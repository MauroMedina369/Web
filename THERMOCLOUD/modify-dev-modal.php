<html>
    <div class="row">        
        <!-- MODIFY DEVICE MODAL content -->
        <div id="modify-dev-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="text-center mt-2 mb-4">
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <i class="fas fa-arrow-left"></i>
                                                    </button>
                                                        <a class="text-dark">
                                                            <span><img class="mr-2" src="assets/images/favicon.ico"
                                                                    alt="" height="18"><label>Modificar Dispositivo</label></span>
                                                        </a>
                                                    </div>
    
                                                    <div  class="pl-3 pr-3">    
                                                        <div class="form-group">
                                                            <div>
                                                                <label for="emailaddress1" id="devtxt">ID de Dispositivo</label>
                                                            </div>
                                                            <label for="" style="margin-top:10px">Nombre de Dispositivo</label>
                                                            <input class="form-control" type="text" name="Description" id="devnametxt"
                                                                required="" placeholder="Ingresá un nombre para el dispositivo">                                                               
                                                            <label for="emailaddress1" style="margin-top:10px">Descripción</label>
                                                            <input class="form-control" type="text" name="Description" id="descriptiontxt" placeholder="Ingresá una descripción">                                                                
                                                            <label for="emailaddress1" style="margin-top:10px">Ubicacion</label>
                                                            <input class="form-control" type="text" name="Description" id="locationtxt2" placeholder="Ingresá una ubicación">                                                                                                                            
                                                        </div>
                                                        <hr>
                            <!-- Card Body -->
                                <div class="" id="TempLimitsConfig">   
                                    <h3 id="tituloLimits">  </h3>
                                    <div class="row">                           
                                        <div class="col-md-12">
                                            <p> Límite inferior</p>                                      
                                            <input type="range"  id="tempmin" name="vol2" min="-20" max="150"  oninput="this.nextElementSibling.value = this.value" style="width:80%">
                                            <output style="font-size:x-large"  id="tempmintxt" >24</output>
                                        </div>
                                        <div class="col-md-12">
                                            <p> Límite superior</p>
                                            <input type="range" id="tempmax" name="vol2" min="-20" max="150"  oninput="this.nextElementSibling.value = this.value" style="width:80%">
                                            <output style="font-size:x-large" id="tempmaxtxt" >24</output>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div id="HRLimitsConfig">
                                    <h3> Humedad </h3>
                                    <div class="row" style="margin-top:20px">
                                        <div class="col-md-12">
                                                    <p> Límite inferior</p>
                                                    <input type="range" id="hrmin" name="vol2" min="0" max="100"  oninput="this.nextElementSibling.value = this.value" style="width:80%">
                                                    <output style="font-size:x-large" id="hrmintxt">24</output>

                                        </div>
                                        <div class="col-md-12">                                        
                                                    <p> Límite superior</p>
                                                    <input type="range" id="hrmax" name="vol2" min="0" max="100"  oninput="this.nextElementSibling.value = this.value" style="width:80%">
                                                    <output style="font-size:x-large" id="hrmaxtxt">24</output>

                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row" id="PPMLimitsConfig">                                    
                                    <div class="col-md-12">
                                                <p> Límite superior (en PPM)</p>
                                                <input type="range" id="ppmmax" name="vol2" min="400" max="3000"  oninput="this.nextElementSibling.value = this.value" style="width:80%">
                                                <output style="font-size:x-large" id="ppmmaxtxt" >800</output>
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <h3>Enviar Notificaciones</h3>                                                
                                    <label class="switch pull-right" style="margin-top:10px">
                                    Activa o desactiva el envío de alertas al mail
                                                <input type="checkbox" value="enabledAlerts" name="enabledAlertschk" id="enabledAlertschk">
                                                <span></span>
                                                <!-- <p><small> (*) No disponible aún </small></p> -->
                                     </label>                                       
                                </div>
                                <hr>                                                         
                                                    
                                                        <div class="form-group text-center">
                                                        <button class="btn btn-rounded btn-secondary pull-left" type="submit"  data-dismiss="modal" aria-label="Close">Volver</button>                                                            
                                                            <button class="btn btn-rounded btn-success" type="submit" onclick="ModifyDevClick()">Modificar</button>
                                                        </div>    
                            </div>
    
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        </div>


</html>