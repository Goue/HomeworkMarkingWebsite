<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\teacher_f.css" type="text/css">
	<script type="text/javascript" src="js\js.js"> </script>
</head>
<body onload="ShowTime()">
<?php	
	include("connMysql.php");
	email(@$_COOKIE["email"]);
	$ech=@$_COOKIE["ech"];
	if(@$_COOKIE["ech"]==null)
	{
		setcookie("ech",$_GET['ech'],time()+3600);
		$ech=$_GET['ech'];
	}
	//把ech分開
	$ech1=explode("!",$ech);
	$e=$ech1[0];
	$c=$ech1[1];
	$h=$ech1[2];
	//把空白用掉
	$ech=$e.$c.$h;
	$ech=explode(" ",$ech);
	$ech=join($ech);
	//修改分數
	if(@$_POST['STATUS']!=null)
	{
		$sql="UPDATE `studenthomework` SET `STATUS`='".@$_POST['STATUS']."' WHERE `studentemail`='".$e."' AND `homeworkname`='".$h."'";
		$result=@mysqli_query($link,$sql);
		if(@$result)
		{
			setcookie("ch",$c."!".$h,time()+3600);
			echo "<script>window.location.href='teacher_e.php'</script>";
		}
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
	
	
	
		<div class="table">
		<div class="table1">
			
<?php	

		if(@$_GET["image"]==null)
			$image=$ech."1.jpg";
		else
			$image=@$_GET["image"];
		if( @fopen( $image, 'r' ) )
			echo "<img src='".$image."' alt=''>";
		else
			echo "<div class='incorrect'>
				Not submitted</div>";
		//判斷圖片是否有
		

?>
		</div>
		
<?php
		echo "<div class='table2'>";
		echo	"<span class='table2-a'>".$h."<br>".$e."</span>";
		echo	"<span class='table2-b'>Problem</span>";

		//查詢題目數量
		$sql="SELECT `link1`, `link2`, `link3`, `link4`, `link5`, `link6`, `link7`, `link8`, `link9`, `link10` FROM `homework` WHERE `classname`='".$c."' AND `homeworkname`='".$h."'";		
		$result=@mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($result);
		$row["link1"];
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
			echo "<li><a href='teacher_f.php?image=".$ech.$i.".jpg'>".$row["link".$i]."</a></li>";					
		}
		echo "</ul>
			<form method='post' action='teacher_f.php'>";	
		echo "<span class='text2'>Points:</span>
		<input class='text' type='text' name='STATUS' style=''>";
?>				
			<div class="table2-2">	
<?php		echo "<a href='teacher_e.php?ch=".$c."!".$h."' style='text-decoration: none;'>";?>
				<div class='table2-d'>Return</div>
			</a>
				<input class="table2-c" type="submit" value="Upload">
			</form>
			</div>
		</div>
	</div>
<?php
mysqli_close($link);
?>
	
	
	
	
	
	
	
	
	
	
	
</body>
</html>