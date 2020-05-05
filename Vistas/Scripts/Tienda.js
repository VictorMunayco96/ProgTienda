var tabla;

function init(){

MostrarForm(false);
Listar();

$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})




}
function limpiar(){

    $("#IdTienda").val("");
$("#RazonSocial").val("");
$("#Ruc").val("");

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

        url: '../Ajax/ATienda.php?Op=Listar',
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

url: "../Ajax/ATienda.php?Op=GuardaryEditar",
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

function Mostrar(IdTienda)
{

    
    $.post("../Ajax/ATienda.php?Op=Mostrar",{IdTienda : IdTienda}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(true);

            $("#IdTIenda").val(data.IdTienda);
         
            $("#RazonSocial").val(data.RazonSocial);

        $("#Ruc").val(data.Ruc);
            

         




})


}

function Desactivar(IdTienda){

bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR EL REGISTRO?", function(result){

if(result){

    $.post("../Ajax/ATienda.php?Op=Desactivar",{IdTienda : IdTienda}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();

    });


}

})


}




function Activar(IdTienda){

    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL REGISTRO?", function(result){
    
    if(result){
    
        $.post("../Ajax/ATienda.php?Op=Activar",{IdTienda : IdTienda}, function(e){
    
            bootbox.alert(e);
            tabla.ajax.reload();
    
        });
    
    
    }
    
    })
    
    
    }


init();

