<?php require_once "/../../../../include/PayBillsFrontSheetInclude.php";?>
<div style="display: block;border-bottom: 1px solid #000;min-height: 70px;margin-bottom: 5px;">
	<div style="display: inline-block;float: left;width: 50%;">
		<p style="margin-bottom:5px;font-size: 10px;"><b><?php echo $model->BILL_TITLE; ?></b></p>
		<p style="margin-bottom:5px;font-size: 10px;"><strong>NAME OF OFFICE :</strong><span style="border-bottom: 1px dotted #000;"> O/o the <?php echo $master->OFFICE_NAME; ?></span></p>
		<p style="margin-bottom:5px;font-size: 10px;"><strong>PERIOD OF PAYMENT :</strong><span style="border-bottom: 1px dotted #000;"><?php echo date('M-Y', strtotime($model->CREATION_DATE)); ?></span></p>
	</div>
	  <div style="display: inline-block;width: 111px;position: absolute;left: 65%;margin-left: -100px;text-align: center;font-weight: bold;">
		<h4 style="margin-bottom: 5px;font-weight: bold;">CENTRAL	</h4>
		<h2 style="margin-bottom: 0;font-weight: bold;">PAY BILL<p></p></h2>
	</div>
	  <div style="display: inline-block;float: right; width: 25%;">
	  <p style="margin-bottom:5px;font-size: 10px;"><strong>(i) Bill No and  Date:-	</strong><span style="border-bottom: 1px dotted #000;"><?php echo $model->BILL_NO; ?></span></p>
	  <p style="margin-bottom:5px;font-size: 10px;"><strong>(ii)Token No. and Date :</strong></p>
	  <p style="margin-bottom:5px;font-size: 10px;"><strong>(iii) Voucher no. and Date :</strong></p>
	</div>
