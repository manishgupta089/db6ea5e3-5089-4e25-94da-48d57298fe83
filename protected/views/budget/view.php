<?php
/* @var $this BudgetController */
/* @var $model Budget */

$this->breadcrumbs=array(
	'Budgets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Budget', 'url'=>array('index')),
	array('label'=>'Create Budget', 'url'=>array('create')),
	array('label'=>'Update Budget', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Budget', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Budget', 'url'=>array('admin')),
);
?>

<h1>View Budget #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'HEAD',
		'AMOUNT',
		'YEAR',
	),
)); ?>
