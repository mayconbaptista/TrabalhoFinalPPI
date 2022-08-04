function buscaAnuncios(pesquisa) {
    let palavrasChaves = [];

    for(let i = 0; i < pesquisa.length; ++i) {
        if(pesquisa[i] === ' ') {
            let palavra = ''
            for(let j = 0; j < i; ++j)
                palavra = palavra . pesquisa[j];

            palavrasChaves.push(palavra);
        }
    }
}


window.onload = function () {
    const buscaInput = document.querySelector('.busca-input');
    buscaInput.onkeyup = function (event) {
        if(event.key === 'Enter' && buscaInput.value !== '')
            buscaAnuncios(buscaInput.value);
    }
}