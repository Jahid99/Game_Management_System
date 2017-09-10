<?php include 'inc/header.php'; ?>

        <?php 
            if (!isset($_GET['id']) || $_GET['id'] == NULL) {
                echo "<script>window.location='index.php';</script>";
            }else{
                $id = $_GET['id'];
            }

         ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edit Division and Rank
                        </h1><hr>
                    </div>
                </div>
        <?php 
             if ($_SERVER['REQUEST_METHOD']=='POST') {  
                $division = $_POST['division'];      
                $rank = $_POST['rank'];      
                $division =  mysqli_real_escape_string($db->link,$division);
                $rank =  mysqli_real_escape_string($db->link,$rank);
             
               if(empty($division) || empty($rank)){
                echo "<span class='label label-danger'>Field must not be empty !!!</span><br><br>";
               }elseif($division<0 || $division>10 || $rank<0 || $rank>5){
                    echo "<span class='label label-danger'>Division must be between 1-10 and Rank must be between 1-5 !!!</span><br><br>";
               }elseif(((Session::get('division'))<=$division) || ((Session::get('division'))==($division+1))){
                echo "<span class='label label-danger'>You cannot promote this user !!!</span><br><br>";
               }elseif((Session::get('division'))==10){

                $query = "UPDATE tbl_users
                SET
                division = '$division',
                rank = '$rank'
                WHERE id = $id;";

                    $updated_row = $db->update($query);
                    if ($updated_row) {
                                 echo "<span class='label label-success'>Data Updated Successfully !!!</span><br><br>";
                     
                    }
                        }else {
                    $user_division = Session::get('user_division');
                            $user_rank = Session::get('user_rank');


                        if($user_division > $division || $user_rank > $rank){
                            echo "<span class='label label-danger'>You can not demote this user !!!</span><br><br>";
                        }else{
                            $query = "UPDATE tbl_users
                            SET
                            division = '$division',
                            rank = '$rank'
                            WHERE id = $id;";

                        $updated_row = $db->update($query);
                        if ($updated_row) {
                           echo "<span class='label label-success'>Data Updated Successfully !!!</span><br><br>";
                     
                         }
                            }
                        }
                           
                    }          
                ?>

        <?php 
            $query = "select * from tbl_users where id='$id'";
            $singleuser = $db->select($query);
            if($singleuser){
            while ($result = $singleuser->fetch_assoc()) {
            Session::set("user_division",$result['division']);
            Session::set("user_rank",$result['rank']);
         ?>
                 
        	<form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                                <label class="form-group">Character Name : </label>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="character_name" value="<?php  echo $result['character_name']; ?>" class="medium" disabled="disabled"/><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-group">Division : </label>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="division" value="<?php  echo $result['division']; ?>" class="medium" /><br>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                <label class="form-group">Rank : </label>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="rank" value="<?php  echo $result['rank']; ?>" class="medium" /><br>
                            </td>

                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" class="btn btn-default" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>

                <?php } } ?>

<?php include 'inc/footer.php'; ?>