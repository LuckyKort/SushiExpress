<?php
	session_start();
	header("Location: admin.php");
	include ("bd.php");
	$completeid=$_REQUEST['completeid'];
	$action=$_REQUEST['action'];
	
	if ($_SESSION['adm'] == 1) {
	if ($action=="complete")
	{
		$sql="UPDATE cart SET completed='1' WHERE id='$completeid'";
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