<?php
class form_master_odp_form extends form_master_odp_apl
{
function Form_Init()
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
?>
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("Data ODP"); } else { echo strip_tags("Data ODP"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php
header("X-XSS-Protection: 0");
?>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
 </SCRIPT>
 <SCRIPT type="text/javascript">
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
<?php
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['sc_redir_atualiz'] == 'ok')
{
?>
  var sc_closeChange = true;
<?php
}
else
{
?>
  var sc_closeChange = false;
<?php
}
?>
 </SCRIPT>
        <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_master_odp/form_master_odp_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("form_master_odp_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_binicio_off = "<?php echo $this->arr_buttons['binicio_off']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bavanca_off = "<?php echo $this->arr_buttons['bavanca_off']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bretorna_off = "<?php echo $this->arr_buttons['bretorna_off']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_bfinal_off  = "<?php echo $this->arr_buttons['bfinal_off']['type']; ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).show();
       $("#sc_b_ini_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_ini_" + str_pos).show();
       $("#gbl_sc_b_ini_off_" + str_pos).hide();
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).show();
       $("#sc_b_ret_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_ret_" + str_pos).show();
       $("#gbl_sc_b_ret_off_" + str_pos).hide();
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).hide();
       $("#sc_b_ini_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_ini_" + str_pos).hide();
       $("#gbl_sc_b_ini_off_" + str_pos).show();
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).hide();
       $("#sc_b_ret_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_ret_" + str_pos).hide();
       $("#gbl_sc_b_ret_off_" + str_pos).show();
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).show();
       $("#sc_b_fim_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_fim_" + str_pos).show();
       $("#gbl_sc_b_fim_off_" + str_pos).hide();
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).show();
       $("#sc_b_avc_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_avc_" + str_pos).show();
       $("#gbl_sc_b_avc_off_" + str_pos).hide();
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).hide();
       $("#sc_b_fim_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_fim_" + str_pos).hide();
       $("#gbl_sc_b_fim_off_" + str_pos).show();
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).hide();
       $("#sc_b_avc_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_avc_" + str_pos).hide();
       $("#gbl_sc_b_avc_off_" + str_pos).show();
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
function summary_atualiza(reg_ini, reg_qtd, reg_tot)
{
    nm_sumario = "[<?php echo $this->Ini->Nm_lang['lang_othr_smry_info']?>]";
    nm_sumario = nm_sumario.replace("?start?", reg_ini);
    nm_sumario = nm_sumario.replace("?final?", reg_qtd);
    nm_sumario = nm_sumario.replace("?total?", reg_tot);
    if (reg_qtd < 1) {
        nm_sumario = "";
    }
    if (document.getElementById("sc_b_summary_b")) document.getElementById("sc_b_summary_b").innerHTML = nm_sumario;
}
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}
<?php

include_once('form_master_odp_jquery.php');

?>

 var scQSInit = true;
 var scQSPos  = {};
 var Dyn_Ini  = true;
 $(function() {


  scJQGeneralAdd();

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).on('load', function() {
   });
 if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['recarga'];
}
if ('novo' == $opcao_botoes && $this->Embutida_form)
{
    $opcao_botoes = 'inicio';
}
?>
<body class="scFormPage" style="<?php echo $str_iframe_body; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_master_odp_js0.php");
?>
<script type="text/javascript"> 
  sc_quant_excl = <?php echo count($sc_check_excl); ?>; 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
 </script>
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="script_case_session" value="<?php  echo $this->form_encode_input(session_id()); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_master_odp'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_master_odp'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<script type="text/javascript">
var scMsgDefTitle = "<?php echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl']; ?>";
var scMsgDefButton = "Ok";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->page; ?>";
</script>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0 >
 <tr>
  <td>
  <div class="scFormBorder">
   <table width='100%' cellspacing=0 cellpadding=0>
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R")
{
    $NM_btn = false;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($this->Embutida_form) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "do_ajax_form_master_odp_add_new_line(); return false;", "do_ajax_form_master_odp_add_new_line(); return false;", "sc_b_new_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "nm_move ('novo');", "nm_move ('novo');", "sc_b_new_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bincluir", "nm_atualiza ('incluir');", "nm_atualiza ('incluir');", "sc_b_ins_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "" . $this->NM_cancel_insert_new . " document.F5.submit();", "" . $this->NM_cancel_insert_new . " document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "balterarsel", "nm_atualiza ('alterar');", "nm_atualiza ('alterar');", "sc_b_upd_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bexcluirsel", "nm_atualiza ('excluir');", "nm_atualiza ('excluir');", "sc_b_del_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<tr><td>
<?php
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['empty_filter'] = true;
       }
       echo "<tr><td>";
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
     <div id="SC_tab_mult_reg">
<?php
}

function Form_Table($Table_refresh = false)
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
   if ($Table_refresh) 
   { 
       ob_start();
   }
