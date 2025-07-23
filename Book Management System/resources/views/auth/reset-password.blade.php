@extends('layouts.app')

@section('content')
<h2 style="text-align:center;">Reset Password</h2>

@if ($errors->any())
    <div style="color:red; margin-bottom: 20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('password.update') }}" style="max-width:400px; margin:auto;">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required style="width:100%; padding:10px; margin-bottom:15px;">
    <input type="password" name="password" placeholder="New Password" required style="width:100%; padding:10px; margin-bottom:15px;">
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required style="width:100%; padding:10px; margin-bottom:25px;">

    <button type="submit" style="width:100%; padding:10px; background-color:#2196F3; color:#fff; border:none; border-radius:5px;">Reset Password</button>
</form>
@endsection
