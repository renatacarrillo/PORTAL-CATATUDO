<!-- 
    Archive: index.php
    Author: Reginaldo Cardoso Domingos / Renata Carrillo / Thais Machado Oliveira
    Since: 2020/05/25
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CATATUDO - Portal</title>
    <meta name="author" content="Renata">
    <link rel="icon" href="./IMAGENS/RECICLAGEM.png" alt="Logotipo CATATUDO">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">

    <!-- Icones -->
    <script src="https://kit.fontawesome.com/d7ddfb275f.js" crossorigin="anonymous"></script>
    <!-- CSS padrão -->
    <link rel="stylesheet" href="css/style.css">
    <!-- FONTE MONTSERRAT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

</head>

<body class='container-fluid'>
    <!-- INCLUINDO O HEADER -->
    <?php include "includes/header.php" ?>

    <nav class="mt-5 mb-5">
        <div class="container fundo-verde">
            <div class="col-sm">
                <img src="./IMAGENS/businessinsider.png" class="img-garrafa" alt="Imagem de uma garrafa no mar">
            </div>
            <div class="row">
                <div class="col-sm fundo-escuro">
                </div>
                <div class="col-sm fundo-cinza">
                    <h1 class="font-weight-bold text-princ ml-3">O planeta ainda pode ser RECICLADO</h1>
                    <h3 class="corverde ml-3 mt-5">Você também pode ajudar a salvar o planeta, é só baixar o aplicativo
                        nas lojas:</h3>
                    <div class="row taman mt-5 mr-1">
                        <div class="col-sm-6 tam-play-nav">
                            <a href="https://play.google.com/store/"><img src="./IMAGENS/playstore.png"
                                    class="img-fluid"></a>
                        </div>
                        <div class="col-sm-6 tam-app-nav">
                            <a href="https://www.apple.com/br/ios/app-store/"><img src="./IMAGENS/appstore.png"
                                    class="img-fluid"></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                </div>
            </div>
        </div>
    </nav>

    <!-- SECTION VEJA COMO FUNCIONA -->
    <section>
        <div class="container esp-caixas esp-nav-home">
            <div class="row">
                <div class="col-sm">
                    <h1 class="teste text-center"> VEJA COMO FUNCIONA </h1>
                    <hr>
                    </hr>
                </div>
            </div>

            <div class="row efeito2">
                <div class="col-sm-4 ml-5 mr-5 esp-caixas">
                    <h3 class="sombreamento-text">CADASTRO</h3>
                    <hr>
                    </hr>
                    <h5 class="square-color">Você faz o cadastro no site e baixa o aplicativo nas lojas.</h5>
                </div>

                <div class="row">
                    <div class="col-sm ml-5 mr-5">
                        <ul class="square mr-4">
                            <h1 class="mb-4">01</h1>
                            <h5>
                                <li class="square-color">Totalmente Rápido</li>
                                <li class="square-color">Totalmente Prático</li>
                                <li class="square-color">Totalmente Seguro</li>
                            </h5>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-sm ml-5 esp-caixas">
                            <i class="fas fa-address-book posi-mob-ind"></i>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row efeito2">
                <div class="col-sm-4 ml-5 mr-5 esp-caixas">
                    <h3 class="sombreamento-text">AGENDAMENTO</h3>
                    <hr>
                    </hr>
                    <h5 class="square-color">Você separa o lixo reciclável e pelo aplicativo agenda uma data para o
                        coletor ir buscar.</h5>
                </div>


                <div class="row">
                    <div class="col-sm ml-5 mr-5">
                        <ul class="square mr-4">
                            <h1 class="mb-4">02</h1>
                            <h5>
                                <li class="square-color">Ferramenta Simples</li>
                                <li class="square-color">Muito Eficiente</li>
                                <li class="square-color">Rápido</li>
                            </h5>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-sm ml-4 esp-caixas">
                            <i class="far fa-calendar-check posi-mob-ind"></i>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row efeito2">
                <div class="col-sm-4 ml-5 mr-5 esp-caixas esp-caixas-b">
                    <h3 class="sombreamento-text">PRONTO!</h3>
                    <hr>
                    </hr>
                    <h5 class="square-color">Você separa o lixo reciclável e aguarda um coletor ir fazer a retirada.
                    </h5>
                </div>

                <div class="row">
                    <div class="col-sm ml-5 mr-5">
                        <ul class="square mr-4">
                            <h1 class="mb-4">03</h1>
                            <h5>
                                <li class="square-color">Apoie a Causa</li>
                                <li class="square-color">Beneficie Coletores</li>
                                <li class="square-color">Ajude o Planeta</li>
                            </h5>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-sm ml-4 esp-caixas">
                            <i class="fas fa-globe-americas posi-mob-ind-ul"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- NAV PARCEIROS -->
    <nav class="esp-nav-home">
        <div class="container">
            <div class="row">
                <div class="col-sm esp-caixas-b tam-mob-ind">
                    <h1 class="teste text-center"> PARCEIROS </h1>
                    <hr>
                    </hr>

                    <div class="row mt-5 cor-nav-home">
                        <div class="col-sm tam-mob-ind-li">
                            <h3 class="mt-5 mb-5 ml-1 sombreamento-text-nav">MORADORES</h3>
                            <i class="efeito fas fa-users icons-nav-green ml-5 mb-5"></i>
                        </div>

                        <div class="vl mr-5"></div>

                        <div class="col-sm tam-mob-ind-lix">
                            <h3 class="mt-5 mb-5 ml-1 sombreamento-text-nav">COLETORES</h3>
                            <i class="efeito fas fa-trash-alt icons-nav ml-5 mb-5"></i>
                        </div>

                        <div class="vl mr-5"></div>

                        <div class="col-sm tam-mob-ind-lix">
                            <h3 class="mt-5 mb-5 ml-1 sombreamento-text-nav">PREFEITURA</h3>
                            <i class="efeito fas fa-archway icons-nav-green ml-5 mb-5"></i>
                        </div>

                        <div class="vl mr-5"></div>

                        <div class="col-sm tam-mob-ind-lix">
                            <h3 class="mt-5 mb-5 ml-1 sombreamento-text-nav">INDÚSTRIAS</h3>
                            <i class="efeito fas fa-city icons-nav ml-5 mb-5"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>

    <!-- NAV INF -->
    <nav class="esp-nav-dois-home">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1 class="teste text-center">O CATATUDO É O PORTAL PARA AJUDAR NO CONTROLE DO LIXO RECICLÁVEL</h1>
                    <hr>
                    </hr>

                    <div class="row">
                        <div class="col-sm esp-nav-dois-home">
                            <hr class="linha-cor-nav">
                            </hr>
                            <h3 class="square-color">Pessoas conscientes, como você, ajudam tanto o meio ambiente, como
                                os coletores que são imprescindíveis nessa causa.</h3>
                            <h2 class="text-center mt-4 sombreamento-text-nav">JUNTE-SE A NÓS!</h2>
                            <hr class="linha-cor-nav">
                            </hr>
                        </div>

                        <div class="col-sm">
                            <img src="./IMAGENS/gerdau-2.png" class="efeito2 img-gerdau img-fluid"
                                alt="Imagem fonte Gerdau">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>

    <!-- INCLUINDO O FOOTER -->
    <!-- FOOTER -->
    <footer class="">
        <div class="row">
            <div class="col-sm">
                <?php include "includes/footer.php" ?>
            </div>
        </div>
    </footer>

</body>

</html>