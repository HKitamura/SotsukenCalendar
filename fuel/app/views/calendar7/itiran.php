<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
    var pageTop = $('.page-top');
    pageTop.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            pageTop.fadeIn();
        } else {
            pageTop.fadeOut();
        }
    });
    pageTop.click(function () {
        $('body, html').animate({scrollTop:0}, 500, 'swing');
        return false;
    });
});
</script>
</head>

<?php echo Form::open(array("class"=>"form-horizontal")); ?>
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
	<?php 
		echo "<div class='itiran'>";//全画面、大きい画面幅での表示
			echo "<h2> $siteinen/$siteituki/$siteibi の予定一覧</span></h2>";
			if ($calendar7s){
				echo"<table class='table-striped aiu' id='calyotei'>";
					echo"<thead>";
						echo"<tr>";
							echo"<th>名前</th>";
							echo"<th>予定日</th>";
							echo"<th>時間</th>";
							echo"<th>タイトル</th>";
							echo"<th>内容</th>";
							echo"<th>&nbsp;</th>";
						echo"</tr>";
					echo"</thead>";

					echo"<tbody>";
						foreach ($calendar7s as $item){
							if($item->year == $siteinen){		
								if($item->month == $siteituki){
									if($item->day == $siteibi){
										echo"<tr class='calyoteitr'>";
											echo"<td class='calyoteitd'>";echo Str::truncate($item->name ,5,'', true);echo"</td>";
											echo"<td class='tdyear'>";

												if($item->month < 10 ){echo"0$item->month /";}
												elseif($item->month > 9 ){echo"$item->month /";}

											if($item->day < 10 ){echo"0$item->day</td>";}
											elseif($item->day > 9 ){echo"$item->day</td>";}

											echo"<td class='hour'>";
												//時間(時)の表示設定
												if($item->hour < 10 ){//1～9なら□1～□9にする
													echo'&nbsp';
													echo'&nbsp';
													echo"$item->hour : ";
												}
												elseif($item->hour > 9){echo"$item->hour : ";}
												//時間(分)の表示設定
												if($item->minute < 10 ){echo"0$item->minute";echo" ～";echo"</td>";}//0～9なら00～09にする
												elseif($item->minute != 0){echo"$item->minute ～</td>";}
												//elseif($item->minute == 0){echo"$item->minute";echo"0 ～";echo"</td>";}

											echo"<td class='calyoteitd'>";echo Str::truncate($item->title,8,'', true); echo"</td>";
											echo"<td class='calyoteitd'>";echo Str::truncate($item->text,8,'', true); echo"</td>";
											echo"<td class='calyoteitd'>";
												echo"<div class='btn-toolbar'>";
													echo"<div class='btn-group'>";
														echo Html::anchor('calendar7/view/'.$item->id, '<i class="icon-eye-open"></i> 詳細', array('class' => 'btn btn-default btn-sm'));
														if($item->user == Arr::get(Auth::get_user_id(),1)){
															echo Html::anchor('calendar7/edit/'.$item->id, '<i class="icon-wrench"></i> 編集', array('class' => 'btn btn-default btn-sm')); 
															echo Html::anchor('calendar7/delete/'.$item->id, '<i class="icon-trash icon-white"></i> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('本当に削除してもよろしいですか？')"));
														}
													echo"</div>";//<div class='btn-toolbar'>
												echo"</div>";	 //<div class='btn-group'>
											echo"</td>";		 //<td class='calyoteitd'>
										echo"</tr>";			 //<tr class='calyoteitr'>
									}
								}	//($item->month == $month)
							}		//($item->year == $year)
						}			//foreach ($calendar7s as $item)
					echo"</tbody>";	//<tbody>
				echo"</table>";		//<table class='table-striped aiu' id='calyotei'>
			}//if ($calendar7s)
			else{
				echo "<p>予定はありません</p>";
			}
		echo "</div>";//<div class='itiran'>
		echo "<div class='syoitiran'>";//画面幅が小さい時の表示
			echo "<h2> $siteinen/$siteituki/$siteibi の予定一覧</span></h2>";
			if ($calendar7s){
				echo"<table class='table-striped aiu' id='calyotei'>";
					echo"<thead>";
						echo"<tr>";
							echo"<th>名前</th>";
							echo"<th>予定日</th>";
							echo"<th class='time'>時間</th>";
							echo"<th>タイトル</th>";
							echo"<th>&nbsp;</th>";
						echo"</tr>";
					echo"</thead>";

					echo"<tbody>";
						foreach ($calendar7s as $item){
							if($item->year == $siteinen){		
								if($item->month == $siteituki){		
										if($item->day == $siteibi){		
										echo"<tr class='calyoteitr'>";
											echo"<td class='calyoteitd'>";echo Str::truncate($item->name ,5,'', true);echo"</td>";
											echo"<td class='tdyear'>";
												if($item->month < 10 ){echo"0$item->month /";}
												elseif($item->month > 9 ){echo"$item->month /";}

											if($item->day < 10 ){echo"0$item->day</td>";}
											elseif($item->day > 9 ){echo"$item->day</td>";}

											echo"<td class='hour'>";
												//時間(時)の表示設定
												if($item->hour < 10 ){//1～9なら□1～□9にする
													echo'&nbsp';
													echo'&nbsp';
													echo"$item->hour : ";
												}
												elseif($item->hour > 9){echo"$item->hour : ";}
												//時間(分)の表示設定
												if($item->minute < 10 ){echo"0$item->minute";echo" ～";echo"</td>";}//0～9なら00～09にする
												elseif($item->minute != 0){echo"$item->minute ～</td>";}
												//elseif($item->minute == 0){echo"$item->minute";echo"0 ～";echo"</td>";}

											echo"<td class='calyoteitd'>";echo Str::truncate($item->title,8,'', true); echo"</td>";
											echo"<td class='calyoteitd'>";
												echo"<div class='btn-toolbar'>";
													echo"<div class='btn-group'>";
														echo Html::anchor('calendar7/view/'.$item->id, '<i class="icon-eye-open"></i> 詳細', array('class' => 'btn btn-default btn-sm'));
														if($item->user == Arr::get(Auth::get_user_id(),1)){
															echo Html::anchor('calendar7/edit/'.$item->id, '<i class="icon-wrench"></i> 編集', array('class' => 'btn btn-default btn-sm')); 
															echo Html::anchor('calendar7/delete/'.$item->id, '<i class="icon-trash icon-white"></i> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('本当に削除してもよろしいですか？')"));
														}
													echo"</div>";//<div class='btn-toolbar'>
												echo"</div>";	 //<div class='btn-group'>
											echo"</td>";		 //<td class='calyoteitd'>
										echo"</tr>";			 //<tr class='calyoteitr'>
									}
								}	//($item->month == $month)
							}		//($item->year == $year)
						}			//foreach ($calendar7s as $item)
					echo"</tbody>";	//<tbody>(641)
				echo"</table>";		//<table class='table-striped aiu' id='calyotei'>
			}//if ($calendar7s)
			else{
				echo "<p>予定はありません</p>";
			}
		echo "</div>";//<div class='syoitiran'>
		echo "<br>";
		//トップへのスクロールボタン
		echo "<a href='#' class='page-top'>TOPへ戻る<i class='fa fa-arrow-circle-up' aria-hidden='true'></i></a>";
	?>
<p><?php echo Html::anchor('javascript:history.back()', '戻る',array('class' => 'btn btn-primary'));?></p>

<?php echo Form::close(); ?>