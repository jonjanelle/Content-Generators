@extends('layouts.master')

@section('title')
  Filler Text Generator
@endsection
@push('head')
  <link rel="stylesheet" href="css/text-view-styles.css">
  <script src="js/clipboard.min.js"></script>
@endpush

@section('content')
  <div id="container">
    <div id="open-form" class="alert alert-info shadowbox">
      Click to show/hide menu
    </div>
    <form id="main_form" class="form-top-round" method="GET" action="/textsubmit">
      <div class="form-header">
        Lorem Ipsum Text Generator
      </div>
      {!! csrf_field() !!}
      <div class="form-section-title">Text Statistics</div>
      <div class="row">
        <div class="col col-md-6">
          <label>Number of paragraphs:</label>
          <input type="number" class="form-control" name="num_para" value="{{$numPara}}">
        </div>
        <div class="col col-md-6">
          <label>Average sentences per paragraph:</label>
          <input type="number" class="form-control" name="num_sent" value="{{$paraLen}}">
        </div>

        <div class="col col-md-6">
          <label>Max deviation from average sentences per paragraph: </label>
          <input type="number" class="form-control" name="sent_dev" value="{{$paraDev}}">
        </div>

        <div class="col col-md-6">
          <label>Average number of words per sentence:</label>
          <input type="number" class="form-control" name="num_words" value="{{$sentLen}}">
        </div>
        <div class="col col-md-6">
          <label>Max deviation from average words per sentence:</label>
          <input type="number" class="form-control" name="word_dev" value="{{$sentDev}}">
        </div>
      </div>

      <div class="row">
        <div class="form-section-title">Other Options</div>
        <div class="col col-md-4">
          <label>
            Sentence Endings
            <select name="punct_sentences">
              <option value="periods">Periods Only</option>
              <option value="all">., !, and ?</option>
            </select>
          </label>
        </div>
        <div class="col col-md-4">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="par_headers" {{$pHeaders}}>
            Include paragraph headers?
          </label>
        </div>
        <div class="col col-md-4">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="lorem_first" {{$beginLorem}} >
            Begin with Lorem ipsum?
          </label>
        </div>
      </div>
      <button type="submit" id="submit-button" class="btn btn-primary btn-lg">Generate!</button>
    </form>

    <!-- Output area -->
    <div id="ouput-div" style="display:{{$display}}">
      <div class="result-header">
        Result
      </div>
      <div class="result-content">
        @foreach ($loremText as $p)
          <p>
            @if ($headers)
              <h3>{{$p['header']}}</h3>
            @endif
            {{$p['body']}}
          </p>
        @endforeach
      </div>
    </div>
    <!-- End output area -->
  </div> <!-- End main container -->
@endsection

@push('body')
  <script type="text/javascript" src="js/text_view_scripts.js"></script>
@endpush
