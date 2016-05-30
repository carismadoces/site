<?php
	class Seguranca{
	                

        static function senhaRandomica($qtd_char){                  	                                 	        
            //lista de caracteres, (coloque aqui os caracteres a sua escolha)                	        
            $caracteres = "A,B,C,d,e,f,G,H,I,j,l,m,n,X,Z,w,Y,o,p,Q,r,S,t,Y,1,2,3,4,5,6,7,8,9,0";                  	                                 	        
            //gera um array com a lista de caractreres                	        
            $array_caracteres = explode(",", $caracteres);                  	                                 	        
            //mistura o array                    	        
            shuffle($array_caracteres);                  	                                 	        
            //transforma em uma string                    	        
            $senha = implode($array_caracteres, "");                  	                                 	        
            //retorna a senha com a quantidade de caracteres desejado                    	        
            return substr($senha, 0, $qtd_char);                          
        }
                
        static function criptografaSenha($senha){
            $chars_aleatorios = Seguranca::senhaRandomica(8);
            return md5($senha.$chars_aleatorios).":".$chars_aleatorios;            
        }
        
        static function testaSenha($senha, $chaveComparacao){
            $senha_criptografada = explode(":",$chaveComparacao);
            if(strcmp(md5($senha . $senha_criptografada[1]),$senha_criptografada[0]) === 0)
                return TRUE;
            return FALSE;    
            
        }
        
        static function criptografaLink($link){
            $chars_aleatorios1 = Seguranca::senhaRandomica(8);
            $chars_aleatorios2 = Seguranca::senhaRandomica(8);
            return $chars_aleatorios1.":".base64_encode($link).":".$chars_aleatorios2;            
        }
        
        static function descriptografaLink($link){
            $link_criptografado = explode(":",$link);
            return base64_decode($link_criptografado[1]);           
        }
 
    
    }
?>