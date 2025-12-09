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
        transform: scale(1.02);
        transition: 0.25s ease;
        }

        .details-grid div:hover {
         transform: scale(1.05);
        transition: 0.25s ease;
        }


        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            row-gap: 12px;
            margin-top: 10px;
        }

        .details-grid div {
            background: #eef2ff;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
        }

        .amenities {
            margin-top: 10px;
        }

        .amenities li {
            margin-bottom: 6px;
        }
        .request-btn {
            width: 100%;
            padding: 14px;
            background: #4e63ff;
            border: none;
            color: white;
            font-size: 17px;
            border-radius: 10px;
            margin-top: 20px;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .request-btn:hover {
            background: #3c4fdd;
            transform: scale(1.02);
        }

    </style>
</head>

<body>

    <div class="container">

        <h2>🏠 Property Details</h2>
        <div class="slider-container">
            <div class="slides" id="slides">
                <img src="" alt="Sort bet saif">
                <img src="" alt="Sort bet saif">
                <img src="" alt="Sort bet saif">
            </div>

            <div class="arrow left" onclick="moveSlide(-1)">&#10094;</div>
            <div class="arrow right" onclick="moveSlide(1)">&#10095;</div>
        </div>

        <div class="card">
            <h3>Modern 2-Bedroom Apartment</h3>
            <p>📍 Nasr City, Cairo</p>
            <p><strong>Price:</strong> 12,800 EGP / month</p>

            <div class="details-grid">
                <div>🏢 5th Floor</div>
                <div>🛏 3 Bedrooms</div>
                <div>🛁 1 Bathroom</div>
                <div>📏 118 m²</div>
                
            </div>
        </div>

        <div class="card">
            <h3>Description</h3>
            <p>
                A modern apartment located in a quiet and safe area in Nasr City. 
                Close to main services and suitable for families and students.
            </p>
        </div>

        <div class="card">
            <h3>Amenities</h3>
            <ul class="amenities">
                <li>✔ Elevator</li>
                <li>✔ Security</li>
                <li>✔ Parking</li>
                <li>✔ Furnished</li>
            </ul>
        </div>

        <button class="request-btn">Send Request</button>

    </div>


    <script>
        let index = 0;

        function moveSlide(direction) {
            const slides = document.getElementById("slides");
            const total = slides.children.length;

            index = index + direction;

            if (index < 0) index = total - 1;
            if (index > total - 1) index = 0;

            slides.style.transform = translateX(-${index * 100}%);
        }
    </script>

</body>
</html>