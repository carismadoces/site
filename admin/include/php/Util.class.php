<?php

require_once 'easyphpthumbnail.class.php5';

class Util {

    /**
     * FUNCAO PARA AJUSTAR VALOR DE 10.000,00 PARA 10000.00
     **/
    static function stringToFloat($valor) {

        if(!strpos($valor,",") && !strpos($valor,"."))
            return $valor;

        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }

    /**
     * FUNCAO PARA AJUSTAR VALOR DE 10000.00 PARA 10.000,00
     **/
    static function floatToString($valor) {

        if(!isset($valor) || strlen($valor) <= 0)
            return "0,00";

        $valor = str_replace(",", "", $valor);
        $valor = number_format($valor, 2, ',', '.');
        return $valor;
    }

    /**
     * FUNCAO PARA AJUSTAR VALOR DE 100.0 PARA 100.00
     **/
    static function ajustaDecimais($valor) {

        if(!isset($valor) || strlen($valor) <= 0)
            return "0.00";

        $valor = number_format($valor, 2);
        return $valor;
    }


    /**
     * FUNCAO PARA MOSTRAR A DATA NA TELA DE 2010-10-10 PARA 10/10/2010
     **/
    static function dateToString ($data) {
        if ($data!='') {
            return (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
        }
        else {
            return '';
        }
    }

    /**
     * FUNCAO PARA GRAVAR A DATA NO BANCO DE  22:00 10/10/2010 PARA 2010-10-10 22:00
     **/
    static function stringToDateTime ($data) {
        if (strlen($data) > 0) {
            $data = explode(" ", $data);
            return Util::stringToDate($data[1])." ".$data[0];
        }
        else {
            return null;
        }
    }

    /**
     * FUNCAO PARA GRAVAR A DATA NO BANCO DE  2010-10-10 22:00 PARA 22:00 10/10/2010
     **/
    static function dateTimeToString ($data) {
        if ($data != '') {
            $data = explode(" ", $data);
            return $data[1]." ".Util::dateToString($data[0]);
        }
        else {
            return '';
        }
    }

    /**
     * FUNCAO PARA GRAVAR A DATA NO BANCO DE 10/10/2010 PARA 2010-10-10
     **/
    static function stringToDate ($data) {
        if ($data != '') {
            return (substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2));
        }
        else {
            return '';
        }
    }


    /**
     * FUNCAO PARA TRANSFORMAR A DATA DE 2010-04-10 PARA 04/10/2010
     **/
    static function dateToTimeStamp($data) {
        if ($data!='') {
            return (substr($data,5,2).'/'.substr($data,8,2).'/'.substr($data,0,4));
        }
        else {
            return '';
        }
    }

    /**
     * FUNCAO PARA CALCULAR A DIFEREN�A DE DIAS ENTRE DATAS
     * valor positivo: $final > $inicial
     * valor negativo: $final < $inicial
     * valor igual a zero: $final == $inicial
     * obs: para calcular o strtotime � preciso informar a data no seguinte formato:
     * mm/dd/aaaa, caso contr�rio ocorrer� erro.
     **/
    static function diferencaDiasData($inicial,$final) {
        $inicial = strtotime($inicial);
        $final = strtotime($final);
        return ($final-$inicial)/86400;
    }

    /**
     * FUNCAO QUE DEIXA SOH NUMEROS NO CPF
     **/
    static function cpfToString ($data) {
        if ($data!='') {
            $data = str_replace(".", "", $data);
            $data = str_replace("-", "", $data);
            return $data;
        }
        else {
            return $data;
        }
    }

    /**
     * FUNCAO QUE FORMATA STRING PARA CPF (DE: 12312312345 PARA: 123.123.123-45)
     **/
    static function stringToCpf ($data) {
        if ($data!='') {

            if(!strpos($data,".") && !strpos($data,"-")) {
                $data = substr($data,0,3).".".substr($data,3,3).".".substr($data,6,3)."-".substr($data,9,2);
            }

            return $data;
        }
        else {
            return $data;
        }
    }

