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
                                <a class="nav-link" href="index.php"><i class="bi bi-house"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="courses.php"><i class="bi bi-journals"></i> Courses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="students.php">
                                    <i class="bi bi-person-circle"></i> Students</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="grades.php">
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
            <h1 class="page-title">Grades</h1>
            <!-- <button class="btn btn-success float-end px-4 mb-4" data-bs-toggle="modal"
                    data-bs-target="#add-g-modal"> Add Grade</button> -->
            <div class="dropdown px-4 mb-4 float-end">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Select Course
                </button>
                <ul class="dropdown-menu">
                    <?php
                    try {
                        $query = "SELECT crn, prefix, number, section FROM courses";
                        $stmt = $dbconn->query($query);
                        foreach ($stmt as $data) { ?>

                    <li>
                        <form action="" method="post">
                            <button name="crnt" value="<?php echo $data['crn'] ?>" class="dropdown-item">
                                <?php echo $data['prefix'], "-", $data["number"], "-", $data["section"]; ?>
                            </button>
                        </form>
                    </li>
                    <?php
                        }
                    ?>
                    <?php
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </ul>
            </div>
            <?php
            if ($_POST['crnt']) {
                $classcrn = $_POST['crnt'];
            ?>
            <button class="btn btn-success float-end px-4 mb-4" data-bs-toggle="modal" data-bs-target="#add-g-modal">
                Add Grade</button>
            <table class="table pt-5">
                <thead>
                    <tr>
                        <th scope="col">RIN</th>
                        <th scope="col">RCSID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                try {
                    $query = "SELECT students.RIN AS sr, students.RCSID AS srd, students.firstname AS sf, students.lastname AS sl, grades.grade AS gg FROM students, grades WHERE grades.crn = '$classcrn' AND students.RIN = grades.RIN";
                    $query2 = "SELECT AVG(grade) AS avg_g, COUNT(grade) AS num_students FROM grades WHERE grades.crn = '$classcrn'";
                    $stmt = $dbconn->query($query);
                    $stmt2 = $dbconn->query($query2);
                    foreach ($stmt as $data) { ?>
                    <tr>
                        <th scope="row">
                            <?php echo $data['sr']; ?>
                        </th>
                        <td>
                            <?php echo $data['srd']; ?>
                        </td>
                        <td>
                            <?php echo $data['sf']; ?>
                        </td>
                        <td>
                            <?php echo $data['sl']; ?>
                        </td>
                        <td>
                            <?php echo $data['gg']; ?>
                        </td>
                    </tr>
                    <?php
                    }
                    foreach ($stmt2 as $data2) {
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row"> Class Avg</th>
                        <td>
                            <?php echo $data2['avg_g']; ?>
                        </td>
                    </tr>
                </tfoot>
                <tfoot>
                    <tr>
                        <th scope="row"> Number of Students</th>
                        <td>
                            <?php echo $data2['num_students']; ?>
                        </td>
                    </tr>
                </tfoot>

                <?php
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </table>
            <?php
            }
            try {
                if (isset($_POST["g-submit"])) {
                    $crn = htmlspecialchars(trim($_POST['crn']));
                    $rin = htmlspecialchars(trim($_POST['rin']));
                    $grade = htmlspecialchars(trim($_POST['grade']));
                    $query3 = "INSERT INTO grades(crn, RIN, grade) VALUES (?, ?, ?);";
                    $stmt3 = $dbconn->prepare($query3);
                    $stmt3->execute([$crn, $rin, $grade]);
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
            <!-- Modal For Adding Grade -->
            <div class="modal fade" id="add-g-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="add-g-modal-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 sec-head-2" id="add-g-modal-label">
                                Add Grade
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="add-grade" name="add-grade" action="grades.php" method="post">
                                <div class="mb-3">
                                    <label for="crn-input" class="form-label">CRN</label>
                                    <input type="text" class="form-control" id="crn-input" name="crn" required>
                                </div>
                                <div class="mb-3">
                                    <label for="rin-input" class="form-label">RIN</label>
                                    <input type="text" class="form-control" id="rin-input" name="rin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="grade-input" class="form-label">Grade</label>
                                    <input type="text" class="form-control" id="grade-input" name="grade" required>
                                </div>
                                <input type="submit" class="btn btn-success" value="Add" id="g-submit"
                                    name="g-submit"></button>
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