?>
<?php
   if (!isset($this->nmgp_cmp_hidden['tpmo_id_']))
   {
       $this->nmgp_cmp_hidden['tpmo_id_'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable" width="100%" style="height: 100%;">   <tr>
<?php
$orderColName = '';
$orderColOrient = '';
?>
    <script type="text/javascript">
     var orderImgAsc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc ?>";
     var orderImgDesc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc ?>";
     var orderImgNone = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort ?>";
     var orderColName = "";
     function scSetOrderColumn(clickedColumn) {
      $(".sc-ui-img-order-column").attr("src", orderImgNone);
      if (clickedColumn != orderColName) {
       orderColName = clickedColumn;
       orderColOrient = orderImgAsc;
      }
      else if ("" != orderColName) {
       orderColOrient = orderColOrient == orderImgAsc ? orderImgDesc : orderImgAsc;
      }
      else {
       orderColName = "";
       orderColOrient = "";
      }
      $("#sc-id-img-order-" + orderColName).attr("src", orderColOrient);
     }
    </script>
<?php
     $Col_span = "";


       if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && ($this->nmgp_botoes['delete'] == "on" || $this->nmgp_botoes['update'] == "on")) { $Col_span = " colspan=2"; }
    if (!$this->Embutida_form && $this->nmgp_opcao == "novo") { $Col_span = " colspan=2"; }
 ?>

    <TD class="scFormLabelOddMult" <?php echo $Col_span ?>> &nbsp; </TD>
   
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] == "on") {?>
    <TD class="scFormLabelOddMult"  width="10">  </TD>
   <?php }?>
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] != "on") {?>
    <TD class="scFormLabelOddMult"  width="10"> &nbsp; </TD>
   <?php }?>
   <?php if (isset($this->nmgp_cmp_hidden['tpmo_id_']) && $this->nmgp_cmp_hidden['tpmo_id_'] == 'off') { $sStyleHidden_tpmo_id_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tpmo_id_']) || $this->nmgp_cmp_hidden['tpmo_id_'] == 'on') {
      if (!isset($this->nm_new_label['tpmo_id_'])) {
          $this->nm_new_label['tpmo_id_'] = "ID"; } ?>

    <TD class="scFormLabelOddMult css_tpmo_id__label" id="hidden_field_label_tpmo_id_" style="<?php echo $sStyleHidden_tpmo_id_; ?>" > <?php echo $this->nm_new_label['tpmo_id_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_projectid_']) && $this->nmgp_cmp_hidden['tpmo_projectid_'] == 'off') { $sStyleHidden_tpmo_projectid_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tpmo_projectid_']) || $this->nmgp_cmp_hidden['tpmo_projectid_'] == 'on') {
      if (!isset($this->nm_new_label['tpmo_projectid_'])) {
          $this->nm_new_label['tpmo_projectid_'] = "Project ID"; } ?>

    <TD class="scFormLabelOddMult css_tpmo_projectid__label" id="hidden_field_label_tpmo_projectid_" style="<?php echo $sStyleHidden_tpmo_projectid_; ?>" > <?php echo $this->nm_new_label['tpmo_projectid_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_namanode_']) && $this->nmgp_cmp_hidden['tpmo_namanode_'] == 'off') { $sStyleHidden_tpmo_namanode_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tpmo_namanode_']) || $this->nmgp_cmp_hidden['tpmo_namanode_'] == 'on') {
      if (!isset($this->nm_new_label['tpmo_namanode_'])) {
          $this->nm_new_label['tpmo_namanode_'] = "Nama ODP"; } ?>

    <TD class="scFormLabelOddMult css_tpmo_namanode__label" id="hidden_field_label_tpmo_namanode_" style="<?php echo $sStyleHidden_tpmo_namanode_; ?>" > <?php echo $this->nm_new_label['tpmo_namanode_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_awal_']) && $this->nmgp_cmp_hidden['tpmo_awal_'] == 'off') { $sStyleHidden_tpmo_awal_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tpmo_awal_']) || $this->nmgp_cmp_hidden['tpmo_awal_'] == 'on') {
      if (!isset($this->nm_new_label['tpmo_awal_'])) {
          $this->nm_new_label['tpmo_awal_'] = "Nomor Awal"; } ?>

    <TD class="scFormLabelOddMult css_tpmo_awal__label" id="hidden_field_label_tpmo_awal_" style="<?php echo $sStyleHidden_tpmo_awal_; ?>" > <?php echo $this->nm_new_label['tpmo_awal_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_jmlodp_']) && $this->nmgp_cmp_hidden['tpmo_jmlodp_'] == 'off') { $sStyleHidden_tpmo_jmlodp_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tpmo_jmlodp_']) || $this->nmgp_cmp_hidden['tpmo_jmlodp_'] == 'on') {
      if (!isset($this->nm_new_label['tpmo_jmlodp_'])) {
          $this->nm_new_label['tpmo_jmlodp_'] = "JmlODP"; } ?>

    <TD class="scFormLabelOddMult css_tpmo_jmlodp__label" id="hidden_field_label_tpmo_jmlodp_" style="<?php echo $sStyleHidden_tpmo_jmlodp_; ?>" > <?php echo $this->nm_new_label['tpmo_jmlodp_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_akhir_']) && $this->nmgp_cmp_hidden['tpmo_akhir_'] == 'off') { $sStyleHidden_tpmo_akhir_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tpmo_akhir_']) || $this->nmgp_cmp_hidden['tpmo_akhir_'] == 'on') {
      if (!isset($this->nm_new_label['tpmo_akhir_'])) {
          $this->nm_new_label['tpmo_akhir_'] = "Nomor Akhir"; } ?>

    <TD class="scFormLabelOddMult css_tpmo_akhir__label" id="hidden_field_label_tpmo_akhir_" style="<?php echo $sStyleHidden_tpmo_akhir_; ?>" > <?php echo $this->nm_new_label['tpmo_akhir_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_merk_']) && $this->nmgp_cmp_hidden['tpmo_merk_'] == 'off') { $sStyleHidden_tpmo_merk_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tpmo_merk_']) || $this->nmgp_cmp_hidden['tpmo_merk_'] == 'on') {
      if (!isset($this->nm_new_label['tpmo_merk_'])) {
          $this->nm_new_label['tpmo_merk_'] = "Merk"; } ?>

    <TD class="scFormLabelOddMult css_tpmo_merk__label" id="hidden_field_label_tpmo_merk_" style="<?php echo $sStyleHidden_tpmo_merk_; ?>" > <?php echo $this->nm_new_label['tpmo_merk_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_kapport_']) && $this->nmgp_cmp_hidden['tpmo_kapport_'] == 'off') { $sStyleHidden_tpmo_kapport_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tpmo_kapport_']) || $this->nmgp_cmp_hidden['tpmo_kapport_'] == 'on') {
      if (!isset($this->nm_new_label['tpmo_kapport_'])) {
          $this->nm_new_label['tpmo_kapport_'] = "Kap. Port"; } ?>

    <TD class="scFormLabelOddMult css_tpmo_kapport__label" id="hidden_field_label_tpmo_kapport_" style="<?php echo $sStyleHidden_tpmo_kapport_; ?>" > <?php echo $this->nm_new_label['tpmo_kapport_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_nosp_']) && $this->nmgp_cmp_hidden['tpmo_nosp_'] == 'off') { $sStyleHidden_tpmo_nosp_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tpmo_nosp_']) || $this->nmgp_cmp_hidden['tpmo_nosp_'] == 'on') {
      if (!isset($this->nm_new_label['tpmo_nosp_'])) {
          $this->nm_new_label['tpmo_nosp_'] = "No. SP"; } ?>

    <TD class="scFormLabelOddMult css_tpmo_nosp__label" id="hidden_field_label_tpmo_nosp_" style="<?php echo $sStyleHidden_tpmo_nosp_; ?>" > <?php echo $this->nm_new_label['tpmo_nosp_'] ?> </TD>
   <?php } ?>





    <script type="text/javascript">
     var orderColOrient = "<?php echo $orderColOrient ?>";
     scSetOrderColumn("<?php echo $orderColName ?>");
    </script>
   </tr>
