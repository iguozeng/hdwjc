<?php 
/*�����ˮ*/
class inventory_class
{
	var $DocId=null; //���ݺ�
	var $ProductId; //��ƷID
	var $InventoryClassId=1;  //��λID
	var $NewInventoryClassId;  //�¿�λID
	var $MemberId=0;   //�ɹ�/���۵Ļ�ԱID
	var $AgentId=0;  //�ɹ�/���۵������������ID
	var $ShoppingId=0;  //�ɹ�/���۵������ID
	var $Class;  //��ֵ��Χ��price[���۸�����],sale_order[���۳���],sale_back[�����˻����],purchase_order[�ɹ����],purchase_back[�ɹ��˻س���],stocktaking[��ӯ/�̿�],move[�ƿ�],shopping_input[�����ɹ����],shopping_output[��������۳���]
	var $PostTotal=0;  //��������
	var $PostSalePrice=0;  //���ۼ۸�
	var $PostDiscount=0;  //�����ۿ�
	var $PostBuyPrice=0;  //�ɹ��۸�
	var $SalePrice=0;
	var $Discount=0;
	var $BuyPrice=0;
	var $InvTotal=0;
	var $ModTotal=0;
	var $hasInv=false;
	var $IsPublicInv=false;  //�ж��Ƿ�Ϊ�������ۿ�
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
	
	function def_event()  //Ĭ���¼�
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
	
	function in_event()  //����¼�
	{
		$str=false;
		$strSQL="update product_inventory_tbl set InvTotal=InvTotal+".$this->PostTotal.",ModTotal=ModTotal+".$this->PostTotal.",InTotal=InTotal+".$this->PostTotal." 
		where ProductId='".$this->ProductId."' and InventoryClassId='".$this->InventoryClassId."';";
		if($this->IsPublicInv)$strSQL.="update product_tbl set ModTotal=ModTotal+".$this->PostTotal." where ProductId='".$this->ProductId."';";
		array_query($strSQL);
		$str=true;
		return $str;
	}
	
	function out_event()  //�����¼�
	{
		$str=false;
		$strSQL="update product_inventory_tbl set InvTotal=InvTotal-".$this->PostTotal.",ModTotal=ModTotal-".$this->PostTotal.",InTotal=InTotal-".$this->PostTotal." 
		where ProductId='".$this->ProductId."' and InventoryClassId='".$this->InventoryClassId."';";
		if($this->IsPublicInv)$strSQL.="update product_tbl set ModTotal=ModTotal-".$this->PostTotal." where ProductId='".$this->ProductId."';";
		array_query($strSQL);
		$str=true;
		return $str;
	}
	
	function price_event()  //���۸������¼�
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
	
	function sale_order_event()  //���۳����¼�
	{
		$this->out_event();
		$InvTotal=$this->def_event();
		return $InvTotal;
	}
	
	function sale_back_event()  //�����˻�����¼�
	{
		$this->in_event();
		$InvTotal=$this->def_event();
		return $InvTotal;
	}
	
	function purchase_order_event()  //�ɹ�����¼�
	{
		$this->in_event();
		$InvTotal=$this->def_event();
		query("insert into product_inventory_exec_log_tbl(ExecTime,ProductId,LinkDocNumber,Total,NowTotal,InventoryClassId)values
			('".$this->ExecTime."','".$this->ProductId."','".$this->DocId."','".$this->PostTotal."','$InvTotal','".$this->InventoryClassId."')");
		return $InvTotal;
	}
	
	function purchase_back_event()  //�ɹ��˻س����¼�
	{
		$this->out_event();
		$InvTotal=$this->def_event();
		query("insert into product_inventory_exec_log_tbl(ExecTime,ProductId,LinkDocNumber,Total,NowTotal,InventoryClassId)values
			('".$this->ExecTime."','".$this->ProductId."','".$this->DocId."','".$this->PostTotal."','$InvTotal','".$this->InventoryClassId."')");
		return $InvTotal;
	}
	
	function stocktaking_event()  //��ӯ/�̿��¼�
	{
		if($this->PostTotal<>0)
		{
			$this->in_event();
		}
		$InvTotal=$this->def_event();
		return $InvTotal;
	}
	
	function move_event()  //�ƿ��¼�
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
	
	function shopping_input_event()  //�����ɹ�����¼�
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
			echo 'δ�ҵ�ʵ�ʡ�AgentId���������ֹ';exit;	
		}
		return $hasInv;
	}
	
	function shopping_output_event()  //��������۳����¼�
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
			echo 'δ�ҵ�ʵ�ʡ�ShoppingId����������ֹ';exit;	
		}
		return $hasInv;
	}
}
?>