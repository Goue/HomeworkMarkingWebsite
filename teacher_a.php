<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\teacher_a.css" type="text/css">
	<script type="text/javascript" src="js\js.js"> </script>
</head>
<body onload="ShowTime()">
<?php
	include("connMysql.php");
	email(@$_COOKIE["email"]);
	setcookie("classname","",time()-600);
	setcookie("ch","",time()-3600);
	setcookie("ech","",time()-3600);
?>
	<div class="head">
		<a href="teacher_a.php"><span class="head-a">goue_goue’s Homework</span></a>
		<span class="head-b" id="showbox"></span>
<?php		
		echo "<span class='head-c'>".$_COOKIE["email"]."</span>";
?>	
		<a href="login.php"><div class="head-dd">Logout</div></a>
	</div>
	<div class="YourCourses">Your Courses 2022</div>
<?php
	//查詢課程數量
	$sql="SELECT * FROM `class` WHERE `INSTRUCTORS`='".$_COOKIE["email"]."'";		
	$result=@mysqli_query($link,$sql);
	$table=mysqli_num_rows($result);
	//查詢課程名稱
	for($i=1;$i<=$table;$i++)
	{
		$sql="SELECT `classname` FROM `class` WHERE `classnameid`='".$_COOKIE["email"].$i."'";	
		$result=@mysqli_query($link,$sql);
		$classname[$i] = mysqli_fetch_row($result);
	}
	//查詢課程內容
	for($i=1;$i<=$table;$i++)
	{
		//查詢修課人數
		$sql="SELECT `classname` FROM `studentclass` WHERE `classname`='".$classname[$i][0]."'";		
		$result=@mysqli_query($link,$sql);
		$student[$i]=mysqli_num_rows($result);
		//查詢作業數量
		$sql="SELECT `assignments` FROM `class` WHERE `classname`='".$classname[$i][0]."'";		
		$result=@mysqli_query($link,$sql);
		$assignments[$i]=mysqli_fetch_row($result);
	}
	//印出來
	for($i=1;$i<=$table;$i++)
	{
		echo "<a href='teacher_b.php?classname=".$classname[$i][0]."'>
				<div class='table'><div class='table-label'></div>
					<span class='table-a'>".$classname[$i][0]."</span>
					<span class='table-b'>修課人數:".$student[$i]."</span>
				<div class='table2'>
					<span class='table2-a'>".$assignments[$i][0]." assignments</span>
				</div></div></a>";
	}
mysqli_close($link);
?>
		
	
</body>
</html>