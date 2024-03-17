<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
}
?>
<!-- Visit codeastro.com for more projects -->
<!DOCTYPE html>
<html lang="en">

<head>
  <title>OneLife Admin</title>
  <!--Sessions Textbox -->
  <script>
    function showSessionsTextbox() {
      var planSelect = document.getElementById("select");
      var sessionsTextbox = document.getElementById("sessions-container");

      if (planSelect.value === "Sessions") {
        sessionsTextbox.style.display = "block";
      } else {
        sessionsTextbox.style.display = "none";
      }
    }
  </script>
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
  <style>
    .form-horizontal .control-label {
      width: 120px;
    }

    .form-horizontal .controls {
      margin-left: 140px;
    }

    .form-horizontal .help-block {
      margin-left: 140px;
    }

    .form-horizontal .form-actions {
      margin-left: 140px;
    }
  </style>

  
</head>

<body>

  <!--Header-part--><!-- Visit codeastro.com for more projects -->
  <div id="header">
    <h1><a href="dashboard.html">Onelife Admin</a></h1>
  </div>
  <!--close-Header-part-->


  <!--top-Header-menu-->
  <?php include 'includes/topheader.php' ?>
  <!--close-top-Header-menu-->
  <!--start-top-serch-->
  <!-- <div id="search">
    <input type="hidden" placeholder="Search here..." />
    <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
  </div> -->
  <!--close-top-serch-->

  <!--sidebar-menu-->
  <?php $page = 'members-entry';
  include 'includes/sidebar.php' ?>
  <!--sidebar-menu-->
  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Manamge Members</a> <a href="#" class="current">Add Members</a> </div>
      <h1 style="background-color: #336699; color: white;">Member entry form</h1>
    </div>
    <div class="container-fluid">
      <hr>
      <div class="row-fluid">
        <div class="span6">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
            <h5 style="background-color: #336699; color: white;">Personal Info</h5>
            </div>
            <div class="widget-content nopadding">
              <form action="add-member-req.php" method="POST" class="form-horizontal">
                <div class="control-group">
                  <label class="control-label">Full Name :</label>
                  <div class="controls">
                    <input type="text" class="span11" name="fullname" placeholder="Fullname" required="required"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">Gender :</label>
                  <div class="controls">
                    <select name="gender" required="required" id="select">
                      <option value="Male" selected="selected">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">D.O.R :</label>
                  <div class="controls">
                    <input type="date" name="dor" class="span11" required="required"/>
                    <span class="help-block">Date of registration</span> </div>
                </div>



            </div>


            <div class="widget-content nopadding">
              <div class="form-horizontal">

              </div>
              <div class="widget-content nopadding">
                <div class="form-horizontal">
                  <div class="control-group">
                    <label for="normal" class="control-label">Plans:</label>
                    <div class="controls">
                      <select name="plan" required="required" id="select" onchange="showSessionsTextbox()">
                        <option value="Sessions" selected="selected">Sessions</option>
                        <option value="1 day">1 day</option>
                        <option value="7 days">7 days</option>
                        <option value="14 days">14 days</option>
                        <option value="30 days">30 days</option>
                        <option value="365 days">365 days</option>
                      </select>
                    </div>
                  </div>
                  <div class="control-group" id="sessions-container">
                    <label for="sessions-input" class="control-label">Number of Sessions:</label>
                    <div class="controls">
                      <input type="text" name="sessions" id="sessions_input" method="POST"/>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="widget-content nopadding">
                <div class="form-horizontal">
                  <div class="control-group">
                    <label for="normal" class="control-label">Plans: </label>
                    <div class="controls">
                      <select name="plan" required="required" id="select">
                      <option value="Sessions" selected="selected" >Sessions</option>
                  <option value="1 day" selected="selected" >1 day</option>
                  <option value="7 days">7 days</option>
                  <option value="14 days">14 days</option>
                  <option value="30 days">30 days</option>
                  <option value="365 days">365 days</option>

                      </select>
                    </div>

                  </div>
                  <div class="control-group">


                  </div>
                </div>

              </div> -->



            </div>
          </div>



        </div>



        <div class="span6">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
            <h5 style="background-color: #336699; color: white;">Contact Details</h5>
            </div>
            <div class="widget-content nopadding">
              <div class="form-horizontal">
                <div class="control-group">
                  <label for="normal" class="control-label">Contact Number</label>
                  <div class="controls">
                    <input type="number" id="mask-phone" name="contact" placeholder="e.g 0771428041" class="span8 mask text" required="required">
                    
                  </div>
                </div>
                
              </div>

              <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                <h5 style="background-color: #336699; color: white;">Service Details</h5>
                </div>
                <div class="widget-content nopadding">
                  <div class="form-horizontal">
                    <div class="control-group">
                      <label class="control-label">Passes</label>
                      <div class="controls">
                        <select name="services" onchange="showServiceOptions(this.value)">
                          <option value="" selected disabled>Select a service</option>
                          <option value="Day Pass">Day Pass - $5</option>
                          <option value="Weekly Pass">Weekly Pass - $15</option>
                          <option value="Two Week Pass">Two Week Pass - $30</option>
                        </select>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label">Monthly Services</label>
                      <div class="controls">
                        <select name="services" onchange="showServiceOptions(this.value)">
                          <option value="" selected disabled>Select a service</option>
                          <option value="Babies-Monthly Pass">Babies monthly Pass(6-23 months) - $30</option>
                          <option value="Youth-Monthly pass">Youth Monthly pass(2-18 years) - $40</option>
                          <option value="Adults-Monthly pass">Adults Monthly pass(19-59 years) - $50</option>
                          <option value="adult Couple-Monthly pass">Adult Couple Monthly Pass - $90</option>
                          <option value="Seniors-Monthly pass">Seniors Monthly Pass(60+ years) - $40</option>
                          <option value="Senior Couple-Monthly Pass">Senior Couple Monthly Pass - $70</option>
                        </select>
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label">Swimming Lessons</label>
                      <div class="controls">
                        <select name="services" onchange="showServiceOptions(this.value)">
                          <option value="" selected disabled>Select a service</option>
                          <option value="LTS Kids Subscription">LTS Kids - $10 per session</option>
                          <option value="LTS Adults Subscription">LTS Adults - $15 per session</option>
                        </select>
                      </div>
                    </div>

                    <div id="service-options" style="display: none;">
                      <!-- Additional options for each service can be added here -->
                    </div>
                  </div>
                </div>

                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Total Amount</label>
                    <div class="controls">
                      <div class="input-append">
                        <span class="add-on">$</span>
                        <input type="number" placeholder="" name="amount" class="span11" required="required">
                      </div>
                    </div>
                  </div>


                  <div class="form-actions text-center">
                    <button type="submit" class="btn btn-success">Submit Member Details</button>
                  </div>
              </form>

            </div>



          </div>

        </div>
      </div>

    </div>
  </div>


  </div></div>


  <!--end-main-container-part-->

  <!--Footer-part-->

  <div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y"); ?> &copy; Developed By Praise Gavi and Shaun Mango</a> </div>
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
    function goPage(newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

        // if url is "-", it is this page -- reset the menu:
        if (newURL == "-") {
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
