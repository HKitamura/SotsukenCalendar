function before($year, $month){
		$caldate = strtotime('-1 month', $caldate); 
		$year = date("Y", $caldate);
		$month = date("n", $caldate);
	}
function after($year, $month){
		$caldate = strtotime('+1 month', $caldate); 	
		$year = date("Y", $caldate);
		$month = date("n", $caldate);
	}
