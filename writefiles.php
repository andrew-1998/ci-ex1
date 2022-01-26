<?php
/*
* В случае правильного заполнения формы, сообщение об успехе должно 
* быть записано в отдельный текстовый файл.
* Обязательные параметры: Сообщение об успехе и путь к файлу, если файл есть
* Значения других полей писать в файл не требуется
*/

$uploaddir = __DIR__ . '/Images/';
$putdir = __DIR__ . '/Messagefiles/';
//Такой формат названия файла ясен и исключает дублирование в рамках задания
$putfile = 'file_' . date('Y-m-d_H-i-s') . '.txt';
$fullFilename = $putdir . $putfile;
//Отрицательный флаг для AJAX
$res['ok']='No'; 
//Дополнительная проверка на заполнение обязательных полей
if (!isset($_POST['username']) ||
    !isset($_POST['usermail']) ||
    !isset($_POST['message'])) {
    die();
}
//Дополнительная проверка адреса электронной почты
$reg = <<< LongRegExp
/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()
[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
LongRegExp;
if (!preg_match($reg, $_POST['usermail'])) {
    die();
}
/*
* Здесь следовало бы обработать полученные значения полей формы
* с помощью функций htmlspecialchars() и strip_tags() но, поскольку
* они не сохраняются в файл и в задании такого требования нет,
* я делать этого не буду */

$text = 'УСПЕХ! ';
//. 'User: '.$_POST['username'].' Email: '.$_POST['usermail'];
//file_put_contents($fullFilename, $text);

if (!empty($_FILES)) {
    $uploadFile = $uploaddir . $_FILES['image']['name'];
    if ($_FILES['image']['type'] == 'image/jpeg' ||
        $_FILES['image']['type'] == 'image/png') {
        if ($_FILES['image']['size'] < 62914560) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $text .= "\n Путь к файлу: " . $uploadFile;
            } else {
                die();
            }
        } else {
            die();
        }
    } else {
        die();
    }
}
//Используется самая простая функция для создания нового файла
file_put_contents($fullFilename, $text);
$res['ok']='Y';
echo json_encode($res);
