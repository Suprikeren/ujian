<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Stock</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Menambahkan garis pada seluruh tabel, header, dan body */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black; /* Menambahkan garis pada tabel dan sel */
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2; /* Memberikan latar belakang abu-abu pada header */
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Tabel untuk Daftar Stock -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="3" class="text-center">Daftar Stock</th> <!-- Judul Daftar Stock -->
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td>{{ $loop->iteration + 0 }}</td>
                            <td>{{ $stock->barang->nama_barang }}</td>
                            <td>{{ $stock->qty }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Menambahkan Bootstrap JS dan jQuery untuk fungsionalitas interaktif -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
