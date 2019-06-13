window.onload = function(){
	var map;
	//um objeto é criado assim {}.
	function iniciar(){ //Função para iniciar o mapa
		/*Criamos abaixo um objeto {} e dentro terá as propriedades
			da variável mapPropriedades.
		*/
		var mapPropriedades = { //propriedades do mapa
			center: new google.maps.LatLng(-23.5999512, -46.72015025), //localização
			scrollwheel: false, //será falso, não vai funcionar no mapa
			zoom:17, //zoom do mapa, quanto maior mais perto ficará
			mapTypeId: 'roadmap' //é o tipo do mapa que vai aparecer	
			//Outros tipos de mapa
				//mapTypeId: 'roadmap'
				//mapTypeId: 'satellite' 
				//mapTypeId: 'terrain'
				//mapTypeId: 'hybrid'
				//MapTypeId:google.maps.MapTypeId.ROADMAP jeito da danki code	
			
		}
		//usar a variável map que foi declarada lá em cima.
		/* a variável map está pegando o elemento pelo id ("mapa").
			esse id foi definido lá na página index na classe map com um id mapa.*/
		map = new google.maps.Map(document.getElementById("map"), mapPropriedades);
			//e pegando as propriedades do objeto mapPropriedades.
	}

	function adicionarMarcador(lat, long, icon, content){ //função para adicionar um marcador ao mapa
		var latlng = {'lat':lat,'lng':long}; //latitude e longitude
		var marcador = new google.maps.Marker({ //o parâmetro desse marcador vai ser um objeto
			//parâmetro é tudo o que está dentro do ()
			position:latlng, //a posição é de acordo com a variável latlng
			map:map, //o map vai fazer referência a variável map do mapa que inicializa o mapa
			icon:icon //icon vai ser referente ao parâmetro icon da função adicionarMarcador
		}); //marcador do mapa
		
		var infoJanela = new google.maps.InfoWindow({
			content:content, //content vai ser referente ao parâmetro content da função adicionarMarcador
			maxWidth:300, //tamanho da janela do conteúdo
			pixelOffset: new google.maps.Size(0,10) //vai movimentar a box do conteúdo
		});
		/*
		google.maps.event.addListener(marcador, 'click', function(){
			infoJanela.open(map,marcador);
		}); //Aqui vai impedir que conteúdo seja aberto assim que iniciar o mapa
		*/

		infoJanela.open(map,marcador);
	}

	iniciar();

	var conteudo = '<p style="color:black;font-weight:lighter;padding:5px;font-size:15px;">Meu local</p>'
		//passa primeiro latitude, depois longitude, depois icon e depois conteudo
	adicionarMarcador(-23.5999512, -46.72015025, '', conteudo); 
		/*
		Pra adicionar outra marca é só chamar novamente o adicionarMarcador
		e adicionar uma nova latitude, longitude, icone e conteudo.
		*/
	//adicionarMarcador(-23.59977875, -46.7183733, '', conteudo); 	

    /*
	setTimeout(function(){ //função de intervalo
		map.panTo({'lat':-23.550520,'lng':-46.633309});
	},3000); /*significa que depois de 2000 (2 segundos) o mapa será atualizado 
		para as coordenadas definidas acima.
	
	map.setZoom(15); //esse zoom vai alterar aquele definido lá em cima tbm
    */
}