    /**
     * FUNCAO QUE DEIXA SOH NUMEROS NO CNPJ
     **/
    static function cnpjToString ($data) {
        if ($data != '') {
            $data = str_replace(".", "", $data);
            $data = str_replace("-", "", $data);
            $data = str_replace("/", "", $data);
            return $data;
        }
        else {
            return $data;
        }
    }

    /**
     * FUNCAO QUE FORMATA STRING PARA CNPJ (DE: 01177318000105 PARA: 01.177.318/0001-05)
     **/
    static function stringToCnpj ($data) {
        if ($data!='') {

            if(!strpos($data,".") && !strpos($data,"/") && !strpos($data,"-")) {
                $data = substr($data,0,2).".".substr($data,2,3).".".substr($data,5,3)."/".substr($data,8,4)."-".substr($data,12,2);
            }

            return $data;
        }
        else {
            return $data;
        }
    }

    /**
     * FUNCAO QUE DEIXA SOH NUMEROS NO CEP
     **/
    static function cepToString ($data) {
        if ($data != '') {
            $data = str_replace("-", "", $data);
            return $data;
        }
        else {
            return $data;
        }
    }

    /**
     * FUNCAO QUE FORMATA STRING PARA CEP (DE: 64300000 PARA: 64300-000)
     **/
    static function stringToCep ($data) {
        if ($data!='') {

            if(!strpos($data,"-")) {
                $data = substr($data,0,5)."-".substr($data,5,3);
            }

            return $data;
        }
        else {
            return $data;
        }
    }

    /**
     * FUNCAO QUE DEIXA SOH NUMEROS NO TELEFONE
     **/
    static function telefoneToString ($data) {
        if ($data != '') {
            $data = str_replace("-", "", $data);
            $data = str_replace("(", "", $data);
            $data = str_replace(")", "", $data);
            return $data;
        }
        else {
            return $data;
        }
    }

    /**
     * FUNCAO QUE FORMATA STRING PARA TELEFONE (DE: 8632223456 PARA: (86)3222-3456)
     **/
    static function stringToTelefone ($data) {
        $data = str_replace(" ","",$data);

        if (strlen($data) >= 10 && strlen($data) <= 13) {

            if(!strpos($data,"(") && !strpos($data,")") && !strpos($data,"-")) {
                $data = "(".substr($data,0,2).")".substr($data,2,4)."-".substr($data,6,4);
            }

            else if(strpos($data,"(")>=0 && strpos($data,")")>=0 && !strpos($data,"-")) {
                $data = substr($data,0,8)."-".substr($data,8,4);
            }

            else if(!strpos($data,"(") && !strpos($data,")") && strpos($data,"-")>=0) {
                $data = "(".substr($data,0,2).")".substr($data,2,9);
            }

        }
        else if (strlen($data) == 8) {
            if(!strpos($data,"-")) {
                $data = substr($data,0,4)."-".substr($data,4,8);
            }
        }

        return $data;
    }

    /**
     * FUN��O QUE RETORNA UM ARRAY COM TODOS OS ARQUIVOS DO DIRETORIO
     * (USA RECURSIVIDADE!!!), PODE-SE TB BUSCAR PELO NOME DO ARQ
     * */
    static function leDiretorio($arquivos, $dir, $filtro = "", $busca = "", $criptografado = true) {

        $d = dir($dir);

        while($name = $d->read()) {

            if(strpos($name,".") === FALSE && is_dir($dir.$name)) {
                $arquivos = Util::leDiretorio($arquivos, $dir.$name."/", $filtro,$busca);
            }

            if(strlen($filtro) > 0 && !preg_match($filtro, $name))
                continue;

            if(strlen($busca) > 0 && strpos($name,strtoupper($busca)) === FALSE)
                continue;

            $size = filesize($dir.$name);
            $lastmod = filemtime($dir.$name);
            $urlCript = $dir.$name;

            if($criptografado)
                $urlCript = Seguranca::criptografaLink($dir.$name);

            $arquivos[] = array('name'=>$name, 'size'=>$size,
                    'lastmod'=>$lastmod, 'url'=>$urlCript);
        }
        $d->close();
        return $arquivos;
    }

