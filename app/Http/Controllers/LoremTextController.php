<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoremTextController extends Controller {

    public function index() {
      return view('text')->with(['loremText'=>array(),
                                 'display'=>'none']);
    }

    public function show(Request $request) {
      $words = new WordList("word_list.csv");
      //Set paragraph characterists based on form input.
      $numPara = $request->input("num_para"); //number of paragraphs
      $paraLen = $request->input("num_sent"); //average sentences per paragraph
      $paraDev = $request->input("sent_dev"); //max absolute deviation from average sentences per paragraph
      $sentLen = $request->input("num_words"); //average sentence length
      $sentDev = $request->input("word_dev"); //max absolute deviation from average sentence length
      $lorem = false;
      $headers = false;
      $punct = $request->input("punct_sentences");
      if ($punct == "periods"){
        $punct = ["."];
      } else if ($punct == "all"){
        $punct = [".","!","?"];
      } else {
        $punct = ["."];
      }
      if ($request->input("par_headers")!==null) { $headers = true; }
      if ($request->input("lorem_first")!==null){ $lorem = true; }

      $loremText = array(); //Each entry is one paragraph.
      for ($i=0; $i<$numPara; $i++) { //Each iteration generates new paragraph
        $loremText[] = $words->getParagraph($paraLen, $paraDev, $sentLen,
                                            $sentDev, $headers, $punct);
      }
      if ($lorem){
        $loremText[0]['body']="Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. ".$loremText[0]['body'];
      }
      return view('text')->with(['loremText'=>$loremText,
                                 'headers'=>$headers,
                                  'display'=>'inline']);
    }

}
