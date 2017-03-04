<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Обновить город</title>
  <link href="../../../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body>
  <header class="main-header">
    <h1 class="main-header__title">Тестовое задание для <span class="main-header__inter">ИНТЕР</span><span class="main-header__volga">ВОЛГИ</span></h1>
    <h1 class="main-header__author">Сделал Кветкин Владислав</h1>
  </header>

<?php

  include_once "../validate/validation.php";
  include_once "../help/help.php";

  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbName = "Intervolga";

  $table = "City";

  $link = mysqli_connect($hostname, $username, $password) or die ("Не удалось подключиться к базе данных!");   

  mysqli_select_db($link, $dbName) or die (mysqli_error($link));   

  // Проверяем есть ли такой город с таким id
  $query = "SELECT id FROM $table";
  $res = mysqli_query($link, $query) or die(mysqli_error($link));
  $cityIdArray = array();
  while ($row = mysqli_fetch_array($res)) {
    array_push($cityIdArray, $row['id']);
  }

  // Проверяем есть ли такая страна с таким id (защита от изменения value option)
  $query = "SELECT id FROM Country";
  $res = mysqli_query($link, $query) or die(mysqli_error($link));
  $countryIdArray = array();
  while ($row = mysqli_fetch_array($res)) {
    array_push($countryIdArray, $row['id']);
  }

  // Если отправили форму
  if (!empty($_POST["save-city"])) { 

    $id = intval( clean($_POST["update-id"]) );
	  $cityName = mb_ucfirst( clean($_POST['city-name']) );
    $cityMayor = makeFIO( clean($_POST['city-mayor']) );
    $cityPopulation = clean($_POST['city-population']);
    $cityDensity = clean($_POST['city-density']);
    $cityCountry = intval( clean($_POST["city-country"]) );

    $isValid = validateCity($cityName, $cityMayor, $cityPopulation, $cityDensity, $cityCountry, $countryIdArray);

    if ($isValid && in_array($id, $cityIdArray)) {
      $query = "UPDATE $table SET 
      name='$cityName',
      mayor='$cityMayor',
      population='$cityPopulation',
      density='$cityDensity',
      countryId='$cityCountry'
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
    $cityId = intval($_GET["id"]);
    // Проверяем не изменили ли GET-параметр id
    if (in_array($cityId, $cityIdArray)) {
      $query = "SELECT name, mayor, population, density, countryId FROM $table WHERE id='$cityId'";   
      $res = mysqli_query($link, $query) or die(mysqli_error($link));
      $row = mysqli_fetch_array($res);
	  } else {
      echo ("<div class=\"container\">
        <div class=\"alert alert-warning\" style=\"text-align: center; margin-top: 30px;\">
	     	<span>Что то не так с id города! Не меняйте GET-параметр!</span>
	     	<a href=\"../../index.php\">Вернуться на главную страницу!</a></div></div>");
      die();
    }
  }

?>

  <main class="jumbotron container">
    <h2 class="create-country__title text-center">Обновить город</h2>
    <form action="update-city.php" class="form-horizontal" method="post">
      <input name="update-id" type="hidden" value="<?php echo($cityId) ?>">
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="city-name">Название:</label>
        <div class="col-sm-10">
          <input class="form-control" id="city-name" name="city-name" placeholder="Название города..." type="text" value="<?php echo ($row['name']) ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="city-mayor">Мэр:</label>
        <div class="col-sm-10">
          <input class="form-control" id="city-mayor" name="city-mayor" placeholder="ФИО мэра..." type="text" value="<?php echo($row['mayor']) ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="city-population">Население (чел.):</label>
        <div class="col-sm-10">
          <input class="form-control" id="city-population" name="city-population" placeholder="Население города..." type="number" value="<?php echo($row['population']) ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="city-density">Плотность (чел/км<sup>2</sup>):</label>
        <div class="col-sm-10">
          <input class="form-control" id="city-density" name="city-density" placeholder="Плотность населения города..." step="any" type="number" value="<?php echo($row['density']) ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="country-language">Страна:</label>
        <div class="col-sm-10">
          <select class="form-control" id="city-country" name="city-country">
            <?php echo ( selectFromArray("Country", "id", "name", $row['countryId'], $link) )?>
          </select>
        </div>
      </div>
      <div class="form-submit">
        <button class="btn btn-default btn-submit" id="submit" name="save-city" onclick="validateCity(event)" type="submit" value="save">Обновить</button> <input class="btn btn-default" type="reset" value="Очистить">
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

