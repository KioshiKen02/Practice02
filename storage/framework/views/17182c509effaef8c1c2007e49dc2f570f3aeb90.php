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
        }

        .auth-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateY(10px);
            animation: fadeIn 0.6s ease-in-out forwards;
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
        }

        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .input-group {
            text-align: left;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #a83232;
            font-size: 16px;
            margin-bottom: 8px;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #fefefe;
            transition: all 0.3s ease-in-out;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #a83232;
            outline: none;
            box-shadow: 0 0 8px rgba(168, 50, 50, 0.3);
            transform: scale(1.02);
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
            margin-top: 10px;
        }

        button:hover {
            background-color: #b84242;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(0.98);
        }

        .message, .error-message {
            margin-top: 20px;
            font-size: 14px;
            color: #a83232;
            font-weight: bold;
        }

        /* Error message fade-in animation */
        .error-message {
            opacity: 0;
            transform: translateY(-10px);
            animation: fadeInMessage 0.5s ease-in-out forwards;
        }

        @keyframes  fadeInMessage {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <h2>Reset Your Password</h2>
        <p>Please enter your email and new password.</p>

        <!-- Blade Component for Validation Errors -->
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.auth-validation-errors','data' => ['class' => 'mb-4','errors' => $errors]]); ?>
<?php $component->withName('auth-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4','errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

        <form method="POST" action="<?php echo e(route('password.update')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="token" value="<?php echo e($request->route('token')); ?>">

            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" class="block mt-1 w-full" type="email" name="email" value="<?php echo e(old('email', $request->email)); ?>" required autofocus />
            </div>

            <div class="input-group mt-4">
                <label for="password">Password</label>
                <input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <div class="input-group mt-4">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <button type="submit">Reset Password</button>
        </form>

        <!-- Error Message -->
        <div class="error-message show">
            <?php if(session('error')): ?>
                <?php echo e(session('error')); ?>

            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\Practice02\resources\views\auth\reset-password.blade.php ENDPATH**/ ?>