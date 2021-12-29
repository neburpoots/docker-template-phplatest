<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC demo</title>
	<link rel="preload" href="./scene.json" as="fetch">
    <link rel="stylesheet" type="text/css" href="styles/homepagestyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<?php
include __DIR__ . '/../components/header.php';

include 'home.php';

#include __DIR__ . '/../components/footer.php';
?>
</body>
</html>

