<?php echo render('calendar6/_form'); ?>
<p>
	<?php echo Html::anchor('calendar6/view/'.$calendar6->id, '詳細',array('class' => 'btn btn-primary')); ?>
	<?php echo Html::anchor('calendar6', '戻る',array('class' => 'btn btn-primary')); ?>
	<?php echo Html::anchor('calendar6/delete/'.$calendar6->id, '<i class="icon-trash icon-white"></i> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('本当に削除してもよろしいですか？')")); ?></p>
