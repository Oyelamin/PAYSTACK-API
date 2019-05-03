@if (count($errors) > 0)
    <div style="border-radius:0px;" class="animated bounceInDown notification is-danger">
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    </div><br><br>
   
@endif

@if (session('success'))
    <div style="border-radius:0px;" class="notification is-success">
        <div>{{session('success')}}</div>
    </div><br><br>

    
@endif

@if (session('error'))
    <div style="border-radius:0px;" class="box notification is-danger">
        <div>{{session('error')}}</div>
    </div>
    <br><br>

    
@endif
