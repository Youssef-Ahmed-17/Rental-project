<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
 <style>

 body{
    margin: 25px ;
    font-family: cursive;
    } 

 .savebar{
   padding-left: 50px;
   width: 100%;
   height: 100px;
   background: rgb(233, 231, 231); 
   position: fixed;
   top : 0 ;
   left: 0;
   z-index: 1000;
   
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
   margin-top: 100px;
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

.bottom-nav {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: white;
    display: flex;
    justify-content: space-around;
    padding: 8px 0;
    border-top: 1px solid #ddd;
}

.nav-item {
    text-decoration: none;
    color: #080808;
    font-size: 14px;
}

 </style>

</head>
<body>
    
<div class="savebar">
<p> Saved properties </p>
<p> 3 Properties Saved </p>
</div>

<div class="row">

<div class="card">

   <image  class="img"  src = "pic_1.jpg" > 
     <div class="description"> 
      <p> Modern Downtown Appartment </p>
      <p class="price">  $2500/mo </p>
     </div>
     <div class="description2"> 
   <p class="Location"> ⚲ New York  </p>
   <p> 🛏 2    🛁 2   ◻ 1200 sqft </p>
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
   <p> 🛏 4    🛁 3   ◻ 3200 sqft </p>
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
   <p> 🛏 1    🛁 1   ◻ 500 sqft </p>
   <p> 👁156 views </p>
     </div>

</div>

</div>

<nav class="bottom-nav">
    <a href="tenantWall.php" class="nav-item "> 🏠 Home</a>
    <a href="" class="nav-item">⛉ Saved</a>
    <a href="tenantNotifications.php" class="nav-item">🕭 Notifications</a>
</nav>



</body>
</html>