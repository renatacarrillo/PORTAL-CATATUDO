$(document).ready(function () {
  $('form[name="form-feed"]').submit(function (event) {
    event.preventDefault();

    var action = $(this).attr("data-action");

    var botao = $(this).find(":button");

    var buttonSubmit = $(this).find("#btnSubmit");
    var descButton = buttonSubmit.html();
    var title = $(this).find("input[name='title']").val();
    var subtitle = $(this).find("input[name='subtitle']").val();
    var body = $(this).find("textarea[name='body']").val();
    var source = $(this).find("input[name='source']").val();
    var image = $(this).find("input[name='image']").val();
    var link = $(this).find("input[name='link']").val();
    var active = $(this).find("input:radio:checked").val();
    var tag = $(this).find("select[name='tag']").val();
    var feedId = $(this).find("input[name='feedId']").val();

    var formFeed = this;

    // console.table({ title, subtitle, body, source, image, link, tag, active });
    $.ajax({
      url: "../administration/controllers/c_feeds.php",
      type: "POST",
      data: {
        action: action,
        title,
        subtitle,
        body,
        source,
        image,
        link,
        tag,
        active,
        feedId,
      },
      beforeSend: function () {
        buttonSubmit
          .html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Salvando...'
          )
          .attr("disabled", true);
      },
    })
      .done(function (retorno) {
        var result = JSON.parse(retorno);
        if (result.code == 201) {
          toastr.success(result.description, "Sucesso");
          if (action == "addNewFeed") {
            formFeed.reset();
          }
        } else if (result.code == 500) {
          toastr.error(result.description, "Erro");
        } else {
          toastr.warning(result.description, "Alerta");
        }
      })
      .fail(function (jqXHR, textStatus, msg) {
        toastr.error(msg, "Erro!");
      })
      .always(function () {
        buttonSubmit.attr("disabled", false).html(descButton);
      });

    // $.post(
    //   "../administration/controllers/c_feeds.php",
    //   {
    //     action: action,
    //     title,
    //     subtitle,
    //     body,
    //     source,
    //     image,
    //     link,
    //     tag,
    //     active,
    //     feedId,
    //   },
    //   function (retorno) {
    //     var result = JSON.parse(retorno);
    //     if (result.code == 201) {
    //       toastr.success(result.description, "Sucesso");
    //       if (action == "addNewFeed") {
    //         formFeed.reset();
    //       }
    //     } else if (result.code == 500) {
    //       toastr.error(result.description, "Erro");
    //     } else {
    //       toastr.warning(result.description, "Alerta");
    //     }
    //   }
    // );
  });

  /**Deletar um endereço */
  $(".form-feed").on("click", "#deleteFeed", function () {
    var formFeed = $(this).parents("form");
    var feedId = formFeed.find("input[name='feedId']").val();

    $("#modalAlert").modal();

    $("#modalAlert").on("click", "#confirmed", function (event) {
      event.preventDefault();
      var buttonDel = $(this);

      $.ajax({
        url: "../administration/controllers/c_feeds.php",
        type: "POST",
        data: {
          action: "deleteFeed",
          feedId: feedId,
        },
        beforeSend: function () {
          buttonDel
            .html(
              '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde...'
            )
            .attr("disabled", true);
        },
      })
        .done(function (retorno) {
          buttonDel.attr("disabled", false).html("Confirma");
          var result = JSON.parse(retorno);
          if (result.code == 201) {
            $("#modalAlert").modal("hide");
            toastr.success(result.description, "Sucesso!");
            setTimeout(function () {
              $(location).attr("href", "feeds.php");
            }, 1000);
          } else {
            toastr.warning(result.description, "Alerta!");
          }
        })
        .fail(function (jqXHR, textStatus, msg) {
          toastr.error(textStatus, "Erro!");
        });
    });
    return false;
  });
});
