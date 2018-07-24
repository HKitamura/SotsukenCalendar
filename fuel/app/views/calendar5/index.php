<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>カレンダー</title>
</head>
<body>
<br>
<?php
//年月の指定があれば
	if(isset($_POST['yyyy']) && $_POST['yyyy'] != '' && isset($_POST['mm']) && $_POST['mm'] != ''){
	    $yyyy = $_POST['yyyy'];
	    $mm =   $_POST['mm'];
	//指定がなければ本日の年月
	}else{
	    $yyyy = date('Y');
	    $mm =   date('m');
	}
	$dd = 1;
	?>

	<!-- テーブルの作成 -->
	<TABLE BORDER>
		<tr align="center">
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
	    $month =   $_POST['mm'];
	//指定がなければ本日の年月
	}else{
	    $year = date('Y');
	    $month =  date('n');
	}
	$dd = 1;
		calendar($year, $month);//カレンダー用の関数の呼び出し
		?>
	</tr>
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
	    echo '<option value="'.$i.'"'; if($i == $mm) echo ' selected'; echo '>'.$i.'</option>'."\n";
	}
	?>
	</select>月
	<input type="submit" value="移動">
	<br>
	<br>

</div>
</table>
</body>
</html>

<?php
function calendar($year, $month) {
	$data['calendar5s'] = Model_calendar5::find('all', array(
												'order_by' => array('Day' => 'asc'),
												));

	$nowyear = date('Y');
	$nowmonth = date('n');
	$nowtoday;
	$sengetulast = date('t', mktime(0,0,0,$month,0,$year));
	$wtop = date("w", mktime(0,0,0,$month,1,$year));//月の初めの曜日の確認
	//echo $wtop;
	$today = date("j");

	$caldate = time();
	if (isset($_POST['before'])) { $month = $month-1; } 
	if (isset($_POST['next'])) { $month = $month+1; }
	$month = $month;

	echo "<div class='honzitu'>";
		echo "今日の日付 : ";
		echo "<a href='/calendar5'>";
		echo $nowyear;
		echo "/";
		echo $nowmonth;
		echo "/";
		echo $today;
	echo "</div></a>";
	echo "<h1><div class='siteibi'>";
		echo $year;
		echo "/";
		echo $month;
	echo "</h1></div>";

	//echo "<td><font color=\"green\">$today</td>";


//先月********************************************************************
	if($wtop>0){
 		for($i=0,$count=0;$i<$wtop;$i++){
			$count++;
		}
		$count -= 1;
	}
	if($wtop>0){
		$sengetulast = date('t', mktime(0,0,0,$month,0,$year));
		$sengetulast = $sengetulast - $count;
		$sengetu = $month - 1;
		if($sengetu == 0){
			$sengetu = 12;
		} 
 		for($i=0;$i<$wtop;$i++,$sengetulast++){
			if($i==0){
				echo "<td class='sun'><div id='sengetu'>$sengetu/$sengetulast</div>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $sengetu){	
							if($item->day == $sengetulast){	
							echo "<div class='sengetuyotei'>";
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true) );
							echo"</div><br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
			}
			elseif($i==7){
				echo "<td class='sat'><div id='sengetu'>$sengetulast</div>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $sengetu){	
							if($item->day == $sengetulast){	
							echo "<div class='sengetuyotei'>";
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true) );
							echo"</div><br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</div></td>";
			}
			else{
				echo "<td class='font-day'><div id='sengetu'>$sengetulast</div>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $sengetu){	
							if($item->day == $sengetulast){	
							echo "<div class='sengetuyotei'>";
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true) );
							echo"</div><br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
			}
		}
	}

