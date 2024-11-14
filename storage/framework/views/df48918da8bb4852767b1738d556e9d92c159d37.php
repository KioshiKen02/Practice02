<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* Reset Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: gray;
            color: #333;
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            width: 80%; 
            max-width: 1200px; 
            height: 80vh; 
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes  fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .image-side {
            flex: 2; 
            background-image: url('/photo/BG1.gif'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            height: 100%;
        }

        .form-side {
            flex: 1; 
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            border-radius: 12px;
            opacity: 0;
            animation: fadeInForm 0.6s ease-out 0.3s forwards;
        }

        @keyframes  fadeInForm {
            to {
                opacity: 1;
            }
        }

        h2 {
            color: #a83232;
            margin-bottom: 40px;
            font-size: 28px;
        }

        label {
            display: flex;
            margin-bottom: 20px;
            margin-left: 90px;
            font-weight: bold;
            color: #a83232;
            font-size: 16px;
        }

        input[type="email"], input[type="password"] {
            width: 50%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #fefefe;
            transition: border-color 0.3s, transform 0.3s ease;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #a83232;
            outline: none;
            transform: scale(1.05);
        }

        button {
            display: block;
            width: 50%;
            background-color: #a83232;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: center;
            margin-left: 95px;
            transition: background-color 0.3s, transform 0.1s;
        }

        button:hover {
            background-color: #b84242;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(0.98);
        }

        p {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
            margin-left: 12px;
        }

        a {
            color: #a83232;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Forgot password link styling */
        .forgot-password {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
            opacity: 0;
            animation: fadeInLink 0.6s ease-out 0.6s forwards;
        }

        @keyframes  fadeInLink {
            to {
                opacity: 1;
            }
        }

        .forgot-password a {
            color: #a83232;
            text-decoration: none;
            margin-left: 13px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="image-side"></div>

        <div class="form-side">
            <h2>Login to Your Account</h2>
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required autofocus>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <!-- Wrap button in a container to center it -->
                <div class="button-container">
                    <button type="submit">Log In</button>
                </div>

                <!-- Forgot password link -->
                <div class="forgot-password">
                    <?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>">Forgot your password?</a>
                    <?php endif; ?>
                </div>
            </form>
            <p>Don't have an account? <a href="<?php echo e(route('register')); ?>">Register here</a></p>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\Practice02\resources\views/auth/login.blade.php ENDPATH**/ ?>