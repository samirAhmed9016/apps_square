<!DOCTYPE html>
<html>

<head>
    <title>Password Reset Code</title>
</head>

<body>
    <h2>Hello,</h2>
    <p>You have requested to reset your password. Use the following code to proceed:</p>

    <h3 style="color: #333; padding: 10px; background-color: #f3f3f3; display: inline-block;">
        {{ $resetCode }}
    </h3>

    <p>This code is valid for 10 minutes.</p>
    <p>If you did not request a password reset, please ignore this email.</p>

    <br>
    <p>Thank you,</p>
    <p><strong>{{ config('app.name') }}</strong></p>
</body>

</html>
