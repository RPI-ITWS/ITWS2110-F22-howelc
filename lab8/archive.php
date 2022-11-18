<?php
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
try {
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if ($contentType == "application/json") {
       $jsondata = trim(file_get_contents('php://input'));
       $query = "INSERT INTO coursecontent(jsondata) VALUES (?);";
       $stmt = $dbconn->prepare($query);
       $stmt->execute([$jsondata]);
       echo "Course Content Archived";
    }
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
?>