<?php
class form_tahapanproject_detail_form extends form_tahapanproject_detail_apl
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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - AKSESSMR.TB_MASTERTAHAPAN_TASK"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - AKSESSMR.TB_MASTERTAHAPAN_TASK"); } ?></TITLE>
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
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['sc_redir_atualiz'] == 'ok')
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>mastertahapan/form_tahapanproject_detail_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("form_tahapanproject_detail_sajax_js.php");
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
<?php

include_once('form_tahapanproject_detail_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['recarga'];
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
 include_once("form_tahapanproject_detail_js0.php");
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
$_SESSION['scriptcase']['error_span_title']['form_tahapanproject_detail'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_tahapanproject_detail'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "R")
{
    $NM_btn = false;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($this->Embutida_form) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "do_ajax_form_tahapanproject_detail_add_new_line(); return false;", "do_ajax_form_tahapanproject_detail_add_new_line(); return false;", "sc_b_new_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
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
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['empty_filter'] = true;
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
   <?php if ((!isset($this->nmgp_cmp_hidden['tmt_id_']) || $this->nmgp_cmp_hidden['tmt_id_'] == 'on') && ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir"))) { 
      if (!isset($this->nm_new_label['tmt_id_'])) {
          $this->nm_new_label['tmt_id_'] = "ID"; } ?>

    <TD class="scFormLabelOddMult css_tmt_id__label" id="hidden_field_label_tmt_id_" style="<?php echo $sStyleHidden_tmt_id_; ?>" > <?php echo $this->nm_new_label['tmt_id_'] ?> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_tasktamplate_']) && $this->nmgp_cmp_hidden['tmt_tasktamplate_'] == 'off') { $sStyleHidden_tmt_tasktamplate_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tmt_tasktamplate_']) || $this->nmgp_cmp_hidden['tmt_tasktamplate_'] == 'on') {
      if (!isset($this->nm_new_label['tmt_tasktamplate_'])) {
          $this->nm_new_label['tmt_tasktamplate_'] = "Nama Template"; } ?>

    <TD class="scFormLabelOddMult css_tmt_tasktamplate__label" id="hidden_field_label_tmt_tasktamplate_" style="<?php echo $sStyleHidden_tmt_tasktamplate_; ?>" > <?php echo $this->nm_new_label['tmt_tasktamplate_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_tahapanproject_']) && $this->nmgp_cmp_hidden['tmt_tahapanproject_'] == 'off') { $sStyleHidden_tmt_tahapanproject_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tmt_tahapanproject_']) || $this->nmgp_cmp_hidden['tmt_tahapanproject_'] == 'on') {
      if (!isset($this->nm_new_label['tmt_tahapanproject_'])) {
          $this->nm_new_label['tmt_tahapanproject_'] = "Tahapan Project"; } ?>

    <TD class="scFormLabelOddMult css_tmt_tahapanproject__label" id="hidden_field_label_tmt_tahapanproject_" style="<?php echo $sStyleHidden_tmt_tahapanproject_; ?>" > <?php echo $this->nm_new_label['tmt_tahapanproject_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_tasktahapan_']) && $this->nmgp_cmp_hidden['tmt_tasktahapan_'] == 'off') { $sStyleHidden_tmt_tasktahapan_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tmt_tasktahapan_']) || $this->nmgp_cmp_hidden['tmt_tasktahapan_'] == 'on') {
      if (!isset($this->nm_new_label['tmt_tasktahapan_'])) {
          $this->nm_new_label['tmt_tasktahapan_'] = "Nama Tahapan"; } ?>

    <TD class="scFormLabelOddMult css_tmt_tasktahapan__label" id="hidden_field_label_tmt_tasktahapan_" style="<?php echo $sStyleHidden_tmt_tasktahapan_; ?>" > <?php echo $this->nm_new_label['tmt_tasktahapan_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_tasknumber_']) && $this->nmgp_cmp_hidden['tmt_tasknumber_'] == 'off') { $sStyleHidden_tmt_tasknumber_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tmt_tasknumber_']) || $this->nmgp_cmp_hidden['tmt_tasknumber_'] == 'on') {
      if (!isset($this->nm_new_label['tmt_tasknumber_'])) {
          $this->nm_new_label['tmt_tasknumber_'] = "Nomor Tahapan"; } ?>

    <TD class="scFormLabelOddMult css_tmt_tasknumber__label" id="hidden_field_label_tmt_tasknumber_" style="<?php echo $sStyleHidden_tmt_tasknumber_; ?>" > <?php echo $this->nm_new_label['tmt_tasknumber_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_target90_']) && $this->nmgp_cmp_hidden['tmt_target90_'] == 'off') { $sStyleHidden_tmt_target90_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tmt_target90_']) || $this->nmgp_cmp_hidden['tmt_target90_'] == 'on') {
      if (!isset($this->nm_new_label['tmt_target90_'])) {
          $this->nm_new_label['tmt_target90_'] = "Target Waktu(hari)"; } ?>

    <TD class="scFormLabelOddMult css_tmt_target90__label" id="hidden_field_label_tmt_target90_" style="<?php echo $sStyleHidden_tmt_target90_; ?>" > <?php echo $this->nm_new_label['tmt_target90_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_target62_']) && $this->nmgp_cmp_hidden['tmt_target62_'] == 'off') { $sStyleHidden_tmt_target62_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['tmt_target62_']) || $this->nmgp_cmp_hidden['tmt_target62_'] == 'on') {
      if (!isset($this->nm_new_label['tmt_target62_'])) {
          $this->nm_new_label['tmt_target62_'] = "Milestone"; } ?>

    <TD class="scFormLabelOddMult css_tmt_target62__label" id="hidden_field_label_tmt_target62_" style="<?php echo $sStyleHidden_tmt_target62_; ?>" > <?php echo $this->nm_new_label['tmt_target62_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
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
       $iStart = sizeof($this->form_vert_form_tahapanproject_detail);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_tahapanproject_detail = $this->form_vert_form_tahapanproject_detail;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_tahapanproject_detail))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['tmt_id_']))
           {
               $this->nmgp_cmp_readonly['tmt_id_'] = 'on';
           }
   foreach ($this->form_vert_form_tahapanproject_detail as $sc_seq_vert => $sc_lixo)
   {
       $this->loadRecordState($sc_seq_vert);
       $this->tmt_entrydate_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_entrydate_'];
       $this->tmt_entryby_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_entryby_'];
       $this->tmt_updatedate_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_updatedate_'];
       $this->tmt_updateby_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_updateby_'];
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['tmt_id_'] = true;
           $this->nmgp_cmp_readonly['tmt_tasktamplate_'] = true;
           $this->nmgp_cmp_readonly['tmt_tahapanproject_'] = true;
           $this->nmgp_cmp_readonly['tmt_tasktahapan_'] = true;
           $this->nmgp_cmp_readonly['tmt_tasknumber_'] = true;
           $this->nmgp_cmp_readonly['tmt_target90_'] = true;
           $this->nmgp_cmp_readonly['tmt_target62_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['tmt_id_']) || $this->nmgp_cmp_readonly['tmt_id_'] != "on") {$this->nmgp_cmp_readonly['tmt_id_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tmt_tasktamplate_']) || $this->nmgp_cmp_readonly['tmt_tasktamplate_'] != "on") {$this->nmgp_cmp_readonly['tmt_tasktamplate_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tmt_tahapanproject_']) || $this->nmgp_cmp_readonly['tmt_tahapanproject_'] != "on") {$this->nmgp_cmp_readonly['tmt_tahapanproject_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tmt_tasktahapan_']) || $this->nmgp_cmp_readonly['tmt_tasktahapan_'] != "on") {$this->nmgp_cmp_readonly['tmt_tasktahapan_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tmt_tasknumber_']) || $this->nmgp_cmp_readonly['tmt_tasknumber_'] != "on") {$this->nmgp_cmp_readonly['tmt_tasknumber_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tmt_target90_']) || $this->nmgp_cmp_readonly['tmt_target90_'] != "on") {$this->nmgp_cmp_readonly['tmt_target90_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['tmt_target62_']) || $this->nmgp_cmp_readonly['tmt_target62_'] != "on") {$this->nmgp_cmp_readonly['tmt_target62_'] = false;}
       }
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
        $this->tmt_id_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_id_']; 
       $tmt_id_ = $this->tmt_id_; 
       $sStyleHidden_tmt_id_ = '';
       if (isset($sCheckRead_tmt_id_))
       {
           unset($sCheckRead_tmt_id_);
       }
       if (isset($this->nmgp_cmp_readonly['tmt_id_']))
       {
           $sCheckRead_tmt_id_ = $this->nmgp_cmp_readonly['tmt_id_'];
       }
       if (isset($this->nmgp_cmp_hidden['tmt_id_']) && $this->nmgp_cmp_hidden['tmt_id_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tmt_id_']);
           $sStyleHidden_tmt_id_ = 'display: none;';
       }
       $bTestReadOnly_tmt_id_ = true;
       $sStyleReadLab_tmt_id_ = 'display: none;';
       $sStyleReadInp_tmt_id_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["tmt_id_"]) &&  $this->nmgp_cmp_readonly["tmt_id_"] == "on"))
       {
           $bTestReadOnly_tmt_id_ = false;
           unset($this->nmgp_cmp_readonly['tmt_id_']);
           $sStyleReadLab_tmt_id_ = '';
           $sStyleReadInp_tmt_id_ = 'display: none;';
       }
       $this->tmt_tasktamplate_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_tasktamplate_']; 
       $tmt_tasktamplate_ = $this->tmt_tasktamplate_; 
       $sStyleHidden_tmt_tasktamplate_ = '';
       if (isset($sCheckRead_tmt_tasktamplate_))
       {
           unset($sCheckRead_tmt_tasktamplate_);
       }
       if (isset($this->nmgp_cmp_readonly['tmt_tasktamplate_']))
       {
           $sCheckRead_tmt_tasktamplate_ = $this->nmgp_cmp_readonly['tmt_tasktamplate_'];
       }
       if (isset($this->nmgp_cmp_hidden['tmt_tasktamplate_']) && $this->nmgp_cmp_hidden['tmt_tasktamplate_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tmt_tasktamplate_']);
           $sStyleHidden_tmt_tasktamplate_ = 'display: none;';
       }
       $bTestReadOnly_tmt_tasktamplate_ = true;
       $sStyleReadLab_tmt_tasktamplate_ = 'display: none;';
       $sStyleReadInp_tmt_tasktamplate_ = '';
       if (isset($this->nmgp_cmp_readonly['tmt_tasktamplate_']) && $this->nmgp_cmp_readonly['tmt_tasktamplate_'] == 'on')
       {
           $bTestReadOnly_tmt_tasktamplate_ = false;
           unset($this->nmgp_cmp_readonly['tmt_tasktamplate_']);
           $sStyleReadLab_tmt_tasktamplate_ = '';
           $sStyleReadInp_tmt_tasktamplate_ = 'display: none;';
       }
       $this->tmt_tahapanproject_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_tahapanproject_']; 
       $tmt_tahapanproject_ = $this->tmt_tahapanproject_; 
       $sStyleHidden_tmt_tahapanproject_ = '';
       if (isset($sCheckRead_tmt_tahapanproject_))
       {
           unset($sCheckRead_tmt_tahapanproject_);
       }
       if (isset($this->nmgp_cmp_readonly['tmt_tahapanproject_']))
       {
           $sCheckRead_tmt_tahapanproject_ = $this->nmgp_cmp_readonly['tmt_tahapanproject_'];
       }
       if (isset($this->nmgp_cmp_hidden['tmt_tahapanproject_']) && $this->nmgp_cmp_hidden['tmt_tahapanproject_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tmt_tahapanproject_']);
           $sStyleHidden_tmt_tahapanproject_ = 'display: none;';
       }
       $bTestReadOnly_tmt_tahapanproject_ = true;
       $sStyleReadLab_tmt_tahapanproject_ = 'display: none;';
       $sStyleReadInp_tmt_tahapanproject_ = '';
       if (isset($this->nmgp_cmp_readonly['tmt_tahapanproject_']) && $this->nmgp_cmp_readonly['tmt_tahapanproject_'] == 'on')
       {
           $bTestReadOnly_tmt_tahapanproject_ = false;
           unset($this->nmgp_cmp_readonly['tmt_tahapanproject_']);
           $sStyleReadLab_tmt_tahapanproject_ = '';
           $sStyleReadInp_tmt_tahapanproject_ = 'display: none;';
       }
       $this->tmt_tasktahapan_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_tasktahapan_']; 
       $tmt_tasktahapan_ = $this->tmt_tasktahapan_; 
       $sStyleHidden_tmt_tasktahapan_ = '';
       if (isset($sCheckRead_tmt_tasktahapan_))
       {
           unset($sCheckRead_tmt_tasktahapan_);
       }
       if (isset($this->nmgp_cmp_readonly['tmt_tasktahapan_']))
       {
           $sCheckRead_tmt_tasktahapan_ = $this->nmgp_cmp_readonly['tmt_tasktahapan_'];
       }
       if (isset($this->nmgp_cmp_hidden['tmt_tasktahapan_']) && $this->nmgp_cmp_hidden['tmt_tasktahapan_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tmt_tasktahapan_']);
           $sStyleHidden_tmt_tasktahapan_ = 'display: none;';
       }
       $bTestReadOnly_tmt_tasktahapan_ = true;
       $sStyleReadLab_tmt_tasktahapan_ = 'display: none;';
       $sStyleReadInp_tmt_tasktahapan_ = '';
       if (isset($this->nmgp_cmp_readonly['tmt_tasktahapan_']) && $this->nmgp_cmp_readonly['tmt_tasktahapan_'] == 'on')
       {
           $bTestReadOnly_tmt_tasktahapan_ = false;
           unset($this->nmgp_cmp_readonly['tmt_tasktahapan_']);
           $sStyleReadLab_tmt_tasktahapan_ = '';
           $sStyleReadInp_tmt_tasktahapan_ = 'display: none;';
       }
       $this->tmt_tasknumber_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_tasknumber_']; 
       $tmt_tasknumber_ = $this->tmt_tasknumber_; 
       $sStyleHidden_tmt_tasknumber_ = '';
       if (isset($sCheckRead_tmt_tasknumber_))
       {
           unset($sCheckRead_tmt_tasknumber_);
       }
       if (isset($this->nmgp_cmp_readonly['tmt_tasknumber_']))
       {
           $sCheckRead_tmt_tasknumber_ = $this->nmgp_cmp_readonly['tmt_tasknumber_'];
       }
       if (isset($this->nmgp_cmp_hidden['tmt_tasknumber_']) && $this->nmgp_cmp_hidden['tmt_tasknumber_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tmt_tasknumber_']);
           $sStyleHidden_tmt_tasknumber_ = 'display: none;';
       }
       $bTestReadOnly_tmt_tasknumber_ = true;
       $sStyleReadLab_tmt_tasknumber_ = 'display: none;';
       $sStyleReadInp_tmt_tasknumber_ = '';
       if (isset($this->nmgp_cmp_readonly['tmt_tasknumber_']) && $this->nmgp_cmp_readonly['tmt_tasknumber_'] == 'on')
       {
           $bTestReadOnly_tmt_tasknumber_ = false;
           unset($this->nmgp_cmp_readonly['tmt_tasknumber_']);
           $sStyleReadLab_tmt_tasknumber_ = '';
           $sStyleReadInp_tmt_tasknumber_ = 'display: none;';
       }
       $this->tmt_target90_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_target90_']; 
       $tmt_target90_ = $this->tmt_target90_; 
       $sStyleHidden_tmt_target90_ = '';
       if (isset($sCheckRead_tmt_target90_))
       {
           unset($sCheckRead_tmt_target90_);
       }
       if (isset($this->nmgp_cmp_readonly['tmt_target90_']))
       {
           $sCheckRead_tmt_target90_ = $this->nmgp_cmp_readonly['tmt_target90_'];
       }
       if (isset($this->nmgp_cmp_hidden['tmt_target90_']) && $this->nmgp_cmp_hidden['tmt_target90_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tmt_target90_']);
           $sStyleHidden_tmt_target90_ = 'display: none;';
       }
       $bTestReadOnly_tmt_target90_ = true;
       $sStyleReadLab_tmt_target90_ = 'display: none;';
       $sStyleReadInp_tmt_target90_ = '';
       if (isset($this->nmgp_cmp_readonly['tmt_target90_']) && $this->nmgp_cmp_readonly['tmt_target90_'] == 'on')
       {
           $bTestReadOnly_tmt_target90_ = false;
           unset($this->nmgp_cmp_readonly['tmt_target90_']);
           $sStyleReadLab_tmt_target90_ = '';
           $sStyleReadInp_tmt_target90_ = 'display: none;';
       }
       $this->tmt_target62_ = $this->form_vert_form_tahapanproject_detail[$sc_seq_vert]['tmt_target62_']; 
       $tmt_target62_ = $this->tmt_target62_; 
       $sStyleHidden_tmt_target62_ = '';
       if (isset($sCheckRead_tmt_target62_))
       {
           unset($sCheckRead_tmt_target62_);
       }
       if (isset($this->nmgp_cmp_readonly['tmt_target62_']))
       {
           $sCheckRead_tmt_target62_ = $this->nmgp_cmp_readonly['tmt_target62_'];
       }
       if (isset($this->nmgp_cmp_hidden['tmt_target62_']) && $this->nmgp_cmp_hidden['tmt_target62_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['tmt_target62_']);
           $sStyleHidden_tmt_target62_ = 'display: none;';
       }
       $bTestReadOnly_tmt_target62_ = true;
       $sStyleReadLab_tmt_target62_ = 'display: none;';
       $sStyleReadInp_tmt_target62_ = '';
       if (isset($this->nmgp_cmp_readonly['tmt_target62_']) && $this->nmgp_cmp_readonly['tmt_target62_'] == 'on')
       {
           $bTestReadOnly_tmt_target62_ = false;
           unset($this->nmgp_cmp_readonly['tmt_target62_']);
           $sStyleReadLab_tmt_target62_ = '';
           $sStyleReadInp_tmt_target62_ = 'display: none;';
       }

       $nm_cor_fun_vert = ($nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?>>


   
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>"  style="display: none;"> <?php echo $sc_seq_vert; ?> </TD>
   
   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") {?>
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
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_tahapanproject_detail_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_tahapanproject_detail_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_tahapanproject_detail_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_tahapanproject_detail_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_tahapanproject_detail_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_tahapanproject_detail_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 </TD>
   <?php }?>
   <?php if (isset($this->nmgp_cmp_hidden['tmt_id_']) && $this->nmgp_cmp_hidden['tmt_id_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tmt_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_id_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOddMult css_tmt_id__line" id="hidden_field_data_tmt_id_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tmt_id_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tmt_id__line" style="vertical-align: top;padding: 0px"><span id="id_read_on_tmt_id_<?php echo $sc_seq_vert ?>" class="css_tmt_id__line" style="<?php echo $sStyleReadLab_tmt_id_; ?>"><?php echo $this->form_encode_input($this->tmt_id_); ?></span><span id="id_read_off_tmt_id_<?php echo $sc_seq_vert ?>" style="<?php echo $sStyleReadInp_tmt_id_; ?>"><input type="hidden" id="id_sc_field_tmt_id_<?php echo $sc_seq_vert ?>" name="tmt_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_id_) . "\">"?>
<span id="id_ajax_label_tmt_id_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($tmt_id_); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tmt_id_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tmt_id_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_tasktamplate_']) && $this->nmgp_cmp_hidden['tmt_tasktamplate_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tmt_tasktamplate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tasktamplate_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tmt_tasktamplate__line" id="hidden_field_data_tmt_tasktamplate_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tmt_tasktamplate_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tmt_tasktamplate__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tmt_tasktamplate_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tmt_tasktamplate_"]) &&  $this->nmgp_cmp_readonly["tmt_tasktamplate_"] == "on") { 

 ?>
<input type="hidden" name="tmt_tasktamplate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tasktamplate_) . "\">" . $tmt_tasktamplate_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tmt_tasktamplate_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tmt_tasktamplate_<?php echo $sc_seq_vert ?> css_tmt_tasktamplate__line" style="<?php echo $sStyleReadLab_tmt_tasktamplate_; ?>"><?php echo $this->form_encode_input($this->tmt_tasktamplate_); ?></span><span id="id_read_off_tmt_tasktamplate_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tmt_tasktamplate_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tmt_tasktamplate__obj" style="" id="id_sc_field_tmt_tasktamplate_<?php echo $sc_seq_vert ?>" type=text name="tmt_tasktamplate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tasktamplate_) ?>"
 size=50 maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tmt_tasktamplate_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tmt_tasktamplate_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_tahapanproject_']) && $this->nmgp_cmp_hidden['tmt_tahapanproject_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tmt_tahapanproject_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tahapanproject_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tmt_tahapanproject__line" id="hidden_field_data_tmt_tahapanproject_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tmt_tahapanproject_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tmt_tahapanproject__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tmt_tahapanproject_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tmt_tahapanproject_"]) &&  $this->nmgp_cmp_readonly["tmt_tahapanproject_"] == "on") { 

 ?>
