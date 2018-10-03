<head>
<title>カレンダー</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
    var pageTop = $('.page-top');
    pageTop.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 130) {
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
<body>
	<?php 
		if(!isset($_GET['nen']) && !isset($_GET['tuki'])) {
			$siteinen = date('Y');
			$siteituki = date('n');
		}
		elseif(isset($_GET['nen']) && isset($_GET['tuki'])) {
			$siteinen = $_GET['nen'];
			$siteituki = $_GET['tuki'];
			if($siteinen > 2050 || $siteinen < 2000){$siteinen = date('Y');}
			if($siteituki > 12 || $siteituki < 0){$siteituki = date('n');}
			if($siteinen == 2050 && $siteituki == 12){$siteinen = date('Y');$siteituki = date('n');}
		}
	?>
<?php
	//年月の指定があれば
	if(isset($_POST['yyyy']) && $_POST['yyyy'] != '' && isset($_POST['mm']) && $_POST['mm'] != ''){
		$yyyy = $_POST['yyyy'];
		$mm =   $_POST['mm'];
		//指定がなければ本日の年月
	}else{
		$yyyy = date('Y');
		$mm = $siteituki;
	}
	$dd = 1;
?>
	<div class="col-md-6 calendar">
		<!-- テーブルの作成 -->
		<TABLE BORDER>
			<tr class="youbi" align="center">
				<td class="youbi-sun"><font color="red">日</font></td>
				<td>月</td>
				<td>火</td>
				<td>水</td>
				<td>木</td>
				<td>金</td>
				<td class="youbi-sat"><font color="blue">土</font></td>
			</tr>
			<?php
				//年月の指定があれば
				if(isset($_POST['yyyy']) && $_POST['yyyy'] != '' && isset($_POST['mm']) && $_POST['mm'] != ''){
					$year = $_POST['yyyy'];
					$month = $_POST['mm'];
				//指定がなければ本日の年月
				}else{
					$year = date('Y');
					$month =  $siteituki+1;
					if($month > 12){
						$year = $siteinen+1;
						$siteituki = 1;
						$mm = $siteituki;
						$yyyy = $siteinen+1;
						$month =  $siteituki;
					}
					else{
						$year = $siteinen;
						$yyyy = $siteinen;
						$mm = $siteituki+1;
						$month = $month;
					}
				}
				$dd = 1;
				calendar($year, $month);//カレンダー用の関数の呼び出し
			?>
			<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="select">
					<select name="yyyy">
						<?php
							for($i = 2000; $i <= 2050; $i++){
						    	 echo '<option value="'.$i.'"'; if($i == $yyyy) echo ' selected'; echo '>'.$i.'</option>'."\n";
							}
						?>
					</select>年
					<select name="mm">
						<?php
							for($i = 1; $i <= 12; $i++){
							    echo '<option value="'.$i.'"'; if($i == $mm) echo 'selected'; echo '>'.$i.'</option>'."\n";
							}
						?>
					</select>月
					<input type="submit" value="移動">
				</div>
			</form>
		</table>
	</div>
<div class="col-md-6">
	<?php
		function calendar($year, $month) {
			$data['calendar7s'] = Model_calendar7::find('all', array(
												    'order_by' => array('Day' => 'asc',
																		'Hour' => 'asc',
																		'Minute' => 'asc',
																		'Name' => 'asc',
																		),
													));
			$nowyear = date('Y');
			$nowmonth = date('n');
			$nowtoday;
			$sengetulast = date('t', mktime(0,0,0,$month,0,$year));//先月の最終日の曜日確認
			$wtop = date("w", mktime(0,0,0,$month,1,$year));//月の初めの曜日の確認
			//echo $wtop;
			$today = date("j");

			$caldate = time();
			$month = $month;

			echo "<div class='honzitu'>";
				echo "今日の日付 : ";
				echo "<a href='/calendar7'>";
				echo $nowyear;
				echo "/";
				echo $nowmonth;
				echo "/";
				echo $today;
			echo "</div></a>";
			echo "<h1><div class='siteibi'>";
				if($year >= 2000 && $month > 0){
					if($year == 2000){
						if($month == 1){
						}
						else{
							echo "<a href='/calendar7/previous?nen=$year&tuki=$month' class='siteibi2'><<</a>";
						}
					}
					else{
						echo "<a href='/calendar7/previous?nen=$year&tuki=$month' class='siteibi2'><<</a>";
					}
				}
				echo $year;
				echo "/";
				echo $month;
				if($year < 2051 && $month < 13){
					if($year == 2050){
						if($month == 12){
						}
						else{
							echo "<a href='/calendar7/next?nen=$year&tuki=$month' class='siteibi3'>>></a>";
						}
					}
					else{
						echo "<a href='/calendar7/next?nen=$year&tuki=$month' class='siteibi3'>>></a>";
					}
				}
			echo "</h1></div>";

		//echo "<td><font color=\"green\">$today</td>";
	//先月********************************************************************
			if($wtop>0){
		 		for($i=0,$count=0;$i<$wtop;$i++){						//先月の最終週で表示できる数確認
					$count++;
				}
				$count -= 1;											//for文で最後に追加されたぶんを引く
				$sengetulast = date('t', mktime(0,0,0,$month,0,$year)); //先月の最終日確認(実際は日数が出ているが...)
				$sengetulast = $sengetulast - $count;					//先月の最終日から$countのぶん日数を戻して回すといい感じに日数が出る
				$sengetu = $month - 1;									//今月から1を引き、先月の値を入れる
				if($sengetu == 0){										//今月が1月だった場合、去年の12月に戻す
					$sengetu = 12;
				} 
		 		for($i=0;$i<$wtop;$i++,$sengetulast++){//先月の日付、予定を追加
					if($i==0){//日曜日
						//日曜日は先頭になるため月も表示
						echo "<td class='sun'><div id='sengetu'><a href='/calendar7/create?nen=$year&tuki=$sengetu&day=$sengetulast'>$sengetu/$sengetulast</a></div>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){//予定の表示
							if($item->year == $year){		
								if($item->month == $sengetu){	
									if($item->day == $sengetulast){	
										if($kensu < 4){
											echo "<div class='sengetuyotei'>";
												//タイトルの先頭5文字を表示
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true) );
												$kensu++;
											echo"</div>";
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//if($item->day == $sengetulast)
								}//($item->month == $sengetu)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
					}//if($i==0)
					elseif($i==7){//土曜日
						echo "<td class='sat'><div id='sengetu'><a href='/calendar7/create?nen=$year&tuki=$sengetu&day=$sengetulast'>$sengetulast</a></div>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){//予定の表示
							if($item->year == $year){		
								if($item->month == $sengetu){	
									if($item->day == $sengetulast){	
										if($kensu < 4){
											echo "<div class='sengetuyotei'>";
												//タイトルの先頭5文字を表示
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true) );
												$kensu++;
											echo"</div>";
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//if($item->day == $sengetulast)
								}//($item->month == $sengetu)
							}//($item->year == $year)
						}//foreach
						echo"</div></td>";
					}//elseif($i==7)
					else{//平日
						echo "<td class='font-day'><div id='sengetu'><a href='/calendar7/create?nen=$year&tuki=$sengetu&day=$sengetulast'>$sengetulast</a></div>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){//予定の表示
							if($item->year == $year){		
								if($item->month == $sengetu){	
									if($item->day == $sengetulast){	
										if($kensu < 4){
											echo "<div class='sengetuyotei'>";
											//タイトルの先頭5文字を表示
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true) );
												$kensu++;
											echo"</div>";
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//if($item->day == $sengetulast)
								}//($item->month == $sengetu)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
					}//else
				}//for($i=0;$i<$wtop;$i++,$sengetulast++)
			}//if($wtop>0)

		//今月********************************************************************

			//月の日数の確認
			$dend = date("t",mktime(0,0,0,$month,1,$year));
			//echo $dend;

			//曜日の始めを代入
			//$w;現在の曜日
			$w = $wtop;

			$kensu = 0;

			for($i=1;$i<=$dend;$i++){ //今月1日から最終日までの日付、予定表示
				if($i == 1){//月の最初なら
					if($i == $today){//iが今日なら
						if($month==$nowmonth){//表示している月が今月なら
							//月も表示する
							//日曜日
							if($w == 0){echo "<td class='sun'><font color=\"red\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$month/$i<br>";}
							//土曜日
							if($w == 6){echo "<td class='sat'><font color=\"blue\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$month/$i<br>";}
							//平日
							else{echo "<td class='today'><font color=\"green\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$month/$i<br>";}
							echo"<br>";
							$kensu = 0;
							foreach ($data['calendar7s'] as $item){//予定の表示
								if($item->year == $year){		
									if($item->month == $month){	
										if($item->day == $i){
											if($kensu < 4){	
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
												$kensu++;
												echo"<br>";
											}
											else{
												echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
												break;
											}
										}//($item->day == $i)
									}//($item->month == $month)
								}//($item->year == $year)
							}//foreach
							echo"</td>";
						}//($month==$nowmonth)
						else{
							if($w == 0){echo "<td class='sun'><font color=\"red\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$month/$i<br>";}
							else if($w == 6){echo "<td class='sat'><font color=\"blue\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$month/$i<br>";}
							else if($w != 0 || $w != 6 || $i == 1){	echo "<td class='font-day'><font color=\"blue\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$month/$i<br>";}
							echo"<br>";
							$kensu = 0;
							foreach ($data['calendar7s'] as $item){//予定の表示
								if($item->year == $year){		
									if($item->month == $month){	
										if($item->day == $i){	
											if($kensu < 4){	
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
												$kensu++;
												echo"<br>";
											}
											else{
												echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
												break;
											}
										}//($item->day == $i)
									}//($item->month == $month)
								}//($item->year == $year)
							}//foreach
							echo"</td>";
						}//else
					}//($i == $today)
					else if($w == 0){//日曜日
						echo "</tr><tr>";//改行
						echo "<td class='sun'><font color=\"red\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$month/$i<br>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){//予定の表示
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $i){
										if($kensu < 4){
											echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
											$kensu++;
											echo"<br>";
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//($item->day == $i)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
					
					}else if($w == 6){//土曜日
						echo "<td class='sat'><font color=\"blue\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$month/$i<br>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $i){	
										if($kensu < 4){
											echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
											$kensu++;
											echo"<br>";
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//($item->day == $i)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
					}else{//平日
						echo"<td class='font-day'><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$month/$i<br>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $i){	
										if($kensu < 4){
											echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
											$kensu++;
											echo"<br>";
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//($item->day == $i)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
					}
					//次の曜日にする
						$w++;
						$w %=7;//日曜になったらリセットする
				}//($i == 1)
				else{		
					if($i == $today){	
						if($month==$nowmonth){
							if($year==$nowyear){
								echo "<td class='today'><font color=\"green\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$i<br>";
								$kensu = 0;
								foreach ($data['calendar7s'] as $item){
									if($item->year == $year){		
										if($item->month == $month){	
											if($item->day == $i){	
												if($kensu < 4){
													echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
													$kensu++;
													echo"<br>";
												}
												else{
													echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
													break;
												}
											}//($item->day == $i)
										}//($item->month == $month)
									}//($item->year == $year)
								}//foreach
								echo"</td>";
							}//($year==$nowyear)
							else{
								if($w == 0){//日曜日
									echo "</tr><tr>";//改行
									echo "<td class='sun'><font color=\"red\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$i<br>";
									$kensu = 0;
									foreach ($data['calendar7s'] as $item){
										if($item->year == $year){		
											if($item->month == $month){	
												if($item->day == $i){	
													if($kensu < 4){
														echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
														$kensu++;
														echo"<br>";
													}
													else{
														echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
														break;
													}
												}//($item->day == $i)
											}//($item->month == $month)
										}//($item->year == $year)
									}//foreach
									echo"</td>";
								}//($w == 0)
								else if($w == 6){//土曜日
									echo "<td class='sat'><font color=\"blue\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$i<br>";
									$kensu = 0;
									foreach ($data['calendar7s'] as $item){
										if($item->year == $year){		
											if($item->month == $month){	
												if($item->day == $i){	
													if($kensu < 4){
														echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
														$kensu++;
														echo"<br>";
													}
													else{
														echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
														break;
													}
												}//($item->day == $i)
											}//($item->month == $month)
										}//($item->year == $year)
									}//foreach
									echo"</td>";
								}//else if($w == 6)
								else{//平日
									echo"<td class='font-day'><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$i<br>";
									$kensu = 0;
									foreach ($data['calendar7s'] as $item){
										if($item->year == $year){		
											if($item->month == $month){	
												if($item->day == $i){	
													if($kensu < 4){
														echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
														$kensu++;
														echo"<br>";
													}
													else{
														echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
														break;
													}
												}//($item->day == $i)
											}//($item->month == $month)
										}//($item->year == $year)
									}//foreach
									echo"</td>";
								}//else(平日)
							}//else
						}//($month==$nowmonth)
						else{
							if($w == 0){//日曜日
								echo "</tr><tr>";//改行
								echo "<td class='sun'><font color=\"red\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$i</td><br>";
								$kensu = 0;
								foreach ($data['calendar7s'] as $item){
									if($item->year == $year){		
										if($item->month == $month){	
											if($item->day == $i){	
												if($kensu < 4){
													echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
													$kensu++;
													echo"<br>";
												}
												else{
													echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
													break;
												}
											}//($item->day == $i)
										}//($item->month == $month)
									}//($item->year == $year)
								}//foreach
							echo"</td>";
							}//($w == 0)
							else if($w == 6){//土曜日
								echo "<td class='sat'><font color=\"blue\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$i</td>";
								$kensu = 0;
								foreach ($data['calendar7s'] as $item){
									if($item->year == $year){		
										if($item->month == $month){	
											if($item->day == $i){	
												if($kensu < 4){
													echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
													$kensu++;
													echo"<br>";
												}
												else{
													echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
													break;
												}
											}//($item->day == $i)
										}//($item->month == $month)
									}//($item->year == $year)
								}//foreach
								echo"</td>";
							}//else if($w == 6)
							else{//平日
								echo"<td class='font-day'><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$i";
								echo"<br>";
								$kensu = 0;
								foreach ($data['calendar7s'] as $item){
									if($item->year == $year){		
										if($item->month == $month){	
											if($item->day == $i){	
												if($kensu < 4){
													echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
													$kensu++;
													echo"<br>";
												}
												else{
													echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
													break;
												}
											}//($item->day == $i)
										}//($item->month == $month)
									}//($item->year == $year)
								}//foreach
								echo"</td>";
							}//else
						}//else
					}//if($i == $today)
					else if($w == 0){//日曜日
						echo "</tr><tr>";//改行
						echo "<td class='sun'><font color=\"red\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$i";
						echo"<br>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $i){	
										if($kensu < 4){
											echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
											$kensu++;
											echo"<br>";
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//($item->day == $i)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
					}//	else if($w == 0)
					else if($w == 6){//土曜日
						echo "<td class='sat'><font color=\"blue\"><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$i";
						echo"<br>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $i){	
										if($kensu < 4){
											echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
											$kensu++;
											echo"<br>";
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//($item->day == $i)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
					}//else if($w == 6)
					else{//平日
						echo"<td class='font-day'><a href='/calendar7/create?nen=$year&tuki=$month&day=$i'>$i";
						echo"<br>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $i){	
										if($kensu < 4){
											echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true));
											$kensu++;
											echo"<br>";
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//($item->day == $i)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
					}//else
					//次の曜日にする
					$w++;
					$w %= 7;//日曜日になったらリセットする
				}//else
			}//for($i=1;$i<=$dend;$i++)

			//最終日の次の日が日曜日なら終了
			if($w == 0)return;

		//来月********************************************************************

			//残りのマスを空白でうめる
			for($i=$w,$month = $month + 1,$x = 1;$i<7;$i++){				//来月の最終週で表示できる数確認
				if($month == 13){											//今月が12月だった場合、来年の1月に進める
					$month = 1;
				}
				if($x == 1){//1日の場合
					if($i==-1){//日曜日
						echo "<td class='sun'><div id='raigetu'><a href='/calendar7/create?nen=$year&tuki=$month&day=$x'>$month/$x</div>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $x){
										if($kensu < 4){
											echo "<div class='raigetuyotei'>";
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true) );
											echo"</div>";
											$kensu++;
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//($item->day == $x)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
						$x++;
					}//($i==-1)
					elseif($i==6){//土曜日
						echo "<td class='sat'><div id='raigetu'><a href='/calendar7/create?nen=$year&tuki=$month&day=$x'>$month/$x</div>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $x){	
										if($kensu < 4){
											echo "<div class='raigetuyotei'>";
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true) );
											echo"</div>";
											$kensu++;
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$i'>一覧へ…";
											break;
										}
									}//($item->day == $x)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
						$x++;
					}//($i==6)
					else{//平日
						echo "<td class='font-day'><div id='raigetu'><a href='/calendar7/create?nen=$year&tuki=$month&day=$x'>$month/$x</div>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $x){	
										if($kensu < 4){
											echo "<div class='raigetuyotei'>";
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true) );
											echo"</div>";
											$kensu++;
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$x'>一覧へ…";
											break;
										}
									}//($item->day == $x)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
						$x++;
					}//else
				}//if($x == 1)
				else{
					if($i==-1){//日曜日
						echo "<td class='sun'><a href='/calendar7/create?nen=$year&tuki=$month&day=$x'>$x</div>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $x){	
										if($kensu < 4){
											echo "<div class='raigetuyotei'>";
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true) );
											echo"</div>";
											$kensu++;
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$x'>一覧へ…";
											break;
										}
									}//($item->day == $x)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
						$x++;
					}//if($i==-1)
					elseif($i==6){
						echo "<td class='sat'><div id='raigetu'><a href='/calendar7/create?nen=$year&tuki=$month&day=$x'>$x</div>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $x){	
										if($kensu < 4){
											echo "<div class='raigetuyotei'>";
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true) );
											echo"</div>";
											$kensu++;
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$x'>一覧へ…";
											break;
										}
									}//($item->day == $x)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
						$x++;
					}//if($i==6)
					else{
						echo "<td class='font-day'><div id='raigetu'><a href='/calendar7/create?nen=$year&tuki=$month&day=$x'>$x</div>";
						$kensu = 0;
						foreach ($data['calendar7s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $x){	
										if($kensu < 4){
											echo "<div class='raigetuyotei'>";
												echo Html::anchor('calendar7/view/'.$item->id, Str::truncate($item->title,5,'', true) );
											echo"</div>";
											$kensu++;
										}
										else{
											echo "<a href='/calendar7/itiran?nen=$year&tuki=$month&day=$x'>一覧へ…";
											break;
										}
									}//($item->day == $x)
								}//($item->month == $month)
							}//($item->year == $year)
						}//foreach
						echo"</td>";
						$x++;
					}//else
				}//else
			}//for($i=$w,$month = $month + 1,$x = 1;$i<7;$i++)
		}//function calendar($year, $month)

		echo "<div class='itiran'>";//全画面、大きい画面幅での表示
			echo "<h2>予定一覧</span></h2>";
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
							if($item->year == $year){		
								if($item->month == $month){		
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
								}	//($item->month == $month)
							}		//($item->year == $year)
						}			//foreach ($calendar7s as $item)
					echo"</tbody>";	//<tbody>
				echo"</table>";		//<table class='table-striped aiu' id='calyotei'>(561)
			}//if ($calendar7s)
			else{
				echo "<p>予定はありません</p>";
			}
		echo "</div>";//<div class='itiran'>
		echo "<br>";


		echo "<div class='syoitiran'>";//画面幅が小さい時の表示
			echo "<h2>予定一覧</span></h2>";
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
							if($item->year == $year){		
								if($item->month == $month){		
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
								}	//($item->month == $month)
							}		//($item->year == $year)
						}			//foreach ($calendar7s as $item)
					echo"</tbody>";	//<tbody>
				echo"</table>";		//<table class='table-striped aiu' id='calyotei'>(630)
			}//if ($calendar7s)
			else{
				echo "<p>予定はありません</p>";
			}
		echo "</div>";//<div class='syoitiran'>
		echo "<br>";
		//トップへのスクロールボタン
		echo "<a href='#' class='page-top'>TOPへ戻る<i class='fa fa-arrow-circle-up' aria-hidden='true'></i></a>";
	?>
</body>
</html>
