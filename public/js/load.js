

$(document).ready(function(){
    $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
});


$(document).ready(function(){
    $(document).ajaxStart(function(){
        $("#wait2").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait2").css("display", "none");
    });
});