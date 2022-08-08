

window.addEventListener("load",function () {

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

        console.log(response);

        for (item of response){

            var opt = window.document.createElement("option");
            opt.value = item.codigo;
            opt.innerText = item.nome;

            select.appendChild(opt);
        }
    }

    xhr.send();
});