<?php   
} 
function Form_Corpo($Line_Add = false, $Table_refresh = false) 
{ 
   global $sc_seq_vert; 
   if ($Line_Add) 
   { 
       ob_start();
       $iStart = sizeof($this->form_vert_form_master_odp);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_master_odp = $this->form_vert_form_master_odp;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_master_odp))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['tpmo_id_']))
           {
               $this->nmgp_cmp_readonly['tpmo_id_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['tpmo_projectid_']))
           {
               $this->nmgp_cmp_readonly['tpmo_projectid_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['tpmo_akhir_']))
           {
               $this->nmgp_cmp_readonly['tpmo_akhir_'] = 'on';
           }
   foreach ($this->form_vert_form_master_odp as $sc_seq_vert => $sc_lixo)
   {
       $this->loadRecordState($sc_seq_vert);
       $this->tpmo_entryby_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_entryby_'];
       $this->tpmo_entrydate_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_entrydate_'];
       $this->tpmo_updateby_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_updateby_'];
       $this->tpmo_updatedate_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_updatedate_'];
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['tpmo_id_'] = true;
           $this->nmgp_cmp_readonly['tpmo_projectid_'] = true;
           $this->nmgp_cmp_readonly['tpmo_namanode_'] = true;
           $this->nmgp_cmp_readonly['tpmo_awal_'] = true;
           $this->nmgp_cmp_readonly['tpmo_jmlodp_'] = true;
           $this->nmgp_cmp_readonly['tpmo_akhir_'] = true;
           $this->nmgp_cmp_readonly['tpmo_merk_'] = true;
           $this->nmgp_cmp_readonly['tpmo_kapport_'] = true;
           $this->nmgp_cmp_readonly['tpmo_nosp_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['tpmo_id_']) || $this->nmgp_cmp_readonly['tpmo_id_'] != "on") {$this->nmgp_cmp_readonly['tpmo_id_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tpmo_projectid_']) || $this->nmgp_cmp_readonly['tpmo_projectid_'] != "on") {$this->nmgp_cmp_readonly['tpmo_projectid_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tpmo_namanode_']) || $this->nmgp_cmp_readonly['tpmo_namanode_'] != "on") {$this->nmgp_cmp_readonly['tpmo_namanode_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tpmo_awal_']) || $this->nmgp_cmp_readonly['tpmo_awal_'] != "on") {$this->nmgp_cmp_readonly['tpmo_awal_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tpmo_jmlodp_']) || $this->nmgp_cmp_readonly['tpmo_jmlodp_'] != "on") {$this->nmgp_cmp_readonly['tpmo_jmlodp_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tpmo_akhir_']) || $this->nmgp_cmp_readonly['tpmo_akhir_'] != "on") {$this->nmgp_cmp_readonly['tpmo_akhir_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tpmo_merk_']) || $this->nmgp_cmp_readonly['tpmo_merk_'] != "on") {$this->nmgp_cmp_readonly['tpmo_merk_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tpmo_kapport_']) || $this->nmgp_cmp_readonly['tpmo_kapport_'] != "on") {$this->nmgp_cmp_readonly['tpmo_kapport_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tpmo_nosp_']) || $this->nmgp_cmp_readonly['tpmo_nosp_'] != "on") {$this->nmgp_cmp_readonly['tpmo_nosp_'] = false;}
       }
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
        $this->tpmo_id_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_id_']; 
       $tpmo_id_ = $this->tpmo_id_; 
       if (!isset($this->nmgp_cmp_hidden['tpmo_id_']))
       {
           $this->nmgp_cmp_hidden['tpmo_id_'] = 'off';
       }
       $sStyleHidden_tpmo_id_ = '';
       if (isset($sCheckRead_tpmo_id_))
       {
           unset($sCheckRead_tpmo_id_);
       }
       if (isset($this->nmgp_cmp_readonly['tpmo_id_']))
       {
           $sCheckRead_tpmo_id_ = $this->nmgp_cmp_readonly['tpmo_id_'];
       }
       if (isset($this->nmgp_cmp_hidden['tpmo_id_']) && $this->nmgp_cmp_hidden['tpmo_id_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tpmo_id_']);
           $sStyleHidden_tpmo_id_ = 'display: none;';
       }
       $bTestReadOnly_tpmo_id_ = true;
       $sStyleReadLab_tpmo_id_ = 'display: none;';
       $sStyleReadInp_tpmo_id_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["tpmo_id_"]) &&  $this->nmgp_cmp_readonly["tpmo_id_"] == "on"))
       {
           $bTestReadOnly_tpmo_id_ = false;
           unset($this->nmgp_cmp_readonly['tpmo_id_']);
           $sStyleReadLab_tpmo_id_ = '';
           $sStyleReadInp_tpmo_id_ = 'display: none;';
       }
       $this->tpmo_projectid_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_projectid_']; 
       $tpmo_projectid_ = $this->tpmo_projectid_; 
       $sStyleHidden_tpmo_projectid_ = '';
       if (isset($sCheckRead_tpmo_projectid_))
       {
           unset($sCheckRead_tpmo_projectid_);
       }
       if (isset($this->nmgp_cmp_readonly['tpmo_projectid_']))
       {
           $sCheckRead_tpmo_projectid_ = $this->nmgp_cmp_readonly['tpmo_projectid_'];
       }
       if (isset($this->nmgp_cmp_hidden['tpmo_projectid_']) && $this->nmgp_cmp_hidden['tpmo_projectid_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tpmo_projectid_']);
           $sStyleHidden_tpmo_projectid_ = 'display: none;';
       }
       $bTestReadOnly_tpmo_projectid_ = true;
       $sStyleReadLab_tpmo_projectid_ = 'display: none;';
       $sStyleReadInp_tpmo_projectid_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["tpmo_projectid_"]) &&  $this->nmgp_cmp_readonly["tpmo_projectid_"] == "on"))
       {
           $bTestReadOnly_tpmo_projectid_ = false;
           unset($this->nmgp_cmp_readonly['tpmo_projectid_']);
           $sStyleReadLab_tpmo_projectid_ = '';
           $sStyleReadInp_tpmo_projectid_ = 'display: none;';
       }
       $this->tpmo_namanode_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_namanode_']; 
       $tpmo_namanode_ = $this->tpmo_namanode_; 
       $sStyleHidden_tpmo_namanode_ = '';
       if (isset($sCheckRead_tpmo_namanode_))
       {
           unset($sCheckRead_tpmo_namanode_);
       }
       if (isset($this->nmgp_cmp_readonly['tpmo_namanode_']))
       {
           $sCheckRead_tpmo_namanode_ = $this->nmgp_cmp_readonly['tpmo_namanode_'];
       }
       if (isset($this->nmgp_cmp_hidden['tpmo_namanode_']) && $this->nmgp_cmp_hidden['tpmo_namanode_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tpmo_namanode_']);
           $sStyleHidden_tpmo_namanode_ = 'display: none;';
       }
       $bTestReadOnly_tpmo_namanode_ = true;
       $sStyleReadLab_tpmo_namanode_ = 'display: none;';
       $sStyleReadInp_tpmo_namanode_ = '';
       if (isset($this->nmgp_cmp_readonly['tpmo_namanode_']) && $this->nmgp_cmp_readonly['tpmo_namanode_'] == 'on')
       {
           $bTestReadOnly_tpmo_namanode_ = false;
           unset($this->nmgp_cmp_readonly['tpmo_namanode_']);
           $sStyleReadLab_tpmo_namanode_ = '';
           $sStyleReadInp_tpmo_namanode_ = 'display: none;';
       }
       $this->tpmo_awal_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_awal_']; 
       $tpmo_awal_ = $this->tpmo_awal_; 
       $sStyleHidden_tpmo_awal_ = '';
       if (isset($sCheckRead_tpmo_awal_))
       {
           unset($sCheckRead_tpmo_awal_);
       }
       if (isset($this->nmgp_cmp_readonly['tpmo_awal_']))
       {
           $sCheckRead_tpmo_awal_ = $this->nmgp_cmp_readonly['tpmo_awal_'];
       }
       if (isset($this->nmgp_cmp_hidden['tpmo_awal_']) && $this->nmgp_cmp_hidden['tpmo_awal_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tpmo_awal_']);
           $sStyleHidden_tpmo_awal_ = 'display: none;';
       }
       $bTestReadOnly_tpmo_awal_ = true;
       $sStyleReadLab_tpmo_awal_ = 'display: none;';
       $sStyleReadInp_tpmo_awal_ = '';
       if (isset($this->nmgp_cmp_readonly['tpmo_awal_']) && $this->nmgp_cmp_readonly['tpmo_awal_'] == 'on')
       {
           $bTestReadOnly_tpmo_awal_ = false;
           unset($this->nmgp_cmp_readonly['tpmo_awal_']);
           $sStyleReadLab_tpmo_awal_ = '';
           $sStyleReadInp_tpmo_awal_ = 'display: none;';
       }
       $this->tpmo_jmlodp_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_jmlodp_']; 
       $tpmo_jmlodp_ = $this->tpmo_jmlodp_; 
       $sStyleHidden_tpmo_jmlodp_ = '';
       if (isset($sCheckRead_tpmo_jmlodp_))
       {
           unset($sCheckRead_tpmo_jmlodp_);
       }
       if (isset($this->nmgp_cmp_readonly['tpmo_jmlodp_']))
       {
           $sCheckRead_tpmo_jmlodp_ = $this->nmgp_cmp_readonly['tpmo_jmlodp_'];
       }
       if (isset($this->nmgp_cmp_hidden['tpmo_jmlodp_']) && $this->nmgp_cmp_hidden['tpmo_jmlodp_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tpmo_jmlodp_']);
           $sStyleHidden_tpmo_jmlodp_ = 'display: none;';
       }
       $bTestReadOnly_tpmo_jmlodp_ = true;
       $sStyleReadLab_tpmo_jmlodp_ = 'display: none;';
       $sStyleReadInp_tpmo_jmlodp_ = '';
       if (isset($this->nmgp_cmp_readonly['tpmo_jmlodp_']) && $this->nmgp_cmp_readonly['tpmo_jmlodp_'] == 'on')
       {
           $bTestReadOnly_tpmo_jmlodp_ = false;
           unset($this->nmgp_cmp_readonly['tpmo_jmlodp_']);
           $sStyleReadLab_tpmo_jmlodp_ = '';
           $sStyleReadInp_tpmo_jmlodp_ = 'display: none;';
       }
       $this->tpmo_akhir_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_akhir_']; 
       $tpmo_akhir_ = $this->tpmo_akhir_; 
       $sStyleHidden_tpmo_akhir_ = '';
       if (isset($sCheckRead_tpmo_akhir_))
       {
           unset($sCheckRead_tpmo_akhir_);
       }
       if (isset($this->nmgp_cmp_readonly['tpmo_akhir_']))
       {
           $sCheckRead_tpmo_akhir_ = $this->nmgp_cmp_readonly['tpmo_akhir_'];
       }
       if (isset($this->nmgp_cmp_hidden['tpmo_akhir_']) && $this->nmgp_cmp_hidden['tpmo_akhir_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tpmo_akhir_']);
           $sStyleHidden_tpmo_akhir_ = 'display: none;';
       }
       $bTestReadOnly_tpmo_akhir_ = true;
       $sStyleReadLab_tpmo_akhir_ = 'display: none;';
       $sStyleReadInp_tpmo_akhir_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["tpmo_akhir_"]) &&  $this->nmgp_cmp_readonly["tpmo_akhir_"] == "on"))
       {
           $bTestReadOnly_tpmo_akhir_ = false;
           unset($this->nmgp_cmp_readonly['tpmo_akhir_']);
           $sStyleReadLab_tpmo_akhir_ = '';
           $sStyleReadInp_tpmo_akhir_ = 'display: none;';
       }
       $this->tpmo_merk_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_merk_']; 
       $tpmo_merk_ = $this->tpmo_merk_; 
       $sStyleHidden_tpmo_merk_ = '';
       if (isset($sCheckRead_tpmo_merk_))
       {
           unset($sCheckRead_tpmo_merk_);
       }
       if (isset($this->nmgp_cmp_readonly['tpmo_merk_']))
       {
           $sCheckRead_tpmo_merk_ = $this->nmgp_cmp_readonly['tpmo_merk_'];
       }
       if (isset($this->nmgp_cmp_hidden['tpmo_merk_']) && $this->nmgp_cmp_hidden['tpmo_merk_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tpmo_merk_']);
           $sStyleHidden_tpmo_merk_ = 'display: none;';
       }
       $bTestReadOnly_tpmo_merk_ = true;
       $sStyleReadLab_tpmo_merk_ = 'display: none;';
       $sStyleReadInp_tpmo_merk_ = '';
       if (isset($this->nmgp_cmp_readonly['tpmo_merk_']) && $this->nmgp_cmp_readonly['tpmo_merk_'] == 'on')
       {
           $bTestReadOnly_tpmo_merk_ = false;
           unset($this->nmgp_cmp_readonly['tpmo_merk_']);
           $sStyleReadLab_tpmo_merk_ = '';
           $sStyleReadInp_tpmo_merk_ = 'display: none;';
       }
       $this->tpmo_kapport_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_kapport_']; 
       $tpmo_kapport_ = $this->tpmo_kapport_; 
       $sStyleHidden_tpmo_kapport_ = '';
       if (isset($sCheckRead_tpmo_kapport_))
       {
           unset($sCheckRead_tpmo_kapport_);
       }
       if (isset($this->nmgp_cmp_readonly['tpmo_kapport_']))
       {
           $sCheckRead_tpmo_kapport_ = $this->nmgp_cmp_readonly['tpmo_kapport_'];
       }
       if (isset($this->nmgp_cmp_hidden['tpmo_kapport_']) && $this->nmgp_cmp_hidden['tpmo_kapport_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tpmo_kapport_']);
           $sStyleHidden_tpmo_kapport_ = 'display: none;';
       }
       $bTestReadOnly_tpmo_kapport_ = true;
       $sStyleReadLab_tpmo_kapport_ = 'display: none;';
       $sStyleReadInp_tpmo_kapport_ = '';
       if (isset($this->nmgp_cmp_readonly['tpmo_kapport_']) && $this->nmgp_cmp_readonly['tpmo_kapport_'] == 'on')
       {
           $bTestReadOnly_tpmo_kapport_ = false;
           unset($this->nmgp_cmp_readonly['tpmo_kapport_']);
           $sStyleReadLab_tpmo_kapport_ = '';
           $sStyleReadInp_tpmo_kapport_ = 'display: none;';
       }
       $this->tpmo_nosp_ = $this->form_vert_form_master_odp[$sc_seq_vert]['tpmo_nosp_']; 
       $tpmo_nosp_ = $this->tpmo_nosp_; 
       $sStyleHidden_tpmo_nosp_ = '';
       if (isset($sCheckRead_tpmo_nosp_))
       {
           unset($sCheckRead_tpmo_nosp_);
       }
       if (isset($this->nmgp_cmp_readonly['tpmo_nosp_']))
       {
           $sCheckRead_tpmo_nosp_ = $this->nmgp_cmp_readonly['tpmo_nosp_'];
       }
       if (isset($this->nmgp_cmp_hidden['tpmo_nosp_']) && $this->nmgp_cmp_hidden['tpmo_nosp_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tpmo_nosp_']);
           $sStyleHidden_tpmo_nosp_ = 'display: none;';
       }
       $bTestReadOnly_tpmo_nosp_ = true;
       $sStyleReadLab_tpmo_nosp_ = 'display: none;';
       $sStyleReadInp_tpmo_nosp_ = '';
       if (isset($this->nmgp_cmp_readonly['tpmo_nosp_']) && $this->nmgp_cmp_readonly['tpmo_nosp_'] == 'on')
       {
           $bTestReadOnly_tpmo_nosp_ = false;
           unset($this->nmgp_cmp_readonly['tpmo_nosp_']);
           $sStyleReadLab_tpmo_nosp_ = '';
           $sStyleReadInp_tpmo_nosp_ = 'display: none;';
       }

       $nm_cor_fun_vert = ($nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?>>


   
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>" > <?php echo $sc_seq_vert; ?> </TD>
   
   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && ($this->nmgp_botoes['delete'] == "on" || $this->nmgp_botoes['update'] == "on")) {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\""; if (in_array($sc_seq_vert, $sc_check_excl)) { echo " checked";} ?> onclick="if (this.checked) {sc_quant_excl++; } else {sc_quant_excl--; }" class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php }?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao == "novo") {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\"" ; if (in_array($sc_seq_vert, $sc_check_incl) || !empty($this->nm_todas_criticas)) { echo " checked ";} ?> class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php }?>
   <?php if ($this->Embutida_form) {?>
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_actions<?php echo $sc_seq_vert; ?>" NOWRAP> <?php if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['delete'] == "off") {
        $sDisplayDelete = 'display: none';
    }
    else {
        $sDisplayDelete = '';
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayDelete. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php
if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['update'] == "off") {
        $sDisplayUpdate = 'display: none';
    }
    else {
        $sDisplayUpdate = '';
    }
    if ($this->Embutida_ronly) {
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayUpdate. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
        $sButDisp = 'display: none';
    }
    else
    {
        $sButDisp = $sDisplayUpdate;
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "" . $sButDisp. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
}
?>

