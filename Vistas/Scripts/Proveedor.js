var tabla;

function init(){

MostrarForm(false);
Listar();

$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})


}
function limpiar(){

    $("#IdProveedor").val("");
$("#RazonSocial").val("");
$("#TipoDocumento").val("");
$("#NumDocumento").val("");
$("#Rublo").val("");
$("#NumCelular").val("");
$("#Telf").val("");
$("#Correo").val("");


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

        url: '../Ajax/AProveedor.php?Op=Listar',
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

url: "../Ajax/AProveedor.php?Op=GuardaryEditar",
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

function Mostrar(IdProveedor)
{

    
    $.post("../Ajax/AProveedor.php?Op=Mostrar",{IdProveedor : IdProveedor}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(true);

            
        
            $("#IdProveedor").val(data.IdProveedor);
            $("#RazonSocial").val(data.RazonSocial);
            $("#TipoDocumento").val(data.TipoDocumento);
            $("#TipoDocumento").selectpicker('refresh');
            $("#NumDocumento").val(data.NumDocumento);
            $("#Rublo").val(data.Rublo);
            $("#Rublo").selectpicker('refresh');
            $("#NumCelular").val(data.NumCelular);
            $("#Telf").val(data.Telf);
            $("#Correo").val(data.Correo);
         




})


}

function Desactivar(IdProveedor){

bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR EL REGISTRO?", function(result){

if(result){

    $.post("../Ajax/AProveedor.php?Op=Desactivar",{IdProveedor : IdProveedor}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();

    });


}

})


}




function Activar(IdProveedor){

    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL REGISTRO?", function(result){
    
    if(result){
    
        $.post("../Ajax/AProveedor.php?Op=Activar",{IdProveedor : IdProveedor}, function(e){
    
            bootbox.alert(e);
            tabla.ajax.reload();
    
        });
    
    
    }
    
    })
    
    
    }


init();

