<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Wall</title>

    <style>
        body {
            margin: 25px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fb;
        }

        .start {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .start p {
            font-size: 20px;
            font-weight: bold;
        }

        .search {
            margin: auto;
            background-color: rgb(236, 234, 234);
            width: 95%;
            height: 40px;
            border-radius: 10px;
            padding-left: 15px;
            border: none;
            font-size: 15px;
        }

        .searchrow {
            display: flex;
            justify-content: space-between;
            padding-right: 10px;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter {
            font-size: 24px;
            cursor: pointer;
        }

        .propertiesrow {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            font-weight: 600;
        }

        .row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 100px;
        }

        @media (max-width: 1200px) {
            .row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .row {
                grid-template-columns: 1fr;
            }
        }

        .card {
            height: 480px;
            border: rgb(187, 185, 185) 1px solid;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 10px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .card:hover {
            transform: scale(1.03);
            transition: 0.2s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .card-image {
            width: 100%;
            height: 200px;
            border-radius: 10px 10px 0 0;
            object-fit: cover;
            background: #ddd;
        }

        .description {
            display: flex;
            justify-content: space-between;
            padding: 0 15px;
            align-items: center;
        }

        .description p {
            margin: 8px 0;
            font-weight: 600;
            font-size: 15px;
        }

        .description2 {
            padding: 0 15px;
            color: grey;
            font-size: 14px;
        }

        .description2 p {
            margin: 5px 0;
        }

        .price {
            color: rgb(64, 64, 207);
            font-weight: bold;
        }

        .card-buttons {
            display: flex;
            gap: 12px;
            margin: 10px 15px 0 15px;
        }

        .btn-small {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: none;
            font-weight: bold;
            color: white;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: 0.2s;
            display: block;
        }

        .btn-small:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .details-btn {
            background: #418beb;
        }

        .apply-btn {
            background: #2b9446;
        }

        .save-btn {
            background: #f59e0b;
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            transition: 0.2s;
        }

        .save-btn:hover {
            transform: scale(1.1);
        }

        .save-btn.saved {
            background: #ef4444;
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

        .no-properties {
            text-align: center;
            padding: 60px 20px;
            color: #666;
            font-size: 18px;
            grid-column: 1 / -1;
        }
    </style>
</head>
<body>

<div class="start">
    <p>Welcome, <?= htmlspecialchars($name) ?></p>
    <p>⚙️</p>
</div>

<div class="searchrow">
    <input class="search" type="text" id="searchInput" placeholder="Search by title, city, or location...">
    <p class="filter">🔍</p>
</div>

<div class="propertiesrow">
    <p>All Properties</p>
    <p><span id="visibleCount"><?= $total_count ?></span> properties</p>
</div>

<div class="row" id="propertyList">
    <?php if (!empty($properties)): ?>
        <?php foreach ($properties as $property): ?>
            <div class="card" 
                 data-title="<?= htmlspecialchars(strtolower($property['title'])) ?>"
                 data-city="<?= htmlspecialchars(strtolower($property['city'])) ?>"
                 data-address="<?= htmlspecialchars(strtolower($property['address'] ?? '')) ?>">
                
                <img class="card-image" 
                     src="<?= htmlspecialchars($property['main_image'] ?? 'https://via.placeholder.com/400x200?text=No+Image') ?>" 
                     alt="<?= htmlspecialchars($property['title']) ?>"
                     onerror="this.src='https://via.placeholder.com/400x200?text=No+Image'">
                
                <div class="description">
                    <p><?= htmlspecialchars($property['title']) ?></p>
                    <button class="save-btn <?= $property['is_saved'] ? 'saved' : '' ?>" 
                            onclick="toggleSave(<?= $property['property_id'] ?>, this)">
                        <?= $property['is_saved'] ? '❤️' : '🤍' ?>
                    </button>
                </div>
                
                <div class="description2">
                    <p>📍 <?= htmlspecialchars($property['city']) ?></p>
                    <p>🛏 <?= $property['bedroom'] ?> bed  🛁 <?= $property['bathroom'] ?> bath  ◻ <?= $property['area_sqft'] ?> sqft</p>
                    <p>👁 <?= $property['view_count'] ?> views</p>
                </div>

                <div class="description">
                    <p class="price"><?= number_format($property['monthly_rent'], 0) ?> EGP/mo</p>
                </div>

                <div class="card-buttons">
                    <a class="btn-small details-btn" 
                       href="index.php?url=TenantController/propertyDetails/<?= $property['property_id'] ?>">Details</a>
                    <a class="btn-small apply-btn" 
                       href="index.php?url=TenantController/propertyApply/<?= $property['property_id'] ?>">Apply</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-properties">
            <p>No properties available at the moment.</p>
        </div>
    <?php endif; ?>
</div>

<!-- Add padding at bottom for nav -->
<div style="height: 80px;"></div>

<nav class="bottom-nav">
    <a href="index.php?url=TenantController/tenantWall" class="nav-item">
        <span>🏠</span>
        <span>Home</span>
    </a>
    <a href="index.php?url=TenantController/savedProperties" class="nav-item">
        <span>❤️</span>
        <span>Saved</span>
    </a>
    <a href="index.php?url=TenantController/tenantNotifications" class="nav-item">
        <span>🔔</span>
        <span>Notifications</span>
    </a>
</nav>

<script>
// Search functionality - searches title, city, and address
document.getElementById('searchInput').addEventListener('input', function(e) {
    const query = e.target.value.toLowerCase().trim();
    const cards = document.querySelectorAll('.card');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const title = card.dataset.title || '';
        const city = card.dataset.city || '';
        const address = card.dataset.address || '';
        
        const matches = title.includes(query) || 
                       city.includes(query) || 
                       address.includes(query);
        
        if (matches || query === '') {
            card.style.display = '';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    // Update visible count
    document.getElementById('visibleCount').textContent = visibleCount;
});

// Toggle save property
async function toggleSave(propertyId, button) {
    try {
        const response = await fetch(`index.php?url=TenantController/toggleSave&property_id=${propertyId}`);
        const data = await response.json();
        
        if (data.success) {
            if (data.saved) {
                button.classList.add('saved');
                button.textContent = '❤️';
            } else {
                button.classList.remove('saved');
                button.textContent = '🤍';
            }
        } else {
            alert('Failed to save property');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to save property');
    }
}
</script>

</body>
</html>