$(document).ready(function () {
  var btnTodos = $("#todos");
  var btnColetores = $("#coletores");
  var btnGeradores = $("#geradores");
  var btnAddUser = $("#btnAddUser");

  /**Chamar a função quando carregar apagina */
  listUsers();

  /**filtar os usuarios */
  btnGeradores.click(function () {
    listUsers("gerador");
  });

  btnColetores.click(function () {
    listUsers("coletor");
  });

  btnTodos.click(function () {
    listUsers("null");
  });

  btnAddUser.click(function () {
    $("#modalCreateUser").modal({ backdrop: "static" });
  });

  $("#modalCreateUser").on("submit", 'form[name="form-cadastro"]', function (
    event
  ) {
    event.preventDefault();
    var uEmail = $(this).find("input[name='email']").val();
    var uName = $(this).find("input[name='name']").val();
    var uPass = $(this).find("input[name='password']").val();
    var uPhone = $(this).find("input[name='phone']").val();
    var formUser = this;
    $.post(
      "../administration/controllers/c_users.php",
      {
        action: "addNewUser",
        email: uEmail,
        name: uName,
        phone: uPhone,
        password: uPass,
      },
      function (retorno) {
        var result = JSON.parse(retorno);
        if (result.code == 201) {
          $("#modalCreateUser").modal("hide");
          toastr.success("Usuário Cadastrado com sucesso!", "Sucesso");
          formUser.reset();
        } else if (result.code == 500) {
          toastr.error("Não foi possivel cadastrar o usuário", "Erro");
        } else {
          toastr.warning(result.description, "Alerta");
        }
      }
    );
  });

  /**Função para listar os usuarios */
  function listUsers(profile = "null", page = 1) {
    var load = $("#loading");
    $.ajax({
      url: "../administration/controllers/c_users.php",
      type: "POST",
      data: {
        action: "listUsers",
        profile: profile,
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
          $("#pagination").html(
            getPagintarion(retorno.totalPages, retorno.page)
          );
          $("#tbodyUsers").html(retorno.html);
        }
      })
      .fail(function (jqXHR, textStatus, msg) {
        toastr.error(msg, "Erro");
      })
      .always(function () {
        load.fadeOut("fast");
      });
  }

  /** carregar a pagina selecionada ao clicar */
  $("#pagination").on("click", "li", function () {
    $("#pagination li").removeClass("active");
    $(this).addClass("active");

    //Loading Data
    var pageNum = $(this).attr("data-page");
    listUsers(null, pageNum);
  });

  function getPagintarion(totalPages, pageAtual) {
    let pagination = "";
    // var pagination =
    //   '<li class="page-item" id="1"><a class="page-link" >Primeiro</a></li>';

    let nextPage = pageAtual > 10 ? pageAtual : 1;

    for (let i = nextPage; i <= totalPages || i > 10; i++) {
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
