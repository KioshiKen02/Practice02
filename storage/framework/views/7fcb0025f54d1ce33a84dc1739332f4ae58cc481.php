<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        /* Reset Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            margin: 0;
        }

        .auth-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 40px 60px 40px 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateY(10px);
            animation: fadeIn 0.5s ease-in-out forwards;
        }

        @keyframes  fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            color: #a83232;
            font-size: 28px;
            margin-bottom: 20px;
            transition: color 0.3s;
        }

        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .input-group {
            text-align: left;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        label {
            display: block;
            font-weight: bold;
            color: #a83232;
            font-size: 16px;
            margin-bottom: 8px;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #fefefe;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="email"]:focus {
            border-color: #a83232;
            outline: none;
            box-shadow: 0 0 8px rgba(168, 50, 50, 0.3);
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
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #b84242;
        }

        button:active {
            transform: scale(0.98);
        }

        .back-button {
            background-color: #ddd;
            color: #555;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #ccc;
        }

        .message, .error-message {
            margin-top: 20px;
            font-size: 14px;
            color: #a83232;
            font-weight: bold;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .message.show, .error-message.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <h2>Forgot Password</h2>
        <p>If you’ve forgotten your password, enter your email below to receive a reset link.</p>

        <form method="POST" action="<?php echo e(route('password.email')); ?>">
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" required autofocus placeholder="example@domain.com"/>
                <div id="emailError" class="error-message">Please enter a valid email address.</div>
            </div>

            <button type="submit">Send Reset Link</button>
        </form>

        <button class="back-button" onclick="window.location.href='<?php echo e(route('login')); ?>'">Back to Login</button>

        <div id="statusMessage" class="message">
            <?php if(session('status')): ?>
                <div class="message show">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->has('email')): ?>
                <div class="error-message show"><?php echo e($errors->first('email')); ?></div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\Practice02\resources\views\auth\forgot-password.blade.php ENDPATH**/ ?>