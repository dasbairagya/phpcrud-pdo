<?php 
error_reporting(E_ALL);
require_once 'db/class-employee.php';
$emp_obj = new Employee;
//$emp_res = $emp_obj->get_emp_list();
$limit = 3;//change according to needs
$page = (isset($_GET['page']) && $_GET['page']!=0) ? $_GET['page'] : 1; 
$emp_res = $emp_obj->get_emp_list($page,$limit);
// print_r($emp_res);
// die;
?>
<html>
  <head>
    <title>PHP CRUD Operations Using PDO
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- Include main CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Include jQuery library -->
    <script src="js/jQuery/jquery.min.js"></script>
    <!-- Include Bootstrap Javascript -->
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container wrapper">
      <h1 class="text-center">PHP CRUD OPERATIONS USING  OOPS & PDO
      </h1>
      <nav class="navbar navbar-default">
        <div class="navbar-header">
          <div class="alert alert-default navbar-brand search-box">
            <button class="btn btn-primary" onclick="formToggle()">Add Employee
              <span class="glyphicon glyphicon-plus" aria-hidden="true">
              </span>
            </button>
          </div>
          <div class="alert alert-default input-group search-box">
            <span class="input-group-btn">
            </span>
          </div>
        </div>
      </nav>
      <div class="col-md-6 col-md-offset-3">
        <?php require_once 'templates/form.php';?>
        <!-- Include form template which is used to edit and update data into database -->
        <?php
        if (isset($_POST['update_emp'])) {
        // print_r($_POST);
        // die();
        $emp_obj->update_emp_info($_POST, $_FILES);
        }
        ?>
        <?php if(isset($_SESSION['err_msg'])){ ?>
        <div id="signupalert" style="display:block" class="alert alert-danger">
          <span>
            <?php echo $_SESSION['err_msg'];?>
          </span>
        </div>
        <?php } ?>
        <?php if(isset($_SESSION['succ_msg'])){ ?>
        <div id="signupalert" style="display:block" class="alert alert-success">
          <span>
            <?php echo $_SESSION['succ_msg'];?>
          </span>
        </div>
        <?php } ?>
        <div class="editInfo">
          <?php require_once 'templates/editForm.php';?>
        </div>
      </div>
      <div class="clearfix">
      </div>
      <!-- Table to show employee detalis -->
      <div class="table-responsive">
        <?php if($emp_res!=null){ ?>
        <table class="table table-hover">
          <tr>
            <th>Emp ID</th>
            <th>Employee Name</th>
            <th>Email Address</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Action</th>
          </tr>
        <?php
        foreach ($emp_res as $res) { ?>
          <tr>
            <td>
              <span>
                <?php echo $res['emp_id']; ?>
              </span>
            </td>
            <td>
              <?php echo $res['emp_name']; ?>
            </td>
            <td>
              <?php echo $res['emp_email']; ?>
            </td>
            <td>
              <?php echo $res['emp_gender']; ?>
            </td>
            <td>
              <?php echo $res['emp_address']; ?>
            </td>
            <td>
              <button class="btn btn-warning"  onclick="editInfo(<?php echo $res['emp_id']; ?>)" title="Edit">
                <span
                      class="glyphicon glyphicon-edit">
                </span>
              </button>
              
              <a href="delete-emp-info.php?emp_id=<?php echo $res['emp_id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"  title="Delete">
                <span class="glyphicon glyphicon-trash">
                </span>
              </a>
            </td>
          </tr>
          <?php } ?>
        </table>
        <?php  }
         //else{ echo "<h4><center>No more records!</center></h4>"; }
        ?>
        </div>
        <?php
   $actual_link = "http://$_SERVER[HTTP_HOST]";
   $actual_link.= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
   // echo $actual_link;
  $total_records = $emp_obj->get_results();//get the total no of records
   //var_dump($total_records);
  $total_pages = ceil($total_records / $limit);  //split the total recods in to pages using limit.
  echo "<ul class='pagination'>";
  $pagLink = '';
  for ($i=1; $i<=$total_pages; $i++) {
    $class = (isset($_GET['page']) && $_GET['page']==$i)?'active':'';
    if(!isset($_GET['page']) && $i==1){$class ='active';}else{$class=$class;}
    // echo $class.$i;
    $pagLink .= "<li class='".$class."'><a href='". $actual_link."?page=".$i."'>".$i."</a></li>";  //pass the next page id using query-string(page=page-id)
  };


  echo "<li><a href='". $actual_link."?page=".($page-1)."' class='button'><span class=' glyphicon glyphicon-chevron-left '></span></a></li>";
  echo $pagLink ;
  echo "<li><a href='". $actual_link."?page=".($page+1)."' class='button'><span class=' glyphicon glyphicon-chevron-right'></span></a></li></ul>";


  ?>
    </div>
    </div>
  <script>
    function formToggle(){
      $('#empForm').slideToggle();
      $('#editForm').css('display', 'none');
    }
    function editInfo(id){
      $('#empForm').css('display', 'none');
      if(id !=''){
        jQuery('#loader'+id).show();
        jQuery.ajax({
          type:'POST',
          url: 'edit-emp.php?id='+id,
          //data: datas,
          catch: false,
          success: function(response){
            //console.log(response);
            $('.editInfo').html();
            $('.editInfo').html(response);
            $('#editForm').slideToggle();
            //alert(response);
            //setTimeout(function(){ location.reload(); }, 2000);
          }
          ,
          error: function (response) {
            alert(response);
            //location.reload();
          }
        }
                   );
        return false;
      }
    }
  </script>
  </body>
</html>