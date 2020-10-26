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
						<h1>Удаление</h1>
					</div>
					<?php
						if ($_SESSION['adm'] == 1) {
							if (isset($_POST['deltitle'])) { 
								$deltitle = $_POST['deltitle'];
								}
							if (isset($_POST['delid'])) { 
								$delid = $_POST['delid'];
								}
							if (empty($_POST['deltitle']) or empty($_POST['delid'])) 
							{
								exit ("<div class='alert alert-warning'><strong>Внимание! </strong>Вы выбрали товар для удаления!</div><form action='/'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>");
							}else{
							echo"<div class='alert alert-warning'>Товар<strong> «"; print $deltitle;	echo"» </strong>удалён.</div>";
							echo"<form action='/'><button class ='btn btn-success btn-group' onlick='return false;'>Переидти на главную страницу</button></form>";
							include ("bd.php");
							$result = mysql_query("DELETE FROM products WHERE id='$delid'",$db);
							}
						}else{ 
							echo"<div class='alert alert-danger'><strong>Внимание! </strong>У вас нет прав на просмотр этой страницы.</div><br><form action='/'><button class ='btn btn-success btn-group' onlick='return false;'>Переидти на главную страницу</button></form>"; 
						}
					?>
				</div>
			</center>
        </div>
    </div>
    <?include 'footer.php';?>
</body>
</html>