<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>goue_goue’s Homework</title>
	<link rel="stylesheet" href="css\student_d.css" type="text/css"></link>
	<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet'></link>
	<script type="text/javascript" src="js\js.js"></script>
</head>
<body onload="ShowTime()">
	<div class="head">
		<a href="student_a.php"><span class="head-a">goue_goue’s Homework</span></a>
		<span class="head-b" id="showbox"></span>
<?php		
		echo "<span class='head-c'>".$_COOKIE["email"]."</span>";
?>	
		<a href="login.php"><div class="head-dd">Logout</div></a>
	</div>
<?php	
	include("connMysql.php");
	email(@$_COOKIE["email"]);
	//判斷是從_c還是go來的
	if(@$_GET["ch"] != null)
	{
		$ch=explode("!",$_GET["ch"]);
		$c=$ch[0];
		$h=$ch[1];
	}
	else
	{
		$c=@$_COOKIE["c"];	
		$h=@$_COOKIE["h"];	
	}
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
	//讓圖片檔不會有空白
	$cc=explode(" ",$c);
	$cc=join($cc);
		//修改或新增檔案
		$sql="UPDATE `link` SET ";
		for($i=1;$i<$a;$i++)
		{
			if(@$_FILES['file'.$i]['error'] === UPLOAD_ERR_OK)
			{
				setcookie("if",1, time()+5);
				move_uploaded_file($_FILES['file'.$i]['tmp_name'],$_COOKIE["email"].$cc.$h.$i.".jpg");
				$sql=$sql."`link".$i."`='".$_COOKIE["email"].$cc.$h.$i.".jpg"."',";				
			}
		}
		$sql=substr($sql,0,strlen($sql)-1);
		$sql=$sql."WHERE `ech` = '".$_COOKIE["email"].$c.$h."'";
		$result=mysqli_query($link,$sql);
		//判斷是否更新成功並跳回
		if($result)
		{
			//修改繳交
			$sql="UPDATE `studenthomework` SET `STATUS`='Submitted' WHERE `studentemail`='".$_COOKIE["email"]."' AND `classname`='".$c."' AND `homeworkname`='".$h."'";
			mysqli_query($link,$sql);
			$sql="UPDATE `link` SET `iflink`='1'";
			mysqli_query($link,$sql);
			echo "<script>window.location.href='student_c.php'</script>;";	
			setcookie("c", $c, time()+120);
			setcookie("h", $h, time()+120);	
		}

	//印出來
		$height=$a*65+150;
		echo "<div class='table' style='height:".$height."px;'>";
		echo "<div class='table-a'>".$h."</div>";
		echo "<span class='table-b'>Problem</span>";

		echo "<form method='POST' action='student_d.php' enctype='multipart/form-data'>";
		echo "<ul>";
		for($i=1;$i<$a;$i++){
			echo "<li>".$row["link".$i]."&nbsp;&nbsp;&nbsp;&nbsp;Please select file &nbsp;&nbsp;&nbsp;&nbsp;".
					"<label class='table-file'>".
						"<input type='file' name='file".$i."' style='display:none;'><i class='fa fa-photo'></i>Select".
					"</label>".					
				 "</li>";
		}
		echo "</ul>";
		echo "<div class='table2'>";
		echo "<label class='table-submit'><i class='fa fa-cloud-upload'></i>Submit<input type='submit' style='display:none;'></label>";
		echo "</div>";
		echo "</form>";
		

		
?>
	</div>
<?php
mysqli_close($link);
?>
</body>
</html>