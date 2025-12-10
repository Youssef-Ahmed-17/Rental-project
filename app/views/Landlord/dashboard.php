<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Landlord Dashboard</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f5f7fb;
}

.fcard {
    background: white;
    width: 100%;
    padding: 20px 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);   
}

.fcard h1 {
    margin: 0 0 5px 0;
    font-size: 28px;
}

.fcard p {
    margin: 0;
    color: #666;
}

.dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin: 30px;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}

.icon {
    width: 70px;
    height: 70px;
    border-radius: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 35px;
    background: #eef2ff;
}

.title {
    margin: 0;
    font-size: 14px;
    color: #666;
}

.number {
    margin: 5px 0 0;
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

.buttons-row {
    margin: 30px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.btn {
    padding: 15px;
    border-radius: 10px;
    border: none;
    font-weight: bold;
    color: white;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    transition: 0.2s;
    font-size: 15px;
}

.add-btn { background: #418beb; }
.view-btn { background: #2361be; }
.list-btn { background: #0d2a74; }

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.my-properties {
    margin: 30px;
}

.my-properties h3 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

.properties-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 20px;
}

.property-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: 0.2s;
}

.property-card:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.property-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: #ddd;
}

.property-info {
    padding: 15px;
}

.property-info h4 {
    margin: 0 0 10px 0;
    font-size: 18px;
}

.property-info p {
    margin: 5px 0;
    color: #666;
    font-size: 14px;
}

.property-actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.property-actions a,
.property-actions button {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    border: none;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    font-size: 14px;
}

.edit-action {
    background: #418beb;
    color: white;
}

.delete-action {
    background: #ef4444;
    color: white;
}

.empty-box {
    background: white;
    padding: 60px 30px;
    text-align: center;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.empty-icon {
    font-size: 60px;
    display: block;
    margin-bottom: 15px;
}

.add-first {
    margin-top: 20px;
    padding: 15px 30px;
    background: #418beb;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
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
    z-index: 100;
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

.alert {
    margin: 20px 30px;
    padding: 15px;
    border-radius: 8px;
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

.status-badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
}

.status-available {
    background: #d4edda;
    color: #155724;
}

.status-rented {
    background: #fff3cd;
    color: #856404;
}

.status-unavailable {
    background: #f8d7da;
    color: #721c24;
}
</style>
</head>
<body>
    <div class="fcard">
        <h1>🏢 Landlord Dashboard</h1>
        <p>Welcome back, <?= htmlspecialchars($name) ?></p>
    </div>

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
        
    <div class="dashboard">
        <div class="card">
            <div class="icon">🏢</div>
            <div>
                <p class="title">Total Properties</p>
                <p class="number"><?= $total_properties ?></p>
            </div>
        </div>

        <div class="card">
            <div class="icon">🏠</div>
            <div>
                <p class="title">Rented Properties</p>
                <p class="number"><?= $rented_properties ?></p>
            </div>
        </div>

        <div class="card">
            <div class="icon">📄</div>
            <div>
                <p class="title">Pending Applications</p>
                <p class="number"><?= $pending_applications ?></p>
            </div>
        </div>
    </div>

    <div class="buttons-row">
        <a class="btn add-btn" href="index.php?url=LandlordController/createProperty">➕ Add New Property</a>
        <a class="btn view-btn" href="index.php?url=LandlordController/proposals">📋 View Applications</a>
        <a class="btn list-btn" href="index.php?url=LandlordController/landlordNotifications">🔔 Notifications</a>
    </div>

    <section class="my-properties">
        <h3>My Properties</h3>
        
        <?php if (!empty($properties)): ?>
            <div class="properties-grid">
                <?php foreach($properties as $property): ?>
                    <div class="property-card">
                        <img class="property-image" 
                             src="<?= htmlspecialchars($property['main_image'] ?? 'https://via.placeholder.com/400x200?text=No+Image') ?>" 
                             alt="<?= htmlspecialchars($property['title']) ?>"
                             onerror="this.src='https://via.placeholder.com/400x200?text=No+Image'">
                        
                        <div class="property-info">
                            <h4><?= htmlspecialchars($property['title']) ?></h4>
                            <p>📍 <?= htmlspecialchars($property['city']) ?></p>
                            <p>🛏 <?= $property['bedroom'] ?> bed | 🛁 <?= $property['bathroom'] ?> bath | ◻ <?= $property['area_sqft'] ?> sqft</p>
                            <p><strong>💰 <?= number_format($property['monthly_rent'], 0) ?> EGP/month</strong></p>
                            <p>👁 <?= $property['view_count'] ?> views | 📝 <?= $property['pending_applications'] ?> applications</p>
                            <span class="status-badge status-<?= strtolower($property['status']) ?>">
                                <?= ucfirst($property['status']) ?>
                            </span>
                            
                            <div class="property-actions">
                                <a href="index.php?url=LandlordController/editProperty/<?= $property['property_id'] ?>" 
                                   class="edit-action">✏️ Edit</a>
                                <button onclick="deleteProperty(<?= $property['property_id'] ?>)" 
                                        class="delete-action">🗑️ Delete</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-box">
                <span class="empty-icon">🏙️</span>
                <p>No properties yet</p>
                <p>Start by adding your first property</p>
                <a href="index.php?url=LandlordController/createProperty">
                    <button class="add-first">➕ Add Your First Property</button>
                </a>
            </div>
        <?php endif; ?>
    </section>

    <div style="height: 80px;"></div>

    <nav class="bottom-nav">
        <a href="index.php?url=LandlordController/landlordDashboard" class="nav-item">
            <span>🏠</span>
            <span>Home</span>
        </a>
        <a href="index.php?url=LandlordController/landlordNotifications" class="nav-item">
            <span>🔔</span>
            <span>Notifications</span>
        </a>
    </nav>

    <script>
        function deleteProperty(propertyId) {
            if (confirm('Are you sure you want to delete this property? This action cannot be undone.')) {
                window.location.href = `index.php?url=LandlordController/deleteProperty/${propertyId}`;
            }
        }
    </script>
</body>
</html>