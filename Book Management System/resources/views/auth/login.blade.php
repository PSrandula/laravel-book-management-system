@extends('layouts.app')

@section('content')
<h2 style="text-align:center; color:#333;">Welcome Back, Please Login</h2>

@if ($errors->any())
    <div style="background:#f8d7da; color:#842029; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <ul style="margin:0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login') }}" style="max-width: 400px; margin: auto; background:#f9f9f9; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    @csrf
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
    <input type="password" name="password" placeholder="Password" required style="width:100%; padding:10px; margin-bottom:25px; border:1px solid #ccc; border-radius:5px;">

    <button type="submit" style="width:100%; padding: 12px; background-color: #2196F3; color:white; border:none; border-radius:5px; font-size:16px;">Login</button>
</form>

<p style="text-align:center; margin-top:15px;">
    <a href="{{ route('password.request') }}" style="color:#2196F3; font-weight:bold; display:block; margin-bottom:10px;">Forgot Password?</a>
    Don't have an account? <a href="{{ route('register') }}" style="color:#4CAF50; font-weight:bold;">Register here</a>
</p>
@endsection
