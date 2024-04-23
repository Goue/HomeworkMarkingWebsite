<?php
	$db_host="localhost";
	$db_username="root";
	$db_password="";
	$db_db="3a932053";
	$link = @mysqli_connect($db_host,$db_username,$db_password,$db_db);
	if(!$link)
		echo "<script>alert('資料庫連線失敗');</script>";	


//檢查email是否還有
function email($email){
	if($email==null)
		echo "<script>window.location,href='login.php'</script>";
}
//數字月份轉換英文
function datea($time){
	$m=substr($time,5,2);
	$d=substr($time,8,2);
	$date;
	switch($m){
		case "01":
			$date="Jan";
			break;
		case "02":
			$date="Feb";
			break;
		case "03":
			$date="Mar";
			break;
		case "04":
			$date="Apr";
			break;
		case "05":
			$date="May";
			break;
		case "06":
			$date="Jun";
			break;
		case "07":
			$date="Jul";
			break;			
		case "08":
			$date="Aug";
			break;
		case "09":
			$date="Sep";
			break;
		case "10":
			$date="Oct";
			break;
		case "11":
			$date="Nov";
			break;
		case "12":
			$date="Dec";
			break;
	}
	$date=$date."&nbsp".$d;
	return $date;
}
//轉英文後加小時分
function dateaa($time,$date){
	$h=substr($time,11,5);
	$date=$date."&nbsp".$h;
	return $date;
}
//判斷月份日期小時為要抓幾個數
function ifdate($time){
	if(substr($time,0,1)==0)
		return substr($time,1,1);
	else
		return substr($time,0,2);
}
//計算月日變小時{
function sumdate($m,$d,$h){
	$sum=((($m*30)+$d)*24)+$h;
	return $sum;
}
//判斷進度條
function dateb($starttime,$endtime){
		
	$sm=ifdate(substr($starttime,5,2));
	$sd=ifdate(substr($starttime,8,2));
	$sh=ifdate(substr($starttime,11,2));

	$em=ifdate(substr($endtime,5,2));
	$ed=ifdate(substr($endtime,8,2));
	$eh=ifdate(substr($endtime,11,2));
	
	$nm=ifdate(date("m"));

	$nd=ifdate(substr(date("Y-m-dTH",mktime(date("H")+7)),8,2));
	$nh=ifdate(date("H",mktime(date("H")+7)));
	
	$ssum=sumdate($sm,$sd,$sh);
	$esum=sumdate($em,$ed,$eh);
	$nsum=sumdate($nm,$nd,$nh);
	$sum=(($esum-$nsum)/($esum-$ssum))*100;

	return $sum;
}
//計算還有多少時間才到期
function datec($endtime){
	$em=ifdate(substr($endtime,5,2));
	$ed=ifdate(substr($endtime,8,2));
	$eh=ifdate(substr($endtime,11,2));	
	$nm=ifdate(date("m"));
	$nd=ifdate(substr(date("Y-m-dTH",mktime(date("H")+7)),8,2));
	$nh=ifdate(date("H",mktime(date("H")+7)));
	$esum=sumdate($em,$ed,$eh);
	$nsum=sumdate($nm,$nd,$nh);
	$time=$esum-$nsum;
	$time=$time/24;
	$time=explode(".",$time);
	$day=$time[0];
	if($day==0)
		$day="";
	else
		$day=$day."&nbspday";
	@$h=$time[1];
	if(substr($h,0,1)==0)
	{
		$h=$h*24;
		$h="0".$h;
	}
	else
		$h=$h*24;
	if(substr($h,0,1)==0)
		$h=substr($h,1,1)."&nbsphour";
	else if(substr($h,0,1)==0 && substr($h,1,1)==0)
		$h="";
	else
		$h=substr($h,1,1)."&nbsphour";	
	$a=$day."&nbsp&nbsp".$h;
	return $a;
}





















?>