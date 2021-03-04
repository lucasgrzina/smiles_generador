<?php
return [
    'homeActiva' => true,
    'templates' => [
        'diario' => 'Diario',
        'comunicado' => 'Comunicado',
        'vto_millas' => 'Vto. Millas'
    ],
    'default_diario' => [
    	'publicidad' => true,
    	'saldo' => false,
    	'contenido' => '[{"id": "imagen1", "link": "", "index": "content_1", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-07082020/img-banner-3promos.jpg", "nombre": "Fila de una sola imagen", "unique": 1, "utm_term": "", "utm_medium": "", "utm_source": "", "utm_content": "", "utm_campaign": ""}, {"id": "separador1", "index": "content_3", "input": "", "nombre": "Separador Horizontal | 30px de alto", "unique": 3}, {"id": "contenido_predefinido", "index": "content_2", "input": "", "nombre": "Contenido predefinido", "unique": 2, "predefinido": 9}, {"id": "imagen1", "index": "content_4", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-07082020/promo-compra-2.jpg", "nombre": "Fila de una sola imagen", "unique": 4}, {"id": "contenido_predefinido", "index": "content_5", "input": "", "nombre": "Contenido predefinido", "unique": 5, "predefinido": 6}]',
    	'legales'=> '"{\"legales\":\"1\",\"legales_custom\":\"\"}"',
    	'footer'=> '"{\"footer\":\"4\",\"redes\":\"3\"}"'
    ],
    'default_comunicado' => [
    	'publicidad' => false,
    	'saldo' => false,
    	'contenido' => '[{"id": "contenido_predefinido", "index": "content_3", "input": "", "nombre": "Contenido predefinido", "unique": 3, "predefinido": 8}, {"id": "textoplano", "index": "content_2", "input": "<p><strong style=\"color: #7c7c7c; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\">Si ya ten&eacute;s un vuelo con Delta canjeado con millas Smiles o un Viaje F&aacute;cil, no te preocupes</strong><span style=\"color: #7c7c7c; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\">, todos los vuelos ser&Atilde;&iexcl;n respetados. Pod&eacute;s pedir el ac&uacute;mulo de las millas para todos los vuelos realizados hasta el 31 de Marzo 2020. El formulario para solicitar las millas seguir&Atilde;&iexcl; disponible hasta el 31 de Agosto de 2020.</span><br style=\"color: #7c7c7c; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\" /><br style=\"color: #7c7c7c; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\" /><span style=\"color: #7c7c7c; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\">Y para proporcionar una mejor experiencia, ahora en Smiles pod&eacute;s canjear tus millas por pasajes a m&aacute;s de 365 destinos en 61 pa&Atilde;&shy;ses con American Airlines, la compa&ntilde;&iacute;&shy;a a&eacute;rea l&Atilde;&shy;der en el mercado americano que opera en m&Atilde;&iexcl;s de 6800 vuelos diarios. En breve los clientes Smiles tambi&Atilde;&copy;n podr&Atilde;&iexcl;n acumular millas con American Airlines. Estate atento.</span><br style=\"color: #7c7c7c; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\" /><br style=\"color: #7c7c7c; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\" /><span style=\"color: #7c7c7c; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\">Gracias,</span><br style=\"color: #7c7c7c; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\" /><br style=\"color: #7c7c7c; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\" /><span style=\"font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #ff5a00;\"><strong>Smiles Argentina</strong></span></p>", "nombre": "Texto Plano", "unique": 2}]',
    	'legales'=> '"{\"legales\":\"1\",\"legales_custom\":\"\"}"',
    	'footer'=> '"{\"footer\":\"4\",\"redes\":\"3\"}"'
    ],
    'default_vto_millas' => [
    	'publicidad' => false,
    	'saldo' => true,
    	'contenido' => '[{"id": "imagen1", "index": "content_2", "input": "https://smiles-mkt-ar.s3.amazonaws.com/EMKT-Smiles-Millas-Vencimiento/banner_vencimiento_millas.png", "nombre": "Fila de una sola imagen", "unique": 2}, {"id": "separador1", "index": "content_3", "input": "", "nombre": "Separador Horizontal | 30px de alto", "unique": 3}, {"id": "contenido_predefinido", "index": "content_4", "input": "", "nombre": "Contenido predefinido", "unique": 4, "predefinido": 10}]',
    	'legales'=> '"{\"legales\":\"1\",\"legales_custom\":\"\"}"',
    	'footer'=> '"{\"footer\":\"4\",\"redes\":\"3\"}"'
    ]
];