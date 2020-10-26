<?php
	session_start();
	header("Location: admin.php");
	include ("bd.php");
	$newcattitle=$_REQUEST['newcattitle'];
	$delcatid=$_REQUEST['delcatid'];
	$editcatid=$_REQUEST['editcatid'];
	$catedittitle=$_REQUEST['catedittitle'];
	$action=$_REQUEST['action'];
	
	if ($_SESSION['adm'] == 1) {
	if ($action=="newcat")
	{
		$sql="INSERT INTO categories(title) VALUES ('$newcattitle')";
		$r=mysql_query ($sql);
	}
	if ($action=="delcat")
	{
		$sql="DELETE FROM categories WHERE id='$delcatid'";
		$r=mysql_query($sql);
	}
	if ($action=="editcat")
	{
		$sql="UPDATE categories SET title='$catedittitle' WHERE id='$editcatid'";
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