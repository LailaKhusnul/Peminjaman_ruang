<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Data Peminjaman</h1>
    <hr>
    <table class="table table-hover text-nowrap" id="serverside" style="width: 100%" border="1">
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