<!DOCTYPE html>
<html>
    <html lang="en">
    <head>
        <title>Manage Posts</title>
    <meta charset="UTF-8">
    </head>
    <style>
.header{
    text-align: center;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-size: 50px;
    font-weight: 400px;
}
.back-icon {
    display: inline-block;
    margin: 15px 20px;
    font-size: 26px;
    font-weight: bold;
    text-decoration: none;
    color: #000000;
    transition: 0.2s;
}
.dashboard {
    display: flex; 
    gap: 40px;
    margin: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}
.column {
    display: flex;
    flex-direction: row;
    gap: 25px;
    width: 100%;
}
.card-head{
    background: rgb(240, 248, 255);
    width: 380px;
    padding: 25px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);   
}
.icon {
    width: 70px;
    height: 70px;
    border-radius: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 35px;
}
.card-group{
   text-align: center;
   flex-direction: row;
    display: flex;
    width: 100%;
    border: 250px;
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
    <body>
        <a href="adminDashboard.php" class="back-icon">⬅</a>
        <h1 class="header">Total Posts</h1>
<div class="dashboard">
    <div class="column">

        <div class="card-head">
            <div class="icon req">💬</div>
            <div>
                <p class="title">Total Posts</p>
                <p class="number">6</p>
            </div>
        </div>

        <div class="card-head">
            <div class="icon acc">✔ </div>
            <div>
                <p class="title">Approved</p>
                <p class="number">4</p>
            </div>
        </div>
        <div class="card-head">
            <div class="icon acc">❌</div>
            <div>
                <p class="title">Rejected</p>
                <p class="number">1</p>
            </div>
        </div>
    </div>
</div>
      <button id="resetBtn" style="
    margin: 10px 0;
    padding: 8px 15px;
    border: none;
    color:#333;
    background-color:#f4f4f7;
    cursor:pointer;
    border-radius:6px;">
    Reset Status
</button>
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
   <button style="background-color: #90EE9080;
    padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Approved✔</button>
     <button style="background-color: #F0808080; padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Hide✘</button>
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
 <button style="background-color: #90EE9080;
    padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Approved✔</button>
     <button style="background-color: #F0808080; padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Hide✘</button>
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
     <button style="background-color: #90EE9080;
    padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Approved✔</button>
     <button style="background-color: #F0808080; padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Hide✘</button>
     </div>
</div>
</div>
<div class="row">
<div class="card">
   <image  class="img"  src = "pic_4.jpg" > 
     <div class="description"> 
      <p> Penthouse with City Views </p>
      <p class="price">  $7500/mo </p>
     </div>
     <div class="description2"> 
   <p class="Location"> ⚲ New York  </p>
   <p> 🛏 3    🛁 3   ◻ 2500 sqft </p>
  <button style="background-color: #90EE9080;
    padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Approved✔</button>
     <button style="background-color: #F0808080; padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Hide✘</button>
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
   <p> 🛏 3    🛁 2   ◻ 1800 sqft </p>
   =<button style="background-color: #90EE9080;
    padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Approved✔</button>
     <button style="background-color: #F0808080; padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Hide✘</button>
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
   <p> 🛏 4    🛁 3   ◻ 3000 sqft </p>
  <button style="background-color: #90EE9080;
    padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Approved✔</button>
     <button style="background-color: #F0808080; padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;">Hide✘</button>
     </div>
</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card");
    cards.forEach((card, index) => {
        const approveBtn = card.querySelector("button:nth-of-type(1)");
        const hideBtn = card.querySelector("button:nth-of-type(2)");
        const cardKey = "post_" + index;
        const saved = localStorage.getItem(cardKey);
        if (saved === "Approved") {
            if (approveBtn) {
                approveBtn.textContent = "Approved ✔";
                approveBtn.style.backgroundColor = "#90EE9080";
            }
            if (hideBtn) hideBtn.style.display = "none";
        } else if (saved === "Hidden") {
            card.style.display = "none";
        }
        if (approveBtn) {
            approveBtn.addEventListener("click", () => {
                approveBtn.textContent = "Approved ✔";
                approveBtn.style.backgroundColor = "#90EE9080";
                if (hideBtn) hideBtn.style.display = "none";
                card.style.display = "";
                localStorage.setItem(cardKey, "Approved");
            });
        }
        if (hideBtn) {
            hideBtn.addEventListener("click", () => {
                card.style.display = "none";
                localStorage.setItem(cardKey, "Hidden");
            });
        }
    });
});
document.getElementById("resetBtn").addEventListener("click", () => {
    localStorage.clear(); 
    location.reload(); 
});
</script>
</body>
</html>