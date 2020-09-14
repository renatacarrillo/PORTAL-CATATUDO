$(document).ready(function () {
  /* Section para cadastro */
  var slidebar_width = 500; //tamamho do slide
  var slide_bar = $(".side-registrer"); //slidebar
  var slide_open_btn = $(".slide-register-open");
  var slide_close_btn = $(".slide-register-close");
  var overlay = $(".side-section-overlay");
  var container = $("#section-register");

  slide_open_btn.click(function (e) {
    e.preventDefault();
    slide_bar.css({ right: "0px" }); //lado que o menu vai abrir
    overlay.css({ opacity: "1", width: "100%" });
  });
  slide_close_btn.click(function (e) {
    e.preventDefault();
    slide_bar.css({ right: "-" + slidebar_width + "px" }); //lado que o menu vai fechar
    overlay.css({ opacity: "0", width: "0" });
    slide_open_btn.attr("aria-expanded", false);
  });

  $('form[name="form-cadastro"]').submit(function (event) {
    event.preventDefault();

    var botao = $(this).find(":button");
    var uEmail = $(this).find("input[name='email']").val();
    var uName = $(this).find("input[name='name']").val();
    var uPass = $(this).find("input[name='password']").val();
    var uPhone = $(this).find("input[name='phone']").val();

    $.ajax({
      url: "controllers/c_cadastro.php",
      type: "POST",
      data: {
        action: "create",
        email: uEmail,
        name: uName,
        password: uPass,
        phone: uPhone,
      },
      beforeSend: function () {
        botao.html("Aguarde Carregando...").attr("disabled", true);
      },
    })
      .done(function (msg) {
        var retorno = JSON.parse(msg);
        if (retorno.code == 201) {
          msgSucesso(uName);
        } else {
          msgReponse(retorno.description, "error");
        }

        console.log(msg);

        botao.attr("disabled", false).html("CADASTRAR");
      })
      .fail(function (jqXHR, textStatus, msg) {
        alert(msg);
      });

    function msgReponse(msg, type) {
      var response = $("#feedResponse");
      var type =
        type === "sucess"
          ? "sucess"
          : type === "alert"
          ? "warning"
          : type === "error"
          ? "danger"
          : type === "info"
          ? "info"
          : "dark";

      response.empty().fadeOut("fast", function () {
        return $(this)
          .html(
            '<div class="alert alert-' +
              type +
              '" role="alert">' +
              msg +
              "</div>"
          )
          .fadeIn("slow");
      });

      setTimeout(function () {
        response.fadeOut("slow");
      }, 6000);
    }

    function msgSucesso(userName) {
      var nameArray = userName.split(" ");
      container.empty().fadeOut("fast", function () {
        return $(this)
          .html(
            '<div class="mt-5" >' +
              "<p class='text-center'><i class='fa fa-check-circle'></i></p>" +
              "<h2>Obrigado " +
              nameArray[0] +
              ", o seu cadastro foi realizado com Sucesso!</h2>" +
              "<p>Agora é só baixar nosso aplicatico, separar os reciclaveis e solicitar a coleta!" +
              "</div>"
          )
          .fadeIn("slow");
      });
    }
  });
});
