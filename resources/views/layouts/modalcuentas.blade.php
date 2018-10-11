<div class="modal fade" id="example1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if($cuentas == "cuenta_vacio")
          @else
            @if(count($cuentas) == 0)
                <center><h5>No existen pagos previos</h5></center>
          @else    
            <table class="table" id="myTable">
            <thead>
              <tr>
              <th>Fecha</th>
              <th>Dejo a Cuenta</th>
              <th>Deuda a la fecha</th>
              
            </tr>
            </thead>
            @foreach($cuentas as $cuenta)
            <tbody>
                <td>{{ $cuenta->fecha }}</td>
                <td>{{ $cuenta->cuenta }}</td>
                <td>{{ $cuenta->deuda }}</td>
                
                

            </tbody>
            @endforeach
          </table>
              @endif
          @endif

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>