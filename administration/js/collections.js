$(document).ready(function () {
  listCollections();

  /**Função para listar os coletas */
  function listCollections(status = null, page = 1) {
    var load = $("#loading");
    $.ajax({
      url: "../administration/controllers/c_collections.php",
      type: "POST",
      data: {
        action: "listCollections",
        status: status,
        page: page,
        limit: 10,
      },
      beforeSend: function () {
        load.fadeIn("fast");
      },
    })
      .done(function (response) {
        let retorno = JSON.parse(response);
        // let retorno = response;

        if (retorno.code == 200) {
          $("#pagination").html(
            getPagination(retorno.totalPages, retorno.page)
          );
          $("#tbodyCollections").html(retorno.table);
        }
      })
      .fail(function (jqXHR, textStatus, msg) {
        toastr.error(msg, "Erro");
      })
      .always(function () {
        load.fadeOut("fast");
      });
  }

  $("#tbodyCollections").on("click", ".btn-view", function () {
    var Id = $(this).attr("data-id");
    var conteudo = $(".modal-body");

    $.post(
      "../administration/controllers/c_collections.php",
      { action: "detailsCollect", collectId: Id },
      function (retorno) {
        $("#collectDetails").modal({ backdrop: "static" });
        conteudo.html(retorno);
      }
    );

    return false;
  });

  /** carregar a pagina selecionada ao clicar */
  $("#pagination").on("click", "li", function () {
    $("#pagination li").removeClass("active");
    $(this).addClass("active");

    //Loading Data
    var pageNum = $(this).attr("data-page");
    listCollections(null, pageNum);
  });

  function getPagination(totalPages, pageAtual) {
    let pagination = "";
    let nextPage = 1;

    if (pageAtual > 3) {
      pagination +=
        '<li class="page-item" id="1"><a class="page-link" >Primeiro</a></li>';
      nextPage = pageAtual;
    }
    // var pagination =
    //   '<li class="page-item" id="1"><a class="page-link" >Primeiro</a></li>';

    for (let i = nextPage; i <= totalPages; i++) {
      if (pageAtual == i) {
        pagination +=
          '<li class="page-item active" data-page=' +
          i +
          ' ><a class="page-link">' +
          i +
          "</a></li>";
      } else if (i == totalPages) {
        pagination +=
          '<li class="page-item" data-page=' +
          totalPages +
          '><a class="page-link" href="#">Ultimo</a></li>';
      } else {
        pagination +=
          '<li class="page-item" data-page=' +
          i +
          ' href = "#" ><a class="page-link">' +
          i +
          "</a></li>";
      }
    }
    // if (pageAtual <= totalPages - 2)
    //   pagination +=
    //     '<li class="page-item" data-page=' +
    //     totalPages +
    //     '><a class="page-link" href="#">Ultimo</a></li>';
    return pagination;
  }
});
