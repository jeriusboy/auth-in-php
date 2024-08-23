
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
<style>
.hero{
    background-image: url('https://img.freepik.com/free-photo/study-group-african-people_23-2149156368.jpg?t=st=1724417122~exp=1724420722~hmac=d0ba196289219f3526f7ca85ec5eb9f3be535c5f06becb2fe41b67de5960538a&w=740');
    background-repeat:no-repeat;
    background-size:cover;
    background-position:center;
    
}
</style>
  <title>minimalist</title>
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

 <!-- hero section -->

 <div class="w-full lg:pt-12 lg:pl-12  hero h-[520px]">
    <div class="lg:w-1/3 sm:w-4/5 md:w-2/3   px-8 py-10   h-full bg-[#2598BC]">
        <h1 class="text-white font-bold text-6xl flex flex-col  capitalize ">
            <span>child</span>
            <span>education</span>
        </h1>
        <p class="text-white font-semibold text-5xl py-1 tracking-wide">Insurance</p>
        <p class="text-white font-semibold py-2 text-lg">Understanding how insurance works can help you choose a policy.
             For instance,your coverage may or may not be the right type of auto insurance for you.</p>
             <button class="text-[#38b6ff] px-7 py-2 bg-slate-200 rounded">Get Started</button>
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