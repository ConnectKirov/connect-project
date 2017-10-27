<?php
function render(){
    ob_start();
    if(func_num_args() > 1)
    {extract(func_get_arg(1));
    }
    include __DIR__ . '/templates/' . func_get_arg(0) .'.php';
    $html = ob_get_clean();
    return $html;
}