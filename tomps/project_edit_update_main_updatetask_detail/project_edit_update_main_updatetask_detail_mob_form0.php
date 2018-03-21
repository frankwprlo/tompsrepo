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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("Update Progress Tahapan Project"); } else { echo strip_tags("Update Progress Tahapan Project"); } ?></TITLE>
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>project_edit_update_main_updatetask_detail/project_edit_update_main_updatetask_detail_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("project_edit_update_main_updatetask_detail_mob_sajax_js.php");
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

include_once('project_edit_update_main_updatetask_detail_mob_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['recarga'];
}
?>
<body class="scFormPage" style="<?php echo $str_iframe_body; ?>">
<?php

if (isset($_SESSION['scriptcase']['project_edit_update_main_updatetask_detail']['error_buffer']) && '' != $_SESSION['scriptcase']['project_edit_update_main_updatetask_detail']['error_buffer'])
{
    echo $_SESSION['scriptcase']['project_edit_update_main_updatetask_detail']['error_buffer'];
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
 include_once("project_edit_update_main_updatetask_detail_mob_js0.php");
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
<form  name="F1" method="post" enctype="multipart/form-data" 
               action="project_edit_update_main_updatetask_detail_mob.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['insert_validation']; ?>">
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
<input type="hidden" name="upload_file_flag" value="">
<input type="hidden" name="upload_file_check" value="">
<input type="hidden" name="upload_file_name" value="">
<input type="hidden" name="upload_file_temp" value="">
<input type="hidden" name="upload_file_libs" value="">
<input type="hidden" name="upload_file_height" value="">
<input type="hidden" name="upload_file_width" value="">
<input type="hidden" name="upload_file_aspect" value="">
<input type="hidden" name="upload_file_type" value="">
<input type="hidden" name="ppo_evident_one_salva" value="<?php  echo $this->form_encode_input($this->ppo_evident_one) ?>">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['project_edit_update_main_updatetask_detail_mob'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['project_edit_update_main_updatetask_detail_mob'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; text-align: center; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['empty_filter'] = true;
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
<TABLE align="center" id="hidden_bloco_0" class="scFormTable" width="100%" style="height: 100%;"><input type="hidden" name="ppo_evident_one_ul_name" id="id_sc_field_ppo_evident_one_ul_name" value="<?php echo $this->form_encode_input($this->ppo_evident_one_ul_name);?>">
<input type="hidden" name="ppo_evident_one_ul_type" id="id_sc_field_ppo_evident_one_ul_type" value="<?php echo $this->form_encode_input($this->ppo_evident_one_ul_type);?>">
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['ppo_id']))
           {
               $this->nmgp_cmp_readonly['ppo_id'] = 'on';
           }
?>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ppo_id']))
    {
        $this->nm_new_label['ppo_id'] = "IDTable";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_id = $this->ppo_id;
   $sStyleHidden_ppo_id = '';
   if (isset($this->nmgp_cmp_hidden['ppo_id']) && $this->nmgp_cmp_hidden['ppo_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_id']);
       $sStyleHidden_ppo_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_id = 'display: none;';
   $sStyleReadInp_ppo_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["ppo_id"]) &&  $this->nmgp_cmp_readonly["ppo_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_id']);
       $sStyleReadLab_ppo_id = '';
       $sStyleReadInp_ppo_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_id']) && $this->nmgp_cmp_hidden['ppo_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_id" value="<?php echo $this->form_encode_input($ppo_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_id_line" id="hidden_field_data_ppo_id" style="<?php echo $sStyleHidden_ppo_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_id_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_id_label"><span id="id_label_ppo_id"><?php echo $this->nm_new_label['ppo_id']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_id']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_id'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["ppo_id"]) &&  $this->nmgp_cmp_readonly["ppo_id"] == "on")) { 

 ?>
<input type="hidden" name="ppo_id" value="<?php echo $this->form_encode_input($ppo_id) . "\"><span id=\"id_ajax_label_ppo_id\">" . $ppo_id . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_ppo_id" class="sc-ui-readonly-ppo_id css_ppo_id_line" style="<?php echo $sStyleReadLab_ppo_id; ?>"><?php echo $this->form_encode_input($this->ppo_id); ?></span><span id="id_read_off_ppo_id" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_id; ?>">
 <input class="sc-js-input scFormObjectOdd css_ppo_id_obj" style="" id="id_sc_field_ppo_id" type=text name="ppo_id" value="<?php echo $this->form_encode_input($ppo_id) ?>"
 size=12 maxlength=22 alt="{datatype: 'text', maxLength: 22, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_id_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['ppo_status']))
   {
       $this->nm_new_label['ppo_status'] = "Status Project";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_status = $this->ppo_status;
   $sStyleHidden_ppo_status = '';
   if (isset($this->nmgp_cmp_hidden['ppo_status']) && $this->nmgp_cmp_hidden['ppo_status'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_status']);
       $sStyleHidden_ppo_status = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_status = 'display: none;';
   $sStyleReadInp_ppo_status = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ppo_status']) && $this->nmgp_cmp_readonly['ppo_status'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_status']);
       $sStyleReadLab_ppo_status = '';
       $sStyleReadInp_ppo_status = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_status']) && $this->nmgp_cmp_hidden['ppo_status'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="ppo_status" value="<?php echo $this->form_encode_input($this->ppo_status) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_status_line" id="hidden_field_data_ppo_status" style="<?php echo $sStyleHidden_ppo_status; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_status_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_status_label"><span id="id_label_ppo_status"><?php echo $this->nm_new_label['ppo_status']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_status']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_status'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ppo_status"]) &&  $this->nmgp_cmp_readonly["ppo_status"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'] = array(); 
    }

   $old_value_ppo_tglmulaiactual = $this->ppo_tglmulaiactual;
   $old_value_ppo_tglselesaiactual = $this->ppo_tglselesaiactual;
   $old_value_ppo_projectid = $this->ppo_projectid;
   $old_value_ppo_idtasktahapan = $this->ppo_idtasktahapan;
   $old_value_ppo_tglmulaiplan = $this->ppo_tglmulaiplan;
   $old_value_ppo_targethari = $this->ppo_targethari;
   $old_value_ppo_targetselesai = $this->ppo_targetselesai;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_ppo_tglmulaiactual = $this->ppo_tglmulaiactual;
   $unformatted_value_ppo_tglselesaiactual = $this->ppo_tglselesaiactual;
   $unformatted_value_ppo_projectid = $this->ppo_projectid;
   $unformatted_value_ppo_idtasktahapan = $this->ppo_idtasktahapan;
   $unformatted_value_ppo_tglmulaiplan = $this->ppo_tglmulaiplan;
   $unformatted_value_ppo_targethari = $this->ppo_targethari;
   $unformatted_value_ppo_targetselesai = $this->ppo_targetselesai;

   $nm_comando = "SELECT STATUSID, STATUSNAME  FROM TB_TASKTSTATUS  ORDER BY STATUSNAME";

   $this->ppo_tglmulaiactual = $old_value_ppo_tglmulaiactual;
   $this->ppo_tglselesaiactual = $old_value_ppo_tglselesaiactual;
   $this->ppo_projectid = $old_value_ppo_projectid;
   $this->ppo_idtasktahapan = $old_value_ppo_idtasktahapan;
   $this->ppo_tglmulaiplan = $old_value_ppo_tglmulaiplan;
   $this->ppo_targethari = $old_value_ppo_targethari;
   $this->ppo_targetselesai = $old_value_ppo_targetselesai;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $ppo_status_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->ppo_status_1))
          {
              foreach ($this->ppo_status_1 as $tmp_ppo_status)
              {
                  if (trim($tmp_ppo_status) === trim($cadaselect[1])) { $ppo_status_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->ppo_status) === trim($cadaselect[1])) { $ppo_status_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="ppo_status" value="<?php echo $this->form_encode_input($ppo_status) . "\">" . $ppo_status_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_ppo_status();
   $x = 0 ; 
   $ppo_status_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->ppo_status_1))
          {
              foreach ($this->ppo_status_1 as $tmp_ppo_status)
              {
                  if (trim($tmp_ppo_status) === trim($cadaselect[1])) { $ppo_status_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->ppo_status) === trim($cadaselect[1])) { $ppo_status_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($ppo_status_look))
          {
              $ppo_status_look = $this->ppo_status;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_ppo_status\" class=\"css_ppo_status_line\" style=\"" .  $sStyleReadLab_ppo_status . "\">" . $this->form_encode_input($ppo_status_look) . "</span><span id=\"id_read_off_ppo_status\" style=\"" . $sStyleReadInp_ppo_status . "\">";
   echo " <span id=\"idAjaxSelect_ppo_status\"><select class=\"sc-js-input scFormObjectOdd css_ppo_status_obj\" style=\"\" id=\"id_sc_field_ppo_status\" name=\"ppo_status\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'][] = ''; 
   echo "  <option value=\"\"></option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->ppo_status) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->ppo_status)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">$cadaselect[0] </option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_status_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ppo_tglmulaiactual']))
    {
        $this->nm_new_label['ppo_tglmulaiactual'] = "Tgl Mulai(aktual)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_tglmulaiactual = $this->ppo_tglmulaiactual;
   $sStyleHidden_ppo_tglmulaiactual = '';
   if (isset($this->nmgp_cmp_hidden['ppo_tglmulaiactual']) && $this->nmgp_cmp_hidden['ppo_tglmulaiactual'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_tglmulaiactual']);
       $sStyleHidden_ppo_tglmulaiactual = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_tglmulaiactual = 'display: none;';
   $sStyleReadInp_ppo_tglmulaiactual = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ppo_tglmulaiactual']) && $this->nmgp_cmp_readonly['ppo_tglmulaiactual'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_tglmulaiactual']);
       $sStyleReadLab_ppo_tglmulaiactual = '';
       $sStyleReadInp_ppo_tglmulaiactual = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_tglmulaiactual']) && $this->nmgp_cmp_hidden['ppo_tglmulaiactual'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_tglmulaiactual" value="<?php echo $this->form_encode_input($ppo_tglmulaiactual) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_tglmulaiactual_line" id="hidden_field_data_ppo_tglmulaiactual" style="<?php echo $sStyleHidden_ppo_tglmulaiactual; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_tglmulaiactual_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_tglmulaiactual_label"><span id="id_label_ppo_tglmulaiactual"><?php echo $this->nm_new_label['ppo_tglmulaiactual']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ppo_tglmulaiactual"]) &&  $this->nmgp_cmp_readonly["ppo_tglmulaiactual"] == "on") { 

 ?>
<input type="hidden" name="ppo_tglmulaiactual" value="<?php echo $this->form_encode_input($ppo_tglmulaiactual) . "\">" . $ppo_tglmulaiactual . ""; ?>
<?php } else { ?>
<span id="id_read_on_ppo_tglmulaiactual" class="sc-ui-readonly-ppo_tglmulaiactual css_ppo_tglmulaiactual_line" style="<?php echo $sStyleReadLab_ppo_tglmulaiactual; ?>"><?php echo $this->form_encode_input($ppo_tglmulaiactual); ?></span><span id="id_read_off_ppo_tglmulaiactual" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_tglmulaiactual; ?>">
 <input class="sc-js-input scFormObjectOdd css_ppo_tglmulaiactual_obj" style="" id="id_sc_field_ppo_tglmulaiactual" type=text name="ppo_tglmulaiactual" value="<?php echo $this->form_encode_input($ppo_tglmulaiactual) ?>"
 size=10 alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['ppo_tglmulaiactual']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['ppo_tglmulaiactual']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$tmp_form_data = $this->field_config['ppo_tglmulaiactual']['date_format'];
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_tglmulaiactual_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_tglmulaiactual_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ppo_tglselesaiactual']))
    {
        $this->nm_new_label['ppo_tglselesaiactual'] = "Tgl Selesai(aktual)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_tglselesaiactual = $this->ppo_tglselesaiactual;
   $sStyleHidden_ppo_tglselesaiactual = '';
   if (isset($this->nmgp_cmp_hidden['ppo_tglselesaiactual']) && $this->nmgp_cmp_hidden['ppo_tglselesaiactual'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_tglselesaiactual']);
       $sStyleHidden_ppo_tglselesaiactual = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_tglselesaiactual = 'display: none;';
   $sStyleReadInp_ppo_tglselesaiactual = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ppo_tglselesaiactual']) && $this->nmgp_cmp_readonly['ppo_tglselesaiactual'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_tglselesaiactual']);
       $sStyleReadLab_ppo_tglselesaiactual = '';
       $sStyleReadInp_ppo_tglselesaiactual = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_tglselesaiactual']) && $this->nmgp_cmp_hidden['ppo_tglselesaiactual'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_tglselesaiactual" value="<?php echo $this->form_encode_input($ppo_tglselesaiactual) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_tglselesaiactual_line" id="hidden_field_data_ppo_tglselesaiactual" style="<?php echo $sStyleHidden_ppo_tglselesaiactual; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_tglselesaiactual_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_tglselesaiactual_label"><span id="id_label_ppo_tglselesaiactual"><?php echo $this->nm_new_label['ppo_tglselesaiactual']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ppo_tglselesaiactual"]) &&  $this->nmgp_cmp_readonly["ppo_tglselesaiactual"] == "on") { 

 ?>
<input type="hidden" name="ppo_tglselesaiactual" value="<?php echo $this->form_encode_input($ppo_tglselesaiactual) . "\">" . $ppo_tglselesaiactual . ""; ?>
<?php } else { ?>
<span id="id_read_on_ppo_tglselesaiactual" class="sc-ui-readonly-ppo_tglselesaiactual css_ppo_tglselesaiactual_line" style="<?php echo $sStyleReadLab_ppo_tglselesaiactual; ?>"><?php echo $this->form_encode_input($ppo_tglselesaiactual); ?></span><span id="id_read_off_ppo_tglselesaiactual" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_tglselesaiactual; ?>">
 <input class="sc-js-input scFormObjectOdd css_ppo_tglselesaiactual_obj" style="" id="id_sc_field_ppo_tglselesaiactual" type=text name="ppo_tglselesaiactual" value="<?php echo $this->form_encode_input($ppo_tglselesaiactual) ?>"
 size=10 alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['ppo_tglselesaiactual']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['ppo_tglselesaiactual']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$sTimeFormat = '';
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcalendario", "nm_display_calendar('ppo_tglselesaiactual', '', '10', '" . $_SESSION['scriptcase']['reg_conf']['date_week_ini']. "', '" . $sTimeFormat. "')", "nm_display_calendar('ppo_tglselesaiactual', '', '10', '" . $_SESSION['scriptcase']['reg_conf']['date_week_ini']. "', '" . $sTimeFormat. "')", "calendar_ppo_tglselesaiactual", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<?php
$tmp_form_data = $this->field_config['ppo_tglselesaiactual']['date_format'];
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_tglselesaiactual_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_tglselesaiactual_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ppo_evident_one']))
    {
        $this->nm_new_label['ppo_evident_one'] = "Dokumen";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_evident_one = $this->ppo_evident_one;
   $sStyleHidden_ppo_evident_one = '';
   if (isset($this->nmgp_cmp_hidden['ppo_evident_one']) && $this->nmgp_cmp_hidden['ppo_evident_one'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_evident_one']);
       $sStyleHidden_ppo_evident_one = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_evident_one = 'display: none;';
   $sStyleReadInp_ppo_evident_one = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ppo_evident_one']) && $this->nmgp_cmp_readonly['ppo_evident_one'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_evident_one']);
       $sStyleReadLab_ppo_evident_one = '';
       $sStyleReadInp_ppo_evident_one = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_evident_one']) && $this->nmgp_cmp_hidden['ppo_evident_one'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_evident_one" value="<?php echo $this->form_encode_input($ppo_evident_one) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_evident_one_line" id="hidden_field_data_ppo_evident_one" style="<?php echo $sStyleHidden_ppo_evident_one; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_evident_one_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_evident_one_label"><span id="id_label_ppo_evident_one"><?php echo $this->nm_new_label['ppo_evident_one']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ppo_evident_one"]) &&  $this->nmgp_cmp_readonly["ppo_evident_one"] == "on") { 

 ?>
<input type="hidden" name="ppo_evident_one" value="<?php echo $this->form_encode_input($ppo_evident_one) . "\"><img id=\"ppo_evident_one_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><span id=\"id_ajax_doc_ppo_evident_one\"><a href=\"javascript:nm_mostra_doc('0', '" . str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_ppo_evident_one, 3)) . "', 'project_edit_update_main_updatetask_detail')\">" . $ppo_evident_one . "</a></span>"; ?>
<?php } else { ?>
<span id="id_read_on_ppo_evident_one" class="scFormLinkOdd sc-ui-readonly-ppo_evident_one css_ppo_evident_one_line" style="<?php echo $sStyleReadLab_ppo_evident_one; ?>"><?php echo $this->form_encode_input($this->ppo_evident_one); ?></span><span id="id_read_off_ppo_evident_one" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_evident_one; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-ppo_evident_one" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_ppo_evident_one_obj" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="ppo_evident_one[]" id="id_sc_field_ppo_evident_one" ></span></span>
<span id="chk_ajax_img_ppo_evident_one"<?php if ($this->nmgp_opcao == "novo" || empty($ppo_evident_one)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="ppo_evident_one_limpa" value="<?php echo $ppo_evident_one_limpa . '" '; if ($ppo_evident_one_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="ppo_evident_one_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><span id="id_ajax_doc_ppo_evident_one"><a href="javascript:nm_mostra_doc('0', '<?php echo str_replace(array("'", '%'), array("\'", '**Perc**'), substr($sTmpFile_ppo_evident_one, 3)); ?>', 'project_edit_update_main_updatetask_detail')"><?php echo $ppo_evident_one ?></a></span><div id="id_img_loader_ppo_evident_one" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_ppo_evident_one" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_evident_one_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_evident_one_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['keterangan']))
    {
        $this->nm_new_label['keterangan'] = "Keterangan";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $keterangan = $this->keterangan;
   $sStyleHidden_keterangan = '';
   if (isset($this->nmgp_cmp_hidden['keterangan']) && $this->nmgp_cmp_hidden['keterangan'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['keterangan']);
       $sStyleHidden_keterangan = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_keterangan = 'display: none;';
   $sStyleReadInp_keterangan = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['keterangan']) && $this->nmgp_cmp_readonly['keterangan'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['keterangan']);
       $sStyleReadLab_keterangan = '';
       $sStyleReadInp_keterangan = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['keterangan']) && $this->nmgp_cmp_hidden['keterangan'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="keterangan" value="<?php echo $this->form_encode_input($keterangan) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_keterangan_line" id="hidden_field_data_keterangan" style="<?php echo $sStyleHidden_keterangan; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_keterangan_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_keterangan_label"><span id="id_label_keterangan"><?php echo $this->nm_new_label['keterangan']; ?></span></span><br><span id="id_read_on_keterangan css_keterangan_line" style="<?php echo $sStyleReadLab_keterangan; ?>"><?php echo $this->form_encode_input($this->keterangan); ?></span><span id="id_read_off_keterangan" style="<?php echo $sStyleReadInp_keterangan; ?>"><span id="id_ajax_label_keterangan"><?php echo $keterangan?></span>
</span><input type="hidden" name="keterangan" value="<?php echo $this->form_encode_input($keterangan); ?>">
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_keterangan_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_keterangan_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['ppo_projectid']))
           {
               $this->nmgp_cmp_readonly['ppo_projectid'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['ppo_note']))
    {
        $this->nm_new_label['ppo_note'] = "Catatan";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_note = $this->ppo_note;
   $sStyleHidden_ppo_note = '';
   if (isset($this->nmgp_cmp_hidden['ppo_note']) && $this->nmgp_cmp_hidden['ppo_note'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_note']);
       $sStyleHidden_ppo_note = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_note = 'display: none;';
   $sStyleReadInp_ppo_note = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ppo_note']) && $this->nmgp_cmp_readonly['ppo_note'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_note']);
       $sStyleReadLab_ppo_note = '';
       $sStyleReadInp_ppo_note = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_note']) && $this->nmgp_cmp_hidden['ppo_note'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_note" value="<?php echo $this->form_encode_input($ppo_note) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_note_line" id="hidden_field_data_ppo_note" style="<?php echo $sStyleHidden_ppo_note; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_note_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_note_label"><span id="id_label_ppo_note"><?php echo $this->nm_new_label['ppo_note']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_note']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_note'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php
$ppo_note_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($ppo_note));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["ppo_note"]) &&  $this->nmgp_cmp_readonly["ppo_note"] == "on") { 

 ?>
<input type="hidden" name="ppo_note" value="<?php echo $this->form_encode_input($ppo_note) . "\">" . $ppo_note_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_ppo_note" class="sc-ui-readonly-ppo_note css_ppo_note_line" style="<?php echo $sStyleReadLab_ppo_note; ?>"><?php echo $this->form_encode_input($ppo_note_val); ?></span><span id="id_read_off_ppo_note" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_note; ?>">
 <textarea  class="sc-js-input scFormObjectOdd css_ppo_note_obj" style="white-space: pre-wrap;" name="ppo_note" id="id_sc_field_ppo_note" rows="2" cols="30"
 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $ppo_note; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_note_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_note_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_ppo_note_dumb = ('' == $sStyleHidden_ppo_note) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ppo_note_dumb" style="<?php echo $sStyleHidden_ppo_note_dumb; ?>"></TD>
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
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['ppo_tahapanproject']))
           {
               $this->nmgp_cmp_readonly['ppo_tahapanproject'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['ppo_projectid']))
    {
        $this->nm_new_label['ppo_projectid'] = "ID Project";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_projectid = $this->ppo_projectid;
   $sStyleHidden_ppo_projectid = '';
   if (isset($this->nmgp_cmp_hidden['ppo_projectid']) && $this->nmgp_cmp_hidden['ppo_projectid'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_projectid']);
       $sStyleHidden_ppo_projectid = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_projectid = 'display: none;';
   $sStyleReadInp_ppo_projectid = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["ppo_projectid"]) &&  $this->nmgp_cmp_readonly["ppo_projectid"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_projectid']);
       $sStyleReadLab_ppo_projectid = '';
       $sStyleReadInp_ppo_projectid = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_projectid']) && $this->nmgp_cmp_hidden['ppo_projectid'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_projectid" value="<?php echo $this->form_encode_input($ppo_projectid) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_projectid_line" id="hidden_field_data_ppo_projectid" style="<?php echo $sStyleHidden_ppo_projectid; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_projectid_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_projectid_label"><span id="id_label_ppo_projectid"><?php echo $this->nm_new_label['ppo_projectid']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["ppo_projectid"]) &&  $this->nmgp_cmp_readonly["ppo_projectid"] == "on")) { 

 ?>
<input type="hidden" name="ppo_projectid" value="<?php echo $this->form_encode_input($ppo_projectid) . "\"><span id=\"id_ajax_label_ppo_projectid\">" . $ppo_projectid . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_ppo_projectid" class="sc-ui-readonly-ppo_projectid css_ppo_projectid_line" style="<?php echo $sStyleReadLab_ppo_projectid; ?>"><?php echo $this->form_encode_input($this->ppo_projectid); ?></span><span id="id_read_off_ppo_projectid" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_projectid; ?>">
 <input class="sc-js-input scFormObjectOdd css_ppo_projectid_obj" style="" id="id_sc_field_ppo_projectid" type=text name="ppo_projectid" value="<?php echo $this->form_encode_input($ppo_projectid) ?>"
 size=4 alt="{datatype: 'integer', maxLength: 5, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['ppo_projectid']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['ppo_projectid']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_projectid_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_projectid_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['ppo_idtasktahapan']))
           {
               $this->nmgp_cmp_readonly['ppo_idtasktahapan'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['ppo_tahapanproject']))
    {
        $this->nm_new_label['ppo_tahapanproject'] = "Tahapan Project";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_tahapanproject = $this->ppo_tahapanproject;
   $sStyleHidden_ppo_tahapanproject = '';
   if (isset($this->nmgp_cmp_hidden['ppo_tahapanproject']) && $this->nmgp_cmp_hidden['ppo_tahapanproject'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_tahapanproject']);
       $sStyleHidden_ppo_tahapanproject = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_tahapanproject = 'display: none;';
   $sStyleReadInp_ppo_tahapanproject = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["ppo_tahapanproject"]) &&  $this->nmgp_cmp_readonly["ppo_tahapanproject"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_tahapanproject']);
       $sStyleReadLab_ppo_tahapanproject = '';
       $sStyleReadInp_ppo_tahapanproject = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_tahapanproject']) && $this->nmgp_cmp_hidden['ppo_tahapanproject'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_tahapanproject" value="<?php echo $this->form_encode_input($ppo_tahapanproject) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_tahapanproject_line" id="hidden_field_data_ppo_tahapanproject" style="<?php echo $sStyleHidden_ppo_tahapanproject; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_tahapanproject_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_tahapanproject_label"><span id="id_label_ppo_tahapanproject"><?php echo $this->nm_new_label['ppo_tahapanproject']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["ppo_tahapanproject"]) &&  $this->nmgp_cmp_readonly["ppo_tahapanproject"] == "on")) { 

 ?>
<input type="hidden" name="ppo_tahapanproject" value="<?php echo $this->form_encode_input($ppo_tahapanproject) . "\"><span id=\"id_ajax_label_ppo_tahapanproject\">" . $ppo_tahapanproject . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_ppo_tahapanproject" class="sc-ui-readonly-ppo_tahapanproject css_ppo_tahapanproject_line" style="<?php echo $sStyleReadLab_ppo_tahapanproject; ?>"><?php echo $this->form_encode_input($this->ppo_tahapanproject); ?></span><span id="id_read_off_ppo_tahapanproject" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_tahapanproject; ?>">
 <input class="sc-js-input scFormObjectOdd css_ppo_tahapanproject_obj" style="" id="id_sc_field_ppo_tahapanproject" type=text name="ppo_tahapanproject" value="<?php echo $this->form_encode_input($ppo_tahapanproject) ?>"
 size=10 maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_tahapanproject_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_tahapanproject_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['ppo_tasktahapan']))
           {
               $this->nmgp_cmp_readonly['ppo_tasktahapan'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['ppo_idtasktahapan']))
    {
        $this->nm_new_label['ppo_idtasktahapan'] = "ID Tahapan Task";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_idtasktahapan = $this->ppo_idtasktahapan;
   $sStyleHidden_ppo_idtasktahapan = '';
   if (isset($this->nmgp_cmp_hidden['ppo_idtasktahapan']) && $this->nmgp_cmp_hidden['ppo_idtasktahapan'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_idtasktahapan']);
       $sStyleHidden_ppo_idtasktahapan = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_idtasktahapan = 'display: none;';
   $sStyleReadInp_ppo_idtasktahapan = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["ppo_idtasktahapan"]) &&  $this->nmgp_cmp_readonly["ppo_idtasktahapan"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_idtasktahapan']);
       $sStyleReadLab_ppo_idtasktahapan = '';
       $sStyleReadInp_ppo_idtasktahapan = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_idtasktahapan']) && $this->nmgp_cmp_hidden['ppo_idtasktahapan'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_idtasktahapan" value="<?php echo $this->form_encode_input($ppo_idtasktahapan) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_idtasktahapan_line" id="hidden_field_data_ppo_idtasktahapan" style="<?php echo $sStyleHidden_ppo_idtasktahapan; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_idtasktahapan_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_idtasktahapan_label"><span id="id_label_ppo_idtasktahapan"><?php echo $this->nm_new_label['ppo_idtasktahapan']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["ppo_idtasktahapan"]) &&  $this->nmgp_cmp_readonly["ppo_idtasktahapan"] == "on")) { 

 ?>
<input type="hidden" name="ppo_idtasktahapan" value="<?php echo $this->form_encode_input($ppo_idtasktahapan) . "\"><span id=\"id_ajax_label_ppo_idtasktahapan\">" . $ppo_idtasktahapan . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_ppo_idtasktahapan" class="sc-ui-readonly-ppo_idtasktahapan css_ppo_idtasktahapan_line" style="<?php echo $sStyleReadLab_ppo_idtasktahapan; ?>"><?php echo $this->form_encode_input($this->ppo_idtasktahapan); ?></span><span id="id_read_off_ppo_idtasktahapan" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_idtasktahapan; ?>">
 <input class="sc-js-input scFormObjectOdd css_ppo_idtasktahapan_obj" style="" id="id_sc_field_ppo_idtasktahapan" type=text name="ppo_idtasktahapan" value="<?php echo $this->form_encode_input($ppo_idtasktahapan) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['ppo_idtasktahapan']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['ppo_idtasktahapan']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_idtasktahapan_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_idtasktahapan_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['ppo_tglmulaiplan']))
           {
               $this->nmgp_cmp_readonly['ppo_tglmulaiplan'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['ppo_tasktahapan']))
    {
        $this->nm_new_label['ppo_tasktahapan'] = "Tahapan Task";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_tasktahapan = $this->ppo_tasktahapan;
   $sStyleHidden_ppo_tasktahapan = '';
   if (isset($this->nmgp_cmp_hidden['ppo_tasktahapan']) && $this->nmgp_cmp_hidden['ppo_tasktahapan'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_tasktahapan']);
       $sStyleHidden_ppo_tasktahapan = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_tasktahapan = 'display: none;';
   $sStyleReadInp_ppo_tasktahapan = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["ppo_tasktahapan"]) &&  $this->nmgp_cmp_readonly["ppo_tasktahapan"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_tasktahapan']);
       $sStyleReadLab_ppo_tasktahapan = '';
       $sStyleReadInp_ppo_tasktahapan = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_tasktahapan']) && $this->nmgp_cmp_hidden['ppo_tasktahapan'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_tasktahapan" value="<?php echo $this->form_encode_input($ppo_tasktahapan) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_tasktahapan_line" id="hidden_field_data_ppo_tasktahapan" style="<?php echo $sStyleHidden_ppo_tasktahapan; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_tasktahapan_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_tasktahapan_label"><span id="id_label_ppo_tasktahapan"><?php echo $this->nm_new_label['ppo_tasktahapan']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["ppo_tasktahapan"]) &&  $this->nmgp_cmp_readonly["ppo_tasktahapan"] == "on")) { 

 ?>
<input type="hidden" name="ppo_tasktahapan" value="<?php echo $this->form_encode_input($ppo_tasktahapan) . "\"><span id=\"id_ajax_label_ppo_tasktahapan\">" . $ppo_tasktahapan . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_ppo_tasktahapan" class="sc-ui-readonly-ppo_tasktahapan css_ppo_tasktahapan_line" style="<?php echo $sStyleReadLab_ppo_tasktahapan; ?>"><?php echo $this->form_encode_input($this->ppo_tasktahapan); ?></span><span id="id_read_off_ppo_tasktahapan" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_tasktahapan; ?>">
 <input class="sc-js-input scFormObjectOdd css_ppo_tasktahapan_obj" style="" id="id_sc_field_ppo_tasktahapan" type=text name="ppo_tasktahapan" value="<?php echo $this->form_encode_input($ppo_tasktahapan) ?>"
 size=20 maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_tasktahapan_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_tasktahapan_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['ppo_targethari']))
           {
               $this->nmgp_cmp_readonly['ppo_targethari'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['ppo_tglmulaiplan']))
    {
        $this->nm_new_label['ppo_tglmulaiplan'] = "Tgl Mulai(Plan)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_tglmulaiplan = $this->ppo_tglmulaiplan;
   $sStyleHidden_ppo_tglmulaiplan = '';
   if (isset($this->nmgp_cmp_hidden['ppo_tglmulaiplan']) && $this->nmgp_cmp_hidden['ppo_tglmulaiplan'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_tglmulaiplan']);
       $sStyleHidden_ppo_tglmulaiplan = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_tglmulaiplan = 'display: none;';
   $sStyleReadInp_ppo_tglmulaiplan = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["ppo_tglmulaiplan"]) &&  $this->nmgp_cmp_readonly["ppo_tglmulaiplan"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_tglmulaiplan']);
       $sStyleReadLab_ppo_tglmulaiplan = '';
       $sStyleReadInp_ppo_tglmulaiplan = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_tglmulaiplan']) && $this->nmgp_cmp_hidden['ppo_tglmulaiplan'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_tglmulaiplan" value="<?php echo $this->form_encode_input($ppo_tglmulaiplan) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_tglmulaiplan_line" id="hidden_field_data_ppo_tglmulaiplan" style="<?php echo $sStyleHidden_ppo_tglmulaiplan; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_tglmulaiplan_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_tglmulaiplan_label"><span id="id_label_ppo_tglmulaiplan"><?php echo $this->nm_new_label['ppo_tglmulaiplan']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["ppo_tglmulaiplan"]) &&  $this->nmgp_cmp_readonly["ppo_tglmulaiplan"] == "on")) { 

 ?>
<input type="hidden" name="ppo_tglmulaiplan" value="<?php echo $this->form_encode_input($ppo_tglmulaiplan) . "\"><span id=\"id_ajax_label_ppo_tglmulaiplan\">" . $ppo_tglmulaiplan . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_ppo_tglmulaiplan" class="sc-ui-readonly-ppo_tglmulaiplan css_ppo_tglmulaiplan_line" style="<?php echo $sStyleReadLab_ppo_tglmulaiplan; ?>"><?php echo $this->form_encode_input($ppo_tglmulaiplan); ?></span><span id="id_read_off_ppo_tglmulaiplan" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_tglmulaiplan; ?>">
 <input class="sc-js-input scFormObjectOdd css_ppo_tglmulaiplan_obj" style="" id="id_sc_field_ppo_tglmulaiplan" type=text name="ppo_tglmulaiplan" value="<?php echo $this->form_encode_input($ppo_tglmulaiplan) ?>"
 size=10 alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['ppo_tglmulaiplan']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['ppo_tglmulaiplan']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$tmp_form_data = $this->field_config['ppo_tglmulaiplan']['date_format'];
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_tglmulaiplan_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_tglmulaiplan_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['ppo_targetselesai']))
           {
               $this->nmgp_cmp_readonly['ppo_targetselesai'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['ppo_targethari']))
    {
        $this->nm_new_label['ppo_targethari'] = "Target(hari)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_targethari = $this->ppo_targethari;
   $sStyleHidden_ppo_targethari = '';
   if (isset($this->nmgp_cmp_hidden['ppo_targethari']) && $this->nmgp_cmp_hidden['ppo_targethari'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_targethari']);
       $sStyleHidden_ppo_targethari = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_targethari = 'display: none;';
   $sStyleReadInp_ppo_targethari = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["ppo_targethari"]) &&  $this->nmgp_cmp_readonly["ppo_targethari"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_targethari']);
       $sStyleReadLab_ppo_targethari = '';
       $sStyleReadInp_ppo_targethari = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_targethari']) && $this->nmgp_cmp_hidden['ppo_targethari'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_targethari" value="<?php echo $this->form_encode_input($ppo_targethari) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_targethari_line" id="hidden_field_data_ppo_targethari" style="<?php echo $sStyleHidden_ppo_targethari; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_targethari_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_targethari_label"><span id="id_label_ppo_targethari"><?php echo $this->nm_new_label['ppo_targethari']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["ppo_targethari"]) &&  $this->nmgp_cmp_readonly["ppo_targethari"] == "on")) { 

 ?>
<input type="hidden" name="ppo_targethari" value="<?php echo $this->form_encode_input($ppo_targethari) . "\"><span id=\"id_ajax_label_ppo_targethari\">" . $ppo_targethari . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_ppo_targethari" class="sc-ui-readonly-ppo_targethari css_ppo_targethari_line" style="<?php echo $sStyleReadLab_ppo_targethari; ?>"><?php echo $this->form_encode_input($this->ppo_targethari); ?></span><span id="id_read_off_ppo_targethari" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_targethari; ?>">
 <input class="sc-js-input scFormObjectOdd css_ppo_targethari_obj" style="" id="id_sc_field_ppo_targethari" type=text name="ppo_targethari" value="<?php echo $this->form_encode_input($ppo_targethari) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['ppo_targethari']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['ppo_targethari']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_targethari_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_targethari_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ppo_targetselesai']))
    {
        $this->nm_new_label['ppo_targetselesai'] = "Tgl Selesai(Plan)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ppo_targetselesai = $this->ppo_targetselesai;
   $sStyleHidden_ppo_targetselesai = '';
   if (isset($this->nmgp_cmp_hidden['ppo_targetselesai']) && $this->nmgp_cmp_hidden['ppo_targetselesai'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ppo_targetselesai']);
       $sStyleHidden_ppo_targetselesai = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ppo_targetselesai = 'display: none;';
   $sStyleReadInp_ppo_targetselesai = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["ppo_targetselesai"]) &&  $this->nmgp_cmp_readonly["ppo_targetselesai"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ppo_targetselesai']);
       $sStyleReadLab_ppo_targetselesai = '';
       $sStyleReadInp_ppo_targetselesai = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ppo_targetselesai']) && $this->nmgp_cmp_hidden['ppo_targetselesai'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ppo_targetselesai" value="<?php echo $this->form_encode_input($ppo_targetselesai) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_ppo_targetselesai_line" id="hidden_field_data_ppo_targetselesai" style="<?php echo $sStyleHidden_ppo_targetselesai; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ppo_targetselesai_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_ppo_targetselesai_label"><span id="id_label_ppo_targetselesai"><?php echo $this->nm_new_label['ppo_targetselesai']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["ppo_targetselesai"]) &&  $this->nmgp_cmp_readonly["ppo_targetselesai"] == "on")) { 

 ?>
<input type="hidden" name="ppo_targetselesai" value="<?php echo $this->form_encode_input($ppo_targetselesai) . "\"><span id=\"id_ajax_label_ppo_targetselesai\">" . $ppo_targetselesai . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_ppo_targetselesai" class="sc-ui-readonly-ppo_targetselesai css_ppo_targetselesai_line" style="<?php echo $sStyleReadLab_ppo_targetselesai; ?>"><?php echo $this->form_encode_input($ppo_targetselesai); ?></span><span id="id_read_off_ppo_targetselesai" style="white-space: nowrap;<?php echo $sStyleReadInp_ppo_targetselesai; ?>">
 <input class="sc-js-input scFormObjectOdd css_ppo_targetselesai_obj" style="" id="id_sc_field_ppo_targetselesai" type=text name="ppo_targetselesai" value="<?php echo $this->form_encode_input($ppo_targetselesai) ?>"
 size=10 alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['ppo_targetselesai']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['ppo_targetselesai']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$tmp_form_data = $this->field_config['ppo_targetselesai']['date_format'];
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ppo_targetselesai_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ppo_targetselesai_text"></span></td></tr></table></td></tr></table> </TD>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "R")
{
    $NM_btn = false;
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "balterar", "nm_atualiza ('alterar');", "nm_atualiza ('alterar');", "sc_b_upd_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "Klik Save untuk menyimpan perubahan!", "", "", "");?>
 
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
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
<?php
      $Tzone = ini_get('date.timezone');
      if (empty($Tzone))
      {
?>
<script> 
  _scAjaxShowMessage('', "<?php echo $this->Ini->Nm_lang['lang_errm_tz']; ?>", false, 0, false, "Ok", 0, 0, 0, 0, "", "", "", true, false);
</script> 
<?php
      }
?>
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1);

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
var aFormat = {};
function nm_display_calendar(sField, cVert, iInter, sWeekIni, sTimeFormat)
{
    sValue = document.F1.elements[sField].value;
<?php
   $sCalDateFormat = strtolower($this->field_config['ppo_tglmulaiplan']['date_format']);
   $sCalDateFormat = str_replace('aaaa', 'yyyy', $sCalDateFormat);
   $sCalDateFormat = (strpos($sCalDateFormat, ';') !== false) ? substr($sCalDateFormat, 0, strpos($sCalDateFormat, ';')) : $sCalDateFormat;
?>
    aFormat["ppo_tglmulaiplan"] = "<?php echo $sCalDateFormat; ?>";
<?php
   $sCalDateFormat = strtolower($this->field_config['ppo_targetselesai']['date_format']);
   $sCalDateFormat = str_replace('aaaa', 'yyyy', $sCalDateFormat);
   $sCalDateFormat = (strpos($sCalDateFormat, ';') !== false) ? substr($sCalDateFormat, 0, strpos($sCalDateFormat, ';')) : $sCalDateFormat;
?>
    aFormat["ppo_targetselesai"] = "<?php echo $sCalDateFormat; ?>";
<?php
   $sCalDateFormat = strtolower($this->field_config['ppo_tglmulaiactual']['date_format']);
   $sCalDateFormat = str_replace('aaaa', 'yyyy', $sCalDateFormat);
   $sCalDateFormat = (strpos($sCalDateFormat, ';') !== false) ? substr($sCalDateFormat, 0, strpos($sCalDateFormat, ';')) : $sCalDateFormat;
?>
    aFormat["ppo_tglmulaiactual"] = "<?php echo $sCalDateFormat; ?>";
<?php
   $sCalDateFormat = strtolower($this->field_config['ppo_tglselesaiactual']['date_format']);
   $sCalDateFormat = str_replace('aaaa', 'yyyy', $sCalDateFormat);
   $sCalDateFormat = (strpos($sCalDateFormat, ';') !== false) ? substr($sCalDateFormat, 0, strpos($sCalDateFormat, ';')) : $sCalDateFormat;
?>
    aFormat["ppo_tglselesaiactual"] = "<?php echo $sCalDateFormat; ?>";
    if (' ' != sValue && -1 < sValue.indexOf(' ')) {
        sTimeFormat = sValue.substr(sValue.indexOf(' ') + 1);
        sValue = sValue.substr(0, sValue.indexOf(' '));
    }
    tb_show('', '<?php echo $this->Ini->path_link . SC_dir_app_name('project_edit_update_main_updatetask_detail_mob'); ?>/project_edit_update_main_updatetask_detail_mob.php?nm_cal_display=Y&field=' + sField + '&value=' + sValue + '&sVert=' + cVert + '&inter=' + iInter + '&week_ini=' + sWeekIni + '&format=' + aFormat[sField] + '&time_format=' + sTimeFormat + '&script_case_init=<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>&script_case_session=<?php echo session_id(); ?>&TB_iframe=true&height=150&width=220&modal=true', '');
}
function calendar_ppo_tglmulaiplan_callback(date, month, year, time)
{
   if (String(month).length == 1)
   {
       month = '0' + month;
   }
   if (String(date).length == 1)
   {
       date = '0' + date;
   }
<?php
   $sCalDateFormat = strtolower($this->field_config['ppo_tglmulaiplan']['date_format']);
   $sCalDateFormat = str_replace('aaaa', 'yyyy', $sCalDateFormat);
   $sCalDateFormat = (strpos($sCalDateFormat, ';') !== false) ? substr($sCalDateFormat, 0, strpos($sCalDateFormat, ';')) : $sCalDateFormat;
?>
   data_ok = "<?php echo strtolower($sCalDateFormat); ?>";
   data_ok = data_ok.replace("dd", date);
   data_ok = data_ok.replace("mm", month);
   data_ok = data_ok.replace("yyyy", year);
   if ('' != time) {
       data_ok += ' ' + time;
   }
   document.F1.elements["ppo_tglmulaiplan"].value = data_ok;
   Obj_Form = document.F1.elements["ppo_tglmulaiplan"];
   if (Obj_Form.onchange && Obj_Form.onchange != '')
   {
       Obj_Form.onchange();
   }
}
function calendar_ppo_targetselesai_callback(date, month, year, time)
{
   if (String(month).length == 1)
   {
       month = '0' + month;
   }
   if (String(date).length == 1)
   {
       date = '0' + date;
   }
<?php
   $sCalDateFormat = strtolower($this->field_config['ppo_targetselesai']['date_format']);
   $sCalDateFormat = str_replace('aaaa', 'yyyy', $sCalDateFormat);
   $sCalDateFormat = (strpos($sCalDateFormat, ';') !== false) ? substr($sCalDateFormat, 0, strpos($sCalDateFormat, ';')) : $sCalDateFormat;
?>
   data_ok = "<?php echo strtolower($sCalDateFormat); ?>";
   data_ok = data_ok.replace("dd", date);
   data_ok = data_ok.replace("mm", month);
   data_ok = data_ok.replace("yyyy", year);
   if ('' != time) {
       data_ok += ' ' + time;
   }
   document.F1.elements["ppo_targetselesai"].value = data_ok;
   Obj_Form = document.F1.elements["ppo_targetselesai"];
   if (Obj_Form.onchange && Obj_Form.onchange != '')
   {
       Obj_Form.onchange();
   }
}
function calendar_ppo_tglmulaiactual_callback(date, month, year, time)
{
   if (String(month).length == 1)
   {
       month = '0' + month;
   }
   if (String(date).length == 1)
   {
       date = '0' + date;
   }
<?php
   $sCalDateFormat = strtolower($this->field_config['ppo_tglmulaiactual']['date_format']);
   $sCalDateFormat = str_replace('aaaa', 'yyyy', $sCalDateFormat);
   $sCalDateFormat = (strpos($sCalDateFormat, ';') !== false) ? substr($sCalDateFormat, 0, strpos($sCalDateFormat, ';')) : $sCalDateFormat;
?>
   data_ok = "<?php echo strtolower($sCalDateFormat); ?>";
   data_ok = data_ok.replace("dd", date);
   data_ok = data_ok.replace("mm", month);
   data_ok = data_ok.replace("yyyy", year);
   if ('' != time) {
       data_ok += ' ' + time;
   }
   document.F1.elements["ppo_tglmulaiactual"].value = data_ok;
   Obj_Form = document.F1.elements["ppo_tglmulaiactual"];
   if (Obj_Form.onchange && Obj_Form.onchange != '')
   {
       Obj_Form.onchange();
   }
}
function calendar_ppo_tglselesaiactual_callback(date, month, year, time)
{
   if (String(month).length == 1)
   {
       month = '0' + month;
   }
   if (String(date).length == 1)
   {
       date = '0' + date;
   }
<?php
   $sCalDateFormat = strtolower($this->field_config['ppo_tglselesaiactual']['date_format']);
   $sCalDateFormat = str_replace('aaaa', 'yyyy', $sCalDateFormat);
   $sCalDateFormat = (strpos($sCalDateFormat, ';') !== false) ? substr($sCalDateFormat, 0, strpos($sCalDateFormat, ';')) : $sCalDateFormat;
?>
   data_ok = "<?php echo strtolower($sCalDateFormat); ?>";
   data_ok = data_ok.replace("dd", date);
   data_ok = data_ok.replace("mm", month);
   data_ok = data_ok.replace("yyyy", year);
   if ('' != time) {
       data_ok += ' ' + time;
   }
   document.F1.elements["ppo_tglselesaiactual"].value = data_ok;
   Obj_Form = document.F1.elements["ppo_tglselesaiactual"];
   if (Obj_Form.onchange && Obj_Form.onchange != '')
   {
       Obj_Form.onchange();
   }
}
</script> 
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("project_edit_update_main_updatetask_detail_mob");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("project_edit_update_main_updatetask_detail_mob");
 parent.scAjaxDetailHeight("project_edit_update_main_updatetask_detail_mob", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("project_edit_update_main_updatetask_detail_mob", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("project_edit_update_main_updatetask_detail_mob", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['sc_modal'])
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
<iframe id="sc-id-download-iframe" name="sc_name_download_iframe" style="display: none"></iframe>
</body> 
</html> 