</div>
<h4 style="text-align: center; font-size: 13px;font-weight: bold;margin-bottom: 5px;">ABSTRACT OF THE CLAIM AND OTHER PARTICULARS</h4>
<div style="width: 100%;position: relative">
	<div style="border: 1px solid;height: 25px;position: absolute;width: 100%;right: 16px;top: 400px;"></div>
	<div style="width: 33%;min-height: 425px;display: inline-block;float: left;font-size: 10px;position: relative;">
		<div style="border: 1px solid;height: 425px;position: absolute;width: 74px;right: 5px;top: 0;"></div>
		<p>(a) Deductions/recoveries adjustable in the books  <br> of Payand Accocunts Officer.</p><br><br>
		<p><span style="font-weight: bold;font-size: 11px;">0021</span> <span style="font-weight: bold;font-size: 11px;"> TAXES ON INCOME	</span></p>
		<?php $IT = Yii::app()->db->createCommand("SELECT SUM(IT) as IT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['IT'];?>
		<p><span style="font-weight: bold;font-size: 11px;">OTHER THAN CORPN. TAX</span><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 50%;">Income Tax:<span style="float: right;font-style: italic;">Rs.<?php echo round(($IT / 103) * 100);?></span></span></p>
		<p><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 50%;">	CESS:<span style="float: right;font-style: italic;">Rs.<?php echo round(($IT / 103) * 2);?></span></span></p>
		<p><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 50%;">	Higher Edn. Cess:<span style="float: right;font-style: italic;">Rs.<?php echo round(($IT / 103) * 1);?></span></span></p>
		<p><span style="font-size: 12px;float: right;margin-right: 10px;display: inline-block;width: 50%;">	<span style="float: right;font-style: italic;font-weight: bold;">Rs.<?php echo $IT;?></span></span></p>
		<p><span style="font-weight: bold;font-size: 11px;">0049 INTEREST RECEIPTS</span><span style="float: right;margin-right: 10px;font-style: italic;"></span></p>
		<p>(i) Interest on House Building </p><br><br>
		<p>(ii) Interst on Motor Conveyance Advance</p>
		<p>(iii) Interest on Other Conveyance </p><br><br>
		<p>(iv)</p><br>
		<p>(v) </p>
		<p><span style="font-weight: bold;font-size: 11px;">0210 MEDICAL</span></p><br>
		<p>C.G.H.S Contribution <span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php $CGHS = Yii::app()->db->createCommand("SELECT SUM(CGHS) as CGHS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CGHS']; echo $CGHS;?></span></p><br>
		<p>HOUSING </p><br>
		<p>Licence Fee <span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php $LF = Yii::app()->db->createCommand("SELECT SUM(LF) as LF FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['LF']; echo $LF;?></span></p><br><br>
		
		<p><span style="font-weight: bold;font-size: 11px;">0235  SOCIAL SECURITY AND WELFARE</span></p><br>
		<p>C.G.E.G.I.S Contribution <span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php $CGEGIS = Yii::app()->db->createCommand("SELECT SUM(CGEGIS) as CGEGIS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CGEGIS']; echo $CGEGIS;?></span></p><br>
		
		<p><span style="font-weight: bold;font-size: 11px;">8342 :</span> <span style="font-weight: bold;font-size: 11px;"> [ 20.01 ]	</span></p>
		<?php 		
				$CPF_TIER_I = Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_I']; 
				$CPF_TIER_II = Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_II) as CPF_TIER_II FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_II']; 
				
			?>
		<p style="font-weight: bold;font-size: 12px;">Employee's Contribution <span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php echo $CPF_TIER_I+$CPF_TIER_II;?></span></p><br>
		<p style="font-weight: bold;font-size: 10px;">Total C/o <span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php echo $IT+$CGHS+$LF+$CGEGIS+$CPF_TIER_I+$CPF_TIER_II;?></span></p><br>
		
	</div>
	<div style="width: 33%;min-height: 425px;display: inline-block;float: left;position: relative;">
		<div style="border: 1px solid;height: 425px;position: absolute;width: 65px;right: 5px;top: 0;"></div>
		<p style="font-weight: bold;font-size: 11px;">Total B/F <span style="float: right;margin-right: 10px;font-style: italic">Rs.<?php echo $IT+$CGHS+$LF+$CGEGIS+$CPF_TIER_I+$CPF_TIER_II;?></span></p><br>
		<p><span style="font-weight: bold;font-size: 11px;">7610 LOANS TO GOVERNMENT SERVANTS, Etc.,</span></p>
		<p><span style="font-weight: bold;font-size: 11px;">LONG TERM ADVANCES</span></p><br>
		<p style="font-size: 11px;">(i) House Building Advance <span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php $HBA_EMI = Yii::app()->db->createCommand("SELECT SUM(HBA_EMI) as HBA_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['HBA_EMI']; echo $HBA_EMI;?></span></p>
		<p><span style="font-size: 11px;">(ii) Advances for purchase of Motor </span><span style="font-weight: bold;font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 40%;">OMCA<span style="float: right;font-style: italic;">Rs.<?php $MCA_EMI = Yii::app()->db->createCommand("SELECT SUM(MCA_EMI) as MCA_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['MCA_EMI']; echo $MCA_EMI;?></span></span></p><br>
		<p><span style="font-weight: bold;font-size: 11px;">SHORT TERM ADVANCES</span></p>
		<p><span style="font-size: 11px;">(i) Advances for purchase of other Conveyance-</span><span style="font-weight: bold;font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 40%;">Cycl.Adv<span style="float: right;font-style: italic;">Rs.<?php $CYCLE_EMI = Yii::app()->db->createCommand("SELECT SUM(CYCLE_EMI) as CYCLE_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CYCLE_EMI']; echo $CYCLE_EMI;?></span></span></p>
		<p><span style="font-size: 11px;">(ii) FAN Advance<span style="float: right;font-style: italic;margin-right: 10px;">Rs. <?php $FAN_EMI = Yii::app()->db->createCommand("SELECT SUM(FAN_EMI) as FAN_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['FAN_EMI']; echo $FAN_EMI;?></span></p>
		<p><span style="font-size: 11px;">(iii) Flood Advance<span style="float: right;font-style: italic;margin-right: 10px;">Rs. <?php $FLOOD_EMI = Yii::app()->db->createCommand("SELECT SUM(FLOOD_EMI) as FLOOD_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['FLOOD_EMI']; echo $FLOOD_EMI;?></span></p>
		<p><span style="font-size: 11px;">(iv) Other Advances<span style="float: right;font-style: italic;margin-right: 10px;">Rs. 0</span></p>
		<p><span style="font-size: 11px;">(v)</p>
		<p><span style="font-size: 11px;">(vi)</p>
		<p><span style="font-size: 11px;">(vii)</p><br>
		<p><span style="font-weight: bold;font-size: 11px;">MISCELLANEOUS RECOVERIES</span></p>
		<p style="font-size: 11px;">Overpayments made during the previous financial year(s)<span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php $MISC = Yii::app()->db->createCommand("SELECT SUM(MISC) as MISC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['MISC']; echo $MISC;?></span></p><br>
		<p><span style="font-weight: bold;font-size: 11px;">Classification of Expenditure.</span></p>
		<p style="font-size: 11px;">(To be filled in by the Drawing and Disbursing Officer)</p>
		<p style="font-size: 11px;">Demand No .</p>
		<p style="font-size: 11px;">Major Head</p>
		<p><span style="font-size: 11px;">Group Head.</span><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 75%;">(iv) Pay & Allowances of Staff/Officers</span></p>
		<p style="font-size: 11px;">Minor Head</p>
		<p><span style="font-size: 11px;">Sub - Head.</span><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 60%;text-align: center;">Salaries</span></p><br>
		<p><span style="font-weight: bold;font-size: 11px;">(A)</span> <span style="font-weight: bold;font-size: 11px;"> -- Total	</span><span style="float: right;margin-right: 10px;font-weight: bold;">Rs.<?php echo $IT+$CGHS+$LF+$CGEGIS+$CPF_TIER_I+$CPF_TIER_II+$HBA_EMI+$MCA_EMI+$CYCLE_EMI+$FAN_EMI+$FLOOD_EMI+$MISC;?></span></p>
		
	</div>
	<div style="width: 33%;min-height: 425px;display: inline-block;float: left;position: relative;">
		<div style="border: 1px solid;height: 425px;position: absolute;width: 73px;right: 5px;top: 0;"></div>
		<p><span style="font-weight: bold;font-size: 11px;">Detailed Heads</span></p>
		<?php $GROSS = Yii::app()->db->createCommand("SELECT SUM(GROSS) as GROSS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['GROSS']; echo $GROSS;?>
		<?php $DA = Yii::app()->db->createCommand("SELECT SUM(DA) as DA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['DA']; echo $DA;?>
		<p style="font-size: 11px;">Salaries <?php if($model->IS_CEA_BILL == 1) echo "<span style='padding-left: 100px;'>CEA</span>"?><span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php echo $GROSS - $DA;?></span></p>
		<p style="font-size: 11px;">Dearness Allowance <span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php echo $DA;?></span></p>
		<p><span style="font-weight: bold;font-size: 11px;">Interim Relief</span><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 60%;">Total :-<span style="float: right;font-style: italic;">Rs.<?php echo $GROSS;?></span></span></p>
		<p><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 60%;">Festival Advance :-  (LESS)<span style="float: right;font-style: italic;">Rs.<?php $FEST_EMI = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) as FEST_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['FEST_EMI']; echo $FEST_EMI;?></span></span></p>
		<p><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 60%;">I. Grand Total :-<span style="float: right;font-style: italic;">Rs.<?php echo $GROSS + $FEST_EMI;?></span></span></p>
		<p style="font-size: 11px;">(a) LESS deductions/recoveries adjustable by Pay <br> and Accounts Officer as per details <span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php echo $IT+$CGHS+$LF+$CGEGIS+$CPF_TIER_I+$CPF_TIER_II+$HBA_EMI+$MCA_EMI+$CYCLE_EMI+$FAN_EMI+$FLOOD_EMI+$MISC;?></span></p><br>
		<p style="font-size: 11px;">(b) LESS deduction/recoveries adjustable by other <br> Accounts Offices        (Salary Advance) <span style="float: right;font-weight: bold;margin-right: 10px;">Rs.0</span></p><br>
		<p style="font-size: 11px;">8658  Suspence Accounts - Pay & Accounts Office  Suspence - Transactions adjustable with :</p>
		<p style="font-size: 11px;">(I) A.G.......................................................................</p>
		<p style="font-size: 11px;">(ii) P.A.O....................................................................</p>
		<p style="font-size: 11px;">(iii).........................................................................</p>
		<p style="font-size: 11px;">(iv)..........................................................................</p>
		<p style="font-size: 11px;">(v)...........................................................................</p>
		<p style="font-size: 11px;">Total          ........                .........               .........      </p>
		<p style="font-size: 11px;">*	(c) DEDUCT - Undisbursed amount(s)     ...................................</p>
		<p style="font-size: 11px;font-weight: bold;">II. Total deductions / recoveries <span style="float: right;font-weight: bold;margin-right: 10px;">Rs.<?php $DED = Yii::app()->db->createCommand("SELECT SUM(DED) as DED FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['DED']; echo $DED;?></span></p>
		<p style="margin-bottom: 20px;"><span style="font-weight: bold;font-size: 11px;"></span><span style="font-size: 13px;float: right;margin-right: 10px;display: inline-block;width: 70%;font-weight: bold;">NET. :-<span style="float: right;font-style: italic;">Rs.<?php $NET = Yii::app()->db->createCommand("SELECT SUM(NET) as NET FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['NET']; echo $NET;?></span></span></p>
		<p style="margin-bottom: 20px;"><span style="font-weight: bold;font-size: 11px;">(i) Cheque in f/o :-</span><span style="font-size: 12px;float: right;margin-right: 10px;display: inline-block;width: 70%;font-weight: bold;">P.T. :-<span style="float: right;font-style: italic;">Rs.<?php $PT = Yii::app()->db->createCommand("SELECT SUM(PT) as PT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['PT']; echo $PT;?></span></span></p>
		<p style="margin-bottom: 20px;"><span style="font-weight: bold;font-size: 11px;"></span><span style="font-size: 12px;float: right;margin-right: 10px;display: inline-block;width: 70%;font-weight: bold;">Credit Society :-<span style="float: right;font-style: italic;">Rs.<?php $CCS = Yii::app()->db->createCommand("SELECT SUM(CCS) as CCS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CCS']; echo $CCS;?></span></span></p>
		<p style="margin-bottom: 20px;"><span style="font-weight: bold;font-size: 11px;"></span><span style="font-size: 12px;float: right;margin-right: 10px;display: inline-block;width: 70%;font-weight: bold;">L.I.C. :-<span style="float: right;font-style: italic;">Rs.<?php $LIC = Yii::app()->db->createCommand("SELECT SUM(LIC) as LIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['LIC']; echo $LIC;?></span></span></p>
		<p style="margin-bottom: 30px;"><span style="font-weight: bold;font-size: 11px;"></span><span style="font-size: 12px;float: right;margin-right: 10px;display: inline-block;width: 70%;font-weight: bold;">Other Deductions - (DDO) :-<span style="float: right;font-style: italic;">Rs.0</span></span></p><br>
		<p><span style="font-weight: bold;font-size: 11px;"></span><span style="font-size: 13px;float: right;margin-right: 10px;display: inline-block;width: 70%;font-weight: bold;">Amt. credit to Bank :-<span style="font-weight: bold;font-size:12px;float: right;">Rs.<?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK;?></span></p>
	</div>
</div>
<p style="text-align: center;font-weight: bold;font-size:11px;"><?php echo $this->amountToWord($AMOUNT_BANK);?></p>
<div style="font-size: 10px;">
	<p>CERTIFIED THAT I HAVE SATISFIED MYSELF THAT --</p>
	<p>(a) the amounts claimed in the Bill are actually due to the persons concerned and the conditions attached to the payment of various allowances have been duly complied with in all cases ;</p>
	<p>(b) the claims have been made against sanctioned posts (details of cases, if any, where claims have been made in anticipatioon of sanction may be mentioned) and, whereever necesssary, snctions of competent autorities 
	have ben obtained as regards grant of increment, crossing of Efficiency Bar, fixation of pay, grant of leave, etc., and that these events have been properly noted in the related Service Books ;</p>
	<p>(c) the particulars of the various deductions/recoveries have been fully noted in the attached schedules and the totals shown in these schedules agree with those given in the bill ;</p>
	<p>(d) all emoluments included in bills drawn 1month/2 months / 3 months previous to this date with the exception of those detailed in the bill have been disbursed to the proper persons and that their acquittances have been taken
	 and filed in my office with receipt stamps duly cancelled  for every payment in excess of Rs.20/- ;</p>
	<p>(e) all persons whose names are omitted from, but whose pay has been drawn in this bill have actually been employed during the month, that full details of emoluments drawn for them working up to the total included in this 
	bill have duly shown in the Pay Bill have been duly shown in the Pay Bill Register and that the emoluments drawn are according to the relevant rules and orders.</p>
</div>
<br>
<div>
	<div style="font-weight: bold; width:400px; float: left;font-size: 10px;"><p><span>Station :</span> Bangalore</p><p><span>Date :</span> <?php echo date('d/m/Y', strtotime($model->CREATION_DATE));?></p></div>
	<div style="font-weight: bold; width:400px; float: right;text-align:center;font-size: 10px;">
		<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
		<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
		<p><?php echo $master['DEPT_NAME']?></p>
	</div>
</div>