<?php
  namespace App\Http\Controllers;
  use Illuminate\Http\Request;

  class RandDataController extends Controller {

    /**
    * GET /
    * Load main view
    */
    public function index(){
      $data = [['x'=>0, 'y'=>0]];
      return view('data')->with(['data'=>$data,
                                 'xHead'=>'X',
                                 'yHead'=>'Y',
                                 'nPoints'=>25,
                                 'randhead'=>"",
                                 'dispersion'=>5,
                                 'coeff'=>1,
                                 'type'=>'linear']);
    }

    public function show(Request $request) {

      $this -> validate($request, ['pattern-type'=>'required',
                                   'n-points'=>'required|numeric|min:1',
                                   'dispersion'=>'required|numeric|min:0',
                                   'coeff'=>'required|numeric']);

      $nPoints = $request->input("n-points"); //number of points
      $data1 = new RandData($nPoints);
      $dispersion = $request->input("dispersion");
      $coeff = $request->input("coeff");
      $type = $request->input("pattern-type");
      if ($type == "linear"){
        $data1->genLinear($coeff,$dispersion,1);
      } else if ($type == "quadratic"){
        $data1->genQuadratic($coeff,random_int(-10,10),random_int(-20,20),$dispersion,1);
      } else if ($type == "exponential") {
        $data1->genExponential($coeff, random_int(2,10), $dispersion, 1);
      }
      else if ($type == "logarithmic"){
        $data1->genLogarithmic($coeff);
      }
      $labels = $request->input("col-labels");
      $xHead ="X";
      $yHead ="Y";
      $randhead = "";
      if ($labels != null) {
        $labels = ["height", "cholesterol", "smugness", "cupcakes", "smoothness",
                   "moon opacity", "loudness", "nostril radius", "eyebrow tension", "heart rate",
                   "belligerence", "snowfall", "temperature", "time", "strength",
                   "speed", "charisma", "intelligence", "tenacity", "swimming pools",
                   "ice cream", "cats", "apples", "cheese consumption", "divorce rate",
                   "noodle thefts", "bicycles", "unicorns", "fire hydrants", "paperclips",
                   "broccoli deaths", "lemur anger", "light intensity", "torque",
                   "viscosity", "marbles eaten", "flying squirrels", "night sweating",
                   "phone addiction", "vitamin A deficiency","hair length",
                   "balloon enthusiasm"];

        $xHead = $labels[array_rand($labels)];
        $yHead = $labels[array_rand($labels)];
        $randhead = "checked";
      }


      $xVals = $data1->getXArr();
      $yVals = $data1->getYArr();

      $data = array();
      for ($i = 0; $i < $data1->length(); $i++) {
        $data[] = ['x'=>$xVals[$i],'y'=>$yVals[$i]];
      }
      $data1=json_encode($data);

      return view('data')->with(['data'=>$data,
                                 'xHead'=>ucfirst($xHead),
                                 'yHead'=>ucfirst($yHead),
                                 'nPoints'=>$nPoints,
                                 'randhead'=>$randhead,
                                 'dispersion'=>$dispersion,
                                 'coeff'=>$coeff,
                                 'type'=>$type]);
    }
}
