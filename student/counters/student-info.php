<?php
include '../../includes/dbconn.php';
$studentId = $_SESSION['studentid'];
$sql = "SELECT FullName, EmailId, Gender, Dob, Phonenumber FROM students WHERE id = :studentId";
$query = $dbh->prepare($sql);
$query->bindParam(':studentId', $studentId, PDO::PARAM_INT);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);

echo "<strong>Name:</strong> " . htmlentities($result->FullName) . "<br>";
echo "<strong>Email:</strong> " . htmlentities($result->EmailId) . "<br>";
echo "<strong>Gender:</strong> " . htmlentities($result->Gender) . "<br>";
echo "<strong>Date of Birth:</strong> " . htmlentities($result->Dob) . "<br>";
echo "<strong>Phone:</strong> " . htmlentities($result->Phonenumber) . "<br>";
?>
