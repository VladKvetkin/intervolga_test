<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Удалить страну</title>
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
    Удаляем даные о стране
    Но перед этим проверим, не изменил ли кто GET-параметр id города
  */

  include_once "../validate/validation.php";

  $hostname = "localhost"; 
  $username = "root"; 
  $password = "";
  $dbName = "Intervolga";   

  $table = "Country";   

  $link = mysqli_connect($hostname, $username, $password) or die ("Не удалось подключиться к базе данных!");

  mysqli_select_db($link, $dbName) or die (mysqli_error($link));   

  // Есть ли страна с таким id. Проверяем не изменили ли GET-параметр id.
  $query = "SELECT id FROM $table";
  $res = mysqli_query($link, $query) or die(mysqli_error($link));
  $idArray = array();
  while ($row = mysqli_fetch_array($res)) {
    array_push($idArray, $row['id']);
  }

  if (!empty($_GET["id"])) { 
    $id = intval( clean($_GET["id"]) );

    if (in_array($id, $idArray)) {
      $query = "DELETE FROM $table WHERE id=".$id;

      mysqli_query($link, $query) or die(mysqli_error($link));

      echo ("<div class=\"container\">
		 <div class=\"alert alert-success\" style=\"text-align: center; margin-top: 30px;\">
	     <span>Данные успешно удалены!</span>
	     <a href=\"../../index.php\">Вернуться на главную страницу!</a></div></div>"); 
      die();
	} else {
      echo ("<div class=\"container\">
		 <div class=\"alert alert-warning\" style=\"text-align: center; margin-top: 30px;\">
	     <span>Не удалось удалить данные!</span>
	     <a href=\"../../index.php\">Вернуться на главную страницу!</a></div></div>");
      die();
    }
  } else {
    echo ("<div class=\"container\">
		 <div class=\"alert alert-warning\" style=\"text-align: center; margin-top: 30px;\">
	     <span>Что то не так с id страны! Не меняйте GET-параметр!</span>
	     <a href=\"../../index.php\">Вернуться на главную страницу!</a></div></div>");
    die();
  }

?>