<?php if ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_opcao == "novo") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_incluir", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "sc_ins_line_" . $sc_seq_vert . "", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php if ($this->nmgp_botoes['delete'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php if ($Line_Add && $this->Embutida_ronly) {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>

<?php if ($this->nmgp_botoes['update'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php }?>
<?php if ($this->nmgp_botoes['insert'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_master_odp_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_master_odp_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_master_odp_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_master_odp_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_master_odp_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_master_odp_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 </TD>
   <?php }?>
   <?php if (isset($this->nmgp_cmp_hidden['tpmo_id_']) && $this->nmgp_cmp_hidden['tpmo_id_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_id_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tpmo_id__line" id="hidden_field_data_tpmo_id_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tpmo_id_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tpmo_id__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tpmo_id_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["tpmo_id_"]) &&  $this->nmgp_cmp_readonly["tpmo_id_"] == "on")) { 

 ?>
<input type="hidden" name="tpmo_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_id_) . "\"><span id=\"id_ajax_label_tpmo_id_" . $sc_seq_vert . "\">" . $tpmo_id_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_id_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tpmo_id_<?php echo $sc_seq_vert ?> css_tpmo_id__line" style="<?php echo $sStyleReadLab_tpmo_id_; ?>"><?php echo $this->form_encode_input($this->tpmo_id_); ?></span><span id="id_read_off_tpmo_id_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_id_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tpmo_id__obj" style="" id="id_sc_field_tpmo_id_<?php echo $sc_seq_vert ?>" type=text name="tpmo_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_id_) ?>"
 size=22 maxlength=22 alt="{datatype: 'text', maxLength: 22, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_id_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_id_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_projectid_']) && $this->nmgp_cmp_hidden['tpmo_projectid_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_projectid_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_projectid_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tpmo_projectid__line" id="hidden_field_data_tpmo_projectid_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tpmo_projectid_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tpmo_projectid__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tpmo_projectid_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["tpmo_projectid_"]) &&  $this->nmgp_cmp_readonly["tpmo_projectid_"] == "on")) { 

 ?>
<input type="hidden" name="tpmo_projectid_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_projectid_) . "\"><span id=\"id_ajax_label_tpmo_projectid_" . $sc_seq_vert . "\">" . $tpmo_projectid_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_projectid_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tpmo_projectid_<?php echo $sc_seq_vert ?> css_tpmo_projectid__line" style="<?php echo $sStyleReadLab_tpmo_projectid_; ?>"><?php echo $this->form_encode_input($this->tpmo_projectid_); ?></span><span id="id_read_off_tpmo_projectid_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_projectid_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tpmo_projectid__obj" style="" id="id_sc_field_tpmo_projectid_<?php echo $sc_seq_vert ?>" type=text name="tpmo_projectid_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_projectid_) ?>"
 size=22 maxlength=22 alt="{datatype: 'text', maxLength: 22, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_projectid_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_projectid_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_namanode_']) && $this->nmgp_cmp_hidden['tpmo_namanode_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_namanode_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_namanode_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tpmo_namanode__line" id="hidden_field_data_tpmo_namanode_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tpmo_namanode_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tpmo_namanode__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tpmo_namanode_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_namanode_"]) &&  $this->nmgp_cmp_readonly["tpmo_namanode_"] == "on") { 

 ?>
<input type="hidden" name="tpmo_namanode_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_namanode_) . "\">" . $tpmo_namanode_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_namanode_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tpmo_namanode_<?php echo $sc_seq_vert ?> css_tpmo_namanode__line" style="<?php echo $sStyleReadLab_tpmo_namanode_; ?>"><?php echo $this->form_encode_input($this->tpmo_namanode_); ?></span><span id="id_read_off_tpmo_namanode_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_namanode_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tpmo_namanode__obj" style="" id="id_sc_field_tpmo_namanode_<?php echo $sc_seq_vert ?>" type=text name="tpmo_namanode_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_namanode_) ?>"
 size=15 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_namanode_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_namanode_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_awal_']) && $this->nmgp_cmp_hidden['tpmo_awal_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_awal_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_awal_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tpmo_awal__line" id="hidden_field_data_tpmo_awal_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tpmo_awal_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tpmo_awal__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tpmo_awal_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_awal_"]) &&  $this->nmgp_cmp_readonly["tpmo_awal_"] == "on") { 

 ?>
