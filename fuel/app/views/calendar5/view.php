
<h3><strong>登録者</strong></h3>
<p><?php echo $calendar5->name; ?></p>
<h3><strong>日時</strong></h3>
<p>
	<?php echo $calendar5->year; ?>
	<strong>年</strong>
	<?php echo $calendar5->month; ?>
	<strong>月</strong>
	<?php echo $calendar5->day; ?>
	<strong>日</strong>
</p>
<h3><strong>時間</strong></h3>
<p><?php echo $calendar5->time; ?></p>
	<strong>タイトル：</strong>
<p><?php echo $calendar5->title; ?></p>

<h3><strong>内容</strong><br></h3>
<p><?php echo nl2br($calendar5->text); ?></p>

<br>

<?php echo Html::anchor('calendar5', '戻る',array('class' => 'btn btn-primary')); ?>