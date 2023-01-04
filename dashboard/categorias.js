$(document).ready(function(){
    tablaCategorias = $("#tablaCategorias").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarC'>Editar</button><button class='btn btn-danger btnBorrarC'>Borrar</button></div></div>"  
       }],
       "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
    $("#btnNuevoC").click(function(){
        $("#formCategorias").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Categoria");            
        $("#modalCategoria").modal("show");        
        id=null;
        opcion = 1; //alta
    });    
        
    var fila; //capturar la fila para editar o borrar el registro
        
    //botón EDITAR    
    $(document).on("click", ".btnEditarC", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        categoria = fila.find('td:eq(1)').text();
        estado = fila.find('td:eq(2)').text();
        
        $("#categoria").val(categoria);
        $("#estado").val(estado);
        opcion = 2; //editar
        
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Categoria");            
        $("#modalCategoria").modal("show");  
        
    });

    //botón BORRAR
    $(document).on("click", ".btnBorrarC", function(){    
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
        if(respuesta){
            $.ajax({
                url: "bd/categoria.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(){
                    tablaCategorias.row(fila.parents('tr')).remove().draw();
                }
            });
        }   
    });
        
    $("#formCategorias").submit(function(e){
        e.preventDefault();    
        categoria = $.trim($("#categoria").val());
        estado = $.trim($("#estado").val());   
        $.ajax({
            url: "bd/categoria.php",
            type: "POST",
            dataType: "json",
            data: {categoria:categoria, estado:estado, id:id, opcion:opcion},
            success: function(data){  
                console.log(data);
                id = data[0].id;            
                categoria = data[0].categoria;
                estado = data[0].estado;
                if(opcion == 1){tablaCategorias.row.add([id,categoria,estado]).draw();}
                else{tablaCategorias.row(fila).data([id,categoria,estado]).draw();}            
            }        
        });
        $("#modalCategoria").modal("hide");    
        
    });    
    
});