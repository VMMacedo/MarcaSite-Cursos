@extends('layouts.principal.index')
@section('title', 'Dashboard')
@section('ContentTitle', 'Dashboard')
@section('content')
    <div class="graph">
        <div id="alertageral" class="text-center"></div>
        <div class="row">
            <div class="col-3 text-center">
               <div id="card1"></div>
            </div>
            <div class="col-3 text-center">
                <div id="card2"></div>
            </div>
            <div class="col-6 text-center">
                <div id="piechart_3d"></div>
            </div>
            
        </div>
        <hr>
        <div class="row">
            <div class="col-6 text-center">
                <div id="chart_div"></div>
            </div>
            <div class="col-6 text-center">
                <p>Últimos Inscritos</p>
                <div id="table_div"></div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        var config = {
            routes: {
                show: "{{ route('dashboard.index') }}",
            }

        };
    </script>
    <script src="{{ asset('js/dashboard/script.js') }}"></script>

@endsection
