@extends('admin.layouts.app')

@section('title', 'Admin Login')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #e0e7ff 0%, #f1f5f9 100%);
    }
    .main-content {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
    }
    .login-container {
        width: 100%;
        max-width: 420px;
    }
    .login-card {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05), 0 5px 15px rgba(0,0,0,0.03);
        overflow: hidden;
    }
    .login-header {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        padding: 35px 20px;
        text-align: center;
        color: white;
    }
    .login-header .logo-icon {
        background: rgba(255, 255, 255, 0.2);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 15px;
        backdrop-filter: blur(5px);
    }
    .login-header h3 {
        margin: 0;
        font-weight: 700;
        font-size: 24px;
        letter-spacing: 0.5px;
    }
    .login-header p {
        margin: 8px 0 0;
        opacity: 0.9;
        font-size: 14px;
    }
    .login-body {
        padding: 40px 30px;
    }
    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 14px 15px;
        font-size: 15px;
        transition: all 0.2s;
        background-color: #f8fafc;
    }
    .form-control:focus {
        border-color: #3b82f6;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }
    .form-label {
        font-weight: 600;
        color: #475569;
        font-size: 14px;
        margin-bottom: 8px;
    }
    .btn-login {
        background: #2563eb;
        border: none;
        border-radius: 10px;
        padding: 14px;
        font-weight: 600;
        font-size: 16px;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .btn-login:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(37, 99, 235, 0.25);
    }
    .icon-input {
        position: relative;
    }
    .icon-input i {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 16px;
        color: #64748b;
        font-size: 18px;
    }
    .icon-input .form-control {
        padding-left: 48px;
    }
    .copyright {
        text-align: center;
        margin-top: 25px;
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="logo-icon">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h3>Admin Portal</h3>
            <p>Sign in to manage your store</p>
        </div>
        <div class="login-body">
            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="icon-input">
                        <i class="bi bi-envelope"></i>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@example.com">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="icon-input">
                        <i class="bi bi-key"></i>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="••••••••">
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label text-secondary fw-medium" for="remember" style="font-size: 14px;">Remember me</label>
                    </div>
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-login">
                        Sign In <i class="bi bi-arrow-right-short ms-1 fs-5 align-middle"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="copyright">
        &copy; {{ date('Y') }} Crowns IT. All rights reserved.
    </div>
</div>
@endsection
