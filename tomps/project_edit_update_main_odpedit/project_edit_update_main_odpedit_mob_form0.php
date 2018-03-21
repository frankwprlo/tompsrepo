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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("Master ODP"); } else { echo strip_tags("Master ODP"); } ?></TITLE>
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>project_edit_update_main_odpedit/project_edit_update_main_odpedit_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("project_edit_update_main_odpedit_mob_sajax_js.php");
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
    if (document.getElementById("sc_b_summary_b")) document.getElementById("sc_b_summary_b").innerHTML = nm_sumario;
}
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}
<?php

include_once('project_edit_update_main_odpedit_mob_jquery.php');

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
    if ("hidden_bloco_1" == block_id) {
      scAjaxDetailHeight("odp_master_edit_detail", $($("#nmsc_iframe_liga_odp_master_edit_detail")[0].contentWindow.document).innerHeight());
    }
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['recarga'];
}
?>
<body class="scFormPage" style="<?php echo $str_iframe_body; ?>">
<?php

if (isset($_SESSION['scriptcase']['project_edit_update_main_odpedit']['error_buffer']) && '' != $_SESSION['scriptcase']['project_edit_update_main_odpedit']['error_buffer'])
{
    echo $_SESSION['scriptcase']['project_edit_update_main_odpedit']['error_buffer'];
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
 include_once("project_edit_update_main_odpedit_mob_js0.php");
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
               action="project_edit_update_main_odpedit_mob.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['insert_validation']; ?>">
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
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['project_edit_update_main_odpedit_mob'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['project_edit_update_main_odpedit_mob'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R")
{
    $NM_btn = false;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "nm_move ('novo');", "nm_move ('novo');", "sc_b_new_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "balterar", "nm_atualiza ('alterar');", "nm_atualiza ('alterar');", "sc_b_upd_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "nm_atualiza ('excluir');", "nm_atualiza ('excluir');", "sc_b_del_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
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
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['empty_filter'] = true;
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
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['tpmo_id']))
           {
               $this->nmgp_cmp_readonly['tpmo_id'] = 'on';
           }
?>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tpmo_id']))
    {
        $this->nm_new_label['tpmo_id'] = "IDTable";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tpmo_id = $this->tpmo_id;
   $sStyleHidden_tpmo_id = '';
   if (isset($this->nmgp_cmp_hidden['tpmo_id']) && $this->nmgp_cmp_hidden['tpmo_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tpmo_id']);
       $sStyleHidden_tpmo_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tpmo_id = 'display: none;';
   $sStyleReadInp_tpmo_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["tpmo_id"]) &&  $this->nmgp_cmp_readonly["tpmo_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tpmo_id']);
       $sStyleReadLab_tpmo_id = '';
       $sStyleReadInp_tpmo_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tpmo_id']) && $this->nmgp_cmp_hidden['tpmo_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_id" value="<?php echo $this->form_encode_input($tpmo_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOdd css_tpmo_id_line" id="hidden_field_data_tpmo_id" style="<?php echo $sStyleHidden_tpmo_id; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tpmo_id_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tpmo_id_label"><span id="id_label_tpmo_id"><?php echo $this->nm_new_label['tpmo_id']; ?></span></span><br><span id="id_read_on_tpmo_id" class="css_tpmo_id_line" style="<?php echo $sStyleReadLab_tpmo_id; ?>"><?php echo $this->form_encode_input($this->tpmo_id); ?></span><span id="id_read_off_tpmo_id" style="<?php echo $sStyleReadInp_tpmo_id; ?>"><input type="hidden" name="tpmo_id" value="<?php echo $this->form_encode_input($tpmo_id) . "\">"?><span id="id_ajax_label_tpmo_id"><?php echo nl2br($tpmo_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_id_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tpmo_projectid']))
    {
        $this->nm_new_label['tpmo_projectid'] = "Project ID";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tpmo_projectid = $this->tpmo_projectid;
   $sStyleHidden_tpmo_projectid = '';
   if (isset($this->nmgp_cmp_hidden['tpmo_projectid']) && $this->nmgp_cmp_hidden['tpmo_projectid'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tpmo_projectid']);
       $sStyleHidden_tpmo_projectid = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tpmo_projectid = 'display: none;';
   $sStyleReadInp_tpmo_projectid = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tpmo_projectid']) && $this->nmgp_cmp_readonly['tpmo_projectid'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tpmo_projectid']);
       $sStyleReadLab_tpmo_projectid = '';
       $sStyleReadInp_tpmo_projectid = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tpmo_projectid']) && $this->nmgp_cmp_hidden['tpmo_projectid'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_projectid" value="<?php echo $this->form_encode_input($tpmo_projectid) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tpmo_projectid_line" id="hidden_field_data_tpmo_projectid" style="<?php echo $sStyleHidden_tpmo_projectid; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tpmo_projectid_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tpmo_projectid_label"><span id="id_label_tpmo_projectid"><?php echo $this->nm_new_label['tpmo_projectid']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_projectid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_projectid'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_projectid"]) &&  $this->nmgp_cmp_readonly["tpmo_projectid"] == "on") { 

 ?>
<input type="hidden" name="tpmo_projectid" value="<?php echo $this->form_encode_input($tpmo_projectid) . "\">" . $tpmo_projectid . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_projectid" class="sc-ui-readonly-tpmo_projectid css_tpmo_projectid_line" style="<?php echo $sStyleReadLab_tpmo_projectid; ?>"><?php echo $this->form_encode_input($this->tpmo_projectid); ?></span><span id="id_read_off_tpmo_projectid" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_projectid; ?>">
 <input class="sc-js-input scFormObjectOdd css_tpmo_projectid_obj" style="" id="id_sc_field_tpmo_projectid" type=text name="tpmo_projectid" value="<?php echo $this->form_encode_input($tpmo_projectid) ?>"
 size=22 maxlength=22 alt="{datatype: 'text', maxLength: 22, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_projectid_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_projectid_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tpmo_namanode']))
    {
        $this->nm_new_label['tpmo_namanode'] = "Nama Node";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tpmo_namanode = $this->tpmo_namanode;
   $sStyleHidden_tpmo_namanode = '';
   if (isset($this->nmgp_cmp_hidden['tpmo_namanode']) && $this->nmgp_cmp_hidden['tpmo_namanode'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tpmo_namanode']);
       $sStyleHidden_tpmo_namanode = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tpmo_namanode = 'display: none;';
   $sStyleReadInp_tpmo_namanode = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tpmo_namanode']) && $this->nmgp_cmp_readonly['tpmo_namanode'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tpmo_namanode']);
       $sStyleReadLab_tpmo_namanode = '';
       $sStyleReadInp_tpmo_namanode = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tpmo_namanode']) && $this->nmgp_cmp_hidden['tpmo_namanode'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_namanode" value="<?php echo $this->form_encode_input($tpmo_namanode) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tpmo_namanode_line" id="hidden_field_data_tpmo_namanode" style="<?php echo $sStyleHidden_tpmo_namanode; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tpmo_namanode_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tpmo_namanode_label"><span id="id_label_tpmo_namanode"><?php echo $this->nm_new_label['tpmo_namanode']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_namanode']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_namanode'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_namanode"]) &&  $this->nmgp_cmp_readonly["tpmo_namanode"] == "on") { 

 ?>
<input type="hidden" name="tpmo_namanode" value="<?php echo $this->form_encode_input($tpmo_namanode) . "\">" . $tpmo_namanode . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_namanode" class="sc-ui-readonly-tpmo_namanode css_tpmo_namanode_line" style="<?php echo $sStyleReadLab_tpmo_namanode; ?>"><?php echo $this->form_encode_input($this->tpmo_namanode); ?></span><span id="id_read_off_tpmo_namanode" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_namanode; ?>">
 <input class="sc-js-input scFormObjectOdd css_tpmo_namanode_obj" style="" id="id_sc_field_tpmo_namanode" type=text name="tpmo_namanode" value="<?php echo $this->form_encode_input($tpmo_namanode) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_namanode_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_namanode_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tpmo_awal']))
    {
        $this->nm_new_label['tpmo_awal'] = "Nomor Awal";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tpmo_awal = $this->tpmo_awal;
   $sStyleHidden_tpmo_awal = '';
   if (isset($this->nmgp_cmp_hidden['tpmo_awal']) && $this->nmgp_cmp_hidden['tpmo_awal'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tpmo_awal']);
       $sStyleHidden_tpmo_awal = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tpmo_awal = 'display: none;';
   $sStyleReadInp_tpmo_awal = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tpmo_awal']) && $this->nmgp_cmp_readonly['tpmo_awal'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tpmo_awal']);
       $sStyleReadLab_tpmo_awal = '';
       $sStyleReadInp_tpmo_awal = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tpmo_awal']) && $this->nmgp_cmp_hidden['tpmo_awal'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_awal" value="<?php echo $this->form_encode_input($tpmo_awal) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tpmo_awal_line" id="hidden_field_data_tpmo_awal" style="<?php echo $sStyleHidden_tpmo_awal; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tpmo_awal_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tpmo_awal_label"><span id="id_label_tpmo_awal"><?php echo $this->nm_new_label['tpmo_awal']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_awal']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_awal'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_awal"]) &&  $this->nmgp_cmp_readonly["tpmo_awal"] == "on") { 

 ?>
<input type="hidden" name="tpmo_awal" value="<?php echo $this->form_encode_input($tpmo_awal) . "\">" . $tpmo_awal . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_awal" class="sc-ui-readonly-tpmo_awal css_tpmo_awal_line" style="<?php echo $sStyleReadLab_tpmo_awal; ?>"><?php echo $this->form_encode_input($this->tpmo_awal); ?></span><span id="id_read_off_tpmo_awal" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_awal; ?>">
 <input class="sc-js-input scFormObjectOdd css_tpmo_awal_obj" style="" id="id_sc_field_tpmo_awal" type=text name="tpmo_awal" value="<?php echo $this->form_encode_input($tpmo_awal) ?>"
 size=6 maxlength=6 alt="{datatype: 'text', maxLength: 6, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_awal_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_awal_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tpmo_jmlodp']))
    {
        $this->nm_new_label['tpmo_jmlodp'] = "Jml ODP";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tpmo_jmlodp = $this->tpmo_jmlodp;
   $sStyleHidden_tpmo_jmlodp = '';
   if (isset($this->nmgp_cmp_hidden['tpmo_jmlodp']) && $this->nmgp_cmp_hidden['tpmo_jmlodp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tpmo_jmlodp']);
       $sStyleHidden_tpmo_jmlodp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tpmo_jmlodp = 'display: none;';
   $sStyleReadInp_tpmo_jmlodp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tpmo_jmlodp']) && $this->nmgp_cmp_readonly['tpmo_jmlodp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tpmo_jmlodp']);
       $sStyleReadLab_tpmo_jmlodp = '';
       $sStyleReadInp_tpmo_jmlodp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tpmo_jmlodp']) && $this->nmgp_cmp_hidden['tpmo_jmlodp'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_jmlodp" value="<?php echo $this->form_encode_input($tpmo_jmlodp) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tpmo_jmlodp_line" id="hidden_field_data_tpmo_jmlodp" style="<?php echo $sStyleHidden_tpmo_jmlodp; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tpmo_jmlodp_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tpmo_jmlodp_label"><span id="id_label_tpmo_jmlodp"><?php echo $this->nm_new_label['tpmo_jmlodp']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_jmlodp']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_jmlodp'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_jmlodp"]) &&  $this->nmgp_cmp_readonly["tpmo_jmlodp"] == "on") { 

 ?>
<input type="hidden" name="tpmo_jmlodp" value="<?php echo $this->form_encode_input($tpmo_jmlodp) . "\">" . $tpmo_jmlodp . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_jmlodp" class="sc-ui-readonly-tpmo_jmlodp css_tpmo_jmlodp_line" style="<?php echo $sStyleReadLab_tpmo_jmlodp; ?>"><?php echo $this->form_encode_input($this->tpmo_jmlodp); ?></span><span id="id_read_off_tpmo_jmlodp" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_jmlodp; ?>">
 <input class="sc-js-input scFormObjectOdd css_tpmo_jmlodp_obj" style="" id="id_sc_field_tpmo_jmlodp" type=text name="tpmo_jmlodp" value="<?php echo $this->form_encode_input($tpmo_jmlodp) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tpmo_jmlodp']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tpmo_jmlodp']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_jmlodp_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_jmlodp_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tpmo_akhir']))
    {
        $this->nm_new_label['tpmo_akhir'] = "Nomor Akhir";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tpmo_akhir = $this->tpmo_akhir;
   $sStyleHidden_tpmo_akhir = '';
   if (isset($this->nmgp_cmp_hidden['tpmo_akhir']) && $this->nmgp_cmp_hidden['tpmo_akhir'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tpmo_akhir']);
       $sStyleHidden_tpmo_akhir = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tpmo_akhir = 'display: none;';
   $sStyleReadInp_tpmo_akhir = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tpmo_akhir']) && $this->nmgp_cmp_readonly['tpmo_akhir'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tpmo_akhir']);
       $sStyleReadLab_tpmo_akhir = '';
       $sStyleReadInp_tpmo_akhir = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tpmo_akhir']) && $this->nmgp_cmp_hidden['tpmo_akhir'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_akhir" value="<?php echo $this->form_encode_input($tpmo_akhir) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tpmo_akhir_line" id="hidden_field_data_tpmo_akhir" style="<?php echo $sStyleHidden_tpmo_akhir; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tpmo_akhir_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tpmo_akhir_label"><span id="id_label_tpmo_akhir"><?php echo $this->nm_new_label['tpmo_akhir']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_akhir']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_akhir'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_akhir"]) &&  $this->nmgp_cmp_readonly["tpmo_akhir"] == "on") { 

 ?>
<input type="hidden" name="tpmo_akhir" value="<?php echo $this->form_encode_input($tpmo_akhir) . "\">" . $tpmo_akhir . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_akhir" class="sc-ui-readonly-tpmo_akhir css_tpmo_akhir_line" style="<?php echo $sStyleReadLab_tpmo_akhir; ?>"><?php echo $this->form_encode_input($this->tpmo_akhir); ?></span><span id="id_read_off_tpmo_akhir" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_akhir; ?>">
 <input class="sc-js-input scFormObjectOdd css_tpmo_akhir_obj" style="" id="id_sc_field_tpmo_akhir" type=text name="tpmo_akhir" value="<?php echo $this->form_encode_input($tpmo_akhir) ?>"
 size=6 maxlength=6 alt="{datatype: 'text', maxLength: 6, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_akhir_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_akhir_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tpmo_merk']))
    {
        $this->nm_new_label['tpmo_merk'] = "Merk";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tpmo_merk = $this->tpmo_merk;
   $sStyleHidden_tpmo_merk = '';
   if (isset($this->nmgp_cmp_hidden['tpmo_merk']) && $this->nmgp_cmp_hidden['tpmo_merk'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tpmo_merk']);
       $sStyleHidden_tpmo_merk = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tpmo_merk = 'display: none;';
   $sStyleReadInp_tpmo_merk = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tpmo_merk']) && $this->nmgp_cmp_readonly['tpmo_merk'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tpmo_merk']);
       $sStyleReadLab_tpmo_merk = '';
       $sStyleReadInp_tpmo_merk = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tpmo_merk']) && $this->nmgp_cmp_hidden['tpmo_merk'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_merk" value="<?php echo $this->form_encode_input($tpmo_merk) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tpmo_merk_line" id="hidden_field_data_tpmo_merk" style="<?php echo $sStyleHidden_tpmo_merk; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tpmo_merk_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tpmo_merk_label"><span id="id_label_tpmo_merk"><?php echo $this->nm_new_label['tpmo_merk']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_merk"]) &&  $this->nmgp_cmp_readonly["tpmo_merk"] == "on") { 

 ?>
<input type="hidden" name="tpmo_merk" value="<?php echo $this->form_encode_input($tpmo_merk) . "\">" . $tpmo_merk . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_merk" class="sc-ui-readonly-tpmo_merk css_tpmo_merk_line" style="<?php echo $sStyleReadLab_tpmo_merk; ?>"><?php echo $this->form_encode_input($this->tpmo_merk); ?></span><span id="id_read_off_tpmo_merk" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_merk; ?>">
 <input class="sc-js-input scFormObjectOdd css_tpmo_merk_obj" style="" id="id_sc_field_tpmo_merk" type=text name="tpmo_merk" value="<?php echo $this->form_encode_input($tpmo_merk) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_merk_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_merk_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tpmo_kapport']))
    {
        $this->nm_new_label['tpmo_kapport'] = "Kap. Port";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tpmo_kapport = $this->tpmo_kapport;
   $sStyleHidden_tpmo_kapport = '';
   if (isset($this->nmgp_cmp_hidden['tpmo_kapport']) && $this->nmgp_cmp_hidden['tpmo_kapport'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tpmo_kapport']);
       $sStyleHidden_tpmo_kapport = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tpmo_kapport = 'display: none;';
   $sStyleReadInp_tpmo_kapport = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tpmo_kapport']) && $this->nmgp_cmp_readonly['tpmo_kapport'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tpmo_kapport']);
       $sStyleReadLab_tpmo_kapport = '';
       $sStyleReadInp_tpmo_kapport = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tpmo_kapport']) && $this->nmgp_cmp_hidden['tpmo_kapport'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_kapport" value="<?php echo $this->form_encode_input($tpmo_kapport) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tpmo_kapport_line" id="hidden_field_data_tpmo_kapport" style="<?php echo $sStyleHidden_tpmo_kapport; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tpmo_kapport_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tpmo_kapport_label"><span id="id_label_tpmo_kapport"><?php echo $this->nm_new_label['tpmo_kapport']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_kapport']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_kapport'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_kapport"]) &&  $this->nmgp_cmp_readonly["tpmo_kapport"] == "on") { 

 ?>
<input type="hidden" name="tpmo_kapport" value="<?php echo $this->form_encode_input($tpmo_kapport) . "\">" . $tpmo_kapport . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_kapport" class="sc-ui-readonly-tpmo_kapport css_tpmo_kapport_line" style="<?php echo $sStyleReadLab_tpmo_kapport; ?>"><?php echo $this->form_encode_input($this->tpmo_kapport); ?></span><span id="id_read_off_tpmo_kapport" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_kapport; ?>">
 <input class="sc-js-input scFormObjectOdd css_tpmo_kapport_obj" style="" id="id_sc_field_tpmo_kapport" type=text name="tpmo_kapport" value="<?php echo $this->form_encode_input($tpmo_kapport) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tpmo_kapport']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tpmo_kapport']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_kapport_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_kapport_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tpmo_nosp']))
    {
        $this->nm_new_label['tpmo_nosp'] = "NoSP";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tpmo_nosp = $this->tpmo_nosp;
   $sStyleHidden_tpmo_nosp = '';
   if (isset($this->nmgp_cmp_hidden['tpmo_nosp']) && $this->nmgp_cmp_hidden['tpmo_nosp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tpmo_nosp']);
       $sStyleHidden_tpmo_nosp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tpmo_nosp = 'display: none;';
   $sStyleReadInp_tpmo_nosp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tpmo_nosp']) && $this->nmgp_cmp_readonly['tpmo_nosp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tpmo_nosp']);
       $sStyleReadLab_tpmo_nosp = '';
       $sStyleReadInp_tpmo_nosp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tpmo_nosp']) && $this->nmgp_cmp_hidden['tpmo_nosp'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tpmo_nosp" value="<?php echo $this->form_encode_input($tpmo_nosp) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tpmo_nosp_line" id="hidden_field_data_tpmo_nosp" style="<?php echo $sStyleHidden_tpmo_nosp; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tpmo_nosp_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tpmo_nosp_label"><span id="id_label_tpmo_nosp"><?php echo $this->nm_new_label['tpmo_nosp']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tpmo_nosp"]) &&  $this->nmgp_cmp_readonly["tpmo_nosp"] == "on") { 

 ?>
<input type="hidden" name="tpmo_nosp" value="<?php echo $this->form_encode_input($tpmo_nosp) . "\">" . $tpmo_nosp . ""; ?>
<?php } else { ?>
<span id="id_read_on_tpmo_nosp" class="sc-ui-readonly-tpmo_nosp css_tpmo_nosp_line" style="<?php echo $sStyleReadLab_tpmo_nosp; ?>"><?php echo $this->form_encode_input($this->tpmo_nosp); ?></span><span id="id_read_off_tpmo_nosp" style="white-space: nowrap;<?php echo $sStyleReadInp_tpmo_nosp; ?>">
 <input class="sc-js-input scFormObjectOdd css_tpmo_nosp_obj" style="" id="id_sc_field_tpmo_nosp" type=text name="tpmo_nosp" value="<?php echo $this->form_encode_input($tpmo_nosp) ?>"
 size=50 maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tpmo_nosp_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tpmo_nosp_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_tpmo_nosp_dumb = ('' == $sStyleHidden_tpmo_nosp) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_tpmo_nosp_dumb" style="<?php echo $sStyleHidden_tpmo_nosp_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_1"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_1"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['detail']))
    {
        $this->nm_new_label['detail'] = "ODP Detail";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $detail = $this->detail;
   $sStyleHidden_detail = '';
   if (isset($this->nmgp_cmp_hidden['detail']) && $this->nmgp_cmp_hidden['detail'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['detail']);
       $sStyleHidden_detail = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_detail = 'display: none;';
   $sStyleReadInp_detail = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['detail']) && $this->nmgp_cmp_readonly['detail'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['detail']);
       $sStyleReadLab_detail = '';
       $sStyleReadInp_detail = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['detail']) && $this->nmgp_cmp_hidden['detail'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="detail" value="<?php echo $this->form_encode_input($detail) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_detail_line" id="hidden_field_data_detail" style="<?php echo $sStyleHidden_detail; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td width="100%" class="scFormDataFontOdd css_detail_line" style="vertical-align: top;padding: 0px">
<?php
 if (isset($_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_detail'] ]) && '' != $_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_detail'] ]) {
     $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] = $_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_detail'] ];
 }
 else {
     $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] = $this->Ini->sc_page;
 }
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_proc']  = false;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_form']  = true;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_call']  = true;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_multi'] = false;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_liga_form_insert'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_liga_form_update'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_liga_form_delete'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_liga_form_btn_nav'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_liga_grid_edit'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_liga_grid_edit_link'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_liga_qtd_reg'] = '10';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_liga_tp_pag'] = 'parcial';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_parms'] = "var_projectid*scin" . $this->nmgp_dados_form['tpmo_projectid'] . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scout";
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['foreign_key']['po_tpmoid'] = $this->nmgp_dados_form['tpmo_id'];
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['foreign_key']['po_idproject'] = $this->nmgp_dados_form['tpmo_projectid'];
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['where_filter'] = "PO_TPMOID = " . $this->nmgp_dados_form['tpmo_id'] . " AND PO_IDPROJECT = " . $this->nmgp_dados_form['tpmo_projectid'] . "";
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['where_detal']  = "PO_TPMOID = " . $this->nmgp_dados_form['tpmo_id'] . " AND PO_IDPROJECT = " . $this->nmgp_dados_form['tpmo_projectid'] . "";
 if ($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['project_edit_update_main_odpedit_mob']['total'] < 0)
 {
     $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['where_filter'] = "1 <> 1";
 }
 $sDetailSrc = ('novo' == $this->nmgp_opcao) ? 'project_edit_update_main_odpedit_mob_empty.htm' : $this->Ini->link_odp_master_edit_detail_mob_edit . '?script_case_init=' . $this->form_encode_input($this->Ini->sc_page) . '&script_case_session=' . session_id() . '&script_case_detail=Y';
 foreach ($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob'] as $i => $v)
 {
     $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail'][$i] = $v;
 }
if (isset($this->Ini->sc_lig_target['C_@scinf_detail']) && 'nmsc_iframe_liga_odp_master_edit_detail_mob' != $this->Ini->sc_lig_target['C_@scinf_detail'])
{
    if ('novo' != $this->nmgp_opcao)
    {
        $sDetailSrc .= '&under_dashboard=1&dashboard_app=' . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['dashboard_app'] . '&own_widget=' . $this->Ini->sc_lig_target['C_@scinf_detail'] . '&parent_widget=' . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['own_widget'];
        $sDetailSrc  = $this->addUrlParam($sDetailSrc, 'script_case_init', $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init']);
    }
?>
<script type="text/javascript">
$(function() {
    scOpenMasterDetail("<?php echo $this->Ini->sc_lig_target['C_@scinf_detail'] ?>", "<?php echo $sDetailSrc; ?>");
});
</script>
<?php
}
else
{
?>
<iframe border="0" id="nmsc_iframe_liga_odp_master_edit_detail_mob"  marginWidth="0" marginHeight="0" frameborder="0" valign="top" height="100" width="100%" name="nmsc_iframe_liga_odp_master_edit_detail_mob"  scrolling="auto" src="<?php echo $sDetailSrc; ?>"></iframe>
<?php
}
?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_detail_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_detail_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
<?php
  }
?>
</td></tr>
<tr><td class="scFormPageText">
<span class="scFormRequiredOddColor">* <?php echo $this->Ini->Nm_lang['lang_othr_reqr']; ?></span>
</td></tr> 
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R")
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
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "binicio", "nm_move ('inicio');", "nm_move ('inicio');", "sc_b_ini_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "binicio_off", "nm_move ('inicio');", "nm_move ('inicio');", "sc_b_ini_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bretorna", "nm_move ('retorna');", "nm_move ('retorna');", "sc_b_ret_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bavanca", "nm_move ('avanca');", "nm_move ('avanca');", "sc_b_avc_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bavanca_off", "nm_move ('avanca');", "nm_move ('avanca');", "sc_b_avc_off_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bfinal", "nm_move ('final');", "nm_move ('final');", "sc_b_fim_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
  $nm_sc_blocos_da_pag = array(0,1);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.visibility = 'hidden';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
$(window).bind("load", function() {
<?php
  $nm_sc_blocos_da_pag = array(0,1);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.visibility = '';";
      }
  }
?>
});
</script> 
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("project_edit_update_main_odpedit_mob");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("project_edit_update_main_odpedit_mob");
 parent.scAjaxDetailHeight("project_edit_update_main_odpedit_mob", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("project_edit_update_main_odpedit_mob", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("project_edit_update_main_odpedit_mob", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['sc_modal'])
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
<span id="sc-id-mobile-out"><?php echo $this->Ini->Nm_lang['lang_version_web']; ?></span>
<?php
       }
?>
</body> 
</html> 
