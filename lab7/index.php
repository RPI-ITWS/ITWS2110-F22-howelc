<!DOCTYPE html>
<html lang="en">

<head>
    <!--meta tags-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="White Board Gradebook">
    <!-- Latest compiled and minified bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"
        defer></script>

    <link rel="shortcut icon" type="image/x-icon" href="resources/writing-whiteboard.png">
    <title>White Board</title>
</head>

<body>
    <?php

    $host = "localhost";

    $user = "root";

    $pass = "jaclynn2019!";

    $dbname = "websyslab7";

    $dbconn = new
        PDO("mysql:host=$host; dbname=$dbname", $user, $pass);

    echo $dbconn ? 'connected' : 'not connected';

    ?>

</body>

</html>