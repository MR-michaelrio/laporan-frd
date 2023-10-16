@extends('template.master')

@section('title')
Absen {{ \Carbon\Carbon::parse($tanggal->tanggal_absen)->format('d-m-Y') }}
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Anggota</th>
                        <th>Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 1;
                    @endphp
                    @foreach($data as $agt)
                    <tr>
                        <td>{{ $nomor++ }}</td>
                        <td>{{ $agt->anggota->nama }} - {{ $agt->anggota->instansi }}</td>
                        <td>{{ $agt->absenshadir }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection 