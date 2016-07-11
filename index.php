<?php
/* 
 * Projeto Criado por David - Modificado por mim
 * @author Osvaldo - Data 06-07-2016 02:52Hs
 */
session_start();

include_once 'App/Loader.php';

$Loader = new App\Loader();
$Loader->Register();

$Pdo = new PDO("mysql:host=localhost;dbname=shop", "root", "");
$ProdutoRepositorio = new \App\Model\Produto\ProdutoRepositorioPDO($Pdo);

$Page = isset($_GET['page']) ? $_GET['page'] : '';
$Action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($Page){
    case 'cart':
        $SessionCart = new App\Model\Shopping\CartSession();
        $Cart = new App\Controller\Cart($ProdutoRepositorio, $SessionCart);
        call_user_func_array(array($Cart, $Action), array());
        break;
    default :
        $Home = new \App\Controller\Home($ProdutoRepositorio);
        call_user_func_array(array($Home, $Action), array());
}