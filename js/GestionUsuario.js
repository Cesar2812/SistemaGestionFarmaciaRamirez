$(document).ready(function () {
  var tipo_usuario = $('#user_tipo').val();
  //console.log(tipo_user);

  if (tipo_usuario == 2) {
    $('#button-Crear').hide();
  }

  buscar_datos();
  var funcion;

  function buscar_datos(consulta) {
    funcion = 'buscar_user_adm';
    $.post('../controlador/ControladorUsuario.php', { consulta, funcion }, (response) => {
      //console.log(response);
      const usuarios = JSON.parse(response);
      let template = '';

      usuarios.forEach(usuario => {
        template += `
                <div usuarioId="${usuario.id}"class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">`;
        if (usuario.tipo_usuario == 3) {
          template += `<h1 class="badge badge-danger">${usuario.rol}</h1>`;

        }
        if (usuario.tipo_usuario == 1) {
          template += `<h1 class="badge badge-warning">${usuario.rol}</h1>`;

        }
        if (usuario.tipo_usuario == 2) {
          template += `<h1 class="badge badge-info">${usuario.rol}</h1>`;

        }
        template += `</div>
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
                  <div class="text-right">`;
        if (tipo_usuario == 3) {
          if (usuario.tipo_usuario != 3) {
            template += `
            <button class="borrar-usuario btn btn-danger mr-1" type="button" data-toggle="modal" data-target="#confirmar">
                     <i class="fas fa-window-close mr-1"></i>Eliminar
                    </button>
            `;
          }
          if (usuario.tipo_usuario == 2) {
            template += `
            <button class="ascender btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                     <i class="fas fa-sort-amount-up mr-1"></i>Ascender
                    </button>
            `;
          }

          /*if (usuario.tipo_usuario == 1) {
            template += `
            <button class="btn btn-secondary">
                     <i class="fas fa-sort-amount-down mr-1"></i>Descender
                    </button>
            `;

          }*/

        } else {
          if (tipo_usuario == 1 && usuario.tipo_usuario != 1 && usuario.tipo_usuario != 3) {
            template += `
            <button class="borrar-usuario btn btn-danger"type="button" data-toggle="modal" data-target="#confirmar">
                     <i class="fas fa-window-close mr-1"></i>Eliminar
                    </button>
            `;

          }
        }
        template += `
                  </div>
                </div>
              </div>
                
             </div>
                `;
      })
      $('#card-usuarios').html(template);
    });

  }

  //buscador
  $(document).on('keyup', '#buscarUser', function () {
    let valor = $(this).val();

    if (valor != "") {
      buscar_datos(valor);

    } else {
      buscar_datos();
    }
  });



  //evento del formulario para crear usuario
  $('#crearUser').submit(e => {
    let nombre = $('#nombre').val();
    let apellido = $('#apellido').val();
    let edad = $('#edad').val();
    let nombre_usuario = $('#user').val();
    let contraseña = $('#pass').val();

    funcion = 'crear_usuario';
    $.post('../controlador/ControladorUsuario.php', { nombre, apellido, edad, nombre_usuario, contraseña, funcion }, (response) => {
      if (response == 'agregado') {
        Swal.fire({
          position: "Center",
          icon: "success",
          title: "Usuario Agregado Exitosamente",
          showConfirmButton: false,
          timer: 1520
        });
        buscar_datos();
        $('#crearUser').trigger('reset');

      } else {
        //si se repite el nombre del usuario se activara el alert 
        $('#noAgregado').hide('slow');
        $('#noAgregado').show(1000);
        $('#noAgregado').hide(2000);

      }
    });
    e.preventDefault();
  });



  //evento para ascender usuario
  $(document).on('click', '.ascender', (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    //console.log(elemento);
    const id = $(elemento).attr('usuarioId')
    //console.log(id);
    funcion = 'ascender';
    $('#id_user').val(id);
    $('#funcion').val(funcion);
  });

  //evento para borrar Usuario
  $(document).on('click', '.borrar-usuario', (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    //console.log(elemento);
    const id = $(elemento).attr('usuarioId')
    //console.log(id);
    funcion = 'borrar_usuario';
    $('#id_user').val(id);
    $('#funcion').val(funcion);
  });

  //evento del modal para ascender usuario
  $('#form-confirmar').submit(e => {
    let pass = $('#old-pass').val();
    let id_usuario = $('#id_user').val();
    funcion = $('#funcion').val();
    //console.log(pass);
    //console.log(id_usuario);
    //console.log(funcion);
    $.post('../controlador/ControladorUsuario.php', { pass, id_usuario, funcion }, (response) => {
      //console.log(response);
      if (response == 'ascendido') {
        Swal.fire({
          position: "Center",
          icon: "success",
          title: "Usuario Ascendido Exitosamente",
          showConfirmButton: false,
          timer: 1520
        });
        buscar_datos();
        $('#form-confirmar').trigger('reset');


      } else {
        //si la contraseña no es correcta
        $('#noRealizado').hide('slow');
        $('#noRealizado').show(1000);
        $('#noRealizado').hide(2000);
      }
    });
    e.preventDefault();

  });




  //evento del modal para borrar usuario
  $('#form-confirmar').submit(e => {
    let pass = $('#old-pass').val();
    let id_usuario = $('#id_user').val();
    funcion = $('#funcion').val();
    //console.log(pass);
    //console.log(id_usuario);
    //console.log(funcion);
    $.post('../controlador/ControladorUsuario.php', { pass, id_usuario, funcion }, (response) => {
      //console.log(response);
      if (response == 'borrado') {
        Swal.fire({
          position: "Center",
          icon: "success",
          title: "Usuario Borrado Exitosamente",
          showConfirmButton: false,
          timer: 1520
        });
        buscar_datos();
        $('#form-confirmar').trigger('reset');


      } else {
        //si la contraseña no es correcta
        $('#noEliminado').hide('slow');
        $('#noEliminado').show(1000);
        $('#noEliminado').hide(2000);
      }
    });
    e.preventDefault();

  });

});