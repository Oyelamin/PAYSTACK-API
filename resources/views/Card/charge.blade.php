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
        border-radius:0px;
        box-shadow:none;
        border-bottom:1px solid skyblue;
        border-right:1px solid skyblue;
        border-left: 1px solid skyblue;
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
    <br><br><br><br>
    <br><br><br>
    <h1 style="margin:auto;text-align:center;font-size:30px;border:2px solid skyblue;width:50%;color:silver;">PAYSTACK - Charge Card</h1>
    <div class="box">
        <h1>PAY!</h1>
        <hr>
        <div>
            @extends('Layouts.validations')
        </div>
        @if(count($card) > 0)
        
        <form action="/transaction/chargecard" method="POST">
            @csrf
            {{-- @foreach($cards as $card) --}}
            
            <input type="hidden" name="email" value="{{$card['email']}}">
            <input type="hidden" name="card_number" value="{{$card['card_number']}}">
            <input type="hidden" name="cvv" value="{{$card['cvv']}}">
            <input type="hidden" name="expiry_month" value="{{$card['exp_month']}}">
            <input type="hidden" name="expiry_year" value="{{$card['exp_year']}}">
            <input type="hidden" name="auth_code" value="{{$card['authorization_code']}}">
            <label for="" class="label">Amount</label>
            <input type="number" class="input" name="amount" placeholder="Amount (#)">
            <div class="row">
                <div>
                    <label for="" class="label">Account Number</label>
                    <input type="number" class="input" name="account_number" placeholder="Account No.">
                </div>
                <div>
                    <label for="" class="label">Select Code</label>
                    <div class="select">
                        <select name="code" id="">
                            @if(count($codes) > 0)
                                @foreach($codes as $code)
                                    <option value="{{$code->bank_code}}">{{$code->name}}({{$code->bank_code}})</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            {{-- @endforeach --}}
            <br><br>
            <button class="button"> PAY! </button>
        </form>
        
        @endif
    </div>
    <script>
        $(document).ready(function(){
            alert("PLease Fill Required Fields");
        });
    </script>
</body>
</html>