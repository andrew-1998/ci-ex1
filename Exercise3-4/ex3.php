<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
    <h1>Задание 3</h1>
    <h2>Сумма натуральных чисел меньше 1000, кратных 3 и 5</h2>
<?php
//Понимаю, что в нормальных проектах так код посреди страницы не пишут
$sum=0;
for ($i=1; $i < 1000; $i++)
{
    if ($i % 3 == 0) $sum += $i;
    if ($i % 5 == 0) $sum += $i;
}
echo "Сумма = " . $sum;
?>
</body>
</html>