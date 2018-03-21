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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . ""); } else { echo strip_tags("Form Kontrol Closing Project"); } ?></TITLE>
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
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>project_edit_update_main_controlclose/project_edit_update_main_controlclose_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("project_edit_update_main_controlclose_sajax_js.php");
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

include_once('project_edit_update_main_controlclose_jquery.php');

?>

 var scQSInit = true;
 var scQSPos  = {};
 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['recarga'];
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
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>digita.js"> 
</script> 
<?php
 include_once("project_edit_update_main_controlclose_js0.php");
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
               action="./" 
               target="_self">
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nmgp_url_saida); ?>">
<input type="hidden" name="bok" value="OK">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="script_case_session" value="<?php  echo $this->form_encode_input(session_id()); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['project_edit_update_main_controlclose'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['project_edit_update_main_controlclose'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<?php
  if (!$this->Embutida_call && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['mostra_cab']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['mostra_cab'] != "N") && (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard'] || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['compact_mode'] || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['maximized']))
  {
?>
<tr><td>
   <TABLE width="100%" class="scFormHeader">
    <TR align="center">
     <TD style="padding: 0px">
      <TABLE style="padding: 0px; border-spacing: 0px; border-width: 0px;" width="100%">
       <TR align="center" valign="middle">
        <TD align="left" rowspan="2" class="scFormHeaderFont">
          
        </TD>
        <TD class="scFormHeaderFont">
          <?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . ""; } else { echo "Form Kontrol Closing Project"; } ?>
        </TD>
       </TR>
       <TR align="right" valign="middle">
        <TD class="scFormHeaderFont">
          
        </TD>
       </TR>
      </TABLE>
     </TD>
    </TR>
   </TABLE></td></tr>
<?php
  }
