<html>
<head>
    <link rel="stylesheet" href="<?= Router::getFile('/styles/style.css')?>">
    <link rel="stylesheet" href="/bower_components/normalize-css/normalize.css">
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700&amp;subset=cyrillic" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <title><?=$title?></title>
</head>
<body>
<?=$children?>
<script src="<?= Router::getFile('/js/schedule.js')?>"></script>
</body>
</html>