<input type="hidden" name="tmt_tahapanproject_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tahapanproject_) . "\">" . $tmt_tahapanproject_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tmt_tahapanproject_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tmt_tahapanproject_<?php echo $sc_seq_vert ?> css_tmt_tahapanproject__line" style="<?php echo $sStyleReadLab_tmt_tahapanproject_; ?>"><?php echo $this->form_encode_input($this->tmt_tahapanproject_); ?></span><span id="id_read_off_tmt_tahapanproject_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tmt_tahapanproject_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tmt_tahapanproject__obj" style="" id="id_sc_field_tmt_tahapanproject_<?php echo $sc_seq_vert ?>" type=text name="tmt_tahapanproject_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tahapanproject_) ?>"
 size=50 maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tmt_tahapanproject_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tmt_tahapanproject_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_tasktahapan_']) && $this->nmgp_cmp_hidden['tmt_tasktahapan_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tmt_tasktahapan_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tasktahapan_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tmt_tasktahapan__line" id="hidden_field_data_tmt_tasktahapan_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tmt_tasktahapan_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tmt_tasktahapan__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tmt_tasktahapan_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tmt_tasktahapan_"]) &&  $this->nmgp_cmp_readonly["tmt_tasktahapan_"] == "on") { 

 ?>
<input type="hidden" name="tmt_tasktahapan_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tasktahapan_) . "\">" . $tmt_tasktahapan_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tmt_tasktahapan_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tmt_tasktahapan_<?php echo $sc_seq_vert ?> css_tmt_tasktahapan__line" style="<?php echo $sStyleReadLab_tmt_tasktahapan_; ?>"><?php echo $this->form_encode_input($this->tmt_tasktahapan_); ?></span><span id="id_read_off_tmt_tasktahapan_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tmt_tasktahapan_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tmt_tasktahapan__obj" style="" id="id_sc_field_tmt_tasktahapan_<?php echo $sc_seq_vert ?>" type=text name="tmt_tasktahapan_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tasktahapan_) ?>"
 size=50 maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tmt_tasktahapan_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tmt_tasktahapan_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_tasknumber_']) && $this->nmgp_cmp_hidden['tmt_tasknumber_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tmt_tasknumber_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tasknumber_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tmt_tasknumber__line" id="hidden_field_data_tmt_tasknumber_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tmt_tasknumber_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tmt_tasknumber__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tmt_tasknumber_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tmt_tasknumber_"]) &&  $this->nmgp_cmp_readonly["tmt_tasknumber_"] == "on") { 

 ?>
