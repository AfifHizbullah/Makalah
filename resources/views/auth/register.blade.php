<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 1s ease-in;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0; /* Awal transparan */
            transform: translateY(30px); /* Awal bergeser ke bawah */
            animation: slideIn 0.5s forwards; /* Menggunakan animasi slideIn */
        }

        @keyframes slideIn {
            to {
                opacity: 1; /* Menjadi terlihat */
                transform: translateY(0); /* Kembali ke posisi normal */
            }
        }

        .card-header {
            background-color: #6f42c1; /* Warna ungu */
            color: white;
            text-align: center;
        }

        .btn-primary {
            width: 100%;
            background-color: #6f42c1; /* Warna ungu */
            border-color: #6f42c1;   /* Warna ungu */
            transition: background-color 0.3s, border-color 0.3s, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #5a32a3; /* Warna ungu yang lebih gelap saat hover */
            border-color: #5a32a3;   /* Warna ungu yang lebih gelap saat hover */
            transform: scale(1.05); /* Efek pembesaran saat hover */
        }

        .form-group label {
            font-weight: bold;
        }

        .alert {
            margin-top: 10px;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Nama:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Konfirmasi Password:</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </form>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer login-link">
                        <p>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
