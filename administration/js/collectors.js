$(document).ready(function () {
  listPendingApproval();

  /**Função para listar as solicitações de aprovaçãod e coletor */
  function listPendingApproval(status = 1) {
    var load = $("#loading");
    $.ajax({
      url: "../administration/controllers/c_collectors.php",
      type: "POST",
      data: {
        action: "pendingApproval",
        status: status,
      },
      beforeSend: function () {
        load.fadeIn("fast");
      },
    })
      .done(function (response) {
        let retorno = JSON.parse(response);
        if (retorno.code == 200) {
          $("#tbodyCollectors").html(retorno.table);
        }
      })
      .fail(function (jqXHR, textStatus, msg) {
        toastr.error(msg, "Erro");
      })
      .always(function () {
        load.fadeOut("fast");
      });
  }

  /**Aprovar a solicitação de coletor */
  $("#tbodyCollectors").on("click", "#btnAprovar", function () {
    var _userId = $(this).attr("data-id");
    var botao = $(this);
    var trDetails = $(this).parents("tr.tbLine");

    $.ajax({
      url: "../administration/controllers/c_collectors.php",
      type: "POST",
      data: {
        action: "approveRequest",
        userId: _userId,
      },
      beforeSend: function () {
        botao
          .html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
          )
          .attr("disabled", true);
      },
    })
      .done(function (response) {
        let retorno = JSON.parse(response);
        if (retorno.code == 200) {
          $(".collapse").collapse("hide");
          trDetails.fadeOut(400, function () {
            toastr.success("Novo Coletor Aprovado!", "Sucesso!");
            $(this).remove();
          });
        } else {
          toastr.warning(
            "Não foi possível realizar a aprovação no momento, tente mais tarde",
            "Alerta!"
          );
        }
      })
      .fail(function (jqXHR, textStatus, msg) {
        toastr.error(msg, "Erro");
      })
      .always(function () {
        botao
          .attr("disabled", false)
          .html('<i class="fas fa-check-circle"></i>');
      });
  });

  /**Rejeitar a solicitação de coletor */
  $("#tbodyCollectors").on("click", "#btnRejeitar", function () {
    var _userId = $(this).attr("data-id");
    var botao = $(this);
    var trDetails = $(this).parents("tr.tbLine");

    $.ajax({
      url: "../administration/controllers/c_collectors.php",
      type: "POST",
      data: {
        action: "rejectRequest",
        userId: _userId,
      },
      beforeSend: function () {
        botao
          .html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
          )
          .attr("disabled", true);
      },
    })
      .done(function (response) {
        let retorno = JSON.parse(response);
        if (retorno.code == 200) {
          $(".collapse").collapse("hide");
          trDetails.fadeOut(400, function () {
            toastr.success("Solicitação rejeitada!", "Sucesso!");
            $(this).remove();
          });
        } else {
          toastr.warning(
            "Não foi possível realizar a operação no momento, tente mais tarde",
            "Alerta!"
          );
        }
      })
      .fail(function (jqXHR, textStatus, msg) {
        toastr.error(msg, "Erro");
      })
      .always(function () {
        botao
          .attr("disabled", false)
          .html('<i class="fas fa-times-circle"></i>');
      });
  });
});