    /**
     * FUN��O PARA VALIDAR CPF
     **/
    static function validaCPF($number) {

        // Os str_replace servem para "corrigir" os poss�veis "erros", tendo em vista que o c�digo foi preparado apenas para trabalhar com n�meros
        if(strstr($number,"."))
            $number=str_replace(".","",$number);
        if(strstr($number,"-"))
            $number=str_replace("-","",$number);
        if(strstr($number,"/"))
            $number=str_replace("/","",$number);
        if(strlen($number)!=11)
            return false;

        $d1 = 0;
        $d2 = 0;

        for($i=0;$i<9;$i++)
            $d1=$d1+($number[$i]*(10-$i));

        $d1=11-($d1%11);
        if($d1>=10)
            $d1=0;
        for($i=0;$i<9;$i++)
            $d2=$d2+($number[$i]*(11-$i));

        $d2=11-(($d2+($d1*2))%11);

        if($d2>=10)
            $d2=0;
        if($number[9]==$d1&&$number[10]==$d2)
            return true;

        return false;

    }

    /**
     * FUN��O PARA VALIDAR CNPJ
     **/
    static function validaCNPJ($number) {

        // Os str_replace servem para "corrigir" os poss�veis "erros", tendo em vista que o c�digo foi preparado apenas para trabalhar com n�meros
        if(strstr($number,"."))
            $number=str_replace(".","",$number);
        if(strstr($number,"-"))
            $number=str_replace("-","",$number);
        if(strstr($number,"/"))
            $number=str_replace("/","",$number);
        if(strlen($number) != 14)
            return false;

        $d1 = $number[11]*2+$number[10]*3+$number[9]*4+$number[8]*5+
                $number[7]*6+$number[6]*7+$number[5]*8+$number[4]*9+
                $number[3]*2+$number[2]*3+$number[1]*4+$number[0]*5;

        $d1 = 11-($d1%11);
        if($d1 >= 10)
            $d1 = 0;
        $d2 = $d1*2+$number[11]*3+$number[10]*4+$number[9]*5+
                $number[8]*6+$number[7]*7+$number[6]*8+$number[5]*9+
                $number[4]*2+$number[3]*3+$number[2]*4+$number[1]*5+$number[0]*6;
        $d2 = 11-($d2%11);
        if($d2>=10)
            $d2=0;
        if($number[12]==$d1&&$number[13]==$d2)
            return true;

        return false;

    }

    static function getPaginacao($pagina, $tamanho = 0) {

        $complemento = "";
        if(isset($pagina) && $pagina > 0) {

            if($tamanho == 0)
                $tamanho = Constantes::$TAM_PAGINA;

            $inicio = ($pagina*$tamanho)-$tamanho;

            $complemento = " LIMIT " .
                    $inicio . "," . $tamanho;

        }

        return $complemento;

    }

    static function calculaNumPaginas($total, $tamanho = 0){

        if($tamanho == 0)
                $tamanho = Constantes::$TAM_PAGINA;

        $numPaginas = $total/$tamanho;
        if($numPaginas > intval($numPaginas))
            $numPaginas = intval($numPaginas) + 1;

        return $numPaginas;
    }

    static function geraNomeArquivo($nomeTemp) {
        $ext = explode(".", $nomeTemp);

        if(count($ext) > 1)
            $extensao = ".".$ext[count($ext)-1];
        else
            $extensao = '';
        return md5(uniqid(time())) . $extensao;
    }

    static function arrayCombo($lista, $chave, $valor, $primeiraOpcao = " -- Selecione -- ") {
        $combo = array();

        $combo[''] = $primeiraOpcao;

        foreach ($lista as $obj) {
            $getChave = "get".strtoupper($chave[0]).substr($chave, 1);
            $getValor = "get".strtoupper($valor[0]).substr($valor, 1);
            $combo[$obj->$getChave()] = $obj->$getValor();
        }
        return $combo;
    }

