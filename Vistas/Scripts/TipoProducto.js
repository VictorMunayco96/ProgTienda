var tabla;

function init(){

MostrarForm(false);
Listar();

$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})


}
function limpiar(){

    $("#IdTipoProducto").val("");
$("#TipoProducto").val("");


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

        url: '../Ajax/ATipoProducto.php?Op=Listar',
        type : "get",
        dataType :"json",
        error: function(e){
            console.log(e.responseText);
        }

    },
    "bDestroy":true,
    "iDisplayLength":5,
    "order":[[0,"desc"]]

}).DataTable();

}

function GuardaryEditar(e){

e.preventDefault();
$("#BtnGuardar").prop("disabled",true);
var formData= new FormData($("#Formulario")[0]);

$.ajax({

url: "../Ajax/ATipoProducto.php?Op=GuardaryEditar",
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

function Mostrar(IdTipoProducto)
{

    
    $.post("../Ajax/ATipoProducto.php?Op=Mostrar",{IdTipoProducto : IdTipoProducto}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(true);

            $("#TipoProducto").val(data.TipoProducto);
         
            $("#IdTipoProducto").val(data.IdTipoProducto);
        

         




})


}

function Desactivar(IdTipoProducto){

bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR EL TIPO DE PRODUCTO?", function(result){

if(result){

    $.post("../Ajax/ATipoProducto.php?Op=Desactivar",{IdTipoProducto : IdTipoProducto}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();

    });


}

})


}




function Activar(IdTipoProducto){

    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL TIPO DE PRODUCTO?", function(result){
    
    if(result){
    
        $.post("../Ajax/ATipoProducto.php?Op=Activar",{IdTipoProducto : IdTipoProducto}, function(e){
    
            bootbox.alert(e);
            tabla.ajax.reload();
    
        });
    
    
    }
    
    })
    
    
    }


init();

