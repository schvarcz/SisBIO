
(function ($) {

    var defaults = {
        container: ".coletaItemContainer",
        modalAtributos: ".modalColetaItem",
        inputName: "especie_add",
        postVar: "primaryKey",
        uniqueWidget: false,
        uniqueId: "#coletaitem-idespecie",
        ajax: {
            url: "/SisBIO/web/coleta/adddescritoresespecie"
        }
    };

    var methods = {
        init: function ($this) {
            var settings = $this.data("settings");
            $this.click(methods.add);
            $this.parents("form").find(".close-btn").click(methods.remove);
            $(settings.modalAtributos).find(".btn-primary").data("coleta", $this).click(methods.UpdateVisibleAttributes);
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
        successAjax: function (data, status, jqXHR, settings) {
            var $data = $(data);
            $(settings.container).append($data);
            $data.css({
                opacity: 0
            });
            $data.find(".close-btn").click(methods.remove);

            var idTipoOrganismo = $data.find(".idTipoOrganismo").val();
            var $inputOrganismo = $(settings.modalAtributos).find(".idTipoOrganismo[value=" + idTipoOrganismo + "]");

            var $checkboxes = $inputOrganismo.parent().find("input[type=checkbox]");

            $checkboxes.each(function (j, $checkbox) {

                var val = $($checkbox).val();
                if (!$checkbox.checked)
                    $data.find(".idDescritor[value=" + val + "]").parent().hide().find("input[type=text]").val("");
            });

            $data.animate({
                opacity: 1
            });
            $data.find('[data-toggle="popover"]').popover();
        },
        UpdateVisibleAttributes: function (e) {
            var settings = $(this).data("coleta").data("settings");

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
                        $fields.find(".idDescritor[value=" + val + "]").parent().fadeOut().find("input[type=text]").val("");
                });

            });
        }
    };

    var publicMethods = {
        updateTipoOrganismo: function(idTipoOrganismo){
            var settings = $(this).data("settings");
            var modalContainer = $(settings.modalAtributos);
            var container = $(settings.container);
            container.find(".idTipoOrganismo[value!="+idTipoOrganismo+"]").parents("fieldset").find(".close-btn").click();
            
            if (idTipoOrganismo == null)
            {
                modalContainer.find(".bg-danger").show();
                modalContainer.find(".idTipoOrganismo").parents(".panel").hide();
                return;
            }
            modalContainer.find(".idTipoOrganismo[value!="+idTipoOrganismo+"]").parents(".panel").hide();
            modalContainer.find(".idTipoOrganismo[value="+idTipoOrganismo+"]").parents(".panel").show().find(".panel-collapse").collapse("show");
            modalContainer.find(".bg-danger").hide();
        },
        countTipoOrganismo: function(){
            var settings = $(this).data("settings");
            var container = $(settings.container);
            
            return container.find(".idTipoOrganismo").length;
        }
    };

    $.fn.coletaPlus = function (options) {
        if (publicMethods[options])
        {
            var args = Array.prototype.slice.call(arguments, 1);
            var returns = [];
            this.each(function(){
                returns.push(publicMethods[options].apply(this, args));
                return returns[returns.length-1];
            });
            return returns;
        } else if (typeof options === 'object' || !options)
        {
            var settings = $.extend({}, defaults, options);
            $(this).data("settings", settings);
            methods.init(this);
            return this;
        } else if (typeof options === 'string' || !options)
        {
            var settings = $(this).data("settings");
            if (settings[options])
                return settings[options];
            return this;
        }
    }; 

})(jQuery);