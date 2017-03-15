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
      return view('data')->with(['data'=>$data]);
    }

    public function show() {
      $data1 = new RandData(25);
      $data1->genLinear(3,40,1.5);

      $xVals = $data1->getXArr();
      $yVals = $data1->getYArr();

      $data = array();
      for ($i = 0; $i < $data1->length(); $i++) {
        $data[] = ['x'=>$xVals[$i],'y'=>$yVals[$i]];
      }

      return view('data')->with(['data'=>$data]);

    }
}
