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
    <body style="height:100vh; display: flex; justify-content: center; align-items: center;">
        {{-- @if($session->error)
            <p>{{ $session->error }}</p>
        @endif --}}
        <form method="POST" action="{{ route('user.register') }}" style="display: flex; flex-direction: column; align-items: center;">
            @csrf
            <input type="text" name="fullname" placeholder="Enter fullname"/>
            <input type="text" name="email" placeholder="Enter email"/>
            <input type="password" name="password" placeholder="Enter password" />
            <button type="submit">Register</button>
        </form>
    </body>
</html>
