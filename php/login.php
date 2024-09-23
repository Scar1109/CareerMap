<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            width: 80%;
            max-width: 1000px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form {
            flex: 1;
            padding: 2rem;
        }

        .image-placeholder {
            flex: 1;
            background-color: #e0e0e0;
        }

        .logo {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            text-decoration: underline;
        }

        h2 {
            margin-bottom: 1rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="password"] {
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .remember-me input {
            margin-right: 0.5rem;
        }

        .forgot-password {
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .login-button {
            padding: 0.5rem 1rem;
            background-color: #f0f0f0;
            color: black;
            border: 1px solid #ccc;
            cursor: pointer;
            align-self: flex-start;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            font-size: 0.8rem;
        }

        .login-button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        .login-button:active {
            transform: translateY(1px);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .register-link {
            margin-top: 1rem;
            font-size: 0.9rem;
            text-align: center;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .logo {
            height: 40px;
            width: 160px;
            display: block;
            margin-top: 15px;
            float: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-form">
            <h2>Login</h2>
            
            <form action="includes/login.inc.php" method="POST">
            <img class="logo" src="../images/logo_Main.png" alt="logo">

                <label for="username">Email/Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember Me</label>
                </div>

                <div class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" name="submit" class="login-button">Login</button>
            </form>

            <div class="register-link">
                Don't have an account? <a href="signup.php">Register</a>
            </div>

            <div class="footer">
                <div>
                    <a href="#">Privacy Policy</a> | <a href="#">Terms and Conditions</a>
                </div>
                <div>© 2024 Your Website. All rights reserved.</div>
            </div>
        </div>
        <div class="image-placeholder"></div>
    </div>
</body>

</html>