<input type="hidden" name="tpmo_awal_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_awal_) . "\">" . $tpmo_awal_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_awal_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tpmo_awal_<?php echo $sc_seq_vert ?> css_tpmo_awal__line" style="<?php echo $sStyleReadLab_tpmo_awal_; ?>"><?php echo $this->form_encode_input($this->tpmo_awal_); ?></span><span id="id_read_off_tpmo_awal_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_awal_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tpmo_awal__obj" style="" id="id_sc_field_tpmo_awal_<?php echo $sc_seq_vert ?>" type=text name="tpmo_awal_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_awal_) ?>"
 size=6 maxlength=6 alt="{datatype: 'text', maxLength: 6, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '999', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_awal_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_awal_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_jmlodp_']) && $this->nmgp_cmp_hidden['tpmo_jmlodp_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_jmlodp_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_jmlodp_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tpmo_jmlodp__line" id="hidden_field_data_tpmo_jmlodp_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tpmo_jmlodp_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tpmo_jmlodp__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tpmo_jmlodp_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_jmlodp_"]) &&  $this->nmgp_cmp_readonly["tpmo_jmlodp_"] == "on") { 

 ?>
<input type="hidden" name="tpmo_jmlodp_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_jmlodp_) . "\">" . $tpmo_jmlodp_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_jmlodp_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tpmo_jmlodp_<?php echo $sc_seq_vert ?> css_tpmo_jmlodp__line" style="<?php echo $sStyleReadLab_tpmo_jmlodp_; ?>"><?php echo $this->form_encode_input($this->tpmo_jmlodp_); ?></span><span id="id_read_off_tpmo_jmlodp_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_jmlodp_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tpmo_jmlodp__obj" style="" id="id_sc_field_tpmo_jmlodp_<?php echo $sc_seq_vert ?>" type=text name="tpmo_jmlodp_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_jmlodp_) ?>"
 size=8 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tpmo_jmlodp_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tpmo_jmlodp_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_jmlodp_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_jmlodp_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_akhir_']) && $this->nmgp_cmp_hidden['tpmo_akhir_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_akhir_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_akhir_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tpmo_akhir__line" id="hidden_field_data_tpmo_akhir_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tpmo_akhir_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tpmo_akhir__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tpmo_akhir_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["tpmo_akhir_"]) &&  $this->nmgp_cmp_readonly["tpmo_akhir_"] == "on")) { 

 ?>
<input type="hidden" name="tpmo_akhir_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_akhir_) . "\"><span id=\"id_ajax_label_tpmo_akhir_" . $sc_seq_vert . "\">" . $tpmo_akhir_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_akhir_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tpmo_akhir_<?php echo $sc_seq_vert ?> css_tpmo_akhir__line" style="<?php echo $sStyleReadLab_tpmo_akhir_; ?>"><?php echo $this->form_encode_input($this->tpmo_akhir_); ?></span><span id="id_read_off_tpmo_akhir_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_akhir_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tpmo_akhir__obj" style="" id="id_sc_field_tpmo_akhir_<?php echo $sc_seq_vert ?>" type=text name="tpmo_akhir_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_akhir_) ?>"
 size=6 maxlength=6 alt="{datatype: 'text', maxLength: 6, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_akhir_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_akhir_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_merk_']) && $this->nmgp_cmp_hidden['tpmo_merk_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_merk_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_merk_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tpmo_merk__line" id="hidden_field_data_tpmo_merk_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tpmo_merk_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tpmo_merk__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tpmo_merk_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_merk_"]) &&  $this->nmgp_cmp_readonly["tpmo_merk_"] == "on") { 

 ?>
<input type="hidden" name="tpmo_merk_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_merk_) . "\">" . $tpmo_merk_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_merk_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tpmo_merk_<?php echo $sc_seq_vert ?> css_tpmo_merk__line" style="<?php echo $sStyleReadLab_tpmo_merk_; ?>"><?php echo $this->form_encode_input($this->tpmo_merk_); ?></span><span id="id_read_off_tpmo_merk_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_merk_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tpmo_merk__obj" style="" id="id_sc_field_tpmo_merk_<?php echo $sc_seq_vert ?>" type=text name="tpmo_merk_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_merk_) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_merk_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_merk_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_kapport_']) && $this->nmgp_cmp_hidden['tpmo_kapport_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_kapport_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_kapport_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tpmo_kapport__line" id="hidden_field_data_tpmo_kapport_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tpmo_kapport_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tpmo_kapport__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tpmo_kapport_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_kapport_"]) &&  $this->nmgp_cmp_readonly["tpmo_kapport_"] == "on") { 

 ?>
