<!DOCTYPE html>
<html>
<head>
    <title>Interview</title>
</head>
<body>
    <!-- @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif -->

    <form method="POST" action="{{ route('user.store') }}">
        @csrf
        <label for="fullname">Fullname:</label>
        <input type="text" id="fullname" name="fullname" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
