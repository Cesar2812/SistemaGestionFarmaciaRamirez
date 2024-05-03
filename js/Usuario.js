$(document).ready(function () {
    var funcion = '';
    var id_Usuario = $('#id_Usuario').val();
    console.log(id_Usuario);

    buscar_Usuario(id_Usuario);

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
})