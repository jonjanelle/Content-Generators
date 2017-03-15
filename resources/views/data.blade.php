@extends('layouts.master')

@section('title')
  Meaningless Data Generator
@endsection

@push('head')
  <link rel="stylesheet" href="css/data-view-styles.css">

  <script type="text/javascript" src="https://www.amcharts.com/lib/3/amcharts.js"></script>
	<script type="text/javascript" src="https://www.amcharts.com/lib/3/xy.js"></script>
@endpush

@section('content')
  <form id="main_form" method="GET" action="/datasubmit">
    <div class="form-header">
      Data Generator
    </div>
    {!! csrf_field() !!}
    <div class="form-section-title">Options</div>
    <div class="form-body">
      <div class="form-row">
        <label for="pattern-type">Pattern Type</label>
        <select class="form-control" id="pattern-type">
          <option value="linear">Linear</option>
          <option value="quadratic">Quadratic</option>
          <option value="exponential">Exponential</option>
        </select>
      </div>

      <div class="form-row">
        <label>Number of Points</label>
        <input type="number" class="form-control" name="n-points" value="10">
      </div>

      <div class="form-row">
        <input type="checkbox" id="rand-check" class="form-check-input-lg" name="col-labels">
        <label class="form-check-label" for="rand-check">
          Random column labels?
        </label>
      </div>
    </div>
    <button type="submit" id="submit-button" class="btn btn-primary btn-lg">Generate!</button>
  </form>

  <div id="table-container">
    <table id="main-table" class="table table-bordered table-condensed table-responsive table-striped">
      <thead>
        <tr class="info">
          <th>{{$xHead}}</th>
          <th>{{$yHead}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $point)
          <tr>
            <td>{{$point['x']}}</td>
            <td>{{$point['y']}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div id="chartdiv" ></div>
@endsection

@push('body')
  <script type="text/javascript" src="js/data_view_scripts.js"></script>
@endpush
