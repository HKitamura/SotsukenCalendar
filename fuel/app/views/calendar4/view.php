
<h3><strong>登録者</strong></h3>
<p><?php echo $calendar4->name; ?></p>
<h3><strong>日時</strong></h3>
<p>
	<?php echo $calendar4->year; ?>
	<strong>年</strong>
	<?php echo $calendar4->month; ?>
	<strong>月</strong>
	<?php echo $calendar4->day; ?>
	<strong>日</strong>
</p>
<h3><strong>時間</strong></h3>
<p><?php echo $calendar4->time; ?></p>
	<strong>タイトル：</strong>
<p><?php echo $calendar4->title; ?></p>

<h3><strong>内容</strong><br></h3>
<p><?php echo nl2br($calendar4->text); ?></p>

<br>

<?php echo Html::anchor('calendar4/edit/'.$calendar4->id, '編集',array('class' => 'btn btn-primary')); ?>　
<?php echo Html::anchor('calendar4', '戻る',array('class' => 'btn btn-primary')); ?>