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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("Input Data ODP"); } else { echo strip_tags("Update Data ODP"); } ?></TITLE>
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>odp_edit/odp_edit_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("odp_edit_inline_sajax_js.php");
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
    nm_sumario = "[<?php echo substr($this->Ini->Nm_lang['lang_othr_smry_info'], strpos($this->Ini->Nm_lang['lang_othr_smry_info'], "?final?")) ?>]";
    nm_sumario = nm_sumario.replace("?final?", reg_qtd);
    nm_sumario = nm_sumario.replace("?total?", reg_tot);
    if (reg_qtd < 1) {
        nm_sumario = "";
    }
}
function navpage_atualiza(str_navpage)
{
}
<?php

include_once('odp_edit_inline_jquery.php');

?>

 var scQSInit = true;
 var scQSPos  = {};
 var Dyn_Ini  = true;
 $(function() {

  setTimeout(function() {
  scJQElementsAdd('');

  scJQGeneralAdd();

  }, 50);
  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  $(".scUiLabelWidthFix").css("width", "120px");
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['recarga'];
}
?>
<body class="scFormPage" style="<?php echo $str_iframe_body; ?>">
<?php

if (isset($_SESSION['scriptcase']['odp_edit']['error_buffer']) && '' != $_SESSION['scriptcase']['odp_edit']['error_buffer'])
{
    echo $_SESSION['scriptcase']['odp_edit']['error_buffer'];
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
 include_once("odp_edit_inline_js0.php");
?>
<script type="text/javascript"> 
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
               action="odp_edit_inline.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['insert_validation']; ?>">
<?php
}
?>
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
$_SESSION['scriptcase']['error_span_title']['odp_edit_inline'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['odp_edit_inline'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="100%">
 <tr>
  <td>
  <div class="scFormBorder">
   <table width='100%' cellspacing=0 cellpadding=0>
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R")
{
    $NM_btn = false;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
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
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R")
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
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; text-align: center; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['empty_filter'] = true;
       }
  }
  else
  {
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable" width="100%" style="height: 100%;"><?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['po_id_']))
           {
               $this->nmgp_cmp_readonly['po_id_'] = 'on';
           }
?>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['po_idproject_']))
           {
               $this->nmgp_cmp_readonly['po_idproject_'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['po_id_']))
    {
        $this->nm_new_label['po_id_'] = "ID Table";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_id_ = $this->po_id_;
   $sStyleHidden_po_id_ = '';
   if (isset($this->nmgp_cmp_hidden['po_id_']) && $this->nmgp_cmp_hidden['po_id_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_id_']);
       $sStyleHidden_po_id_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_id_ = 'display: none;';
   $sStyleReadInp_po_id_ = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["po_id_"]) &&  $this->nmgp_cmp_readonly["po_id_"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_id_']);
       $sStyleReadLab_po_id_ = '';
       $sStyleReadInp_po_id_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_id_']) && $this->nmgp_cmp_hidden['po_id_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_id_" value="<?php echo $this->form_encode_input($po_id_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_id__label" id="hidden_field_label_po_id_" style="<?php echo $sStyleHidden_po_id_; ?>"><span id="id_label_po_id_"><?php echo $this->nm_new_label['po_id_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_id__line" id="hidden_field_data_po_id_" style="<?php echo $sStyleHidden_po_id_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_id__line" style="vertical-align: top;padding: 0px"><span id="id_read_on_po_id_" class="css_po_id__line" style="<?php echo $sStyleReadLab_po_id_; ?>"><?php echo $this->form_encode_input($this->po_id_); ?></span><span id="id_read_off_po_id_" style="<?php echo $sStyleReadInp_po_id_; ?>"><input type="hidden" name="po_id_" value="<?php echo $this->form_encode_input($po_id_) . "\">"?><span id="id_ajax_label_po_id_"><?php echo nl2br($po_id_); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_id__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_id__text"></span></td></tr></table></td></tr></table></TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['po_tpmoid_']))
           {
               $this->nmgp_cmp_readonly['po_tpmoid_'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['po_idproject_']))
    {
        $this->nm_new_label['po_idproject_'] = "ID Project";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_idproject_ = $this->po_idproject_;
   $sStyleHidden_po_idproject_ = '';
   if (isset($this->nmgp_cmp_hidden['po_idproject_']) && $this->nmgp_cmp_hidden['po_idproject_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_idproject_']);
       $sStyleHidden_po_idproject_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_idproject_ = 'display: none;';
   $sStyleReadInp_po_idproject_ = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["po_idproject_"]) &&  $this->nmgp_cmp_readonly["po_idproject_"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_idproject_']);
       $sStyleReadLab_po_idproject_ = '';
       $sStyleReadInp_po_idproject_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_idproject_']) && $this->nmgp_cmp_hidden['po_idproject_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_idproject_" value="<?php echo $this->form_encode_input($po_idproject_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_idproject__label" id="hidden_field_label_po_idproject_" style="<?php echo $sStyleHidden_po_idproject_; ?>"><span id="id_label_po_idproject_"><?php echo $this->nm_new_label['po_idproject_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_idproject__line" id="hidden_field_data_po_idproject_" style="<?php echo $sStyleHidden_po_idproject_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_idproject__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["po_idproject_"]) &&  $this->nmgp_cmp_readonly["po_idproject_"] == "on")) { 

 ?>
<input type="hidden" name="po_idproject_" value="<?php echo $this->form_encode_input($po_idproject_) . "\"><span id=\"id_ajax_label_po_idproject_\">" . $po_idproject_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_po_idproject_" class="sc-ui-readonly-po_idproject_ css_po_idproject__line" style="<?php echo $sStyleReadLab_po_idproject_; ?>"><?php echo $this->form_encode_input($this->po_idproject_); ?></span><span id="id_read_off_po_idproject_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_idproject_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_idproject__obj" style="" id="id_sc_field_po_idproject_" type=text name="po_idproject_" value="<?php echo $this->form_encode_input($po_idproject_) ?>"
 size=22 maxlength=22 alt="{datatype: 'text', maxLength: 22, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_idproject__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_idproject__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['po_tipenode_']))
           {
               $this->nmgp_cmp_readonly['po_tipenode_'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['po_tpmoid_']))
    {
        $this->nm_new_label['po_tpmoid_'] = "TPMOID";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_tpmoid_ = $this->po_tpmoid_;
   $sStyleHidden_po_tpmoid_ = '';
   if (isset($this->nmgp_cmp_hidden['po_tpmoid_']) && $this->nmgp_cmp_hidden['po_tpmoid_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_tpmoid_']);
       $sStyleHidden_po_tpmoid_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_tpmoid_ = 'display: none;';
   $sStyleReadInp_po_tpmoid_ = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["po_tpmoid_"]) &&  $this->nmgp_cmp_readonly["po_tpmoid_"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_tpmoid_']);
       $sStyleReadLab_po_tpmoid_ = '';
       $sStyleReadInp_po_tpmoid_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_tpmoid_']) && $this->nmgp_cmp_hidden['po_tpmoid_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_tpmoid_" value="<?php echo $this->form_encode_input($po_tpmoid_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_tpmoid__label" id="hidden_field_label_po_tpmoid_" style="<?php echo $sStyleHidden_po_tpmoid_; ?>"><span id="id_label_po_tpmoid_"><?php echo $this->nm_new_label['po_tpmoid_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_tpmoid__line" id="hidden_field_data_po_tpmoid_" style="<?php echo $sStyleHidden_po_tpmoid_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_tpmoid__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["po_tpmoid_"]) &&  $this->nmgp_cmp_readonly["po_tpmoid_"] == "on")) { 

 ?>
<input type="hidden" name="po_tpmoid_" value="<?php echo $this->form_encode_input($po_tpmoid_) . "\"><span id=\"id_ajax_label_po_tpmoid_\">" . $po_tpmoid_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_po_tpmoid_" class="sc-ui-readonly-po_tpmoid_ css_po_tpmoid__line" style="<?php echo $sStyleReadLab_po_tpmoid_; ?>"><?php echo $this->form_encode_input($this->po_tpmoid_); ?></span><span id="id_read_off_po_tpmoid_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_tpmoid_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_tpmoid__obj" style="" id="id_sc_field_po_tpmoid_" type=text name="po_tpmoid_" value="<?php echo $this->form_encode_input($po_tpmoid_) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['po_tpmoid_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['po_tpmoid_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_tpmoid__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_tpmoid__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['po_namanode_']))
           {
               $this->nmgp_cmp_readonly['po_namanode_'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['po_tipenode_']))
    {
        $this->nm_new_label['po_tipenode_'] = "Type Node";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_tipenode_ = $this->po_tipenode_;
   $sStyleHidden_po_tipenode_ = '';
   if (isset($this->nmgp_cmp_hidden['po_tipenode_']) && $this->nmgp_cmp_hidden['po_tipenode_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_tipenode_']);
       $sStyleHidden_po_tipenode_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_tipenode_ = 'display: none;';
   $sStyleReadInp_po_tipenode_ = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["po_tipenode_"]) &&  $this->nmgp_cmp_readonly["po_tipenode_"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_tipenode_']);
       $sStyleReadLab_po_tipenode_ = '';
       $sStyleReadInp_po_tipenode_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_tipenode_']) && $this->nmgp_cmp_hidden['po_tipenode_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_tipenode_" value="<?php echo $this->form_encode_input($po_tipenode_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_tipenode__label" id="hidden_field_label_po_tipenode_" style="<?php echo $sStyleHidden_po_tipenode_; ?>"><span id="id_label_po_tipenode_"><?php echo $this->nm_new_label['po_tipenode_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_tipenode__line" id="hidden_field_data_po_tipenode_" style="<?php echo $sStyleHidden_po_tipenode_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_tipenode__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["po_tipenode_"]) &&  $this->nmgp_cmp_readonly["po_tipenode_"] == "on")) { 

 ?>
<input type="hidden" name="po_tipenode_" value="<?php echo $this->form_encode_input($po_tipenode_) . "\"><span id=\"id_ajax_label_po_tipenode_\">" . $po_tipenode_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_po_tipenode_" class="sc-ui-readonly-po_tipenode_ css_po_tipenode__line" style="<?php echo $sStyleReadLab_po_tipenode_; ?>"><?php echo $this->form_encode_input($this->po_tipenode_); ?></span><span id="id_read_off_po_tipenode_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_tipenode_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_tipenode__obj" style="" id="id_sc_field_po_tipenode_" type=text name="po_tipenode_" value="<?php echo $this->form_encode_input($po_tipenode_) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_tipenode__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_tipenode__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['po_merk_']))
           {
               $this->nmgp_cmp_readonly['po_merk_'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['po_namanode_']))
    {
        $this->nm_new_label['po_namanode_'] = "Nama Node";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_namanode_ = $this->po_namanode_;
   $sStyleHidden_po_namanode_ = '';
   if (isset($this->nmgp_cmp_hidden['po_namanode_']) && $this->nmgp_cmp_hidden['po_namanode_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_namanode_']);
       $sStyleHidden_po_namanode_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_namanode_ = 'display: none;';
   $sStyleReadInp_po_namanode_ = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["po_namanode_"]) &&  $this->nmgp_cmp_readonly["po_namanode_"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_namanode_']);
       $sStyleReadLab_po_namanode_ = '';
       $sStyleReadInp_po_namanode_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_namanode_']) && $this->nmgp_cmp_hidden['po_namanode_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_namanode_" value="<?php echo $this->form_encode_input($po_namanode_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_namanode__label" id="hidden_field_label_po_namanode_" style="<?php echo $sStyleHidden_po_namanode_; ?>"><span id="id_label_po_namanode_"><?php echo $this->nm_new_label['po_namanode_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_namanode__line" id="hidden_field_data_po_namanode_" style="<?php echo $sStyleHidden_po_namanode_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_namanode__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["po_namanode_"]) &&  $this->nmgp_cmp_readonly["po_namanode_"] == "on")) { 

 ?>
<input type="hidden" name="po_namanode_" value="<?php echo $this->form_encode_input($po_namanode_) . "\"><span id=\"id_ajax_label_po_namanode_\">" . $po_namanode_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_po_namanode_" class="sc-ui-readonly-po_namanode_ css_po_namanode__line" style="<?php echo $sStyleReadLab_po_namanode_; ?>"><?php echo $this->form_encode_input($this->po_namanode_); ?></span><span id="id_read_off_po_namanode_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_namanode_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_namanode__obj" style="" id="id_sc_field_po_namanode_" type=text name="po_namanode_" value="<?php echo $this->form_encode_input($po_namanode_) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_namanode__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_namanode__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['po_kapport_']))
           {
               $this->nmgp_cmp_readonly['po_kapport_'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['po_merk_']))
    {
        $this->nm_new_label['po_merk_'] = "Merk";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_merk_ = $this->po_merk_;
   $sStyleHidden_po_merk_ = '';
   if (isset($this->nmgp_cmp_hidden['po_merk_']) && $this->nmgp_cmp_hidden['po_merk_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_merk_']);
       $sStyleHidden_po_merk_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_merk_ = 'display: none;';
   $sStyleReadInp_po_merk_ = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["po_merk_"]) &&  $this->nmgp_cmp_readonly["po_merk_"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_merk_']);
       $sStyleReadLab_po_merk_ = '';
       $sStyleReadInp_po_merk_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_merk_']) && $this->nmgp_cmp_hidden['po_merk_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_merk_" value="<?php echo $this->form_encode_input($po_merk_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_merk__label" id="hidden_field_label_po_merk_" style="<?php echo $sStyleHidden_po_merk_; ?>"><span id="id_label_po_merk_"><?php echo $this->nm_new_label['po_merk_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_merk__line" id="hidden_field_data_po_merk_" style="<?php echo $sStyleHidden_po_merk_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_merk__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["po_merk_"]) &&  $this->nmgp_cmp_readonly["po_merk_"] == "on")) { 

 ?>
<input type="hidden" name="po_merk_" value="<?php echo $this->form_encode_input($po_merk_) . "\"><span id=\"id_ajax_label_po_merk_\">" . $po_merk_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_po_merk_" class="sc-ui-readonly-po_merk_ css_po_merk__line" style="<?php echo $sStyleReadLab_po_merk_; ?>"><?php echo $this->form_encode_input($this->po_merk_); ?></span><span id="id_read_off_po_merk_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_merk_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_merk__obj" style="" id="id_sc_field_po_merk_" type=text name="po_merk_" value="<?php echo $this->form_encode_input($po_merk_) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_merk__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_merk__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['po_kapport_']))
    {
        $this->nm_new_label['po_kapport_'] = "Kap. Port";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_kapport_ = $this->po_kapport_;
   $sStyleHidden_po_kapport_ = '';
   if (isset($this->nmgp_cmp_hidden['po_kapport_']) && $this->nmgp_cmp_hidden['po_kapport_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_kapport_']);
       $sStyleHidden_po_kapport_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_kapport_ = 'display: none;';
   $sStyleReadInp_po_kapport_ = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["po_kapport_"]) &&  $this->nmgp_cmp_readonly["po_kapport_"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_kapport_']);
       $sStyleReadLab_po_kapport_ = '';
       $sStyleReadInp_po_kapport_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_kapport_']) && $this->nmgp_cmp_hidden['po_kapport_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_kapport_" value="<?php echo $this->form_encode_input($po_kapport_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_kapport__label" id="hidden_field_label_po_kapport_" style="<?php echo $sStyleHidden_po_kapport_; ?>"><span id="id_label_po_kapport_"><?php echo $this->nm_new_label['po_kapport_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_kapport__line" id="hidden_field_data_po_kapport_" style="<?php echo $sStyleHidden_po_kapport_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_kapport__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["po_kapport_"]) &&  $this->nmgp_cmp_readonly["po_kapport_"] == "on")) { 

 ?>
<input type="hidden" name="po_kapport_" value="<?php echo $this->form_encode_input($po_kapport_) . "\"><span id=\"id_ajax_label_po_kapport_\">" . $po_kapport_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_po_kapport_" class="sc-ui-readonly-po_kapport_ css_po_kapport__line" style="<?php echo $sStyleReadLab_po_kapport_; ?>"><?php echo $this->form_encode_input($this->po_kapport_); ?></span><span id="id_read_off_po_kapport_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_kapport_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_kapport__obj" style="" id="id_sc_field_po_kapport_" type=text name="po_kapport_" value="<?php echo $this->form_encode_input($po_kapport_) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['po_kapport_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['po_kapport_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_kapport__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_kapport__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['po_alamatlokasi_']))
    {
        $this->nm_new_label['po_alamatlokasi_'] = "Alamat ODP";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_alamatlokasi_ = $this->po_alamatlokasi_;
   $sStyleHidden_po_alamatlokasi_ = '';
   if (isset($this->nmgp_cmp_hidden['po_alamatlokasi_']) && $this->nmgp_cmp_hidden['po_alamatlokasi_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_alamatlokasi_']);
       $sStyleHidden_po_alamatlokasi_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_alamatlokasi_ = 'display: none;';
   $sStyleReadInp_po_alamatlokasi_ = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['po_alamatlokasi_']) && $this->nmgp_cmp_readonly['po_alamatlokasi_'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_alamatlokasi_']);
       $sStyleReadLab_po_alamatlokasi_ = '';
       $sStyleReadInp_po_alamatlokasi_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_alamatlokasi_']) && $this->nmgp_cmp_hidden['po_alamatlokasi_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_alamatlokasi_" value="<?php echo $this->form_encode_input($po_alamatlokasi_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_alamatlokasi__label" id="hidden_field_label_po_alamatlokasi_" style="<?php echo $sStyleHidden_po_alamatlokasi_; ?>"><span id="id_label_po_alamatlokasi_"><?php echo $this->nm_new_label['po_alamatlokasi_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_alamatlokasi__line" id="hidden_field_data_po_alamatlokasi_" style="<?php echo $sStyleHidden_po_alamatlokasi_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_alamatlokasi__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["po_alamatlokasi_"]) &&  $this->nmgp_cmp_readonly["po_alamatlokasi_"] == "on") { 

 ?>
<input type="hidden" name="po_alamatlokasi_" value="<?php echo $this->form_encode_input($po_alamatlokasi_) . "\">" . $po_alamatlokasi_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_po_alamatlokasi_" class="sc-ui-readonly-po_alamatlokasi_ css_po_alamatlokasi__line" style="<?php echo $sStyleReadLab_po_alamatlokasi_; ?>"><?php echo $this->form_encode_input($this->po_alamatlokasi_); ?></span><span id="id_read_off_po_alamatlokasi_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_alamatlokasi_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_alamatlokasi__obj" style="" id="id_sc_field_po_alamatlokasi_" type=text name="po_alamatlokasi_" value="<?php echo $this->form_encode_input($po_alamatlokasi_) ?>"
 size=60 maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_alamatlokasi__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_alamatlokasi__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['po_latitude_']))
    {
        $this->nm_new_label['po_latitude_'] = "Latitude";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_latitude_ = $this->po_latitude_;
   $sStyleHidden_po_latitude_ = '';
   if (isset($this->nmgp_cmp_hidden['po_latitude_']) && $this->nmgp_cmp_hidden['po_latitude_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_latitude_']);
       $sStyleHidden_po_latitude_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_latitude_ = 'display: none;';
   $sStyleReadInp_po_latitude_ = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['po_latitude_']) && $this->nmgp_cmp_readonly['po_latitude_'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_latitude_']);
       $sStyleReadLab_po_latitude_ = '';
       $sStyleReadInp_po_latitude_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_latitude_']) && $this->nmgp_cmp_hidden['po_latitude_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_latitude_" value="<?php echo $this->form_encode_input($po_latitude_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_latitude__label" id="hidden_field_label_po_latitude_" style="<?php echo $sStyleHidden_po_latitude_; ?>"><span id="id_label_po_latitude_"><?php echo $this->nm_new_label['po_latitude_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_latitude__line" id="hidden_field_data_po_latitude_" style="<?php echo $sStyleHidden_po_latitude_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_latitude__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["po_latitude_"]) &&  $this->nmgp_cmp_readonly["po_latitude_"] == "on") { 

 ?>
<input type="hidden" name="po_latitude_" value="<?php echo $this->form_encode_input($po_latitude_) . "\">" . $po_latitude_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_po_latitude_" class="sc-ui-readonly-po_latitude_ css_po_latitude__line" style="<?php echo $sStyleReadLab_po_latitude_; ?>"><?php echo $this->form_encode_input($this->po_latitude_); ?></span><span id="id_read_off_po_latitude_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_latitude_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_latitude__obj" style="" id="id_sc_field_po_latitude_" type=text name="po_latitude_" value="<?php echo $this->form_encode_input($po_latitude_) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_latitude__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_latitude__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['po_longitude_']))
    {
        $this->nm_new_label['po_longitude_'] = "Longitude";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_longitude_ = $this->po_longitude_;
   $sStyleHidden_po_longitude_ = '';
   if (isset($this->nmgp_cmp_hidden['po_longitude_']) && $this->nmgp_cmp_hidden['po_longitude_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_longitude_']);
       $sStyleHidden_po_longitude_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_longitude_ = 'display: none;';
   $sStyleReadInp_po_longitude_ = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['po_longitude_']) && $this->nmgp_cmp_readonly['po_longitude_'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_longitude_']);
       $sStyleReadLab_po_longitude_ = '';
       $sStyleReadInp_po_longitude_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_longitude_']) && $this->nmgp_cmp_hidden['po_longitude_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_longitude_" value="<?php echo $this->form_encode_input($po_longitude_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_longitude__label" id="hidden_field_label_po_longitude_" style="<?php echo $sStyleHidden_po_longitude_; ?>"><span id="id_label_po_longitude_"><?php echo $this->nm_new_label['po_longitude_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_longitude__line" id="hidden_field_data_po_longitude_" style="<?php echo $sStyleHidden_po_longitude_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_longitude__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["po_longitude_"]) &&  $this->nmgp_cmp_readonly["po_longitude_"] == "on") { 

 ?>
<input type="hidden" name="po_longitude_" value="<?php echo $this->form_encode_input($po_longitude_) . "\">" . $po_longitude_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_po_longitude_" class="sc-ui-readonly-po_longitude_ css_po_longitude__line" style="<?php echo $sStyleReadLab_po_longitude_; ?>"><?php echo $this->form_encode_input($this->po_longitude_); ?></span><span id="id_read_off_po_longitude_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_longitude_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_longitude__obj" style="" id="id_sc_field_po_longitude_" type=text name="po_longitude_" value="<?php echo $this->form_encode_input($po_longitude_) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_longitude__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_longitude__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['po_nosp_']))
    {
        $this->nm_new_label['po_nosp_'] = "NoSP";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_nosp_ = $this->po_nosp_;
   $sStyleHidden_po_nosp_ = '';
   if (isset($this->nmgp_cmp_hidden['po_nosp_']) && $this->nmgp_cmp_hidden['po_nosp_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_nosp_']);
       $sStyleHidden_po_nosp_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_nosp_ = 'display: none;';
   $sStyleReadInp_po_nosp_ = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['po_nosp_']) && $this->nmgp_cmp_readonly['po_nosp_'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_nosp_']);
       $sStyleReadLab_po_nosp_ = '';
       $sStyleReadInp_po_nosp_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_nosp_']) && $this->nmgp_cmp_hidden['po_nosp_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_nosp_" value="<?php echo $this->form_encode_input($po_nosp_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_nosp__label" id="hidden_field_label_po_nosp_" style="<?php echo $sStyleHidden_po_nosp_; ?>"><span id="id_label_po_nosp_"><?php echo $this->nm_new_label['po_nosp_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_nosp__line" id="hidden_field_data_po_nosp_" style="<?php echo $sStyleHidden_po_nosp_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_nosp__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["po_nosp_"]) &&  $this->nmgp_cmp_readonly["po_nosp_"] == "on") { 

 ?>
<input type="hidden" name="po_nosp_" value="<?php echo $this->form_encode_input($po_nosp_) . "\">" . $po_nosp_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_po_nosp_" class="sc-ui-readonly-po_nosp_ css_po_nosp__line" style="<?php echo $sStyleReadLab_po_nosp_; ?>"><?php echo $this->form_encode_input($this->po_nosp_); ?></span><span id="id_read_off_po_nosp_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_nosp_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_nosp__obj" style="" id="id_sc_field_po_nosp_" type=text name="po_nosp_" value="<?php echo $this->form_encode_input($po_nosp_) ?>"
 size=50 maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_nosp__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_nosp__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['po_tglbast_']))
    {
        $this->nm_new_label['po_tglbast_'] = "Tgl BAST";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_tglbast_ = $this->po_tglbast_;
   $sStyleHidden_po_tglbast_ = '';
   if (isset($this->nmgp_cmp_hidden['po_tglbast_']) && $this->nmgp_cmp_hidden['po_tglbast_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_tglbast_']);
       $sStyleHidden_po_tglbast_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_tglbast_ = 'display: none;';
   $sStyleReadInp_po_tglbast_ = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['po_tglbast_']) && $this->nmgp_cmp_readonly['po_tglbast_'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_tglbast_']);
       $sStyleReadLab_po_tglbast_ = '';
       $sStyleReadInp_po_tglbast_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_tglbast_']) && $this->nmgp_cmp_hidden['po_tglbast_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_tglbast_" value="<?php echo $this->form_encode_input($po_tglbast_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_tglbast__label" id="hidden_field_label_po_tglbast_" style="<?php echo $sStyleHidden_po_tglbast_; ?>"><span id="id_label_po_tglbast_"><?php echo $this->nm_new_label['po_tglbast_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_tglbast__line" id="hidden_field_data_po_tglbast_" style="<?php echo $sStyleHidden_po_tglbast_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_tglbast__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["po_tglbast_"]) &&  $this->nmgp_cmp_readonly["po_tglbast_"] == "on") { 

 ?>
<input type="hidden" name="po_tglbast_" value="<?php echo $this->form_encode_input($po_tglbast_) . "\">" . $po_tglbast_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_po_tglbast_" class="sc-ui-readonly-po_tglbast_ css_po_tglbast__line" style="<?php echo $sStyleReadLab_po_tglbast_; ?>"><?php echo $this->form_encode_input($po_tglbast_); ?></span><span id="id_read_off_po_tglbast_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_tglbast_; ?>">
 <input class="sc-js-input scFormObjectOdd css_po_tglbast__obj" style="" id="id_sc_field_po_tglbast_" type=text name="po_tglbast_" value="<?php echo $this->form_encode_input($po_tglbast_) ?>"
 size=10 alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['po_tglbast_']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['po_tglbast_']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$tmp_form_data = $this->field_config['po_tglbast_']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<?php echo $tmp_form_data; ?></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_tglbast__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_tglbast__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['po_uraian_']))
    {
        $this->nm_new_label['po_uraian_'] = "Uraian";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $po_uraian_ = $this->po_uraian_;
   $sStyleHidden_po_uraian_ = '';
   if (isset($this->nmgp_cmp_hidden['po_uraian_']) && $this->nmgp_cmp_hidden['po_uraian_'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['po_uraian_']);
       $sStyleHidden_po_uraian_ = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_po_uraian_ = 'display: none;';
   $sStyleReadInp_po_uraian_ = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['po_uraian_']) && $this->nmgp_cmp_readonly['po_uraian_'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['po_uraian_']);
       $sStyleReadLab_po_uraian_ = '';
       $sStyleReadInp_po_uraian_ = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['po_uraian_']) && $this->nmgp_cmp_hidden['po_uraian_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="po_uraian_" value="<?php echo $this->form_encode_input($po_uraian_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_po_uraian__label" id="hidden_field_label_po_uraian_" style="<?php echo $sStyleHidden_po_uraian_; ?>"><span id="id_label_po_uraian_"><?php echo $this->nm_new_label['po_uraian_']; ?></span></TD>
    <TD class="scFormDataOdd css_po_uraian__line" id="hidden_field_data_po_uraian_" style="<?php echo $sStyleHidden_po_uraian_; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_po_uraian__line" style="vertical-align: top;padding: 0px">
<?php
$po_uraian__val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($po_uraian_));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["po_uraian_"]) &&  $this->nmgp_cmp_readonly["po_uraian_"] == "on") { 

 ?>
<input type="hidden" name="po_uraian_" value="<?php echo $this->form_encode_input($po_uraian_) . "\">" . $po_uraian__val . ""; ?>
<?php } else { ?>
<span id="id_read_on_po_uraian_" class="sc-ui-readonly-po_uraian_ css_po_uraian__line" style="<?php echo $sStyleReadLab_po_uraian_; ?>"><?php echo $this->form_encode_input($po_uraian__val); ?></span><span id="id_read_off_po_uraian_" style="white-space: nowrap;<?php echo $sStyleReadInp_po_uraian_; ?>">
 <textarea  class="sc-js-input scFormObjectOdd css_po_uraian__obj" style="white-space: pre-wrap;" name="po_uraian_" id="id_sc_field_po_uraian_" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $po_uraian_; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_po_uraian__frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_po_uraian__text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
<?php
  }
?>
</td></tr> 
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R")
{
    $NM_btn = false;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("odp_edit_inline");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("odp_edit_inline");
 parent.scAjaxDetailHeight("odp_edit_inline", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("odp_edit_inline", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("odp_edit_inline", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['odp_edit_inline']['sc_modal'])
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
