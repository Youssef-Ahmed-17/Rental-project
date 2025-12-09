<!DOCTYPE html>
<html>
     <html lang="en">
<head>
<title>List User</title>
    <meta charset="UTF-8">
</head>
<style>
.header{
    text-align: center;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-size: 40px;
    font-weight: 350px;
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
.container {
    width: 100%;
    display: flex;
    gap: 15px;
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    border: 1px solid #e5e5e5;
    box-sizing: border-box;
}
.search-box {
    flex: 1;
    display: flex;
    align-items: center;
    background: #f4f4f7;
    padding: 12px 15px;
    border-radius: 10px;
    gap: 10px;
}

.search-box input {
    width: 100%;
    border: none;
    background: none;
    outline: none;
    font-size: 15px;
}

.search-icon {
    font-size: 18px;
    color: #7b7b7b;
}
.dropdown {
    background: #f4f4f7;
    padding: 12px 15px;
    border-radius: 10px;
    border: none;
    font-size: 15px;
    color: #333;
    outline: none;
    appearance: none;
    position: relative;
    width: 160px;
}

.dropdown-wrapper {
    position: relative;
}

.dropdown-wrapper::after {
    content: "▼";
    font-size: 10px;
    color: #777;
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
}
.info{
   
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border: 50px;
    background-color: aliceblue;
    padding: 5px;
}
.info table{
    width: 100%;
    border-collapse: collapse;
    text-align: center;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1);
}
.info th{
    padding: 5px;
    font-size: 18px;
}

.info td{
    padding: 5px;
    font-size: 17px;
}

.btn{
    padding: 6px 8px;
    border: 500px;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;
}
.btn.active{
    background-color: rgb(245, 255, 250);
}
.btn.inactive{
    background-color: rgb(15, 15, 15);
    color: aliceblue;
}
.btn.Suspended{
    background-color: #ec444480;
    color: #000;

}
</style>
<body>
    <a href="adminDashboard.php" class="back-icon">⬅</a>
    <h1 class="header">All Users</h1>
<div class="dashboard">
    <div class="column">

        <div class="card">
            <div class="icon req">👥</div>
            <div>
                <p class="title">Total Users</p>
                <p class="number">9</p>
            </div>
        </div>

        <div class="card">
            <div class="icon acc">♻ </div>
            <div>
                <p class="title">Active Users</p>
                <p class="number">5</p>
            </div>
        </div>
         <div class="card">
            <div class="icon acc">⚠</div>
            <div>
                <p class="title">Suspended</p>
                <p class="number">1</p>
            </div>
        </div>
        <div class="card">
            <div class="icon acc">🚷</div>
            <div>
                <p class="title">Inactive Users</p>
                <p class="number">3</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" placeholder="Search users by name or email...">
    </div>
    <div class="dropdown-wrapper">
        <select class="dropdown">
            <option>All Users</option>
            <option>Active</option>
            <option>Suspended</option>
            <option>Inactive</option>
        </select>
    </div>
    <div class="dropdown-wrapper">
        <select class="dropdown">
            <option>All Roles</option>
            <option>Admin</option>
            <option>Landlord</option>
            <option>Tenant</option>
        </select>
    </div>

</div>
<div class="info">
    <table>
        <thead>
            <tr>
                <th>User-Name</th>
                <th>E-mail</th>
                <th>City</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Landlord</td>
                <td> <button class="btn active">Active</button></td>
            </tr>
             <tr>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Landlord</td>
                <td> <button class="btn inactive">Inactive</button></td>
            </tr>>
              <tr>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Landlord</td>
                <td> <button class="btn active">Active</button></td>
            </tr>
                  <tr>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Tenant</td>
                <td> <button class="btn inactive">Inactive</button></td>
            </tr>
               <tr>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Landlord</td>
                <td> <button class="btn Suspended">Suspended</button></td>
            </tr>
              <tr>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Landlord</td>
                <td> <button class="btn active">Active</button></td>
            </tr>
                 <tr>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Tenant</td>
                <td> <button class="btn inactive">Inactive</button></td>
            </tr>
             <tr>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Tenant</td>
                <td> <button class="btn active">Active</button></td>
            </tr>  
            <tr>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Landlord</td>
                <td> <button class="btn active">Active</button></td>
            </tr>
        </tbody>
    </table>
<script>
    const searchInput = document.querySelector(".search-box input");
    const statusFilter = document.querySelectorAll(".dropdown")[0];
    const roleFilter = document.querySelectorAll(".dropdown")[1];
    const rows = document.querySelectorAll("tbody tr");

    function filterTable() {
        const text = searchInput.value.toLowerCase();
        const selectedStatus = statusFilter.value;
        const selectedRole = roleFilter.value;

        rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();

            const rowRole = row.children[4].textContent.trim(); 
            const rowStatus = row.children[5].querySelector("button").textContent.trim();

            let matchSearch  = rowText.includes(text);
            let matchStatus  = selectedStatus === "All Users" || rowStatus === selectedStatus;
            let matchRole    = selectedRole === "All Roles" || rowRole === selectedRole;

            if (matchSearch && matchStatus && matchRole) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    searchInput.addEventListener("input", filterTable);
    statusFilter.addEventListener("change", filterTable);
    roleFilter.addEventListener("change", filterTable);
</script>

</body>
</html>