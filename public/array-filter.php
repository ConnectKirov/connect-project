<?php

// Задача: написать реализацию нативной функции array_filter на php

// Пример: требуется оставить в массиве только элементы с длиной > 5

// Реализация:
$arr = ['это', 'тестовый', 'массив', 'который', 'нужно', 'будет', 'отфильтровать'];

function moreThanFive($string) {
  /**
  * @see http://php.net/manual/ru/function.mb-strlen.php
  */
  return mb_strlen($string) > 5;
}

$arr = array_filter(arr, 'moreThanFive');
var_dump($arr) // array(4): ['тестовый', 'массив', 'который', 'отфильтровать']

// Надо написать свою функцию array_filter:

function myArrayFilter($arr, $callback) {
  // применяем коллбек для каждого элемента и оставляем его или нет
  
  // пишем код тут
}
