<?php

include 'functions.php';

$user = ['name' => 'Donald Trump'];

$html = render('main', ['name' => $user['name']]);

echo $html;
