@extends('layouts.master')
@section('title')
  Color Generator
@endsection

@push('head')
  <link rel="stylesheet" href= "css/color-view-styles.css">
@endpush

@section('content')
  <form class="form-top-round light-shadowbox" method="GET" action="/colorsubmit">
    <div class="form-header">
      Color Generator
    </div>
    {!! csrf_field() !!}

    <div class="form-section-title">Base Color</div>

    <div class="row">
      <input type="color" name="base-color" id="color-input" value="{{$baseHex}}">
    </div>
    <div id="radio-div">
      <div class="row">
        <div class="form-section-title">Palette Type</div>
        <div class="btn-group" data-toggle="buttons">
          <div class="col col-md-12">
            <div class="radio btn btn-primary center-block {{$type=='Triadic' ? 'active':'' }}">
                <label>Triadic<input type="radio" name="palette-type" value="triadic" {{$type=='Triadic' ? 'checked':'' }}></label>
            </div>
          </div>
          <div class="col col-md-12">
            <div class="radio btn btn-primary center-block {{$type=='Complementary'?'active':'' }}">
              <label>Complementary<input type="radio" name="palette-type" value="comp" {{$type=='Complementary' ? 'checked':''}}></label>
            </div>
          </div>
          <div class="col col-md-12">
            <div class="radio btn btn-primary center-block {{$type=='Split Complementary'?'active':'' }}">
              <label>Split-Complementary<input type="radio" name="palette-type" value="split-comp" {{$type=='Split Complementary' ? 'checked':''}}></label>
            </div>
          </div>
        </div>
      </div>
    </div> <!--end radio div-->

    <div class="form-section-title">Output Format</div>
    <div class="form-row">
      <select class="form-control" id="output-format" name="output-format">
        <option class="option" value="hex" {{$colorFormat=='hex'?'selected':'' }}>Hex</option>
        <option class="option" value="rgb" {{$colorFormat=='rgb'?'selected':'' }}>RGB</option>
      </select>
    </div>

    <div id="button-div" class="center-block">
      <input type="submit" class="btn btn-info btn-lg" id="main-button" value="Submit">
    </div>
  </form>

  <div id="result-div" class="light-shadowbox">
    <form method="GET" action="/color">
      <div id="result-label" class="alert alert-success">
        <input type="submit" class="btn btn-success" id="reset-button" value="Reset">
        Results
      </div>
    </form>

    <div id="result-content">
        @foreach ($results as $result)
          <div class="row center-block result-row">
            <div class="result-row-header">
              Base Color: {{$base}}&nbsp;&nbsp;&nbsp;
              Type: {{$result['type']}}</div>
              @foreach ($result['color'] as $c)
                <div class="col-xs-3 out-box" style="background-color:{{$c}}">
                  <div class="out-shade">
                  {{$c}}
                  </div>
                </div>
              @endforeach
          </div>
        @endforeach
    </div> <!--End output-div-->
  </div>

  <div id="reference-image">
    <p>All calculations based on the hex color wheel</p>
    <img src="images/colorwheel.png" alt="hex color wheel">
  </div>

@endsection
