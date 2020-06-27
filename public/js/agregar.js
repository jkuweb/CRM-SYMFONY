function agregar() {
    var padre = document.getElementById('padre');
    var hijo = padre.lastElementChild;
    var capa = document.createElement('div');
    capa.setAttribute('class', 'form-group hijo');
    padre.appendChild(capa);
    padre.lastElementChild.innerHTML = hijo.innerHTML;
}

function eliminar(elemento) {
    var hijo= elemento.parentNode.parentNode;
    var padre = document.getElementById('padre');
    var n = padre.children.length;
    if (n > 1) {
        padre.removeChild(hijo);
    } else {
        hijo.children[1].children[0].value = "";
    }
}

