<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Rent Hub </title>
    <style>
    
    body{
    margin: 25px ;
    font-family: cursive;
    } 

    .start {
       display: flex;
       justify-content :space-between
   
    }
  
    .search{
    margin: auto;
    background-color: rgb(236, 234, 234);
    width: 95% ;
    height: 30px;
    border: black  0px solid;   
    border-radius: 10px;
    padding-left: 10px; 
    }
   
   .searchrow {
      display: flex;
      justify-content: space-between;
      padding-right: 10px; 
   }

   .filter{
     font-size: 20px ;
     
   
   } 

   .propertiesrow{  
   display: flex;
   justify-content: space-between;

   }


  .card {
    height: 400px ;
    width : 400px ; 
    border: rgb(187, 185, 185) 1px solid ;
    border-radius: 10px ;
    margin: 20px;

  }
  
  .card:hover{
  transform: scale(1.05);
  transition: transform 0.2s;
  }
  
  .row {
   
   display: flex;
   justify-content: space-around;

  }

 img {

  width: 400px ;
  height: 200px ;
  border-radius: 10px 10px 0px 0px ;

 }


 .description{
    display: flex;
    justify-content: space-around;
    margin: 0px ;
   
  }


  .description2{
  
    padding-left: 20px;
    color: grey;
  }  

  .price{
    color: rgb(64, 64, 207);
  }


  .taskbar{
 
   width: 100%;
   height: 50px;
   background: rgb(245, 243, 243); 
   position: fixed;
   bottom: 0 ;
   left: 0;
   z-index: 1000;
   display: flex;
   justify-content: space-around
   ;
  }

    </style>

</head>
<body>

<div class="start">    
<p > Welcome, Youssef Ahmed </p> 
<p > ⚙ </p> 
</div>

<div class="searchrow">
<input class="search"  type="text" placeholder="search properties ,Location " >
<p class="filter"> ᯤ </p>
</div>


<div  class="propertiesrow ">
<p> All properties </p>

<p> 6 properties </p>

</div>

<!-- 1st row -->

<div class="row">

<div class="card">

   <image  class="img"  src = "pic_1.jpg" > 
     <div class="description"> 
      <p> Modern Downtown Appartment </p>
      <p class="price">  $2500/mo </p>
     </div>
     <div class="description2"> 
   <p class="Location"> ⚲ New York  </p>
   <p> 🛏️ 2    🛁 2   ◻ 1200 sqft </p>
   <p> 👁 245 views </p>
     </div>

</div>


<div class="card">

   <image  class="img"  src = "pic_2.jpg" > 
     <div class="description"> 
      <p> Luxury Villa with Pool </p>
      <p class="price">  $5500/mo </p>
     </div>
     <div class="description2"> 
   <p class="Location"> ⚲ Los Angelos  </p>
   <p> 🛏️ 4    🛁 3   ◻ 3200 sqft </p>
   <p> 👁 389 views </p>
     </div>

</div>

<div class="card">

   <image  class="img"  src = "pic_3.jpg" > 
     <div class="description"> 
      <p> Cozy Studio in Brooklyn </p>
      <p class="price">  $1800/mo </p>
     </div>
     <div class="description2"> 
   <p class="Location"> ⚲ New York  </p>
   <p> 🛏️ 1    🛁 1   ◻ 500 sqft </p>
   <p> 👁156 views </p>
     </div>

</div>

</div>

<!-- 2nd row -->

<div class="row">

<div class="card">

   <image  class="img"  src = "pic_4.jpg" > 
     <div class="description"> 
      <p> Penthouse with City Views </p>
      <p class="price">  $7500/mo </p>
     </div>
     <div class="description2"> 
   <p class="Location"> ⚲ New York  </p>
   <p> 🛏️ 3    🛁 3   ◻ 2500 sqft </p>
   <p> 👁 512 views </p>
     </div>

</div>


<div class="card">

   <image  class="img"  src = "pic_5.jpg" > 
     <div class="description"> 
      <p> Suburban Family Home </p>
      <p class="price">  $3200/mo </p>
     </div>
     <div class="description2"> 
   <p class="Location"> ⚲ chicago  </p>
   <p> 🛏️ 3    🛁 2   ◻ 1800 sqft </p>
   <p> 👁 198 views </p>
     </div>

</div>

<div class="card">

   <image  class="img"  src = "pic_6.jpg" > 
     <div class="description"> 
      <p> Luxury Villa with Pool </p>
      <p class="price">  $5000/mo </p>
     </div>
     <div class="description2"> 
   <p class="Location"> ⚲ california  </p>
   <p> 🛏️ 4    🛁 3   ◻ 3000 sqft </p>
   <p> 👁980 views </p>
     </div>

</div>

</div>


<div class="taskbar">

<div> <p> 🏠︎ Home </p> </div>

<div> <p> ⛉ Saved </p> </div>

<div> <p> 🕭 Notifications </p> </div>

</div>


</body>
</html>