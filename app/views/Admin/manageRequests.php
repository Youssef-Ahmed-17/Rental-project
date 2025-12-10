<!DOCTYPE html>
<html lang="en">
 <head>
    <title>Manage Requests</title>
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

.card .title {
    font-size: 14px;
    color: #666;
    margin-bottom: 5px;
}

.card .number {
    font-size: 32px;
    font-weight: bold;
    color: #333;
}

.container {
    width: 100%;
    display: flex;
    gap: 15px;
    background: #fff;
    padding: 20px;
    margin: 0 20px;
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
    cursor: pointer;
    min-width: 160px;
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
    margin: 20px;
    background-color: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
}
.info table{
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}
.info th{
    padding: 15px 5px;
    font-size: 16px;
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}

.info td{
    padding: 12px 5px;
    font-size: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.info tr:hover {
    background-color: #f8f9fa;
}

.btn{
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    color: white;
    font-weight: 500;
    margin: 0 3px;
    transition: all 0.2s;
}
.btn.accept{
    background-color: rgb(20, 199, 104);
}
.btn.accept:hover{
    background-color: rgb(16, 170, 88);
}
.btn.reject{
    background-color: #dc3545;
}
.btn.reject:hover{
    background-color: #c82333;
}

.status-badge {
    display: inline-block;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
}

.status-badge.pending {
    background-color: #fff3cd;
    color: #856404;
}

.status-badge.accepted {
    background-color: #d4edda;
    color: #155724;
}

.status-badge.rejected {
    background-color: #f8d7da;
    color: #721c24;
}

.no-results {
    text-align: center;
    padding: 40px;
    color: #666;
    font-size: 16px;
}
 </style>
    <body>
        <a href="?url=AdminController/dashboard" class="back-icon">⬅</a>
        <h1 class="header">Landlord Requests</h1>

<div class="dashboard">
    <div class="column">
        <div class="card">
            <div class="icon req">📂</div>
            <div>
                <p class="title">Pending Requests</p>
                <p class="number" id="pendingCount"><?= count(array_filter($requests ?? [], fn($r) => $r['status'] === 'Pending')) ?></p>
            </div>
        </div>

        <div class="card">
            <div class="icon acc">✔</div>
            <div>
                <p class="title">Approved</p>
                <p class="number" id="acceptedCount"><?= count(array_filter($requests ?? [], fn($r) => $r['status'] === 'Approved')) ?></p>
            </div>
        </div>
         <div class="card">
            <div class="icon acc">❌</div>
            <div>
                <p class="title">Rejected</p>
                <p class="number" id="rejectedCount"><?= count(array_filter($requests ?? [], fn($r) => $r['status'] === 'Rejected')) ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" id="searchInput" placeholder="Search users by name or email...">
    </div>
    <div class="dropdown-wrapper">
        <select class="dropdown" id="statusFilter">
            <option value="">All Status</option>
            <option value="Pending">Pending</option>
            <option value="Approved">Approved</option>
            <option value="Rejected">Rejected</option>
        </select>
    </div>
</div>

<div class="info">
    <table>
        <thead>
            <tr>
                <th>RequestID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="requestTableBody">
            <?php if (!empty($requests)): ?>
                <?php foreach ($requests as $request): ?>
                    <tr data-request-id="<?= $request['id'] ?>" 
                        data-status="<?= htmlspecialchars($request['status']) ?>"
                        data-name="<?= htmlspecialchars(strtolower($request['name'])) ?>"
                        data-email="<?= htmlspecialchars(strtolower($request['email'])) ?>">
                        <td>REQ-<?= str_pad($request['id'], 3, '0', STR_PAD_LEFT) ?></td>
                        <td><?= htmlspecialchars($request['name']) ?></td>
                        <td><?= htmlspecialchars($request['email']) ?></td>
                        <td><?= htmlspecialchars($request['city']) ?></td>
                        <td><?= htmlspecialchars($request['phone']) ?></td>
                        <td class="status-cell">
                            <span class="status-badge <?= strtolower(htmlspecialchars($request['status'])) ?>">
                                <?= htmlspecialchars($request['status']) ?>
                            </span>
                        </td>
                        <td class="action-cell">
                            <?php if ($request['status'] === 'Pending'): ?>
                                <button class="btn accept" onclick="updateRequestStatus(<?= $request['id'] ?>, 'Approved')">✓</button>
                                <button class="btn reject" onclick="updateRequestStatus(<?= $request['id'] ?>, 'Rejected')">✘</button>
                            <?php else: ?>
                                <span class="status-badge <?= strtolower(htmlspecialchars($request['status'])) ?>">
                                    <?= htmlspecialchars($request['status']) ?>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="no-results">No requests found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
// Filter function
const searchInput = document.getElementById('searchInput');
const statusFilter = document.getElementById('statusFilter');
const rows = document.querySelectorAll('#requestTableBody tr[data-request-id]');

function filterTable() {
    const searchText = searchInput.value.toLowerCase();
    const selectedStatus = statusFilter.value;
    let visibleCount = 0;

    rows.forEach(row => {
        const name = row.dataset.name;
        const email = row.dataset.email;
        const rowStatus = row.dataset.status;

        const matchesSearch = !searchText || name.includes(searchText) || email.includes(searchText);
        const matchesStatus = !selectedStatus || rowStatus === selectedStatus;

        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    // Show "no results" message if needed
    if (visibleCount === 0 && rows.length > 0) {
        const tbody = document.getElementById('requestTableBody');
        const existing = tbody.querySelector('.no-results-row');
        if (!existing) {
            const noResultsRow = document.createElement('tr');
            noResultsRow.className = 'no-results-row';
            noResultsRow.innerHTML = '<td colspan="7" class="no-results">No requests match your filters</td>';
            tbody.appendChild(noResultsRow);
        }
    } else {
        const existing = document.querySelector('.no-results-row');
        if (existing) existing.remove();
    }
}

searchInput.addEventListener('input', filterTable);
statusFilter.addEventListener('change', filterTable);

// Update request status via AJAX
async function updateRequestStatus(id, status) {
    try {
        const response = await fetch(`?url=AdminController/updateStatus&action=updateRequestStatus&id=${id}&status=${status}`);
        const data = await response.json();
        
        if (data.success) {
            // Update the row UI immediately
            const row = document.querySelector(`tr[data-request-id="${id}"]`);
            if (row) {
                // Update status cell with badge
                const statusClass = status.toLowerCase();
                row.querySelector('.status-cell').innerHTML = `<span class="status-badge ${statusClass}">${status}</span>`;
                
                // Update action cell with badge
                row.querySelector('.action-cell').innerHTML = `<span class="status-badge ${statusClass}">${status}</span>`;
                
                // Update data attributes
                row.dataset.status = status;
                
                // Update counters
                updateCounters();
            }
        } else {
            alert('Failed to update status: ' + (data.message || 'Unknown error'));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to update status');
    }
}

// Update the counter cards
function updateCounters() {
    const allRows = document.querySelectorAll('#requestTableBody tr[data-request-id]');
    let pending = 0, accepted = 0, rejected = 0;
    
    allRows.forEach(row => {
        const status = row.dataset.status;
        if (status === 'Pending') pending++;
        if (status === 'Approved') accepted++;
        if (status === 'Rejected') rejected++;
    });
    
    document.getElementById('pendingCount').textContent = pending;
    document.getElementById('acceptedCount').textContent = accepted;
    document.getElementById('rejectedCount').textContent = rejected;
}
</script>

</body>
</html>