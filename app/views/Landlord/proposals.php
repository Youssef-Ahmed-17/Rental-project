<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenant Applications</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 20px;
} 
.top-header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      background: white;
      padding: 15px 18px;
      font-size: 20px;
      font-weight: bold;
      border-bottom: 1px solid white ;
    }
.active{
    margin-left: 40px; 
}

.tabs {
    display: flex;
    gap: 390px;
    margin-top: 90px;
    margin-bottom: 10px;
    
}
.tabs button {
    padding: 10px 20px;
    border: none;
    background: #7b56b2;
    border-radius: 50px;
    font-size: 15px;
    cursor: pointer;
}
.tabs button span {
    background: #aca6a6;
    padding: 2px 8px;
    border-radius: 30px;
}
.tabs .active {
    background: #7b56b2;
    color: white;
}

.application-card {
    background: white;
    padding: 25px;
    border-radius: 14px;
    box-shadow: 0px 2px 6px rgba(0,0,0,0.15);
    margin-bottom: 30px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.status {
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 13px;
    text-transform: capitalize;
}
.status.pending {
    background: #ffcc33;
}

.tenant-info {
    display: flex;
    align-items: center;
    gap: 15px;
}
.emoji {
    background: #b87dd32d;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
}

.doc-list {
    list-style: none;
    padding: 0;
}
.doc-list li {
    background: #f0f2f5;
    padding: 10px;
    border-radius: 8px;
    margin: 6px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.download {
    cursor: pointer;
    font-size: 20px;
}

.note {
    background: #f0f2f5;
    padding: 12px;
    border-radius: 10px;
}

.actions {
    margin-top: 20px;
    display: flex;
    justify-content: flex-end;
    gap: 15px;
}
.reject {
    background: #e74c3c;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    color: white;
    cursor: pointer;
}
.accept {
    background: #2ecc71;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    color: white;
    cursor: pointer;
}
    </style>
</head>
<body>
<div class="top-header"> 
                <h3>Tenant propsales</h3>
            </div>
<div class="tabs">
    <button class="active"> Under review <span> 2</span></button>
    <button>Accepted <span>6</span></button>
    <button>Rejected <span>5</span></button>
</div>

<div class="application-card">
    <div class="header">
        <h2>Modern Downtown Apartment</h2>
        <span class="status pending">Pending</span>
    </div>

    <p class="submitted-date">Submitted on: 2025-11-12</p>

    <h3>Tenant Information</h3>
    <div class="tenant-info">
        <div class="emoji">👤</div>
        <div>
            <h4>tasneem elbraady</h4>
            <p>mnya elkameh</p>
            <p>Email: tasnem@gmial.com</p>
            <p>Phone: 01023456789</p>
        </div>
    </div>

    <h3>Submitted Documents</h3>
    <ul class="doc-list">
        <li>ID Document <span class="download">⬇</span></li>
        <!-- <li>Proof of Income <span class="download">⬇</span></li>
        <li>Reference Letter <span class="download">⬇</span></li> -->
    </ul>
    <h3>Additional Note</h3>
    <p class="note">
        I have been working at a fintech company for 4 years. I have stable income
        and excellent references. Looking for a long-term rental.
    </p>
    <div class="actions">
        <button class="reject">Reject</button>
        <button class="accept">Accept</button>
    </div>
</div>

<div class="application-card">
    <div class="header">
        <h2>City View Apartment</h2>
        <span class="status pending">Pending</span>
    </div>
    <p class="submitted-date">Submitted on: 2025-6-29</p>
    <h3>Tenant Information</h3>
    <div class="tenant-info">
        <div class="emoji">👤</div>
        <div>
            <h4>elsayed elbadawy</h4>
            <p>tanta</p>
            <p>Email: elbadawy@gmail.com</p>
            <p>Phone: 01011166542</p>
        </div>
    </div>

    <h3>Submitted Documents</h3>
    <ul class="doc-list">
        <li>ID Document <span class="download">⬇</span></li>
        <!-- <li>Employment Letter <span class="download">⬇</span></li>
        <li>Bank Statements <span class="download">⬇</span></li> -->
    </ul>

    <h3>Additional Note</h3>
    <p class="note">
        I recently relocated for a new job position. I am looking for a quiet apartment
        and can move in immediately.
    </p>
    <div class="actions">
        <button class="reject">Reject</button>
        <button class="accept">Accept</button>
    </div>
</div>

</body>
</html>