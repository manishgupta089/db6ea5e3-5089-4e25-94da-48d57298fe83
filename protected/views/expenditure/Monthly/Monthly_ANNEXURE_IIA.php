<?php require_once "/../../../../include/ExpenditureReportInclude.php";?>
<?php
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1); 
?>
<p style="font-size: 20px;text-align: center;font-weight: bold;">अनुबंध-II/ANNEXURE - II A</p>
<span style="font-size: 15px;font-weight: bold;"><?php echo $master->OFFICE_NAME_HINDI;?><br><?php echo $master->OFFICE_NAME;?></span>
<div style="float: right;font-weight: bold;">
	<p>MAJOR HEAD : 2038 Union Excise Duties</p>
	<p>MINOR HEAD : B.2(2) Other Offices.</p>
</div>
<p style="font-size: 15px;text-align: center;font-weight: bold;"><?php echo $monthNameHindi[$this->Month]?> -<?php echo $this->Year?> माह के लिए मासिक व्यय विवरण/MONTHLY EXPENDITURE STATEMENT FOR THE MONTH OF - <?php echo $monthName[$this->Month]?> <?php echo $this->Year?></p>
<br><p style="font-size: 20px;text-align: center;font-weight: bold;">कार्यालय व्यय/OFFICE EXPENSES</p>
<br><br>
<table class="one-table" >
	<thead>
		<tr>
			<th>Sl.NO</th>
			<th>बिल सं. एवं दिनांक/ Bill No. and Date</th>
			<th>Wages</th>
			<th>यात्रा खर्च/ Travel Expenses (DTE)</th>
			<th>कुल कार्यालय व्यय/ Total Office Expenses</th>
			<th>Information Technologies (IT)</th>
			<th>Payment of staff special services law charges.</th>
			<th>Rent rates & Taxes (RRT)</th>
			<th>Secret service expenditures/DG Set</th>
			<th>Reward to informer</th>
			<th>O.T.A</th>
			<th>P.P & S.S</th>
			<th>Any other charges</th>
			<th>Total other charges</th>
			<th>GRAND TOTAL</th>
			<th>Remarks</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$criteria=new CDbCriteria;        
			$criteria->compare("MONTH(PASSED_DATE)",$this->Month);
			$criteria->compare("YEAR(PASSED_DATE)",$this->Year);
			$criteria->compare("PFMS_STATUS",'Passed');
			$criteria->addInCondition("BILL_TYPE",array(3, 4, 8));
			$Bills = Bill::model()-> findAll($criteria);
			$billsArray = array(); 
			$i=1;
			foreach($Bills as $bill)
				array_push($billsArray, $bill->ID);
				
			if(count($billsArray) > 0){
				foreach($Bills as $bill){
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $bill->BILL_NO;?></td>
					<td><?php echo ($bill->BILL_TYPE == 8) ? $bill->BILL_AMOUNT : 0;?></td>
					<td><?php echo ($bill->BILL_TYPE == 4) ? $bill->BILL_AMOUNT : 0;?></td>
					<td><?php echo ($bill->BILL_TYPE == 3) ? $bill->BILL_AMOUNT : 0;?></td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td><?php echo $bill->BILL_AMOUNT?></td>
					<td></td>
				</tr>	
				<?php
					$i++;
				} ?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">TOTAL</td>
					<td><?php $WAGES_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=8")->queryRow()['TOTAL']; echo $WAGES_TOTAL;?></td>
					<td><?php $DTE_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=4")->queryRow()['TOTAL'];echo $DTE_TOTAL;?></td>
					<td><?php $OE_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=3")->queryRow()['TOTAL'];echo $OE_TOTAL;?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><?php echo $WAGES_TOTAL + $DTE_TOTAL + $OE_TOTAL; ?></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">Amount Re-credited</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">NET TOTAL</td>
					<td><?php $NET_WAGES_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=8")->queryRow()['TOTAL']; echo $NET_WAGES_TOTAL;?></td>
					<td><?php $NET_DTE_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=4")->queryRow()['TOTAL'];echo $NET_DTE_TOTAL;?></td>
					<td><?php $NET_OE_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=3")->queryRow()['TOTAL'];echo $NET_OE_TOTAL;?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><?php echo $NET_WAGES_TOTAL + $NET_DTE_TOTAL + $NET_OE_TOTAL; ?></td>
					<td></td>
				</tr>
			<?php } ?>	
				<?php
					$financialYear = FinancialYears::model()->find('STATUS=1');
					$criteria=new CDbCriteria;
					$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".date_create($this->Year."-".$this->Month." last day of last month")->format('Y-m-d')."'";
					$criteria->compare("PFMS_STATUS",'Passed');
					$criteria->addInCondition("BILL_TYPE",array(3,4,8));
					$bills = Bill::model()-> findAll($criteria);
					$tpmbillsArray = array();
					foreach($bills as $bill)
						array_push($tpmbillsArray, $bill->ID);
					
					$queryCondition = "";
					if(count($tpmbillsArray) > 0){
						$queryCondition.="ID IN (".implode($tpmbillsArray, ',').") AND ";
				?>
					<tr>
						<td colspan="2">Total upto Previous Month</td>
						<td><?php $PM_WAGES_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=8")->queryRow()['TOTAL'];echo $PM_WAGES_TOTAL;?></td>
						<td><?php $PM_DTE_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=4")->queryRow()['TOTAL'];echo $PM_DTE_TOTAL;?></td>
						<td><?php $PM_OE_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=3")->queryRow()['TOTAL'];echo $PM_OE_TOTAL;?></td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td><?php echo $PM_WAGES_TOTAL + $PM_DTE_TOTAL + $PM_OE_TOTAL;?></td>
						<td></td>
					</tr>
				<?php
					}
					else{
						?>
							<tr>
								<td colspan="2">Total upto Previous Month</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td></td>
							</tr>
						<?php
					}
				?>
				<?php
					$d = new DateTime( $this->Year.'-'.$this->Month ); 
					$criteria=new CDbCriteria;        
					$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".$d->format( 'Y-m-t' )."'";
					$criteria->compare("PFMS_STATUS",'Passed');
					$criteria->addInCondition("BILL_TYPE",array(3,4,8));
					$bills = Bill::model()-> findAll($criteria);
					$pbillsArray = array();
					foreach($bills as $bill)
						array_push($pbillsArray, $bill->ID);
					
					$queryCondition = "";
					if(count($pbillsArray) > 0){
						$queryCondition.="ID IN (".implode($pbillsArray, ',').") AND ";?>
						<tr>
							<td colspan="2">Progressive Total</td>
							<td><?php $PT_WAGES_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=8")->queryRow()['TOTAL'];echo $PT_WAGES_TOTAL;?></td>
							<td><?php $PT_DTE_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=4")->queryRow()['TOTAL'];echo $PT_DTE_TOTAL;?></td>
							<td><?php $PT_OE_TOTAL = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=3")->queryRow()['TOTAL'];echo $PT_OE_TOTAL;?></td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td><?php echo $PT_WAGES_TOTAL + $PT_DTE_TOTAL + $PT_OE_TOTAL;?></td>
							<td></td>
						</tr>
					<?php } else { ?>
						<tr>
							<td colspan="2">Progressive Total</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td></td>
						</tr>
					<?php } ?>
				<?php $budget = Budget::model()->findByPK(2)->AMOUNT + Budget::model()->findByPK(3)->AMOUNT + Budget::model()->findByPK(7)->AMOUNT;
				//ID IN (".implode($billsArray, ',').") AND 
				$billAmount = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE (BILL_TYPE=3 OR BILL_TYPE=4 OR BILL_TYPE=8)")->queryRow()['TOTAL'];?>
				<tr>
					<td colspan="2">SANCTION GRANT</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><?php echo $budget;?></td>
					<td></td>
				</tr>
				<tr>
			<td colspan="2">BALANCE OF APPROPRIATION</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><?php echo $budget-($PT_WAGES_TOTAL + $PT_DTE_TOTAL + $PT_OE_TOTAL);?></td>
			<td></td>
		</tr>
		
	</tbody>
</table>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<style>
	th, td{text-align: center;}
</style>
