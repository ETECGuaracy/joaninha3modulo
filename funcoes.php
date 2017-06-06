<?PHP
	function formatarData($data){
		$dia = date("d",$data);
		$mes = date("m",$data);
		$ano = date("Y",$data);
		
		$hora = date("H",$data);
		$minutos = date("i",$data);
		
		return "$dia/$mes/$ano - $hora:$minutos";
	}
	function formatarDataExtenso($data){
		$dia = date("j",$data); //j número do dia //d para 2 dígitos (inclui o 0)
		$mes = date("m",$data); //m (minúsculo) número do mês
		$ano = date("Y",$data);
		$semana = date('w',$data);
		$hora = date("H",$data);
		$minutos = date("i",$data);
		
		//converte o número do mês para o nome por extenso
		switch ($mes){
			case 1: $mes = "Janeiro"; break;
			case 2: $mes = "Fevereiro"; break;
			case 3: $mes = "Março"; break;
			case 4: $mes = "Abril"; break;
			case 5: $mes = "Maio"; break;
			case 6: $mes = "Junho"; break;
			case 7: $mes = "Julho"; break;
			case 8: $mes = "Agosto"; break;
			case 9: $mes = "Setembro"; break;
			case 10: $mes = "Outubro"; break;
			case 11: $mes = "Novembro"; break;
			case 12: $mes = "Dezembro"; break;
		}
		//configuração da semana
		switch ($semana) {
			case 0: $semana = "Domingo"; break;
			case 1: $semana = "Segunda-feira"; break;
			case 2: $semana = "Terça-feira"; break;
			case 3: $semana = "Quarta-feira"; break;
			case 4: $semana = "Quinta-feira"; break;
			case 5: $semana = "Sexta-feira"; break;
			case 6: $semana = "Sábado"; break;
		}
		
		return $semana.', ' .$dia. ' de ' .$mes. ' de ' .$ano. ' - ' .$hora. ':' .$minutos;
	}
	function sexocompleto($sexo){
		if($sexo == "m"){
			$sexo = "Masculino";
		}else if($sexo == "f"){
			$sexo = "Feminino";
		}
		
		return "$sexo";
	}
?>