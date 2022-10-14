//Library Wisee v1 asd
var deviceID;
var deviceName;
var deviceList;
var deviceListNumber = 1;
var userList;
var alertList;
var start = 0;
var myChart = "a";
var historicdata;
var tempold = 0; //se utiliza para que sólo actualize el gauge si es distinto al anterior
var HRold = 0; //se utiliza para que sólo actualize el gauge si es distinto al anterior
var canvas = document.getElementById('canvas');
var fechaMin = convertFecha2(new Date());
var fechaMax = convertFecha2(new Date());
var alertasMostradas = false;
var fechaHoraSelector = 0;
var MODEL;
document.getElementById('graphicDate1').value = convertFecha(new Date());
document.getElementById('graphicDate2').value = convertFecha(new Date());

var fm3 = new FluidMeter();
fm3.init({
    targetContainer: document.getElementById("fluid-meter-3"),
    fillPercentage: 45,
    options: {
        fontSize: "30px",
        drawPercentageSign: true,
        drawBubbles: false,
        size: 200,
        borderWidth: 19,
        backgroundColor: "#e2e2e2",
        foregroundColor: "#fafafa",
        foregroundFluidLayer: {
            fillStyle: "#16E1FF",
            angularSpeed: 30,
            maxAmplitude: 5,
            frequency: 30,
            horizontalSpeed: -20
        },
        backgroundFluidLayer: {
            fillStyle: "#4F8FC6",
            angularSpeed: 100,
            maxAmplitude: 3,
            frequency: 22,
            horizontalSpeed: 20
        }
    }
});


$(document).ready(function() {
    //$('#asistente1').modal('show');      
    GetDevices();
    GetUsers();
    GetAlarms(0);
});


setInterval(function() {
    GetDevices();
    GetDataGraphic();
    //FillDevices(deviceList);
    //   GetAlerts();
}, 120000); // REFRESCA DATOS 

setInterval(function() {
    location.reload();
}, 600000); // REFRESCA Pagina cada 10 minutos 

///////////////////////////////////////////////////////////////////////
var GetAlarms = function(visto) {
    //var p = md5(password);
    var retorno = $.getJSON("get-alarms.php", {
        Visto: visto
    });
    return retorno;
};

GetAlarms().done(function(response) {
    //  ahoraOBJ = parseJSON(response.datos);
    //var datos=JSON.parse(response.responseText);
    var out = response;
    alertList = out;
    FillAlarms(out);
    return out;
}).fail(function(jqXHR, textStatus, errorThrown) {
    swal("Ups!", "Algun error obteniendo los dispositivos " + textStatus);
});

/////////////////////////////////////////////////////////////////////
function FillAlarms(ul) {

    var a = 0;
    var htmlstr = "";
    var htmlstr2 = "";
    var b = 1;
    var count = 0;

    while (ul[a] != undefined) {
        if (ul[a].Type == "MaxGas") $Type = "Aire contaminado";
        if (ul[a].Type == "MaxTemp") $Type = "Exceso de temperatura";
        if (ul[a].Type == "MinTemp") $Type = "Temperatura baja";
        if (ul[a].Type == "MaxHR") $Type = "Exceso de humedad";
        if (ul[a].Type == "MinHR") $Type = "Humedad baja";
        if (ul[a].Type == "MinSoil") $Type = "Tierra seca";
        var Hora = ul[a].Hora;
        var Fecha = MuestraFechaSTR(ul[a].Fecha) + " a las " + MuestraHoraSTR(Hora);
        var Titulo = "Alarma de " + ul[a].DeviceID + " | " + $Type;
        var Mensaje = "Valor: " + ul[a].Value;
        if (ul[a].Viewed == '0') {
            htmlstr = htmlstr + '<a class="message-item d-flex align-items-center border-bottom px-3 py-3 "  ><div class="btn btn-danger rounded-circle btn-circle" style="max-width:50px;max-height:50px"><i  class=" fas fa-exclamation text-white"></i></div><div class="w-75 d-inline-block v-middle pl-2">        <h6 class="message-title mb-0 mt-1">' + Titulo + '</h6>        <span class="font-12 text-nowrap d-block text-muted">' + Mensaje + '</span><span class="font-12 text-nowrap d-block text-muted">' + Fecha + ' </span></div></a>';
            count++;
        }
        htmlstr2 = htmlstr2 + '<a  class="message-item d-flex align-items-center border-bottom " ><div class="btn btn-danger rounded-circle btn-circle"><i  class=" fas fa-exclamation text-white"></i></div><div class="w-75 d-inline-block v-middle pl-2">        <h6 class="message-title mb-0 mt-1">' + Titulo + '</h6>        <span class="font-12 text-nowrap d-block text-muted">' + Mensaje + '</span><span class="font-12 text-nowrap d-block text-muted">' + Fecha + ' </span></div></a>';
        a++;
    }

    document.getElementById('listadoalertstxt2').innerHTML = htmlstr2; //Centro de alertas
    if (count >= 1) {
        document.getElementById('listadoalertstxt').innerHTML = htmlstr; //Alertas barra superior        
        document.getElementById('cantalertstxt').innerText = count;
    } else {
        document.getElementById('cantalertstxt').style.opacity = 0;
    }

}

/////////////////////////////////////////////////////////////////////////
var GetUsers = function() {
    //var p = md5(password);
    var retorno = $.getJSON("get-users.php", {
        // Email: uname,
        // Password: pwd,
    });
    return retorno;
};

GetUsers().done(function(response) {
    //  ahoraOBJ = parseJSON(response.datos);
    //var datos=JSON.parse(response.responseText);
    userList = response;
    FillUsers(userList);
    return userList;
}).fail(function(jqXHR, textStatus, errorThrown) {
    // swal("Ups!","Algun error obteniendo los dispositivos " +textStatus);
});

/////////////////////////////////////////////////////////////////////
function FillUsers(ul) {
    document.getElementById('emailtxt').value = ul[0].Email;
    document.getElementById('nametxt').innerHTML = ul[0].Name;
    document.getElementById('nombretxt').value = ul[0].Name;
    document.getElementById('apellidotxt').value = ul[0].LastName;
    document.getElementById('pass1').value = "";
}

/////////////////////////////////////////////////////////////////////////
var GetDevices = function() {
        //var p = md5(password);

        var GetDevices = function() {
            return $.getJSON("get-devices.php", {});
        };

        GetDevices()
            .done(function(response) {
                //  ahoraOBJ = parseJSON(response.datos);
                //var datos=JSON.parse(response.responseText);
                var out = response;
                deviceList = response;
                FillDevices(deviceList);
                GetDataGraphic();
                return out;
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                // swal("Ups!","Algun error obteniendo los dispositivos " +textStatus);
            });


    }
    /////////////////////////////////////////////////////////////////////////
function GetDataGraphic() {

    var GetHistorialDev = function() {
        //var p = md5(password);
        var retorno = $.getJSON("get-graphicdata.php", {
            DeviceID: deviceID,
            DateMin: fechaMin,
            DateMax: fechaMax,
        });
        return retorno;
    };

    GetHistorialDev().done(function(response) {
        historicdata = response;
        if (response == "TIMEOUT") { $('#login-modal').modal('show'); return; }
        ShowGraphic(historicdata);
        return response;
    }).fail(function(jqXHR, textStatus, errorThrown) {

        //swal("Ups!","Algun error obteniendo los dispositivos " +textStatus);
    });


}

