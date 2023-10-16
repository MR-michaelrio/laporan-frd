@extends('template.master')

@section('title')
Regu
@endsection

@section('content')
<div class="col-12">
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{route('regu.update',$regu->id_regu)}}">
            @csrf
            @METHOD('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Regu</label>
                    <input type="text" class="form-control" name="nama_regu" placeholder="Input Nama" value="{{ $regu->nama_regu }}" required>
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