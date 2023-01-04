$(document).ready(function(){
    tablaDashboard = $("#tablaDashboard").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
    });
      
    
    var fila; //capturar la fila para editar o borrar el registro
    
    //botón EDITAR    
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        pais = fila.find('td:eq(2)').text();
        edad = parseInt(fila.find('td:eq(3)').text());
        
        $("#nombre").val(nombre);
        $("#pais").val(pais);
        $("#edad").val(edad);
        opcion = 2; //editar
        
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Persona");            
        $("#modalCRUD").modal("show");  
        
    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function(){    
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
        if(respuesta){
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(){
                    tablaPersonas.row(fila.parents('tr')).remove().draw();
                }
            });
        }   
    });
        
    $("#formDashboard").submit(function(e){
        e.preventDefault();    
        nombre = $.trim($("#nombre").val());
        pais = $.trim($("#pais").val());
        edad = $.trim($("#edad").val());    
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {nombre:nombre, pais:pais, edad:edad, id:id, opcion:opcion},
            success: function(data){  
                console.log(data);
                id = data[0].id;            
                nombre = data[0].nombre;
                pais = data[0].pais;
                edad = data[0].edad;
                if(opcion == 1){tablaPersonas.row.add([id,nombre,pais,edad]).draw();}
                else{tablaPersonas.row(fila).data([id,nombre,pais,edad]).draw();}            
            }        
        });
        $("#modalCRUD").modal("hide");    
        
    });    
    
});