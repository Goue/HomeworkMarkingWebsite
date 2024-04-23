<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\student_b.css" type="text/css">
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
<?php
	//查詢作業數量
	$classname=$_GET["classname"];
	$sql="SELECT `classname` FROM `studenthomework` WHERE `classname`='".$classname."' AND `studentemail`='".$_COOKIE["email"]."'";		
	$result=@mysqli_query($link,$sql);
	$table=mysqli_num_rows($result);
	$height=$table*90+280;
		echo "<div class='table' style='height:".$height."px;'>";

		echo "<div class='table-a'>".$classname."</div>";
?>
		<div class="table2">
			<span class="table2_a">NAME</span>
			<span class="table2_b">STATUS</span>
			<span class="table2_c">RELEASED</span>
			<span class="table2_d">DUE</span>
		</div>
<?php
	//查詢作業內容
	for($i=0;$i<$table;$i++)
	{
		$id=$i+1;
		$sql="SELECT * FROM `studenthomework` WHERE `homeworkid`='".$_COOKIE["email"].$classname.$id."' ORDER BY 'homeworkid' DESC";
		$result=mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($result);
		$rowhomeworkid[$i][0]=$row['homeworkname'];
		$rowhomeworkid[$i][1]=$row['STATUS'];
		$sql="SELECT * FROM `homework` WHERE `id`='".$classname.$id."' ORDER BY 'id' DESC";
		$result=mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($result);
		$rowclasshomeworkid[$i][0]=$row['RELEASED'];
		$rowclasshomeworkid[$i][1]=$row['DUE'];
	}
	
		for($i=0;$i<$table;$i++)
		{	
			$a=$i*90+230;
			//取得課程名稱作業名稱
			$ch[$i]=$classname."!".$rowhomeworkid[$i][0];
			//決定進度條			
			$b=dateb($rowclasshomeworkid[$i][0],$rowclasshomeworkid[$i][1]);
			if($b>60)
				$dstyle="style='width:".$b."%; background: #3fb302;'";
			else if($b>40)
				$dstyle="style='width:".$b."%; background: #f8c000;'";
			else if($b>20)
				$dstyle="style='width:".$b."%; background: #f36d00;'";
			else
				$dstyle="style='width:".$b."%; background: #eb0f00;'";
			
			//更改STATUS
			$qq="";
			if($rowhomeworkid[$i][1]=="Submitted")
				$sstyle="style='color:#61f314;'";
			else if($rowhomeworkid[$i][1]=="Unsubmitted")
				$sstyle="style='color:#ff0000;'";
			else
			{
				$sstyle="";
				$qq="/100";
			}
			
			//印出來		
			if($b<=0)
			{
			echo "<a href='go.php?ch=".$ch[$i]."'><div class='table_1' style='top:".$a."px;'>#".$rowhomeworkid[$i][0]."
			<span class='table_1b'>".$rowhomeworkid[$i][1].$qq."</span>
			<span class='table_1c'>".datea($rowclasshomeworkid[$i][0])."</span>			
				<span class='table_1ee'>".dateaa($rowclasshomeworkid[$i][1],datea($rowclasshomeworkid[$i][1]))."</span>
			</div></a>";
			}
			else
			{
			
			echo "<a href='go.php?ch=".$ch[$i]."'><div class='table_1' style='top:".$a."px;'>#".$rowhomeworkid[$i][0]."
			<span class='table_1b' ".$sstyle.">".$rowhomeworkid[$i][1]."</span>
			<span class='table_1c'>".datea($rowclasshomeworkid[$i][0])."</span>			
			<div class='g-container'>
				<span class='table_1d'>".datec($rowclasshomeworkid[$i][1])."</span>
				<div class='g-progress' ".$dstyle."></div>
				<span class='table_1e'>".dateaa($rowclasshomeworkid[$i][1],datea($rowclasshomeworkid[$i][1]))."</span>
			</div>
			</div></a>";
			}

			
		}
	mysqli_close($link);

?>
		<div class="end"></div>
	</div>

</body>
</html>