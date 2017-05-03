  <div class="panel-header">
      <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
              <span>PANEL PRINCIPAL DE ADMINISTRACIÓN</span>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="row">
                <div class="user">
                  <div class="col-xs-6">
                    <span>Usuario : <?php echo $_SESSION['webuser_empresa'];?></span>
                  </div>
                  <div class="col-xs-5 pull-right">
                    <button type="button"  onclick="xajax_salir();" class="btn btn-primary btn-block btn-flat">Cerrar Sesión</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div>