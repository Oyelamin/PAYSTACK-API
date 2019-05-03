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
        <form action="/transaction/otp" method="post">
            @csrf
            <h1 class="h1">
                <b>
                    OTP
                </b>
            </h1>
            <hr>
            <label for="" class="label">Please ENTER Your OTP</label>
            <input type="number" name="otp" class="input">
            <input type="hidden" name="reference" value="{{$reference}}"><br><br>
            <button class="button">DONE!</button>
        </form>
    </div>
</body>
</html>