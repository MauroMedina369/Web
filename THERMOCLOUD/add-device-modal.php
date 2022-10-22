    <div class="row">        
        <!-- ADD DEVICE MODAL content -->
        <div id="add-modal" class="modal fullscreen-modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="height:100%">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="text-center mt-2 mb-4">
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <i class="fas fa-arrow-left"></i>
                                                    </button>
                                                        <a class="text-dark">
                                                            <span><img class="mr-2" src="assets/images/favicon.ico"
                                                                    alt="" height="18"><label>Agregar wisee</label></span>
                                                        </a>
                                                    </div>
    
                                                    <div  class="pl-3 pr-3">    
                                                        <div class="form-group">
                                                            <label for="emailaddress1">ID de wisee</label>
                                                            <input class="form-control" type="text" name="DeviceID" id="adddevicetxt"
                                                                required="" placeholder="Ingresá el wisee ID">
                                                                <p type="button" class="btn btn-link" href="#wiseeid-modal" data-toggle="modal" data-target="#wiseeid-modal" ><i class="fa fa-question-circle" aria-hidden="true"></i>¿Dónde encuentro el ID de equipo?</p>
                                                            <p for="emailaddress1" style="margin-top:30px">Nombre del dispositivo</p>
                                                            <input class="form-control" type="text" name="DeviceName" id="devicenametxt"
                                                                required="" placeholder="Ingresá un nombre de equipo">                                                                
                                                                <p for="emailaddress1" style="margin-top:30px">Descripción</p>
                                                            <input class="form-control" type="text" name="Description" id="descriptiontxt2"
                                                                required="" placeholder="Ingresá una descripción">    
                                                                <p for="emailaddress1" style="margin-top:30px">Ubicación</p>
                                                            <input class="form-control" type="text" name="Description" id="locationtxt"
                                                                required="" placeholder="Ingresá una ubicación">                                                                                                                              
                                                                <!-- <div class="form-group mb-4" style="margin-top:30px">
                                                                    <p class="mr-sm-2" for="inlineFormCustomSelect">Modelo</p>
                                                                    <select class="custom-select mr-sm-2" id="modeltxt">
                                                                        <option value="WDS18"> WDS18</option>
                                                                        <option value="WHT22">WHT22</option>
                                                                        <option value="GAS">GAS</option>
                                                                        <option value="AIR2">AIR2</option>
                                                                        <option value="PIXIRELAY">Pixirelay</option>
                                                                        <option value="PIXIGROW">PIXIGROW</option>
                                                                    </select>
                                                                </div> -->
                                                        </div>
                                                        <div class="form-group text-center">
                                                        <button class="btn btn-rounded btn-secondary pull-left" type="submit"  data-dismiss="modal" aria-label="Close">Volver</button>                                                            
                                                            <button class="btn btn-rounded btn-success" type="submit" onclick="AddDeviceClick()">Agregar</button>
                                                        </div>    
                                                    </div>
    
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="wiseeid-modal" class="modal fullscreen-modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="height:100%">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3> ID de equipo</h3>
                    </div>                    
                    <div class="modal-body">
                        <a>
                            Para obtener el ID del equipo, ingresá a la webapp local colocando la IP del dispositivo. Luego andá a Configuración, como se muestra en la siguiente imagen:
                        </a>
                        <br>
                        <img src="assets/images/WiseeID.png" style="width:100%;margin-top:30px">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-rounded btn-secondary pull-left" type="submit"  data-dismiss="modal" aria-label="Close">Volver</button>                                                            
                    </div>                        
                </div>
            </div>
        <div>
        <div class="row">
    

    <!-- CENTRO DE ALERTAS  -->
    <div  id="alert-center" class="modal fullscreen-modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="height:100%">
                        <!-- Content Row -->
                        <div class="modal-dialog modal-dialog-scrollable" >
                            <!-- CENTRO DE ALERTAS  -->
                            <div class="modal-content">   
                                <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <i class="fas fa-arrow-left"></i>
                                                </button>
                                                    <a class="text-dark">
                                                        <span><img class="mr-2" src="assets/images/favicon.ico"
                                                                alt="" height="18"><label class="form-group">Centro de Alarmas</label></span>
                                                    </a>
                                                </div>                                           
                                    <!-- Card Body -->
                                    <div class="list-style-none">
                                        <div class="message-center notifications position-relative">
                                            <!-- Dropdown - Alerts -->
                                            <div id="listadoalertstxt2" class="message-center notifications position-relative" aria-labelledby="alertsDropdown">                                                   
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>     

</div>
        </div>
        <script>
            function AddDeviceClick(){
                var deviceID=document.getElementById('adddevicetxt').value;
                var desc=document.getElementById('descriptiontxt2').value;
                var name=document.getElementById('devicenametxt').value;
                var location=document.getElementById('locationtxt').value;
                var model=document.getElementById('modeltxt').value;                

                    if (deviceID != ""){
                        var AddDevices = function () {
                            //var p = md5(password);
                            var retorno = $.getJSON("add-device.php", {                         
                                DeviceID: deviceID,
                                Description: desc,
                                Location:location,
                                Model: model,
                                DeviceName: name
                            });
                            return retorno ;
                        };

                        AddDevices().done(function (response) {
                            document.getElementById('adddevicetxt').value="";
                            var datos = response;
                            if (datos =="OK"){
                                swal("Se agregó el dispositivo correctamente")
                                    .then((value) => {
                                        $('#add-modal').modal('hide'); 
                                        var dev = "SelectDevice('"+deviceID+"')" ;
                                        GetDevices();
                                        window.location.href = "dashboard.php";
                                    });                                

                            } 
                             if (datos =="EXIST"){ 
                                swal("El dispositivo ya se encuentra registrado. Intente nuevamente.");
                            }

                            if (datos =="INVALID"){ 
                                swal("El ID de dispositivo no es válido o aún no ha registrado datos en la plataforma. Aguarde 5 minutos y vuelva a intentarlo.");
                            }                            
                        
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            swal("Algun error al agregar el dispositivo " +textStatus);
                        });   
                    }
            }        
        </script>
