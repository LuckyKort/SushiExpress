<?php
	if (($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/pjpeg"))
		  {
		  if ($_FILES["file"]["error"] > 0)
			{
			echo "Возвращена ошибка: " . $_FILES["file"]["error"] . "<br />";
			?>
			<a href="/admin.php"><button>Вернуться назад</button></a>
			<?
			die();
			}
		  else
			{
			if (file_exists("img/" . $_FILES["file"]["name"]))
			  {
			  echo $_FILES["file"]["name"] . " уже загружен. ";
			  ?>
				<a href="/admin.php"><button>Вернуться назад</button></a>
				<?
				die();
			  }
			else
			  {
			  move_uploaded_file($_FILES["file"]["tmp_name"],
			  "img/" . $_FILES["file"]["name"]);
			  }
			}
		  }
		else
		  {
		  echo "Неверный файл";
		  ?>
		  <a href="/admin.php"><button>Вернуться назад</button></a>
		  <?
		  die();
		  }
	if (isset($_POST['addtitle'])) { $addtitle = $_POST['addtitle']; if ($addtitle == '') { unset($addtitle);} }
	if (isset($_POST['addprice'])) { $addprice = $_POST['addprice']; if ($addprice == '') { unset($addprice);} }
	if (isset($_POST['addintro'])) { $addintro = $_POST['addintro']; if ($addintro == '') { unset($addintro);} }
	if (isset($_POST['addimg'])) { $addimg = $_POST['addimg']; if ($addimg == '') { unset($addimg);} }
	if (isset($_POST['addcategory'])) { $addcategory = $_POST['addcategory']; if ($addcategory == '') { unset($addcategory);} }
?> 
<form id="hidden" method="post" action="/save_prod.php">
	<input type="hidden" name="addtitle" value="<?php echo $addtitle?>">
	<input type="hidden" name="addprice" value="<?php echo $addprice?>">
	<input type="hidden" name="addintro" value="<?php echo $addintro?>">
	<input type="hidden" name="addimg" value="<?php echo "img/" . $_FILES["file"]["name"];?>">
	<input type="hidden" name="addcategory" value="<?php echo $addcategory?>">
</form>
<script>hidden.submit();</script>
