<!DOCTYPE html>
<html lang="en">
<?php include('head.php') ?>

<body>
    <?php
    // Vars for PDO connection
    $host = "localhost";
    $user = "phpmyadmin";
    $pass = "jaclynn2019!";
    $dbname = "websyslab7";
    // PDO Connection
    try {
        $dbconn = new
            PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
        $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        echo $exception->getMessage();
    }

    ?>
    <div id="body-format">
        <!-- Site Header and Nav -->
        <header>
            <nav id="side-nav" class="navbar navbar-expand-md navbar-dark flex-md-column p-3">
                <a href="#" class="brand navbar-brand align-middle">Whiteboard</a>
                <hr>
                <!-- Mobile Nav Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#WB-nav"
                    aria-controls="WB-nav"><span class="navbar-toggler-icon"></span></button>
                <!-- Start of off canvas nav -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="WB-nav">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body flex-column mb-auto">
                        <ul class="nav nav-pills my-auto flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php"><i class="bi bi-house"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="courses.php"><i class="bi bi-journals"></i> Courses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="students.php">
                                    <i class="bi bi-person-circle"></i> Students</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="grades.php">
                                    <i class="bi bi-pencil-square"></i> Grades</a>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="bottom-buttons p-1"><button class="sign-in p-1"><i class="bi bi-box-arrow-in-right"></i>
                            Login</button><button class="sign-in p-1"><i class="bi bi-person-plus"></i> Sign
                            Up</button></div>
                </div>
            </nav>
        </header>
        <main class="p-3">
            <h1 class="welcome-msg text-center p-5">Welcome to Whiteboard</h1>
            <div class="coming-soon d-flex flex-column">
                <div class="bg-cs align-self-center my-5">
                    <h2 class="text-center py-3 title-text">Coming Soon</h2>
                    <p class="text-center px-5 py-3 body-text">User accounts, personalization, and much more is
                        coming to Whiteboard!</p>
                </div>
            </div>
        </main>
    </div>

</body>

</html>