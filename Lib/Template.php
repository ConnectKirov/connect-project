<?php

namespace App\Lib;

class Template {
    private $layout;

    public function setLayout(string $name) {
        $this->layout = $this->getPath('layouts/' . $name);
    }

    /**
     * Функция для рендеринга шаблона с заданными переменными
     *
     * @param  string $template имя файла шаблона
     * @param  array $vars массив с переменными имя => значение
     *
     * @return string html код страницы
     */
    private function render(): string {
        // включаем буфер вывода
        ob_start();
        // если передан массив, то преобразуем его в переменные
        if (func_num_args() > 1) {
            extract(func_get_arg(1));
        }
        // вставляем шаблон, в котором будут доступны преобразованные переменные
        include func_get_arg(0);
        // возвращаем содержимое буфера вывода
        return ob_get_clean();
    }

    private function renderInclude($name, $params = []) {
        return $this->render($this->getPath($name), $params);
    }

    private function getPath() {
        return __DIR__ . '/../templates/' . func_get_arg(0) . '.php';
    }

    public function renderWithLayout($name, $params = [], $title = 'Connect') {
        $html = $this->render($this->getPath($name), $params);
        return $this->render($this->layout, ['children' => $html, 'title' => $title]);
    }

    /**
     * Составление строки класса из переданного массива
     *
     * @param array ...$args
     * @return string
     */
    public function cs(...$args) {
        $classes = '';
        foreach ($args as $arg) {
            if (is_string($arg)) {
                $classes .= $arg . ' ';
            }
            if (is_array($arg)) {
                foreach ($arg as $key => $value) {
                    if (is_numeric($key)) {
                        $classes .= $value . ' ';
                    } elseif ($value) {
                        $classes .= $key . ' ';
                    }
                }
            }
        }
        return $classes;
    }

    public function getLocaleDate($date) {
        $month = [
            '',
            'Января',
            'Февраля',
            'Марта',
            'Апреля',
            'Мая',
            'Июня',
            'Июля',
            'Августа',
            'Сентября',
            'Октября',
            'Ноября',
            'Декабря'
        ];
        $day = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
        return date('d', $date) . ' ' . $month[date('n', $date)] . ', ' . $day[date('w', $date)];
    }


    public function getLocaleTimeAgo($date) {
        $d = date('Y-m-d');
        $d1 = date('Y-m-d', $date);
        $dz = date('Y-m-d', time() + 3600 * 24);
        $dw = date('Y-m-d', time() - 3600 * 24);
        if ($d == $d1) {
            return 'сегодня';
        } elseif ($d == $dz) {
            return 'завтра';
        } elseif ($d == $dw) {
            return 'вчера';
        } else {
            return '';
        }
    }

    public function getFile($url) {
        return $url . '?' . filemtime($_SERVER['DOCUMENT_ROOT'] . $url);
    }

}