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
<title>OneLife System Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/fullcalendar.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Onelife Admin</a></h1>
</div>
<!--close-Header-part--> 

<!-- Visit codeastro.com for more projects -->
<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->

<!--sidebar-menu-->
<?php $page='member-status'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="member-status.php" class="current">Status</a> </div>
    <h1 class="text-center">Member's Current Status <i class="fas fa-eye"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
      
      <div class='widget-box'>
      
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Status table</h5>
            <form id="custom-search-form" role="search" method="POST" action="member-status.php" class="form-search form-horizontal pull-right">
              <div class="input-append span12">
                <input type="text" class="search-query" placeholder="Search" name="search" required>
                <button type="submit" class="btn"><i class="fas fa-search"></i></button>
              </div>
            </form>
            </div>
            <div class='widget-content nopadding'>
            <?php
              include "dbcon.php";

              if(isset($_POST['search'])){
                $search = $_POST['search'];
                $qry = "SELECT * FROM members WHERE fullname LIKE '%$search%'";
                $result = mysqli_query($con, $qry);
                
                if (mysqli_num_rows($result) == 0) {
                  echo "<div class='error_ex'>
                    <h1>403</h1>
                    <h3>Opps, Results Not Found!!</h3>
                    <p>It seems like there's no such record available in our database.</p>
                    <a class='btn btn-danger btn-big'  href='member-status.php'>Go Back</a> </div>'";
                } else {
                  echo "<table class='table table-bordered table-hover'>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Fullname</th>
                      <th>Contact Number</th>
                      <th>Chosen Service</th>
                      <th>Plan</th>
                      <th>Registration Date</th>
                      <th>Expiry Date</th>
                      <th>Membership Status</th>
                      
                    </tr>
                  </thead>
                  <tbody>";

                  $cnt = 1;
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                        <td><div class='text-center'>$cnt</div></td>
                        <td><div class='text-center'>" . $row['fullname'] . "</div></td>
                        <td><div class='text-center'>" . $row['contact'] . "</div></td>
                        <td><div class='text-center'>" . $row['services'] . "</div></td>
                        <td><div class='text-center'>" . $row['plan'] . " Day/s</div></td>
                        <td><div class='text-center'>" . $row['dor'] . "</div></td>
                        <td><div class='text-center'>" . $row['expiry_date'] . "</div></td>
                        <td><div class='text-center'>";
                    if ($row['status'] == 'Active') {
                      echo "<i class='fas fa-circle' style='color:green;'></i> Active";
                    } else if ($row['status'] == 'Expired') {
                      echo "<i class='fas fa-circle' style='color:red;'></i> Expired";
                    } else {
                      echo "<i class='fas fa-circle' style='color:orange;'></i> Pending Reg";
                    }
                    echo "</div></td>
                      </tr>";
                    $cnt++;
                  }
                  echo "</tbody>
                    </table>";
                }
              } else {
                $qry = "SELECT * FROM members";
                $result = mysqli_query($con, $qry);

                echo "<table class='table table-bordered table-hover'>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Fullname</th>
                      <th>Contact Number</th>
                      <th>Choosen Service</th>
                      <th>Plan</th>
                      <th>Registration Date</th>
                      <th>Expiry Date</th>
                      <th>Days Remaining</th>
                      <th>Membership Status</th>
                      
                    </tr>
                  </thead>
                  <tbody>";
                $cnt = 1;
                while ($row = mysqli_fetch_array($result)) {
                  date_default_timezone_set("Africa/Harare");
                  // $date_of_registration = date_format(new DateTime($dor),"Y-m-d");
                  // $expiry_date = date("Y-m-d", strtotime($date_of_registration) + (60 * 60 * 24 * ($plan-1)));
                  // echo $expiry_date . "<br>";
                  $expiry_date = $row['expiry_date'];
                  $session_input = $row['sessions'];
                  $user_id = $row['user_id'];
                  $attendance_count = $row['attendance_count'];

                  $current_date = date("Y-m-d");
                  
                  
                  $date1 = new DateTime($current_date);
                  $date2 = new DateTime($expiry_date);
                  $date3 = new DateTime($row['dor']);

                  $interval = $date2->diff($date1);
                  $interval2 = $date1->diff($date3);
                  $daysDifference = $interval->d; //expiry - current
                  $daysDifference2 = $interval2->d; //dor - current date

                  //echo $daysDifference2 . "<br>";  
                  $status = "Pending";

                  //if ($daysDifference2 >= 0){ $plan == "Sessions"
                  //if ($session_input != 0){
                  if( strtotime($current_date) >= strtotime($row['dor']) ){
                    if ($row['plan'] == "Sessions"){
                      if ($session_input > $attendance_count){
                        //if ($daysDifference < 1){
                        if (strtotime($current_date) > strtotime($row['expiry_date'])){
                          $status = "Expired";
                        }else {
                        $status = "Active";
                        }
                      }else {
                        $status = "Expired";
                      }

                        // $query = "update members set sessions='$session_input' user_id='$user_id'";
                        // $query_result = mysqli_query($conn,$qry);
                    }else{
                          if(strtotime($current_date) < strtotime($row['expiry_date'])){
                            $status = "Active";
                          }else {
                            $status = "Expired";
                          }
                    }
                  }else{
                    $status = "Pending";
                  }

                    
                
                  $fullname = $row['fullname'];
                  $sql = "UPDATE members SET status = '$status' WHERE fullname = '$fullname'";
                  $update = mysqli_query($con, $sql);

                  // if ($update){
                  //   echo "data has been updated in the database <br>";
                  // }else{
                  //   echo "no update in the database <br>";
                  // }

                  
                  echo "<tr>
                      <td><di`v class='text-center'>$cnt</div></td>
                      <td><div class='text-center'>" . $row['fullname'] . "</div></td>
                      <td><div class='text-center'>" . $row['contact'] . "</div></td>
                      <td><div class='text-center'>" . $row['services'] . "</div></td>
                      <td><div class='text-center'>" . $row['plan'] . "</div></td>
                      <td><div class='text-center'>" . $row['dor'] . "</div></td>
                      <td><div class='text-center'>" . $row['expiry_date'] . "</div></td>
                      <td><div class='text-center'>" . $daysDifference . "</div></td>
                      <td><div class='text-center'>";
                  if ($row['status'] == 'Active') {
                    echo "<i class='fas fa-circle' style='color:green;'></i> Active";
                  } else if ($row['status'] == 'Expired') {
                    echo "<i class='fas fa-circle' style='color:red;'></i> Expired";
                  } else {
                    echo "<i class='fas fa-circle' style='color:orange;'></i> Pending Reg";
                  }
                  echo "</div></td>
                    </tr>";
                  $cnt++;
                }
                echo "</tbody>
                
                  </table>";
              }
            ?>

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
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Developed By Shaun and Praise</a> </div>
</div>

<style>
#footer {
  color: white;
}
</style>
<!--end-Footer-part-->

<script src="../js/excanvas.min.js"></script> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.flot.min.js"></script> 
<script src="../js/jquery.flot.resize.min.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/fullcalendar.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.dashboard.js"></script> 
<script src="../js/jquery.gritter.min.js"></script> 
<script src="../js/matrix.interface.js"></script> 
<script src="../js/matrix.chat.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/matrix.form_validation.js"></script> 
<script src="../js/jquery.wizard.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.popover.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 


<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>