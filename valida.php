<?php
    session_start();
    require "conexao.php";
    $usuario_autenticado = false;
    $usuario_id = null;
    $usuario_perfil = null;
    $usuario_email = null;

    if(!empty($_POST['email']) && !empty($_POST['senha']) ){
        try{
            $query = "SELECT id, email, senha, perfil FROM usuarios WHERE email = :email and senha = :senha";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':email', $_POST['email']);
            $stmt->bindValue(':senha', $_POST['senha']);

            $stmt->execute();
            $usuario = $stmt->fetch();
            $usuario_autenticado = true;
            $usuario_id = $usuario['id'];
            $usuario_perfil = $usuario['perfil'];
            $usuario_email = $usuario['email'];

        }catch(PDOExpection $e){
            echo $e;
        }
    }

    if($usuario_autenticado){
        $_SESSION['autenticado'] = 'SIM';
        $_SESSION['id'] = $usuario_id;
        $_SESSION['perfil'] = $usuario_perfil;
        $_SESSION['email'] = $usuario_email;
        header('Location: home.php');
    }else{
        $_SESSION['autenticado'] = 'NAO';
        header('Location: index.php?login=erro');
    }

    /*echo '<pre>';
            print_r($usuario);
            echo '</pre>';*/
?>