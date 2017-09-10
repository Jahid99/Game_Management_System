<?php include 'inc/header.php'; ?>

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Player's Profile:
                        </h1><hr>
                    </div>
                </div>
                <?php 
                    if (!isset($_GET['id']) || $_GET['id'] == NULL) {
                        echo "<script>window.location='index.php';</script>";
                    }else{
                        $id = $_GET['id'];
                    }

                 ?>

                  <div class="col-sm-6 col-md-8">
                    <?php 
                            $query = "select * from tbl_users where id='$id'";
                            $singleuser = $db->select($query);
                            if($singleuser){
                            while ($result = $singleuser->fetch_assoc()) {
                        ?>          
                                        <img class="img-responsive img-blog" src="<?php echo  $result['avatar'];?>" width="40%" alt="" />
                                        <h4>
                                            <?php  echo $result['character_name']; ?></h4>
                                       
                                        <p>
                                             <i class="glyphicon glyphicon-info-sign"></i>Division <?php  echo $result['division']; ?>,  Rank : <?php  echo $result['rank']; ?>
                                            <br />
                                            <i class="glyphicon glyphicon-envelope"></i><?php  echo $result['email']; ?>                                      

                                <?php } } ?>
                 </div>

<?php include 'inc/footer.php'; ?>