<?php
require("consulta.php");
 ?>
<!-- Contenedor de Pago-->
<div class="container-pago">
  <div align="center" class="container-total">
 <b><p class="txt-total">TOTAL:</p><div id='resultado'>$0</div></b>
 <br>
 <div id="paypal-button-container"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
</div>
</div>
<div class="container-buscador">

  <input type="text" id="search" placeholder="Buscar..." />

</div>

<!--Tabla con facturas-->
<div class="scroll">
<div class="container-table">

<table class="facturas">
  <thead>
  <tr>
    <th>Folio de Factura</th>
    <th>Descripción</th>
    <th>Fecha de Facturacion</th>
    <th>Estatus</th>
    <th>Moneda</th>
    <th>Total</th>
    <th>Seleccionar</th>
  </tr>
</thead>

<tbody>
  <?php
  $factura_auxiliar=0;
  $fecha_facturacion="";
  $prima=0;
  $descripcion= 0;
  $moneda = "";

  if (mysqli_num_rows($consulta_certificados) == 0)
      echo "</table><p align='center'>No hay facturas por pagar</p>";
   else {
       while ($registro_certificados = mysqli_fetch_array($consulta_certificados)) {
         $calculo_prima = 0;

              if($factura_auxiliar ==$registro_certificados['facturareporte'] || $factura_auxiliar==0){

                $id_factura=$registro_certificados['facturareporte'];
                $factura_auxiliar = $registro_certificados['facturareporte'];
                $fecha_facturacion = $registro_certificados['fecha_facturacion'];
                $prima += $registro_certificados['PrimaTotal'];
                $descripcion ++;
                if ($registro_certificados['Moneda'] == "Pesos")
                      $moneda = "MXN";
                if ($registro_certificados['Moneda'] == "Dolares" || $registro_certificados['facturareporte']==26739)
                      $moneda = "USD";

              }else if($factura_auxiliar!=$registro_certificados['facturareporte']) {

                 $registro_pago=mysqli_query($con,"SELECT * FROM pagos WHERE id_factura='".$id_factura."'");

              if (mysqli_num_rows($registro_pago) == 0){
                $estatus=0;

              }else{
                $estatus=1;
              }
                ?>
                <tr>
                  <td><?=$id_factura;?></td>
                  <td>
                    <button type="button" value="<?=$id_factura;?>" onclick="Mostrar(<?=$id_factura;?>);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Certificados">
                    ver
                  </button>
                    Esta factura contiene: <?=$descripcion?> certificados

                    </td>
                  <td><?=$fecha_facturacion?></td>
                  <?php
                  if($estatus==0){
                  echo "<td>Pendiente de pago</td>";
                }else{
                  echo "<td>En proceso de confirmación</td>";
                }
                   ?>
                  <td><?=$moneda?></td>
                  <td>$ <?= number_format($prima, 2, ".", ",");?></td>

                  <?php
                  if($estatus==0){
                  ?>
                  <td align='center'>
                    <input type='checkbox' class='pago' value='<?=  number_format($prima,2,".","");?>'  ".$check.">
                  </td>
                  <?php
                }else{
                  echo "<td  class='reloj' align='center'><i class='fa fa-clock-o' aria-hidden='true'></i></td>";
                }
                   ?>
                </tr>
                <?php

                $factura_auxiliar = $registro_certificados['facturareporte'];
                $id_factura=$registro_certificados['facturareporte'];
                $descripcion=1;
                $fecha_facturacion = $registro_certificados['fecha_facturacion'];
                $prima = $registro_certificados['PrimaTotal'];
                if ($registro_certificados['Moneda'] == "Pesos")
                      $moneda = "MXN";
                if ($registro_certificados['Moneda'] == "Dolares" || $registro_certificados['facturareporte']==26739)
                      $moneda = "USD";

              }
       }

   }

   ?>
 </tbody>
</table>
</div>
</div>



</div>

<!-- Modal -->
<div class="modal fade" id="Modal_Certificados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLongTitle">Certificados</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="box-body table-responsive">
         <table id="tabla_certificados" class="table_cert" style="background-color: white;
           color: black;
           height: 50px;
           font-size: 15px;">
         </table>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
  var checked = false;
  var items;


$('.check-all').on('click',function(){

if(checked == false) {
$('.pago').prop('checked', true);
checked = true;
} else {
$('.pago').prop('checked', false);
checked = false;
}

$('input[type=checkbox]:checked').each(function(){
  var result = [];
  var i = 0;


  $(this).closest('td').siblings().each(function(){


    result[i] = $(this).text();
    ++i;


  });

  console.log(result.join(' '));
});

});

  var total = 0;
  var a=0;
  var id=[];
  var cantidad=[];
  var id_folio=0;
  var moneda="";
  var list;

