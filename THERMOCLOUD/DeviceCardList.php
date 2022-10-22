<?php 

//session_start();
include "config.php";
//ini_set('max_execution_time', 5); 

error_reporting(E_PARSE);

$wht22= '
<div class="col-md-3 col-6" class="text-light"> 
<div class="card2" style="margin-top:20px" onclick={_onclick} >
    <a class="text-left">
    <p style="margin-top:20px;margin-left:20px"> <i class="fa fa-circle text-{colorState}" aria-hidden="true"></i> <i class="fa fa-arrows"></i> {SensorName}</p> <p style="margin-top:-20px;margin-left:20px"><small><i class="fa fa-microchip"></i> {DeviceID} </small></p> 
    </a>
    <table>
        <tr style="width:100%">
            <td style="font-size:20px" class="text-{colorTemp}"> <i class="fa fa-thermometer-half" aria-hidden="true"></i> {Tem} °C</td>
            <td style="font-size:20px" class="text-{colorHR}"> <i class="fa fa-tint" aria-hidden="true"></i> {Hum} %</td>
        </tr>
    </table>
    <div class="row" style="margin: 0px 0px 0px 0px">
    <canvas id="{ChartName}" style="width:auto"></canvas>
    </div>
</div>
</div>
<script>
var xValues = [{valoresFecha}];
var yValues = [{valoresTemp}];
var yValues2 = [{valoresHR}];

