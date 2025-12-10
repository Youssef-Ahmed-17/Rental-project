<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Properties</title>
  
 <style>
 body{
    margin: 0;
    padding: 25px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f5f7fb;
} 

 .savebar{
   padding: 20px 50px;
   width: 100%;
   background: white; 
   position: fixed;
   top: 0;
   left: 0;
   z-index: 1000;
   box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.savebar h2 {
    margin: 0 0 5px 0;
    font-size: 24px;
}

.savebar p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.content {
    margin-top: 120px;
    margin-bottom: 80px;
}

.card {
    height: 450px;
    width: 380px; 
    border: 1px solid rgb(187, 185, 185);
    border-radius: 10px;
    margin: 20px;
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
}
  
.card:hover{
    transform: scale(1.03);
    transition: transform 0.2s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
  
.row {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    gap: 20px;
}

img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.description{
    display: flex;
    justify-content: space-between;
    padding: 0 15px;
    align-items: center;
}

.description p {
    margin: 8px 0;
    font-weight: 600;
}

.description2{
    padding: 0 15px;
    color: grey;
    font-size: 14px;
}

.description2 p {
    margin: 5px 0;
}

.price{
    color: rgb(64, 64, 207);
    font-weight: bold;
}

.card-buttons {
    display: flex;
    gap: 12px;
    margin: 10px 15px;
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
}

.details-btn {
    background: #418beb;
}

.remove-btn {
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

.no-saved {
    text-align: center;
    padding: 60px 20px;
    color: #666;
    font-size: 18px;
}
 </style>
</head>
<body>
    
<div class="savebar">
    <h2>❤️ Saved Properties</h2>
    <p><?= $saved_count ?> Properties Saved</p>
</div>

<div class="content">
    <?php if (!empty($properties)): ?>
    <div class="row">
        <?php foreach ($properties as $property): ?>
        <div class="card" id="card-<?= $property['property_id'] ?>">
            <img src="<?= htmlspecialchars($property['main_image'] ?? 'https://via.placeholder.com/400x200?text=No+Image') ?>" 
                 alt="<?= htmlspecialchars($property['title']) ?>"
                 onerror="this.src='https://via.placeholder.com/400x200?text=No+Image'">
            
            <div class="description"> 
                <p><?= htmlspecialchars($property['title']) ?></p>
                <p class="price"><?= number_format($property['monthly_rent'], 0) ?> EGP/mo</p>
            </div>
            
            <div class="description2"> 
                <p>📍 <?= htmlspecialchars($property['city']) ?></p>
                <p>🛏 <?= $property['bedroom'] ?>  🛁 <?= $property['bathroom'] ?>  ◻ <?= $property['area_sqft'] ?> sqft</p>
                <p>👁 <?= $property['view_count'] ?> views</p>
            </div>

            <div class="card-buttons">
                <a class="btn-small details-btn" 
                   href="?url=TenantController/propertyDetails&id=<?= $property['property_id'] ?>">
                    View Details
                </a>
                <button class="btn-small remove-btn" 
                        onclick="removeSaved(<?= $property['property_id'] ?>)">
                    Remove
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="no-saved">
        <p>💔 No saved properties yet.</p>
        <p><a href="?url=TenantController/tenantWall">Browse Properties</a></p>
    </div>
    <?php endif; ?>
</div>

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

<script>
async function removeSaved(propertyId) {
    if (!confirm('Remove this property from saved?')) return;
    
    try {
        const response = await fetch(`?url=TenantController/toggleSave&property_id=${propertyId}`);
        const data = await response.json();
        
        if (data.success) {
            // Remove card from view
            const card = document.getElementById(`card-${propertyId}`);
            if (card) {
                card.style.animation = 'fadeOut 0.3s';
                setTimeout(() => {
                    card.remove();
                    // Update count
                    const countEl = document.querySelector('.savebar p');
                    const currentCount = parseInt(countEl.textContent);
                    countEl.textContent = `${currentCount - 1} Properties Saved`;
                    
                    // Show "no saved" message if empty
                    if (document.querySelectorAll('.card').length === 0) {
                        location.reload();
                    }
                }, 300);
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to remove property');
    }
}
</script>

<style>
@keyframes fadeOut {
    from { opacity: 1; transform: scale(1); }
    to { opacity: 0; transform: scale(0.8); }
}
</style>

</body>
</html>