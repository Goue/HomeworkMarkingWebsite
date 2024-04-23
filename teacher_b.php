<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\teacher_b.css" type="text/css">
	<script type="text/javascript" src="js\js.js"> </script>
</head>
<body onload="ShowTime()">
	<div class="head">
		<a href="teacher_a.php"><span class="head-a">goue_goue’s Homework</span></a>
		<span class="head-b" id="showbox"></span>
<?php	
include("connMysql.php");	
email(@$_COOKIE["email"]);
		echo "<span class='head-c'>".$_COOKIE["email"]."</span>";
?>	
		<a href="login.php"><div class="head-dd">Logout</div></a>
	</div>
<?php
	echo "<a href='teacher_c.php?classname=".$_GET['classname']."'>";
?>
		<div class="table1">New homework</div>
	</a>
<?php
	echo "<a href='teacher_d.php?classname=".$_GET['classname']."'>";
?>
		<div class="table2">Correcting homework</div>
	</a>
	
</body>
</html>