new Chart("{ChartName}", {
type: "line",
data: {
    labels: xValues,
    datasets: [{
        label: \'Temperatura (°C)\',
        scaleFontColor: "#000",
        pointLabelFontColor: "#4480CE",
        borderColor: \'rgb(95, 118, 232,1)\',
        pointRadius: 0,
        pointHoverRadius: 1,
        pointHitRadius: 10,
        pointBorderWidth: 2,
        backgroundColor: \'rgb(95, 118, 232,0.3)\',
        fill: true,
    data: yValues
    },
    {
        label: \'Humedad (°C)\',
        scaleFontColor: "#000",
        pointLabelFontColor: "#4480CE",
        borderColor: \'rgb(1, 202, 241,1)\',
        pointRadius: 0,
        pointHoverRadius: 1,
        pointHitRadius: 10,
        pointBorderWidth: 2,
        backgroundColor: \'rgb(1, 202, 241,0.3)\',
        fill: true,
    data: yValues2
    }                                    ]
},
options: {
    legend: {display: false},
    responsive: true,
    plugins: {
        legend: {
          display:false,
        },
        
    },
    scales: {
        xAxes: [{     
            display:false,       
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
        yAxes: [{
            display: false,
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            } ,
            ticks: {
                beginAtZero: true
            }     
        }]
    }    
}
});
</script>';

$wds18= '
<div class="col-md-3 col-6" class="text-light"> 
<div class="card2" style="margin-top:20px;margin-left:0px" onclick={_onclick} >
    <a class="text-left">
    <p style="margin-top:20px;margin-left:20px"> <i class="fa fa-circle text-{colorState}" aria-hidden="true"></i> {SensorName}</p> <p style="margin-top:-20px;margin-left:20px"><small><i class="fa fa-microchip"></i> {DeviceID} </small></p> 
    <a style="font-size:20px" class="text-{colorTemp}"> <i class="fa fa-thermometer-half" aria-hidden="true"></i> {Tem} °C {Exclamation} </a> 
    </a>
    <div class="row" style="margin: 0px 0px 0px 0px">
        <canvas id="{ChartName}" style="width:auto"></canvas>
    </div>
</div>
</div>
<script>
var xValues = [{valoresFecha}];
var yValues = [{valoresTemp}];

new Chart("{ChartName}", {
type: "line",
data: {
    labels: xValues,
    datasets: [{
        label: \'Temperatura (°C)\',
        scaleFontColor: "#000",
        pointLabelFontColor: "#4480CE",
        borderColor: \'rgb(95, 118, 232,1)\',
        pointRadius: 0,
        pointHoverRadius: 1,
        pointHitRadius: 10,
        pointBorderWidth: 2,
        backgroundColor: \'rgb(95, 118, 232,0.3)\',
        fill: true,
    data: yValues
    }]
},
options: {
    legend: {display: false},
    responsive: true,
    plugins: {
        legend: {
          display:false,
        },
        
    },
    scales: {
        xAxes: [{
            display:false,              
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
        yAxes: [{
            display:false,  
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            },
            ticks: {
                beginAtZero: true
            }               
        }]
    }    
}
});
</script>';

$ppm= '
<div class="col-md-3 col-6" class="text-light"> 
<div class="card2" style="margin-top:20px;margin-left:0px" onclick={_onclick} >
    <a class="text-left">
    <p style="margin-top:20px;margin-left:20px"> <i class="fa fa-circle text-{colorState}" aria-hidden="true"></i> <i class="fa fa-arrows"></i> {SensorName}</p> <p style="margin-top:-20px;margin-left:20px"><small><i class="fa fa-microchip"></i> {DeviceID} </small></p> 
    <a style="font-size:20px" class="text-{colorPPM}"> <strong><i class="bi bi-wind" aria-hidden="true"></i></strong> {Tem} ppm</a>
    </a>
    <div class="row" style="margin: 0px 0px 0px 0px">
        <canvas id="{ChartName}" style="width:auto"></canvas>
    </div>
</div>
</div>
<script>
var xValues = [{valoresFecha}];
var yValues = [{valoresTemp}];

new Chart("{ChartName}", {
type: "line",
data: {
    labels: xValues,
    datasets: [{
        label: \'PPM \',
        scaleFontColor: "#000",
        pointLabelFontColor: "#4480CE",
        borderColor: \'rgb(95, 118, 232,1)\',
        pointRadius: 0,
        pointHoverRadius: 1,
        pointHitRadius: 10,
        pointBorderWidth: 2,
        backgroundColor: \'rgb(95, 118, 232,0.3)\',
        fill: true,
    data: yValues
    }]
},
options: {
    legend: {display: false},
    responsive: true, 
    plugins: {
        legend: {
          display:false,
        },        
    },
    scales: {
        xAxes: [{
            display:false,  
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
        yAxes: [{
            display:false,  
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            } 
        }]
    }    
}
});
</script>';

$pixigrow='
<div class="col-md-3 col-6" class="text-light"> 
    <div class="card2" style="margin-top:20px" onclick={_onclick} >
        <a class="text-left">
        <p style="margin-top:20px;margin-left:20px"> <i class="fa fa-circle text-{colorState}" aria-hidden="true"></i> <i class="fa fa-arrows"></i> {SensorName}</p> <p style="margin-top:-20px;margin-left:20px"><small><i class="fa fa-microchip"></i> {DeviceID} </small></p> 
        </a>
        <table>
            <tr style="width:100%">
                <td style="font-size:20px" class="text-{colorTemp}"> <i class="fa fa-thermometer-half" aria-hidden="true"></i> {Tem} °C</td>
                <td style="font-size:20px" class="text-{colorHR}"> <i class="fa fa-tint" aria-hidden="true"></i> {Hum} %</td>
                <td style="font-size:20px" class="text-{colorSoil}"> <i class="fa fa-seedling" aria-hidden="true"></i> {Soil} %</td>
            </tr>
        </table>
        <div class="row" style="margin: 0px 0px 0px 0px">
        <canvas id="{ChartName}" style="width:auto"></canvas>
        </div>
    </div>
</div>

<script>
var xValues = [{valoresFecha}];
var yValues = [{valoresTemp}];
var yValues2 = [{valoresHR}];
var yValues3 = [{valoresSoil}];

new Chart("{ChartName}", {
type: "line",
data: {
    labels: xValues,
    datasets: [{
        label: \'Temperatura (°C)\',
        scaleFontColor: "#000",
        pointLabelFontColor: "#4480CE",
        borderColor: \'rgb(95, 118, 232,1)\',
        pointRadius: 0,
        pointHoverRadius: 1,
        pointHitRadius: 10,
        pointBorderWidth: 2,
        backgroundColor: \'rgb(95, 118, 232,0.3)\',
        fill: true,
    data: yValues
    },
    {
        label: \'Humedad (°C)\',
        scaleFontColor: "#000",
        pointLabelFontColor: "#4480CE",
        borderColor: \'rgb(1, 202, 241,1)\',
        pointRadius: 0,
        pointHoverRadius: 1,
        pointHitRadius: 10,
        pointBorderWidth: 2,
        backgroundColor: \'rgb(1, 202, 241,0.3)\',
        fill: true,
    data: yValues2
    },
    {
        label: \'Suelo (%)\',
        scaleFontColor: "#000",
        pointLabelFontColor: "#4480CE",
        borderColor: \'rgb(0, 175, 20,1)\',
        pointRadius: 0,
        pointHoverRadius: 1,
        pointHitRadius: 10,
        pointBorderWidth: 2,
        backgroundColor: \'rgb(0, 175, 20,0.3)\',
        fill: true,
    data: yValues3
    }]
},
options: {
    legend: {display: false},
    responsive: true,
    plugins: {
        legend: {
          display:false,
        },
        
    },
    scales: {
        xAxes: [{
            display:false,  
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
        yAxes: [{
            display:false,  
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            } ,
            ticks: {
              
            }     
        }]
    }    
}
});

</script>
';

$Email =$_SESSION['Email'];   
$querystr = "Select * from devices where Email = '".$Email."' order by LastUpdateFecha desc, LastUpdateHora desc, DeviceName asc"; 
$db =  ConnectMySQL();
$sql = $db->prepare($querystr); 
$sql->execute(); 
$numeroFilas = $sql->rowCount();
$ChartIndex=0;
while( $row= $sql->fetch(PDO::FETCH_ASSOC)){    
    $Chartname="_Chart".$ChartIndex;
    $diferencia = DiffTime($row["LastUpdateFecha"], $row["LastUpdateHora"]); //Diferencia en minutos
    //logmsg($row["LastUpdateFecha"]);
    $row["State"]="success";
    $row["ColorTemp"]="secondary";
    $row["ColorHR"]="secondary";
    $row["ColorPPM"]="secondary";
    $row["colorSoil"]="secondary";

    $row["Exclamation"]="";
    if ($diferencia >= 7) {$row["State"]="danger";};
    if ($row["LastUpdateFecha"] == ""){$row["State"]="danger";};


    if ($row["CurrentTemp"]> $row["TempLimitMayor"]) { $row["ColorTemp"]="secondary";    $row["Exclamation"]="<i class='text-danger bi bi-exclamation-triangle-fill'></i>";}
    if ($row["CurrentTemp"]< $row["TempLimitMenor"]) { $row["ColorTemp"]="secondary";    $row["Exclamation"]="<i class='text-danger bi bi-exclamation-triangle-fill'></i>";}
    if ($row["CurrentHR"]> $row["HRLimitMayor"]) { $row["ColorHR"]="secondary";    $row["Exclamation"]="<i class='text-danger bi bi-exclamation-triangle-fill'></i>";}
    if ($row["CurrentHR"]< $row["HRLimitMenor"]) { $row["ColorHR"]="secondary";    $row["Exclamation"]="<i class='text-danger bi bi-exclamation-triangle-fill'></i>";}
    if ($row["CurrentTemp"]> $row["PPMLimitMax"]) {$row["ColorPPM"]="secondary";    $row["Exclamation"]="<i class='text-danger bi bi-exclamation-triangle-fill'></i>";}

    
    $MODEL= $row["Model"];
    
    $datosGrafico= GetGraphicCard($row["DeviceID"]);    
    $porciones = explode("/", $datosGrafico);    
    $templist= $porciones[0]; // porción1
    $humlist= $porciones[1]; // porción2
    $soillist= $porciones[2]; // porción2
    $fechalist=$porciones[3];
    $data[]=$row;   

    if ($MODEL == "WHT22") $out=$wht22;
    if ($MODEL == "PIXIGROW") $out=$pixigrow;
    if ($MODEL == "WDS18") $out=$wds18;
    if (($MODEL == "GAS")|| ($MODEL == "AIR2")) $out=$ppm;

    $onclick="SelectDevice(" . $ChartIndex . ")";
    $out= str_replace("{DeviceID}",$row["DeviceID"],$out);
    $out= str_replace("{SensorName}",$row["DeviceName"],$out);
    $out= str_replace("{Tem}",$row["CurrentTemp"],$out);
    $out= str_replace("{Hum}",$row["CurrentHR"],$out);
    $out= str_replace("{Soil}",$row["CurrentSoil"],$out);
    $out= str_replace("{colorState}",$row["State"],$out);
    $out= str_replace("{valoresFecha}",$fechalist,$out);
    $out= str_replace("{valoresTemp}",$templist,$out);
    $out= str_replace("{valoresHR}",$humlist,$out);
    $out= str_replace("{valoresSoil}",$soillist,$out);
    $out= str_replace("{ChartName}",$Chartname,$out);
    $out= str_replace("{_onclick}",$onclick,$out);
    $out= str_replace("{colorTemp}",$row["ColorTemp"],$out);    
    $out= str_replace("{colorHR}",$row["ColorHR"],$out);    
    $out= str_replace("{colorPPM}",$row["ColorPPM"],$out);    
    $out= str_replace("{Exclamation}",$row["Exclamation"],$out);    
      
    echo $out;
    $ChartIndex++;
}      
$db= null;
$sql = null; // obligado para cerrar la conexión                               while($row= $sql->fetch(PDO::FETCH_ASSOC)){   


    
?>