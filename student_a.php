<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\student_a.css" type="text/css">
	<script type="text/javascript" src="js\js.js"> </script>
</head>
<body onload="ShowTime()">
<?php
	include("connMysql.php");
	email(@$_COOKIE["email"]);
?>
	<div class="head">
		<a href="student_a.php"><span class="head-a">goue_goue’s Homework</span></a>
		<span class="head-b" id="showbox"></span>
<?php		
		echo "<span class='head-c'>".$_COOKIE["email"]."</span>";
?>	
		<a href="login.php"><div class="head-dd">Logout</div></a>
	</div>
	<div class="YourCourses">Your Courses 2022</div>
<?php
	//查詢課程數量
	$sql="SELECT `classname` FROM `studentclass` WHERE `email`='".$_COOKIE["email"]."'";		
	$result=@mysqli_query($link,$sql);
	$table=mysqli_num_rows($result);
	//查詢課程名稱
	for($i=1;$i<=$table;$i++)
	{
		$sql="SELECT `classname` FROM `studentclass` WHERE `Coursenumber`='".$_COOKIE["email"]."".$i."'";		
		$result=@mysqli_query($link,$sql);
		$row[$i-1] = mysqli_fetch_row($result);
	}
	//查詢課程內容
	for($i=0;$i<$table;$i++)
	{
		$sql="SELECT * FROM `class` WHERE `classname`='".$row[$i][0]."'";
		$result=mysqli_query($link,$sql);
		$row2 = mysqli_fetch_assoc($result);

		$rowclass[$i][0]=$row2['classname'];
		$rowclass[$i][1]=$row2['INSTRUCTORS'];
		//查詢作業數量
		$sql="SELECT `classname` FROM `studenthomework` WHERE `classname`='".$row[$i][0]."' AND `studentemail`='".$_COOKIE["email"]."'";		
		$result=@mysqli_query($link,$sql);
		$rowclass[$i][2]=mysqli_num_rows($result);
	}
	
	//顯示
	for($i=0;$i<$table;$i++)
	{
		echo "<a href='student_b.php?classname=".$rowclass[$i][0]."'>";
		echo "<div class='table'><div class='table-label'></div>";
		echo "<span class='table-a'>".$rowclass[$i][0]."</span>";
		echo "<span class='table-b'>INSTRUCTORS:".$rowclass[$i][1]."</span>";
		echo "<div class='table2'>";
		echo 	"<span class='table2-a'>".$rowclass[$i][2]." assignments</span>";
		echo "</div></div></a>";	
	}
	mysqli_close($link);
?>

</body>
</html>