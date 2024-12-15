<nav>
        <ul class="metismenu" id="menu">
        <li class="<?php if($page=='dashboard') {echo 'active';} ?>"><a href="dashboard.php"><i class="fa-solid fa-house"></i><span>Dashboard</span></a></li>

        <li class="<?php if($page=='student') {echo 'active';} ?>">
            <a href="javascript:void(0)" aria-expanded="true"><i class="fa-solid fa-user-pen"></i><span>Students</span></a>
                <ul class="collapse">
                    <li ><a href="students.php"><i class="fa-regular fa-id-card"></i> Student Details</a></li>
                    <li ><a href="students-sports.php"><i class="fa-solid fa-key"></i> Students to Sports</a></li>
                </ul>
        </li>

        <li class="<?php if($page=='teacher') {echo 'active';} ?>"><a href="teachers.php"><i class="fa-solid fa-chalkboard-user"></i><span>Lecturers/ Tutors/ Demonstrators</span></a></li>
        
        <li class="<?php if($page=='instructor') {echo 'active';} ?>"><a href="instructors.php"><i class="fa-solid fa-user-tie"></i><span>Sport Instructors</span></a></li>
        
        <li class="<?php if($page=='sport') {echo 'active';} ?>"><a href="sports.php"><i class="fa-solid fa-basketball"></i><span>Sports</span></a></li>
        
        <li class="<?php if($page=='subject') {echo 'active';} ?>"><a href="subjects.php"><i class="fa-solid fa-book"></i><span>Subjects</span></a></li>

        <li class="<?php if($page=='manage-forms') {echo 'active';} ?>"><a href="history.php"><i class="fa-brands fa-wpforms"></i><span>Lecture Free Forms</span></a></li>

        <li class="<?php if($page=='manage-admin') {echo 'active';} ?>"><a href="manage-admin.php"><i class="fa-solid fa-lock"></i><span>Manage Admin</span></a></li>
                            
    </ul>

    <ul class="metismenu" id="logout-menu">
        <li>
            <a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
        </li>
    </ul>
</nav>
