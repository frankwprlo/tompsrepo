<?php
class mastertemplate_form extends mastertemplate_apl
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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - AKSESSMR.TB_MASTER_TEMPLATE"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - AKSESSMR.TB_MASTER_TEMPLATE"); } ?></TITLE>
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
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['sc_redir_atualiz'] == 'ok')
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>mastertemplate/mastertemplate_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("mastertemplate_sajax_js.php");
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
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}
<?php

include_once('mastertemplate_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['recarga'];
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
 include_once("mastertemplate_js0.php");
?>
<script type="text/javascript"> 
nmdg_enter_tab = true;
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
$_SESSION['scriptcase']['error_span_title']['mastertemplate'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['mastertemplate'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R")
{
    $NM_btn = false;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($this->Embutida_form) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "do_ajax_mastertemplate_add_new_line(); return false;", "do_ajax_mastertemplate_add_new_line(); return false;", "sc_b_new_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
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
       <?php echo nmButtonOutput($this->arr_buttons, "balterar", "nm_atualiza ('alterar');", "nm_atualiza ('alterar');", "sc_b_upd_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['empty_filter'] = true;
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


       if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") { $Col_span = " colspan=2"; }
    if (!$this->Embutida_form && $this->nmgp_opcao == "novo") { $Col_span = " colspan=2"; }
 ?>

    <TD class="scFormLabelOddMult" style="display: none;" <?php echo $Col_span ?>> &nbsp; </TD>
   
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] == "on") {?>
    <TD class="scFormLabelOddMult"  width="10">  </TD>
   <?php }?>
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] != "on") {?>
    <TD class="scFormLabelOddMult"  width="10"> &nbsp; </TD>
   <?php }?>
   <?php if ((!isset($this->nmgp_cmp_hidden['idtemplate_']) || $this->nmgp_cmp_hidden['idtemplate_'] == 'on') && ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir"))) { 
      if (!isset($this->nm_new_label['idtemplate_'])) {
          $this->nm_new_label['idtemplate_'] = "IDTemplate"; } ?>

    <TD class="scFormLabelOddMult css_idtemplate__label" id="hidden_field_label_idtemplate_" style="<?php echo $sStyleHidden_idtemplate_; ?>" > <?php echo $this->nm_new_label['idtemplate_'] ?> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['templatename_']) && $this->nmgp_cmp_hidden['templatename_'] == 'off') { $sStyleHidden_templatename_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['templatename_']) || $this->nmgp_cmp_hidden['templatename_'] == 'on') {
      if (!isset($this->nm_new_label['templatename_'])) {
          $this->nm_new_label['templatename_'] = "Nama Template"; } ?>

    <TD class="scFormLabelOddMult css_templatename__label" id="hidden_field_label_templatename_" style="<?php echo $sStyleHidden_templatename_; ?>" > <?php echo $this->nm_new_label['templatename_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['deskripsi_']) && $this->nmgp_cmp_hidden['deskripsi_'] == 'off') { $sStyleHidden_deskripsi_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['deskripsi_']) || $this->nmgp_cmp_hidden['deskripsi_'] == 'on') {
      if (!isset($this->nm_new_label['deskripsi_'])) {
          $this->nm_new_label['deskripsi_'] = "Deskripsi"; } ?>

    <TD class="scFormLabelOddMult css_deskripsi__label" id="hidden_field_label_deskripsi_" style="<?php echo $sStyleHidden_deskripsi_; ?>" > <?php echo $this->nm_new_label['deskripsi_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['targetwaktu_']) && $this->nmgp_cmp_hidden['targetwaktu_'] == 'off') { $sStyleHidden_targetwaktu_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['targetwaktu_']) || $this->nmgp_cmp_hidden['targetwaktu_'] == 'on') {
      if (!isset($this->nm_new_label['targetwaktu_'])) {
          $this->nm_new_label['targetwaktu_'] = "Target(hari)"; } ?>

    <TD class="scFormLabelOddMult css_targetwaktu__label" id="hidden_field_label_targetwaktu_" style="<?php echo $sStyleHidden_targetwaktu_; ?>" > <?php echo $this->nm_new_label['targetwaktu_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['idwitel_']) && $this->nmgp_cmp_hidden['idwitel_'] == 'off') { $sStyleHidden_idwitel_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['idwitel_']) || $this->nmgp_cmp_hidden['idwitel_'] == 'on') {
      if (!isset($this->nm_new_label['idwitel_'])) {
          $this->nm_new_label['idwitel_'] = "IDWITEL"; } ?>

    <TD class="scFormLabelOddMult css_idwitel__label" id="hidden_field_label_idwitel_" style="<?php echo $sStyleHidden_idwitel_; ?>" > <?php echo $this->nm_new_label['idwitel_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['iddivre_']) && $this->nmgp_cmp_hidden['iddivre_'] == 'off') { $sStyleHidden_iddivre_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['iddivre_']) || $this->nmgp_cmp_hidden['iddivre_'] == 'on') {
      if (!isset($this->nm_new_label['iddivre_'])) {
          $this->nm_new_label['iddivre_'] = "IDDIVRE"; } ?>

    <TD class="scFormLabelOddMult css_iddivre__label" id="hidden_field_label_iddivre_" style="<?php echo $sStyleHidden_iddivre_; ?>" > <?php echo $this->nm_new_label['iddivre_'] ?> </TD>
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
       $iStart = sizeof($this->form_vert_mastertemplate);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_mastertemplate = $this->form_vert_mastertemplate;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_mastertemplate))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['idtemplate_']))
           {
               $this->nmgp_cmp_readonly['idtemplate_'] = 'on';
           }
   foreach ($this->form_vert_mastertemplate as $sc_seq_vert => $sc_lixo)
   {
       $this->loadRecordState($sc_seq_vert);
       $this->entrydate_ = $this->form_vert_mastertemplate[$sc_seq_vert]['entrydate_'];
       $this->entryby_ = $this->form_vert_mastertemplate[$sc_seq_vert]['entryby_'];
       $this->updatedate_ = $this->form_vert_mastertemplate[$sc_seq_vert]['updatedate_'];
       $this->udateby_ = $this->form_vert_mastertemplate[$sc_seq_vert]['udateby_'];
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['idtemplate_'] = true;
           $this->nmgp_cmp_readonly['templatename_'] = true;
           $this->nmgp_cmp_readonly['deskripsi_'] = true;
           $this->nmgp_cmp_readonly['targetwaktu_'] = true;
           $this->nmgp_cmp_readonly['idwitel_'] = true;
           $this->nmgp_cmp_readonly['iddivre_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['idtemplate_']) || $this->nmgp_cmp_readonly['idtemplate_'] != "on") {$this->nmgp_cmp_readonly['idtemplate_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['templatename_']) || $this->nmgp_cmp_readonly['templatename_'] != "on") {$this->nmgp_cmp_readonly['templatename_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['deskripsi_']) || $this->nmgp_cmp_readonly['deskripsi_'] != "on") {$this->nmgp_cmp_readonly['deskripsi_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['targetwaktu_']) || $this->nmgp_cmp_readonly['targetwaktu_'] != "on") {$this->nmgp_cmp_readonly['targetwaktu_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['idwitel_']) || $this->nmgp_cmp_readonly['idwitel_'] != "on") {$this->nmgp_cmp_readonly['idwitel_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['iddivre_']) || $this->nmgp_cmp_readonly['iddivre_'] != "on") {$this->nmgp_cmp_readonly['iddivre_'] = false;}
       }
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
        $this->idtemplate_ = $this->form_vert_mastertemplate[$sc_seq_vert]['idtemplate_']; 
       $idtemplate_ = $this->idtemplate_; 
       $sStyleHidden_idtemplate_ = '';
       if (isset($sCheckRead_idtemplate_))
       {
           unset($sCheckRead_idtemplate_);
       }
       if (isset($this->nmgp_cmp_readonly['idtemplate_']))
       {
           $sCheckRead_idtemplate_ = $this->nmgp_cmp_readonly['idtemplate_'];
       }
       if (isset($this->nmgp_cmp_hidden['idtemplate_']) && $this->nmgp_cmp_hidden['idtemplate_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['idtemplate_']);
           $sStyleHidden_idtemplate_ = 'display: none;';
       }
       $bTestReadOnly_idtemplate_ = true;
       $sStyleReadLab_idtemplate_ = 'display: none;';
       $sStyleReadInp_idtemplate_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["idtemplate_"]) &&  $this->nmgp_cmp_readonly["idtemplate_"] == "on"))
       {
           $bTestReadOnly_idtemplate_ = false;
           unset($this->nmgp_cmp_readonly['idtemplate_']);
           $sStyleReadLab_idtemplate_ = '';
           $sStyleReadInp_idtemplate_ = 'display: none;';
       }
       $this->templatename_ = $this->form_vert_mastertemplate[$sc_seq_vert]['templatename_']; 
       $templatename_ = $this->templatename_; 
       $sStyleHidden_templatename_ = '';
       if (isset($sCheckRead_templatename_))
       {
           unset($sCheckRead_templatename_);
       }
       if (isset($this->nmgp_cmp_readonly['templatename_']))
       {
           $sCheckRead_templatename_ = $this->nmgp_cmp_readonly['templatename_'];
       }
       if (isset($this->nmgp_cmp_hidden['templatename_']) && $this->nmgp_cmp_hidden['templatename_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['templatename_']);
           $sStyleHidden_templatename_ = 'display: none;';
       }
       $bTestReadOnly_templatename_ = true;
       $sStyleReadLab_templatename_ = 'display: none;';
       $sStyleReadInp_templatename_ = '';
       if (isset($this->nmgp_cmp_readonly['templatename_']) && $this->nmgp_cmp_readonly['templatename_'] == 'on')
       {
           $bTestReadOnly_templatename_ = false;
           unset($this->nmgp_cmp_readonly['templatename_']);
           $sStyleReadLab_templatename_ = '';
           $sStyleReadInp_templatename_ = 'display: none;';
       }
       $this->deskripsi_ = $this->form_vert_mastertemplate[$sc_seq_vert]['deskripsi_']; 
       $deskripsi_ = $this->deskripsi_; 
       $deskripsi__tmp = str_replace(array('\r\n', '\n\r', '\n', '\r'), array("\r\n", "\n\r", "\n", "\r"), $deskripsi_);
       $deskripsi__val = nl2br($deskripsi__tmp);
       $sStyleHidden_deskripsi_ = '';
       if (isset($sCheckRead_deskripsi_))
       {
           unset($sCheckRead_deskripsi_);
       }
       if (isset($this->nmgp_cmp_readonly['deskripsi_']))
       {
           $sCheckRead_deskripsi_ = $this->nmgp_cmp_readonly['deskripsi_'];
       }
       if (isset($this->nmgp_cmp_hidden['deskripsi_']) && $this->nmgp_cmp_hidden['deskripsi_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['deskripsi_']);
           $sStyleHidden_deskripsi_ = 'display: none;';
       }
       $bTestReadOnly_deskripsi_ = true;
       $sStyleReadLab_deskripsi_ = 'display: none;';
       $sStyleReadInp_deskripsi_ = '';
       if (isset($this->nmgp_cmp_readonly['deskripsi_']) && $this->nmgp_cmp_readonly['deskripsi_'] == 'on')
       {
           $bTestReadOnly_deskripsi_ = false;
           unset($this->nmgp_cmp_readonly['deskripsi_']);
           $sStyleReadLab_deskripsi_ = '';
           $sStyleReadInp_deskripsi_ = 'display: none;';
       }
       $this->targetwaktu_ = $this->form_vert_mastertemplate[$sc_seq_vert]['targetwaktu_']; 
       $targetwaktu_ = $this->targetwaktu_; 
       $sStyleHidden_targetwaktu_ = '';
       if (isset($sCheckRead_targetwaktu_))
       {
           unset($sCheckRead_targetwaktu_);
       }
       if (isset($this->nmgp_cmp_readonly['targetwaktu_']))
       {
           $sCheckRead_targetwaktu_ = $this->nmgp_cmp_readonly['targetwaktu_'];
       }
       if (isset($this->nmgp_cmp_hidden['targetwaktu_']) && $this->nmgp_cmp_hidden['targetwaktu_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['targetwaktu_']);
           $sStyleHidden_targetwaktu_ = 'display: none;';
       }
       $bTestReadOnly_targetwaktu_ = true;
       $sStyleReadLab_targetwaktu_ = 'display: none;';
       $sStyleReadInp_targetwaktu_ = '';
       if (isset($this->nmgp_cmp_readonly['targetwaktu_']) && $this->nmgp_cmp_readonly['targetwaktu_'] == 'on')
       {
           $bTestReadOnly_targetwaktu_ = false;
           unset($this->nmgp_cmp_readonly['targetwaktu_']);
           $sStyleReadLab_targetwaktu_ = '';
           $sStyleReadInp_targetwaktu_ = 'display: none;';
       }
       $this->idwitel_ = $this->form_vert_mastertemplate[$sc_seq_vert]['idwitel_']; 
       $idwitel_ = $this->idwitel_; 
       $sStyleHidden_idwitel_ = '';
       if (isset($sCheckRead_idwitel_))
       {
           unset($sCheckRead_idwitel_);
       }
       if (isset($this->nmgp_cmp_readonly['idwitel_']))
       {
           $sCheckRead_idwitel_ = $this->nmgp_cmp_readonly['idwitel_'];
       }
       if (isset($this->nmgp_cmp_hidden['idwitel_']) && $this->nmgp_cmp_hidden['idwitel_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['idwitel_']);
           $sStyleHidden_idwitel_ = 'display: none;';
       }
       $bTestReadOnly_idwitel_ = true;
       $sStyleReadLab_idwitel_ = 'display: none;';
       $sStyleReadInp_idwitel_ = '';
       if (isset($this->nmgp_cmp_readonly['idwitel_']) && $this->nmgp_cmp_readonly['idwitel_'] == 'on')
       {
           $bTestReadOnly_idwitel_ = false;
           unset($this->nmgp_cmp_readonly['idwitel_']);
           $sStyleReadLab_idwitel_ = '';
           $sStyleReadInp_idwitel_ = 'display: none;';
       }
       $this->iddivre_ = $this->form_vert_mastertemplate[$sc_seq_vert]['iddivre_']; 
       $iddivre_ = $this->iddivre_; 
       $sStyleHidden_iddivre_ = '';
       if (isset($sCheckRead_iddivre_))
       {
           unset($sCheckRead_iddivre_);
       }
       if (isset($this->nmgp_cmp_readonly['iddivre_']))
       {
           $sCheckRead_iddivre_ = $this->nmgp_cmp_readonly['iddivre_'];
       }
       if (isset($this->nmgp_cmp_hidden['iddivre_']) && $this->nmgp_cmp_hidden['iddivre_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['iddivre_']);
           $sStyleHidden_iddivre_ = 'display: none;';
       }
       $bTestReadOnly_iddivre_ = true;
       $sStyleReadLab_iddivre_ = 'display: none;';
       $sStyleReadInp_iddivre_ = '';
       if (isset($this->nmgp_cmp_readonly['iddivre_']) && $this->nmgp_cmp_readonly['iddivre_'] == 'on')
       {
           $bTestReadOnly_iddivre_ = false;
           unset($this->nmgp_cmp_readonly['iddivre_']);
           $sStyleReadLab_iddivre_ = '';
           $sStyleReadInp_iddivre_ = 'display: none;';
       }

       $nm_cor_fun_vert = ($nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?>>


   
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>"  style="display: none;"> <?php echo $sc_seq_vert; ?> </TD>
   
   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\""; if (in_array($sc_seq_vert, $sc_check_excl)) { echo " checked";} ?> onclick="if (this.checked) {sc_quant_excl++; } else {sc_quant_excl--; }" class="sc-js-input" alt="{type: 'checkbox', enterTab: true}"> </TD>
   <?php }?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao == "novo") {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\"" ; if (in_array($sc_seq_vert, $sc_check_incl) || !empty($this->nm_todas_criticas)) { echo " checked ";} ?> class="sc-js-input" alt="{type: 'checkbox', enterTab: true}"> </TD>
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
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_mastertemplate_add_new_line(" . $sc_seq_vert . ")", "do_ajax_mastertemplate_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_mastertemplate_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_mastertemplate_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_mastertemplate_cancel_update(" . $sc_seq_vert . ")", "do_ajax_mastertemplate_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 </TD>
   <?php }?>
   <?php if (isset($this->nmgp_cmp_hidden['idtemplate_']) && $this->nmgp_cmp_hidden['idtemplate_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="idtemplate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($idtemplate_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOddMult css_idtemplate__line" id="hidden_field_data_idtemplate_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_idtemplate_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_idtemplate__line" style="vertical-align: top;padding: 0px"><span id="id_read_on_idtemplate_<?php echo $sc_seq_vert ?>" class="css_idtemplate__line" style="<?php echo $sStyleReadLab_idtemplate_; ?>"><?php echo $this->form_encode_input($this->idtemplate_); ?></span><span id="id_read_off_idtemplate_<?php echo $sc_seq_vert ?>" style="<?php echo $sStyleReadInp_idtemplate_; ?>"><input type="hidden" id="id_sc_field_idtemplate_<?php echo $sc_seq_vert ?>" name="idtemplate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($idtemplate_) . "\">"?>
<span id="id_ajax_label_idtemplate_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($idtemplate_); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_idtemplate_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_idtemplate_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['templatename_']) && $this->nmgp_cmp_hidden['templatename_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="templatename_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($templatename_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_templatename__line" id="hidden_field_data_templatename_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_templatename_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_templatename__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_templatename_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["templatename_"]) &&  $this->nmgp_cmp_readonly["templatename_"] == "on") { 

 ?>
<input type="hidden" name="templatename_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($templatename_) . "\">" . $templatename_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_templatename_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-templatename_<?php echo $sc_seq_vert ?> css_templatename__line" style="<?php echo $sStyleReadLab_templatename_; ?>"><?php echo $this->form_encode_input($this->templatename_); ?></span><span id="id_read_off_templatename_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_templatename_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_templatename__obj" style="" id="id_sc_field_templatename_<?php echo $sc_seq_vert ?>" type=text name="templatename_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($templatename_) ?>"
 size=50 maxlength=200 alt="{datatype: 'text', maxLength: 200, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_templatename_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_templatename_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['deskripsi_']) && $this->nmgp_cmp_hidden['deskripsi_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="deskripsi_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($deskripsi_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_deskripsi__line" id="hidden_field_data_deskripsi_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_deskripsi_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_deskripsi__line" style="vertical-align: top;padding: 0px">
<?php
$deskripsi__val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($deskripsi_));

?>

<?php if ($bTestReadOnly_deskripsi_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["deskripsi_"]) &&  $this->nmgp_cmp_readonly["deskripsi_"] == "on") { 

 ?>
<input type="hidden" name="deskripsi_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($deskripsi_) . "\">" . $deskripsi__val . ""; ?>
<?php } else { ?>
<span id="id_read_on_deskripsi_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-deskripsi_<?php echo $sc_seq_vert ?> css_deskripsi__line" style="<?php echo $sStyleReadLab_deskripsi_; ?>"><?php echo $this->form_encode_input($deskripsi__val); ?></span><span id="id_read_off_deskripsi_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_deskripsi_; ?>">
 <textarea  class="sc-js-input scFormObjectOddMult css_deskripsi__obj" style="white-space: pre-wrap;" name="deskripsi_<?php echo $sc_seq_vert ?>" id="id_sc_field_deskripsi_<?php echo $sc_seq_vert ?>" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $deskripsi_; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_deskripsi_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_deskripsi_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['targetwaktu_']) && $this->nmgp_cmp_hidden['targetwaktu_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="targetwaktu_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($targetwaktu_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_targetwaktu__line" id="hidden_field_data_targetwaktu_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_targetwaktu_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_targetwaktu__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_targetwaktu_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["targetwaktu_"]) &&  $this->nmgp_cmp_readonly["targetwaktu_"] == "on") { 

 ?>
<input type="hidden" name="targetwaktu_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($targetwaktu_) . "\">" . $targetwaktu_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_targetwaktu_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-targetwaktu_<?php echo $sc_seq_vert ?> css_targetwaktu__line" style="<?php echo $sStyleReadLab_targetwaktu_; ?>"><?php echo $this->form_encode_input($this->targetwaktu_); ?></span><span id="id_read_off_targetwaktu_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_targetwaktu_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_targetwaktu__obj" style="" id="id_sc_field_targetwaktu_<?php echo $sc_seq_vert ?>" type=text name="targetwaktu_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($targetwaktu_) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['targetwaktu_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['targetwaktu_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_targetwaktu_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_targetwaktu_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['idwitel_']) && $this->nmgp_cmp_hidden['idwitel_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="idwitel_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($idwitel_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_idwitel__line" id="hidden_field_data_idwitel_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_idwitel_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_idwitel__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_idwitel_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["idwitel_"]) &&  $this->nmgp_cmp_readonly["idwitel_"] == "on") { 

 ?>
<input type="hidden" name="idwitel_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($idwitel_) . "\">" . $idwitel_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_idwitel_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-idwitel_<?php echo $sc_seq_vert ?> css_idwitel__line" style="<?php echo $sStyleReadLab_idwitel_; ?>"><?php echo $this->form_encode_input($this->idwitel_); ?></span><span id="id_read_off_idwitel_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_idwitel_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_idwitel__obj" style="" id="id_sc_field_idwitel_<?php echo $sc_seq_vert ?>" type=text name="idwitel_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($idwitel_) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['idwitel_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['idwitel_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_idwitel_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_idwitel_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['iddivre_']) && $this->nmgp_cmp_hidden['iddivre_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="iddivre_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($iddivre_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_iddivre__line" id="hidden_field_data_iddivre_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_iddivre_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_iddivre__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_iddivre_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["iddivre_"]) &&  $this->nmgp_cmp_readonly["iddivre_"] == "on") { 

 ?>
<input type="hidden" name="iddivre_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($iddivre_) . "\">" . $iddivre_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_iddivre_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-iddivre_<?php echo $sc_seq_vert ?> css_iddivre__line" style="<?php echo $sStyleReadLab_iddivre_; ?>"><?php echo $this->form_encode_input($this->iddivre_); ?></span><span id="id_read_off_iddivre_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_iddivre_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_iddivre__obj" style="" id="id_sc_field_iddivre_<?php echo $sc_seq_vert ?>" type=text name="iddivre_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($iddivre_) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['iddivre_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['iddivre_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_iddivre_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_iddivre_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_idtemplate_))
       {
           $this->nmgp_cmp_readonly['idtemplate_'] = $sCheckRead_idtemplate_;
       }
       if ('display: none;' == $sStyleHidden_idtemplate_)
       {
           $this->nmgp_cmp_hidden['idtemplate_'] = 'off';
       }
       if (isset($sCheckRead_templatename_))
       {
           $this->nmgp_cmp_readonly['templatename_'] = $sCheckRead_templatename_;
       }
       if ('display: none;' == $sStyleHidden_templatename_)
       {
           $this->nmgp_cmp_hidden['templatename_'] = 'off';
       }
       if (isset($sCheckRead_deskripsi_))
       {
           $this->nmgp_cmp_readonly['deskripsi_'] = $sCheckRead_deskripsi_;
       }
       if ('display: none;' == $sStyleHidden_deskripsi_)
       {
           $this->nmgp_cmp_hidden['deskripsi_'] = 'off';
       }
       if (isset($sCheckRead_targetwaktu_))
       {
           $this->nmgp_cmp_readonly['targetwaktu_'] = $sCheckRead_targetwaktu_;
       }
       if ('display: none;' == $sStyleHidden_targetwaktu_)
       {
           $this->nmgp_cmp_hidden['targetwaktu_'] = 'off';
       }
       if (isset($sCheckRead_idwitel_))
       {
           $this->nmgp_cmp_readonly['idwitel_'] = $sCheckRead_idwitel_;
       }
       if ('display: none;' == $sStyleHidden_idwitel_)
       {
           $this->nmgp_cmp_hidden['idwitel_'] = 'off';
       }
       if (isset($sCheckRead_iddivre_))
       {
           $this->nmgp_cmp_readonly['iddivre_'] = $sCheckRead_iddivre_;
       }
       if ('display: none;' == $sStyleHidden_iddivre_)
       {
           $this->nmgp_cmp_hidden['iddivre_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_mastertemplate = $guarda_form_vert_mastertemplate;
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R")
{
    $NM_btn = false;
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
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['run_modal'])
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("mastertemplate");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("mastertemplate");
 parent.scAjaxDetailHeight("mastertemplate", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("mastertemplate", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("mastertemplate", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['mastertemplate']['sc_modal'])
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
