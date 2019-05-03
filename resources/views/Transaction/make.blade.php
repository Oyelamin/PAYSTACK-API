<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/transaction/pay" method="post">
        @csrf
        Email
        <input type="text" name="email"><br>
        Amount
        <input type="number" name="amount">
        <button>Pay!</button>
    </form>
</body>
</html>