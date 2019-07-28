<?php 
require_once 'db/class-employee.php';
if(isset($_GET['emp_id'])){
    $emp_id = $_GET['emp_id'];
    $emp_obj = new Employee;
    $emp_obj->delete_emp_info_by_id($emp_id);   
}
?>