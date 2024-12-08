<!-- resources/views/posters/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Poster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Font Awesome for icons -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f0f4f8; /* Soft background */
            color: #333;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #6a1b9a; /* Purple color */
            font-size: 2.5em;
            text-transform: uppercase;
            letter-spacing: 1px; /* Spacing for modern look */
        }
        .create-button-container {
            text-align: center;
            margin-bottom: 20px; /* Spacing below the button */
        }
        .create-button {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #007bff; /* Blue color for create button */
            color: white;
            border: none;
            border-radius: 8px; /* Rounded corners */
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .create-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .article-table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto 40px; /* Margin above and below */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background-color: #ffffff; /* White background for table */
            border-radius: 12px; /* More rounded corners */
            overflow: hidden;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 16px; /* More padding for a cleaner look */
        }
        th {
            background-color: #6a1b9a; /* Purple header */
            color: white;
            font-size: 1.2em; /* Increased font size for headers */
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; /* Light grey for even rows */
        }
        tr:hover {
            background-color: #e3f2fd; /* Light blue on hover */
            transition: background-color 0.3s; /* Smooth transition */
        }
        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }
        .edit-button,
        .delete-button {
            padding: 10px 15px;
            cursor: pointer;
            border: none; /* No border for edit button */
            border-radius: 8px; /* More rounded corners for buttons */
            font-size: 16px;
            transition: all 0.3s ease;
            font-weight: bold;
            width: 120px;
            color: white;
            display: flex; /* Center icon and text */
            align-items: center;
            justify-content: center;
        }
        .edit-button {
            background-color: #4caf50; /* Green for edit button */
        }
        .delete-button {
            background-color: #f44336; /* Red for delete button */
        }
        .edit-button:hover {
            background-color: #388e3c; /* Darker green on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
        .delete-button:hover {
            background-color: #d32f2f; /* Darker red on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
        .edit-button i, .delete-button i {
            margin-right: 5px; /* Space between icon and text */
        }
        @media (max-width: 768px) {
            .article-table {
                width: 100%; /* Full width on small screens */
            }
            h1 {
                font-size: 2em; /* Smaller title on mobile */
            }
        }
    </style>
</head>
<body>
    <h1>List of Poster</h1>

    <div class="create-button-container">
        <a href="{{ route('posters.create') }}">
            <button class="create-button"><i class="fas fa-plus"></i>Create Poster</button>
        </a>
    </div>

    @foreach ($posters as $poster)
    <table class="article-table">
        <tr>
            <th>Attribute</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Judul Artikel</td>
            <td>{{ $poster->Judul_Artikel }}</td>
        </tr>
        <tr>
            <td>Penulis</td>
            <td>{{ $poster->Penulis }}</td>
        </tr>
        <tr>
            <td>Nama Seminar</td>
            <td>{{ $poster->Nama_Seminar }}</td>
        </tr>
        <tr>
            <td>Penyelenggara Seminar</td>
            <td>{{ $poster->Penyelenggara_Seminar }}</td>
        </tr>
        <tr>
            <td>Waktu Pelaksanaan</td>
            <td>{{ $poster->Waktu_Pelaksaaan }}</td>
        </tr>
        <tr>
            <td>ISBN/ISSN</td>
            <td>{{ $poster->ISBN_ISSN }}</td>
        </tr>
        <tr>
            <td>URL</td>
            <td>{{ $poster->URL }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="button-container">
                    <a href="{{ route('posters.edit', ['id' => $poster->id]) }}">
                        <button class="edit-button"><i class="fas fa-edit"></i>Edit</button>
                    </a>
                    <form action="{{ route('posters.destroy', ['id' => $poster->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this poster?')"><i class="fas fa-trash"></i>Delete</button>
                    </form>
                </div>
            </td>
        </tr>
    </table>
    @endforeach
</body>
</html>