/////////////////////////////////////////////////////
function FillDevices(datos) { //Rellena lista de dispositivos

    var indice = 0;
    var htmlstr = ''; //'<h4 class="text-left text-dark" style="margin-top:0px;margin-left:20px"> Seleccioná tu wisee</h4>';
    var htmlstr3 = '';
    var CardDeviceList = '';
    var alerthtml = '';
    var online = 0;
    var offline = 0;
    var fueravalor = 0;
    var total = 0;
    var htmlstr2 = '<h4 class="text-left text-dark" style="margin-top:20px;margin-left:20px"> Seleccioná tu wisee</h4>';
    for (indice = 0; indice <= (objlen(datos) - 1); indice++) { //Rellena lista de dispositivos   
        //swal("MSG:" + datos[a].DeviceID + "   ");
        var onclick = "SelectDevice(" + indice + ")";
        var color = "danger";
        total++;
        var temp = datos[indice].CurrentTemp;
        var HR = parseInt(datos[indice].CurrentHR);
        var deviceID = datos[indice].DeviceID;
        var DeviceName = datos[indice].DeviceName;
        MODEL = datos[indice].Model;
        var LastUpdateFecha = datos[indice].LastUpdateFecha;
        var LastUpdateHora = datos[indice].LastUpdateHora;
        var LastRead = "Actualizado: " + MuestraFechaSTR(LastUpdateFecha) + ' | ' + MuestraHoraSTR(LastUpdateHora);
        var colorState = "danger";
        if (datos[indice].State == "1") {
            colorState = "success";
            online++;
        } else {
            offline++;
        }
        var colorTemp = datos[indice].ColorTemp;
        var colorHR = datos[indice].ColorHR;
        if ((colorTemp != "success" || colorHR != "success")) {
            fueravalor++;
            alerthtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert" > <a id="alerttxt"> <strong><i class="fa fa-exclamation-triangle"></i></strong> ' + fueravalor + ' equipos requieren atención.</a> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden = "true"> X </span> </button> </div>';
        }

        //CardDeviceList = " <div class=\"card border-{colorstate} \" onclick=\"{OnClick}\" style=\"max-width: 18rem;max-height:17rem;border-width:2px ;border-radius:10px;margin: 10px 10px 10px 0px\"> <div class=\"card-header \"><label class=\"text-left\">{DeviceName}</label></div><div class=\"card-body text-dark\"> <h3><span class=\"badge-pill badge-{colortemp}\"> <i class=\"fa fa-thermometer-empty\"></i>{Temp}<small> °C </small></span></h3></a> </td><td class=\"font-weight-medium px-2 py-4\"><a style=\"font-size:25px\"> <h3><span class=\"badge-pill badge-{colorhum}\"> <i class=\"fa fa-tint\"></i>{Hum}<small> % </small></span></h3> <hr> <h5 class=\"text-secondary\" style=\"font-size:16px\"><i class=\"fa fa-bars\"></i>{Description}</h5> <h5 class=\"text-secondary\" style=\"font-size:16px\"><i class=\"fa fa-location-arrow\"></i>{Location}</h5> <p class=\"text-muted\" style=\"font-size:16px\"><small>{LastRead}</small></p></div></div>";
        if (MODEL == "WHT22") {
            //CardDeviceList = CardDeviceList + '<div class="card2 border-' + colorState + ' \" onclick=' + onclick + ' style=\"border-left:5px solid ;border-radius:10px;margin: 10px 10px 10px 0px\"> <div class=\"card-header \" style="height:70px"><label class=\"text-left\" style="font-size:20px"> ' + DeviceName + '</label><p style="font-size:16px;margin-top:-10px"> <small> ID #' + deviceID + '</small></p></div><div class=\"card-body text-dark\"> <h3><span class=\"badge-pill badge-' + colorTemp + '\"> <i class=\"fa fa-thermometer-empty\"></i> ' + temp + '<small> °C </small></span></h3><h3><span class=\"badge-pill badge-' + colorHR + '\"> <i class=\"fa fa-tint\"></i> ' + HR + '<small> % </small></span></h3> <hr> <h5 class=\"text-secondary text-left\" style=\"font-size:16px\"><i class=\"fa fa-bars\"></i> ' + datos[indice].Description + '</h5>  <p class=\"text-muted text-left\" style=\"font-size:14px\"><small> ' + LastRead + '</small></p></div></div>';
            CardDeviceList = CardDeviceList + '<div class="card2 border-' + colorState + ' \" onclick=' + onclick + ' style=\"border-left:5px solid ;border-radius:10px;margin: 10px 10px 10px 0px;height:200px\"> <div class=\"card-header \" style="height:70px"><label class=\"text-left\" style="font-size:20px">  ' + DeviceName + '</label><p style="font-size:16px;margin-top:-10px"> <small> ID #' + deviceID + '</small></p></div><div class=\"card-body text-dark\"> <h3><span class=\"badge-pill badge-' + colorTemp + '\"> <i class=\"fa fa-thermometer-empty\"></i> ' + temp + '<small> °C </small></span></h3><h3><span class=\"badge-pill badge-' + colorHR + '\"> <i class=\"fa fa-tint\"></i> ' + HR + '<small> % </small></span></h3> <hr> <p class=\"text-muted text-left\" style=\"font-size:14px;margin-top:-15px\"><small> ' + LastRead + '</small></p></div></div>';
            htmlstr = htmlstr + '<table style="width:100%" class="clase2"> <tr style="width:100%" class="border-bottom border-top border-left" > <td style="width:90%"> <a class="clase1   align-items-center px-3 py-2" onclick=' + onclick + '  > <i  class="fas fa-wifi text-' + colorState + ' " style="margin-top:15px;margin-left:-10px;font-size:x-small;position:absolute"></i> <div class="w-75 d-inline-block v-middle pl-2"> <h6 class="message-title mb-0 mt-1">' + datos[indice].DeviceName + ' | ' + datos[indice].Description + ' </h6> <span class="font-12 text-nowrap d-block "> ID #' + datos[indice].DeviceID + '</span>  </div> </a> </td> <td style="width:20%;min-width:70px" class="border-left text-center"><i  class="fas fa-thermometer-half text-' + colorTemp + ' "></i> ' + temp + '°C </td> <td style="width:20%;min-width:70px" class="border-left text-center border-right"><i  class="fas fa-tint text-' + colorHR + '"></i>  ' + HR + '%   </td>   </tr>  </table>';
            htmlstr3 = htmlstr3 + '<tr onclick=' + onclick + ' style="pointer:cursor" href="#"> <td class=" px-2 py-4"> <div class="d-flex no-block align-items-center"> <div class="mr-3"> <a class="btn btn-secondary rounded-circle btn-circle font-10"> <label style="color:white;margin-left:-8px">' + MODEL + '</label></a> </div><div class=""> <h5 class="text-dark mb-0 font-16 font-weight-medium">' + DeviceName + '  <small class="text-muted">| ID #' + deviceID + ' </small> </h5> <span class="text-muted font-12">Última lectura: ' + MuestraFechaSTR(LastUpdateFecha) + ' | ' + MuestraHoraSTR(LastUpdateHora) + '</span> </div></div></td><td class=" text-muted px-2 py-4 font-14">' + datos[indice].Description + '</td><td class=" px-2 py-4"> ' + datos[indice].Location + ' </td><td class=" text-center px-2 py-4"><i class="fa fa-wifi text-' + colorState + ' " data-toggle="tooltip" data-placement="top" title="In Testing"></i></td><td class=" text-center font-weight-medium  px-2 py-4"><a style="font-size:25px"> <h3><span class="badge-pill badge-' + colorTemp + '"> <i class="fa fa-thermometer-empty"></i> ' + temp + ' <small> °C  </small></span></h3></a> </td><td class="font-weight-medium px-2 py-4"><a style="font-size:25px"> <h3><span class="badge-pill badge-' + colorHR + '"> <i class="fa fa-tint"></i> ' + HR + ' <small> %  </small></span></h3></a> </td><td> <div class="dropdown sub-dropdown"> <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i> </button> <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1"> <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-edit "></i> Modificar</a> <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-trash "></i> Eliminar</a> </div></div></td></tr>'
        }
        if (MODEL == "PIXIGROW") {
            //CardDeviceList = CardDeviceList + '<div class="card2 border-' + colorState + ' \" onclick=' + onclick + ' style=\"border-left:5px solid ;border-radius:10px;margin: 10px 10px 10px 0px\"> <div class=\"card-header \" style="height:70px"><label class=\"text-left\" style="font-size:20px"> ' + DeviceName + '</label><p style="font-size:16px;margin-top:-10px"> <small> ID #' + deviceID + '</small></p></div><div class=\"card-body text-dark\"> <h3><span class=\"badge-pill badge-' + colorTemp + '\"> <i class=\"fa fa-thermometer-empty\"></i> ' + temp + '<small> °C </small></span></h3><h3><span class=\"badge-pill badge-' + colorHR + '\"> <i class=\"fa fa-tint\"></i> ' + HR + '<small> % </small></span></h3> <hr> <h5 class=\"text-secondary text-left\" style=\"font-size:16px\"><i class=\"fa fa-bars\"></i> ' + datos[indice].Description + '</h5>  <p class=\"text-muted text-left\" style=\"font-size:14px\"><small> ' + LastRead + '</small></p></div></div>';
            CardDeviceList = CardDeviceList + '<div class="card2 border-' + colorState + ' \" onclick=' + onclick + ' style=\"border-left:5px solid ;border-radius:10px;margin: 10px 10px 10px 0px;height:200px\"> <div class=\"card-header \" style="height:70px"><label class=\"text-left\" style="font-size:20px">  ' + DeviceName + '</label><p style="font-size:16px;margin-top:-10px"> <small> ID #' + deviceID + '</small></p></div><div class=\"card-body text-dark\"> <h3><span class=\"badge-pill badge-' + colorTemp + '\"> <i class=\"fa fa-thermometer-empty\"></i> ' + temp + '<small> °C </small></span></h3><h3><span class=\"badge-pill badge-' + colorHR + '\"> <i class=\"fa fa-tint\"></i> ' + HR + '<small> % </small></span></h3> <hr> <p class=\"text-muted text-left\" style=\"font-size:14px;margin-top:-15px\"><small> ' + LastRead + '</small></p></div></div>';
            htmlstr = htmlstr + '<table style="width:100%" class="clase2"> <tr style="width:100%" class="border-bottom border-top border-left" > <td style="width:90%"> <a class="clase1   align-items-center px-3 py-2" onclick=' + onclick + '  > <i  class="fas fa-wifi text-' + colorState + ' " style="margin-top:15px;margin-left:-10px;font-size:x-small;position:absolute"></i> <div class="w-75 d-inline-block v-middle pl-2"> <h6 class="message-title mb-0 mt-1">' + datos[indice].DeviceName + ' | ' + datos[indice].Description + ' </h6> <span class="font-12 text-nowrap d-block "> ID #' + datos[indice].DeviceID + '</span>  </div> </a> </td> <td style="width:20%;min-width:70px" class="border-left text-center"><i  class="fas fa-thermometer-half text-' + colorTemp + ' "></i> ' + temp + '°C </td> <td style="width:20%;min-width:70px" class="border-left text-center border-right"><i  class="fas fa-tint text-' + colorHR + '"></i>  ' + HR + '%   </td>   </tr>  </table>';
            htmlstr3 = htmlstr3 + '<tr onclick=' + onclick + ' style="pointer:cursor" href="#"> <td class=" px-2 py-4"> <div class="d-flex no-block align-items-center"> <div class="mr-3"> <a class="btn btn-secondary rounded-circle btn-circle font-10"> <label style="color:white;margin-left:-8px">' + MODEL + '</label></a> </div><div class=""> <h5 class="text-dark mb-0 font-16 font-weight-medium">' + DeviceName + '  <small class="text-muted">| ID #' + deviceID + ' </small> </h5> <span class="text-muted font-12">Última lectura: ' + MuestraFechaSTR(LastUpdateFecha) + ' | ' + MuestraHoraSTR(LastUpdateHora) + '</span> </div></div></td><td class=" text-muted px-2 py-4 font-14">' + datos[indice].Description + '</td><td class=" px-2 py-4"> ' + datos[indice].Location + ' </td><td class=" text-center px-2 py-4"><i class="fa fa-wifi text-' + colorState + ' " data-toggle="tooltip" data-placement="top" title="In Testing"></i></td><td class=" text-center font-weight-medium  px-2 py-4"><a style="font-size:25px"> <h3><span class="badge-pill badge-' + colorTemp + '"> <i class="fa fa-thermometer-empty"></i> ' + temp + ' <small> °C  </small></span></h3></a> </td><td class="font-weight-medium px-2 py-4"><a style="font-size:25px"> <h3><span class="badge-pill badge-' + colorHR + '"> <i class="fa fa-tint"></i> ' + HR + ' <small> %  </small></span></h3></a> </td><td> <div class="dropdown sub-dropdown"> <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i> </button> <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1"> <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-edit "></i> Modificar</a> <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-trash "></i> Eliminar</a> </div></div></td></tr>'
        }
        if (MODEL == "WDS18") {
            CardDeviceList = CardDeviceList + '<div class="card2 border-' + colorState + ' \" onclick=' + onclick + ' style=\"border-left:5px solid ;border-radius:10px;margin: 10px 10px 10px 0px;height:200px\"> <div class=\"card-header \" style="height:70px"><label class=\"text-left\" style="font-size:20px"> ' + DeviceName + '</label><p style="font-size:16px;margin-top:-10px"> <small> ID #' + deviceID + '</small></p></div><div class=\"card-body text-dark\"> <h3><span class=\"badge-pill badge-' + colorTemp + '\"> <i class=\"fa fa-thermometer-empty\"></i> ' + temp + '<small> °C </small></span></h3> <hr>  <p class=\"text-muted text-left\" style=\"font-size:14px;margin-top:-15px\"><small> ' + LastRead + '</small></p></div></div>';
            htmlstr = htmlstr + '<table style="width:100%" class="clase2"> <tr style="width:100%" class="border-bottom border-top border-left" > <td style="width:90%"> <a class="clase1   align-items-center px-3 py-2" onclick=' + onclick + '  > <i  class="fas fa-wifi text-' + colorState + ' " style="margin-top:15px;margin-left:-10px;font-size:x-small;position:absolute"></i> <div class="w-75 d-inline-block v-middle pl-2"> <h6 class="message-title mb-0 mt-1">' + datos[indice].DeviceName + ' | ' + datos[indice].Description + ' </h6> <span class="font-12 text-nowrap d-block "> ID #' + datos[indice].DeviceID + '</span>  </div> </a> </td> <td style="width:20%;min-width:70px" class="border-left text-center"><i  class="fas fa-thermometer-half text-' + colorTemp + ' "></i> ' + temp + '°C </td> <td style="width:20%;min-width:70px" class="border-left text-center border-right">  </td>   </tr>  </table>';
            htmlstr3 = htmlstr3 + '<tr onclick=' + onclick + ' style="pointer:cursor" href="#"> <td class=" px-2 py-4"> <div class="d-flex no-block align-items-center"> <div class="mr-3"> <a class="btn btn-secondary rounded-circle btn-circle font-10"> <label style="color:white;margin-left:-5px">' + MODEL + '</label></a> </div><div class=""> <h5 class="text-dark mb-0 font-16 font-weight-medium">' + DeviceName + '  <small class="text-muted">| ID #' + deviceID + ' </small> </h5> <span class="text-muted font-12">Última lectura: ' + MuestraFechaSTR(LastUpdateFecha) + ' | ' + MuestraHoraSTR(LastUpdateHora) + '</span> </div></div></td><td class=" text-muted px-2 py-4 font-14">' + datos[indice].Description + '</td><td class=" px-2 py-4"> ' + datos[indice].Location + ' </td><td class=" text-center px-2 py-4"><i class="fa fa-wifi text-' + colorState + ' " data-toggle="tooltip" data-placement="top" title="In Testing"></i></td><td class=" text-center font-weight-medium  px-2 py-4"><a style="font-size:25px"> <h3><span class="badge-pill badge-' + colorTemp + '"> <i class="fa fa-thermometer-empty"></i> ' + temp + ' <small> °C  </small></span></h3></a> </td><td class="font-weight-medium px-2 py-4"><a style="font-size:25px"></a> </td><td> <div class="dropdown sub-dropdown"> <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i> </button> <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1"> <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-edit "></i> Modificar</a> <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-trash "></i> Eliminar</a> </div></div></td></tr>'
        }
        if (MODEL == "GAS") {
            CardDeviceList = CardDeviceList + '<div class="card2 border-' + colorState + ' \" onclick=' + onclick + ' style=\"border-left:5px solid ;border-radius:10px;margin: 10px 10px 10px 0px;height:200px\"> <div class=\"card-header \" style="height:70px"><label class=\"text-left\" style="font-size:20px"> ' + DeviceName + '</label><p style="font-size:16px;margin-top:-10px"> <small> ID #' + deviceID + '</small></p></div><div class=\"card-body text-dark\"> <h3><span class=\"badge-pill badge-' + colorTemp + '\"> <i class=\"fa fa-fire\"></i> ' + temp + '<small> ppm </small></span></h3><hr>  <p class=\"text-muted text-left\" style=\"font-size:14px;margin-top:-15px\"><small> ' + LastRead + '</small></p></div></div>';
            htmlstr = htmlstr + '<table style="width:100%" class="clase2"> <tr style="width:100%" class="border-bottom border-top border-left" > <td style="width:90%"> <a class="clase1   align-items-center px-3 py-2" onclick=' + onclick + '  > <i  class="fas fa-wifi text-' + colorState + ' " style="margin-top:15px;margin-left:-10px;font-size:x-small;position:absolute"></i> <div class="w-75 d-inline-block v-middle pl-2"> <h6 class="message-title mb-0 mt-1">' + datos[indice].DeviceName + ' | ' + datos[indice].Description + ' </h6> <span class="font-12 text-nowrap d-block "> ID #' + datos[indice].DeviceID + '</span>  </div> </a> </td> <td style="width:20%;min-width:70px" class="border-left text-center"><i  class="fas fa-fire' + colorTemp + ' "></i> ' + temp + ' <small>ppm</small> </td> <td style="width:20%;min-width:70px" class="border-left text-center border-right"></td>   </tr>  </table>';
            htmlstr3 = htmlstr3 + '<tr onclick=' + onclick + ' style="pointer:cursor" href="#"> <td class=" px-2 py-4"> <div class="d-flex no-block align-items-center"> <div class="mr-3"> <a class="btn btn-warning rounded-circle btn-circle font-10"> <label style="color:black;margin-left:0px">' + MODEL + '</label></a> </div><div class=""> <h5 class="text-dark mb-0 font-16 font-weight-medium">' + DeviceName + '  <small class="text-muted">| ID #' + deviceID + ' </small> </h5> <span class="text-muted font-12">Última lectura: ' + MuestraFechaSTR(LastUpdateFecha) + ' | ' + MuestraHoraSTR(LastUpdateHora) + '</span> </div></div></td><td class=" text-muted px-2 py-4 font-14">' + datos[indice].Description + '</td><td class=" px-2 py-4"> ' + datos[indice].Location + ' </td><td class=" text-center px-2 py-4"><i class="fa fa-wifi text-' + colorState + ' " data-toggle="tooltip" data-placement="top" title="In Testing"></i></td><td class=" text-center font-weight-medium  px-2 py-4"><a style="font-size:25px"> <h3><span class="badge-pill badge-' + colorTemp + '"> <i class="fa fa-fire"></i> ' + temp + ' <small style="font-size:x-small"> ppm  </small></span></h3></a> </td><td class="font-weight-medium px-2 py-4"><a style="font-size:25px"></a> </td><td> <div class="dropdown sub-dropdown"> <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i> </button> <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1"> <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-edit "></i> Modificar</a> <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-trash "></i> Eliminar</a> </div></div></td></tr>'
        }
        if ((MODEL == "AIR2") || (MODEL == "AIR")) {
            CardDeviceList = CardDeviceList + '<div class="card2 border-' + colorState + ' \" onclick=' + onclick + ' style=\"border-left:5px solid ;border-radius:10px;margin: 10px 10px 10px 0px;height:200px\"> <div class=\"card-header \" style="height:70px"><label class=\"text-left\" style="font-size:20px"> ' + DeviceName + '</label><p style="font-size:16px;margin-top:-10px"> <small> ID #' + deviceID + '</small></p></div><div class=\"card-body text-dark\"> <h3><span class=\"badge-pill badge-' + colorTemp + '\"> <i class=\"fa fa-fire\"></i> ' + temp + '<small> ppm </small></span></h3><hr>  <p class=\"text-muted text-left\" style=\"font-size:14px;margin-top:-15px\"><small> ' + LastRead + '</small></p></div></div>';
            htmlstr = htmlstr + '<table style="width:100%" class="clase2"> <tr style="width:100%" class="border-bottom border-top border-left" > <td style="width:90%"> <a class="clase1   align-items-center px-3 py-2" onclick=' + onclick + '  > <i  class="fas fa-wifi text-' + colorState + ' " style="margin-top:15px;margin-left:-10px;font-size:x-small;position:absolute"></i> <div class="w-75 d-inline-block v-middle pl-2"> <h6 class="message-title mb-0 mt-1">' + datos[indice].DeviceName + ' | ' + datos[indice].Description + ' </h6> <span class="font-12 text-nowrap d-block "> ID #' + datos[indice].DeviceID + '</span>  </div> </a> </td> <td style="width:20%;min-width:70px" class="border-left text-center"><i  class="fas fa-fire' + colorTemp + ' "></i> ' + temp + ' <small>ppm</small> </td> <td style="width:20%;min-width:70px" class="border-left text-center border-right"></td>   </tr>  </table>';
            htmlstr3 = htmlstr3 + '<tr onclick=' + onclick + ' style="pointer:cursor" href="#"> <td class=" px-2 py-4"> <div class="d-flex no-block align-items-center"> <div class="mr-3"> <a class="btn btn-warning rounded-circle btn-circle font-10"> <label style="color:black;margin-left:0px">' + MODEL + '</label></a> </div><div class=""> <h5 class="text-dark mb-0 font-16 font-weight-medium">' + DeviceName + '  <small class="text-muted">| ID #' + deviceID + ' </small> </h5> <span class="text-muted font-12">Última lectura: ' + MuestraFechaSTR(LastUpdateFecha) + ' | ' + MuestraHoraSTR(LastUpdateHora) + '</span> </div></div></td><td class=" text-muted px-2 py-4 font-14">' + datos[indice].Description + '</td><td class=" px-2 py-4"> ' + datos[indice].Location + ' </td><td class=" text-center px-2 py-4"><i class="fa fa-wifi text-' + colorState + ' " data-toggle="tooltip" data-placement="top" title="In Testing"></i></td><td class=" text-center font-weight-medium  px-2 py-4"><a style="font-size:25px"> <h3><span class="badge-pill badge-' + colorTemp + '"> <i class="fa fa-fire"></i> ' + temp + ' <small style="font-size:x-small"> ppm  </small></span></h3></a> </td><td class="font-weight-medium px-2 py-4"><a style="font-size:25px"></a> </td><td> <div class="dropdown sub-dropdown"> <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i> </button> <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1"> <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-edit "></i> Modificar</a> <a class="dropdown-item" href="#modify-dev-modal" data-toggle="modal" data-target="#modify-dev-modal"><i class="fa fa-trash "></i> Eliminar</a> </div></div></td></tr>'
        }
        //CardDeviceList = CardDeviceList + '<div class="card2 border-' + colorState + ' \" onclick=' + onclick + ' style=\"border-left:5px solid ;border-radius:10px;margin: 10px 10px 10px 0px\"> <div class=\"card-header \" style="height:70px"><label class=\"text-left\" style="font-size:20px"> ' + DeviceName + '</label><p style="font-size:16px;margin-top:-10px"> <small> ID #' + deviceID + '</small></p></div><div class=\"card-body text-dark\"> <h3><span class=\"badge-pill badge-' + colorTemp + '\"> <i class=\"fa fa-thermometer-empty\"></i>' + temp + '<small> °C </small></span></h3></a> </td><td class=\"font-weight-medium px-2 py-4\"><a style=\"font-size:25px\"> <h3><span class=\"badge-pill badge-' + colorHR + '\"> <i class=\"fa fa-tint\"></i>' + HR + '<small> % </small></span></h3> <hr> <h5 class=\"text-secondary text-left\" style=\"font-size:16px\"><i class=\"fa fa-bars\"></i> ' + datos[indice].Description + '</h5> <h5 class=\"text-secondary text-left\" style=\"font-size:16px\"><i class=\"fa fa-location-arrow\"></i> ' + datos[indice].Location + '</h5> <p class=\"text-muted text-left\" style=\"font-size:14px\"><small> ' + LastRead + '</small></p></div></div>';

    }

    if (offline > 0) {
        alerthtml = alerthtml + '<div class="alert alert-warning alert-dismissible fade show" role="alert" > <a id="alerttxt"> <i class="fa fa-exclamation-triangle"></i> ' + offline + ' equipos se encuentran fuera de línea</a> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden = "true"> X </span> </button> </div>';
    }
    if (fueravalor == 0 && offline == 0) {
        alerthtml = '<div class="alert alert-success alert-dismissible fade show" role="alert" > <a id="alerttxt"> <i class="fa fa-thumbs-up"></i> Todos los equipos se encuentran OK</a> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden = "true"> X </span> </button> </div>';
    }
    if (!alertasMostradas) {
        // document.getElementById('alertdiv').innerHTML = alerthtml;
        alertasMostradas = true;
    }


    //document.getElementById('_CardDeviceList').innerHTML = CardDeviceList;
    document.getElementById('devicelist-modaldata').innerHTML = htmlstr;
    // document.getElementById('devicelist-modaldata2').innerHTML = htmlstr3;
    document.getElementById('onlinetxt').innerHTML = online + ' <small> / ' + total + '</small>';
    //document.getElementById('offlinetxt').innerHTML = offline;
    if (fueravalor > 0) document.getElementById('fueravalortxt').innerHTML = fueravalor;
    if (fueravalor == 0) document.getElementById('fueravalortxt').innerHTML = "0";
    //if (offline == 0) document.getElementById('offlinetxt').innerHTML = "0";

    SelectDevice(deviceListNumber);
}

