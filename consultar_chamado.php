<?php
  require 'conexao.php';
  session_start();

  $query = "select u.id, u.perfil, u.nome, t.id_usuario, t.titulo, t.categoria, t.descricao, t.status_chamado from usuarios as u
            left join tbl_registra as t on (u.id = t.id_usuario)";

  $stmt = $conexao->prepare($query);
  $stmt->execute();
  $chamado = $stmt->fetchAll(PDO::FETCH_OBJ);
  /*echo '<pre>';
  print_r($chamado);
  echo '</pre>';
  echo '<br>';
  echo $_SESSION['id'];
  echo $_SESSION['perfil'];*/
  
  
?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">
              <?php foreach($chamado as $indices => $chamados){ ?>
                <?php if($_SESSION['perfil'] == 1){ ?>
                  <div class="card mb-3 bg-light">
                  <div class="card-body">
                  <h5 class="card-title"><?= $chamados->titulo  ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $chamados->categoria ?></h6>
                  <p class="card-text"><?= $chamados->descricao ?> </p>
                </div>
                  <?php }else ?> 
                  <?php if($_SESSION['perfil'] == 2){ ?>
                      <?php if($chamados->id == $_SESSION['id']){ ?>
                      <div class="card mb-3 bg-light">
                      <div class="card-body">
                      <h5 class="card-title"><?= $chamados->titulo  ?></h5>
                      <h6 class="card-subtitle mb-2 text-muted"><?= $chamados->categoria ?></h6>
                      <p class="card-text"><?= $chamados->descricao ?> </p>
                    </div>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              
            </div>

              <div class="row mt-5">
                <div class="col-6">
                  <a href="home.php">
                  <button class="btn btn-lg btn-warning btn-block" type="submit">Voltar</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>