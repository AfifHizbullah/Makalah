<!DOCTYPE html>
<html>
<head>
    <title>Create Your Inspiration Makalah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #e9ecef;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }
        form {
            display: grid;
            gap: 15px;
        }
        input[type="text"] {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus {
            border-color: #80bdff;
            outline: none;
        }
        input[type="submit"] {
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
            font-weight: bold;
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: white;
            transition: all 0.3s ease; /* Smooth transition */
        }
        input[type="submit"]:hover {
            background: linear-gradient(90deg, #0056b3, #007bff);
            transform: translateY(-2px); /* Lift effect */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .view-button {
            display: inline-block; /* Make it behave like a button */
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            width: 100%; /* Full width */
            box-sizing: border-box;
            font-weight: bold;
            background: linear-gradient(90deg, #28a745, #218838); /* Green gradient */
            color: white;
            text-decoration: none; /* Remove underline */
            transition: all 0.3s ease; /* Smooth transition */
            margin-top: 10px; /* Space above */
        }
        .view-button:hover {
            background: linear-gradient(90deg, #218838, #28a745); /* Darker green on hover */
            transform: translateY(-2px); /* Lift effect */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #495057;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
        .button-container {
            display: flex;
            justify-content: center; /* Center the button */
            margin-top: 20px; /* Add spacing above the button */
        }
    </style>
    <script>
        function validateForm() {
            // Validasi Penulis
            const penulis = document.getElementById("penulis").value;
            const regexPenulis = /^[a-zA-Z\s]+$/; // Hanya huruf dan spasi yang diizinkan
            
            if (!regexPenulis.test(penulis)) {
                alert("Kolom Penulis hanya boleh berisi huruf!");
                return false; // Menghentikan form dari pengiriman
            }

            // Validasi Waktu Pelaksanaan
            const waktuPelaksanaan = document.getElementById("waktu_pelaksaaan").value;
            const regexTanggal1 = /^\d{4}-\d{2}-\d{2}$/; // Format YYYY-MM-DD
            const regexTanggal2 = /^\d{1,2}\s[a-zA-Z]+\s\d{4}$/; // Format 13 September 2002

            if (!regexTanggal1.test(waktuPelaksanaan) && !regexTanggal2.test(waktuPelaksanaan)) {
                alert("Kolom Waktu Pelaksanaan harus dalam format YYYY-MM-DD!");
                return false; // Menghentikan form dari pengiriman
            }

            return true; // Jika validasi berhasil, form akan dikirim
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Create Your Inspiration Makalah</h1>

        @if ($errors->any())
            <div class="error">
                <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('makalahs.store') }}" onsubmit="return validateForm()">
            @csrf
            <div class="form-group">
                <label for="judul_artikel">Judul Artikel:</label>
                <input type="text" id="judul_artikel" name="Judul_Artikel" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis:</label>
                <input type="text" id="penulis" name="Penulis" required>
            </div>
            <div class="form-group">
                <label for="nama_seminar">Nama Seminar:</label>
                <input type="text" id="nama_seminar" name="Nama_Seminar" required>
            </div>
            <div class="form-group">
                <label for="penyelenggara_seminar">Penyelenggara Seminar:</label>
                <input type="text" id="penyelenggara_seminar" name="Penyelenggara_Seminar" required>
            </div>
            <div class="form-group">
                <label for="waktu_pelaksaaan">Waktu Pelaksanaan:</label>
                <input type="text" id="waktu_pelaksaaan" name="Waktu_Pelaksaaan" required>
            </div>
            <div class="form-group">
                <label for="url">URL:</label>
                <input type="text" id="url" name="URL" required>
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
