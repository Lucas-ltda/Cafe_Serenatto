<?php
require 'src/modelo/modelo.php';// chamando o modelo de objeto para ser usado;
require 'src/connection.php';
require 'src/repositorio/produtoRepositorio.php';

$produtoRepositorio =  new ProdutoRepositorio($pdo);
$produtoRepositorio -> excluir($_POST['id']);

header('location:admin.php');
?>