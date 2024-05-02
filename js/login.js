//declaracion de variable para obtener los inputs del formulario de login html
const inputs = document.querySelectorAll(".input");

//creacion de funcion para que ocurra el focus
function addcl(){
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}


function remcl() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}

//añadiendo la funcion del focus a los inputs
inputs.forEach(input => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});

//inicio del focus al abrir la pagina
window.addEventListener('load', function () {
    inputs[0].focus();
});
