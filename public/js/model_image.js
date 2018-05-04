
$(document).ready(function(){
    var modal = $('#myModal');
    var modalImg = $("#img01");

    $('.model_image').click(function (){
        modal.css("display", "block");
        modalImg.attr('src',this.src)
    });
    $('.close').click(function(){
         modal.css("display", "none");
    })
});
