if (document.getElementById('myBtn')){

    var mybutton = document.getElementById("myBtn");
    var mybutton2 = document.getElementById("myBtn2");
// When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
        showButtons()
    };
}





function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton2.style.display = "block";
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
        mybutton2.style.display = "none";
    }
}

function showButtons(){
    if (window.innerWidth < 1100){
        mybutton2.style.display = "block"
        mybutton.style.display = "none"
    }else{
        mybutton2.style.display = "none"
        mybutton.style.display = "block"

    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
$(document).ready(function() {
    $(document).resize(function(){
        if ($(window).width() < 700){
            $('#myBtn2').hide()
        }
        else {
            $('#myBtn').show()
        }
    });


    /*$('[data-toggle="collapse"]').click(function() {
        $(this).toggleClass( "collapse" );
        if ($(this).hasClass("collapse")) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });*/

    $('.btn-sm').click(function() {
        if ($(this).not(":hidden")) {
            $('.btn-sm').show()
            $(this).hide();
        } else {
            $('.btn-sm').show()
            $(this).show();
        }
    });


// document ready
});
