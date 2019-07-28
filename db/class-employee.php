<?php

class Employee{
    private $conn;
    function __construct() {
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "@Ece11801@";
    $db = "employee";
      try {
          $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
          // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //echo "Connected successfully";
      }
      catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
      }

    }
    public function get_emp_list($page,$limit){
    
      $start_from = ($page-1) * $limit;  
      $result = array();
        
       $sql = "SELECT * FROM emp_details ORDER BY emp_id DESC LIMIT $start_from, $limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0) {
          while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $res;
          }
          
        }
        if (!empty($result)) {return $result;}
        else{return null;}     
    }
    function get_results(){
      $sql = "SELECT * FROM emp_details ORDER BY emp_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();

    }

    public function get_emp_list1(){
        
       $sql = "SELECT * FROM emp_details ORDER BY emp_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount()>0) {
          while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $res;
          }
          
        }
        if (!empty($data)) {return $data;}
        else{return null;}     
    }
    
    public function create_emp_info($post_data=array(), $file){
      // print_r($post_data);
      // die;
      if(isset($post_data['create_emp'])){
       $emp_name= trim($post_data['emp_name']);
       $emp_email= trim($post_data['emp_email']);
       $emp_gender= trim($post_data['emp_gender']);
       $emp_address= trim($post_data['emp_address']);
       
       
       // if(is_array($file)) { 
       //    if(is_uploaded_file($file['file']['tmp_name'])) {
       //    $sourcePath = $_FILES['file']['tmp_name'];
       //    $targetPath = "assets/images/".$_FILES['file']['name'];
       //    move_uploaded_file($sourcePath,$targetPath); 
       //    }
       //  }

       // $sql="INSERT INTO users (user_name, email_address, contact,country,gender,image) VALUES ('$user_name', '$email_address', '$contact','$country','$gender','$targetPath')";
        
       //  $result=  $this->conn->query($sql);

        if (empty($emp_name)) {
            $err_msg = "Employee name is required";
        } elseif (empty($emp_email)) {
            $err_msg = "Employee email is required";
        } elseif (empty($emp_gender)) {
            $err_msg = "Employee gender is required";
        } elseif (empty($emp_address)) {
            $err_msg = "Employee address is required";
        }
        if (!isset($err_msg)) {

            $sql = "INSERT INTO emp_details (emp_name,emp_email,emp_gender,emp_address) values(:emp_name, :emp_email, :emp_gender, :emp_address)";

            $result = $this->conn->prepare($sql);
            $result->bindParam(':emp_name', $emp_name);
            $result->bindParam(':emp_email', $emp_email);
            $result->bindParam(':emp_gender', $emp_gender);
            $result->bindParam(':emp_address', $emp_address);
            if ($result->execute()) {
                //var_dump($con->errorInfo());
                //$succ_msg = "Data inserted successfully!";
                $_SESSION['succ_msg']="Employee info created successfully!";
                header("refresh:1, index.php");
            } else {
                $err_msg = "Error";
            }
        }
        else{
          $_SESSION['err_msg']=$err_msg;

        }
              
        unset($post_data['create_user']);
      }
           
            
    }
    
    public function get_emp_info_by_id($id){
       if(isset($id)){
        $sql = "SELECT * FROM emp_details WHERE emp_id = :eid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':eid'=>$id));
          while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data['data'] = $res;
          }
        if (!empty($data)) {return $data;}
        else{return null;} 
    
       }  
    }
    
    
    public function update_emp_info($post_data=array(), $file){
       if(isset($post_data['update_emp'])){
       $emp_name= trim($post_data['emp_name']);
       $emp_email= trim($post_data['emp_email']);
       $emp_gender= trim($post_data['emp_gender']);
       $emp_address= trim($post_data['emp_address']);
       $emp_id= trim($post_data['emp_id']);
         if (empty($emp_name)) {
            $err_msg = "Employee name is required";
        } elseif (empty($emp_email)) {
            $err_msg = "Employee email is required";
        } elseif (empty($emp_gender)) {
            $err_msg = "Employee gender is required";
        } elseif (empty($emp_address)) {
            $err_msg = "Employee address is required";
        }
           
       
    if (!isset($err_msg)) {
       // if(is_array($file)) { 
        //         if(is_uploaded_file($file['file']['tmp_name'])) {
        //         $sourcePath = $_FILES['file']['tmp_name'];
        //         $targetPath = "assets/images/".$_FILES['file']['name'];
        //         move_uploaded_file($sourcePath,$targetPath);
        //          $sql="UPDATE users SET image='$targetPath' WHERE user_id =$user_id";
        //          $result = $this->conn->query($sql);
        //         }
        //       }

       $sql = "UPDATE emp_details SET emp_name = :emp_name,emp_email= :emp_email,emp_gender = :emp_gender,emp_address = :emp_address WHERE emp_id = :emp_id";
       $result = $this->conn->prepare($sql);
        $result->bindParam(':emp_name', $emp_name);
            $result->bindParam(':emp_email', $emp_email);
            $result->bindParam(':emp_gender', $emp_gender);
            $result->bindParam(':emp_address', $emp_address);
            $result->bindParam(':emp_id', $emp_id);
        if($result->execute()) {
           $_SESSION['succ_msg']="Successfully Updated user Info";
            header("refresh:2, index.php");
        }
        else{ $err_msg = "Error";}

    }
     else{
          $_SESSION['err_msg']=$err_msg;

        }
       
           
       unset($post_data['update_user']);
       }   
    }
    
    public function delete_emp_info_by_id($emp_id){
        
       if(isset($emp_id)){
       $sql = "DELETE FROM emp_details where emp_id = :emp_id";
       $stmt = $this->conn->prepare($sql);
        if($stmt->execute(array(':emp_id'=>$emp_id))){
            header("location: index.php");
        }
           if($result){
               $_SESSION['message']="Successfully Deleted user Info";
            
           }
       }
        header('Location: index.php'); 
    }
    public function update_emp_status_by_user_id($id, $status){
      if(isset($id)){
       $user_id= $id;
        $sql="UPDATE emp_details SET status='$status' WHERE user_id =$user_id";
        $result=  $this->conn->query($sql);
        
           if($result){
               $_SESSION['message']="Status successfully updated!";
              return true;
           }
       }
        die;
    }
    function __destruct() {
      $this->conn = null; 
    }
    
}

?>