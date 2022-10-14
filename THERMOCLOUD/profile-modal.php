
    <div class="row">        
        <!-- PROFILE MODAL content -->
        <div id="Profile-Modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="text-center mt-2 mb-4">
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                        <a class="text-dark">
                                                            <span><img class="mr-2" src="assets/images/logo-icon.png"
                                                                    alt="" height="18"><label>Perfil de Usuario</label></span>
                                                        </a>
                                                    </div>
    
                                                    <div  class="pl-3 pr-3">   
                                                        <div class="form-group">                                                           
                                                            <label for="emailaddress1" style="margin-top:0px">Nombre</label>
                                                            <input class="form-control" type="text" name="Description" id="nombretxt"
                                                                required="" placeholder="Ingresá tu nombre">                                                                
                                                        </div>
                                                        <hr>                                                        
                                                        <div class="form-group">                                                           
                                                            <label for="emailaddress1" style="margin-top:0px">Apellido</label>
                                                            <input class="form-control" type="text" name="Description" id="apellidotxt"
                                                                required="" placeholder="Ingresá tu apellido">                                                                
                                                        </div>
                                                        <hr>                                                         
                                                        <div class="form-group">                                                           
                                                            <label for="emailaddress1" style="margin-top:0px">Email</label>
                                                            <input class="form-control" type="text" name="Description" id="emailtxt"
                                                                required="" placeholder="Ingresá tu dirección de email">                                                                
                                                        </div>
                                                        <hr>
                                                        <div class="form-group ">                                                           
                                                            <!-- <label for="emailaddress1" style="margin-top:30px">Password</label> -->
                                                            <button class="btn btn-rounded btn-secondary" href="#Password-Modal" data-target="#Password-Modal" data-toggle="modal" aria-expanded="false"> Modificar Password</button>                                                               
                                                        </div>
                                                        <hr>                                                        
                                                        <div class="form-group text-center">
                                                            <button class="btn btn-rounded btn-secondary pull-left" type="submit"  data-dismiss="modal" aria-label="Close">Volver</button>                                                            
                                                            <button class="btn btn-rounded btn-success" type="submit" onclick="ModifyProfileClick()">Modificar</button>
                                                        </div>    
                                                    </div>
    
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>

    <div id="Password-Modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="text-center mt-2 mb-4">
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                        <a class="text-dark">
                                                            <span><img class="mr-2" src="assets/images/logo-icon.png"
                                                                    alt="" height="18"><label>Modificar Contraseña</label></span>
                                                        </a>
                                                    </div>
    
                                                    <div  class="pl-3 pr-3">    
                                                        <div class="form-group">                                                           
                                                            <label for="password" style="margin-top:10px">Contraseña actual</label>
                                                            <input class="form-control" type="password" name="pass1" id="pass1"
                                                                required="" placeholder="Ingresá la contraseña actual" value="">                                                                
                                                        </div>
                                                        <div class="form-group">                                                           
                                                            <label for="password" style="margin-top:10px">Nueva Contraseña</label>
                                                            <input class="form-control" type="password" name="pass2" id="pass2"
                                                                required="" placeholder="Ingresá la nueva contraseña">                                                                
                                                        </div>      
                                                        <div class="form-group">                                                           
                                                            <label for="password" style="margin-top:10px">Otra vez...</label>
                                                            <input class="form-control" type="password" name="pass3" id="pass3"
                                                                required="" placeholder="Ingresá la contraseña nuevamente">                                                                
                                                        </div>
                                                        <hr>                                                                                                            
                                                        <div class="form-group text-center">
                                                            <button class="btn btn-rounded btn-secondary pull-left" type="submit"  data-dismiss="modal" aria-label="Close">Volver</button>                                                            
                                                            <button class="btn btn-rounded btn-success" type="submit" onclick="ModifyPassClick()">Modificar</button>
                                                        </div>    
                                                    </div>
    
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

        <script>

            
            function ModifyProfileClick(){
                //  document.getElementById('devtxt').innerHTML = ;

                if (userList.responseText == undefined) {
                    var datos= userList;   
                } else {
                  var datos = JSON.parse(userList.responseText);
                }        
                datos[0].Name= document.getElementById('nombretxt').value;     
                datos[0].LastName= document.getElementById('apellidotxt').value;     
                datos[0].Email= document.getElementById('emailtxt').value;     
                datos[0].Password= userList.Password;     

                var myJSON = JSON.stringify(datos[0]);       
                    if (datos.Name != ""){
                        var ModifyUser = function () {
                            var retorno = $.getJSON("modify-profile.php", {                         
                                DeviceID: deviceID,
                                Datos: myJSON
                            });
                            return retorno ;
                        };

                        ModifyUser().done(function (response) {
                            // document.getElementById('adddevicetxt').value="";
                             var datos = response;
                             if (datos =="OK") {
                                 swal('',"Se actualizaron los datos correctamente",'success');
                                 $('#Profile-Modal').modal('hide'); //esconde devicelist modal
                             }
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            swal("Algun error al agregar el dispositivo " +textStatus);
                        });   
                    }
            }        

            function ModifyPassClick(){
                var pass1=  document.getElementById('pass1').value;
                var pass2=  document.getElementById('pass2').value;
                var pass3=  document.getElementById('pass3').value;
                // if (userList.responseText == undefined) {
                     var pwd= userList[0].Password;   
                // } else {
                //     var datos = JSON.parse(userList.responseText);
                //     var pwd = datos[1].Password;
                // }                    
                if (md5(pass1) == pwd) {
                    if (pass2 == pass3) {
                        var pass= md5(pass2);
                        var ModifyPass = function () {
                                var retorno = $.getJSON("modify-password.php", {                         
                                    Password: pass,
                                });
                                return retorno ;
                            };

                            ModifyPass().done(function (response) {
                                // document.getElementById('adddevicetxt').value="";
                                var datos = response;
                                if (datos =="OK") {
                                    swal('', "Se actualizó la contraseña correctamente",'success');
                                    userList[0].Password=md5(pass2);                                   
                                    $('#Password-Modal').modal('hide');
                                    $('#Profile-Modal').modal('hide');
                                }
                            }).fail(function (jqXHR, textStatus, errorThrown) {
                                swal("Algun error al cambiar la contraseña " +textStatus);
                            });   
                    } else {
                        swal ("Las contraseñas no coinciden, intente nuevamente");
                    }                    
                } else {
                    alert ("La contraseña actual no coincide. Intente nuevamente");
                }
                document.getElementById('pass3').value="";
                document.getElementById('pass2').value="";
                document.getElementById('pass1').value ="";                        

            }                
        </script>
