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
					<h1>Редактирование</small></h1>
				</div>
				<?if ($_SESSION['adm'] == 1) {?>
					<?php
						if (isset($_POST['edittitle'])) { $edittitle = $_POST['edittitle']; if ($edittitle == '') { unset($edittitle);} }
						if (isset($_POST['editprice'])) { $editprice = $_POST['editprice']; if ($editprice == '') { unset($editprice);} }
						if (isset($_POST['editintro'])) { $editintro = $_POST['editintro']; if ($editintro == '') { unset($editintro);} }
						if (isset($_POST['editimg'])) { $editimg = $_POST['editimg']; if ($editimg == '') { unset($editimg);} }
						if (isset($_POST['editcategory'])) { $editcategory = $_POST['editcategory']; if ($editcategory == '') { unset($editcategory);} }
						if (isset($_POST['editid'])) { $editid = $_POST['editid']; if ($editid == '') { unset($editid);} }
						if (isset($_POST['edithit'])) { $edithit = $_POST['edithit']; if ($edithit == '') { unset($edithit);} }
					if (empty($edittitle)) 
						{
							echo ("<div class='alert alert-warning'><strong>Внимание! </strong>Вы не выбрали товар для редактирования.</div><form action='/'><button class ='btn btn-success btn-group' onlick='return false;'>Вернуться назад</button></form>");
						}else{
							ob_start();
							?>	
								<script>
								function splash()
								{
									if (document.form3.edittitle.value  =='')
										{
											alert ("Введите название продукта!");
											form3.edittitle.focus();
											return false;	
										}
										
									if (document.form3.editprice.value  =='')
										{
											alert ("Введите цену продукта!");
											form3.editprice.focus();
											return false;	
										}
									
									if (document.form3.editintro.value  =='')
										{
											alert ("Введите описание продукта!");
											form3.editintro.focus();
											return false;	
										}
										
									if (document.form3.editcategory.selectedIndex == 0 )
										{
											alert ("Укажите категорию товара!");
											form3.editcategory.focus();
											return false;	
										}
									
									return true;  									
								}
								</script>
								<form id="form3" name="form3" method="post" action="/save_editprod.php" enctype="multipart/form-data" onSubmit="return splash();">
									<div class="input-group">
										<span class="input-group-addon">Название:</span>
										<input type="text" class="form-control" name="edittitle" value="<?php echo $edittitle?>" />
									</div><br>
									<div class="input-group">
										<span class="input-group-addon">Цена:</span>
										<input type="number" class="form-control" name="editprice" value="<?php echo $editprice?>" />
										<span class="input-group-addon">Руб.</span>
									</div><br>
									<div class="input-group">
										<span class="input-group-addon">Описание:</span>
										<input type="text" class="form-control" name="editintro" value="<?php echo $editintro?>" />
									</div><br>
									<div class='well well-sm' style='font-size: 12px;'>
									Выберите новое изображение товара, или оставьте поле пустым, если хотите оставить прежнее изображение.<br><br>
									<input type="hidden" name="oldpic" value="<?php echo $editimg?>" />
									<input type="file" name="file" id="file" accept="image/jpeg,image/png">
									</div>
									<?
									$con = mysql_connect("localhost","id1053190_admin","");
									$db = mysql_select_db("id1053190_shop",$con);
									mysql_query("SET CHARACTER SET utf8 ");
									$get=mysql_query("SELECT id,title FROM categories");?>
									<div class="form-group">	
										<label>Категория:</label>
										<select name="editcategory" class="form-control"> 
										<option name="editcategory" value="0">Выберите категорию</option>
											<?php
												while($row = mysql_fetch_assoc($get))
												{
												if ($editcategory == $row['id']) {
												?>
												<option name="editcategory" selected="selected" value = "<?php echo($row['id'])?>" ><?php echo($row['title']) ?></option>
												<?php
												} else {
												?>
												<option name="editcategory" value = "<?php echo($row['id'])?>" ><?php echo($row['title']) ?></option>
												<?php
												}
												}												
											?>
										</select>
									</div>
									<input type="checkbox" name="edithit" value="1" <?if ($edithit == 1) {?>checked <?}?> >
									Хит продаж<br><br>
									<input type="hidden" name="editid" value="<?php echo $editid?>">
									<button type='submit' name='Submit' class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Сохранить изменения</button>
								</form>
							<?}?>
					<?}else{?>
						<div class='alert alert-danger'>У вас нет прав на просмотр этой страницы.</div>
						<?}?>
				</div>
			</center>
    </div>
    <?include 'footer.php';?>
</body>
</html>