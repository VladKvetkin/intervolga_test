<?php
  /*
   Выбираем все страны для селекта
  */

  include_once "../help/help.php";

  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbName = "Intervolga";

  $table = "Country";

  $link = mysqli_connect($hostname, $username, $password) or die ("Не удалось подключиться к базе данных!");   

  mysqli_select_db($link, $dbName) or die (mysqli_error($link)); 

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Добавить город</title>
  <link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body>
  <header class="main-header">
    <h1 class="main-header__title">Тестовое задание для <span class="main-header__inter">ИНТЕР</span><span class="main-header__volga">ВОЛГИ</span></h1>
    <h1 class="main-header__author">Сделал Кветкин Владислав</h1>
  </header>
  <main class="jumbotron container">
    <h2 class="create-city__title text-center">Добавить город</h2>
    <form action="save-city.php" class="form-horizontal" method="post">
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="city-name">Название:</label>
        <div class="col-sm-10">
          <input class="form-control" id="city-name" name="city-name" placeholder="Название города..." type="text">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="city-mayor">Мэр:</label>
        <div class="col-sm-10">
          <input class="form-control" id="city-mayor" name="city-mayor" placeholder="ФИО мэра..." type="text">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="city-population">Население (чел.):</label>
        <div class="col-sm-10">
          <input class="form-control" id="city-population" name="city-population" placeholder="Население города..." type="number">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="city-density">Плотность (чел/км<sup>2</sup>):</label>
        <div class="col-sm-10">
          <input class="form-control" id="city-density" name="city-density" placeholder="Плотность населения города..." type="number" step="any">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label col-sm-2 control-label" for="city-country">Страна:</label>
        <div class="col-sm-10">
          <select class="form-control" id="city-country" name="city-country">
            <?php echo ( selectFromArray($table, "id", "name", 1, $link) ) ?>
          </select>
        </div>
      </div>
      <div class="form-submit">
        <button class="btn btn-default btn-submit" id="submit" onclick="validateCity(event)" type="submit">Отправить</button>
        <input class="btn btn-default" type="reset" value="Очистить">
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