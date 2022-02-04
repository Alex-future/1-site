<?php

error_reporting(-1);

header('Content-Type: text/html; charset=utf-8');

// инициализируем переменные

$s=0;

$name=$_POST['name'];

$fam=$_POST['fam'];

$email=$_POST['email'];

$geo=$_POST['geo'];

$calendar=$_POST['calendar'];

$period=$_POST['period'];

$gosty=$_POST['gosty'];

$pay=$_POST['pay'];

// переменные для ошибок

$emailErr = "";

$nameErr = "";

$famErr = "";

switch($period) {

case "2-3 ночи":$s+=1500;break;

case "7-10 ночей":$s+=7000;break;

case "14 ночей":$s+=30000;break;

case "30 ночей":$s+=100000;break;

}

switch($gosty) {

case "1 взрослый":$s+=1700;break;

case "2 взрослых":$s+=2500;break;

case "3 взрослых":$s+=4000;break;

case "4 взрослых":$s+=5400;break;

case "размещение с детьми":$s+=1500;break;

}

// если данные из web-формы были переданы методом post

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (empty($_POST["name"])) {

// если поле не заполнено, то формируем сообщение об ошибке

$nameErr = "Имя обязательно"

}

else {

$name = test_input($_POST["name"]);

if (!preg_match("/[D-Sr-z3-6]{7,16}/",$name)){

$nameErr ="Неверное имя!Введите в формате [D-Sr-z3-6]{7,16}<br>"

}

}

if (empty($_POST["fam"])) {

$famErr = "Фамилия обязательно"

}

else {

$fam = test_input($_POST["fam"]);

if (!preg_match("/[Q-Yc-k\?\>\%]{3,12}/",$fam)){

$famErr ="Неверная фамилия!Введите в формате [Q-Yc-k\?\>\%]{3,12}<br>"

}

}

if (empty($_POST["email"])) {

$emailErr = "E-mail обязательно"

}

else {

$email = test_input($_POST["email"]);

if (!preg_match("/[A-Z]+\..+@\w{0,10}\.[a-z]{3}/",$email)){

$emailErr="Неверный E-mail!Введите в формате [A-Z]+\..+@\w{0,10}\.[a-z]{3}<br>"

}

}

}

// проверка входных данных, полученных из web-формы

function test_input($data) {

$data = trim($data);

$data = stripslashes($data);

$data = htmlspecialchars($data);

return $data;

}

//если поле заполнено некорректно, то выводятся подсказки

if ((empty($_POST['name'])) or (empty($_POST['fam'])) or (empty($_POST['email'])) or

(!empty($nameErr)) or (!empty($famErr)) or (!empty($emailErr)) ) {

echo "<!DOCTYPE html>

<html>

<head>

<meta charset='utf-8'>

<link rel='stylesheet' href='style2.css'>

<title> Проверка формы </title>

<style> .error {color:#F00; font-size:10pt} </style>

</head>

<body>

<form action='form2.php' method='post'>

<h2>Туристическое агентство</h2>

<fieldset>

<legend>Выполните вход</legend>

<p><label><strong>Логин:</strong></label>

<input maxlength='15' size='30' name='login' placeholder='Логин'></p>

<p><label><strong>Пароль:</strong></label>

<input type='password' maxlength='8' size='30' name='password' placeholder='Пароль'></p>

</fieldset>

<p><i>Форма регистрации. Обязательные поля помечены </i><em>*</em></p>

<fieldset>

<legend>Введите данные</legend>

<p><label><strong>Имя<em>*</em></strong></label>

<input type='text' name='name' maxlength='15' size='30'></p><span class='error'>*<br>" .$nameErr."</span><br>

<p><label><strong>Фамилия<em>*</em></strong></label>

<input type='text' name='fam' maxlength='20' size='30'></p><span class='error'>*<br>" .$famErr."</span><br>

<p><label><strong>E-mail<em>*</em></strong></label>

<input type='text' name='email' placeholder='___.___@___.___' maxlength='20' size='30'></p><span class='error'>*<br>" .$emailErr."</span><br>

<p><label><strong>Телефон</strong></label>

<input type='tel' name='tel' pattern='8-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}' placeholder='8-***-***-**-**' size='30'></p>

</fieldset>

<fieldset>

<legend>Поиск тура</legend>

<p><label><strong>Куда</strong></label>

<input size='90' name='geo' placeholder='Город,курорт,отель...'></p>

<label><strong>Когда</strong></label>

<input type='date' name='calendar' value='2020–14-04'>

<label><b>Период</b></label>

<select name='period' size='1'>

<option selected value='2-3 ночи'>2-3 ночи</option>

<option value='7-10 ночей'>7-10 ночей</option>

<option value='14 ночей'>14 ночей</option>

<option value='30 ночей'>30 ночей </option>

</select>

<label><b>Гости</b></label>

<select name='gosty' size='1'>

<option selected value='1 взрослый'>1 взрослый</option>

<option value='2 взрослых'>2 взрослых</option>

<option value='3 взрослых'>3 взрослых</option>

<option value='4 взрослых'>4 взрослых</option>

<option value='размещение с детьми'>размещение с детьми</option>

</select>

<p><input type='checkbox' name='s1' checked> Даты поездки неизвестны

<input type='checkbox' name='s2' checked> +/- 1 день

<input type='checkbox' name='s3'> Моментльное подтверждение<br></p>

<p><b>Выберите способ оплаты</b></p>

<input type='radio' name='pay' checked value='Наличными'> Наличными<br>

<input type='radio' name='pay' value='Банковской картой'> Банковской картой<br>

<input type='radio' name='pay' value='QIWI'>QIWI<br>

</fieldset>

<p><b>Дополнительно(средний возраст туристов)</b></p>

<input type='radio' name='v' value='v1' checked> 18-25 лет<br>

<input type='radio' name='v' value='v2'> 35-50 лет<br>

<input type='radio' name='v' value='v3'>60 и более<br>

<p><b>Приоритетные туры</b>

<input type='checkbox' name='f1' checked> Туры по России

<input type='checkbox' name='f2' checked> Зарубежные туры

<p><label><strong>Введите ваш отзыв</strong></label>

<textarea name='comment' cols='30' rows='3' maxlength='200'></textarea></p>

<p><input type='submit' value='Отправить'>

<input type='reset' value='Очистить'></p>

</form>

</body>

</html>";}

// если всё верно, то собираем данные о путёвке

else {

echo "<html lang='ru'>

<head>

<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

<title>Данные о путевке</title>

</head>

<body style='background:url(/2.jpg);background-size:cover'>

<h2 style='margin left:10%;'>Данные о путёвке: </h2>

<p>Имя:" .$name. "</p>

<p>Фамилия:" .$fam. "</p>

<p>E-mail:" .$email. "</p>

<p>Куда отправится:" .$geo. "</p>

<p>Дата:" .$calendar. "</p>

<p>Период:" .$period. "</p>

<p>Кол-во гостей:" .$gosty. "</p>

<p>Способ оплаты:" .$pay. "</p>

<p>Сумма:" .$s. "</p>

<div style = 'display:inline-block'><img src = '/3.jpg' style = 'width:39%; margin-left:78%; margin-top:28%'></div>;

</body>

</html>";}

?>