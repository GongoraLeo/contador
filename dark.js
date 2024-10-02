const dark = document.querySelector('.dark');

let mode = 0;
dark.addEventListener('click', () => {
    if (mode == 0) {
        document.body.style.backgroundColor = 'rgb(66, 66, 66)';
        document.body.style.color = 'white';
        //cambiar la imagen de fondo de dark
        dark.src = 'img/modo-clarob.png';

        
        mode = 1;
    } else {
        document.body.style.backgroundColor = 'white';
        document.body.style.color = 'black';
        dark.src = 'img/modo-claro.png'
        mode = 0;
    }
});
