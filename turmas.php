<?PHP
	Require('header.php');
?>
<script language="javascript">
$(document).ready(function(){
	$(".linkTurmas").click(function() {
		$(".conteudoTurmas").animate({height: 'hide'}, 2000);
		
		if ($(this).next().css("display") == "none") {
			$(this).next().stop().animate({height: 'show'}, 2000);
		}
	});
});
$('#turmasConteudo div').corner();
</script>
<style>
div#turmasConteudo div{
	padding:10px;
	margin:10px;
	background-color:#f78c18;
	color:#FFF;
}
div#turmasConteudo div div{
	display:none;
	background-color:#FFF;
	color:#000;
}
.linkTurmas{
	font-weight:bold;
	cursor:pointer;
}
</style>
<p class="titulo">Turmas</p>
<p>Clique nas turmas para mais detalhes.</p>
<div id="turmasConteudo">
<!---------------------BERÇÁRIO--------------------->
<div>
    <p id="turmasBercarioClique" class="linkTurmas">Berçário</p>
        <div id="turmasBercario" class="conteudoTurmas">
            <p>Para  crianças entre 4 meses e 1 ano de idade.</p>
            <p><em>Desenvolvimento  esperado:</em></p>
            <p><strong>Entre 4 e 6 meses  </strong> <br/>
            O bebê está mais firme e gosta de movimentar-se. As sensações provocadas pelo movimento ficam registradas, formando novas conexões cerebrais que serão utilizadas para a aquisição de outros movimentos voluntários. A preensão palmar, que antes acontecia de forma reflexa torna-se uma ação voluntária. O bebê tenta agarrar objetos, apesar de ainda ser freqüente a ocorrência de erros de pontaria. Quando pega o objeto desejado, invariavelmente leva-o à boca. Ele usa a boca para conhecer as características do objeto, transformando as informações que recebe numa reconstituição visual exata do mesmo.<br /><br />
			O que pode estar fazendo nesse período:
				<ul>
            		<li>Vira-se sozinho e rola de um lado para o outro.</li>
               		<li>Agarra brinquedos como argolas e chocalhos, segurando firme e resistindo se alguém tenta tirá-los de sua mão.</li>
                	<li>Quando escuta algum barulho, vira a cabeça para achar de onde vem.</li>
				</ul>
			</p>            
            <p><strong>Entre 6 e 9 meses</strong> <br>
            O controle da musculatura do tronco e o aumento da força muscular favorecem a habilidade de sentar. Sentar significa ver o mundo na posição ereta e finalmente ter as mãos livres para explorá-lo. O controle progressivo da musculatura dos braços favorece as primeiras tentativas de engatinhar. Ao engatinhar ou se arrastar, a criança consegue pela primeira vez explorar e atingir seus objetivos sem a ajuda de outros, o que exige coordenação dos movimentos e raciocínio. Não existe um padrão único de engatinhar. Além disso, cerca de 20% das crianças andam, sem ter passado por essa etapa.<br />
            Nessa fase, interessa-se muito pelas conseqüências ambientais de suas ações. A criança tenta manter, através da repetição, uma mudança ambiental que sua própria ação produziu acidentalmente. Ela balança, joga, esfrega, bate os objetos com grande interesse pelas imagens e sons que essas ações produzem. Mesmo já sabendo que as coisas não deixam de existir quando estão fora de sua visão, nessa fase, em decorrência do maior desenvolvimento de sua atenção e memória a criança procura os objetos que estão fora do seu campo visual divertindo-se com brincadeiras do tipo esconde-achou.<br /><br />
            O que pode estar fazendo nesse período:
            	<ul>
                	<li>O bebê fica sentado sem apoio.</li>
                    <li>Passa objetos de uma mão para a outra.</li>
                    <li>Estranha pessoas desconhecidas.</li>
                    <li>Repete sons como "A-pa", "ma-ma", "A-ba".</li>
				</ul>
            </p>
            <p><strong>Entre 9 e 12 meses</strong> <br>
            A criança adquire maior capacidade de locomoção, noções espaciais de distância e limites e executa planos de ações para atingir objetivos. Ao ficar em pé apoiando-se nos móveis exercita o equilíbrio e amplia em muito as possibilidades de exploração do mundo. Muito familiarizada com os sons de sua língua nativa é capaz de compreender muitas palavras, mesmo sem ainda ser capaz de emiti-las. Essa compreensão coincide com o aparecimento da linguagem gestual, quando é comum a criança bater palminhas, apontar para expressar desejo ou dar tchau.<br /><br />
O que pode estar fazendo nesse período:
				<ul>
                	<li>Fica em pé, apoiando-se nos móveis ou com ajuda de uma pessoa.</li>
                    <li>Bate palmas, aponta o que deseja pegar e diverte-se dando adeus.  </li>
                    <li>Pode estar falando uma ou duas palavras como mãmã, papa, dá.</li>
				</ul>
                <p align="right">Autora: Dra. Rosa Resegue Ferreira da Silva - Médica</p>                   
			</p>
        </div>
