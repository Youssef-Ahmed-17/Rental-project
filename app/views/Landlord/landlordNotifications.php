<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Landlord Notifications</title>

    <style>  
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            padding: 20px;
            margin: 50px;
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

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .notification-card {
            background: white;
            padding: 18px;
            border-radius: 12px;
            margin-bottom: 15px;
            margin-right: 40px;

            box-shadow: 0 3px 10px rgba(0,0,0,0.09);
            display: flexbox;
            gap: 15px;
            align-items: center;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .notification-card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            cursor: pointer;
        }
        .icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #eef2ff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
        }

        .info h3 {
            margin: 0;
            font-size: 17px;
            font-weight: bold;
        }

        .info p {
            margin: 4px 0;
            color: black;
        }
    </style>

</head>
<body>
<a href="dashboard.php" class="back-icon">⬅ Back to dashboard</a>
    <h2>🔔Notifications</h2>

    <div class="notification-card">
        <div class="icon">💬</div>
        <div class="info">
            <h3>New Message</h3>
            <p>Ahmed Hossam sent a message : Is the property still available ?.</p>
            <p>Hesham Maged sent a message : Is the area of the property includes the balacony? </p>
        </div>
    </div>

    <div class="notification-card">
        <div class="icon">📄</div>
        <div class="info">
            <h3>Request</h3>
            <p>Khamees Gomaa sent you a request.</p>
        </div>
    </div>

    <div class="notification-card">
        <div class="icon">🏠</div>
        <div class="info">
            <h3>Listing Status</h3>
            <p>You have 1 property listed.</p>
        </div>
    </div>

</body>
</html>