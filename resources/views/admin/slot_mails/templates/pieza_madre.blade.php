<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta charset="utf-8">
    <title>Smiles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="/dtagent634_23hjprtx_1034.js"
        data-dtconfig="rid=RID_1487864261|rpid=2060065574|domain=smiles.com.br|rt=100|tp=500,50,3,1,10|reportUrl=dynaTraceMonitor"></script>

    <style type="text/css">
        .dataSaldoHeader a {
            color: #828484;
            text-decoration: none;
        }

        .dataHeader a {
            color: #555555;
            text-decoration: none;
        }

        .dataReferentes a {
            color: #828484;
            text-decoration: none;
        }

        .dataExpiracao a {
            color: #ff7119;
            text-decoration: none;
        }

        .applelinkFooter a {
            color: #7c7c7c;
            text-decoration: none;
        }

        @media screen and (max-width: 600px) {
            .full-width {
                width: 100% !important;
            }

            .img-responsive {
                width: 100% !important;
                height: auto !important;
            }

            .text-center {
                text-align: center !important;
            }
        }

        .mobile-only {
            display: none;
        }

        img {
            border: 0 none;
        }

        @media screen and (max-width:480px) {
            .txt-480 {
                font-size: 16px !important;
            }

            .margen-box {
                width: 95% !important;
            }

            .width-foto {
                width: 97% !important;
                image-rendering: -webkit-optimize-contrast;
            }

            .logo-gris {
                width: 33% !important;
                image-rendering: -webkit-optimize-contrast;
                text-align: center !important;
                margin: auto !important;
                padding-left: 0px !important;
            }

            .ancho-div-1 {
                width: 97% !important;
                margin: auto !important;
                text-align: center !important;
                padding-left: 2% !important;
                padding-right: 2% !important;
            }

            .txt-aling {
                text-align: center !important;
            }

            .centrar {
                margin: auto !important;
                padding-bottom: 7%;
            }
        }

        @media only screen and (max-width:480px) {
            table[class="mobile-only"] {
                display: block !important;
                text-align: center !important;
                overflow: visible !important;
                float: none !important;
                line-height: 100% !important;
            }
        }
    </style>
</head>

