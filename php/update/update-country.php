<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Обновить страну</title>
  <link rel="stylesheet" href="../../../../css/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <header class="main-header">
  	<h1 class="main-header__title">Тестовое задание для <span class="main-header__inter">ИНТЕР</span><span class="main-header__volga">ВОЛГИ</span></h1>
  	<h1 class="main-header__author">Сделал Кветкин Владислав</h1>
  </header>

<?php
  /*
    Удаляем страну.
    Перед этим проверяем GET-параметр id страны.
  */

  include_once "../validate/validation.php";

  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbName = "Intervolga";

  $table = "Country";

  $link = mysqli_connect($hostname, $username, $password) or die ("Не удалось подключиться к базе данных!");   

  mysqli_select_db($link, $dbName) or die (mysqli_error($link));   

  // Создаем массив id всех стран
  $query = "SELECT id FROM $table";
  $res = mysqli_query($link, $query) or die(mysqli_error($link));
  $idArray = array();
  while ($row = mysqli_fetch_array($res)) {
	  array_push($idArray, $row['id']);
  }

  if (!empty($_POST["save-country"])) { 

    $countryName = mb_ucfirst( clean($_POST["country-name"]) );
    $countryPresident = makeFIO( clean($_POST['country-president']) );	
    $countryPopulation = clean($_POST["country-population"]);
    $countryArea = clean($_POST["country-area"]);
    $countryLanguage = clean($_POST["country-language"]);
    $id = intval( clean($_POST["update-id"]) );

    $isValid = validateCountry($countryName, $countryPresident, $countryPopulation, $countryArea, $countryLanguage);

    if ($isValid && in_array($id, $idArray)){
      $query = "UPDATE $table SET 
      name='$countryName',
      president='$countryPresident',
      population='$countryPopulation',
      area='$countryArea',
      language='$countryLanguage'
      WHERE id='$id'";

      mysqli_query($link, $query) or die(mysqli_error($link));

      echo ("<div class=\"container\">
        <div class=\"alert alert-success\" style=\"text-align: center; margin-top: 30px;\">
	     	<span>Данные успешно обновлены!</span>
	     	<a href=\"../../index.php\">Вернуться на главную страницу!</a></div></div>"); 
      die();
    } else {
      echo ("<div class=\"container\">
        <div class=\"alert alert-warning\" style=\"text-align: center; margin-top: 30px;\">
	     	<span>Не удалось обновить данные!</span>
	     	<a href=\"../../index.php\">Вернуться на главную страницу!</a></div></div>");
      die();
    }
  } else {
    $countryId = intval($_GET["id"]);
    // Проверяем не изменили ли GET-параметр id
    if (in_array($countryId, $idArray)) {
      $query = "SELECT name, president, population, area, language FROM $table WHERE id='$countryId'";   
      $res = mysqli_query($link, $query) or die(mysqli_error($link));
      $row = mysqli_fetch_array($res);
    } else {
      echo ("<div class=\"container\">
        <div class=\"alert alert-warning\" style=\"text-align: center; margin-top: 30px;\">
	     	<span>Что то не так с id страны! Не меняйте GET-параметр!</span>
	     	<a href=\"../../index.php\">Вернуться на главную страницу!</a></div></div>");
      die();
    }
  }

?>

  <main class="jumbotron container">
    <h2 class="create-country__title text-center">Обновить страну</h2>
    <form action="update-country.php" class="form-horizontal" method="post">
      <input name="update-id" type="hidden" value="<?php echo($countryId) ?>">
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="country-name">Название:</label>
        <div class="col-sm-10">
          <input class="form-control" id="country-name" name="country-name" placeholder="Название страны..." type="text" value="<?php echo ($row['name']) ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="country-president">Президент:</label>
        <div class="col-sm-10">
          <input class="form-control" id="country-president" name="country-president" placeholder="ФИО президента..." type="text" value="<?php echo($row['president']) ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="country-population">Население (чел.):</label>
        <div class="col-sm-10">
          <input class="form-control" id="country-population" name="country-population" placeholder="Население страны..." type="number" value="<?php echo($row['population']) ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="country-area">Площадь (км<sup>2</sup>):</label>
        <div class="col-sm-10">
          <input class="form-control" id="country-area" name="country-area" placeholder="Площадь страны..." type="number" value="<?php echo($row['area']) ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="country-language">Официальный язык:</label>
        <div class="col-sm-10">
          <input class="form-control" id="country-language" name="country-language" placeholder="Официальный язык страны..." type="text" value="<?php echo($row['language']) ?>">
        </div>
      </div>
      <div class="form-submit">
        <button class="btn btn-default btn-submit" id="submit" name="save-country" onclick="validateCountry(event)" type="submit" value="save">Обновить</button> <input class="btn btn-default" type="reset" value="Очистить">
      </div>
    </form>
    <div class="row">
      <div class="col-xs-12 return-to-index">
        <a class="btn btn-success" href="../../index.php">Вернуться на главную страницу</a>
      </div>
    </div>
  </main>
  <script src="../../js/validation.js"></script> 
  <script src="../../js/jQuery/jquery-3.1.1.min.js"></script> 
  <script src="../../css/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

