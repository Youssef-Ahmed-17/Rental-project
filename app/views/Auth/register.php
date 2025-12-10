<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
     * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(180deg, #f4d5d9, #5d6473);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo {
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, #3c00ff, #7900ff);
            border-radius: 18px;
            margin-top: 25px;
        }

        .title {
            font-size: 28px;
            margin-top: 10px;
        }

        .subtitle {
            margin-top: 5px;
            opacity: 0.7;
            margin-bottom: 25px;
        }

        .card {
            width: 380px;
            padding: 35px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }

        .tabs {
            display: flex;
            margin: 15px 0;
            background: #eaeaea;
            padding: 5px;
            border-radius: 40px;
        }

        .tab {
            flex: 1;
            padding: 10px;
            border: none;
            text-align: center;
            text-decoration: none;
            color: black;
            font-weight: 500;
            background: transparent;
            border-radius: 40px;
            cursor: pointer;
        }

        .tab.active {
            background: #3c00ff;
            color: white;
            transform: scale(1.05);
        }
        
        .tab:hover {
             background: #e0d4ff;
             border-radius: 40px;
             cursor: pointer;
        }

        .register-as {
            margin: 15px 0 5px;
            font-weight: 500;
        }

        .role-box {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .role {
            flex: 1;
            padding: 10px;
            border: none;
            background: #f1f1f1;
            border-radius: 12px;
            cursor: pointer;
        }

        .role.active {
            border: 2px solid #bbb;
            background: #fff;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
            outline: none;
        }

        .row {
            display: flex;
            gap: 10px;
        }

        .createbutton {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #3c00ff, #7900ff);
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 10px;
        }

        .error {
            background: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
 
    <div class="logo"></div>
    <h1 class="title">RentHub</h1>
    <p class="subtitle">Find your perfect home</p>

    <div class="card">
        <h2>Welcome</h2>
        <p>Sign in to your account or create a new one</p>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="error">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
        
        <!-- TABS -->
        <div class="tabs">
            <a href="?url=AuthController/login" class="tab">Login</a>
            <a href="?url=AuthController/register" class="tab active">Register</a>
        </div>
        
        <p class="register-as">Register as</p>

        <!-- ROLES -->
        <div class="role-box">
            <button type="button" class="role active" id="tenantBtn">👤 Tenant</button>
            <button type="button" class="role" id="landlordBtn">🏠 Landlord</button>
        </div>

        <!-- FORM -->
        <form action="?url=AuthController/store" method="POST">

            <input type="hidden" name="role" id="roleInput" value="tenant">
            <input type="text" name="name" placeholder="Enter your full name" required>
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="Create a password" required>

            <div class="row">
                <input type="text" name="city" placeholder="City" required>
                <input type="text" name="phone" placeholder="Phone" required>
            </div>

            <input type="text" name="national_id" placeholder="Enter your national ID" required>

            <button type="submit" class="createbutton">Create Account</button>

        </form>

    </div>

    <!-- ROLE LOGIC -->
    <script>
        const tenantBtn = document.getElementById('tenantBtn');
        const landlordBtn = document.getElementById('landlordBtn');
        const roleInput = document.getElementById('roleInput');

        tenantBtn.addEventListener('click', () => {
            tenantBtn.classList.add('active');
            landlordBtn.classList.remove('active');
            roleInput.value = 'tenant';
        });

        landlordBtn.addEventListener('click', () => {
            landlordBtn.classList.add('active');
            tenantBtn.classList.remove('active');
            roleInput.value = 'landlord';
        });
    </script>

</body>
</html>