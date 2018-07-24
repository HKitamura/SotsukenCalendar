<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('名前', 'name', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>
		<div class="form-group1">

				<?php echo Form::input('name', Input::post('name', isset($calendar4) ? $calendar4->name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）ほげほげ')); ?>
		</div>
		</div>
		<div class="form-group ymd">
			<?php echo Form::label('年', 'year', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>

				<?php echo Form::input('year', Input::post('year', isset($calendar4) ? $calendar4->year : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）＊＊＊＊')); ?>
		</div>	
		<div class="form-group ymd">
			<?php echo Form::label('月', 'month', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>

				<?php echo Form::input('month', Input::post('month', isset($calendar4) ? $calendar4->month : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）＊＊')); ?>
		</div>	
		<div class="form-group ymd">
			<?php echo Form::label('日', 'day', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>

				<?php echo Form::input('day', Input::post('day', isset($calendar4) ? $calendar4->day : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）＊＊')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('時間', 'time', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>

				<?php echo Form::input('time', Input::post('time', isset($calendar4) ? $calendar4->time : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）＊＊：＊＊～')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('タイトル', 'title', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>

				<?php echo Form::input('title', Input::post('title', isset($calendar4) ? $calendar4->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'例）＊＊会議')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('内容', 'text', array('class'=>'control-label')); ?><div class="frm-required">※必須</div>

				<?php echo Form::textarea('text', Input::post('text', isset($calendar4) ? $calendar4->text : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'例）＊＊会議：ふがふが会議室')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', '登録', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>