
var tablaPE;

function init(){



ListarIngresoTienda();     
    




}



function ListarIngresoTienda()
{
   


   
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

        url: '../Ajax/ATransferenciasPend.php?Op=ListarIngresoTienda',
       
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


    function Aceptar(IdIngresoTienda){

        bootbox.confirm("¿ESTA SEGURO DE RECEPCIONAR LA TRANSFERENCIA?", function(result){
        
        if(result){
        
            $.post("../Ajax/ATransferenciasPend.php?Op=Aceptar",{IdIngresoTienda : IdIngresoTienda}, function(e){
        
                bootbox.alert(e);
             
                tablaPE.ajax.reload();

        
            });
        
        
        }
        
        })
        
        
        }




init();