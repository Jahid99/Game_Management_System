<?php include 'inc/header.php'; ?>


    <div class="col-sm-6 col-md-8">
    
         <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Change Password
                        </h1><hr>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-md-12">

            <?php 
                if ($_SERVER['REQUEST_METHOD']=='POST') {
               
                $password_old =  $fm->validation($_POST['password_old']);
                $password_new =  $fm->validation($_POST['password_new']);
                $password_old =  mysqli_real_escape_string($db->link,$password_old);
                $password_new =  mysqli_real_escape_string($db->link,$password_new);
             
                if(empty($password_old) || empty($password_new)){
                 echo "<span class='label label-danger'>Field must not be empty  !!!</span><br><br>";
               }else{
                $username = Session::get('username');
                $password_new = password_hash($password_new, PASSWORD_BCRYPT);

                $query = "SELECT * FROM tbl_admin WHERE username = '$username'";
                $result = $db->select($query);
                if($result!= false){
                    $value = $result->fetch_assoc();
                    $dbpassword = $value['password'];
                    if(password_verify($password_old, $dbpassword)){
                    $query = "UPDATE tbl_admin
                SET
                password = '$password_new'
                WHERE username = '$username'";

                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span class='label label-success'>Password Updated Successfully  !!!</span><br><br>";
                   
                }
                    }else{
                        echo "<span class='label label-danger'>Old Password does not matched   !!!</span><br><br>";
                        
                    }
                    
                }else {
                     echo "<span class='label label-danger'>Password Not Updated   !!!</span><br><br>";
                }

                     }
                 }
             ?>
                     <form action="" method="post">
                        <table class="form">                    
                            <tr>
                                <td>
                                    <label class="form-group">Old Password :</label>
                                </td>
                                <td>
                                    <input type="text" name="password_old" class="form-control" placeholder="Enter Old Password..."   class="medium" /><br>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    <label class="form-group">New Password :</label>
                                </td>
                                <td>
                                    <input type="text" name="password_new" class="form-control" placeholder="Enter New Password..."  class="medium" /><br>

                                </td>
                            </tr>
                             
                            
                             <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="submit" class="btn btn-default" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>