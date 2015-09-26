<?php 
/*订单工作*/
class order_class
{
	var $Class; //订单类别：member_order[会员销售订单],agent_order[批发线上销售订单],agent_offline_order[批发线下销售订单]
	var $Identity=1; //订单身份：1会员自己，10系统管理员
	var $MemberId;   //订单会员ID
	var $PayClassId;  //结算方式
	var $SendClassId;  //配送方式
	var $PostTime; //实时时间
	var $ExecTime; //单据执行时间
	var $Payed;  //是否已支付
	var $PayLogId;  //支付流水号
	var $Remark;  //备注
	
	var $AgentId=0;  //采购/销售的体验店批发户ID
	var $ShoppingId=0;  //采购/销售的体验店ID
	var $OrderClass='';
	var $OrderId='';
	var $ExecClass='';
	var $ExecId='';
	var $LinkMan='unknow';
	var $LinkAddress='unknow';
	var $LinkPostCode='unknow';
	var $LinkTel='unknow';
	var $LinkMobile='unknow';
	var $LinkProvinceId=0;
	var $LinkCityId=0;
	var $LinkDistrictId=0;
	var $hasOrder=false;
	
	public function __construct(){}
	
	public function post()
	{
		$val=0;
		if(!is_numeric($this->MemberId)||$this->MemberId=="")$this->MemberId=0;
		$this->PayClassId=str2int($this->PayClassId);
		$this->Payed=str2int($this->Payed);
		$this->SendClassId=str2int($this->SendClassId);
		$this->PostTime=smarty_make_timestamp(date("Y-m-d H:i:s"));
		if(isnull($this->Class)){
			echo "err : Class";exit;	
		}
		if($this->MemberId==0){
			echo "err : MemberId";exit;	
		}
		if($this->PayClassId==0){
			echo "err : PayClassId";exit;	
		}
		if($this->SendClassId==0){
			echo "err : SendClassId";exit;	
		}
		if(!isnull($this->ExecTime))
		{
			$TmpTime=$this->ExecTime.' '.date("H:i:s");
			$TmpTime=format_dt($TmpTime,'%Y-%m-%d %H:%M:%S');
			$this->ExecTime=smarty_make_timestamp($TmpTime);
		}else{
			$this->ExecTime=$this->PostTime;
		}
		$result=query("select AgentId,(select ShoppingId from shopping_tbl where MemberId='$MemberId' limit 1) as ShoppingId from member_tbl where MemberId='".$this->MemberId."'");
		if(num_rows($result))
		{
			$row=fetch_array($result);
			$this->AgentId=str2int($row['AgentId']);
			$this->ShoppingId=str2int($row['ShoppingId']);
		}
		$result=query("select Linkman,Address,PostCode,Tel,Mobile,ProvinceId,CityId,DistrictId from member_address_tbl where IsRoot=1 and MemberId='".$this->MemberId."'");
		if(num_rows($result)){
			$row=fetch_array($result);
			$this->LinkMan=$row[0];
			$this->LinkAddress=$row[1];
			$this->LinkPostCode=$row[2];
			$this->LinkTel=$row[3];
			$this->LinkMobile=$row[4];
			$this->LinkProvinceId=$row[5];
			$this->LinkCityId=$row[6];
			$this->LinkDistrictId=$row[7];
		}
		switch($this->Class)
		{
			case "member_order":
				$this->OrderClass=get_doc_code('MemberOrderHead',"k");
				$this->OrderId=get_doc_code('MemberOrderHead');
				$this->ExecClass=get_doc_code('MemberOrderExecHead',"k");
				$this->ExecId=get_doc_code('MemberOrderExecHead');
				//$val=$this->order_event();
				break;
			case "member_order_exec":
				$this->ExecClass=get_doc_code('MemberOrderExecHead',"k");
				$this->ExecId=get_doc_code('MemberOrderExecHead');
				//$val=$this->order_event();
				break;
			case "agent_order":
				$this->OrderClass=get_doc_code('AgentOrderHead',"k");
				$this->OrderId=get_doc_code('AgentOrderHead');
				$this->ExecClass=get_doc_code('AgentOrderExecHead',"k");
				$this->ExecId=get_doc_code('AgentOrderExecHead');
				//$val=$this->order_event();
				break;
			case "agent_offline_order":
				$this->OrderClass=get_doc_code('AgentOfflineOrderHead',"k");
				$this->OrderId=get_doc_code('AgentOfflineOrderHead');
				$this->ExecClass=get_doc_code('AgentOrderExecHead',"k");
				$this->ExecId=get_doc_code('AgentOrderExecHead');
				//$val=$this->order_event();
				break;
		}
		return $val;
	}
	
