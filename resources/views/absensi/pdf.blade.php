<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-family: Arial, sans-serif;
        text-transform: capitalize;
    }
    .container {
        margin: 20px;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    table{
        width:100%;
    }
    td{
        padding-left:5px;
    }
    </style>
</head>

<body>
    <div class="container">
        @php
            $no = 1;
        @endphp
        <table>
            <thead>
                <tr>
                    <th style="width: 20px">#</th>
                    <th>Nama</th>
                    <th>Kehadiran</th>
                </tr>
            </thead>
            @foreach($data as $d)
            <tbody>
                <tr>
                    <td style="text-align:center">{{$no++}}</td>
                    <td>{{ $d->anggota->nama }} - {{ $d->anggota->instansi }}</td>
                    <td>
                        {{ $d->absenshadir }}
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        @foreach ($data2 as $item)
            <h3>Catatan: <p>{{ $item->catatan }}</p></h3>
        @endforeach
    </div>
</body>

</html>