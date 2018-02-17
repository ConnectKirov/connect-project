<?php
/**
 * @var $this Template
 */
?>
<html>
<head>
    <link rel="stylesheet" href="<?= $this->getFile('/styles/style.css')?>">
    <link rel="stylesheet" href="<?= $this->getFile('/styles/schedule.css')?>">
    <link rel="stylesheet" href="<?= $this->getFile('/styles/schedule.css')?>">
    <link rel="stylesheet" href="/bower_components/normalize-css/normalize.css">
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700&amp;subset=cyrillic" rel="stylesheet">
    <title><?=$title?></title>
</head>
<body>
<?=$children?>
<script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
<script src="<?= $this->getFile('/js/main.js')?>"></script>
<script src="<?= $this->getFile('/js/schedule.js')?>"></script>
</body>
</html>