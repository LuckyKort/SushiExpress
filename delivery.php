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

function update_cart_sum() { 
	$_SESSION['cart_sum']=0; 
	for ($i=0; $i<$_SESSION['prod_count']; $i++) { 
		$_SESSION['cart_sum']=$_SESSION['cart_sum'] + $_SESSION['product_price'][$i]* $_SESSION['product_count'][$i]; 
	} 
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
}

//Закончилась

$categories = array();
if ($result = $mysqli->query('SELECT * FROM categories')) {
	while($tmp = $result->fetch_assoc()) {
		$categories[] = $tmp;
	}
	$result->close();
}

$products = array();
$cat = isset($_REQUEST['cat']) ? (int) $_REQUEST['cat'] : 0;
$sql = 'SELECT p.* FROM products AS p ';
if ($cat) {
	$sql .= ' INNER JOIN products AS cp ON cp.id=p.id AND cp.category=' . $cat;
}
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
		}
		.header_logo {
			font-family: 'Russo One', sans-serif;
			color: white;
			float: left;
			height: 50px;
			padding: 14px 15px;
			font-size: 25px;
			line-height: 20px;
			list-style-type: none;
			cursor: default;
		}
		.col-lg-12 {
		    position: inherit;
		}
	</style>
</head>
<body>
	<div style="display: none;">
		<? print_r($_SESSION);?>
	</div>
	<div style="display: none;">
		<? print_r($_GET);?>
	</div>
	<div style="display: none;">
		<? print_r($_REQUEST);?>
	</div>
	<div style="display: none;">
		<? print_r($_SERVER );?>
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
					<li>
						<a href="/">Главная</a>
					</li>
					<li>
						<a href="/news.php">Новости</a>
					</li>
					<li class="dropdown active">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Информация <b class="caret"></b></a>
					  <ul class="dropdown-menu" style="font-size: 14px;">
						<li class="active"><a href="/delivery.php">Доставка и оплата</a></li>
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
				<p class="lead">Категории товаров</p>
				<div class="list-group">
					<a href="/" class="list-group-item">Все товары</a>
					<?php
					foreach($categories AS $category) {
						echo ' <a href="/?cat=' . $category['id'] . '" class="list-group-item">' . $category['title'] . '</a>';
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
										<span class="input-group-addon">Количество: </span>
										<input type="text" class="form-control" size="3" maxlength="2" value="<?php echo htmlspecialchars($_SESSION['product_count'][$i]);?>" name="p_count">
										<input type="hidden" value="<?php echo $i;?>" name="upd_id"/>
										<div class="input-group-btn">
											<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span></button>
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
									<a onclick="document.getElementById('form2').submit(); return false;"><span class="glyphicon glyphicon-share"></span> Очистить корзину</a>
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
											<li><a onclick="document.getElementById('form3').submit(); return false;" type="submit" name="Submit"><span class="glyphicon glyphicon-ok-sign"></span> Оформить заказ</a></li>
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
		<div class="col-md-8">
		<div class="row">
			  <div class="col-sm-15 col-md-15">
				<div class="thumbnail">
				  <img src="/delivery.png" alt="...">
				  <div class="caption">
					<h4>Условия доставки</h4>
					Бесплатно доставим вам роллы на дом и в офис.
					<br>Каждый заказ готовится только после поступления, доставка осуществляется в специальных фирменных красных термосумках с нашим логотипом.<br>
					<br><h4>Оплата заказа</h4>
					Оплатить заказ вы сможете наличными курьеру, либо банковской картой. 
					<br>При оплате банковской картой обязательно предупредите об этом оператора, чтобы курьер приехал к вам с терминалом для оплаты. Мы принимаем к оплате банковские карты VISA и MasterCard, а также обязательно требуем ввода цифровой подписи владельца (PIN-кода карты).
					<br><b>Внимание! Перед оплатой заказа мы просим вас обязательно его проверить - это займет 2-3 минуты.</b> Распакуйте заказ и посмотрите - все ли из того, что вы заказали, вам привезли. Если чего-то не будет хватать, сообщите об этом курьеру, он свяжется с оператором или администратором нашего ресторана и они уже будут разбираться в вашем случае. 
					<br>После оплаты заказа претензии по его количественному содержанию мы не принимаем.<br>
					<br><h4>Стоимость доставки</h4>
					Доставка бесплатная, при условии суммы заказа более 700 рублей. 
					<br>В случае заказа на сумму меньшую суммы для бесплатной доставки, стоимость доставки составит 100 рублей, для районов ДОК и ИНОРС - 200 рублей.
				  </div>
				</div>
			  </div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<hr>
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