$(".z-main").on( "click", function() {
    id = $(this).data("id");
    $(".z-sub-"+id).toggle();
});