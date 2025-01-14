<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $branch = $_POST['branch'];
    $imgname = $_FILES['img']['name'];
    $imgtmp = $_FILES['img']['tmp_name'];
    $role = $_POST['role'];

    if(!empty($imgname)){
        move_uploaded_file($imgtmp,"upload/".$imgname);
    }else{
        $imgname = "upload/undraw_profile.svg";
    }
    if(!empty($name) && !empty($email) && !empty($pass) && !empty($branch)){
        $connection = mysqli_connect("localhost","root","","instant" );
        $query_branch= mysqli_query( $connection,"SELECT branch_id FROM branches WHERE branch_name = '$branch'");
        $values = mysqli_fetch_all($query_branch, MYSQLI_ASSOC);
        foreach($values as $value){
            $branch_id = $value['branch_id'];
        }if($role == "student"){
                $query_students = mysqli_query($connection,"INSERT INTO students(branch_id,student_name,student_email,student_password,student_img) VALUES ('$branch_id','$name','$email','$pass','$imgname')");
        }else{
            mysqli_query($connection,"INSERT INTO instructors(instructor_name,instructor_email,instructor_password,instructor_img) VALUES ('$name','$email','$pass','$imgname')");
        }
        if(mysqli_affected_rows($connection)==1){
            header("location:login.php");

        }
    }else{
        header("location:register.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add new Student</title>
    <link rel="icon" type="image/x-icon" href="../../logo-orange.png">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="center">
      <h1>Add New member</h1>
      <form method="post" action="register.php" enctype="multipart/form-data">
        <div class="txt_field">
          <input type="text" name="name" required>
          <span></span>
          <label>Name</label>
        </div>
        <div class="txt_field">
            <input type="email" name="email" required>
            <span></span>
            <label>Email</label>
        </div>
        <div class="txt_field">
            <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" name="phone" required>
            <span></span>
            <label>phone</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" required>
            <span></span>
            <label>Create a password</label>
        </div>
        <div class="txt_field">
                <select id="branch" name="branch" style="width: 100%;border: none;">
                <option value="Alexandria">Alexandria</option>
                <option value="Cairo">Cairo</option>
                <option value="Kafr-Elsheikh">Kafr-Elsheikh</option>
                <option value="Giza">Giza</option>
            </select>
        </div>
        <div class="txt_field">
            <input type="date" name="registration_date" required>
            <span></span>
        </div>
        <div class="txt_field">
            <input type="file" name="img" >
            <span></span>
        </div>
        <div class="txt_field">
            
            <select id="role" name="role" style="width: 100%;border: none;">
                <option value="student">Student</option>
                <option value="instructor">instructor</option>
            </select>
        </div>
        <input type="submit" value="Add">
        <div class="signup_link">
            <a href="login.php">Login</a> 
        </div>
        
    </form>
    </div>

</body>
</html>
