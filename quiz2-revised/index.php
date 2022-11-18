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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Other -->
    <script type="module" src="index.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/x-icon" href="resources/writing-whiteboard.png">
    <title>Whiteboard</title>
</head>

<body>
    <?php
    include_once("./CAS-1.4.0/CAS.php");
    phpCAS::client(CAS_VERSION_2_0, 'cas.auth.rpi.edu', 443, '/cas');

    // This is not recommended in the real world!
    // But we don't have the apparatus to install our own certs...
    phpCAS::setNoCasServerValidation();
    // Vars for PDO connection
    $host = "localhost";
    $user = "phpmyadmin";
    $pass = "jaclynn2019!";
    $dbname = "websyslab8+quiz2";
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
                        <ul id="course-content" class="nav nav-pills my-auto flex-column" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home" data-bs-toggle="tab"
                                    data-bs-target="#home-tab" type="button" aria-controls="home-tab"
                                    aria-selected="true" role="tab"><i class="bi bi-house"></i> Home</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" id="lec-display"><i class="bi bi-easel2"></i>
                                    Lectures</button>
                                <ul id="lec-dropdown" class="hide">

                                </ul>

                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="lab-display"><i class="bi bi-code-slash"></i> Labs</button>
                                <ul id="lab-dropdown" class="hide">

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="bottom-buttons p-1">
                        <?php
                        if (phpCAS::isAuthenticated()) {
                            echo "<p class='body-text p-1'> <i class='bi bi-person-circle'></i> " . phpCAS::getUser() . "</p>";
                            echo "<a href='logout.php'><button class='sign-in p-1'><i class='bi bi-box-arrow-in-left'></i>
                            Logout</button></a>";
                        } else {
                            echo "<script>window.location.href='login.php'</script>";
                        }
                        ?>
                    </div>
                </div>
            </nav>
        </header>
        <main class="p-3">
            <div id="tab-display" class="tab-content">
                <div class="tab-pane fade show active" id="home-tab" role="tabpanel" aria-labelledby="home"
                    tabindex="0">
                    <h1 class="welcome-msg text-center p-5">Welcome to Whiteboard</h1>
                    <div class="coming-soon d-flex flex-column">
                        <div class="bg-cs align-self-center text-center my-5">
                            <h2 class="text-center py-3 title-text">Hello
                                <?php echo phpCAS::getUser() ?>
                            </h2>
                            <p class="text-center px-5 py-3 body-text">You can delete the tables using the button below!
                            </p>
                            <form action="index.php" id="delete-tables" method="post" name="delete-tables">
                                <button type="submit" class="btn btn-danger mb-2" id="delete-btn" name="delete-btn">
                                    Delete Tables</button>
                            </form>
                            <?php
                            try {
                                if (isset($_POST["delete-btn"])) {
                                    $query = "DELETE FROM coursecontent;";
                                    $stmt = $dbconn->prepare($query);
                                    $stmt->execute();
                                }
                            } catch (PDOException $e) {
                                echo "ERROR: " . $e->getMessage();
                            }
                            ?>
                        </div>
                        <div class="course-display align-self-center text-center my-5">
                        <h2 class="text-center py-3 title-text d-flex flex-column">Courses</h2>
                        <button id="course-websys" class="course-select p-2 m-2">
                            ITWS 2110 - Web Systems Development
                        </button>
                            
                        <button id="course-MBE" class="course-select p-2 m-2">
                            ITWS 4967 - Modern Binary Exploitation
                        </button>
                        </div>
                    </div> 
                </div>
            </div>
        </main>
    </div>

</body>

</html>