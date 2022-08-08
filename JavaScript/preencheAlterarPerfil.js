async function getAnunciante() {
    try {
        let response = await fetch("../PHP/perfilAlterar.php");
        if(!response.ok) throw new Error(response.statusText);
        let anunciante = await response.json();

        return anunciante;
    } catch(e) {
        console.log(e);
        alert('Não foi possível pegar seus dados!');
    }
}

window.onload = async function () {
    let anuncio = await getAnunciante();
    
    let inputNome = document.querySelector("#nome");
    let inputCpf = document.querySelector("#cpf");
    let inputTelefone = document.querySelector("#telefone");
    let inputSenha = document.querySelector("#senha");

    inputNome.value = anunciante.nome;
    inputCpf.value = anunciante.cpf;
    inputTelefone.value = anunciante.telefone;
    inputSenha.value = anunciante.cep;
}