<body style="margin:0; padding:0;">

    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color:#e0e0e0;">
        <tr>
            <td>
                <!-- PUBLICIDAD / VER NAVEGADOR-->
                <table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;"
                    class="full-width" width="600" align="center">
                    <tr>
                        <td valign="top" width="600" height="29"
                            style="color:#ffffff;font-family:arial;font-size:1px;line-height:3px;mso-line-height-rule:exactly;text-align:center;width:600px;height:3px">
                            Gracias por estos 6 meses en Club Smiles</td>
                    </tr>
                    <tr>
                        <td style="text-align:center; font-size:0;">
                            <div style="display:inline-block; vertical-align:top;">
                                <table align="center" width="600" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td width="24" height="10" style="font-size:0px; height:10px; line-height: 0px">
                                            &nbsp;</td>
                                        <td height="10" style="font-size:0px; height:10px; line-height: 0px">&nbsp;</td>
                                        <td height="10" style="font-size:0px; height:10px; line-height: 0px">&nbsp;</td>
                                        <td width="21" height="10" style="font-size:0px; height:10px; line-height: 0px">
                                            &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="10" style="font-size:0px; height:10px; line-height: 0px">&nbsp;</td>
                                        <td align="left" width="276" class="full-width"
                                            style="font-family: Arial, Helvetica, sans-serif; color: #828484; font-size: 11px; text-align: LEFT;">
                                            @if($publicidad)PUBLICIDAD @endif </td>
                                        <td align="center" width="279" class="full-width"
                                            style="font-family: Arial, Helvetica, sans-serif; color: #828484; font-size: 11px; text-align: right;">
                                            <a href="${form(campaign.name,{'usedb',true})}" target="_blank"
                                                style="color: #868a8d;">VER EN EL NAVEGADOR</a>.
                                        </td>
                                        <td height="10" style="font-size:0px; height:10px; line-height: 0px">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td height="10" style="font-size:0px; height:10px; line-height: 0px">&nbsp;</td>
                                        <td height="10" style="font-size:0px; height:10px; line-height: 0px">&nbsp;</td>
                                        <td height="10" style="font-size:0px; height:10px; line-height: 0px">&nbsp;</td>
                                        <td height="10" style="font-size:0px; height:10px; line-height: 0px">&nbsp;</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- FIN PUBLICIDAD / VER NAVEGADOR-->
                
                @if(isset($export) && $export)
                    <table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;"
                        class="full-width" width="600" align="center">
                        <tr>
                            <td width="600" align="center" class="full-width"></td>
                        </tr>
                        <tr>
                            <td valign='top' align='center' width='600' style='text-align:center;width:600px'>
                                <#setting locale="es_ar">
                                    <#include "cms://contentlibrary/argentina/headers/header_rpl_padrao_ar.htm">
                            </td>
                        </tr>
                        <tr>
                            <td width="600">
                                <table
                                    border="0"
                                    cellpadding="0"
                                    cellspacing="0"
                                    style="
                                        background-color: #ffffff;
                                        margin: 0 auto;
                                    "
                                    class="full-width"
                                    align="center"
                                >
                                    <tr>
                                        <td
                                            height="10"
                                            style="
                                                line-height: 0px;
                                                font-size: 0px;
                                            "
                                        >
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="600" align="center" class="full-width"></td>
                        </tr>
                        <tr>
                            <td data-content-region-name="Region2" width="600" class="full-width" align="center"><span
                                    style="color: rgb(29, 28, 29); font-family: Slack-Lato, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: rgb(255, 255, 255);">CONTENT_REGION_|SLOT_TARJA_SUSPENSO|</span>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="full-width"
                                    style="background-color:#ffffff;" width="600">
                                    <tbody>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    
                    <table border="0" cellpadding="0" cellspacing="0" style="background-color: #ffffff; margin: 0 auto" width="600" class="full-width" align="center">
                        <tbody><tr>
                            <td width="600">
                                <table border="0" cellpadding="0" cellspacing="0" style="
                                        background-color: #ffffff;
                                        margin: 0 auto;
                                    " class="full-width" align="center">
                                    <tbody><tr>
                                        <td height="10" style="
                                                line-height: 0px;
                                                font-size: 0px;
                                            ">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                @else

                    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td valign="top" width="600" height="84" style="padding: 0; width: 600px; height: 84px; border-bottom: 2px solid rgb(236, 236, 236);">
                                    <table cellspacing="0" cellpadding="0" align="center">
                                        <tr>
                                            <td valign="top" width="27" height="84" style="padding: 0; width: 27px; height: 84px; background: rgb(255, 255, 255);"></td>
                                            <td width="131" height="84" bgcolor="#ffffff" style="padding:0;width:131px;height:auto; bac">
                                                <img class="full-width" src="https://smiles-mkt.s3.amazonaws.com/logo_frase.png" border="0" alt="Smiles" style="display: block; margin: auto;" />
                                            </td>
                                            <td
                                                valign="top"
                                                width="423"
                                                height="84"
                                                style="color: rgb(240, 240, 240); background: rgb(255, 255, 255); font-family: arial; font-size: 13px; line-height: 15px; mso-line-height-rule: exactly; text-align: right; width: 423px; height: 84px;"
                                            >
                                                <span style="color: #f07b00; font-weight: bold;">Hola, $cond(eq(1, empty(lookup(PRI_NOME))), nothing(), firstname(lookup(PRI_NOME)))$ ;) </span><br />
                                                <span style="color: #828484; font-size: 11px;"> N&uacute;mero Smiles: <span style="color: #4599e4; font-weight: bold;">$cond(eq(1, empty(lookup(CUSTOMER_ID_))), nothing(), lookup(CUSTOMER_ID_))$ </span></span>
                    
                                                @if($saldo)
                                                <br />
                                                <span style="color: #828484; font-size: 11px;">
                                                    Saldo: <b>$cond(eq(1, empty(lookup(DT_PROCESS_SALDO))),nothing (),lookup(DT_PROCESS_SALDO))$: </b>
                                                    <span style="color: #4599e4; font-weight: bold;"> $cond(eq(1, empty(lookup(Saldo_Pontos))), nothing(), numberformat(lookup(Saldo_Pontos),1.0f,1,0,de))$ </span>
                                                </span>
                                                @endif
                                                <br />
                    
                                                <a
                                                    href="https://www.smiles.com.ar/login/?utm_source=newsletter&utm_medium=email&utm_campaign=transferencia_17072020&utm_content=header-micuenta"
                                                    style="color: #828484; font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: 11px; line-height: 13px;"
                                                    target="_blank"
                                                    rilt="Conta_Smiles"
                                                >
                                                    Entrar a mi cuenta
                                                </a>
                                            </td>
                    
                                            <td valign="top" width="19" height="84" style="padding: 0; width: 19px; height: 84px; background: rgb(255, 255, 255);"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                
                    @if ($tarj_susp)
                        {!!$tarj_susp !!}
                    @endif

                @endif



                @if(isset($export) && $export)
                <table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" width="600" align="center">
                    <tbody><tr>
                        <td width="600" align="center" class="full-width"></td>
                    </tr>
                    <tr>
                        <td data-content-region-name="Region1" width="600" class="full-width" align="center"><span style="color: rgb(29, 28, 29); font-family: Slack-Lato, appleLogo, sans-serif; font-size: 15px; font-variant-ligatures: common-ligatures; background-color: rgb(255, 255, 255);">CONTENT_REGION_|SLOT_CONTEUDO|</span>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="full-width" style="background-color:#ffffff;" width="600">
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody></table>                
                @endif

                <!-- END top -->
                @if(isset($export) && !$export)
                    @include('admin.slot_mails.templates.inc.contenido',[
                            'contenido' => $contenido
                    ])
                @else
                    <!-- VACIO 1-->
                    <table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" width="600" class="full-width" align="center">
                        <tbody><tr>
                            <td width="600">
                                <table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" align="center">
                                    <tbody><tr>
                                        <td height="20" style="line-height: 0px; font-size: 0px;">&nbsp;</td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                    <!-- FIN VACIO 1-->
                    <!-- VACIO 2-->
                    <table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" width="600" align="center">
                        <tbody><tr>
                            <td width="600" align="center" class="full-width"></td>
                        </tr>
                        <tr>
                            <td width="600" class="full-width" align="center">
                                <table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;" class="full-width" width="600" align="center">
                                    <tbody><tr>
                                        <td width="600" class="full-width" align="center">

                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                    <!-- FIN VACIO 2-->                
                @endif


                {!! ($footer) !!}
                {!! ($redes) !!}
                
                @if(isset($export) && $export)
                    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td data-content-region-name="Region3" valign="top" width="570" align="center" style="padding:0;width:570px;font-size:12px;line-height:16px;font-family:arial;mso-line-height-rule:exactly;color:#7C7C7C;text-align:center;padding-top:15px">
                                    CONTENT_REGION_|TJ_01|
                                </td>
                            </tr>

                        </tbody>
                    </table>                
                @else
                    @if ($legales_custom != '')
                    <table border="0" cellpadding="0" cellspacing="0" style="background-color:#e3e3e3;margin:0 auto" width="600" align="center">
                        <tbody>
                            <tr>
                                <td>
                                    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td valign="top" style="color: rgb(133, 139, 142); background: rgb(227, 227, 227); font-family: arial; font-size: 10px; line-height: 12px; text-align: left; width: 575px; height: 23px;"><br> {!! ($legales_custom) !!} </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif                
                @endif



				{!! ($legaleshtml) !!}

                <table style="background-color: #7c7c7c; margin: 0 auto;" border="0" width="600" cellspacing="0" cellpadding="0" align="center">
                    <tbody>
                        <tr>
                            <td>
                                <table border="0" width="600" cellspacing="0" cellpadding="0" align="center">
                                    <tbody>
                                        <tr>
            
                                        </tr>
                                        <tr>
                                            <td style="color: #858b8e; background: #e3e3e3; font-family: arial; font-size: 10px; line-height: 12px; text-align: center; width: 575px; height: 23px;" valign="top"><br><br>Smiles respeta tu privacidad, y está en contra del
                                                spam en internet. <br><br><a style="color: #868a8d;" href=" ${form('OPTOUT_OPTDOWN_AR_V1', 'customer_id_')}" target="_blank" rel="noopener">Desuscribirte </a>| <a style="color: #868a8d;" href=" ${form('OPTOUT_OPTDOWN_AR_V1', 'customer_id_')}" target="_blank" rel="noopener"> Opciones de subscripción</a> <br><br></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>                
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" style="background-color:#e2e2e2; margin:0 auto;" class="full-width" width="600" align="center">
					<tr>
						<td width="600" class="full-width" height="10" style="height:10px; font-size:0px;">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>