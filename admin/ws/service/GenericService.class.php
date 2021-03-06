<?php
/**
 * Classe Base para as Servi�os.
 * @access public
 * @author Daniel Eduardo
 * @package ws/service
 */
class GenericService {
	
	function GenericService() {
	}
	
	public function build($obj, $filename = null){
		
		$status_code = 200;
		$status_header = Constantes::$HTTP_STATUS[$status_code];
		
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');
		
		$accept = $_SERVER['HTTP_ACCEPT'];
		if ( strpos($accept, "*/*")  !== false || strpos($accept, "application/json")  !== false ){
			$content_type = 'application/json';
			if( is_array( $obj ) ){
				echo Util::array_to_json($obj);
			}else if ( $obj instanceof GenericBean ){
				echo Util::array_to_json($obj->toArray());
			}else{
				echo Util::array_to_json(array($obj));
			}
		}else if ( strpos($accept, "application/xml")  !== false ){
			$content_type = 'text/xml';
			if( is_array( $obj ) ){
				echo new ObjectToXML($obj);
			}else if ( $obj instanceof GenericBean ){
				echo new ObjectToXML($obj->toArray());
			}else{
				echo Util::array_to_json(array($obj));
			}
		}else if ( strpos($accept, "application/pdf")  !== false ){			
			$handle = fopen($obj, "r");
			$length = filesize($obj);
			$contents = fread($handle, $length);
			fclose($handle);
			
			header("Content-type: application/pdf");
			header("Content-Length: $length");
			header("Content-Disposition: attachment; filename=$filename");

			echo $contents;
		}else if ( strpos($accept, "application/png")  !== false ){			
			$handle = fopen($obj, "r");
			$length = filesize($obj);
			$contents = fread($handle, $length);
			fclose($handle);
			
			header("Content-type: application/png");
			header("Content-Length: $length");
			header("Content-Disposition: attachment; filename=$filename");

			echo $contents;
		}else{
			$content_type = 'text';
			$status_code = 415;
			$status_header = Constantes::$HTTP_STATUS[$status_code];
		}
		
		if ( $accept !== "application/pdf" || $accept !== "application/png"){
			header('Content-type: ' . $content_type);
			header($status_header);
		}
	}

}