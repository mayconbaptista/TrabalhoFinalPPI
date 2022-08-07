async function getIds() {
    try {
        let response = await fetch("../PHP/anunciosConta.php");
        if(!response.ok) throw new Error(response.statusText);
        let anuncios = await response.json();

        return anuncios;

    } catch(e) {
        console.log(e);
        alert('Não foi possível achar os ids dos anuncios');
    }
}

window.onload = function () {
    let anuncios = getIds();
    let select = document.querySelector('#id');

    for(let anuncio of anuncios.arr) {
        let option = document.createElement('option');
        
        option.value = anuncio.codigo;
        option.textContent = anuncio.titulo;

        select.appendChild(option);
    }
}