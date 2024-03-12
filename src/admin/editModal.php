<?php 
    include ("../connection.php");
                                    
        $sql = "SELECT * FROM students";

        $output = '';

        $que = mysqli_query($conn,$sql);


        $check_que = mysqli_num_rows($que) > 0;

            if ($check_que) {

                while ($result = mysqli_fetch_assoc($que)) {
                                        
?>
<!-- Modal -->
<div class="modal fade" id="editModal<?php echo $result['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="firstname" class="col-form-label">First name:</label>
                <input type="text" class="form-control" id="firstname" value="<?php echo $result['firstname']; ?>">
            </div>
            <div class="mb-3">
                <label for="lastname" class="col-form-label">Last name:</label>
                <input type="text" class="form-control" id="lastname" value="<?php echo $result['lastname']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="col-form-label">Email:</label>
                <input type="email" class="form-control" id="email" value="<?php echo $result['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="contact" class="col-form-label">Contact:</label>
                <input type="text" class="form-control" id="contact" value="<?php echo $result['contact']; ?>">
            </div>
            <div class="form-group mt-4">
                <button type="submit" name="edit" class="btn confirm">Edit</button>
            </div>
        </form>
    </div>
  </div>
</div>
<?php

                }

            }else {

                echo "no details found";

            }
        ?>