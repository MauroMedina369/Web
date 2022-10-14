<html>
        <!-- MODIFICA ALERTAS  -->
        <div class="row">
        <div class="modal fade" role="dialog" id="modify-alert-modal" aria-hidden="true">
                <!-- Content Row -->
                <div class="modal-dialog" >
                    <!-- CENTRO DE ALERTAS  -->
                    <div class="modal-content">     
                                       
                        <div class="modal-body ">    
                        <div class="text-center mt-2 mb-4">
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <i class="fas fa-arrow-left"></i>
                                                    </button>
                                                        <a class="text-dark">
                                                            <span><img class="mr-2" src="assets/images/logo-icon.png"
                                                                    alt="" height="18"><label class="form-group">Modificar Alertas</label></span>
                                                        </a>
                                                    </div>                                                       
                            <!-- Card Body -->
                            <div class="card-body">
                                <h3> Temperatura </h3>
                                <div class="col-md-12">                                    
                                    <div class="row">
                                        <p> Límite inferior</p>                                      
                                        <input type="range"  id="tempmin" name="vol2" min="-20" max="100"  oninput="this.nextElementSibling.value = this.value" style="width:80%">
                                        <output style="font-size:x-large"  id="tempmintxt" >24</output>
                                    </div>
                                    <div class="row">
                                                <p> Límite superior</p>
                                                <input type="range" id="tempmax" name="vol2" min="-20" max="100"  oninput="this.nextElementSibling.value = this.value" style="width:80%">
                                                <output style="font-size:x-large" id="tempmaxtxt" >24</output>
                                    </div>
                                </div>
                                <hr>
                                <h3> Humedad </h3>
                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-12">
                                                <p> Límite inferior</p>
                                                <input type="range" id="hrmin" name="vol2" min="-20" max="100"  oninput="this.nextElementSibling.value = this.value" style="width:80%">
                                                <output style="font-size:x-large" id="hrmintxt">24</output>

                                    </div>
                                    <div class="col-md-12">                                        
                                                <p> Límite superior</p>
                                                <input type="range" id="hrmax" name="vol2" min="-20" max="100"  oninput="this.nextElementSibling.value = this.value" style="width:80%">
                                                <output style="font-size:x-large" id="hrmaxtxt">24</output>

                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <h3>Enviar Notificaciones</h3>                                                
                                    <label class="switch pull-right" style="margin-top:10px">
                                    Activa o desactiva el envío de alertas al celular
                                                <input type="checkbox" id="enabledAlertschk">
                                                <span></span>
                                     </label>                                       
                                </div>
                                <hr>                                                         
                                <div class="form-group text-center">
                                    <button class="btn btn-rounded btn-secondary pull-left" type="submit"  data-dismiss="modal" aria-label="Close">Volver</button>
                                    <button class="btn btn-rounded btn-cyan " type="submit" onclick="ModifyAlertsClick()">Modificar</button>
                                </div>                                                                    
                            </div>
                        </div>
                    </div>
                </div>   
        </div>
        </div>

        <script>
            function ModifyAlertsClick(){
                //  document.getElementById('devtxt').innerHTML = ;
                if (deviceList.responseText == undefined) {
                    var datos= deviceList;   
                } else {
                  var datos = JSON.parse(deviceList.responseText);
                }         
                datos[deviceListNumber].TempLimitMayor=document.getElementById("tempmax").value;
                datos[deviceListNumber].TempLimitMayor=document.getElementById("tempmax").value;
                datos[deviceListNumber].TempLimitMenor=document.getElementById("tempmin").value;
                datos[deviceListNumber].HRLimitMayor=document.getElementById("hrmax").value;
                datos[deviceListNumber].HRLimitMenor=document.getElementById("hrmin").value;                                
                if (document.getElementById("enabledAlertschk").checked == true) datos[deviceListNumber].EnabledAlerts="1";
                else datos[deviceListNumber].EnabledAlerts="0";

                var myJSON = JSON.stringify(datos[deviceListNumber])
                // var desc=document.getElementById('desctxt').value;                        
                    if (deviceID != ""){
                        var ModifyAlert = function () {
                            var retorno = $.getJSON("modify-alerts.php", {                         
                                DeviceID: deviceID,
                                Datos: myJSON
                            });
                            return retorno ;
                        };

                        ModifyAlert().done(function (response) {
                            // document.getElementById('adddevicetxt').value="";
                             var datos = response;
                             if (datos =="OK") {
                                swal("","Se actualizaron los datos correctamente", 'success');
                             }
                            
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            swal("Algun error al modificar el dispositivo " +textStatus);
                        });   
                    }
            }        
        </script>        
</html>