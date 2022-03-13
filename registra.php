<?php
    session_start();
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    
    require 'conexao.php';
    
    $id_usuario = $_SESSION['id'];
    $titulo = $_POST['titulo'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $status = 1;

    $query = "INSERT INTO tbl_registra(id_usuario, titulo, categoria, descricao, status_chamado)
             VALUES(:id_usuario, :titulo, :categoria, :descricao, :status)";
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':id_usuario', $id_usuario);
    $stmt->bindValue(':titulo', $titulo);
    $stmt->bindValue(':categoria', $categoria);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':status', $status);
    $stmt->execute();
    header("Location: home.php");
    
?>