<?php

    include 'connection.php';

    session_start();

    //Redirect to login if not login yet
    $select_sess = mysqli_query($conn, "SELECT * FROM tutors WHERE email='$_SESSION[email]' AND password='$_SESSION[password]'");
    $select_sess_result = mysqli_num_rows($select_sess);

    if($select_sess_result==0) {

        header("location: tutor_login.php?restricted-tch");
    }

    error_reporting(0);

    $id =  $_SESSION['id'];
    $rowimg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tutors WHERE id = $id"));

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- font awesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <!-- <link rel="stylesheet" type="text/css" href ="css/acc_sett.css"> -->
    <link rel="stylesheet" href="https://alexe-ctrl.github.io/css/acc_sett.css">

    <title>UPDATE</title>
    <link rel="icon" type="image/x-icon" href="assets/logo_yellow.png" />
  </head>
  <body>
      <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="row no-gutters">
                <div class="col">
                    <div class="card login-card">
                        <div class="card-body">
                        <a href="tutor_page.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                            <h2 class="acc_sett_text">Account settings</h2>
                            <form class="form" id="form" action="" method="POST" enctype="multipart/form-data">
                                <div class="upload">
                                    <?php
                                        $id = $rowimg['id'];
                                        $profile = $rowimg['profile'];
                                    ?>
                                    <img src="uploads/<?php echo $profile; ?>" alt="" width="125" height="125" title="<?php echo $profile; ?>">
                                    <div class="round">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="file" name="profile" id="profile" accept=".jpg, .jpeg, .png">
                                        <i class="fa fa-camera" ></i>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-borderless">
                                <?php
                                    //Query to get the current student's account details
                                    $select = mysqli_query($conn, "SELECT * FROM tutors WHERE id=$_SESSION[id]") or die(mysqli_error());

                                    while($rows = mysqli_fetch_array($select)) {
                                ?>
                            
                                <tr>
                                    <td class="lbl">Name:</td>
                                    <td align="justify" class="info"><?php echo $rows['firstname'] . " " . $rows['lastname'];?></td>
                                </tr>
                                <tr>
                                    <td class="lbl">Email:</td>
                                    <td align="justify" class="info"><?php echo $rows['email'];?></td>
                                </tr>
                                <tr>
                                    <td class="lbl">Contact:</td>
                                    <td align="justify" class="info"><?php echo $rows['contact'];?></td>
                                </tr>
                                <tr>
                                    <td class="lbl">Sex:</td>
                                    <td align="justify" class="info"><?php echo $rows['sex'];?></td>
                                </tr>
                                <tr>
                                    <td class="lbl">Educational Attainment:</td>
                                    <td align="justify" class="info"><?php echo $rows['education'];?></td>
                                </tr>
                                <tr>
                                    <td class="lbl">Bio:</td>
                                    <td align="justify" class="info"><?php echo $rows['bio'];?></td>
                                </tr>
                                <?php

                                    }
                                ?>
                            </table>
                            <div class="btn-view">
                                <button type="button" class="btn-modal" data-bs-toggle="modal" data-bs-target="#update<?php echo $_SESSION['id']?>">update</button>
                                <button type="button" class="btn-modal" data-bs-toggle="modal" data-bs-target="#delete<?php echo $_SESSION['id']?>">delete</button>
                            </div>
                        </div>
                        <!-- Modal update-->
                        <div class="modal fade" id="update<?php echo $_SESSION['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="error"></div>
                                    <form action="update_query.php" method="POST" class="form-update" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                                            <div class="input-group">
                                                <input type="text" name="firstname" id="firstname" placeholder="First name" value="<?php echo $_SESSION['firstname']; ?>">
                                            </div>
                                            <div class="input-group">
                                                <input type="text" name="lastname" id="lastname" placeholder="Last name" value="<?php echo $_SESSION['lastname']; ?>">
                                            </div>
                                            <div class="input-group">
                                                <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $_SESSION['email']; ?>">
                                            </div>
                                            <div class="input-group">
                                                <input type="text" name="contact" id="contact" placeholder="Contact" value="<?php echo $_SESSION['contact']; ?>">
                                            </div>
                                            <div class="input-group">
                                                <input type="text" name="education" id="education" placeholder="Educational Attainment" value="<?php echo $_SESSION['education']; ?>">
                                            </div>
                                            <div class="bio-box">
                                                <label class="lbl-bio">Bio:</label>
                                                <input type="text" name="bio" id="bio" placeholder="Bio" value="<?php echo $_SESSION['bio']; ?>">
                                            </div>
                                            <div class="radio-group">
                                                <label class="lbl-radio">Sex :</label>
                                                <input type="radio" name="sex" value="male" required>
                                                <label class="lbl-radio">Male</label>
                                                <input type="radio" name="sex" value="female">
                                                <label class="lbl-radio">Female</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button name="updateTutor" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal delete-->
                        <div class="modal fade" id="delete<?php echo $_SESSION['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete User Account</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="tutor_del_rev_fk.php" method="GET">
                                        <div class="modal-body-del">
                                            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                                            <h6>Are you sure you want to delete your account?</h6>
                                            This account will be deleted immediately. You can' t undo this action.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button name="deleteTutor" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Delete</button>
                                        </div> 
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
      </main>
    
    <script type="text/javascript">
      document.getElementById("profile").onchange = function(){

          document.getElementById("form").submit();
      };
    </script>
    <?php
        if(isset($_FILES["profile"]["name"])){

            $id = $_POST["id"];

            $imageName = $_FILES["profile"]["name"];
            $imageSize = $_FILES["profile"]["size"];
            $tmpName = $_FILES["profile"]["tmp_name"];

            // Image validation
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)){

                echo
                    "
                    <script>
                    alert('Invalid Image Extension');
                    document.location.href = '../Learn(Final)';
                    </script>
                    ";

            }elseif ($imageSize > 1200000){

                echo
                    "
                    <script>
                    alert('Image Size Is Too Large');
                    document.location.href = '../Learn(Final)';
                    </script>
                    ";

            }else{
                $newImageName = $imageName . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
                $newImageName .= '.' . $imageExtension;

                $query = "UPDATE tutors SET profile = '$newImageName' WHERE id = $id";
                
                mysqli_query($conn, $query);
                move_uploaded_file($tmpName, 'uploads/' . $newImageName);

                echo
                    "
                    <script>
                        document.location.href = 'tutor_acc_sett.php';
                    </script>
                    ";
            }
        }
    ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
  </body>
</html>