////////////////////////////////////////////////////////
function SelectDevice(_deviceListNumber) { //modifica valores de seleccion de dispositivo y alertas     
    if (deviceList.responseText == undefined) {
        var datos = deviceList;
    } else {
        var datos = JSON.parse(deviceList.responseText);
    }
    // let elem = document.querySelector('canvas');
    // let rect = elem.getBoundingClientRect();

    // window.scrollTo(0, rect.y);

    document.getElementById("dispositivo").scrollIntoView({ behavior: 'smooth' });

    deviceListNumber = _deviceListNumber;
    MODEL = datos[deviceListNumber].Model;
    $('#devicelist-modal').modal('hide'); //esconde devicelist modal
    deviceID = datos[deviceListNumber].DeviceID;
    GetDataGraphic(); //obtiene datos del gráfico

    var count = Object.keys(datos).length - 1;
    var color = "text-danger";
    if (datos[deviceListNumber].State == '1') { color = "text-success"; }
    deviceID = datos[deviceListNumber].DeviceID;

    if (datos[deviceListNumber].EnabledAlerts == "1") document.getElementById("enabledAlertschk").checked = true;
    else document.getElementById("enabledAlertschk").checked = false;

    document.getElementById('descriptiontxt').value = datos[deviceListNumber].Description;
    document.getElementById('locationtxt2').value = datos[deviceListNumber].Location;
    //document.getElementById('MainDescriptiontxt').innerText = 'ID de Equipo: ' + datos[deviceListNumber].DeviceID;
    document.getElementById('devtxt').innerHTML = "ID # <strong> " + deviceID + " </strong>";
    document.getElementById('devicestate').innerHTML = '    <i class="fas fa-wifi ' + color + '" style="position:absolute;font-size:25px;margin-top:5px;margin-left:0px; "></i><strong style="margin-left:40px;position:relative;color:white"> ' + datos[deviceListNumber].DeviceName + '</strong> | <a style="font-size:15px;color:white">' + datos[deviceListNumber].Description + ' </a> <span class="text-right"> <a style="margin-left:60px;margin-top:0px;font-size:14px" class=""> <small> <i class="fa fa-location-arrow" style="font-size:10px"> </i> ' + datos[deviceListNumber].Location + ' | <i class="fa fa-microchip"></i> ' + deviceID + ' </small></a> </span>    ';
    document.getElementById('devnametxt').value = datos[deviceListNumber].DeviceName;
    document.getElementById('lastreadtxt').innerText = "Última lectura " + MuestraFechaSTR(datos[deviceListNumber].LastUpdateFecha) + " a las " + MuestraHoraSTR(datos[deviceListNumber].LastUpdateHora);
    var temp = datos[deviceListNumber].CurrentTemp;
    var HR = parseInt(datos[deviceListNumber].CurrentHR);
    var Soil = datos[deviceListNumber].CurrentSoil;
    var color1 = datos[deviceListNumber].Color1;
    var color2 = datos[deviceListNumber].Color2;


    var msg = "";
    if (color1 == 0 & color2 == 0) { msg = "La temperatura y humedad están OK"; }
    if (color1 == 0 & color2 == 2) { msg = "La temperatura está bien pero la humedad está alta"; }
    if (color1 == 0 & color2 == 1) { msg = "La temperatura está bien pero la humedad está baja"; }
    if (color1 == 2 & color2 == 0) { msg = "La humedad está bien pero la temperatura está alta"; }
    if (color1 == 2 & color2 == 2) { msg = "La temperatura y humedad se encuentran altos"; }
    if (color1 == 2 & color2 == 1) { msg = "La temperatura está alta y la humedad está baja"; }
    if (color1 == 1 & color2 == 1) { msg = "La temperatura y humedad se encuentran bajas"; }
    if (color1 == 1 & color2 == 0) { msg = "La humedad está bien pero la temperatura está baja"; }
    if (color1 == 1 & color2 == 2) { msg = "La temperatura está baja y la humedad está alta"; }
    document.getElementById('sensorstatetxt').innerText = msg;




    if ((MODEL == "WHT22") || (MODEL == "PIXIGROW")) {
        //document.getElementById('tableGauge').style.display = "inline";
        document.getElementById('tableHR').style.display = "block";
        document.getElementById('tableTemp').style.display = "block";
        document.getElementById('tablePPM').style.display = "none";
        document.getElementById('tableSoil').style.display = "none";
        if (MODEL == "PIXIGROW") {
            document.getElementById('tableSoil').style.display = "block";
            // document.getElementById('soiltxt').innerHTML = Soil + " %";
            fm3.setPercentage(Soil);
        }

        document.getElementById('hrmin').value = datos[deviceListNumber].HRLimitMenor;
        document.getElementById('hrmax').value = datos[deviceListNumber].HRLimitMayor;
        document.getElementById('hrmintxt').value = datos[deviceListNumber].HRLimitMenor;
        document.getElementById('hrmaxtxt').value = datos[deviceListNumber].HRLimitMayor;
        document.getElementById('HRLimitsConfig').style.display = "block";
        document.getElementById('PPMLimitsConfig').style.display = "none";
        document.getElementById('TempLimitsConfig').style.display = "block";
        document.getElementById('tituloLimits').innerHTML = "Temperatura";
        document.getElementById('tempmin').value = datos[deviceListNumber].TempLimitMenor;
        document.getElementById('tempmax').value = datos[deviceListNumber].TempLimitMayor;
        document.getElementById('tempmintxt').value = datos[deviceListNumber].TempLimitMenor;
        document.getElementById('tempmaxtxt').value = datos[deviceListNumber].TempLimitMayor;
        // document.getElementById('icongaugeHR').style.display = "block";
        // document.getElementById('icongaugetemp').style.display = "block";
        //document.getElementById('temptxt').innerHTML = temp + " °C";
        // document.getElementById('HRtxt').innerHTML = HR + " %";

        // document.getElementById('GaugeHR').style.display = "block";
        if (tempold !== temp) { //SI CAMBIAN LOS VALORES ACTUALIZA EL GAUGE
            $("#GaugeTemp").data("percent", parseInt(temp));
            $("#GaugeTemp").empty();
            $("#GaugeTemp").gaugeMeter();
            tempold = temp;
        }
        if (HRold !== HR) {
            $("#GaugeHR").data("percent", HR);
            $("#GaugeHR").empty();
            $("#GaugeHR").gaugeMeter();
            HRold = HR;
        }


    }

    if (MODEL == "WDS18") {
        //    document.getElementById('tableGauge').style.display = "inline";
        document.getElementById('tableHR').style.display = "none";
        document.getElementById('tableTemp').style.display = "block";
        document.getElementById('tablePPM').style.display = "none";
        document.getElementById('tableSoil').style.display = "none";
        document.getElementById('HRLimitsConfig').style.display = "none";
        document.getElementById('TempLimitsConfig').style.display = "block";
        document.getElementById('PPMLimitsConfig').style.display = "none";
        document.getElementById('tituloLimits').innerHTML = "Temperatura";
        document.getElementById('tempmin').value = datos[deviceListNumber].TempLimitMenor;
        document.getElementById('tempmax').value = datos[deviceListNumber].TempLimitMayor;
        document.getElementById('tempmintxt').value = datos[deviceListNumber].TempLimitMenor;
        document.getElementById('tempmaxtxt').value = datos[deviceListNumber].TempLimitMayor;
        //document.getElementById('temptxt').innerHTML = temp + " °C";
        //document.getElementById('icongaugetemp').style.display = "block";

        //document.getElementById('GaugeHR').style.display = "none";
        if (tempold !== temp) { //SI CAMBIAN LOS VALORES ACTUALIZA EL GAUGE
            $("#GaugeTemp").data("percent", parseInt(temp));
            $("#GaugeTemp").empty();
            $("#GaugeTemp").gaugeMeter();
            tempold = temp;
        }

    }

    if (MODEL == "GAS") {
        document.getElementById('tableHR').style.display = "none";
        document.getElementById('tableTemp').style.display = "none";
        document.getElementById('tablePPM').style.display = "block";
        document.getElementById('tableSoil').style.display = "none";
        //document.getElementById('tableGauge').style.display = "none";
        //document.getElementById('PPMtxt').innerHTML = temp + " ppm";
        document.getElementById('HRLimitsConfig').style.display = "none";
        document.getElementById('PPMLimitsConfig').style.display = "block";
        document.getElementById('TempLimitsConfig').style.display = "none";
        document.getElementById('tituloLimits').innerHTML = "Concentración";
        document.getElementById('ppmmaxtxt').value = datos[deviceListNumber].PPMLimitMax;
        document.getElementById('ppmmax').value = datos[deviceListNumber].PPMLimitMax;
        //document.getElementById('icongaugePPM').style.display = "block";
        if (tempold !== temp) { //SI CAMBIAN LOS VALORES ACTUALIZA EL GAUGE
            $("#GaugePPM").data("used", parseInt(temp));
            $("#GaugePPM").empty();
            $("#GaugePPM").gaugeMeter();
            tempold = temp;
        }
    }

    if ((MODEL == "AIR2") || (MODEL == "AIR")) {
        document.getElementById('tablePPM').style.display = "block";
        document.getElementById('tableHR').style.display = "none";
        document.getElementById('tableTemp').style.display = "none";
        document.getElementById('tableSoil').style.display = "none";
        //document.getElementById('tableGauge').style.display = "none";
        //document.getElementById('PPMtxt').innerHTML = temp;
        document.getElementById('HRLimitsConfig').style.display = "none";
        document.getElementById('PPMLimitsConfig').style.display = "block";
        document.getElementById('TempLimitsConfig').style.display = "none";
        document.getElementById('tituloLimits').innerHTML = "PPM";
        document.getElementById('ppmmaxtxt').value = datos[deviceListNumber].PPMLimitMax;
        document.getElementById('ppmmax').value = datos[deviceListNumber].PPMLimitMax;
    }

}


