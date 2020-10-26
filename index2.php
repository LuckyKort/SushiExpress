<?php

session_start();

$mysqli = mysqli_init();
if (!$mysqli) {
	die('mysqli_init завершилась провалом');
}

if (!$mysqli->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
	die('Установка MYSQLI_INIT_COMMAND завершилась провалом');
}

if (!$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
	die('Установка MYSQLI_OPT_CONNECT_TIMEOUT завершилась провалом');
}

if (!$mysqli->real_connect('localhost', 'id1053190_admin', '', 'id1053190_shop')) {
	die('Ошибка подключения (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

$mysqli->set_charset("utf8"); 

//Корзина началась
//Очистка корзины
if(isset($_POST['clear'])) {
	clear();    
	header("Location: ".$_SERVER['REQUEST_URI']);
}

//Добавление в корзину
if(isset($_POST['tocart'])) {
	addtocart($_POST['product_id'], $_POST['product_price'], $_POST['product_title']);  
	header("Location: ".$_SERVER['REQUEST_URI']);
}

//Удаление из корзины
if (isset($_POST['del_id'])) {
	remove_from_cart($_POST['del_id']);
	header("Location: ".$_SERVER['REQUEST_URI']);
}

//Обновление
if (isset($_POST['upd_id'])) {
	update_cart($_POST['p_count'], $_POST['upd_id']);
	header("Location: ".$_SERVER['REQUEST_URI']);
}

function addtocart($product_id, $product_price, $product_title) {
	$incart = -1;
	for ($i=0; $i < $_SESSION['prod_count']; $i++) {
		if ( $_SESSION['product_id'][$i] == $product_id ) {
			$incart = $i;
		}
	}
	if ( $incart == -1 ) {
		$_SESSION['prod_count']++;
		$incart=$_SESSION['prod_count'] - 1;
	}
	$_SESSION['product_id'][$incart] = $product_id;
	$_SESSION['product_price'][$incart] = $product_price;
	$_SESSION['product_title'][$incart] = $product_title;
	$_SESSION['product_count'][$incart] = $_SESSION['product_count'][$incart] + 1;
}

function update_cart($cnt, $update_key) 
	 { 
	 $_SESSION['product_count'][$update_key]=$cnt; 
	 update_cart_sum(); 
	 }

function remove_from_cart($delete_key) { 
	unset($_SESSION['product_id'][$delete_key]); 
	unset($_SESSION['product_price'][$delete_key]); 
	unset($_SESSION['product_count'][$delete_key]);
	unset($_SESSION['product_title'][$delete_key]);
	$_SESSION['prod_count']=$_SESSION['prod_count']-1; 
	sort($_SESSION['product_id']); 
	sort($_SESSION['product_price']); 
	sort($_SESSION['product_count']); 
	sort($_SESSION['product_title']);
	update_cart_sum(); 
}

function clear() { 
	unset($_SESSION['product_id']); 
	unset($_SESSION['product_price']); 
	unset($_SESSION['product_count']);
	unset($_SESSION['product_title']);
	$_SESSION['prod_count']=0; 
	update_cart_sum();
}

function update_cart_sum() { 
	$_SESSION['cart_sum']=0; 
	for ($i=0; $i<$_SESSION['prod_count']; $i++) { 
		$_SESSION['cart_sum']=$_SESSION['cart_sum'] + $_SESSION['product_price'][$i]* $_SESSION['product_count'][$i]; 
	} 
}

//Закончилась

$categories = array();
if ($result = $mysqli->query('SELECT * FROM categories')) {
	while($tmp = $result->fetch_assoc()) {
		$categories[] = $tmp;
	}
	$result->close();
}

include("bd.php");
$query = $_POST['query'];
if ((isset($query))) 
{
$qresult= mysql_query("SELECT * FROM `products` WHERE `title` LIKE '%$query%' ",$db);
if (mysql_num_rows($qresult) != 0) 
	{while ($row = mysql_fetch_assoc($qresult)) 
		{
		$_SESSION[searchids] .= $row[id] . ',';
		}
	}
}

$_SESSION[searchids] = substr($_SESSION[searchids], 0, -1);

$products = array();
if ( isset($_REQUEST['cat']) ) {
	$cat = (int) $_REQUEST['cat'];
} else {
	$cat = 0;
}

if ( isset($_REQUEST['page']) ) {
	$page = (int) $_REQUEST['page'];
} else {
	$page = 1;
}

if(empty($_SESSION[searchids])) {
$sql = 'SELECT * FROM products';
}else{
$sql = 'SELECT * FROM products WHERE id IN ('.$_SESSION[searchids].')';
}
if ($cat) {
	$sql .= ' WHERE  category=' . $cat ;
}
/*if ($page) {
	for ($i=0; $i<$page; $i++) {
	$sql .= ' LIMIT ($i-1), 6';
	}
}

если выбрана страница N 

$sql .= ' LIMIT ($i-1), 10';

*/
if ($result = $mysqli->query($sql)) {
	while($tmp = $result->fetch_assoc()) {
		$products[] = $tmp;
	}
	$result->close();
}
$mysqli->close();

$username=$_SESSION['login'];
?>
<!DOCTYPE html> 
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Суши Экспресс Уфа</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/shop-homepage.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic" rel="stylesheet" type="text/css" />
	<link href='https://fonts.googleapis.com/css?family=Russo+One&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<style>
		.price {
			font-family: 'PT Sans', serif;
			font-size: 14px;
		}
		.intro {
			margin-top: -10px;
			font-size: 11px;
		}
		.col-lg-12 {
		    position: inherit;
		}
		.thumbnail .caption {
			padding: 9px;
			color: #333;
			margin-top: -10px;
		}
	</style>
</head>
<body>
	<div style="display: none;">
	    <!--SESSION-->
		<? print_r($_SESSION);?>
	</div>
	<div style="display: none;">
		<!--GET-->
		<? print_r($_GET);?>
	</div>
	<div style="display: none;">
		 <!--REQUEST-->
		<? print_r($_REQUEST);?>
	</div>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<img src="logo.png" class="hidden-sm" style="margin-top: 5px;margin-right: 5px; margin-left: 5px;">
				<img src="logo.png" class="visible-sm" style="margin-top: 10px;margin-right: 5px; width: 160px;">
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
					<li class="active">
						<a href="/">Главная</a>
					</li>
					<li>
						<a href="/news.php">Новости</a>
					</li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Информация <b class="caret"></b></a>
					  <ul class="dropdown-menu" style="font-size: 14px;">
						<li><a href="/delivery.php">Доставка и оплата</a></li>
						<li><a href="/howto.php">Как заказать</a></li>
						<li><a href="/about.php">О магазине</a></li>
					  </ul>
					</li>
					<li>
						<a href="/gb.php">Гостевая книга</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="hidden-xs hidden-sm">
					<? if (empty($_SESSION['login']) or empty($_SESSION['id']))
									{?>
										<a href='#'><span class="hidden-xs hidden-sm glyphicon glyphicon-user"></span> Гость</a>
									<?}
								else
									{?>
										<a href='#'><span class="hidden-xs hidden-sm glyphicon glyphicon-user"></span> <?print $username;?></a>
									<?}
						?>
					</li>
					<li>
						<?php
							if ($_SESSION['adm'] == 1) {?>
								<a href="/admin.php"><span class="hidden-xs hidden-sm glyphicon glyphicon-dashboard"></span> Админпанель</a>
							<?}?>
					</li>
						<? if (empty($_SESSION['login']) or empty($_SESSION['id']))
									{?>
										<li><a href='/login.php'><span class="hidden-xs hidden-sm glyphicon glyphicon-log-in"></span> Вход</a></li>
										<li><a href='/register.php'><span class="hidden-xs hidden-sm glyphicon glyphicon-plus-sign"></span> Регистрация</a></li>
									<?}
								else
									{?>
										<li><a href='/logout.php'><span class="hidden-xs hidden-sm glyphicon glyphicon-log-out"></span> Выйти</a></li>
									<?}
						?>
				</ul>
			</div>
            </div>
        </div>
    </nav>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
			<p class="lead">Поиск товаров</p>
				<div class="list-group2">
					<script>
					function splash2()
					{
						if (document.form.query.value  =='')
							{
								alert ("Вы не ввели поисковый запрос!");
								form.query.focus();
								return false;	
							}
						
						return true;   
					}
					</script>
					<form action="/" method="post" name="form" onSubmit="return splash2();">
					<div class="input-group">
						<input type="text" class="form-control" name="query" placeholder="Что будем искать?" value="<? echo $_REQUEST['query'];?>">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">Поиск</button>
							</span>
					</div>
					</form>
					<?php
						include("bd.php");
						$query = $_POST['query'];
						if ((isset($query))) 
						{
							if (empty($_SESSION[searchids])) 
							{?>
							<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Ничего не найдено.</div>
							<?}
						}?>
				</div>
				<p class="lead">Категории товаров</p>
				<div class="list-group">
					<a href="/" class="list-group-item">Все товары</a>
					<?php
					foreach($categories AS $category) {
						echo ' <a href="?cat=' . $category['id'] . '" class="list-group-item">' . $category['title'] . '</a>';
					}
					?>
				</div>
				<p class="lead">Ваша корзина</p>
				<div class="list-group">
					<!--Корзина началась-->
					<?php
					for ($i=0; $i<$_SESSION['prod_count']; $i++) {
						$q="SELECT * FROM products WHERE id='".$_SESSION['product_id'][$i]."'";
						?>
						<div class="list-group-item">
							<center>
								<td><h4 style="margin-top: 2px;"><?php echo $_SESSION['product_title'][$i]?></h4></td>	
									<label>
									<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="POST">
									<div class="input-group input-group-sm">
										<span class="input-group-addon hidden-md">Количество: </span>
										<input type="text" class="form-control" size="3" maxlength="2" value="<?php echo htmlspecialchars($_SESSION['product_count'][$i]);?>" name="p_count">
										<input type="hidden" value="<?php echo $i;?>" name="upd_id"/>
										<div class="input-group-btn">
											<button type="submit" class="btn btn-default bnt">Обновить</button>
										</div>
									</div>
									</form>
									</label>
									<label style="position: absolute; top: 10px; right: 10px;">
									<form action="<?php echo $_SERVER[‘REQUEST_URI’]?>" method="POST">
											<input type="hidden" value="<?php echo $i;?>" name="del_id" />
											<button type="submit" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
									</form>
									</label>
									<form>
										<td nowrap>Цена: <?php echo $_SESSION['product_price'][$i];?> |  </td>
										<td nowrap>Сумма: <?php echo $summ = $_SESSION['product_price'][$i]* $_SESSION['product_count'][$i];?></td>
									</form>
							</center>
						</div>
						<?php
						}
						$sum = 0;
						for ($i=0; $i<$_SESSION['prod_count']; $i++) {
							$sum += $_SESSION['product_price'][$i] * $_SESSION['product_count'][$i];
						}
						?>
				<!--Закончилась-->
			</div>
			<center>
					<div class="btn-group">
					  <button type="button" class="btn btn-warning">Сумма: <?echo"$sum"?> руб.</button>
					  <div class="btn-group">
						<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
							Меню
							<span class="caret"></span>
						  </button>
						<ul class="dropdown-menu">
							<li>
								<form id="form2" name="form2" method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
									<input type="hidden" name="clear" />
									<a onclick="document.getElementById('form2').submit(); return false;"><span class="glyphicon glyphicon-remove-sign"></span> Очистить корзину</a>
								</form>
							</li>
								<? if (empty($_SESSION['login']) or empty($_SESSION['id']))
									{
										?>
										<li class="disabled"><a><span class="glyphicon glyphicon-ok-sign"></span> Оформить заказ</a></li>
										<?
									}
								else
									{
										?>
										<form id="form3" name="form3" method="post" action="/cartconfirm.php">
											<input type="hidden" name="user" value="<?php echo $_SESSION['login']?>" />
											<input type="hidden" name="summa" value="<?php echo $sum?>" />
											<input type="hidden" name="count" value="<?php echo $_SESSION['prod_count']?>" />
											<input type="hidden" name="count2" value="<?php echo $_SESSION['product_count']?>" />
											<input type="hidden" name="ids" value="
											<?php 
											$ids = 0;
												for ($i=0; $i<$_SESSION['prod_count']; $i++) {
													$ids = $_SESSION['product_id'][$i].':'.$_SESSION['product_count'][$i].',';
												echo $ids;
												}
											?>
											" />
											<input type="hidden" name="titles" value="
											<?php 
											$titles = 0;
												for ($i=0; $i<$_SESSION['prod_count']; $i++) {
													$titles = $_SESSION['product_title'][$i].' '.$_SESSION['product_count'][$i].' шт., ';
												echo $titles;
												}
											?>
											" />
											<li><a onclick="document.form3.submit(); return false;" type="submit" name="Submit"><span class="glyphicon glyphicon-ok-sign"></span> Оформить заказ</a></li>
											</form>
										<?
										}
										?>
						</ul>
					  </div>
					</div>
					<br><br>
					<? if (empty($_SESSION['login']) or empty($_SESSION['id']))
						{
							echo"<div class='well well-sm' style='font-size: 12px;'>Оформление заказа доступно только после авторизации.</div>";
						}
					?> <br><br>
			</center>
		</div>
		<div class="col-md-9">
			<div class="row carousel-holder">
                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators" style="bottom: -10px;">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="/action.png" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="/60min.png" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="/inors.png" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" style="width:1%; background: rgba(255, 255, 255, 0);" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" style="width:1%; background: rgba(255, 255, 255, 0);" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>
			<div class="row">
				<?php foreach($products AS $product) {?>
				<div class="col-sm-4 col-lg-4 col-md-4">
					<div class="thumbnail">
						<?php
						if ($_SESSION['adm'] == 1) { ?>
						<button class="btn btn-xs btn-warning hidden-xs" style="position: absolute; right: 28px; bottom: 133px;"><span style="font-family:Verdana;"><?php echo $product['price'];?> &#8381;</span></button>
						<button class="btn btn-xs btn-warning visible-xs" style="position: absolute; right: 28px; bottom: 113px;"><span style="font-family:Verdana;"><?php echo $product['price'];?> &#8381;</span></button>
						<?}else{?>
						<button class="btn btn-xs btn-warning hidden-xs" style="position: absolute; right: 28px; bottom: 101px;"><span style="font-family:Verdana;"><?php echo $product['price'];?> &#8381;</span></button>
						<button class="btn btn-xs btn-warning visible-xs" style="position: absolute; right: 28px; bottom: 79px;"><span style="font-family:Verdana;"><?php echo $product['price'];?> &#8381;</span></button>
						<?}?>
						<img src="<?php echo $product['img'];?>" alt="">
						<div class="caption">
							<h4><?php echo $product['title'];?></h4>
							<p class="intro" style="color: #777;"><?php echo $product['intro'];?></p>
							<!--Кнопка началась-->
							<center>
								<!--Добавление в корзину-->
								<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
									<input type="hidden" name="product_price" value="<?php echo $product['price']?>" />
									<input type="hidden" name="product_id" value="<?php echo $product['id']?>" />
									<input type="hidden" name="product_title" value="<?php echo $product['title']?>" />
									<input type="hidden" name="tocart" value="tocart" />
									<button type="submit" name="Submit" class="btn btn-sm btn-success btn-block"><span class="glyphicon glyphicon-shopping-cart"></span> Добавить в корзину</button>
								</form>
								<!--Редактирование-->
								<?php
								if ($_SESSION['adm'] == 1) { ?>
								<table cellspacing="10" cellpadding="10" width="100%" style="margin-top:10px;">
								<tr>
								<td>
								<form action='/editprod.php' method="post">
									<input type="hidden" name="editid" value="<?php echo $product['id']?>">
									<input type="hidden" name="edittitle" value="<?php echo $product['title']?>">
									<input type="hidden" name="editprice" value="<?php echo $product['price']?>">
									<input type="hidden" name="editintro" value="<?php echo $product['intro']?>">
									<input type="hidden" name="editimg" value="<?php echo $product['img']?>">
									<input type="hidden" name="editcategory" value="<?php echo $product['category']?>">
									<button type='submit' name='Submit' class='btn btn-xs btn-primary btn-block' onlick='return false;'><span class='glyphicon glyphicon-pencil'></span> Изменить</button>
								</form>
								</td>
								<td>
								<div style="width:7px;"></div>
								</td>
								<td>
								<!--Удаление-->
								<script>
									function splash()
									{
										if (confirm("Вы действительно хотите удалить этот товар?"))
											{
												return true;	
											}
										
										return false;   
									}
								</script>
								<form action='/del_prod.php' method="post" onSubmit="return splash();">
									<input type="hidden" name="delid" value="<?php echo $product['id']?>">
									<input type="hidden" name="deltitle" value="<?php echo $product['title']?>">
									<button type='submit' name='Submit' class='btn btn-xs btn-danger btn-block' onlick='return false;'><span class='glyphicon glyphicon-remove'></span> Удалить</button>
								</form> 
								</td>
								</tr>
								</table>
								<?}?>
							</center>
							<!--Закончилась-->
						</div>
					</div>
				</div>
				<?php } 
				unset($_SESSION[searchids]);?>
	</div>
</div>
<div class="container">
	<hr><hr>
	<footer>
		<div class="row">
			<div class="col-lg-12">
				<p>Copyright &copy; Юрий Истомин 2016</p>
			</div>
		</div>
	</footer>
</div>
</body>
</html>