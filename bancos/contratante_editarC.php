<?php  include("../../conexaoI.php"); 

$pegar_ip = $_SERVER["REMOTE_ADDR"];
  $consultalog = "INSERT acessolog (ip,login,arquivo,datahora)values('$pegar_ip','".$_SESSION['session_login']."','gerencial/contratante_editarC',CURRENT_TIMESTAMP)";
  $executa = mysqli_query($mysqli, $consultalog) or die(mysqli_error($mysqli));
  

  if($_SESSION['session_log'] != 'S' ) {
  echo "Seu login Expirou!!! Efetue o Login Novamente.";
  exit();
}

$id = $_GET["id"];
$i = "0";
$vlrEvitado = "0";
$vlrAprovado = "0";
$taxaprazo = "0";
$vlrCancelado = "0";
$taxavista = "0";
$_viscob = "0";
$codbairro = "0";
$taxavista = "0";
$taxavista7 = "0";
$_base = "";
$_link = "";


//************************************************************************************
//VERSAO 1.0
//ULTIMA ALTERA��O: 06/05/2015
//USUARIO: ROBSON
//************************************************************************************

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Creditall </title>
<script>
function exclui_equipamento(idexcluir,nome) {
      if(confirm('Deseja realmente excluir o equipamento '+nome ))
       {
		carregaAjaxRua('equipamentos','equipamentos.php?acao=e&id='+ document.form1.cnpj.value+'&equipamento='+ idexcluir);         
       }
}


function exclui_filial(idexcluir,nome) {
 
      if(confirm('Deseja realmente excluir a filial '+nome ))
       {
  
		 carregaAjaxRua('filial','filial.php?acao=e&cnpj='+ idexcluir);
         
       }
}

function exclui(id,nome,lg) {
      if(confirm('Deseja realmente excluir '+nome+' do contratante' ))
       {

		 carregaAjaxRua('filial','acaocontratante_ligacao.php?login='+lg+'&id='+id);
       }
}

function adicionar(id,nome) {
      var lg  = document.form1.cod_login.value;
		 carregaAjaxRua('filial','acaocontratante_ligacao.php?login='+id+'&login_filial='+lg);
      }

function selecionar() { 
	var indexSelect = document.getElementById("cmb_contratante").selectedIndex;
	var valueSelected = form1.cmb_contratante.options[indexSelect].value;
	document.form1.cod_login.value = valueSelected;
}

function selecionar2() { 
	document.form1.cmb_contratante.value   = document.form1.cod_login.value;
}


 function mascaraTexto(evento, tipo){  

      if (tipo ==  1) { 
var	  mascara = "999.999.999-99";
  document.getElementById('cpf').maxLength = 14;
if (document.form1.cpf.value.length==14) {
	 document.form1.nome.focus();
}
	  } 
	  if (tipo == 2) { 
	var    mascara = "99.999.999/9999-99";
	document.getElementById('cnpj').maxLength = 18;
	if (document.form1.cnpj.value.length==18) {
	 document.form1.razao_social.focus();
}
	  }
	
 if (tipo == 10) { 
	var    mascara = "99.999.999/9999-99";
	document.getElementById('cnpj').maxLength = 18;
	if (document.form1.cnpjf.value.length==18) {
	 document.form1.fantasiaf.focus();
}
	  }
	     if (tipo == 3) { 
			var    mascara = "9999-9999";
			if (document.form1.fone_comercial.value.length==9) {	
			 document.form1.ddd_fax.focus();
	  		}
		  }
		  
		  
 if (tipo == 4) { 
		var    mascara = "99.999-999";
		if (document.form1.cep.value.length==10) {
		 document.form1.estado.focus();
			}
	 }
	  
	  if (tipo == 11) { 
		var    mascara = "99.999-999";
		if (document.form1.cepf.value.length==10) {
		 document.form1.cidadef.focus();
			}
	 }
	  
     if (tipo == 5) { 
			var    mascara = "9999-9999";
			if (document.form1.fone_fax.value.length==9) {	
			 document.form1.ddd_celular.focus();
	  		}
		  }	  
	
	if (tipo == 12) { 
			var    mascara = "9999-9999";
			if (document.form1.telefonef.value.length==9) {	
			 document.form1.ruaf.focus();
	  		}
		  }	  	  
	   if (tipo == 6) { 
			var    mascara = "9999-9999";
			if (document.form1.fone_celular.value.length==9) {	
			 document.form1.email.focus();
	  		}
		  }	  
		  if (tipo == 13) { 
	var    mascara = "99/99/9999";
	  }
	  
    var campo, valor, i, tam, caracter;  
      
    if (document.all) // Internet Explorer  
       campo = evento.srcElement;  
    else // Nestcape, Mozzila  
        campo= evento.target;  
          
    valor = campo.value;  
    tam = valor.length;  
      
    for(i=0;i<mascara.length;i++){  
       caracter = mascara.charAt(i);  
       if(caracter!="9")   
          if(i<tam & caracter!=valor.charAt(i))  
             campo.value = valor.substring(0,i) + caracter + valor.substring(i,tam);  
    }  
   
 }  
 
//M?SCARA DE VALORES

function txtBoxFormat(objeto, sMask, evtKeyPress) {
    var i, nCount, sValue, fldLen, mskLen,bolMask, sCod, nTecla;


if(document.all) { // Internet Explorer
    nTecla = evtKeyPress.keyCode;
} else if(document.layers) { // Nestcape
    nTecla = evtKeyPress.which;
} else {
    nTecla = evtKeyPress.which;
    if (nTecla == 8) {
        return true;
    }
}

    sValue = objeto.value;

    // Limpa todos os caracteres de formata&ccedil;&atilde;o que
    // j? estiverem no campo.
    sValue = sValue.toString().replace( "-", "" );
    sValue = sValue.toString().replace( "-", "" );
    sValue = sValue.toString().replace( ".", "" );
    sValue = sValue.toString().replace( ".", "" );
    sValue = sValue.toString().replace( "/", "" );
    sValue = sValue.toString().replace( "/", "" );
    sValue = sValue.toString().replace( ":", "" );
    sValue = sValue.toString().replace( ":", "" );
    sValue = sValue.toString().replace( "(", "" );
    sValue = sValue.toString().replace( "(", "" );
    sValue = sValue.toString().replace( ")", "" );
    sValue = sValue.toString().replace( ")", "" );
    sValue = sValue.toString().replace( " ", "" );
    sValue = sValue.toString().replace( " ", "" );
    fldLen = sValue.length;
    mskLen = sMask.length;

    i = 0;
    nCount = 0;
    sCod = "";
    mskLen = fldLen;

    while (i <= mskLen) {
      bolMask = ((sMask.charAt(i) == "-") || (sMask.charAt(i) == ".") || (sMask.charAt(i) == "/") || (sMask.charAt(i) == ":"))
      bolMask = bolMask || ((sMask.charAt(i) == "(") || (sMask.charAt(i) == ")") || (sMask.charAt(i) == " "))

      if (bolMask) {
        sCod += sMask.charAt(i);
        mskLen++; }
      else {
        sCod += sValue.charAt(nCount);
        nCount++;
      }

      i++;
    }

    objeto.value = sCod;

    if (nTecla != 8) { // backspace
      if (sMask.charAt(i-1) == "9") { // apenas n?meros...
        return ((nTecla > 47) && (nTecla < 58)); }
      else { // qualquer caracter...
        return true;
      }
    }
    else {
      return true;
    }
  }
  
  
//Formata n�mero tipo moeda usando o evento onKeyDown

