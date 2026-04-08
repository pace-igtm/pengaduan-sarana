<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Aplikasi Pengaduan Sekolah</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet"> 
    <style> 
        body { background-color: #f8f9fa; } 
        .card { box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: none; } 
    </style> 
</head> 
<body> 
 
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4"> 
        <div class="container"> 
            <a class="navbar-brand" href="#">Pengaduan Sekolah</a> 
            @auth('siswa') 
                <span class="navbar-text text-white">Halo, Siswa ({{ Auth::guard('siswa')->user()->nis 
}})</span> 
                <a href="{{ route('logout') }}" class="btn btn-sm btn-danger ms-3">Logout</a> 
            @endauth 
            @auth('admin') 
 
                <span class="navbar-text text-white">Halo, Admin ({{ Auth::guard('admin')->user()
>username }})</span> 
                <a href="{{ route('logout') }}" class="btn btn-sm btn-danger ms-3">Logout</a> 
            @endauth 
        </div> 
    </nav> 
 
    <div class="container"> 
        @if(session('success')) 
            <div class="alert alert-success">{{ session('success') }}</div> 
        @endif 
        @if(session('error')) 
            <div class="alert alert-danger">{{ session('error') }}</div> 
        @endif 
 
        @yield('content') 
    </div> 
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body> 
</html>