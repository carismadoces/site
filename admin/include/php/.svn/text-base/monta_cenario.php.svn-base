<?php

    header('Content-type: text/html; charset=utf-8');

    include_once '../../autoload.php';
    include_once 'Conexao.class.php';
    include_once 'Constantes.class.php';
    include_once 'Util.class.php';

    $conexao = Conexao::getConexao();
    
    try {

        $conexao->beginTransaction();
    
        /** Salvando tipos de leilao **/
        echo "Salvando tipos de leilao... <br/>";
        $tpLeiloes = array();

        $tpLeiloes[] = new TipoLeilaoBean(0, "Simples");
        $tpLeiloes[] = new TipoLeilaoBean(0, "Frete Grátis");
        $tpLeiloes[] = new TipoLeilaoBean(0, "Grátis");
        $tpLeiloes[] = new TipoLeilaoBean(0, "Frete Grátis e Grátis");
        $tpLeiloes[] = new TipoLeilaoBean(0, "Do Usuário");
        $tpLeiloes[] = new TipoLeilaoBean(0, "Vale Compra");
        $tpLeiloes[] = new TipoLeilaoBean(0, "Iniciante");
        $tpLeiloes[] = new TipoLeilaoBean(0, "Multiplos Produtos");

        $statusService = new TipoLeilaoService();

        foreach ($tpLeiloes as $tpLeilao) {
             echo "Salvando Tipo ".$tpLeilao->getTipoLeilaoID().": ".$tpLeilao->getDescricao(). "<br/>";
            $statusService->salvar($tpLeilao);
        }

        echo "Tipos de Leilao Salvo!!!<br/><br/><br/>";


        /** Salvando tipos de status do usuario **/
        echo "Salvando tipos de status do usuario... <br/>";
        $stUsuario = array();

        $stUsuario[] = new StatusBean(0, "Usuário Cadastrado", Constantes::$STATUS_USUARIO);
        $stUsuario[] = new StatusBean(0, "Usuário Excluido", Constantes::$STATUS_USUARIO);
        $stUsuario[] = new StatusBean(0, "Usuário Banido", Constantes::$STATUS_USUARIO);

        $statusService = new StatusService();

        foreach ($stUsuario as $stUsuario) {
            echo $stUsuario->getDescricao(). " :: ";
            $statusService->salvar($stUsuario);
        }

        echo "<br/>Tipos de Status do Usuario Salvo!!!<br/><br/>";

        /** Salvando tipos de status de informacao **/
        echo "Salvando tipos de status de informacao... <br/>";
        $stInformacao = array();

        $stInformacao[] = new StatusBean(0, "Informação Lida", Constantes::$STATUS_INFORMACAO);
        $stInformacao[] = new StatusBean(0, "Informação Não Lida", Constantes::$STATUS_INFORMACAO);
        $stInformacao[] = new StatusBean(0, "Informação Excluída", Constantes::$STATUS_INFORMACAO);

        foreach ($stInformacao as $stInformacao) {
            echo $stInformacao->getDescricao(). " :: ";
            $statusService->salvar($stInformacao);
        }

        echo "<br/>Tipos de Status de Informacao Salvo!!!<br/><br/>";

        /** Salvando tipos de status de depoimento **/
        echo "Salvando tipos de status de depoimento... <br/>";
        $stDepoimento = array();

        $stDepoimento[] = new StatusBean(0, "Depoimento Lido", Constantes::$STATUS_DEPOIMENTO);
        $stDepoimento[] = new StatusBean(0, "Depoimento Não Lido", Constantes::$STATUS_DEPOIMENTO);
        $stDepoimento[] = new StatusBean(0, "Depoimento Excluído", Constantes::$STATUS_DEPOIMENTO);

        foreach ($stDepoimento as $stDepoimento) {
            echo $stDepoimento->getDescricao(). " :: ";
            $statusService->salvar($stDepoimento);
        }

        echo "<br/>Tipos de Status de Depoimento Salvo!!!<br/><br/>";

        /** Salvando tipos de status de convite **/
        echo "Salvando tipos de status de convite... <br/>";
        $stConvite = array();

        $stConvite[] = new StatusBean(0, "Convite Aceito", Constantes::$STATUS_CONVITE);
        $stConvite[] = new StatusBean(0, "Convite Não Aceito", Constantes::$STATUS_CONVITE);
        $stConvite[] = new StatusBean(0, "Convite Excluído", Constantes::$STATUS_CONVITE);

        foreach ($stConvite as $stConvite) {
            echo $stConvite->getDescricao(). " :: ";
            $statusService->salvar($stConvite);
        }

        echo "<br/>Tipos de Status de Convite Salvo!!!<br/><br/>";

        /** Salvando tipos de status de compra **/
        echo "Salvando tipos de status de compra... <br/>";
        $stCompra = array();

        $stCompra[] = new StatusBean(0, "Compra Iniciada", Constantes::$STATUS_COMPRA);
        $stCompra[] = new StatusBean(0, "Aguardando Pagamento", Constantes::$STATUS_COMPRA);
        $stCompra[] = new StatusBean(0, "Compra Confirmada", Constantes::$STATUS_COMPRA);
        $stCompra[] = new StatusBean(0, "Compra Cancelada", Constantes::$STATUS_COMPRA);
        $stCompra[] = new StatusBean(0, "Compra Excluída", Constantes::$STATUS_COMPRA);

        foreach ($stCompra as $stCompra) {
            echo $stCompra->getDescricao(). " :: ";
            $statusService->salvar($stCompra);
        }

        echo "<br/>Tipos de Status de Compra Salvo!!!<br/><br/>";

        /** Salvando tipos de status de enquete **/
        echo "Salvando tipos de status de enquete... <br/>";
        $stEnquete = array();

        $stEnquete[] = new StatusBean(0, "Enquete Ativa", Constantes::$STATUS_ENQUETE);
        $stEnquete[] = new StatusBean(0, "Enquete Inativa", Constantes::$STATUS_ENQUETE);

        foreach ($stEnquete as $stEnquete) {
            echo $stEnquete->getDescricao(). " :: ";
            $statusService->salvar($stEnquete);
        }

        echo "<br/>Tipos de Status de Enquete Salvo!!!<br/><br/>";

        /** Salvando tipos de status de produto **/
        echo "Salvando tipos de status de produto... <br/>";
        $stProduto = array();

        $stProduto[] = new StatusBean(0, "Produto Escolhido", Constantes::$STATUS_PRODUTO);
        $stProduto[] = new StatusBean(0, "Produto Não Escolhido", Constantes::$STATUS_PRODUTO);
        $stProduto[] = new StatusBean(0, "Produto Excluído", Constantes::$STATUS_PRODUTO);

        foreach ($stProduto as $stProduto) {
            echo $stProduto->getDescricao(). " :: ";
            $statusService->salvar($stProduto);
        }

        echo "<br/>Tipos de Status de Produto Salvo!!!<br/><br/>";

        /** Salvando tipos de status de leilao **/
        echo "Salvando tipos de status de leilao... <br/>";
        $stLeilao = array();

        $stLeilao[] = new StatusBean(0, "Leilão Aguardando", Constantes::$STATUS_LEILAO);
        $stLeilao[] = new StatusBean(0, "Leilão Iniciado", Constantes::$STATUS_LEILAO);
        $stLeilao[] = new StatusBean(0, "Leilão Finalizado", Constantes::$STATUS_LEILAO);

        foreach ($stLeilao as $stLeilao) {
            echo $stLeilao->getDescricao(). " :: ";
            $statusService->salvar($stLeilao);
        }

        echo "<br/>Tipos de Status de Leilao Salvo!!!<br/><br/>";

        /** Salvando tipos de status de leilao **/
        echo "Salvando tipos de cronometro do leilao... <br/>";
        $cronometros = array();

        $cronometros[] = new CronometroBean(0,30);
        $cronometros[] = new CronometroBean(0,20);
        $cronometros[] = new CronometroBean(0,15);
        $cronometros[] = new CronometroBean(0,10);

        $cronometroService = new CronometroService();

        foreach ($cronometros as $cro) {
            echo $cro->getValor(). " :: ";
            $cronometroService->salvar($cro);
        }

        echo "<br/>Tipos de Cronometro do Leilao Salvo!!!<br/><br/>";

        $conexao->commit();
    } catch (Exception $exc) {
        $conexao->rollBack();
        echo $exc->getTraceAsString();
    }
?>
