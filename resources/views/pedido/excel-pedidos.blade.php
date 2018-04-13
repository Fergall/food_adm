<html>
    <body>
      <table border="1">
        <thead>
          <tr>
            <th>N° pedido</th>
            <th>Atención</th>
            <th>Fecha</th>
            <th>Hora de pedido</th>
            <th>Hora de entrega</th>
            <th>Cliente</th>
            <th>Direccion</th>
            <th>Fono</th>
            <th>Total</th>
            <th>Medio de pago</th>
          </tr>
        </thead>
      @foreach ($pedidos as $listaPedidos)
      <tr>
        <td>{{$listaPedidos->detalle_pedido_numero}}</td>
        <td>{{$listaPedidos->name}}</td>
        <td>{{$listaPedidos->detalle_pedido_hora_pedido->format('d/m/Y')}}</td>
        <td>{{$listaPedidos->detalle_pedido_hora_pedido->format('G:i')}}</td>
        <td>{{$listaPedidos->detalle_pedido_hora_entrega->format('G:i')}}</td>

        <td>{{$listaPedidos->detalle_pedido_nombre}}</td>
        <td>{{$listaPedidos->detalle_pedido_direccion}}</td>
        <td>{{$listaPedidos->detalle_pedido_fono}}</td>
        <td>{{$listaPedidos->detalle_pedido_total}}</td>
        <td>{{$listaPedidos->medio_pago_nombre}}</td>
     </tr>
     @endforeach
     </table>
    </body>
</html>
