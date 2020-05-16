var tabla;

function init(){

MostrarForm(false);
Listar();

$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})


}
function limpiar(){

    $("#IdPersonal").val("");
$("#Nombre").val("");
$("#Apellido").val("");
$("#FecNac").val("");
$("#TipoDocumento").val("");
$("#NumDocumento").val("");
$("#Area").val("");
$("#Cargo").val("");


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

        url: '../Ajax/APersonal.php?Op=Listar',
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

url: "../Ajax/APersonal.php?Op=GuardaryEditar",
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

function Mostrar(IdPersonal)
{

    
    $.post("../Ajax/APersonal.php?Op=Mostrar",{IdPersonal : IdPersonal}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(true);

            $("#IdPersonal").val(data.IdPersonal);
         
            $("#Nombre").val(data.Nombre);
            $("#Apellido").val(data.Apellido);
            $("#FecNac").val(data.FecNac);
            $("#TipoDocumento").val(data.TipoDocumento);
            $("#TipoDocumento").selectpicker('refresh');
            $("#NumDocumento").val(data.NumDocumento);
            $("#Area").val(data.Area);
            $("#Area").selectpicker('refresh');
            $("#Cargo").val(data.Cargo);
            $("#Cargo").selectpicker('refresh');
         




})


}

function Desactivar(IdPersonal){

bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR EL REGISTRO?", function(result){

if(result){

    $.post("../Ajax/APersonal.php?Op=Desactivar",{IdPersonal : IdPersonal}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();

    });


}

})


}




function Activar(IdPersonal){

    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL REGISTRO?", function(result){
    
    if(result){
    
        $.post("../Ajax/APersonal.php?Op=Activar",{IdPersonal : IdPersonal}, function(e){
    
            bootbox.alert(e);
            tabla.ajax.reload();
    
        });
    
    
    }
    
    })
    
    
    }


init();

