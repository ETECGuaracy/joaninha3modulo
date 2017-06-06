<?PHP
	#Caso este script não esteja funcionando, verificar se a Biblioteca GD está instalada e ativa.
	
	function redimensionarImagem(){
		global $caminhoImg, $novoNomeImg;
		
		$imagemJpg = $caminhoImg;
		
		if(!file_exists($imagemJpg)){
			return false;
		}
		
		$larguraFinal1 = "194";
		$larguraFinal2 = "500";
		
		$img = imagecreatefromjpeg($imagemJpg);
		
		$larguraOriginal = imagesX($img);
		$alturaOriginal = imagesY($img);
		
		$alturaFinal1 = (int) ($alturaOriginal * $larguraFinal1)/$larguraOriginal;
		$alturaFinal2 = (int) ($alturaOriginal * $larguraFinal2)/$larguraOriginal;
		
		$nova1 = ImageCreateTrueColor($larguraFinal1,$alturaFinal1);
		$nova2 = ImageCreateTrueColor($larguraFinal2,$alturaFinal2);
		
		imagecopyresampled($nova1, $img, 0, 0, 0, 0, $larguraFinal1, $alturaFinal1, $larguraOriginal,  $alturaOriginal);
		imagecopyresampled($nova2, $img, 0, 0, 0, 0, $larguraFinal2, $alturaFinal2, $larguraOriginal,  $alturaOriginal);
		
		imagejpeg($nova1,'../loja/imgPeq/' . $novoNomeImg); #salvando as novas imagens redimensionadas.
		imagejpeg($nova2,'../loja/imgGrd/' . $novoNomeImg);
		
		return true;
	}
?>