$(document).ready(function () {
    buscar_presentacion();
    var funcion;
    $('#crearPresent').submit(e => {
        let nombre_present = $('#nombre-presentacion').val();
        funcion = 'crear_presentacion';

        //peticion con Ajax para crear presentacion, se hace referncia al controlador del archivo php
        $.post('../controlador/ControladorPresent.php', {nombre_present, funcion }, (response) => {
            if (response == 'agregado') {
                Swal.fire({
                    position: "Center",
                    icon: "success",
                    title: "Presentacion Agregada Exitosamente",
                    showConfirmButton: false,
                    timer: 1520
                });
                $('#crearPresent').trigger('reset');
                buscar_presentacion();

            } else {
                //si se pone el mismo nombre de la categoria 
                $('#noAgrega').hide('slow');
                $('#noAgrega').show(1000);
                $('#noAgrega').hide(2000);
                $('#crearPresent').trigger('reset');
            }


        })
        e.preventDefault();
    });



    //funcion para buscar Presentacion
    function buscar_presentacion(consulta) {
        funcion = 'buscarPresentacion';
        $.post('../controlador/ControladorPresent.php', { consulta, funcion }, (response) => {
            //console.log(response);
            const Presentaciones = JSON.parse(response);
            let template = '';
            Presentaciones.forEach(presentacion => {
                template += `
                <tr PreseID="${presentacion.id_Presentacion}"PreseNom="${presentacion.descripcion}">
                <td>${presentacion.descripcion}</td>
                <td>
                <button class="edd btn btn-success" title="Editar" type="button" data-toggle="modal" data-target="#editarPresentacion"><i class="fas fa-pencil-alt"></i>
                </button>
                <button class="delet btn btn-danger" title="Eliminar"><i class="fas fa-trash-alt"></i>
                </button>
                </td>
                </tr>
                `;
            });
            $('#table_present').html(template);
        });
    }

    //evento para buscar categoria
    $(document).on('keyup', '#buscar-present', function () {
        let valor = $(this).val();
        if (valor != '') {
            buscar_presentacion(valor);
        } else {
            buscar_presentacion();
        }
    });




    //evento para eliminar Presentacion
    $(document).on('click', '.delet', (e) => {
        const elemento = $(e.target).closest('tr');
        console.log(elemento); // Verifica si estás obteniendo la fila correctamente
        const id = parseInt(elemento.attr('PreseID'));
        const descripcion = $(elemento).attr('PreseNom');

        console.log("el id a eliminar es: " + id);

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger mr-1"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: '¿Esta Seguro que Desea Eliminar La Presentacion en: ' + descripcion + '?',
            text: "¡No podra revertir estos cambios!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "¡Si, Borrar!",
            cancelButtonText: "¡No, Cancelar!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../controlador/eliminarPresent.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function (data) {
                        buscar_presentacion();
                    },
                    error: function (error) {
                        // console.log(error);
                    }
                });

                swalWithBootstrapButtons.fire({
                    title: "¡Borrado!",
                    text: '¡La Presentacion en: ' + descripcion + ' fue borrada exitosamente.',
                    icon: "success"
                });
                buscar_presentacion("");

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "La eliminacion fue cancelada",
                    icon: "error"
                });
            }
        });

    });



    //evento para editar Presentacion
    $(document).on('click', '.edd', (e) => {
        const elemento = $(e.target).closest('tr');
        console.log(elemento); // Verifica si estás obteniendo la fila correctamente
        const id = parseInt(elemento.attr('PreseID'));
        const descripcion = $(elemento).attr('PreseNom');

        $('#idPresent').val(id);
        $('#nombreprese').val(descripcion)

    });

    $('#editarPresent').submit(e => {
        e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

        const id = $('#idPresent').val(); // Obtener los valores actualizados del formulario
        const descripcion = $('#nombreprese').val();


        $.ajax({
            url: "../controlador/editarPresent.php",
            method: "POST",
            data: {
                id: id,
                descripcion: descripcion
            },
            dataType: "json",
            success: function (data) {
                buscar_presentacion();

            },
            error: function (error) {
                // console.log(error);
            }
        });
        Swal.fire({
            position: "Center",
            icon: "success",
            title: "Presentacion Editada Exitosamente",
            showConfirmButton: false,
            timer: 1520
        });
        buscar_presentacion("");
        $('#editarPresent').trigger('reset');
    });











});