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

window.onload = function () {
    let anuncio = getAnunciante();
    
    let inputNome = document.querySelector("#nome");
    let inputCpf = document.querySelector("#cpf");
    let inputTelefone = document.querySelector("#telefone");
    let inputSenha = document.querySelector("#senha");

    inputNome.textContent = anunciante.nome;
    inputCpf.textContent = anunciante.cpf;
    inputTelefone.textContent = anunciante.telefone;
    inputSenha.textContent = anunciante.cep;
}