/////////////////////////////////////////////////////////
function ModifyDevClick() {
    if (deviceList.responseText !== undefined) {
        deviceList = JSON.parse(deviceList.responseText);
    }

    deviceList[deviceListNumber].Location = document.getElementById('locationtxt2').value;
    deviceList[deviceListNumber].TempLimitMayor = document.getElementById("tempmax").value;
    deviceList[deviceListNumber].TempLimitMenor = document.getElementById("tempmin").value;


    if ((MODEL == "WHT22") || (MODEL == "PIXIGROW")) {
        deviceList[deviceListNumber].HRLimitMayor = document.getElementById("hrmax").value;
        deviceList[deviceListNumber].HRLimitMenor = document.getElementById("hrmin").value;
    } else {
        deviceList[deviceListNumber].HRLimitMayor = 100;
        deviceList[deviceListNumber].HRLimitMenor = 0;
    }
    if ((MODEL == "GAS") || (MODEL == "AIR2")) {
        deviceList[deviceListNumber].PPMLimitMax = document.getElementById("ppmmax").value;
    }

    if (document.getElementById("enabledAlertschk").checked == true) deviceList[deviceListNumber].EnabledAlerts = "1";
    else deviceList[deviceListNumber].EnabledAlerts = "0";

    deviceList[deviceListNumber].DeviceName = document.getElementById('devnametxt').value;
    deviceList[deviceListNumber].Description = document.getElementById('descriptiontxt').value;


    if (deviceID != "") {
        var ModifyDev = function() {
            var retorno = $.getJSON("modify-device.php", {
                DeviceID: deviceID,
                Description: deviceList[deviceListNumber].Description,
                DeviceName: deviceList[deviceListNumber].DeviceName,
                Location: deviceList[deviceListNumber].Location,
                TempLimitMayor: deviceList[deviceListNumber].TempLimitMayor,
                TempLimitMenor: deviceList[deviceListNumber].TempLimitMenor,
                HRLimitMayor: deviceList[deviceListNumber].HRLimitMayor,
                HRLimitMenor: deviceList[deviceListNumber].HRLimitMenor,
                PPMLimitMax: deviceList[deviceListNumber].PPMLimitMax,
                EnabledAlerts: deviceList[deviceListNumber].EnabledAlerts
            });
            return retorno;
        };

        ModifyDev().done(function(response) {
            // document.getElementById('adddevicetxt').value="";
            var datos = response;
            if (datos == "OK") {
                swal('', "Se actualizaron los datos correctamente", 'success');
                //ModifyAlertsClick();
                FillDevices(deviceList);
                $('#modify-dev-modal').modal('hide');

            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            swal("¡Ups!", "Algun error al modificar el dispositivo. Error '" + textStatus + "'");
        });
    }
}


///////////////////////////////////////////////////////////
function graphicSelectDate(flagtoday) {
    if (flagtoday == 0) {
        fechaMin = FormatDate(document.getElementById('graphicDate1').value);
        fechaMax = FormatDate(document.getElementById('graphicDate2').value);
        fechaHoraSelector = 0;
    }
    if (flagtoday == 1) {
        fechaMin = convertFecha2(new Date());
        fechaMax = convertFecha2(new Date());
        document.getElementById('graphicDate1').value = convertFecha(new Date());
        document.getElementById('graphicDate2').value = convertFecha(new Date());
        fechaHoraSelector = 1;
    }
    GetDataGraphic(); //obtiene datos del gráfico
}
////////////////////////////////////////////////////////////
function misdispositivosClick() {
    document.getElementById("misdispositivos").style.display = "block";
    document.getElementById("mainpage").style.display = "none";
}

//////////////////////////////////////////////////////////
function ClearAlarms() {
    document.getElementById('cantalertstxt').style.opacity = 0;
    document.getElementById('cantalertstxt').innerText = '0';

    var _ClearAlerts = function() {
        //var p = md5(password);
        var retorno = $.getJSON("clear-alerts.php", {});
        return retorno;
    };
    _ClearAlerts().done(function(response) {

    }).fail(function(jqXHR, textStatus, errorThrown) {
        // swal("Ups!","Algun error obteniendo los dispositivos " +textStatus);
    });
}


//////////////////////////////////////////////////////////
function ShowGraphic(datain) {
    if (myChart !== "a") myChart.destroy();

    var dataMaxTemp = datain.LimiteMaximoTemp;
    var dataMinTemp = datain.LimiteMinimoTemp;
    var dataMaxHR = datain.LimiteMaximoHR;
    var dataMinHR = datain.LimiteMinimoHR;
    var dataSoil = datain.Soil;
    var dataTemp = datain.Temp;
    var dataHR = datain.HR;
    var dataFecha = datain.Fecha;
    var dataHora = datain.Hora;
    var dataLabels = dataHora;

    if (fechaHoraSelector == 0) dataLabels = dataFecha;

    document.getElementById('templimmin').innerText = dataMinTemp[0] + " °C";
    document.getElementById('templimmax').innerText = dataMaxTemp[0] + " °C";
    document.getElementById('hrlimmin').innerText = dataMinHR[0] + " %";
    document.getElementById('hrlimmax').innerText = dataMaxHR[0] + " %";

    document.getElementById('picoTemp').innerText = datain.PicoTemp + " °C | " + datain.FechaPicoTemp;
    document.getElementById('promedioTemp').innerText = datain.PromedioTemp.toFixed(1) + " °C";
    document.getElementById('picoHR').innerText = datain.PicoHR + " % | " + datain.FechaPicoHR;
    document.getElementById('promedioHR').innerText = datain.PromedioHR.toFixed(0) + " %";


    //  if (lineChartData !== "a"){ lineChartData.datasets.splice(0, 1); lineChartData.datasets.splice(1, 1);}
    if (ctx !== undefined) ctx.destroy();
    var lineChartData = {
        labels: dataLabels,
        datasets: [{
            label: 'Temperatura (°C)',
            scaleFontColor: "#000",
            pointLabelFontColor: "#4480CE",
            borderColor: 'rgb(95, 118, 232,1)',
            pointRadius: 0,
            pointHoverRadius: 1,
            pointHitRadius: 10,
            pointBorderWidth: 2,
            backgroundColor: 'rgb(95, 118, 232,0.3)',
            fill: true,
            data: dataTemp,
            yAxisID: 'y-axis-1',
        }, {
            label: 'Humedad (%)',
            borderColor: 'rgb(1, 202, 241,1)',
            backgroundColor: 'rgb(1, 202, 241,0.3)',
            fill: true,
            pointRadius: 0,
            pointHoverRadius: 1,
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: dataHR,
            yAxisID: 'y-axis-2'
        }, {
            label: '',
            borderColor: 'rgb(95, 118, 232,0.7)',
            backgroundColor: 'rgb(100, 202, 241,0)',
            fill: true,
            pointRadius: 0,
            borderDash: [5, 15],
            pointHoverRadius: 1,
            pointHitRadius: 10,
            pointBorderWidth: 1,
            data: dataMinTemp,
            yAxisID: 'y-axis-1'
        }, {
            label: '',
            borderColor: 'rgb(95, 118, 232,0.7)',
            backgroundColor: 'rgb(100, 202, 241,0)',
            fill: true,
            pointRadius: 0,
            pointHoverRadius: 1,
            borderDash: [5, 15],
            pointHitRadius: 10,
            pointBorderWidth: 1,
            data: dataMaxTemp,
            yAxisID: 'y-axis-1'
        }, {
            label: '',
            borderColor: 'rgb(100, 202, 241,0.7)',
            backgroundColor: 'rgb(100, 202, 241,0)',
            fill: true,
            pointRadius: 0,
            borderDash: [5, 15],
            pointHoverRadius: 1,
            pointHitRadius: 10,
            pointBorderWidth: 1,
            data: dataMinHR,
            yAxisID: 'y-axis-2'
        }, {
            label: '',
            borderColor: 'rgb(100, 202, 241,0.7)',
            backgroundColor: 'rgb(100, 202, 241,0)',
            fill: true,
            pointRadius: 0,
            pointHoverRadius: 1,
            borderDash: [5, 15],
            pointHitRadius: 10,
            pointBorderWidth: 1,
            data: dataMaxHR,
            yAxisID: 'y-axis-2'
        }, {
            label: 'Tierra',
            scaleFontColor: "#000",
            pointLabelFontColor: "rgb(0, 175, 20,1)",
            borderColor: 'rgb(0, 175, 20,0.7)',
            backgroundColor: 'rgb(0, 175, 20,0)',
            fill: false,
            pointRadius: 0,
            pointHoverRadius: 1,
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: dataSoil,
            yAxisID: 'y-axis-2'
        }]
    };

    var ctx = document.getElementById('canvas').getContext('2d');
    myChart = new Chart.Line(ctx, {
        data: lineChartData,
        options: {
            scaleFontColor: "#FFFFFF",
            legend: {
                labels: {
                    fontColor: '#000',
                    scaleFontColor: "#FFFFFF",
                    backgroundColor: "#fff",
                },
                backgroundColor: "#fff",
                display: false,
            },
            responsive: true,
            scaleFontColor: "#000",
            hoverMode: 'index',
            stacked: false,
            maintainAspectRatio: false,
            title: {
                display: false,
                text: 'Gráfico Histórico',
            },
            scales: {
                yAxes: [{
                    type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                    display: true,
                    position: 'left',
                    id: 'y-axis-1',
                    ticks: {
                        fontColor: "grey",
                        maxTicksLimit: 5,
                        padding: 1,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return number_formatDiario(value);
                        }
                    }
                }, {
                    type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                    display: true,
                    position: 'right',
                    id: 'y-axis-2',
                    ticks: {
                        min: 0,
                        max: 100,
                        fontColor: "grey",
                        maxTicksLimit: 5,
                        padding: 1,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return number_formatDiario2(value);
                        }
                    },
                    // grid line settings
                    gridLines: {
                        drawOnChartArea: true, // only want the grid lines for one axis to show up
                    },
                }],
            }
        }
    });

}

