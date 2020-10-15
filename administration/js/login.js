$(document).ready(function () {
  $('form[name="form_login"]').submit(function (event) {
    event.preventDefault();
    var form = $(this);
    var botao = $(this).find(":button");
    var lEmail = $(this).find("input[name='email']").val();
    var lPass = $(this).find("input[name='password']").val();
    var lRemember = $(this).find("input[name='remember']:checked").val()
      ? true
      : false;

    $.ajax({
      url: "../administration/controllers/c_login.php",
      type: "POST",
      data: {
        action: "login",
        email: lEmail,
        password: lPass,
        remember: lRemember,
      },
      beforeSend: function () {
        botao
          .html(
            '<span class="spinner-border spinner-border" role="status" aria-hidden="true"></span> Validando o usuário...'
          )
          .attr("disabled", true);
        $(".load").fadeIn("slow");
      },
    })
      .done(function (msg) {
        var retorno = JSON.parse(msg);

        if (retorno.code == 500) {
          toastr.error(retorno.message, "Erro");
        } else if (retorno.code != 200) {
          toastr.warning(retorno.message, "Alerta!");
        } else {
          /**LOGIM COM SUCESSO */
          form.fadeOut("fast", function () {
            toastr.success("Bem vindo!", "Sucesso!");
          });
          /**Redireciona para home admim */
          setTimeout(function () {
            $(location).attr("href", "dashboard.php");
          }, 900);
        }
      })
      .fail(function (jqXHR, textStatus, msg) {
        toastr.error(msg, "Erro");
      })
      .always(function () {
        $(".load").fadeOut("slow", function () {
          botao.attr("disabled", false).html("Entrar");
        });
      });
  });
});
