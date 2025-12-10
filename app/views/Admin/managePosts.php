<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Posts</title>
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
.card-head{
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
.card-group{
   text-align: center;
   flex-direction: row;
    display: flex;
    width: 100%;
    border: 250px;
}
.card {
    height: auto;
    width: 350px; 
    border: rgb(187, 185, 185) 1px solid;
    border-radius: 15px;
    margin: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    overflow: hidden;
    background: white;
    position: relative;
}
.card:hover{
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}
.row {
    margin-top: 30px;
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    padding-left: 20px;
}
img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    background: #e0e0e0;
}
.image-container {
    position: relative;
    width: 100%;
}
.property-title {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    color: white;
    padding: 30px 15px 15px 15px;
    font-size: 16px;
    font-weight: bold;
}
.property-info {
    padding: 15px;
}
.property-price {
    color: #4169E1;
    font-size: 18px;
    font-weight: bold;
    margin: 10px 0;
}
.property-details {
    color: #666;
    font-size: 14px;
    line-height: 1.8;
}
.description{
    display: flex;
    justify-content: space-between;
    margin: 15px 20px; 
    font-weight: bold;
    align-items: center;
}
.description2{
    padding: 0px 20px;
    color: #555;
    font-size: 14px;
}  
.price{
    color: #4169E1;
    font-weight: bold;
    font-size: 16px;
}
.landlord-info {
    font-size: 14px;
    color: #666;
    margin: 5px 0;
}
.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
    margin: 5px 0;
}
.status-pending {
    background: #FFF3CD;
    color: #856404;
}
.btn-approve {
    background-color: #90EE90;
    padding: 8px 16px;
    border: none;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
    margin: 5px;
    font-weight: bold;
}
.btn-approve:hover {
    background-color: #7CDB7C;
}
.btn-reject {
    background-color: #F08080;
    padding: 8px 16px;
    border: none;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
    margin: 5px;
    font-weight: bold;
}
.btn-reject:hover {
    background-color: #E06C6C;
}
.button-group {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}
</style>
<body>
    <a href="?url=AdminController/dashboard" class="back-icon">⬅</a>
    <h1 class="header">Manage Posts</h1>

<div class="dashboard">
    <div class="column">
        <div class="card-head">
            <div class="icon req">💬</div>
            <div>
                <p class="title">Total Posts</p>
                <p class="number"><?= $total_posts ?? 0 ?></p>
            </div>
        </div>

        <div class="card-head">
            <div class="icon acc">✔</div>
            <div>
                <p class="title">Approved</p>
                <p class="number"><?= $approved_posts ?? 0 ?></p>
            </div>
        </div>
        
        <div class="card-head">
            <div class="icon acc">✖</div>
            <div>
                <p class="title">Inactive</p>
                <p class="number"><?= $inactive_posts ?? 0 ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="card" data-property-id="<?= $post['property_id'] ?>">
                <div class="image-container">
                    <?php if (!empty($post['main_image'])): ?>
                        <img src="<?= htmlspecialchars($post['main_image']) ?>" alt="Property Image">
                    <?php else: ?>
                        <img src="pic_1.jpg" alt="Property Image">
                    <?php endif; ?>
                    <div class="property-title">
                        <?= htmlspecialchars($post['title'] ?? 'Property') ?>
                    </div>
                </div>
                
                <div class="property-info">
                    <p class="property-details" style="margin: 5px 0;">📍 <?= htmlspecialchars($post['city'] ?? 'Unknown') ?></p>
                    <p class="property-details" style="margin: 5px 0;">🛏 <?= $post['bedroom'] ?? 0 ?> bed  🚿 <?= $post['bathroom'] ?? 0 ?> bath  ◻ <?= $post['area_sqft'] ?? 0 ?> sqft</p>
                    <p class="property-details" style="margin: 5px 0;">👤 Landlord: <?= htmlspecialchars($post['landlord_name'] ?? 'Unknown') ?></p>
                    <p class="property-details" style="margin: 5px 0;">👁 0 views</p>
                    
                    <p class="property-price"><?= number_format($post['monthly_rent'] ?? 0) ?> EGP/mo</p>
                    
                    <div style="text-align: center; margin: 10px 0;">
                        <span class="status-badge status-pending">⏳ Pending Approval</span>
                    </div>
                    
                    <div class="button-group">
                        <button class="btn-approve" onclick="approveProperty(<?= $post['property_id'] ?>)">
                            Approve ✓
                        </button>
                        <button class="btn-reject" onclick="rejectProperty(<?= $post['property_id'] ?>)">
                            Reject ✗
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; width: 100%; margin-top: 50px; font-size: 18px; color: #666;">No pending posts available</p>
    <?php endif; ?>
</div>

<?php if (!empty($_SESSION['success'])): ?>
    <script>
        alert('<?= addslashes($_SESSION['success']) ?>');
    </script>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <script>
        alert('<?= addslashes($_SESSION['error']) ?>');
    </script>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<script>
function approveProperty(id) {
    if (confirm('Are you sure you want to approve this property? It will appear on the tenant wall.')) {
        window.location.href = `?url=AdminController/approveProperty&id=${id}`;
    }
}

function rejectProperty(id) {
    if (confirm('Are you sure you want to reject this property?')) {
        window.location.href = `?url=AdminController/rejectProperty&id=${id}`;
    }
}
</script>

</body>
</html>