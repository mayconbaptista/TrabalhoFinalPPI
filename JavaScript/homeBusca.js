function trataNomesBusca () {
    var nomes = document.getElementById("busca").value;
    let palavras = "%";
    let contagem = 0;

    if(nomes.value == "") {
        alert("Digite algo para buscar");
        return;
    }

    for(let letra of nomes) {
        if(letra === " ") {
            palavras = palavras + "%;%";
            ++contagem;

        } else
            palavras = palavras + letra;

        if(contagem >= 5)
            break;
    }

    return palavras + "%";
}

function renderProducts(objJS) {
    let arrayProdutos = objJS.anuncios;
    let section = document.querySelector("#prod-section");
    section.innerHTML = "";
    let qtdProd = section.childElementCount;

    for(let i = 0; i < qtdProd + arrayProdutos.length; ++i) {
        let novaDiv = document.createElement('div');
        let novaDiv2 = document.createElement('div');
        let img = document.createElement('img');
        let h3 = document.createElement('h3');
        let h4 = document.createElement('h4');
        let p2 = document.createElement('p');

        img.className = "anuncio-imagem";
        img.alt = "Imagem do anúncio " + arrayProdutos[i].nome;
        img.dataset.aux = arrayProdutos[i].imagePath;
        img.src = arrayProdutos[i].imagePath;
        img.width = 300;
        img.height = 300;

        h3.className = "anuncio-nome";
        h3.textContent = arrayProdutos[i].nome;
        
        h4.className = "anuncio-preco";
        h4.textContent = arrayProdutos[i].preco;

        p2.className = "anuncio-descricao";
        p2.textContent = arrayProdutos[i].descricao;

        novaDiv2.className = "anucio-inf";
        novaDiv2.appendChild(h3);
        novaDiv2.appendChild(h4);
        novaDiv2.appendChild(p2);

        novaDiv.className = "anuncio";
        novaDiv.appendChild(img);
        novaDiv.appendChild(novaDiv2);
        section.appendChild(novaDiv);
    }

    let h4s = document.querySelectorAll(".anuncio-nome");
    for(let h4 of h4s) {
        let divPai = h4.parentElement;
        var img = divPai.previousSibling;
        h4.onclick = () => {
            window.location.href = "http://ppimteus.atwebpages.com/trabalhoFinal//Publico/exibeAnuncio.php?imagePath=" + img.dataset.aux;
        }
    }
}

window.addEventListener("load", function(){
    var btnBusca = window.document.getElementById("btn");
    btnBusca.addEventListener("click", function (){
        var nomes = trataNomesBusca();    
        let xhr = new XMLHttpRequest();
        let section = document.querySelector("#prod-section");

        xhr.open("POST", "PHP/buscaAnuncios.php?palavras=" + nomes, true);

        xhr.onload = function () {
            if(xhr.status != 200) {
                alert("Erro " + xhr.statusText);
                return;
            }
            
            var response = JSON.parse(xhr.responseText);
            section.innerHTML = "";
            renderProducts(response);
        }

        xhr.send();
    }); 
});

window.onscroll = function () {
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        var nomes = trataNomesBusca();    
        let xhr = new XMLHttpRequest();

        xhr.open("POST", "PHP/buscaAnuncios.php?palavras=" + nomes, true);

        xhr.onload = function () {
            if(xhr.status != 200) {
                alert("Erro " + xhr.statusText);
                return;
            }
            
            var response = JSON.parse(xhr.responseText);
            renderProducts(response);
        }

        xhr.send();
  }
};