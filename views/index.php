<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.$asset; ?>/css/card.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.$asset; ?>/morris.js/morris.css" />

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.$asset; ?>/js/raphael.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.$asset; ?>/morris.js/morris.min.js"></script>

<div id="<?php echo $model->scriptName; ?>" data-attr-id="<?php echo $model->id; ?>">
	<div class="card-header">
		<span class="title">Posts By Status</span>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
	<div class="card-body">
		<div id="<?php echo $model->id; ?>-chart" class="chart"></div>
	</div>
</div>
