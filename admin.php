<!DOCTYPE html>
<html lang="ru">
<?include 'header.php';?>
    <div class="container">
	<center><div class="page-header">
		<h1>Админпанель</h1>
	</div>
		<div class="row">
		<?if ($_SESSION['adm'] == 1) {?>
			<div class="col-md-4">
				<div class="panel panel-default">
				<script>
					function splash()
					{
						if (document.prod.addtitle.value  =='')
							{
								alert ("Введите название продукта!");
								prod.addtitle.focus();
								return false;	
							}
							
						if (document.prod.addprice.value  =='')
							{
								alert ("Введите цену продукта!");
								prod.addprice.focus();
								return false;	
							}
						
						if (document.prod.addintro.value  =='')
							{
								alert ("Введите описание продукта!");
								prod.addintro.focus();
								return false;	
							}
						
						if (document.prod.file.value  =='')
							{
								alert ("Выберите изображение товара!");
								prod.file.focus();
								return false;	
							}
						
						if ( document.prod.addcategory.selectedIndex == 0 )
							{
								alert ("Укажите категорию товара!");
								prod.addcategory.focus();
								return false;	
							}
						
						return true;   
					}
					</script>
				<div class="panel-heading">Добавление товара</div>
					  <div class="panel-body">
					<form name="prod" action="save_prod.php" method="post" enctype="multipart/form-data" onSubmit="return splash();">
						<div class="input-group">
							<span class="input-group-addon">Название: </span>
							<input name="addtitle" type="text" class="form-control" placeholder="Введите название">
						</div><br>
						<div class="input-group">
							<span class="input-group-addon">Цена: </span>
							<input name="addprice" type="number" class="form-control" placeholder="Введите цену">
							<span class="input-group-addon">Руб.</span>
						</div><br>
						<div class="input-group">
							<span class="input-group-addon">Информация: </span>
							<input name="addintro" type="text" class="form-control" placeholder="Введите информацию">
						</div><br>
						<div class="panel panel-default">
						  <div class="panel-heading">Выберите изображение товара</div>
						  <div class="panel-body">
						<input type="file" name="file" id="file" accept="image/jpeg,image/png">
						</div>
						</div>
						<?
						$con = mysql_connect("localhost","id1053190_admin","");
						$db = mysql_select_db("id1053190_shop",$con);
						mysql_query("SET CHARACTER SET utf8 ");
						$get=mysql_query("SELECT id,title FROM categories");?>
							<div class="form-group">	
								<label for="sel1">Категория:</label>
								<select name="addcategory" class="form-control">
								<option name="addcategory" value="0">Выберите категорию</option>
								<?php
									while($row = mysql_fetch_assoc($get))
									{
									?>
									<option name="addcategory" value = "<?php echo($row['id'])?>" ><?php echo($row['title']) ?></option>
									<?php
									}               
								?>
								</select>
							</div>
						<button type="submit" name="submit" class ="btn btn-success btn-group">Добавить товар</button>
					</form>
					</div>
					</div>
			</div>
			
			<div class="col-md-4">
			<div class="panel panel-default">
				<script>
					function splash2()
					{
						if (document.news.msgtitle.value  =='')
							{
								alert ("Введите название новости!");
								news.msgtitle.focus();
								return false;	
							}
							
						if (document.news.file.value  =='')
							{
								alert ("Укажите изображение новости!");
								news.file.focus();
								return false;	
							}
						
						if (document.news.msg.value  =='')
							{
								alert ("Введите текст новости!");
								news.msg.focus();
								return false;	
							}

						return true;   
					}
					</script>
				  <div class="panel-heading">Добавление новости</div>
				  <div class="panel-body">
					<form name="news" action="save_news.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="action" value="add">
					<input type="hidden" name="username" value="<?php echo $_SESSION['login']?>">
					<div class="input-group">
					<span class="input-group-addon">Заголовок: </span>
					<input name="msgtitle" type="text" class="form-control" placeholder="Введите заголовок">
					</div><br>
					<div class="panel panel-default">
						  <div class="panel-heading">Выберите изображение новости</div>
						  <div class="panel-body">
					<input type="file" name="file" id="file" accept="image/jpeg,image/png,image/gif">
					</div>
					</div>
					<label>Текст новости:</label>
					<div class="form-group">
						<textarea class="form-control" name="msg" rows="7" style="resize: vertical;" placeholder="Введите текст новости"></textarea>
					</div>
					<input type="submit" onClick="return splash2();" class="btn btn-success" value="Опубликовать новость">
					</form>
					</div>
			</div>
		</div>
			<div class="col-md-4">
			<div class="panel panel-default">
				<script>
					function splash3()
					{
						if (document.cat.newcattitle.value  =='')
							{
								alert ("Введите название категории!");
								cat.newcattitle.focus();
								return false;	
							}
							
						return true;   
					}
					
					function splash4()
					{
						if (confirm("Вы действительно хотите удалить эту категорию?"))
							{
								return true;	
							}
						
						return false;   
					}
					</script>
				  <div class="panel-heading">Управление категориями</div>
				  <div class="panel-body">
					<form name="cat" action="cat.php" method="post">
					<input type="hidden" name="action" value="newcat">
					<div class="input-group">
						<span class="input-group-addon">Добавление: </span>
					<input name="newcattitle" type="text" class="form-control" placeholder="Введите название">
					</div><br>
					<input type="submit" onClick="return splash3();" class="btn btn-success" value="Добавить категорию">
					</form><br><label>Все категории:</label>
						<?
						$con = mysql_connect("localhost","id1053190_admin","");
						$db = mysql_select_db("id1053190_shop",$con);
						mysql_query("SET CHARACTER SET utf8 ");
						$get=mysql_query("SELECT id,title FROM categories");?>
						<ul class="list-group">
						<?php
						while($row = mysql_fetch_assoc($get))
						{
						?>
						<li class="list-group-item"><?php echo($row['title']) ?> <span class="badge">ID: <?php echo($row['id'])?></span>
						<form name="editcat" action="editcat.php" method="post">
							<input type="hidden" name="editcatid" value="<?php echo($row['id'])?>">
							<input type="hidden" name="catedittitle" value="<?php echo($row['title'])?>">
							<input type="hidden" name="action" value="editcat">
							<button type="submit" style="position: absolute; top: 25%; left: 40px;" class="btn btn-xs btn-warning">
						<span class="glyphicon glyphicon-edit"></span>
						</button>
						</form>
						<form name="delcat" action="cat.php" method="post">
						<input type="hidden" name="delcatid" value="<?php echo($row['id'])?>">
						<input type="hidden" name="action" value="delcat">
						<button type="submit" style="position: absolute; top: 25%; left: 10px;" onClick="return splash4();" class="btn btn-xs btn-danger">
						<span class="glyphicon glyphicon-remove"></span>
						</button>
						</form>
						</li>
						<?php
						}               
						?>
						</ul>
					</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<script>					
					function splash5()
					{
						if (confirm("Вы действительно хотите отметить заказ как выполненный?"))
							{
								return true;	
							}
						
						return false;   
					}
					</script>
				  <div class="panel-heading">Управление заказами</div>
				  <div class="panel-body">
						<?
						$con = mysql_connect("localhost","id1053190_admin","");
						$db = mysql_select_db("id1053190_shop",$con);
						mysql_query("SET CHARACTER SET utf8 ");
						$get=mysql_query("SELECT id,user,summ,adress,phone,completed,titles FROM cart");?>
						<ul class="list-group">
						<?php
						while($row = mysql_fetch_assoc($get))
						{
						?>
						<li class="list-group-item <?if ($row['completed'] == 1) {?>list-group-item-success <?}?> >"><b>Заказчик: </b><?php echo($row['user']) ?> <b>Адрес: </b> <?php echo($row['adress']) ?> <b>Телефон: </b> <?php echo($row['phone']) ?> <br> <b>Заказ: </b> <?php echo($row['titles']) ?> <br> <b>Сумма заказа: </b><?php echo($row['summ']) ?> Руб.
						<form name="completecart" action="completecart.php" method="post">
							<input type="hidden" name="completeid" value="<?php echo($row['id'])?>">
							<input type="hidden" name="action" value="complete">
							<?if ($row['completed'] == 0) {?><button type="submit" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-ok"></span> Заказ доставлен / Завершить заказ</button><?}?>
						</form>						
						</li>
						<?php
						}               
						?>
						</ul>
					</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<script>
					function splash6()
					{
						if (document.user.newusername.value  =='')
							{
								alert ("Введите имя пользователя!");
								user.newusername.focus();
								return false;	
							}
						
						if (document.user.newuserpass.value  =='')
							{
								alert ("Введите пароль пользователя!");
								user.newuserpass.focus();
								return false;	
							}
							
						if (document.user.newusermail.value  =='')
							{
								alert ("Введите e-mail пользователя!");
								user.newusermail.focus();
								return false;	
							}
						return true;   
					}
					
					function splash7()
					{
						if (confirm("Вы действительно хотите удалить этого пользователя?"))
							{
								return true;	
							}
						
						return false;   
					}
					</script>
				  <div class="panel-heading">Управление пользователями</div>
				  <div class="panel-body">
					<form name="user" action="user.php" method="post">
					<input type="hidden" name="action" value="newuser">
					<label>Добавление пользователя:</label>
					<div class="input-group">
					<span class="input-group-addon">Логин: </span>
					<input name="newusername" type="text" class="form-control" placeholder="Введите логин">
					</div><br>
					<div class="input-group">
					<span class="input-group-addon">Пароль: </span>
					<input name="newuserpass" type="password" class="form-control" placeholder="Введите пароль">
					</div><br>
					<div class="input-group">
					<span class="input-group-addon">E-Mail: </span>
					<input name="newusermail" type="text" class="form-control" placeholder="Введите e-mail">
					</div><br>
					<input type="checkbox" name="newuseradm" value="1" >
					Администратор<br><br>
					<input type="submit" onClick="return splash6();" class="btn btn-success" value="Добавить пользователя">
					</form><br><label>Все пользователи:</label>
						<?
						$con = mysql_connect("localhost","id1053190_admin","");
						$db = mysql_select_db("id1053190_shop",$con);
						mysql_query("SET CHARACTER SET utf8 ");
						$get=mysql_query("SELECT id,login,password,email,adm FROM users");?>
						<ul class="list-group">
						<?php
						while($row = mysql_fetch_assoc($get))
						{
						?>
						<li class="list-group-item"><?php echo($row['login']) ?> <span class="badge">ID: <?php echo($row['id'])?></span>
						<form name="edituser" action="edituser.php" method="post">
							<input type="hidden" name="edituserid" value="<?php echo($row['id'])?>">
							<input type="hidden" name="editusername" value="<?php echo($row['login'])?>">
							<input type="hidden" name="editusermail" value="<?php echo($row['email'])?>">
							<input type="hidden" name="edituseradm" value="<?php echo($row['adm'])?>">
							<input type="hidden" name="oldpassword" value="<?php echo($row['password'])?>">
							<input type="hidden" name="action" value="edituser">
							<button type="submit" style="position: absolute; top: 25%; left: 40px;" class="btn btn-xs btn-warning">
						<span class="glyphicon glyphicon-edit"></span>
						</button>
						</form>
						
						<form name="deluser" action="user.php" method="post">
						<input type="hidden" name="deluserid" value="<?php echo($row['id'])?>">
						<input type="hidden" name="action" value="deluser">
						<button type="submit" style="position: absolute; top: 25%; left: 10px;" onClick="return splash7();" class="btn btn-xs btn-danger">
						<span class="glyphicon glyphicon-remove"></span>
						</button>
						</form>
						
						</li>
						<?php
						}               
						?>
						</ul>
					</div>
			</div>
		</div>
		
		<?}else{ 
			echo"<div class='alert alert-danger'>У вас нет прав на просмотр этой страницы.</div>"; 
		}?>
    </div></center>
    <?include 'footer.php';?>
</body>
</html>