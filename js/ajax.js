/**
 * Função para criar um objeto XMLHTTPRequest
 */
function CriaRequest() {
	try {
		request = new XMLHttpRequest();
	} catch (IEAtual) {

		try {
			request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch(IEAntigo) {

			try {
				request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(falha) {
				request = false;
			}
		}
	}

	if (!request)
		alert("Seu Navegador não suporta Ajax!");
	else
		return request;
}

/**
 * Função para enviar os dados
 */

function getDados() {

	// Declaração de Variáveis
	var valor = document.getElementById("valor").value;
	var parametro = document.getElementById("parametro").value;
	var dtini = document.getElementById("dtini").value;
	var dtfim = document.getElementById("dtfim").value;
	var todos = document.getElementById("todos").value;
	var result = document.getElementById("Resultado");
	var xmlreq = CriaRequest();

	// Exibi a imagem de progresso
	result.innerHTML = '<img src="Progresso1.gif"/>';

	// Monta a requisição
	xmlreq.open("GET", "parser.php?valor=" + valor + "&param=" + parametro + "&dtini=" + dtini + "&dtfim=" + dtfim + "&todos=" + todos, true);

	// Atribui uma função para ser executada sempre que houver uma mudança de estado
	xmlreq.onreadystatechange = function() {

		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {

			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			} else {
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);
}

function getClientes() {
	var valor = document.getElementById("valor").value;
	var parametro = document.getElementById("parametro").value;
	var result = document.getElementById("Resultado");
	var xmlreq = CriaRequest();

	// Exibi a imagem de progresso
	result.innerHTML = '<img src="Progresso1.gif"/>';

	// Monta a requisição
	xmlreq.open("GET", "lista.php?valor=" + valor + "&param=" + parametro, true);

	// Atribui uma função para ser executada sempre que houver uma mudança de estado
	xmlreq.onreadystatechange = function() {

		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {

			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			} else {
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);

}
function getCadClientes($div,$valor) {
	var valor  = $valor; 
	var result = document.getElementById($div);
	var xmlreq = CriaRequest();
    
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="Progresso1"/>';

	// Monta a requisição
	xmlreq.open("GET", "vercadastro.php?id=" + valor, true);
	

	// Atribui uma função para ser executada sempre que houver uma mudança de estado
	xmlreq.onreadystatechange = function() {

		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {

			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			} else {
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);

} 
function getCadUser($div,$valor) {
	var valor  = $valor; 
	var result = document.getElementById($div);
	var xmlreq = CriaRequest();
    
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="Progresso1.gif"/>';

	// Monta a requisição
	xmlreq.open("GET", "vercadpartners.php?id=" + valor, true);
	

	// Atribui uma função para ser executada sempre que houver uma mudança de estado
	xmlreq.onreadystatechange = function() {

		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {

			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			} else {
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);

}
function getUsers($div) {
	
	var valor = document.getElementById("valor").value;
	var parametro = document.getElementById("parametro").value;
	var result = document.getElementById($div);
	var xmlreq = CriaRequest();

	// Exibi a imagem de progresso
	result.innerHTML = '<img src="Progresso1.gif"/>';

	// Monta a requisição
	xmlreq.open("GET", "listuser.php?valor=" + valor + "&param=" + parametro, true);

	// Atribui uma função para ser executada sempre que houver uma mudança de estado
	xmlreq.onreadystatechange = function() {

		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {

			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			} else {
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);

} 

function getSenha(div,sisid,formName,actionName) {
	var hiddenControl = 'serialcod';
	var theForm       = document.getElementById(formName);
	var valor         = sisid;	
	var result        = document.getElementById($div);
	var xmlreq        = CriaRequest();
	// Exibi a imagem de progresso
	result.innerHTML = '<img src="Progresso1.gif"/>';
	
	hiddenControl.value = actionName;	
	// Monta a requisição
	xmlreq.open("POST",theForm.submit(), true);

	// Atribui uma função para ser executada sempre que houver uma mudança de estado
	xmlreq.onreadystatechange = function() {

		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {

			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			} else {
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);

}
function DelUsers(div,table,valor) {
	
	var valor = document.getElementById("valor").value;
	var parametro = document.getElementById("parametro").value;
	var result = document.getElementById($div);
	var xmlreq = CriaRequest();

	// Exibi a imagem de progresso
	result.innerHTML = '<img src="Progresso1.gif"/>';

	// Monta a requisição
	xmlreq.open("GET", "listuser.php?valor=" + valor + "&param=" + parametro, true);

	// Atribui uma função para ser executada sempre que houver uma mudança de estado
	xmlreq.onreadystatechange = function() {

		// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
		if (xmlreq.readyState == 4) {

			// Verifica se o arquivo foi encontrado com sucesso
			if (xmlreq.status == 200) {
				result.innerHTML = xmlreq.responseText;
			} else {
				result.innerHTML = "Erro: " + xmlreq.statusText;
			}
		}
	};
	xmlreq.send(null);

} 
 
