<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Property Details</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #418beb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 20px;
        }
 
        h2 {
            margin-bottom: 15px;
            font-size: 26px;
        }

        .slider-container {
            width: 100%;
            height: 350px;
            position: relative;
            overflow: hidden;
            border-radius: 14px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            background: #ddd;
        }

        .slides {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform 0.4s ease;
        }

        .slides img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            padding: 10px 14px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            user-select: none;
            z-index: 10;
        }

        .arrow:hover {
            background: #eef2ff;
        }

        .left {
            left: 12px;
        }

        .right {
            right: 12px;
        }

        .card {
            background: white;
            padding: 18px;
            margin-top: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.09);
        }

        .card:hover {
            transform: scale(1.01);
            transition: 0.25s ease;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin-top: 10px;
        }

        .details-grid div {
            background: #eef2ff;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
        }

        .request-btn {
            width: 100%;
            padding: 14px;
            background: #2b9446;
            border: none;
            color: white;
            font-size: 17px;
            border-radius: 10px;
            margin-top: 20px;
            cursor: pointer;
            transition: 0.25s ease;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .request-btn:hover {
            background: #236d38;
            transform: scale(1.02);
        }

        .request-btn.disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .save-btn {
            background: #f59e0b;
            padding: 10px 20px;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
        }

        .save-btn.saved {
            background: #ef4444;
        }

        .landlord-info {
            background: #f0f9ff;
            padding: 15px;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="?url=TenantController/tenantWall" class="back-btn">← Back to Properties</a>

        <h2>🏠 Property Details</h2>

        <?php if (!empty($images)): ?>
        <div class="slider-container">
            <div class="slides" id="slides">
                <?php foreach ($images as $image): ?>
                    <img src="<?= htmlspecialchars($image['image_url']) ?>" 
                         alt="Property Image"
                         onerror="this.src='https://via.placeholder.com/900x350?text=Image+Not+Found'">
                <?php endforeach; ?>
            </div>

            <?php if (count($images) > 1): ?>
                <div class="arrow left" onclick="moveSlide(-1)">&#10094;</div>
                <div class="arrow right" onclick="moveSlide(1)">&#10095;</div>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="slider-container">
            <img src="https://via.placeholder.com/900x350?text=No+Images+Available" 
                 alt="No images" style="width: 100%; height: 350px;">
        </div>
        <?php endif; ?>

        <div class="card">
            <h3><?= htmlspecialchars($property['title']) ?></h3>
            <p>📍 <?= htmlspecialchars($property['city']) ?>, <?= htmlspecialchars($property['address'] ?? '') ?></p>
            <p><strong>Price:</strong> <?= number_format($property['monthly_rent'], 0) ?> EGP / month</p>

            <div class="details-grid">
                <?php if ($property['floor']): ?>
                    <div>🏢 <?= $property['floor'] ?><?= $property['floor'] == 1 ? 'st' : ($property['floor'] == 2 ? 'nd' : ($property['floor'] == 3 ? 'rd' : 'th')) ?> Floor</div>
                <?php endif; ?>
                <div>🛏 <?= $property['bedroom'] ?> Bedrooms</div>
                <div>🛁 <?= $property['bathroom'] ?> Bathrooms</div>
                <div>📐 <?= number_format($property['area_sqft']) ?> m²</div>
            </div>

            <div class="landlord-info">
                <strong>Landlord:</strong> <?= htmlspecialchars($property['landlord_name']) ?><br>
                <strong>Phone:</strong> <?= htmlspecialchars($property['landlord_phone']) ?><br>
                <strong>Views:</strong> <?= $view_count ?>
            </div>

            <button class="save-btn <?= $is_saved ? 'saved' : '' ?>" 
                    onclick="toggleSave(<?= $property['property_id'] ?>, this)">
                <?= $is_saved ? '❤️ Saved' : '🤍 Save Property' ?>
            </button>
        </div>

        <div class="card">
            <h3>Description</h3>
            <p>
                <?= nl2br(htmlspecialchars($property['description'] ?? 'No description available.')) ?>
            </p>
        </div>

        <?php if ($has_applied): ?>
            <button class="request-btn disabled" disabled>
                ✓ Already Applied
            </button>
        <?php else: ?>
            <a href="?url=TenantController/propertyApply&id=<?= $property['property_id'] ?>" 
               class="request-btn">
                Send Application
            </a>
        <?php endif; ?>
    </div>

    <script>
        let index = 0;

        function moveSlide(direction) {
            const slides = document.getElementById("slides");
            const total = slides.children.length;

            index = index + direction;

            if (index < 0) index = total - 1;
            if (index > total - 1) index = 0;

            slides.style.transform = `translateX(-${index * 100}%)`;
        }

        // Toggle save property
        async function toggleSave(propertyId, button) {
            try {
                const response = await fetch(`?url=TenantController/toggleSave&property_id=${propertyId}`);
                const data = await response.json();
                
                if (data.success) {
                    if (data.saved) {
                        button.classList.add('saved');
                        button.textContent = '❤️ Saved';
                    } else {
                        button.classList.remove('saved');
                        button.textContent = '🤍 Save Property';
                    }
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>
</body>
</html>