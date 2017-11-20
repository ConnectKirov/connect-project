<?php

class Template {
    private $layout;

    public function setLayout($name) {
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
    private function render() {
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
    private function renderincludes($name) {
        return $this->render($this->getPath($name));
    }

    private function getPath() {
        return __DIR__ . '/../templates/' . func_get_arg(0) . '.php';
    }

    public function renderWithLayout($name, $params = [], $title = 'Connect') {
        $html = $this->render($this->getPath($name), $params);
        return $this->render($this->layout, ['children' => $html, 'title' => $title]);
    }

}