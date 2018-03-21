<?php
class form_statusproject_form extends form_statusproject_apl
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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - AKSESSMR.TB_PROJECTSTATUS"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - AKSESSMR.TB_PROJECTSTATUS"); } ?></TITLE>
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
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['sc_redir_atualiz'] == 'ok')
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_statusproject/form_statusproject_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("form_statusproject_sajax_js.php");
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

include_once('form_statusproject_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['recarga'];
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
 include_once("form_statusproject_js0.php");
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
$_SESSION['scriptcase']['error_span_title']['form_statusproject'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_statusproject'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R")
{
    $NM_btn = false;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($this->Embutida_form) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "do_ajax_form_statusproject_add_new_line(); return false;", "do_ajax_form_statusproject_add_new_line(); return false;", "sc_b_new_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
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
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['empty_filter'] = true;
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
   <?php if (isset($this->nmgp_cmp_hidden['statusid_']) && $this->nmgp_cmp_hidden['statusid_'] == 'off') { $sStyleHidden_statusid_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['statusid_']) || $this->nmgp_cmp_hidden['statusid_'] == 'on') {
      if (!isset($this->nm_new_label['statusid_'])) {
          $this->nm_new_label['statusid_'] = "ID"; } ?>

    <TD class="scFormLabelOddMult css_statusid__label" id="hidden_field_label_statusid_" style="<?php echo $sStyleHidden_statusid_; ?>" > <?php echo $this->nm_new_label['statusid_'] ?> <span class="scFormRequiredOddMult">*</span> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['statusname_']) && $this->nmgp_cmp_hidden['statusname_'] == 'off') { $sStyleHidden_statusname_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['statusname_']) || $this->nmgp_cmp_hidden['statusname_'] == 'on') {
      if (!isset($this->nm_new_label['statusname_'])) {
          $this->nm_new_label['statusname_'] = "Status Project"; } ?>

    <TD class="scFormLabelOddMult css_statusname__label" id="hidden_field_label_statusname_" style="<?php echo $sStyleHidden_statusname_; ?>" > <?php echo $this->nm_new_label['statusname_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['description_']) && $this->nmgp_cmp_hidden['description_'] == 'off') { $sStyleHidden_description_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['description_']) || $this->nmgp_cmp_hidden['description_'] == 'on') {
      if (!isset($this->nm_new_label['description_'])) {
          $this->nm_new_label['description_'] = "Deskripsi"; } ?>

    <TD class="scFormLabelOddMult css_description__label" id="hidden_field_label_description_" style="<?php echo $sStyleHidden_description_; ?>" > <?php echo $this->nm_new_label['description_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['entrydate_']) && $this->nmgp_cmp_hidden['entrydate_'] == 'off') { $sStyleHidden_entrydate_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['entrydate_']) || $this->nmgp_cmp_hidden['entrydate_'] == 'on') {
      if (!isset($this->nm_new_label['entrydate_'])) {
          $this->nm_new_label['entrydate_'] = "Tgl Entry"; } ?>
<?php
          $date_format_show = strtolower(str_replace(';', ' ', $this->field_config['entrydate_']['date_format']));
          $date_format_show = str_replace("dd", $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
          $date_format_show = str_replace("mm", $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
          $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
          $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
          $date_format_show = str_replace("hh", $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
          $date_format_show = str_replace("ii", $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
          $date_format_show = str_replace("ss", $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
?>

    <TD class="scFormLabelOddMult css_entrydate__label" id="hidden_field_label_entrydate_" style="<?php echo $sStyleHidden_entrydate_; ?>" > <?php echo $this->nm_new_label['entrydate_'] ?><br><?php echo $date_format_show ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['entryby_']) && $this->nmgp_cmp_hidden['entryby_'] == 'off') { $sStyleHidden_entryby_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['entryby_']) || $this->nmgp_cmp_hidden['entryby_'] == 'on') {
      if (!isset($this->nm_new_label['entryby_'])) {
          $this->nm_new_label['entryby_'] = "Petugas Entry"; } ?>

    <TD class="scFormLabelOddMult css_entryby__label" id="hidden_field_label_entryby_" style="<?php echo $sStyleHidden_entryby_; ?>" > <?php echo $this->nm_new_label['entryby_'] ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['updatedate_']) && $this->nmgp_cmp_hidden['updatedate_'] == 'off') { $sStyleHidden_updatedate_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['updatedate_']) || $this->nmgp_cmp_hidden['updatedate_'] == 'on') {
      if (!isset($this->nm_new_label['updatedate_'])) {
          $this->nm_new_label['updatedate_'] = "Tgl Update"; } ?>
<?php
          $date_format_show = strtolower(str_replace(';', ' ', $this->field_config['updatedate_']['date_format']));
          $date_format_show = str_replace("dd", $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
          $date_format_show = str_replace("mm", $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
          $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
          $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
          $date_format_show = str_replace("hh", $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
          $date_format_show = str_replace("ii", $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
          $date_format_show = str_replace("ss", $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
?>

    <TD class="scFormLabelOddMult css_updatedate__label" id="hidden_field_label_updatedate_" style="<?php echo $sStyleHidden_updatedate_; ?>" > <?php echo $this->nm_new_label['updatedate_'] ?><br><?php echo $date_format_show ?> </TD>
   <?php } ?>

   <?php if (isset($this->nmgp_cmp_hidden['updateby_']) && $this->nmgp_cmp_hidden['updateby_'] == 'off') { $sStyleHidden_updateby_ = 'display: none'; }
      if (1 || !isset($this->nmgp_cmp_hidden['updateby_']) || $this->nmgp_cmp_hidden['updateby_'] == 'on') {
      if (!isset($this->nm_new_label['updateby_'])) {
          $this->nm_new_label['updateby_'] = "Petugas Update"; } ?>

    <TD class="scFormLabelOddMult css_updateby__label" id="hidden_field_label_updateby_" style="<?php echo $sStyleHidden_updateby_; ?>" > <?php echo $this->nm_new_label['updateby_'] ?> </TD>
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
       $iStart = sizeof($this->form_vert_form_statusproject);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_statusproject = $this->form_vert_form_statusproject;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_statusproject))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['statusid_']))
           {
               $this->nmgp_cmp_readonly['statusid_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['entrydate_']))
           {
               $this->nmgp_cmp_readonly['entrydate_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['entryby_']))
           {
               $this->nmgp_cmp_readonly['entryby_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['updatedate_']))
           {
               $this->nmgp_cmp_readonly['updatedate_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['updateby_']))
           {
               $this->nmgp_cmp_readonly['updateby_'] = 'on';
           }
   foreach ($this->form_vert_form_statusproject as $sc_seq_vert => $sc_lixo)
   {
       $this->loadRecordState($sc_seq_vert);
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['statusid_'] = true;
           $this->nmgp_cmp_readonly['statusname_'] = true;
           $this->nmgp_cmp_readonly['description_'] = true;
           $this->nmgp_cmp_readonly['entrydate_'] = true;
           $this->nmgp_cmp_readonly['entryby_'] = true;
           $this->nmgp_cmp_readonly['updatedate_'] = true;
           $this->nmgp_cmp_readonly['updateby_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['statusid_']) || $this->nmgp_cmp_readonly['statusid_'] != "on") {$this->nmgp_cmp_readonly['statusid_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['statusname_']) || $this->nmgp_cmp_readonly['statusname_'] != "on") {$this->nmgp_cmp_readonly['statusname_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['description_']) || $this->nmgp_cmp_readonly['description_'] != "on") {$this->nmgp_cmp_readonly['description_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['entrydate_']) || $this->nmgp_cmp_readonly['entrydate_'] != "on") {$this->nmgp_cmp_readonly['entrydate_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['entryby_']) || $this->nmgp_cmp_readonly['entryby_'] != "on") {$this->nmgp_cmp_readonly['entryby_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['updatedate_']) || $this->nmgp_cmp_readonly['updatedate_'] != "on") {$this->nmgp_cmp_readonly['updatedate_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['updateby_']) || $this->nmgp_cmp_readonly['updateby_'] != "on") {$this->nmgp_cmp_readonly['updateby_'] = false;}
       }
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
        $this->statusid_ = $this->form_vert_form_statusproject[$sc_seq_vert]['statusid_']; 
       $statusid_ = $this->statusid_; 
       $sStyleHidden_statusid_ = '';
       if (isset($sCheckRead_statusid_))
       {
           unset($sCheckRead_statusid_);
       }
       if (isset($this->nmgp_cmp_readonly['statusid_']))
       {
           $sCheckRead_statusid_ = $this->nmgp_cmp_readonly['statusid_'];
       }
       if (isset($this->nmgp_cmp_hidden['statusid_']) && $this->nmgp_cmp_hidden['statusid_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['statusid_']);
           $sStyleHidden_statusid_ = 'display: none;';
       }
       $bTestReadOnly_statusid_ = true;
       $sStyleReadLab_statusid_ = 'display: none;';
       $sStyleReadInp_statusid_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["statusid_"]) &&  $this->nmgp_cmp_readonly["statusid_"] == "on"))
       {
           $bTestReadOnly_statusid_ = false;
           unset($this->nmgp_cmp_readonly['statusid_']);
           $sStyleReadLab_statusid_ = '';
           $sStyleReadInp_statusid_ = 'display: none;';
       }
       $this->statusname_ = $this->form_vert_form_statusproject[$sc_seq_vert]['statusname_']; 
       $statusname_ = $this->statusname_; 
       $sStyleHidden_statusname_ = '';
       if (isset($sCheckRead_statusname_))
       {
           unset($sCheckRead_statusname_);
       }
       if (isset($this->nmgp_cmp_readonly['statusname_']))
       {
           $sCheckRead_statusname_ = $this->nmgp_cmp_readonly['statusname_'];
       }
       if (isset($this->nmgp_cmp_hidden['statusname_']) && $this->nmgp_cmp_hidden['statusname_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['statusname_']);
           $sStyleHidden_statusname_ = 'display: none;';
       }
       $bTestReadOnly_statusname_ = true;
       $sStyleReadLab_statusname_ = 'display: none;';
       $sStyleReadInp_statusname_ = '';
       if (isset($this->nmgp_cmp_readonly['statusname_']) && $this->nmgp_cmp_readonly['statusname_'] == 'on')
       {
           $bTestReadOnly_statusname_ = false;
           unset($this->nmgp_cmp_readonly['statusname_']);
           $sStyleReadLab_statusname_ = '';
           $sStyleReadInp_statusname_ = 'display: none;';
       }
       $this->description_ = $this->form_vert_form_statusproject[$sc_seq_vert]['description_']; 
       $description_ = $this->description_; 
       $description__tmp = str_replace(array('\r\n', '\n\r', '\n', '\r'), array("\r\n", "\n\r", "\n", "\r"), $description_);
       $description__val = nl2br($description__tmp);
       $sStyleHidden_description_ = '';
       if (isset($sCheckRead_description_))
       {
           unset($sCheckRead_description_);
       }
       if (isset($this->nmgp_cmp_readonly['description_']))
       {
           $sCheckRead_description_ = $this->nmgp_cmp_readonly['description_'];
       }
       if (isset($this->nmgp_cmp_hidden['description_']) && $this->nmgp_cmp_hidden['description_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['description_']);
           $sStyleHidden_description_ = 'display: none;';
       }
       $bTestReadOnly_description_ = true;
       $sStyleReadLab_description_ = 'display: none;';
       $sStyleReadInp_description_ = '';
       if (isset($this->nmgp_cmp_readonly['description_']) && $this->nmgp_cmp_readonly['description_'] == 'on')
       {
           $bTestReadOnly_description_ = false;
           unset($this->nmgp_cmp_readonly['description_']);
           $sStyleReadLab_description_ = '';
           $sStyleReadInp_description_ = 'display: none;';
       }
       $this->entrydate_ = $this->form_vert_form_statusproject[$sc_seq_vert]['entrydate_']; 
       $entrydate_ = $this->entrydate_; 
       $sStyleHidden_entrydate_ = '';
       if (isset($sCheckRead_entrydate_))
       {
           unset($sCheckRead_entrydate_);
       }
       if (isset($this->nmgp_cmp_readonly['entrydate_']))
       {
           $sCheckRead_entrydate_ = $this->nmgp_cmp_readonly['entrydate_'];
       }
       if (isset($this->nmgp_cmp_hidden['entrydate_']) && $this->nmgp_cmp_hidden['entrydate_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['entrydate_']);
           $sStyleHidden_entrydate_ = 'display: none;';
       }
       $bTestReadOnly_entrydate_ = true;
       $sStyleReadLab_entrydate_ = 'display: none;';
       $sStyleReadInp_entrydate_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["entrydate_"]) &&  $this->nmgp_cmp_readonly["entrydate_"] == "on"))
       {
           $bTestReadOnly_entrydate_ = false;
           unset($this->nmgp_cmp_readonly['entrydate_']);
           $sStyleReadLab_entrydate_ = '';
           $sStyleReadInp_entrydate_ = 'display: none;';
       }
       $this->entryby_ = $this->form_vert_form_statusproject[$sc_seq_vert]['entryby_']; 
       $entryby_ = $this->entryby_; 
       $sStyleHidden_entryby_ = '';
       if (isset($sCheckRead_entryby_))
       {
           unset($sCheckRead_entryby_);
       }
       if (isset($this->nmgp_cmp_readonly['entryby_']))
       {
           $sCheckRead_entryby_ = $this->nmgp_cmp_readonly['entryby_'];
       }
       if (isset($this->nmgp_cmp_hidden['entryby_']) && $this->nmgp_cmp_hidden['entryby_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['entryby_']);
           $sStyleHidden_entryby_ = 'display: none;';
       }
       $bTestReadOnly_entryby_ = true;
       $sStyleReadLab_entryby_ = 'display: none;';
       $sStyleReadInp_entryby_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["entryby_"]) &&  $this->nmgp_cmp_readonly["entryby_"] == "on"))
       {
           $bTestReadOnly_entryby_ = false;
           unset($this->nmgp_cmp_readonly['entryby_']);
           $sStyleReadLab_entryby_ = '';
           $sStyleReadInp_entryby_ = 'display: none;';
       }
       $this->updatedate_ = $this->form_vert_form_statusproject[$sc_seq_vert]['updatedate_']; 
       $updatedate_ = $this->updatedate_; 
       $sStyleHidden_updatedate_ = '';
       if (isset($sCheckRead_updatedate_))
       {
           unset($sCheckRead_updatedate_);
       }
       if (isset($this->nmgp_cmp_readonly['updatedate_']))
       {
           $sCheckRead_updatedate_ = $this->nmgp_cmp_readonly['updatedate_'];
       }
       if (isset($this->nmgp_cmp_hidden['updatedate_']) && $this->nmgp_cmp_hidden['updatedate_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['updatedate_']);
           $sStyleHidden_updatedate_ = 'display: none;';
       }
       $bTestReadOnly_updatedate_ = true;
       $sStyleReadLab_updatedate_ = 'display: none;';
       $sStyleReadInp_updatedate_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["updatedate_"]) &&  $this->nmgp_cmp_readonly["updatedate_"] == "on"))
       {
           $bTestReadOnly_updatedate_ = false;
           unset($this->nmgp_cmp_readonly['updatedate_']);
           $sStyleReadLab_updatedate_ = '';
           $sStyleReadInp_updatedate_ = 'display: none;';
       }
       $this->updateby_ = $this->form_vert_form_statusproject[$sc_seq_vert]['updateby_']; 
       $updateby_ = $this->updateby_; 
       $sStyleHidden_updateby_ = '';
       if (isset($sCheckRead_updateby_))
       {
           unset($sCheckRead_updateby_);
       }
       if (isset($this->nmgp_cmp_readonly['updateby_']))
       {
           $sCheckRead_updateby_ = $this->nmgp_cmp_readonly['updateby_'];
       }
       if (isset($this->nmgp_cmp_hidden['updateby_']) && $this->nmgp_cmp_hidden['updateby_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['updateby_']);
           $sStyleHidden_updateby_ = 'display: none;';
       }
       $bTestReadOnly_updateby_ = true;
       $sStyleReadLab_updateby_ = 'display: none;';
       $sStyleReadInp_updateby_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["updateby_"]) &&  $this->nmgp_cmp_readonly["updateby_"] == "on"))
       {
           $bTestReadOnly_updateby_ = false;
           unset($this->nmgp_cmp_readonly['updateby_']);
           $sStyleReadLab_updateby_ = '';
           $sStyleReadInp_updateby_ = 'display: none;';
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
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_statusproject_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_statusproject_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_statusproject_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_statusproject_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_statusproject_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_statusproject_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 </TD>
   <?php }?>
   <?php if (isset($this->nmgp_cmp_hidden['statusid_']) && $this->nmgp_cmp_hidden['statusid_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="statusid_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($statusid_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_statusid__line" id="hidden_field_data_statusid_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_statusid_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_statusid__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_statusid_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["statusid_"]) &&  $this->nmgp_cmp_readonly["statusid_"] == "on")) { 

 ?>
<input type="hidden" name="statusid_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($statusid_) . "\"><span id=\"id_ajax_label_statusid_" . $sc_seq_vert . "\">" . $statusid_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_statusid_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-statusid_<?php echo $sc_seq_vert ?> css_statusid__line" style="<?php echo $sStyleReadLab_statusid_; ?>"><?php echo $this->form_encode_input($this->statusid_); ?></span><span id="id_read_off_statusid_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_statusid_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_statusid__obj" style="" id="id_sc_field_statusid_<?php echo $sc_seq_vert ?>" type=text name="statusid_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($statusid_) ?>"
 size=5 alt="{datatype: 'integer', maxLength: 5, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['statusid_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['statusid_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_statusid_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_statusid_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['statusname_']) && $this->nmgp_cmp_hidden['statusname_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="statusname_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($statusname_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_statusname__line" id="hidden_field_data_statusname_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_statusname_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_statusname__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_statusname_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["statusname_"]) &&  $this->nmgp_cmp_readonly["statusname_"] == "on") { 

 ?>
<input type="hidden" name="statusname_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($statusname_) . "\">" . $statusname_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_statusname_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-statusname_<?php echo $sc_seq_vert ?> css_statusname__line" style="<?php echo $sStyleReadLab_statusname_; ?>"><?php echo $this->form_encode_input($this->statusname_); ?></span><span id="id_read_off_statusname_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_statusname_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_statusname__obj" style="" id="id_sc_field_statusname_<?php echo $sc_seq_vert ?>" type=text name="statusname_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($statusname_) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_statusname_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_statusname_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['description_']) && $this->nmgp_cmp_hidden['description_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="description_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($description_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_description__line" id="hidden_field_data_description_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_description_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_description__line" style="vertical-align: top;padding: 0px">
<?php
$description__val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($description_));

?>

<?php if ($bTestReadOnly_description_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["description_"]) &&  $this->nmgp_cmp_readonly["description_"] == "on") { 

 ?>
<input type="hidden" name="description_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($description_) . "\">" . $description__val . ""; ?>
<?php } else { ?>
<span id="id_read_on_description_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-description_<?php echo $sc_seq_vert ?> css_description__line" style="<?php echo $sStyleReadLab_description_; ?>"><?php echo $this->form_encode_input($description__val); ?></span><span id="id_read_off_description_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_description_; ?>">
 <textarea  class="sc-js-input scFormObjectOddMult css_description__obj" style="white-space: pre-wrap;" name="description_<?php echo $sc_seq_vert ?>" id="id_sc_field_description_<?php echo $sc_seq_vert ?>" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 200, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $description_; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_description_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_description_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['entrydate_']) && $this->nmgp_cmp_hidden['entrydate_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="entrydate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($entrydate_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_entrydate__line" id="hidden_field_data_entrydate_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_entrydate_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_entrydate__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_entrydate_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["entrydate_"]) &&  $this->nmgp_cmp_readonly["entrydate_"] == "on")) { 

 ?>
<input type="hidden" name="entrydate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($entrydate_) . "\"><span id=\"id_ajax_label_entrydate_" . $sc_seq_vert . "\">" . $entrydate_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_entrydate_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-entrydate_<?php echo $sc_seq_vert ?> css_entrydate__line" style="<?php echo $sStyleReadLab_entrydate_; ?>"><?php echo $this->form_encode_input($entrydate_); ?></span><span id="id_read_off_entrydate_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_entrydate_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_entrydate__obj" style="" id="id_sc_field_entrydate_<?php echo $sc_seq_vert ?>" type=text name="entrydate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($entrydate_) ?>"
 size=10 alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['entrydate_']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['entrydate_']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$tmp_form_data = $this->field_config['entrydate_']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_entrydate_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_entrydate_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['entryby_']) && $this->nmgp_cmp_hidden['entryby_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="entryby_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($entryby_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_entryby__line" id="hidden_field_data_entryby_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_entryby_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_entryby__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_entryby_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["entryby_"]) &&  $this->nmgp_cmp_readonly["entryby_"] == "on")) { 

 ?>
<input type="hidden" name="entryby_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($entryby_) . "\"><span id=\"id_ajax_label_entryby_" . $sc_seq_vert . "\">" . $entryby_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_entryby_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-entryby_<?php echo $sc_seq_vert ?> css_entryby__line" style="<?php echo $sStyleReadLab_entryby_; ?>"><?php echo $this->form_encode_input($this->entryby_); ?></span><span id="id_read_off_entryby_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_entryby_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_entryby__obj" style="" id="id_sc_field_entryby_<?php echo $sc_seq_vert ?>" type=text name="entryby_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($entryby_) ?>"
 size=6 maxlength=6 alt="{datatype: 'text', maxLength: 6, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_entryby_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_entryby_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['updatedate_']) && $this->nmgp_cmp_hidden['updatedate_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="updatedate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($updatedate_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_updatedate__line" id="hidden_field_data_updatedate_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_updatedate_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_updatedate__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_updatedate_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["updatedate_"]) &&  $this->nmgp_cmp_readonly["updatedate_"] == "on")) { 

 ?>
<input type="hidden" name="updatedate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($updatedate_) . "\"><span id=\"id_ajax_label_updatedate_" . $sc_seq_vert . "\">" . $updatedate_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_updatedate_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-updatedate_<?php echo $sc_seq_vert ?> css_updatedate__line" style="<?php echo $sStyleReadLab_updatedate_; ?>"><?php echo $this->form_encode_input($updatedate_); ?></span><span id="id_read_off_updatedate_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_updatedate_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_updatedate__obj" style="" id="id_sc_field_updatedate_<?php echo $sc_seq_vert ?>" type=text name="updatedate_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($updatedate_) ?>"
 size=10 alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['updatedate_']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['updatedate_']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$tmp_form_data = $this->field_config['updatedate_']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_updatedate_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_updatedate_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['updateby_']) && $this->nmgp_cmp_hidden['updateby_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="updateby_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($updateby_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_updateby__line" id="hidden_field_data_updateby_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_updateby_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_updateby__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_updateby_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["updateby_"]) &&  $this->nmgp_cmp_readonly["updateby_"] == "on")) { 

 ?>
<input type="hidden" name="updateby_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($updateby_) . "\"><span id=\"id_ajax_label_updateby_" . $sc_seq_vert . "\">" . $updateby_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_updateby_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-updateby_<?php echo $sc_seq_vert ?> css_updateby__line" style="<?php echo $sStyleReadLab_updateby_; ?>"><?php echo $this->form_encode_input($this->updateby_); ?></span><span id="id_read_off_updateby_<?php echo $sc_seq_vert ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_updateby_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_updateby__obj" style="" id="id_sc_field_updateby_<?php echo $sc_seq_vert ?>" type=text name="updateby_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($updateby_) ?>"
 size=6 maxlength=6 alt="{datatype: 'text', maxLength: 6, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_updateby_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_updateby_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_statusid_))
       {
           $this->nmgp_cmp_readonly['statusid_'] = $sCheckRead_statusid_;
       }
       if ('display: none;' == $sStyleHidden_statusid_)
       {
           $this->nmgp_cmp_hidden['statusid_'] = 'off';
       }
       if (isset($sCheckRead_statusname_))
       {
           $this->nmgp_cmp_readonly['statusname_'] = $sCheckRead_statusname_;
       }
       if ('display: none;' == $sStyleHidden_statusname_)
       {
           $this->nmgp_cmp_hidden['statusname_'] = 'off';
       }
       if (isset($sCheckRead_description_))
       {
           $this->nmgp_cmp_readonly['description_'] = $sCheckRead_description_;
       }
       if ('display: none;' == $sStyleHidden_description_)
       {
           $this->nmgp_cmp_hidden['description_'] = 'off';
       }
       if (isset($sCheckRead_entrydate_))
       {
           $this->nmgp_cmp_readonly['entrydate_'] = $sCheckRead_entrydate_;
       }
       if ('display: none;' == $sStyleHidden_entrydate_)
       {
           $this->nmgp_cmp_hidden['entrydate_'] = 'off';
       }
       if (isset($sCheckRead_entryby_))
       {
           $this->nmgp_cmp_readonly['entryby_'] = $sCheckRead_entryby_;
       }
       if ('display: none;' == $sStyleHidden_entryby_)
       {
           $this->nmgp_cmp_hidden['entryby_'] = 'off';
       }
       if (isset($sCheckRead_updatedate_))
       {
           $this->nmgp_cmp_readonly['updatedate_'] = $sCheckRead_updatedate_;
       }
       if ('display: none;' == $sStyleHidden_updatedate_)
       {
           $this->nmgp_cmp_hidden['updatedate_'] = 'off';
       }
       if (isset($sCheckRead_updateby_))
       {
           $this->nmgp_cmp_readonly['updateby_'] = $sCheckRead_updateby_;
       }
       if ('display: none;' == $sStyleHidden_updateby_)
       {
           $this->nmgp_cmp_hidden['updateby_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_statusproject = $guarda_form_vert_form_statusproject;
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R")
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['run_modal'])
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_statusproject");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_statusproject");
 parent.scAjaxDetailHeight("form_statusproject", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_statusproject", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_statusproject", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_statusproject']['sc_modal'])
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
