
(function ($) {
    $(".plus-permissao").click(function () {
        var id = $("select[name=pesquisador_add]").val();
        var $exist = $(".pesquisadoresPermissao").find("input[type=hidden]").filter("[value=" + id + "]");
        if ($exist.size() == 0)
        {
            $.ajax({
                url: "/sisbio/web/projeto/addpermissao",
                data: "idPesquisador=" + id,
                success: function (data, status, jqXHR) {
                    $(".pesquisadoresPermissao").append(data);
                }
            });
        }
    });
})(jQuery);