
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


function UpdateVisibleAttributes(e)
{
    $checkboxes = $(this).parents(".modal-content").find("input[type=checkbox]");
    for(idx in $checkboxes)
    {
        val = $($checkboxes[idx]).val();
        if ($checkboxes[idx].checked)
            $(".idDescritor[value="+val+"]").parent().fadeIn();
        else
            $(".idDescritor[value="+val+"]").parent().fadeOut();
    }
}