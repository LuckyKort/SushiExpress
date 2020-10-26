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
						<h1>Редактирование пользователя</h1>
					</div>
					<?if ($_SESSION['adm'] == 1) {
					ob_start(); 
					?>
					<script>
					function splash()
					{
						if (document.form1.editusername.value  =='')
							{
								alert ("Введите новое имя пользователя!");
								return false;	
							}
						if (document.form1.editusermail.value  =='')
							{
								alert ("Введите новый e-mail пользователя!");
								return false;	
							}
						
						return true;   
					}
					</script>
					<?
					$edituserid=$_REQUEST['edituserid'];
					$editusername=$_REQUEST['editusername'];
					$edituserpass=$_REQUEST['edituserpass'];
					$editusermail=$_REQUEST['editusermail'];
					$edituseradm=$_REQUEST['edituseradm'];
					?>
					<form name="form1" action="user.php" method="post" onSubmit="return splash();">
						<input type="hidden" name="action" value="edituser">
						<input type="hidden" name="edituserid" value="<?php echo $edituserid; ?>">
								<div class="form-group">
									<label>Новое имя пользователя:</label>
									<input type="text" class="form-control" name="editusername" value="<?php echo $editusername?>" />
								</div>	
								<div class="form-group">
									<label>Новый пароль пользователя:</label>
									<input type="password" class="form-control" name="edituserpass" value="<?php echo $edituserpass?>" />
								</div>
								<div class="form-group">
									<label>Новый email пользователя:</label>
									<input type="text" class="form-control" name="editusermail" value="<?php echo $editusermail?>" />
								</div>
								<input type="checkbox" name="edituseradm" value="1" <?if ($edituseradm == 1) {?>checked <?}?> >
									Администратор<br><br>								
							<input type="submit" class="btn btn-success" value="Сохранить">
						</form>
					<br>
					<?
					echo ob_get_clean();
					?>
					<?}else{ 
						echo"<div class='alert alert-danger'>У вас нет прав на просмотр этой страницы.</div>"; 
					}?>
			</div>
		</center>
    </div>
    <?include 'footer.php';?>
</body>
</html>