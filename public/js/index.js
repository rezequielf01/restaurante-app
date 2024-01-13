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

// CATEGORIES NAV FIX
$(window).scroll(function() {
  let categoriesNav = $(".categories");
  let foodContainer = $(".foods-section");
  var scrollTop = $(window).scrollTop();
  if ( scrollTop > 500 && screen.width >= 1920) { 
    $(categoriesNav).css({ "background-color": "#0c0c0c",
    "position": "fixed", "top": "10vh", "left": "0", "transition": "var(--trans-02)", "z-index": "100"});
    $(foodContainer).css({ "margin-top": "60px",});
  }
  else {
    $(categoriesNav).css({ "background-color": "white",
    "position": "static", "top": "10vh", "left": "0",});
    $(foodContainer).css({ "margin-top": "25px",});
  }
});

// CAROUSEL SLICK SLIDER
$('.food-carousel').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 1025,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: false,
          dots: true
        }
      },
      {
        breakpoint: 769,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: false,
          dots: true
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
