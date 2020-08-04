<?php
class Profissionais
{
    public function filterProfissional($especialidades)
    {
        return array_filter(
            $especialidades,
            function ($sp) {
                $id = $_REQUEST['especialidade_id'];
                if ($sp->nome) {
                    $existe = false;
                    foreach ($sp->especialidades as $e) {
                        if ($e->especialidade_id == $id) {
                            $existe = true;
                            break;
                        }
                    }
                    if ($existe) {
                        return $sp;
                    }
                }
            }
        );
    }
    public function listProfissionais()
    {
        $url = "https://api.feegow.com.br/api/professional/list";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = [
            'x-access-token:eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $profissionais = json_decode(curl_exec($ch));
        $produtosFiltrados = $this->filterProfissional($profissionais->content);
        
        return $produtosFiltrados;
    }
    
    public function createOptions($options)
    {
        $output = "";
        foreach ($options as $opt) {
            $id = $opt->profissional_id;
            $foto = $opt->foto ? $opt->foto : "https://cdn.feegow.com/img/user-dummy.png";
            $crm = $opt->documento_conselho;
            $nome = $opt->nome;
            if (strlen($nome) > 30) {
                $nome = substr($nome, 0, 30) . '...';
            }
            if ($id && $nome) {
                $output .= '<div class="card mb-3 rounded" style="max-width: 540px;">
                <div class="card-body">
                  <img
                    src="' . $foto . '"
                    class="card-img rounded-pill foto"
                    alt="' . $nome . '"
                  />
                  <h5 class="card-title">' . $nome . '</h5>
                  <p class="card-text">CRM: ' . $crm . '</p>
                </div>
                <div class="card-footer">
                  <button
                    class="btn btn-info btn-lg btn-block rounded-0"
                    type="submit"
                    onclick="abrirAgendamento(event, ' . $id . ')"
                  >
                    Agendar
                  </button>
                </div>
              </div>
              
              ';
            }
        }

        echo $output;
    }
}
//Retornando resposta para solicitação ajax
$profissionais = new Profissionais;

if(isset($_GET['action']) && !empty($_GET['action'])) {
    $action = $_GET['action'];
    switch($action){
        case "listar" :
            $profissionalList = $profissionais->listProfissionais();
            echo $profissionais->createOptions($profissionalList);
        break;
    }
}else{
    echo "Ação não cadastrada";
}


