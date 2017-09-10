<?php include 'inc/header.php'; ?>
        
         <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            All Players List
                        </h1><hr>
                    </div>
                </div>
      	<table class="table table-bordered" id="example" >
			<thead>
				<tr>
					<th>Serial No.</th>
                    <th>Character Name</th>
                    <th>Division and Rank</th>
					<th>Profile</th>                   
				</tr>
			</thead>
			<tbody>

			<?php 
				$query = "SELECT * FROM tbl_users ORDER BY id desc";
				$users = $db->select($query);
				if ($users) {
				$i=0;
				while ($result = $users->fetch_assoc()) {
				$i++;
			 ?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
                    <td><?php echo $result['character_name']; ?></td>
                    <td>Division : <?php echo $result['division']; ?> || Rank : <?php echo $result['rank']; ?>

                    

                     </td>
                    <td><a href="profile.php?id=<?php echo $result['id']; ?>">View
                    <?php if(Session::get('userId')!=$result['id'] && Session::get('division')>=4 && (Session::get('division')-$result['division'])>1) { ?></a>
                     || <a href="edit_division_rank.php?id=<?php echo $result['id']; ?>">Edit</a>
                     	<?php } ?>                    	
                     </td>					                    
				</tr>				
			<?php } }  ?>

			</tbody>
		</table>

     <?php include 'inc/footer.php'; ?>