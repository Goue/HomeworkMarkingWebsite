<?php
include("connMysql.php");

	//判斷是否有交過作業如果沒有則跳到交作業
	$ch=explode("!",$_GET["ch"]);
	$ech=$_COOKIE["email"].$ch[0].$ch[1];
	$sql="SELECT `iflink` FROM `link` WHERE `ech`='".$ech."'";
	$result=mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($result);
	$a=$row["iflink"];
	if($a==0)
	{
		setcookie("c", $ch[0], time()+360);
		setcookie("h", $ch[1], time()+360);
		echo "<script>window.location.href='student_d.php'</script>;";
	}
	else
	{
		setcookie("c", $ch[0], time()+360);
		setcookie("h", $ch[1], time()+360);
		echo "<script>window.location.href='student_c.php'</script>;";
	}










?>