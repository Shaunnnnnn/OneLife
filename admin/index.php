<!DOCTYPE html>
<html lang="en">
<head>
<title>OneLife Aqua & Recreation Centre</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/fullcalendar.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<!-- Add CSS for the logo 
<style>
.logo {
  width: 14.81%;
  height: 15%;
  position: absolute;
  top: 0%;
  left: 0%;
  max-width: calc(100% - 20px);
}
</style>

</head>
<body>
 Add the logo image
 <img src="img/Gym-Logo.JPG" width="" alt="Logo" class="logo"> 

Rest of the HTML code -->


</body>
</html>                
              </script>

          <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawStuff);

                function drawStuff() {
                  var data = new google.visualization.arrayToDataTable
                    ['Terms', 'Total Amount',],
                    
                    <?php
                    $query1 = "SELECT gender, SUM(amount) as numberone FROM members; ";

                      $rezz=mysqli_query($con,$query1);
                      while($data=mysqli_fetch_array($rezz)){
                        $services='Earnings';
                        $numberone=$data['numberone'];
                        // $numbertwo=$data['numbertwo'];
                     ?>
                     ['<?php echo $services;?>',<?php echo $numberone;?>,],   
                     <?php   
                      }
                     ?>
                     var options = {
                   
                    width: "1050",
                    legend: { position: 'none' },
                    
                    bars: 'horizontal', // Required for Material Bar Charts.
                    axes: {
                      x: {
                        0: { side: 'top', label: 'Total'} // Top x-axis.
                      }
                    },
                    bar: { groupWidth: "100%" }
                  };

                  var chart = new google.charts.Bar(document.getElementById('top_y_div'));
                  chart.draw(data, options);
                };


                
              </script>

          <script type="text/javascript">
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                  var data = google.visualization.arrayToDataTable([  
                                    ['Gender', 'Number'],  
                                    <?php  
                                    while($row = mysqli_fetch_array($result3))  
                                    {  
                                         echo "['".$row["gender"]."', ".$row["enumber"]."],";  
                                    }  
                                    ?>  
                               ]); 

                  var options = {
                    
                    pieHole: 0.4,
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                  chart.draw(data, options);
                }
              </script>

              <script>
                 google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                  var data = google.visualization.arrayToDataTable([  
                                    ['Designation', 'Number'],  
                                    <?php  
                                    while($row = mysqli_fetch_array($result5))  
                                    {  
                                         echo "['".$row["designation"]."', ".$row["snumber"]."],";  
                                    }  
                                    ?>  
                               ]); 

                  var options = {
                    
                    pieHole: 0.4,
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('donutchart2022'));
                  chart.draw(data, options);
                }
              </script>
          */
          </head>
          <body>

          <!--Header-part-->
          <div id="header">
            <h1><a href="dashboard.html"><img src="" alt=""></a></h1>
          </div>
          <!--close-Header-part--> 


          <!--top-Header-menu-->
          <?php include 'includes/topheader.php'?>
          <!--close-top-Header-menu-->

          <!-- Visit codeastro.com for more projects -->
          <!--sidebar-menu-->
            <?php $page='dashboard'; include 'includes/sidebar.php'?>
          <!--sidebar-menu-->

          <!--main-container-part-->
          <div id="content">
          <!--breadcrumbs-->
            <div id="content-header">
              <div id="breadcrumb"> <a href="index.php" title="You're right here" class="tip-bottom"><i class="fa fa-home"></i> Home</a></div>
            </div>
          <!--End-breadcrumbs-->

          <!--Action boxes-->
            <div class="container-fluid">
              <div class="quick-actions_homepage">
                <ul class="quick-actions">
                  <li class="bg_ls span"> <a href="index.php" style="font-size: 16px;"> <i class="fas fa-user-check"></i> <span class="label label-important"><?php include'actions/dashboard-activecount.php'?></span> Active Members </a> </li>
                  <li class="bg_lo span3"> <a href="members.php" style="font-size: 16px;"> <i class="fas fa-users"></i></i><span class="label label-important"><?php include'dashboard-usercount.php'?></span> Registered Members</a> </li>
                  <li class="bg_lg span3"> <a href="payment.php" style="font-size: 16px;"> <i class="fa fa-dollar-sign"></i> Total Earnings: $<?php include'income-count.php' ?></a> </li>
                  
                  <!-- <li class="bg_ls span2"> <a href="buttons.html"> <i class="fas fa-tint"></i> Buttons</a> </li>
                  <li class="bg_ly span3"> <a href="form-common.html"> <i class="fas fa-th-list"></i> Forms</a> </li>
                  <li class="bg_lb span2"> <a href="interface.html"> <i class="fas fa-pencil"></i>Elements</a> </li> -->
                  <!-- <li class="bg_lg"> <a href="calendar.html"> <i class="fas fa-calendar"></i> Calendar</a> </li>
                  <li class="bg_lr"> <a href="error404.html"> <i class="fas fa-info-sign"></i> Error</a> </li> -->
          <!-- Visit codeastro.com for more projects -->
                </ul>
              </div>
          <!--End-Action boxes-->    

          <!--Chart-box-->    
              <div class="row-fluid">
                <div class="widget-box">
                  <div class="widget-title bg_lg"><span class="icon"><i class="fas fa-file"></i></span>
                    <h5>Services Report</h5>
                  </div>
                  <div class="widget-content" >
                    <div class="row-fluid">
                      
                      <div class="span4">
                        <ul class="site-stats">
                          <li class="bg_lh"><i class="fas fa-users"></i> <strong><?php include 'dashboard-usercount.php';?></strong> <small>Total Members</small></li>
                         
             
                       
                     
                          <li class="bg_lb"><i class="fas fa-calendar-check"></i> <strong><?php include 'actions/count-attendance.php';?></strong> <small>Present Members</small></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div><!-- Visit codeastro.com for more projects -->
              </div><!-- End of row-fluid -->
                           

                            
              
              
         
      
       
      </div> <!-- End of ToDo List Bar -->
    </div><!-- End of Announcement Bar -->
  </div><!-- End of container-fluid -->
</div><!-- End of content-ID -->

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Developed By Praise Gavi and Shaun Mango</a> </div>
</div>

<style>
#footer {
  color: white;
}

#piechart {
  width: 800px; 
  height: 280px;  
  margin-left:auto; 
  margin-right:auto;
}
</style>

<!--end-Footer-part-->

<script src="../js/excanvas.min.js"></script> <!-- Visit codeastro.com for more projects -->
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
<!-- <script src="../js/matrix.interface.js"></script>  -->
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