?>
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; text-align: center; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['empty_filter'] = true;
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
   if (!isset($this->nmgp_cmp_hidden['prepare']))
   {
       $this->nmgp_cmp_hidden['prepare'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['perijinan']))
   {
       $this->nmgp_cmp_hidden['perijinan'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['inst_testcomm']))
   {
       $this->nmgp_cmp_hidden['inst_testcomm'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['prepare']))
    {
        $this->nm_new_label['prepare'] = "Preparing";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $prepare = $this->prepare;
   if (!isset($this->nmgp_cmp_hidden['prepare']))
   {
       $this->nmgp_cmp_hidden['prepare'] = 'off';
   }
   $sStyleHidden_prepare = '';
   if (isset($this->nmgp_cmp_hidden['prepare']) && $this->nmgp_cmp_hidden['prepare'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['prepare']);
       $sStyleHidden_prepare = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_prepare = 'display: none;';
   $sStyleReadInp_prepare = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['prepare']) && $this->nmgp_cmp_readonly['prepare'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['prepare']);
       $sStyleReadLab_prepare = '';
       $sStyleReadInp_prepare = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['prepare']) && $this->nmgp_cmp_hidden['prepare'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="prepare" value="<?php echo $this->form_encode_input($prepare) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_prepare_label" id="hidden_field_label_prepare" style="<?php echo $sStyleHidden_prepare; ?>"><span id="id_label_prepare"><?php echo $this->nm_new_label['prepare']; ?></span></TD>
    <TD class="scFormDataOdd css_prepare_line" id="hidden_field_data_prepare" style="<?php echo $sStyleHidden_prepare; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["prepare"]) &&  $this->nmgp_cmp_readonly["prepare"] == "on") { 

 ?>
<input type="hidden" name="prepare" value="<?php echo $this->form_encode_input($prepare) . "\">" . $prepare . ""; ?>
<?php } else { ?>
<span id="id_read_on_prepare" class="sc-ui-readonly-prepare css_prepare_line" style="<?php echo $sStyleReadLab_prepare; ?>"><?php echo $this->form_encode_input($this->prepare); ?></span><span id="id_read_off_prepare" style="white-space: nowrap;<?php echo $sStyleReadInp_prepare; ?>">
 <input class="sc-js-input scFormObjectOdd css_prepare_obj" style="" id="id_sc_field_prepare" type=text name="prepare" value="<?php echo $this->form_encode_input($prepare) ?>"
 size=10 alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['prepare']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['prepare']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['perijinan']))
    {
        $this->nm_new_label['perijinan'] = "Perijinan";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $perijinan = $this->perijinan;
   if (!isset($this->nmgp_cmp_hidden['perijinan']))
   {
       $this->nmgp_cmp_hidden['perijinan'] = 'off';
   }
   $sStyleHidden_perijinan = '';
   if (isset($this->nmgp_cmp_hidden['perijinan']) && $this->nmgp_cmp_hidden['perijinan'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['perijinan']);
       $sStyleHidden_perijinan = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_perijinan = 'display: none;';
   $sStyleReadInp_perijinan = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['perijinan']) && $this->nmgp_cmp_readonly['perijinan'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['perijinan']);
       $sStyleReadLab_perijinan = '';
       $sStyleReadInp_perijinan = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['perijinan']) && $this->nmgp_cmp_hidden['perijinan'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="perijinan" value="<?php echo $this->form_encode_input($perijinan) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_perijinan_label" id="hidden_field_label_perijinan" style="<?php echo $sStyleHidden_perijinan; ?>"><span id="id_label_perijinan"><?php echo $this->nm_new_label['perijinan']; ?></span></TD>
    <TD class="scFormDataOdd css_perijinan_line" id="hidden_field_data_perijinan" style="<?php echo $sStyleHidden_perijinan; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["perijinan"]) &&  $this->nmgp_cmp_readonly["perijinan"] == "on") { 

 ?>
<input type="hidden" name="perijinan" value="<?php echo $this->form_encode_input($perijinan) . "\">" . $perijinan . ""; ?>
<?php } else { ?>
<span id="id_read_on_perijinan" class="sc-ui-readonly-perijinan css_perijinan_line" style="<?php echo $sStyleReadLab_perijinan; ?>"><?php echo $this->form_encode_input($this->perijinan); ?></span><span id="id_read_off_perijinan" style="white-space: nowrap;<?php echo $sStyleReadInp_perijinan; ?>">
 <input class="sc-js-input scFormObjectOdd css_perijinan_obj" style="" id="id_sc_field_perijinan" type=text name="perijinan" value="<?php echo $this->form_encode_input($perijinan) ?>"
 size=10 alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['perijinan']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['perijinan']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['idproject']))
           {
               $this->nmgp_cmp_readonly['idproject'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['inst_testcomm']))
    {
        $this->nm_new_label['inst_testcomm'] = "Instalasi & TestComm";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $inst_testcomm = $this->inst_testcomm;
   if (!isset($this->nmgp_cmp_hidden['inst_testcomm']))
   {
       $this->nmgp_cmp_hidden['inst_testcomm'] = 'off';
   }
   $sStyleHidden_inst_testcomm = '';
   if (isset($this->nmgp_cmp_hidden['inst_testcomm']) && $this->nmgp_cmp_hidden['inst_testcomm'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['inst_testcomm']);
       $sStyleHidden_inst_testcomm = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_inst_testcomm = 'display: none;';
   $sStyleReadInp_inst_testcomm = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['inst_testcomm']) && $this->nmgp_cmp_readonly['inst_testcomm'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['inst_testcomm']);
       $sStyleReadLab_inst_testcomm = '';
       $sStyleReadInp_inst_testcomm = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['inst_testcomm']) && $this->nmgp_cmp_hidden['inst_testcomm'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="inst_testcomm" value="<?php echo $this->form_encode_input($inst_testcomm) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_inst_testcomm_label" id="hidden_field_label_inst_testcomm" style="<?php echo $sStyleHidden_inst_testcomm; ?>"><span id="id_label_inst_testcomm"><?php echo $this->nm_new_label['inst_testcomm']; ?></span></TD>
    <TD class="scFormDataOdd css_inst_testcomm_line" id="hidden_field_data_inst_testcomm" style="<?php echo $sStyleHidden_inst_testcomm; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["inst_testcomm"]) &&  $this->nmgp_cmp_readonly["inst_testcomm"] == "on") { 

 ?>
<input type="hidden" name="inst_testcomm" value="<?php echo $this->form_encode_input($inst_testcomm) . "\">" . $inst_testcomm . ""; ?>
<?php } else { ?>
<span id="id_read_on_inst_testcomm" class="sc-ui-readonly-inst_testcomm css_inst_testcomm_line" style="<?php echo $sStyleReadLab_inst_testcomm; ?>"><?php echo $this->form_encode_input($this->inst_testcomm); ?></span><span id="id_read_off_inst_testcomm" style="white-space: nowrap;<?php echo $sStyleReadInp_inst_testcomm; ?>">
 <input class="sc-js-input scFormObjectOdd css_inst_testcomm_obj" style="" id="id_sc_field_inst_testcomm" type=text name="inst_testcomm" value="<?php echo $this->form_encode_input($inst_testcomm) ?>"
 size=10 alt="{datatype: 'integer', maxLength: 20, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['inst_testcomm']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['inst_testcomm']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['tahapanproject']))
           {
               $this->nmgp_cmp_readonly['tahapanproject'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['idproject']))
    {
        $this->nm_new_label['idproject'] = "ID Project";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $idproject = $this->idproject;
   $sStyleHidden_idproject = '';
   if (isset($this->nmgp_cmp_hidden['idproject']) && $this->nmgp_cmp_hidden['idproject'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['idproject']);
       $sStyleHidden_idproject = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_idproject = 'display: none;';
   $sStyleReadInp_idproject = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["idproject"]) &&  $this->nmgp_cmp_readonly["idproject"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['idproject']);
       $sStyleReadLab_idproject = '';
       $sStyleReadInp_idproject = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['idproject']) && $this->nmgp_cmp_hidden['idproject'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="idproject" value="<?php echo $this->form_encode_input($idproject) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_idproject_label" id="hidden_field_label_idproject" style="<?php echo $sStyleHidden_idproject; ?>"><span id="id_label_idproject"><?php echo $this->nm_new_label['idproject']; ?></span></TD>
    <TD class="scFormDataOdd css_idproject_line" id="hidden_field_data_idproject" style="<?php echo $sStyleHidden_idproject; ?>">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["idproject"]) &&  $this->nmgp_cmp_readonly["idproject"] == "on")) { 

 ?>
<input type="hidden" name="idproject" value="<?php echo $this->form_encode_input($idproject) . "\"><span id=\"id_ajax_label_idproject\">" . $idproject . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_idproject" class="sc-ui-readonly-idproject css_idproject_line" style="<?php echo $sStyleReadLab_idproject; ?>"><?php echo $this->form_encode_input($this->idproject); ?></span><span id="id_read_off_idproject" style="white-space: nowrap;<?php echo $sStyleReadInp_idproject; ?>">
 <input class="sc-js-input scFormObjectOdd css_idproject_obj" style="" id="id_sc_field_idproject" type=text name="idproject" value="<?php echo $this->form_encode_input($idproject) ?>"
 size=10 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['templateproject']))
           {
               $this->nmgp_cmp_readonly['templateproject'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['tahapanproject']))
    {
        $this->nm_new_label['tahapanproject'] = "Tahapan Project";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tahapanproject = $this->tahapanproject;
   $sStyleHidden_tahapanproject = '';
   if (isset($this->nmgp_cmp_hidden['tahapanproject']) && $this->nmgp_cmp_hidden['tahapanproject'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tahapanproject']);
       $sStyleHidden_tahapanproject = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tahapanproject = 'display: none;';
   $sStyleReadInp_tahapanproject = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["tahapanproject"]) &&  $this->nmgp_cmp_readonly["tahapanproject"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tahapanproject']);
       $sStyleReadLab_tahapanproject = '';
       $sStyleReadInp_tahapanproject = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tahapanproject']) && $this->nmgp_cmp_hidden['tahapanproject'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tahapanproject" value="<?php echo $this->form_encode_input($tahapanproject) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tahapanproject_label" id="hidden_field_label_tahapanproject" style="<?php echo $sStyleHidden_tahapanproject; ?>"><span id="id_label_tahapanproject"><?php echo $this->nm_new_label['tahapanproject']; ?></span></TD>
    <TD class="scFormDataOdd css_tahapanproject_line" id="hidden_field_data_tahapanproject" style="<?php echo $sStyleHidden_tahapanproject; ?>">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["tahapanproject"]) &&  $this->nmgp_cmp_readonly["tahapanproject"] == "on")) { 

 ?>
<input type="hidden" name="tahapanproject" value="<?php echo $this->form_encode_input($tahapanproject) . "\"><span id=\"id_ajax_label_tahapanproject\">" . $tahapanproject . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_tahapanproject" class="sc-ui-readonly-tahapanproject css_tahapanproject_line" style="<?php echo $sStyleReadLab_tahapanproject; ?>"><?php echo $this->form_encode_input($this->tahapanproject); ?></span><span id="id_read_off_tahapanproject" style="white-space: nowrap;<?php echo $sStyleReadInp_tahapanproject; ?>">
 <input class="sc-js-input scFormObjectOdd css_tahapanproject_obj" style="" id="id_sc_field_tahapanproject" type=text name="tahapanproject" value="<?php echo $this->form_encode_input($tahapanproject) ?>"
 size=10 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['templateproject']))
    {
        $this->nm_new_label['templateproject'] = "Template Project";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $templateproject = $this->templateproject;
   $sStyleHidden_templateproject = '';
   if (isset($this->nmgp_cmp_hidden['templateproject']) && $this->nmgp_cmp_hidden['templateproject'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['templateproject']);
       $sStyleHidden_templateproject = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_templateproject = 'display: none;';
   $sStyleReadInp_templateproject = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["templateproject"]) &&  $this->nmgp_cmp_readonly["templateproject"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['templateproject']);
       $sStyleReadLab_templateproject = '';
       $sStyleReadInp_templateproject = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['templateproject']) && $this->nmgp_cmp_hidden['templateproject'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="templateproject" value="<?php echo $this->form_encode_input($templateproject) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_templateproject_label" id="hidden_field_label_templateproject" style="<?php echo $sStyleHidden_templateproject; ?>"><span id="id_label_templateproject"><?php echo $this->nm_new_label['templateproject']; ?></span></TD>
    <TD class="scFormDataOdd css_templateproject_line" id="hidden_field_data_templateproject" style="<?php echo $sStyleHidden_templateproject; ?>">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["templateproject"]) &&  $this->nmgp_cmp_readonly["templateproject"] == "on")) { 

 ?>
<input type="hidden" name="templateproject" value="<?php echo $this->form_encode_input($templateproject) . "\"><span id=\"id_ajax_label_templateproject\">" . $templateproject . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_templateproject" class="sc-ui-readonly-templateproject css_templateproject_line" style="<?php echo $sStyleReadLab_templateproject; ?>"><?php echo $this->form_encode_input($this->templateproject); ?></span><span id="id_read_off_templateproject" style="white-space: nowrap;<?php echo $sStyleReadInp_templateproject; ?>">
 <input class="sc-js-input scFormObjectOdd css_templateproject_obj" style="" id="id_sc_field_templateproject" type=text name="templateproject" value="<?php echo $this->form_encode_input($templateproject) ?>"
 size=10 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } ?>
   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
