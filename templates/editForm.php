<!-- Form used for updation of data into database -->
<form class="form-horizontal alert alert-warning" id="editForm" hidden>
<h3 class="text-center">Update Employee Details</h3>
	<div class="form-group">
		<label for="Name">Employee Name:</label>
		<input type="text" class="form-control"  value="">
	</div>
	
	<div class="form-group">
		<label for="Email">Email Address:</label>
		<input type="email" class="form-control"  value="">
	</div>
		<div class="form-group">
		<label for="Gender">Gender:</label>
		<label for="" class="radio-inline gender">
			<input type="radio"  value="male" >Male
		</label>
		<label for="" class="radio-inline gender">
			<input type="radio" name="gender"  value="female">Female
		</label>
	</div>
	
	<div class="form-group">
		<label for="Address">Address:</label>
		<input type="text" class="form-control"  value="">
	</div>
	<div class="form-group">
		<button class="btn btn-warning">Update</button>
	</div>
</form>
