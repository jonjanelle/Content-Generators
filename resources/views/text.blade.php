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
          <label>
            <a href="#" data-toggle="tooltip" title="Required.">
              <span class="glyphicon glyphicon-info-sign"></span>
            </a>
            Number of paragraphs:
          </label>
          <input type="number" class="form-control" id="num_para" name="num_para" value="{{$numPara}}" onchange="minInput1('num_para')" required>
        </div>
        <div class="col col-md-6">
          <label>
            <a href="#" data-toggle="tooltip" title="Required. Actual length may vary based on specified deviation.">
              <span class="glyphicon glyphicon-info-sign"></span>
            </a>
            Average sentences per paragraph:</label>
          <input type="number" class="form-control" id="num_sent" name="num_sent" value="{{$paraLen}}" onchange="minInput1('num_sent')" required>
        </div>

        <div class="col col-md-6">
          <label>
            <a href="#" data-toggle="tooltip" title="Required. Max random difference from sentences per paragraph. Must be less than number of paragraphs.">
              <span class="glyphicon glyphicon-info-sign"></span>
            </a>
            Max deviation from average sentences per paragraph:
          </label>
          <input type="number" class="form-control" id="sent_dev" name="sent_dev" value="{{$paraDev}}" onchange="checkDev('sent_dev')" required>
        </div>

        <div class="col col-md-6">

          <label>
              <a href="#" data-toggle="tooltip" title="Required. Actual length may vary based on specified deviation.">
                <span class="glyphicon glyphicon-info-sign"></span>
              </a>
            Average number of words per sentence:
          </label>
          <input type="number" class="form-control" id="num_words" name="num_words" value="{{$sentLen}}" onchange="minInput1('num_words')" required>
        </div>
        <div class="col col-md-6">
          <label>
            <a href="#" data-toggle="tooltip" title="Required. Max random difference from words per sentence. Must be less than words per sentence.">
              <span class="glyphicon glyphicon-info-sign"></span>
            </a>
            Max deviation from average words per sentence:
          </label>
          <input type="number" class="form-control" id="word_dev" name="word_dev" value="{{$sentDev}}" onchange="checkDev('word_dev')" required>
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
        <div id="result-header-copy" onclick="copyToClipboard()">
          copy
        </div>
      </div>

      <div class="result-content" id="lorem-text-output">
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
