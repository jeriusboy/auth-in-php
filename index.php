
<?php
session_start();
$authenticated = false;
?>


<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"  />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
 <!-- navigation bar -->
 <div class=" relative">
 <div class="flex  justify-around items-center w-full bg-slate-200  py-3">
 <h1 class="text-[#38b6ff] font-bold uppercase text-3xl ">minimalist</h1>
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
        <a href="" class="px-7 py-2 bg-[#38b6ff] text-white rounded">Login</a>
        <a href="" class="px-7 py-2 bg-[#38b6ff] text-white rounded">Register</a>
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

<script>
    const dropdown = document.querySelector('.dropdown'); 

    const dropdown1 = document.querySelector('.dropdown1');

    dropdown.addEventListener('click', () => {
      dropdown1.style.display = 'block';
    });
</script>
</body>
</html>