 "use strict";

// Спрашиваем у пользователя, действительно ли он хочет удалить страну
 function deleteCountry(event) {
      var answer = confirm("Вы уверены, что хотите удалить страну? Если да, то вместе с ней КАСКАДНО удаляться и все города. Подумайте...");

      if (!answer) {
        event.preventDefault();
      }
}