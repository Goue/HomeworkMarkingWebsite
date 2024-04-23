<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\student_c.css" type="text/css">
	<script type="text/javascript" src="js\js.js"> </script>
</head>
<body onload="ShowTime()">
<?php
	include("connMysql.php");
	email(@$_COOKIE["email"]);
	$c=@$_COOKIE["c"];
	$h=@$_COOKIE["h"];
	setcookie("c", $_COOKIE["c"], time()+360);
	setcookie("h", $_COOKIE["h"], time()+360);
	//讓圖片檔不會有空白
	$cc=explode(" ",$c);
	$cc=join($cc);
?>
	<div class="head">
		<a href="student_a.php"><span class="head-a">goue_goue’s Homework</span></a>
		<span class="head-b" id="showbox"></span>
<?php		
		echo "<span class='head-c'>".$_COOKIE["email"]."</span>";
?>	
		<a href="login.php"><div class="head-dd">Logout</div></a>
	</div>
	<div class="table">
		<div class="table1">
			
<?php	
		//判斷圖片是否有
		if(@$_GET["image"]==null)
			$image=$_COOKIE["email"].$cc.$h."1.jpg";
		else
			$image=@$_GET["image"];
		if( @fopen( $image, 'r' ) )
			echo "<img src='".$image."' alt=''>";
		else
			echo "<div class='incorrect'>
				Not submitted</div>";
?>
		</div>
		
<?php
		echo "<div class='table2'>";
		echo	"<span class='table2-a'>".$h."</span>";
		echo	"<span class='table2-b'>Problem</span>";
		
		
		//判斷繳交期限是否到達
		$sql="SELECT `RELEASED` FROM `homework` WHERE `homeworkname`='".$h."'";
		$result=@mysqli_query($link,$sql);
		$RELEASED=mysqli_fetch_row($result);
		$sql="SELECT `DUE` FROM `homework` WHERE `homeworkname`='".$h."'";
		$result=@mysqli_query($link,$sql);
		$DUE=mysqli_fetch_row($result);
		$ww=dateb($RELEASED[0],$DUE[0]);		
		
		//查詢題目數量
		$sql="SELECT `link1`, `link2`, `link3`, `link4`, `link5`, `link6`, `link7`, `link8`, `link9`, `link10` FROM `homework` WHERE `classname`='".$c."' AND `homeworkname`='".$h."'";		
		$result=@mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($result);
		$a=1;
		while(true)
		{	
			if(@$row["link".$a]==null)
				break;		
			$a++;
		}
		echo "<ul>";
		for($i=1;$i<$a;$i++)
		{	
				echo "<li><a href='student_c.php?image=".@$_COOKIE["email"].$cc.$h.$i.".jpg'>".$row["link".$i]."</a></li>";					
		}
		echo "</ul>";
?>
			<div class="table2-2">
<?php		if($ww<=0)
			{
				echo"<a href='student_b.php?classname=".$c."' style='text-decoration: none;'>
				<div class='table2-c'>Return</div>
				";
			}
				
			else
			{
				echo"<a href='student_d.php?ch=".$c."!".$h."' style='text-decoration: none;'>	
					<div class='table2-c'>Submit</div>";
			}
?>
					
				</a>				
			</div>
		</div>
	</div>
<?php
mysqli_close($link);
?>
</body>
</html>