
(function ($) {
    $(document).ready(function () {
        $("#coleta-idunidadegeografica").change(function () {
            if ($(this).val() == "")
                $(".maps").gmaps("clear");
            else
                $.ajax({
                    url: "/sisbio/web/unidade-geografica/ugpolygon",
                    dataType: "json",
                    data: "idUnidadeGeografica=" + $(this).val(),
                    success: function (data) {
                        $(".maps").gmaps("updateMapByArray", data.results.type, data.results.coords);
                    }
                });
        });
    });
})(jQuery);

var opened = false;

var methodsMetodo = {
    open: function () {
        if (opened == false) {
            opened = true;
            var hasWidget = false;
            var soma = 0;
            $($(".plus-coleta").coletaPlus("countTipoOrganismo")).each(function(idx,val){ soma += val; });
            hasWidget = (soma !== 0);
            if( hasWidget )
            {
                alert("Atencão!\n\n"+
                        "Você já adicionou espécies vinculadas ao tipo de organismo coletado por este método.\n\n"+
                        "Se você alterar o método de coleta para o de outro tipo de organismo, as espécies já registradas serão perdidas.");
            }
        }
    }, 
    close: function () {
        opened = false;
    }, 
    select: function (e) {
        var idTipoOrganismo = e.params.data.idTipoOrganismo;
        $("#coleta-idtipoorganismo").val(idTipoOrganismo);

        $(".plus-coleta").coletaPlus("updateTipoOrganismo", idTipoOrganismo);
        $(".plus-coleta-input").prop("disabled", false);
        $('.plus-coleta-input').val(null).trigger("change");
    }, 
    unselect: function () {
        var idTipoOrganismo=null;
        $("#coleta-idtipoorganismo").val(idTipoOrganismo);
        $('.plus-coleta').coletaPlus('updateTipoOrganismo', idTipoOrganismo);
        $('.plus-coleta-input').prop('disabled', true);
        $('.plus-coleta-input').val(null).trigger("change"); 
    }
}

var methodsProjeto = {
    select: function (e) {
        $("#coleta-idunidadegeografica").prop("disabled", false);
        $('#coleta-idunidadegeografica').val(null).trigger("change");
    }, 
    unselect: function () {
        $('#coleta-idunidadegeografica').prop('disabled', true);
        $('#coleta-idunidadegeografica').val(null).trigger("change"); 
    }
}

