var tabla;

function init(){

MostrarForm(false);
Listar();

$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})


$.post("../Ajax/ACategoria.php?Op=SelectTipoProducto", function(r){

    $("#IdTipoProducto").html(r);
    $('#IdTipoProducto').selectpicker('refresh');
    
    
    
    });

}
function limpiar(){

    $("#IdCategoria").val("");
$("#IdTipoProducto").val("");
$("#Categoria").val("");

}

function MostrarForm(flag){

limpiar();
if (flag){

$("#ListadoRegistros").hide();
$("#FormularioRegistros").show();
$("#BtnGuardar").prop("disabled",false);


}else{

    $("#ListadoRegistros").show();
    $("#FormularioRegistros").hide();

}


}

function CancelarForm(){

    limpiar();
    MostrarForm(false);
}

function Listar(){

tabla=$("#tbllistado").dataTable(
    
    {
    "aProcessing": true,
    "aServerSide": true,
    dom: 'Bfrtip',
    buttons:[
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'


    ],

    "ajax":{

        url: '../Ajax/ACategoria.php?Op=Listar',
        type : "get",
        dataType :"json",
        error: function(e){
            console.log(e.responseText);
        }

    },
    "bDestroy":true,
    "iDisplayLength":10,
    "order":[[0,"desc"]]

}).DataTable();

}

function GuardaryEditar(e){

e.preventDefault();
$("#BtnGuardar").prop("disabled",true);
var formData= new FormData($("#Formulario")[0]);

$.ajax({

url: "../Ajax/ACategoria.php?Op=GuardaryEditar",
type: "POST",
data: formData,
contentType: false,
processData: false,

success: function(datos){

    bootbox.alert(datos);
    MostrarForm(false);
    tabla.ajax.reload();

}


});

limpiar();
}

function Mostrar(IdCategoria)
{

    
    $.post("../Ajax/ACategoria.php?Op=Mostrar",{IdCategoria : IdCategoria}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(true);

            $("#IdCategoria").val(data.IdCategoria);
         
            $("#IdTipoProducto").val(data.IdTipoProducto);
            $("#IdTipoProducto").selectpicker('refresh');

        $("#Categoria").val(data.Categoria);
            

         




})


}

function Desactivar(IdCategoria){

bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR LA CATEGORIA?", function(result){

if(result){

    $.post("../Ajax/ACategoria.php?Op=Desactivar",{IdCategoria : IdCategoria}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();

    });


}

})


}




function Activar(IdCategoria){

    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL TIPO DE PRODUCTO?", function(result){
    
    if(result){
    
        $.post("../Ajax/ACategoria.php?Op=Activar",{IdCategoria : IdCategoria}, function(e){
    
            bootbox.alert(e);
            tabla.ajax.reload();
    
        });
    
    
    }
    
    })
    
    
    }


init();

