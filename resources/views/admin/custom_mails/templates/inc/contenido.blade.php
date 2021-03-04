@foreach($contenido as $item)
	@if($item->id == 'textolibre')
		<!-- imagen 1 columna -->
		<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" width="600" align="center">
			<tr>
				<td width="600" align="center" class="full-width"></td>
			</tr>
			<tr>
				<td width="600" class="full-width" align="center">
					<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;" class="full-width" width="600" align="center">
						<tr>
							<td width="600" class="full-width" align="center" style="color:rgb(0,0,0);background:rgb(255,255,255);font-family:arial;font-size:13px;line-height:15px;mso-line-height-rule:exactly;text-align:center;">
								{!! $item->input !!}
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<!-- END imagen 1 columna -->
	@endif

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

	@if($item->id == 'imagen1')
		<!-- imagen 1 columna -->
		<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" width="600" align="center">
			<tr>
				<td width="600" align="center" class="full-width"></td>
			</tr>
			<tr>
				<td width="600" class="full-width" align="center">
					<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;" class="full-width" width="600" align="center">
						<tr>
							<td width="600" class="full-width" align="center">
								
								@if(property_exists($item, 'link'))
								<a style="color:#7c7c7c" 
								href="{!! $item->link !!}?
								utm_source={!! $item->utm_source !!}&amp;
								utm_medium={!! $item->utm_medium !!}&amp;
								utm_campaign={!! $item->utm_campaign !!}&amp;
								utm_content={!! $item->utm_content !!}&amp;
								utm_term={!! $item->utm_term !!}" target="_blank">
									<img src="{!! $item->input !!}" width="600" class="full-width" border="0" style="display:block; max-width: 100%;">
								</a>
								@else
								<div style="padding: 0 0;"><img src="{!! $item->input !!}" border="0" width="600px;" >
      							</div>
      							@endif
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<!-- END imagen 1 columna -->
	@endif

	@if($item->id == 'imagen2')
		<table bgcolor="#FFFFFF" width="600" style="background-color:#ffffff" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tbody>
		    <tr>
		      <td bgcolor="#FFFFFF">
		      	<a style="color:#7c7c7c" 
								href="{!! $item->link !!}?
								utm_source={!! $item->utm_source !!}&amp;
								utm_medium={!! $item->utm_medium !!}&amp;
								utm_campaign={!! $item->utm_campaign !!}&amp;
								utm_content={!! $item->utm_content !!}&amp;
								utm_term={!! $item->utm_term !!}" target="_blank">
		      		<img src="{!! $item->input !!}" width="300" border="0" style="display:block;max-width:100%"></a>
		      	</td>
				
		      <td bgcolor="#FFFFFF">
		      	<a style="color:#7c7c7c" 
								href="{!! $item->link2 !!}?
								utm_source={!! $item->utm_source2 !!}&amp;
								utm_medium={!! $item->utm_medium2 !!}&amp;
								utm_campaign={!! $item->utm_campaign2 !!}&amp;
								utm_content={!! $item->utm_content2 !!}&amp;
								utm_term={!! $item->utm_term2 !!}" target="_blank">
		      		<img src="{!! $item->input2 !!}" width="300" border="0" style="display:block;max-width:100%">
		      	</a>
		      </td>
		    </tr>
		  </tbody>
		</table>
	@endif

	@if($item->id == 'separador1')
		<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" width="600" class="full-width" align="center">
			<tr>
				<td width="600">
					<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff; margin:0 auto;" class="full-width" align="center">
						<tr>
							<td height="30" style="line-height: 0px; font-size: 0px;">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	@endif

	@if($item->id == 'contenido_predefinido')
		{!! $item->contenidohtml !!}
	@endif
	
@endforeach