// //////////////////////////////////////////////////////////
// function ShowGraphic(datain){
//     var dataValue = datain.Temp;
//     var dataValue2 = datain.HR;
//     var labels =datain.Etiqueta;    
//     canvas = document.getElementById("canvas");
//     if (datagra !== "a") datagra.data.datasets.splice(0, 1);
//     datagra = {
//         type: 'line', data: {
//             labels: labels,
//             datasets: [{
//                 label: "",
//                 lineTension: 0.3,
//                 backgroundColor: "rgb(212, 221, 247,0.3)",
//                 borderColor: "#2043ac",
//                 pointRadius:0,
//                 pointBackgroundColor: "rgba(78, 115, 223, 1)",
//                 pointBorderColor: "#2043ac",
//                 pointHoverRadius: 1,
//                 pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
//                 pointHoverBorderColor: "rgba(78, 115, 223, 1)",
//                 pointHitRadius: 10,
//                 pointBorderWidth: 2,
//                 data: dataValue
//             }]
//         }, options: {
//             maintainAspectRatio: false,
//             bezierCurve: true,
//             layout: {
//                 padding: {
//                     left: 5,
//                     right: 5,
//                     top: 25,
//                     bottom: 0
//                 }
//             },
//             scales: {
//                 xAxes: [{
//                     time: {
//                         unit: 'date'
//                     },
//                     gridLines: {
//                         display: false,
//                         drawBorder: false
//                     },
//                     ticks: {
//                         maxTicksLimit: 24
//                     }
//                 }],
//                 yAxes: [{
//                     ticks: {
//                         maxTicksLimit: 5,
//                         padding: 10,
//                         // Include a dollar sign in the ticks
//                         callback: function (value, index, values) {
//                             return number_formatDiario(value);

