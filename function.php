<?php
 function render($mi){
     ob_start();
     if (func_num_args()>1){
         extract(func_get_arg(1));
     }
     include __DIR__.'/templace/'.func_get_arg(0).'.php';
     return ob_get_clean();
 }