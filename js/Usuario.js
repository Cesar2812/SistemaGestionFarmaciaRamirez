$(document).ready(function () {
    var funcion = '';
    var id_Usuario = $('#id_Usuario').val();
    var edit = false;
    console.log(id_Usuario);

    buscar_Usuario(id_Usuario);


    //esta funcion toma los datos y les quita el fromato JSON para pasarlos a las card
    //evento para pasar todo a los card
    function buscar_Usuario(dato) {
        funcion = 'buscar_Usuario';
        $.post("../controlador/ControladorUsuario.php", { dato, funcion }, (response) => {
            console.log(response);
            let nombre = '';
            let apellido = '';
            let usuario_ = '';
            let edad = '';
            let rol = '';
            let telefono = '';
            let residencia = '';
            let Correo = '';
            const usuario = JSON.parse(response);
            nombre += `${usuario.nombre}`;
            apellido += `${usuario.apellido}`;
            usuario_ += `${usuario.usuario}`;
            edad += `${usuario.edad}`;
            if (usuario.rol =='Root') {
                rol += `<h1 class="badge badge-danger">${usuario.rol}</h1>`;

            }
            if (usuario.rol =='Administrador') {
                rol += `<h1 class="badge badge-warning">${usuario.rol}</h1>`;

            }
            if (usuario.rol =='Facturador') {
                rol += `<h1 class="badge badge-info">${usuario.rol}</h1>`;

            }
            telefono += `${usuario.telefono}`;
            residencia += `${usuario.residencia}`;
            Correo += `${usuario.correo}`;
            //estos son templates
            $('#nombre_user').html(nombre);
            $('#apellido_user').html(apellido);
            $('#user_name').html(usuario_);
            $('#edad').html(edad);
            $('#rol').html(rol);
            $('#telefono').html(telefono);
            $('#residencia').html(residencia);
            $('#correo').html(Correo);

            $('#foto-card').attr('src', usuario.foto);
            $('#foto-modal-chan').attr('src', usuario.foto);
            $('#foto-contraseña').attr('src', usuario.foto);
            $('#usuario-navb').attr('src', usuario.foto);

        })


    }


    //evento del boton editar para ejecutar eventos de click y cargue los datos de las card del formulario en los input para que sean editados
    //evento para cargar los datos de los card a los inputs para la edicion
    $(document).on('click', '.edit', (e) => {
        funcion = 'capturar_datos';
        edit = true;
        $.post('../controlador/ControladorUsuario.php', { funcion, id_Usuario }, (response) => {
            console.log(response);
            //quitando el JSON para pasarlos al los inputs de HTML
            const usuario = JSON.parse(response);
            $('#admin').val(usuario.usuario);
            $('#tele').val(usuario.telefono);
            $('#residenci').val(usuario.residencia);
            $('#email').val(usuario.correo);
        });

    });


    //capturando los datos de los input del formulario editar usuario para que los lleve a la consulta a realizarse en la base de datos
    //evento para editar datos del usuario
    $('#form-usuario').submit(e => {

        if (edit == true) {
            let admin = $('#admin').val();
            let tele = $('#tele').val();
            let residenci = $('#residenci').val();
            let email = $('#email').val();
            funcion = 'editar_usuario';
            $.post('../controlador/ControladorUsuario.php', { funcion, id_Usuario, admin, tele, residenci, email }, (response) => {
                if (response = 'Editado') {
                    $('#Editado').hide('slow');
                    $('#Editado').show(1000);
                    $('#Editado').hide(2000);
                    $('#form-usuario').trigger('reset');
                }
                edit = false;
                buscar_Usuario(id_Usuario)
            });

        } else {
            $('#NoEditado').hide('slow');
            $('#NoEditado').show(1000);
            $('#NoEditado').hide(2000);
            $('#form-usuario').trigger('reset');


        }
        e.preventDefault();
    });


    //implementacion de cambiar contraseña al cual le estoy diciendo que cuando se haga click en el boton guardar se ejecute una funcion 
    //evento para cambiar contraseña
    $('#form-pass').submit(e => {
        let oldpass = $('#old-pass').val();
        let newpass = $('#new-pass').val();

        funcion = 'cambiar_contraseña';

        $.post('../controlador/ControladorUsuario.php', { id_Usuario, funcion, oldpass, newpass }, (response) => {
            console.log(response);
            //invocando a los alert para cuando se ralice el cambio de contraseña de forma correcta 
            if (response == 'Cambio Realizado con Exito') {
                Swal.fire({
                    position: "Center",
                    icon: "success",
                    title: "Cambio Realizado Exitosamente",
                    showConfirmButton: false,
                    timer: 1515
                });
                $('#form-pass').trigger('reset');
            } else {
                //si se pone mal la contraseña se activara el Alert 
                $('#noUpdate').hide('slow');
                $('#noUpdate').show(1000);
                $('#noUpdate').hide(2000);
                $('#form-pass').trigger('reset');
            }
        });
        console.log(oldpass + newpass);
        //reinicia el formulario osea lo limpia 
        e.preventDefault();
    });




    //evento para cambiar foto
    $("#form-foto").submit(e => {
        let formdata = new FormData($("#form-foto")[0]);

        $.ajax({
            url: '../controlador/ControladorUsuario.php',
            type: 'POST',
            data: formdata,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            console.log(response);
            const json = JSON.parse(response);

            if (json.alert == 'edit') {
                Swal.fire({
                    position: "Center",
                    icon: "success",
                    title: "Cambio Realizado Exitosamente",
                    showConfirmButton: false,
                    timer: 1515
                });
                $('#foto-modal-chan').attr('src', json.ruta);
                $('#form-foto').trigger('reset');
                buscar_Usuario(id_Usuario);

            } else {
                $('#noEdit').hide('slow');
                $('#noEdit').show(1000);
                $('#noEdit').hide(2000);
                $('#form-foto').trigger('reset');

            }
        });
        e.preventDefault();

    })


})