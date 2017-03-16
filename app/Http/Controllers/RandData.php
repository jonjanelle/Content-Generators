<?php
  /**
  * Generate sets of two-variable numerical data that follow a specified
  * function pattern.
  *
  * Author: Jon Janelle
  */
  namespace App\Http\Controllers;

  class RandData {

      private $xArr=array();
      private $yArr=array();
      private $len=0;

      function __construct($count) {
        $this->len = $count;
      }

      /**
      * Generate a "random" linear data set
      * $slope: The slope in the underlying relationship
      * $dispersion: Spread of the data. Higher values = more spread
      * $scale: x-axis scale. Controls the changes in x.
      */
      public function genLinear($slope, $dispersion, $scale=1) {
        $this->xArr = array(); #Clear any current data.
        $this->yArr = array();
        $x = 0;
        for ($i=0; $i < $this->len; $i++){
          $this->xArr[]=$x; //better than array_push. avoids function call overhead.
          $dx = mt_rand(-$scale, 10*$scale)/10; //Generate random -scale/10 to scale change in x
          $wiggle = mt_rand(-$dispersion,$dispersion)/10;
          $x = $x+$dx;
          $this->yArr[] = ($x+$wiggle)*$slope;
        }
      }

      /**
        * f(x) = k*b^x
        * f(x) = $coeff*$base^x
      */
      public function genExponential($coeff, $base, $dispersion, $scale=1) {
        $this->xArr = array(); #Clear any current data.
        $this->yArr = array();
        $x=0;
        for ($i=0; $i < $this->len; $i++){
          $this->xArr[]=$x;
          $dx = mt_rand(1, 10*$scale)/100;
          $wiggle = mt_rand(-$dispersion,$dispersion)/100;
          $x = $x+$dx;
          $this->yArr[] = $coeff*pow($base,($x+$wiggle));
        }
      }

      /**
        *
        *
      */
      public function genQuadratic($a, $b, $c, $dispersion, $scale) {
        $this->xArr = array(); #Clear any current data.
        $this->yArr = array();
        $x=0;
        for ($i=0; $i < $this->len; $i++){
          $this->xArr[]=$x;
          $dx = mt_rand(-$scale, 10*$scale)/10;
          $wiggle = mt_rand(-$dispersion,$dispersion)/10;
          $x = $x+$dx;
          $xw = $x+$wiggle;
          $this->yArr[] = $a*($xw*$xw)+$b*$xw+$c;
        }
      }

      /**
        *
        *
      */
      public function genLogarithmic($coeff, $c=0, $dispersion=5, $scale=1) {
        $this->xArr = array(); #Clear any current data.
        $this->yArr = array();
        $x=1;
        for ($i=0; $i < $this->len; $i++){
          $this->xArr[]=$x;
          $dx = mt_rand(0,10*$scale)/10;
          $wiggle = mt_rand(-$dispersion,$dispersion)/10;
          $x = $x+$dx;
          $xw = max($x+$wiggle,.1);
          $this->yArr[] = $coeff*log10($xw)+$c;
        }
      }

      //Get the number of points in the data set
      public function length() {
        return $this->len;
      }

      //get x-value at index $n
      public function getX($n) {
        if ($n>0 and $n<$this->len) {
          return $this->xArr[$n];
        } else {
             return null;
        }
      }

      //get y-value at index $n
      public function getY($n) {
        if ($n>0 and $n<$this->len) {
          return $this->yArr[$n];
        } else {
             return null;
        }
      }

      //get x-value array
      public function getXArr(){
        return $this->xArr;
      }

      //get y-value array
      public function getYArr() {
        return $this->yArr;
      }

  }
