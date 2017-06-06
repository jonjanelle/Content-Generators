/*
* Scripts to handle the showing and hiding of the menu and
* output area of the Lorem Ipsum Text Generator
*
*/

//Ensure the number input with the given id
//is a positive integer (1 or greater)
function minInput1(id) {
    var nInput = document.getElementById(id);
    nInput.value = Math.floor(nInput.value);
    if (nInput.value < 1){ nInput.value = 1; }
}

//Validate the deviation number inputs.
function checkDev(id) {
  if (id == 'sent_dev') {
    minInput1('sent_dev');
    var sentDev = document.getElementById('sent_dev');
    var sentences = document.getElementById('num_sent');
    if (sentDev.value >= sentences.value) {
      sentDev.value = sentences.value - 1;
    }

  }
  else if (id == 'word_dev') {
    minInput1('word_dev');
    var wordDev = document.getElementById('word_dev');
    var numWords = document.getElementById('num_words');
    if (wordDev.value >= numWords.value){
      wordDev.value = numWords.value - 1;
    }
  }

}

function copyToClipboard() {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($('#lorem-text-output').text().trim()).select();
    document.execCommand("copy");
    $temp.remove();
    $('#result-header-copy').html("Copied!");
}

$(document).ready(function(){
  /*
  If output is being shown, menu starts hidden (up).
  Otherwise the menu starts visible (down).
  */
  var display = $('#ouput-div').css('display');
  if (display != 'none'){
    $('#main_form').slideUp();
    $('#open-form').show();
  } else {
    $('#main_form').slideDown();
    $('#open-form').hide();
  }

  /*
   When the top alert bar is clicked, toggle the visibility
   of the main form. Makes it slightly easier to get to the results.
  */
  $("#open-form").click(function(){
    $("#main_form").slideToggle();
  });

  /*
  Make the show/hide form bar change color on mouse enter/leave
  */
  $("#open-form").mouseenter(function(){
    $(this).removeClass("alert-info");
    $(this).addClass("alert-success");
  });

  $("#open-form").mouseleave(function(){
    $(this).removeClass("alert-success");
    $(this).addClass("alert-info");
  });


  //Enable glyphicon tooltips
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });

});
