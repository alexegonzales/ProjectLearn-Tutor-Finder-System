<?php

    include ("../connection.php");

    session_start();

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM admin WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: admin_login.php?restricted-adm");

    }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Table</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" type="text/css" href ="../css/admin_tbl.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/admin_tbl.css">

    <link rel="icon" type="image/x-icon" href="../assets/logo_yellow.png"/>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <nav class="navbar">
        <div class="container-nav">
            <a class="navbar-brand" href="admin_page.php">
                <span class="fas fa-arrow-left back"></span>
                <label for="" class="back-lbl">Back</label>    
            </a>
        </div>
    </nav>
    <section id="post">
		<div class="container">
        <div class="tbl-list">
            <label>Tutor Table List</label>
        </div>
			<div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tbl-req" id="table-list">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Topic/s</th>
                                    <th>Sex</th>
                                    <th>Education</th>
                                    <th>Status</th>
                                    <th>Register Date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                        // $sql = "SELECT * FROM tutors ORDER BY id";
                                        $sql = "SELECT t.*, GROUP_CONCAT(p.topic_name SEPARATOR ', ') 
                                        AS topic_name 
                                        FROM tutors t,topics p 
                                        WHERE t.id = p.tutor_id 
                                        GROUP BY id 
                                        ORDER BY id";
                                       
                                        // $sql= "SELECT GROUP_CONCAT(topic_name SEPARATOR ', ') AS topic_name FROM topics WHERE tutor_id = 19";

                                        $output = '';

                                        $que = mysqli_query($conn,$sql);

                                        $cnt = 1;

                                        $check_que = mysqli_num_rows($que) > 0;

                                        if ($check_que) {

                                            while ($result = mysqli_fetch_assoc($que)) {
                                            
                                        ?>

                                        
                                    <tr>
                                        <td><?php echo $cnt;?></td>
                                        <td><?php echo $result['firstname'] .' '. $result['lastname']; ?></td>
                                        <td><?php echo $result['email']; ?></td>
                                        <td><?php echo $result['contact']; ?></td>
                                        <td><?php echo $result['topic_name']; ?></td>
                                        <td><?php echo $result['sex']; ?></td>
                                        <td><?php echo $result['education']; ?></td>
                                        <td><?php echo $result['tutor_status']; ?></td>
                                        <td><?php echo date('Y/m/d h:i:s A', strtotime($result["reg_date"])); ?></td>
                                        <td>
                                            <!-- trigger editModal -->
                                            <button type="button" class="btn fa-solid fa-pen-to-square edit" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $result['id']?>"></button>
                            
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal<?php echo $result['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Student Details</h1>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="error"></div>
                                                            <form action="update_users.php" method="post">
                                                                <input type="hidden" name="id" id="id" value="<?php echo $result['id']; ?>">
                                                                <div class="mb-3">
                                                                    <label for="firstname" class="col-form-label">First name:</label>
                                                                    <input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo $result['firstname']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="lastname" class="col-form-label">Last name:</label>
                                                                    <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo $result['lastname']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email" class="col-form-label">Email:</label>
                                                                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $result['email']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="contact" class="col-form-label">Contact:</label>
                                                                    <input type="text" name="contact" class="form-control" id="contact" value="<?php echo $result['contact']; ?>">
                                                                </div>
                                                                <div class="form-group mt-4">
                                                                    <button type="submit" name="editTutor" class="btn confirm">Edit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <?php

                                            $cnt++; }

                                        } else {

                                            ?>
                                    </tr>        
                                    <table class="new-tbl">
                                        <thead class="no-req">
                                            <th >No Student Yet</th>
                                        </thead>
                                    
                                    </table>
                                    <?php

                                        } 

                                        ?>
                                </tbody>
                    </table>
                </div>
			</div>
		</div>
	</section>
    
    
  </body>
</html>