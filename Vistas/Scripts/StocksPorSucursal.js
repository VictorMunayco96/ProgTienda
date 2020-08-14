var tabla;

function init(){




$("#Formulario").on("submit",function(e){

    GuardaryEditar(e);

})


$.post("../Ajax/AStocksPorSucursal.php?Op=SelectSucursal", function(r){

    $("#Sucursal").html(r);
    $('#Sucursal').selectpicker('refresh');
    
    
    
    });





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

        url: '../Ajax/AStocksPorSucursal.php?Op=Listar',
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


function ListarPorSucursal(){

    var Sucursal = $("#Sucursal").val();

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
    
            url: '../Ajax/AStocksPorSucursal.php?Op=ListarPorSucursal',
            data:{Sucursal: Sucursal},
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








init();