<input type="hidden" name="tmt_tasknumber_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tasknumber_) . "\">" . $tmt_tasknumber_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tmt_tasknumber_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tmt_tasknumber_<?php echo $sc_seq_vert ?> css_tmt_tasknumber__line" style="<?php echo $sStyleReadLab_tmt_tasknumber_; ?>"><?php echo $this->form_encode_input($this->tmt_tasknumber_); ?></span><span id="id_read_off_tmt_tasknumber_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tmt_tasknumber_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tmt_tasknumber__obj" style="" id="id_sc_field_tmt_tasknumber_<?php echo $sc_seq_vert ?>" type=text name="tmt_tasknumber_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_tasknumber_) ?>"
 size=6 maxlength=6 alt="{datatype: 'text', maxLength: 6, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tmt_tasknumber_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tmt_tasknumber_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_target90_']) && $this->nmgp_cmp_hidden['tmt_target90_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tmt_target90_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_target90_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tmt_target90__line" id="hidden_field_data_tmt_target90_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tmt_target90_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tmt_target90__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tmt_target90_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tmt_target90_"]) &&  $this->nmgp_cmp_readonly["tmt_target90_"] == "on") { 

 ?>
<input type="hidden" name="tmt_target90_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_target90_) . "\">" . $tmt_target90_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tmt_target90_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tmt_target90_<?php echo $sc_seq_vert ?> css_tmt_target90__line" style="<?php echo $sStyleReadLab_tmt_target90_; ?>"><?php echo $this->form_encode_input($this->tmt_target90_); ?></span><span id="id_read_off_tmt_target90_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tmt_target90_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tmt_target90__obj" style="" id="id_sc_field_tmt_target90_<?php echo $sc_seq_vert ?>" type=text name="tmt_target90_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_target90_) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tmt_target90_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tmt_target90_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tmt_target90_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tmt_target90_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['tmt_target62_']) && $this->nmgp_cmp_hidden['tmt_target62_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tmt_target62_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_target62_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_tmt_target62__line" id="hidden_field_data_tmt_target62_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_tmt_target62_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_tmt_target62__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_tmt_target62_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tmt_target62_"]) &&  $this->nmgp_cmp_readonly["tmt_target62_"] == "on") { 

 ?>
<input type="hidden" name="tmt_target62_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_target62_) . "\">" . $tmt_target62_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_tmt_target62_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-tmt_target62_<?php echo $sc_seq_vert ?> css_tmt_target62__line" style="<?php echo $sStyleReadLab_tmt_target62_; ?>"><?php echo $this->form_encode_input($this->tmt_target62_); ?></span><span id="id_read_off_tmt_target62_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tmt_target62_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_tmt_target62__obj" style="" id="id_sc_field_tmt_target62_<?php echo $sc_seq_vert ?>" type=text name="tmt_target62_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($tmt_target62_) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tmt_target62_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tmt_target62_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tmt_target62_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tmt_target62_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_tmt_id_))
       {
           $this->nmgp_cmp_readonly['tmt_id_'] = $sCheckRead_tmt_id_;
       }
       if ('display: none;' == $sStyleHidden_tmt_id_)
       {
           $this->nmgp_cmp_hidden['tmt_id_'] = 'off';
       }
       if (isset($sCheckRead_tmt_tasktamplate_))
       {
           $this->nmgp_cmp_readonly['tmt_tasktamplate_'] = $sCheckRead_tmt_tasktamplate_;
       }
       if ('display: none;' == $sStyleHidden_tmt_tasktamplate_)
       {
           $this->nmgp_cmp_hidden['tmt_tasktamplate_'] = 'off';
       }
       if (isset($sCheckRead_tmt_tahapanproject_))
       {
           $this->nmgp_cmp_readonly['tmt_tahapanproject_'] = $sCheckRead_tmt_tahapanproject_;
       }
       if ('display: none;' == $sStyleHidden_tmt_tahapanproject_)
       {
           $this->nmgp_cmp_hidden['tmt_tahapanproject_'] = 'off';
       }
       if (isset($sCheckRead_tmt_tasktahapan_))
       {
           $this->nmgp_cmp_readonly['tmt_tasktahapan_'] = $sCheckRead_tmt_tasktahapan_;
       }
       if ('display: none;' == $sStyleHidden_tmt_tasktahapan_)
       {
           $this->nmgp_cmp_hidden['tmt_tasktahapan_'] = 'off';
       }
       if (isset($sCheckRead_tmt_tasknumber_))
       {
           $this->nmgp_cmp_readonly['tmt_tasknumber_'] = $sCheckRead_tmt_tasknumber_;
       }
       if ('display: none;' == $sStyleHidden_tmt_tasknumber_)
       {
           $this->nmgp_cmp_hidden['tmt_tasknumber_'] = 'off';
       }
       if (isset($sCheckRead_tmt_target90_))
       {
           $this->nmgp_cmp_readonly['tmt_target90_'] = $sCheckRead_tmt_target90_;
       }
       if ('display: none;' == $sStyleHidden_tmt_target90_)
       {
           $this->nmgp_cmp_hidden['tmt_target90_'] = 'off';
       }
       if (isset($sCheckRead_tmt_target62_))
       {
           $this->nmgp_cmp_readonly['tmt_target62_'] = $sCheckRead_tmt_target62_;
       }
       if ('display: none;' == $sStyleHidden_tmt_target62_)
       {
           $this->nmgp_cmp_hidden['tmt_target62_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_tahapanproject_detail = $guarda_form_vert_form_tahapanproject_detail;
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
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['run_modal'])
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_tahapanproject_detail");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_tahapanproject_detail");
 parent.scAjaxDetailHeight("form_tahapanproject_detail", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_tahapanproject_detail", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_tahapanproject_detail", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tahapanproject_detail']['sc_modal'])
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
