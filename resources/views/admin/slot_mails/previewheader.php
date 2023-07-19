<!-- MAIL PREVIEW -->
<div class="form-group col-sm-12"><h1 class="w-100 text-center">(% selectedItem.nombre %)</h1></div>
<div class="form-group col-sm-12">
  <div class="box box-default">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div style="margin:0;padding:0">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color:#e0e0e0">
              <tbody>
                <tr>
                  <td>
                    <table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;margin:0 auto" width="600" align="center">
                      <tbody>
                        <tr>
                          <td valign="top" width="600" height="29" style="color:#ffffff;font-family:arial;font-size:1px;line-height:3px;text-align:center;width:600px;height:3px">Comunicado Smiles Argentina.</td>
                        </tr>
                        <tr>
                          <td style="text-align:center;font-size:0">
                            <div style="display:inline-block;vertical-align:top">
                              <table align="center" width="600" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                  <tr>
                                    <td width="24" height="10" style="font-size:0px;height:10px;line-height:0px">&nbsp;</td>
                                    <td height="10" style="font-size:0px;height:10px;line-height:0px">&nbsp;</td>
                                    <td height="10" style="font-size:0px;height:10px;line-height:0px">&nbsp;</td>
                                    <td width="21" height="10" style="font-size:0px;height:10px;line-height:0px">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="10" style="font-size:0px;height:10px;line-height:0px">&nbsp;</td>
                                    <td align="left" width="276" style="font-family:Arial,Helvetica,sans-serif;color:#828484;font-size:11px;text-align:LEFT"> <span v-if="selectedItem.publicidad">PUBLICIDAD</span>
                                    </td>
                                    <td align="center" width="279" style="font-family:Arial,Helvetica,sans-serif;color:#828484;font-size:11px;text-align:right">
                                      <a href="http://$prefilledform(campaignname())$" style="color:#868a8d" target="_blank">VER EN EL NAVEGADOR</a>.</td>
                                    <td height="10" style="font-size:0px;height:10px;line-height:0px">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="10" style="font-size:0px;height:10px;line-height:0px">&nbsp;</td>
                                    <td height="10" style="font-size:0px;height:10px;line-height:0px">&nbsp;</td>
                                    <td height="10" style="font-size:0px;height:10px;line-height:0px">&nbsp;</td>
                                    <td height="10" style="font-size:0px;height:10px;line-height:0px">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td valign="top" width="600" height="84" style="padding:0;width:600px;height:84px;border-bottom:2px solid rgb(236,236,236)">
                            <table cellspacing="0" cellpadding="0" align="center">
                              <tbody>
                                <tr>
                                  <td valign="top" width="27" height="84" style="padding:0;width:27px;height:84px;background:rgb(255,255,255)">
                                  </td>
                                  <td width="131" height="84" bgcolor="#ffffff"><img src="https://smiles-mkt.s3.amazonaws.com/logo_frase.png" border="0" alt="Smiles" style="display:block;margin:auto"></td>
                                  <td valign="top" width="423" height="84" style="color:rgb(240,240,240);background:rgb(255,255,255);font-family:arial;font-size:13px;line-height:15px;text-align:right;width:423px;height:84px">
                                    <span style="color:#f07b00;font-weight:bold">Hola, $cond(eq(1, empty(lookup(PRI_NOME))), nothing(), firstname(lookup(PRI_NOME)))$ ;)</span><br>
                                    <span style="color:#828484;font-size:11px"> Número Smiles:  <span style="color:#4599e4;font-weight:bold">$cond(eq(1, empty(lookup(CUSTOMER_ID_))), nothing(), lookup(CUSTOMER_ID_))$  </span></span>
                                    <br>
                                    <span v-if="selectedItem.saldo" style="color:#828484;font-size:11px">  Saldo: <b>$cond(eq(1, empty(lookup(DT_PROCESS_SALDO)<wbr>)),nothing (),lookup(DT_PROCESS_SALDO))$: </b> <span style="color:#4599e4;font-weight:bold"> $cond(eq(1, empty(lookup(Saldo_Pontos))), nothing(), numberformat(lookup(Saldo_<wbr>Pontos),1.0f,1,0,de))$</span></span>
                                    <br>
                                    <a href="https://www.smiles.com.ar/login" style="color:#828484;font-family:Tahoma,Arial,Helvetica,sans-serif;font-size:11px;line-height:13px" target="_blank">Entrar a mi cuenta</a>
                                  </td>
                                  <td valign="top" width="19" height="84" style="padding:0;width:19px;height:84px;background:rgb(255,255,255)"></td>
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
                    <table border="0" cellpadding="0" cellspacing="0" style="background-color:#e2e2e2;margin:0 auto" width="600" align="center">
                      <tbody>
                        <tr>
                          <td width="600" height="10" style="height:10px;font-size:0px">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>