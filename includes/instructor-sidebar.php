<nav>
    <ul class="metismenu" id="menu">

    <li class="<?php if($page=='dashboard') {echo 'active';} ?>"><a href="dashboard.php"><i class="fa-solid fa-house"></i><span>Dashboard</span></a></li>

    <li class="<?php if($page=='pending') {echo 'active';} ?>"><a href="pending.php"><i class="fa-solid fa-spinner"></i><span>Pending Forms</span></a></li>

    <li class="<?php if($page=='approved') {echo 'active';} ?>"><a href="approved.php"><i class="fa-solid fa-circle-check"></i><span>Approved Forms</span></a></li>

    <li class="<?php if($page=='declined') {echo 'active';} ?>"><a href="declined.php"><i class="fa-solid fa-circle-xmark"></i><span>Declined Forms</span></a></li>

    <li class="<?php if($page=='history') {echo 'active';} ?>"><a href="history.php"><i class="fa-solid fa-clock"></i><span>History</span></a></li>

    <li class="<?php if($page=='settings') {echo 'active';} ?>">
            <a href="javascript:void(0)" aria-expanded="true"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
            <ul class="collapse">
                <li ><a href="my-profile.php"><i class="fa-regular fa-id-card"></i> Edit Profile</a></li>
                <li ><a href="change-password.php"><i class="fa-solid fa-key"></i> Change Password</a></li>
            </ul>
        </li>
    </ul>

    <ul class="metismenu" id="logout-menu">
        <li>
            <a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
        </li>
    </ul>
</nav>
