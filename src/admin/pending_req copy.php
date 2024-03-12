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
                <label for="">Pending Request</label>
                <a href="pending_req.php" class="refresh">
                    <span class="fa-solid fa-rotate-right"></span>
                </a>
            </div>    
			<div class="row">
			    <table class="table table-hover table-striped tbl" id="table-list">
					<thead>
						<th>#</th>
						<th>Name</th>
						<th>Request Date</th>
						<th>Request Status</th>
                        <th class="cr"></th>
					</thead>
					<tbody>
							<?php 
                                    // query for displaying pending requests
									$sql = "SELECT * FROM credibility WHERE receiver_id = '$id' 
                                    AND req_status = 0 
                                    ORDER BY cred_id";

                                    $output = '';

									$que = mysqli_query($conn,$sql);

									$cnt = 1;

                                    $check_que = mysqli_num_rows($que) > 0;

                                    if ($check_que) {

									    while ($result = mysqli_fetch_assoc($que)) {
										
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['notif_subj']; ?></td>
							 		<td><?php echo date('Y/m/d h:i:s A', strtotime($result["reg_date"])); ?></td>
							 		<td>
							 			<?php 
							 			if ($result['req_status'] == 0) {
							 				echo "<span class='badge badge-secondary pen'>Pending</span>";
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm view" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $result['cred_id']; ?>">
                                            View Credential
                                        </button>
                                        <!-- Cred Modal -->
                                        <div class="modal fade modal-lg" id="viewModal<?php echo $result['cred_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Credential</h1>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="../credentials/<?php echo $result['cred_pic'];?>" class="cred-pic" alt="">
                                                </div>
                                                <form action="admin_action.php" method="post">
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="appid" value="<?php echo $result['cred_id']; ?>">
                                                        <input type="hidden" name="sender_id" value="<?php echo $result['sender_id']; ?>"> <!--sender id-->
                                                        <input type="hidden" name="receiver_id" value="<?php echo $id; ?>"> <!--receiver id-->
                                                        <input type="hidden" name="notif_subj" id="notif_subj" value="admin">  
                                                        <input type="hidden" name="notif_msgv" id="notif_msgv" value="Your account has beed verified.">
                                                        <button type="submit" name="verify" class="btn verify" data-bs-dismiss="modal">Verify</button>
                                                        <button type="button" class="btn decline" data-bs-toggle="modal" data-bs-target="#declineModal">Decline</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Decline Modal -->
                                        <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header dec">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reason for Declining</h1>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                     <div class="modal-body">
                                                            <form action="admin_action.php" method="post">
                                                                <input type="hidden" name="appid" value="<?php echo $result['cred_id']; ?>">
                                                                <input type="hidden" name="sender_id" value="<?php echo $result['sender_id']; ?>"> <!--sender id-->
                                                                <input type="hidden" name="receiver_id" value="<?php echo $id; ?>"> <!--receiver id-->
                                                                <input type="hidden" name="notif_subj" id="notif_subj" value="Declined">  
                                                                <textarea cols="60" rows="2"name="notif_msgd" id="notif_msgd"></textarea>                                          
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary can" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="decline" class="btn decC">Confirm</button>
                                                </div>
                                                            </form>
                                                </div>
                                            </div>
                                        </div>

                                        
							 		</td>
                                    <?php
                                        } elseif ($result['req_status'] == 1) {
							 				echo "<span class='badge badge-success app'>Verified</span>";
                             
                                    
                                        } else {
											echo "<span class='badge badge-danger rej'>Declined</span>";

                                        }

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