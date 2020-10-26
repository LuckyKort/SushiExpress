<!DOCTYPE html>
<html lang="ru">
<?include 'header.php';?>
<style>
	.col-md-3 {
		float: none;
	}
	</style>
    <div class="container">
		<center>
			<div class="col-md-3">
					<?php
						if    (empty($_SESSION['login'])) 
						{
						echo ("<div class='alert alert-danger'><strong>Ошибка!</strong> Вы не авторизованы</div><br><form action='/'><button class ='btn btn-danger btn-group' onlick='return false;'>Вернуться на главную страницу</button></form>");
						}else{
							unset($_SESSION['password']);
							unset($_SESSION['login']); 
							unset($_SESSION['id']);
							unset($_SESSION['adm']);
							unset($_SESSION['email']);
							unset($_SESSION['product_id']); 
							unset($_SESSION['product_price']); 
							unset($_SESSION['product_count']);
							unset($_SESSION['product_title']);
							$_SESSION['prod_count']=0; 
						exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
						}
					?>
				</div>
			</center>
        </div>
    </div>
    <?include 'footer.php';?>
</body>
</html>