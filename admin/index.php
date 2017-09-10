<?php include 'inc/header.php'; ?>
    <div class="container">
      <div class="row">
        <h2>Select ranks and divisions can post/reply</h2><hr>
          <?php 

            if ($_SERVER['REQUEST_METHOD']=='POST') {
            $allowed_divisions_ranks = $_POST['allowed_divisions_ranks'];
            $allowed_divisions_ranks = serialize($allowed_divisions_ranks);
            $query = "UPDATE tbl_admin
                        SET
                        allowed_divisions_ranks = '$allowed_divisions_ranks'
                        WHERE id = 1;
                ";

                $updated_row = $db->update($query);
                if ($updated_row) {
                    echo "<span class='label label-success'>Data Updated Successfully !!!</span><br><br>";
                 
                }else {
                    echo "<span class='label label-danger'>Data Not Updated !!!</span><br><br>";
                }

             }

           ?>
            <form action="" method="POST">
                <?php for($i=1;$i<=10;$i++){ ?>
            	       <?php for($j=1;$j<=5;$j++){ ?>
                        <?php echo "<div class='col-md-2'>"; ?>
                           <?php 
                             $division_and_rank = 'division '.$i. ' rank '. $j;
                           ?>
          	    <div class="checkbox">
          	      <label><input type="checkbox"

                    <?php 
                  $query = "SELECT allowed_divisions_ranks FROM tbl_admin";
                  $users = $db->select($query);
                  if ($users) {
                  
                  while ($result = $users->fetch_assoc()) {
                
                  $allowed_divisions_ranks = unserialize($result['allowed_divisions_ranks']);
                  $cnt = count($allowed_divisions_ranks);
                 
                  
                  foreach($allowed_divisions_ranks as $allowed_divisions_rank){
                 ?>


                 <?php if($allowed_divisions_rank==$division_and_rank){ ?>

                  checked="checked"

                  <?php } } } } ?>

                   name="allowed_divisions_ranks[]" value="division <?php echo $i?> rank <?php echo $j?>">division <?php echo $i?> rank <?php echo $j?></label>
          	    </div>

              <?php echo "</div>"; ?>

              <?php } }?>
              <input name="allowed_divisions_ranks[]" value="0" type="hidden"><br>
                <button style="padding: 11px 54px;margin: 51px 119px;" class="btn btn-primary" type="submit">Add</button>
            </form>
          </div>
        </div>
       
<?php include 'inc/footer.php'; ?>