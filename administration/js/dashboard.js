$(document).ready(function () {
  var _labels = [];
  var _data = [];

  var users = $("#usuarios");
  var collector = $("#coletores");
  var collections = $("#coletas");
  var finished = $("#finalizadas");

  atualizaGrafico();
  getStatistics();

  function atualizaGrafico() {
    $.post(
      "../administration/controllers/c_dashboard.php",
      {
        action: "grafic",
      },
      function (retorno) {
        var result = JSON.parse(retorno);
        if (result.code == 200) {
          _labels = result.labels;
          _data = result.data;
          gerarGrafico(_labels, _data, result.title);
        } else if (result.code == 500) {
          toastr.error(
            "No momento não foi possível carregar as estatísticas",
            "Erro"
          );
        } else {
          toastr.warning(result.description, "Alerta");
        }
      }
    );
  }

  function getStatistics() {
    $.post(
      "../administration/controllers/c_dashboard.php",
      {
        action: "geral",
      },
      function (retorno) {
        var result = JSON.parse(retorno);
        if (result.code == 500) {
          toastr.error(
            "No momento não foi possível carregar as estatísticas",
            "Erro"
          );
        } else {
          users.html(result.users);
          collector.html(result.collectors);
          collections.html(result.collections);
          finished.html(result.completedCollections);
        }
      }
    );
  }

  /**grafico */
  function gerarGrafico(labels, data, title = "Coletas no periodo") {
    var ctx = $("#myChart");
    var myChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: labels,
        datasets: [
          {
            label: "Total",
            data: data,
            lineTension: 0,
            backgroundColor: "transparent",
            borderColor: "#14a949",
            borderWidth: 4,
            pointBackgroundColor: "#000",
          },
        ],
      },
      options: {
        responsive: true,
        legend: {
          display: false,
          position: "left",
          align: "end",
          labels: {
            fontColor: "rgb(255, 99, 132)",
            position: "left",
          },
        },
        title: {
          display: true,
          text: title,
          position: "top",
          lineHeight: 1,
        },
        scales: {
          yAxes: [
            {
              scaleLabel: {
                display: true,
                labelString: "Quantidade de Coletas",
              },
              ticks: {
                beginAtZero: true,
              },
            },
          ],
          xAxes: [
            {
              scaleLabel: {
                display: true,
                labelString: "Dia do Mês",
              },
              ticks: {
                beginAtZero: false,
              },
            },
          ],
        },
      },
    });
  }
});
