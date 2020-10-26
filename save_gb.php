<?php
	session_start();
	header("Location: gb.php");
	include ("bd.php");
	$username=$_REQUEST['username'];
	$msg=$_REQUEST['msg'];
	$action=$_REQUEST['action'];
	$delid=$_REQUEST['delid'];
	$answid=$_REQUEST['answid'];
	$msg=$_REQUEST['msg'];
	$answer=$_REQUEST['answer'];
	
	if ($action=="add")
	{
		$sql="INSERT INTO gb(username, msg) VALUES ('$username', '$msg')";
		$r=mysql_query ($sql);
	}
	if ($_SESSION['adm'] == 1) {
	if ($action=="delete")
	{
		$sql="DELETE FROM gb WHERE id='$delid'";
		$r=mysql_query($sql);
	}
	if ($action=="answer")
	{
		$sql="UPDATE gb SET msg=CONCAT('$msg','<br><b>Ответ администратора:</b><br>','$answer') WHERE id='$answid'";
		$r=mysql_query($sql);
	}
	}else{ 
		echo"<div class='alert alert-danger'><strong>Внимание! </strong>У вас нет прав на просмотр этой страницы.</div><br><form action='/'><button class ='btn btn-success btn-group' onlick='return false;'>Переидти на главную страницу</button></form>"; 
	}
?>
<div style="display: none;">
	    <!--SESSION-->
		<? print_r($_SESSION);?>
	</div>
	<div style="display: none;">
		<!--GET-->
		<? print_r($_GET);?>
	</div>
	<div style="display: none;">
		 <!--REQUEST-->
		<? print_r($_REQUEST);?>
	</div>