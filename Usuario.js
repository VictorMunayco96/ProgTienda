var tabla;

function init(){

MostrarForm(false);
Listar();

$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})



$.post("../Ajax/AUsuario.php?Op=SelectEmpleado", function(r){

$("#IdEmpleado").html(r);
$('#IdEmpleado').selectpicker('refresh');



});

$.post("../Ajax/AUsuario.php?Op=Permiso&Id=", function(r){

    $("#Permiso").html(r);
    $('#Permiso').selectpicker('refresh');
    
    
    
    });
    




}
function limpiar(){

    $("#IdUsuario").val("");
$("#Usuario").val("");
$("#Contrasena").val("");
$("#TipoUsuario").val("");


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

        url: '../Ajax/AUsuario.php?Op=Listar',
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

url: "../Ajax/AUsuario.php?Op=GuardaryEditar",
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

function Mostrar(IdUsuario)
{

    
    $.post("../Ajax/AUsuario.php?Op=Mostrar",{IdUsuario : IdUsuario}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(true);
            $("#Sectores").val(data.Sector);
            $("#Sectores").selectpicker('refresh');
            $("#IdEmpleado").val(data.IdEmpleado);
            $("#IdEmpleado").selectpicker('refresh');
            $("#IdUsuario").val(data.IdUsuario);
            $("#Usuario").val(data.Usuario);
            $("#Contrasena").val(data.Contrasena);
            $("#TipoUsuario").val(data.TipoUsuario);
            $("#TipoUsuario").selectpicker('refresh');
           
        

         




});

$.post("../Ajax/AUsuario.php?Op=Permiso&Id="+IdUsuario, function(r){

    $("#Permiso").html(r);
    $('#Permiso').selectpicker('refresh');
    
    
    
    });


}

function Desactivar(IdUsuario){

bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR EL USUARIO?", function(result){

if(result){

    $.post("../Ajax/AUsuario.php?Op=Desactivar",{IdUsuario : IdUsuario}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();

    });


}

})


}




function Activar(IdUsuario){

    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL USUARIO?", function(result){
    
    if(result){
    
        $.post("../Ajax/AUsuario.php?Op=Activar",{IdUsuario : IdUsuario}, function(e){
    
            bootbox.alert(e);
            tabla.ajax.reload();
    
        });
    
    
    }
    
    })
    
    
    }


init();