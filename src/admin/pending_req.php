<?php
    include ("../connection.php");

    session_start();

    $id =  $_SESSION['admin_id'];

    error_reporting(0);
   
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pending Request</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!--for copy icon-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--script for notif-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" type="text/css" href ="../css/pending.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/pending.css">

	<link rel="icon" type="image/x-icon" href="../assets/logo_yellow.png" />

    <script src="js/notif.js"></script>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

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
     <!--This is section-->
	<section id="sections" class="py-4 mb-2 bg-faded">
        <div class="msg">
            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['removed'])) { ?>
                <p class="removed"><?php echo $_GET['removed']; ?></p>
            <?php } ?>
        </div>
        
	</section>
    <!----Section2 for showing Post Model ---->
	<section id="post">
		<div class="container">
            <div class="tbl-list">
                <label for="">Tutor Pending Request</label>
                <a href="pending_req.php" class="refresh">
                    <span class="fa-solid fa-rotate-right"></span>
                </a>
            </div>    
			<div class="row">
			    <table class="table table-hover table-striped tbl" id="table-list">
					<thead>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Sex</th>
                        <th>Registration Date</th>
                        <th>Status</th>
                        <th>Credentials</th>
                        <th>Action</th>
					</thead>
					<tbody>
							<?php 
                                    // query for displaying pending requests
									$sql = "SELECT * FROM tutors WHERE verification_status = 'Pending' ORDER BY id ASC";

                                    $output = '';

									$que = mysqli_query($conn,$sql);

									$cnt = 1;

                                    $check_que = mysqli_num_rows($que) > 0;

                                    if ($check_que) {

									    while ($result = mysqli_fetch_assoc($que)) {
										
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['firstname'] ." " . $result['lastname']; ?></td>
                                    <td><?php echo $result['email']; ?></td>
                                    <td><?php echo $result['sex']; ?></td>
							 		<td><?php echo date('Y/m/d h:i:s A', strtotime($result["reg_date"])); ?></td>
							 		<td>
							 			<span class='badge badge-secondary pen'>Pending</span>
                                    </td>
                                    <td>
                                        <a href="admin_view_credentials.php?id=<?php echo $result['id']; ?>" target="_blank"><input type="button" class="btn btn-sm view" value="View Credentials"></a>
                                    </td>
                                    <td>
                                        <form action="admin_action.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $result['id']?>">
                                            <input type='submit' class='btn btn-sm btn-success' name='verify' value='Verify'>
                                            <input type='submit' class='btn btn-sm btn-danger' name='decline' value='Decline'>                    
                                        </form>
							 		</td>
                                    <?php
                                        
							 	        $cnt++;	}

                                    } else {

							 				?>
                                        <table class="new-tbl">
                                            <thead class="no-req">
                                                <th >No Request Yet</th>
                                            </thead>
                                        </table>
                                        <?php

								    } 
							 		    ?>
							 		</td>
							 		
                                </tr>        
					</tbody> 	
				</table>
			</div>
		</div>
	</section>
    

    <script src="js/bootstrap.min.js"></script>

    <!--script for notif-->
    <script>
        $(document).ready(function() {
            function load_unseen_notification(view = '') {
                $.ajax({
                    url: "admin_fetch.php",
                    method: "POST",
                    data: {
                        view: view,
                        ids: "<?php echo $id; ?>"
                    },
                    dataType: "json",
                    success: function(data) {
                        // .dd class ng <ul> dropdown
                        $('.dd').html(data.notification);
                        if (data.unseen_notification > 0) {
                            $('.count').html(data.unseen_notification);
                        }
                    }
                });
            }
            load_unseen_notification();

            // .dt class ng button
            $(document).on('click', '.dt', function() {
                $('.count').html('');
                load_unseen_notification('yes');
            });
            setInterval(function() {
                load_unseen_notification();;
            }, 500);
        });
    </script>

  </body>
</html>