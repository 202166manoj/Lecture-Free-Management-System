<?php
include '../includes/dbconn.php';

$eid = $_SESSION['stulogin']; // Use 'stulogin' session variable
$sql = "SELECT FullName, StuId, ProfilePicture FROM students WHERE StuId=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
    foreach ($results as $result) {
?>
        <div class="user-profile pull-right">
            <?php if ($result->ProfilePicture) { ?>
                <img class="avatar user-thumb" src="<?php echo htmlentities($result->ProfilePicture); ?>" alt="avatar">
            <?php } else { ?>
                <img class="avatar user-thumb" src="../assets/images/avatar.jpg" alt="avatar">
            <?php } ?>
            <div>
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo htmlentities($result->FullName); ?></h4>
                <span><?php echo htmlentities($result->StuId); ?></span>
            </div>
            
        </div>
<?php
    }
}
?>


