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
    	'contenido' => '[{"id": "contenido_predefinido", "index": "content_3", "input": "", "nombre": "Contenido predefinido", "unique": 3, "predefinido": 8}, {"id": "textoplano", "index": "content_2", "input": "", "nombre": "Texto Plano", "unique": 2}]',
    	'legales'=> '"{\"legales\":\"1\",\"legales_custom\":\"\"}"',
    	'footer'=> '"{\"footer\":\"4\",\"redes\":\"3\"}"'
    ],
    'default_vto_millas' => [
    	'publicidad' => false,
    	'saldo' => true,
    	'contenido' => '[{"id": "imagen1", "index": "content_2", "input": "https://smiles-mkt-ar.s3.amazonaws.com/EMKT-Smiles-Millas-Vencimiento/banner_vencimiento_millas.png", "nombre": "Fila de una sola imagen", "unique": 2}, {"id": "separador1", "index": "content_3", "input": "", "nombre": "Separador Horizontal | 30px de alto", "unique": 3}, {"id": "contenido_predefinido", "index": "content_4", "input": "", "nombre": "Contenido predefinido", "unique": 4, "predefinido": 10}]',
    	'legales'=> '"{\"legales\":\"1\",\"legales_custom\":\"\"}"',
    	'footer'=> '"{\"footer\":\"4\",\"redes\":\"3\"}"'
	],
	'tiposContenidosPredefinidos' => [
		'contenido' => 'Contenido',
		'footer' => 'Footer',
		'redes' => 'Redes',
		'legales' => 'Legales',
	]
];