
$(document).ready(function(){
    $(function() {
      $(".draggable").draggable();
    });


    $(".droppable").droppable({
      hoverClass: "drop-hover",
      tolerance: "touch",
      drop:function(event, ui) {
        //stuff to do here.
        
        $(this).addClass("ui-state-highlight").find("p").html("Dropped!");
      }
    });


    //http://stackoverflow.com/questions/5217311/setting-z-index-on-draggable-elements
    var a = 3;
    $(".table-container").draggable({
      start: function(event, ui) { $(this).css("z-index", a++); }
    });

    $('.droppable').click(function() {
      $(this).addClass('top').removeClass('bottom');
      $(this).siblings().removeClass('top').addClass('bottom');
      $(this).css("z-index", a++);
    });

});
