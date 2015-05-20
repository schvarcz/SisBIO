
(function($){
    $(document).ready(function(){
        $("#coleta-idunidadegeografica").change(function(){
            if ($(this).val() == "")
                $(".maps").gmaps("clear");
            else
                $.ajax({
                    url: "http://localhost/sisbio/web/unidade-geografica/ugpolygon",
                    dataType: "json",
                    data: "idUnidadeGeografica="+$(this).val(),
                    success: function(data){
                        $(".maps").gmaps("updateMapByArray",data.results.type,data.results.coords);
                        console.log(data);
                    }
                });
        });
    });
})(jQuery);