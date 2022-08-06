async function requisicaoAjax(uri) {
    try {
        let respose = await fetch(uri);
        if(!respose.ok) throw new Error(respose.statusText);
        return await respose.json();
    } catch(e) {
        console.log(e);
        return;
    }
}

function mostraProdutos(objJS) {
    let arrayProdutos = objJS.anuncios;
    let section = document.querySelector("#prod-section");
    let template = document.querySelector("#template");
    let qtdProd = section.childElementCount;

    for(let i = qtdProd; i < qtdProd + 10; ++i) {
        if(i >= arrayProdutos.length)
            break;

        let html = template.innerHTML
            .replace("{{prod-imagem}}", arrayProdutos[i].imagePath)
            .replace("{{prod-nome}}", arrayProdutos[i].nome)
            .replace("{{prod-peco}}", arrayProdutos[i].preco)
            .replace("{{prod-descricao}}", arrayProdutos[i].descricao);

        section.insertAdjacentElementHTML("beforeend", html);
    }
}

function requisitaAnuncios(strKeyWords) {
    let uri = "../PHP/buscaAnuncios.php?busca=";
    let contagem = 0;
    var palavra = "";
    var ehPrimeira = true;

    for(let letra of strKeyWords) {
        if(letra === " ") {
            if(palavra !== "") {
                if(!ehPrimeira)
                    uri = uri + ";";
                else
                    ehPrimeira = false;

                uri = uri + palavra;
                ++contagem;

                palavra = "";
            }
        } else
            palavra = palavra + letra;

        if(contagem >= 5)
            break;
    }

    let objJS = requisicaoAjax(uri);
    mostraProdutos(objJS);
}

window.onload = function () {
    let inputBusca = document.querySelector("#busca");
    inputBusca.onkeyup = function (event) {
        if(event.key === "Enter") {
            let section = document.querySelector("#prod-section");
            section.innerHTML = "";

            requisitaAnuncios(inputBusca.value);
        }
    }
};

window.onscroll = function () {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        requisitaAnuncios(inputBusca.value);
    }
};