$(document).ready(function(){
    tablaUsuarios = $("#tablaUsuarios").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarU'>Editar</button><button class='btn btn-danger btnBorrarU'>Borrar</button></div></div>"  
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
    
    $("#btnNuevoU").click(function(){
        $("#formUsuarios").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Usuario");            
        $("#modalUsuarios").modal("show");        
        id=null;
        opcion = 1; //alta
    });    
        
    var fila; //capturar la fila para editar o borrar el registro
        
    //botón EDITAR    
    $(document).on("click", ".btnEditarU", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        usuario = fila.find('td:eq(2)').text();
        
        $("#nombre").val(nombre);
        $("#usuario").val(usuario);
        opcion = 2; //editar
        
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Usuario");            
        $("#modalUsuarios").modal("show");  
        
    });

    //botón BORRAR
    $(document).on("click", ".btnBorrarU", function(){    
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
        if(respuesta){
            $.ajax({
                url: "bd/usuario.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(){
                    tablaUsuarios.row(fila.parents('tr')).remove().draw();
                }
            });
        }   
    });
        
    $("#formUsuarios").submit(function(e){
        e.preventDefault();    
        nombre = $.trim($("#nombre").val());
        usuario = $.trim($("#usuario").val());    
        $.ajax({
            url: "bd/usuario.php",
            type: "POST",
            dataType: "json",
            data: {nombre:nombre, usuario:usuario, id:id, opcion:opcion},
            success: function(data){  
                console.log(data);
                id = data[0].id;            
                nombre = data[0].nombre;
                usuario = data[0].usuario;
                if(opcion == 1){tablaUsuarios.row.add([id,nombre,usuario]).draw();}
                else{tablaUsuarios.row(fila).data([id,nombre,usuario]).draw();}            
            }        
        });
        $("#modalUsuarios").modal("hide");    
        
    });    
    
});