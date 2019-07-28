<?php 
require_once 'db/class-employee.php';
if(isset($_GET['id'])){
	$id = $_GET['id'];
}
$emp_obj = new Employee;
$emp_res = $emp_obj->get_emp_info_by_id($id);
extract($emp_res);
// print_r($data);
// die;
if(!empty($data)){

	

	?>
<!-- Form used for updation of data into database -->
<form class="form-horizontal alert alert-warning" id="editForm" method="post" action="" <?php echo (isset($_POST['update_emp']))?'':'hidden' ;?>>
<h3 class="text-center">Update Employee Details</h3>

    
    <input type="hidden" name="emp_id" value="<?php echo $data['emp_id'];?>">
	<div class="form-group">
		<label for="Name">Employee Name:</label>
		<input type="text" class="form-control" name="emp_name" value="<?php echo $data['emp_name'];?>">
	</div>
	
	<div class="form-group">
		<label for="Email">Email Address:</label>
		<input type="email" class="form-control" name="emp_email" value="<?php echo $data['emp_email'];?>">
	</div>
	<div class="form-group">
		<label for="Gender">Gender:</label>
		<label for="" class="radio-inline gender">
			<input type="radio" name="emp_gender" value="male" <?php echo ($data['emp_gender'] == 'male')? 'checked':'';?>>Male
		</label>
		<label for="" class="radio-inline gender">
			<input type="radio" name="emp_gender"  value="female" <?php echo ($data['emp_gender'] == 'female')? 'checked':'';?>>Female
		</label>
	</div>
	
	<div class="form-group">
		<label for="Address">Address:</label>
		<input type="text" class="form-control" name="emp_address" value="<?php echo $data['emp_address'];?>">
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-warning" name="update_emp" value="update_emp">Update</button>
	</div>
</form>

	<?php
}
?>