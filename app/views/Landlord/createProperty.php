<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Add New Property</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fb;
            padding-bottom: 50px;
        }

        .back-icon {
            display: inline-block;
            margin: 20px 30px;
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
            max-width: 900px;
            margin: 0 auto;
            padding: 0 30px;
        }

        .section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .section h4 {
            margin: 0 0 20px 0;
            font-size: 18px;
            color: #333;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #444;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            background: #fafafa;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #418beb;
            background: white;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
            font-family: inherit;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .row {
                grid-template-columns: 1fr;
            }
        }

        .upload-area {
            border: 2px dashed #418beb;
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            background: #f8f9ff;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-area:hover {
            background: #eef2ff;
            border-color: #2563eb;
        }

        .upload-icon {
            font-size: 48px;
            color: #418beb;
            margin-bottom: 12px;
        }

        .upload-text {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .upload-subtext {
            font-size: 14px;
            color: #666;
        }

        input[type="file"] {
            display: none;
        }

        .preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .preview-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .preview-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .buttons-row {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            border-radius: 10px;
            border: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .create-btn {
            background: #2b9446;
            color: white;
        }

        .create-btn:hover {
            background: #236d38;
            transform: translateY(-2px);
        }

        .cancel-btn {
            background: #ccc;
            color: #333;
        }

        .cancel-btn:hover {
            background: #bbb;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <a href="index.php?url=LandlordController/landlordDashboard" class="back-icon">← Back</a>
    
    <div class="top-header">
        <h3>➕ Add New Property</h3>
    </div>

    <div class="container">
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?url=LandlordController/createProperty" enctype="multipart/form-data">
            
            <div class="section">
                <h4>📝 Basic Information</h4>
                <div class="form-group">
                    <label for="title">Property Title *</label>
                    <input type="text" id="title" name="title" required 
                           placeholder="🏠 e.g., Modern Downtown Apartment">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" 
                              placeholder="📝 Describe your property, amenities, nearby facilities..."></textarea>
                </div>
            </div>

            <div class="section">
                <h4>📍 Location & Pricing</h4>
                <div class="row">
                    <div class="form-group">
                        <label for="city">City *</label>
                        <input type="text" id="city" name="city" required 
                               placeholder="📍 e.g., Cairo">
                    </div>
                    <div class="form-group">
                        <label for="monthly_rent">Monthly Rent (EGP) *</label>
                        <input type="number" id="monthly_rent" name="monthly_rent" required 
                               placeholder="e.g., 5000">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="address">Full Address</label>
                        <input type="text" id="address" name="address" 
                               placeholder="🏢 123 Main Street, Downtown">
                    </div>
                    <div class="form-group">
                        <label for="floor">Floor</label>
                        <input type="number" id="floor" name="floor" 
                               placeholder="e.g., 7">
                    </div>
                </div>
            </div>

            <div class="section">
                <h4>🏠 Property Details</h4>
                <div class="row">
                    <div class="form-group">
                        <label for="bedroom">Bedrooms *</label>
                        <input type="number" id="bedroom" name="bedroom" required min="0" value="1" 
                               placeholder="e.g., 2">
                    </div>
                    <div class="form-group">
                        <label for="bathroom">Bathrooms *</label>
                        <input type="number" id="bathroom" name="bathroom" required min="0" value="1" 
                               placeholder="e.g., 2">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="area_sqft">Area (sqft) *</label>
                        <input type="number" id="area_sqft" name="area_sqft" required min="1" 
                               placeholder="e.g., 1400">
                    </div>
                    <div class="form-group">
                        <label for="status">Status *</label>
                        <select id="status" name="status" required>
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                            <option value="rented">Rented</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="section">
                <h4>📷 Property Images</h4>
                <div class="upload-area" onclick="document.getElementById('images').click()">
                    <div class="upload-icon">⬆️</div>
                    <div class="upload-text">Click to upload images (<span id="imageCount">0</span>/5)</div>
                    <div class="upload-subtext">JPG, PNG or JPEG (Max 5MB each)</div>
                    <input type="file" id="images" name="images[]" multiple 
                           accept="image/jpeg,image/jpg,image/png" 
                           onchange="previewImages(event)">
                </div>
                <div class="preview-container" id="previewContainer"></div>
            </div>

            <div class="buttons-row">
                <button type="submit" class="btn create-btn">✅ Create Property</button>
                <a href="index.php?url=LandlordController/landlordDashboard" class="btn cancel-btn" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">❌ Cancel</a>
            </div>
        </form>
    </div>

    <script>
        let selectedFiles = [];

        function previewImages(event) {
            const files = Array.from(event.target.files);
            const previewContainer = document.getElementById('previewContainer');
            const imageCountSpan = document.getElementById('imageCount');
            
            // Limit to 5 images
            if (files.length > 5) {
                alert('Maximum 5 images allowed');
                event.target.value = '';
                return;
            }
            
            // Clear previous previews
            previewContainer.innerHTML = '';
            selectedFiles = files;
            
            files.forEach((file, index) => {
                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File ${file.name} is too large. Maximum size is 5MB`);
                    return;
                }
                
                // Check file type
                if (!file.type.match('image.*')) {
                    alert(`File ${file.name} is not an image`);
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';
                    previewItem.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="remove-image" onclick="removeImage(${index})">×</button>
                    `;
                    previewContainer.appendChild(previewItem);
                };
                reader.readAsDataURL(file);
            });
            
            // Update count
            imageCountSpan.textContent = files.length;
        }
        
        function removeImage(index) {
            const dt = new DataTransfer();
            const input = document.getElementById('images');
            const files = input.files;
            
            for (let i = 0; i < files.length; i++) {
                if (i !== index) {
                    dt.items.add(files[i]);
                }
            }
            
            input.files = dt.files;
            
            // Re-trigger preview
            const event = new Event('change');
            input.dispatchEvent(event);
        }
    </script>
</body>
</html>