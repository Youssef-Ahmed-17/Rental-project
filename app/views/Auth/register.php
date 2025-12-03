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
    animation: slideUp 1s ease;
}

h2 {
    margin-bottom: 5px;
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
    background: transparent;
    border-radius: 40px;
    cursor: pointer;
}

.tab.active {
   background: #3c00ff;
    color: white;
    transform: scale(1.05);
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
    border: 2px solid #3c00ff;
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
    </style>
</head>
<body>

    <div class="logo"></div>
    <h1 class="title">RentHub</h1>
    <p class="subtitle">Find your perfect home</p>

    <div class="card">
        <h2>Welcome</h2>
        <p>Sign in to your account or create a new one</p>

        <div class="tabs">
            <button class="tab">Login</button>
            <button class="tab active">Register</button>
        </div>

        <p class="register-as">Register as</p>

        <div class="role-box">
            <button class="role active">👤 Tenant</button>
            <button class="role">🏠 Landlord</button>
        </div>

        <input type="text" placeholder="Enter your full name">
        <input type="email" placeholder="Enter your email">
        <input type="password" placeholder="Create a password">

        <div class="row">
            <input type="text" placeholder="City">
            <input type="text" placeholder="Phone">
        </div>

        <input type="text" placeholder="Enter your national ID">

        <button class="createbutton">Create Account</button>
    </div>

</body>
</html>