    static function getCodificacao($string) {
        return mb_detect_encoding($string.'x', 'UTF-8, ISO-8859-1');
    }

    static function geraThumb($img, $tam = 100) {

        $thumb = new easyphpthumbnail;

        if(isset($img) && strlen($img) > 0) {

            $pasta = dirname($img);

            $thumb->Thumblocation = $pasta . '/thumbs/';
            $thumb->Thumbprefix = 'mini_';
            $thumb->Thumbsize = $tam;
            $thumb->Polaroid = false;
            $thumb->Createthumb($img,'file');
        }
    }

    static function dateTimeFusoHorario($fuso){
        #$hora = date("H")+$fuso;
        $hora = date("H")-3;
        $hora = $hora.date(":i:s");
        return date("Y-m-d ").$hora;

    }

    static function getMediaMini($media) {

        $med = $media;
        $ext = explode("/", $med);

        if(count($ext) > 1)
            $nome = $ext[count($ext)-1];
        else
            $nome = $med;

        return dirname($med)."/mini_".$nome;

    }

	static function calcularValorMensalidade($valorMensalidade, $descontos, $qtdModalidadeSelecionada, $plano, $aluno_academia, $aluno_area_molhada){

		$descontoTotal = 0;

		// Posi��o inicial dos descontos das modalidades
		$indiceModalidade = 4;

		// Desconto pela quantidade de modalidades
		$desconto = $descontos[$indiceModalidade + $qtdModalidadeSelecionada];
		if ( $desconto > 0 ){
			$valor = $valorMensalidade * ( $desconto / 100);
			$descontoTotal = $valor;
			$valor = ($valorMensalidade * $qtdModalidadeSelecionada) - $valor;
		}else{
			$valor = $valorMensalidade;
		}

		// Desconto pelo Plano
		$descontoPlano = ( $valor * ( $descontos[$plano-1] / 100 ) );
		$descontoTotal += $descontoPlano;
		$valor = $valor - $descontoPlano;

		// Desconto aluno academia
		if ( $aluno_academia ){
			$descontoAlunoAcad = ( $valor * ( $descontos[4] / 100 ) );
			$descontoTotal += $descontoAlunoAcad;
			$valor = $valor - $descontoAlunoAcad;
		}

		// Desconto aluno �rea molhada
		if ( $aluno_area_molhada ){
			$descontoAlunoAM = ( $valor * ( $descontos[5] / 100 ) );
			$descontoTotal += $descontoAlunoAM;
			$valor = $valor - $descontoAlunoAM;
		}

		return money_format('%i', $valor) ;
	}



	/**
	 *
	 * @convert pdo multi-d array to single d
	 *
	 * @param array $result
	 *
	 * @return $array
	 *
	 */
	 function pdoToArray($result){
		 $new=array();
		 $i = 0;
		 foreach ( $result as $val )
		 {
		    $keys = array_keys($val);
		    $new[$i] = $val[$keys[1]];
		    $i++;
		 }
		 return $new;
	 }

	public static function endsWith($haystack,$needle,$case=true){
	  $expectedPosition = strlen($haystack) - strlen($needle);

	  if($case)
	      return strrpos($haystack, $needle, 0) === $expectedPosition;

	  return strripos($haystack, $needle, 0) === $expectedPosition;
	}

	 public static function startswith($haystack, $needle) {
	 	return strpos($haystack, $needle) === 0;
	 }

	 function listaArquivos($dir,$nivel){

	 	try {
		 	$files = "";
		 	$d = dir($dir);
		 	$nivel = $nivel + 1;
		 	while (false !== ($entry = $d->read()))
		 	{
		 		if (is_dir($dir.$entry."/"))
		 		{
		 			if (($entry!=".") && ($entry!=".."))
		 			{
		 				for($i=1;$i<=$nivel;$i++){
		 					if ( !Util::startsWith($entry, '.') )
			 				$files .= $dir."/".$entry . ",";
		 				}

		 				listaArquivos($dir.$entry."/",$nivel);
		 			}
		 		}
		 		else
		 		{
		 			for($i=1;$i<=$nivel;$i++){
		 				if ( !Util::startsWith($entry, '.') )
		 				$files .= $dir."/".$entry . ",";
		 			}
		 		}
		 	}

		 	return $files;
		 	$d->close();
	 	} catch (Exception $e) {
	 		echo $e->getMessage();
	 		throw $e;
	 	}
	 }

