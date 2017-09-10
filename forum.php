<?php include 'inc/header.php'; ?>
        
      	<div class="col-md-8">
      	<?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {  

            $title = $_POST['title'];
            $body = $_POST['body'];      
            $cat = $_POST['cat'];      
            $title =  mysqli_real_escape_string($db->link,$title);
            $body =  mysqli_real_escape_string($db->link,$body);
            $cat =  mysqli_real_escape_string($db->link,$cat);
            $slug = str_replace(' ', '-', $title);
         
               if(empty($title) || empty($body)){
                echo "<span class='label label-success'>Field must not be empty !!!</span><br><br>"; 
               }else{
                $slugquery = "SELECT * FROM tbl_post where slug = '$slug'";
                $slugcheck = $db->select($slugquery);
                if ($slugcheck != false) {
              
              $postquery = "SELECT * FROM tbl_post";
              $allposts = $db->select($postquery);
              if ($allposts != false) {
              while ($result = $allposts->fetch_assoc()) {
                $id = $result['id'];
                  }
                }
                $slug = $slug.$id;
              }

              
    
            	$character_name = Session::get('characterName');
            	$userid = Session::get('userId');
              $query = "INSERT INTO tbl_post(cat,title,body,slug,character_name,userid) VALUES ('$cat','$title','$body','$slug','$character_name','$userid')";
              $catinsert = $db->insert($query);
                if($catinsert){
                  echo "<span class='label label-success'>Post Inserted successfully !!!</span><br><br>";
                }   else {
                  echo "<span class='label label-success'>Post Not Inserted  !!!</span><br><br>";
                    
                  }
               }
            }
          ?>

          <?php 
            $division = Session::get('division');
            $rank = Session::get('rank');
            $division_and_rank = 'division '.$division.' rank '.$rank;
          ?>

          <?php 
            $query = "SELECT allowed_divisions_ranks FROM tbl_admin";
            $users = $db->select($query);
            if ($users) {
            while ($result = $users->fetch_assoc()) {
            $allowed_divisions_ranks = unserialize($result['allowed_divisions_ranks']);
            foreach($allowed_divisions_ranks as $allowed_divisions_rank){
          ?>

          <?php if($allowed_divisions_rank==$division_and_rank){ ?>
            <div class="well">
               <form action="" method="POST" class="form-horizontal" role="form">
                  <h4>Post Here</h4>

                    <div class="form-group" style="padding:14px;">
                      <label for="usr">Title:</label>
                      <input type="text" name="title" class="form-control" id="usr" style="min-width: 100%">
                    </div>

                    <div class="form-group" style="padding:14px;">
                      <label for="usr">Post:</label>
                      <textarea name="body" class="form-control" rows="5" style="min-width: 100%"></textarea>
                    </div>
                    <button class="btn btn-primary pull-right" type="submit">Post</button><ul class="list-inline"><li>Select Category : </li><li><select class="form-control" id="sel1"  name="cat">
                    <?php 
                        $query = "SELECT * FROM tbl_category";
                        $category = $db->select($query);
                        if($category){
                            while($result = $category->fetch_assoc()){
                    ?>
                    <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                    <?php } } ?>
                    </select></li></ul>
                          </form>
                      </div>
       
            <?php } } } } ?>
      	
      		  <?php 
                $query = "select * from tbl_post order by id desc";
                $post = $db->select($query);
                if ($post) {
                while ($result = $post->fetch_assoc()) {  
            ?>
                <div class="blog-item">
                    <div class="blog-content">
                        <a href="<?php echo $result['slug']; ?>"><h3><?php echo $result['title']; ?></h3></a>
                        <div class="entry-meta">
                            <span><i class="icon-user"></i> <a href="profile.php?id=<?php echo $result['userid']; ?>"><?php echo $result['character_name']; ?></a></span>
                            <span><i class="icon-calendar"></i> <?php echo $fm->formatDate($result['date']); ?></span>
                        </div>
                        <?php echo $fm->textShorten($result['body'],425); ?>
                        <a class="btn btn-default" href="<?php echo $result['slug']; ?>">Read More <i class="icon-angle-right"></i></a>
                    </div>
                </div><!--/.blog-item--><br>
              <?php } } ?>
      	   </div>
           
     <?php include 'inc/sidebar.php'; ?>
     <?php include 'inc/footer.php'; ?>