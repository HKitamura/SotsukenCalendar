<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<?php echo Asset::css('main.css'); ?>
	<?php echo Asset::js('main.js'); ?>


</head>
<body>
<div class="row">
	<h1 class="title">スケジュール管理システム</h1>
	<h2 class="title">ログイン</h2>

	<?php echo Form::open(array('class' => 'form-horizontal'));?>

	<?php if (isset($error)): ?>
		<p class="alert alert-warning"><?php echo $error ?></p>
	<?php endif ?>


	<div class="form-group">
		<label for="form_name" class="col-sm-6 control-label">ユーザー名</label>
	<div class="col-sm-6">
		<?php echo Form::input('username');?>
	</div>
	</div>

	<div class="form-group">
		<label for="form_name" class="col-sm-6 control-label">パスワード</label>
		<div class="col-sm-6">
			<?php echo Form::password('password');?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-12 col-sm-12">
			<?php echo Form::submit('submit', 'ログイン', array('class' => 'btn btn-default btn-lg btn-success'));?>
		</div>
	</div>

	<?php echo Form::close();?>

</div>
</body>
</html>
