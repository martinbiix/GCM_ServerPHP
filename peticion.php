<?php
	//apiKery => Es el ID que nos da la consola de google al crear el proyecto
	$apiKey ='KKKKKXXXXXXXX_BYYYYYYY_Oa89s7d9a8sd7-ASDDAS';

	//Cabeceras, especificamos el tipo de dato que va a salir hacia el dispositivo
	$headers = array('Content-Type:application/json', "Authorization:key=$apiKey");

	/*
		Datos, estos son los datos que se enviaran al dispotivo
		mensaje => es el valor el cual capturamos en android 
		 			Ej para android:
		 				String mensaje = intent.getStringExtra("mensaje");

	*/
	$payload = array('mensaje'=> utf8_encode('Mensaje!!!'), 'id'=>'99999');

	/*
		Lista de IDs a los cuales enviaremos el mensaje, este ID lo regresa GCM al dispositivo(Android) en este caso esta hardcodeado
		Este valor siempre va a cambiar dependiendo de a donde queramos mandar el mensae, lo recomendable es almacenar todos estos IDS
		en una base de datos desde el momento en que el dispositivo(Android) se registra en los GCM, vincularlo a un usuario, telefono, etc..
		y desde ahi jalarlo para poder enviar los mensajes.
	*/
	$registratoinIdsArray = array('IOAJsdaoijsdASDJAOSIdjasDJAOSIDJ-IOAsjdaosda89sdu7ams89duasudny9_XCa9w0d9aj-ASPdi9ujao90u82o9du8_AWDKAwdkaw09dj8awo9dh8awDAWHDaw98dh');

	/*
		Formamos el array que enviaremos a los servidores de Google Cloud Messaging, despues google se va a encargar de enviar el mensaje al dispositivo
		con el array de IDs que le pasemos, puede ser 1 o varios.
	*/
	$data = array(
					'data'	=> $payload,   //Array declarado en la parte de arriba el cual contiene los datos a enviar
					'registration_ids'=>$registratoinIdsArray //   ID/IDS del registro de Android a GCM, a los cuales se le enviara el mensaje 
				);

	//Se crea la peticion mediante curl para enviarla a los servidores de Google Cloud Messaging
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  //Ingresamos los headers
	curl_setopt($ch, CURLOPT_URL, "http://android.googleapis.com/gcm/send"); //Dirección para enviar a los servidores de GCM
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0); //Deshabilitamos la verificación SSL
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0); //Deshabilitamos CURLOPT_SSL_VERIFYPEER
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));      //Codificamos data para enviarlo en forma de json

	//Conectamos y recuperamos la respuesta
	$response = curl_exec($ch);

	//cerrar la conexión
	curl_close($ch);
?>