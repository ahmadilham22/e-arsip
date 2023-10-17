<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Ruang</th>
                <th>Jenis Laporan</th>
                <th>Pemilik</th>
                <th>Npm</th>
                <th>Dosen Pembimbing 1</th>
                <th>Dosen Pembimbing 2</th>
                <th>Dosen Pembahas</th>
                <th>Tanggal Seminar</th>
                <th>Berita Acara</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($arsip as $item => $value)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $value->judul }}</td>
                    <td>{{ $value->ruang }}</td>
                    <td>{{ $value->jenis_laporan }}</td>
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value->user->npm }}</td>
                    <td>{{ $value->dosen_pembimbing_1 }}</td>
                    <td>{{ $value->dosen_pembimbing_2 }}</td>
                    <td>{{ $value->dosen_penguji }}</td>
                    <td>{{ $value->tgl_seminar }}</td>
                    <td>
                        @if ($value->berita_acara)
                            Ada
                        @else
                            Tidak ada
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
