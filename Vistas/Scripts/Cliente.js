var tabla;

function init(){

MostrarForm(false);
Listar();

$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})




}
function limpiar(){

    $("#IdCliente").val("");
$("#TipoDocumento").val("");
$("#NumDocumento").val("");
$("#Nombres").val("");
$("#Apellidos").val("");
$("#FecNac").val("");
$("#NumCel").val("");
$("#Correo").val("");
$("#Direccion").val("");
$("#IdUsuario").val("");
$("#IdSucursal").val("");

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

        url: '../Ajax/ACliente.php?Op=Listar',
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

url: "../Ajax/ACliente.php?Op=GuardaryEditar",
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

function Mostrar(IdCliente)
{

    
    $.post("../Ajax/ACliente.php?Op=Mostrar",{IdCliente : IdCliente}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(true);

            $("#IdCliente").val(data.IdCliente);
            $("#TipoDocumento").val(data.TipoDocumento);
            $("#TipoDocumento").selectpicker('refresh');
            $("#NumDocumento").val(data.NumDocumento);

            $("#Nombres").val(data.Nombres);
            $("#Apellidos").val(data.Apellidos);

            $("#FecNac").val(data.FecNac);
        
            $("#NumCel").val(data.NumCel);
         
            $("#Correo").val(data.Correo);
            $("#Direccion").val(data.Direccion);
        
         




})


}

function Desactivar(IdCliente){

bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR EL REGISTRO?", function(result){

if(result){

    $.post("../Ajax/ACliente.php?Op=Desactivar",{IdCliente : IdCliente}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();

    });


}

})


}




function Activar(IdCliente){

    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL REGISTRO?", function(result){
    
    if(result){
    
        $.post("../Ajax/ACliente.php?Op=Activar",{IdCliente : IdCliente}, function(e){
    
            bootbox.alert(e);
            tabla.ajax.reload();
    
        });
    
    
    }
    
    })
    
    
    }


init();

