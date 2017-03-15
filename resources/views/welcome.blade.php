@extends('layouts.master')

@section('title')
  Filler Content Generator
@endsection

@push('head')
  <link rel="stylesheet" href="css/welcome-view-styles.css">
@endpush

@section('content')
  <div id="container" class="shadowbox">
    <div id="titlebar">
      <div id="title">
        Filler Content Generators
      </div>
    </div>
    <div id="menu-div">
      <h3 id="select-title" class="info">
        <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
        Select a function:
      </h3>

      <div class="container-fluid row-centered">
        <div class="row row-centered">
          <a href="/text" class="col col-md-3 col-sm-4 col-xs-6 col-centered app-card shadowbox">
            <div class="app-card-header">
              Filler Text Generator
            </div>
            <div class="card-text">
              Generate lorem ipsum filler text to given specifications
            </div>
            <span class="glyphicon glyphicon-pencil card-icon" aria-hidden="true"></span>
          </a>

          <a href="/color" class="col col-md-3 col-sm-4 col-xs-6 col-centered app-card shadowbox">
            <div class="app-card-header">Color Palette Generator</div>
            <div class="card-text">
              Generate color palettes from a specified base color
            </div>
            <span class="glyphicon glyphicon-tint card-icon red" aria-hidden="true"></span>
            <span class="glyphicon glyphicon-tint card-icon green" aria-hidden="true"></span>
            <span class="glyphicon glyphicon-tint card-icon blue" aria-hidden="true"></span>
          </a>

          <a href="/data" class="col col-md-3 col-sm-4 col-xs-6 col-centered app-card shadowbox">
            <div class="app-card-header">Random Data Generator</div>
            <div class="card-text">
              Generate random tables of data that follow a specified pattern
            </div>
            <span class="glyphicon glyphicon-list-alt card-icon" aria-hidden="true"></span>
          </a>

        </div> <!-- END ROW -->
      </div> <!-- END ROW CONTAINER FLUID -->
    </div> <!-- END MENU DIV -->
  </div> <!-- END MAIN CONTAINER -->
@endsection
