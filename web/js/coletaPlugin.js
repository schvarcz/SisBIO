
(function ($) {

    var settings = {
        container: ".coletaItensContainer",
        inputName: "especie_add",
        postVar: "idEspecie",
        ajax: {
            url: "http://localhost/sisbio/web/coleta/addatributosespecie"
        }
    };

    var methods = {
        init: function($this){
            $this.click(methods.add);
        },
        add: function(){
            var id = $("input[name="+settings.inputName+"]").val();
            var $exist = $("#coletaitem-idespecie[value="+id+"]");
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
            $.ajax($.extend(settings.ajax,{
                data: settings.postVar+"="+id,
                success:methods.successAjax
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
        successAjax: function(data,status,jqXHR){
            var $data = $(data);
            $(settings.container).append($data);
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
            settings = $.extend(settings, options);
            methods.init(this);
            return this;
        }
    }

})(jQuery);