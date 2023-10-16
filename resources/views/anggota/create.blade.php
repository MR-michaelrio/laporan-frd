@extends('template.master')

@section('title')
Anggota
@endsection

@section('content')
<div class="col-12">
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{route('anggota.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Input Nama" required>
                </div>
                <div class="form-group">
                    <label>Instansi</label>
                    <input type="text" class="form-control" name="instansi" placeholder="Input Instansi">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control select2" name="role" style="width: 100%;">
                        <option value="anggota" selected>Anggota</option>
                        <option value="101">101</option>
                        <option value="102">102</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Regu</label>
                    <select class="form-control select2" name="regu" style="width: 100%;">
                        <option value="-" selected>-</option>
                        @foreach($regu as $r)
                        <option value="{{ $r->id_regu }}">{{ $r->nama_regu }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection