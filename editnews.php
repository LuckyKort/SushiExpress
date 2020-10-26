<!DOCTYPE html>
<html lang="ru">
<?include 'header.php';?>
	<style>
	.col-md-6 {
		float: none;
	}
	</style>
    <div class="container">
		<center>
			<div class="col-md-6">
					<div class="page-header">
						<h1>Редактирование новости</h1>
					</div>
					<?if ($_SESSION['adm'] == 1) {
					ob_start(); 
					?>
					<script>
					function splash()
					{
						if (document.form1.edittitle.value  =='')
							{
								alert ("Введите заголовок!");
								return false;	
							}
						if (document.form1.editmsg.value  =='')
							{
								alert ("Введите текст новости!");
								return false;	
							}
						
						return true;   
					}
					</script>
					<?
					$editid = $_REQUEST['editid'];
					$editmsg = $_REQUEST['editmsg'];
					$edittitle = $_REQUEST['edittitle'];
					$editimg = $_REQUEST['editimg'];
					?>
					<form name="form1" action="save_news.php" method="post" onSubmit="return splash();" enctype="multipart/form-data">
						<input type="hidden" name="action" value="edit">
						<input type="hidden" name="editid" value="<?php echo $editid; ?>">
								<div class="form-group">
									<label>Заголовок новости:</label>
									<input type="text" class="form-control" name="edittitle" value="<?php echo $edittitle?>" />
								</div>	
								<div class="form-group">
									<label>Текст новости:</label>
									<textarea type="text" class="form-control" rows="7" style="resize: vertical;" name="editmsg"><?php echo htmlspecialchars($editmsg); ?></textarea>
								</div>
								<div class='well well-sm' style='font-size: 12px;'>
								Выберите новое изображение новости, или оставьте поле пустым, если хотите оставить прежнее изображение.<br><br>
								<input type="hidden" name="oldpic" value="<?php echo $editimg?>" />
								<input type="file" name="file" id="file" accept="image/jpeg,image/png">
								</div>
							<button type='submit' name='Submit' class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Сохранить изменения</button>
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