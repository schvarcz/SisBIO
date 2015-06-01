
(function ($) {

    var settings = {
        container: ".coletaItensContainer",
        inputName: "especie_add",
        postVar: "primaryKey",
        uniqueWidget: false,
        ajax: {
            url: "http://localhost/SisBIO/web/coleta/adddescritoresespecie"
        }
    };
    var settingsInstance = {};

    var methods = {
        init: function($this){
            $this.click(methods.add);
            $this.parents("form").find(".close-btn").click(methods.remove);
        },
        add: function(){
            var set = settingsInstance[$(this).attr("id")];
            var id = $("select[name="+set.inputName+"]").val();
            if(set.uniqueWidget)
            {
                var $exist = $(set.container).find("#coletaitem-idespecie[value="+id+"]");
                if ($exist.size() != 0)
                {
                    $exist.parents("fieldset").animate({
                        opacity: 0.3
                        },500,function(){
                            $exist.parents("fieldset").animate({
                        opacity: 1
                            });
                    }); 
                    return;
                }
            }
            $.ajax($.extend(set.ajax,{
                data: set.postVar+"="+id,
                success:function(data,status,jqXHR){
                    methods.successAjax(data,status,jqXHR,set)
                }
            }));
        },
        remove: function(){
            var $fieldset = $(this).parents("fieldset");
            $fieldset.animate({
                opacity:0,
                height: 0
            },500,function(){
                $fieldset.remove();
            });
            //
        },
        successAjax: function(data,status,jqXHR,set){
            var $data = $(data);
            $(set.container).append($data);
            var height = $data.height();
            $data.css({
                opacity:0,
                height: 0
            });
            $data.find(".close-btn").click(methods.remove);
            $data.animate({
                opacity:1,
                height: height
            });
            $data.find('[data-toggle="popover"]').popover();
        }
    };
    
    var publicMethods = {
    };

    $.fn.coletaPlus = function (options) {
        if (publicMethods[options])
        {
            return publicMethods[options].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof options === 'object' || !options)
        {
            settingsInstance[$(this).uniqueId().attr("id")] = $.extend({},settings, options);
            methods.init(this);
            return this;
        }
    }

})(jQuery);