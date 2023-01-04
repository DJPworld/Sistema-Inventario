$(document).ready(function(){
    tablaEquipos = $("#tablaEquipos").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarE'>Editar</button><button class='btn btn-danger btnBorrarE'>Borrar</button></div></div>"  
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
    
$("#btnNuevoE").click(function(){
    $("#formEquipos").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Equipo");            
    $("#modalEquipos").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditarE", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    marca = fila.find('td:eq(2)').text();
    modelo = fila.find('td:eq(3)').text();
    num_inventario = fila.find('td:eq(4)').text();
    servicetag = fila.find('td:eq(5)').text();
    tipo = fila.find('td:eq(6)').text();
    estado = parseInt(fila.find('td:eq(7)').text());
    
    $("#nombre").val(nombre);
    $("#marca").val(marca);
    $("#modelo").val(modelo);
    $("#num_inventario").val(num_inventario);
    $("#servicetag").val(servicetag);
    $("#tipo").val(tipo);
    $("#estado").val(estado);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Equipo");            
    $("#modalEquipos").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrarE", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/equipo.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaEquipos.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formEquipos").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    marca = $.trim($("#marca").val());
    modelo = $.trim($("#modelo").val());    
    num_inventario = $.trim($("#num_inventario").val()); 
    servicetag = $.trim($("#servicetag").val()); 
    tipo = $.trim($("#tipo").val()); 
    estado = $.trim($("#estado").val()); 
    $.ajax({
        url: "bd/equipo.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, marca:marca, modelo:modelo, num_inventario:num_inventario, servicetag:servicetag, tipo:tipo, estado:estado, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombre = data[0].nombre;
            marca = data[0].marca;
            modelo = data[0].modelo;
            num_inventario = data[0].num_inventario;
            servicetag = data[0].servicetag;
            tipo = data[0].tipo;
            estado = data[0].estado;
            if(opcion == 1){tablaEquipos.row.add([id, nombre, marca, modelo, num_inventario, servicetag, tipo, estado]).draw();}
            else{tablaEquipos.row(fila).data([id, nombre, marca, modelo, num_inventario, servicetag, tipo, estado]).draw();}            
        }        
    });
    $("#modalEquipos").modal("hide");    
    
});    
    
});