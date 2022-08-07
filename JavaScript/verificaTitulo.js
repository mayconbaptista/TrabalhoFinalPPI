async function requisicao() {
    try {
        let input = document.querySelector('#titulo');

        const response = await fetch("../PHP/verificaTituloAnuncio.php?titulo=" + input.value);
        if(!response.ok) throw new Error(response.statusText);
        const objJS = await response.json();

        return objJS.naoEsta;

    } catch(error) {
        console.error(error);
        alert('Você já tem um anúncio com esse título!');
    }
}

window.onload = function () {
    let form = document.querySelector("#myForm");

    form.onsubmit = e => {
        if(!requisicao())
            e.preventDefault();
    };
}