$('.pago').on('click',function(){
   total = 0;
   var a = 0;
   id = [];
   cantidad=[];
   moneda="";
   var aux_mon="";
   var aux_not=0;
   list= {
     items :[]
 };


  $('input:checkbox:checked').each(function() {

      var result = [];
      var i = 0;

      $(this).closest('td').siblings().each(function(){
        result[i] = $(this).text();

        //Obtener folio factura y monto

        if(i==0){
          id[a]=result[i];
        }

        if(moneda=="" && i==4){
          moneda=result[i];
          aux_mon=moneda
        }else{
          aux_mon=result[4];
        }

        if(i==5){
          var aux_cant = result[i];
          cantidad[a]=aux_cant.replace(/[^0-9.]+/g, '');

          ++a;
        }
        ++i;

      });

    //Comprobar Moneda
      if(moneda!=aux_mon){
        this.checked = false;
        if(aux_not==0){
          Swal.fire( "Error" ,  "Selecciona el mismo tipo de moneda" ,  "error" )
          aux_not=1;
          id.pop();
          cantidad.pop();
          --a;
        }
      }else{
        total+=Number($(this).attr('value'));


      }

      console.log(moneda);
      console.log(aux_mon);
      console.log(result.join(' '));

    });

     total=roundOf(total,2)
     console.log(total);
document.getElementById('resultado').innerHTML = '$ '+ total.toFixed(2)+ ' '+moneda;

//Obtener items JSON
for (var b = 0; b < id.length; b++) {
    list.items.push({
    name: 'factura: '+id[b],
    quantity: '1',
    price: cantidad[b],
    currency: moneda
  });
};

json = JSON.stringify(list);
items = JSON.parse(json);

console.log(items);

$('#paypal-button-container').empty();

button_PayPal();

});

//Boton de PayPal
function button_PayPal(){






//Paypal renderizar boton
paypal.Button.render({
// Set your environment
env: 'sandbox', // sandbox | production

style: {
layout: 'vertical',  // horizontal | vertical
size:   'medium',    // medium | large | responsive
shape:  'rect',      // pill | rect
color:  'blue'       // gold | blue | silver | white | black
},

// Specify allowed and disallowed funding sources
//
// Options:
// - paypal.FUNDING.CARD
// - paypal.FUNDING.CREDIT
// - paypal.FUNDING.ELV
funding: {
allowed: [
paypal.FUNDING.CARD,
paypal.FUNDING.CREDIT
],
disallowed: []
},

// Enable Pay Now checkout flow (optional)
commit: true,

// PayPal Client IDs - replace with your own
// Create a PayPal app: https://developer.paypal.com/developer/applications/create
client: {
sandbox: 'AQEeGJLkV6D_ayxJlHpvhV5bxIOWKz6o2zIlvigiX7yDy8OkZVBNG4Yxprt_y_If_Yo_xj-pzGdxassH',
production: '<insert production client id>'
},

payment: function (data, actions) {

 aux_to=0;
  for(a=0;a<id.length;a++){
    $.ajax({
       type:'POST',
       url: 'confirmar.php',
       data: {id_usuario:<?=$id_usuario?>,id_factura:id[a],cantidad:cantidad[a]},
       success:function(data){
       if(data==0){

       }else{
         location.reload();
       }
            },
            error:function(data){

            }
          });
          ++a;

  }
return actions.payment.create({
payment: {
  transactions: [
    {
      amount: {

        total: total,
        currency: moneda,
      },
      description: 'Pago facturas BAS Agentes',
      item_list: items
    }

  ]
}
});
},
onAuthorize: function (data, actions) {
return actions.payment.execute()
.then(function () {

//Insertar datos de pago en DB
var id_folio=0;
  $.ajax({
     type:'POST',
     url: 'pago.php',
     data: {id_usuario:<?=$id_usuario?>,moneda:moneda,total:total},
     success:function(data){
     id_folio=data;
     if(id_folio!=0){
     for(a=0;a<id.length;a++){
       $.ajax({
          type:'POST',
          url: 'confirmar_pago.php',
          data: {id_usuario:<?=$id_usuario?>,id_factura:id[a],cantidad:cantidad[a],id_folio:id_folio},
          success:function(data){
          if(data==0){

          }else{
            alert("Error");
          }
               },
               error:function(data){

               }
             });

     }

     $.ajax({
        type:'POST',
        url: 'generarPDF.php',
        data: {folio:id_folio,facturas:items},
        success:function(data){

          location.reload();

             },
             error:function(data){
               alert("Error");
             }
           })



   }else{
     alert("error");
   }


          },
          error:function(data){
          }
        });

        Swal.fire({
        position: 'top-end',
        type: 'success',
        title: 'Pago realizado correctamente',
        showConfirmButton: false,
        timer: 2500
      })



});
},
onCancel: function(data, actions) {
      Swal.fire( "Cancelada" ,  "Transacción cancelada por el usuario" ,  "error" );
},

onError: function(error) {
  if(total==0){
    Swal.fire( "Error" ,  "Debes seleccionar facturas para pagar" ,  "error" );
  }else
    Swal.fire( "Error" ,  "Ocurrio un error al procesar su pago" ,  "error" );
    console.log(error);
}
}, '#paypal-button-container');
}

$(button_PayPal());

$(function () {

  $('#search').quicksearch('table tbody tr');
});

//Mostrar Certificados de la factura
function Mostrar(factura){
$("#tabla_certificados").html("");

  $.ajax({
        type:'POST',
        url: 'buscarcertificados.php',
        data: {factura:factura},
        success:function(data){
     $("#tabla_certificados").html(data);
             },
             error:function(data){
              //registro fallido
              alert("Registro fallido");
             }
           });
           $('#Modal_Certificados').on('shown.bs.modal', function () {


             $('#myInput').trigger('focus')
           });
}

function roundOf(n, p) {
    const n1 = n * Math.pow(10, p + 1);
    const n2 = Math.floor(n1 / 10);
    if (n1 >= (n2 * 10 + 5)) {
        return (n2 + 1) / Math.pow(10, p);
    }
    return n2 / Math.pow(10, p);
}

</script>
