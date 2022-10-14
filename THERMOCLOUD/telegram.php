<?php 
$TOKEN = "5193210257:AAFA8fAMsSW4IuFj_rcgvBhK0OSkcHB-IaA";
$URL = "https://api.telegram.org/bot" .$TOKEN; 

$apiToken = "my_bot_api_token";

$data = [
    'chat_id' => '@Wisee_demobot',
    'text' => 'Hello world!'
];

$response = file_get_contents("https://api.telegram.org/bot".$TOKEN."/sendMessage?" . http_build_query($data) );

// //https://api.telegram.org/bot5193210257:AAFA8fAMsSW4IuFj_rcgvBhK0OSkcHB-IaA/sendMessage?chat_id=123?parse_mode=HTML?text=pruebaphp
// sendMessage("123","Prueba de PHP");

// function http_post($url, $json){
//     $ans = null;
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url); 
//     try
//     {
//         $data_string = json_encode($json);
//         // Disable SSL verification
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//         curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//         // Will return the response, if false it print the response
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//             'Content-Type: application/json',
//             'Content-Length: ' . strlen($data_string))
//         );
//         $ans = json_decode(curl_exec($ch));
//         if($ans->ok !== TRUE)
//         {
//             $ans = null;
//         }
//     }
//     catch(Exception $e)
//     {
//         echo "Error: ", $e->getMessage(), "\n";
//     }
//     curl_close($ch);
//     return $ans;
// }


// function sendMessage($chat_id, $text)
// {
//     global $URL;
//     $json = ['chat_id'       => $chat_id,
//              'text'          => $text,
//              'parse_mode'    => 'HTML'];
//     return http_post($URL.'/sendMessage', $json);
// }
?>