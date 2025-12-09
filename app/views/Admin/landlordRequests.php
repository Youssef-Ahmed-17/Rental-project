<!DOCTYPE html>
<html>
    <html lang="en">
 <head>
    <title>Accept/Reject Landlord Requests</title>
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
.back-icon:hover {
    color: #1b4d97;
    transform: translateX(-4px);
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
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    border-color: black;
    box-shadow:  0 3px 12px rgba(0,0,0,0.1) ;
}
.btn.accept{
    background-color: rgb(20, 199, 104);
}
.btn.reject{
    background-color: red;
}
 </style>
    <body>
        <a href="adminDashboard.php" class="back-icon">⬅</a>
        <h1 class="header">Total Requests</h1>
<div class="dashboard">
    <div class="column">

        <div class="card">
            <div class="icon req">🔂</div>
            <div>
                <p class="title">Padding Requests</p>
                <p class="number">7</p>
            </div>
        </div>

        <div class="card">
            <div class="icon acc">✔</div>
            <div>
                <p class="title">Approved</p>
                <p class="number">1</p>
            </div>
        </div>
         <div class="card">
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
<div class="container">
    <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" placeholder="Search users by name or email...">
    </div>
    <div class="dropdown-wrapper">
        <select class="dropdown">
            <option>Status</option>
            <option>Approved</option>
            <option>Rejected</option>
            <option>Pending</option>
        </select>
    </div>
</div>
<div class="info">
    <table>
        <thead>
            <tr>
                <th>RequestID</th>
                <th>User-Name</th>
                <th>E-mail</th>
                <th>City</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>REQ-001</td>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Pending</td>
                <td>
                    <button class="btn accept">✔</button>
                    <button class="btn reject">✘</button>
                </td>
            </tr>
             <tr>
                <td>REQ-001</td>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Pending</td>
                <td>
                    <button class="btn accept">✔</button>
                    <button class="btn reject">✘</button>
                </td>
            </tr>
             <tr>
                <td>REQ-001</td>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Pending</td>
                <td>
                    <button class="btn accept">✔</button>
                    <button class="btn reject">✘</button>
                </td>
            </tr>
                 <tr>
                <td>REQ-002</td>
                <td>john</td>
                <td>john.smith@gmail.com</td>
                <td>NewYork</td>
                <td>556-0942</td>
                <td >Approved</td>
                <td>
                    <button class="btn accept">✔</button>
                    <button class="btn reject">✘</button>
                 </td>
            </tr>
             <tr>
                <td>REQ-001</td>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Pending</td>
                <td>
                    <button class="btn accept">✔</button>
                    <button class="btn reject">✘</button>
                </td>
            </tr> <tr>
                <td>REQ-001</td>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Pending</td>
                <td>
                    <button class="btn accept">✔</button>
                    <button class="btn reject">✘</button>
                </td>
            </tr>
                <tr>
                <td>REQ-003</td>
                <td>Amir</td>
                <td>amir.doe@gmail.com</td>
                <td>NewYork</td>
                <td>468-2235</td>
                <td >Rejected</td>
                <td>
                    <button class="btn accept">✔</button>
                    <button class="btn reject">✘</button>
                </td>
            </tr>
             <tr>
                <td>REQ-001</td>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Pending</td>
                <td>
                    <button class="btn accept">✔</button>
                    <button class="btn reject">✘</button>
                </td>
            </tr> <tr>
                <td>REQ-001</td>
                <td>Emily</td>
                <td>emily.d@gmail.com</td>
                <td>NewYork</td>
                <td>555-0198</td>
                <td>Pending</td>
                <td>
                    <button class="btn accept">✔</button>
                    <button class="btn reject">✘</button>
                </td>
            </tr>
        </tbody>
    </table>
    <script>
const search = document.querySelector(".search-box input");
const status = document.querySelector(".dropdown");
const rows = document.querySelectorAll("tbody tr");

function filter() {
  rows.forEach(r => {
    let txt = r.textContent.toLowerCase();
    let st = r.children[5].textContent.trim();
    r.style.display =
      txt.includes(search.value.toLowerCase()) &&
      (status.value === "Status" || st === status.value)
      ? ""
      : "none";
  });
}

search.oninput = filter;
status.onchange = filter;
function saveStatus(rowId, status) {
    localStorage.setItem(rowId, status);
}
function loadStatus(row, rowId) {
    const saved = localStorage.getItem(rowId);
    const statusCell = row.children[5];

    if (saved === "Approved") {
        statusCell.textContent = "Approved";
        row.style.backgroundColor = "#90EE9080";
        removeButtons(row);
    }

    if (saved === "Rejected") {
        statusCell.textContent = "Rejected";
        row.style.backgroundColor = "#F0808080";
        removeButtons(row);
    }
}
function removeButtons(row){
    const acceptBtn = row.querySelector(".accept");
    const rejectBtn = row.querySelector(".reject");
    if (acceptBtn) acceptBtn.remove();
    if (rejectBtn) rejectBtn.remove();
}

document.querySelectorAll("tbody tr").forEach((row, index) => {
    const rowId = "row_" + index;
    const acceptBtn = row.querySelector(".accept");
    const rejectBtn = row.querySelector(".reject");
    const statusCell = row.children[5];

    loadStatus(row, rowId);

    if (acceptBtn) {
        acceptBtn.addEventListener("click", () => {
            statusCell.textContent = "Approved";
            row.style.backgroundColor = "#90EE9080";
            saveStatus(rowId, "Approved");
            removeButtons(row);
        });
    }

    if (rejectBtn) {
        rejectBtn.addEventListener("click", () => {
            statusCell.textContent = "Rejected";
            row.style.backgroundColor = "#F0808080";
            saveStatus(rowId, "Rejected");
            removeButtons(row);
        });
    }
});
document.getElementById("resetBtn").addEventListener("click", () => {
    localStorage.clear(); 
    location.reload(); 
});
</script>
    </body>
</html>