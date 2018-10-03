<h3><strong>登録者</strong></h3>
<p><?php echo $calendar7->name; ?></p>
<h3><strong>予定日</strong></h3>
<p>
	<?php echo $calendar7->year; ?>
	<strong>年</strong>
	<?php echo $calendar7->month; ?>
	<strong>月</strong>
	<?php echo $calendar7->day; ?>
	<strong>日</strong>
</p>
<h3><strong>時間</strong></h3>
<?php if($calendar7->minute != 0):?>
	<p><?php echo $calendar7->hour; ?>：<?php echo $calendar7->minute; ?>～</p>
<?php endif ?>

<?php if($calendar7->minute == 0):?>
	<p><?php echo $calendar7->hour; ?>：<?php echo $calendar7->minute; ?>0～</p>
<?php endif ?>
	<strong>タイトル</strong>
<p><?php echo $calendar7->title; ?></p>

<h3><strong>内容</strong><br></h3>
<p><?php echo nl2br($calendar7->text); ?></p>

<br>

<?php 
	echo Html::anchor('javascript:history.back()', '戻る',array('class' => 'btn btn-primary')); 
	if($calendar7->user == Arr::get(Auth::get_user_id(),1)){
		echo Html::anchor('calendar7/edit/'.$calendar7->id, '<i class="icon-wrench"></i> 編集', array('class' => 'btn btn-primary edit')); 
		echo Html::anchor('calendar7/delete/'.$calendar7->id, '<i class="icon-trash icon-white"></i> 削除', array('class' => 'btn btn-danger danger', 'onclick' => "return confirm('本当に削除してもよろしいですか？')"));
	}
?>