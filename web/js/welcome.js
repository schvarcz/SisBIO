(function($){
    function adjustWindow()
    {
        $(".window-height").css({
            minHeight: $(window).height()
        });
    }
    $(document).ready(function(){
        $(window).resize(adjustWindow);
        adjustWindow();
    });
})(jQuery);