<?php
  }
?>
</td></tr> 
<tr><td>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
    $NM_btn = false;
?>
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
        $sCondStyle = ($this->nmgp_botoes['ok'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bok", "nm_atualiza('alterar');", "nm_atualiza('alterar');", "sub_form_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
?>
       
<?php
           if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?>
       
<?php
           if (($nm_apl_dependente != 1) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "nm_saida_glo(); return false;", "nm_saida_glo(); return false;", "Bsair_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?>
       
<?php
           if (($nm_apl_dependente == 1) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "nm_saida_glo(); return false;", "nm_saida_glo(); return false;", "Bsair_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?>
            </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("project_edit_update_main_controlclose");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("project_edit_update_main_controlclose");
 parent.scAjaxDetailHeight("project_edit_update_main_controlclose", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("project_edit_update_main_controlclose", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("project_edit_update_main_controlclose", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_controlclose']['sc_modal'])
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
<script type="text/javascript">
$(function() {
 $("#sc-id-mobile-in").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("in");
 });
 $("#sc-id-mobile-out").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("out");
 });
});
function scMobileDisplayControl(sOption) {
 $("#sc-id-mobile-control").val(sOption);
 nm_atualiza("recarga_mobile");
}
</script>
<?php
       if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'])
       {
?>
<span id="sc-id-mobile-in"><?php echo $this->Ini->Nm_lang['lang_version_mobile']; ?></span>
<?php
       }
?>
</body> 
</html> 
