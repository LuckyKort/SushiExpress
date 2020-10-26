<?php
	session_start();
	header("Location: admin.php");
	include ("bd.php");
	$newusername=$_REQUEST['newusername'];
	$newuserpass=$_REQUEST['newuserpass'];
	$newusermail=$_REQUEST['newusermail'];
	$newuseradm=$_REQUEST['newuseradm'];
	$deluserid=$_REQUEST['deluserid'];
	$edituserid=$_REQUEST['edituserid'];
	$editusername=$_REQUEST['editusername'];
	$edituserpass=$_REQUEST['edituserpass'];
	$editusermail=$_REQUEST['editusermail'];
	$edituseradm=$_REQUEST['edituseradm'];
	$action=$_REQUEST['action'];
	
	if ($_SESSION['adm'] == 1) {
	if ($action=="newuser")
	{
		$newusermd5pass = md5($newuserpass);
		$sql="INSERT INTO users(login,password,email,adm) VALUES ('$newusername','$newusermd5pass','$newusermail','$newuseradm')";
		$r=mysql_query ($sql);
	}
	if ($action=="deluser")
	{
		$sql="DELETE FROM users WHERE id='$deluserid'";
		$r=mysql_query($sql);
	}
	if ($action=="edituser")
	{
		$editusermd5pass = md5($edituserpass);
		if ($edituserpass == '') {
			$sql="UPDATE users SET login='$editusername',email='$editusermail',adm='$edituseradm' WHERE id='$edituserid'";
		}else{
			$sql="UPDATE users SET login='$editusername',password='$editusermd5pass',email='$editusermail',adm='$edituseradm' WHERE id='$edituserid'";
		}
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