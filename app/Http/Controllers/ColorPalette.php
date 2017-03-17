<?php
/*
 * Class to model geometric color palettes relative to a base color. Currently
 * able to generate complementary, triadic, and split complementary palettes.
 *
 * Color palette geometry info from:
 * http://www.tigercolor.com/color-lab/color-theory/color-theory-intro.htm
 * HSL conversion algorithm adapted from:
 * http://www.niwa.nu/2013/05/math-behind-colorspace-conversions-rgb-hsl/
 * https://en.wikipedia.org/wiki/HSL_and_HSV
 *
 * Seems like this should be in a separate models area.
 *
 * Author: Jon Janelle
 * Created: 3/11/2017
 */
namespace App\Http\Controllers;
class ColorPalette {
  private $baseColor; //Hex color string #rrggbb

    /*
    * Construct a new ColorPalette using a hex color string
    * as a base color.
    */
    function __construct($baseColor) {
      $this->baseColor = $baseColor;
    }

    //Get current base color as hex string
    function getBaseColor() {
      return $this->baseColor;
    }

    //Set base color to new hex string.
    function setBaseColor($newBaseColor) {
      $this->baseColor = $newBaseColor;
    }

    /*
      Convert a hex string to a length 3 array of integer RGB values
      Hex string is assumed to have the format: "#RRGGBB"
    */
    function hexToRgb($color = null){
      $hexColor = $color;
      if ($color==null){
        $hexColor = $this->baseColor;
      }

      $result = array();
      for ($i=0; $i<3; $i++){
        array_push($result,hexdec(substr($hexColor,2*$i+1,2)));
      }
      return $result;
    }

    /*
      Convert a length 3 array of RGB colors to a hex string of the format
      "#RRGGBB"
    */
    function rgbToHex($colorArr) {
      if (count($colorArr)!=3) {
        return -1;
      }
      $result = '#';
      for ($i=0; $i < 3; $i++) {
        $pair = dechex($colorArr[$i]);
        //Next line needed so that leading zeros not omitted
        if (strlen($pair)==1) { $pair = '0'.$pair;}
        $result.=$pair;
      }
      return $result;
    }

    //Used http://www.niwa.nu/2013/05/math-behind-colorspace-conversions-rgb-hsl/
    //for math reference
    //Most color palettes require degree movements from either the base color
    //or its complement, which makes HSL the best option.
    function getHsl() {
      $rgb = $this->hexToRgb($this->baseColor);
      $r = $rgb[0]/255;
      $g = $rgb[1]/255;
      $b = $rgb[2]/255;
      if ($r==$b and $r==$g and $b==$g) {
        $r=abs($r-1/255); //Prevents division by 0 issues. hue can't be 0 or 360.
      }
      $min = min($r,$g,$b);
      $max = max($r,$g,$b);

      //Calculate Luminance
      $l = ($max+$min)/2;

      //Calculate saturation
      $s=0;
      if ($l > .5){
        $s=($max-$min)/(2.0-$max-$min);
      }
      else {
        $s = ($max-$min)/($max+$min);
      }
      //Calculate hue
      $h = 0;
      if ($max != $min) {
        if ($r>$b and $r>$g) {
          $h=($g-$b)/($max-$min);
        }
        else if ($g>$b and $g>$r) {
          $h= 2.0 + ($b-$r)/($max-$min);
        }
        else {
          $h = 4.0 + ($r-$g)/($max-$min);
        }
      }
      return [$h,$s,$l];
    }

    /*
     * Convert an HSL color to a hex string
     * Info about the conversion algorithm found at:
     * https://en.wikipedia.org/wiki/HSL_and_HSV
    */
    function hslToHex($hslArr) {
      $h = $hslArr[0];
      $s = $hslArr[1];
      $l = $hslArr[2];

      //Find chroma
      $c = $s*(1-abs(2*$l-1));

      $x= $c*(1-abs($h-2*floor($h/2)-1));

      $rgb1 = array();
      if (0 <= $h and $h <= 1) {
        $rgb1 = [$c, $x, 0];
      }
      else if (1 < $h and $h <= 2){
        $rgb1 = [$x, $c, 0];
      }
      else if (2 < $h and $h <=3) {
        $rgb1 = [0, $c, $x];
      }
      else if (3 < $h and $h <= 4) {
        $rgb1 = [0, $x, $c];
      }
      else if (4 < $h and $h <= 5) {
        $rgb1 = [$x, 0, $c];
      }
      else {
        $rgb1 = [$c, 0, $x];
      }
      $m = $l - 0.5*$c;

      $rgb1[0] = round(255*($rgb1[0]+$m));
      $rgb1[1] = round(255*($rgb1[1]+$m));
      $rgb1[2] = round(255*($rgb1[2]+$m));

      return $this->rgbToHex($rgb1);
    }

    /*
      Get a complementary color scheme.
      Returns a length 2 array containing the base color
      and its complement.
    */
    function getComplementary() {
      $compColors = [$this->baseColor];
      $base = $this->hexToRgb($this->baseColor);
      $base[0] = 255-$base[0]; //get complement of each color channel
      $base[1] = 255-$base[1];
      $base[2] = 255-$base[2];

      array_push($compColors, $this->rgbToHex($base));

      return $compColors;
    }

    /*
      Get a triadic color palette.
      Returns a length 3 array of colors
    */
    function getTriadic() {
      $hsl = $this->getHsl();
      //Hue is a 6-unit partition of a circle, so 2 = 120 degrees
      $h1 = round($hsl[0]+2)%6;
      $h2 = round($hsl[0]+4)%6;
      $color1 = $this->hslToHex(array($h1, $hsl[1], $hsl[2]));
      $color2 = $this->hslToHex(array($h2, $hsl[1], $hsl[2]));
      return [$this->baseColor, $color1, $color2];
    }

    /*
     * Get a split complementary color palette
     * Returns a length 3 array of colors
     * Calculation based on a 12-color wheel, so colors adjacent to the
     * base color are found via 30 degree rotations in either direction.
    */
    function getSplitComp() {
      $hsl = $this->getHsl();//Get hsl representation of $this->baseColor
      $h1 = $hsl[0]+.5; //0.5 is equivalent to 30 degrees
      $h2 = $hsl[0]-.5;
      if ($h2<0) {
        $h2 = 6+$h2; //so that 0 <= h <= 6
      }
      $color1 = $this->hslToHex(array($h1, $hsl[1], $hsl[2]));
      $color2 = $this->hslToHex(array($h2, $hsl[1], $hsl[2]));
      return [$this->getComplementary()[1], $color1, $color2];
    }

  }
