<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class=" bg-[#bebebe]">
    <div class=" container mx-auto bg-red-300">
        <h1 class="">Password Reset</h1>

        <h4>Hello, We have received your request to reset your account password</h4>

        <p>You can use the following code to recover your account</p>

        <h1 class=" text-2xl text-red-300">{{ $code }}</h1>
        <br>
        <p> Click the link below to reset your password.</p>
        <a href="">Click Here to reset your Password</a>

        <p>If you did not request a password reset, you can safely ignore this email.</p>
    </div>
</body>

</html>
