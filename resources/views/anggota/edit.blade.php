@extends('template.master')

@section('title')
Anggota
@endsection

@section('content')
<div class="col-12">
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{route('anggota.update',$data->id_anggota)}}">
            @csrf
            @METHOD('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" placeholder="Input Nama" value="{{ $data->nama }}" required>
                </div>
                <div class="form-group">
                    <label>Instansi</label>
                    <input type="text" class="form-control" name="instansi" value="{{ $data->instansi }}" placeholder="Input Instansi">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control select2" name="role" style="width: 100%;">
                        <option value="anggota" @if($data->role == 'anggota') selected @endif>Anggota</option>
                        <option value="101" @if($data->role == '101') selected @endif>101</option>
                        <option value="102" @if($data->role == '102') selected @endif>102</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Regu</label>
                    <select class="form-control select2" name="regu" style="width: 100%;">
                        <!-- <option value="-" @if($data->id_regu == '-') selected @endif>-</option> -->
                        @foreach($regu as $r)
                            <option value="{{ $r->id_regu }}" @if($data->id_regu == $r->id_regu) selected @endif>@if($r->nama_regu == "null")-@else{{ $r->nama_regu }}@endif</option>
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