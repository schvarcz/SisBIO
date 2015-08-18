
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
                        console.log(data);
                    }
                });
        });
    });
})(jQuery);

var idTipoOrganismo = null;
var opened = false;

var methodsMetodo = {
    open: function () {
        if (opened == false) {
            opened = true;
            var hasWidget = false;
            var soma = 0;
            $($(".plus-coleta").coletaPlus("countTipoOrganismo")).each(function(idx,val){ soma += val; });
            console.log(soma);
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
        idTipoOrganismo = e.params.data.idTipoOrganismo;
        $(".plus-coleta").coletaPlus("updateTipoOrganismo", idTipoOrganismo);
        $("#coleta-idpesquisadores, .plus-coleta-input").prop("disabled", false);
        $('.plus-coleta-input').val(null).trigger("change");
    }, 
    unselect: function () {
        idTipoOrganismo=null;
        $('.plus-coleta').coletaPlus('updateTipoOrganismo', idTipoOrganismo);
        $('#coleta-idpesquisadores, .plus-coleta-input').prop('disabled', true);
        $('.plus-coleta-input').val(null).trigger("change"); 
    }
}