//                         }
//                     },
//                     gridLines: {
//                         color: "rgb(234, 236, 244)",
//                         zeroLineColor: "rgb(234, 236, 244)",
//                         drawBorder: false,
//                         borderDash: [2],
//                         zeroLineBorderDash: [2]
//                     }
//                 }]
//             },
//             legend: {
//                 display: false
//             },
//             tooltips: {
//                 backgroundColor: "rgb(255,255,255)",
//                 bodyFontColor: "#858796",
//                 titleMarginBottom: 10,
//                 titleFontColor: '#6e707e',
//                 titleFontSize: 14,
//                 borderColor: '#dddfeb',
//                 borderWidth: 1,
//                 xPadding: 5,
//                 yPadding: 15,
//                 displayColors: true,
//                 intersect: false,
//                 mode: 'index',
//                 caretPadding: 10,
//                 callbacks: {
//                     label: function (tooltipItem, chart) {
//                         var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
//                         return datasetLabel + number_formatDiario(tooltipItem.yLabel);
//                     }
//                 }
//             }
//         }
//     };

//     var DayChart = new Chart.Line(canvas, datagra);

//     DayChart.update();    
// }


//////////////////////////////////////////////////////////////////////////////////
function MuestraFechaSTR(_in) {
    var año = _in.substring(0, 4);
    var mes = _in.substring(4, 6);
    var dia = _in.substring(6, 8);

    return dia + "/" + mes + "/" + año;
}


