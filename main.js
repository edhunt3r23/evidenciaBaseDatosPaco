function mostrarSeccion(id) {
    var seccion = document.getElementById(id);
    
    if (seccion.classList.contains("show")) {
      // Si la sección actual ya está visible, la oculta
      seccion.classList.remove("show");
    } else {
      // Oculta todas las secciones
      var secciones = document.getElementsByClassName("seccion");
      for (var i = 0; i < secciones.length; i++) {
        secciones[i].classList.remove("show");
      }
      
      // Muestra la sección actual
      seccion.classList.add("show");
    }
}
function mostrarSubSeccion(id) {
    var subSeccion = document.getElementById(id);
    
    if (subSeccion.style.display === "block") {
      // Si la subsección actual ya está visible, la oculta
      subSeccion.style.display = "none";
    } else {
      // Oculta todas las subsecciones
      var subSecciones = document.getElementsByClassName("subseccion");
      for (var i = 0; i < subSecciones.length; i++) {
        subSecciones[i].style.display = "none";
      }
      
      // Muestra la subsección actual
      subSeccion.style.display = "block";
    }
  }

  window.onload = function() {
    // Oculta todas las subsecciones
    var subSecciones = document.getElementsByClassName("subseccion");
    for (var i = 0; i < subSecciones.length; i++) {
      subSecciones[i].style.display = "none";
    }
  }