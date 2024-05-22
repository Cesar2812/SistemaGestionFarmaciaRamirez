$(document).ready(function () {
    buscar_categoria();
    var funcion;
    $('#crearCatego').submit(e => {
        let nombre_categ = $('#nombre-categoria').val();
        funcion = 'crear_categoria';

        //peticion con Ajax para crear categoria, se hace referncia al controlador del archivo php
        $.post('../controlador/ControladorCatg.php', { nombre_categ, funcion }, (response) => {
            if (response == 'agregado') {
                Swal.fire({
                    position: "Center",
                    icon: "success",
                    title: "Categoria Agregada Exitosamente",
                    showConfirmButton: false,
                    timer: 1520
                });
                $('#crearCatego').trigger('reset');
                buscar_categoria();

            } else {
                //si se pone el mismo nombre de la categoria 
                $('#noAgregado').hide('slow');
                $('#noAgregado').show(1000);
                $('#noAgregado').hide(2000);
                $('#crearCatego').trigger('reset');
            }


        })
        e.preventDefault();
    });



    //funcion para buscar categorias
    function buscar_categoria(consulta) {
        funcion = 'buscarCategoria';
        $.post('../controlador/ControladorCatg.php', { consulta, funcion }, (response) => {
            //console.log(response);
            const categorias = JSON.parse(response);
            let template = '';
            categorias.forEach(categoria => {
                template += `
                <tr CatgId="${categoria.id_Categoria}"CatgNombre="${categoria.descripcion}">
                <td>${categoria.descripcion}</td>
                <td>
                <button class="eddit btn btn-success" title="Editar" type="button" data-toggle="modal" data-target="#editarCategoria"><i class="fas fa-pencil-alt"></i>
                </button>
                <button class="delete btn btn-danger" title="Eliminar"><i class="fas fa-trash-alt"></i>
                </button>
                </td>
                </tr>
                `;
            });
            $('#table_categ').html(template);
        });
    }

    //evento para buscar categoria
    $(document).on('keyup', '#buscar-catg', function () {
        let valor = $(this).val();
        if (valor != '') {
            buscar_categoria(valor);
        } else {
            buscar_categoria();
        }
    });




    //evento para eliminar Categoria
    $(document).on('click', '.delete', (e) => {
        const elemento = $(e.target).closest('tr');
        console.log(elemento); // Verifica si estás obteniendo la fila correctamente
        const id = parseInt(elemento.attr('CatgId'));
        const descripcion = $(elemento).attr('CatgNombre');

        console.log("el id a eliminar es: " + id);

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger mr-1"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: '¿Esta Seguro que Desea Eliminar La Categoria ' + descripcion + '?',
            text: "¡No podra revertir estos cambios!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "¡Si, Borrar!",
            cancelButtonText: "¡No, Cancelar!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../controlador/eliminarCateg.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function (data) {
                        buscar_categoria();
                    },
                    error: function (error) {
                        // console.log(error);
                    }
                });

                swalWithBootstrapButtons.fire({
                    title: "¡Borrado!",
                    text: '¡La Categoria ' + descripcion + ' fue borrada exitosamente.',
                    icon: "success"
                });
                buscar_categoria("");

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "La eliminacion fue cancelada",
                    icon: "error"
                });
            }
        });

    });



    //evento para editar categoria
    $(document).on('click', '.eddit', (e) => {
        const elemento = $(e.target).closest('tr');
        console.log(elemento); // Verifica si estás obteniendo la fila correctamente
        const id = parseInt(elemento.attr('CatgId'));
        const descripcion = $(elemento).attr('CatgNombre');

        $('#idCateg').val(id);
        $('#nombreCate').val(descripcion)

    });

    $('#editarCateg').submit(e => {
        e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

        const id = $('#idCateg').val(); // Obtener los valores actualizados del formulario
        const descripcion = $('#nombreCate').val();


        $.ajax({
            url: "../controlador/editarCateg.php",
            method: "POST",
            data: {
                id: id,
                descripcion: descripcion
            },
            dataType: "json",
            success: function (data) {
                buscar_categoria();

            },
            error: function (error) {
                // console.log(error);
            }
        });
        Swal.fire({
            position: "Center",
            icon: "success",
            title: "Categoria Editada Exitosamente",
            showConfirmButton: false,
            timer: 1520
        });
        buscar_categoria("");
        $('#editarCateg').trigger('reset');
    });











});