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
					if ($_SESSION['adm'] == 1) 
						{
							$canupd = 0;
							if ($_FILES['file']['size'] > 0)  {
							if (($_FILES["file"]["type"] == "image/gif")
							|| ($_FILES["file"]["type"] == "image/jpeg")
							|| ($_FILES["file"]["type"] == "image/png"))
							{
								if ($_FILES["file"]["error"] > 0)
									{
									?>
									<div class='alert alert-danger'>
									<strong>Возвращена ошибка: </strong><b><? echo $_FILES["file"]["error"] ?></b>
									</div>
									<form action="/editprod.php" method="post">
									<input type="hidden" name="editid" value="<?php echo $_POST['editid']?>">
									<input type="hidden" name="edittitle" value="<?php echo $_POST['edittitle']?>">
									<input type="hidden" name="editprice" value="<?php echo $_POST['editprice']?>">
									<input type="hidden" name="editintro" value="<?php echo $POST['editintro']?>">
									<input type="hidden" name="editimg" value="<?php echo $_POST['oldpic']?>">
									<input type="hidden" name="editcategory" value="<?php echo $_POST['editcategory']?>">
									<button type="submit" class ="btn btn-success btn-group" onlick="return false;">Вернуться назад</button>
									</form>
									<?
									}
								else
									{
										if (file_exists("img/" . $_FILES["file"]["name"]))
										{
											?>
											<div class='alert alert-danger'>
											<strong>Ошибка! </strong> Файл <b><? echo $_FILES["file"]["name"] ?></b> уже загружен.
											</div>
											<form action="/editprod.php" method="post">
											<input type="hidden" name="editid" value="<?php echo $_POST['editid']?>">
											<input type="hidden" name="edittitle" value="<?php echo $_POST['edittitle']?>">
											<input type="hidden" name="editprice" value="<?php echo $_POST['editprice']?>">
											<input type="hidden" name="editintro" value="<?php echo $_POST['editintro']?>">
											<input type="hidden" name="editimg" value="<?php echo $_FILES["file"]['name']?>">
											<input type="hidden" name="editcategory" value="<?php echo $_POST['editcategory']?>">
											<button type="submit" class ="btn btn-success btn-group" onlick="return false;">Вернуться назад</button>
											</form>
											<?
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
							?>
								<div class="alert alert-danger">
								<strong>Внимание! </strong> Неверный тип файла
								</div>
								<form action="/editprod.php" method="post">
								<input type="hidden" name="editid" value="<?php echo $_POST['editid']?>">
								<input type="hidden" name="edittitle" value="<?php echo $_POST['edittitle']?>">
								<input type="hidden" name="editprice" value="<?php echo $_POST['editprice']?>">
								<input type="hidden" name="editintro" value="<?php echo $_POST['editintro']?>">
								<input type="hidden" name="editimg" value="<?php echo $_POST['oldpic']?>">
								<input type="hidden" name="editcategory" value="<?php echo $_POST['editcategory']?>">
								<button type="submit" class ="btn btn-success btn-group" onlick="return false;">Вернуться назад</button>
								</form>
							<?
							}
						}
					
					if ($canupd == 0) {
						if (isset($_POST['edittitle'])) { $edittitle = $_POST['edittitle']; if ($edittitle == '') { unset($edittitle);} }
						if (isset($_POST['editprice'])) { $editprice = $_POST['editprice']; if ($editprice == '') { unset($editprice);} }
						if (isset($_POST['editintro'])) { $editintro = $_POST['editintro']; if ($editintro == '') { unset($editintro);} }
						if (isset($_POST['editcategory'])) { $editcategory = $_POST['editcategory']; if ($editcategory == '') { unset($editcategory);} }
						if (isset($_POST['editid'])) { $editid = $_POST['editid']; if ($editid == '') { unset($editid);} }
						if (isset($_POST['edithit'])) { $edithit = $_POST['edithit']; if ($edithit == '') { unset($edithit);} }
						if (empty($edittitle) or empty($editprice) or empty($editintro) or empty($editcategory)) 
						{
							?>
								<div class="alert alert-warning">
								<strong>Внимание! </strong>Вы ввели не всю информацию. Вернитесь назад и заполните все поля!
								</div>
								<form action="/editprod.php" method="post">
								<input type="hidden" name="editid" value="<?php echo $product["id"]?>">
								<input type="hidden" name="edittitle" value="<?php echo $edittitle?>">
								<input type="hidden" name="editprice" value="<?php echo $editprice?>">
								<input type="hidden" name="editintro" value="<?php echo $editintro?>">
								<input type="hidden" name="editimg" value="<?php echo $_POST['oldpic']?>">
								<input type="hidden" name="editcategory" value="<?php echo $editcategory?>">
								<input type="hidden" name="edithit" value="<?php echo $edithit?>">
								<button type="submit" class ="btn btn-success btn-group" onlick="return false;">Вернуться назад</button>
								</form>
							<?
							} else {
								$edittitle = stripslashes($edittitle);
								$edittitle = htmlspecialchars($edittitle);
								$editprice = stripslashes($editprice);
								$editprice = htmlspecialchars($editprice);
								$editintro = stripslashes($editintro);
								$editimg = stripslashes($editimg);
								$editimg = htmlspecialchars($editimg);
								$editcategory = stripslashes($editcategory);
								$editcategory = htmlspecialchars($editcategory);
								$edittitle = trim($edittitle);
								$editprice = trim($editprice);
								$editintro = trim($editintro);
								$editimg = trim($editimg);
								$editcategory = trim($editcategory);
								include ("bd.php");
								if (empty($editimg)) {
									$editimg = $_POST["oldpic"];
								}
								$result2 = mysql_query ("UPDATE products SET title='$edittitle', img='$editimg',intro='$editintro',price='$editprice',category='$editcategory',hit='$edithit' WHERE id='$editid'");
								if ($result2=='TRUE')
									{
										echo "<div class='alert alert-success'>Товар отредактирован!</div><br> <form action='/'><button class ='btn btn-success btn-group' onlick='return false;'>Переидти на главную страницу</button></form><br>";
									} else {
										echo "<div class='alert alert-danger'><strong>Ошибка! </strong>Товар не отредактирован.</div><form action='/'><button class ='btn btn-success btn-group' onlick='return false;'>Переидти на главную страницу</button></form>";
									}
								}
							}
						} else { 
						echo"<div class='alert alert-danger'><strong>Внимание! </strong>У вас нет прав на просмотр этой страницы.</div><br><form action='/'><button class ='btn btn-success btn-group' onlick='return false;'>Переидти на главную страницу</button></form>"; 
						}
					?>
				</div>
			</center>
    </div>
    <?include 'footer.php';?>
</body>
</html>