async function buscaEndereco(cep) {
    try {
        const response = await fetch("../privado/busEndAjax.php?cep=" + cep);

        if (! response.ok) throw new Error("Falha inesperada: " + response.status);

        const endereco = await response.json();

        //const cidade = document.querySelector("form");
        const cidade = document.getElementById("cidade");
        const estado = document.getElementById("estado");


        cidade.value = endereco.cidade;
        estado.value = endereco.estado;
    }
    catch (e) {
        console.error(e);
    }
}

window.onload = function () {
    const inputCep = document.querySelector("#cep");
    inputCep.onchange = () => buscaEndereco(inputCep.value);
}