 <div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Conceptos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if($conceptos == "concepto_vacio")
          @else
            @if(count($conceptos) == 0)
                <center><h5>No existen pagos previos</h5></center>
          @else    
            <table class="table" id="myTable">
            <thead>
              <tr>
              
              <th>Concepto</th>
              <th>precio</th>
            </tr>
            </thead>
            @foreach($conceptos as $concepto)
            <tbody>
              
                <td>{{ $concepto->concepto }}</td>
                <td>{{ $concepto->precio }}</td>
              

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