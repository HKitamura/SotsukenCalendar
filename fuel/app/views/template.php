<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<?php echo Asset::js('main.js'); ?>
	<?php echo Asset::css('main.css'); ?>
	<style>
		body { margin: 10px; }
	</style>
	<script type="text/javascript">
		$(function(){
			$('#mobile-menu').on('click', function(){
				$('.navbar-nav').slideToggle()
			});
		});
	</script>

</head>
<body>
<?php
	$flg = 0;
?>
		<div class="col-md-12">
			<h1><?php echo $title; ?></h1>
				<button class="menu-btn" id="mobile-menu"></button>
				<ul class="nav navbar-nav">
					<li><a href="/calendar7">ホーム</a></li>
					<li><a href="/calendar7/create?nen&tuki&day">予定登録</a></li>
					<li><a href="/logout">ログアウト</a></li>
				</ul>
				<div class="clear-element"></div>
			<?php if (Session::get_flash('success')): ?>
			<div class="alert alert-success">
				<strong>Success</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
				</p>
			</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
			<div class="alert alert-danger">
				<strong>Error</strong>
				<p>
				<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
				</p>
			</div>
<?php endif; ?>	
		</div>
		<div class="col-md-12">
			<?php echo $content; ?>
		</div>
		<footer>
		</footer>

</body>
</html>
