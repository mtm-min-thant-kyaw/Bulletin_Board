<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>
    <style>
        * {
            box-sizing: border-box;
        }

        p {
            font-size: 30px;
            font-weight: 400;
            font-family: "IBM Plex Sans", sans-serif;
        }

        .button {
            display: inline-block;
            background-color: #00ba4a;
            color: white;
            border: none;
            padding: 15px 32px;
            text-align: center;
            font-size: 16px;
            margin: 4px 2px;
            border-radius: 10px;

        }

        .button:hover {
            background-color: #733b00;
        }
    </style>
</head>

<body>
    <p>Welcome {{ $user->name }}!</p>
    <p>Your username is {{ $user->name }}. Click the button below to reset your password:</p>
    <a href="{{ route('password.reset.form', $token) }}" class="button">Reset Password</a>
    <p>Thanks a lot.</p>
</body>

</html>
