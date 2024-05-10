$(document).ready(function () {

  buscar_datos();

  var funcion;

  function buscar_datos(consulta) {
    funcion = 'buscar_user_adm';
    $.post('../controlador/ControladorUsuario.php', { consulta, funcion }, (response) => {
      console.log(response);
      const usuarios = JSON.parse(response);
      let template = '';

      usuarios.forEach(usuario => {
        template += `
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                 ${usuario.rol}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${usuario.nombre} ${usuario.apellido}</b></h2>
                      <p class="text-muted text-sm"><b>Trabaja en:</b>Farmacia Ramirez</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">

                      <li class="small"><span class="fa-li"><i class="fa fa-envelope"></i></span> Correo: ${usuario.correo}</li>

                       <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono: ${usuario.telefono} </li>

                       <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Residencia: ${usuario.residencia}</li>

                      <li class="small"><span class="fa-li"><i class="fas fa-lg  fa-child"></i></span> Edad: ${usuario.edad}</li>

                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${usuario.foto}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="btn btn-danger">
                     <i class="fas fa-window-close mr-1"></i>Eliminar
                    </button>
                  </div>
                </div>
              </div>
                
             </div>
                `;
      })
      $('#card-usuarios').html(template);
    });

  }
  $(document).on('keyup', '#buscarUser', function () {
    let valor = $(this).val();

    if (valor != "") {
      buscar_datos(valor);

    } else {
      buscar_datos();
    }



  });

})