var tabla;

function init(){

MostrarForm(false);
Listar();

$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})


$.post("../Ajax/AProducto.php?Op=SelectCategoria", function(r){

    $("#IdCategoria").html(r);
    $('#IdCategoria').selectpicker('refresh');
    
    
    
    });
    $("#imagenmuestra").hide();

}
function limpiar(){

    $("#IdProducto").val("");
$("#IdCategoria").val("");
$("#Codigo").val("");
$("#Nombre").val("");
$("#StockMinTienda").val("");
$("#StockMinGeneral").val("");
$("#Descripcion").val("");

$("#imagenmuestra").hide();


$("#imagenmuestra").attr("src","");
}

function MostrarForm(flag){

limpiar();
$("#Print").hide();

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

        url: '../Ajax/AProducto.php?Op=Listar',
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

url: "../Ajax/AProducto.php?Op=GuardaryEditar",
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

function Mostrar(IdProducto)
{

    
    $.post("../Ajax/AProducto.php?Op=Mostrar",{IdProducto : IdProducto}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(true);

            $("#IdProducto").val(data.IdProducto);
            $("#IdCategoria").val(data.IdCategoria);
            $('#IdCategoria').selectpicker('refresh');
            $("#Codigo").val(data.Codigo);
            $("#Nombre").val(data.Nombre);
            $("#StockMinTienda").val(data.StockMinTienda);
            $("#StockMinGeneral").val(data.StockMinGeneral);
            $("#Descripcion").val(data.Descripcion);
            $("#imagen").val(data.imagen);
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src","../Files/Productos/"+data.imagen);
            $("#imagenactual").val(data.imagen);

            GenerarBarcode();
                

            




})


}

function Desactivar(IdProducto){

bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR EL PRODUCTO?", function(result){

if(result){

    $.post("../Ajax/AProducto.php?Op=Desactivar",{IdProducto : IdProducto}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();

    });


}

})


}




function Activar(IdCategoria){

    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR EL PRODUCTO?", function(result){
    
    if(result){
    
        $.post("../Ajax/AProducto.php?Op=Activar",{IdProducto : IdProducto}, function(e){
    
            bootbox.alert(e);
            tabla.ajax.reload();
    
        });
    
    
    }
    
    })
    
    
    }


    //función para generar el código de barras
function GenerarBarcode()
{
	codigo=$("#Codigo").val();
	JsBarcode("#Barcode", codigo);
	$("#Print").show();
}

//Función para imprimir el Código de barras
function imprimir()
{
	$("#Print").printArea();
}


init();

