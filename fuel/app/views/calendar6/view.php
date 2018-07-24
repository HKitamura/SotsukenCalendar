<h3><strong>登録者</strong></h3>
<p><?php echo $calendar6->name; ?></p>
<h3><strong>予定日</strong></h3>
<p>
	<?php echo $calendar6->year; ?>
	<strong>年</strong>
	<?php echo $calendar6->month; ?>
	<strong>月</strong>
	<?php echo $calendar6->day; ?>
	<strong>日</strong>
</p>
<h3><strong>時間</strong></h3>
<?php if($calendar6->minute != 0):?>
	<p><?php echo $calendar6->hour; ?>：<?php echo $calendar6->minute; ?>～</p>
<?php endif ?>

<?php if($calendar6->minute == 0):?>
	<p><?php echo $calendar6->hour; ?>：<?php echo $calendar6->minute; ?>0～</p>
<?php endif ?>
	<strong>タイトル</strong>
<p><?php echo $calendar6->title; ?></p>

<h3><strong>内容</strong><br></h3>
<p><?php echo nl2br($calendar6->text); ?></p>

<br>

<?php echo Html::anchor('calendar6', '戻る',array('class' => 'btn btn-primary')); ?>