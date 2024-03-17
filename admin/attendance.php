<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>
<!-- Visit codeastro.com for more projects -->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Onelife System Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- Visit codeastro.com for more projects -->
<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Onelife Admin</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->
<!-- Visit codeastro.com for more projects -->
<!--sidebar-menu-->
<?php $page="attendance"; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="attendance.php" class="current">Manage Attendance</a> </div>
    <h1 class="text-center">Attendance List <i class="fas fa-calendar"></i></h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Attendance Table</h5>
            </div>
            <div class='widget-content nopadding'> 

            <form id="custom-search-form" role="search" method="POST" action="attendance.php" class="form-search form-horizontal pull-right">
              <div class="input-append span12">
                <input type="text" class="search-query" placeholder="Search" name="search" required>
                <button type="submit" class="btn"><i class="fas fa-search"></i></button>
              </div>
            </form>

            <table class='table table-bordered table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fullname</th>
                  <th>Contact Number</th>
                  <th>Chosen Service</th>
                  <th>Action</th>
                </tr>
              </thead>

              <?php
              include "dbcon.php";
              date_default_timezone_set('Europe/Bucharest');
              $current_date = date('Y-m-d h:i A');
              $exp_date_time = explode(' ', $current_date);
              $todays_date =  $exp_date_time['0'];

              // Check if search query is submitted
              if(isset($_POST['search'])) {
                $search = $_POST['search'];
                $qry = "SELECT * FROM members WHERE status = 'Active' AND (fullname LIKE '%$search%' OR contact LIKE '%$search%' OR services LIKE '%$search%')";
              } else {
                $qry = "SELECT * FROM members WHERE status = 'Active'";
              }

              $result = mysqli_query($conn, $qry);
              $i = 1;
              $cnt = 1;

              while($row = mysqli_fetch_array($result)) {
              ?>
              <tbody> 
                <td><div class='text-center'><?php echo $cnt; ?></div></td>
                <td><div class='text-center'><?php echo $row['fullname']; ?></div></td>
                <td><div class='text-center'><?php echo $row['contact']; ?></div></td>
                <td><div class='text-center'><?php echo $row['services']; ?></div></td>

                <?php
                $qry = "SELECT * FROM attendance WHERE curr_date = '$todays_date' AND user_id = '".$row['user_id']."'";
                $res = $conn->query($qry);
                $num_count  = mysqli_num_rows($res);
                $row_exist = mysqli_fetch_array($res);
                $curr_date = $row_exist['curr_date'];
                if($curr_date == $todays_date) {
                   ?>
                <td>
                <div class='text-center'><span class="label label-inverse"><?php echo $row_exist['curr_date'];?>  <?php echo $row_exist['curr_time'];?></span></div>
                <div class='text-center'><a href='actions/delete-attendance.php?id=<?php echo $row['user_id'];?>'><button class='btn btn-danger'>Check Out <i class='fas fa-clock'></i></button> </a></div>
                </td>

            <?php } else {
                
                ?>

                <td><div class='text-center'><a href='actions/check-attendance.php?id=<?php echo $row['user_id'];?>'><button class='btn btn-info'>Check In <i class='fas fa-map-marker-alt'></i></button> </a></div></td>
             
                <?php }
              ?>      
              </tbody>
           <?php $cnt++; } ?>
                
            </table>
          </div>
        </div>
   
		
	
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Developed By Praise Gavi & Shaun Mango</a> </div>
</div>

<style>
#footer {
  color: white;
}
</style>

<!--end-Footer-part-->

<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script>  
<script src="../js/matrix.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 

</script>
</body>
</html>
