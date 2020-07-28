<nav class="navbar navbar-expand-md navbar-dark shadow-sm rounded navbar-fixed-top" style="background-color: #1d354c; background: rgba(0, 0, 0, 0.7);">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
    data-target="#navbar" aria-controls="navbar"
    aria-expanded="false" aria-label="Toggle navigation" style="float: rigth;">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbar">

      <ul class="nav navbar-nav">
        <li @if($current=="/") class="nav-item active" @else class="nav-item" @endif>
          <a class="nav-link" href="/">Página Inicial<span class="sr-only">(current)</span></a>
        </li>
        <li @if($current=="solicitacoes") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="/solicitacoes">Solicitacões <span class="sr-only">(current)</span></a>
        </li>
        <li @if($current=="funcionamento") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="#">Como Funciona ? <span class="sr-only">(current)</span></a>
        </li>
        <li @if($current=="whois") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="#">Quem Somos<span class="sr-only">(current)</span></a>
        </li>
        <li @if($current=="recsuj") class="nav-item active" @else class="nav-item" @endif>
            <a class="nav-link" href="#">Reclamações e Sujestões<span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
