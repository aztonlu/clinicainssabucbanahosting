function addConcepto() {
    
    var concepto = document.getElementById('concepto').value;
    var precio = document.getElementById('costo').value;
    
    if (concepto == "" || precio == "") {
        alert("POR FAVOR INGRESA LOS DATOS SOLICITADOS");
    }
    else
    {
        var hidden = "hidden";
        var conceptoV = "concepto[]";
        var precioV = "precio[]";
        var x = document.getElementById("myTable").rows.length;
        var click = "funcionEliminar(this,"+x+")";
        var buttonclase = "button";
        

        $("#cuerpoTabla").append("<tr><td>"+x+"</td><td>"+concepto+"</td><input type="+hidden+" name="+conceptoV+" value="+concepto+"><td>"+precio+"</td><td><button type="+buttonclase+" onclick="+click+">Eliminar</button></td><input type="+hidden+" id="+x+" name="+precioV+" value="+precio+"></tr>");
        

        
        var a = parseInt(document.getElementById("total").value);
        var b = a + parseInt(precio);
        document.getElementById("total").value = b;

        //calcula la deuda total
        var deuda = document.getElementById('deuda').value;
        if(deuda == "")
        {
            console.log("deuda en 0");
            var deudatotal = b;
        }
        else
        {
            console.log("deuda existente");
            var deudatotal = parseInt(deuda) + parseInt(precio);
        }
        
        document.getElementById("totaldeuda").value = deudatotal;
        document.getElementById("deuda").value = deudatotal;
        //limpia campos y manda al concepto
        document.getElementById('concepto').value = "";
        document.getElementById('costo').value = "";
        document.getElementById('concepto').focus();
    }
    
}
function funcionEliminar(obj,x)
{
  var id = x;
  var precio = parseInt(document.getElementById(id).value);
  //resta de deudas
  var deuda = document.getElementById('deuda').value;
  var deudatotal = document.getElementById('totaldeuda').value;
  var restadeuda = parseInt(deudatotal) - parseInt(precio);

  document.getElementById("totaldeuda").value = restadeuda;
  document.getElementById("deuda").value = restadeuda;

  //resta en conceptos
  var a = parseInt(document.getElementById("total").value);
  var b = a - parseInt(precio);

  document.getElementById("total").value = b;
  $(obj).closest('tr').remove();

}
function addDeuda() {
    
    
    var cuenta = document.getElementById('cuenta').value;

    var deuda = document.getElementById('deuda').value;
    var deudatotal = document.getElementById('totaldeuda').value;
    var restadeuda = parseInt(deudatotal) - parseInt(cuenta);

    document.getElementById("totaldeuda").value = restadeuda;
    

    /*var hidden2 = "hidden";
    var deudaV = "deuda[]";
    var cuentaV = "cuenta[]";
    var click2 = "$(this).closest('tr').remove();";

    $("#tabla2").append("<tr><td>"+deuda+"</td><input type="+hidden2+" name="+deudaV+" value="+deuda+"><td>"+cuenta+"</td><td><button onclick="+click2+">Eliminar</button></td><input type="+hidden2+" name="+cuentaV+" value="+cuenta+"></tr>");
    

    /*var xx = document.getElementById("tabla2").rows.length;
    var aa = parseInt(document.getElementById("totaldeuda").value);
    var bb = aa + parseInt(cuenta);
    document.getElementById("totaldeuda").value = bb;
    console.log(bb);*/

}
function funcionEliminarcuenta(obj,x)
{
  //console.log(obj->precio);
  var id = x;
  var precio = parseInt(document.getElementById(id).value);
  var a = parseInt(document.getElementById("totaldeuda").value);
    var b = a - parseInt(precio);
    document.getElementById("totaldeuda").value = b;
  $(obj).closest('tr').remove();

}
function guardar()
{
  document.getElementById("formulario").submit();
}