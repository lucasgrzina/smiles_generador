@if (isset($export) && $export)
<html>
    <head>
        <meta charset="utf-8" />
        <title>Smiles</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script type="text/javascript" src="/dtagent634_23hjprtx_1034.js" data-dtconfig="rid=RID_1487864261|rpid=2060065574|domain=smiles.com.br|rt=100|tp=500,50,3,1,10|reportUrl=dynaTraceMonitor"></script>

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

            @media screen and (max-width: 480px) {
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

            @media only screen and (max-width: 480px) {
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
	


    <body style="margin: 0; padding: 0;">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color: #e0e0e0;">
            <tbody>
                <tr>
                    <td>
@endif


<div  v-for="contenidosList in ordenarContenidosGrupos(_data.selectedItem.contenidos)">
	<div v-if="contenidosList.activo">
		
		
		<div v-for="contenidoTemplate in JSON.parse(contenidosList.contenido)">
			
			<!-- Texto libre -->
			<table v-if="contenidoTemplate.id == 'textolibre'" border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" width="600" align="center">
				<tr>
					<td width="600" align="center" class="full-width"></td>
				</tr>
				<tr>
					<td width="600" class="full-width" align="center">
						<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;" class="full-width" width="600" align="center">
							<tr>
								<td width="600" class="full-width" align="center" style="color:rgb(0,0,0);background:rgb(255,255,255);font-family:arial;font-size:13px;line-height:15px;mso-line-height-rule:exactly;text-align:center;">
									<div v-html="contenidoTemplate.input"></div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<!-- End Texto libre -->

			<!-- imagen 1 columna -->
			<table v-if="contenidoTemplate.id == 'imagen1'" border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" width="600" align="center">
				<tr>
					<td width="600" align="center" class="full-width"></td>
				</tr>
				<tr>
					<td width="600" class="full-width" align="center">
						<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;" class="full-width" width="600" align="center">
							<tr>
								<td width="600" class="full-width" align="center">
									
								
										
									<a v-if="contenidoTemplate.haslink == true"
										style="color:#7c7c7c"
										:href="contenidoTemplate.link"
										target="_blank"
										width="600"
										class="full-width"
										border="0"
										style="display:block; max-width: 100%;"
									>
										<img :src="contenidoTemplate.input" width="600" class="full-width" border="0" style="display:block; max-width: 100%;" />
									</a>
									
									
									<div v-else style="padding: 0 0;"><img :src="contenidoTemplate.input" border="0" width="600px;" ></div>
									
									
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<!-- END imagen 1 columna -->

			<!-- imagen 2 -->
			<table v-if="contenidoTemplate.id == 'imagen2'" bgcolor="#FFFFFF" width="600" style="background-color:#ffffff" border="0" align="center" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
					<td bgcolor="#FFFFFF">
						<a v-if="contenidoTemplate.haslink == true"
										style="color:#7c7c7c"
										:href="contenidoTemplate.link"
										target="_blank"
										width="600"
										class="full-width"
										border="0"
										style="display:block; max-width: 100%;"
									>
										<img :src="contenidoTemplate.input" width="300" class="full-width" border="0" style="display:block; max-width: 100%;" />
						</a>
						<div v-else style="padding: 0 0;"><img :src="contenidoTemplate.input" border="0" width="300px;" ></div>	
						</td>					
						<td bgcolor="#FFFFFF">
						<a v-if="contenidoTemplate.haslink2 == true"
										style="color:#7c7c7c"
										:href="contenidoTemplate.link2"
										target="_blank"
										width="600"
										class="full-width"
										border="0"
										style="display:block; max-width: 100%;"
									>
										<img :src="contenidoTemplate.input2" width="300" class="full-width" border="0" style="display:block; max-width: 100%;" />
						</a>
						<div v-else style="padding: 0 0;"><img :src="contenidoTemplate.input2" border="0" width="300px;" ></div>	
						</td>
					</tr>
				</tbody>
				</table>

			<!-- END imagen 2 -->
			<!-- contenido_predefinido -->
			<div v-if="contenidoTemplate.id == 'contenido_predefinido'" v-html="contenidoTemplate.contenidohtml">
			
			</div>
			<!-- END contenido_predefinido -->

			<!-- separador1 -->
			<table v-if="contenidoTemplate.id == 'separador1'" border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" width="600" class="full-width" align="center">
				<tr>
					<td width="600">
						<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" align="center">
							<tr>
								
								<td v-if="contenidoTemplate.input != ''" :height="contenidoTemplate.input" style="line-height: 0px; font-size: 0px;">&nbsp;</td>
								
								<td v-else height="30" style="line-height: 0px; font-size: 0px;">&nbsp;</td>
								
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<!-- end separador1 -->

			<!-- textoplano -->
			<div v-if="contenidoTemplate.id == 'textoplano'">
			<table  border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" width="600" align="center">
				<tbody>
					<tr>
						<td width="600">
							<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" align="center">
								<tbody>
									<tr>
										<td height="40" style="line-height:0px;font-size:0px">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" width="600" align="center">
				<tbody>
					<tr>
						<td>
							<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" width="560" align="center">
								<tbody>
									<tr>
										<td style="text-align:center;font-size:0">
											<div style="display:inline-block;vertical-align:top;width:100%">
												<table align="center" width="560" cellspacing="0" cellpadding="0" border="0">
													<tbody>
														<tr>
															<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:18px;color:#7c7c7c;text-align:left">
																<table width="560" cellspacing="0" cellpadding="0" border="0">
																	<tbody>
																		<tr>
																			<td width="3%" bgcolor="#ffffff" style="background-color:#ffffff">&nbsp;</td>
																			<td width="90%" align="left" valign="top" bgcolor="#ffffff" style="text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:15px;line-height:20px;color:#555555">
																				<div style="margin:auto;font-family:Arial,Helvetica,sans-serif;width:100%">
																					<span style="color:#7c7c7c" v-html="contenidoTemplate.input"></span>
																				</div>
																			</td>
																			<td width="3%" bgcolor="#ffffff" style="background-color:#ffffff">&nbsp;</td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" width="600" align="center">
				<tbody>
					<tr>
						<td width="600">
							<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" align="center">
								<tbody>
									<tr>
										<td height="40" style="line-height:0px;font-size:0px">
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			</div>
			<!-- end textoplano -->

		</div>
	</div>
</div>









	

<div style="display:none;">

@foreach($contenido as $item)

	

	@if($item->id == 'textoplano')
	<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" width="600" align="center">
		<tbody>
			<tr>
				<td width="600">
					<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" align="center">
						<tbody>
							<tr>
								<td height="40" style="line-height:0px;font-size:0px">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" width="600" align="center">
		<tbody>
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" width="560" align="center">
						<tbody>
							<tr>
								<td style="text-align:center;font-size:0">
									<div style="display:inline-block;vertical-align:top;width:100%">
										<table align="center" width="560" cellspacing="0" cellpadding="0" border="0">
											<tbody>
												<tr>
													<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:18px;color:#7c7c7c;text-align:left">
														<table width="560" cellspacing="0" cellpadding="0" border="0">
															<tbody>
																<tr>
																	<td width="3%" bgcolor="#ffffff" style="background-color:#ffffff">&nbsp;</td>
																	<td width="90%" align="left" valign="top" bgcolor="#ffffff" style="text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:15px;line-height:20px;color:#555555">
																		<div style="margin:auto;font-family:Arial,Helvetica,sans-serif;width:100%">
																			<span style="color:#7c7c7c">{!! $item->input !!}</span>
																		</div>
																	</td>
																	<td width="3%" bgcolor="#ffffff" style="background-color:#ffffff">&nbsp;</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" width="600" align="center">
		<tbody>
			<tr>
				<td width="600">
					<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" align="center">
						<tbody>
							<tr>
								<td height="40" style="line-height:0px;font-size:0px">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	@endif
	
	
@endforeach

		</div>
@if (isset($export) && $export)						
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
@endif