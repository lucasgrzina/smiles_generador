<?php
return [
    'homeActiva' => true,
    'templates' => [
        'diario' => 'Diario',
        'comunicado' => 'Comunicado',
        'vto_millas' => 'Vto. Millas',
        'eventos_especiales' => 'Eventos Especiales',
        'sabias_que' => 'Sabías que',
        'voucher' => 'Voucher',
        'template_libre' => 'Template Libre'
    ],
    'default_diario' => [
    	'publicidad' => true,
    	'saldo' => false,
    	'contenido' => '[{"id": "imagen1", "link": "", "index": "content_1", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-07082020/img-banner-3promos.jpg", "nombre": "Fila de una sola imagen", "unique": 1, "utm_term": "", "utm_medium": "", "utm_source": "", "utm_content": "", "utm_campaign": ""}, {"id": "separador1", "index": "content_3", "input": "30", "nombre": "Separador Horizontal", "unique": 3}, {"id": "contenido_predefinido", "index": "content_2", "input": "", "nombre": "Contenido predefinido", "unique": 2, "predefinido": 9}, {"id": "imagen1", "index": "content_4", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-07082020/promo-compra-2.jpg", "nombre": "Fila de una sola imagen", "unique": 4}, {"id": "contenido_predefinido", "index": "content_5", "input": "", "nombre": "Contenido predefinido", "unique": 5, "predefinido": 6}]',
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
    	'contenido' => '[{"id": "imagen1", "index": "content_2", "input": "https://smiles-mkt-ar.s3.amazonaws.com/EMKT-Smiles-Millas-Vencimiento/banner_vencimiento_millas.png", "nombre": "Fila de una sola imagen", "unique": 2}, {"id": "separador1", "index": "content_3", "input": "30", "nombre": "Separador Horizontal", "unique": 3}, {"id": "contenido_predefinido", "index": "content_4", "input": "", "nombre": "Contenido predefinido", "unique": 4, "predefinido": 10}]',
    	'legales'=> '"{\"legales\":\"1\",\"legales_custom\":\"\"}"',
    	'footer'=> '"{\"footer\":\"4\",\"redes\":\"3\"}"'
	],
	'tiposContenidosPredefinidos' => [
		'contenido' => 'Contenido',
		'footer' => 'Footer',
		'redes' => 'Redes',
		'legales' => 'Legales',
	],
    'default_eventos_especiales' => [
        'publicidad' => true,
        'saldo' => true,
        'contenido' => '[{"id": "imagen1", "link": "https://www.smiles.com.ar/promo/hot-week/", "index": "content_1", "input": "https://smiles-mkt-ar.s3.amazonaws.com/EMKT-30072020/img-banner.gif", "nombre": "Fila de una sola imagen", "unique": 1, "utm_term": "", "utm_medium": "", "utm_source": "", "utm_content": "", "utm_campaign": ""}, {"id": "separador1", "index": "content_8", "input": 30, "nombre": "Separador Horizontal", "unique": 8}, {"id": "imagen1", "link": "https://www.smiles.com.ar/promo/hot-week/", "index": "content_6", "input": "https://smiles-mkt-ar.s3.amazonaws.com/EMKT-30072020/Post_600x200.png", "nombre": "Fila de una sola imagen", "unique": 6}, {"id": "imagen1", "link": "https://www.smiles.com.ar/promo/hot-week/", "index": "content_7", "input": "https://smiles-mkt-ar.s3.amazonaws.com/EMKT-30072020/promo-banc.gif", "nombre": "Fila de una sola imagen", "unique": 7}, {"id": "imagen1", "link": "https://www.smiles.com.ar/promo/hot-week/", "index": "content_4", "input": "https://smiles-mkt-ar.s3.amazonaws.com/EMKT-30072020/tit-01.gif", "nombre": "Fila de una sola imagen", "unique": 4}, {"id": "imagen2", "link": "https://www.smiles.com.ar/emission?originAirportCode=EZE&amp;destinationAirportCode=RIO&amp;departureDate=1613401200000&amp;adults=1&amp;children=0&amp;infants=0&amp;isFlexibleDateChecked=false&amp;tripType=2&amp;currencyCode=BRL/", "index": "content_9", "input": "https://smiles-mkt-ar.s3.us-east-1.amazonaws.com/EMKT-30072020/dest-01.jpg", "link2": "https://www.smiles.com.ar/emission?originAirportCode=EZE&amp;destinationAirportCode=SAO&amp;departureDate=1610593200000&amp;adults=1&amp;children=0&amp;infants=0&amp;isFlexibleDateChecked=false&amp;tripType=1&amp;currencyCode=BRL&amp;returnDate=1610593200000/", "input2": "https://smiles-mkt-ar.s3.us-east-1.amazonaws.com/EMKT-30072020/dest-02.jpg", "nombre": "Fila con dos imagenes", "unique": 9}, {"id": "imagen2", "link": "https://www.smiles.com.ar/emission?originAirportCode=EZE&amp;destinationAirportCode=FOR&amp;departureDate=1613228400000&amp;adults=1&amp;children=0&amp;infants=0&amp;isFlexibleDateChecked=false&amp;tripType=2&amp;currencyCode=BRL/", "index": "content_10", "input": "https://smiles-mkt-ar.s3.us-east-1.amazonaws.com/EMKT-30072020/dest-03.jpg", "link2": "https://www.smiles.com.ar/emission?originAirportCode=EZE&amp;destinationAirportCode=MIA&amp;departureDate=1614783600000&amp;adults=1&amp;children=0&amp;infants=0&amp;isFlexibleDateChecked=false&amp;tripType=1&amp;currencyCode=BRL&amp;returnDate=1616079600000/", "input2": "https://smiles-mkt-ar.s3.us-east-1.amazonaws.com/EMKT-30072020/dest-04.jpg", "nombre": "Fila con dos imagenes", "unique": 10}, {"id": "separador1", "index": "content_12", "input": 30, "nombre": "Separador Horizontal", "unique": 12}, {"id": "imagen1", "link": "https://www.smiles.com.ar/emission?originAirportCode=EZE&amp;destinationAirportCode=CUN&amp;departureDate=1616468400000&amp;adults=1&amp;children=0&amp;infants=0&amp;isFlexibleDateChecked=false&amp;tripType=2&amp;currencyCode=BRL/", "index": "content_11", "input": "https://smiles-mkt-ar.s3.us-east-1.amazonaws.com/EMKT-30072020/dest-05.jpg", "nombre": "Fila de una sola imagen", "unique": 11}, {"id": "separador1", "index": "content_17", "input": 30, "nombre": "Separador Horizontal", "unique": 17}, {"id": "imagen1", "link": "https://www.smiles.com.ar/promo/hot-week/", "index": "content_13", "input": "https://smiles-mkt-ar.s3.amazonaws.com/EMKT-30072020/promo-vf.jpg", "nombre": "Fila de una sola imagen", "unique": 13}, {"id": "separador1", "index": "content_16", "input": 30, "nombre": "Separador Horizontal", "unique": 16}, {"id": "imagen1", "link": "https://www.smiles.com.ar/promo/hot-week/", "index": "content_14", "input": "https://smiles-mkt-ar.s3.amazonaws.com/EMKT-30072020/vf-01.gif", "nombre": "Fila de una sola imagen", "unique": 14}, {"id": "separador1", "index": "content_15", "input": 30, "nombre": "Separador Horizontal", "unique": 15}]',
        'legales'=> '"{\"legales\":\"1\",\"legales_custom\":\"\"}"',
        'footer'=> '"{\"footer\":\"4\",\"redes\":\"3\"}"'
    ], 
    'default_sabias_que' => [
        'publicidad' => true,
        'saldo' => true,
        'contenido' => '[{"id": "imagen1", "link": "https://www.smiles.com.ar/promo/compra-millas-bonus/", "index": "content_1", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-20082020/banner-img.jpg", "nombre": "Fila de una sola imagen", "unique": 1, "utm_term": "", "utm_medium": "", "utm_source": "", "utm_content": "", "utm_campaign": ""}, {"id": "imagen1", "link": "https://www.smiles.com.ar/promo/compra-millas-bonus/", "index": "content_6", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-20082020/sec-01.gif", "nombre": "Fila de una sola imagen", "unique": 6}, {"id": "separador1", "index": "content_10", "input": "10", "nombre": "Separador Horizontal", "unique": 10}, {"id": "imagen1", "link": "https://www.smiles.com.ar/promo/destinos/", "index": "content_7", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-20082020/promo-destinos.jpg", "nombre": "Fila de una sola imagen", "unique": 7}, {"id": "separador1", "index": "content_8", "input": 30, "nombre": "Separador Horizontal", "unique": 8}, {"id": "imagen1", "link": "https://www.smiles.com.ar/promo/register-pc/", "index": "content_4", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-20082020/promo-registro.jpg", "nombre": "Fila de una sola imagen", "unique": 4}, {"id": "separador1", "index": "content_9", "input": 30, "nombre": "Separador Horizontal", "unique": 9}]',
        'legales'=> '"{\"legales\":\"1\",\"legales_custom\":\"\"}"',
        'footer'=> '"{\"footer\":\"4\",\"redes\":\"3\"}"'
    ], 
    'default_voucher' => [
        'publicidad' => true,
        'saldo' => true,
        'contenido' => '[{"id": "imagen1", "link": "", "index": "content_1", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-18072020/img-banner-beneficio.jpg", "nombre": "Fila de una sola imagen", "unique": 1, "utm_term": "", "utm_medium": "", "utm_source": "", "utm_content": "", "utm_campaign": ""}, {"id": "imagen1", "link": "https://www.smiles.com.ar/promo/compra-de-millas", "index": "content_6", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-14052020/img-voucher-beneficio.gif", "nombre": "Fila de una sola imagen", "unique": 6}, {"id": "separador1", "index": "content_10", "input": "10", "nombre": "Separador Horizontal", "unique": 10}, {"id": "imagen1", "link": "", "index": "content_7", "input": "https://smiles-mkt-ar.s3.amazonaws.com/Emkt-14052020/img-esquema.gif", "nombre": "Fila de una sola imagen", "unique": 7}, {"id": "separador1", "index": "content_8", "input": 30, "nombre": "Separador Horizontal", "unique": 8}, {"id": "contenido_predefinido", "index": "content_11", "input": "", "nombre": "Contenido predefinido", "unique": 11, "predefinido": 6}, {"id": "separador1", "index": "content_9", "input": 30, "nombre": "Separador Horizontal", "unique": 9}]',
        'legales'=> '"{\"legales\":\"1\",\"legales_custom\":\"\"}"',
        'footer'=> '"{\"footer\":\"4\",\"redes\":\"3\"}"'
    ], 
    'default_template_libre' => [
        'publicidad' => true,
        'saldo' => true,
        'contenido' => '',
        'legales'=> '"{\"legales\":\"1\",\"legales_custom\":\"\"}"',
        'footer'=> '"{\"footer\":\"4\",\"redes\":\"3\"}"'
    ]
];