<input type="hidden" name="tpmo_kapport_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_kapport_) . "\">" . $tpmo_kapport_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_kapport_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tpmo_kapport_<?php echo $sc_seq_vert ?> css_tpmo_kapport__line" style="<?php echo $sStyleReadLab_tpmo_kapport_; ?>"><?php echo $this->form_encode_input($this->tpmo_kapport_); ?></span><span id="id_read_off_tpmo_kapport_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_kapport_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tpmo_kapport__obj" style="" id="id_sc_field_tpmo_kapport_<?php echo $sc_seq_vert ?>" type=text name="tpmo_kapport_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_kapport_) ?>"
 size=8 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tpmo_kapport_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tpmo_kapport_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_kapport_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_kapport_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tpmo_nosp_']) && $this->nmgp_cmp_hidden['tpmo_nosp_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_nosp_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_nosp_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tpmo_nosp__line" id="hidden_field_data_tpmo_nosp_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tpmo_nosp_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tpmo_nosp__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tpmo_nosp_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_nosp_"]) &&  $this->nmgp_cmp_readonly["tpmo_nosp_"] == "on") { 

 ?>
<input type="hidden" name="tpmo_nosp_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_nosp_) . "\">" . $tpmo_nosp_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_nosp_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tpmo_nosp_<?php echo $sc_seq_vert ?> css_tpmo_nosp__line" style="<?php echo $sStyleReadLab_tpmo_nosp_; ?>"><?php echo $this->form_encode_input($this->tpmo_nosp_); ?></span><span id="id_read_off_tpmo_nosp_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_nosp_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tpmo_nosp__obj" style="" id="id_sc_field_tpmo_nosp_<?php echo $sc_seq_vert ?>" type=text name="tpmo_nosp_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tpmo_nosp_) ?>"
 size=30 maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_nosp_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_nosp_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_tpmo_id_))
       {
           $this->nmgp_cmp_readonly['tpmo_id_'] = $sCheckRead_tpmo_id_;
       }
       if ('display: none;' == $sStyleHidden_tpmo_id_)
       {
           $this->nmgp_cmp_hidden['tpmo_id_'] = 'off';
       }
       if (isset($sCheckRead_tpmo_projectid_))
       {
           $this->nmgp_cmp_readonly['tpmo_projectid_'] = $sCheckRead_tpmo_projectid_;
       }
       if ('display: none;' == $sStyleHidden_tpmo_projectid_)
       {
           $this->nmgp_cmp_hidden['tpmo_projectid_'] = 'off';
       }
       if (isset($sCheckRead_tpmo_namanode_))
       {
           $this->nmgp_cmp_readonly['tpmo_namanode_'] = $sCheckRead_tpmo_namanode_;
       }
       if ('display: none;' == $sStyleHidden_tpmo_namanode_)
       {
           $this->nmgp_cmp_hidden['tpmo_namanode_'] = 'off';
       }
       if (isset($sCheckRead_tpmo_awal_))
       {
           $this->nmgp_cmp_readonly['tpmo_awal_'] = $sCheckRead_tpmo_awal_;
       }
       if ('display: none;' == $sStyleHidden_tpmo_awal_)
       {
           $this->nmgp_cmp_hidden['tpmo_awal_'] = 'off';
       }
       if (isset($sCheckRead_tpmo_jmlodp_))
       {
           $this->nmgp_cmp_readonly['tpmo_jmlodp_'] = $sCheckRead_tpmo_jmlodp_;
       }
       if ('display: none;' == $sStyleHidden_tpmo_jmlodp_)
       {
           $this->nmgp_cmp_hidden['tpmo_jmlodp_'] = 'off';
       }
       if (isset($sCheckRead_tpmo_akhir_))
       {
           $this->nmgp_cmp_readonly['tpmo_akhir_'] = $sCheckRead_tpmo_akhir_;
       }
       if ('display: none;' == $sStyleHidden_tpmo_akhir_)
       {
           $this->nmgp_cmp_hidden['tpmo_akhir_'] = 'off';
       }
       if (isset($sCheckRead_tpmo_merk_))
       {
           $this->nmgp_cmp_readonly['tpmo_merk_'] = $sCheckRead_tpmo_merk_;
       }
       if ('display: none;' == $sStyleHidden_tpmo_merk_)
       {
           $this->nmgp_cmp_hidden['tpmo_merk_'] = 'off';
       }
       if (isset($sCheckRead_tpmo_kapport_))
       {
           $this->nmgp_cmp_readonly['tpmo_kapport_'] = $sCheckRead_tpmo_kapport_;
       }
       if ('display: none;' == $sStyleHidden_tpmo_kapport_)
       {
           $this->nmgp_cmp_hidden['tpmo_kapport_'] = 'off';
       }
       if (isset($sCheckRead_tpmo_nosp_))
       {
           $this->nmgp_cmp_readonly['tpmo_nosp_'] = $sCheckRead_tpmo_nosp_;
       }
       if ('display: none;' == $sStyleHidden_tpmo_nosp_)
       {
           $this->nmgp_cmp_hidden['tpmo_nosp_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_master_odp = $guarda_form_vert_form_master_odp;
   } 
   if ($Table_refresh) 
   { 
       $this->Table_refresh = ob_get_contents();
       ob_end_clean();
   } 
}

