
<!-- <style>
.logo {
  width: 14.81%;
  height: 
  position: absolute;
  top: 0.1%;
  left: 0.1%;
  max-width: calc(100% - 20px);
}
</style> 
</head>
<body> Add the logo image to the sidebar 
<img src="img/Gym-Logo.JPG" width="" alt="Logo" class="logo">
</div>-->

<div id="sidebar"><a href="#" class="visible-phone"><i class="fas fa-home"></i> Dashboard</a>
  <ul>
    <li class="<?php if($page=='dashboard'){ echo 'active'; }?>"><a href="index.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="fas fa-users"></i> <span>Manage Members</span> <span class="label label-important"><?php include 'dashboard-usercount.php';?> </span></a>
      <ul>
        <li class="<?php if($page=='members'){ echo 'active'; }?>"><a href="members.php"><i class="fas fa-arrow-right"></i> List All Members</a></li>
        <li class="<?php if($page=='members-entry'){ echo 'active'; }?>"><a href="member-entry.php"><i class="fas fa-arrow-right"></i> Member Entry Form</a></li>
        <li class="<?php if($page=='members-remove'){ echo 'active'; }?>"><a href="remove-member.php"><i class="fas fa-arrow-right"></i> Remove Member</a></li>
        <li class="<?php if($page=='members-update'){ echo 'active'; }?>"><a href="edit-member.php"><i class="fas fa-arrow-right"></i> Update Member Details</a></li>
      </ul>
    </li>

    

    <li class="<?php if($page=='attendance'){ echo 'submenu active'; } else { echo 'submenu';}?>"> <a href="#"><i class="fas fa-calendar-alt"></i> <span>Attendance</span></a>
      <ul>
        <li class="<?php if($page=='attendance'){ echo 'active'; }?>"><a href="attendance.php"><i class="fas fa-arrow-right"></i> Check In/Out</a></li>
          <li class="<?php if($page=='view-attendance'){ echo 'active'; }?>"><a href="view-attendance.php"><i class="fas fa-arrow-right"></i> View</a></li>
        </ul>
      </li>

    
    
    <li class="<?php if($page=='member-status'){ echo 'active'; }?>"><a href="member-status.php"><i class="fas fa-eye"></i> <span>Member's Status</span></a></li>
    
    <li><a href="../logout.php"><i class="fas fa-key"></i> Log Out</a></li>
    </li>

     
   
    <!-- Visit codeastro.com for more projects -->
  </ul>
</div>