$(document).ready(function () {
  /**Atualizar informações do perfil */
  $('form[name="form-profile"]').submit(function (event) {
    event.preventDefault();

    var load = $("#loading");

    var saveButton = $(this).find("#salvar");
    var luserId = $(this).find("input[name='userId']").val();
    var uEmail = $(this).find("input[name='email']").val();
    var uName = $(this).find("input[name='name']").val();
    var uPhone = $(this).find("input[name='phone']").val();
    var uIsCollector =
      $(this).find("input:radio:checked").val() == "coletor" ? true : false;
    var uIsAdmin = $(this).find("input:checkbox[name='isAdmin']:checked").val()
      ? true
      : false;

    $.ajax({
      url: "../administration/controllers/c_users.php",
      type: "POST",
      data: {
        action: "alterUser",
        userId: luserId,
        email: uEmail,
        name: uName,
        phone: uPhone,
        isCollector: uIsCollector,
        isAdmin: uIsAdmin,
      },
      beforeSend: function () {
        saveButton
          .html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Atualizando o perfil...'
          )
          .attr("disabled", true);
      },
    })
      .done(function (retorno) {
        saveButton.attr("disabled", false).html("Salvar Alterações");
        var result = JSON.parse(retorno);
        if (result.code == 201) {
          toastr.success("Informações do perfil atualizadas", "Sucesso!");
        } else {
          toastr.warning(
            "Não foi possível alterar as informações no momento",
            "Alerta!"
          );
        }
      })
      .fail(function (jqXHR, textStatus, msg) {
        toastr.error(textStatus, "Erro!");
      });
  });

  /**Atualizar as informações do endereço */
  $("#listAddresses").on("submit", 'form[name="form-address"]', function (
    event
  ) {
    event.preventDefault();

    if ($(this).find("input").prop("readonly")) {
      $(this).find("input").attr("readonly", false);
      $(this).find(".btn-pri").fadeOut("fast");
      $(this).find(".btn-sec").fadeIn("slow");
    } else {
      var lcodAddress = $(this).find("input[name='codAddress']").val();
      var luserId = $(this).find("input[name='userId']").val();

      var lstreet = $(this).find("input[name='street']").val();
      var lnumber = $(this).find("input[name='number']").val();
      var lcomplement = $(this).find("input[name='complement']").val();
      var lneighborhood = $(this).find("input[name='neighborhood']").val();
      var lcity = $(this).find("input[name='city']").val();
      var lstate = $(this).find("input[name='state']").val();
      var lzipCode = $(this).find("input[name='zipCode']").val();

      var form = $(this).find("input");
      var btnSec = $(this).find(".btn-sec");
      var btnPri = $(this).find(".btn-pri").fadeIn("slow");

      $.post(
        "../administration/controllers/c_users.php",
        {
          action: "alterAddress",
          codAddress: lcodAddress,
          street: lstreet,
          number: lnumber,
          complement: lcomplement,
          neighborhood: lneighborhood,
          city: lcity,
          state: lstate,
          zipCode: lzipCode,
          userId: luserId,
        },
        function (retorno) {
          var result = JSON.parse(retorno);
          if (result.code == 201) {
            form.attr("readonly", true);
            btnSec.fadeOut("fast");
            btnPri.fadeIn("slow");
            toastr.success("Endereço alterado com sucesso", "Sucesso");
          } else {
            toastr.error("Não foi possível alterar o endereço", "Erro");
          }
        }
      );
    }
  });

  /** cancelar a edição do endereço */
  $("#listAddresses").on("reset", 'form[name="form-address"]', function () {
    $(this).find("input").attr("readonly", true);
    $(this).find(".btn-sec").fadeOut("fast");
    $(this).find(".btn-pri").fadeIn("slow");
  });

  /**Deletar um endereço */
  $("#listAddresses").on("click", "#deleteAddress", function () {
    var formAddress = $(this).parents("form");
    var lcodAddress = formAddress.find("input[name='codAddress']").val();
    var luserId = formAddress.find("input[name='userId']").val();
    var buttonDel = $(this);

    $("#modalAlert").modal();

    $("#modalAlert").on("click", "#confirmed", function (event) {
      $("#modalAlert").modal("hide");
      event.preventDefault();

      $.ajax({
        url: "../administration/controllers/c_users.php",
        type: "POST",
        data: {
          action: "deleteAddress",
          codAddress: lcodAddress,
          userId: luserId,
        },
        beforeSend: function () {
          buttonDel
            .html(
              '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Aguarde...'
            )
            .attr("disabled", true);
        },
      })
        .done(function (retorno) {
          buttonDel.attr("disabled", false).html("Excluir");
          var result = JSON.parse(retorno);
          if (result.code == 204) {
            formAddress.fadeOut(400, function () {
              $(this).remove();
              toastr.success("Endereço Excluido com sucesso", "Sucesso!");
            });
          } else {
            toastr.warning(
              "Não foi possível excluir o endereço no momento",
              "Alerta!"
            );
          }
        })
        .fail(function (jqXHR, textStatus, msg) {
          toastr.error(msg, "Erro!");
        });
    });
    return false;
  });

  /**Cadastrar um novo endereço */
  $("#newAddress").click(function () {
    $("#modalAddAddress").modal({ backdrop: "static" });
  });

  $("#modalAddAddress").on("submit", 'form[name="form-addAddress"]', function (
    event
  ) {
    event.preventDefault();

    var luserId = $(this).find("input[name='userId']").val();
    var lstreet = $(this).find("input[name='street']").val();
    var lnumber = $(this).find("input[name='number']").val();
    var lcomplement = $(this).find("input[name='complement']").val();
    var lneighborhood = $(this).find("input[name='neighborhood']").val();
    var lcity = $(this).find("input[name='city']").val();
    var lstate = $(this).find("input[name='state']").val();
    var lzipCode = $(this).find("input[name='zipCode']").val();
    var formAddress = this;

    $.post(
      "../administration/controllers/c_users.php",
      {
        action: "addNewAddress",
        street: lstreet,
        number: lnumber,
        complement: lcomplement,
        neighborhood: lneighborhood,
        city: lcity,
        state: lstate,
        zipCode: lzipCode,
        userId: luserId,
      },
      function (retorno) {
        if (retorno) {
          formAddress.reset();
          $("#notAddress").remove();
          $("#listAddresses").append(retorno);
          toastr.success("Endereço cadastrado com sucesso", "Sucesso");
        } else {
          toastr.error(
            "Não foi possível cadastrar o endereço, por favor tente mais tarde",
            "Erro"
          );
        }
      }
    );
  });

  /** alterar a senha do usuario */
  $("#resetPassword").click(function () {
    $("#modalAlterPass").modal({ backdrop: "static" });
  });

  $("#modalAlterPass").on("submit", 'form[name="form-alterPass"]', function (
    event
  ) {
    event.preventDefault();
    var LPass = $(this).find("input[name='password']").val();
    var lUserId = $(this).find("input[name='userId']").val();

    $.post(
      "../administration/controllers/c_users.php",
      {
        action: "alterPassword",
        userId: lUserId,
        password: LPass,
      },
      function (retorno) {
        if (retorno == 201) {
          $("#modalAlterPass").modal("hide");
          toastr.success("Senha alterada com sucesso", "Sucesso");
        } else {
          toastr.error("Não foi possivel alterar a senha", "Erro");
        }
      }
    );
    this.reset();
  });
});