//////////////////////////////////////////////////////////////////////////////////
function MuestraHoraSTR(_in) {
    hora = _in.substring(0, 2);
    min = _in.substring(2, 4);
    return hora + ":" + min;
}


//////////////////////////////////////////////////////////////////////////////////
function GetColor(str) {
    var color = "info";
    if (str == '0') { color = "success"; }
    if (str == '1') { color = "primary"; }
    if (str == '2') { color = "danger"; }
    return color;
}

//////////////////////////////////////////////////////////////////////////////////
function GetColorIcon(str) {
    var color = "info";
    if (str == '0') { color = "#00e600"; }
    if (str == '1') { color = "#5f76e8"; }
    if (str == '2') { color = "#ff4f70"; }
    return color;
}
/////////////////////////////////////////////////////////////////////////////////////
function objlen(obj) {
    var result = 0;
    for (var prop in obj) {
        if (obj.hasOwnProperty(prop)) {
            // or Object.prototype.hasOwnProperty.call(obj, prop)
            result++;
        }
    }
    return result;
}



//////////////////////////////////////// CHARTS
//Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
//Chart.defaults.global.defaultFontColor = '#858796';


function number_formatDiario(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    var tipoDiario = 1;
    decimals = 0;
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            var _resultado;
            if (tipoDiario === 1) {
                return Math.round(n * k) / k + '°C ';
            }
            // if (tipoDiario === 2) {

            //     _resultado = Math.round(n * k) / k;
            //     _resultado = _resultado;
            //     return _resultado.toFixed(1) + ' %';
            // }


        };

    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('');
    }
    return s;
}

