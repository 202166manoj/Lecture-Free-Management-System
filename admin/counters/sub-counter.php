<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT id from subjects";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $subcount=$query->rowCount();

    echo htmlentities($subcount);
?>