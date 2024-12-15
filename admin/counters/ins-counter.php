<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT id from instructors";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $inscount=$query->rowCount();

    echo htmlentities($inscount);
?>