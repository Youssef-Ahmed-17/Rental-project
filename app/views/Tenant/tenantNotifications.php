<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>My Applications</title>

    <style>  
       body { 
           font-family: Arial, sans-serif; 
           background: #f5f7fb;
           padding: 20px; 
           margin: 0; 
       }
       
       .container {
           max-width: 1000px;
           margin: auto;
       }
       
       .back-icon {
           display: inline-block;
           margin: 15px 0;
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

       h2 { 
           margin-bottom: 20px;
           font-size: 28px; 
       }
       
       .stats {
           display: flex;
           gap: 20px;
           margin-bottom: 30px;
           flex-wrap: wrap;
       }
       
       .stat-card {
           background: white;
           padding: 20px;
           border-radius: 12px;
           box-shadow: 0 2px 8px rgba(0,0,0,0.1);
           flex: 1;
           min-width: 150px;
       }
       
       .stat-card h3 {
           margin: 0 0 10px 0;
           font-size: 14px;
           color: #666;
       }
       
       .stat-card .number {
           font-size: 32px;
           font-weight: bold;
           margin: 0;
       }
       
       .stat-card.pending .number { color: #f59e0b; }
       .stat-card.accepted .number { color: #10b981; }
       .stat-card.rejected .number { color: #ef4444; }
       
       .application-card { 
           background: white; 
           padding: 20px; 
           border-radius: 12px; 
           margin-bottom: 15px;
           box-shadow: 0 3px 10px rgba(0,0,0,0.09); 
           display: flex; 
           gap: 20px;
           align-items: center;   
           transition: transform 0.25s ease, box-shadow 0.25s ease; 
       }
       
       .application-card:hover { 
           transform: scale(1.02); 
           box-shadow: 0 6px 18px rgba(0,0,0,0.12);  
           cursor: pointer;  
       }
       
       .app-image {
           width: 120px;
           height: 120px;
           border-radius: 10px;
           object-fit: cover;
           background: #ddd;
       }
       
       .info {
           flex: 1;
       }
       
       .info h3 { 
           margin: 0 0 8px 0; 
           font-size: 18px;  
           font-weight: bold; 
       }

       .info p {  
           margin: 4px 0; 
           color: #666; 
           font-size: 14px;
       }
       
       .status-badge {
           display: inline-block;
           padding: 8px 16px;
           border-radius: 20px;
           font-size: 14px;
           font-weight: 600;
           text-transform: uppercase;
       }
       
       .status-badge.pending {
           background: #fef3c7;
           color: #92400e;
       }
       
       .status-badge.accepted {
           background: #d1fae5;
           color: #065f46;
       }
       
       .status-badge.rejected {
           background: #fee2e2;
           color: #991b1b;
       }
       
       .no-applications {
           text-align: center;
           padding: 60px 20px;
           background: white;
           border-radius: 12px;
           color: #666;
       }
       
       .bottom-nav {
           position: fixed;
           bottom: 0;
           left: 0;
           width: 100%;
           background: white;
           display: flex;
           justify-content: space-around;
           padding: 12px 0;
           border-top: 1px solid #ddd;
           box-shadow: 0 -2px 8px rgba(0,0,0,0.1);
       }

       .nav-item {
           text-decoration: none;
           color: #080808;
           font-size: 14px;
           display: flex;
           flex-direction: column;
           align-items: center;
           gap: 4px;
       }
       
       .nav-item:hover {
           color: #418beb;
       }
     </style>
</head>
<body>
    <div class="container">
        <a href="?url=TenantController/tenantWall" class="back-icon">← Back to Home</a>
        <h2>📋 My Applications</h2>

        <div class="stats">
            <div class="stat-card pending">
                <h3>Pending</h3>
                <p class="number"><?= $pending_count ?></p>
            </div>
            <div class="stat-card accepted">
                <h3>Accepted</h3>
                <p class="number"><?= $accepted_count ?></p>
            </div>
            <div class="stat-card rejected">
                <h3>Rejected</h3>
                <p class="number"><?= $rejected_count ?></p>
            </div>
        </div>

        <?php if (!empty($applications)): ?>
            <?php foreach ($applications as $app): ?>
                <div class="application-card" 
                     onclick="window.location='?url=TenantController/propertyDetails&id=<?= $app['property_id'] ?>'">
                    <img class="app-image" 
                         src="<?= htmlspecialchars($app['main_image'] ?? 'https://via.placeholder.com/120?text=No+Image') ?>" 
                         alt="<?= htmlspecialchars($app['title']) ?>"
                         onerror="this.src='https://via.placeholder.com/120?text=No+Image'">
                    
                    <div class="info">
                        <h3><?= htmlspecialchars($app['title']) ?></h3>
                        <p>📍 <?= htmlspecialchars($app['city']) ?>, <?= htmlspecialchars($app['address'] ?? '') ?></p>
                        <p>💰 <?= number_format($app['monthly_rent'], 0) ?> EGP/month</p>
                        <?php if ($app['message']): ?>
                            <p>💬 <?= htmlspecialchars(substr($app['message'], 0, 100)) ?><?= strlen($app['message']) > 100 ? '...' : '' ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <span class="status-badge <?= htmlspecialchars($app['status']) ?>">
                        <?= htmlspecialchars($app['status']) ?>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-applications">
                <h3>📝 No Applications Yet</h3>
                <p>You haven't applied to any properties yet.</p>
                <p><a href="?url=TenantController/tenantWall">Browse Properties</a></p>
            </div>
        <?php endif; ?>
    </div>

    <div style="height: 80px;"></div>

    <nav class="bottom-nav">
        <a href="?url=TenantController/tenantWall" class="nav-item">
            <span>🏠</span>
            <span>Home</span>
        </a>
        <a href="?url=TenantController/savedProperties" class="nav-item">
            <span>❤️</span>
            <span>Saved</span>
        </a>
        <a href="?url=TenantController/tenantNotifications" class="nav-item">
            <span>🔔</span>
            <span>Notifications</span>
        </a>
    </nav>
</body>
</html>