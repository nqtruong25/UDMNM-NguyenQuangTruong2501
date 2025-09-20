jQuery(document).ready(function($){
    $(".support-toggle").click(function(){
        $(".support-box").toggle();
    });

    $(".support-header .close-btn").click(function(){
        $(".support-box").hide();
    });
});
