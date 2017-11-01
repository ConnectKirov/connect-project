<?php

include '../functions.php';

echo render_with_layout('main', ['users' => $results['results']]);