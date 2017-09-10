<?php include 'inc/header.php'; ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Edit Your Profile:
                </h1><hr>
            </div>
        </div>

         <div class="col-sm-6 col-md-8">
        <?php 
                $id = Session::get('userId');
        ?>

       <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {  
            $username =  mysqli_real_escape_string($db->link,$_POST['username']);
            $character_name =  mysqli_real_escape_string($db->link,$_POST['character_name']);
            $email =  mysqli_real_escape_string($db->link,$_POST['email']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;
            if ($username == "" || $character_name == "" || $email == "" ) {
                       echo "<span class='label label-danger'>Field must not be empty !!!</span><br><br>";
            }else{
            $usernamequery = "SELECT * FROM tbl_users where username = '$username' limit 1";
            $usernamecheck = $db->select($usernamequery);
            if ($usernamecheck == false) {
             $query = "UPDATE tbl_users
                    SET
                    username = '$username'
                    WHERE id = '$id';
            ";

                $updated_row = $db->update($query);
                if ($updated_row) {
                Session::set("message","Data Updated Successfully !!!");
                }else {
                 echo "<span class='label label-danger'>Data Updated Successfully !!!</span><br><br>";
                }
            }
            $characternamequery = "SELECT * FROM tbl_users where character_name = '$character_name' limit 1";
            $characternamecheck = $db->select($characternamequery);
            if ($characternamecheck == false) {           
                $query = "UPDATE tbl_users
                        SET
                        character_name = '$character_name'
                        WHERE id = '$id';
                ";

                $updated_row = $db->update($query);
                if ($updated_row) {
                Session::set("message","Data Updated Successfully !!!");
                }else {
                 echo "<span class='label label-danger'>Character Name Not Updated !!!</span><br><br>";
                     }

                 }
                 $mailquery = "SELECT * FROM tbl_users where email = '$email' limit 1";
                 $mailcheck = $db->select($mailquery);
                 if ($mailcheck == false) {         
                 $query = "UPDATE tbl_users
                        SET
                        email = '$email'
                        WHERE id = '$id';
                ";

                $updated_row = $db->update($query);
                if ($updated_row) {
                Session::set("message","Data Updated Successfully !!!");
                }else {
                 echo "<span class='label label-danger'>E-mail Not Updated !!!</span><br><br>";
                }

            }

            if (!empty($file_name)) {   
                if ($file_size >1048567) {
                 echo "<span class='error'>Image Size should be less then 1MB!
                 </span>";
                } elseif (in_array($file_ext, $permited) === false) {
                 echo "<span class='error'>You can upload only:-".implode(', ', 

                $permited)."</span>";
                } else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    Session::set("characterName",$character_name);
                    $query = "UPDATE tbl_users
                            SET
                            avatar = '$uploaded_image'
                            WHERE id = '$id';
                    ";

                    $updated_row = $db->update($query);
                        if ($updated_row) {
                        Session::set("message","Data Updated Successfully !!!");   
                            }else {
                                echo "<span class='label label-danger'>Image Not Updated !!!</span><br><br>";
                            }
                         }
                        }
                    }
                }
            ?>

            <?php 

               if(Session::get("message")){ ?>
                  <span class="label label-success"><?php echo Session::get("message"); ?></span><br><br>
                  <?php Session::unset_it("message");
                  }

            ?>

            <?php
                $query = "select * from tbl_users where id='$id'";
                $singleuser = $db->select($query);
                if($singleuser){
                while ($result = $singleuser->fetch_assoc()) {
            ?>    
                 
                   <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">
                        <tr>
                            <td>
                                <label class="form-group">Change Avatar :   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                            </td>
                            <td>
                                <img src="<?php echo  $result['avatar']; ?>" height="50px" width="100px"/><br/>
                                <input class="form-control" name="image" type="file" /><br>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label class="form-group">User Name :</label>
                            </td>
                            <td>
                                <input name="username" class="form-control" type="text" value="<?php echo $result['username']; ?>" class="medium" /><br>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label class="form-group">Character Name :</label>
                            </td>
                            <td>
                                <input name="character_name" class="form-control" type="text" value="<?php echo $result['character_name']; ?>" class="medium" /><br>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label class="form-group">Email :</label>
                            </td>
                            <td>
                                <input name="email" class="form-control" type="email" value="<?php echo $result['email']; ?>" class="medium" /><br>
                            </td>
                        </tr>
                        </table>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>           
                      <?php } } ?>
                    </div>
<?php include 'inc/footer.php'; ?>