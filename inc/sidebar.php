<div class="col-md-4">
      	<div class="widget">
      		 <div class="widget categories">
                    <h3>Post Categories</h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-group" >
                            	<?php 
                			         $query = "select * from tbl_category";
                			         $category = $db->select($query);
                			         if ($category) {
                			         while ($result = $category->fetch_assoc()) {	
                		            ?>
                                                <li class="list-group-item"><a href="<?php echo SITE_URL;?>category/<?php echo $result['cat_slug']; ?>"><?php echo $result['name'] ?></a></li>
                                                <?php } } else { ?>					
                						<li>No Category Created</li>
                					<?php } ?>
                            </ul>
                        </div>
                    </div>                     
                </div><!--/.categories-->             
      	</div>
</div>