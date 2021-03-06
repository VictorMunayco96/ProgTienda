var tabla;

function init(){

MostrarForm(false);
Listar();

$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})


$.post("../Ajax/ASucursal.php?Op=SelectTienda", function(r){

    $("#IdTienda").html(r);
    $('#IdTienda').selectpicker('refresh');
    
    
    
    });

}
function limpiar(){


    $("#IdSucursal").val("");
$("#IdTienda").val("");
$("#Direccion").val("");
$("#Departamento").val("");
$("#Provincia").val("");


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

        url: '../Ajax/ASucursal.php?Op=Listar',
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

url: "../Ajax/ASucursal.php?Op=GuardaryEditar",
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

function Mostrar(IdSucursal)
{

    
    $.post("../Ajax/ASucursal.php?Op=Mostrar",{IdSucursal : IdSucursal}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(true);

            $("#IdSucursal").val(data.IdSucursal);
         
            $("#IdTienda").val(data.IdTienda);
            $("#IdTienda").selectpicker('refresh');

        $("#Direccion").val(data.Direccion);
            

        $("#Departamento").val(data.Departamento);
        
        $("#Provincia").val(data.Provincia);
            
         




})


}

function Desactivar(IdSucursal){

bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR EL REGISTRO?", function(result){

if(result){

    $.post("../Ajax/ASucursal.php?Op=Desactivar",{IdSucursal : IdSucursal}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();

    });


}

})


}




function Activar(IdSucursal){

    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL REGISTRO?", function(result){
    
    if(result){
    
        $.post("../Ajax/ASucursal.php?Op=Activar",{IdSucursal : IdSucursal}, function(e){
    
            bootbox.alert(e);
            tabla.ajax.reload();
    
        });
    
    
    }
    
    })
    
    
    }


init();

