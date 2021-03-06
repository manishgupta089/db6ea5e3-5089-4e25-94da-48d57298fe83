<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php
	$master = Master::model()->findByPK(1);
?>
<h2 style="text-transform: uppercase;text-align:center;">NILL BILL(GOVT. CONTR.) OF <?php echo ($model->BILL_TYPE == 1)? "OPS":"NPS"; ?> STAFF OF  <?php echo $master->DEPT_NAME?>FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h2>
<h2 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->NILL_BILL_NO; ?></h2>
<p>( 8342 : [ 20.02 ]     Government's Contribution Tier-I )</p>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<th class="small-xx">Pay in PB</th>
			<th class="small-xx">GP</th>
			<th class="small-xx right-br left-br">BASIC</th>
			<th class="small-xxx">DA</th>
			<th class="small-xx">SP</th>
			<th class="small-xx">PP</th>
			<th class="small-xx">CCA</th>
			<th class="small-xxx">HRA</th>
			<th class="small-xxx">TA</th>
			<th class="small-xxx">Expenditure Awaiting Transfer</th>
			<th class="small-xxx">WA</th>
			<th class="small-xxx">GROSS</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT ID FROM db_oneadmin.tbl_employee ORDER BY DESIGNATION_ID_FK DESC")->queryAll();
		$employeesIds = array();
		foreach($employees as $employee) array_push($employeesIds, $employee['ID']);
		$criteria=new CDbCriteria;
		$criteria->order="FIELD(EMPLOYEE_ID_FK, ".implode( ", ", $employeesIds ).")";
		$criteria->condition = "BILL_ID_FK=$model->ID AND YEAR=$model->YEAR AND $model->MONTH";
		$criteria->addInCondition('EMPLOYEE_ID_FK', $employeesIds);
		$salaries = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($salaries as $salary) { ?>
		<tr>
			<td class="small-xxx right-br"><?php echo $i; ?></td>
			<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
			<td class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
			<td class="small-xx"><?php echo $salary->BASIC; ?></td>
			<td class="small-xx"><?php echo $salary->GP; ?></td>
			<td class="small-xx right-br left-br"><?php echo $salary->BASIC + $salary->GP; ?></td>
			<td class="small-xxx"><?php echo $salary->DA; ?></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xxx"></td>
			<td class="small-xxx"></td>
			<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
			<td class="small-xxx"></td>
			<td class="small-xxx"></td>
			<td class="small-xxx"></td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"></th>
		<th class="small-xx"><?php $BASIC = Yii::app()->db->createCommand("SELECT SUM(BASIC) as BASIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['BASIC'];echo $BASIC;?></th>
		<th class="small-xx"><?php $GP = Yii::app()->db->createCommand("SELECT SUM(GP) as GP FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['GP'];echo $GP;?></th>
		<th class="small-xx right-br left-br"><?php echo $BASIC + $GP;?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(DA) as DA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['DA'];?></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xxx"></th>
		<th class="small-xxx"></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_I'];?></th>
		<th class="small-xxx"></th>
		<th class="small-xxx"></th>
		<th class="small-xxx"></th>
	</tfoot>
</table>

<div style="width: 400px; margin: 0 auto; font-size: 20px; margin-top:100px;">
	<?php $appropiations = Yii::app()->db->createCommand("SELECT * FROM tbl_appropiation_register WHERE BILL_NO = $model->ID")->queryRow(); ?>
	<h4 style="text-decoration: underline;">Appropiation</h4>
	<p><b>Budget: </b>Rs. <?php echo Budget::model()->findByPK($appropiations['BUDGET_ID'])->AMOUNT;?>/-</p>
	<p><b>Bill Amount: </b>Rs. <?php echo $appropiations['BILL_AMOUNT'];?>/-</p>
	<p><b>Expenditure Including Bill: </b>Rs. <?php echo $appropiations['EXPENDITURE_INC_BILL'];?>/-</p>
	<p><b>Balance: </b>Rs. <?php echo $appropiations['BALANCE'];?>/-</p>
</div>
