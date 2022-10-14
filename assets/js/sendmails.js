function EnviarMailClick() {

    var desde = document.getElementById('email').value;

    var nombre = document.getElementById('name').value;

    var mensaje = document.getElementById('message').value;

    var celu = document.getElementById('celu').value;


    if (desde.indexOf('@') > -1) {
        if (nombre === '' || desde === '' || mensaje === '') {
            alert("Complete todos los campos por favor");
            document.getElementById('sendbtn').style.display = 'block';
        } else {
            document.getElementById('sendbtn').style.display = 'none';
            Email.send({

                SecureToken: "ae9f7e0a-12ec-4f9b-ab8f-9c92de5f6f56",

                To: 'info@wisee.com.ar',

                From: desde,

                Subject: "CONTACTO WEB",

                Body: nombre + " (" + celu + "):" + mensaje

            }).then(message => alert("Tu mensaje fue enviado correctamente. Nos pondremos en contacto contigo a la brevedad."));

        }

    }

}


function sendMail() {
    $.ajax({
        type: 'POST',
        url: 'https://mandrillapp.com/api/1.0/messages/send.json',
        data: {
            'key': 'YOUR API KEY HERE',
            'message': {
                'from_email': 'mi@EMAIL.HERE',
                'to': [{
                    'email': 'info@wisee.com.ar',
                    'name': 'nombre',
                    'type': 'to'
                }],
                'autotext': 'true',
                'subject': 'asunto',
                'html': 'cuerpo mensaje'
            }
        }
    }).done(function(response) {
        console.log(response); // if you're into that sorta thing
    });
}