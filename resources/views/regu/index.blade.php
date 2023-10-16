@extends('template.master')

@section('title')
Regu
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
                        <th>Nama Regu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 1;
                    @endphp
                    @foreach($regu as $agt)
                    <tr>
                        <td>{{ $nomor++ }}</td>
                        <td>
                            @if($agt->id_regu == '4')
                                Null
                            @else
                                {{$agt->nama_regu}}
                            @endif
                        </td>
                        <td>
                            <form action="{{route('regu.destroy',$agt->id_regu)}}" method="post">
                                @csrf
                                @METHOD('DELETE')
                                <a href="{{route('regu.edit',$agt->id_regu)}}"><button type="button" class="btn btn-warning">Edit</button></a>&nbsp
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?')">Delete</button>
                            </form>
                        </td>
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