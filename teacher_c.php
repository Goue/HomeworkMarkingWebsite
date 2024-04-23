<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\teacher_c.css" type="text/css">
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
<form method="post" action="teacher_c.php">
	<div class="table">
<?php	echo	"<span class='table-a'>".$classname."</span>";
?>			
			<span class="table-b">Homework</span>
			<input class="table-input-text1" type="text" placeholder="Homework name" name="homework">
			<span class="table-c">DUE</span>
			<input class="table-input-text2" type="datetime-local" name="DUE">
			<span class="table-d">problem</span>
<?php		$a=1+@$_GET['a'];
			echo	"<a href='teacher_c.php?a=".$a."'>+</a>";
			for($i=1;$i<=$a;$i++)
			{
				if($i>10)
					break;
				$left=$i*12+3;
				$style="style='left:".$left."%;";
				if($i>=7)
				{
					$left=($i-6)*12+3;
					$style="style='left:".$left."%;";
					echo "<input class='table-input-text3' type='text' name='problem[]' ".$style."top:320px;'>";
				}
				else
					echo "<input class='table-input-text3' type='text' name='problem[]' ".$style."'>";
			}

	if(@$_POST["homework"]!=null && @$_POST["DUE"]!=null && @$_POST["problem"]!=null)
	{
		//新增作業到`homework`
		//查詢id需要多少
		$sql="SELECT `classname` FROM `homework` WHERE `classname`='".$classname."'";
		$result=mysqli_query($link,$sql);
		$idint=mysqli_num_rows($result);
		$idint=$idint+1;
		//取得現在時間2022-01-07T14:27
		$date1=date("Y-m-d",mktime(date("H")+7));
		$date2=date("H:s",mktime(date("H")+7));
		$date=$date1."T".$date2;
		//新增
		$problem=$_POST["problem"];
		$sql="INSERT INTO `homework`(`id`, `classname`, `homeworkname`, `RELEASED`, `DUE`";	 
		for($i=1;$i<=count($problem);$i++)
		{
			$sql=$sql.", `link".$i."`";
			if($i==count($problem))
				$sql=$sql.")VALUES ('".$_COOKIE["classname"].$idint."', '".$classname."', '".$_POST["homework"]."', '".$date."', '".$_POST["DUE"]."'";
		}
		for($i=1;$i<=count($problem);$i++)
		{
			$sql=$sql.", '".$problem[$i-1]."'";
			if($i==count($problem))
				$sql=$sql.")";
		}
		$result1=mysqli_query($link,$sql);
		
		
		//新增作業到`studenthomework`
		//查詢有修這堂課的學生email  使用$semail[$i][0]查詢
		$sql="SELECT `email` FROM `studentclass` WHERE `classname`='".$classname."'";
		$result=mysqli_query($link,$sql);
		$semailint=mysqli_num_rows($result);
		for($i=0;$i<$semailint;$i++){
			$semail[$i] = mysqli_fetch_row($result);					
		}
		//查詢id需要多少
		$sql="SELECT * FROM `studenthomework` WHERE `classname`='".$classname."' AND `studentemail`='".$semail[0][0]."'";
		$result=mysqli_query($link,$sql);
		$idint=mysqli_num_rows($result);
		$idint=$idint+1;
		//新增
		for($i=0;$i<$semailint;$i++)
		{
			$sql="INSERT INTO `studenthomework`(`homeworkid`, `studentemail`, `classname`, `homeworkname`, `STATUS`) 
			VALUES ('".$semail[$i][0].$classname.$idint."' ,'".$semail[$i][0]."', '".$classname."', '".$_POST["homework"]."', 'Unsubmitted')";
			$result2=mysqli_query($link,$sql);

		}
		
		
		//新增作業到`link`
		for($i=0;$i<$semailint;$i++)
		{
			$sql="INSERT INTO `link`(`ech`, `iflink`)  VALUES ('".$semail[$i][0].$classname.$_POST["homework"]."', '0')";			
			$result3=mysqli_query($link,$sql);
		}
		
		
		//更新作業數量到`class`
		$sql="UPDATE `class` SET `assignments`='".$idint."' WHERE classname='".$classname."'";
		$result4=mysqli_query($link,$sql);
		
		if($result1 && $result2 && $result3 && $result4)
			echo "<script>window.location.href='teacher_a.php'</script>";
	
	}
?>			
		<div class="table2">
			<input class="table-submit" type="submit" value="announce">
		</div>
	</div>
</form>
<?php
	mysqli_close($link);
?>
</body>
</html>