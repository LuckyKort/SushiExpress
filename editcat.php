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
						<h1>Редактирование категории</h1>
					</div>
					<?if ($_SESSION['adm'] == 1) {
					ob_start(); 
					?>
					<script>
					function splash()
					{
						if (document.form1.catedittitle.value  =='')
							{
								alert ("Введите название категории!");
								return false;	
							}
						
						return true;   
					}
					</script>
					<?
					$editcatid = $_REQUEST['editcatid'];
					$catedittitle = $_REQUEST['catedittitle'];
					?>
					<form name="form1" action="cat.php" method="post" onSubmit="return splash();">
						<input type="hidden" name="action" value="editcat">
						<input type="hidden" name="editcatid" value="<?php echo $editcatid; ?>">
								<div class="form-group">
									<label>Новое название категории:</label>
									<input type="text" class="form-control" name="catedittitle" value="<?php echo $catedittitle?>" />
								</div>		
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