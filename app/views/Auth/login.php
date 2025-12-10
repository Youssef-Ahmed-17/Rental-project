<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
 * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    height: 100vh;
    background: linear-gradient(180deg, #f4d5d9, #5d6473);
    display: flex;
    justify-content: center;
    align-items: center;
    animation: fadeIn 1.2s ease-in-out;
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

.logo {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    margin: 0 auto 15px;
    background: linear-gradient(135deg, #2f00ff, #6a00ff);
    animation: float 3s ease-in-out infinite;
}

.title {
    text-align: center;
    font-size: 26px;
    font-weight: 600;
}

.subtitle {
    text-align: center;
    margin-bottom: 25px;
    font-size: 14px;
    opacity: 0.8;
}

label {
    font-size: 14px;
    margin-top: 10px;
    display: block;
    color: #222;
    font-weight: 500;
}

input {
    width: 100%;
    padding: 12px;
    margin-top: 4px;
    border-radius: 12px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.8);
    font-size: 14px;
    transition: 0.3s;
}

input:focus {
    box-shadow: 0 0 0 2px #6a00ff;
}

.login-btn {
    width: 100%;
    margin-top: 20px;
    padding: 12px;
    background: linear-gradient(90deg, #3c00ff, #7900ff);
    color: white;
    border: none;
    font-size: 16px;
    border-radius: 12px;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
}

.login-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(80,0,255,0.4);
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

.forgot {
    display: block;
    margin-top: 8px;
    color: #3c00ff;
    text-align: right;
    font-size: 13px;
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
    <div class="container">
        <div class="logo"></div>
        <h1 class="title">RentHub</h1>
        <p class="subtitle">Find your perfect home</p>

        <div class="card">
            <h2 class="welcome">Welcome</h2>
            <p class="desc">Sign in to your account or create a new one</p>

            <div class="tabs">
                <button class="tab active">Login</button>
                <a class="tab" href="?url=AuthController/register">Register</a>
            </div>
   
            <form method="POST" action="?url=AuthController/login">

                <?php if(!empty($error)): ?>
                    <div class="error">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>

                <a href="#" class="forgot">Forgot your password?</a>

                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>