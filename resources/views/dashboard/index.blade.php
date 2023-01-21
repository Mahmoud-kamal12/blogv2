@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Dashboard</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
        </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    {{-- {{dd($data)}} --}}

                    @foreach ($data as $key => $item)
                    {{-- {{dd($item['nummber'])}} --}}
                        <div class="col-lg-6 mb-4">
                            <a href="{{$item['route']!==null? route($item['route']):'#' }}" style="text-decoration:none" target="_blank">
                                <div class="card textwhite bg-{{$item['color']}} text-white shadow">
                                    <div class="card-body">
                                        <p class="m-0">{{$item['name']}}</p>
                                        <p class="text-white-100 small m-0">{{$item['nummber']}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
