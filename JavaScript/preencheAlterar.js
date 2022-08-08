async function getAnuncio() {
    try {
        let response = await fetch("../PHP/anuncioAlterar.php");
        if(!response.ok) throw new Error(response.statusText);
        let anuncio = await response.json();

        let inputTitulo = document.querySelector("#titulo");
        let inputDescricao = document.querySelector("#descricao");
        let inputPreco = document.querySelector("#preco");
        let inputData = document.querySelector("#data_hora");
        let inputCep = document.querySelector("#cep");
        let inputBairro = document.querySelector("#bairro");
        let inputCidade = document.querySelector("#cidade");
        let selectEstado = document.querySelector("#estado");

        inputTitulo.value = anuncio.titulo;
        inputDescricao.value = anuncio.descricao;
        inputPreco.value = anuncio.preco;
        inputData.value = anuncio.data;
        inputCep.value = anuncio.cep;
        inputBairro.value = anuncio.bairro;
        inputCidade.value = anuncio.cidade;
        selectEstado.value = anuncio.estado;

    } catch(e) {
        console.log(e);
        alert('Não foi possível pegar dados do anúncio!');
    }
}

window.onload = getAnuncio();