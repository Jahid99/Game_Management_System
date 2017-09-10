<?php include 'inc/header.php'; ?>     

   
		<div id="page-wrapper">
        
            <div class="container-fluid">
             <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Add Category
                        </h1><hr>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Page Heading -->
                <div class="row">
                <div class="col-md-12">
            
               <?php 
                    if ($_SERVER['REQUEST_METHOD']=='POST') {  
                        $name = $_POST['name'];      
                        $cat_slug = $_POST['cat_slug'];      
                        $name =  mysqli_real_escape_string($db->link,$name);
                        $cat_slug =  mysqli_real_escape_string($db->link,$cat_slug);
                     
                           if(empty($name) || empty($cat_slug)){
                            Session::set("message","Field must not be empty !!!");
                           } else{
                            if($cat_slug!=''){
                                $querySlugCheck = "select * from tbl_category where cat_slug='$cat_slug'";
                            $checkSlug = $db->select($querySlugCheck);
                            if ($checkSlug) {
                            
                            while ($result = $checkSlug->fetch_assoc()) {
                                        if($result['cat_slug']==$cat_slug){
                                            echo "<span class='label label-danger'>Slug Already Exits !!!</span><br><br>";
                                        }
                                        }
                                    }else{
                                            $query = "INSERT INTO tbl_category(name,cat_slug) VALUES ('$name','$cat_slug')";
                            $catinsert = $db->insert($query);
                            if($catinsert){
                                Session::set("message","Category Inserted Successfully !!!");
                                Session::set("color","success");
                                echo "<script>window.location='catlist.php'</script>";
                                exit();
                            }   else {
                                Session::set("message","Category Not Inserted !!!");
                            }
                                }
                            }
                            
                       }
                    }
                ?>
                 
                    <table class="form">	
                        <form action="" method="post">
                            <?php
                                if(Session::get("message")){ ?>
                                    <span class="label label-danger"><?php echo Session::get("message"); ?></span><br><br>
                                    <?php Session::unset_it("message");
                                }
                            ?>				
                            <tr>
                             <td>
                                    <label class="form-group">Category Name : </label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="name"  placeholder="Enter Category Name..." class="medium" /><br>
                                </td>
                                 
                            </tr>
                            <tr> 
                                <td>
                                    <label class="form-group">Category Slug : </label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="cat_slug" placeholder="Enter Category Slug..." class="medium" /><br>
                                </td>
                            </tr>
    						<tr> 
                                <td>
                                    <input type="submit" name="submit" class="btn btn-default" Value="Save" />
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div>
                        <!-- /.row -->
                </div>
            </div>
        </div>
                
<?php include 'inc/footer.php'; ?>