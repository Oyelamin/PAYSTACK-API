<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAYSTACK</title>
    <link rel="stylesheet" href="{{asset('css/bulma.css')}}">
    <style>
        .box{
            width:50%;
            margin:auto;
            margin-top:30px;
        }
    </style>
</head>
<body>
    <div class="box">
       <h1 class="h1">PIN (You are paying N{{$amount}})</h1><hr>
        <form action="/transaction/pin" method="POST">
            @csrf
            <input type="hidden" name="reference" value="{{$reference}}">
            <label for="" class="label">Please Type your Pin</label>
            <input type="number" class="input" name="pin"><br>
            <label for="" class="label">Please Enter your OTP Digits</label>
            <input type="number" class="input" name="otp"><br>
            <button class="button">PAY!</button>
        </form>
    </div> 
</body>
</html>