function Form_Fim() 
{
   global $sc_seq_vert, $opcao_botoes, $nm_url_saida; 
?>   
</TABLE></div><!-- bloco_f -->
 </div> 
<?php
$iContrVert = $this->Embutida_form ? $sc_seq_vert + 1 : $sc_seq_vert + 1;
if ($sc_seq_vert < $this->sc_max_reg)
{
    echo " <script type=\"text/javascript\">";
    echo "    bRefreshTable = true;";
    echo "</script>";
}
?>
<input type="hidden" name="sc_contr_vert" value="<?php echo $this->form_encode_input($iContrVert); ?>">
<?php
    $sEmptyStyle = 0 == $sc_seq_vert ? '' : 'display: none;';
?>
</td></tr>
<tr id="sc-ui-empty-form" style="<?php echo $sEmptyStyle; ?>"><td class="scFormPageText" style="padding: 10px; text-align: center; font-weight: bold">
<?php echo $this->Ini->Nm_lang['lang_errm_empt'];
?>
</td></tr>
<tr><td class="scFormPageText">
<span class="scFormRequiredOddColorMult">* <?php echo $this->Ini->Nm_lang['lang_othr_reqr']; ?></span>
</td></tr> 
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R")
{
    $NM_btn = false;
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "birpara", " nm_navpage(document.F1.nmgp_rec_b.value, 'P');document.F1.nmgp_rec_b.value = ''", " nm_navpage(document.F1.nmgp_rec_b.value, 'P');document.F1.nmgp_rec_b.value = ''", "brec_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['qtline'] == "on")
      {
?> 
          <span class="<?php echo $this->css_css_toolbar_obj ?>" style="border: 0px;"><?php echo $this->Ini->Nm_lang['lang_btns_rows'] ?></span>
          <select class="scFormToolbarInput" name="nmgp_quant_linhas_b" onchange="document.F7.nmgp_max_line.value = this.value; document.F7.submit();"> 
<?php 
              $obj_sel = ($this->sc_max_reg == '5') ? " selected" : "";
?> 
           <option value="5" <?php echo $obj_sel ?>>5</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '10') ? " selected" : "";
?> 
           <option value="10" <?php echo $obj_sel ?>>10</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '20') ? " selected" : "";
?> 
           <option value="20" <?php echo $obj_sel ?>>20</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '50') ? " selected" : "";
