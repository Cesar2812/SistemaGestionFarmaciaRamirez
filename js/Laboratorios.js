$(document).ready(function () {
    buscar_lab();
    var funcion;
    $('#crearLab').submit(e => {
        let nombre_lab = $('#nombre-laboratorio').val();
        let telefono_lab = $('#telefono-laboratorio').val();
        funcion = 'crear_laboratorio';

        //peticion con Ajax para crear Laboratorio, se hace referncia al controlador del archivo php
        $.post('../controlador/ControladorLab.php', { nombre_lab, telefono_lab, funcion }, (response) => {
            if (response == 'agregado') {
                Swal.fire({
                    position: "Center",
                    icon: "success",
                    title: "Laboratorio Agregado Exitosamente",
                    showConfirmButton: false,
                    timer: 1520
                });
                $('#crearLab').trigger('reset');
                buscar_lab();

            } else {
                //si se pone el mismo nombre del laboratorio 
                $('#noADD').hide('slow');
                $('#noADD').show(1000);
                $('#noADD').hide(2000);
                $('#crearLab').trigger('reset');
            }


        })
        e.preventDefault();
    });



    //funcion para buscar laboratorios 
    function buscar_lab(consulta) {
        funcion = 'buscarLaboratorio';
        $.post('../controlador/ControladorLab.php', { consulta, funcion }, (response) => {
            //console.log(response);
            const laboras = JSON.parse(response);
            let template = '';
            laboras.forEach(laboratorio => {
                template += `
                <tr labId="${laboratorio.id_Laboratorio}"labNombre="${laboratorio.nombre}"labLogo="${laboratorio.logo}"labTelefono="${laboratorio.telefono}">
                <td>${laboratorio.nombre}</td>
                <td>${laboratorio.telefono}</td>
                <td>
                <img src="${laboratorio.logo}" class="img-fluid rounded" width="70" height="70">
                </td>
                <td>
                <button class="logo btn btn-info" title="Cambiar Logo" type="button" data-toggle="modal" data-target="#cambiarLogo"><i class="far fa-image"></i>
                </button>
                <button class="editar btn btn-success" title="Editar" type="button" data-toggle="modal" data-target="#editarLaboratorio"><i class="fas fa-pencil-alt"></i>
                </button>
                <button class="eliminar btn btn-danger" title="Eliminar"><i class="fas fa-trash-alt"></i>
                </button>
                </td>
                </tr>
                `;
            });
            $('#table_lab').html(template);
        });
    }

    //evento para buscar Laboratorio
    $(document).on('keyup', '#buscar_lab', function () {
        let valor = $(this).val();
        if (valor != '') {
            buscar_lab(valor);
        } else {
            buscar_lab();
        }
    });



    //capturando datos para pasarlos al modal para cambiar logo
    $(document).on('click', '.logo', (e) => {
        funcion = 'cambiar_logo';
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('labId');
        const nombre = $(elemento).attr('labNombre');
        const logo = $(elemento).attr('labLogo');
        //console.log(id + nombre + logo);

        $('#logo-img').attr('src', logo);
        $('#nombre_lab').html(nombre);
        $('#funcion').val(funcion);
        $('#id_logo_lab').val(id);

    })

    //evento para cambiar logo del laboratorio
    $("#form-logo").submit(e => {
        let formdata = new FormData($("#form-logo")[0]);

        $.ajax({
            url: '../controlador/ControladorLab.php',
            type: 'POST',
            data: formdata,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            const json = JSON.parse(response);
            if (json.alert == 'edit') {
                $('#logo-img').attr('src', json.ruta);
                Swal.fire({
                    position: "Center",
                    icon: "success",
                    title: "Cambio Realizado Exitosamente",
                    showConfirmButton: false,
                    timer: 1520
                });
                $('#form-logo').trigger('reset');
                buscar_lab();

            } else {
                $('#nocambiado').hide('slow');
                $('#nocambiado').show(1000);
                $('#nocambiado').hide(2000);
                $('#form-logo').trigger('reset');
            }

        });
        e.preventDefault();

    })

    //evento para eliminar Laboratorio
    $(document).on('click', '.eliminar', (e) => {
        const elemento = $(e.target).closest('tr');
        console.log(elemento); // Verifica si estás obteniendo la fila correctamente
        const id = parseInt(elemento.attr('labId'));
        const nombre = $(elemento).attr('labNombre');

        console.log("el id a eliminar es: " + id);

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger mr-1"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: '¿Esta Seguro que Desea Eliminar el Laboratorio ' + nombre + '?',
            text: "¡No podra revertir estos cambios!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "¡Si, Borrar!",
            cancelButtonText: "¡No, Cancelar!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../controlador/eliminarLab.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function (data) {
                        buscar_lab();
                    },
                    error: function (error) {
                        // console.log(error);
                    }
                });

                swalWithBootstrapButtons.fire({
                    title: "¡Borrado!",
                    text: '¡El Laboratorio ' + nombre + ' fue borrado exitosamente.',
                    icon: "success"
                });
                buscar_lab("");

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "La eliminacion fue cancelada",
                    icon: "error"
                });
            }
        });

    });



    //evento para editar laboratorio 
    $(document).on('click', '.editar', (e) => {
        const elemento = $(e.target).closest('tr');
        console.log(elemento); // Verifica si estás obteniendo la fila correctamente
        const id = parseInt(elemento.attr('labId'));
        const nombre = $(elemento).attr('labNombre');
        const telefono = $(elemento).attr('labTelefono');

        $('#idLab').val(id);
        $('#nombrelab').val(nombre)
        $('#telefonolab').val(telefono);
    });

    $('#editarLab').submit(e => {
        e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

        const id = $('#idLab').val(); // Obtener los valores actualizados del formulario
        const nombre = $('#nombrelab').val();
        const telefono = $('#telefonolab').val();

        $.ajax({
            url: "../controlador/editarLab.php",
            method: "POST",
            data: {
                id: id,
                nombre: nombre,
                telefono: telefono
            },
            dataType: "json",
            success: function (data) {
                buscar_lab();
                
            },
            error: function (error) {
                // console.log(error);
            }
        });
        Swal.fire({
            position: "Center",
            icon: "success",
            title: "Laboratorio Editado Exitosamente",
            showConfirmButton: false,
            timer: 1520
        });
        buscar_lab("");
        $('#editarLab').trigger('reset');
    });











});