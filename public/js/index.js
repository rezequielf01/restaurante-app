// PRELOADER
window.onload = function(){
    document.getElementById("preloader").style.opacity = 0;
    document.getElementById("preloader").style.zIndex = -1;
  }


// SWEET ALERTS
function horariosAlert() {
    Swal.fire({
        title: '<i class="fa fa-clock-o" aria-hidden="true"></i> Horarios de atencion',
        html: `<div style="display:flex; justify-content: space-between;"><p>Lunes</p> <span>09:30 - 22:00</span></div><br>
        <div style="display:flex; justify-content: space-between;"><p>Martes</p> <span>09:30 - 22:00</span></div><br>
        <div style="display:flex; justify-content: space-between;"><p>Miercoles</p> <span>09:30 - 22:00</span></div><br>
        <div style="display:flex; justify-content: space-between;"><p>Jueves</p> <span>09:30 - 22:00</span></div><br>
        <div style="display:flex; justify-content: space-between;"><p>Viernes</p> <span>09:30 - 22:00</span></div><br>
        <div style="display:flex; justify-content: space-between;"><p>Sabado</p> <span>09:30 - 22:00</span></div>`,
      });
}

function wifiAlert() {
    Swal.fire({
        title: '<i class="fa fa-wifi" aria-hidden="true"></i> Clave wifi',
        html: `<div style="display:flex; flex-direction:column; justify-content: center;">
        Usuario: <b>Raicesrestaurante</b><br>
        Contraseña: <b>abc1234</b>
        </div>`,
      });
}