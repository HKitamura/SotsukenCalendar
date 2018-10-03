<?php echo render('calendar7/_form'); ?>
<p>
	<?php echo Html::anchor('javascript:history.back()', '戻る',array('class' => 'btn btn-primary')); ?>
	<?php echo Html::anchor('calendar7/view/'.$calendar7->id, '詳細',array('class' => 'btn btn-primary')); ?>
</p>