?> 
           <option value="50" <?php echo $obj_sel ?>>50</option>
          </select>
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "binicio", "nm_move ('inicio');", "nm_move ('inicio');", "sc_b_ini_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "binicio_off", "nm_move ('inicio');", "nm_move ('inicio');", "sc_b_ini_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bretorna", "nm_move ('retorna');", "nm_move ('retorna');", "sc_b_ret_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bretorna_off", "nm_move ('retorna');", "nm_move ('retorna');", "sc_b_ret_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['navpage'] == "on")
{
?> 
     <span nowrap id="sc_b_navpage_b" class="scFormToolbarPadding"></span> 
<?php 
}
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bavanca", "nm_move ('avanca');", "nm_move ('avanca');", "sc_b_avc_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bavanca_off", "nm_move ('avanca');", "nm_move ('avanca');", "sc_b_avc_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bfinal", "nm_move ('final');", "nm_move ('final');", "sc_b_fim_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bfinal_off", "nm_move ('final');", "nm_move ('final');", "sc_b_fim_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
if ($opcao_botoes != "novo" && $this->nmgp_botoes['summary'] == "on")
{
?> 
     <span nowrap id="sc_b_summary_b" class="scFormToolbarPadding"></span> 
<?php 
}
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none; position: absolute; left: 50px; top: 50px"><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>
<script>
 var iAjaxNewLine = <?php echo $sc_seq_vert; ?>;
<?php
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['run_modal'])
{
?>
 for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) {
  scJQElementsAdd(iLine);
 }
<?php
}
else
{
?>
 $(function() {
  setTimeout(function() { for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) { scJQElementsAdd(iLine); } }, 250);
 });
<?php
}
?>
</script>
<div id="new_line_dummy" style="display: none">
</div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
   </td></tr></table>
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['masterValue']);
?>
}
<?php
    }
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_master_odp");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_master_odp");
 parent.scAjaxDetailHeight("form_master_odp", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_master_odp", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_master_odp", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
    }
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
?>
<script type="text/javascript">
_scAjaxShowMessage(scMsgDefTitle, "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", false, sc_ajaxMsgTime, false, "Ok", 0, 0, 0, 0, "", "", "", false, true);
</script>
<?php
}
?>
<?php
if ('' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_master_odp']['sc_modal'])
{
?>
  parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
elseif ($this->lig_edit_lookup)
{
?>
  opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
?>
}
if (bLigEditLookupCall)
{
  scLigEditLookupCall();
}
<?php
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
</body> 
</html> 
<?php 
 } 
} 
?> 