	function order_event()  //销售订单事件
	{
		
	}
	
	function order_event()  //销售订单事件
	{
		$ExecResult=false;
		$result=query("select t.TempOrderId,t.ProductId,t.Price,t.Discount,t.Total,t.ShoppingId,t.InventoryClassId,t.LotNumber,t.BatchNumber from temp_order_tbl t,product_tbl p,member_tbl m where (t.UserName=m.MemberName and t.ProductId=p.ProductId) and m.MemberId='".$this->MemberId."' and t.OrderClass='".$this->OrderClass."' and t.IsRegisterUser='".$this->Identity."' order by t.TempOrderId");
		while($row=fetch_array($result))
		{
			$ExecResult=true;
			$TempOrderId=$row["TempOrderId"];
			$ProductId=$row["ProductId"];
			$Price=$row["Price"];
			$Price=str2int($Price,2);
			$Total=str2int($row["Total"]);
			$InventoryClassId=str2int($row["InventoryClassId"]);
			$LotNumber=$row["LotNumber"];
			$BatchNumber=$row["BatchNumber"];
			$NeedAmount=$Price*$Total;
			$NeedAmount=str2int($NeedAmount,2);
			if($this->AgentId>0)
			{
				$ShoppingId=0;
				$Discount=str2int($row["Discount"],2);
				$Amount=$NeedAmount*$Discount/10;
				$Amount=str2int($Amount,2);
			}else{
				$ShoppingId=str2int($row["ShoppingId"]);
				$Discount=10;
				$Amount=$NeedAmount;
			}
			array_query("insert into sale_order_detail_tbl(`OrderId`,`ProductId`,`Price`,`Total`,Discount,ShoppingId,NeedAmount,`Amount`,`InventoryClassId`,LotNumber,BatchNumber,Remark)
			values('".$this->OrderId."','$ProductId','$Price','$Total','$Discount','$ShoppingId','$NeedAmount','$Amount','$InventoryClassId','$LotNumber','$BatchNumber','$Remark');
			delete from `temp_order_tbl` where TempOrderId='$TempOrderId';");
		}
		if($ExecResult)
		{
			$HeadAmount=0;$HeadTotalAmount=0;
			$result=query("select sum(Amount) from sale_order_detail_tbl where OrderId='$OrderId'");
			if(num_rows($result))
			{
				$row=fetch_array($result);
				$HeadAmount=str2int($row[0],2);
				$HeadTotalAmount=$HeadAmount;
			}
			$StatusId='audited';
			if($Payed==0)$StatusId='waitpay';
			if($Payed==1)$StatusId='payed';
			$Status=get_val('order_status_tbl','StatusKey','StatusName',$StatusId);
			query("insert into sale_order_head_tbl
			(`OrderId`,OrderClass,AgentId,`MemberId`,Amount,TotalAmount,PayClassId,SendClassId,ProvinceId,CityId,DistrictId,AddRess,PostCode,Name,Tel,Mobile,Status,ManageId,Remark,AddTime,Payed,PayLogId)values
			('".$this->OrderId."','".$this->OrderClass."','".$this->AgentId."','".$this->MemberId."','$HeadAmount','$HeadTotalAmount','".$this->PayClassId."','".$this->SendClassId."','".$this->LinkProvinceId."','".$this->LinkCityId."','".$this->LinkDistrictId."','".$this->LinkAddress."','".$this->LinkPostCode."','".$this->LinkMan."','".$this->LinkTel."','".$this->LinkMobile."','$Status',0,'".$this->Remark."','".$this->PostTime."','".$this->Payed."','".$this->PayLogId."')");
		}
		return $ExecResult;
	}
	
	function order_exec_event()  //销售订单执行事件
	{
		$ExecResult=false;
		$Status=get_val('order_status_tbl','StatusKey','StatusName','completed');
		array_query("insert into sale_order_detail_tbl(`OrderId`,`ProductId`,`Price`,`Total`,Discount,ShoppingId,NeedAmount,`Amount`,`InventoryClassId`,LotNumber,BatchNumber,Remark)
		(select '".$this->ExecId."',`ProductId`,`Price`,`Total`,Discount,ShoppingId,NeedAmount,`Amount`,`InventoryClassId`,LotNumber,BatchNumber,Remark from sale_order_detail_tbl where OrderId='".$this->OrderId."');
		insert into sale_order_head_tbl(Execed,ExecTime,Status,`OrderId`,LinkOrderId,OrderClass,AgentId,`MemberId`,Amount,TotalAmount,PayClassId,Payed,PayLogId,SendClassId,Remark,ProvinceId,CityId,DistrictId,AddRess,PostCode,Name,Tel,Mobile,AddTime)
	(select '1','".$this->ExecTime."','$Status','".$this->ExecId."',OrderId,'".$this->ExecClass."',AgentId,MemberId,Amount,TotalAmount,PayClassId,Payed,PayLogId,SendClassId,Remark,ProvinceId,CityId,DistrictId,AddRess,PostCode,Name,Tel,Mobile,'".$this->PostTime."' from sale_order_head_tbl where OrderId='".$this->OrderId."')");
		$result=query("select ProductId,Total,InventoryClassId,LotNumber,BatchNumber from sale_order_detail_tbl where OrderId='".$this->ExecId."'");
		while($row=fetch_array($result)){
			$ProductId=str2int($row["ProductId"]);
			$ProductTotal=str2int($row["Total"]);
			$ProductInventoryClassId=str2int($row["InventoryClassId"]);
			$ProductLotNumber=$row["LotNumber"];
			$ProductBatchNumber=$row["BatchNumber"];
			if($ProductId>0)
			{
				$myinv=new inventory_class();
				$myinv->DocId=$OrderId;
				$myinv->InventoryClassId=$ProductInventoryClassId;
				$myinv->NewInventoryClassId=$NewInventoryClassId;
				$myinv->ProductId=$ProductId;
				$myinv->PostTotal=$ProductTotal;
				$myinv->Class="sale_order";
				$myinv->send();
				if($this->AgentId>0)
				{
					$hasProduct=false;
					$ret=query("select Id from shopping_inventory_tbl where ProductId='$ProductId' and AgentId='".$this->AgentId."'");
					if(num_rows($ret))$hasProduct=true;
					if($hasProduct)
					{
						$strSQL="update set shopping_inventory_tbl set ShoppingId='".$this->ShoppingId."',InvTotal=InvTotal+$ProductTotal,InTotal=InTotal+$ProductTotal,UpdateTime='".$this->PostTime."' where ProductId='$ProductId' and AgentId='".$this->AgentId."'";
					}else{
						$strSQL="insert into sale_order_detail_tbl(ProductId,MemberId,AgentId,ShoppingId,InvTotal,InTotal,UpdateTime)values('$ProductId','".$this->MemberId."','".$this->AgentId."','".$this->ShoppingId."','$ProductTotal','$ProductTotal','".$this->PostTime."')";
					}
					query($strSQL);
				}
			}
		}
		return $ExecResult;
	}
	
}
?>