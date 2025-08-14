<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>

    </style>

</head>

<body
    style="height:100vh; display: flex; justify-content: center; align-items: center; background-color: #f0efef; border-radius: 20px;">
    {{-- @if (session('error'))
            <p>{{ session('error' }}</p>
        @endif --}}
    <form method="POST" action="{{ route('user.register') }}"
        style="display: flex; flex-direction: column; align-items: center; background-color: white; width: 50%;">
        @csrf
        <div style="margin-bottom: 1rem; display:flex; flex-direction: column;">
            <label>Fullname</label>
            <input type="text" name="fullname" placeholder="Enter fullname" />
        </div>
        <div style="margin-bottom: 1rem; display:flex; flex-direction: column;">
            <label>Email</label>
            <input type="text" name="email" placeholder="Enter email" />
        </div>
        <div style="margin-bottom: 1rem; display:flex; flex-direction: column;">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" />
        </div>
        <button type="submit">Register</button>
    </form>
</body>

</html>
