async function getAnuncio() {
    try {
        let response = await fetch("../PHP/anuncioAlterar.php");
        if(!response.ok) throw new Error(response.statusText);
        let anuncio = await response.json();

        return anuncio;
    } catch(e) {
        console.log(e);
        alert('Não foi possível pegar dados do anúncio!');
    }
}

window.onload = function () {
    let anuncio = getAnuncio();
    
    let inputTitulo = document.querySelector("#titulo");
    let inputDescricao = document.querySelector("#descricao");
    let inputPreco = document.querySelector("#preco");
    let inputData = document.querySelector("#data_hora");
    let inputCep = document.querySelector("#cep");
    let inputBairro = document.querySelector("#bairro");
    let inputCidade = document.querySelector("#cidade");
    let selectEstado = document.querySelector("#estado").childNodes();

    inputTitulo.textContent = anuncio.titulo;
    inputDescricao.textContent = anuncio.descricao;
    inputPreco.textContent = anuncio.preco;
    inputData.textContent = anuncio.data;
    inputCep.textContent = anuncio.cep;
    inputBairro.textContent = anuncio.bairro;
    inputCidade.textContent = anuncio.cidade;
    selectEstado.value = anuncio.estado;
}