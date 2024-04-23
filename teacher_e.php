<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\teacher_e.css" type="text/css">
	<script type="text/javascript" src="js\js.js"> </script>
</head>
<body onload="ShowTime()">
<?php	
	include("connMysql.php");
	email(@$_COOKIE["email"]);
	setcookie("ech","",time()-3600);
	$ch=@$_COOKIE["ch"];
	if(@$_COOKIE["ch"]==null)
	{
		setcookie("ch",$_GET['ch'],time()+3600);
		$ch=$_GET['ch'];
	}
	//把課程與作業名稱分開
	$ch=explode("!",$ch);
	$classname=$ch[0];
	$homework=$ch[1];
?>
	<div class="head">
		<a href="teacher_a.php"><span class="head-a">goue_goue’s Homework</span></a>
		<span class="head-b" id="showbox"></span>
<?php		
		echo "<span class='head-c'>".$_COOKIE["email"]."</span>";
?>	
		<a href="login.php"><div class="head-dd">Logout</div></a>
	</div>
	
<?php
	//查詢學生數量 使用$table查詢
	$sql="SELECT `email` FROM `studentclass` WHERE `classname`='".$classname."'";		
	$result=@mysqli_query($link,$sql);
	$table=mysqli_num_rows($result);
	//查詢作業是否到期 用$RELEASED[0]$DUE[0]查詢
	$sql="SELECT `RELEASED` FROM `homework` WHERE `homeworkname`='".$homework."'";
	$result=@mysqli_query($link,$sql);
	$RELEASED=mysqli_fetch_row($result);
	$sql="SELECT `DUE` FROM `homework` WHERE `homeworkname`='".$homework."'";
	$result=@mysqli_query($link,$sql);
	$DUE=mysqli_fetch_row($result);

	
	$height=$table*55+280;
		echo "<div class='table' style='height:".$height."px;'>";

		echo "<div class='table-a'>#".$homework."</div>";

?>
	
	
	<div class="table2">
			<span class="table2_a">NAME</span>
			<span class="table2_b">STATUS</span>
	</div>
<?php
	
	for($i=1;$i<=$table;$i++)
	{	//查詢學生email 使用$studentemail[$i][0]查詢
		$sql="SELECT `email` FROM `studentclass` WHERE `classnameid`='".$classname.$i."'";		
		$result=@mysqli_query($link,$sql);
		$studentemail[$i]=mysqli_fetch_row($result);
		//查詢學生作業繳交狀態 使用$STATUS[$i][0]查詢
		$sql="SELECT `STATUS` FROM `studenthomework` WHERE `studentemail`='".$studentemail[$i][0]."' AND`classname`='".$classname."' AND homeworkname='".$homework."'";
		$result=@mysqli_query($link,$sql);
		$STATUS[$i]=mysqli_fetch_row($result);
		if($STATUS[$i][0]=="Submitted")
			$sstyle="style='color:#61f314;'";
		else if($STATUS[$i][0]=="Unsubmitted")
			$sstyle="style='color:#ff0000;'";
		else
		{
			$sstyle="";
			$qq="/100";
		}
			
		//判斷超連結
		$b=dateb($RELEASED[0],$DUE[0]);
		if($b<=0)
		{
			$b="teacher_f.php?ech=".$studentemail[$i][0]."!".$classname."!".$homework;
			//印出來
			$a=$i*80+150;
			echo "<a href='".$b."'>
			<div class='table_1' style='top:".$a."px;'>".$studentemail[$i][0]."
			<span class='table_1b' ".$sstyle.">".$STATUS[$i][0].@$qq."</span>
			<div class='incorrect' style='color:#c8d9c0; border-color:#c8d9c0;'>Can be corrected</div>
			</div></a>";		
		}
		else
		{	
			$b="";
			//印出來
			$a=$i*80+150;
			echo "<a href='".$b."'>
			<div class='table_1' style='top:".$a."px;'>".$studentemail[$i][0]."
			<span class='table_1b' ".$sstyle.">".$STATUS[$i][0]."</span>
			<div class='incorrect' style='color:#ccb5b5; border-color:#ccb5b5;'>Unable to correct</div>
			</div></a>";			
		}
		
		
	}	

?>	
	<div class="end"></div>
	</div>
	
</body>
</html>