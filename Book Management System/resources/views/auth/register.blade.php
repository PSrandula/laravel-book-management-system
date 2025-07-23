@extends('layouts.app')

@section('content')
<h2 style="text-align:center; color:#333;">Create Your Account</h2>

@if ($errors->any())
    <div style="background:#f8d7da; color:#842029; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <ul style="margin:0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}" style="max-width: 400px; margin: auto; background:#f9f9f9; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    @csrf
    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
    <input type="password" name="password" placeholder="Password" required style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required style="width:100%; padding:10px; margin-bottom:25px; border:1px solid #ccc; border-radius:5px;">

    <button type="submit" style="width:100%; padding: 12px; background-color: #4CAF50; color:white; border:none; border-radius:5px; font-size:16px;">Register</button>
</form>

<p style="text-align:center; margin-top:20px;">Already have an account? <a href="{{ route('login') }}" style="color:#4CAF50; font-weight:bold;">Login here</a></p>
@endsection
