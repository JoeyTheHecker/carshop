@extends('layouts.app')


@section('content')
<div class="pageheader">
  <h2>Dashboard</h2>
  <p>Here’s a glance of the what’s happening today.</p>
</div>

<h1>admin</h1>
@endsection
@section('javascript')
<script src="{{ URL::asset('js/chart/highcharts.js') }}"></script>
<script src="{{ URL::asset('js/chart/exporting.js') }}"></script>
<script src="{{ URL::asset('js/chart/export-data.js') }}"></script>
<script src="{{ URL::asset('js/dashboard/dashboard.js') }}"></script>

@stop