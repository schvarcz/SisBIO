(function($){
    var defaults = {
        infoUrl:baseUrl+"/exportacao/exportacao-info"
    };
    var interval;
    var methods = {
        init: function ($this) {
            
            if ($this.html() !== "100%")
            {
                interval = setInterval(function(){methods.updateBar($this);},1000);
                $this.data("interval", interval);
            }
        },
        updateBar: function($this){
            var settings = $this.data("settings");
            $.getJSON(
                settings.infoUrl,
                "idExportacao="+$this.attr("data-id"),
                function(data){
                    if(data.percent==1)
                    {
                        clearInterval($this.data("interval"));
                        window.location = data.file; 
                    }
                    var percent = (data.percent*100)+"%";
                    $this.css({width: percent});
                    $this.html(percent);
                }
            );
        }
    };
    
    var publicMethods = {
    };

    $.fn.exportingloadbar = function (options) {
        if (publicMethods[options])
        {
            return publicMethods[options].apply(this,Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof options === 'object' || ! options ) 
        {
            var settings = $.extend({},defaults,options);
            $(this).data("settings", settings);
            methods.init(this);
            return this;
        }
    };
})(jQuery);