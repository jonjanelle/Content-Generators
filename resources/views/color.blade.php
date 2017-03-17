@extends('layouts.master')
@section('title')
  Color Generator
@endsection

@push('head')
  <link rel="stylesheet" href= "css/color-view-styles.css">
@endpush

@section('content')
  <form class="form-top-round" method="GET" action="/colorsubmit">
    <div class="form-header">
      Color Generator
    </div>
    {!! csrf_field() !!}

    <div class="form-section-title">Base Color</div>

    <div class="row">
      <input type="color" name="base-color" id="color-input" value="{{$color[0]}}">
    </div>

    <div class="row">
      <div class="form-section-title">Palette Type</div>
      <div class="col col-md-4">
        <div class="radio btn btn-primary center-block">
            <label><input type="radio" name="palette-type" value="triadic" checked="checked">Triadic</label>
        </div>
      </div>

      <div class="col col-md-4">
        <div class="radio btn btn-primary center-block">
          <label><input type="radio" name="palette-type" value="comp">Complementary</label>
        </div>
      </div>

      <div class="col col-md-4">
        <div class="radio btn btn-primary center-block">
          <label><input type="radio" name="palette-type" value="split-comp">Split-Complementary</label>
        </div>
      </div>
    </div>

    <div id="button-div" class="center-block">
      <input type="submit" class="btn btn-info btn-lg" id="main-button" value="Submit">
      <input type="submit" class="btn btn-warning btn-lg" id="reset-button" value="Reset">
    </div>

  </form>










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
