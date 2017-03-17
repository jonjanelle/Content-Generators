$(".btn-group > .btn").click(function(){
    $(this).addClass("active").siblings().removeClass("active");
    $(this).addClass("active");
});
