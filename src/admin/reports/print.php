<?php
    include ("../../connection.php");

    session_start();

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM admin WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: ../admin_login.php?restricted-adm");

    }
    
    $id = $_SESSION['admin_id'];
    
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">  

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" type="text/css" href ="../css/admin_page.css"> -->
    <!-- <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/pending.css"> -->
    <link rel="stylesheet" type="text/css" href ="../../css/reports.css">

    <!-- filter -->
    <!-- <link rel="stylesheet" type="text/css" href="../../jquery-ui.css">

    <script type="text/javascript" src="../../jquery-1.12.4.js"></script>
    <script ype="text/javascript" src="../../jquery-ui.js"></script> -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <link rel="stylesheet" type="text/css" href="../../css/print.css" media="print">

    <script>
        $( function() {
            $( "#from" ).datepicker();
        } );

        $( function() {
            $( "#to" ).datepicker();
        } );
    </script>
    <script>
        $(document).ready(function() {

        });
    </script>

    <link rel="icon" type="image/x-icon" href="../../assets/logo_yellow.png"/>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light sticky-top" id="nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../assets/logo.png" alt="" width="40" height="34">
            </a>
            <a class="navbar-brand" href="">
                <h2 class="learn">Learn</h2>
            </a>
            <a class="navbar-toggler" type="a" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </a>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link opt" href="../admin_page.php">
                            <i class="fa-solid fa-table-columns"></i>
                            <label>dashboard</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="../tutor_verification_request.php">
                            <i class="fa-solid fa-square-check"></i>
                            <label>tutor request</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="../std_verification_req.php">
                            <i class="fa-solid fa-circle-check"></i>
                            <label>student request</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt" href="../transactions.php">
                            <i class="fa-solid fa-receipt"></i>
                            <label>transactions</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link opt active" href="admin_reports.php">
                            <i class="fa-solid fa-print"></i>
                            <label>reports</label>
                        </a>
                    </li>
                </ul>
                <div class="topbar-divider d-none d-sm-block"></div>
                <span class="navbar-text">
                    <div class="btn-group">
                        <div class="ddown flex-nowrap btn-group" data-bs-toggle="dropdown" aria-expanded="false">
                            <button class="fullname"><?php echo $_SESSION['name']; ?></button>
                            <img src="../../assets/avatar.png" class="profile-pic" alt="">
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end justify-content-center shadow animated--grow-in">
                            <li><a class="dropdown-item" href="../admin_acc_sett.php">Account settings</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="../admin_logout.php" style="color: red;">Log out</a></li>
                        </ul>
                    </div>
                </span>
            </div>
        </div>
    </nav>
    <div class="main-container">
        <section id="post">
            <div class="container">
                <label for="" class="title">Printable Reports (Tutors)</label>
                <div class="tbl-list">
                    <form method="POST" action="" class="form-sort">
                        <div class="form-inline">
                            <select id="select" class="form-select" name="all_tables" onchange="location = this.value;">
                                <option disabled selected>Select Table</option>
                                <option value="tutors_tbl.php">Tutors</option>
                                <option value="students_tbl.php">Students</option>
                                <option value="enroll_req_tbl.php">Enroll</option>
                                <option value="transaction_tbl.php">Payment Transactions</option>
                            </select>
                            <select id="select"class="form-select" name="gender">
                                <option selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div id="select"class="form-group">
                                <input type="text" name="topic_name" class="form-control" placeholder="Topics">
                            </div>
                            <select id="select" class="form-select" name="verification_status">
                                <option selected>Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Verified">Verified</option>
                                <option value="Declined">Declined</option>
                            </select>
                            <div id="select" class="form-group">
                                <input type="text" name="from_date" id="from" class="form-control" placeholder ="From">   
                            </div>
                            <div id="select" class="form-group">
                                <input type="text" name="to_date" id="to" class="form-control" placeholder ="To">  
                            </div>
                            <button id="select" type="submit" class="btn sort" name="sort">Sort</button>
                            <button id="select" class="btn reset" name="reset">Reset</button>
                            
                            <button type="submit" onclick="window.print();" id="print" class="btn btn-warning print" name="print">Generate PDF</button>
                          
                        </div>
                    </form>
                </div>  
                <div class="row">
                    <table class="table table-hover table-striped reports-tbl" id="table-list">
                        <thead>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Gender</th>
                            <th>Topics</th>
                            <th>Verification Status</th>
                            <th>Education</th>
                            <th>Registration Date</th>
                        </thead>
                        <tbody>
                            <?php

                                if(!isset($_POST['sort'])) {

                                    $sql = "SELECT t.*, GROUP_CONCAT(p.topic_name SEPARATOR ', ') 
                                    AS topic_name 
                                    FROM tutors t,topics p 
                                    WHERE t.id = p.tutor_id 
                                    GROUP BY id 
                                    ORDER BY id";
    
                                    $output = '';
    
                                    $que = mysqli_query($conn,$sql);
    
                                    $cnt = 1;
    
                                    $check_que = mysqli_num_rows($que) > 0;
    
                                    if ($check_que) {
    
                                        while ($result = mysqli_fetch_assoc($que)) {
                                ?>
                                <tr>
                                    <td><?php echo $cnt;?></td>
                                    <td><?php echo $result['id'];?></td>
                                    <td><?php echo $result['firstname'] . ' ' . $result['lastname'];?></td>
                                    <td><?php echo $result['email'];?></td>
                                    <td><?php echo $result['contact'];?></td>
                                    <td><?php echo $result['sex'];?></td>
                                    <td><?php echo $result['topic_name'];?></td>
                                    <td><?php echo $result['verification_status'];?></td>
                                    <td><?php echo $result['education'];?></td>
                                    <td><?php echo date('Y/m/d h:i:s A', strtotime($result["reg_date"]));?></td>
                                </tr>
                                
                                <?php
                                        $cnt++; }
    
                                    } else {
    
                                        ?>
                                </tr>        
                                <table class="new-tbl">
                                    <thead class="no-req">
                                        <th >No Record Yet</th>
                                    </thead>
                                
                                </table>
                                <?php
    
                                    } 

                                } elseif (isset($_POST['reset'])) {
                                
                                    $sql = "SELECT t.*, GROUP_CONCAT(p.topic_name SEPARATOR ', ') 
                                    AS topic_name 
                                    FROM tutors t,topics p 
                                    WHERE t.id = p.tutor_id 
                                    GROUP BY id 
                                    ORDER BY id";
    
                                    $output = '';
    
                                    $que = mysqli_query($conn,$sql);
    
                                    $cnt = 1;
    
                                    $check_que = mysqli_num_rows($que) > 0;
    
                                    if ($check_que) {
    
                                        while ($result = mysqli_fetch_assoc($que)) {
                                ?>
                                <tr>
                                    <td><?php echo $cnt;?></td>
                                    <td><?php echo $result['id'];?></td>
                                    <td><?php echo $result['firstname'] . ' ' . $result['lastname'];?></td>
                                    <td><?php echo $result['email'];?></td>
                                    <td><?php echo $result['contact'];?></td>
                                    <td><?php echo $result['sex'];?></td>
                                    <td><?php echo $result['topic_name'];?></td>
                                    <td><?php echo $result['verification_status'];?></td>
                                    <td><?php echo $result['education'];?></td>
                                    <td><?php echo date('Y/m/d h:i:s A', strtotime($result["reg_date"]));?></td>
                                </tr>
                                
                                <?php
                                        $cnt++; }
    
                                    } else {
    
                                        ?>
                                </tr>        
                                <table class="new-tbl">
                                    <thead class="no-req">
                                        <th >No Record Yet</th>
                                    </thead>
                                
                                </table>
                                <?php
    
                                    } 

                                } else {

                                    $gender = $_POST['gender'];
                                    $topics = $_POST['topic_name'];
                                    $status = $_POST['verification_status'];
                                    $from_date = $_POST['from_date'];
                                    $fdate = strtotime($from_date);
                                    $fdate = date('Y/m/d h:i:s A', $fdate);
                                    $to_date = $_POST['to_date'];
                                    $tdate = strtotime($to_date);
                                    $tdate = date('Y/m/d h:i:s A', $tdate);

                                    if($gender != "" || $topics != "" || $status != "" || $fdate != "" || $tdate != "") {

                                        $sql = "SELECT t.*, GROUP_CONCAT(p.topic_name SEPARATOR ', ') 
                                        AS topic_name 
                                        FROM tutors t,topics p 
                                        WHERE t.id = p.tutor_id AND sex = '$gender' OR t.id = p.tutor_id AND topic_name = '$topics' 
                                        OR t.id = p.tutor_id AND verification_status = '$status' OR t.id = p.tutor_id AND reg_date >= '$fdate'
                                        AND t.id = p.tutor_id AND reg_date <= '$tdate'
                                        GROUP BY id 
                                        ORDER BY id";

                                        $output = '';

                                        $que = mysqli_query($conn,$sql);

                                        $cnt = 1;

                                        $check_que = mysqli_num_rows($que) > 0;

                                        if ($check_que) {

                                            while ($result = mysqli_fetch_assoc($que)) {
                                ?>
                            <tr>
                                <td><?php echo $cnt;?></td>
                                <td><?php echo $result['id'];?></td>
                                <td><?php echo $result['firstname'] . ' ' . $result['lastname'];?></td>
                                <td><?php echo $result['email'];?></td>
                                <td><?php echo $result['contact'];?></td>
                                <td><?php echo $result['sex'];?></td>
                                <td><?php echo $result['topic_name'];?></td>
                                <td><?php echo $result['verification_status'];?></td>
                                <td><?php echo $result['education'];?></td>
                                <td><?php echo date('Y/m/d h:i:s A', strtotime($result["reg_date"]));?></td>
                            </tr>
                            <?php
                                            $cnt++; }

                                        } else {

                                    ?>
                            </tr>        
                            <table class="new-tbl">
                                <thead class="no-req">
                                    <th >No Record Yet</th>
                                </thead>
                            
                            </table>
                                <?php
                                        }
                                    }
                                } 
                            ?>
                        </tbody> 	
                    </table>
                </div>
            </div>
        </section>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>