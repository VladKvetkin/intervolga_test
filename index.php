<?php

  /*
    Подключаемся к базе данных, выбираем таблицы Страны и Города
    Выводим информацию в html таблицы
  */

  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbName = "Intervolga";

  $tableCountry = "Country";
  $tableCity = "City";

  $link = mysqli_connect($hostname, $username, $password) or die ("Не удалось подключиться к базе данных!");

  mysqli_select_db($link, $dbName) or die (mysqli_error($link));

  $queryCountry = "SELECT id, name, president, population, area, language FROM $tableCountry";
  $queryCity = "SELECT id, name, mayor, population, density, countryId FROM $tableCity";

  $resCountry = mysqli_query($link, $queryCountry) or die(mysqli_error($link));
  $resCity = mysqli_query($link, $queryCity) or die(mysqli_error($link));

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Тестовое задание ИНТЕРВОЛГА</title>
  <link href="css/tableSorter/style.css" rel="stylesheet">
  <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <header class="main-header">
    <h1 class="main-header__title">Тестовое задание для <span class="main-header__inter">ИНТЕР</span><span class="main-header__volga">ВОЛГИ</span></h1>
    <h1 class="main-header__author">Сделал Кветкин Владислав</h1>
  </header>
  <main class="container">
    <div class="countries row">
      <div class="col-md-12">
        <table class="tablesorter table table-bordered table-hover" id="table-countries">
          <caption class="table__caption">
            Таблица "Страны"
          </caption>
          <thead>
            <tr>
              <th>Название</th>
              <th>Президент</th>
              <th>Население (чел.)</th>
              <th>Площадь (км<sup>2</sup>)</th>
              <th>Официальный язык</th>
              <th>Редактирование</th>
              <th class="warning">Удаление</th>
            </tr>
          </thead>
          <tbody>
          	<?php
              while ($row = mysqli_fetch_array($resCountry)) {
                echo ("<tr>");
                echo ("<td>".$row['name']."</td>");
                echo ("<td>".$row['president']."</td>");
                echo ("<td>".$row['population']."</td>");
                echo ("<td>".$row['area']."</td>");
                echo ("<td>".$row['language']."</td>");
                echo ("<td>"."<a class=\"btn btn-primary\" href=\"php/update/update-country.php?id=".$row['id']."\">Обновить</a></td>");
                echo ("<td class=\"warning\">"."<a onclick=\"deleteCountry(event)\" class=\"btn btn-danger\" href=\"php/delete/delete-country.php?id=".$row['id']."\">Удалить</a></td>");
                echo ("</tr>");
              }
            ?>
          </tbody>
        </table>
      </div>
      <div class="create-country col-md-12">
        <a class="btn btn-success" href="php/create/create-country.html">Добавить страну</a>
      </div>
    </div>
    <div class="cities row">
      <div class="col-md-12">
        <table class="tablesorter table table-bordered table-hover" id="table-cities">
          <caption class="table__caption">
            Таблица "Города"
          </caption>
          <thead>
            <tr>
              <th>Название</th>
              <th>Мэр</th>
              <th>Население</th>
              <th>Плотность</th>
              <th>Страна</th>
              <th>Редактирование</th>
              <th class="warning">Удаление</th>
            </tr>
          </thead>
          <tbody>
          	<?php
              while ($row = mysqli_fetch_array($resCity)) {
                // Вместо id страны, в столбце будет ее название
                $queryCountryName = "SELECT name FROM $tableCountry WHERE id=".$row['countryId'];
                $resCountryName = mysqli_query($link, $queryCountryName) or die(mysqli_error($link));
                $countryName = mysqli_fetch_array($resCountryName)["name"];
                echo ("<tr>");
                echo ("<td>".$row['name']."</td>");
                echo ("<td>".$row['mayor']."</td>");
                echo ("<td>".$row['population']."</td>");
                echo ("<td>".$row['density']."</td>");
                echo ("<td>".$countryName."</td>");
                echo ("<td>"."<a class=\"btn btn-primary\" href=\"php/update/update-city.php?id=".$row['id']."\">Обновить</a></td>");
                echo ("<td class=\"warning\">"."<a class=\"btn btn-danger\" href=\"php/delete/delete-city.php?id=".$row['id']."\">Удалить</a></td>");
                echo ("</tr>");
              }

              mysqli_close($link);
            ?>
          </tbody>
        </table>
      </div>
      <div class="create-city col-md-12">
        <a class="btn btn-success" href="php/create/create-city.php">Добавить город</a>
      </div>
    </div>
  </main>
  <script src="js/deleteCountry.js"></script>
  <script src="js/jQuery/jquery-3.1.1.min.js"></script>
  <script src="js/jQuery/jquery.tablesorter.min.js"></script>
  <script src="css/bootstrap/js/bootstrap.min.js"></script>
  <script>
    // Скрипт для сортировки таблиц
    $(document).ready(function() {
      $("#table-countries").tablesorter();
      $("#table-cities").tablesorter();
    });
  </script>
</body>
</html>
