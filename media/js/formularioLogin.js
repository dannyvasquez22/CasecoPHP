$(document).ready(function(){

// Recorrer los elementos y hacer que onchange ejecute una funcion para comprobar el valor de ese input
  var formulario = document.formulario_login,
    elementos = formulario.elements;

  // Funcion que se ejecuta cuando el evento click es activado
  var validarInputs = function() {
    for (var i = 0; i < elementos.length; i++) {
      // Identificamos si el elemento es de tipo texto, email, password, radio o checkbox
      if (elementos[i].type == "text" || elementos[i].type == "email" || elementos[i].type == "password") {
        // Si es tipo texto, email o password vamos a comprobar que esten completados los input
        if (elementos[i].value.length == 0) {
          console.log('El campo ' + elementos[i].name + ' esta incompleto');
          elementos[i].className = elementos[i].className + " error";
          return false;
        } else {
          elementos[i].className = elementos[i].className.replace(" error", "");
        }
      }
    }
    return true;
  };

// funciones que validan el boton
  var enviar = function(e) {
    if (!validarInputs()) {
      alert('Falto validar los Input');
      e.preventDefault();
    } else {
      /*alert('Envia');*/
    } 
  };

  var focusInput = function() {
    this.parentElement.children[1].className = "label active";
    this.parentElement.children[0].className = this.parentElement.children[0].className.replace("error", "");
  };

  var blurInput = function() {
    if (this.value <= 0) {
      this.parentElement.children[1].className = "label";
      this.parentElement.children[0].className = this.parentElement.children[0].className + " error";
    }
  };

  // --- Eventos ---
  formulario.addEventListener("submit", enviar);

  for (var i = 0; i < elementos.length; i++) {
    if (elementos[i].type == "text" || elementos[i].type == "email" || elementos[i].type == "password") {
      elementos[i].addEventListener("focus", focusInput);
      elementos[i].addEventListener("blur", blurInput);
    }
  }

  $('.formulario').on('click', '#btn-submit', function() {
    var user = document.getElementById('usuario').value;
    var passwd = document.getElementById('password').value;
    messageError(user, passwd);
  });

});

function messageError(usuario, password) {
    /*alert(usuario + ' - ' +password);*/
    $.ajax({
        url: "controllers/usuario/login.php",
        type: "POST",
        data: "usuario="+usuario+"&password="+password,
        success: function(resp){
          $('#login-alert').html(resp); 
        }       
    });
}