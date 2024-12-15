<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT id from sports";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $spocount=$query->rowCount();

    echo htmlentities($spocount);
?>