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
						<h1>Ответ на сообщение</h1>
					</div>
					<?if ($_SESSION['adm'] == 1) {
					ob_start(); 
					?>
					<script>
					function splash()
					{
						if (document.form1.answer.value  =='')
							{
								alert ("Заполните текст ответа!");
								return false;	
							}
						
						return true;   
					}
					</script>
					<?
					$answid = $_REQUEST['answid'];
					$username = $_POST['username'];
					$msg = $_POST['msg'];
					?>
					<div class="panel panel-default">
					  <div class="panel-heading">Ваш ответ на сообщение пользователя <? echo $username;?>:</div>
					  <div class="panel-body">
						<? echo $msg;?>
					  </div>
					</div>
					<form name="form1" action="save_gb.php" method="post" onSubmit="return splash();">
						<input type="hidden" name="action" value="answer">
						<input type="hidden" name="answid" value="<?php echo $answid; ?>">
						<input type="hidden" name="msg" value="<?php echo $msg; ?>">
								<div class="form-group">
									<textarea class="form-control" rows="4" style="resize: vertical;" name="answer"></textarea>
								</div>	
							<input type="submit" class="btn btn-success" value="Отправить сообщение">
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