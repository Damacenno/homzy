<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <input type="email" name="email" required>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>

</html>