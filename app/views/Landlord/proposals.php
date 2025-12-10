<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Tenant Applications</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 20px;
            padding-bottom: 100px;
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
            color: #418beb;
            transform: translateX(-4px);
        }

        .top-header {
            background: white;
            padding: 20px 30px;
            font-size: 24px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
            margin-bottom: 30px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .tabs {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .tabs button {
            padding: 12px 24px;
            border: none;
            background: white;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .tabs button:hover {
            transform: translateY(-2px);
        }

        .tabs button.active {
            background: #418beb;
            color: white;
        }

        .application-card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: 0.2s;
        }

        .application-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
            color: #333;
        }

        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 14px;
        }

        .status {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status.accepted {
            background: #d4edda;
            color: #155724;
        }

        .status.rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .tenant-info {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 20px;
            align-items: start;
            margin: 20px 0;
        }

        .emoji {
            background: #eef2ff;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 35px;
        }

        .tenant-details h4 {
            margin: 0 0 10px 0;
            font-size: 18px;
            color: #333;
        }

        .tenant-details p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        .message-box {
            background: #f8f9ff;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 4px solid #418beb;
        }

        .message-box h4 {
            margin: 0 0 10px 0;
            font-size: 16px;
            color: #333;
        }

        .message-box p {
            margin: 0;
            color: #666;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .reject-btn {
            background: #ef4444;
            color: white;
        }

        .reject-btn:hover {
            background: #dc2626;
        }

        .accept-btn {
            background: #2b9446;
            color: white;
        }

        .accept-btn:hover {
            background: #236d38;
        }

        .no-applications {
            background: white;
            padding: 60px;
            text-align: center;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .no-applications-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .no-applications h3 {
            margin: 0 0 10px 0;
            color: #333;
        }

        .no-applications p {
            margin: 0;
            color: #666;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <a href="index.php?url=LandlordController/landlordDashboard" class="back-icon">←</a>
    
    <div class="top-header">
        <h3>📋 Tenant Applications</h3>
    </div>

    <div class="container">
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="tabs">
            <button class="active" onclick="filterApplications('all')">All Applications</button>
            <button onclick="filterApplications('pending')">Pending</button>
            <button onclick="filterApplications('accepted')">Accepted</button>
            <button onclick="filterApplications('rejected')">Rejected</button>
        </div>

        <?php if (!empty($applications)): ?>
            <?php foreach($applications as $app): ?>
                <div class="application-card" data-status="<?= strtolower($app['status']) ?>">
                    <div class="header">
                        <div>
                            <h2><?= htmlspecialchars($app['title']) ?></h2>
                            <p>📍 <?= htmlspecialchars($app['city']) ?></p>
                            <p>💰 <?= number_format($app['monthly_rent'], 0) ?> EGP/month</p>
                            <p>📅 Applied: <?= date('M d, Y', strtotime($app['applied_at'])) ?></p>
                        </div>
                        <span class="status <?= strtolower($app['status']) ?>">
                            <?= ucfirst($app['status']) ?>
                        </span>
                    </div>

                    <div class="tenant-info">
                        <div class="emoji">👤</div>
                        <div class="tenant-details">
                            <h4><?= htmlspecialchars($app['tenant_name']) ?></h4>
                            <p>📧 Email: <?= htmlspecialchars($app['tenant_email']) ?></p>
                            <p>📱 Phone: <?= htmlspecialchars($app['tenant_phone']) ?></p>
                        </div>
                    </div>

                    <?php if (!empty($app['message'])): ?>
                        <div class="message-box">
                            <h4>💬 Message from Tenant:</h4>
                            <p><?= nl2br(htmlspecialchars($app['message'])) ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($app['status'] === 'pending'): ?>
                        <div class="actions">
                            <form method="POST" action="index.php?url=LandlordController/updateApplicationStatus" style="display: inline;">
                                <input type="hidden" name="application_id" value="<?= $app['application_id'] ?>">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn reject-btn" onclick="return confirm('Are you sure you want to reject this application?')">
                                    ❌ Reject
                                </button>
                            </form>
                            <form method="POST" action="index.php?url=LandlordController/updateApplicationStatus" style="display: inline;">
                                <input type="hidden" name="application_id" value="<?= $app['application_id'] ?>">
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="btn accept-btn" onclick="return confirm('Are you sure you want to accept this application?')">
                                    ✅ Accept
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-applications">
                <div class="no-applications-icon">📭</div>
                <h3>No Applications Yet</h3>
                <p>When tenants apply to your properties, they will appear here.</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function filterApplications(status) {
            const cards = document.querySelectorAll('.application-card');
            const buttons = document.querySelectorAll('.tabs button');
            
            // Update active button
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filter cards
            cards.forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>