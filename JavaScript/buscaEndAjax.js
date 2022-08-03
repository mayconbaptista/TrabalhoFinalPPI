async function buscaEndereco(cep) {
    try {
        const response = await fetch("../CRUDs/busEndAjax.php?cep=" + cep);

        if (! response.ok) throw new Error("Falha inesperada: " + response.status);

        const endereco = await response.json();

        const cidade = document.getElementById("cidade");
        const estado = document.getElementById("estado");
        const bairro = document.getElementById("bairro");

        //alert("bairro = " + bairro + " " + endereco.bairro);
        cidade.value = endereco.cidade;
        estado.value = endereco.estado;
        bairro.value = endereco.bairro;

    }
    catch (e) {
        console.error(e);
    }
}

async function buscaCategorias() {
    try {
        const response = await fetch("../CRUDs/busca_categoria.php");

        if (!response.ok) throw new Error("Falha inesperada: " + response.status);

        const endereco = await response.json();

        const categoria = document.getElementById("categoria");

        endereco.forEach(element => {
            
            const novo = window.document.createElement('option');
            novo.value = element.id;
            novo.innerHTML = element.nome;
            categoria.appendChild(novo);
            console.log(novo);
        });
    }
    catch (e) {
        console.error(e);
    }
}

window.onload = function () {
    const inputCep = document.querySelector("#cep");
    inputCep.onchange = () => buscaEndereco(inputCep.value);
}

window.onload = buscaCategorias();
