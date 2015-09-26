<?php 
/*库存流水*/
class inventory_class
{
	var $DocId=null; //单据号
	var $ProductId; //商品ID
	var $InventoryClassId=1;  //库位ID
	var $NewInventoryClassId;  //新库位ID
	var $MemberId=0;   //采购/销售的会员ID
	var $AgentId=0;  //采购/销售的体验店批发户ID
	var $ShoppingId=0;  //采购/销售的体验店ID
	var $Class;  //赋值范围：price[库存价格修正],sale_order[销售出库],sale_back[销售退货入库],purchase_order[采购入库],purchase_back[采购退回出库],stocktaking[盘盈/盘亏],move[移库],shopping_input[体验店采购入库],shopping_output[体验店销售出库]
	var $PostTotal=0;  //操作数量
	var $PostSalePrice=0;  //销售价格
	var $PostDiscount=0;  //销售折扣
	var $PostBuyPrice=0;  //采购价格
	var $SalePrice=0;
	var $Discount=0;
	var $BuyPrice=0;
	var $InvTotal=0;
	var $ModTotal=0;
	var $hasInv=false;
	var $IsPublicInv=false;  //判定是否为常规销售库
	var $ExecTime;
	
	public function __construct(){}
	
	public function send()
	{
		$val=0;
		$this->ProductId=str2int($this->ProductId);
		$this->InventoryClassId=str2int($this->InventoryClassId);
		$this->NewInventoryClassId=str2int($this->NewInventoryClassId);
		$this->ShoppingId=str2int($this->ShoppingId);
		$this->PostTotal=abs(str2int($this->PostTotal));
		$this->PostSalePrice=str2int($this->PostSalePrice,2);
		$this->PostDiscount=str2int($this->PostDiscount,2);
		$this->PostBuyPrice=str2int($this->PostBuyPrice,2);
		$this->ExecTime=smarty_make_timestamp(date("Y-m-d H:i:s"));
		if(isnull($this->DocId)){
			echo "err : DocId";exit;	
		}
		if($this->ProductId==0){
			echo "err : ProductId";exit;	
		}
		if($this->InventoryClassId==0){
			echo "err : InventoryClassId";exit;	
		}
		$result=query("select InventoryClassId from inventory_class_tbl where InventoryClassId='".$this->InventoryClassId."' and IsPublic=1");
		if(num_rows($result))$this->IsPublicInv=true;
		$result=query("select InvTotal,ModTotal,SalePrice,BuyPrice,Discount from product_inventory_tbl where ProductId='".$this->ProductId."' and InventoryClassId='".$this->InventoryClassId."'");
		if(num_rows($result))
		{
			$this->hasInv=true;
			$row=fetch_array($result);
			$this->InvTotal=str2int($row["InvTotal"]);
			$this->ModTotal=str2int($row["ModTotal"]);
			$this->SalePrice=str2int($row["SalePrice"],2);
			$this->BuyPrice=str2int($row["BuyPrice"],2);
			$this->Discount=str2int($row["Discount"],2);
		}
		if(!$this->hasInv)
		{
			$ProductSalePrice=0;$ProductDiscount=0;$ProductModTotal=0;
			$result=query("select SalePrice,Discount from product_tbl where ProductId='".$this->ProductId."'");
			if(num_rows($result))
			{
				$row=fetch_array($result);
				$ProductSalePrice=str2int($row[0],2);
				$ProductDiscount=str2int($row[1],2);
			}
			query("insert into product_inventory_tbl(BuyPrice,SalePrice,Discount,InvTotal,ModTotal,InTotal,ProductId,InventoryClassId)values
				('$ProductSalePrice','$ProductSalePrice','$ProductDiscount','$ProductModTotal','$ProductModTotal','$ProductModTotal','".$this->ProductId."','".$this->InventoryClassId."')");
			$this->InvTotal=$ProductModTotal;
			$this->ModTotal=$ProductModTotal;
		}
		switch($this->Class)
		{
			case "price":
				$val=$this->price_event();break;
			case "sale_order":
				$val=$this->sale_order_event();break;
			case "sale_back":
				$val=$this->sale_back_event();break;
			case "purchase_order":
				$val=$this->purchase_order_event();break;
			case "purchase_back":
				$val=$this->purchase_back_event();break;
			case "stocktaking":
				$val=$this->stocktaking_event();break;	
			case "shopping_input":
				$val=$this->shopping_input_event();break;
			case "shopping_output":
				$val=$this->shopping_output_event();break;
			case "move":
				$val=$this->move_event();break;	
			default:
				$val=$this->def_event();break;
		}
		return $val;
	}
	
	function def_event()  //默认事件
	{
		$NowInvTotal=0;
		$result=query("select InvTotal from product_inventory_tbl where ProductId='".$this->ProductId."' and InventoryClassId='".$this->InventoryClassId."'");
		if(num_rows($result))
		{
			$row=fetch_array($result);
			$NowInvTotal=$row["InvTotal"];
		}
		return $NowInvTotal;
	}
	
	function in_event()  //入库事件
	{
		$str=false;
		$strSQL="update product_inventory_tbl set InvTotal=InvTotal+".$this->PostTotal.",ModTotal=ModTotal+".$this->PostTotal.",InTotal=InTotal+".$this->PostTotal." 
		where ProductId='".$this->ProductId."' and InventoryClassId='".$this->InventoryClassId."';";
		if($this->IsPublicInv)$strSQL.="update product_tbl set ModTotal=ModTotal+".$this->PostTotal." where ProductId='".$this->ProductId."';";
		array_query($strSQL);
		$str=true;
		return $str;
	}
	
	function out_event()  //出库事件
	{
		$str=false;
		$strSQL="update product_inventory_tbl set InvTotal=InvTotal-".$this->PostTotal.",ModTotal=ModTotal-".$this->PostTotal.",InTotal=InTotal-".$this->PostTotal." 
		where ProductId='".$this->ProductId."' and InventoryClassId='".$this->InventoryClassId."';";
		if($this->IsPublicInv)$strSQL.="update product_tbl set ModTotal=ModTotal-".$this->PostTotal." where ProductId='".$this->ProductId."';";
		array_query($strSQL);
		$str=true;
		return $str;
	}
	
	function price_event()  //库存价格修正事件
	{
		$strSQL="update product_inventory_tbl set SalePrice=".$this->PostSalePrice.",Discount=".$this->PostDiscount." 
		where ProductId='".$this->ProductId."' and InventoryClassId='".$this->InventoryClassId."';";
		if($this->IsPublicInv)$strSQL.="update product_tbl set SalePrice=".$this->PostSalePrice.",Discount=".$this->PostDiscount." where ProductId='".$this->ProductId."';";
		$strSQL.="insert into product_inventory_price_edit_log_tbl(ProductId,LinkDocNumber,Price,OldPrice,Discount,OldDiscount,InventoryClassId)values
		('".$this->ProductId."','".$this->DocId."','".$this->PostSalePrice."','".$this->SalePrice."','".$this->PostDiscount."','".$this->Discount."','".$this->InventoryClassId."');";
		array_query($strSQL);
		$str=true;
		return $this->PostSalePrice;
	}
	
	function sale_order_event()  //销售出库事件
	{
		$this->out_event();
		$InvTotal=$this->def_event();
		return $InvTotal;
	}
	
	function sale_back_event()  //销售退货入库事件
	{
		$this->in_event();
		$InvTotal=$this->def_event();
		return $InvTotal;
	}
	
	function purchase_order_event()  //采购入库事件
	{
		$this->in_event();
		$InvTotal=$this->def_event();
		query("insert into product_inventory_exec_log_tbl(ExecTime,ProductId,LinkDocNumber,Total,NowTotal,InventoryClassId)values
			('".$this->ExecTime."','".$this->ProductId."','".$this->DocId."','".$this->PostTotal."','$InvTotal','".$this->InventoryClassId."')");
		return $InvTotal;
	}
	
	function purchase_back_event()  //采购退回出库事件
	{
		$this->out_event();
		$InvTotal=$this->def_event();
		query("insert into product_inventory_exec_log_tbl(ExecTime,ProductId,LinkDocNumber,Total,NowTotal,InventoryClassId)values
			('".$this->ExecTime."','".$this->ProductId."','".$this->DocId."','".$this->PostTotal."','$InvTotal','".$this->InventoryClassId."')");
		return $InvTotal;
	}
	
	function stocktaking_event()  //盘盈/盘亏事件
	{
		if($this->PostTotal<>0)
		{
			$this->in_event();
		}
		$InvTotal=$this->def_event();
		return $InvTotal;
	}
	
	function move_event()  //移库事件
	{
		if($this->PostTotal<>0)
		{
			$NewPrice=str2int($this->PostSalePrice,2);
			if($NewPrice>0)$tempSQL=",SalePrice=$NewPrice";
			$NewtDiscount=str2int($this->PostDiscount,2);
			if($NewtDiscount>0)$tempSQL.=",Discount=$NewtDiscount";
			$strSQL="update product_inventory_tbl set InvTotal=InvTotal+".$this->PostTotal.",ModTotal=ModTotal+".$this->PostTotal.$tempSQL." 
			where ProductId='".$this->ProductId."' and InventoryClassId='".$this->NewInventoryClassId."';";
			$strSQL.="update product_inventory_tbl set InvTotal=InvTotal-".$this->PostTotal.",ModTotal=ModTotal-".$this->PostTotal." 
			where ProductId='".$this->ProductId."' and InventoryClassId='".$this->InventoryClassId."';";
			if($this->IsPublicInv)
			{
				$InvTotal=$this->def_event();
				$strSQL.="update product_tbl set ModTotal=".$InvTotal." where ProductId='".$this->ProductId."';";
			}
			array_query($strSQL);
		}
		$InvTotal=$this->def_event();
		return $InvTotal;
	}
	
	function shopping_input_event()  //体验店采购入库事件
	{
		$hasData=false;
		if(str2int($this->AgentId)>0)
		{
			$BuyPrice=str2int(($this->PostSalePrice*$this->PostDiscount)/10,2);
			$InventoryClassId=7;$ShoppingId=0;
			$result=query("select InventoryClassId,(select ShoppingId from shopping_tbl where AgentId='".$this->AgentId."' limit 1) as ShoppingId from inventory_class_tbl where IsPrivate=1");
			if(num_rows($result)){
				$row=fetch_array($result);
				$InventoryClassId=str2int($row['InventoryClassId']);
				$ShoppingId=str2int($row['ShoppingId']);
			}
			$result=query("select ProductId from product_inventory_tbl where ProductId='".$this->ProductId."' and AgentId='".$this->AgentId."' and MemberId='".$this->MemberId."' and ShoppingId='$ShoppingId'");
			if(num_rows($result))$hasData=true;
			if($hasData)
			{
				$strSQL="update product_inventory_tbl set InvTotal=InvTotal+".$this->PostTotal.",ModTotal=ModTotal+".$this->PostTotal.",InTotal=InTotal+".$this->PostTotal.",BuyPrice=".$BuyPrice.",SalePrice=".$this->PostSalePrice.",Discount=".$this->PostDiscount.",UpdateTime='".$this->ExecTime."' 
				where ProductId='".$this->ProductId."' and AgentId='".$this->AgentId."' and MemberId='".$this->MemberId."' and ShoppingId='$ShoppingId'";
			}else{
				$strSQL="insert into product_inventory_tbl(Saleed,ProductId,MemberId,AgentId,ShoppingId,InventoryClassId,InvTotal,ModTotal,InTotal,BuyPrice,SalePrice,Discount,UpdateTime)values
				(1,'".$this->ProductId."','".$this->MemberId."','".$this->AgentId."','$ShoppingId','".$InventoryClassId."','".$this->PostTotal."','".$this->PostTotal."','".$this->PostTotal."','".$BuyPrice."','".$this->PostSalePrice."','".$this->PostDiscount."','".$this->ExecTime."')";
			}
			query($strSQL);
		}else{
			echo '未找到实际“AgentId”，入库终止';exit;	
		}
		return $hasInv;
	}
	
	function shopping_output_event()  //体验店销售出库事件
	{
		$hasData=false;
		if(str2int($this->ShoppingId)>0)
		{
			$result=query("select ProductId from product_inventory_tbl where ProductId='".$this->ProductId."' and ShoppingId='".$this->ShoppingId."'");
			if(num_rows($result))$hasData=true;
			if($hasData)
			{
				$strSQL="update product_inventory_tbl set InvTotal=InvTotal-".$this->PostTotal.",ModTotal=ModTotal-".$this->PostTotal." where ProductId='".$this->ProductId."' and ShoppingId='".$this->ShoppingId."'";
				query($strSQL);
			}
		}else{
			echo '未找到实际“ShoppingId”，出库终止';exit;	
		}
		return $hasInv;
	}
}
?>