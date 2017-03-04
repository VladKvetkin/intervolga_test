<?php

  // Делает список стран в виде <option value="$opValue">$opStr</option>
  function selectFromArray($tableName, $opValue, $opStr, $countryId, $link) {
    $query = "SELECT $opValue, $opStr FROM $tableName";
    $res = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($res)) {
      $resultStr .= "<option ";
      if ($row[$opValue] === $countryId) {
        $resultStr .= "selected ";
      }

      $resultStr .= "value= \"$row[$opValue]\">$row[$opStr]</option>";
    }

    return $resultStr;
  }

?>