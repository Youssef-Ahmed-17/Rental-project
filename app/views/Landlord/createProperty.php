<!DOCTYPE html>
 <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Add new property</title>
         <style>
  body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f4f4f4;
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

    /* FIXED HEADER */
    .top-header {
      top: 0;
      left: 0;
      right: 0;
      background: white;
      padding: 15px 18px;
      font-size: 20px;
      font-weight: bold;
      border-bottom: 1px solid #ddd;
    }
 .section {
    border: 1px solid #e6e6e6;
    border-radius: 10px;
    padding: 50px;
    margin-top: 20px;
    background: #fff;
}

h4 {
    margin-bottom: 10px;
    font-size: 16px;
    color: #333;
}

label {
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
    color: #444;
}

input, textarea {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    margin-bottom: 15px;
    font-size: 14px;
    background: #fafafa;
}

textarea {
    height: 100px;
} 
  .upload-icon {
    font-size: 36px;
    color: #47597c;
    margin-bottom: 12px;
  }
  .upload-text {
    font-size: 18px;
    margin-bottom: 6px;
  }
  .upload-subtext {
    font-size: 14px;
    color: #a0aec0;
  }
  input[type="file"] {
    display: none;
  }
  label {
    cursor: pointer;
  }
 .buttons-row {
    margin-top: 35px;
    display: flex;
    gap: 30px;
    justify-content: flex-start;
    padding-left: 20px;
}
.btn {
    width: 300px;
    padding: 12px;
    text-decoration: solid;
    border-radius: 10px;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: .2s;
    width: 90%;
}
.new-btn { background: #4ca8af;}
.cancel-btn{ background: #cacacad2; }

      </style>
    </head>
        <body> 
          <a href="dashboard.php" class="back-icon">⬅</a>
            <div class="top-header"> 
                <h3>Add New Property</h3>
            </div>
          <div class="section">
        <h4>Basic Information</h4>
          <form>
        <label for="1">Property Title </label>
        <input type="text" placeholder="🏠  e.g., Modern Downtown Apartment"> <Br>
        <label for="2">Description </label>
        <textarea placeholder="📝  Describe your property, amenities, nearby facilities..."></textarea> <br>
        </form>
    </div>
    <div class="section">
        <h4>Location & Pricing</h4>
          <form>
        <label for="1">city </label>
        <input type="text" placeholder="📍  e.g., New York"> 
        <label for="2">Monthly rent ($)  </label>
        <input type="number" placeholder="2500"> <br>
        <label>Full Address </label>
        <input type="text" placeholder="📍 123 Main Street, Downtown">
        <label>floor: </label>
        <input type="number" placeholder="7">
        </form>
    </div>
    <div class="section">
        <h4>Property Details</h4>
          <form>
        <label for="1"> Bedrooms</label>
        <input type="number" placeholder="2"> 
        <label for="2">Bathrooms </label>
        <input type="number" placeholder="2"> <br>
        <label>Area (sqft)  </label>
        <input type="number" placeholder="1400">
      </form>
    </div>
    <div class="section">
        <h4>Property image</h4>
          <form>
            <label for="Upload Images (max 5)">
                <button class="upload-icon">&#8679</button>
                <div class="upload-text">click to upload images(0/5)</div>
                <div class="upload-subtext">JPG,PNG Or WebP</div>
            </label>
        <input type="image" placeholder="click to upload image (1/5)" src="" alt=""> 
          </form>
       <div class="buttons-row">
       <button class="btn new-btn"> Create new property</button>
       <button class="btn cancel-btn">Cancel</button>
          </div>
        </body>
      </html>