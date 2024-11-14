<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
            margin-bottom: 30px;
            font-size: 28px;
        }

        label {
            display: flex;
            margin-bottom: 8px;
            font-weight: bold;
            color: #a83232;
            font-size: 14px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #fefefe;
            transition: border-color 0.3s, transform 0.3s ease;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
            border-color: #a83232;
            outline: none;
            transform: scale(1.05);
        }

        button {
            width: 100%;
            background-color: #a83232;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
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
        }

        a {
            color: #a83232;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="image-side"></div> 

        <div class="form-side">
            <h2>Create an Account</h2>
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required autofocus>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div>
                    <button type="submit">Sign Up</button>
                </div>
            </form>
            <p>Already have an account? <a href="<?php echo e(route('login')); ?>">Log in here</a></p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\Practice02\resources\views\auth\register.blade.php ENDPATH**/ ?>