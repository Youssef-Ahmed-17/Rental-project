<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

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

.accept-btn { background: #418beb;}
.post-btn { background: #17acc3; }
.list-btn{ background: #2361be; }

.btn:hover {
    filter: brightness(0.85);
}

</style>
</head>
<body>
    <div class="fcard">
    <h1>Admin Dashboard</h1>
       <h5 style=" margin-left: 30px;">Welcome back,adminUserName</h5>
        </div>
        
<div class="dashboard">
    <div class="column">

        <div class="card">
            <div class="icon req">👤</div>
            <div>
                <p class="title">Landlord Requests</p>
                <p class="number">0</p>
            </div>
        </div>

        <div class="card">
            <div class="icon acc">✔</div>
            <div>
                <p class="title">Accepted Posts</p>
                <p class="number">0</p>
            </div>
        </div>

    </div>


    <div class="column">

        <div class="card">
            <div class="icon req">👥</div>
            <div>
                <p class="title">Registered Users</p>
                <p class="number">1</p>
            </div>
        </div>

        <div class="card">
            <div class="icon post">💬</div>
            <div>
                <p class="title">Total Posts</p>
                <p class="number">0</p>
            </div>
        </div>

    </div>
    <div class="column">

        <div class="card">
            <div class="icon Inpost">❌</div>
            <div>
                <p class="title">Inactive Posts</p>
                <p class="number">0</p>
            </div>
        </div>

        <div class="card">
            <div class="icon rev">🗑</div>
            <div>
                <p class="title">Remove Posts</p>
                <p class="number">0</p>
            </div>
        </div>

    </div>

</div>
<div class="buttons-row">
    <button class="btn accept-btn">👤 Accept/Reject Landlord Requests</button>
    <button class="btn post-btn">🧩 Manage Posts (Accept / Reject)</button>
    <button class="btn list-btn">≡ List Users</button>
</div>
</body>
</html>