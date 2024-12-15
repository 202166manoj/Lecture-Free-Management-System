<?php
    include '../includes/dbconn.php';
    
    $eid=$_SESSION['eid'];
    $sql = "SELECT FullName from  instructors where id=:eid";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;

    if($query->rowCount() > 0){
        foreach($results as $result)
    {    ?>
        <p style="color:#413c3c;"><?php echo htmlentities($result->FullName);?></p>
        
<?php }
    } 
?>