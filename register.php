<?php
// check if user is already logged in and redirect to index.php

if(isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

session_start();
$authenticated = false;

$email="";
$password="";
$confirm_password="";

$email_error = "";
$password_error = "";
$confirm_password_error = "";

$error = false;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    // email validation
    if(empty($email)){
        $email_error = "Email is required";
        $error = true;
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_error = "Email is invalid";
        $error = true;
    }

    // connect to database
    include "db/db.php";
    $db_connection = databaseConnection();

    // check if email already exists
    $statement = $db_connection->prepare("SELECT * FROM users WHERE email = ?");
    // bind parameters and "s" is use because email is of type string
    $statement->bind_param("s", $email);
    // execute the statement
    $statement->execute();
    // get the result
    $result = $statement->get_result();
    if($result->num_rows > 0){
        $email_error = "Email already exists";
        $error = true;
    }

    // close the statement
    $statement->close();

    // password validation
    if(empty($password)){
        $password_error = "Password is required";
        $error = true;
    }else if(strlen($password) < 4){
        $password_error = "Password must be at least 4 characters";
        $error = true;
    }

    // confirm password validation
    if(empty($confirm_password)){
        $confirm_password_error = "Confirm Password is required";
        $error = true;
    }else if($password != $confirm_password){
        $confirm_password_error = "Password do not match";
        $error = true;
    }

    if(!$error){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $create_date = date('Y-m-d H:i:s');

        $statement = $db_connection->prepare("INSERT INTO users (email, password, create_date) VALUES (?, ?, ?)");
        $statement->bind_param("sss", $email, $password, $create_date);
        $statement->execute();

        // read the id of the created user
        $id = $db_connection->insert_id;
        $statement->close();

        // save session data
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;

        header("Location: index.php");
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
     <!-- navigation bar -->
 <div class=" relative">
 <div class="flex  justify-around items-center w-full bg-slate-200  py-3">
<div class="flex gap-x-4 items-center">
 <h1 class="text-[#38b6ff] font-bold uppercase text-3xl ">minimalist</h1>
 <a href="index.php" class="text-cyan-900 font-semibold capitalize text-lg px-5 ">home</a></a>
 </div>
 <div class ="flex">
    <?php
if($authenticated){
    ?>
    <div class ="flex  items-center hover:text-[#38b6ff] dropdown" onClick="dropdown()">
     <button class="mx-2 font-bold " >Admin</button>  
     <span ><i class="fa-solid fa-caret-down"></i></span> 
    </div>

    <?php
}else{
    ?>
    <div class ="flex gap-x-4">
        <a href="/auth_php/login.php" class="px-7 py-2 bg-[#38b6ff] text-white rounded">Login</a>
    </div>
    <?php } ?>
 </div>

 </div> 

 <div class=" dropdown1 hidden flex flex-col absolute bg-slate-100 py-4 px-4 w-[200px] p top-12 right-40 rounded "> 
    <div class="w-full border-b pb-2">
   <a href="" class="cursor-pointer capitalize hover:text-[#38b6ff] font-semibold text-lg  ">profile</a><br>    
    </div>  
    <div class="w-full ">
   <button type="button" class="cursor-pointer capitalize hover:text-[#38b6ff] font-semibold text-lg ">logout</button>
        
    </div>
</div>
 </div>

 <!-- hero section -->

 <div class="w-full lg:py-20 lg:pl-12   flex justify-center  ">
<form action="" method="post" class="w-1/3  h-auto bg-slate-100 rounded"> 
    <div class="py-4 bg-[#2598BC]">
    <h1 class="text-center font-bold text-3xl text-white">Register</h1> 
    </div> 
    <div class="px-4 py-8 bg-cyan-900 w-full gap-y-2">
     <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email" class="w-full border-1 border-cyan-900 outline-none p-2  my-2">
     <span class="text-red-500 text-sm font-semibold mb-2"><?php echo $email_error ?></span>
     <input type="password" name="password" value="" placeholder="Password" class="w-full border-1 border-cyan-900 outline-none p-2 my-2">
     <span class="text-red-500 text-sm font-semibold mb-2"><?php echo $password_error ?></span>
     <input type="password" name="confirm_password" value="" placeholder="Confirm Password" class="w-full border-1 border-cyan-900 outline-none p-2 my-2">
    <span class="text-red-500 text-sm font-semibold mb-2"><?php echo $confirm_password_error ?></span>
     <div class="flex justify-end">
     <input type="submit" name="" value="submit" class="px-7 mt-4 py-2.5 bg-[#38b6ff] text-white rounded cursor-pointer">
     </div>
    </div>
    </div>
</form>
 </div>

<!-- footer -->
<div class="w-full bg-slate-200 text-[#38b6ff] py-1 px-4 flex justify-between text-center ">
    <div class="w-full">
        
        <p class="py-2 text-center">Copyright &copy; 2022. All Rights Reserved</p>
    </div>
    <div>


</body>
</html>