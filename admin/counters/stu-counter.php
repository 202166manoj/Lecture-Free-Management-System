<?php
    include '../../includes/dbconn.php';

    $sql = "SELECT id from students";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $stucount=$query->rowCount();

    echo htmlentities($stucount);
?>