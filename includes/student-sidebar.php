<nav>
    <ul class="metismenu" id="menu">
    <li class="<?php if($page=='dashboard') {echo 'active';} ?>"><a href="dashboard.php"><i class="fa-solid fa-house"></i><span>Dashboard</span></a></li>

    <li class="<?php if($page=='form') {echo 'active';} ?>"><a href="forms.php"><i class="fa-solid fa-pen-to-square"></i><span>Fill a Form</span></a></li>

    <li class="<?php if($page=='history') {echo 'active';} ?>"><a href="history.php"><i class="fa-brands fa-wpforms"></i><span>My Forms</span></a></li>

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


                    