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
    let qtdProd = section.childElementCount;

    for(let i = qtdProd; i < qtdProd + 10; ++i) {
        if(i >= arrayProdutos.length)
            break;

        let novaDiv = document.createElement('div');
        let img = document.createElement('img');
        let h4 = document.createElement('h4');
        let p1 = document.createElement('p');
        let p2 = document.createElement('p');

        img.className = "anuncio-imagem";
        img.alt = arrayProdutos[i].imagePath;
        img.src = arrayProdutos[i].imagePath;

        h4.className = "anuncio-nome";
        h4.textContent = arrayProdutos[i].nome;
        
        p1.className = "anuncio-preco";
        p1.textContent = arrayProdutos[i].preco;

        p2.className = "anuncio-descricao";
        p2.textContent = arrayProdutos[i].descricao;

        novaDiv.appendChild(img);
        novaDiv.appendChild(h4);
        novaDiv.appendChild(p1);
        novaDiv.appendChild(p2);
        section.appendChild(novaDiv);
    }

    let h4s = document.querySelectorAll(".anuncio-nome");
    for(let h4 of h4s) {
        h4.onclick = () => {
            window.location.href = "../Publico/exibeAnuncio.php?nome=" + h4.textContent;
        }
    }
}

async function requisitaAnuncios(strKeyWords) {
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

    let objJS = await requisicaoAjax(uri);
    mostraProdutos(objJS);
}

window.addEventListener("load", function () {
    let inputBusca = document.querySelector("#busca");
    inputBusca.onkeyup = function (event) {
        if(event.key === "Enter") {
            let section = document.querySelector("#prod-section");
            section.innerHTML = "";

            requisitaAnuncios(inputBusca.value);
        }
    }
});

window.onscroll = function () {
    let inputBusca = document.querySelector("#busca");

    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        requisitaAnuncios(inputBusca.value);
    }
};