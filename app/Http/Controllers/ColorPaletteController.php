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
      return view('color')->with(['color'=> ["#00FF00"],
                                  'results'=>[],
                                  'base'=>"#00FF00",
                                  'type'=>""]);
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

      $color = array();
      if ($type=="triadic") {
        $color=$palette->getTriadic();
        $type="Triadic";
      }
      else if ($type=="comp"){
        $color=$palette->getComplementary();
        $type="Complementary";
      }
      else if ($type=="split-comp"){
        $color = $palette->getSplitComp();
        $type="Split Complementary";
      }


      //push to front so newest appears on top
      array_unshift($_SESSION['results'],$color);
      $results = $_SESSION['results'];
      //will need to rethink the chaining approach.
      return view('color')->with(['color'=>$color,
                                  'results'=>$results,
                                  'base'=>$palette->getBaseColor(),
                                  'type'=>$type]);
    }
  }