//今月********************************************************************

	//月の日数の確認
	$dend = date("t",mktime(0,0,0,$month,1,$year));
	//echo $dend;

	//曜日の始めを代入
	//$w;現在の曜日
	$w = $wtop;


	for($i=1;$i<=$dend;$i++){ //１日から月末まで出力
		if($i == 1){
			if($i == $today){
				if($month==$nowmonth){
					echo "<td class='today'><font color=\"green\">$month/$i";
				echo"<br>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $i){	
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
							echo"<br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
				}
				else{
					echo "<td class='font-day'>$month/$i";
				echo"<br>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $i){	
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
							echo"<br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
				}
			}
			else if($w == 0){//日曜
				echo "</tr><tr>";//改行
				echo "<td class='sun'><font color=\"red\">$month/$i";
				echo"<br>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $i){	
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
							echo"<br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
			
			}else if($w == 6){//土曜
				echo "<td class='sat'><font color=\"blue\">$month/$i";
				echo"<br>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $i){	
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
							echo"<br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
			}else{//平日
				echo"<td class='font-day'>$month/$i";
				echo"<br>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $i){	
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
							echo"<br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
			}
			//次の曜日にする
				$w++;
				$w %=7;//日曜になったらリセットする
		}
		else{		
			if($i == $today){	
				if($month==$nowmonth){
					if($year==$nowyear){
						echo "<td class='today'><font color=\"green\">$i";
						echo"<br>";
						foreach ($data['calendar5s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $i){	
									echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
									echo"<br>";

									}else{
									}
								}else{
								}
							}
							else{
							}
						}	
						echo"</td>";
					}
					else{
						if($w == 0){//日曜
							echo "</tr><tr>";//改行
							echo "<td class='sun'><font color=\"red\">$i";
							echo"<br>";
							foreach ($data['calendar5s'] as $item){
								if($item->year == $year){		
									if($item->month == $month){	
										if($item->day == $i){	
										echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
										echo"<br>";

										}else{
										}
									}else{
									}
								}
								else{
								}
							}	
							echo"</td>";
						}else if($w == 6){//土曜
							echo "<td class='sat'><font color=\"blue\">$i";
							echo"<br>";
							foreach ($data['calendar5s'] as $item){
								if($item->year == $year){		
									if($item->month == $month){	
										if($item->day == $i){	
										echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
										echo"<br>";

										}else{
										}
									}else{
									}
								}
								else{
								}
							}	
							echo"</td>";
						}else{//平日
							echo"<td class='font-day'>$i";
						echo"<br>";
						foreach ($data['calendar5s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $i){	
									echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
									echo"<br>";

									}else{
									}
								}else{
								}
							}
							else{
							}
						}	
							echo"</td>";
						}
					}
				}
				else{
					if($w == 0){//日曜
						echo "</tr><tr>";//改行
						echo "<td class='sun'><font color=\"red\">$i</td>";
						echo"<br>";
						foreach ($data['calendar5s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $i){	
									echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
									echo"<br>";

									}else{
									}
								}else{
								}
							}
							else{
							}
						}	
						echo"</td>";
					}else if($w == 6){//土曜
						echo "<td class='sat'><font color=\"blue\">$i</td>";
						foreach ($data['calendar5s'] as $item){
							if($item->year == $year){		
								if($item->month == $month){	
									if($item->day == $i){	
									echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
									echo"<br>";

									}else{
									}
								}else{
								}
							}
							else{
							}
						}	
						echo"</td>";
					}else{//平日
						echo"<td class='font-day'>$i";
				echo"<br>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $i){	
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
							echo"<br>";

							}else{
							}
						}else{
						}
					}
					else{
					}
				}	
						echo"</td>";
					}
				}
			}
			else if($w == 0){//日曜
				echo "</tr><tr>";//改行
				echo "<td class='sun'><font color=\"red\">$i";
				echo"<br>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $i){	
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
							echo"<br>";

							}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
			}else if($w == 6){//土曜
				echo "<td class='sat'><font color=\"blue\">$i";
				echo"<br>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $i){	
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
							echo"<br>";

							}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
			}else{//平日
				echo"<td class='font-day'>$i";
				echo"<br>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $i){	
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true));
							echo"<br>";

							}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
			}
			//次の曜日にする
				$w++;
				$w %=7;//日曜になったらリセットする
		}

	}//for文の終了

	//最終日の次の日が日曜日なら終了
	if($w == 0)return;

