<?php include 'inc/header.php'; ?>


        <?php 
            if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
                echo "<script>window.location='catlist.php';</script>";
            }else{
                $id = $_GET['catid'];
            }

         ?>

        <div id="page-wrapper">

            <div class="container-fluid">

             <!-- Page Heading -->
                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-header">
                            Edit Category
                        </h1>

               <?php 
                     if ($_SERVER['REQUEST_METHOD']=='POST') {  
                        $name = $_POST['name'];      
                        $cat_slug = $_POST['cat_slug'];      
                        $name =  mysqli_real_escape_string($db->link,$name);
                        $cat_slug =  mysqli_real_escape_string($db->link,$cat_slug);
                     
                       if(empty($name) || empty($cat_slug)){
                        echo "<span class='label label-danger'>Field must not be empty !!!</span><br><br>";
                       } else{
                            if($cat_slug!=''){
                                $querySlugCheck = "select * from tbl_category where cat_slug='$cat_slug'";
                            $checkSlug = $db->select($querySlugCheck);
                            if ($checkSlug) {
                            
                            while ($result = $checkSlug->fetch_assoc()) {
                                if($result['name']!=$name){

                            $query = "UPDATE tbl_category
                            SET
                            name = '$name',
                            cat_slug = '$cat_slug'
                            WHERE id = '$id'";
                            $updated_row = $db->update($query);
                            if($updated_row){
                                Session::set("message","Category Updated Successfully !!!");
                                Session::set("color","success");
                                echo "<script>window.location='catlist.php'</script>";
                            }   else {
                                echo "<span class='label label-danger'>Category Not Updated !!!</span><br><br>";
                            }
                                    }elseif($result['cat_slug']==$cat_slug){
                                        echo "<span class='label label-danger'>Slug Already Exits !!!</span><br><br>";
                                    }
                                }
                            }else{
                                      $query = "UPDATE tbl_category
                            SET
                            name = '$name',
                            cat_slug = '$cat_slug'
                            WHERE id = '$id'";
                            $updated_row = $db->update($query);
                            if($updated_row){
                                Session::set("message","Category Updated Successfully !!!");
                                Session::set("color","success");
                                echo "<script>window.location='catlist.php'</script>";
                            }   else {
                                echo "<span class='label label-danger'>Category Not Updated !!!</span><br><br>";
                            }
                                }
                            }
                       
                        }
                    }
                ?>

            <?php 
                $query = "select * from tbl_category where id='$id' order by id desc";
                $category = $db->select($query);
                if($category){
                while ($result = $category->fetch_assoc()) {
            ?>
                     <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>
                                    <label class="form-group">Category Name : </label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="name" value="<?php  echo $result['name']; ?>" class="medium" /><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="form-group">Category Slug : </label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="cat_slug" value="<?php  echo $result['cat_slug']; ?>" class="medium" /><br>
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
                    </div>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>