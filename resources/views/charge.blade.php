<form action="charge/storage" method="POST">
    @csrf
    <label for="">Email</label>
    <input type="text" name="email">
    <br>
    <label for="">Amount</label>
    <input type="number" name="amount">
    <label for="">Account Number</label>
    <input type="text" name="account_number">
    <br>
    <label for="">Card Number</label>
    <input type="text" name="number"><br>
    <label for="">cvv</label>
    <input type="text" name="cvv" id="">
    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
    <br>
    <label for="">expiry_month</label>
    <input type="text" name="expiry_month">
    <label for="">expiry_year</label>
    <input type="text" name="expiry_year" id="">
    <label for="">code</label>
    <input type="text" name="code">
    <input type="submit" value="submit">
</form>