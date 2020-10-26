<?php
	session_start();
	header("Location: news.php");
	include ("bd.php");
	$username=$_REQUEST['username'];
	$msg=$_REQUEST['msg'];
	$msgtitle=$_REQUEST['msgtitle'];
	$action=$_REQUEST['action'];
	$delid=$_REQUEST['delid'];
	$editid=$_REQUEST['editid'];
	$editmsg=$_REQUEST['editmsg'];
	$edittitle=$_REQUEST['edittitle'];
	$editimg=$_REQUEST['editimg'];
	
	if ($_SESSION['adm'] == 1) {
	if ($action=="add")
	{
		if (($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/png"))
			{
				if ($_FILES["file"]["error"] > 0)
				{
				echo "<div class='alert alert-danger'><strong>Возвращена ошибка: </strong><b>".$_FILES["file"]["error"]."</b></div><form action='/admin.php'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>";
				}
				else
				{
					if (file_exists("img/" . $_FILES["file"]["name"]))
						{
							echo "<div class='alert alert-danger'><strong>Ошибка! </strong> Файл <b>".$_FILES["file"]["name"]."</b> уже загружен</div><form action='/admin.php'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>";
						}
					else
						{
						move_uploaded_file($_FILES["file"]["tmp_name"],
						"img/" . $_FILES["file"]["name"]);
						$img = "img/" . $_FILES["file"]["name"];
						$sql="INSERT INTO news(username, date, msg, title, img) VALUES ('$username', NOW(), '$msg', '$msgtitle', '$img')";
						$r=mysql_query ($sql);
						}
				}
			}
			else
			{
			echo "<div class='alert alert-danger'><strong>Ошибка! </strong>Неверный тип файла.</div><form action='/admin.php'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>";
			}
	}
	if ($action=="delete")
	{
		$sql="DELETE FROM news WHERE id='$delid'";
		$r=mysql_query($sql);
	}
	if ($action=="edit")
	{
		$canupd = 0;
		if ($_FILES['file']['size'] > 0)  {
		if (($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/png"))
			{
				if ($_FILES["file"]["error"] > 0)
				{
				echo "<div class='alert alert-danger'><strong>Возвращена ошибка: </strong><b>".$_FILES["file"]["error"]."</b></div><form action='/editnews.php'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>";
				}
				else
				{
					if (file_exists("img/" . $_FILES["file"]["name"]))
						{
							echo "<div class='alert alert-danger'><strong>Ошибка! </strong> Файл <b>".$_FILES["file"]["name"]."</b> уже загружен</div><form action='/admin.php'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>";
						}
					else
						{
						move_uploaded_file($_FILES["file"]["tmp_name"],
						"img/" . $_FILES["file"]["name"]);
						$editimg = "img/" . $_FILES["file"]["name"];
						$canupd = 0;
						}
				}
			}
			else
			{
			$canupd = 1;
			echo "<div class='alert alert-danger'><strong>Ошибка! </strong>Неверный тип файла.</div><form action='/admin.php'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>";
			}
		}
		if ($canupd == 0) {
			if (empty($editimg)) {
				$editimg = $_POST["oldpic"];
				}
				$sql="UPDATE news SET msg='$editmsg', title='$edittitle', img='$editimg' WHERE id='$editid'";
				$r=mysql_query($sql);
		}
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