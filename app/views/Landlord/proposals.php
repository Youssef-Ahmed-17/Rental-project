<?php
// معالجة رفع الملفات
if(isset($_FILES['document'])){
    $controller->uploadDocument($_POST['application_id'], $_FILES['document']);
    header("Location: tenant_applications.php");
    exit;
}

// معالجة تغيير الحالة
if(isset($_POST['status_change'])){
    $controller->changeStatus($_POST['application_id'], $_POST['status']);
    header("Location: tenant_applications.php");
    exit;
}

$applications = $controller->getApplications();
?>
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
.back-icon {
    display: inline-block;
    margin: 15px 20px;
    font-size: 26px;
    font-weight: bold;
    text-decoration: none;
    color: #000000ff;
    transition: 0.2s;
}

.back-icon:hover {
    color: #1b4d97;
    transform: translateX(-4px);
}

.top-header {
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
<a href="dashboard.php" class="back-icon">⬅</a>
<div class="top-header"><h3>Tenant Applications</h3></div>
<div class="tabs">
    <button class="active">Pending</button>
    <button>Accepted</button>
    <button>Rejected</button>
</div>

<?php foreach($applications as $app): ?>
    <?php $docs = $controllers->getDocuments($app['id']); ?>
    <div class="application-card">
        <div class="header">
            <h2><?php echo htmlspecialchars($app['property_name']); ?></h2>
            <span class="status <?php echo strtolower($app['status']); ?>"><?php echo ucfirst($app['status']); ?></span>
        </div>
        <p>Submitted on: <?php echo $app['submited_at']; ?></p>

        <h3>Tenant Information</h3>
        <div class="tenant-info">
            <div class="emoji">👤</div>
            <div>
                <h4><?php echo htmlspecialchars($app['tenant_name']); ?></h4>
                <p><?php echo htmlspecialchars($app['tenant_address']); ?></p>
                <p>Email: <?php echo htmlspecialchars($app['tenant_email']); ?></p>
                <p>Phone: <?php echo htmlspecialchars($app['tenant_phone']); ?></p>
            </div>
        </div>

        <h3>Submitted Documents</h3>
        <ul class="doc-list">
            <?php foreach($docs as $doc): ?>
                <li>
                    <?php echo htmlspecialchars($doc['file_name']); ?> 
                    <a href="<?php echo htmlspecialchars($doc['file_path']); ?>" target="_blank" class="download">⬇</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <form class="upload-form" action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="document" required>
            <input type="hidden" name="application_id" value="<?php echo $app['id']; ?>">
            <button type="submit">Upload Document</button>
        </form>

        <h3>Additional Note</h3>
        <p class="note"><?php echo htmlspecialchars($app['note']); ?></p>

        <div class="actions">
            <form action="" method="POST" style="display:inline-block;">
                <input type="hidden" name="status_change" value="1">
                <input type="hidden" name="application_id" value="<?php echo $app['id']; ?>">
                <input type="hidden" name="status" value="rejected">
                <button class="reject">Reject</button>
            </form>
            <form action="" method="POST" style="display:inline-block;">
                <input type="hidden" name="status_change" value="1">
                <input type="hidden" name="application_id" value="<?php echo $app['id']; ?>">
                <input type="hidden" name="status" value="accepted">
                <button class="accept">Accept</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>
</body>
</html>