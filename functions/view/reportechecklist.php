<?php
  require_once 'menuview.php';

  $menu = new Menu();
  $menu->header('reportechecklist','Generar Reporte Check List Documentos');
  ?>
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Reporte Check List Documentos <small> &nbsp; (*) Campos requeridos</small></h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="formCliente" name="formCliente">
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="combocliente">Cliente (*)</label>
                    <select class="form-control select2" name="combocliente" id="combocliente" style="width: 100%;">
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer" id="divbtnGenerarReporteEstadoCuenta">
            </div>
          </form>

        </div>
        <!-- /.card -->
      </div>
      <!--/.col (left) -->
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

<?php
  $menu->footer();
?>
<script>
  $(document).ready(function () {
    llenarComboCliente();
    cambiarValorCombos();
    // generarReporteEstadoCuentaPension();
  });

  //Función para ver que retorna reporteAJAX
  // var generarReporteEstadoCuentaPension = function () {
  //   $('#btnGenerarReporteEstadoCuenta').click(function () {
  //     $.ajax({
  //       method: "POST",
  //       url: "../process/reporteajax.php",
  //       data: {"accion": $('#combomodulo').val(), "idcliente": $('#combocliente').val()},
  //         success: function (data) {
  //           console.log(data);
  //         }
  //       });
  //   });
  // }

  //Método que detecta cuando se hace un cambio en algún select para asignarle valor a  la etiquete <a> para generar el PDF
  var cambiarValorCombos = function () {
    $('#combocliente').change(function () {
      $('#divbtnGenerarReporteEstadoCuenta').html('<a download="error.pdf" href="../process/reporteajax.php?idcliente='+$('#combocliente').val()+'&accion=reporteDocumentoCliente"><button type="button" id="btnGenerarReporteEstadoCuenta" name="btnGenerarReporteEstadoCuenta" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar Reporte</button></a>');
    });
  }

  var llenarComboCliente = function () {
    $.ajax({
      type: "POST",
      url: "../process/clienteajax.php",
      data: {'accion':'readarray'}, //El idmodulo 1 es de pensiones
      success: function(data) {
        data = JSON.parse(data);
        $.each(data, function (i, row) {
          $('#combocliente').append("<option value='" + data[i]['id_cliente'] + "'>"+ data[i]['nombre_cliente'] +" " +data[i]['ap_pat'] + " " + data[i]['ap_mat']  +"</option>");
        });
        //Se ejecuta este código después de cada Ajax ya que si se pone sólo manda null, porque aún no se ha cargado el select
        $('#divbtnGenerarReporteEstadoCuenta').html('<a download="error.pdf" href="../process/reporteajax.php?idcliente='+$('#combocliente option:selected').val()+'&accion=reporteDocumentoCliente"><button type="button" id="btnGenerarReporteEstadoCuenta" name="btnGenerarReporteEstadoCuenta" class="btn btn-primary"><i class="far fa-file-pdf"></i> Generar Reporte</button></a>');

      }
    });
  }
</script>
