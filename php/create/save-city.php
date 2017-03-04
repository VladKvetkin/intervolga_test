<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Добавить город</title>
  <link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body>
  <header class="main-header">
    <h1 class="main-header__title">Тестовое задание для <span class="main-header__inter">ИНТЕР</span><span class="main-header__volga">ВОЛГИ</span></h1>
    <h1 class="main-header__author">Сделал Кветкин Владислав</h1>
  </header>
	
<?php 

  /*
   Сохраняем данные о городе в базу данных.
   Перед сохранением даннные проходят валидацию.
  */

  include_once "../validate/validation.php";

  $hostname = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $dbName = "Intervolga"; 
  $table = "City";   

  $link = mysqli_connect($hostname, $username, $password) or die ("Не удалось подключиться к базе данных!");   
  mysqli_select_db($link, $dbName) or die (mysqli_error($link));

  $cityName = mb_ucfirst( clean($_POST['city-name']) );
  $cityMayor = makeFIO( clean($_POST['city-mayor']) ); // Каждая часть ФИО начинается с заглавной буквы
  $cityPopulation = clean($_POST['city-population']);
  $cityDensity = clean($_POST['city-density']);
  $cityCountry = intval( clean($_POST["city-country"]) );

  // Проверяем есть ли страна с таким id (защита от изменения value option)
  // Создаем массив из id стран для последующей проверки
  $query = "SELECT id FROM Country";
  $res = mysqli_query($link, $query) or die(mysqli_error($link));
  $countryIdArray = array();
  while ($row = mysqli_fetch_array($res)) {
	  array_push($countryIdArray, $row['id']);
  }

  // Валидация данных
  $isValid = validateCity($cityName, $cityMayor, $cityPopulation, $cityDensity, $cityCountry, $countryIdArray);

  if ($isValid) {
    $query = "INSERT INTO $table SET 
      name='" .$cityName. "', 
      mayor='" .$cityMayor. "',
      population='" .$cityPopulation. "',
      density='" .$cityDensity. "',
      countryId='" .$cityCountry. "'"  
    ;

    mysqli_query($link, $query) or die(mysqli_error($link));  
    mysqli_close($link);

    echo ("<div class=\"container\"><div class=\"alert alert-success\" style=\"text-align: center; margin-top: 30px;\">
		<span>Данные успешно сохранены!</span>
		<a href=\"../../index.php\">Вернуться на главную страницу</a></div></div>");
	 
  } else {
    mysqli_close($link);

    echo ("<div class=\"container\"><div class=\"alert alert-warning\" style=\"text-align: center; margin-top: 30px;\">
		<span>Не удалось добавить город!</span>
		<a href=\"create-city.php\">Попробовать еще раз</a></div></div>"); 
  }

?> 
</body>
</html>