function Formata(campo,tammax,teclapres,decimal) {
var tecla = teclapres.keyCode;
vr = Limpar(campo.value,"0123456789");
tam = vr.length;
dec=decimal

if (tam < tammax && tecla != 8){ tam = vr.length + 1 ; }

if (tecla == 8 )
{ tam = tam - 1 ; }

if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 )
{

if ( tam <= dec )
{ campo.value = vr ; }

if ( (tam > dec) && (tam <= 5) ){
campo.value = vr.substr( 0, tam - 2 ) + "," + vr.substr( tam - dec, tam ) ; }
if ( (tam >= 6) && (tam <= 8) ){
campo.value = vr.substr( 0, tam - 5 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; 
}
if ( (tam >= 9) && (tam <= 11) ){
campo.value = vr.substr( 0, tam - 8 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
if ( (tam >= 12) && (tam <= 14) ){
campo.value = vr.substr( 0, tam - 11 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
if ( (tam >= 15) && (tam <= 17) ){
campo.value = vr.substr( 0, tam - 14 ) + "." + vr.substr( tam - 14, 3 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - 2, tam ) ;}
} 

}
 function Limpar(valor, validos) {
// retira caracteres invalidos da string
var result = "";
var aux;
for (var i=0; i < valor.length; i++) {
aux = validos.indexOf(valor.substring(i, i+1));
if (aux>=0) {
result += aux;
}
}
return result;
}

function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58)) return true;
    else{
    if (tecla != 8) return false;
    else return true;
    }
}

function teste(){
alert("aa");

}

</script>

<script src="../js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="../../bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="../../bootstrap/3.2.0/js/collapse.js"></script>

<style>
.btn      {padding: 7px 12px;}
.alert    {padding: 6px;}
.style3   {color: #FFFFFF; font-weight: bold; }
.style4   {color: #000000; font-weight: bold; }
.style5   {color: #000000}
.style7   {font-size: 12px}
.style8   {font-weight: bold}
.style13  {color: #FF6600; font-weight: bold; }
.style14  {font-size: 10px;}
.style104 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; font-weight: bold}
.style105 {color: #FF6600}
.style106 {font-size: 11px; font-weight:bold; text-align:center;}
.style114 {padding:0px; text-align:center;}
.style115 {
	color: #FF0000;
	font-weight: bold;
}
.style116 {color: #FF0000}
.style117 {color: #FFFFFF}
</style>
</head>

<body style="width: 2000px; font-size: 11px; color: #333; font-family: Tahoma, Geneva, sans-serif;">

<?php 
$consulta = "Select * from  usuario where usuario_LOGIN = '".$_SESSION['session_login']."'" ;
$executa = mysqli_query($mysqli, $consulta) or die(mysqli_error($mysqli));

	 while($rstP = mysqli_fetch_array($executa))						
		{
		//permissoes princiapl
		$p101 = $rstP["permissao_contratante_salvar"]; // cadastro de produto
			
		//permissao debito cheque
		$p74 = $rstP["permissao_deb_cheque"];
		
		//permissao debito crediario
		$p75 = $rstP["permissao_deb_crediario"];	
		
		}
		
$consulta = "Select *,contratante.usuario_LOGIN as login , date_format(contrato_datacadastro, '%d/%m/%Y') as dtcadastro,date_format(contrato_dataassinatura, '%d/%m/%Y') as dtassinatura,date_format(contrato_dataassinaturacrediario, '%d/%m/%Y') as dtassinatura2,date_format(contratante_dtcancelamento, '%d/%m/%Y') as dtcancelamento ,date_format(contratante_dtremessa, '%d/%m/%Y') as dtremessa from  contratante left join usuario on contratante_codrepresentante = usuario.usuario_LOGIN where cont_id = '$id'";
$executa = mysqli_query($mysqli, $consulta) or die(mysqli_error($mysqli));

$num_rows = mysqli_num_rows($executa);
if($num_rows!=0)
		{		
		   while($rst = mysqli_fetch_array($executa))						
			{
			$inativo = $rst["contratante_inativo"];
			$liberajuro = $rst["cont_repasseate"];
			$liberajuro_ch = $rst["cont_repasseate_ch"];
			$permissao_aceite = $rst["permissao_aceite"];			
			$loginContratante = $rst['login'];
			$sequencialBoleto = $rst['contratante_sequencia'];
			
			$sequencialRemessa = $rst['cont_sequencial'];
			
	$consultaCont = "SELECT *, date_format(dt_implantacao, '%d/%m/%Y') as dt_implantacao,DATE_FORMAT(contp_DT_VersaoCheque , '%d/%m/%Y') as contp_DT_VersaoCheque, DATE_FORMAT(contp_DT_VersaoCredito , '%d/%m/%Y') as contp_DT_VersaoCredito,DATE_FORMAT(contp_DT_VersaoOutros , '%d/%m/%Y') as contp_DT_VersaoOutros FROM contratante_parametros WHERE contp_login = '".$rst['login']."'";
	$executaCont = mysqli_query($mysqli, $consultaCont) or die(mysqli_error($mysqli));	
		while($rstCont = mysqli_fetch_array($executaCont)){		
					$pontos_atigindo_maximo = $rstCont['contp_quizpontosmaximo'];
					$quiz_libera = $rstCont['cont_quiz_libera'];
					$quiz_liberaCH = $rstCont['cont_quiz_libera_ch'];
					$cont_avistaCreditall = $rstCont['cont_avistaCreditall'];
					$cont_avista7Creditall = $rstCont['cont_avista7Creditall'];
					$cont_prazoCreditall = $rstCont['cont_prazoCreditall'];
					$cont_prazoSeisCreditall = $rstCont['cont_prazoSeisCreditall'];
					$cont_prazoCemCreditall = $rstCont['cont_prazoCemCreditall'];
					$cont_prazoACreditall = $rstCont['cont_prazoACreditall'];
					$conta_prazoBCreditall = $rstCont['conta_prazoBCreditall'];
					$cont_tipoVenda = $rstCont['cont_tipovenda'];
					$cont_tipoVendacr = $rstCont['cont_tipovenda_crediario'];
					$flagBanco = $rstCont['dadosCH_cadastro'];
					$empresa = $rstCont['contp_empresa'];
					$multiplicadormosaico = $rstCont['contratante_multi_mosaicocred'];
					//acesso bases mosaico
					$contp_localizabaseACP = $rstCont['contp_localizabaseACP'];
					$contp_localizabaseSerasa = $rstCont['contp_localizabaseSerasa'];
					$contp_localizabaseBrasil = $rstCont['contp_localizabaseBrasil'];
					$_modcobranca = $rstCont['contp_cobrancamodfat'];
					$_modboletofatura  = $rstCont['contp_boletomodfat'];
					
					//liberacao acesso mosaico
					$contp_mosaicosocio = $rstCont['contp_mosaicosocio']; //socios 
					$contp_antifraude = $rstCont['contp_antifraude']; //antifraude
					$contp_localize = $rstCont['contp_localize']; //localize
					$contp_preanlise = $rstCont['contp_preanlise']; //preanalise
					
					//debitos mosaico
					$contp_localizadebitocpf = $rstCont['contp_localizadebitocpf']; //debito localize cpf
					$contp_localizadebitocnpj = $rstCont['contp_localizadebitocnpj']; //debito localize cnpj
					$contp_debitomosaicoScnpj = $rstCont['contp_debitomosaicoScnpj']; //debito mosaico credito Sintetico cnpj
					$contp_debitomosaicoAcpf = $rstCont['contp_debitomosaicoAcpf']; //debito mosaico credito Analitico cpf
					$contp_debitomosaicoAcnpj = $rstCont['contp_debitomosaicoAcnpj']; //debito mosaico credito analitico cnpj
					$contp_debitoantifraudecpf = $rstCont['contp_debitoantifraudecpf']; // debito antifraude cpf
					$contp_diaspreanalise = $rstCont['contp_diaspreanalise']; // dias para consulta mosaico
					
					$contp_debitoantifraudecnpj = $rstCont['contp_debitoantifraudecnpj']; // debito antifraude cnpj
					$contp_debitosocios = $rstCont['contp_debitosocios']; // socios
					$contp_debitomosaicoSnegado = $rstCont['contp_debitomosaicoSnegado'];
					$contp_debitomosaicoSlimite = $rstCont['contp_debitomosaicoSlimite'];
					$contp_debitomosaicoAnegado = $rstCont['contp_debitomosaicoAnegado'];
					$contp_debitomosaicoAlimite = $rstCont['contp_debitomosaicoAlimite'];
					
					$boleto_imptodos = $rstCont['contratante_boletotudo'];
					$boleto_modboleto= $rstCont['contratante_boletofatura'];
					
				
					$tipoempresa = $rstCont['contp_tipo'];
					$contratofoto = $rstCont['contp_docfoto'];
					$adesaofoto = $rstCont['contp_docAdesaofoto'];
					$visualizatitulo= $rstCont['contp_vizTitulo'];
					$botao_cancela= $rstCont['bot_cancelar'];
				
					$combustivel = $rstCont['contp_combustivel'];
					$gestor = $rstCont['gestor_conta'];
					$juros_carne = $rstCont['juros_carnemostra'];//mostra ou esconde instrucao juros
					
					$preliberaAnalitico =  $rstCont['preliberaAnalitico'];
					
					$base_dados = $rstCont['base_dados'];
					$cont_cobgrafico = $rstCont['cont_cobgrafico'];// permissao grafico cobranca extrato gerencial cliente.
					$cont_asslibera = $rstCont['cont_asslibera'];// permissao se ? protocolo digital ou nao.
					$cont_entrega = $rstCont['cont_entrega'];
					
					$cont_VlrAdParcela = $rstCont['cont_VlrAdParcela']; //valor adicional por parcela
					$razaoboleto= $rstCont['cont_boletorazao']; // impressao boleto
					$cnpjboleto= $rstCont['cont_boletocnpj']; // impressao boleto

				
					//remessa cartao
					$arteCartao = $rstCont['cont_arte'];
		   			$tipoCartao = $rstCont['cont_tipoCartao'];
		   			$envioCartao = $rstCont['cont_envioCartao'];
					$qntdeCartao = $rstCont['cont_qtdeRemessa'];

					//dados contratante
					$conta_contabil_passivo  = $rstCont['conta_contabil_passivo'];
					$conta_contabil_ativo = $rstCont['conta_contabil_ativo'];
					$dt_implantacao = $rstCont['dt_implantacao'];
					$tipo_entrada = $rstCont['tipo_entrada'];
					$capital_social = $rstCont['capital_social'];
					$versao_contrato = $rstCont['versao_contrato'];
					$cont_protoloDigital = $rstCont['cont_protocoloDigital'];
					$cont_LibCompraAnt = $rstCont['contP_liberaDigitalAnt'];
					$cont_LibCompraAnt = $rstCont['contP_liberaDigitalAnt'];
					$modelorepasse = $rstCont['contp_mod_contrato'];
					$pontosFraude = $rstCont['contp_pontosfraude'];
					$pontosFraudeCH = $rstCont['contp_pontosfraudeCH'];
       			
				   $cont_menuNovo = $rstCont['menuNovo'];
				
                   $cont_qrcode = $rstCont['cont_qrcode'];
         		   $cont_doc = $rstCont['qrcodeDocCred'];
		           $cont_selfie = $rstCont['qrcodeSelfieCred'];
			  	   $cont_qrcodeCheque = $rstCont['qrcodeCheque'];
				   $ocrSelfie = $rstCont['qrcodeSelfie'];
				   $ocrDoc = $rstCont['qrcodeDoc'];
				   $ocrCheque = $rstCont['qrocdeCheque'];
				   $cont_acp = $rstCont['qrocdeAcp'];
				   $cont_cartao = $rstCont['qrocdeCartaoCred'];
				   $cont_cartaoch = $rstCont['qrocdeCartaoCh'];
				   $cont_acpch = $rstCont['qrocdeAcpch'];
				   $linkpagamento = $rstCont['linkPagamento'];
					
					$versaocheque = $rstCont['contp_VersaoCheque'];
					$versaocredito = $rstCont['contp_VersaoCredito'];
					$versaoutros = $rstCont['contp_VersaoOutros'];
					$vesaochequeDT = $rstCont['contp_DT_VersaoCheque'];
					$vesaocreditoDT = $rstCont['contp_DT_VersaoCredito'];
					$vesaoutrosDT = $rstCont['contp_DT_VersaoOutros'];
					
					$contp_bloqueioTroca = $rstCont['contp_bloqueioTroca']; 
					$contp_bloqueioDez = $rstCont['contp_bloqueioDez'];
					
					$cep_ch = $rstCont['contp_cep_ch'];
					
					$_acionarcob = $rstCont['contp_acionarcob'];
					
					$tivit = $rstCont['contp_tivit'];
					
					$_repassBoleto = $rstCont['contp_repassBoleto']; //repasseVlrBol
					$_repassFianca = $rstCont['contp_repassFianca']; //txSim
					
					//situacao tributaria
					$_confis = number_format($rstCont['contp_confis'],2,',','.');
					$_ir = number_format($rstCont['contp_ir'],2,',','.');
					$_pis = number_format($rstCont['contp_pis'],2,',','.');
					$_csll = number_format($rstCont['contp_csll'],2,',','.');
					
					$vlr_negativacao = number_format($rstCont['contp_VlrNegativacao'],2,',','.');
					$codassociado =  $rstCont['contp_associado'];
					$Ind_negativacao =  $rstCont['contp_negativacao']; 	
					$seq_negativacao =  $rstCont['contp_NegativacaoSeq']; 
          
          $perfilvip =  $rstCont['contp_vip']; 
          
					

			        
?>
<form id="form1" name="form1" method="post" action="" class="form-inline">
 <table width="952" border="0"><tr><td><table width="952" border="0">
   <tr>
     <td><span class="style4"><span class="style4">Empresa:</span><Br />LOGIN: </span>
        <h4> <?=$rst['login']; $idlogin = $rst['login']; echo "-".$rst['cont_nomefantasia'];?>   </h4>  </td>
     <td><span class="style4">
     <span class="style4">Perfil:</span><Br />
       <select name="perfilvip" size="1" id="perfilvip"  class="form-control input-sm">
         <option value="0" <?php if ($perfilvip == 0){ ?> selected="selected" <?php }?>>Padr&atilde;o</option>
         <option value="-1" <?php if ($perfilvip == '-1'){ ?> selected="selected" <?php }?>>Vip</option>
       </select>
     </span></td>
     <td><span class="style4">Empresa:</span><Br />
         <?php 
             $query = ("SELECT * FROM empresa ");
             $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	          
	         $TotalReg = mysqli_num_rows($result);		
	  ?>
         <select name="empresa" id="empresa" class="form-control input-sm" >
           <?php    if($TotalReg!= 0)
		     			{			
						$Linha = 0;
						
						     	while($rs = mysqli_fetch_array($result)){
								$descricao = $rs["empresa_nome"];
								$codigo = $rs["empresa_id"];
								if($codigo == $empresa) { 
								?>
           <option value="<?php  echo "$codigo";?>" selected="selected"> <?php  echo "$descricao"; ?></option>
           <?php  } else {   ?>
           <option value="<?php  echo "$codigo";?>"> <?php  echo "$descricao"; ?></option>
           <?php 
  									}
										$Linha++;		 
		       				}	
		    }		 
                 ?>
         </select> </td>
   </tr>
 </table></td>
            </tr>
</table>
     <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">     

<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFive" style="height:20px; padding:1px;">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapsecont" aria-expanded="true" aria-controls="collapseFive">
        <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Dados do Contratante</strong>
        </a>
      </h4>
    </div>
    <div id="collapsecont" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">
      
<div class="container-fluid">

	<div class="row">
		<div class="col-md-12"  >
		  <table width="865" border="0">
            <tr>
              <td width="112"><span class="col-md-2">Ativo</span></td>
              <td width="112"><span ><strong><label>Senha Operacional</label></strong></span></td>
              <td width="112"><span ><strong><label>Senha Gerencial</label></strong></span></td>
              <td width="175"><span ><strong><label>Cod Representante</label></strong></span></td>
              <td width="332"><span ><strong><label>Gestor da Conta</label></strong></span></td>
              </tr>
            <tr>
              <td>
                <select name="ativo2" id="ativo2" class="form-control input-sm" style="width:110px">
                  <option value="0" <?php  if ($inativo == 0) { ?>selected="selected"<?php  } ?>>Ativo</option>
                  <option value="-1" <?php  if ($inativo == "-1") { ?>selected="selected"<?php  } ?>>Inativo</option>
                  <option value="-2"  <?php  if($inativo == "-2") { ?> selected="selected" <?php  }?>>Inativo Restri&ccedil;&atilde;o</option>
                  <option value="-3"  <?php  if($inativo == "-3") { ?> selected="selected" <?php  }?>>Inativo Pedido Cancelamento</option>
                  <option value="-4"  <?php  if($inativo == "-4") { ?> selected="selected" <?php  }?>>Inativo Inadimplente Creditall</option>
                  <option value="-5"  <?php  if($inativo == "-5") { ?> selected="selected" <?php  }?>>Inativo Encerrou Atividades</option>
                  <option value="-6"  <?php  if($inativo == "-6") { ?> selected="selected" <?php  }?>>Em Implanta&ccedil;&atilde;o e Homologa&ccedil;&atilde;o</option>
                  <option value="2" <?php  if ($inativo == "2") { ?>selected="selected"<?php  } ?>>Suspenso</option>
                </select>             </td>
              <td><span >
                <input name="senhaA1" type="text" id="senhaA1" size="8"  value="<?=$rst["senhaA"];?>" class="form-control input-sm"/>
                <input type="hidden" id="codCont" value="<?=$rst['login'];?>" />
              </span></td>
              <td><span >
                <input name="senhaB" type="text" id="senhaB" size="8" class="form-control input-sm"  value="<?=$rst["senhaB"];?>"/>
              </span></td>
              <td><span >
                <input name="representante" type="text" id="representante" value="<?=$rst["contratante_codrepresentante"];?>" size="8" class="form-control input-sm" />
                
                <?php    echo '<p class="text-muted">'.$rst['usuario_NOME'].'</p>';?>
              </span></td>
			  <td>
              <input name="gestor" type="text" id="gestor" value="<?=$gestor;?>" size="8" class="form-control input-sm" />
               <?php  
					$consultaG = "Select * from  usuario where usuario_LOGIN = '".$gestor."'" ;
					$executaG = mysqli_query($mysqli, $consultaG) or die(mysqli_error($mysqli));
					
	 				while($rstG = mysqli_fetch_array($executaG)){			
					
					echo '<p class="text-muted">'.$rstG['usuario_NOME'].'</p>';
				}
			   ?>
             
             </td>
              </tr>
          </table>
		</div>
	</div> 	
	<div class="row">		
		<div class="col-md-4" id="atualizaGrupo">
			<label>Grupo</label><br />
			<select id="grupo" name="grupo" class="form-control input-sm">
				<option value="">Selecione</option>
				<?php 
				
				
					$consultaGP = "SELECT * FROM  `grupo_contratante` WHERE grupoCon_contratante = '$idlogin '";
						$executaGP = mysqli_query($mysqli, $consultaGP) or die(mysqli_error($mysqli));
						
						while($rstGP = mysqli_fetch_array($executaGP)){
						
						$gp = $rstGP['grupoCon_idGrupo'];
				}
				
					$consultaGrupo = "SELECT * FROM  `grupo`";
					$executaGrupo = mysqli_query($mysqli, $consultaGrupo) or die(mysqli_error($mysqli));
						
							while($rstGrupo = mysqli_fetch_array($executaGrupo)){
							?>
								<option value="<?=$rstGrupo['grupo_id']?>" <?php  if($rstGrupo['grupo_id'] == $gp){?> selected="selected" <?php  } ?> ><?=$rstGrupo['grupo_descricao'] ?></option>';			
							<?php 
							}			
				?>
			</select>	

			<button class="btn btn-default" type="button" onclick="carregaAjaxContratante('atualizaGrupo','acaoObscontratante.php?acao=atualizar');">
			<i class="glyphicon glyphicon-refresh"></i> </button>

			
		</div>
		
		
		
		<div class="col-md-3">
			<label>Criar Grupo</label>
			<div class="input-group">
				<input class="form-control input-sm" name="criagrupo" type="text" id="criagrupo" >
					<span class="input-group-btn">
						<button class="btn btn-default" type="button" onclick="carregaAjaxContratante('retornoGrupo','acaoObscontratante.php?acao=criar&desc='+document.getElementById('criagrupo').value);">
						<i class="glyphicon glyphicon-plus"></i> </button>
					</span>
			</div>
		</div>
		<div class="col-md-1">
			<br />
			<span id="retornoGrupo"></span>
		
		</div>
			
	</div>
	
	<br />
	
	<div class="row">
	
		<div class="col-md-12">
			<label></label>
			<table width="775" border="0">
              <tr>
                <td width="112">
                  <div align="center"><label>Data Cadastro</label></div>
                </td>
                <td width="168">
                  <div align="center"><label>Dt. Ass. Contrato Cheque</label></div>
                </td>
                <td width="163">
                  
                  <div align="center"><label>Dt. Ass. Contrato Credi&aacute;rio</label>  </div>
                  </td>
                <td width="147"><label>
                  <div align="center">Dt. Cancelamento Contrato</div>
                </label></td>
                <td width="163">
                  <div align="center"><label>Dt. Ult Remessa</label></div>
                </td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="dtcadastro" type="text" size="8" id="dtcadastro" value="<?=$rst["dtcadastro"];?>" tabindex="2" onblur="dataTexto(this.value)" onkeyup="mascaraTexto(event,11)" maxlength="10"  class="form-control input-sm" />
                </div></td>
                <td><div align="center"><span>
                  <input name="dtassinatura" type="text" size="12" id="dtassinatura" value="<?=$rst["dtassinatura"];?>" tabindex="2"  onkeyup="mascaraTexto(event,13)" maxlength="10" class="form-control input-sm"  />
                </span></div></td>
                <td><div align="center"><span >
                  <input name="dtassinatura2" size="12" type="text" id="dtassinatura2" value="<?=$rst["dtassinatura2"];?>" tabindex="2"  onkeyup="mascaraTexto(event,13)" maxlength="10" class="form-control input-sm"/>
                </span></div></td>
                <td><div align="center">
                  <input name="dtcancelamento" size="12" type="text" id="dtcancelamento" value="<?=$rst["dtcancelamento"];?>" tabindex="2"  onkeyup="mascaraTexto(event,13)" maxlength="10" class="form-control input-sm" />
                </div></td>
                <td><div align="center">
                  <input name="dtremessa" size="12" type="text" id="dtremessa" value="<?=$rst["dtremessa"];?>" tabindex="2"  onkeyup="mascaraTexto(event,13)" maxlength="10" class="form-control input-sm" />
                </div></td>
              </tr>

            </table>
		</div>
		
	</div>  

<br />
<div class="row">
		<div class="col-md-12"  >
		  <table width="865" border="0">
            <tr>
              <td width="112"><strong><label>Conta Contabil Passivo</label></strong></td>
              <td width="112"><span ><strong><label>Conta Contabil Ativo</label></strong></span></td>
              <td width="112"><span ><strong><label>Tipo de Entrada</label></strong></span></td>
              <td width="112"><span ><strong><label>Capital Social</label></strong></span></td>
              <td width="112"><span ><strong><label>Data de Implanta&ccedil;&atilde;o</label></strong></span></td>
              <td width="112"><span ><strong><label>Vers&atilde;o Contrato</label></strong></span></td>
              </tr>
              <tr>
              <td><div align="left">
              	<input name="conta_contabil_passivo" type="text" class="form-control input-sm" class="campo" id="conta_contabil_passivo"
                 value="<?php  echo "$conta_contabil_passivo"; ?>" size="10" maxlength="10" />
              </div></td>
              <td><div align="left">
              	<input name="conta_contabil_ativo" type="text" class="form-control input-sm" id="conta_contabil_ativo" value="<?php  echo "$conta_contabil_ativo"; ?>" size="10" maxlength="10" />
              </div></td>
              <td><div align="left">
              	 <select name="tipo_entrada"  id="tipo_entrada" class="form-control input-sm"  style=" width: 135px;" >

                      <option value="1" <?php  if($tipo_entrada == "1" ) { ?>   selected="selected" <?php  } ?> >Ativo Promotor</option>
                      <option value="2"  <?php  if($tipo_entrada == "2" ) { ?>   selected="selected" <?php  } ?>>Ativo televendas</option>
                      <option value="3"  <?php  if($tipo_entrada == "3" ) { ?>   selected="selected" <?php  } ?>>Receptivo</option>
                    </select>
              </div></td>
              <td><div align="left">
               <input name="capital_social" type="text" class="form-control input-sm" id="capital_social" value="<?=number_format($capital_social,2,',','.');?>
               " size="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)'/>
           </div></td>
           <td><div align="left">
           <input name="dt_implantacao" type="text" class="form-control input-sm" id="dt_implantacao" value="<?php echo "$dt_implantacao"; ?>"  onkeypress="return txtBoxFormat(this, '99/99/9999', event);"   size="10" maxlength="10"/>
       </div></td>
       <td><div align="left">
			<input name="versao_contrato" type="text" class="form-control input-sm"  id="versao_contrato" value="<?php  echo "$versao_contrato"; ?>" size="4" maxlength="4"/>
		</div></td>
	</tr>
	<tr>
		<td><label>Vers&atilde;o Contrato Cr&eacute;dito</label>
			<div align="left"> 
				<?php  $sel1 = "select * from  VersaoContrato where versao_tipo = '1' or versao_tipo = '0'";
					$exe = mysqli_query($mysqli, $sel1) or die(mysqli_error($mysqli));
				   ?>
				   <select name="versaoContCred"  id="versaoContCred" class="form-control input-sm"  style=" width: 135px;" >
				   <?php while($re = mysqli_fetch_array($exe)){
					   if($versaocredito == '0'){$versaocredito = '3'; }?>
				
                      <option value="<?=$re['versao_id'];?>" <?php  if($re['versao_id'] == $versaocredito ) { ?>   selected="selected" <?php  } ?> ><?=$re['versao_descricao'];?></option>
					  
				   <?php }?>
                </select>
		</div></td>
		<td><label>Vers&atilde;o Contrato Cheque</label>
			<div align="left"> 
				<?php  $sel1 = "select * from  VersaoContrato where versao_tipo = '2' or versao_tipo = '0'";
					$exe = mysqli_query($mysqli, $sel1) or die(mysqli_error($mysqli));
				 ?>
				<select name="versaoContCheq"  id="versaoContCheq" class="form-control input-sm"  style=" width: 135px;" >
                   <?php while($re = mysqli_fetch_array($exe)){
					   if($versaocheque == '0'){$versaocheque = '3'; }
					   ?>
						
                      <option value="<?=$re['versao_id'];?>" <?php  if($re['versao_id'] == $versaocheque ) { ?>   selected="selected" <?php  } ?> ><?=$re['versao_descricao'];?></option>
					  
				   <?php }?>
                </select>
		</div></td>
		<td colspan="2"><label>Vers&atilde;o Contrato Outros</label>
			<div align="left" id="contratoOutros" name="contratoOutros"> 
				<?php  $sel1 = "select * from  VersaoContrato where versao_tipo = '3' or versao_tipo = '0'";
					$exe = mysqli_query($mysqli, $sel1) or die(mysqli_error($mysqli));
				   ?>
				<select name="versaoContOutro"  id="versaoContOutro" class="form-control input-sm"  style=" width: 135px;" >
                      <?php while($re = mysqli_fetch_array($exe)){
						  if($versaoutros == '0'){$versaoutros = '3'; }
						  ?>
				
                      <option value="<?=$re['versao_id'];?>" <?php  if($re['versao_id'] == $versaoutros ) { ?>   selected="selected" <?php  } ?> ><?=$re['versao_descricao'];?></option>
					  
				   <?php }?>
                </select>
		<button class="btn btn-sm btn-success" style="padding:3px; width:25px;" type="button" onclick="carregaAjax('contratoOutros','AtualizaVersaoContrato.php?login=<?=$loginContratante;?>&acao=1&versao=<?=$versaoutros;?>')"> + </button></div></td>
	</tr>
	<tr>
		<td>
		<label>Dt Vers&atilde;o Contrato Cr&eacute;dito</label>
		   <input name="dtVersaoCredito" id="dtVersaoCredito" type="text" class="form-control input-sm"  value="<?php  echo $vesaocreditoDT; ?>"  onkeypress="return txtBoxFormat(this, '99/99/9999', event);"   size="10" maxlength="10"/>
		</td>
		<td>
			<label>Dt Vers&atilde;o Contrato Cheque</label>
			<input name="dtVersaoCheque" id="dtVersaoCheque" type="text" class="form-control input-sm"  value="<?php  echo $vesaochequeDT; ?>"  onkeypress="return txtBoxFormat(this, '99/99/9999', event);"   size="10" maxlength="10"/>
		</td>
		<td>
			<label>Dt Vers&atilde;o Contrato Cr&eacute;dito</label>
		   <input name="dtVersaoOutros" id="dtVersaoOutros" type="text" class="form-control input-sm"  value="<?php  echo $vesaoutrosDT; ?>"  onkeypress="return txtBoxFormat(this, '99/99/9999', event);"   size="10" maxlength="10"/>
		</td>
	</tr>
          </table>
      </div>
  </div>
  <br />
  <!-------------- ----------EMISSAO CARTAO ----------------------------- ---------------------------------------------------------------- ----------------- ---------------------->		
	<div class="row">
		<div class="col-sm-12" style="background-color: whitesmoke">
			<legend style="font-size:18px;">• Par&acirc;metros Emiss&atilde;o Cart&atilde;o</legend>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-3">
			<label>Emite Cartão</label>
			<select name="emitecartao" id="emitecartao" class="form-control input-sm"  style="width:100%">
				<option value="0" <?php  if($rst["parametro_emitecartao"] == 0) { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
				<option value="1"  <?php  if($rst["parametro_emitecartao"] == 1) { ?>  selected="selected" <?php  } ?>>Sim</option>
				<option value="2"  <?php  if($rst["parametro_emitecartao"] == 2) { ?>  selected="selected" <?php  } ?>>Opcional</option>
			</select>
		</div>
		<div class="col-sm-3">
			<label>Mostra Cartão</label>
			<select name="apemissao" id="apemissao" class="form-control input-sm"  style="width:100%">
				<option value="0" <?php  if($rst["cont_liberaemissao"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
				<option value="-1"  <?php  if($rst["cont_liberaemissao"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
			</select>
		</div>
		<div class="col-sm-3">
			<label>Vlr da Emissão</label>
			<input name="vlrEmissao" type="text" id="vlrEmissao" size="10" value="<?=number_format($rst["contratante_Emissao"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)'class="form-control input-sm" style="width: 100%;"/>
		</div>
		<div class="col-sm-3">
			<label>Arte Cart&atilde;o</label>
			<select class="form-control input-sm" name="arteremessa" id="arteremessa" style="width:100%">
				<option value="0" <?php  if($arteCartao == 0){ echo 'selected';} ?> >N&atilde;o</option>
				<option value="1" <?php  if($arteCartao == 1){ echo 'selected';} ?> >Sim</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<label>Tipo Cart&atilde;o</label>
			<select class="form-control input-sm" name="tipocartaoremessa" id="tipocartaoremessa" style="width:100%">
				<option value="1" <?php  if($tipoCartao == 1){ echo 'selected';} ?> >Creditall</option>
				<option value="2" <?php  if($tipoCartao == 2){ echo 'selected';} ?> >Loja</option>
			</select>
		</div>
		
		<div class="col-sm-3">
			<label>Tipo Envio</label>
			<select class="form-control input-sm" name="envioremessa" id="envioremessa" style="width:100%">
				<option value="1" <?php  if($envioCartao == 1){ echo 'selected';} ?> >Loja</option>
				<option value="2" <?php  if($envioCartao == 2){ echo 'selected';} ?> >Consumidor</option>
			</select>
		</div>
		
		<div class="col-sm-3">
			<label>Qtde min. envio</label>
			<input class="form-control input-sm" type="text" name="qtderemessa" id="qtderemessa" value="<?=$qntdeCartao?>">
		</div>
		<div class="col-sm-3">
			<label>Cartão Combustível</label>
			<select id="combustivel" class="form-control" style="width:100%">
				<option value="0" <?php  if($combustivel == 0){ ?> selected="selected" <?php  }?>>N&atilde;o</option>
				<option value="1" <?php  if($combustivel == 1){ ?> selected="selected" <?php  }?>>Sim</option>
			</select>    
		</div>
		
	</div>
	<br>
	<hr>					

<!-------------- ---------- FIM EMISSAO CARTAO ----------------------------- ---------------------------------------------------------------- ----------------- ---------------------->	                       
    
 <div class="row">  
 
 
 <div class="col-sm-6">
		<a href="https://siscredit.com.br/duplicaCod.php?cod=<?=$idlogin?>" target="_blank"><button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-plus"></i> Duplicar Contratante</button></a>
 	</div>
 
 
 
 	<div class="col-sm-6" align="right">
    	 <a href="https://siscredit.com.br/sisrepr/re_PDF_boasvindas.php?id_cont=<?=$idlogin?>" target="_blank"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-envelope"></i> Carta de Boas Vindas</button></a>
    
    </div>

 	
 </div>
    
</div>
</div>
</div>
    
          

          
 <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFive" style="height:20px; padding:1px;">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
        <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Dados Cadastrais</strong>
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">

<table width="38%" class="table table-condensed" border="0" >
         
        <tr>
              <td height="34" colspan="4"><table width="100%" border="0" align="right">
			  
			  <tr>
				 <td class="style106">ACP</td>
				 <td class="style106">SERASA</td>
				 <td class="style106">LOGO</td>
				 <td class="style106">LOGO CARN&Ecirc;</td>
				 <td class="style106">CRIAR PASTA RETORNO/REMESSA</td>
				 <td class="style106">FOTOS</td>
				 <td class="style106">DOCUMENTOS</td>	  
				 <td class="style106">ASSINATURA ELETR&Ocirc;NICA</td>	  
			  </tr>
               <tr>
                  <?php 
				$numero_B =  str_replace(".", "", $rst["cont_cpf"]);
				$numero_B =  str_replace(",", "", $numero_B);
				$numero_B =  str_replace("-", "", $numero_B);
				$numero_B =  str_replace("/", "", $numero_B);
				$numero_B  = substr($numero_B,0,3).".".substr($numero_B,3,3).".".substr($numero_B,6,3)."-".substr($numero_B,9,2);

				?>
                  <td width="20" class="style114" style="cursor:pointer">                   
                    <button data-toggle="modal" href="#myModal2" type="button" class="btn btn-default" onClick="carregaAjax('resp', 'listabaseDetalheCPF.php?cpf=<?=$numero_B;?>')"><i class="glyphicon glyphicon-search"></i></button>                                
                  </td>
                 
                  <td width="20" class="style114" style="cursor:pointer">                   
                    <button data-toggle="modal" href="#myModal2" type="button" class="btn btn-default" onClick="carregaAjax('resp', 'listabaseDetalheCPFSerasa.php?cpf=<?=$rst["cont_cnpj"];?>')"><i class="glyphicon glyphicon-search"></i></button>
                  </td>
                  
                  <td width="20" class="style114" style="cursor:pointer">                   
                    <button data-toggle="modal" href="#myModal2" type="button" class="btn btn-default" onClick="carregaAjax('resp', 'contratante_logo.php?id=<?=$id;?>&login=<?=$idlogin;?>')"><i class="glyphicon glyphicon-search"></i></button>                      
                  </td>
                  
				  <td width="20" class="style114" style="cursor:pointer">                   
                    <button data-toggle="modal" href="#myModal2" type="button" class="btn btn-default" onClick="carregaAjax('resp', 'contratante_logocarne.php?id=<?=$id;?>&login=<?=$idlogin;?>')"><i class="glyphicon glyphicon-search"></i></button>     
                  </td>
                  
                  <td width="20" class="style114 style117">                   
                    <button data-toggle="modal" href="#myModal2" type="button" class="btn btn-default" onClick="carregaAjax('resp', 'contratante_pasta.php?id=<?=$idlogin;?>')"><i class="glyphicon glyphicon-search"></i></button>               
                  </td>      
                   
                   <td width="20" class="style114 style117">                    
                    <button data-toggle="modal" href="#myModal2" type="button" class="btn btn-default" onClick="carregaAjax('resp', 'contratante_pasta.php?id=<?=$idlogin;?>')"><i class="glyphicon glyphicon-search"></i></button>               
                   </td>
                  
                   
                   <td width="20" class="style114 style117">       
                    <button data-toggle="modal" href="#myModal2" type="button" class="btn btn-default" onclick="carregaAjaxContratante('resp', 'documentos_contrato.php?contra=<?=$idlogin;?>')"><i class="glyphicon glyphicon-search"></i></button>              
                   </td>
					
				   <td width="20" class="style114 style117">       
                    <a href="photo_ass_gerencial.php?TcuIP=<?=$id;?>" target="_blank"><button type="button" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button> </a>             
                   </td>
       
                </tr>
                </table>              </td>
          </tr>
            <tr>
              <td width="267">CNPJ</td>
              <td width="283">Raz&atilde;o Social
                <input name="codbairro" type="hidden" id="codbairro" size="5" value="<?=$codbairro;?>" />
               
                <input type="hidden" name="codigologin" id="codigologin" value="<?=$id;?>" />
              </span></strong></span></td>
              <td width="200" colspan="2" >            </td>
          </tr>
            <tr>
              <td>
                <input type="text" name="cnpj" id="cnpj"  class="form-control input-sm" style="width:200px"  onkeypress='return SomenteNumero(event)' onkeyup="mascaraTexto(event,'2')" maxlength="18" value="<?=$cnpj = $rst["cont_cnpj"];?>"/>
            </td>
              <td colspan="3">
                <input type="text" name="razao_social" id="razao_social"  class="form-control input-sm" style="width:400px" value="<?=$rst["cont_razaosocial"];?>"/>
              </td>
          </tr>
            <tr>
              <td class="style104">Nome Fantasia</td>
              <td class="style104">CPF - Respons&aacute;vel</td>
              <td colspan="2" class="style104">Nome  - Respons&aacute;vel</td>
          </tr>
            <tr>
              <td>
                <input type="text" name="nome_fantasia" id="nome_fantasia"  class="form-control input-sm" style="width:200px" value="<?=$rst["cont_nomefantasia"];?>"/>
              </td>
              <td>
                <input type="text" name="cpf" id="cpf"  class="form-control input-sm" style="width:200px"    maxlength="14" value="<?=$cpf_responsavel = $rst["cont_cpf"];?>"/>
           </td>
              <td colspan="2">
                <input type="text" name="nome" id="nome"  class="form-control input-sm" style="width:200px" value="<?=$rst["cont_nome"];?>"/>
           </td>
          </tr>
            <tr>
              <td class="style104">Cargo Respons&aacute;vel</td>
              <td class="style104">CEP</td>
              <td colspan="2"><span class="style51">Estado</span></td>
          </tr>
            <tr>
              <td>
                <input type="text" name="responsavel" id="responsavel"  class="form-control input-sm" style="width:200px" value="<?=$rst["contratante_responsavel"];?>"/>
           </td>
              <td><table width="200" border="0">
                <tr>
                  <td width="132">
                    <input name="cep" type="text" id="cep" class="form-control input-sm" style="width:200px" onkeyup="mascaraTexto(event,'4')" onblur="carregaAjaxCEP('pagina', 'buscacep.php?cep=' + this.value)" value="<?=$rst["cont_cep"];?>"/>
                 </td>
                  <td width="26"></td>
                </tr>
              </table></td>
              <td colspan="2">
                <select name="estado" id="estado" class="form-control input-sm" style="width:200px">
                  <option value=""></option>
                  <option value="AC" <?php  if($rst["cont_uf"] == "AC") { ?> selected="selected"<?php  } ?>>Acre</option>
                  <option value="AL" <?php  if($rst["cont_uf"] == "AL") { ?> selected="selected"<?php  } ?>>Alagoas</option>
                  <option value="AP" <?php  if($rst["cont_uf"] == "AP") { ?> selected="selected"<?php  } ?>>Amapa</option>
                  <option value="AM" <?php  if($rst["cont_uf"] == "AM") { ?> selected="selected"<?php  } ?>>Amazonas</option>
                  <option value="BA" <?php  if($rst["cont_uf"] == "BA") { ?> selected="selected"<?php  } ?>>Bahia</option>
                  <option value="CE" <?php  if($rst["cont_uf"] == "CE") { ?> selected="selected"<?php  } ?>>Ceara</option>
                  <option value="DF" <?php  if($rst["cont_uf"] == "DF") { ?> selected="selected"<?php  } ?>>Distrito Federal</option>
                  <option value="GO" <?php  if($rst["cont_uf"] == "GO") { ?> selected="selected"<?php  } ?>>Goias</option>
                  <option value="ES" <?php  if($rst["cont_uf"] == "ES") { ?> selected="selected"<?php  } ?>>Espirito Santo</option>
                  <option value="MA" <?php  if($rst["cont_uf"] == "MA") { ?> selected="selected"<?php  } ?>>Maranhao</option>
                  <option value="MT" <?php  if($rst["cont_uf"] == "MT") { ?> selected="selected"<?php  } ?>>Mato Grosso</option>
                  <option value="MS" <?php  if($rst["cont_uf"] == "MS") { ?> selected="selected"<?php  } ?>>Mato Grosso do Sul</option>
                  <option value="MG" <?php  if($rst["cont_uf"] == "MG") { ?> selected="selected"<?php  } ?>>Minas Gerais</option>
                  <option value="PA" <?php  if($rst["cont_uf"] == "PA") { ?> selected="selected"<?php  } ?>>Para</option>
                  <option value="PB" <?php  if($rst["cont_uf"] == "PB") { ?> selected="selected"<?php  } ?>>Paraiba</option>
                  <option value="PR" <?php  if($rst["cont_uf"] == "PR") { ?> selected="selected"<?php  } ?>>Parana</option>
                  <option value="PE" <?php  if($rst["cont_uf"] == "PE") { ?> selected="selected"<?php  } ?>>Pernambuco</option>
                  <option value="PI" <?php  if($rst["cont_uf"] == "PI") { ?> selected="selected"<?php  } ?>>Piaui</option>
                  <option value="RJ" <?php  if($rst["cont_uf"] == "RJ") { ?> selected="selected"<?php  } ?>>Rio de Janeiro</option>
                  <option value="RN" <?php  if($rst["cont_uf"] == "RN") { ?> selected="selected"<?php  } ?>>Rio Grande do Norte</option>
                  <option value="RS" <?php  if($rst["cont_uf"] == "RS") { ?> selected="selected"<?php  } ?>>Rio Grande do Sul</option>
                  <option value="RO" <?php  if($rst["cont_uf"] == "RO") { ?> selected="selected"<?php  } ?>>Rondonia</option>
                  <option value="RR" <?php  if($rst["cont_uf"] == "RR") { ?> selected="selected"<?php  } ?>>Roraima</option>
                  <option value="SP" <?php  if($rst["cont_uf"] == "SP") { ?> selected="selected"<?php  } ?>>Sao Paulo</option>
                  <option value="SC" <?php  if($rst["cont_uf"] == "SC") { ?> selected="selected"<?php  } ?>>Santa Catarina</option>
                  <option value="SE" <?php  if($rst["cont_uf"] == "SE") { ?> selected="selected"<?php  } ?>>Sergipe</option>
                  <option value="TO" <?php  if($rst["cont_uf"] == "TO") { ?> selected="selected"<?php  } ?>>Tocantins</option>
              </select>
        </td>
          </tr>
            <tr>
              <td><span class="style104">Cidade</span></td>
              <td><span class="style104">Bairro</span></td>
              <td colspan="2" class="style104">C&oacute;d. Municipio</td>
          </tr>
            <tr>
              <td>
                <input name="cidade" type="text" id="cidade" class="form-control input-sm" style="width:200px" value="<?=$rst["cont_cidade"];?>"/>
             </td>
              <td>
                <input type="text" name="bairro" id="bairro" class="form-control input-sm" style="width:200px" value="<?=$rst["cont_bairro"];?>"/>
              </td>
              <td colspan="2">
              	<input type="text" name="codmunicipio" id="codmunicipio" class="form-control input-sm" style="width:200px" value="<?=$rstCont["cont_municipio"]; }?>"/>
              	<a href="municipio.php" target="_blank" class="btn btn-primary btn-sm">Buscar</a>
              </td>
          </tr>
            <tr>
              <td class="style104">Logradouro</td>
              <td>&nbsp;</td>
              <td colspan="2"><span class="style104">N&uacute;mero</span></td>
          </tr>
            <tr>
              <td colspan="4"><input name="rua" type="text"  id="rua" class="form-control input-sm" style="width:550px" value="<?=$rst["cont_endereco"];?>"/>                <input name="numero" type="text" class="form-control input-sm" style="width:60px" id="numero"  value="<?=$rst["cont_numero"];?>"/></td>
          </tr>
            <tr>
              <td class="style104">Complemento</td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
          </tr>
            <tr>
              <td colspan="2"><input name="complemento" type="text" class="form-control input-sm" style="width:200px" id="complemento"  value="<?=$rst["cont_complemento"];?>"/></td>
              <td colspan="2">&nbsp;</td>
          </tr>
            <tr>
              <td><span class="style51 style52">Telefone Comercial</span></td>
              <td><span class="style51 style52">Fax</span></span></td>
              <td colspan="2"><span class="style104">Telefone Celular</span></td>
          </tr>
            <tr>
              <td>
                <input type="text" name="ddd_comercial" id="ddd_comercial" class="form-control input-sm" style="width:50px" onkeyup="if (this.value.length==2) this.form.fone_comercial.focus()" value="<?=$rst["cont_ddcomercial"];?>"/>
                <input name="fone_comercial" type="text" id="fone_comercial" class="form-control input-sm" style="width:150px"  onkeyup="mascaraTexto(event,3)" maxlength="9" value="<?=$rst["cont_fonecomercial"];?>"/>
           </td>
              <td>
                <input type="text" name="ddd_fax" id="ddd_fax"class="form-control input-sm" style="width:50px" onkeyup="if (this.value.length==2) this.form.fone_fax.focus()" value="<?=$rst["cont_ddfax"];?>"/>
                <input name="fone_fax" type="text" id="fone_fax" class="form-control input-sm" style="width:150px" onkeyup="mascaraTexto(event,5)" value="<?=$rst["cont_fonefax"];?>"/>
           </td>
              <td colspan="2">
                <input type="text" name="ddd_celular" id="ddd_celular" class="form-control input-sm" style="width:50px" onkeyup="if (this.value.length==2) this.form.fone_celular.focus()" value="<?=$rst["cont_ddcelular"];?>"/>
                <input name="fone_celular" type="text" id="fone_celular" class="form-control input-sm" style="width:150px" onkeyup="mascaraTexto(event,6)" value="<?=$rst["cont_fonecelular"];?>"/>
              </td>
          </tr>
            <tr>
              <td><span class="style104">Email</span></td>
              <td><span class="style51 style52">Site</span></span></td>
              <td colspan="2">&nbsp;</td>
          </tr>
            <tr>
              <td>
                   
                <input type="text" name="email" id="email"  class="form-control input-sm" style="width:200px" value="<?=$rst["cont_email"]?>" />
              </span></td>
              <td colspan="3">
                <input type="text" name="site" id="site"  class="form-control input-sm" style="width:350px" value="<?=$rst["cont_site"];?>"/>
        </td>
          </tr>
            <tr>
              <td><span class="style104">Site pagamento parcial</span></td>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"> <input type="text" name="siteecommerce" id="siteecommerce"  class="form-control input-sm" style="width:350px" value="<?=$rst["cont_site_ecommerce"];?>"/></td>
              <td colspan="2">&nbsp;</td>
          </tr>
        </table>


      </div>
    </div>
  </div>
          <div class="panel panel-default"> 
     <div class="panel-heading" role="tab" id="headingFive" style="height:20px; padding:1px;">
      <h4 class="panel-title">
      
        <a data-toggle="collapse" data-parent="#accordion" href="#collapsecond" aria-expanded="true" aria-controls="collapseFive">
        <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Condi&ccedil;&otilde;es Comercias</strong>
        </a>
      </h4>
    </div>
    <div id="collapsecond" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">
        <table width="785" border="0" class="table table-condensed">
          <tr>
            <td colspan="4" class="style104" bgcolor="#F0F0F0"><div align="center" class="style56"></div></td>
          </tr>
          <tr>
            <td height="30" colspan="4" class="style104"><table width="808" border="0">
                <tr>
                  <td width="431"><strong>Segmento:</strong></td>
                  <td width="133">Publico Atendido:</td>
                  <td width="130"><div align="left">Tipo Empresa</div></td>
                  <td width="96">Piloto:</td>
                </tr>
                <tr>
                  <td><?php
             $query = ("SELECT * FROM segmento order by seg_descricao");
             $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	         
	         $TotalReg = mysqli_num_rows ($result);
		
	  ?>
                      <select name="segmento" id="segmento" class="form-control input-sm"  style="width:400px">
                        <option value=""></option>
                        <?php 					
		   if($TotalReg!= 0)
		     {			
			$Linha = 0;
			while($rs2 = mysqli_fetch_array($result))
			
		     {
			
			$descricao = $rs2["seg_descricao"];
			$codigo = $rs2["seg_id"];
			if($codigo == $rst["cont_segmento"]) { 
			?>
                        <option value="<?php  echo "$codigo";?>" selected="selected"> <?php  echo "$codigo - $descricao"; ?></option>
                        <?php  } else { 
  ?>
                        <option value="<?php  echo "$codigo";?>"> <?php  echo "$codigo - $descricao"; ?></option>
                        <?php 
  }
		
			$Linha++;		 
		       }	
		    }		 
                 ?>
                    </select></td>
                  <td><span class="style16">
                    <?php 
             $query = ("SELECT * FROM classe_compra");
             $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	         
	         $TotalReg = mysqli_num_rows ($result);
		
	  ?>
                    <select name="publico" id="publico" tabindex="3" class="form-control input-sm" style="width: 100px;">
                      <option value=""></option>
                      <?php 					
		    if($TotalReg!= 0)
		     {			
			$Linha = 0;
			
		     	while($rs3 = mysqli_fetch_array($result))
			
		     {
			
			$descricao = $rs3["descricao"];
			$codigo = $rs3["id"]; 
			if($codigo == $rst["cont_classesocial"]) { 
			?>
                      <option value="<?php  echo "$codigo";?>" selected="selected"> <?php  echo "$descricao"; ?></option>
                      <?php  } else { 
  ?>
                      <option value="<?php  echo "$codigo";?>"> <?php  echo "$descricao"; ?></option>
                      <?php 
  }
		
			$Linha++;		 
		       }	
		    }		 
                 ?>
                    </select>
                  </span></td>
                  <td><div align="left">
                      <select name="tipoempresa" id="tipoempresa"  class="form-control input-sm" style="width:120px" >
                        <option value="0" <?php  if($tipoempresa == '0') { ?>  selected="selected" <?php  } ?>>Varejo</option>
                        <option value="1" <?php  if($tipoempresa == '1') { ?>  selected="selected" <?php  } ?>>Ind&uacute;stria</option>
                      </select>
                  </div></td>
                  <td><select id="piloto" name="piloto" class="form-control input-sm">
                      <option value="0" <?php  if($rst["cont_piloto"] == "0"){?> selected="selected"<?php  }?>>N&atilde;o</option>
                      <option value="1" <?php  if($rst["cont_piloto"] == "1"){?> selected="selected"<?php  }?>>Sim</option>
                    </select>                  </td>
                </tr>
              </table>
                <span class="style16"> </span></td>
          </tr>
          <tr>
            <td height="30" colspan="4" class="style104"><table width="811" border="0">
                <tr>
                  <td colspan="6" class="style104" bgcolor="#F0F0F0"><div align="center" class="style56">
                      <div align="left">:: VENDAS CHEQUE</div>
                  </div></td>
                </tr>
                <tr>
                  <td width="212"><span class="style16">Produto:</span> </td>
                  <td width="205">Contrato</td>
                  <td width="187">Calculo Debito </td>
                  <td width="189"><div align="center" class="style105">
                      <div align="left">Modelo Comprovante</div>
                  </div></td>
                </tr>
                <tr>
                  <td><?php 
             $query = ("SELECT * FROM tipo_contrato");
             $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	       
	         $TotalReg = mysqli_num_rows ($result);
		
	  ?>
                      <select name="tipo_contrato1" id="tipo_contrato1"  onchange="carregaAjaxSeg('segmentos','segmentos.php?id='+ this.value + '&segmento='+ document.form1.seg.value)" class="form-control input-sm" style="width: 200px;">
                        <option value="0">Nenhum</option>
                        <?php 					
		   if($TotalReg!= 0)
		     {			
			$Linha = 0;
			while($rs4 = mysqli_fetch_array($result)){
			
			$descricao = $rs4["tipo_descricao"]; 
			$codigo = $rs4["tipo_contrato"];
			if($codigo == $rst["cont_tipocontranto"]) { 
			?>
                        <option value="<?php  echo "$codigo";?>" selected="selected"> <?php  echo "$descricao"; ?></option>
                        <?php  } else { 
  ?>
                        <option value="<?php  echo "$codigo";?>"> <?php  echo "$descricao"; ?></option>
                        <?php 
  }
		
			$Linha++;		 
		       }	
		    }		 
                 ?>
                    </select></td>
                  <td><select name="cont_contrmodeloch" id="cont_contrmodeloch" class="form-control input-sm" style="width: 200px;"  >
                      <option value="0">Nenhum</option>
                      <?php 	
			   $querymod = ("SELECT * FROM tab_modcontrato  where mod_tipo = '1'");
			   $resultmod = mysqli_query($mysqli, $querymod) or die(mysqli_error($mysqli));
	           
	           while($rstmod = mysqli_fetch_array($resultmod)){		
						$descricao = $rstmod['mod_nome'];
						$codigo = $rstmod['mod_id'];
						if($codigo == $rst["cont_contrmodeloch"]) { ?>
                      <option value="<?php  echo "$codigo";?>" selected="selected"> <?php  echo "$descricao"; ?></option>
                      <?php  } else { ?>
                      <option value="<?php  echo "$codigo";?>"> <?php  echo "$descricao"; ?></option>
                      <?php  } 
				    }?>
                  </select></td>
                  <td><select name="contrato_calc_debito" id="contrato_calc_debito" class="form-control input-sm" style="width: 170px;" <?php  if ($p74 == "-1"){?>disabled="disabled"<?php }?>>
                      <option value="0">Valor Compra+Juros</option>
                      <option value="1"  <?php  if($rst['contratante_calc_debito'] == 1) { ?> selected="selected" <?php  } ?>>Valor Compra</option>
                  </select></td>
                  <td><div align="left">
                      <select name="termoCheque" id="termoCheque" class="form-control input-sm" style="width: 150px;">
                        <option value="4"  <?php  if($rst["cont_termo"] == '4') { ?>  selected="selected" <?php  } ?>>Com Testemunha e Foto</option>
                        <option value="5"  <?php  if($rst["cont_termo"] == '5') { ?>  selected="selected" <?php  } ?>>Com Testemunha sem Foto</option>
                        <option value="1"  <?php  if($rst["cont_termo"] == '1') { ?>  selected="selected" <?php  } ?>>Sem  Reserva com Assinatura</option>
                        <option value="3"  <?php  if($rst["cont_termo"] == '3') { ?>  selected="selected" <?php  } ?>>Sem  Reserva Sem Assinatura</option>
                        <option value="2"  <?php  if($rst["cont_termo"] == '2') { ?>  selected="selected" <?php  } ?>>Com Reserva</option>
                      </select>
                  </div></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="30" class="style104"><table width="811" border="0">
                <tr>
                  <td colspan="5" class="style104" bgcolor="#F0F0F0"><div align="center" class="style56">
                      <div align="left">:: VENDAS CREDITO</div>
                  </div></td>
                </tr>
                <tr>
                  <td width="210"><?php 
             $query = ("SELECT * FROM tipo_contrato_cartao ");
             $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
	        
	         $TotalReg = mysqli_num_rows ($result);
		
			?>
                    Produto</td>
                  <td width="210">Contrato</td>
                  <td width="377">Debito </td>
                  <td width="150"><div class="style105">Modelo Contrato</div></td>
                </tr>
                <tr>
                  <td height="30" ><select name="tipocartao" id="tipocartao" class="form-control input-sm" style="width: 200px;"  >
                      <option value="0">Nenhum</option>
                      <?php 					
			   			if($TotalReg!= 0){
			
						$Linha = 0;
						while($rs5 = mysqli_fetch_array($result)){	
			
						$descricao = $rs5["tipoc_descricao"]; 
						$codigo = $rs5["tipoc_id"]; 
						if($codigo == $rst["contratante_tipocartao"]) { 
						?>
                      <option value="<?php  echo "$codigo";?>" selected="selected"> <?php  echo "$descricao"; ?></option>
                      <?php  } else { 
						 ?>
                      <option value="<?php  echo "$codigo";?>"> <?php  echo "$descricao"; ?></option>
                      <?php }
		
			$Linha++;		 
		       }	
		    }		 
                 ?>
                  </select></td>
                  <td><select name="cont_contrmodelocred" id="cont_contrmodelocred" class="form-control input-sm" style="width: 200px;"  >
                      <option value="0">Nenhum</option>
                      <?php 	
			   $querymod = ("SELECT * FROM tab_modcontrato  where mod_tipo = '2'");
			   $resultmod = mysqli_query($mysqli, $querymod) or die(mysqli_error($mysqli));
	           
	           		 while($rstmod = mysqli_fetch_array($resultmod))						
					{		
						$descricao = $rstmod['mod_nome'];
						$codigo = $rstmod['mod_id'];
						if($codigo == $rst["cont_contrmodelocred"]) { ?>
                      <option value="<?php  echo "$codigo";?>" selected="selected"> <?php  echo "$descricao"; ?></option>
                      <?php  } else { ?>
                      <option value="<?php  echo "$codigo";?>"> <?php  echo "$descricao"; ?></option>
                      <?php  } 
				    }?>
                  </select></td>
                  <td><select name="contrato_calc_debito_cred" id="contrato_calc_debito_cred" class="form-control input-sm" style="width: 170px;" <?php  if ($p75 == "-1") {?> disabled="disabled"<?php  }?>>
                      <option value="0" <?php  if($rst['contratante_calc_debito_cred'] == "0") { ?> selected="selected" <?php  } ?>>Valor Compra+Juros</option>
                      <option value="1"  <?php  if($rst['contratante_calc_debito_cred'] == "1") { ?> selected="selected" <?php  } ?>>Valor Compra</option>
                  </select></td>
                  <td>
                  <select name="termoCrediario" id="termoCrediario" class="form-control input-sm" style="width: 200px;">
                  <option value="1"  <?php  if($rst["cont_termo_crediario"] == '1') { ?>  selected="selected" <?php  } ?>>Abertura de Cr&eacute;dito</option>
                  <option value="2"  <?php  if($rst["cont_termo_crediario"] == '2') { ?>  selected="selected" <?php  } ?>>Abertura de Cr&eacute;dito e Fian&ccedil;a Garantida</option>
                </select>               </td>
                </tr>
                <tr>
                  <td width="150" height="20"><div class="style105">Modelo de Ades&atilde;o</div></td>
                  <td width="150"><div class="style105">Ficha de Ades&atilde;o</div></td>
                  <td width="150"><div class="style105">Modalidade Repasse</div></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td ><select name="termoAdesao" id="termoAdesao" class="form-control input-sm" style="width: 200px;">
                      <option value="1"  <?php  if($rst["cont_termo_adesao"] == '1') { ?>  selected="selected" <?php  } ?>>Sem Fian&ccedil;a Garantida</option>
                      <option value="2"  <?php  if($rst["cont_termo_adesao"] == '2') { ?>  selected="selected" <?php  } ?>>Com Fian&ccedil;a Garantida</option>
                    </select>                  </td>
                  <td><select name="adesaoCrediario" id="adesaoCrediario" class="form-control input-sm" style="width: 200px;">
                      <option value="1" <?php  if($rst["cont_adesao"] == '1') { ?>  selected="selected" <?php  } ?>>Sem Reserva</option>
                      <option value="2"  <?php  if($rst["cont_adesao"] == '2') { ?>  selected="selected" <?php  } ?>>Com Reserva </option>
                    </select>                  </td>
                  <td><select name="modelorepasse" id="modelorepasse" class="form-control input-sm" style="width: 200px;"  onchange="_ttTaxa();">
				  <?php  $querymod = ("SELECT * FROM Modalidade_Repasse  ");
				  		$resultmod = mysqli_query($mysqli, $querymod) or die(mysqli_error($mysqli));
	           
	           		 while($rstmod = mysqli_fetch_array($resultmod))						
					{
						?>		
                 	  <option value="<?=$rstmod['mp_id'];?>" <?php  if($modelorepasse == $rstmod['mp_id']) { ?>  selected="selected" <?php  } ?>><?=$rstmod['mp_descricao'];?></option>
					<?php  } ?>
                     
                    </select>                  </td>
                  <td>&nbsp;</td>
                </tr>
            

              <tr>
                  <td height="30" >Titulo Impress&atilde;o </td>
                  <td><div align="center" class="style105">
                      <div align="left">Modelo Cobran&ccedil;a </div>
                  </div></td>
                  <td><div align="center" class="style105">
                      <div align="left">Boleto  Faturamento (consumidor)</div>
                  </div></td>
                  <td width="189"><div align="center" class="style105">
                      <div align="left">Mostra juros carne(instru&ccedil;&atilde;o)</div>
                  </div></td>
                </tr>
                <tr>
                  <td height="30" rowspan="2" >
					<select name="contrato_impressao" id="contrato_impressao" class="form-control input-sm" style="width: 200px;">	
						<option value="1"  <?php  if($rst['contratante_doc_imp'] == 1) { ?>selected="selected" <?php  } ?>>Duplicata</option>
						<option value="3"  <?php  if($rst['contratante_doc_imp'] == 3) { ?>selected="selected" <?php  } ?>>Duplicata Fian&ccedil;a</option>
						<option value="2"  <?php  if($rst['contratante_doc_imp'] == 2) { ?>selected="selected" <?php  } ?>>Promissoria</option>
						<option value="4"  <?php  if($rst['contratante_doc_imp'] == 4) { ?>selected="selected" <?php  } ?>>Promissoria Fian&ccedil;a</option>
					</select>				  </td>
                  <td rowspan="2"><div align="left">
                      <select name="modcobranca" id="modcobranca"  class="form-control input-sm" style="width:200px">
                        <option value="0"   <?php  if($_modcobranca == '0') { ?>  selected="selected" <?php  } ?>>Padr&atilde;o</option>
                        <option value="-1"  <?php  if($_modcobranca == '-1'){ ?>  selected="selected" <?php  } ?>>Fatura</option>
                      </select>
                  </div></td>
                  <td rowspan="2"><div align="left">
                      <select name="modboletofatura" id="modboletofatura"  class="form-control input-sm" style="width:180px">
                        <option value="0"   <?php  if($_modboletofatura == '0') { ?>  selected="selected" <?php  } ?>>Padr&atilde;o</option>
                        <option value="-1"  <?php  if($_modboletofatura == '-1') { ?>  selected="selected" <?php  } ?>>Fatura</option>
                      </select>
                  </div></td>
                  <td rowspan="2"><div align="left">
                      <select name="jurosc" id="jurosc"  class="form-control input-sm" style="width:180px">
                        <option value="0"   <?php  if($juros_carne == '0') { ?>  selected="selected" <?php  } ?>>Mostra</option>
                        <option value="-1"  <?php  if($juros_carne == '-1') { ?>  selected="selected" <?php  } ?>>N&atilde;o mostra</option>
                      </select>
                  </div></td>
                </tr>
            </table></td>
            <td height="30" class="style104">&nbsp;</td>
            <td height="30" class="style104">&nbsp;</td>
            <td height="30" class="style104">&nbsp;</td>
          </tr>
          <tr>
            <td height="30" colspan="4" class="style104"><table width="807" border="0">
                <tr class="style56 style7" style="font-size:11px;">
                  <td width="102" height="17"><div align="center">Impressora T&eacute;rmica</div></td>
                  <td width="89" class="style13"><div align="center">Titulo  com Foto</div></td>
                  <td width="110" class="style13"><div align="center">Ades&atilde;o com Foto</div></td>
                  <td width="115" class="style13"><div align="center">Visualiza Titulo(D/P)</div></td>
                  <td width="102">
                  <div align="center">Calculo Hibrido </div></td>
                  <td width="88"><div align="center">Ecommerce</div></td>
                  <td width="110"><div align="center">Ecommerce  1&ordm; Vista</div></td>
                  <td width="115" class="style13"><div align="center">Habilitar Entrega</div></td>
                </tr>
                <tr>
                  <td><div align="center">
                      <select name="termica" id="termica"  class="form-control input-sm" style="width: 80px;">
                        <option value="0" <?php  if($rst["contratante_imp_termica"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                        <option value="-1"  <?php  if($rst["contratante_imp_termica"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                      </select>
                  </div></td>
                  <td><div align="center">
                      <select name="contratofoto" id="contratofoto"  class="form-control input-sm" style="width: 80px;">
                        <option value="0" <?php  if($contratofoto == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                        <option value="1"  <?php  if($contratofoto == '1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                      </select>
                  </div></td>
                  <td><div align="center">
                      <select name="adesaofoto" id="adesaofoto"  class="form-control input-sm" style="width: 80px;">
                        <option value="0" <?php  if($adesaofoto == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                        <option value="1"  <?php  if($adesaofoto == '1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                      </select>
                  </div></td>
                  <td><div align="center">
                      <select name="visualizatitulo" id="visualizatitulo"  class="form-control input-sm" style="width: 80px;">
                        <option value="0" <?php  if($visualizatitulo == '0') { ?>  selected="selected" <?php  } ?>>Sim</option>
                        <option value="1"  <?php  if($visualizatitulo == '1') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                      </select>
                  </div></td>
                  <td><div align="center">
                      <select name="hibrido" id="hibrido"  class="form-control input-sm" style="width:70px">
                        <option value="0" <?php  if($rst["contratante_hibrido"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                        <option value="-1" <?php  if($rst["contratante_hibrido"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                      </select>
                  </div></td>
                  <td><select name="ecommerce" id="ecommerce"  class="form-control input-sm" style="width:70px">
                      <option value="0" <?php  if($rst["contratante_ind_ecommerce"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                      <option value="-1" <?php  if($rst["contratante_ind_ecommerce"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                  </select></td>
                  <td><div align="center">
                      <select name="ecommerce_vista" id="ecommerce_vista"  class="form-control input-sm" style="width:70px">
                        <option value="0"  <?php  if($rst["contratante_ecommerce_vista"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                        <option value="-1" <?php  if($rst["contratante_ecommerce_vista"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                      </select>
                  </div></td>
                  <td><div align="center">
                      <select name="cont_entrega" id="cont_entrega"  class="form-control input-sm" style="width: 80px;">
                        <option value="0" <?php  if($cont_entrega == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                        <option value="-1"  <?php  if($cont_entrega == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                      </select>
                  </div></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="87" colspan="4" class="style104"><table width="808" border="0">
              <tr>
                <td width="86" height="30" rowspan="2" class="style104"><div align="center">Inclus&atilde;o Automatica</div></td>
                <td width="81" height="30" rowspan="2" class="style104"><div align="center">Cobran&ccedil;a 
                  Enviar SMS</div></td>
                <td width="91" height="30" rowspan="2" class="style104"><div align="center">Visualizar OBS Cobran&ccedil;a Extratos</div></td>
                <td width="90" height="30" rowspan="2" class="style104"><div align="center">Libera Aprova&ccedil;&atilde;o Lojista</div></td>
                <td width="126" height="30" rowspan="2" class="style104"><div align="center">Libera Aprova&ccedil;&atilde;o Lojista c/ Restri&ccedil;&atilde;o</div></td>
                <td width="150" height="30" rowspan="2" class="style104">Valor Aprov.Lojista</td>
                <td height="14" colspan="2" class="style104"><div align="center"><span class="style104 style5"><span class="style116">** </span></span>Pontua&ccedil;&atilde;o Fraude<span class="style104 style5"><span class="style116">** </span></span></div></td>
                </tr>
              <tr>
                <td width="82" height="14" class="style104"><div align="center">Cr&eacute;dito</div></td>
                <td width="68" class="style104"><div align="center">Cheque</div></td>
              </tr>
              <tr>
                <td height="30" class="style104"><div align="center">
                    <select name="cobrancaautomatica" id="cobrancaautomatica"  class="form-control input-sm" style="width: 80px;">
                      <option value="0" <?php  if($rst["cont_processaRetornoBoleto"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                      <option value="-1"  <?php  if($rst["cont_processaRetornoBoleto"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                    </select>
                </div></td>
                <td height="30" class="style104"><div align="center">
                    <select name="cobrancasms" id="cobrancasms"  class="form-control input-sm" style="width: 80px;">
                      <option value="0" <?php  if($rst["cont_processaSms"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                      <option value="-1"  <?php  if($rst["cont_processaSms"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                    </select>
                </div></td>
                <td height="30" class="style104"><div align="center">
                    <?php /*
	  $_sql = "Select * from contratante_parametros  where contp_login = '$id' ";
	  $_exe = mysql_query($_sql) or die (mysql_error());
	  $_viscob = mysql_num_rows($_exe);*/
	  ?>
                    <select name="vis_cobranca" id="vis_cobranca"  class="form-control input-sm" style="width: 80px;" disabled>
                      <option value="0" <?php  if($_viscob == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                      <option value="-1"  <?php  if($_viscob == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                    </select>
                </div></td>
                <td height="30" class="style104"><div align="center">
                    <select name="aplojista" id="aplojista" class="form-control input-sm" style="width: 80px;">
                      <option value="0" <?php  if($rst["cont_liberamanual"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                      <option value="-1"  <?php  if($rst["cont_liberamanual"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                    </select>
                </div></td>
                <td height="30" class="style104"><div align="center">
                    <select name="aplojistaR" id="aplojistaR" class="form-control input-sm" style="width: 80px;">
                      <option value="0" <?php  if($rst["cont_liberaemissao_Restricao"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                      <option value="-1"  <?php  if($rst["cont_liberaemissao_Restricao"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                    </select>
                </div></td>
                <td height="30" class="style104"><input name="vlrAL" type="text" id="vlrAL" size="10" value="<?=number_format($rst["contratante_vlrAL"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 100px;"/></td>
				
				<td height="30" class="style104">
					<div align="center">
					  <input name="pontosFraude" type="text" id="pontosFraude" value="<?=$pontosFraude;?>" maxlength="10" class="form-control input-sm" style="width: 50px;"/>				
				    </div></td>
                <td height="30" class="style104"><div align="center">
                  <input name="pontosFraudeCH" type="text" id="pontosFraudeCH" value="<?=$pontosFraudeCH;?>" maxlength="10" class="form-control input-sm" style="width: 50px;"/>
                </div></td>
              </tr>
            </table></td>
          </tr>

          <tr>
            <td height="30" colspan="4" class="style104"><table width="806" border="0">
              <tr class="table table-condensed">
                <td width="154" height="30" class="style104"><div align="center"><span class="style118"><strong>Calculo Taxa de Juros</strong></span></div></td>
                <td width="122" height="30" class="style104"><div align="center"><span class="style13 style14">Cancelar botao(OP)</span></div></td>
                <td width="142" height="30" class="style104"><div align="center"><span class="style13 style14">Permiss&atilde;o aceite</span></div></td>
                <td width="207" height="30" class="style104"><div align="center"><span class="style13 style14">Grafico cobran&ccedil;a</span></div></td>
              </tr>
              <tr class="table table-condensed">

                <td height="30" class="style104"><div align="center">
                    <select name="calculo_txch" id="calculo_txch" class="form-control input-sm"  style="width: 120px;">
                      <option value="0"  <?php  if($rst['contratante_calc_tipojuro'] == "0") { ?> selected="selected" <?php  } ?>>Juros Simples</option>
                      <option value="1"  <?php  if($rst['contratante_calc_tipojuro'] == "1") { ?> selected="selected" <?php  } ?>>Juros Composto</option>
                    </select>
                </div></td>
                <td height="30" class="style104"><div align="center">
                    <select name="botao_cancela" id="botao_cancela" class="form-control input-sm" style="width: 95px;">
                      <option value="0" <?php  if($botao_cancela == '0') { ?>  selected="selected" <?php  } ?>>Mostra Sim</option>
                      <option value="-1"  <?php  if($botao_cancela == '-1') { ?>  selected="selected" <?php  } ?>>Mostra N&atilde;o</option>
                    </select>
                </div></td>
                <td height="30" class="style104"><div align="center">
                    <select name="permissao_aceite" id="permissao_aceite" class="form-control input-sm" style="width: 95px;">
                      <option value="0" <?php  if($permissao_aceite == '0') { ?>  selected="selected" <?php  } ?>>Libera Sim</option>
                      <option value="-1"  <?php  if($permissao_aceite == '-1') { ?>  selected="selected" <?php  } ?>>Libera N&atilde;o</option>
                    </select>
                </div></td>
                <td height="30" class="style104"><div align="center">
                    <select name="cont_cobgrafico" id="cont_cobgrafico" class="form-control input-sm" style="width: 95px;">
                      <!--GRAFICO COBRANCA-->
                      <option value="-1" <?php  if($cont_cobgrafico == '-1') { ?>  selected="selected" <?php  } ?>>Mostra Sim</option>
                      <option value="0"  <?php  if($cont_cobgrafico == '0') { ?>  selected="selected" <?php  } ?>>Mostra N&atilde;o</option>
                    </select>
                </div></td>
              </tr>
              
            </table></td>
          </tr>
          <tr>
            <td height="67" colspan="4" class="style104"><table width="806" border="0">
              <tr>
                <td width="158">Solicitar Cart&atilde;o do Banco =&gt;</td>
                <td width="151"><div align="center">Credi&aacute;rio (Fisica)</div></td>
                <td width="123"><div align="center">Cr&eacute;diario (J) </div></td>
                <td width="139"><div align="center">Cheque (F)</div></td>
                <td width="201"><div align="center">Cheque (Juridica)</div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div align="center">
                  <select name="sol_cartao_f" id="sol_cartao_f" class="form-control input-sm" style="width: 80px;">
                    <option value="0" <?php  if($rst["sol_cartao_f"] == '0') { ?>  selected="selected" <?php  } ?>>Sim</option>
                    <option value="-1"  <?php  if($rst["sol_cartao_f"] == '-1') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                  </select>
                </div></td>
                <td><div align="center">
                  <select name="sol_cartao_j" id="sol_cartao_j" class="form-control input-sm" style="width: 80px;">
                    <option value="0" <?php  if($rst["sol_cartao_j"] == '0') { ?>  selected="selected" <?php  } ?>>Sim</option>
                    <option value="-1"  <?php  if($rst["sol_cartao_j"] == '-1') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                  </select>
                </div></td>
                <td><div align="center">
                  <select name="sol_cartao_cheque" id="sol_cartao_cheque" class="form-control input-sm" style="width: 80px;">
                    <option value="0"   <?php  if($rst["sol_cartao_chequej"] == '0') { ?>   selected="selected" <?php  } ?>>Sim</option>
                    <option value="-1"  <?php  if($rst["sol_cartao_chequej"] == '-1') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                  </select>
                </div></td>
                <td><div align="center">
                  <select name="sol_cartao_chequej" id="sol_cartao_chequej" class="form-control input-sm" style="width: 80px;">
                    <option value="0" <?php  if($rst["cont_solic_cartao"] == '0') { ?>  selected="selected" <?php  } ?>>Sim</option>
                    <option value="-1"  <?php  if($rst["cont_solic_cartao"] == '-1') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                  </select>
                </div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="67" colspan="4" class="style104"><table width="600" border="0">
              <tr>
                <td><div align="center">Protocolo Eletr&ocirc;nico</div></td>
                <td><div align="center">Protocolo Eletr&ocirc;nico <br />
                  (Liberar Compras Antigas) </div></td>
                <td><div align="center">Menu Novo Creditall Pay</div></td>
                <td bgcolor="#FF0000"><div align="center"><span class="style104 style117">Acionar Cobran&ccedil;a</span></div></td>
				<td><div align="center">Libera<br>Link Pagamento</div></td>
              </tr>
              <tr>
                <td><div align="center">
                  <select id="cont_protocoloDigital" name="cont_protocoloDigital" class="form-control input-sm" style="width: 80px;">
                    <option value="0" <?php  if($cont_protoloDigital == '0'){?>selected="selected"<?php }?>>Sim</option>
                    <option value="1" <?php  if($cont_protoloDigital == '1'){?>selected="selected"<?php }?>>N&atilde;o</option>
                  </select>
                </div></td>
                <td><div align="center">
                  <select id="_protocoloDigitalLibera" name="_protocoloDigitalLibera" class="form-control input-sm" style="width: 80px;">
                    <option value="1" <?php  if($cont_LibCompraAnt == '1'){?>selected="selected"<?php }?>>Sim</option>
                    <option value="0" <?php  if($cont_LibCompraAnt == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                  </select>
                </div></td>
                <td><div align="center">
                  <select id="cont_menuNovo" name="cont_menuNovo" class="form-control input-sm" style="width: 80px;background: #242424; color: #fff;">
                    <option value="1" <?php  if($cont_menuNovo == '1'){?>selected="selected"<?php }?>>Sim</option>
                    <option value="0" <?php  if($cont_menuNovo == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                  </select>
                </div></td>
                <td><div align="center">
                  <select id="acionarcob" name="acionarcob" class="form-control input-sm" style="width: 80px;">
                    <option value="-1" <?php  if($_acionarcob == '-1'){?>selected="selected"<?php }?>>Sim</option>
                    <option value="0" <?php  if($_acionarcob == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                  </select>
                </div></td>
				<td>
					<div align="center">
						<select id="linkPagamento" name="linkPagamento" class="form-control input-sm" style="width: 80px;">
							<option value="-1" <?php  if($linkpagamento == '-1'){?>selected="selected"<?php }?>>Sim</option>
							<option value="0" <?php  if($linkpagamento == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
						</select>
					</div>
				</td>
              </tr>
            </table></td>
          </tr>
          
          
          <tr>
            <td  colspan="4" class="style104">&nbsp;</td>
        </tr>

          
          
          <tr>
            <td width="30%"></td>
          </tr>
      </table>


<table width="45%" class="table table-condensed table-bordered" border="0">
  <tr>
    <td align="center" bgcolor="#C0C0C0"><span class="style56">N&uacute;mero de Pontos de venda</span></td>
    <td align="center" bgcolor="#C0C0C0"><span class="style56">Boleto Banc&aacute;rio</span></td>
    <td align="center" bgcolor="#C0C0C0"><span class="style56">Valor de Ativa&ccedil;&atilde;o</span></td>
    <td align="center" bgcolor="#C0C0C0"><span class="style56">Tipo Venda CH</span></td>
    <td align="center" bgcolor="#C0C0C0"><span class="style56">Tipo Venda CRED.</span></td>
  </tr>
  <tr>
    <td align="center"> <select name="pontos" id="pontos" class="form-control input-sm" style="width: 80px;">
                                    <option value=""></option>
                                    <option value="1" <?php  if($rst["cont_pontosvenda"] == 1) { ?> selected="selected" <?php  } ?>>1</option>
                                    <option value="2" <?php  if($rst["cont_pontosvenda"] == 2) { ?> selected="selected" <?php  } ?>>2</option>
                                    <option value="3" <?php  if($rst["cont_pontosvenda"] == 3) { ?> selected="selected" <?php  } ?>>3</option>
                                    <option value="4" <?php  if($rst["cont_pontosvenda"] == 4) { ?> selected="selected" <?php  } ?>>4</option>
                                    <option value="5" <?php  if($rst["cont_pontosvenda"] == 5) { ?> selected="selected" <?php  } ?>>5</option>
                                    <option value="6" <?php  if($rst["cont_pontosvenda"] == 6) { ?> selected="selected" <?php  } ?>>6</option>
                                    <option value="7" <?php  if($rst["cont_pontosvenda"] == 7) { ?> selected="selected" <?php  } ?>>7</option>
                                    <option value="8" <?php  if($rst["cont_pontosvenda"] == 8) { ?> selected="selected" <?php  } ?>>8</option>
                                    <option value="9" <?php  if($rst["cont_pontosvenda"] == 9) { ?> selected="selected" <?php  } ?>>9</option>
                        </select></td>
    <td align="center"><select name="boleto" id="boleto" class="form-control input-sm" style="width: 150px;">
      <option value="1"  <?php  if($rst["contratante_boleto"] == 1) { ?> selected="selected" <?php  } ?>>Boleto Unico</option>
      <option value="2"  <?php  if($rst["contratante_boleto"] == 2) { ?> selected="selected" <?php  } ?>>Boleto Individual</option>
    </select></td>
    <td align="center"><input name="vl_ativacao" type="text" id="vl_ativacao" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" size="10" maxlength="10" value="<?=$rst["contratante_vlrAtivacao"];?>" class="form-control input-sm" style="width: 80px;"/>
                                  <input name="vl_ativacao2" type="hidden" id="vl_ativacao2" size="10" value="250,00" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)'/></td>
    <td align="center">
    	<select id="tipoVenda" name="tipoVenda" class="form-control input-sm">
        	<option value="0" <?php  if($cont_tipoVenda == 0){ echo 'selected';} ?>>CPF/CNPJ</option>
            <option value="1" <?php  if($cont_tipoVenda == 1){ echo 'selected';} ?>>Somente CPF</option>
            <option value="2" <?php  if($cont_tipoVenda == 2){ echo 'selected';} ?>>Somente CNPJ</option>        
        </select>    </td>
    
      <td align="center">
    	<select id="tipoVendacr" name="tipoVendacr" class="form-control input-sm">
        	<option value="0" <?php  if($cont_tipoVendacr == 0){ echo 'selected';} ?>>CPF/CNPJ</option>
            <option value="1" <?php  if($cont_tipoVendacr == 1){ echo 'selected';} ?>>Somente CPF</option>F
            <option value="2" <?php  if($cont_tipoVendacr == 2){ echo 'selected';} ?>>Somente CNPJ</option>        
        </select>    </td>
  </tr>
</table>
      </div>
    </div>
  </div>
 <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingSeven" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                      <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Situações Tributária</strong>
                                  </a>
                                </h4>
    </div>
                             
                              <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                <div class="panel-body">
                          <table width="722" border="0">
                                <tr>
                                  <td width="120"><span >
                                    <label>Tipo Tributa&ccedil;&atilde;o</label>
                                  </span></td>
                                  <td width="120"><span >
                                    <label>Notas Integrais</label>
                                  </span></td>
                                  <td width="82">                                   <span class="col-md-2"><label>
                                    <div align="center">CONFIS</div>
                                    </label>
                                  </span></td>
                                  <td width="72">                                    <span class="col-md-2"><label>
                                    <div align="center">PIS</div>
                                    </label>
                                  </span></td>
                                  <td width="63">                                    <span class="col-md-2"><label> 
                                    <div align="center">CSLL</div>
                                    </label>
                                  </span></td>
                                  <td width="65">                                   <span class="col-md-2"><label> 
                                    <div align="center">IR</div>
                                    </label>
                                  </span></td>
                            </tr>
                                <tr>
                                  <td><span >
                                    <select name="tributacao" id="tributacao"  class="form-control input-sm"  style="width:120px">
                                      <option  <?php  if($rst["cont_tributacao"] == '0') { ?>  selected="selected" <?php  } ?> value="0">Simples Nacional</option>
                                      <option <?php  if($rst["cont_tributacao"] == '1') { ?>  selected="selected" <?php  } ?> value="1">Lucro Real</option>
                                    </select>
                                  </span></td>
                                  <td><span >
                                    <select name="notacheia" id="notacheia"  class="form-control input-sm"  style="width:120px">
                                      <option  <?php  if($rst["cont_notacheia"] == '0') { ?>  selected="selected" <?php  } ?> value="0">Normal</option>
                                      <option <?php  if($rst["cont_notacheia"] == '-1') { ?>  selected="selected" <?php  } ?> value="-1">Integral</option>
                                    </select>
                                  </span></td>
                                  <td><div align="center">
                                    <input name="confis" type="text" id="confis" size="8" class="form-control input-sm"  value="<?=$_confis;?>"/>
                                  </div></td>
                                  <td><div align="center">
                                    <input name="pis" type="text" id="pis" size="8" class="form-control input-sm"  value="<?=$_pis;?>"/>
                                  </div></td>
                                  <td><div align="center">
                                    <input name="csll" type="text" id="csll" size="8" class="form-control input-sm"  value="<?=$_csll;?>"/>
                                  </div></td>
                                  <td><div align="center">
                                    <input name="ir" type="text" id="ir" size="8" class="form-control input-sm"  value="<?=$_ir;?>"/>
                                  </div></td>
                                </tr>
                              </table>
                                 
                          
                          </div>
                    </div>
  </div>             
 
                            <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingOne" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                   <span class="glyphicon glyphicon-chevron-right"></span> <strong>Cheque</strong>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body" style="padding: 3px; font-weight: normal;">
           
            <table width="100%"  border="0" bgcolor="#E2E2E2">
                                  <tr>
                                    <td colspan="7" ><table width="100%" border="0" style="font-size:12px">
                                      <tr bgcolor="#E2E2E2" class="table table-condensed table-bordered">
                                        <td colspan="2" bgcolor="#FFD18C" class="style56"><div align="center" class="style4" >Tx a Vista <span class="style55">%</span></div></td>
                                        <td colspan="2" bgcolor="#FFE7C1" class="style56"><div align="center" class="style4" >Tx  Prazo 7 dias <span class="style55">%</span></div></td>
                                        <td colspan="2" bgcolor="#FFD18C" class="style56"><div align="center" class="style109 style5">
                                          <div align="center" class="style4" >Tx  Prazo 30 dias <span class="style55">%</span></div>
                                        </div></td>
                                        <td colspan="2" bgcolor="#FFE7C1" class="style56"><div align="center" class="style109 style5">
                                          <div align="center" class="style109 style5">
                                            <div align="center" class="style4" >Tx  Prazo 45 dias <span class="style55">%</span></div>
                                          </div>
                                          </div></td>
                                        <td colspan="2" bgcolor="#FFD18C" class="style104"><div align="center" class="style109 style5">
                                          <div align="center" class="style109 style5">
                                            <div align="center" class="style109 style5">
                                              <div align="center" class="style4" >Tx  Prazo 46 a 100 dias <span class="style55">%</span></div>
                                            </div>
                                          </div>
                                        </div></td>
                                      </tr>
                                      <tr>
                                        <td bgcolor="#FFD18C"><div align="center"><strong>Creditall</strong></div></td>
                                        <td bgcolor="#FFD18C"><div align="center"><strong>Cliente</strong></div></td>
                                        <td width="175" bgcolor="#FFE7C1"><div align="center"><strong>Creditall</strong></div></td>
                                        <td width="223" bgcolor="#FFE7C1"><div align="center"><strong>Cliente</strong></div></td>
                                        <td width="175" bgcolor="#FFD18C"><div align="center"><strong>Creditall</strong></div></td>
                                        <td width="234" bgcolor="#FFD18C"><div align="center"><strong>Cliente</strong></div></td>
                                        <td width="186" bgcolor="#FFE7C1"><div align="center"><strong>Creditall</strong></div></td>
                                        <td width="186" bgcolor="#FFE7C1"><div align="center"><strong>Cliente</strong></div></td>
                                        <td width="203" bgcolor="#FFD18C"><div align="center"><strong>Creditall</strong></div></td>
                                        <td width="65" bgcolor="#FFD18C"><div align="center"><strong>Cliente</strong></div></td>
                                      </tr>
                                      <tr>
                                        <td width="175" height="54" bgcolor="#FFD18C"><div align="center">
                                          <input name="taxavistaCreditall" type="text" id="taxavistaCreditall" size="10" value="<?=number_format($cont_avistaCreditall,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </div></td>
                                        <td width="175" bgcolor="#FFD18C"><div align="center">
                                          <input name="taxavista" type="text" id="taxavista" size="10" value="<?=number_format($rst["cont_avista"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                          <span class="style55">
                                          <input name="taxavista2" type="hidden" id="taxavista2" size="10" value="<?=number_format($taxavista,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)'/>
                                          </span></div></td>
                                        <td bgcolor="#FFE7C1"><div align="center">
                                          <input name="taxavista7Creditall" type="text" id="taxavista7Creditall" size="10" value="<?=number_format($cont_avista7Creditall,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </div></td>
                                        <td bgcolor="#FFE7C1"><div align="center">
                                          <input name="taxavista7" type="text" id="taxavista7" size="10" value="<?=number_format($rst["cont_avista7"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                          <input name="taxavista72" type="hidden" id="taxavista72" size="10" value="<?=number_format($taxavista7,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)'/>
                                        </div></td>
                                        <td bgcolor="#FFD18C"><div align="center">
                                          <input name="taxaprazo30Creditall" type="text" id="taxaprazo30Creditall" size="10" value="<?=number_format($cont_prazoCreditall,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </div></td>
                                        <td bgcolor="#FFD18C"><div align="center">
                                          <input name="taxaprazo30" type="text" id="taxaprazo30" size="10" value="<?=number_format($rst["cont_prazo"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                          <input name="taxaprazo2" type="hidden" id="taxaprazo2" size="10" value="<?=number_format($taxaprazo,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)'/>
                                        </div></td>
                                        <td bgcolor="#FFE7C1"><div align="center"><span class="style109">
                                          <input name="taxaprazo45Creditall" type="text" id="taxaprazo45Creditall" size="10" value="<?=number_format($cont_prazoSeisCreditall,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </span></div></td>
                                        <td bgcolor="#FFE7C1"><div align="center"><span class="style109">
                                          <input name="taxaprazo45" type="text" id="taxaprazo45" size="10" value="<?=number_format($rst["cont_prazoSeis"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </span></div></td>
                                        <td bgcolor="#FFD18C"><div align="center"><span class="style109">
                                          <input name="taxaprazo100Creditall" type="text" id="taxaprazo100Creditall" size="10" value="<?=number_format($cont_prazoCemCreditall,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 65px;"/>
                                        </span></div></td>
                                        <td bgcolor="#FFD18C"><div align="center"><span class="style109">
                                          <input name="taxaprazo100" type="text" id="taxaprazo100" size="10" value="<?=number_format($rst["cont_prazoCem"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 65px;"/>
                                        </span></div></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">&nbsp;</td>
                                        <td colspan="2">&nbsp;</td>
                                        <td colspan="2">&nbsp;</td>
                                        <td colspan="2">&nbsp;</td>
                                        <td colspan="2">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" bgcolor="#FFE7C1"><div align="center"><span class="style4">Tx <span class="style109">Prazo A e B </span> <span class="style55">%</span></span></div></td>
                                        <td colspan="2" bgcolor="#FFD18C"><div align="center"><span class="style4">Tx <span class="style109">Prazo A </span> <span class="style55">%</span></span></div></td>
                                        <td colspan="2" bgcolor="#FFE7C1"><div align="center"><span class="style4">Tx <span class="style109">Prazo B </span> <span class="style55">%</span></span></div></td>
                                        <td colspan="2" bgcolor="#FFD18C"><div align="center"><span class="style4">Tx ao m&ecirc;s <span class="style109"> </span> <span class="style55">%</span></span></div></td>
                                        <td colspan="2"><div align="center"><strong>D&eacute;bito em Dep&oacute;sito</strong></div></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" bgcolor="#FFE7C1"><div align="center">Parcelas de X at&eacute; XX</div></td>
                                        <td width="174" bgcolor="#FFD18C"><div align="center"><strong>Creditall</strong></div></td>
                                        <td width="222" bgcolor="#FFD18C"><div align="center"><strong>Cliente</strong></div></td>
                                        <td width="177" bgcolor="#FFE7C1"><div align="center"><strong>Creditall</strong></div></td>
                                        <td width="237" bgcolor="#FFE7C1"><div align="center"><strong>Cliente</strong></div></td>
                                        <td width="177" bgcolor="#FFD18C"><div align="center"><strong>Creditall</strong></div></td>
                                        <td width="237" bgcolor="#FFD18C"><div align="center"><strong>Cliente</strong></div></td>
                                        <td colspan="2"><div align="center"></div></td>
                                      </tr>
                                      <tr>
                                        <td height="35" colspan="2" bgcolor="#FFE7C1">de
                                          <select name="parcela_a" id="parcela_a" class="form-control input-sm" style="width: 50px;">
                                            <option value="2">2</option>
                                          </select>
at&eacute;
<select name="parcela_b" id="parcela_b" class="form-control input-sm" style="width: 50px;">
  <option value="2" <?php  if($rst['cont_prazo2'] == 2) { ?>selected="selected"<?php  } ?>>2</option>
  <option value="3" <?php  if($rst['cont_prazo2'] == 3) { ?>selected="selected"<?php  } ?>>3</option>
  <option value="4" <?php  if($rst['cont_prazo2'] == 4) { ?>selected="selected"<?php  } ?>>4</option>
  <option value="5" <?php  if($rst['cont_prazo2'] == 5) { ?>selected="selected"<?php  } ?>>5</option>
  <option value="6" <?php  if($rst['cont_prazo2'] == 6) { ?>selected="selected"<?php  } ?>>6</option>
  <option value="7" <?php  if($rst['cont_prazo2'] == 7) { ?>selected="selected"<?php  } ?>>7</option>
  <option value="8" <?php  if($rst['cont_prazo2'] == 8) { ?>selected="selected"<?php  } ?>>8</option>
  <option value="9" <?php  if($rst['cont_prazo2'] == 9) { ?>selected="selected"<?php  } ?>>9</option>
  <option value="10" <?php  if($rst['cont_prazo2'] == 10) { ?>selected="selected"<?php  } ?>>10</option>
  <option value="11" <?php  if($rst['cont_prazo2'] == 11) { ?>selected="selected"<?php  } ?>>11</option>
  <option value="12" <?php  if($rst['cont_prazo2'] == 12) { ?>selected="selected"<?php  } ?>>12</option>
</select></td>
                                        <td bgcolor="#FFD18C"><div align="center">
                                            <input name="taxaACreditall" type="text" id="taxaACreditall" size="10" value="<?=number_format($cont_prazoACreditall,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </div></td>
                                        <td bgcolor="#FFD18C"><div align="center">
                                            <input name="taxaA" type="text" id="taxaA" size="10" value="<?=number_format($rst["cont_prazoA"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </div></td>
                                        <td bgcolor="#FFE7C1"><div align="center">
                                            <input name="taxaprazo_bCreditall" type="text" id="taxaprazo_bCreditall" size="10" value="<?=number_format($conta_prazoBCreditall,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </div></td>
                                        <td bgcolor="#FFE7C1"><div align="center">
                                            <input name="taxaprazo_b" type="text" id="taxaprazo_b" size="10" value="<?=number_format($rst["conta_prazoB"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </div></td>
                                        <td bgcolor="#FFD18C"><div align="center">
                                          <input name="taxaAM2" type="text" id="taxaAM2" size="10" value="<?=number_format($rst["cont_taxachAM_credital"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </div></td>
                                        <td bgcolor="#FFD18C"><div align="center">
                                          <input name="taxaAM" type="text" id="taxaAM" size="10" value="<?=number_format($rst["cont_taxachAM"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                        </div></td>
                                        <td colspan="2"><div align="center">
                                          <select name="depositoch" id="depositoch" class="form-control input-sm" style="width: 70px;">
                                            <option value="0" <?php  if($rst["cont_debitoch"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                            <option value="-1"  <?php  if($rst["cont_debitoch"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                          </select>
                                        </div></td>
                                      </tr>
                                      <tr>
                                        <td colspan="10">&nbsp;</td>
                                      </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td width="488" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Valor da Consulta Cancelada</span></div></td>
                                    <td width="332" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Valor da               Consulta Evitada</span></div></td>
                                    <td width="400" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Valor por Aprova&ccedil;&atilde;o Cheque</span></div></td>
                                    <td colspan="2" align="center" bgcolor="#C0C0C0"><span class="style56">Mensalidade Cheque</span></td>
                                    <td colspan="2" align="center" bgcolor="#C0C0C0"><div align=""></div></td>
              </tr>
                                  <tr>
                                    <td><div align="center">
                                      <input name="vlraprovada" type="hidden" id="vlraprovada" size="10" value="<?=number_format($rst["cont_aprovada"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)'/>
                                      <input name="vlraprovada2" type="hidden" id="vlraprovada2" size="10" value="<?=number_format($vlrAprovado,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)'/>
                                      <input name="vlrcancelada" type="text" id="vlrcancelada" size="10" value="<?=number_format($rst["cont_cancelada"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                      <input name="vlrcancelada2" type="hidden" id="vlrcancelada2" size="10" value="<?=number_format($vlrCancelado,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)'/>
                                      </div></td>
                                    <td><div align="center">
                                      <input name="vlrevitada" type="text" id="vlrevitada" size="10" value="<?=number_format($rst["cont_evitada"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;" />
                                      <input name="vlrevitada2" type="hidden" id="vlrevitada2" size="10" value="<?=number_format($vlrEvitado,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' />
                                      </div></td>
                                    <td><div align="center"><span class="style109"><span class="">
                                      <input name="vlrAprovadoCheque" type="text" id="vlrAprovadoCheque" size="10" value="<?=number_format($rst["contratante_ValorAprovacaoCheque"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                      </span></span></span></div></td>
                                    <td colspan="2" align="center"><input name="mensalidade" type="text" id="mensalidade" size="10" value="<?=number_format($rst["contratante__vlrMensal"],2,',','.');?>" maxlength="10"  class="form-control input-sm" style="width: 80px;"/>
                                        </span>
                                        <input name="mensalidade2" type="hidden" id="mensalidade2" size="10" value="49,90" maxlength="10"  readonly="readonly"/></td>
                                    <td colspan="2" align="center"><div align=""></div></td>
              </tr>
                                  <tr>
                                    <td bgcolor="#C0C0C0"><div align="center" class="style109">
                                      <div align="center"><span class="style56">Repasse</span></div>
                                      </div></td>
                                    <td align="center" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"><span class="style104">Leitura CMC7</span></span></div></td>
                                    <td bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"><span class="style104">WebCam</span></span></div></td>
                                    <td colspan="2" bgcolor="#C0C0C0"><span class="style56"><span class="style109">Libera&ccedil;&atilde;o Cheque Terceiro</span></span></td>
                                    <td colspan="2" align="center" bgcolor="#C0C0C0"><span class="style104"><span class="style56">Dias para Ressarcimento DT Primeiro Carimbo</span></td>
              </tr>
                                  <tr>
                                    <td> <div align="center">
                                      <select name="repassech" id="repassech" class="form-control input-sm" style="width: 80px;">
                                        <option value="0" <?php  if($rst["cont_repasse"] == 0) { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="1"  <?php  if($rst["cont_repasse"] == 1) { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        <option value="2"  <?php  if($rst["cont_repasse"] == 2) { ?>  selected="selected" <?php  } ?>>Livre</option>
                                      </select>
                                      </div></td>
                                    <td align="center"><div align="center">
                                        <select name="leitora" id="leitora" class="form-control input-sm" style="width: 70px;">
                                          <option value="0"  <?php  if($rst["contratante_leitura"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1" <?php  if($rst["contratante_leitura"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                    </div></td>
                                    <td>   <div align="center">
                                      <select name="webcam2" id="webcam2" class="form-control input-sm" style="width: 70px;">
                                        <option value="0" <?php  if($rst["contratante_webcamCheque"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1"  <?php  if($rst["contratante_webcamCheque"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select>
                                      </div></td>
                                    <td colspan="2"><div align="center"><span class="style104">
                                      <select name="chterceiro" id="chterceiro" class="form-control input-sm" style="width: 70px;">
                                        <option value="0" <?php  if($rst["contratante_chterceiro"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1"  <?php  if($rst["contratante_chterceiro"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select>
                                    </span></div></td>
                                    <td colspan="2" align="center"><input name="dias_ressarcimentoch" type="text"   class="form-control input-sm" id="dias_ressarcimentoch" value="<?=$rst["cont_diasch_ressarcimento"];?>" size="10"  /></td>
              </tr>
                                  <tr>
                                    <td align="center" bgcolor="#C0C0C0"><div align="center" class="style54"><span class="style56">Libera Juros At&eacute;</span></div></td>
                                    <td align="center" bgcolor="#C0C0C0"><div align="center" class="style54"><span class="style56">Repassar Taxas (Liberar Juro)</span></div></td>
                                    <td align="center" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"><span class="style104">Identidade</span> Terceiro</span></div></td>
                                    <td colspan="2" align="center" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"><span class="style104">Tela Simplificada</span></span></div></td>
                                    <td colspan="2" align="center" bgcolor="#C0C0C0"><span class="style56">Prazo envio dos Cheques</span></td>
              </tr>
                                  <tr>
                                    <td align="center"><div align="center">
                                      <span class="">
                                      <?=$liberajuro_ch;?>
                                      <select name="liberajuro_ch" id="liberajuro_ch" class="form-control input-sm" style="width: 70px;">
                                        <option value="0"  <?php  if($liberajuro_ch == 0) { ?>selected="selected"<?php  }?>>0</option>
                                        <option value="1"  <?php  if($liberajuro_ch == 1) { ?>selected="selected"<?php  }?>>1</option>
                                        <option value="2"  <?php  if($liberajuro_ch == 2) { ?>selected="selected"<?php  }?>>2</option>
                                        <option value="3"  <?php  if($liberajuro_ch == 3) { ?>selected="selected"<?php  }?>>3</option>
                                        <option value="4"  <?php  if($liberajuro_ch == 4) { ?>selected="selected"<?php  }?>>4</option>
                                        <option value="5"  <?php  if($liberajuro_ch == 5) { ?>selected="selected"<?php  }?>>5</option>
                                        <option value="6"  <?php  if($liberajuro_ch == 6) { ?>selected="selected"<?php  }?>>6</option>
                                        <option value="7"  <?php  if($liberajuro_ch == 7) { ?>selected="selected"<?php  }?>>7</option>
                                        <option value="8"  <?php  if($liberajuro_ch == 8) { ?>selected="selected"<?php  }?>>8</option>
                                        <option value="9"  <?php  if($liberajuro_ch == 9) { ?>selected="selected"<?php  }?>>9</option>
                                        <option value="10"  <?php  if($liberajuro_ch == 10) { ?>selected="selected"<?php  }?>>10</option>
                                        <option value="11"  <?php  if($liberajuro_ch == 11) { ?>selected="selected"<?php  }?>>11</option>
                                        <option value="12"  <?php  if($liberajuro_ch == 12) { ?>selected="selected"<?php  }?>>12</option>
                                      </select>
                                      </span></div></td>
                                    <td align="center"><div align="center">
                               
                                      <select name="repassalibera_ch" id="repassalibera_ch" class="form-control input-sm" style="width: 70px;">
                                        <option value="0" <?php  if($rst["cont_repasseate_cad_ch"] == 0) { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1"  <?php  if($rst["cont_repasseate_cad_ch"] == "-1") { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select>
                                   </div></td>
                                    <td align="center"><div align="center">
                                    
                                      <select name="identidade" id="identidade" class="form-control input-sm" style="width: 70px;">
                                        <option value="0" <?php  if($rst["contratante_IdentidadeCheque"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1"  <?php  if($rst["contratante_IdentidadeCheque"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select>
                                     </div></td>
                                    <td colspan="2" align="center"><div align="center">
                          
                                      <select name="tela_simplificadach" id="tela_simplificadach" class="form-control input-sm" style="width: 70px;">
                                        <option value="0"  <?php  if($rst["contratante_telach_resumida"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1" <?php  if($rst["contratante_telach_resumida"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select>
                                 </div></td>
                                    <td colspan="2" align="center"> 
                                    <input name="prazo" type="text" class="form-control input-sm" style="width: 80px;" id="prazo"  value="<?=$rst["contratante_prazocheques"];?>"   />                                  </td>
              </tr>
                                  <tr>
                                    <td align="center" bgcolor="#C0C0C0"><div align="center" class="style109">
                                      <div align=""><span class="style56">Parcelamento Cheque</span></div>
                                      </div></td>
                                    <td align="center" bgcolor="#C0C0C0"><span class="style56">Garantia das Alineas</span></td>
                                    <td align="center" bgcolor="#C0C0C0"><span class="style56">1&ordm; Cheque (Dias)</span></td>
                                    <td colspan="2" align="center" bgcolor="#C0C0C0"><span class="style56">Fator de Equilíbrio Cheque</span></td>
                                    <td colspan="2" align="center" bgcolor="#C0C0C0"></td>
              </tr>
                                  <tr>
                                    <td align="center"><?php   $parcela = $rst["cont_parcela"];  ?>
                                      <select name="parcelamento" id="parcelamento" class="form-control input-sm" style="width: 80px;">
                                        <option value="1" <?php  if($parcela == 1) { ?>selected="selected"<?php  }?>>1</option>
                                        <option value="2"  <?php  if($parcela == 2) { ?>selected="selected"<?php  }?>>2</option>
                                        <option value="3"  <?php  if($parcela == 3) { ?>selected="selected"<?php  }?>>3</option>
                                        <option value="4"  <?php  if($parcela == 4) { ?>selected="selected"<?php  }?>>4</option>
                                        <option value="5"  <?php  if($parcela == 5) { ?>selected="selected"<?php  }?>>5</option>
                                        <option value="6"  <?php  if($parcela == 6) { ?>selected="selected"<?php  }?>>6</option>
                                        <option value="7"  <?php  if($parcela == 7) { ?>selected="selected"<?php  }?>>7</option>
                                        <option value="8" <?php  if($parcela == 8) { ?>selected="selected"<?php  }?>>8</option>
                                        <option value="9"  <?php  if($parcela == 9) { ?>selected="selected"<?php  }?>>9</option>
                                        <option value="10"  <?php  if($parcela == 10) { ?>selected="selected"<?php  }?>>10</option>
                                        <option value="11"  <?php  if($parcela == 11) { ?>selected="selected"<?php  }?>>11</option>
                                        <option value="12"  <?php  if($parcela == 12) { ?>selected="selected"<?php  }?>>12</option>
                                        <option value="13"  <?php  if($parcela == 13) { ?>selected="selected"<?php  }?>>13</option>
                                        <option value="14"  <?php  if($parcela == 14) { ?>selected="selected"<?php  }?>>14</option>
                                        <option value="15"  <?php  if($parcela == 15) { ?>selected="selected"<?php  }?>>15</option>
                                        <option value="16"  <?php  if($parcela == 16) { ?>selected="selected"<?php  }?>>16</option>
                                        <option value="17"  <?php  if($parcela == 17) { ?>selected="selected"<?php  }?>>17</option>
                                        <option value="18"  <?php  if($parcela == 18) { ?>selected="selected"<?php  }?>>18</option>
                                        <option value="19"  <?php  if($parcela == 19) { ?>selected="selected"<?php  }?>>19</option>
                                        <option value="20"  <?php  if($parcela == 20) { ?>selected="selected"<?php  }?>>20</option>
                                        <option value="21"  <?php  if($parcela == 21) { ?>selected="selected"<?php  }?>>21</option>
                                        <option value="22"  <?php  if($parcela == 22) { ?>selected="selected"<?php  }?>>22</option>
                                        <option value="23"  <?php  if($parcela == 23) { ?>selected="selected"<?php  }?>>23</option>
                                        <option value="24"  <?php  if($parcela == 24) { ?>selected="selected"<?php  }?>>24</option>
                                        <option value="25"  <?php  if($parcela == 25) { ?>selected="selected"<?php  }?>>25</option>
                                        <option value="26"  <?php  if($parcela == 26) { ?>selected="selected"<?php  }?>>26</option>
                                        <option value="27"  <?php  if($parcela == 27) { ?>selected="selected"<?php  }?>>27</option>
                                        <option value="28"  <?php  if($parcela == 28) { ?>selected="selected"<?php  }?>>28</option>
                                        <option value="29"  <?php  if($parcela == 29) { ?>selected="selected"<?php  }?>>29</option>
                                        <option value="30"  <?php  if($parcela == 30) { ?>selected="selected"<?php  }?>>30</option>
                                        <option value="31"  <?php  if($parcela == 31) { ?>selected="selected"<?php  }?>>31</option>
                                        <option value="32"  <?php  if($parcela == 32) { ?>selected="selected"<?php  }?>>32</option>
                                        <option value="33"  <?php  if($parcela == 33) { ?>selected="selected"<?php  }?>>33</option>
                                        <option value="34"  <?php  if($parcela == 34) { ?>selected="selected"<?php  }?>>34</option>
                                        <option value="35"  <?php  if($parcela == 35) { ?>selected="selected"<?php  }?>>35</option>
                                        <option value="36"  <?php  if($parcela == 36) { ?>selected="selected"<?php  }?>>36</option>
                                      </select></td>
                                    <td align="center"><input name="alinea" type="text" class="form-control input-sm" style="width: 80px;" id="alinea"  value="100"  disabled="disabled"/>
                                      <span class="style55">%</span></td>
                                    <td align="center"><input name="chequeunico" type="text" class="form-control input-sm" style="width: 80px;" id="chequeunico"  value="<?=$rst["cont_diasch"];?>"   /></td>
									
                                    <td colspan="2" align="center"><input type="text" name="ponto_equilibrio_cheque" id="ponto_equilibrio_cheque"  value="<?=$rst['contratante_ponto_equilibrio_cheque'];?>"  class="form-control input-sm" style="width: 80px;" /></td>
									
									

                                    <td colspan="2" align="center"></td>
              </tr>
                                  <tr>
                                    <td align="center" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"><span class="style104">Validador documento (cartao, chn, identidade,profissao)</span></span></div></td>
                                    <td align="center" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"><span class="style104">Solicita Data Nascimento</span></span></div></td>
                                    <td align="center" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"><span class="style104">Libera Corte Terceiro</span></span></div></td>
                                    <td width="176" align="center" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style104 style5"><span class="style116">** </span>Bloqueia Venda com <span class="style116">** </span>Vencimento 10 dias aberto</span></div></td>
                                    <td width="155" align="center" bgcolor="#C0C0C0"><span class="style104"><span class="style104 style5"><span class="style116">** </span></span>Bloqueia Venda na Troca<span class="style104 style5"><span class="style116">** </span></span> Documento no mesmo dia </span></td>
                                    <td colspan="2" align="center" bgcolor="#C0C0C0"><span class="style104"><span class="style104 style5"><span class="style116">** </span></span>Solicita CEP / N&uacute;mero / Email <span class="style104 style5"><span class="style116">**</span></span></span></td>
                                  </tr>
                                


                                  <tr>
                                    <td align="center"><div align="center">
                                        <select name="lb_cartao_ch" id="lb_cartao_ch" class="form-control input-sm" style="width: 70px;">
                                          <option value="0"  <?php  if($rst["cont_cartao_ch_libera"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1" <?php  if($rst["cont_cartao_ch_libera"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                    </div></td>
                                    <td align="center"><div align="center">
                                        <select name="lb_data_ch" id="lb_data_ch" class="form-control input-sm" style="width: 70px;">
                                          <option value="0"  <?php  if($rst["cont_dt_ch_libera"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1" <?php  if($rst["cont_dt_ch_libera"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                    </div></td>
                                    <td align="center"><div align="center">
                                        <select name="lb_corte_terceiro" id="lb_corte_terceiro" class="form-control input-sm" style="width: 70px;">
                                          <option value="0"  <?php  if($rst["cont_corte_terceiro"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1" <?php  if($rst["cont_corte_terceiro"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                    </div></td>
                                    <td align="center"><div align="center">
                                      <select name="bloqueioDez" id="bloqueioDez" class="form-control input-sm" style="width: 70px;">
                                        <option value="0"  <?php  if($contp_bloqueioDez == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1" <?php  if($contp_bloqueioDez == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select>
                                    </div></td>
                                    <td align="center"><select name="bloqueiotroca" id="bloqueiotroca" class="form-control input-sm" style="width: 70px;">
                                      <option value="0"  <?php  if($contp_bloqueioTroca == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                      <option value="-1" <?php  if($contp_bloqueioTroca == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                    </select></td>
                                    <td width="412" align="center"><select name="cep_ch" id="cep_ch" class="form-control input-sm" style="width: 70px;">
                                      <option value="0"  <?php  if($cep_ch == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                      <option value="-1" <?php  if($cep_ch == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                    </select></td>
                                        

                                    <td width="1" align="center">&nbsp;</td>
                                  </tr>
                                <table width="100%" class="table table-condensed table-bordered" border="0" style="background: #242424;">
                                  <tr>
                                    <td colspan="7" bgcolor="#242424" style="color: #fff;"><div align="center" class="style118">CreditallPay</div></td>
                                  </tr>
                                  <tr class="style56" style="color: #fff;"> 
                                    <td width="82" bgcolor="#242424"><div align="center">OCR</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">DOC + SELFIE</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">DOC</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">CHEQUE</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">CART&Atilde;O</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">QUIZ</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">ACP</div></td>
                                  </tr>
                                    
                                      <td height="30" class="style104"><div align="center">
                                          <select id="cont_qrcodeCheque" name="cont_qrcodeCheque" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                              <option value="1" <?php  if($cont_qrcodeCheque == '1'){?>selected="selected"<?php }?>>Sim</option>
                                              <option value="0" <?php  if($cont_qrcodeCheque == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                          </select>
                                          </div>                                      </td>

                                      <td height="30" class="style104"><div align="center">
                                          <select id="ocrSelfie" name="ocrSelfie" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                              <option value="1" <?php  if($ocrSelfie == '1'){?>selected="selected"<?php }?>>Sim</option>
                                              <option value="0" <?php  if($ocrSelfie == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                          </select>
                                          </div>                                      </td>

                                      <td height="30" class="style104"><div align="center">
                                          <select id="ocrDoc" name="ocrDoc" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                              <option value="1" <?php  if($ocrDoc == '1'){?>selected="selected"<?php }?>>Sim</option>
                                              <option value="0" <?php  if($ocrDoc == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                          </select>
                                          </div>                                      </td>
                                     
                                      <td height="30" class="style104"><div align="center">
                                          <select id="ocrCheque" name="ocrCheque" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                              <option value="1" <?php  if($ocrCheque == '1'){?>selected="selected"<?php }?>>Sim</option>
                                              <option value="0" <?php  if($ocrCheque == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                          </select>
                                          </div>                                      </td>

                                      <td height="30" class="style104"><div align="center">
                                        <select id="cont_cartaoch" name="cont_cartaoch" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                            <option value="1" <?php  if($cont_cartaoch == '1'){?>selected="selected"<?php }?>>Sim</option>
                                            <option value="0" <?php  if($cont_cartaoch == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                        </select>
                                        </div>                                      </td>

                                      <td height="30" class="style104"><div align="center">
                                        <select id="libera_cheque" name="libera_cheque" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                            <option value="0" <?php  if($quiz_liberaCH == '0'){?>selected="selected"<?php }?>>Sim</option>
                                            <option value="1" <?php  if($quiz_liberaCH == '1'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                        </select>
                                        </div>                                      </td>
                                      <td height="30" class="style104"><div align="center">
                                        <select id="cont_acpch" name="cont_acpch" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                            <option value="1" <?php  if($cont_acpch == '1'){?>selected="selected"<?php }?>>Sim</option>
                                            <option value="0" <?php  if($cont_acpch == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                        </select><br>
                                        <p style="color: #fff; margin-top: 10px;">Busca apartir de R$</p>
                                        <input type="text" name="limiteMinimoAcpCh" id="limiteMinimoAcpCh" size="10" value="" placeholder="0,00" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress="return SomenteNumero(event)" class="form-control input-sm text-center" style="background: #242424; color: #fff;">
                                        </div>                                      </td>
                                                                        
                                  </table>
                                </table>
                                
                                </div>
                              </div>
                                    
                                
    </div>
                            <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingTwo" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                      <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Mosaico</strong>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
             <table width="100%" class="table table-condensed table-bordered" border="0">
                                    <tr>
                                      <td colspan="2" align="center" class="style56 style7"><div align="left">Libera <strong>Mosaico Cr&eacute;dito:</strong></div>                                        <div align="left"></div></td>
                                      <td align="center"><div align="left"><span class="style109">
                                        <select name="prelibera" id="prelibera" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($rst['cont_preanalise_libera'] == 0) { ?>selected="selected"<?php  }?>>Não</option>
                                          <option value="-1" <?php  if($rst['cont_preanalise_libera'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                      </span></div>                                        <div align="left"></div></td>
                                      <td colspan="2" align="center" class="style56 style7"><div align="right">
                                        <div align="right">Libera <strong>Anal&iacute;tico:</strong></div>
                                      </div></td>
                                      <td align="center" class="style56 style7"><div align="left"><span class="style109">
                                        <select name="preliberaAnalitico" id="preliberaAnalitico" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($preliberaAnalitico == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($preliberaAnalitico == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                      </span></div></td>
                                      <td align="center" class="style56 style7">&nbsp;</td>
                                      <td align="center" class="style56 style7"><div align="right">Libera Busca <strong> S&oacute;cios:</strong></div></td>
                                      <td align="center"><div align="center"><span class="style109">
                                        <select name="contp_mosaicosocio" id="contp_mosaicosocio" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($contp_mosaicosocio == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($contp_mosaicosocio == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                      </span></div></td>
                                    </tr>
                                    <tr class="style56 style7">
                                      <td colspan="2" align="center"><div align="left">Libera<strong> Mosaico AntiFraude</strong>:</div>                                        <div align="left"></div></td>
                                      <td align="center"><div align="left">
                                        <select name="contp_antifraude" id="contp_antifraude"  class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($contp_antifraude == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1"  <?php  if($contp_antifraude == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                      </div>                                        <div align="left"></div></td>
                                      <td colspan="3" align="center">&nbsp;</td>
                                      <td align="center">Boa Vista</td>
                                      <td align="center">Serasa</td>
                                      <td align="center">Spc Brasil</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center" class="style56 style7"><div align="left">Libera <strong>Mosaico Localize</strong>:</div>                                        <div align="left"></div></td>
                                      <td align="center"><div align="left">
                                        <select name="contp_localize" id="contp_localize"  class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($contp_localize == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1"  <?php  if($contp_localize == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                      </div>                                        <div align="left"></div></td>
                                      <td colspan="3" align="center" class="style56 style7"><div align="right">Acessa Base de Dados Restritivo<strong> Localize</strong>=&gt;</div>
                                      <div align="left"></div>                                        <div align="left"></div></td>
                                      <td align="center"><select name="contp_localizabaseACP" id="contp_localizabaseACP"  class="form-control input-sm" style="width: 80px;">
                                        <option value="0" <?php  if($contp_localizabaseACP == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1"  <?php  if($contp_localizabaseACP == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select></td>
                                      <td align="center"><select name="contp_localizabaseSerasa" id="contp_localizabaseSerasa"  class="form-control input-sm" style="width: 80px;">
                                        <option value="0" <?php  if($contp_localizabaseSerasa == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1"  <?php  if($contp_localizabaseSerasa == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select></td>
                                      <td align="center"><select name="contp_localizabaseBrasil" id="contp_localizabaseBrasil"  class="form-control input-sm" style="width: 80px;">
                                        <option value="0" <?php  if($contp_localizabaseBrasil == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1"  <?php  if($contp_localizabaseBrasil == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center" class="style56 style7"><div align="left">Libera<strong> Pre An&aacute;lise</strong>:</div>
                                      <div align="left"></div></td>
                                      <td align="center"><div align="left">
                                          <select name="contp_preanlise" id="contp_preanlise"  class="form-control input-sm" style="width: 80px;">
                                            <option value="0" <?php  if($contp_preanlise == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                            <option value="-1"  <?php  if($contp_preanlise == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                          </select>
                                        </div>
                                          <div align="left"></div></td>
                                      <td colspan="3" align="center" class="style56 style7"><div align="right">Dias para cobran&ccedil;a <strong> Mosaico</strong>=&gt;</div></td>
                                      <td align="center"><input name="contp_diaspreanalise" type="text" id="contp_diaspreanalise" size="10" 
                                      value="<?=$contp_diaspreanalise;?>" maxlength="10" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/></td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center" bgcolor="#C0C0C0"><span class="style56 style7">Vlr Consulta <strong>Mosaico Cr&eacute;dito</strong> Sint&eacute;tico e <strong>Pre An&aacute;lise</strong></span></td>
                                      <td colspan="2" align="center" bgcolor="#C0C0C0"><div align="center"><span class="style56 style7">Vlr Consulta<strong> Mosaico Cr&eacute;dito</strong> Analit&iacute;co</span></div></td>
                                      <td align="center" bgcolor="#C0C0C0"><span class="style7">Vlr Consulta<strong> S&oacute;cios</strong></span></td>
                                      <td colspan="2" align="center" bgcolor="#C0C0C0"><span class="style56 style7">Vlr Consulta<strong> Mosaico AntiFraude</strong></span></td>
                                      <td colspan="2" align="center" bgcolor="#C0C0C0"><span class="style56 style7">Vlr Consulta<strong> Mosaico Localize</strong></span></td>
               </tr>
                                    <tr class="style56 style7">
                                      <td width="10%" align="center">Valor Aprovado CPF</td>
                                      <td width="12%" align="center"><span class="style104">
                                        <input name="sintetico" type="hidden" id="sintetico" size="10" value="<?=number_format($rst["contratante_vlrSintetica"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span>Valor Aprovado CNPJ</td>
                                      <td width="9%" align="center">Valor Aprovado CPF</td>
                                      <td width="11%" align="center">Valor Aprovado CNPJ</td>
                                      <td width="11%" align="center">Valor</td>
                                      <td width="10%" align="center">CPF</td>
                                      <td width="12%" align="center">CNPJ</td>
                                      <td width="11%" align="center">CPF</td>
                                      <td width="14%" align="center">CNPJ</td>
                                    </tr>
                                    <tr>
                                      <td align="center"><input name="prevalor" type="text" class="form-control input-sm" style="width: 80px;" id="prevalor"  value="<?=number_format($rst["cont_preanalise_valor"],2,',','.');?>" /></td>
                                      <td align="center"><span class="style104"><span class="">
                                        <input name="contp_debitomosaicoScnpj" type="text" id="contp_debitomosaicoScnpj" size="10" value="<?=number_format($contp_debitomosaicoScnpj,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span></span></td>
                                      <td align="center"><input name="contp_debitomosaicoAcpf" type="text" id="contp_debitomosaicoAcpf" size="10" value="<?=number_format($contp_debitomosaicoAcpf,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/></td>
                                      <td align="center"><input name="contp_debitomosaicoAcnpj" type="text" id="contp_debitomosaicoAcnpj" size="10" value="<?=number_format($contp_debitomosaicoAcnpj,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/></td>
                                      <td align="center"><input name="contp_debitosocios" type="text" id="contp_debitosocios" size="10" value="<?=number_format($contp_debitosocios,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/></td>
                                      <td align="center"><input name="contp_debitoantifraudecpf " type="text" id="contp_debitoantifraudecpf" size="10" value="<?=number_format($contp_debitoantifraudecpf ,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/></td>
                                      <td align="center"><input name="contp_debitoantifraudecnpj" type="text" id="contp_debitoantifraudecnpj" size="10" value="<?=number_format($contp_debitoantifraudecnpj,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/></td>
                                      <td align="center"><input name="contp_localizadebitocpf" type="text" id="contp_localizadebitocpf" size="10" value="<?=number_format($contp_localizadebitocpf,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/></td>
                                      <td align="center"><input name="contp_localizadebitocnpj" type="text" id="contp_localizadebitocnpj" size="10" value="<?=number_format($contp_localizadebitocnpj,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                        <span class="style104">
                                        <input name="detalhado" type="hidden" id="detalhado" size="10" value="<?=number_format($rst["contratante_vlrDetalhada"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                        <input name="completo" type="hidden" id="completo" size="10" value="<?=number_format($rst["contratante_vlrCompleta"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span></td>
               </tr>
                                    <tr class="style56 style7">
                                      <td width="10%" align="center"><span class="style13">Valor Negado</span></td>
                                      <td width="12%" align="center"><span class="style13">Limite Credito p/ Negado</span></td>
                                      <td width="9%" align="center"><span class="style13">Valor Negado</span></td>
                                      <td width="11%" align="center"><span class="style13">Limite Credito p/ Negado</span></td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td align="center"><span class="style104">
                                        <input name="contp_debitomosaicoSnegado" type="text" id="contp_debitomosaicoSnegado" size="10" value="<?=number_format($contp_debitomosaicoSnegado,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span></td>
                                      <td align="center"><span class="style104">
                                        <input name="contp_debitomosaicoSlimite" type="text" id="contp_debitomosaicoSlimite" size="10" value="<?=number_format($contp_debitomosaicoSlimite,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span></td>
                                      <td align="center"><span class="style104">
                                        <input name="contp_debitomosaicoAnegado" type="text" id="contp_debitomosaicoAnegado" size="10" value="<?=number_format($contp_debitomosaicoAnegado,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span></td>
                                      <td align="center"><span class="style104">
                                        <input name="contp_debitomosaicoAlimite" type="text" id="contp_debitomosaicoAlimite" size="10" value="<?=number_format($contp_debitomosaicoAlimite,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span></td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                      <td align="center">&nbsp;</td>
                                    </tr>
                                  </table>
                                
                                
                                
                                
                                
                                </div>
                              </div>
    </div>
                            <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingThree" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                     <span class="glyphicon glyphicon-chevron-right"></span>   <strong>Credi&#225;rio</strong>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                 
                                 
  <table width="49%" class="table table-condensed table-bordered" border="0">
<tr>
            <td width="114" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Taxa  Aprovada Credi&aacute;rio a Vista</span></div></td>
            <td width="136" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"><strong>Taxa Aprovada Credi&aacute;rio</strong></span></div></td>
            <td width="80" bgcolor="#C0C0C0"><div align="center"><span class="style56"><span class="style109">Taxa Aprovada Credi&aacute;rio Cliente</span></span></div></td>
            <td bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"><strong>Repassa Taxa<br /></strong></span> <span class="style115">New</span></div></td>
                                      <td bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"><strong>Total  Taxa <br /> Repasse</strong></span></div></td>
                                      <td bgcolor="#C0C0C0"><div align="center" class="style109">
                                          <div align="center"><span class="style56">Valor Consulta Cart&atilde;o / Credi&aacute;rio Evitada</span></div>
                                      </div></td>
                                      <td bgcolor="#C0C0C0"><div align="center"><span class="style56"><strong>Libera Limite</strong></span></div></td>
                                      <td width="80" bgcolor="#C0C0C0"><div align="center"><span class="style56"><strong>D&eacute;bito em Dep&oacute;sito</strong></span></div>                                        <div align="center"></div></td>
          </tr>
                                    <tr>
                                      <td><div align="center"><span class="">
                                        <input name="taxaAprovadaCartao" type="text" id="taxaAprovadaCartao" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["contratante_vlrCrediario_vista"],2,',','.');?>" size="10" maxlength="10" class="form-control input-sm" style="width: 80px;"/>
                                        </span></div></td>
                                      <td><div align="center"><span class="">
                                        <input name="taxaAprovacaoCrediario" type="text" id="taxaAprovacaoCrediario" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" onblur="_ttTaxa();" value="<?=number_format($rst["contratante_vlrcrediario"],2,',','.');?>" size="10" maxlength="10" class="form-control input-sm" style="width: 80px; font-weight: normal;"/>
                                        </span></div></td>
                                      <td>  <input name="txCliente" type="text" id="txCliente" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["contratante_vlrcrediarioCliente"],2,',','.');?>" size="10" onblur="_ttTaxa();" maxlength="10" class="form-control input-sm" style="width: 80px;"/></td>
                                      <?php
									  if($_repassFianca == "-1" and $modelorepasse == 3) {
										 	 $_TotalTx = $rst["contratante_vlrcrediario"] + $rst["contratante_vlrcrediarioCliente"];
										  }else{
										     $_TotalTx = $rst["contratante_vlrcrediarioCliente"];
										  }
									  ?>
                                      <td><div align="center">
                                      <select name="txSim" id="txSim" class="form-control input-sm" style="width: 80px;"  onchange="_ttTaxa();">
                                        <option value="0" <?php  if($_repassFianca == "0") { ?>  selected="selected" <?php  } ?>>Não</option>
                                        <option value="-1"  <?php  if($_repassFianca == "-1") { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select>
                                      </div></td>
                                      <td><div align="center"  id="dvTotalTx">
                                        <?php echo number_format($_TotalTx,2,',','.');?>
                                      </div></td>
                                      <td><div align="center"><span class="">
                                          <input name="vlrEvitadoCartao" type="text" id="vlrEvitadoCartao" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["contratante_ValorEvitado"],2,',','.');?>" size="10" maxlength="10" class="form-control input-sm" style="width: 80px;"/>
                                      </span></div></td>
                                      <td><div align="center">
                                          <select name="limite" id="limite" class="form-control input-sm" style="width: 80px;">
                                            <option value="0" <?php  if($rst["cont_limite"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                            <option value="-1"  <?php  if($rst["cont_limite"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                          </select>
                                      </div></td>
                                      <td><div align="center">
                                        <select name="depositocred" id="depositocred" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($rst["cont_debitocred"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1"  <?php  if($rst["cont_debitocred"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                        </div>                                        <div align="center"></div></td>
                                    </tr>
                                    <tr>
                                      <td bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Valor  Aprova&ccedil;&atilde;o Cr&eacute;dito</span></div></td>
                                      <td colspan="2" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Valor Cadastro Aprovado Cr&eacute;dito</span></div></td>
                                      <td width="152" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Valor  Cadastro Negado Cr&eacute;dito</span></div></td>
                                      <td width="126" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Valor Consulta Cancelado </span></div></td>
                                      <td width="117" bgcolor="#C0C0C0"><div align="center"><span class="style109"><span class="style56">Valor Adicional por Parcela</span></span> <span class="style115">New</span></div></td>
                                      <td bgcolor="#C0C0C0"><div align="center" class="style56">Liberar Recebimento</div></td>
            </tr>
                                    <tr>
                                      <td height="24"><div align="center"><span class="">
                                        <input name="vlrAprovadoCartao" type="text" id="vlrAprovadoCartao" size="10" value="<?=number_format($rst["contratante_ValorAprovacao"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                        </span></div></td>
                                      <td colspan="2"><div align="center"><span class="">
                                        <input name="vlrAprovadoCadAprovado" type="text" id="vlrAprovadoCadAprovado" size="10" value="<?=number_format($rst["contratante_ValorAprovacaoCadastro"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                        </span></div></td>
                                      <td><div align="center"><span class="">
                                        <input name="vlrAprovadoCadNegado" type="text" id="vlrAprovadoCadNegado" size="10" value="<?=number_format($rst["contratante_ValorNegadoCadastro"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                        </span></div></td>
                                      <td><div align="center"><span class="">
                                        <input name="vlrCrediarioCancelado" type="text" id="vlrCrediarioCancelado" size="10" value="<?=number_format($rst["contratante_vlr_cancelado_cred"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span></div></td>

                                      <td><div align="center"><span class="">
                                          <input name="cont_VlrAdParcela" type="text" id="cont_VlrAdParcela" size="10" value="<?=number_format($cont_VlrAdParcela,2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)'class="form-control input-sm" style="width: 80px;"/>
                                      </span></div></td>
                                      <td><div align="center">
                                        <select name="lib_recebimento" id="lib_recebimento" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($rst["cont_libera_recebimento"] == 0) { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1"  <?php  if($rst["cont_libera_recebimento"] == "-1") { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                      </div></td>
            </tr>
                                    <tr>
                                      <td bgcolor="#C0C0C0"><div align="center"><span class="style56"><span class="style109">Repasse</span></span></div></td>
                                      <td bgcolor="#C0C0C0"><div align="center"><span class="style56"><span class="style104">WebCam </span></span></div></td>
                                      <td bgcolor="#C0C0C0"><div align="center"><span class="style56"><span class="style56">Multa   Boleto</span></span></div></td>
                                      <td colspan="2"  bgcolor="#C0C0C0"><div align="center"><span class="style56"><span class="style109">Juro Boleto</span></span></div></td>
                                      <td  bgcolor="#C0C0C0"><div align="center"><span class="style56"><span class="style109">Valor Boleto</span></span> / Parcela</div></td>
									
            </tr>
                                    <tr>
                                      <td> <div align="center">
                                        <select name="repasse" id="repasse" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($rst["parametro_repasse"] == 0) { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="1"  <?php  if($rst["parametro_repasse"] == 1) { ?>  selected="selected" <?php  } ?>>Sim</option>
                                          <option value="2"  <?php  if($rst["parametro_repasse"] == 2) { ?>  selected="selected" <?php  } ?>>Livre</option>
                                        </select>
                                        </div></td>

                                      <td>     <div align="center">
                                        <select name="webcam" id="webcam" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($rst["contratante_webcam"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1"  <?php  if($rst["contratante_webcam"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                        </div></td>
                                      <td><div align="center"><span class="">
                                        <input name="taxaboleto" type="text" id="taxaboleto" size="10" value="<?=number_format($rst["contratante_txboleto"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span></div></td>
                                      <td colspan="2"><div align="center"><span class="">
                                        <input name="juroboleto" type="text" id="juroboleto" size="10" value="<?=number_format($rst["contratante_juroboleto"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span></div></td>
                                      <td><div align="center"><span class="">
                                          <input name="valorboleto" type="text" id="valorboleto" size="10" value="<?=number_format($rst["contratante_valorboleto"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 80px;"/>
                                      </span></div></td>
            </tr>
                                    <tr>
                                      <td bgcolor="#C0C0C0"><div align="center" class="style54">Libera Juros At&eacute;</div></td>
                                      <td colspan="2" bgcolor="#C0C0C0"><div align="center" class="style54">Repassar Taxas (Liberar Juro)</div></td>
                                      <td bgcolor="#C0C0C0"><div align="center"><span class="style56"><span class="style104">Repasse Emiss&atilde;o Cart&atilde;o</span></span></div></td>
                                      <td bgcolor="#C0C0C0"><div align="center"><span class="style56"><span class="style104">Repasse Taxa Cadastro</span></span></div></td>
                                      <td bgcolor="#C0C0C0"><div align="center"><span class="style104">Repasse Valor Boleto<span class="style115">New</span></span></div></td>
                                      <td bgcolor="#C0C0C0"><div align="center" class="style56">Fator de Equilíbrio Credi&aacute;rio</div></td>
									    <td  ><div align="center"><span class="style56"><span class="style104 style117"></span></span> </div></td>
            </tr>
                                    <tr>
                                      <td><div align="center">
                                        <select name="liberajuro" id="liberajuro" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($liberajuro == 0) { ?>selected="selected"<?php  }?>>0</option>
                                          <option value="1" <?php  if($liberajuro == 1) { ?>selected="selected"<?php  }?>>1</option>
                                          <option value="2"  <?php  if($liberajuro == 2) { ?>selected="selected"<?php  }?>>2</option>
                                          <option value="3"  <?php  if($liberajuro == 3) { ?>selected="selected"<?php  }?>>3</option>
                                          <option value="4"  <?php  if($liberajuro == 4) { ?>selected="selected"<?php  }?>>4</option>
                                          <option value="5"  <?php  if($liberajuro == 5) { ?>selected="selected"<?php  }?>>5</option>
                                          <option value="6"  <?php  if($liberajuro == 6) { ?>selected="selected"<?php  }?>>6</option>
                                          <option value="7"  <?php  if($liberajuro == 7) { ?>selected="selected"<?php  }?>>7</option>
                                          <option value="8" <?php  if($liberajuro == 8) { ?>selected="selected"<?php  }?>>8</option>
                                          <option value="9"  <?php  if($liberajuro == 9) { ?>selected="selected"<?php  }?>>9</option>
                                          <option value="10"  <?php  if($liberajuro == 10) { ?>selected="selected"<?php  }?>>10</option>
                                          <option value="11"  <?php  if($liberajuro == 11) { ?>selected="selected"<?php  }?>>11</option>
                                          <option value="12"  <?php  if($liberajuro == 12) { ?>selected="selected"<?php  }?>>12</option>
                                        </select>
                                      </div></td>
                                      <td colspan="2"><div align="center">
                                        <select name="repassalibera" id="repassalibera" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($rst["cont_repasseate_cad"] == 0) { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1"  <?php  if($rst["cont_repasseate_cad"] == "-1") { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                      </div></td>
                                      <td align="center"><select name="repasseemissao" id="repasseemissao" class="form-control input-sm" style="width: 80px;">
                                        <option value="0" <?php  if($rst["contratante_repasseemissao"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1"  <?php  if($rst["contratante_repasseemissao"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select></td>
                                      <td align="center"><select name="repassecadastro" id="repassecadastro" class="form-control input-sm" style="width: 80px;">
                                        <option value="0" <?php  if($rst["contratante_repassecadastro"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1"  <?php  if($rst["contratante_repassecadastro"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select></td>
                                      <td align="center"><div align="center">
                                        <select name="repasseVlrBol" id="repasseVlrBol" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($_repassBoleto == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1"  <?php  if($_repassBoleto == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                      </div></td>
                                      <td><div align="center">
                                        <input type="text" name="ponto_equilibrio" id="ponto_equilibrio"  value="<?=$rst['contratante_ponto_equilibrio'];?>"  class="form-control input-sm" style="width: 80px;" />
                                      </div></td>
									   <td><div align="center">
                                        
                                      </div></td>
            </tr>
                                      
                                      <tr>
                                      	<td align="center" bgcolor="#C0C0C0"><span class="style56">Mensalidade Cart&atilde;o</span></td>
                                        <td colspan="2" align="center" bgcolor="#C0C0C0"><span class="style56">Parcelamento Cart&atilde;o</span></td>
                                        <td bgcolor="#C0C0C0"><div align="center" class="style56">
                                            <div align="center">Dias Maximo Primeiro Vencimento</div>
                                        </div></td>
                                        <td bgcolor="#C0C0C0" style="color:#FF6600"><b>Mostra Quiz Credi&aacute;rio</b></td>
                                        <td colspan="2" bgcolor="#C0C0C0">Visualiza Dados Bancario e Identificação</td>
                                        <td bgcolor="#C0C0C0"></td>
            </tr>
                                      
                                       <tr>
                                      	<td align="center">     <input name="mensalidadecartao" type="text" id="mensalidadecartao" size="10" value="<?=number_format($rst["contratante_vlrMensalCartao"],2,',','.');?>" maxlength="10" class="form-control input-sm" style="width: 80px;"  /></td>
                                        <td colspan="2" align="center"> <?php   $parcela2 = $rst["cont_parcelaCartao"];  ?>
                                  <select name="parcelamento2" id="parcelamento2" class="form-control input-sm" style="width: 80px;">
                                    <option value="1" <?php  if($parcela2 == 1) { ?>selected="selected"<?php  }?>>1</option>
                                    <option value="2"  <?php  if($parcela2 == 2) { ?>selected="selected"<?php  }?>>2</option>
                                    <option value="3"  <?php  if($parcela2 == 3) { ?>selected="selected"<?php  }?>>3</option>
                                    <option value="4"  <?php  if($parcela2 == 4) { ?>selected="selected"<?php  }?>>4</option>
                                    <option value="5"  <?php  if($parcela2 == 5) { ?>selected="selected"<?php  }?>>5</option>
                                    <option value="6"  <?php  if($parcela2 == 6) { ?>selected="selected"<?php  }?>>6</option>
                                    <option value="7"  <?php  if($parcela2 == 7) { ?>selected="selected"<?php  }?>>7</option>
                                    <option value="8" <?php  if($parcela2 == 8) { ?>selected="selected"<?php  }?>>8</option>
                                    <option value="9"  <?php  if($parcela2 == 9) { ?>selected="selected"<?php  }?>>9</option>
                                    <option value="10"  <?php  if($parcela2 == 10) { ?>selected="selected"<?php  }?>>10</option>
                                    <option value="11"  <?php  if($parcela2 == 11) { ?>selected="selected"<?php  }?>>11</option>
                                    <option value="12"  <?php  if($parcela2 == 12) { ?>selected="selected"<?php  }?>>12</option>
                                    <option value=""  <?php  if($parcela2 == "") { ?>selected="selected"<?php  }?>>---</option>
                                    <option value="18"  <?php  if($parcela2 == 18) { ?>selected="selected"<?php  }?>>18</option>
                                    <option value="24"  <?php  if($parcela2 == 24) { ?>selected="selected"<?php  }?>>24</option>
                                       <option value="36"  <?php  if($parcela2 == 36) { ?>selected="selected"<?php  }?>>36</option>
                                  </select></td>
                                        <td><div align="center"><span class="style104">
                                            <input name="dias_cred" type="text" id="dias_cred"  value="<?=$rst['cont_diasPrimeiroVencCred'];?>" size="10" maxlength="3" class="form-control input-sm" style="width: 70px;"/>
                                        </span></div></td>
                                        <td>
                                        	<select id="libera_crediario" class="form-control input-sm">
                                        		<option value="0" <?php  if($quiz_libera == 0){ ?> selected="selected" <?php  }?>>Mostra</option>
                                                <option value="1" <?php  if($quiz_libera == 1){ ?> selected="selected" <?php  }?>>N&atilde;o Mostra</option>
                                        	</select>                                        </td>
                                        <td colspan="2">
                                        <select id="dados_banco" class="form-control input-sm">
                                        		<option value="0" <?php  if($flagBanco == 0){ ?> selected="selected" <?php  }?>>Sim</option>
                                                <option value="1" <?php  if($flagBanco == 1){ ?> selected="selected" <?php  }?>>N&atilde;o</option>
                                        </select>                                        </td>
                                      </tr> 
                                    <tr>
                                      <td colspan="8" bgcolor="#F0F0F0"><div align="center" class="style118">TAXA FLAT</div></td>
                                    </tr>
                                    <tr>
                                      <td colspan="8">
             <table width="100%" class="table table-condensed table-bordered" border="0">
                                        <tr class="style56">
                                          <td width="82" bgcolor="#C0C0C0"><div align="center">Taxa Flat </div></td>
                                          <td width="81" bgcolor="#C0C0C0"><div align="center">Tx a Vista Flat</div></td>
                                          <td width="78" bgcolor="#C0C0C0"><div align="center">Tx 30 dias Flat</div></td>
                                          <td width="85" bgcolor="#C0C0C0"><div align="center">Tx 45 dias Flat</div></td>
                                          <td width="231" bgcolor="#C0C0C0"><div align="center"><span class="style109">Informe a Prazo de X a Y </span>Flat</div></td>
                                          <td width="102" bgcolor="#C0C0C0"><div align="center">Tx Adicional Repasse</div></td>
                                          <td width="86" bgcolor="#C0C0C0"><div align="center">Repasse</div></td>
                                        </tr>
                                        <tr>
                                          <td height="31"><span class="style104">
                                            <select name="tx_flet2" id="tx_flet2" class="form-control input-sm" style="width: 80px;">
                                              <option value="0" <?php  if($rst["contrante_flext_ind_crediario"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                              <option value="-1"  <?php  if($rst["contrante_flext_ind_crediario"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                            </select>
                                          </span></td>
                                    <td><div align="center"><span class="style104">
                                            <input name="taxaAprovadaCartao_flet" type="text" id="taxaAprovadaCartao_flet" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["contrante_flext_vista"],2,',','.');?>" size="10" maxlength="10" class="form-control input-sm" style="width: 70px;"/>
                                          </span></div></td>
                                          <td><div align="center"><span class="style104">
                                            <input name="taxaAprovadaCartao_flet30" type="text" id="taxaAprovadaCartao_flet30" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["contrante_flext_30"],2,',','.');?>" size="10" maxlength="10" class="form-control input-sm" style="width: 70px;"/>
                                          </span></div></td>
                                          <td><div align="center"><span class="style104">
                                            <input name="taxaAprovadaCartao_flet45" type="text" id="taxaAprovadaCartao_flet45" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["contrante_flext_45"],2,',','.');?>" size="10" maxlength="10" class="form-control input-sm" style="width: 70px;"/>
                                          </span></div></td>
                                          <td><div align="left">Parc de
                                              <select name="parcela_a2" id="parcela_a2" class="form-control input-sm" style="width: 60px;">
                                                <option value="2">2</option>
                                            </select>
                                            at&eacute;
                                              <select name="parcela_b2" id="parcela_b2" class="form-control input-sm" style="width: 60px;">
                                                                                            <option value="2" <?php  if($rst['contrante_flext_parcB'] == 2) { ?>selected="selected"<?php  } ?>>2</option>
                                                                                            <option value="3" <?php  if($rst['contrante_flext_parcB'] == 3) { ?>selected="selected"<?php  } ?>>3</option>
                                                                                            <option value="4" <?php  if($rst['contrante_flext_parcB'] == 4) { ?>selected="selected"<?php  } ?>>4</option>
                                                                                            <option value="5" <?php  if($rst['contrante_flext_parcB'] == 5) { ?>selected="selected"<?php  } ?>>5</option>
                                                                                            <option value="6" <?php  if($rst['contrante_flext_parcB'] == 6) { ?>selected="selected"<?php  } ?>>6</option>
                                                                                            <option value="7" <?php  if($rst['contrante_flext_parcB'] == 7) { ?>selected="selected"<?php  } ?>>7</option>
                                                                                            <option value="8" <?php  if($rst['contrante_flext_parcB'] == 8) { ?>selected="selected"<?php  } ?>>8</option>
                                                                                            <option value="9" <?php  if($rst['contrante_flext_parcB'] == 9) { ?>selected="selected"<?php  } ?>>9</option>
                                                                                            <option value="10" <?php  if($rst['contrante_flext_parcB'] == 10) { ?>selected="selected"<?php  } ?>>10</option>
                                                                                            <option value="11" <?php  if($rst['contrante_flext_parcB'] == 11) { ?>selected="selected"<?php  } ?>>11</option>
                                                                                            <option value="12" <?php  if($rst['contrante_flext_parcB'] == 12) { ?>selected="selected"<?php  } ?>>12</option>
                                              </select>
                                          </div></td>
                                          <td><div align="center"><span class="style104">
                                            <input name="taxa_adicional_repasse" type="text" id="taxa_adicional_repasse" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["contratante_taxaflet_adicional"],2,',','.');?>" size="10" maxlength="10" class="form-control input-sm" style="width: 70px;"/>
                                          </span></div></td>
                                          <td><span class="style104">
                                            <select name="repasse_flat" id="repasse_flat" class="form-control input-sm" style="width: 80px;">
                                              <option value="0" <?php  if($rst["contratante_flet_repasse"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                              <option value="-1"  <?php  if($rst["contratante_flet_repasse"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                            </select>
                                          </span></td>
                                        </tr>
                                        <tr>
                                          <td height="31" bgcolor="#C0C0C0">&nbsp;</td>
                                          <td bgcolor="#C0C0C0">&nbsp;</td>
                                          <td bgcolor="#C0C0C0">&nbsp;</td>
                                          <td bgcolor="#C0C0C0">&nbsp;</td>
                                          <td><div align="left">Taxa A
                                            <input name="taxaA_flet" type="text" id="taxaA_flet" size="10" value="<?=number_format($rst["contrante_flext_A"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
Taxa B
<input name="taxaB_flet" type="text" id="taxaB_flet" size="10" value="<?=number_format($rst["contrante_flext_B"],2,',','.');?>" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress='return SomenteNumero(event)' class="form-control input-sm" style="width: 60px;"/>
                                          </div></td>
                                          <td colspan="2" bgcolor="#C0C0C0">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td height="31" align="center">&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          <td colspan="2">&nbsp;</td>
                                        </tr>
                                      </table></td>
                                    </tr>
              

                              <tr>
                                <table width="100%" class="table table-condensed table-bordered" border="0" style="background: #242424;">
                                    <tr>
                                      <td colspan="7" bgcolor="#242424" style="color: #fff;"><div align="center" class="style118">CreditallPay</div></td>
                                    </tr>
                                  <tr class="style56" style="color: #fff;"> 
                                    <td width="82" bgcolor="#242424"><div align="center">OCR</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">DOC + SELFIE</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">DOC</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">CART&Atilde;O</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">QUIZ</div></td>
                                    <td width="81" bgcolor="#242424"><div align="center">ACP</div></td>
                                  </tr>

                                  <td height="30" class="style104"><div align="center">
                                    <select id="cont_qrcode" name="cont_qrcode" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                        <option value="1" <?php  if($cont_qrcode == '1'){?>selected="selected"<?php }?>>Sim</option>
                                        <option value="0" <?php  if($cont_qrcode == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                    </select>
                                    </div>                                  </td>
                                  <td height="30" class="style104"><div align="center">
                                    <select id="cont_selfie" name="cont_selfie" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                        <option value="1" <?php  if($cont_selfie == '1'){?>selected="selected"<?php }?>>Sim</option>
                                        <option value="0" <?php  if($cont_selfie == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                    </select>
                                    </div>                                  </td>
                                  <td height="30" class="style104"><div align="center">
                                    <select id="cont_doc" name="cont_doc" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                        <option value="1" <?php  if($cont_doc == '1'){?>selected="selected"<?php }?>>Sim</option>
                                        <option value="0" <?php  if($cont_doc == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                    </select>
                                    </div>                                  </td>
                                 
                                  <td height="30" class="style104"><div align="center">
                                    <select id="cont_cartao" name="cont_cartao" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                        <option value="1" <?php  if($cont_cartao == '1'){?>selected="selected"<?php }?>>Sim</option>
                                        <option value="0" <?php  if($cont_cartao == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                    </select>
                                    </div>                                  </td>                  
                                  <td height="30" class="style104"><div align="center">
                                    <select id="libera_crediario" name="libera_crediario" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;" disabled>
                                        <option value="0" <?php  if($quiz_libera == '0'){?>selected="selected"<?php }?>>Sim</option>
                                        <option value="1" <?php  if($quiz_libera == '1'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                    </select>
                                    </div>                                  </td>
                                  <td height="30" class="style104"><div align="center">
                                    <select id="cont_acp" name="cont_acp" class="form-control input-sm"  style="width: 80px; background: #242424; color: #fff;">
                                        <option value="1" <?php  if($cont_acp == '1'){?>selected="selected"<?php }?>>Sim</option>
                                        <option value="0" <?php  if($cont_acp == '0'){?>selected="selected"<?php }?>>N&atilde;o</option>
                                    </select><br>
                                    <p style="color: #fff; margin-top: 10px;">Busca apartir de R$</p>
                                    <input type="text" name="limiteMinimoAcp" size="10" value="" placeholder="0,00" maxlength="10" onkeydown="Formata(this,20,event,2)" onkeypress="return SomenteNumero(event)" class="form-control input-sm text-center" style="background: #242424; color: #fff;">
                                    </div>                                  </td>
                                </table>
                              </tr>
                            </table>
                                    
                                 
                                 
                                </div>
                              </div>
    </div>
	
	    <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingSix" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNegativacao" aria-expanded="false" aria-controls="collapseSix">
                                      <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Negativação</strong>
                                  </a>
                                </h4>
               
							   </div>
                            
                                <div class="panel-body"  > <table width="400" border="0">
                                    <tr>
                                      <td><div align="center">Negativação Assistida</div></td>
                                      <td><div align="center">Valor Debito Negativa&ccedil;&atilde;o</div></td>
                                      <td><div align="center">C&oacute;digo Associado</div></td>
                                      <td><div align="center">Sequencial Remessa</div></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td><div align="center"><span class="style104">
                                        <select name="Ind_negativacao" id="Ind_negativacao" class="form-control input-sm" style="width: 80px;">
                                          <option value="0" <?php  if($Ind_negativacao == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          <option value="-1"  <?php  if($Ind_negativacao == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                        </select>
                                      </span></div></td>
                                      <td><div align="center">
                                        <input type="text" name="vlr_negativacao" id="vlr_negativacao"  value="<?=$vlr_negativacao;?>"  class="form-control input-sm" style="width: 80px;" />
                                      </div></td>
                                      <td><div align="center">
                                        <input type="text"  name="codassociado" id="codassociado"  value="<?=$codassociado;?>"  class="form-control input-sm" style="width: 80px;" />
                                      </div></td>
                                      <td> <input type="text" name="seq_negativacao" id="seq_negativacao"  value="<?=$seq_negativacao;?>"  class="form-control input-sm" style="width: 80px;" /></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
								</div>
							
	   </div>
                            <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingFour" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                      <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Parametros</strong>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                 
                                 <table width="100%" class="table table-condensed table-bordered" border="0" bgcolor="#F4F4F4">
                                    
                                    <tr>
                                      <td colspan="9"><table width="100%" border="0">
                                        <tr>
                                          <td bgcolor="#C0C0C0"><div align="center" class="style109">BUSCAR BASE A PARTIR DE VALOR - Conforme a Regra</div></td>
                                          <td bgcolor="#C0C0C0"><div align="center" class="style109">MULTIPLICADOR CREDITO</div></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" class="style104"><table width="100%" border="0">
  <tr>
    <td width="2%"><input name="acessobase" type="checkbox" id="acessobase" value="0" <?php  if($base_dados == "-1") {?>checked="checked"<?php  } ?>  /></td>
    <td width="98%">N&Atilde;O ACESSA BASES DADOS (<span class="style105">&eacute; validado somento para clientes com acesso a base anterior, caso contrario ser&aacute; bloqueado cadastro/compra</span>) </td>
  </tr>
</table></td>
                                        </tr>
                                        <tr>
                                          <td width="404" height="82"><table width="391" border="0">
                                            
                                            <tr>
                                              <td colspan="2"><div align="center"><span class="style104">Credi&aacute;rio- Busca  a partir de R$</span></div></td>
                                              <td colspan="2"><div align="center"><span class="style104">Cheque - Busca  a partir de R$</span></div></td>
                                            </tr>
                                            <tr>
                                              <td width="74" bgcolor="#DDDDDD"><div align="center">CPF</div></td>
                                              <td width="103" bgcolor="#DDDDDD"><div align="center">CNPJ</div></td>
                                              <td width="106" bgcolor="#DDDDDD"><div align="center">CPF</div></td>
                                              <td width="80" bgcolor="#DDDDDD"><div align="center">CNPJ</div></td>
                                            </tr>
                                            <tr>
                                              <td bgcolor="#DDDDDD"><div align="center"><span class="style104"><span class="style109">
                                                <input name="vlr_buscaserasa" type="text" id="vlr_buscaserasa" size="10"  onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["cont_vlrbusca_serasa"],2,',','.');?>" class="form-control input-sm" style="width: 80px;" />
                                                </span></span></div></td>
                                              <td bgcolor="#DDDDDD"><div align="center"><span class="style109">
                                                <input name="vlr_buscaserasa_CNPJ" type="text" id="vlr_buscaserasa_CNPJ" size="10"  onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["cont_vlrbusca_serasa_CNPJ"],2,',','.');?>" class="form-control input-sm" style="width: 80px;"/>
                                                </span></div></td>
                                              <td bgcolor="#DDDDDD"><div align="center"><span class="style104"><span class="style109">
                                                <input name="vlr_buscaserasa2" type="text" id="vlr_buscaserasa2" size="10"  onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" class="form-control input-sm" style="width: 80px;" value="<?=number_format($rst["cont_vlrbusca_serasa2"],2,',','.');?>"/>
                                                </span></span></div></td>
                                              <td bgcolor="#DDDDDD"><div align="center"><span class="style109">
                                                <input name="vlr_buscaserasa2_CNPJ" type="text"  class="form-control input-sm" style="width: 80px;" id="vlr_buscaserasa2_CNPJ" size="10"  onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["cont_vlrbusca_serasa2_CNPJ"],2,',','.');?>"/>
                                                </span></div></td>
                                            </tr>
                                          </table></td>
                                          <td width="324"><table width="342" border="0">
                                            <tr>
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                              <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                              <td width="98" bgcolor="#DDDDDD"><div align="center">CREDIARIO CNPJ</div></td>
                                              <td width="96" bgcolor="#DDDDDD"><div align="center">CHEQUE CNPJ</div></td>
                                              <td width="128" bgcolor="#DDDDDD"><div align="center">MOSAICO CREDITO CNPJ</div></td>
                                            </tr>
                                            <tr>
                                              <td height="24" bgcolor="#DDDDDD"><div align="center"><span class="style104"><span class="style109">
                                                <input name="vlr_multi_cred" type="text" class="form-control input-sm" style="width: 80px;" id="vlr_multi_cred" size="10"  onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["contratante_multi_cred_J"],2,',','.');?>"/>
                                                </span></span></div></td>
                                              <td bgcolor="#DDDDDD"><div align="center"><span class="style104"><span class="style109">
                                                <input name="vlr_multi_ch" type="text" id="vlr_multi_ch" size="10" class="form-control input-sm" style="width: 80px;"  onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($rst["contratante_multi_ch_J"],2,',','.');?>"/>
                                                </span></span></div></td>
                                              <td bgcolor="#DDDDDD"><div align="center"><span class="style104"><span class="style109">
                                                  <input name="vlr_multi_mosaicocred" type="text" id="vlr_multi_mosaicocred" size="10" class="form-control input-sm" style="width: 80px;"  onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=number_format($multiplicadormosaico,2,',','.');?>"/>
                                              </span></span></div></td>
                                            </tr>
                                            </table>
                                          <div align="center"></div></td>
                                        </tr>
                                      </table></td>
                                   </tr>
                                    <tr>
                                      <td colspan="9" bgcolor="#C0C0C0">&nbsp;</td>
                                   </tr>
                                    <tr>
                                      <td colspan="9"><div align="center" class="style109">  <input name="BASE_A" type="hidden" id="BASE_A" size="10"   value="0"/>BASE DE DADOS CPF</div></td>
                                   </tr>
                                    <tr bgcolor="#C0C0C0">
                                      <td width="80" height="30" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">BOA VISTA  CCF</span></div></td>
                                      <td width="98" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">SERASA</span></div></td>
                                      <td width="86" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56"> SPC BRASIL</span></div></td>
                                      <td width="104" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Serasa Consulta SPC</span></div></td>
                                      <td width="54" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Procob Endere&ccedil;o</span></div></td>
                                      <td><div align="center" class="style109"><span class="style56">Consulta Base Restritiva de Terceiro</span></div></td>
                                      <td colspan="2" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Procob Quadro Societ&aacute;rio</span></div></td>
                                   </tr>
                                    <tr>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_B" id="BASE_B" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_ccf'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_ccf'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                      </div>                                        <span class="style109">
                                      
                                        </span></td>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_C" id="BASE_C" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_serasa'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_serasa'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                      </div></td>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_D" id="BASE_D" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_spc_brasil_debitos'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_spc_brasil_debitos'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                      </div></td>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_E" id="BASE_E" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_spc_brasil_consultas'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_spc_brasil_consultas'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                      </div></td>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_F" id="BASE_F" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_endereco'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_endereco'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                      </div></td>
                                      
                                      <td bgcolor="#E2E2E2"><div align="center"><span class="style104">
                                          <select name="baserestritiva" id="baserestritiva" class="form-control input-sm" style="width: 70px;">
                                            <option value="0" <?php  if($rst["cont_base"] == '0') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                            <option value="-1"  <?php  if($rst["cont_base"] == '-1') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                          </select>
                                      </span></div></td>
                                      <td colspan="2" align="center"><div align="" class="style109">
                                        <select name="BASE_G" id="BASE_G" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_socios'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_socios'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                        R$
  <input name="vlr_quadro" type="text" id="vlr_quadro" size="6"  onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)" value="<?=$rst["contratante_vlrquadro"];?>" class="form-control input-sm" style="width: 80px;"/>
                                      </div></td>
                                   </tr>
                                    
                                    <tr>
                                      <td colspan="8"><div align="center" class="style109">BASE DE DADOS CNPJ</div></td>
                                   </tr>
                                    <tr>
                                      <td height="30" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">BOA VISTA NET</span></div></td>
                                      <td bgcolor="#C0C0C0"><div align="center" class="style109">
                                        <div align="center" class="style109"><span class="style56">BOA VISTA  CCF</span></div>
                                        </div></td>
                                      <td bgcolor="#C0C0C0"><div align="center" class="style109">
                                        <div align="center" class="style109"><span class="style56">SERASA</span></div>
                                        </div></td>
                                      <td bgcolor="#C0C0C0"><div align="center" class="style109">
                                        <div align="center" class="style109"><span class="style56"> SPC BRASIL</span></div>
                                        </div></td>
                                      <td colspan="2" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Serasa Consulta SPC</span></div></td>
                                      <td width="92" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">BOA VISTA MIX CPF</span></div></td>
                                      <td width="201" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Procob Quadro Socio</span></div></td>
                                   </tr>
                                    <tr>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_A1" id="BASE_A1" class="form-control input-sm" style="width: 75px;">
                                          
                                          <option value="0" <?php  if($rst['contratante_base_boavistaJ'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_boavistaJ'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                        </div></td>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_B1" id="BASE_B1" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_ccfJ'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_ccfJ'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                        </div></td>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_C1" id="BASE_C1" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_serasaJ'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_serasaJ'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                        </div></td>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_D1" id="BASE_D1" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_spc_brasil_debitosJ'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_spc_brasil_debitosJ'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                        </div></td>
                                      <td colspan="2"><div align="center" class="style109">
                                        <select name="BASE_E1" id="BASE_E1" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_spc_brasil_consultasJ'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_spc_brasil_consultasJ'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                        </div></td>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_H1" id="BASE_H1" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_mixJ'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_mixJ'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                        </div></td>
                                      <td><div align="center" class="style109">
                                        <select name="BASE_G1" id="BASE_G1" class="form-control input-sm" style="width: 75px;">
                                          <option value="0" <?php  if($rst['contratante_base_sociosJ'] == 0) { ?>selected="selected"<?php  }?>>NAO</option>
                                          <option value="-1" <?php  if($rst['contratante_base_sociosJ'] == "-1") { ?>selected="selected"<?php  }?>>SIM</option>
                                        </select>
                                        R$
                                        <input name="vlrquadro1" type="text" id="vlrquadro1" size="6" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)"  value="<?=$rst["contratante_vlrquadro1"];?>" class="form-control input-sm" style="width: 80px;"/>
                                        </div></td>
                                   </tr>
                                    <tr>
                                      <td height="19">&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td colspan="2">&nbsp;</td>
                                      <td><span class="style109">
                                        <input name="BASE_F1" type="hidden" id="BASE_F1" size="10"   value="0"/>
                                        </span></td>
                                      <td>&nbsp;</td>
                                   </tr>
                                    <tr>
                                      <td height="19" colspan="2" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Perfil limite score Credi&aacute;rio</span></div></td>
                                      <td colspan="2" bgcolor="#C0C0C0"><div align="center" class="style109"><span class="style56">Perfil limite score Cheque</span></div></td>
                                      <td colspan="2" bgcolor="#C0C0C0">&nbsp;</td>
                                      <td bgcolor="#C0C0C0">&nbsp;</td>
                                      <td bgcolor="#C0C0C0">&nbsp;</td>
                                   </tr>
                                    <tr>
                                      <td colspan="2" ><span class="style109">R$
                                        <input name="credito" type="text" id="credito" size="16" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)"  value="<?=number_format($rst["contratante_valorcredito"],2,',','.');?>" class="form-control input-sm" style="width: 80px;" />
                                        </span></td>
                                      <td colspan="2"><span class="style109">R$
                                        <input name="limite_cheque" type="text" id="limite_cheque" size="16" onkeypress='return SomenteNumero(event)' onkeydown="Formata(this,20,event,2)"  value="<?=number_format($rst["contratante_valorcredito_ch"],2,',','.');?>" class="form-control input-sm" style="width: 80px;" /></td>
                                      <td colspan="2">&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                   </tr>
                                  </table>
                              
                                 
                                </div>
                              </div>
    					</div>
                             <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingSix" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseInteligencia" aria-expanded="false" aria-controls="collapseSix">
                                      <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Intelig&#234;ncia Cr&#233;dito </strong>
                                  </a>
                                </h4>
               
</div>
                              <div id="collapseInteligencia" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                <div class="panel-body" style="display:" >
                                              <table width="100%" border="0">
  <tr>
    <td width="17%"> <div align="center"><img src="../botoes/bt_circ_grafic.png" alt="" width="40" height="40" class="image" onclick="carregaAjaxContratante('DVINTELIGENCIA', 'frmreanaliseCredito.php?login=<?=$idlogin;?>')"  style="cursor:pointer;"/></div></td>
  <td width="17%"> <div align="center"><img src="../botoes/bt_circ_time1.png" alt="" width="40" height="40" class="image" onclick="carregaAjaxContratante('DVINTELIGENCIA', 'tempoContalista2_xxx.php?login=<?=$idlogin;?>')"  style="cursor:pointer;"/></div></td>
    <td width="17%"> <div align="center">
	<!---<img src="../botoes/bt_circ_type.png" alt="" width="40" height="40" class="image" onclick="carregaAjaxContratante('DVINTELIGENCIA', 'tipocontalista2_xxxx.php?login=<?=$idlogin;?>')"  style="cursor:pointer;"/></div>-->
	
	<img src="../botoes/bt_circ_type.png" alt="" width="40" height="40" class="image" onclick="carregaAjaxContratante('DVINTELIGENCIA', 'sequenciaFraude.php?login=<?=$idlogin;?>')"  style="cursor:pointer;"/></div>
	</td>
     <td width="17%"> <div align="center"><img src="../botoes/bt_circ_age.png" alt="" width="40" height="40" class="image" onclick="carregaAjaxContratante('DVINTELIGENCIA', 'idadelista2_xxx.php?login=<?=$idlogin;?>')"  style="cursor:pointer;"/></div></td>
     <td width="15%"> <div align="center"><img src="../botoes/bt_circ_details.png" alt="" width="40" height="40" class="image" onclick="carregaAjaxContratante('DVINTELIGENCIA', 'idadealtalista2_xxxxx.php?login=<?=$idlogin;?>')"  style="cursor:pointer;"/></div></td>
      <td width="17%"> <div align="center"><img src="../botoes/bt_circ_house.png" alt="" width="40" height="40" class="image" onclick="carregaAjaxContratante('DVINTELIGENCIA', 'ClasseMoralista2.php_xxxx?login=<?=$idlogin;?>')"  style="cursor:pointer;"/></div></td>
  </tr>
  <tr>
    <td><div align="center">Composi&ccedil;&atilde;o Cr&eacute;dito</div></td>
    <td style="text-align: center">tempo conta </td>
    <td style="text-align: center">Sequencia Fraude</td>
    <td style="text-align: center">idade classe social</td>
    <td style="text-align: center">idade detalhada</td>
    <td style="text-align: center">classe social onde mora</td>
  </tr>
  <tr>
    <td colspan="7" align="left"><div id="DVINTELIGENCIA"></div></td>
    </tr>
</table>
								</div>
                              </div>
                             </div>
                         
                        
                         <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingSix" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                      <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Perfil Pontua&#231;&#227;o Quiz</strong>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                <div class="panel-body" >
								<div>
                                   <table class="table table-condensed table-bordered" border="0">
                                    <tr>
                                      <td colspan="3"  class="style24">Libera&ccedil;&atilde;o Cadastro Guia com/ Quiz 
                                        <select name="lb_quiz_ch" id="lb_quiz_ch" class="form-control input-sm" style="width: 70px;">
                                        <option value="0"  <?php  if($rst["cont_quiz_ch"] == '0') { ?>  selected="selected" <?php  } ?>>N&atilde;o</option>
                                        <option value="-1" <?php  if($rst["cont_quiz_ch"] == '-1') { ?>  selected="selected" <?php  } ?>>Sim</option>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td colspan="3"  class="style24">Pontua&ccedil;&atilde;o a Ser Atiginda:
                                      <input type="text" name="pontos_atigindo" id="pontos_atigindo"  width="30px"  value="<?=$rst["pontos_atigindo"];?>"/>
                                      Pontua&ccedil;&atilde;o M&aacute;xima p/ Libera&ccedil;&atilde;o:
                                      <input type="text" name="pontos_atigindo_maximo" id="pontos_atigindo_maximo"  width="30px"  value="<?=$pontos_atigindo_maximo;?>"/></td>
                                    </tr>
                                    <tr>
                                      <td colspan="3"  class="style24">Tipo Quiz 
	                               	  <?php  
									  $consulta2 = "SELECT * FROM quiz_tipo order by quiz_tipodescricao ASC " ;	
									   $executa2 = mysqli_query($mysqli, $consulta2) or die(mysqli_error($mysqli));		
									 
									  $num_rows2 = mysqli_num_rows($executa2);
								   ?>
								        <select name="quiz_id" id="quiz_id">
                                        <?php 
										 if($num_rows2!=0)	{
									  		 while($rst2 = mysqli_fetch_array($executa2))
											{
											?>
											  <option value="<?=$rst2["quiz_tipoid"];?>"><?=$rst2["quiz_ponto"];?> | <?=$rst2["quiz_tipodescricao"];?> </option> 
                                             <?php 
											}
										}?>
                                        </select> 
								        Pontua&ccedil;&atilde;o
								        <input type="text" name="quiz_pontuacao" id="quiz_pontuacao"  width="30px"   />
								        <input type="button" name="button" id="button" value="Adicionar"  onclick="carregaAjaxContratante('ponto_quiz', 'acaoQuizcontratante.php?acao=i&id=<?=$idlogin;?>&tipo='+ document.getElementById('quiz_id').value+'&pontos='+ document.getElementById('quiz_pontuacao').value)"  /></td>
                                    </tr>
                                    </table>
                                  </div>
                                   <div id="ponto_quiz">
                                   
                                  <table class="table table-condensed table-bordered" border="0">
                                    
                                    <tr>
                                      <td width="429" bgcolor="#CCCCCC" class="style24"><div align="center"><span class="style56">DESCRI&Ccedil;&Atilde;O</span></div></td>
                                      <td width="176" bgcolor="#CCCCCC" class="style24"><div align="center"><span class="style56">PONTUA&Ccedil;&Atilde;O</span></div></td>
                                      <td width="133" bgcolor="#CCCCCC" class="style24"><div align="center"><span class="style56">EXCLUIR</span></div></td>
                                    </tr>
                                    <?php  
				    $consulta_quiz = "Select * from quiz_pontuacao_contrantante left join quiz_tipo  on quizp_idquiz = quiz_tipoid where quizp_login = '".$idlogin."'";	
				     $executa_quiz = mysqli_query($mysqli, $consulta_quiz) or die(mysqli_error($mysqli));							
					
					 while($rst_quiz = mysqli_fetch_array($executa_quiz))
		   			{
				   ?>
                                    <tr>
                                      <td bgcolor="#F0F0F0" class="style8"><?=$rst_quiz["quiz_tipodescricao"];?></td>
                                      <td bgcolor="#F0F0F0" class="style8"><div align="center">
                                        <?=$rst_quiz["quizp_ponto"];?>
                                      </div></td>
                                      <td bgcolor="#F0F0F0" class="style8"><div align="center"><img src="../img/lixeira.jpg"  style="cursor:pointer"  onclick="exclui_pontos('<?=$idlogin;?>','<?=$rst_quiz["quizp_id"];?>')" /> </div></td>
                                    </tr>
                                    <?php  } ?>
                                  </table>
                                  </div>
                                </div>
                                
                             </div>
                              
    </div>
       <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingSix" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix2" aria-expanded="false" aria-controls="collapseSix">
                                      <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Quiz</strong>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseSix2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                <div class="panel-body">
                                 
    <table class="table table-condensed table-bordered" border="0">
                 <tr>
                   <td width="203" bgcolor="#CCCCCC" class="style24"><div align="center"><span class="style56">RESP CERTA</span></div></td>
                   <td width="240" bgcolor="#CCCCCC" class="style24"><div align="center"><span class="style56">RESP SELECIONADA</span></div></td>
                   <td width="295" bgcolor="#CCCCCC" class="style24"><div align="center"><span class="style56">OP&Ccedil;&Otilde;ES</span></div></td>
                   <td width="153" bgcolor="#CCCCCC" class="style24"><div align="center"><span class="style56">TIPO</span></div></td>
                 </tr>
                   <?php  
				    $consulta_quiz = "Select * from quiz left join quiz_tipo on quiz_tipo = quiz_tipoid where quiz_cpf = '".$cnpj."'";
					$executa_quiz = mysqli_query($mysqli, $consulta_quiz) or die(mysqli_error($mysqli));

					 while($rst_quiz = mysqli_fetch_array($executa_quiz))
		   			{
				   ?>
                 <tr>
                   <td bgcolor="#F0F0F0" class="style8"><?=$rst_quiz["quiz_resposta_certa"];?></td>
                   <td bgcolor="#F0F0F0" class="style8"><?=$rst_quiz["quiz_resposta_selecionada"];?></td>
                   <td bgcolor="#F0F0F0" class="style8"><?=nl2br($rst_quiz["quiz_opcoes"]);?></td>
                   <td bgcolor="#F0F0F0" class="style8"><?=$rst_quiz["quiz_tipodescricao"];?></td>
                 </tr>
                   <?php  } ?>
               </table>  
                                 
    
                                </div>
                                
                             </div>
                              
    </div>                   
                          
                <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingSeven" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                      <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Bases</strong>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                <div class="panel-body">
                                
                                <table class="table table-condensed table-bordered">
                                	<tr>
                                    	<td bgcolor="#C0C0C0"><span class="style56">Data/Hora</span></td>
                                        <td bgcolor="#C0C0C0"><span class="style56">Login</span></td>
                                        <td bgcolor="#C0C0C0"><span class="style56">Documento</span></td>
                                        <td bgcolor="#C0C0C0"><span class="style56">Base</span></td>
                                        <td bgcolor="#C0C0C0"><span class="style56">Detalhe</span></td>
         
                                    </tr>
                                    
                                    <?php 
									
//Bases
$bases = array(
	1 => array(
		'base' => 'SERASA',
		'link' => 'listabaseDetalheCPFSerasa_A.php',
		'count' => 0
	),
	2 => array(
		'base' => 'PROCOB CPF/CNPJ',
		'link' => 'listabaseDetalheCPFProcob_A.php',
		'count' => 0
	),
	3 => array(
		'base' => 'SCPC',
		'link' => 'listabaseDetalheCPF_A.php',
		'count' => 0
	),
	4 => array(
		'base' => 'PROCOB LOCALIZA',
		'link' => 'listabaseDetalheCPFProcob_L.php',
		'count' => 0
	),
	5 => array(
		'base' => 'PROCOB SMS',
		'link' => 'listabaseDetalheCPFProcob_L.php',
		'count' => 0
	),
	6 => array(
		'base' => 'PROCOB SOCIOS',
		'link' => 'listabaseDetalheCPFProcob_L.php',
		'count' => 0
	),
	7 => array(
		'base' => 'DBM',
		'link' => 'listabaseDetalheCPFP_DBM.php',
		'count' => 0
	),
	8 => array(
		'base' => 'BOA VISTA NET',
		'link' => 'listabaseDetalheCPF_BOAVISTA.php',
		'count' => 0
	),
	9 => array(
		'base' => 'PROTESTOS Captcha',
		//'link' => 'listabaseDetalheCaptchaProtesto.php',
		'link' => 'listabaseDetalheCaptchaReceita.php',
		'count' => 0
	),
	10 => array(
		'base' => 'SPC Mix',
		'link' => 'listabaseDetalheSPCMix.php',
		'count' => 0
	),
	11 => array(
		'base' => 'ECAC Captcha',
		//'link' => 'listabaseDetalheCaptchaEcac.php',
		'link' => 'listabaseDetalheCaptchaReceita.php',
		'count' => 0
	),
	12 => array(
		'base' => 'DETRAN Captcha',
		'link' => 'listabaseDetalheCaptchaReceita.php',
		'count' => 0
	),
	13 => array(
		'base' => 'RECEITA FEDERAL Captcha',
		'link' => 'listabaseDetalheCaptchaReceita.php',
		'count' => 0
	),
	15 => array(
		'base' => 'CONFIRA FONE',
		'link' => 'listabaseDetalheConfiraFone.php',
		'count' => 0
	),
	16 => array(
		'base' => 'SERASA CH',
		'link' => 'listabaseDetalheCPFSerasa_A.php',
		'count' => 0
	),
	

);	
									
									
									
									
									
$consulta_base = "SELECT * ,DATE_FORMAT(consulta_hora, '%d/%m/%Y as %T') AS dt
			FROM consultas_base WHERE consulta_cpf = '".$cnpj."' or consulta_cpf = '".$cpf_responsavel."'";
			$executa_base = mysqli_query($mysqli, $consulta_base) or die(mysqli_error($mysqli));

					
					while ($rst_base = mysqli_fetch_array($executa_base))
						{
						if ( isset($bases[$rst_base['consulta_tipo']]) ){
							$_base = $bases[$rst_base['consulta_tipo']]['base'];
							$_link = $bases[$rst_base['consulta_tipo']]['link'];
							$bases[$rst_base['consulta_tipo']]['count']++;
								}
		
							
							?>
									
							<tr>
                                    <td bgcolor="#F0F0F0"><?=$rst_base['dt'];?></td>
                                    <td bgcolor="#F0F0F0"><?=$rst_base['consulta_login'];?></td>
                                    <td bgcolor="#F0F0F0"><?=$rst_base['consulta_cpf'];?></td>
                              <td bgcolor="#F0F0F0"><?=$_base?></td>
                              <td align="center" bgcolor="#F0F0F0"> <button data-toggle="modal" href="#myModal2" type="button" class="btn btn-default" onClick="carregaAjax('resp', '<?=$_link?>?id=<?=$rst_base["consulta_id"];?>&cpf=<?=$rst_base["consulta_cpf"];?>')"><i class="glyphicon glyphicon-search"></i></button>  
                                    
							                                    
 
                                    </td>
         
                                  </tr>
									
					<?php  } ?>
                                
                                
                                </table>
                                 
                          
                          </div>
                    </div>
              </div>             
 
  
  <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingEight" style="height: 20px; padding: 1px; font-size: 9px">
                                <h4 class="panel-title">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                      <span class="glyphicon glyphicon-chevron-right"></span>  <strong>Cr&#233;dito conta corrente / Dados Banc&#225;rio boleto</strong>
                                  </a>
                                </h4>
                              </div>
                              <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                                <div class="panel-body">
                                
                                
                                 <table width="100%" class="table table-condensed" border="0">
                          <tr>
                            <td colspan="5" bgcolor="#F0F0F0"><div align="center" class="style48">Dados Banc&aacute;rio Boleto</div></td>
                          </tr>
                          <tr>
                            <td width="131"><span class="style104">Banco </span></td>
                            <td colspan="4"><span class="style104">
                              <input name="banco1" type="text"  id="banco1"  value="<?=$rst["contratante_banco"];?>" class="form-control input-sm" style="width: 100px;"/>
                              </span><span class="style104">Ag&ecirc;ncia
                                <input name="agencia" type="text" class="form-control input-sm" style="width: 60px;" id="agencia"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_agencia"];?>"/>
                                Dv
                                <input name="agenciaDV" type="text" class="form-control input-sm" style="width: 30px;" id="agenciaDV"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_agenciaDV"];?>"/>
                                Conta
                                <input name="conta" type="text" class="form-control input-sm" style="width: 80px;" id="conta"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_conta"];?>"/>
                                Dv
                                <input name="contaDV" type="text" class="form-control input-sm" style="width: 30px;" id="contaDV"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_contaDV"];?>"/>
                                Conta Cedente
                                <input name="cedente" type="text" class="form-control input-sm" style="width: 80px;" id="cedente"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_cedente"];?>"/>
                                Dv
                                <input name="cedenteDV" type="text" class="form-control input-sm" style="width:30px;" id="cedenteDV"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_cedenteDV"];?>"/>
                                </span></td>
     </tr>
                          
                          <tr>
                            <td><span class="style104">Carteira</span></td>
                            <td width="318"><span class="style104">
                              <select name="carteira" size="1"  id="carteira" class="form-control input-sm" style="width: 220px;">
                                <option value="999">NENHUM</option>
                                <option value="8050.76" <?php  if($rst["contratante_carteira"] == "8050.76") { ?>selected="selected"<?php  } ?>>BANRISUL- 8050.76</option>
                                <option value="041" <?php  if($rst["contratante_carteira"] == "041") { ?>selected="selected"<?php  } ?>>041 -BANRISUL S.A</option>
                                <option value="03" <?php  if($rst["contratante_carteira"] == "03") { ?>selected="selected"<?php  } ?>>03-BRADESCO</option>
                                <option value="04" <?php  if($rst["contratante_carteira"] == "04") { ?>selected="selected"<?php  } ?>>04-BRADESCO</option>
                                <option value="06" <?php  if($rst["contratante_carteira"] == "06") { ?>selected="selected"<?php  } ?>>06-BRADESCO</option>
                                <option value="09" <?php  if($rst["contratante_carteira"] == "09") { ?>selected="selected"<?php  } ?>>09-BRADESCO</option>
                                <option value="19" <?php  if($rst["contratante_carteira"] == "19") { ?>selected="selected"<?php  } ?>>19-BRADESCO</option>
                                <option value="19" <?php  if($rst["contratante_carteira"] == "19") { ?>selected="selected"<?php  } ?>>19-UNICRED/BRADESCO</option>
                                <option value="17" <?php  if($rst["contratante_carteira"] == "17") { ?>selected="selected"<?php  } ?>>17-BANCO DO BRASIL</option>
                                <option value="80" <?php  if($rst["contratante_carteira"] == "sr") { ?>selected="selected"<?php  } ?>>80-CAIXA SR</option>
                                <option value="104" <?php  if($rst["contratante_carteira"] == "104") { ?>selected="selected"<?php  } ?>>104-ITAU</option>
                                <option value="109" <?php  if($rst["contratante_carteira"] == "109") { ?>selected="selected"<?php  } ?>>109-ITAU</option>
                                <option value="157" <?php  if($rst["contratante_carteira"] == "157") { ?>selected="selected"<?php  } ?>>157-ITAU</option>
                                <option value="174" <?php  if($rst["contratante_carteira"] == "174") { ?>selected="selected"<?php  } ?>>174-ITAU</option>
                                <option value="175" <?php  if($rst["contratante_carteira"] == "175") { ?>selected="selected"<?php  } ?>>175-ITAU</option>
                                <option value="178" <?php  if($rst["contratante_carteira"] == "178") { ?>selected="selected"<?php  } ?>>178-ITAU</option>
                                <option value="101" <?php  if($rst["contratante_carteira"] == "101") { ?>selected="selected"<?php  } ?>>101 - SANTANDER ECR</option>
                                <option value="102" <?php  if($rst["contratante_carteira"] == "102") { ?>selected="selected"<?php  } ?>>102 -SANTANDER CSR</option>
                                <option value="1"   <?php  if($rst["contratante_carteira"] == "1") { ?>selected="selected"<?php  } ?>>1-SICRED / 1-SICOOB / 1-SAFRA SIMPLES</option>
								<option value="2"   <?php  if($rst["contratante_carteira"] == "2") { ?>selected="selected"<?php  } ?>>2-SAFRA VINCULADA</option>
                              </select>
                            </span></td>
                            <td colspan="3" align="right"><div align="left"><span class="style104">Boleto
                              <select name="boleto_cred" id="boleto_cred" class="form-control input-sm" style="width: 150px;"   onchange="bloqueia_bo(this.value)">
                                <option value="0" <?php   if($rst["contratante_boletocred"] == 0) { ?> selected="selected" <?php  }?>>Boleto Contratante</option>
                                <option value="3" <?php  if($rst["contratante_boletocred"] == 3) { ?> selected="selected" <?php  }?>>Boleto(Itau Creditall)</option>
                                <option value="6" <?php  if($rst["contratante_boletocred"] == 6) { ?> selected="selected" <?php  }?>>Boleto(Itau RGS)</option>
								<option value="11" <?php  if($rst["contratante_boletocred"] == 11) { ?> selected="selected" <?php  }?>>Boleto(Itau Processamento)</option>
                                <option value="4" <?php  if($rst["contratante_boletocred"] == 4) { ?> selected="selected" <?php  }?>>Boleto(Sicredi Creditall)</option>
                                <option value="5" <?php  if($rst["contratante_boletocred"] == 5) { ?> selected="selected" <?php  }?>>Boleto(Sicredi RGS)</option>
                                </select>
                            </span></div></td>
                            </tr>
                          <tr>
                            <td><span class="style104">Banco Boleto</span></td>
                            <td><span class="style104">
                              <select name="tipoboleto" size="1" id="tipoboleto" class="form-control input-sm" style="width: 150px;">
                                <option value="999">NENHUM</option>
                                <option value="8" <?php  if($rst["contratante_tipoboleto"] == 8) { ?>selected="selected" <?php  } ?>>BANRISUL</option>
                                <option value="3"  <?php  if($rst["contratante_tipoboleto"] == 3) { ?>selected="selected" <?php  } ?>>BANCO BRASIL</option>
                                <option value="0" <?php  if($rst["contratante_tipoboleto"] == 0) { ?>selected="selected" <?php  } ?>>BRADESCO</option>
                                <option value="4"  <?php  if($rst["contratante_tipoboleto"] == 4) { ?>selected="selected" <?php  } ?>>CAIXA</option>
                                <option value="11"  <?php  if($rst["contratante_tipoboleto"] == 11) { ?>selected="selected" <?php  } ?>>DAYCOVAL</option>
                                <option value="2"  <?php  if($rst["contratante_tipoboleto"] == 2) { ?>selected="selected" <?php  } ?>>HSBC</option>
                                <option value="1"  <?php  if($rst["contratante_tipoboleto"] == 1) { ?>selected="selected" <?php  } ?>>ITAU</option>
                                <option value="12"  <?php  if($rst["contratante_tipoboleto"] == 12) { ?>selected="selected" <?php  } ?>>SAFRA (422)</option>
								<option value="7"  <?php  if($rst["contratante_tipoboleto"] == 7) { ?>selected="selected" <?php  } ?>>SANTANDER</option>
                                <option value="6"  <?php  if($rst["contratante_tipoboleto"] == 6) { ?>selected="selected" <?php  } ?>>SICREDI</option>
                                <option value="5"  <?php  if($rst["contratante_tipoboleto"] == 5) { ?>selected="selected" <?php  } ?>>SICOOB</option>
                                <option value="9" <?php  if($rst["contratante_tipoboleto"] == 9) { ?>selected="selected" <?php  } ?>>UNICRED</option>
                                <option value="10" <?php  if($rst["contratante_tipoboleto"] == 10) { ?>selected="selected" <?php  } ?>>GUANABARA</option>
                              </select>
                            </span></td>
                            <td colspan="3" align="right"><div align="left"><span class="style104"><span class="style56 style7 style13">Boleto Modelo
                              <select name="boleto_modboleto" id="boleto_modboleto" class="form-control input-sm" style="width: 130px;">
                                <option value="0" <?php  if($boleto_modboleto == 0){ ?> selected="selected" <?php  } ?>>Modelo Padrao</option>
                                <option value="1" <?php  if($boleto_modboleto == 1){ ?> selected="selected" <?php  } ?>>Modelo Fatura</option>
                                                            </select> 
                            Boleto (Imp.Todos)
                                  <select name="boleto_imptodos" id="boleto_imptodos" class="form-control input-sm" style="width: 130px;">
                                      <option value="0" <?php  if($boleto_imptodos == 0){ ?> selected="selected" <?php  } ?>>Imprime s&oacute; 1&ordm; </option>
                                      <option value="1" <?php  if($boleto_imptodos == 1){ ?> selected="selected" <?php  } ?>>Imprime Todos </option>
                                      </select>
                                </span> </span></div></td>
                            </tr>
                          <tr>
                            <td><span class="style104">Conv&ecirc;nio</span></td>
                            <td><span class="style104">
                              <input name="convenio" type="text" class="form-control input-sm" style="width: 150px;" id="convenio" onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_convenio"];?>"/>
                              </span></td>
                            <td colspan="3" align="right"><div align="left"><span class="style104">Cod. Cooperado / Varia&ccedil;&atilde;o / Inicio Conta :</span><span class="style104">
                              <input name="cooperado" type="text" class="form-control input-sm" style="width: 80px;" id="cooperado"   value="<?=$rst["contratante_cooperado"];?>" maxlength="7"/>
                            </span></div></td>
                            </tr>
                          <tr>
                            <td><span class="style104">Comando</span></td>
                            <td class="style55"><select name="comando" id="comando" class="form-control input-sm" style="width: 220px;">
                              <option value="     " <?php  if($rst["contratante_comando"] == "     ") { ?> selected="selected" <?php  } ?>>MODALIDADE SIMPLES</option>
                              <option value="02VIN" <?php  if($rst["contratante_comando"] == "02VIN") { ?> selected="selected" <?php  } ?>>MODALIDADE VINCULADA</option>
                              </select>                              </td>
                            <td colspan="3" class="style104"><div align="left">Desconto de Pontualidade:
                              <input name="desconto" type="text" class="form-control input-sm" style="width: 80px;" id="desconto" value="<?=$rst["contratante_descontopgto"];?>" maxlength="5"/>
                            </div></td>
                            </tr>
                          
                          <tr>
                            <td height="15"><span class="style104">CNPJ Raz&atilde;o Boleto</span></td>
                            <td><span class="style104">
                              <input name="cnpjboleto" type="text" class="form-control input-sm" style="width: 150px;" id="cnpjboleto" onkeypress='return SomenteNumero(event)' value="<?=$cnpjboleto;?>"/>
                            </span></td>
                            <td colspan="3"><span class="style104">Nome Raz&atilde;o Boleto:
                              <input name="razaoboleto" type="text" class="form-control input-sm" style="width: 350px;" id="razaoboleto" onkeypress='return SomenteNumero(event)' value="<?=$razaoboleto;?>"/>
                            </span></td>
                          </tr>
                          <tr>
                            <td>
                              <span class="style104">Dias Atraso Boleto                              </span></td>
                            <td><span class="style104">
                              <input name="diasboleto" type="text" class="form-control input-sm" style="width: 60px;" id="diasboleto"  onkeypress='return SomenteNumero(event)' value="<?=$rst["cont_diaspgboleto"];?>"/>
                            </span> <span class="style31">ex: (30 ou 05) dias</span></td>
                            <td width="232">
                              <div align="left" class="style104">
                                <div align="left">Lote Remessa Unico:
                                  <select name="lote" id="lote" class="form-control input-sm" style="width: 80px;">
                                    <option value="0" <?php   if($rst["contratante_loteunico"] == 0) { ?> selected="selected" <?php  }?>>N&atilde;o</option>
                                    <option value="-1" <?php  if($rst["contratante_loteunico"] == -1) { ?> selected="selected" <?php  }?>>Sim</option>
                                  </select>
                                </div>
                            </div>                            </td>
                            <td width="203" bgcolor="#FF0000"><div align="left" class="style104">
                              <div align="left"><span class="style117">TIVIT: </span>
                                <select name="tivit" id="tivit" class="form-control input-sm" style="width: 80px;">
                                  <option value="0" <?php   if($tivit == 0) { ?> selected="selected" <?php  }?>>N&atilde;o</option>
                                  <option value="-1" <?php  if($tivit == -1) { ?> selected="selected" <?php  }?>>Sim</option>
                                </select>
                                </div>
                            </div></td>
                            <td width="1094">&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="21" colspan="98">
                              <span class="style104">C&oacute;digo de Transmiss&atilde;o:
                                <input type="text" id="codigotransmissao" name="codigotransmissao" maxlength="30" value="<?=$rst["contratante_codigo_transmissao"];?>" class="form-control input-sm" style="width: 150px;"  onkeypress='return SomenteNumero(event)'/>
                              </span>
                              
                          <span class="style104">    
                            Simples Confer&ecirc;ncia 
                            
                            <select id="simplesconf" name="simplesconf" class="form-control input-sm">
                            	<option value="0" <?php  if($rst['cont_simples'] == 0){ ?> selected="selected"<?php  } ?>>N&atilde;o</option>
                                <option value="1" <?php  if($rst['cont_simples'] == 1){ ?> selected="selected"<?php  } ?>>Sim</option>
                            </select>  
                            </span>
                            <span class="style104">
                            Senha Simples 
                            
                            <input type="text" id="senhaconf" name="senhaconf" value="<?=$rst["cont_senha_simples"];?>" class="form-control input-sm" style="width: 100px;" />
                              </span>                            </td>
     </tr>
                          <tr>
                            <td><span class="style104">Sequencial Boleto</span></td>
                            <td width="318"><span class="style104">
                              <input name="sequencialBoleto" type="text" class="form-control input-sm" style="width: 150px;" id="sequencialBoleto" onkeypress='return SomenteNumero(event)' value="<?=$sequencialBoleto;?>"/>
                            </span></td>
                            <td colspan="3" align="right"><div align="left"><span class="style104">Sequencial Remessa
                                  <input name="sequencialRemessa" type="text" class="form-control input-sm" style="width: 150px;" id="sequencialRemessa" onkeypress='return SomenteNumero(event)' value="<?=$sequencialRemessa;?>"/>
                            </span></div></td>
                          </tr>
  </table>
    <table width="100%" border="0" class="table table-condensed">
      <tr>
                        <td colspan="2" bgcolor="#F0F0F0"><div align="center" class="style48">Cr&eacute;dito conta corrente para Deposito </div></td>
                      </tr>
                      <tr>
                        <td width="5%">Banco p/ Deposito</td>
                        <td width="95%"><span class="style104">
                          <select name="tipoboleto2" size="1" id="tipoboleto2" class="form-control input-sm" style="width: 150px;">
                            <option value="999">NENHUM</option>
						    <option value="15" <?php  if($rst["contratante_bancodep"] == 15) { ?>selected="selected" <?php  } ?>>AMAZONIA</option>
                            <option value="8"  <?php  if($rst["contratante_bancodep"] == 8)  { ?>selected="selected" <?php  } ?>>BANRISUL</option>
                            <option value="3"  <?php  if($rst["contratante_bancodep"] == 3)  { ?>selected="selected" <?php  } ?>>BANCO BRASIL</option>
                            <option value="21" <?php  if($rst["contratante_bancodep"] == 21)  { ?>selected="selected" <?php  } ?>>BANCO DO NORDESTE </option>
                            <option value="0"  <?php  if($rst["contratante_bancodep"] == 0)  { ?>selected="selected" <?php  } ?>>BRADESCO</option>
                            <option value="4"  <?php  if($rst["contratante_bancodep"] == 4)  { ?>selected="selected" <?php  } ?>>CAIXA</option>
                            <option value="18" <?php  if($rst["contratante_bancodep"] == 18) { ?>selected="selected" <?php  } ?>>COOP. CENTRAL AILOS</option>
							<option value="20" <?php  if($rst["contratante_bancodep"] == 20) { ?>selected="selected" <?php  } ?>>COOP. URBANO-CECRED</option>
                            <option value="11" <?php  if($rst["contratante_bancodep"] == 11) { ?>selected="selected" <?php  } ?>>DAYCOVAL</option>
                            <option value="10" <?php  if($rst["contratante_bancodep"] == 10) { ?>selected="selected" <?php  } ?>>GUANABARA</option>
                            <option value="2"  <?php  if($rst["contratante_bancodep"] == 2)  { ?>selected="selected" <?php  } ?>>HSBC</option>
                            <option value="1"  <?php  if($rst["contratante_bancodep"] == 1)  { ?>selected="selected" <?php  } ?>>ITAU</option>
                            <option value="13" <?php  if($rst["contratante_bancodep"] == 13) { ?>selected="selected" <?php  } ?>>INTER</option>
                            <option value="22" <?php  if($rst["contratante_bancodep"] == 22) { ?>selected="selected" <?php  } ?>>KIRTON BANK S.A</option>
                            <option value="16" <?php  if($rst["contratante_bancodep"] == 16) { ?>selected="selected" <?php  } ?>>NU BANK</option>
                            <option value="14" <?php  if($rst["contratante_bancodep"] == 14) { ?>selected="selected" <?php  } ?>>074 - J.SAFRA</option>
                            <option value="17" <?php  if($rst["contratante_bancodep"] == 17) { ?>selected="selected" <?php  } ?>>422 - SAFRA</option>
                            <option value="7"  <?php  if($rst["contratante_bancodep"] == 7)  { ?>selected="selected" <?php  } ?>>SANTANDER</option>       
                            <option value="6"  <?php  if($rst["contratante_bancodep"] == 6)  { ?>selected="selected" <?php  } ?>>SICREDI</option>
                            <option value="5"  <?php  if($rst["contratante_bancodep"] == 5)  { ?>selected="selected" <?php  } ?>>SICOOB</option>
							<option value="19" <?php  if($rst["contratante_bancodep"] == 19) { ?>selected="selected" <?php  } ?>>SERVICOOP</option>    
                            <option value="9"  <?php  if($rst["contratante_bancodep"] == 9)  { ?>selected="selected" <?php  } ?>>UNICRED</option>
                            <option value="12" <?php  if($rst["contratante_bancodep"] == 12) { ?>selected="selected" <?php  } ?>>VIACREDI</option>                         
                                                 
                          </select>
                        Ag&ecirc;ncia
                        <input name="agencia2" type="text" class="form-control input-sm" style="width: 60px;" id="agencia2"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_agenciadep"];?>"/>
Dv
<input name="agenciaDV2" type="text" class="form-control input-sm" style="width: 30px;" id="agenciaDV2"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_agenciaDVdep"];?>"/>
Conta
<input name="conta2" type="text" class="form-control input-sm" style="width: 100px;" id="conta2"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_contadep"];?>"/>
Dv
<input name="contaDV2" type="text" class="form-control input-sm" style="width: 30px;" id="contaDV2"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_contaDVdep"];?>"/>
                        Cod Opera&ccedil;&atilde;o
                        <input name="operacao" type="text" class="form-control input-sm" style="width: 50px;" id="operacao"  onkeypress='return SomenteNumero(event)' value="<?=$rst["contratante_operacaodep"];?>"/>
                        </span></td>
                      </tr>
    </table>

                                </div>
                                
                            </div>
                                   
	</div>

  <br />
  
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default" >
    <div class="panel-heading" role="tab" id="headingNine" style="height: 20px; padding: 1px; font-size: 9px">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
       <span class="glyphicon glyphicon-chevron-right"></span>     <strong>Log de Altera&#231;&#245;es</strong>
        </a>
      </h4>
    </div>

    <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
      <div class="panel-body">

		<table class="table table-bordered table-condensed" style="font-size:11px;">
        	<tr align="center" bgcolor="#CCCCCC">
                <td><strong>Usu&aacute;rio</strong></td>
                <td><strong>Data/Hora</strong></td>
                <td><strong>Contratante</strong></td>
                <td><strong>Registro</strong></td>
            </tr>
            
            	
                <?php  $consulta_log = "SELECT *, DATE_FORMAT(log_datahora, '%d/%m/%Y %H:%i') AS dt_hr 
				FROM log_sistema LEFT JOIN contratante ON log_sistema.log_login = contratante.cont_id
				WHERE log_login = '$id'  ORDER BY log_id DESC";
                		$executa_log = mysqli_query($mysqli, $consulta_log) or die(mysqli_error($mysqli));
						
							
							while($rst_log = mysqli_fetch_array($executa_log)){
				
				 ?><tr align="center">
                    <td><?=$rst_log['log_user'];?></td>
                    <td><?=$rst_log['dt_hr'];?></td>	
                    <td><?=$rst_log['usuario_LOGIN'];?></td>
                    <td><?=$rst_log['log_acao'];?></td>
                   </tr> 
            	 <?php 
				 			}
				 ?>
            
          
            
        </table>

    
      </div>
    </div>
  </div>
</div>  
  
  
  <table width="100%" border="0" class="table table-condensed">
                         
                    
                      <tr>
                        <td colspan="2" bgcolor="#F0F0F0"><div align="left" class="style54">Observa&ccedil;&atilde;o:</div></td>
      </tr>
                      <tr>
                        <td height="54" colspan="2"><div align="left">
                        <input id="enviar" name="enviar" value="1" type="hidden" />
                
                        <textarea class="form-control" name="observacao" rows="3" id="observacao" style="max-width:700px; width: 500px; max-height: 300px;"></textarea>
                        
                        <input type="button" name="incluir" id="incluir" value="Incluir Obs" class="btn btn-default" onclick="carregaAjaxContratante('resultado', 'acaoObscontratante.php?id=<?=$idlogin;?>&observacao='+ document.getElementById('observacao').value+'&cnpj='+ document.getElementById('cnpj').value+'&acao='+ document.getElementById('enviar').value)" />
                        
                         <input id="atualizar" name="atualizar" value="4" type="hidden" />
                        

 <input type="button" name="incluir" id="incluir" value="Atualizar" class="btn btn-default" onclick="carregaAjaxContratante('atualiza', 'acaoObscontratante.php?id=<?=$idlogin;?>&acao='+ document.getElementById('atualizar').value)" />
                        
                        
                        
                        </div>
                        
                        <div id="resultado"></div>                        </td>
      </tr>
                   
                      <tr><td colspan="2"></tr>
  </table>
  
<div id="atualiza">  
  
  <table width="100%" border="0" class="table table-condensed">
               
                          <tr>
                            <td width="78" bgcolor="#C0C0C0" class="style56">Data</td>
                    
                            <td width="600" bgcolor="#C0C0C0" class="style56">Observa&ccedil;&atilde;o</td>
                            
                            <td bgcolor="#C0C0C0" class="style56">Usu&aacute;rio</td>
                          </tr>
                      
                     <tr>
                     
                <td height="21" colspan="4"><div id="resultado">
                
            
<?php  $consulta2 = "SELECT obs_texto ,obs_usuario, DATE_FORMAT(obs_data, '%d/%m/%Y %T' ) AS dt FROM obs_contratante where obs_cod = '".$idlogin."' group by obs_id desc limit 0 , 6" ;
			
			$executa2 = mysqli_query($mysqli, $consulta2) or die(mysqli_error($mysqli));
			
			$num_rows2 = mysqli_num_rows($executa2);
			   if($num_rows2!=0)
		{
		   while($rst2 = mysqli_fetch_array($executa2))
			{?>
                  <tr  class="style8">
                    <td width="69" class="style8"><span class="style8">
                      <?=$rst2["dt"];?>
                    </span></td>

                    <td width="599" class="style8"><span class="style8">
                      <?=$rst2["obs_texto"];?>
                    </span></td>
                    
                    <td>
                    <span class="style8">
                      <?=$rst2["obs_usuario"];?>
                    </span>
                    </td>
                  </tr>
  <?php                      $i++;
	}
}

?>
  </table>
  
<?php  

$consulta_contador = "SELECT * FROM obs_contratante where obs_cod = '".$idlogin."' " ;
$executa_contador = mysqli_query($mysqli, $consulta_contador) or die(mysqli_error($mysqli));		

$num_rows_contador = mysqli_num_rows($executa_contador);


if($num_rows_contador > "6"){ ?>
  
 <ul class="pager">
   
    <li class="next"><a href="#" onclick="carregaAjaxContratante('atualiza', 'acaoObscontratante.php?id=<?=$idlogin;?>&acao=3&limite=0')">Pr&oacute;ximo &rarr;</a></li>
</ul>
 
 <?php  } ?> 
 
  </div>
  
  <?php  if($rst["contratante_observacao"] != ""){?>
	  
	<table class="table table-bordered table-condensed" width="100%">
    	<tr>
        	<td bgcolor="#C0C0C0">
            	Obs:
            </td>
      </tr>
        <tr>
        	<td>
            	<?=$rst["contratante_observacao"]?>
            </td>
        
        </tr>
    
    
    </table>
	  
	  
	  
 <?php  }?>
  
  
 
                          
                          <table width="100%" class="table table-condensed" border="0">
                            <tr>
                              <td height="16" bgcolor="#F0F0F0"><div align="center"><span class="style48" style="padding-left:10px; color: #333333;"> Contratantes Filiais</span></div></td>
                            </tr>
                            <tr>
                              <td height="35"><span class="style54">Cod Login</span>
                                <input name="cod_login" type="text" id="cod_login" size="10" onblur="selecionar2()" class="form-control input-sm" style="width: 90px;" />
                                <span class="style54">Nome Fantasia</span>
                                <select name="cmb_contratante" id="cmb_contratante" class="form-control input-sm" style="width: 300px;" >
                                  <option> </option>
                                  <?php 
							
$consulta = "Select usuario_LOGIN 	,cont_nomefantasia from  contratante

where contratante_codrepresentante <> '1016' order by  	cont_nomefantasia ";
$executa = mysqli_query($mysqli, $consulta) or die(mysqli_error($mysqli));


while($rstb = mysqli_fetch_array($executa))						

			{ ?>
                                  <option value="<?=$rstb['usuario_LOGIN'];?>" onclick="selecionar('<?=$rstb['usuario_LOGIN'];?>','<?=$rstb['cont_nomefantasia'];?>')"><?=$rstb['cont_nomefantasia'];?>   </option>
                                  
                                  <?php  }
							?>
                                </select>
                                
<button type="button" name="button2" id="button2" class="btn btn-default"  onclick="adicionar('<?=$idlogin;?>')">Adicionar</button></td>
                            </tr>
  </table>
                            <div  id="filial"> 
                              <table width="100%" class="table table-condensed" border="0">
                                <tr>
                                  <td width="66" bgcolor="#C0C0C0" class="style56"><div align="center">Excluir</div></td>
                                  <td width="639" bgcolor="#C0C0C0" class="style56">Nome Fantasia</td>
                                </tr>
                                <?php  
							$consultac = "Select usuario_LOGIN 	,cont_nomefantasia, c_id  from  contratante_ligacao left join contratante on usuario_LOGIN =  	c_login_filial
where c_login_principal = '".$rst['login']."' order by 	cont_nomefantasia ";
$executac = mysqli_query($mysqli, $consultac) or die(mysqli_error($mysqli));

while($rstc = mysqli_fetch_array($executac))						

			{
							?>
                                <tr>
                                  <td bgcolor="#FFFFFF" class="style3"><div align="center"><img src="../img/lixeira.jpg"  style="cursor:pointer"  onclick="exclui('<?=$rstc["c_id"];?>','<?=$rstc["cont_nomefantasia"];?>','<?=$idlogin;?>')" /> </div></td>
                                  <td bgcolor="#FFFFFF" class="style3 style5"><?=$rstc['usuario_LOGIN'];?>-<?=$rstc['cont_nomefantasia'];?></td>
                                </tr>
                                <?php  
							} 
							?>
                              </table>

            <div id="resposta"  align="center" style="color:#333;"></div>
            
       <div align="center">
 
       
       <?php  if ($p101 == 0) { ?>
  
		<button class="btn btn-success" style="width: 200px;"  type="button" onclick="carregaAjaxContratante('resposta', 'validadorcontratosalvar.php?codigologin='+ document.getElementById('codigologin').value+'&cpf='+ document.getElementById('cpf').value+'&cnpj='+ document.getElementById('cnpj').value+'&razao='+ document.getElementById('razao_social').value+'&fantasia='+ document.getElementById('nome_fantasia').value+'&nome='+ document.getElementById('nome').value+'&cep='+ 
document.getElementById('cep').value+'&estado='+ document.getElementById('estado').value+'&cidade='+ document.getElementById('cidade').value+'&bairro='+ document.getElementById('bairro').value+'&rua='+ document.getElementById('rua').value+'&numero='+ document.getElementById('numero').value+'&complemento='+ document.getElementById('complemento').value+'&ddd_comercial='+ document.getElementById('ddd_comercial').value+'&fone_comercial='+ document.getElementById('fone_comercial').value+'&ddd_fax='+ document.getElementById('ddd_fax').value+'&fone_fax='+ document.getElementById('fone_fax').value+'&ddd_celular='+ document.getElementById('ddd_celular').value+'&fone_celular='+ document.getElementById('fone_celular').value+'&email='+ document.getElementById('email').value+'&site='+ document.getElementById('site').value+'&tipo_contrato1='+ document.getElementById('tipo_contrato1').value+'&segmento='+ document.getElementById('segmento').value+'&publico='+ document.getElementById('publico').value+'&taxavista='+ document.getElementById('taxavista').value+ '&taxavistaCreditall='+ document.getElementById('taxavistaCreditall').value+'&taxavista7='+ document.getElementById('taxavista7').value+'&taxavista7Creditall='+ document.getElementById('taxavista7Creditall').value+'&vlraprovada='+document.getElementById('vlraprovada').value+'&vlrcancelada='+ document.getElementById('vlrcancelada').value+'&vlrevitada='+ document.getElementById('vlrevitada').value+'&mensalidade='+ document.getElementById('mensalidade').value+'&parcelamento='+ document.getElementById('parcelamento').value+'&parcelamento2='+ document.getElementById('parcelamento2').value+'&pontos='+ document.getElementById('pontos').value+'&vl_ativacao='+ document.getElementById('vl_ativacao').value+'&banco1='+ document.getElementById('banco1').value+'&agencia='+ document.getElementById('agencia').value+'&conta='+ document.getElementById('conta').value
+'&prazo='+ document.getElementById('prazo').value+'&alinea='+ document.getElementById('alinea').value+'&taxavista2='+ document.getElementById('taxavista72').value+'&taxaprazo2='+ document.getElementById('taxaprazo2').value+'&vlraprovada2='+ document.getElementById('vlraprovada2').value+'&vlrcancelada2='+ document.getElementById('vlrcancelada2').value+'&vlrevitada2='+ document.getElementById('vlrevitada2').value+'&mensalidade2='+ document.getElementById('mensalidade2').value+'&vl_ativacao2='+ document.getElementById('vl_ativacao2').value+'&chequeunico='+ document.getElementById('chequeunico').value+'&responsavel='+ document.getElementById('responsavel').value+'&agenciaDV='+ document.getElementById('agenciaDV').value+'&contaDV='+ document.getElementById('contaDV').value+'&cedente='+ document.getElementById('cedente').value+'&cedenteDV='+ document.getElementById('cedenteDV').value+'&carteira='+ document.getElementById('carteira').value+'&vlrEmissao='+ document.getElementById('vlrEmissao').value+'&vlrAprovadoCheque='+ document.getElementById('vlrAprovadoCheque').value+'&vlrAprovadoCartao='+ document.getElementById('vlrAprovadoCartao').value+'&taxaAprovadaCartao='+ document.getElementById('taxaAprovadaCartao').value+'&taxaAprovacaoCrediario='+ document.getElementById('taxaAprovacaoCrediario').value+'&txCliente='+ document.getElementById('txCliente').value+'&vlrEvitadoCartao='+ document.getElementById('vlrEvitadoCartao').value+'&tipocartao='+ document.getElementById('tipocartao').value+'&juroboleto='+ document.getElementById('juroboleto').value+'&taxaboleto='+ document.getElementById('taxaboleto').value+'&senhaA1='+ document.getElementById('senhaA1').value+'&senhaB='+ document.getElementById('senhaB').value+'&tipoboleto='+ document.getElementById('tipoboleto').value+'&sintetico='+ document.getElementById('sintetico').value+'&detalhado='+ document.getElementById('detalhado').value+'&completo='+ document.getElementById('completo').value+'&representante='+ document.getElementById('representante').value+'&ativo2='+ document.getElementById('ativo2').value+'&repasse='+ document.getElementById('repasse').value+'&emitecartao='+ document.getElementById('emitecartao').value+'&dtcadastro='+ document.getElementById('dtcadastro').value+'&dtassinatura='+ document.getElementById('dtassinatura').value+'&webcam='+ document.getElementById('webcam').value+'&webcam2='+ document.getElementById('webcam2').value+'&cooperado='+ document.getElementById('cooperado').value+'&taxaprazo30='+ document.getElementById('taxaprazo30').value+'&taxaprazo30Creditall='+ document.getElementById('taxaprazo30Creditall').value+'&taxaprazo45='+ document.getElementById('taxaprazo45').value+'&taxaprazo45Creditall='+ document.getElementById('taxaprazo45Creditall').value+'&taxaprazo_a='+ document.getElementById('taxaA').value+'&taxaprazo_aCreditall='+ document.getElementById('taxaACreditall').value+'&taxaprazo_b='+ document.getElementById('taxaprazo_b').value+'&taxaprazo_bCreditall='+ document.getElementById('taxaprazo_bCreditall').value+'&vlrAprovadoCadAprovado='+ document.getElementById('vlrAprovadoCadAprovado').value+'&chterceiro='+ document.getElementById('chterceiro').value+'&vlrAprovadoCadNegado='+ document.getElementById('vlrAprovadoCadNegado').value+'&repassech='+ document.getElementById('repassech').value+'&emitecartao='+ document.getElementById('emitecartao').value+'&baserestritiva='+ document.getElementById('baserestritiva').value+'&adesaoCrediario='+ document.getElementById('adesaoCrediario').value+'&termoCheque='+ document.getElementById('termoCheque').value+'&repassech='+ document.getElementById('repassech').value+'&taxaAM='+ document.getElementById('taxaAM').value+'&taxaAM2='+ document.getElementById('taxaAM2').value+'&boleto_cred='+ document.getElementById('boleto_cred').value+'&convenio='+ document.getElementById('convenio').value+'&dtassinatura2='+ document.getElementById('dtassinatura2').value+'&convenio='+ document.getElementById('convenio').value+'&cobrancaautomatica='+ document.getElementById('cobrancaautomatica').value+'&mensalidadecartao='+ document.getElementById('mensalidadecartao').value+'&BASE_A='+ document.getElementById('BASE_A').value+'&BASE_B='+ document.getElementById('BASE_B').value+'&BASE_C='+ document.getElementById('BASE_C').value+'&BASE_D='+ document.getElementById('BASE_D').value+'&BASE_E='+ document.getElementById('BASE_E').value+'&BASE_F='+ document.getElementById('BASE_F').value+'&repasseemissao='+ document.getElementById('repasseemissao').value+'&repassecadastro='+ document.getElementById('repassecadastro').value+'&desconto='+ document.getElementById('desconto').value+'&comando='+ document.getElementById('comando').value+'&BASE_A1='+ document.getElementById('BASE_A1').value+'&BASE_B1='+ document.getElementById('BASE_B1').value+'&BASE_C1='+ document.getElementById('BASE_C1').value+'&BASE_D1='+ document.getElementById('BASE_D1').value+'&BASE_E1='+ document.getElementById('BASE_E1').value+'&vlrquadro1='+ document.getElementById('vlrquadro1').value+'&BASE_G1='+ document.getElementById('BASE_G1').value
+'&BASE_H1='+ document.getElementById('BASE_H1').value+'&BASE_G='+ document.getElementById('BASE_G').value+'&credito='+ document.getElementById('credito').value+'&limite_cheque='+ document.getElementById('limite_cheque').value+'&debitocred='+ document.getElementById('depositocred').value+'&debitoch='+ document.getElementById('depositoch').value+'&limite='+ document.getElementById('limite').value+'&taxaprazo100='+ document.getElementById('taxaprazo100').value+'&taxaprazo100Creditall='+ document.getElementById('taxaprazo100Creditall').value+'&dtcancelamento='+ document.getElementById('dtcancelamento').value+'&dtremessa='+ document.getElementById('dtremessa').value+'&lote='+ document.getElementById('lote').value+'&apemissao='+ document.getElementById('apemissao').value+'&aplojista='+ document.getElementById('aplojista').value+'&aplojistaR='+ document.getElementById('aplojistaR').value+'&vlrAL='+ document.getElementById('vlrAL').value+'&sol_cartao_cheque='+ document.getElementById('sol_cartao_cheque').value+'&sol_cartao_f='+ document.getElementById('sol_cartao_f').value+'&sol_cartao_j='+ document.getElementById('sol_cartao_j').value+'&sol_cartao_chequej='+ document.getElementById('sol_cartao_chequej').value+'&diasboleto='+ document.getElementById('diasboleto').value+'&lib_recebimento='+ document.getElementById('lib_recebimento').value+'&vlr_buscaserasa='+ document.getElementById('vlr_buscaserasa').value+'&vlr_buscaserasa2='+ document.getElementById('vlr_buscaserasa2').value+'&vlr_buscaserasa2_CNPJ='+ document.getElementById('vlr_buscaserasa2_CNPJ').value+'&vlr_multi_ch='+ document.getElementById('vlr_multi_ch').value+'&vlr_multi_cred='+ document.getElementById('vlr_multi_cred').value+'&contrato_impressao='+ document.getElementById('contrato_impressao').value+'&contrato_calc_debito='+ document.getElementById('contrato_calc_debito').value+'&liberajuro='+ document.getElementById('liberajuro').value+'&repassalibera='+ document.getElementById('repassalibera').value+'&prelibera='+ document.getElementById('prelibera').value+'&prevalor='+ document.getElementById('prevalor').value+'&liberajuro_ch='+ document.getElementById('liberajuro_ch').value+'&repassalibera_ch='+ document.getElementById('repassalibera_ch').value+ '&contrato_calc_debito_cred='+ document.getElementById('contrato_calc_debito_cred').value +'&ponto_equilibrio='+ document.getElementById('ponto_equilibrio').value+'&ponto_equilibrio_cheque='+ document.getElementById('ponto_equilibrio_cheque').value+'&codigotransmissao='+ document.getElementById('codigotransmissao').value+'&identidade='+ document.getElementById('identidade').value+'&tela_simplificadach='+ document.getElementById('tela_simplificadach').value+'&leitora='+ document.getElementById('leitora').value+'&parcela_b='+ document.getElementById('parcela_b').value+'&vlr_buscaserasa_CNPJ='+ document.getElementById('vlr_buscaserasa_CNPJ').value+'&boleto='+ document.getElementById('boleto').value+'&siteecommerce='+ document.getElementById('siteecommerce').value+'&taxaAprovadaCartao_flet='+ document.getElementById('taxaAprovadaCartao_flet').value+'&taxaAprovadaCartao_flet30='+ document.getElementById('taxaAprovadaCartao_flet30').value+'&taxaAprovadaCartao_flet45='+ document.getElementById('taxaAprovadaCartao_flet45').value+'&parcela_a2='+ document.getElementById('parcela_a2').value+'&parcela_b2='+ document.getElementById('parcela_b2').value+'&taxaA_flet='+ document.getElementById('taxaA_flet').value+'&taxaB_flet='+ document.getElementById('taxaB_flet').value+'&vlrCrediarioCancelado='+ document.getElementById('vlrCrediarioCancelado').value +'&taxa_adicional_repasse='+ document.getElementById('taxa_adicional_repasse').value +'&repasse_flat='+ document.getElementById('repasse_flat').value +'&hibrido='+ document.getElementById('hibrido').value + '&tx_flet2='+ document.getElementById('tx_flet2').value 
+ '&ecommerce_vista='+ document.getElementById('ecommerce_vista').value + '&ecommerce='+ document.getElementById('ecommerce').value + '&tipo_juro=' + document.getElementById('calculo_txch').value   + '&termica=' + document.getElementById('termica').value
 + '&bancodep=' + document.getElementById('tipoboleto2').value  + '&agenciadep=' + document.getElementById('agencia2').value
+ '&agenciadvdep=' + document.getElementById('agenciaDV2').value  + '&contadep=' + document.getElementById('conta2').value 
   + '&contadvdep=' + document.getElementById('contaDV2').value + '&operacao=' + document.getElementById('operacao').value 
  + '&valorboleto=' + document.getElementById('valorboleto').value  + '&cobrancasms=' + document.getElementById('cobrancasms').value + '&lb_cartao_ch=' + document.getElementById('lb_cartao_ch').value  + '&lb_data_ch=' + document.getElementById('lb_data_ch').value  + '&lb_corte_terceiro=' + document.getElementById('lb_corte_terceiro').value  
  + '&lb_quiz_ch=' + document.getElementById('lb_quiz_ch').value + '&simplesconf=' + document.getElementById('simplesconf').value 
+'&senhaconf=' + document.getElementById('senhaconf').value
+'&piloto=' + document.getElementById('piloto').value
+'&tributacao=' + document.getElementById('tributacao').value
+'&dias_ressarcimentoch=' + document.getElementById('dias_ressarcimentoch').value 
+'&dias_cred=' + document.getElementById('dias_cred').value 
+'&pontos_atigindo=' + document.getElementById('pontos_atigindo').value 
+'&grupoContratante=' + document.getElementById('grupo').value  +'&codCont=' + document.getElementById('codCont').value 
+'&vis_cobranca=' + document.getElementById('vis_cobranca').value
+'&libera_crediario=' + document.getElementById('libera_crediario').value
+'&libera_cheque=' + document.getElementById('libera_cheque').value
+'&tipoVenda=' + document.getElementById('tipoVenda').value
+'&tipoVendacr=' + document.getElementById('tipoVendacr').value
+'&pontos_atigindo_maximo=' + document.getElementById('pontos_atigindo_maximo').value
+'&dados_banco=' + document.getElementById('dados_banco').value
+'&empresa=' + document.getElementById('empresa').value
+'&multiplicadormosaico=' + document.getElementById('vlr_multi_mosaicocred').value
+'&varp_localizabaseACP=' + document.getElementById('contp_localizabaseACP').value
+'&varp_localizabaseSerasa=' + document.getElementById('contp_localizabaseSerasa').value
+'&varp_localizabaseBrasil=' + document.getElementById('contp_localizabaseBrasil').value
+'&vartp_mosaicosocio=' + document.getElementById('contp_mosaicosocio').value
+'&vartp_antifraude=' + document.getElementById('contp_antifraude').value
+'&vartp_localize=' + document.getElementById('contp_localize').value
+'&vartp_localizadebitocpf=' + document.getElementById('contp_localizadebitocpf').value
+'&vartp_localizadebitocnpj=' + document.getElementById('contp_localizadebitocnpj').value
+'&vartp_debitomosaicoScnpj=' + document.getElementById('contp_debitomosaicoScnpj').value
+'&vartp_debitomosaicoAcpf=' + document.getElementById('contp_debitomosaicoAcpf').value
+'&vartp_debitomosaicoAcnpj=' + document.getElementById('contp_debitomosaicoAcnpj').value
+'&vartp_debitoantifraudecnpj=' + document.getElementById('contp_debitoantifraudecnpj').value
+'&vartp_debitosocios=' + document.getElementById('contp_debitosocios').value
+'&vartp_debitoantifraudecpf=' + document.getElementById('contp_debitoantifraudecpf').value
+'&var_tipoempresa=' + document.getElementById('tipoempresa').value
+'&var_contratofoto=' + document.getElementById('contratofoto').value
+'&var_adesaofoto=' + document.getElementById('adesaofoto').value
+'&var_visualizatitulo=' + document.getElementById('visualizatitulo').value
+'&contp_debitomosaicoSnegado=' + document.getElementById('contp_debitomosaicoSnegado').value
+'&contp_debitomosaicoSlimite=' + document.getElementById('contp_debitomosaicoSlimite').value
+'&contp_debitomosaicoAnegado=' + document.getElementById('contp_debitomosaicoAnegado').value
+'&contp_debitomosaicoAlimite=' + document.getElementById('contp_debitomosaicoAlimite').value
+'&boleto_imptodos=' + document.getElementById('boleto_imptodos').value
+'&boleto_modboleto=' + document.getElementById('boleto_modboleto').value
+'&contp_preanlise=' + document.getElementById('contp_preanlise').value
+'&modcobranca=' + document.getElementById('modcobranca').value
+'&modboletofatura=' + document.getElementById('modboletofatura').value
+'&permissao_aceite=' + document.getElementById('permissao_aceite').value
+'&botao_cancela=' + document.getElementById('botao_cancela').value
+'&contp_diaspreanalise=' + document.getElementById('contp_diaspreanalise').value
+'&cont_contrmodeloch=' + document.getElementById('cont_contrmodeloch').value
+'&cont_contrmodelocred=' + document.getElementById('cont_contrmodelocred').value
+'&contp_combustivel=' + document.getElementById('combustivel').value
+'&jurosc=' + document.getElementById('jurosc').value
+'&gestor=' + document.getElementById('gestor').value
+'&preliberaAnalitico=' + document.getElementById('preliberaAnalitico').value
+'&acessobase=' + document.getElementById('acessobase').checked
+'&notacheia=' + document.getElementById('notacheia').value
+'&cont_cobgrafico=' + document.getElementById('cont_cobgrafico').value
+'&cont_entrega=' + document.getElementById('cont_entrega').value
+'&codmunicipio=' + document.getElementById('codmunicipio').value
+'&cont_VlrAdParcela=' + document.getElementById('cont_VlrAdParcela').value
+'&razaoboleto=' + document.getElementById('razaoboleto').value
+'&cnpjboleto=' + document.getElementById('cnpjboleto').value
+'&arteremessa=' + document.getElementById('arteremessa').value
+'&tipocartaoremessa=' + document.getElementById('tipocartaoremessa').value
+'&envioremessa=' + document.getElementById('envioremessa').value
+'&qtderemessa=' + document.getElementById('qtderemessa').value
+'&conta_contabil_passivo=' + document.getElementById('conta_contabil_passivo').value
+'&conta_contabil_ativo=' + document.getElementById('conta_contabil_ativo').value
+'&tipo_entrada=' + document.getElementById('tipo_entrada').value
+'&capital_social=' + document.getElementById('capital_social').value
+'&dt_implantacao=' + document.getElementById('dt_implantacao').value
+'&versao_contrato=' + document.getElementById('versao_contrato').value
+'&cont_protocoloDigital=' + document.getElementById('cont_protocoloDigital').value
+'&cont_protocolodigitalLibera=' + document.getElementById('_protocoloDigitalLibera').value
+'&cont_menuNovo=' + document.getElementById('cont_menuNovo').value
+'&termoCrediario=' + document.getElementById('termoCrediario').value
+'&termoAdesao=' + document.getElementById('termoAdesao').value
+'&cont_qrcode=' + document.getElementById('cont_qrcode').value
+'&cont_doc=' + document.getElementById('cont_doc').value
+'&cont_selfie=' + document.getElementById('cont_selfie').value
+'&qrocdeCartao=' + document.getElementById('cont_cartao').value
+'&qrocdeCartaoCh=' + document.getElementById('cont_cartaoch').value
+'&qrcodeCheque=' + document.getElementById('cont_qrcodeCheque').value
+'&qrcodeSelfie=' + document.getElementById('ocrSelfie').value
+'&qrcodeDoc=' + document.getElementById('ocrDoc').value
+'&qrocdeCheque=' + document.getElementById('ocrCheque').value
+'&qrocdeAcp=' + document.getElementById('cont_acp').value 
+'&qrocdeAcpch=' + document.getElementById('cont_acpch').value
+'&modelorepasse=' + document.getElementById('modelorepasse').value
+'&pontosFraude=' + document.getElementById('pontosFraude').value
+'&pontosFraudeCH=' + document.getElementById('pontosFraudeCH').value
+'&versao_cred=' + document.getElementById('versaoContCred').value
+'&versao_cheq=' + document.getElementById('versaoContCheq').value
+'&versao_Outro=' + document.getElementById('versaoContOutro').value
+'&versao_credDT=' + document.getElementById('dtVersaoCredito').value
+'&versao_cheqDT=' + document.getElementById('dtVersaoCheque').value
+'&versao_outroDT=' + document.getElementById('dtVersaoOutros').value
+'&bloqueiotroca=' + document.getElementById('bloqueiotroca').value
+'&bloqueioDez=' + document.getElementById('bloqueioDez').value
+'&cep_ch=' + document.getElementById('cep_ch').value
+'&acionarcob=' + document.getElementById('acionarcob').value
+'&tivit=' + document.getElementById('tivit').value
+'&txSim=' + document.getElementById('txSim').value
+'&repasseVlrBol=' + document.getElementById('repasseVlrBol').value
+'&confis=' + document.getElementById('confis').value
+'&pis=' + document.getElementById('pis').value
+'&ir=' + document.getElementById('ir').value
+'&csll=' + document.getElementById('csll').value
+'&sequencialBoleto=' + document.getElementById('sequencialBoleto').value
+'&sequencialRemessa=' + document.getElementById('sequencialRemessa').value
+'&vlr_negativacao=' + document.getElementById('vlr_negativacao').value
+'&codassociado=' + document.getElementById('codassociado').value
+'&Ind_negativacao=' + document.getElementById('Ind_negativacao').value
+'&seq_negativacao=' + document.getElementById('seq_negativacao').value
+'&perfilvip=' + document.getElementById('perfilvip').value
+'&linkPagamento=' + document.getElementById('linkPagamento').value

 )" >
<span class="glyphicon glyphicon-floppy-saved"></span> SALVAR</button>

<?php  } ?>

       </div>     
     
      
  <?php 
  }
			}
  ?>
</div>
</form>   

</body>
</html>
