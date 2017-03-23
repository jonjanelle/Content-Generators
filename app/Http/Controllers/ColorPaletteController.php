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
      return view('color')->with(['results'=>[],
                                  'base'=>"#00FF00",
                                  'type'=>"Triadic",
                                  'colorFormat'=>"hex",
                                  'baseHex'=>"#00FF00"]);
    }

    /**
    * GET
    * /submit
    */
    public function show(Request $request) {
      if (!isset($_SESSION['results'])){
        $_SESSION['results']=array();
      }
      $this->validate($request, ['palette-type'=>'required',
                                 'base-color' => 'required',
                                 'output-format'=>'required']);

      $palette = new ColorPalette($request->input('base-color'));
      $type = $request->input('palette-type');

      $color = array();
      if ($type=="triadic") {
        $color = $palette->getTriadic();
        $type="Triadic";
      }
      else if ($type=="comp"){
        $color = $palette->getComplementary();
        $type="Complementary";
      }
      else if ($type=="split-comp"){
        $color = $palette->getSplitComp();
        $type="Split Complementary";
      }

      //push to front so newest appears on top
      array_unshift($_SESSION['results'], $color);
      $results = $_SESSION['results'];

      $base = $palette->getBaseColor();
      $out_format = $request->input('output-format');
      if ($out_format=='rgb') {
        //Need to convert all result values to rgb strings.
        $base = ColorPalette::hexToRgb($base, true);
        for ($i=0; $i<count($results); $i++){
          for ($j = 0; $j<count($results[$i]); $j++){
            $results[$i][$j]=ColorPalette::hexToRgb($results[$i][$j], true);
          }
        }
      }

      return view('color')->with(['results'=>$results,
                                  'base'=>$base,
                                  'type'=>$type,
                                  'colorFormat'=>$out_format,
                                  'baseHex'=>$palette->getBaseColor()]);
    }
  }
