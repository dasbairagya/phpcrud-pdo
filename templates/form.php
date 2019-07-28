<?php
if (isset($_POST['create_emp'])) {
    $emp_obj->create_emp_info($_POST, $_FILES);
}
?>
<!-- Include form template which is used to insert data into database -->

<!-- Form used to add new entries of employee in database -->
<form class="form-horizontal alert alert-warning" name="empList" id="empForm" method="post" action="" <?php echo (isset($_POST['create_emp']))?'':'hidden'; ?>>
<h3 class="text-center">Insert Employee Details Into Database</h3>

    <?php if(isset($_SESSION['err_msg'])){?>
        <div id="signupalert" style="display:block" class="alert alert-danger">

            <span><?php echo $_SESSION['err_msg'];?></span>
        </div>
    <?php } ?>
    <?php if(isset($_SESSION['succ_msg'])){?>
        <div id="signupalert" style="display:block" class="alert alert-success">

            <span><?php echo $_SESSION['succ_msg'];?></span>
        </div>
    <?php } ?>
	<div class="form-group">
		<label for="Name">Employee Name:</label>
		<input type="text" name="emp_name" class="form-control" placeholder="Enter Employee Name" value="" autofocus required1 />
	</div>
<!--	<div class="form-group">-->
<!--		<p class="text-danger">Name field is Empty!</p>-->
<!--	</div>-->
	<div class="form-group">
		<label for="Email">Email Address:</label>
		<input type="email" name="emp_email" class="form-control" placeholder="Enter Employee Email Address"  autofocus required1 />
	</div>
<!--	<div class="form-group">-->
<!--		<p class="text-danger">Invalid Email!</p>-->
<!--	</div>-->
	<div class="form-group">
		<label for="Gender">Gender:</label>
		<label for="" class="radio-inline gender">
			<input type="radio" name="emp_gender" value="male" checked>Male
		</label>
		<label for="" class="radio-inline gender">
			<input type="radio" name="emp_gender" value="female">Female
		</label>
	</div>
	
	<div class="form-group">
		<label for="Address">Address:</label>
		<input type="text" name="emp_address" class="form-control" placeholder="Enter Employee Address" autofocus required1 />
	</div>
<!--	<div class="form-group">-->
<!--		<p class="text-danger">Address field is Empty!</p>-->
<!--	</div>-->
	<div class="form-group">
		<button type="submit" class="btn btn-warning" name="create_emp">Add Into Database</button>
	</div>
</form>
<?php 
unset($_SESSION['err_msg']);
unset($_SESSION['succ_msg']);
session_destroy();
?>
