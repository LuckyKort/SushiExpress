<!DOCTYPE html>
<html lang="ru">
<?include 'header.php';?>
	<style>
	.col-md-4 {
		float: none;
	}
	</style>
    <div class="container">
					<center>
            <div class="col-md-4">
				<div class="page-header">
					<h1>Админ-панель</small></h1>
				</div>
					<?php
					if ($_SESSION['adm'] == 1) {
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
								if (isset($_POST['addtitle'])) { $addtitle = $_POST['addtitle']; if ($addtitle == '') { unset($addtitle);} }
								if (isset($_POST['addprice'])) { $addprice = $_POST['addprice']; if ($addprice == '') { unset($addprice);} }
								if (isset($_POST['addintro'])) { $addintro = $_POST['addintro']; if ($addintro == '') { unset($addintro);} }
								$addimg = "img/" . $_FILES["file"]["name"];
								if (isset($_POST['addcategory'])) { $addcategory = $_POST['addcategory']; if ($addcategory == '') { unset($addcategory);} }
								if (empty($addtitle) or empty($addprice) or empty($addintro) or empty($addimg) or empty($addcategory)) 
								{
									echo ("<div class='alert alert-warning'><strong>Внимание! </strong>Вы ввели не всю информацию. Вернитесь назад и заполните все поля!</div><form action='/admin.php'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>");
								} else {
								include ("bd.php");
								$result = mysql_query("SELECT id FROM products WHERE title='$addtitle'",$db);
								$myrow = mysql_fetch_array($result);
									if (!empty($myrow['id'])) {
										exit ("<div class='alert alert-warning'>Извините, такой товар уже сущевсвтует. </div><form action='/admin.php'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>");
									} else {
										$result2 = mysql_query ("INSERT INTO products (title,img,intro,price,category) VALUES('$addtitle','$addimg','$addintro','$addprice','$addcategory')");
										if ($result2=='TRUE')
											{
												echo "<div class='alert alert-success'>Товар добавлен!</div><br> <form action='/'><button class ='btn btn-success btn-group' onlick='return false;'>Переидти на главную страницу</button></form><br>";
											}
										else {
											echo "<div class='alert alert-danger'><strong>Ошибка! </strong>Товар не добавлен.</div><form action='/admin.php'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>";
											}
										}
									}
								}
								}
							  }
							else
							  {
							  echo "<div class='alert alert-danger'><strong>Ошибка! </strong>Неверный тип файла.</div><form action='/admin.php'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>";
							  }
						}else{ 
							echo"<div class='alert alert-danger'><strong>Внимание! </strong>У вас нет прав на просмотр этой страницы.</div><br><form action='/'><button class ='btn btn-success btn-group' onlick='return false;'>Переидти на главную страницу</button></form>"; 
						}
					
					?>
				</div>
			</center>
    </div>
    <?include 'footer.php';?>
</body>
</html>