</div>
<!---------------------MATERNAL--------------------->
<div>
	<p id="turmasMaternalClique" class="linkTurmas">Maternal</p>
        <div id="turmasMaternal" class="conteudoTurmas">
            <p>Para crianças entre 1 e 2 anos e 11 meses de idade.</p>
            <p><em>Desenvolvimento  esperado:</em></p>
            <p><strong>1 ano a 1 ano e 6 meses</strong> <br>
            Mais ativa e curiosa, a criança consegue finalmente andar. Do ponto de vista social, andar é um marco importante no desenvolvimento do indivíduo. Ao andar, conquista autonomia e liberdade para explorar o mundo com as mãos agora liberadas. Gradativamente, vai coordenando ações diferentes e intencionais - subir, escalar, puxar - como instrumentos para atingir seus objetivos. Consegue pegar pequenos objetos e usa bem as mãos para manipulá-los e deixar suas marcas no mundo. O sentido das coisas é apreendido através da ação e observação. Empilha, coloca e tira objetos dos mais diversos lugares e adora desmontar as coisas para entender do que são feitas. Dessa maneira, por meio de sua ação, vai aperfeiçoando os conceitos de dentro e fora, em cima e embaixo, grande e pequeno.<br /><br />
            O que pode estar fazendo nesse período:
            	<ul>
            		<li>Gosta de escutar pequenas histórias e músicas. </li>
                	<li>Compreende bem o que lhe dizem.</li>
                	<li> Entende ordens simples como "dá um beijo na mamãe".</li>
                	<li>Faz birra quando contrariada. </li>
                	<li>Anda sozinha.</li>
				</ul>                            
            </p>            
            <p><strong>1 ano e 6 meses a 2 anos</strong> <br>
            Nessa fase, a criança ainda não entende bem as regras e irrita-se facilmente quando contrariada ou quando não consegue fazer alguma coisa. Gosta de repetir e aprender novas palavras. Começa a entender que uma palavra pode servir para vários objetos, mas ainda utiliza categorias muito abrangentes: uma bola será sempre nomeada como tal independente de ser azul, vermelha, grande ou pequena, mas outros objetos de formato semelhante como um bolo ou uma maçã poderão receber a mesma denominação dependendo da categorização escolhida pela criança. A imitação, considerada como ensaio da imaginação e peça fundamental para a criatividade, é uma de suas atividades preferidas.<br /><br />
            O que pode estar fazendo nesse período:
            	<ul>
            		<li>Começa a juntar duas palavras e a falar frases simples como "au-au cadê?" ou "qué papá".</li>
                	<li>Testa limites e fala muito a palavra "não".</li>
                	<li>Sobe em cadeiras e sofás.</li>
                	<li>Corre, sobe e desce escadas, em pé, com auxílio de um adulto.</li>
                	<li>Pode começar a aprender controlar o xixi e o cocô.</li>
                </ul>
            </p>
            <p><strong>2 a 3 anos</strong> <br>
            	Gosta de dançar e costuma acompanhar a música batendo palmas. Percebe que os objetos podem ser classificados: bola e boneca são brinquedos, cachorro e gato são animais. O mundo reduzido a um número menor de categorias torna-se mais compreensível. Fala frases mais complexas e as palavras comunicam o conteúdo de sua imaginação, sendo utilizadas para falar de coisas que não estão presentes. Assume papéis diferentes conforme fala com diferentes membros da família: é um bebê ao falar com a mamãe ou uma imitação dessa ao falar com o irmão mais novo. Segue a lógica do mundo real no seu mundo de fantasia.<br /><br />
				O que pode estar fazendo nesse período:
				<ul>
                	<li>É capaz de correr e subir escadas, com apoio do corrimão.</li>
                    <li>Descobre que cada coisa tem um nome e pergunta o nome de tudo. </li>
                    <li>Gosta de brincar com outras crianças. </li>
                    <li>Começa a ajudar a se vestir e a colocar os sapatos.</li>
				</ul>
                <p align="right">Autora: Dra. Rosa Resegue Ferreira da Silva – Médica</p>
			</p>
        </div>
</div>
<!---------------------JARDIM I--------------------->
<div>
    <p id="turmasJardimIClique" class="linkTurmas">Jardim I</p>
        <div id="turmasJardimI" class="conteudoTurmas">
            <p>Para  crianças entre 3 anos e 3 anos e 11 meses de idade.</p>
            <p><em>Desenvolvimento  esperado:</em></p>
            <p><strong>3 a 4 anos</strong> <br>
            	Usa períodos simples e compostos (coordenados com "e"/"mas" e subordinados com "porque"/"que") com 5 e 6 elementos. Surgem as orações interrogativas com os pronomes "quem" e "qual". Faz uso de preposições e artigos, tempos verbais no presente, passado e futuro composto, mas há desvios de concordância tanto nominal como verbal. Exemplos:<br />
                "Foi eu que comei o doce."<br />
                "Esse nenê chora e fazi xixi."<br />
                "Ela não deixa mas eu vou."<br />
                <p align="right">Autora: Simone R. de Vasconcellos Hage - Fonoaudióloga</p>
            </p>
		</div>
