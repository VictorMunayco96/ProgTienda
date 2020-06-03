var tabla;

function init(){

MostrarForm(false);
Listar();

$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})


$.post("../Ajax/ACompra.php?Op=SelectProveedor", function(r){

    $("#IdProveedor").html(r);
    $('#IdProveedor').selectpicker('refresh');
    
    
    
    });
 

}
function limpiar(){

    $("#IdCompra").val("");
$("#SerieCompro").val("");
$("#NumCompro").val("");
$("#Asunto").val("");
$("#Descripcion").val("");
$("#Impuesto").val("");
$("#TotalCompra").val("");

}

function MostrarForm(flag){

limpiar();
$("#Print").hide();

if (flag){

$("#ListadoRegistros").hide();
$("#FormularioRegistros").show();
$("#BtnGuardar").prop("disabled",false);

ListarProductoC();


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

        url: '../Ajax/ACompra.php?Op=Listar',
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

function ListarProductoC(){

    tabla=$("#TblProductos").dataTable(
        
        {
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons:[
               
    
        ],
    
        "ajax":{
    
            url: '../Ajax/ACompra.php?Op=SelectProductoC',
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

url: "../Ajax/ACompra.php?Op=GuardaryEditar",
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

    
    $.post("../Ajax/ACompra.php?Op=Mostrar",{Id : IdProducto}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(true);

            $("#IdCompra").val(data.IdProducto);
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

function Anular(IdCompra){

bootbox.confirm("¿ESTA SEGURO DE ANULAR LA COMPRA?", function(result){

if(result){

    $.post("../Ajax/ACompra.php?Op=Desactivar",{IdCompra : IdCompra}, function(e){

        bootbox.alert(e);
        tabla.ajax.reload();

    });


}

})


}




//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto=18;
var cont=0;
var detalles=0;
//$("#Guardar").hide();
$("#BtnGuardar").hide();
$("#TipoComprobante").change(MarcarImpuesto);


function MarcarImpuesto()
  {
  	var tipo_comprobante=$("#TipoComprobante option:selected").text();
  	if (tipo_comprobante=='Factura')
    {
        $("#Impuesto").val(impuesto); 
    }
    else
    {
        $("#Impuesto").val("0"); 
    }
  }


  function AgregarDetalle(IdProducto,Nombre)
  {
  	var Cantidad=1;
    var PrecioCompra=1;
    var CodigoBarra=1;
    

    if (IdProducto!="")
    {
    	var subtotal=Cantidad*PrecioCompra;
    	var fila='<tr class="filas" id="fila'+cont+'">'+
    	'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    	'<td><input type="hidden" name="IdProducto[]" value="'+IdProducto+'">'+Nombre+'</td>'+
    	'<td><input type="number" name="Cantidad[]" id="Cantidad[]" value="'+Cantidad+'"></td>'+
    	'<td><input type="number" name="PrecioCompra[]" id="PrecioCompra[]" value="'+PrecioCompra+'"></td>'+
    	'<td><input type="number" name="CodigoBarra[]" value="'+CodigoBarra+'"></td>'+
    	'<td><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</span></td>'+
    	'<td><button type="button" onclick="modificarSubototales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
    	'</tr>';
    	cont++;
    	detalles=detalles+1;
    	$('#Detalles').append(fila);
    	modificarSubototales();
    }
    else
    {
    	alert("Error al ingresar el detalle, revisar los datos del artículo");
    }
  }










init();
