<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Добавить страну</title>
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
    Сохраняем данные о стране в базу данных.
    Перед сохранением даннные проходят валидацию.
  */

  include_once "../validate/validation.php";

  $hostname = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $dbName = "Intervolga"; 
  $table = "Country";   

  $link = mysqli_connect($hostname, $username, $password) or die ("Не удалось подключиться к базе данных!");   
  mysqli_select_db($link, $dbName) or die (mysqli_error($link));

  $countryName = mb_ucfirst( clean($_POST['country-name']) );
  $countryPresident = makeFIO( clean($_POST['country-president']) ); // Каждая часть ФИО начинается с заглавной буквы
  $countryPopulation = clean($_POST['country-population']);
  $countryArea = clean($_POST['country-area']);
  $countryLanguage = clean($_POST['country-language']);

  $isValid = validateCountry($countryName, $countryPresident, $countryPopulation, $countryArea, $countryLanguage);

  if ($isValid) {
    $query = "INSERT INTO $table SET 
      name='" .$countryName. "', 
      president='" .$countryPresident. "',
      population='" .$countryPopulation. "',
      area='" .$countryArea. "',
      language='" .$countryLanguage. "'"  
    ;

    mysqli_query($link, $query) or die(mysqli_error($link));  
    mysqli_close($link);

    echo ("<div class=\"container\"><div class=\"alert alert-success\" style=\"text-align: center; margin-top: 30px;\"> 
		<span>Данные успешно сохранены!</span>   
		<a href=\"../../index.php\">Вернуться на главную страницу</a></div></div>");
	 
  } else {
    mysqli_close($link);

    echo ("<div class=\"container\"><div class=\"alert alert-warning\" style=\"text-align: center; margin-top: 30px;\">
		<span>Не удалось добавить страну!</span>
		<a href=\"create-country.html\">Попробовать еще раз</a></div></div>"); 
}

?> 
</body>
</html>