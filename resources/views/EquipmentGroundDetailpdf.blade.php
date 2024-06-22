<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Ground Measurement Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0; /* Mengatur margin ke 0 untuk menghindari ruang tambahan */
            padding: 0; /* Mengatur padding ke 0 untuk menghindari ruang tambahan */
        }
        .header, .footer {
            width: 100%;
            position: fixed;
            text-align: center;
            background-color: #ffffff; /* Latar belakang putih untuk header dan footer */
        }
        .header {
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #dddddd; /* Garis bawah di header */
        }
        .header .title-container {
            flex-grow: 1;
            text-align: center;
        }
        .header h1 {
            margin: 0; /* Menghapus margin h1 agar rapi */
        }
        .header img {
            height: 50px;
            margin-right: 10px; /* Jarak kanan antara gambar dan judul */
        }
        .footer {
            bottom: 0;
            font-size: 12px;
            border-top: 1px solid #dddddd; /* Garis atas di footer */
            padding: 10px;
        }
        .footer p {
            margin: 0; /* Menghapus margin pada paragraf footer */
        }
        .content {
            margin-top: 80px; /* Menyesuaikan margin top untuk memberi ruang header */
            padding-bottom: 80px; /* Menambahkan padding bottom untuk memberi ruang footer dan nomor halaman */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .button-ok {
            background-color: #4CAF50; /* Warna hijau untuk tombol OK */
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button-ng {
            background-color: #f44336; /* Warna merah untuk tombol NG */
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title-container">
            <!-- Uncomment and adjust the image source if you have a logo -->
            <!-- <img src="{{ asset('images/esd.png') }}" alt="Left Image"> -->
            <h1>Equipment Ground Measurement Report</h1>
        </div>
    </div>
    
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Machine Name</th>
                    <th>Area</th>
                    <th>Location</th>
                    <th>Measure Results Ohm</th>
                    <th>Judgement Ohm</th>
                    <th>Measure Results Volts</th>
                    <th>Judgement Volts</th>
                    <th>Remarks</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example loop assuming PHP or similar backend templating -->
                <!-- Replace with actual backend logic for generating rows -->
                @foreach($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->equipmentground->machine_name }}</td>
                    <td>{{ $record->equipmentground->area }}</td>
                    <td>{{ $record->equipmentground->location }}</td>
                    <td>{{ $record->measure_results_ohm }}</td>
                    <td>
                        @if ($record->judgement_ohm == 'OK')
                            <button class="button-ok">OK</button>
                        @else
                            <button class="button-ng">NG</button>
                        @endif
                    </td>
                    <td>{{ $record->measure_results_volts }}</td>
                    <td>
                        @if ($record->judgement_volts == 'OK')
                            <button class="button-ok">OK</button>
                        @else
                            <button class="button-ng">NG</button>
                        @endif
                    </td>
                    <td>{{ $record->remarks }}</td>
                    <td>{{ $record->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="footer">
        <p>QR-ADM-24-K056 (Rev-00) | Print on: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s') }}</p>
    </div>
</body>
</html>
