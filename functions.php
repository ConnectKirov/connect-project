<?php

/**
 * Функция для рендеринга шаблона с заданными переменными
 *
 * @param  string $template имя файла шаблона
 * @param  array $vars массив с переменными имя => значение
 *
 * @return string html код страницы
 */
function render() {
    // включаем буфер вывода
    ob_start();
    // если передан массив, то преобразуем его в переменные
    if (func_num_args() > 1) {
        extract(func_get_arg(1));
    }
    // вставляем шаблон, в котором будут доступны преобразованные переменные
    include __DIR__ . '/templates/' . func_get_arg(0) . '.php';
    // возвращаем содержимое буфера вывода
    return ob_get_clean();
}

function render_with_layout($name, $params, $title = 'Connect') {
    $html = render($name, $params);
    return render('layout', ['children' => $html, 'title' => $title]);
}