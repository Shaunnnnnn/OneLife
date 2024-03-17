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
<title>Onelife Admin</title>
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
<?php $page='members-update'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa--home"></i> Home</a> <a href="#" class="current">Registered Members</a> </div>
    <h1 class="text-center">Registered Members List <i class="fas fa-group"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Member table</h5>
          </div>
          <div class='widget-content nopadding'>
            <div class="form-group">
              <input type="text" id="searchInput" class="form-control" placeholder="Search">
            </div>
            <?php
            include "dbcon.php";
            $qry="select * from members";
            $cnt = 1;
              $result=mysqli_query($conn,$qry);


            echo"<table id='memberTable' class='table table-bordered table-hover'>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Fullname</th>
                   
                    <th>Gender</th>
                    <th>Contact Number</th>
                    <th>D.O.R</th>
                    <th>Expiry Date</th>
                    <th>Days Remaining</th>
                    
                    <th>Amount</th>
                    <th>Choosen Service</th>
                    <th>Plan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>";
                /* while($row=mysqli_fetch_array($result)){
                  date_default_timezone_set("Africa/Harare");
                  // $date_of_registration = date_format(new DateTime($dor),"Y-m-d");
                  // $expiry_date = date("Y-m-d", strtotime($date_of_registration) + (60 * 60 * 24 * ($plan-1)));
                  // echo $expiry_date . "<br>";
                  $expiry_date = $row['expiry_date'];
                  $current_date = date("Y-m-d");
                
                  
                  $date1 = new DateTime($current_date);
                  $date2 = new DateTime($expiry_date);
                  $date3 = new DateTime($row['dor']);

                  $interval = $date2->diff($date1);
                  $interval2 = $date1->diff($date3);
                  $daysDifference = $interval->d;
                  $daysDifference2 = $interval2->d;

                  //echo $daysDifference2 . "<br>";  
                  $status = "Pending";

                  //if ($daysDifference2 >= 0){
                    if( strtotime($current_date) <= strtotime($row['dor']) ){
                    if ($daysDifference > 0){
                      $status = "Active";
                    }else {
                      $status = "Expired";
                    }

                  }
                  $fullname = $row['fullname'];
                  $sql = "UPDATE members SET status = '$status' WHERE fullname = '$fullname'";
                  $update = mysqli_query($con, $sql); */
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
                  echo"<tr>
                      <td><div class='text-center'>".$cnt."</div></td>
                      <td><div class='text-center'>".$row['fullname']."</div></td>
                     
                      <td><div class='text-center'>".$row['gender']."</div></td>
                      <td><div class='text-center'>".$row['contact']."</div></td>
                      <td><div class='text-center'>".$row['dor']."</div></td>
                      <td><div class='text-center'>" . $row['expiry_date'] . "</div></td>
                      <td><div class='text-center'>" . $daysDifference . "</div></td>
                      
                      <td><div class='text-center'>$".$row['amount']."</div></td>
                      <td><div class='text-center'>".$row['services']."</div></td>
                      <td><div class='text-center'>".$row['plan']."</div></td>
                      <td><div class='text-center'><a href='edit-memberform.php?id=".$row['user_id']."'><i class='fas fa-edit'></i> Edit</a></div></td>
                    </tr>";
                  $cnt++;
                }
                echo "</tbody>
              </table>";
            ?>
          </div>
          </div>

          <script>
            // Search function
            function searchTable() {
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("searchInput");
              filter = input.value.toUpperCase();
              table = document.getElementById("memberTable");
              tr = table.getElementsByTagName("tr");
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Change index to the column you want to search
                if (td) {
                  txtValue = td.textContent || td.innerText;
                  if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }
              }
            }

            // Attach event listener to search input
            document.getElementById("searchInput").addEventListener("keyup", searchTable);
          </script>
   
		
	
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->
<!-- Visit codeastro.com for more projects -->
<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Developed by Praise Gavi and Shaun Mango</a> </div>
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
