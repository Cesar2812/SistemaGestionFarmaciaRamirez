$(document).ready(function () {
    var funcion = '';
    var id_Usuario = $('#id_Usuario').val();
    var edit = false;
    console.log(id_Usuario);

    buscar_Usuario(id_Usuario);


    //esta funcion toma los datos y les quita el fromato JSON para pasarlos a las card
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
            rol += `${usuario.rol}`;
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
        })


    }


    //evento del boton editar para ejecutar eventos de click y cargue los datos de las card del formulario en los input para que sean editados
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

    $('#form-pass').submit(e => {
        let oldpass = $('#old-pass').val();
        let newpass = $('#new-pass').val();

        funcion = 'cambiar_contraseña';

        $.post('../controlador/ControladorUsuario.php', { id_Usuario, funcion, oldpass, newpass }, (response) => {
            console.log(response);
            if (response == 'Cambio Realizado con Exito') {
                $('#update').hide('slow');
                $('#update').show(1000);
                $('#update').hide(2000);
                $('#form-pass').trigger('reset');
            } else {
                $('#noUpdate').hide('slow');
                $('#noUpdate').show(1000);
                $('#noUpdate').hide(2000);
                $('#form-pass').trigger('reset');
            }
        });
        console.log(oldpass + newpass);
        e.preventDefault();




    });










})