function number_formatDiario2(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    var tipoDiario = 1;
    decimals = 1;
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            var _resultado;
            if (tipoDiario === 1) {
                return Math.round(n * k) / k + '% ';
            }
            if (tipoDiario === 2) {

                _resultado = Math.round(n * k) / k;
                _resultado = _resultado;
                return _resultado.toFixed(1) + ' %';
            }


        };

    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('');
    }
    return s;
}


//////////////////////////////////////////////////////////////////////////////////
function STRtoDATE(str) {
    var año = str.substring(0, 4);
    var mes = str.substring(4, 6) - 1;
    var dia = str.substring(6, 8);
    var d = new Date(año, mes, dia);
    return d;
}


//////////////////////////////////////////////////////////////////////////////////
function convertFecha(_dt) {
    //value="2022-04-16"
    var month = _dt.getMonth() + 1;
    var day = _dt.getDate();
    var year = _dt.getFullYear();
    //if (day === 0) { month = month - 1; }
    var año;
    var mes;
    var dia;
    if (month < 10) { mes = '0' + String(month); } else { mes = String(month); }
    if (day < 10) { dia = '0' + String(day); } else { dia = String(day); }
    anio = String(year);
    var out = anio + "-" + mes + "-" + dia;
    //alert(out);
    return out;
}


//////////////////////////////////////////////////////////////////////////////////
function convertFecha2(_dt) {
    //value="2022-04-16"
    var month = _dt.getMonth() + 1;
    var day = _dt.getDate();
    var year = _dt.getFullYear();
    //if (day === 0) { month = month - 1; }
    var año;
    var mes;
    var dia;
    if (month < 10) { mes = '0' + String(month); } else { mes = String(month); }
    if (day < 10) { dia = '0' + String(day); } else { dia = String(day); }
    anio = String(year);
    var out = anio + mes + dia;
    //alert(out);
    return out;
}


//////////////////////////////////////////////////////////////////////////////////
function FormatDate(str) {
    var año = str.substring(0, 4);
    var mes = str.substring(5, 7);
    var dia = str.substring(8, 10);
    var out = año + mes + dia;
    return out;
}


//////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////
function FechaToSTR(_in) {
    var a = _in.split("-");
    var dia = a[0];
    var mes = a[1];
    var año = a[2];
    return año + mes + dia;
}

////////////////////////////////////////////////////
function ExportDataPHP() {
    var ini = document.getElementById('graphicDate1').value;
    var fin = document.getElementById('graphicDate2').value;
    ini = FechaToSTR(ini);
    fin = FechaToSTR(fin);
    if (fin === "") return;
    if (ini === "") return;
    window.open('ExportData.php?inicio=' + ini + '&fin=' + fin + '&DeviceID=' + deviceID, "Wisee", "width=100,height=100,scrollbars=NO")

}