</div>
<!---------------------JARDIM II--------------------->
<div>
    <p id="turmasJardimIIClique" class="linkTurmas">Jardim II</p>
        <div id="turmasJardimII" class="conteudoTurmas">
        <p>Para  crianças entre 4 anos e 4 anos e 11 meses de idade.</p>
        <p><em>Desenvolvimento  esperado: </em></p>
        <p><strong>4 a 5 anos</strong> <br>
        	Usa períodos simples e compostos (incluindo os subordinados com "se" e "quando"). Uso de pronomes e artigos corretamente flexionados quanto ao gênero. Usa corretamente s principais tempos verbais (presente, passado, futuro composto) para verbos regulares. Usa e compreende vários pronomes indefinidos: outro, ninguém, alguém. Apresenta entre 600 e 1500 palavras com significado lexical e gramatical. Estruturas pouco conhecidas ainda podem apresentar desvios de concordância, principalmente verbos irregulares. Exemplo:<br />
            "Eu almoço se tive batata fita."<br />
        	"Vô toma banho quando eu acaba de brincá."<br />
        	"Eu trazo pra você."<br />
            <p align="right">Autora: Simone R. de Vasconcellos Hage - Fonoaudióloga</p>
        </p>
    </div>
</div>
<!---------------------JARDIM III--------------------->
<div>
    <p id="turmasJardimIIIClique" class="linkTurmas">Jardim III</p>
        <div id="turmasJardimIII" class="conteudoTurmas">
            <p>Para  crianças entre 5 e 6 anos de idade.</p>
            <p><em>Desenvolvimento  esperado:</em></p>
            <p><strong>Entre 5 e  6 anos</strong> <br>
            Na  narrativa, consegue manter a organização temporal dos fatos, mesmo omitindo  alguns fatos secundários, mas que não prejudicam o entendimento da narrativa.  Não insere mais fatos não verdadeiros só para manter a história: se não lembra,  diz que não lembra.</p>
            <p><strong>Após 6 ou  7 anos</strong><br>
            Interessa-se  pelas horas do relógio (as atividades escolares contribuem significativamente  para esse interesse). Há estabilidade no uso de advérbios de tempo mais comuns  (ontem, /hoje/amanhã; manhã/tarde/noite; antes/depois). Corrige a si mesma  quando percebe que não é compreendida.</p>
            <p align="right">Autora: Simone R. de Vasconcellos Hage - Fonoaudióloga</p>
        </div>
</div>
<!---------------------ATIVIDADES--------------------->
<div>
    <p id="turmasAtividadesClique" class="linkTurmas">Atividades</p>
        <div id="turmasAtividades" class="conteudoTurmas">
            <p>Selecionamos  atividades apropriadas a cada faixa etária buscando estimular a criatividade e  a socialização das crianças, proporcionando momentos de prazer e alegria.</p>
            <p><strong>Judô:</strong> melhora o preparo  psicológico, estimula o respeito ao próximo, aumenta a capacidade aeróbica e o  equilíbrio emocional, além da socialização.<br>
            <em>Para turmas de Jd. I,  II e III.</em></p>
            <p><strong>Informática: </strong>aprimora o raciocínio  e o senso crítico,<strong> </strong>aumenta a  criatividade e a assimilação de conceitos abstratos. A criança começa brincando  no computador, aprende a mexer o mouse, jogar e trabalhar com conceitos básicos  como cores, números e formas geométricas, reforçando a aprendizagem formal.<br>
            <em>Para turmas de Jd. I,  II e III.</em></p>
            <p><strong>Natação: </strong>além dos benefícios  físicos da natação, como aprimoramento das funções respiratórias, prevenção e  combate a alergias, a água é um meio propício<strong> </strong>para o desenvolvimento da imagem corporal, assim como para o  fortalecimento da autoconfiança.<br>
            <em>Para todas as turmas.</em></p>
            <p><strong>Ballet: </strong>a aula de dança é um  convite a vivenciar com prazer a arte do movimento. O movimento é usado como  fonte de relaxamento e expansão, proporcionando saúde física e mental, e uma  compreensão mais harmônica do corpo.<br>
            <em>Para turmas de Jd. I,  II e III.</em></p>
            <p><strong>Inglês</strong>: as aulas de inglês  buscam conexão com o mundo da criança através de músicas, histórias, brincadeiras  e situações da vida real. O objetivo é promover uma aprendizagem natural, a  familiarização com as palavras e expressões como também a pronúncia correta de  sons existentes na língua inglesa.<br>
            <em>Para turmas de Jd. I,  II e III.</em></p>
        </div>
</div>
</div>
<?PHP
	Require('footer.php');
?>