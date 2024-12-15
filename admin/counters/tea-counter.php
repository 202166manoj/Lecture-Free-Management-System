<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT id from teachers";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $teacount=$query->rowCount();

    echo htmlentities($teacount);
?>