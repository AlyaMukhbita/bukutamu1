<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login | Sistem Informasi Buku Tamu</title>

    <!-- Buat Favicon -->
    <link rel="icon" href="assets/img/kominfo.png" type="image/x-icon">
    <!-- Tambahkan CSS eksternal -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tambahkan CSS custom -->
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .btn-block {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <form action="{{ route('login_proses') }}" method="post">
            @csrf
            <h2 class="text-center">Selamat Datang!</h2><br>

            <!-- Input username -->
            <div class="form-group mb-4">
                <input type="text" name="username" class="form-control form-control-user" placeholder="Username" value="{{ old('username') }}">
                @error('username')
                <span style="color: crimson">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input password -->
            <div class="form-group mb-4">
                <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                @error('password')
                <span style="color: crimson">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol login -->
            <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
            <hr>

            <!-- Tanggal -->
            <hr>
            <div class="text-center">
                <a class="small">{{ date('d-m-Y') }}</a>
            </div>
        </form>
    </div>
</body>

</html>