//来月********************************************************************
	//残りのマスを空白でうめる
	for($i=$w,$month = $month + 1,$x = 1;$i<7;$i++){
		if($month == 13){
			$month = 1;
		}
		if($x == 1){
			if($i==-1){
				echo "<td class='sun'><div id='raigetu'>$month/$x</div>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $x){	
							echo "<div class='raigetuyotei'>";
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true) );
							echo"</div><br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
				$x++;
				
			}
			elseif($i==6){
				echo "<td class='sat'><div id='raigetu'>$month/$x</div>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $x){	
							echo "<div class='raigetuyotei'>";
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true) );
							echo"</div><br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
				$x++;
			}
			else{
				echo "<td class='font-day'><div id='raigetu'>$month/$x</div>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $x){	
							echo "<div class='raigetuyotei'>";
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true) );
							echo"</div><br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
				$x++;
			}
		}
		else{
			if($i==-1){
				echo "<td class='sun'>$x</div>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $x){	
							echo "<div class='raigetuyotei'>";
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true) );
							echo"</div><br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
				$x++;
				
			}
			elseif($i==6){
				echo "<td class='sat'><div id='raigetu'>$x</div>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $x){	
							echo "<div class='raigetuyotei'>";
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true) );
							echo"</div><br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
				$x++;
			}
			else{
				echo "<td class='font-day'><div id='raigetu'>$x</div>";
				foreach ($data['calendar5s'] as $item){
					if($item->year == $year){		
						if($item->month == $month){	
							if($item->day == $x){	
							echo "<div class='raigetuyotei'>";
							echo Html::anchor('calendar5/view/'.$item->id, Str::truncate($item->title,10,'', true) );
							echo"</div><br>";
								}else{
							}
						}else{
						}
					}
					else{
					}
				}	
				echo"</td>";
				$x++;
			}
		}

	}
}
	echo "<h3>予定一覧</span></h3>";
	if ($calendar5s){
		echo"<table class='table-striped aiu' id='calyotei'>";
			echo"<thead>";
				echo"<tr>";
					echo"<th>名前</th>";
					echo"<th>年</th>";
					echo"<th>月</th>";
					echo"<th>日</th>";
					echo"<th>時間</th>";
					echo"<th>タイトル</th>";
					echo"<th>内容</th>";
					echo"<th>&nbsp;</th>";
				echo"</tr>";
			echo"</thead>";
			echo"<tbody>";
				foreach ($calendar5s as $item){
					if($item->year == $year){		
						if($item->month == $month){		
							echo"<tr class='calyoteitr'>";
							echo"<td class='calyoteitd'>$item->name</td>";
							echo"<td class='tdyear'>$item->year/</td>";
							echo"<td class='tdmonth'>$item->month/</td>";
							echo"<td class='tdday'>$item->day</td>";
							echo"<td class='tdday'>$item->time</td>";
							echo"<td class='calyoteitd'>";echo Str::truncate($item->title,10,'', true); echo"</td>";
							echo"<td class='calyoteitd'>";echo Str::truncate($item->text,10,'', true); echo"</td>";
							echo"<td class='calyoteitd'>";
								echo"<div class='btn-toolbar'>";
								echo"<div class='btn-group'>";
										echo Html::anchor('calendar5/view/'.$item->id, '<i class="icon-eye-open"></i> 詳細', array('class' => 'btn btn-default btn-sm'));
										echo Html::anchor('calendar5/edit/'.$item->id, '<i class="icon-wrench"></i> 編集', array('class' => 'btn btn-default btn-sm')); 
										echo Html::anchor('calendar5/delete/'.$item->id, '<i class="icon-trash icon-white"></i> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('本当に削除してもよろしいですか？')")); 
									echo"</div>";
								echo"</div>";
							echo"</td>";
							echo"</tr>";
						}	
					}	
				}	
			echo"</tbody>";
		echo"</table>";
	}
	else{
		echo "<p>予定はありません</p>";
	}

?>