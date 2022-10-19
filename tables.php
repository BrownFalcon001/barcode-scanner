<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "barcodescanner";

$conn = mysqli_connect($servername, $username, $password, $database);
$flag = $_SESSION['statusFlag'];
$st ="";
$event = "";
$total = $_SESSION['total'];
$present =0;
$late=0;

// echo var_dump($_SESSION);
if(($flag == 0 && $_SERVER['REQUEST_METHOD'] == 'POST')) {
  $flag = 1;
  $_SESSION['statusFlag'] = 1;
  date_default_timezone_set("Asia/Dhaka");
  $today = date("Y-m-d H:i:s");
  $_SESSION['today']= $today;
  $_SESSION['timestamp'] = $today;
  
  if(isset($_POST['st']) && isset($_POST['event'])) {
    // echo "hello";
    $st = $_POST['st'];
    $event = $_POST['event'];
    // echo $st;
    // echo $event; 
    $sql = "INSERT INTO `attendance` (`EVENT`, `START_AT`, `TIMESTAMP`) VALUES ('$event', '$st', '$today');";
    $result = mysqli_query($conn, $sql);
    $_SESSION['startat'] = $st;
    
    $sql = "SELECT * FROM `event_info` WHERE EVENT = '$event';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // NUMBER_OF_MEMBER
    $_SESSION['total'] = $row['NUMBER_OF_MEMBER'];
    $total = $_SESSION['total'];
    $sql = "INSERT INTO `event_details` (`TIMESTAMP`, `TOTAL`, `PRESENT`, `LATE`) VALUES ('$today', '$total', '0', '0');";
    $result = mysqli_query($conn, $sql);
  }
    
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SB Admin 2 - Attendance</title>

    <!-- Custom fonts for this template -->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link
      href="vendor/datatables/dataTables.bootstrap4.min.css"
      rel="stylesheet"
    />
  </head>

  <body id="page-top">
    
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!-- Sidebar - Brand -->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="index.php"
        >
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">Interface</div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseTwo"
            aria-expanded="true"
            aria-controls="collapseTwo"
          >
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
          </a>
          <div
            id="collapseTwo"
            class="collapse"
            aria-labelledby="headingTwo"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <a class="collapse-item" href="buttons.html">Buttons</a>
              <a class="collapse-item" href="cards.html">Cards</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseUtilities"
            aria-expanded="true"
            aria-controls="collapseUtilities"
          >
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
          </a>
          <div
            id="collapseUtilities"
            class="collapse"
            aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Utilities:</h6>
              <a class="collapse-item" href="utilities-color.html">Colors</a>
              <a class="collapse-item" href="utilities-border.html">Borders</a>
              <a class="collapse-item" href="utilities-animation.html"
                >Animations</a
              >
              <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading">Addons</div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapsePages"
            aria-expanded="true"
            aria-controls="collapsePages"
          >
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
          </a>
          <div
            id="collapsePages"
            class="collapse"
            aria-labelledby="headingPages"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Login Screens:</h6>
              <a class="collapse-item" href="login.html">Login</a>
              <a class="collapse-item" href="register.html">Register</a>
              <a class="collapse-item" href="forgot-password.html"
                >Forgot Password</a
              >
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Other Pages:</h6>
              <a class="collapse-item" href="404.html">404 Page</a>
              <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a
          >
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item active">
          <a class="nav-link" href="tables.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Attendance</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav
            class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
          >
            <!-- Sidebar Toggle (Topbar) -->
            <form class="form-inline">
              <button
                id="sidebarToggleTop"
                class="btn btn-link d-md-none rounded-circle mr-3"
              >
                <i class="fa fa-bars"></i>
              </button>
            </form>

            <!-- Topbar Search -->
            <form
              class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
            >
              <div class="input-group">
                <input
                  type="text"
                  class="form-control bg-light border-0 small"
                  placeholder="Search for..."
                  aria-label="Search"
                  aria-describedby="basic-addon2"
                />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="searchDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div
                  class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                  aria-labelledby="searchDropdown"
                >
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input
                        type="text"
                        class="form-control bg-light border-0 small"
                        placeholder="Search for..."
                        aria-label="Search"
                        aria-describedby="basic-addon2"
                      />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="alertsDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Alerts -->
                  <span class="badge badge-danger badge-counter">3+</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div
                  class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="alertsDropdown"
                >
                  <h6 class="dropdown-header">Alerts Center</h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 12, 2019</div>
                      <span class="font-weight-bold"
                        >A new monthly report is ready to download!</span
                      >
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-success">
                        <i class="fas fa-donate text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 7, 2019</div>
                      $290.29 has been deposited into your account!
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 2, 2019</div>
                      Spending Alert: We've noticed unusually high spending for
                      your account.
                    </div>
                  </a>
                  <a
                    class="dropdown-item text-center small text-gray-500"
                    href="#"
                    >Show All Alerts</a
                  >
                </div>
              </li>

              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="messagesDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-envelope fa-fw"></i>
                  <!-- Counter - Messages -->
                  <span class="badge badge-danger badge-counter">7</span>
                </a>
                <!-- Dropdown - Messages -->
                <div
                  class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="messagesDropdown"
                >
                  <h6 class="dropdown-header">Message Center</h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img
                        class="rounded-circle"
                        src="img/undraw_profile_1.svg"
                        alt="..."
                      />
                      <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                      <div class="text-truncate">
                        Hi there! I am wondering if you can help me with a
                        problem I've been having.
                      </div>
                      <div class="small text-gray-500">Emily Fowler · 58m</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img
                        class="rounded-circle"
                        src="img/undraw_profile_2.svg"
                        alt="..."
                      />
                      <div class="status-indicator"></div>
                    </div>
                    <div>
                      <div class="text-truncate">
                        I have the photos that you ordered last month, how would
                        you like them sent to you?
                      </div>
                      <div class="small text-gray-500">Jae Chun · 1d</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img
                        class="rounded-circle"
                        src="img/undraw_profile_3.svg"
                        alt="..."
                      />
                      <div class="status-indicator bg-warning"></div>
                    </div>
                    <div>
                      <div class="text-truncate">
                        Last month's report looks great, I am very happy with
                        the progress so far, keep up the good work!
                      </div>
                      <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img
                        class="rounded-circle"
                        src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                        alt="..."
                      />
                      <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                      <div class="text-truncate">
                        Am I a good boy? The reason I ask is because someone
                        told me that people say this to all dogs, even if they
                        aren't good...
                      </div>
                      <div class="small text-gray-500">
                        Chicken the Dog · 2w
                      </div>
                    </div>
                  </a>
                  <a
                    class="dropdown-item text-center small text-gray-500"
                    href="#"
                    >Read More Messages</a
                  >
                </div>
              </li>

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="userDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"
                    >Douglas McGee</span
                  >
                  <img
                    class="img-profile rounded-circle"
                    src="img/undraw_profile.svg"
                  />
                </a>
                <!-- Dropdown - User Information -->
                <div
                  class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="userDropdown"
                >
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                  </a>
                  <div class="dropdown-divider"></div>
                  <a
                    class="dropdown-item"
                    href="#"
                    data-toggle="modal"
                    data-target="#logoutModal"
                  >
                    <i
                      class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                    ></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <div id="show"></div>
            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-2 text-gray-800">PT Attendance</h1> -->
            

            <!-- DataTales Example -->
          
            
            <!-- <div class="container-fluid"> -->
            <!-- <form action="Manager-results.html"> -->
              <?php
                if($flag == 0) {
                  echo '
                    <div class="row">
                      
                      <div class="col-md-12">
                        <div class="card card-secondary">
                          <div class="card-header">
                            <h3 class="card-title">Select Session</h3>
          
                            <!-- <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                              <i class="fas fa-minus"></i>
                              </button>
                            </div> -->
                          </div>
                          <div class="card-body">
                            <div class="bg-light clearfix">
                              
                              <br>
                              <div class="container" >
                              <div class="row">
                                <div class="form-group col-lg-3 col-12">
                                </div>
      
                                <div class="form-group col-lg-6 col-12">
                                  <h5 style="text-align: center;">Attendance</h5>
                                  <br>
                                  <div class="row">
                                    <div class="form-group col-lg-12 col-12">
                                      <form action="tables.php" method = "POST">
                                        <div class="row">
                                          <div class="form-group col-lg-6 col-12">
                                            <select name="event" id="event" class="form-select" aria-label="Default select example" style="width: 100%; height: 37px;">
                                              <option value="pt">PT</option>
                                              <option value="games">Games</option>
                                              <option value="training">Training</option>
                                              <option value="ipft">IPFT</option>
                                              
      
                                            </select>
                                          </div>
                                          <div class="form-group col-lg-6 col-12">
                                            <div class="row">
                                              <div class="form-group col-lg-8 col-12">
                                                <input type="text" placeholder="Starts At(XX:XX)" class="form-control" id="st" name="st">
                                              </div>
                                              <div class="form-group col-lg-4 col-12">
                                                <button type="submit" class="btn btn-secondary">GO</button>
                                              </div>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </form>
                                    </div>
                                    
                                  </div>
                                  
                                </div>
                                
                              </div>
                            </div>
          
                          </div>
                                <!-- /.card-body -->
                        </div>
                            <!-- /.card -->
                      </div>
          
                    </div>
                  </div>
                  ';
                }
                else {
                  if($_SESSION['today'] != "") {
                    $today = $_SESSION['today'];
                    $sql = "SELECT * FROM `event_details` WHERE `TIMESTAMP` = '$today';";
                    // $sql = "INSERT INTO `attendance` (`EVENT`, `START_AT`, `TIMESTAMP`) VALUES ('$event', '$st', '$today');";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                  }
                  echo '
                  
                  <div class="row">
                  
                  <div class="col-md-12">
                    <div class="card card-secondary">
                      <div class="card-header">
                        <h3 class="card-title">Summary</h3>
      
                        <!-- <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    title="Collapse">
                          <i class="fas fa-minus"></i>
                          </button>
                        </div> -->
                      </div>
                      <div class="card-body">
                        <div class="bg-light clearfix">
                          
                          <br>
                          <div class="container" >
                          <div class="row">
                            <div class="form-group col-lg-4 col-12">
                              <h5 style="text-align: center;">Total Member</h5>
                              <br>
                              <div class="row">
                                <div class="form-group col-lg-12 col-12">
                                  <form action="member_list.php" method = "POST">
                                    <div class="form-group col-lg-12 col-12">
                                      <input type="text" class="form-control" id="mo" name="mo" placeholder='.$row['TOTAL'] .' readonly>
                                    </div>
                                  </form>
                                </div>
                                
                              </div>
                            </div>
  
                            <div class="form-group col-lg-4 col-12">
                              <h5 style="text-align: center;">Present</h5>
                              <br>
                              <div class="row">
                                <div class="form-group col-lg-12 col-12">
                                  <form action="member_list.php" method = "POST">
                                    <div class="form-group col-lg-12 col-12">
                                      <input type="text" class="form-control" id="mo" name="mo" placeholder='.$row['PRESENT'] .' readonly>
                                    </div>
                                  </form>
                                </div>
                                
                              </div>
                              
                            </div>
                            
                            <div class="form-group col-lg-4 col-12">
                              <h5 style="text-align: center;">Absent</h5>
                              <br>
                              <div class="row">
                                <div class="form-group col-lg-12 col-12">
                                  <form action="member_list.php" method = "POST">
                                    <div class="form-group col-lg-12 col-12">
                                      <input type="text" class="form-control" id="mo" name="mo" placeholder='.$row['TOTAL']- $row['PRESENT'] .' readonly>
                                    </div>
                                  </form>
                                </div>
                                
                              </div>
                            </div>
                            
                          </div>
                        </div>
      
                      </div>
                            <!-- /.card-body -->
                    </div>
                        <!-- /.card -->
                  </div>
      
                </div>
              </div>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-primary">
                  PT Attendance
                  </h4>
                  <br>
                  <br>
                  <!-- <div class="container"> -->
                    <form>
                      <div class="mb-5">
                        <label for="armyid" class="form-label">Army ID</label>
                        <input type="text" class="form-control" id="armyid" class="armyid"  aria-describedby="emailHelp">
                      </div>
                    </form>
                  <!-- </div> -->
                </div>
                
                <div class="card-body">
                  <div class="table-responsive">
                    <table
                      class="table table-bordered"
                      id="dataTable"
                      width="100%"
                      cellspacing="0"
                    >
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Rank</th>
                          <th>Name</th>
                          <th>Time</th>
                          <th>Details</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>ID</th>
                          <th>Rank</th>
                          <th>Name</th>
                          <th>Time</th>
                          <th>Details</th>
                        </tr>
                      </tfoot>
                      <tbody>';
                      $today = $_SESSION['today'];
                      $sql = "SELECT * FROM `in_at` WHERE `TIMESTAMP` = '$today';";
                      $result = mysqli_query($conn, $sql);
                      while($row = mysqli_fetch_assoc($result)) {
                        // $today = $_SESSION['today'];
                        $id = $row['ID'];
                        $sql = "SELECT * FROM `general_info` WHERE `ID` = '$id';";
                        $result1 = mysqli_query($conn, $sql);
                        $row1 = mysqli_fetch_assoc($result1);
                        $sql = "SELECT * FROM `in_at` WHERE TIMESTAMP = '$today' && ID = '$id';";
                        $result2 = mysqli_query($conn, $sql);
                        $row2 = mysqli_fetch_assoc($result2);
                        $time = $row2['TIME'];
                        $time = substr($time, 11);
                        // echo $x;
                        // echo "<br>";
                        $time = substr($time, -8, -3);
                        echo '<tr>
                          <td>'.$row1['ID'].'</td>
                          <td>'.$row1['RANK'].'</td>
                          <td>'.$row1['NAME'].'</td>
                          
                          <td>'.$time.'</td>
                          <td>
                          
                            <button type="button" class="details btn btn-primary";">
                              Details
                            </button>
                          </td>
                        </tr>';
                      }
                      
                        
                      echo '</tbody>
                    </table>
                  </div>
                </div>
                
  
                
              </div>
                  ';
                }
              ?>


            
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Your Website 2020</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Select "Logout" below if you are ready to end your current session.
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
              Cancel
            </button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
      
      /* console.log(document.getElementById("show"));
      setInterval(function () {
        let text = document.getElementById("armyid").value;
        console.log(text);
        document.getElementById("show").innerHTML += text.nodeValue;
      }, 1000);
       */
      document.getElementById('armyid').addEventListener('keyup', (e)=>{
        // console.log("hello");
        var res = e.target.value; 
        var ajax = new XMLHttpRequest();
        var method = "GET";
        var url = "data.php?id="+res;
        var asynchronous = true;
        
        ajax.open(method, url, asynchronous);

        ajax.send();
        ajax.onreadystatechange = function() {
          if(this.readyState == 4 && this.status == 200) {
            if(this.responseText == 0) {
              // console.log(this.responseText);
              window.location.href = "tables.php";
            }
          }
        }
        // window.location.href = "tables.php?id="+res;
      }) 
      
    </script>
    <script>
      details = document.getElementsByClassName('details');
      Array.from(details).forEach((element) => {
        element.addEventListener("click", (e) => {
          // console.log("delete ", );
          tr = e.target.parentNode.parentNode;
          // console.log(tr);
          // pkg_id.value = tr.getElementsByTagName("td")[0].innerText;
          // var val = tr.getElementsByTagName("td")[0].innerText;
          var res = tr.getElementsByTagName("td")[0].innerText; 
          var ajax = new XMLHttpRequest();
          var method = "GET";
          var url = "data1.php?id="+res;
          var asynchronous = true;
          
          ajax.open(method, url, asynchronous);

          ajax.send();
          ajax.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
              // if(this.responseText == 0) {
                // console.log(this.responseText);
                // window.location.href = "tables.php";
              // }
              window.location.href = "profile.php";
            }
          }
            // $('#exampleModal1').modal('toggle');
          })
      })
    </script>

  </body>
</html>
