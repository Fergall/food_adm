<html>
    <body>
      <table border="1">
        <thead>
          <tr>
            <th>Nombre de producto</th>
            <th>Cantidad de ventas en el periodo</th>
          </tr>
        </thead>
      @foreach ($listaEstadistica as $listaPedidos)
      <tr>
        <td>{{$listaPedidos->nombre}}</td>
        <td>{{$listaPedidos->amount}}</td>
     </tr>
     @endforeach
     </table>
    </body>
</html>
