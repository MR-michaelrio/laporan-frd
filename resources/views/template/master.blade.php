@include('template.header')
@include('template.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@if(request()->is('/') || request()->is('index')) Dashboard @else @yield('title') @endif</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if(request()->is('/') || request()->is('index'))
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $jmlhanggota }}</h3>
                            <p>Jumlah Anggota</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="{{ route('agt.index2') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @else
                    @yield('content')
                @endif
            </div>
        </div>
    </section>
</div>
@include('template.footer')