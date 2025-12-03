<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>landlord Dashboard</title>

<style>
.fcard{
   background: rgb(244, 244, 245);
    width: 100%;
    padding: 5px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);   
    flex-direction: row;
     height: 90px;
     justify-content: flex-start;
    padding-left: 20px;
    padding-bottom: 20px;
}
.dashboard {
    display: flex; 
    gap: 40px;
    margin: 20px;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}
.column {
    display: flex;
    flex-direction: column;
    gap: 25px;
    width: 100%;
}

.card {
    background: rgb(240, 248, 255);
    width: 330px;
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
.title {
    margin: 0;
    font-size: 16px;
    color: black;
}

.number {
    margin: 5px 0 0;
    font-size: 20px;
    font-weight: bold;
    color: black;
}
.buttons-row {
    margin-top: 35px;
    display: flex;
    gap: 30px;
    justify-content: flex-start;
    padding-left: 20px;
}
.btn {
    width: 350px;
    padding: 12px;
    border-radius: 10px;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: .2s;
    width: 90%;
}

.add-btn { background: #418beb;}
.view-btn{ background: #2361be; }

.btn:hover {
    filter: brightness(0.85);
}
.my-properties h3 {
    padding: 20px;
    margin-bottom: 20px;
    text-align: center;
    text-decoration-style: solid;
    text-decoration-thickness: 45%;
}

.empty-box {
    background: white;
    padding: 30px;
    text-align: center;
    border-radius: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.empty-icon {
    font-size: 40px;
    display: block;
    margin-bottom: 15px;
}

.add-first {
    margin-bottom: 8px;
    background: rgba(13, 42, 116, 0.758);
    color: white;
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
    <div class="fcard">
    <h1> Landlord Dashboard</h1>
       <p style=" margin-left: 30px;">Welcome back,lara</p>
        </div>
        
<div class="dashboard">
    <div class="column">
        <div class="card">
            <div class="icon req">🏢</div>
            <div>
                <p class="title">Total properties</p>
                <p class="number">0</p>
            </div>
        </div>

        <div class="card">
            <div class="icon acc">🏠</div>
            <div>
                <p class="title">Rented</p>
                <p class="number">0</p>
            </div>
        </div>

    </div>


    <div class="column">

        <div class="card">
            <div class="icon req">📄</div>
            <div>
                <p class="title">Proposals</p>
                <p class="number">3</p>
            </div>
        </div>

        <div class="card">
            <div class="icon post">💲</div>
            <div>
                <p class="title">Monthly Revnue</p>
                <p class="number">$0</p>
            </div>
        </div>

    </div>
    <div class="column">

        <div class="card">
            <div class="icon Inpost">📦</div>
            <div>
                <p class="title">Available</p>
                <p class="number">0</p>
            </div>
        </div>

    </div>

</div>
<div class="buttons-row">
    <button class="btn add-btn"> + Add New Property</button>
    <button class="btn view-btn">View Proposals</button>
</div>
<section class="my-properties">
        <h3 style="color: rgb(51, 58, 84) ;">My Properties</h3>
        <div class="empty-box">
            <span class="empty-icon">🏙</span>
            <p>No properties yet</p>
            <button class="btn add-first">+ Add Your First Property</button>
        </div>
    </section>

</div>
<nav class="bottom-nav">
    <a href="#" class="nav-item "> 🔍Dashboard</a>
    <a href="#" class="nav-item">🔔 Notfications</a>
    <a href="#" class="nav-item"> 🏠 home</a>
</nav>
</body>
</html>