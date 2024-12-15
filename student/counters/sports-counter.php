<?php
include '../../includes/dbconn.php';
$studentId = $_SESSION['studentid'];
$sql = "SELECT s.SportName FROM sports s
        JOIN student_sports ss ON s.id = ss.sport_id
        WHERE ss.student_id = :studentId";
$query = $dbh->prepare($sql);
$query->bindParam(':studentId', $studentId, PDO::PARAM_INT);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        echo htmlentities($result->SportName) . "<br>";
    }
} else {
    echo "No sports registered.";
}
?>
