<?php	

	
	function Vigenère($plainText){
	
		$character = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'Â', 'À', 'É', 'È', 'Ê', 'Ë', 'Ç', 'Î', 'Ï', 'Ù', 'Ô', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'à', 'â', 'é', 'è', 'ê', 'ç', 'ï', 'î', 'û', 'ô', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ',', ' ', ';', ':', '?', '.', '!', '\'', '<', '>', '$', '£', '%', 'µ', '*', '+', '-');
		
		shuffle($character);
		
		
		// creating table with text
		$text_explode = preg_split('//', $plainText, -1, PREG_SPLIT_NO_EMPTY);
		
		
		//encryption key creation
		$key = array();
		$characters_key = count($text_explode);
		for($i=0; $i<=$characters_key; $i++) $key[]= $character[rand()%count($character)];
		
		
		//text encryption
		$code = "";
		for($i=0; $i<count($text_explode); $i++) $code = $code . $character[(array_search($text_explode[$i], $character)+array_search($key[$i%count($key)], $character))%count($character)];


		//data return
		$value = array( 'plainText' => $plainText, 'key' => implode($key), 'code' => $code, 'character'=> implode($character));
		return $value;
	
	}
	

	//decryption function

	function decryption($plainText, $key, $character){
		
		//array of characters_key
		$character = preg_split('//', $character, -1, PREG_SPLIT_NO_EMPTY);
		
		//key creation
		$key = preg_split('//', $key, -1, PREG_SPLIT_NO_EMPTY);
		
		
		//text table
		$text_explode = preg_split('//', $plainText, -1, PREG_SPLIT_NO_EMPTY);
		
		
		//decryption code
		$code = "";
		for($i=0; $i<count($text_explode); $i++){
		$id_char =  (array_search($text_explode[$i], $character)-array_search($key[$i%count($key)], $character))%count($character);
		$code = $code . $character[(($id_char < 0)?(count($character)+$id_char):$id_char)];
		
				
		//return decode
		return $code;

}

	
		
	}

		
	

	
	
?>
	
	
	
	
	
	
	

	
					
			
			