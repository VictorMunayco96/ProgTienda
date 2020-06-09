var tabla;
var tablaP;
var tablaPE;

function init(){

MostrarForm(1);
ListarCabeceraProducto();
limpiar();
$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})



$.post("../Ajax/AIngresoTienda.php?Op=SelectSucursal", function(r){

    $("#IdSucursal").html(r);
    $('#IdSucursal').selectpicker('refresh');
    
    
    
    });


        
    




}
function limpiar(){


    $("#IdIngresoTienda").val("");
    $("#Cantidad").val("");
    $("#IdSucursal").val("");
    $("#IdUsuario").val("");
    $("#PrecioVentaXMenor").val("");
    $("#PrecioVentaXMayor").val("");
    $("#IdDetalleCompra").val("");

}

function Mostrar(IdIngresoTienda)
{

    
    $.post("../Ajax/AIngresoTienda.php?Op=Mostrar",{IdIngresoTienda : IdIngresoTienda}, function(data,status)
        {
            data =JSON.parse(data);
            
            MostrarForm(3);

            $("#IdIngresoTienda").val(data.IdIngresoTienda);
            $("#Cantidad").val(data.Cantidad);
            $("#IdSucursal").val(data.IdSucursal);
            $("#IdSucursal").selectpicker('refresh');
            $("#PrecioVentaXMenor").val(data.PrecioVentaXMenor);
            $("#PrecioVentaXMayor").val(data.PrecioVentaXMayor);
         
            $("#IdDetalleCompra").val(data.IdDetalleCompra);
        
          

           

         




})


}



function AgregarIngresoTienda(IdDetalleCompra)
{
    MostrarForm(3);

        $("#IdDetalleCompra").val(IdDetalleCompra);


        


}









function MostrarForm($Ventana){

    limpiar();
    if ($Ventana==1){
    
    $("#ListadoCabecera").show();
    $("#FormularioRegistros").hide();
    $("#ListadoPedidoSemanal").hide();
    $("#ListadoPedido").hide();
    $("#BtnGuardar").prop("disabled",false);
    
    
    }

    if ($Ventana==2){
    
        $("#ListadoCabecera").hide();
        $("#FormularioRegistros").hide();
        $("#ListadoPedidoSemanal").show();
        $("#ListadoPedido").hide();
        $("#BtnGuardar").prop("disabled",false);
        
        
        }

        if ($Ventana==3){
    
            $("#ListadoCabecera").hide();
            $("#FormularioRegistros").show();
            $("#ListadoPedidoSemanal").hide();
            $("#ListadoPedido").hide();
            $("#BtnGuardar").prop("disabled",false);
            
            
            }

            if ($Ventana==4){
    
                $("#ListadoCabecera").hide();
                $("#FormularioRegistros").hide();
                $("#ListadoPedidoSemanal").hide();
                $("#ListadoPedido").show();
                $("#BtnGuardar").prop("disabled",false);
                
                
                }
            

        

    

}



function CancelarForm(){

    limpiar();
    MostrarForm(1);
}

function ListarCabeceraProducto(){

tabla=$("#tbllistadoC").dataTable(
    
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

        url: '../Ajax/AIngresoTienda.php?Op=ListarCabeceraProducto',
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

url: "../Ajax/AIngresoTienda.php?Op=GuardaryEditar",
type: "POST",
data: formData,
contentType: false,
processData: false,

success: function(datos){

    bootbox.alert(datos);
    MostrarForm(1);
    tabla.ajax.reload();

}


});

limpiar();

}

function ListarDetalleCompra(IdProducto)
{
   MostrarForm(2);

var Hola = IdProducto;
   
tablaP=$("#tbllistadoPS").dataTable(
    
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

        url: '../Ajax/AIngresoTienda.php?Op=ListarDetalleCompra&IdProducto='+Hola,
        //data:{IdCabeceraPedido:Hola},
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


function ListarIngresoTienda(IdDetalleCompra)
{
   MostrarForm(4);

var Hola = IdDetalleCompra;
   
tablaPE=$("#tbllistadoPE").dataTable(
    
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

        url: '../Ajax/AIngresoTienda.php?Op=ListarIngresoTienda&IdDetalleCompra='+Hola,
        //data:{IdCabeceraPedido:Hola},
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






function Desactivar(IdIngresoTienda){

bootbox.confirm("¿ESTA SEGURO DE DESACTIVAR LA TRANSFERENCIA?", function(result){

if(result){

    $.post("../Ajax/AIngresoTienda.php?Op=Desactivar",{IdIngresoTienda : IdIngresoTienda}, function(e){

        bootbox.alert(e);
        tablaP.ajax.reload();
        tabla.ajax.reload();
        tablaPE.ajax.reload();

    });


}

})


}




function Activar(IdIngresoTienda){

    bootbox.confirm("¿ESTA SEGURO DE ACTIVAR LA TRANSFERENCIA?", function(result){
    
    if(result){
    
        $.post("../Ajax/AIngresoTienda.php?Op=Activar",{IdIngresoTienda : IdIngresoTienda}, function(e){
    
            bootbox.alert(e);
            tablaP.ajax.reload();
            tabla.ajax.reload();
            tablaPE.ajax.reload();
    
        });
    
    
    }
    
    })
    
    
    }

    function Aceptar(IdIngresoTienda){

        bootbox.confirm("¿ESTA SEGURO DE RECEPCIONAR LA TRANSFERENCIA?", function(result){
        
        if(result){
        
            $.post("../Ajax/AIngresoTienda.php?Op=Aceptar",{IdIngresoTienda : IdIngresoTienda}, function(e){
        
                bootbox.alert(e);
                tablaP.ajax.reload();
                tabla.ajax.reload();
                tablaPE.ajax.reload();

        
            });
        
        
        }
        
        })
        
        
        }

        function Rechazar(IdIngresoTienda){

            bootbox.confirm("¿ESTA SEGURO DE RECHAZAR LA TRANSFERENCIA?", function(result){
            
            if(result){
            
                $.post("../Ajax/AIngresoTienda.php?Op=Rechazar",{IdIngresoTienda : IdIngresoTienda}, function(e){
            
                    bootbox.alert(e);
                    tablaP.ajax.reload();
                    tabla.ajax.reload();
                    tablaPE.ajax.reload();
            
                });
            
            
            }
            
            })
            
            
            }



init();