<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Poster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Font Awesome untuk ikon -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            color: #6a1b9a;
            margin-bottom: 30px;
            font-size: 2.2em;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group input[type="url"],
        .form-group button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="url"]:focus {
            border-color: #6a1b9a;
            outline: none;
            box-shadow: 0 0 8px rgba(106, 27, 154, 0.2);
        }

        .form-group button {
            background-color: #6a1b9a;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .form-group button:hover {
            background-color: #4a148c;
            transform: scale(1.05);
        }

        .form-group button i {
            margin-right: 5px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsif */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }

            h1 {
                font-size: 1.8em;
            }

            .form-group input[type="text"],
            .form-group input[type="url"],
            .form-group button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Edit Poster</h1>

        <!-- Menampilkan pesan kesalahan -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('posters.update', $posters->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul_artikel">Judul Artikel</label>
                <input type="text" id="judul_artikel" name="Judul_Artikel" value="{{ $posters->Judul_Artikel }}" required>
            </div>

            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" id="penulis" name="Penulis" value="{{ $posters->Penulis }}" required>
            </div>

            <div class="form-group">
                <label for="nama_seminar">Nama Seminar</label>
                <input type="text" id="nama_seminar" name="Nama_Seminar" value="{{ $posters->Nama_Seminar }}" required>
            </div>

            <div class="form-group">
                <label for="penyelenggara_seminar">Penyelenggara Seminar</label>
                <input type="text" id="penyelenggara_seminar" name="Penyelenggara_Seminar" value="{{ $posters->Penyelenggara_Seminar }}" required>
            </div>

            <div class="form-group">
                <label for="waktu_pelaksaaan">Waktu Pelaksanaan</label>
                <input type="text" id="waktu_pelaksaaan" name="Waktu_Pelaksaaan" value="{{ $posters->Waktu_Pelaksaaan }}" required>
            </div>

            <div class="form-group">
                <label for="ISBN_ISSN">ISBN/ISSN</label>
                <input type="text" id="isbn_issn" name="ISBN_ISSN" value="{{ $posters->ISBN_ISSN }}" required>
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" id="url" name="URL" value="{{ $posters->URL }}" required>
            </div>

            <div class="form-group">
                <button type="submit"><i class="fas fa-save"></i> Update</button>
            </div>
        </form>
    </div>

</body>
</html>
