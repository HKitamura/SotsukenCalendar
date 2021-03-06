﻿<?php echo Form::open(array("class"=>"form-horizontal")); ?>
	<p>※年、月、日付は半角で入力してください。</p>
	<p>※時間(時、分)は半角で入力してください。</p>

	<?php 
		if(!isset($_GET['nen']) && !isset($_GET['tuki']) && !isset($_GET['day'])) {
			$siteinen = '';
			$siteituki = '';
			$siteibi = '';
		}
		elseif(isset($_GET['nen']) && isset($_GET['tuki']) && isset($_GET['day'])) {
			$siteinen = $_GET['nen'];
			$siteituki = $_GET['tuki'];
			$siteibi = $_GET['day'];
		}
		$user = Arr::get(Auth::get_user_id(),1);
	?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('名前', 'name', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>
			<div class="form-group1">
					<?php echo Form::input('name', Input::post('name', isset($calendar7) ? $calendar7->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）ほげほげ')); ?>
			</div>
		</div>
		<div class="form-group ymd">
			<?php echo Form::label('年', 'year', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>
			<?php echo Form::input('year', Input::post('year', isset($calendar7) ? $calendar7->year : $siteinen), array('class' => 'col-md-4 form-control','value'=>'$siteinen', 'placeholder'=>'例）2018','autocomplete'=>'organization','maxlength'=>'4')); ?>
		</div>	
		<div class="form-group ymd">
			<?php echo Form::label('月', 'month', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>
			<?php echo Form::input('month', Input::post('month', isset($calendar7) ? $calendar7->month : $siteituki), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）0, 12','maxlength'=>'2')); ?>
		</div>	
		<div class="form-group ymd">
			<?php echo Form::label('日付', 'day', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>
				<?php echo Form::input('day', Input::post('day', isset($calendar7) ? $calendar7->day : $siteibi), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）1, 31','maxlength'=>'2')); ?>
		</div>
		<div class="form-group hm">
			<?php echo Form::label('時', 'hour', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>
			<?php echo Form::input('hour', Input::post('hour', isset($calendar7) ? $calendar7->hour : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）00, 24','maxlength'=>'2')); ?>

		</div>
		<div class="form-group hm">
			<?php echo Form::label('分', 'minute', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>
			<?php echo Form::input('minute', Input::post('minute', isset($calendar7) ? $calendar7->minute : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）00, 59','maxlength'=>'2')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('タイトル', 'title', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>
			<?php echo Form::input('title', Input::post('title', isset($calendar7) ? $calendar7->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）＊＊会議')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('内容', 'text', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>
			<?php echo Form::textarea('text', Input::post('text', isset($calendar7) ? $calendar7->text : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'例）＊＊会議：ふがふが会議室')); ?>
		</div>
		<div class="form-groupuser">
			<?php echo Form::label('user', 'user', array('class'=>'control-label')); ?><div class="frm-required"></div>
			<?php echo Form::input('user', Input::post('user', isset($calendar7) ? $calendar7->user : $user), array('class' => 'col-md-4 form-control')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '登録', array('class' => 'btn btn-primary')); ?>		</div
	</fieldset>
<?php echo Form::close(); ?>