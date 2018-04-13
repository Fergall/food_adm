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
      $( document ).on("click", ".elimProducto" ,function (e) {
           console.log("entre al eliminar");

               ordenTotal = ordenTotal - $(this).data("price")*ordenDetalleProductos['prod' + $(this).data("id")];
               ordenDetalleProductos['prod' + $(this).data("id")] = 0;

               $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");

               $('#cantProd'+$(this).data("id")).val(0);
               $('#prod'+$(this).data("id")).remove();

      });
  });

  $(function() {
      $( document ).on("click", ".elimPromocion" ,function (e) {
           console.log("entre al eliminar");

               ordenTotal = ordenTotal - $(this).data("price")*ordenDetallePromociones['prom' + $(this).data("id")];
               ordenDetallePromociones['prom' + $(this).data("id")] = 0;

               $('#totalPedido').html("<h3>$"+addCommas(ordenTotal)+"</h3>");

               $('#cantprom'+$(this).data("id")).val(0);
               $('#prom'+$(this).data("id")).remove();

      });
  });

  $(function() {
    $( ".datepicker" ).datepicker({
         onSelect: function(date) {
             console.log('entro aqui');
             $('#dateInicioExcel').val($('#dateInicio').val());
             $('#dateFinExcel').val($('#dateFin').val());
         },
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy'
    });
  });
