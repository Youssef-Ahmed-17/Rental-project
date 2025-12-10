<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Users</title>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        .header {
            text-align: center;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size: 50px;
            font-weight: 400;
            margin: 20px 0;
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
            gap: 20px;
            margin: 20px;
            flex-wrap: wrap;
        }

        .card {
            background: rgb(240, 248, 255);
            flex: 1;
            min-width: 250px;
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
            display: flex;
            gap: 15px;
            background: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 15px;
            border: 1px solid #e5e5e5;
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

        .dropdown {
            background: #f4f4f7;
            padding: 12px 15px;
            border-radius: 10px;
            border: none;
            font-size: 15px;
            color: #333;
            outline: none;
            cursor: pointer;
            min-width: 150px;
        }

        .info {
            margin: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        }

        .info table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .info th {
            padding: 15px 5px;
            font-size: 16px;
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .info td {
            padding: 12px 5px;
            font-size: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .info tr:hover {
            background-color: #f8f9fa;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-badge.active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-badge.inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-badge.suspended {
            background-color: #fff3cd;
            color: #856404;
        }

        .dropdown-action {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            background-color: white;
        }

        .dropdown-action:hover {
            background-color: #f8f9fa;
        }

        .no-results {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <a href="?url=AdminController/dashboard" class="back-icon">⬅</a>
    <h1 class="header">All Users</h1>

    <div class="dashboard">
        <div class="card">
            <div class="icon">👥</div>
            <div>
                <p class="title">Total Users</p>
                <p class="number" id="totalCount"><?= count($users ?? []) ?></p>
            </div>
        </div>

        <div class="card">
            <div class="icon">♻️</div>
            <div>
                <p class="title">Active Users</p>
                <p class="number" id="activeCount"><?= count(array_filter($users ?? [], fn($u) => $u['STATUS'] === 'active')) ?></p>
            </div>
        </div>

        <div class="card">
            <div class="icon">⚠️</div>
            <div>
                <p class="title">Suspended</p>
                <p class="number" id="suspendedCount"><?= count(array_filter($users ?? [], fn($u) => $u['STATUS'] === 'suspended')) ?></p>
            </div>
        </div>

        <div class="card">
            <div class="icon">🚫</div>
            <div>
                <p class="title">Inactive Users</p>
                <p class="number" id="inactiveCount"><?= count(array_filter($users ?? [], fn($u) => $u['STATUS'] === 'inactive')) ?></p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="search-box">
            <span style="font-size: 18px; color: #7b7b7b;">🔍</span>
            <input type="text" id="searchInput" placeholder="Search users by name or email...">
        </div>
        
        <select class="dropdown" id="statusFilter">
            <option value="">All Users</option>
            <option value="active">Active</option>
            <option value="suspended">Suspended</option>
            <option value="inactive">Inactive</option>
        </select>

        <select class="dropdown" id="roleFilter">
            <option value="">All Roles</option>
            <option value="admin">Admin</option>
            <option value="landlord">Landlord</option>
            <option value="tenant">Tenant</option>
        </select>
    </div>

    <div class="info">
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr data-user-id="<?= $user['id'] ?>" 
                            data-status="<?= htmlspecialchars($user['STATUS']) ?>" 
                            data-role="<?= htmlspecialchars($user['role']) ?>"
                            data-name="<?= htmlspecialchars(strtolower($user['name'])) ?>"
                            data-email="<?= htmlspecialchars(strtolower($user['email'])) ?>">
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['city']) ?></td>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                            <td><?= ucfirst(htmlspecialchars($user['role'])) ?></td>
                            <td>
                                <span class="status-badge <?= htmlspecialchars($user['STATUS']) ?>">
                                    <?= ucfirst(htmlspecialchars($user['STATUS'])) ?>
                                </span>
                            </td>
                            <td>
                                <select class="dropdown-action" onchange="updateUserStatus(<?= $user['id'] ?>, this.value)">
                                    <option value="">Change Status</option>
                                    <option value="active" <?= $user['STATUS'] === 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= $user['STATUS'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    <option value="suspended" <?= $user['STATUS'] === 'suspended' ? 'selected' : '' ?>>Suspended</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="no-results">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const roleFilter = document.getElementById('roleFilter');
        const rows = document.querySelectorAll('#userTableBody tr[data-user-id]');

        function filterTable() {
            const searchText = searchInput.value.toLowerCase();
            const selectedStatus = statusFilter.value;
            const selectedRole = roleFilter.value;
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.dataset.name;
                const email = row.dataset.email;
                const rowStatus = row.dataset.status;
                const rowRole = row.dataset.role;

                const matchesSearch = !searchText || name.includes(searchText) || email.includes(searchText);
                const matchesStatus = !selectedStatus || rowStatus === selectedStatus;
                const matchesRole = !selectedRole || rowRole === selectedRole;

                if (matchesSearch && matchesStatus && matchesRole) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show "no results" message if needed
            if (visibleCount === 0 && rows.length > 0) {
                const tbody = document.getElementById('userTableBody');
                const existing = tbody.querySelector('.no-results-row');
                if (!existing) {
                    const noResultsRow = document.createElement('tr');
                    noResultsRow.className = 'no-results-row';
                    noResultsRow.innerHTML = '<td colspan="7" class="no-results">No users match your filters</td>';
                    tbody.appendChild(noResultsRow);
                }
            } else {
                const existing = document.querySelector('.no-results-row');
                if (existing) existing.remove();
            }
        }

        searchInput.addEventListener('input', filterTable);
        statusFilter.addEventListener('change', filterTable);
        roleFilter.addEventListener('change', filterTable);

        async function updateUserStatus(id, status) {
            if (!status) return; // User didn't select anything

            try {
                const response = await fetch(`?url=AdminController/updateStatus&action=updateUserStatus&id=${id}&status=${status}`);
                const data = await response.json();
                
                if (data.success) {
                    const row = document.querySelector(`tr[data-user-id="${id}"]`);
                    if (row) {
                        // Update status badge
                        const statusBadge = row.querySelector('.status-badge');
                        statusBadge.className = `status-badge ${status}`;
                        statusBadge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                        
                        // Update data attribute
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

        function updateCounters() {
            let active = 0, inactive = 0, suspended = 0;
            
            rows.forEach(row => {
                const status = row.dataset.status;
                if (status === 'active') active++;
                else if (status === 'inactive') inactive++;
                else if (status === 'suspended') suspended++;
            });
            
            document.getElementById('totalCount').textContent = rows.length;
            document.getElementById('activeCount').textContent = active;
            document.getElementById('inactiveCount').textContent = inactive;
            document.getElementById('suspendedCount').textContent = suspended;
        }
    </script>
</body>
</html>