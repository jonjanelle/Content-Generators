<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoremTextController extends Controller {
    private $checkText = [false=>"unchecked", true=>"checked"];
    public function index() {
      return view('text')->with(['loremText'=>array(),
                                 'display'=>'none',
                                 'numPara'=>4,
                                 'paraLen'=>7,
                                 'paraDev'=>2,
                                 'sentLen'=>8,
                                 'sentDev'=>3,
                                 'pHeaders'=> $this->checkText[true],
                                 'beginLorem'=>$this->checkText[true]
                               ]);
    }

    public function show(Request $request) {
      $words = new WordList("storage/word_list.csv"); //File assumed to be in /storage

      //Get paragraph stat inputs.
      $numPara = $request->input("num_para"); //number of paragraphs
      $paraLen = $request->input("num_sent"); //average sentences per paragraph
      $paraDev = $request->input("sent_dev"); //max absolute deviation from average sentences per paragraph
      $sentLen = $request->input("num_words"); //average sentence length
      $sentDev = $request->input("word_dev"); //max absolute deviation from average sentence length


      $punct = $request->input("punct_sentences");
      if ($punct == "periods"){
        $punct = ["."];
      } else if ($punct == "all"){
        $punct = [".","!","?"];
      } else {
        $punct = ["."];
      }

      $headers = false;
      $lorem = false;
      if ($request->input("par_headers")!==null) {
        $headers = true;
        $pHeaders="checked";
      }
      if ($request->input("lorem_first")!==null){
        $lorem = true;
        $beginLorem="checked";
      }

      $loremText = array(); //Each entry is one paragraph.
      for ($i=0; $i<$numPara; $i++) { //Each iteration generates new paragraph
        $loremText[] = $words->getParagraph($paraLen, $paraDev, $sentLen,
                                            $sentDev, $headers, $punct);
      }
      //If "make first sentence lorem ipsum" box checkeds
      if ($lorem){
        $loremText[0]['body']="Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. ".$loremText[0]['body'];
      }
      return view('text')->with(['loremText'=>$loremText,
                                 'headers'=>$headers,
                                 'display'=>'inline',
                                 'numPara'=>$numPara,
                                 'paraLen'=>$paraLen,
                                 'paraDev'=>$paraDev,
                                 'sentLen'=>$sentLen,
                                 'sentDev'=>$sentDev,
                                 'pHeaders'=>$this->checkText[$headers],
                                 'beginLorem'=>$this->checkText[$lorem]]);
    }

}
