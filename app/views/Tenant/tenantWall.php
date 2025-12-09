<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Wall</title>

    <style>

        body {
            margin: 25px;
            font-family: cursive;
        }

        .start {
            display: flex;
            justify-content: space-between;
        }

        .search {
            margin: auto;
            background-color: rgb(236, 234, 234);
            width: 95%;
            height: 30px;
            border-radius: 10px;
            padding-left: 10px;
            border: none;
        }

        .searchrow {
            display: flex;
            justify-content: space-between;
            padding-right: 10px;
        }

        .filter {
            font-size: 20px;
        }

        .propertiesrow {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .row {
            display: flex;
            justify-content: space-around;
        }

        .card {
            height: 400px;
            width: 400px;
            border: rgb(187, 185, 185) 1px solid;
            border-radius: 10px;
            margin: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 10px;
        }

        .card:hover {
            transform: scale(1.05);
            transition: 0.2s;
        }

        img {
            width: 400px;
            height: 200px;
            border-radius: 10px 10px 0 0;
        }

        .description {
            display: flex;
            justify-content: space-around;
        }

        .description2 {
            padding-left: 20px;
            color: grey;
        }

        .price {
            color: rgb(64, 64, 207);
        }

        /* زرارين جنب بعض */
        .card-buttons {
            display: flex;
            gap: 12px;
            margin-top: 16px;
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

        .detalis-btn {
            background: #418beb;
        }

        .apply-btn {
            background: #2b9446;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 8px 0;
            border-top: 1px solid #ddd;
        }

        .nav-item {
            text-decoration: none;
            color: #080808;
            font-size: 14px;
        }

    </style>

</head>
<body>

<div class="start">
    <p> Welcome, Youssef Ahmed </p>
    <p> ⚙ </p>
</div>

<div class="searchrow">
    <input class="search" type="text" placeholder="search properties ,Location">
    <p class="filter">ᯤ</p>
</div>

<div class="propertiesrow">
    <p> All properties </p>
    <p> 6 properties </p>
</div>

<!-- Row 1 -->
<div class="row">

    <div class="card">
        <img src="pic_1.jpg">
        <div class="description">
            <p>Modern Downtown Appartment</p>
            <p class="price">$2500/mo</p>
        </div>
        <div class="description2">
            <p>⚲ New York</p>
            <p>🛏2 🛁2 ◻1200 sqft</p>
            <p>👁245 views</p>
        </div>

        <div class="card-buttons">
            <a class="btn-small detalis-btn" href="propertyDetails.php">Details</a>
            <a class="btn-small apply-btn" href="propertyApply.php">Apply</a>
        </div>
    </div>

    <div class="card">
        <img src="pic_2.jpg">
        <div class="description">
            <p>Luxury Villa with Pool</p>
            <p class="price">$5500/mo</p>
        </div>
        <div class="description2">
            <p>⚲ Los Angeles</p>
            <p>🛏4 🛁3 ◻3200 sqft</p>
            <p>👁389 views</p>
        </div>

        <div class="card-buttons">
            <a class="btn-small detalis-btn" href="propertyDetails.php">Details</a>
            <a class="btn-small apply-btn" href="propertyApply.php">Apply</a>
        </div>
    </div>

    <div class="card">
        <img src="pic_3.jpg">
        <div class="description">
            <p>Cozy Studio in Brooklyn</p>
            <p class="price">$1800/mo</p>
        </div>
        <div class="description2">
            <p>⚲ New York</p>
            <p>🛏1 🛁1 ◻500 sqft</p>
            <p>👁156 views</p>
        </div>

        <div class="card-buttons">
            <a class="btn-small detalis-btn" href="propertyDetails.php">Details</a>
            <a class="btn-small apply-btn" href="propertyApply.php">Apply</a>
        </div>
    </div>

</div>

<!-- Row 2 -->
<div class="row">

    <div class="card">
        <img src="pic_4.jpg">
        <div class="description">
            <p>Penthouse with City Views</p>
            <p class="price">$7500/mo</p>
        </div>
        <div class="description2">
            <p>⚲ New York</p>
            <p>🛏3 🛁3 ◻2500 sqft</p>
            <p>👁512 views</p>
        </div>

        <div class="card-buttons">
            <a class="btn-small detalis-btn" href="propertyDetails.php">Details</a>
            <a class="btn-small apply-btn" href="propertyApply.php">Apply</a>
        </div>
    </div>

    <div class="card">
        <img src="pic_5.jpg">
        <div class="description">
            <p>Suburban Family Home</p>
            <p class="price">$3200/mo</p>
        </div>
        <div class="description2">
            <p>⚲ Chicago</p>
            <p>🛏3 🛁2 ◻1800 sqft</p>
            <p>👁198 views</p>
        </div>

        <div class="card-buttons">
            <a class="btn-small detalis-btn" href="propertyDetails.php">Details</a>
            <a class="btn-small apply-btn" href="propertyApply.php">Apply</a>
        </div>
    </div>

    <div class="card">
        <img src="pic_6.jpg">
        <div class="description">
            <p>Luxury Villa with Pool</p>
            <p class="price">$5000/mo</p>
        </div>
        <div class="description2">
            <p>⚲ California</p>
            <p>🛏4 🛁3 ◻3000 sqft</p>
            <p>👁980 views</p>
        </div>

        <div class="card-buttons">
            <a class="btn-small detalis-btn" href="propertyDetails.php">Details</a>
            <a class="btn-small apply-btn" href="propertyApply.php">Apply</a>
        </div>
    </div>

<nav class="bottom-nav">
    <a href="tenantWall.php" class="nav-item">🏠 Home</a>
    <a href="savedProperties.php" class="nav-item">⛉ Saved</a>
    <a href="tenantNotifications.php" class="nav-item">🕭 Notifications</a>
</nav>

</body>
</html>