@extends('layouts.app')

@section('content')
<h2 style="text-align:center; color:#333;">Forgot Your Password?</h2>

@if(session('status'))
    <p style="background:#d1e7dd; color:#0f5132; padding:15px; border-radius:5px; max-width:400px; margin:20px auto;">
        {{ session('status') }}
    </p>
@endif

@if ($errors->any())
    <div style="background:#f8d7da; color:#842029; padding: 15px; border-radius: 5px; max-width:400px; margin: 20px auto;">
        <ul style="margin:0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}" style="max-width: 400px; margin: auto; background:#f9f9f9; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    @csrf
    <input type="email" name="email" placeholder="Your registered email" required style="width:100%; padding:10px; margin-bottom:25px; border:1px solid #ccc; border-radius:5px;">

    <button type="submit" style="width:100%; padding: 12px; background-color: #f39c12; color:white; border:none; border-radius:5px; font-size:16px;">Send Reset Link</button>
</form>

<p style="text-align:center; margin-top:20px;">
    <a href="{{ route('login') }}" style="color:#2196F3; font-weight:bold;">Back to login</a>
</p>
@endsection
