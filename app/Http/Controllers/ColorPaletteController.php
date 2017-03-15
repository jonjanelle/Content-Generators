<?php
  namespace App\Http\Controllers;
  use Illuminate\Http\Request;

  session_start();

  class ColorPaletteController extends Controller {
    /**
    * GET /
    * Load main view
    */
    public function index(){
      $_SESSION['results']=array();
      $color = array("#00FF00");
      $results = array();
      return view('color')->with('color', $color)->with('results', $results);
    }

    /**
    * GET
    * /submit
    */
    public function show(Request $request) {
      if (!isset($_SESSION['results'])){
        $_SESSION['results']=array();
      }
      $palette = new ColorPalette($request->input('base-color'));
      $type = $request->input('palette-type');
      $color = array("#ffffff");
      if ($type=="triadic") {
        $color=$palette->getTriadic();
      }
      else if ($type=="comp"){
        $color=$palette->getComplementary();
      }
      else if ($type=="split-comp"){
        $color = $palette->getSplitComp();
      }
      array_push($_SESSION['results'],$color);
      $results = $_SESSION['results'];
      //will need to rethink the chaining approach.
      return view('color')->with('color', $color)->with('results',$results);
    }
  }
