var ordenDetalleProductos = {};
var ordenDetallePromociones = {};
var ordenTotal = 0;

$(document).ready(function(){

  function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }

    $(function() {
        $("#pagado").change(function() {
          if(this.checked) {
            var valor = 1;  //chekced
          } else {
            var valor = 0;
          }
          var idDetalle = $('#idDetalle').val();
          var tipo = "detalle_pedido_pagado";

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
              type: "POST",
              url: '../marcarPedido',
              data: {'idDetalle':idDetalle,'valor':valor, 'tipo': tipo},
              cache: false,
              success: function(data){
                alert('Se ha guardado la modificación!!');
              }
          });
        });
    });

    $(function() {
        $("#tipo_entrega").change(function() {
          if(this.checked) {
            var valor = 1;  //chekced
          } else {
            var valor = 0;
          }

          var idDetalle = $('#idDetalle').val();
          var tipo = "detalle_pedido_domicilio";

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
              type: "POST",
              url: '../marcarPedido',
              data: {'idDetalle':idDetalle,'valor':valor, 'tipo': tipo},
              cache: false,
              success: function(data){
                alert('Se ha guardado la modificación!!');
              }
          });
        });
    });

    $(function() {
        $("#entregado").change(function() {
          if(this.checked) {
            var valor = 1;  //chekced
          } else {
            var valor = 0;
          }

          var idDetalle = $('#idDetalle').val();
          var tipo = "detalle_pedido_entregado";

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
              type: "POST",
              url: '../marcarPedido',
              data: {'idDetalle':idDetalle,'valor':valor, 'tipo': tipo},
              cache: false,
              success: function(data){
                alert('Se ha guardado la modificación!!');
              }
          });
        });
    });

    $(function() {
        $("#detalleFinPedido").on("show.bs.modal", function (e) {
             console.log("entre al modal");
             $("#total_monto").val(ordenTotal);
        });
    });

    $( "#finPedido" ).on('submit', function(e) {
      e.preventDefault();

      var cliente_nombre = $('#cliente_nombre').val();
      var domicilio = $('#domicilio').val();
      var tiempo_espera = $('#tiempo_espera').val();
      var total_monto = $('#total_monto').val();
      var medio_pago = $('#mediopago').val();

      if($("#tipo_entrega").prop('checked')){
        var tipo_entrega = 1  //chekced
      } else{
        var tipo_entrega = 0 // unchecked
      }

      if($("#entregado").prop('checked')){
        var entregado = 1  //chekced
      } else{
        var entregado = 0 // unchecked
      }

      if($("#pagado").prop('checked')){
        var pagado = 1  //chekced
      } else{
        var pagado = 0 // unchecked
      }

      var observacion = $('#observacion').val();
      var fono = $('#fono').val();

      $.ajax({
          type: "POST",
          url: '../resources/assets/ajax/procesar-array.php',
          data: {'ordenDetalleProductos': JSON.stringify(ordenDetalleProductos),'ordenDetallePromociones': JSON.stringify(ordenDetallePromociones)},
          cache: false,
          success: function(data){
            $('#items').val(data);
            items = data;
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $(function() {
              $( "#datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd/mm/yy'
              });
            });

            $.ajax({
                type: "POST",
                url: '../public/finPedido',
                data: {items:items, cliente_nombre:cliente_nombre,
                domicilio:domicilio, tiempo_espera:tiempo_espera,
                total_monto:total_monto, medio_pago:medio_pago,
                tipo_entrega:tipo_entrega, entregado:entregado,
                pagado:pagado, observacion:observacion, fono:fono},
                cache: false,
                success: function(data){

                  $('html').fadeOut().html(data).fadeIn();
                }
            });

          }
      });

    });

    $(function() {
        $("#eliminarModal").on("show.bs.modal", function (e) {
             console.log("entre");
             $("#eliminarModalLabel").html($(e.relatedTarget).data('title'));
             $("#elim-title").html($(e.relatedTarget).data('title'));
             $("#elim-id").val($(e.relatedTarget).data('id'));
        });
    });

    $(function() {
        $(".sumaProducto").on("click", function (e) {
             console.log("entre al function");

             if ($( "#prod"+$(this).data("id") ).length == 0){
               console.log("entre al if");
               $('#containerOrden').append(
                    $('<div>').attr({class:"row", id:"prod"+$(this).data("id")}).append(
                        $('<div>').attr('class', "col-sm-2").append(
                            $('<button>').attr('class', 'btn btn-danger elimProducto')
                            .attr('type', 'button')
                            .attr({'data-id':$(this).data("id"), 'data-price':$(this).data("price"), 'data-cant':1, 'data-target':'#ordenActual'})
                            .attr('id', "elim"+$(this).data("id")).append("X")
                        )
                    )
                );

                $('#prod'+$(this).data("id")).append(
                     $('<div>').attr('class', "col-sm-6").append(
                         $(this).data("title")
                     )
                 );

                 $('#prod'+$(this).data("id")).append(
                      $('<div>').attr({class:"col-sm-1", id:"prodcant"+$(this).data("id")}).append(
                          1
                      )
                  );

                  $('#prod'+$(this).data("id")).append(
                       $('<div>').attr({class:"col-sm-1", id:"prodprec"+$(this).data("id")}).append(
                           "$"+$(this).data("price")
                       )
                   );

                   ordenDetalleProductos['prod' + $(this).data("id")] = 1;
                   $('#cantProd'+$(this).data("id")).val(1);

                   ordenTotal = ordenTotal + $(this).data("price");
                   $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");



             } else {

                  cantidad = parseInt($('#prodcant'+$(this).data("id")).text());
                  cantidad = cantidad + 1;
                  $('#prodcant'+$(this).data("id")).html(cantidad);
                  ordenDetalleProductos['prod' + $(this).data("id")] = cantidad;

                  console.log("ordenDetalleProductos["+'prod' + $(this).data("id")+"]="+ordenDetalleProductos['prod' + $(this).data("id")]);

                  $('#cantProd'+$(this).data("id")).val(cantidad);

                  ordenTotal = ordenTotal + $(this).data("price");
                  $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");

             }

        });
    });


    $(function() {
        $(".restaProducto").on("click", function (e) {
             console.log("entre al function");
             console.log($(this).data("id"));
             if ($( "#prod"+$(this).data("id") ).length != 0){
               console.log("entre al if");
               if (parseInt($('#prodcant'+$(this).data("id")).text()) == 1){
                 console.log("entre al segundo if");

                 ordenDetalleProductos['prod' + $(this).data("id")] = 0;
                 ordenTotal = ordenTotal - $(this).data("price");
                 $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");

                 $('#cantProd'+$(this).data("id")).val(0);
                 $('#prod'+$(this).data("id")).remove();

               } else {

                    cantidad = parseInt($('#prodcant'+$(this).data("id")).text());
                    cantidad = cantidad - 1;
                    $('#prodcant'+$(this).data("id")).html(cantidad);
                    ordenDetalleProductos['prod' + $(this).data("id")] = cantidad;

                    $('#cantProd'+$(this).data("id")).val(cantidad);

                    ordenTotal = ordenTotal - $(this).data("price");
                    $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");

               }
            }
        });
    });


    $(function() {
        $(".elimProducto").on("click", function (e) {
             console.log("entre al eliminar");

                 ordenTotal = ordenTotal - $(this).data("price")*ordenDetalleProductos['prod' + $(this).data("id")];
                 ordenDetalleProductos['prod' + $(this).data("id")] = 0;

                 $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");

                 $('#cantProd'+$(this).data("id")).val(0);
                 $('#prod'+$(this).data("id")).remove();

        });
    });

    $(function() {
        $(".sumaPromocion").on("click", function (e) {
             console.log("entre al function");

             if ($( "#prom"+$(this).data("id") ).length == 0){
               console.log("entre al if");
               $('#containerOrden').append(
                    $('<div>').attr({class:"row", id:"prom"+$(this).data("id")}).append(
                        $('<div>').attr('class', "col-sm-2").append(
                            $('<button>').attr('class', 'btn btn-danger elimPromocion')
                            .attr('type', 'button')
                            .attr({'data-id':$(this).data("id"), 'data-price':$(this).data("price"), 'data-cant':1, 'data-target':'#ordenActual'})
                            .attr('id', "elim"+$(this).data("id")).append("X")
                        )
                    )
                );


                $('#prom'+$(this).data("id")).append(
                     $('<div>').attr('class', "col-sm-6").append(
                         $(this).data("title")
                     )
                 );

                 $('#prom'+$(this).data("id")).append(
                      $('<div>').attr({class:"col-sm-1", id:"promcant"+$(this).data("id")}).append(
                          1
                      )
                  );

                  $('#prom'+$(this).data("id")).append(
                       $('<div>').attr({class:"col-sm-1", id:"promprec"+$(this).data("id")}).append(
                           "$"+$(this).data("price")
                       )
                   );

                   ordenDetallePromociones['prom' + $(this).data("id")] = 1;
                   $('#cantProm'+$(this).data("id")).val(1);

                   ordenTotal = ordenTotal + $(this).data("price");
                   $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");



             } else {

                  cantidad = parseInt($('#promcant'+$(this).data("id")).text());
                  cantidad = cantidad + 1;
                  $('#promcant'+$(this).data("id")).html(cantidad);
                  ordenDetallePromociones['prom' + $(this).data("id")] = cantidad;

                  $('#cantProm'+$(this).data("id")).val(cantidad);

                  ordenTotal = ordenTotal + $(this).data("price");
                  $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");

             }

        });
    });


    $(function() {
        $(".restaPromocion").on("click", function (e) {
             console.log("entre al function");
             console.log($(this).data("id"));
             if ($( "#prom"+$(this).data("id") ).length != 0){
               console.log("entre al if");
               if (parseInt($('#promcant'+$(this).data("id")).text()) == 1){
                 console.log("entre al segundo if");

                 ordenDetallePromociones['prom' + $(this).data("id")] = 0;
                 ordenTotal = ordenTotal - $(this).data("price");
                 $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");

                 $('#cantProm'+$(this).data("id")).val(0);
                 $('#prom'+$(this).data("id")).remove();

               } else {

                    cantidad = parseInt($('#promcant'+$(this).data("id")).text());
                    cantidad = cantidad - 1;
                    $('#promcant'+$(this).data("id")).html(cantidad);
                    ordenDetallePromociones['prom' + $(this).data("id")] = cantidad;

                    $('#cantProm'+$(this).data("id")).val(cantidad);

                    ordenTotal = ordenTotal - $(this).data("price");
                    $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");



               }
            }
        });
    });


    $(function() {
        $(".elimPromocion").on("click", function (e) {
             console.log("entre al eliminar");

                 ordenTotal = ordenTotal - $(this).data("price")*ordenDetallePromociones['prom' + $(this).data("id")];
                 ordenDetallePromociones['prom' + $(this).data("id")] = 0;

                 $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");

                 $('#cantProm'+$(this).data("id")).val(0);
                 $('#prom'+$(this).data("id")).remove();

        });
    });


});
