$(document).ready(function () {
  listFeeds();

  /**Função para listar os feeds */
  function listFeeds(page = 1) {
    var load = $("#loading");
    $.ajax({
      url: "../administration/controllers/c_feeds.php",
      type: "POST",
      data: {
        action: "listFeeds",
        page: page,
        limit: 10,
      },
      beforeSend: function () {
        load.fadeIn("fast");
      },
    })
      .done(function (response) {
        let retorno = JSON.parse(response);
        if (retorno.code == 200) {
          $("#bodyFeeds").html(retorno.html);
        }
      })
      .fail(function (jqXHR, textStatus, msg) {
        toastr.error(msg, "Erro!");
      })
      .always(function () {
        load.fadeOut("fast");
      });
  }
});
