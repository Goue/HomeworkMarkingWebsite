<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\teacher_d.css" type="text/css">
	<script type="text/javascript" src="js\js.js"> </script>
</head>
<body onload="ShowTime()">
<?php	
	include("connMysql.php");
	email(@$_COOKIE["email"]);
	$classname=@$_COOKIE["classname"];
	if(@$_COOKIE["classname"]==null)
	{
		setcookie("classname",$_GET['classname'],time()+600);
		$classname=$_GET['classname'];
	}
	
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
	//查詢作業數量 使用$table[0]查詢
	$sql="SELECT `assignments` FROM `class` WHERE `classname`='".$classname."'";		
	$result=@mysqli_query($link,$sql);
	$table=mysqli_fetch_row($result);
	$height=$table[0]*55+280;
		echo "<div class='table' style='height:".$height."px;'>";

		echo "<div class='table-a'>".$classname."</div>";

?>
	
	
	<div class="table2">
			<span class="table2_a">NAME</span>
			<span class="table2_b">RELEASED</span>
			<span class="table2_d">DUE</span>
	</div>
<?php
	//查詢作業名稱與時間 使用$homework[$i][0,1]查詢
	for($i=1;$i<=$table[0];$i++)
	{		
		$sql="SELECT `homeworkname`, `RELEASED`, `DUE` FROM `homework` WHERE `id`='".$classname.$i."'";
		$result=@mysqli_query($link,$sql);
		$homework[$i]=mysqli_fetch_row($result);
			//印出來
			$a=$i*80+150;
			echo "<a href='teacher_e.php?ch=".$classname."!".$homework[$i][0]."'>
			<div class='table_1' style='top:".$a."px;'>#".$homework[$i][0]."
			<span class='table_1b'>".datea($homework[$i][1])."</span>
			<span class='table_1c'>".dateaa($homework[$i][2],datea($homework[$i][2]))."</span>
			
			</div></a>";
	}

?>	
	<div class="end"></div>
	</div>
	
	
</body>
</html>