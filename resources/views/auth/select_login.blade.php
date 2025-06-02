@extends('layouts.app')

@section('title', 'Login Akses')
<link rel="stylesheet" href="{{ asset('css/instruktur.css') }}">
@section('content')
<style>
    body {
        background: linear-gradient(to bottom, #fdb049 50%, #4dd7ee 50%);
        height: 100vh;
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
        background-color: white;
        border-radius: 24px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        padding: 60px 50px;
        max-width: 650px;
        margin: auto;
        text-align: center;
    }

    

    .login-card h2 {
        font-weight: bold;
        margin-bottom: 30px;
    }

    .login-btn {
        width: 180px;
        height: 60px;
        font-size: 1.25rem;
        font-weight: bold;
        border-radius: 12px;
        border: none;
        margin: 0 10px;
        transition: transform 0.2s ease-in-out;
    }

    .login-btn:hover {
        transform: scale(1.05);
    }

    .btn-instruktur {
        background-color: #f9e47d;
        color: #333;
    }

    .btn-pelajar {
        background-color: #f56969;
        color: white;
    }

    .top-image {
        max-width: 220px;
        margin: auto;
        display: block;
        padding-bottom: 30px;
    }

    @media (max-width: 576px) {
        .login-btn {
            width: 100%;
            margin-bottom: 15px;
        }
    }
</style>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="text-center">
        <img src="{{ asset('images/login-illustration.png') }}" alt="Login Illustration" class="top-image">

        <div class="login-card" style="max-width: 720px; padding: 60px 50px;">
            <h2>Masuk Sebagai</h2>
            <div class="d-flex flex-wrap justify-content-center">
                <a href="{{ route('instruktur.login') }}">
                    <button class="login-btn btn-instruktur">Instruktur</button>
                </a>
                <a href="{{ route('student.login') }}">
                    <button class="login-btn btn-pelajar">Pelajar</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
