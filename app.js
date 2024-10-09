const texto = document.querySelector("#texto");
const botonContar = document.querySelector("#botonContar");
const resultado = document.querySelector("#resultado");
const resultado1 = document.querySelector("#resultado1");





botonContar.addEventListener("click", e => {
    e.preventDefault();
    contarPalabras();
    palabrasUnicas();
    textoVacio();
    palabrasRepetidas();
    contarCaracteres();
}, false);

function contarPalabras() {

    const palabras = texto.value.split(" ");
    resultado.innerHTML = `<p>El texto tiene ${palabras.length} palabras</p>`;

}


function palabrasUnicas() {
    const palabras = new Set(texto.value.split(" "));
    resultado.innerHTML += `<p>El texto tiene ${palabras.size} palabras únicas</p>`;
}

function textoVacio() {
    if (texto.value === "") {
        resultado.innerHTML = `<p>El texto está vacío</p>`;
    }
}

function palabrasRepetidas() {
    const palabras = texto.value.split(" ");
    const palabrasRepetidas = {};
    for (let i = 0; i < palabras.length; i++) {
        if (palabrasRepetidas[palabras[i]]) {
            palabrasRepetidas[palabras[i]]++;
        } else {
            palabrasRepetidas[palabras[i]] = 1;
        }
    }
    //número de palabras repetidas
    let numeroPalabrasRepetidas = 0;
    for (let palabra in palabrasRepetidas) {
        if (palabrasRepetidas[palabra] > 1) {
            numeroPalabrasRepetidas++;
        }
    }

    resultado.innerHTML += `<p>El texto tiene ${numeroPalabrasRepetidas} palabras repetidas</p>`;
    resultado.innerHTML += `<p>Las palabras repetidas son:`;
    for (let palabra in palabrasRepetidas) {
        if (palabrasRepetidas[palabra] > 1) {
            resultado.innerHTML += `${palabra} - ${palabrasRepetidas[palabra]}, `;
        }
    }
}

//contar caracteres con y sin espacios
function contarCaracteres() {
    let caracteresConEspacios = texto.value.length;
    let caracteresSinEspacios = texto.value.replace(/\s/g, "").length;
    resultado.innerHTML += `<p>El texto tiene ${caracteresConEspacios} caracteres con espacios</p>`;
    resultado.innerHTML += `<p>El texto tiene ${caracteresSinEspacios} caracteres sin espacios</p>`;
    resultado.innerHTML += `<p>El texto tiene ${caracteresConEspacios - caracteresSinEspacios} espacios</p>`;
}


