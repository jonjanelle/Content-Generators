@extends('layouts.master')
@section('title')
  Color Generator
@endsection

@push('head')
  <link rel="stylesheet" href= "css/color-view-styles.css">
@endpush

@section('content')
  <!--BEGIN MAIN FORM-->
  <div class="jumbotron center-block" id="main-form">
    <h2>Color Generator</h2>
    <hr />
    <form method="GET" action="/colorsubmit">
      {!! csrf_field() !!}
      <h3>Base Color</h3>
      <input type="color" name="base-color" id="color-input" value="{{$color[0]}}">


      <div class="radio btn btn-primary center-block">
        <label><input type="radio" name="palette-type" value="triadic" checked="checked">Triadic</label>
      </div>
      <div class="radio btn btn-primary center-block">
        <label><input type="radio" name="palette-type" value="comp">Complementary</label>
      </div>
      <div class="radio btn btn-primary center-block">
        <label><input type="radio" name="palette-type" value="split-comp">Split-Complementary</label>
      </div>

      <div id="button-div" class="center-block">
        <input type="submit" class="btn btn-info btn-lg" id="main-button" value="Submit">
        <input type="submit" class="btn btn-warning btn-lg" id="reset-button" value="Reset">
      </div>

    </form>
  </div> <!--end main form div -->

  <div id="output-div">
      @foreach ($results as $result)
        <div class="row center-block">
        @foreach ($result as $c)
          <div class="col-xs-3 out-box" style="background-color:{{$c}}"></div>
        @endforeach
        </div>
      @endforeach
  </div> <!--End output-->

@endsection
