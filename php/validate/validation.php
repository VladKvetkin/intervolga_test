<?php

  // Разбивает фио на части, каждую часть делает с заглавной буквы, затем склеивает их и возвращает
  function makeFIO($fio) {
    $fio = explode(" ", $fio);
    $name = mb_ucfirst($fio[0]);
    $surname = mb_ucfirst($fio[1]);
    $patronymic = mb_ucfirst($fio[2]);

    return trim($name . " ". $surname . " " . $patronymic);
  }

  // Очищаем данные от не нужных символов
  function clean($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    
    return $value;
  }

  // Делает первую букву строки заглавной
  function mb_ucfirst($str) {
    $fc = mb_strtoupper(mb_substr($str, 0, 1));
    return $fc.mb_substr($str, 1);
  }

  function validateCountry($countryName, $countryPresident, $countryPopulation, $countryArea, $countryLanguage) {
    $isValid = true;

    if ( (preg_match("/^[a-zа-яё\-]+$/ui", $countryName) === 0) ||
      (preg_match("/^[a-zа-яё\-]+\s[a-zа-яё\-]+(\s[a-zа-яё\-]+)?$/ui", $countryPresident) === 0) ||
      (preg_match("/^[1-9](\d{1,9})?$/ui", $countryPopulation) === 0) ||
      (preg_match("/^[1-9](\d{1,7})?$/ui", $countryArea) === 0) ||
      (preg_match("/^[a-zа-яё]+$/ui", $countryLanguage) === 0) ) {

        $isValid = false;
        return $isValid;
    }

    return $isValid;
  }

  function validateCity($cityName, $cityMayor, $cityPopulation, $cityDensity, $cityCountry, $countryIdArray) {
    $isValid = true;

    if ( (preg_match("/^[a-zа-яё\-]+$/ui", $cityName) === 0) ||
      (preg_match("/^[a-zа-яё\-]+\s[a-zа-яё\-]+(\s[a-zа-яё\-]+)?$/ui", $cityMayor) === 0) ||
      (preg_match("/^[1-9](\d{1,7})?$/ui", $cityPopulation) === 0) ||
      (preg_match("/^\d+\.?(\d+)?$/ui", $cityDensity) === 0) ||
      (preg_match("/^\d+$/ui", $cityCountry) === 0) || 
      (in_array($cityCountry, $countryIdArray) === FALSE) )  {

        $isValid = false;
        return $isValid;
    }

    return $isValid;
  }

?>