@extends('layouts.master')

@section('title')
  Meaningless Data Generator
@endsection

@push('head')
  <link rel="stylesheet" href="css/data-view-styles.css">
@endpush

@section('content')

  <form id="data-form">
    <div class="form-group">
      <label for="pattern-type">Pattern Type</label>
      <select class="form-control" id="pattern-type">
        <option>Linear</option>
        <option>Quadratic</option>
        <option>Exponential</option>
      </select>
    </div>
    <div class="form-group">
      <label for="example-number-input" class="col-2 col-form-label">Number</label>
      <input class="form-control" type="number" value="3" id="example-number-input">
    </div>
    <input class="btn btn-primary" type="submit" value="Submit">
  </form>

  <div class="draggable">
    <div class="table-container">
      <table id="data-table" class="table table-responsive table-condensed">
        <thead>
          <th>X</th>
          <th>Y</th>
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
  </div>

@endsection
