<table>
  <thead>
    <tr>
      <th>Modelo</th>
      <th>Cantidad sugerida</th>
      <th>Cantidad actual</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($toners as $toner)
      <tr>
        <td>{{$toner->modelo}}</td>
        <td>{{$toner->cantidadSugerida}}</td>
        <td>{{$toner->cantidad}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
