<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .signup-form {
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
        input,
        select {
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
        }
        .signup-button {
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
            align-self: flex-start;
        }
        .signup-button:hover {
            background-color: #0056b3;
        }
        .signup-button:active {
            transform: translateY(1px);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="signup-form">
            <div class="logo">Logo</div>
            <h2>Sign Up</h2>
            <form action="includes/signup.inc.php" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                
                <label for="phone_number">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number">
                
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="employee">Employee</option>
                </select>
                
                <button type="submit" name="submit" class="signup-button">Sign Up</button>
            </form>
            
            <div class="footer">
                <div>
                    <a href="#">Privacy Policy</a> | <a href="#">Terms and Conditions</a>
                </div>
                <div>© 2022 Your Website. All rights reserved.</div>
            </div>
        </div>
        <div class="image-placeholder"></div>
    </div>
</body>
</html>