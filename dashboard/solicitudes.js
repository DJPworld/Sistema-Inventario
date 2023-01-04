$(document).ready(function(){
    tablaSolicitudes = $("#tablaSolicitudes").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarS'>Editar</button><button class='btn btn-danger btnBorrarS'>Borrar</button></div></div>"  
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
    
    $("#btnNuevoS").click(function(){
        $("#formSolicitudes").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Solicitud");            
        $("#modalCRUD").modal("show");        
        id=null;
        opcion = 1; //alta
    });    
        
    var fila; //capturar la fila para editar o borrar el registro
        
    //botón EDITAR    
    $(document).on("click", ".btnEditarS", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        diagnostico = fila.find('td:eq(1)').text();
        id_equipo = parseInt(fila.find('td:eq(3)').text());
        id_usuario = parseInt(fila.find('td:eq(4)').text());
        problema = fila.find('td:eq(5)').text();
        fecha_revision = Date.parse(fila.find('td:eq(6)').text());
        
        $("#diagnostico").val(diagnostico);
        $("#id_equipo").val(id_equipo);
        $("#id_usuario").val(id_usuario);
        $("#problema").val(problema);
        $("#fecha_revision").val(fecha_revision);
        opcion = 2; //editar
        
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Solicitud");            
        $("#modalSolicitudes").modal("show");  
        
    });

    //botón BORRAR
    $(document).on("click", ".btnBorrarS", function(){    
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
        if(respuesta){
            $.ajax({
                url: "bd/solicitud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(){
                    tablaSolicitudes.row(fila.parents('tr')).remove().draw();
                }
            });
        }   
    });
        
    $("#formSolicitudes").submit(function(e){
        e.preventDefault();    
        diagnostico = $.trim($("#diagnostico").val());
        id_equipo = $.trim($("#id_equipo").val());
        id_usuario = $.trim($("#id_usuario").val());   
        problema = $.trim($("#problema").val());   
        fecha_revision = $.trim($("#fecha_revision").val());   
        $.ajax({
            url: "bd/solicitud.php",
            type: "POST",
            dataType: "json",
            data: {diagnostico:diagnostico, id_equipo:id_equipo, id_usuario:id_usuario, problema:problema, fecha_revision:fecha_revision, id:id, opcion:opcion},
            success: function(data){  
                console.log(data);
                id = data[0].id;            
                diagnostico = data[0].diagnostico;
                id_equipo = data[0].id_equipo;
                id_usuario = data[0].id_usuario;
                problema = data[0].problema;
                fecha_revision = data[0].fecha_revision;
                if(opcion == 1){tablaSolicitudes.row.add([id, diagnostico, id_equipo, id_usuario, problema, fecha_revision]).draw();}
                else{tablaSolicitudes.row(fila).data([id, diagnostico, id_equipo, id_usuario, problema, fecha_revision]).draw();}            
            }        
        });
        $("#modalSolicitudes").modal("hide");    
        
    });    
    
});