<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/bulma.css')}}">
</head>
<style>
    .box{
        width:50%;
        margin:auto;
    }
    h1{
        font-size:20px;
        font-weight:bolder;
    }
    .row{
        display:grid;
        grid-template-columns: auto auto;
        grid-gap:30px;
    }
    .form{
        display:grid;
        grid-template-columns: auto auto;
        grid-gap:10px;
    }
</style>
<body>
    <br><br><br>
    <div class="box">
        <h1>PAY!</h1>
        <hr>
        <div>
            @extends('Layouts.validations')
        </div>
        <form action="/transaction/addcard" method="post">
            @csrf
            <label for="" class="label">Name</label>
            <input type="text" class="input" name="name" placeholder="Your Name "><br>
            <label for="" class="label">Email</label>
            <input type="text" class="input" name="email" placeholder="Your Email Address"><br>
            <div class="row">
                <div>
                    <label for="" class="label">Account Number</label>
                    <input type="number" class="input" name="account_number" placeholder="Your Account Number">
                </div>
                <div>
                    <label for="" class="label">Card Number</label>
                    <input type="number" class="input" name="card_number" placeholder="Your Card Number">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="form">
                    <div class="month">
                        <label for="" class="label">Card Exp Month</label>
                        <input type="number" class="input" name="exp_month">
                    </div>
                    <div class="year">
                        <label for="" class="label">Card Exp Year</label>
                        <input type="number" class="input" name="exp_year">
                    </div>
                    
                </div>
                <div class="form">
                    <label for="" class="label">CVV</label><br>
                    <input style="margin-top:-15px;" type="number" class="input" name="cvv">
                </div>
                 
            </div>
            <br><br>
            <button class="button"> PAY! </button>
        </form>
    </div>
</body>
</html>