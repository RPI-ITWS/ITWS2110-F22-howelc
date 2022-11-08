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

    try {
        if (isset($_POST["c-submit"])) {
            $crn = htmlspecialchars(trim($_POST["crn"]));
            $prefix = htmlspecialchars(trim($_POST['prefix']));
            $number = htmlspecialchars(trim($_POST['number']));
            $title = htmlspecialchars(trim($_POST['title']));
            $section = htmlspecialchars(trim($_POST['section']));
            $year = htmlspecialchars(trim($_POST['year']));
            $query3 = "INSERT INTO courses(crn, prefix, number, title, section, year) VALUES (?, ?, ?, ?, ?, ?);";
            $stmt3 = $dbconn->prepare($query3);
            $stmt3->execute([$crn, $prefix, $number, $title, $section, $year]);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
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
                                <a class="nav-link" href="index.php"><i class="bi bi-house"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="courses.php"><i class="bi bi-journals"></i> Courses</a>
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
            <h1 class="page-title d-inline">Courses</h1>
            <button class="btn btn-success float-end px-4 mb-4" data-bs-toggle="modal" data-bs-target="#add-c-modal">Add
                Course</button>
            <table class="table pt-5" id="courses-table">
                <thead>
                    <tr>
                        <th scope="col">CRN</th>
                        <th scope="col">Prefix</th>
                        <th scope="col">Number</th>
                        <th scope="col">Title</th>
                        <th scope="col">Section</th>
                        <th scope="col">Year</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $query = "SELECT crn, prefix, number, title, section, year FROM courses";
                        $stmt = $dbconn->query($query);
                        foreach ($stmt as $data) { ?>
                    <tr>
                        <th scope="row">
                            <?php echo $data['crn']; ?>
                        </th>
                        <td>
                            <?php echo $data['prefix']; ?>
                        </td>
                        <td>
                            <?php echo $data['number']; ?>
                        </td>
                        <td>
                            <?php echo $data['title']; ?>
                        </td>
                        <td>
                            <?php echo $data['section']; ?>
                        </td>
                        <td>
                            <?php echo $data['year']; ?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <?php
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
            </table>
            <!-- Modal For Adding Course -->
            <div class="modal fade" id="add-c-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="add-c-modal-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 sec-head-2" id="add-c-modal-label">
                                Add Course
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="add-course" name="add-course" action="courses.php" method="post">
                                <fieldset>
                                    <div class="mb-3">
                                        <label for="crn-input" class="form-label">CRN</label>
                                        <input type="text" class="form-control" id="crn-input" name="crn" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="prefix-input" class="form-label">Prefix</label>
                                        <input type="text" class="form-control" id="prefix-input" name="prefix"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="number-input" class="form-label">Number</label>
                                        <input type="text" class="form-control" id="number-input" name="number"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="title-input" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title-input" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="section-input" class="form-label">Section</label>
                                        <input type="text" class="form-control" id="section-input" name="section"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="year-input" class="form-label">Year</label>
                                        <input type="text" class="form-control" id="year-input" name="year" required>
                                    </div>
                                    <input type="submit" class="btn btn-success" value="Add" id="c-submit"
                                        name="c-submit"></button>
                                </fieldset>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>