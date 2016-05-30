<?php
/**
 * Description of ErroMeta
 *
 * @author Magno
 */
class ErroMeta {
    
    private $classe;
    private $atributo;
    private $mensagem;
    
    function __construct($classe = "", $atributo = "", $mensagem = "") {
        $this->classe = $classe;
        $this->atributo = $atributo;
        $this->mensagem = $mensagem;
    }
    
    public function getClasse() {
        return $this->classe;
    }

    public function setClasse($classe) {
        $this->classe = $classe;
    }

    public function getAtributo() {
        return $this->atributo;
    }

    public function setAtributo($atributo) {
        $this->atributo = $atributo;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function __toString() {
        
        $classe = "";
        $atributo = "";
        $mensagem = "";
        
        if(strlen(trim($this->classe)) > 0) $classe = " <b>Classe - </b>".$this->classe;
        if(strlen(trim($this->atributo)) > 0) $atributo = " <b>Atributo - </b>".$this->atributo;
        if(strlen(trim($this->mensagem)) > 0) $mensagem = " <i>".$this->mensagem. "</i>";
        
        
        return "<b><u>Erro:</u></b>".$classe.$atributo.$mensagem;
    }

}

?>
