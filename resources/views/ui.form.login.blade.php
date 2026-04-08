<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Login - Pengaduan Sekolah</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet"> 
</head> 
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;"> 
 
    <div class="card p-4" style="width: 400px;"> 
        <h3 class="text-center mb-4">Login Pengaduan</h3> 
         
        @if(session('error')) 
            <div class="alert alert-danger">{{ session('error') }}</div> 
        @endif 
 
        <form action="{{ route('login') }}" method="POST"> 
            @csrf 
            <div class="mb-3"> 
                <label class="form-label">Username / NIS</label> 
                <input type="text" name="username" class="form-control" placeholder="Masukkan Username 
Admin atau NIS Siswa" required> 
            </div> 
            <div class="mb-3"> 
                <label class="form-label">Password</label> 
                <input type="password" name="password" class="form-control" required> 
            </div> 
            <button type="submit" class="btn btn-primary w-100">Masuk</button> 
        </form> 
    </div> 
 
</body> 
</html>