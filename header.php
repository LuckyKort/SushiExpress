<?php
session_start();
$username=$_SESSION['login'];
?>
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
	<script src="js/jasny-bootstrap.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	<script src="jquery.js" type="text/javascript"></script>
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
	<div style="display: none;">
		<? print_r($_FILES );?>
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