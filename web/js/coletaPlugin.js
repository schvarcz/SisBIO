
(function ($) {

    var defaults = {
        container: ".coletaItemContainer",
        modalAtributos: ".modalColetaItem",
        inputName: "especie_add",
        postVar: "primaryKey",
        uniqueWidget: false,
        uniqueId: "#coletaitem-idespecie",
        ajax: {
            url: "http://localhost/SisBIO/web/coleta/adddescritoresespecie"
        }
    };

    var methods = {
        init: function ($this) {
            var settings = $this.data("settings");
            $this.click(methods.add);
            $this.parents("form").find(".close-btn").click(methods.remove);
            $(settings.modalAtributos).find(".btn-primary").data("coleta",$this).click(methods.UpdateVisibleAttributes);
        },
        add: function () {
            var settings = $(this).data("settings");
            var id = $("select[name=" + settings.inputName + "]").val();
            if (settings.uniqueWidget)
            {
                var $exist = $(settings.container).find(settings.uniqueId + "[value=" + (isNaN(parseInt(id)) ? id.substr(1) : id) + "]");
                if ($exist.size() != 0)
                {
                    $exist.parents("fieldset").animate({
                        opacity: 0.3
                    }, 500, function () {
                        $exist.parents("fieldset").animate({
                            opacity: 1
                        });
                    });
                    return;
                }
            }
            $.ajax($.extend(settings.ajax, {
                data: settings.postVar + "=" + id,
                success: function (data, status, jqXHR) {
                    methods.successAjax(data, status, jqXHR, settings)
                }
            }));
        },
        remove: function () {
            var $fieldset = $(this).parents("fieldset");
            $fieldset.animate({
                opacity: 0,
                height: 0
            }, 500, function () {
                $fieldset.remove();
            });
        },
        successAjax: function (data, status, jqXHR, set) {
            var $data = $(data);
            $(set.container).append($data);
            var height = $data.height();
            $data.css({
                opacity: 0
            });
            $data.find(".close-btn").click(methods.remove);
            $data.animate({
                opacity: 1
            });
            $data.find('[data-toggle="popover"]').popover();
        },
        UpdateVisibleAttributes: function (){
            var settings = $(this).data("coleta").data("settings");
            console.log(settings);

            var $inputsOrganismos = $(settings.modalAtributos).find("input[name=idTipoOrganismo]");
            
            $inputsOrganismos.each(function (i, $inputOrganismo) {
                $inputOrganismo = $($inputOrganismo);
                
                var idTipoOrganismo = $inputOrganismo.val();
                var $checkboxes = $inputOrganismo.parent().find("input[type=checkbox]");

                var $fields = $(settings.container).find(".idTipoOrganismo[value=" + idTipoOrganismo + "]").parents("fieldset");
                
                $checkboxes.each(function (j, $checkbox) {

                    var val = $($checkbox).val();
                    if ($checkbox.checked)
                        $fields.find(".idDescritor[value=" + val + "]").parent().fadeIn();
                    else
                        $fields.find(".idDescritor[value=" + val + "]").parent().fadeOut();
                });

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
            var settings = $.extend({}, defaults, options);
            $(this).data("settings",settings);
            methods.init(this);
            return this;
        }
    }

})(jQuery);