	 static function cleanInput($input) {

	 	$search = array(
	    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
	    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
	    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
	    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
		 	);

		 	$output = preg_replace($search, '', $input);
		 	return $output;
	 }

		 /**
		  * Converts an associative array of arbitrary depth and dimension into JSON representation.
		  *
		  * NOTE: If you pass in a mixed associative and vector array, it will prefix each numerical
		  * key with "key_". For example array("foo", "bar" => "baz") will be translated into
		  * {'key_0': 'foo', 'bar': 'baz'} but array("foo", "bar") would be translated into [ 'foo', 'bar' ].
		  *
		  * @param $array The array to convert.
		  * @return mixed The resulting JSON string, or false if the argument was not an array.
		  * @author Andy Rusterholz
		  */
		 static function array_to_json( $array ){

		 	if( !is_array( $array ) ){
		 		return false;
		 	}

		 	$associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
		 	if( $associative ){

		 		$construct = array();
		 		foreach( $array as $key => $value ){

		 			// We first copy each key/value pair into a staging array,
		 			// formatting each key and value properly as we go.

		 			// Format the key:
		 			if( is_numeric($key) ){
		 				$key = "key_$key";
		 			}
		 			$key = "\"".addslashes($key)."\"";

		 			// Format the value:
		 			if( is_array( $value )){
		 				$value = Util::array_to_json( $value );
		 			}elseif ( $value instanceof GenericBean ){
		 				$value = Util::array_to_json( $value->toArray() );
		 			}else if( is_bool($value) ){
		 				$value = $value ? 'true' : 'false';
		 			} else if( !is_numeric( $value ) || is_string( $value ) ){
		 				$value = "\"".addslashes($value)."\"";
		 			}

		 			// Add to staging array:
		 			$construct[] = "$key: $value";
		 		}

		 		// Then we collapse the staging array into the JSON form:
		 		$result = "{ " . implode( ", ", $construct ) . " }";

		 	} else { // If the array is a vector (not associative):

		 		$construct = array();
		 		foreach( $array as $value ){

		 			// Format the value:
		 			if( is_array( $value )){
		 				$value = Util::array_to_json( $value );
		 			}elseif ( $value instanceof GenericBean ){
		 				$value = Util::array_to_json( $value->toArray() );
		 			}
		 			else if( !is_numeric( $value ) || is_string( $value ) ){
		 				$value = "\"".addslashes($value)."\"";
		 			}

		 			// Add to staging array:
		 			$construct[] = $value;
		 		}

		 		// Then we collapse the staging array into the JSON form:
		 		$result = "[ " . implode( ", ", $construct ) . " ]";
		 	}

		 	return $result;
	 }

	static function getFileName($file){
        $ext = explode("/", $file);

        if(count($ext) > 1)
            $nome = $ext[count($ext)-1];
        else
            $nome = $file;

        return $nome;
    }

    static function getFileExtension($file){
        $ext = explode("/", $file);

        if(count($ext) > 1)
            $nome = $ext[count($ext)-1];
        else
            $nome = $file;

        $ext = explode(".", $nome);

        if(count($ext) > 1)
            $nome = $ext[count($ext)-1];
        else
            $nome = "";

        return $nome;
    }

	public static function isBlank($value) {
	    return empty($value) && !is_numeric($value);
	}

	public static function isBoolean($value) {
   		return $value === "true";
	}

	public static function rrmdir($dir) {
	    foreach(glob($dir . '/*') as $file) {
	        if(is_dir($file))
		        Util::rrmdir($file);
	        else
	            unlink($file);
	    }
	    rmdir($dir);
	}

  public function replace_accents($string){
    return str_replace( array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'), array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'), $string);
  }

}

?>
