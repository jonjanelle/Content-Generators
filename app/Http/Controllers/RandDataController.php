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
                                 'yHead'=>'Y']);
    }

    public function show(Request $request) {
      $nPoints = $request->input("n-points"); //number of points
      $data1 = new RandData($nPoints);

      $type = $request->input(""); 

      $data1->genLinear(3,40,1.5);

      $xVals = $data1->getXArr();
      $yVals = $data1->getYArr();

      $data = array();
      for ($i = 0; $i < $data1->length(); $i++) {
        $data[] = ['x'=>$xVals[$i],'y'=>$yVals[$i]];
      }
      $data1=json_encode($data);

      return view('data')->with(['data'=>$data,
                                 'xHead'=>'Xs',
                                 'yHead'=>'Ys']);
    }
}
