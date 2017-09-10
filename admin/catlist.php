<?php include 'inc/header.php'; ?>

        <?php 
            if (isset($_GET['delcat'])) {
            	$delid = $_GET['delcat'];
            	$delquery = "delete from tbl_category where id ='$delid'";
            	$deldata = $db->delete($delquery);
            	if($deldata){
                        Session::set("message","Category Deleted Successfully !!!");
                        Session::set("color","success");

                    }   else {
                        Session::set("message","Category Not Deleted !!!");
                    }
            }

         ?>

         <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                 <div class="col-md-12">
                <h1>Category List</h1><hr>
                <?php   if(Session::get("message")){ ?>
                 
                <center><span class="label label-<?php 
                if(Session::get("color")){
                echo Session::get("color");
                Session::unset_it("color");
              }else{
                  echo "danger";
              }
                 ?>"><?php echo Session::get("message"); ?></span></center><br>
               <?php Session::unset_it("message");
              }
                    ?>


                
            <table class="table table-bordered" id="example" >
			<thead>
				<tr>
					<th>Serial No.</th>
                    <th>Category Name</th>
					<th>Category Slug</th>
                    <?php if(Session::get('userRole')=='0') { ?>
					<th>Action</th>
                    <?php } ?>
				</tr>
			</thead>
			<tbody>

			<?php 
				$query = "SELECT * FROM tbl_category ORDER BY id desc";
				$category = $db->select($query);
				if ($category) {
				$i=0;
				while ($result = $category->fetch_assoc()) {
				$i++;
			 ?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
                    <td><?php echo $result['name']; ?></td>
					<td><?php echo $result['cat_slug']; ?></td>
                    <?php if(Session::get('userRole')=='0') { ?>
					<td><a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete');" href="?delcat=<?php echo $result['id']; ?>">Delete</a></td>
                    <?php } ?>
				</tr>
				
			<?php } }  ?>

			</tbody>
		</table>
    
                    <script type="text/javascript">
                    $(document).ready(function () {
                        setupLeftMenu();
                        $('.datatable').dataTable();
                        setSidebarHeight();
                        });
                    </script>
                    </div>
                </div>
             </div>
                <!-- /.container-fluid -->
        </div>
    <!-- /#page-wrapper -->
<?php include 'inc/footer.php'; ?>



 