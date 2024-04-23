<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\login.css" type="text/css">
	<script type="text/javascript" src="js\js.js"> </script>
</head>
<body onload="ShowTime()">
<?php
	include("connMysql.php");
	setcookie("email", "", time()-600);
	if(@$_COOKIE["a"]==null)
		setcookie("a",0,time()+60);
	else
		setcookie("a",@$_COOKIE["a"]+1,time()+60);
		
?>
	<div class="head">
		<a href="login.php"><span class="head-a">goue_goue’s Homework</span></a>
		<span class="head-b" id="showbox"></span>
	</div>
	
	<form method="post" action="login.php">
		<div class="table">
			<span class="table-a">goue_goue’s Homework</span>							
			<span class="table-c">Email</span>			
			<input class="table-input-text1" type="email" placeholder="your email" name="email">			
			<span class="table-d">Password</span>			
			<input class="table-input-text2" type="Password" placeholder="Password" name="password">

			<div class="table2">
<?php
		if(@$_COOKIE["a"]!=null)
			echo "<div class='incorrect'>Email or Password incorrect</div>";
?>
				<input class="table-submit" type="submit" value="Login">
			</div>
		</div>	
	</form>
<?php
	
	if(@$_POST["email"]!="" && @$_POST["password"]!="")
	{
		//判斷是否為學生
		$sql="SELECT `email` ,`password` FROM `student` WHERE `email`='".$_POST["email"]."' AND `password`='".$_POST["password"]."'";		
		$result=@mysqli_query($link,$sql);
		if(mysqli_num_rows($result)==1)
		{
			setcookie("email",$_POST["email"],time()+3600);
			setcookie("a", "", time()-60);
			echo "<script>window.location.href='student_a.php'</script>";
		}
		//判斷是否為老師
		else
		{
			$sql="SELECT `email` ,`password` ,`name` FROM `instructors` WHERE `email`='".$_POST["email"]."' AND `password`='".$_POST["password"]."'";		
			$result=@mysqli_query($link,$sql);
			if(mysqli_num_rows($result)==1)
			{
				$row = mysqli_fetch_assoc($result);
				setcookie("email",$row['name'],time()+3600);
				setcookie("a", "", time()-60);
				echo "<script>window.location.href='teacher_a.php'</script>";
			}
		}
	}
	mysqli_close($link);
?>
</body>
</html>