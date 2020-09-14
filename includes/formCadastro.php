<section class="side-registrer">
  <a tabindex="-1" href="#" class="slide-register-close text-right">X</a>
  <div id="section-register">
    <h3>Quero reciclar</h3>
    <p><small>Preencha seus dados para começar a reciclar</small></p>
    <div id="feedResponse"></div>
    <form name="form-cadastro" class=" form-cadastro" method="POST" oninput='passwordRPT.setCustomValidity(passwordRPT.value != password.value ? "As senhas não conferem." : "")'>
      <div class="form-group verdecla">
        <label for="name">Nome Completo</label>
        <input type="text" class="form-control form-control-sm" name="name" placeholder="Digite seu nome" required>
      </div>
      <div class="verdecla form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control form-control-sm" name="email" placeholder="Digite seu email" required>
      </div>
      <div class="form-group verdecla">
        <label for="phone">Telefone</label>
        <input type="text" class="form-control form-control-sm" name="phone" placeholder="Digite seu telefone">
      </div>
      <div class="form-group verdecla">
        <label for="password">Senha</label>
        <input type="password" class="form-control form-control-sm" name="password" placeholder="Digite sua senha" required>
      </div>
      <div class="form-group verdecla">
        <label for="passwordRPT">Confirme a Senha</label>
        <input type="password" class="form-control form-control-sm" name="passwordRPT" placeholder="Repita sua senha" required>
      </div>
      <div class="custom-control custom-checkbox mb-3">
        <input type="checkbox" class="custom-control-input" id="isOk" name="isOk" required>
        <label class="custom-control-label verdecla" for="isOk">Confirmar que está de acordo com a Política de
          Privacidade</label>
      </div>
      <button type="submit" class="btn btn-success btn-lg btn-block">CADASTRAR</button>
    </form>
  </div>
</section>
<div class="side-section-overlay" style="width: 0px; opacity: 0;"></div>