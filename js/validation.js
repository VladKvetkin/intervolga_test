"use strict"

function createMessage(parent, text) {
	var message = document.createElement("span");
	message.classList.add("help-block");
	message.textContent = text;
	parent.appendChild(message);
}

function removeMessage(parent) {
	if (parent.lastChild.className == "help-block") {
		parent.removeChild(parent.lastChild);
	}
}

function validateCountry(event) {
	var isValid = true;

	var formGroups = document.querySelectorAll(".form-group");

	var form = document.querySelector("form");
	var formElements = form.elements;

	var countryName = formElements["country-name"];
	var countryPresident = formElements["country-president"];
	var countryPopulation = formElements["country-population"];
	var countryArea = formElements["country-area"];
	var countryLanguage = formElements["country-language"];


	formGroups[0].classList.remove("has-error");
	removeMessage(countryName.parentNode);
	countryName.value = countryName.value.trim()
	if (countryName.value.match(/^[a-zа-яё\-]+$/i) == null) {
		var text = "Название страны может включать только буквы и знак -. Пожалуйста, введите его корректно.";
		formGroups[0].classList.add("has-error");
		createMessage(countryName.parentNode, text);
		isValid = false;
	}

	formGroups[1].classList.remove("has-error");
	removeMessage(countryPresident.parentNode);
	countryPresident.value = countryPresident.value.trim()
	if (countryPresident.value.match(/^[a-zа-яё\-]+\s[a-zа-яё\-]+(\s[a-zа-яё\-]+)?$/i) == null) {
		var text = "ФИО президента может включать в себя буквы и знак -, пишется через пробелы. Пример: 'Иванов Иван Иванович'. Пожалуйста, введите его корректно.";
		formGroups[1].classList.add("has-error");
		createMessage(countryPresident.parentNode, text);
		isValid = false;
	}

	formGroups[2].classList.remove("has-error");
	removeMessage(countryPopulation.parentNode);
	if ( (countryPopulation.value.match(/^[1-9](\d{1,9})?$/i) == null) || (countryPopulation.value > 1339450000) ) {
		var text = "Население страны это целое число от 1 до 1 339 450 000(население Китая). Пожалуйста, введите его корректно.";
		formGroups[2].classList.add("has-error");
		createMessage(countryPopulation.parentNode, text);
		isValid = false;
	}

	formGroups[3].classList.remove("has-error");
	removeMessage(countryArea.parentNode);
	if ( (countryArea.value.match(/^[1-9](\d{1,7})?$/i) == null) || (countryArea.value > 17100000) ) {
		var text = "Площадь страны представлена целым числом от 1 до 17 100 000(площадь России). Пожалуйста, введите его корректно.";
		formGroups[3].classList.add("has-error");
		createMessage(countryArea.parentNode, text);
		isValid = false;
	}

	formGroups[4].classList.remove("has-error");
	removeMessage(countryLanguage.parentNode);
	countryLanguage.value = countryLanguage.value.trim()
	if (countryLanguage.value.match(/^[a-zа-яё]+$/i) == null) {
		var text = "Официальный язык страны может включать только буквы. Пожалуйста, введите его корректно.";
		formGroups[4].classList.add("has-error");
		createMessage(countryLanguage.parentNode, text);
		isValid = false;
	}

	if (!isValid) {
		event.preventDefault();
	}
}

function validateCity(event) {
	var isValid = true;

	var formGroups = document.querySelectorAll(".form-group");

	var form = document.querySelector("form");
	var formElements = form.elements;

	var cityName = formElements["city-name"];
	var cityMayor = formElements["city-mayor"];
	var cityPopulation = formElements["city-population"];
	var cityDensity = formElements["city-density"];


	formGroups[0].classList.remove("has-error");
	removeMessage(cityName.parentNode);
	cityName.value = cityName.value.trim()
	if (cityName.value.match(/^[a-zа-яё\-]+$/i) == null) {
		var text = "Название города может включать только буквы и знак -. Пожалуйста, введите его корректно.";
		formGroups[0].classList.add("has-error");
		createMessage(cityName.parentNode, text);
		isValid = false;
	}

	formGroups[1].classList.remove("has-error");
	removeMessage(cityMayor.parentNode);
	cityMayor.value = cityMayor.value.trim()
	if (cityMayor.value.match(/^[a-zа-яё\-]+\s[a-zа-яё\-]+(\s[a-zа-яё\-]+)?$/i) == null) {
		var text = "ФИО мэра может включать в себя буквы и знак -, пишется через пробелы. Пример: 'Иванов Иван Иванович'. Пожалуйста, введите его корректно.";
		formGroups[1].classList.add("has-error");
		createMessage(cityMayor.parentNode, text);
		isValid = false;
	}

	formGroups[2].classList.remove("has-error");
	removeMessage(cityPopulation.parentNode);
	if ( (cityPopulation.value.match(/^[1-9](\d{1,7})?$/i) == null) || (cityPopulation.value > 24150000) ) {
		var text = "Население города это целое число от 1 до 24 150 000(население Шанхая). Пожалуйста, введите его корректно.";
		formGroups[2].classList.add("has-error");
		createMessage(cityPopulation.parentNode, text);
		isValid = false;
	}

	formGroups[3].classList.remove("has-error");
	removeMessage(cityDensity.parentNode);
	if ( (cityDensity.value.match(/^\d+\.?(\d+)?$/i) == null) || (cityDensity.value > 44000) ) {
		var text = "Плотность страны представлена десятичной дробью от 0 до 44 000(плотность населения в Дакке). Пожалуйста, введите его корректно.";
		formGroups[3].classList.add("has-error");
		createMessage(cityDensity.parentNode, text);
		isValid = false;
	}

	if (!isValid) {
		event.preventDefault();
	}
}