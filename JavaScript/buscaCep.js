async function buscaEndereco(cep) {
    try {
        const response = await fetch("../PHP/buscaCep.php?cep=" + cep);

        if (! response.ok) throw new Error("Falha inesperada: " + response.status);

        const endereco = await response.json();

        const cidade = document.getElementById("cidade");
        const estado = document.getElementById("estado");
        const bairro = document.getElementById("bairro");

        cidade.value = endereco.cidade;
        estado.value = endereco.estado;
        bairro.value = endereco.bairro;

    }
    catch (e) {
        console.error(e);
    }
}

window.onload = function (){

    var cep = window.document.getElementById("cep");
    cep.addEventListener("change", buscaEndereco(cep.value));
}