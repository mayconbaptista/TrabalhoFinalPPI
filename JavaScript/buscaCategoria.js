/*
function busca_anuncio (anuncioId){

    fetch("teste.php?anuncioId="+anuncioId)
        .then(function (response){
        {
            if(!response.ok) throw new Error("erro");

            return response.json();
        }
        }).then(function (resposta){
            console.log(resposta);

            window.document.getElementById("anunciante").value = resposta.anunciante;
            window.document.getElementById("titulo").value = resposta.titulo;
            window.document.getElementById("descricao").value = resposta.descricao;
            window.document.getElementById("preco").value = resposta.preco;
            window.document.getElementById("data_hora").value = resposta.data_hora;
            window.document.getElementById("cep").value = resposta.cep;
            window.document.getElementById("bairro").value = resposta.bairro;
            window.document.getElementById("cidade").value = resposta.cidade;
            //window.document.getElementById("estado").value = resposta.estado;
            window.document.getElementById("categoria").value = resposta.categoria;
        });

}
                        
window.onload = function (){
            
    var stringUrl = window.location.search;
    const UrlPamametros =  new URLSearchParams(stringUrl);
    var aux = UrlPamametros.get("anuncioId");
    
    if(aux){
        busca_anuncio(aux);
    }
}
*/

window.onload = function () {

    var xhr = new XMLHttpRequest();
    xhr.open("GET","../PHP/buscaCategoria.php",true);
    xhr.onload = function (){

        if(xhr.status != 200)
        {
            console.log("Erro na busca do endereço!");
            return;
        }
        
        var response = JSON.parse(xhr.responseText);

        var select = window.document.getElementById("categoria");

        if(!select){
            console.log("select categoria não encontrado!");
            return;
        }

        for (item of response){

            var opt = window.document.createElement("option");
            opt.value = item.id;
            opt.innerText = item.nome;

            select.appendChild(opt);
            console.log(opt.text);
        }
    }

    xhr.send();
}
