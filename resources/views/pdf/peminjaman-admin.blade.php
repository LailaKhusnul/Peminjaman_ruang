<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Styling untuk kop PDF */
        table.kop {
            width: 100%;
            border-collapse: collapse;
        }
        .kop td {
            padding: 5px 0;
        }
        .kop img {
            max-width: 100px;
        }
        .kop h1 {
            margin: 0;
            font-size: 16px;
        }
        .kop h2 {
            margin: 0;
            font-size: 18px;
        }
        .kop p {
            margin: 0;
            font-size: 14px;
        }
        /* .kop td:last-child {
            text-align: right;
        } */
        hr.separator {
            border-top: 2px solid #000;
            margin: 10px 0;
        }
        /* Styling untuk tabel */
        table.table {
            width: 100%;
            /* Agar garis tidak double */
            border-collapse: collapse;      
            border: 1px solid black;
        }
        .table th, .table td {
            border: 1px solid black;
            /* Agar isi tabel lebih rapi */
            padding: 8px;
        }
    </style>
</head>
<body>
    <table class="kop">
        <tr>
            <td>
                <img src="data:image/png;base64,{{ $logo_base64 }}" alt="Logo">
            </td>
            <td style="text-align: center;">
                <h1>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h1>
                <h2>POLITEKNIK NEGERI MADIUN</h2>
                <p>Jalan Serayu Nomor 84 Madiun Telepon (0351)452970, Faximile (0351)492960</p>
                <p>Website: www.pnm.ac.id, E-mail: sekretariat@pnm.ac.id</p>
            </td>
        </tr>
    </table>
    <hr class="separator">

    <h1><center>Data Peminjaman</center></h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Nama Ruang</th>
                <th>Tanggal & Waktu Peminjaman</th>
                <th>Tanggal & Waktu Selesai</th>
                <th>Kegiatan</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data_pinjam as $d)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ optional($d->user)->name }}</td>
            <td>{{ optional($d->ruang)->nama_ruang }}</td>
            <td>{{ $d->tanggal_mulai }}</td>
            <td>{{ $d->tanggal_selesai }}</td>
            <td>{{ $d->kegiatan }}</td>
        @endforeach
        </tbody>
    </table>
</body>
</html>