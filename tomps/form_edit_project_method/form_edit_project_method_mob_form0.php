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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("Form Entry Data Proyek"); } else { echo strip_tags("Form Update Data Proyek"); } ?></TITLE>
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
  #quicksearchph_t {
   position: relative;
  }
  #quicksearchph_t img {
   position: absolute;
   top: 0;
   right: 0;
  }
 </style>
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_btngrp.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_btngrp<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" media="screen" />
 <style type="text/css">
  .scTabActiveFontCustom { font-size: 10px }
  .scTabInactiveFontCustom { font-size: 10px }
 </style>
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_edit_project_method/form_edit_project_method_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("form_edit_project_method_mob_sajax_js.php");
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

include_once('form_edit_project_method_mob_jquery.php');

?>

 var scQSInit = true;
 var scQSPos  = {};
 var Dyn_Ini  = true;
 $(function() {

  $(".scBtnGrpText").mouseover(function() { $(this).addClass("scBtnGrpTextOver"); }).mouseout(function() { $(this).removeClass("scBtnGrpTextOver"); });
  $(".scBtnGrpClick").find("a").click(function(e){
     e.preventDefault();
  });
  $(".scBtnGrpClick").click(function(){
     var aObj = $(this).find("a"), aHref = aObj.attr("href");
     if ("javascript:" == aHref.substr(0, 11)) {
        eval(aHref.substr(11));
     }
     else {
        aObj.trigger("click");
     }
   }).mouseover(function(){
     $(this).css("cursor", "pointer");
  });
  scJQElementsAdd('');

  scJQGeneralAdd();

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

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
     scQuickSearchInit(false, '');
     if (document.getElementById('SC_fast_search_t')) {
         scQuickSearchKeyUp('t', null);
     }
     scQSInit = false;
   });
   function SC_btn_grp_text() {
      $(".scBtnGrpText").mouseover(function() { $(this).addClass("scBtnGrpTextOver"); }).mouseout(function() { $(this).removeClass("scBtnGrpTextOver"); });
   };
   function scQuickSearchSubmit_t() {
     nm_move('fast_search', 't');
   }

   function scQuickSearchInit(bPosOnly, sPos) {
     if (!bPosOnly) {
       if (document.getElementById('SC_fast_search_t')) {
           if ('' == sPos || 't' == sPos) {
               scQuickSearchSize('SC_fast_search_t', 'SC_fast_search_close_t', 'SC_fast_search_submit_t', 'quicksearchph_t');
           }
       }
     }
   }
   function scQuickSearchSize(sIdInput, sIdClose, sIdSubmit, sPlaceHolder) {
     var oInput = $('#' + sIdInput),
         oClose = $('#' + sIdClose),
         oSubmit = $('#' + sIdSubmit),
         oPlace = $('#' + sPlaceHolder),
         iInputP = parseInt(oInput.css('padding-right')) || 0,
         iInputB = parseInt(oInput.css('border-right-width')) || 0,
         iInputW = oInput.outerWidth(),
         iPlaceW = oPlace.outerWidth(),
         oInputO = oInput.offset(),
         oPlaceO = oPlace.offset(),
         iNewRight;
     iNewRight = (iPlaceW - iInputW) - (oInputO.left - oPlaceO.left) + iInputB + 1;
     oInput.css({
       'height': Math.max(oInput.height(), 16) + 'px',
       'padding-right': iInputP + 16 + <?php echo $this->Ini->Str_qs_image_padding ?> + 'px'
     });
     oClose.css({
       'right': iNewRight + <?php echo $this->Ini->Str_qs_image_padding ?> + 'px',
       'cursor': 'pointer'
     });
     oSubmit.css({
       'right': iNewRight + <?php echo $this->Ini->Str_qs_image_padding ?> + 'px',
       'cursor': 'pointer'
     });
   }
   function scQuickSearchKeyUp(sPos, e) {
     if ('' != scQSInitVal && $('#SC_fast_search_' + sPos).val() == scQSInitVal && scQSInit) {
       $('#SC_fast_search_close_' + sPos).show();
       $('#SC_fast_search_submit_' + sPos).hide();
     }
     else {
       $('#SC_fast_search_close_' + sPos).hide();
       $('#SC_fast_search_submit_' + sPos).show();
     }
     if (null != e) {
       var keyPressed = e.charCode || e.keyCode || e.which;
       if (13 == keyPressed) {
         if ('t' == sPos) scQuickSearchSubmit_t();
       }
     }
   }
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['recarga'];
}
?>
<body class="scFormPage" style="<?php echo $str_iframe_body; ?>">
<?php

if (isset($_SESSION['scriptcase']['form_edit_project_method']['error_buffer']) && '' != $_SESSION['scriptcase']['form_edit_project_method']['error_buffer'])
{
    echo $_SESSION['scriptcase']['form_edit_project_method']['error_buffer'];
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
 include_once("form_edit_project_method_mob_js0.php");
?>
<script type="text/javascript"> 
nmdg_enter_tab = true;
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
               action="form_edit_project_method_mob.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_edit_project_method_mob'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_edit_project_method_mob'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0  width="80%">
 <tr>
  <td>
  <div class="scFormBorder">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
  if (!$this->Embutida_call && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['mostra_cab']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['mostra_cab'] != "N") && (!$_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard'] || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['compact_mode'] || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['maximized']))
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
          <?php if ($this->nmgp_opcao == "novo") { echo "Form Entry Data Proyek"; } else { echo "Form Update Data Proyek"; } ?>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R")
{
    $NM_btn = false;
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['fast_search'][2] : "";
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <input type="hidden" name="nmgp_fast_search_t" value="SC_all_Cmp">
          <input type="hidden" name="nmgp_cond_fast_search_t" value="qp">
          <script type="text/javascript">var scQSInitVal = "<?php echo $OPC_dat ?>";</script>
          <span id="quicksearchph_t">
           <input type="text" id="SC_fast_search_t" class="scFormToolbarInput" style="vertical-align: middle" name="nmgp_arg_fast_search_t" value="<?php echo $this->form_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{maxLength: 255}" placeholder="masukkan ID Project">
           <img style="position: absolute; display: none; height: 16px; width: 16px" id="SC_fast_search_close_t" src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean; ?>" onclick="document.getElementById('SC_fast_search_t').value = ''; nm_move('fast_search', 't');">
           <img style="position: absolute; display: none; height: 16px; width: 16px" id="SC_fast_search_submit_t" src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search; ?>" onclick="scQuickSearchSubmit_t();">
          </span>
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['copy'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bcopy", "nm_move ('clone');", "nm_move ('clone');", "sc_b_clone_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
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
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_t')", "scBtnGrpShow('group_1_t')", "sc_btgp_btn_group_1_t", "", "Pilih Proses", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "__sc_grp__");?>
 
<?php
?>
<table style="border-collapse: collapse; border-width: 0; display: none; position: absolute; z-index: 1000" id="sc_btgp_div_group_1_t">
 <tr><td class="scBtnGrpBackground">
<?php
?>
 </td></tr>
</table>
<?php
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "document.F5.action='" . $nm_url_saida. "'; document.F5.submit();", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['empty_filter'] = true;
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
   if (!isset($this->nmgp_cmp_hidden['tp_status']))
   {
       $this->nmgp_cmp_hidden['tp_status'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['tp_targetwaktu']))
   {
       $this->nmgp_cmp_hidden['tp_targetwaktu'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable" width="100%" style="height: 100%;"><?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['tp_id']))
           {
               $this->nmgp_cmp_readonly['tp_id'] = 'on';
           }
?>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_id']))
    {
        $this->nm_new_label['tp_id'] = "ID Project";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_id = $this->tp_id;
   $sStyleHidden_tp_id = '';
   if (isset($this->nmgp_cmp_hidden['tp_id']) && $this->nmgp_cmp_hidden['tp_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_id']);
       $sStyleHidden_tp_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_id = 'display: none;';
   $sStyleReadInp_tp_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["tp_id"]) &&  $this->nmgp_cmp_readonly["tp_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_id']);
       $sStyleReadLab_tp_id = '';
       $sStyleReadInp_tp_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_id']) && $this->nmgp_cmp_hidden['tp_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_id" value="<?php echo $this->form_encode_input($tp_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOdd css_tp_id_line" id="hidden_field_data_tp_id" style="<?php echo $sStyleHidden_tp_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_id_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_id_label"><span id="id_label_tp_id"><?php echo $this->nm_new_label['tp_id']; ?></span></span><br><span id="id_read_on_tp_id" class="css_tp_id_line" style="<?php echo $sStyleReadLab_tp_id; ?>"><?php echo $this->form_encode_input($this->tp_id); ?></span><span id="id_read_off_tp_id" style="<?php echo $sStyleReadInp_tp_id; ?>"><input type="hidden" name="tp_id" value="<?php echo $this->form_encode_input($tp_id) . "\">"?><span id="id_ajax_label_tp_id"><?php echo nl2br($tp_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_id_text"></span></td></tr></table></td></tr></table> </TD>
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
   if (!isset($this->nm_new_label['tp_thn_release']))
   {
       $this->nm_new_label['tp_thn_release'] = "Project Release";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_thn_release = $this->tp_thn_release;
   $sStyleHidden_tp_thn_release = '';
   if (isset($this->nmgp_cmp_hidden['tp_thn_release']) && $this->nmgp_cmp_hidden['tp_thn_release'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_thn_release']);
       $sStyleHidden_tp_thn_release = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_thn_release = 'display: none;';
   $sStyleReadInp_tp_thn_release = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_thn_release']) && $this->nmgp_cmp_readonly['tp_thn_release'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_thn_release']);
       $sStyleReadLab_tp_thn_release = '';
       $sStyleReadInp_tp_thn_release = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_thn_release']) && $this->nmgp_cmp_hidden['tp_thn_release'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tp_thn_release" value="<?php echo $this->form_encode_input($this->tp_thn_release) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_thn_release_line" id="hidden_field_data_tp_thn_release" style="<?php echo $sStyleHidden_tp_thn_release; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_thn_release_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_thn_release_label"><span id="id_label_tp_thn_release"><?php echo $this->nm_new_label['tp_thn_release']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_thn_release"]) &&  $this->nmgp_cmp_readonly["tp_thn_release"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_thn_release']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_thn_release'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_thn_release']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_thn_release'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_thn_release']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_thn_release'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_thn_release']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_thn_release'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_status = $this->tp_status;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_status = $this->tp_status;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;

   $nm_comando = "SELECT TMT_TAHUN  FROM AKSESSMR.TBL_MAS_TAHUN  ORDER BY TMT_TAHUN";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_status = $old_value_tp_status;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_thn_release'][] = $rs->fields[0];
              $nmgp_def_dados .= $rs->fields[0] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
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
   $tp_thn_release_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_thn_release_1))
          {
              foreach ($this->tp_thn_release_1 as $tmp_tp_thn_release)
              {
                  if (trim($tmp_tp_thn_release) === trim($cadaselect[1])) { $tp_thn_release_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_thn_release) === trim($cadaselect[1])) { $tp_thn_release_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tp_thn_release" value="<?php echo $this->form_encode_input($tp_thn_release) . "\">" . $tp_thn_release_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tp_thn_release();
   $x = 0 ; 
   $tp_thn_release_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_thn_release_1))
          {
              foreach ($this->tp_thn_release_1 as $tmp_tp_thn_release)
              {
                  if (trim($tmp_tp_thn_release) === trim($cadaselect[1])) { $tp_thn_release_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_thn_release) === trim($cadaselect[1])) { $tp_thn_release_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tp_thn_release_look))
          {
              $tp_thn_release_look = $this->tp_thn_release;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tp_thn_release\" class=\"css_tp_thn_release_line\" style=\"" .  $sStyleReadLab_tp_thn_release . "\">" . $this->form_encode_input($tp_thn_release_look) . "</span><span id=\"id_read_off_tp_thn_release\" style=\"" . $sStyleReadInp_tp_thn_release . "\">";
   echo " <span id=\"idAjaxSelect_tp_thn_release\"><select class=\"sc-js-input scFormObjectOdd css_tp_thn_release_obj\" style=\"\" id=\"id_sc_field_tp_thn_release\" name=\"tp_thn_release\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_thn_release'][] = ''; 
   echo "  <option value=\"\"></option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tp_thn_release) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tp_thn_release)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_thn_release_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_thn_release_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tp_prjtrelease']))
   {
       $this->nm_new_label['tp_prjtrelease'] = "Sub-Release";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_prjtrelease = $this->tp_prjtrelease;
   $sStyleHidden_tp_prjtrelease = '';
   if (isset($this->nmgp_cmp_hidden['tp_prjtrelease']) && $this->nmgp_cmp_hidden['tp_prjtrelease'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_prjtrelease']);
       $sStyleHidden_tp_prjtrelease = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_prjtrelease = 'display: none;';
   $sStyleReadInp_tp_prjtrelease = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_prjtrelease']) && $this->nmgp_cmp_readonly['tp_prjtrelease'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_prjtrelease']);
       $sStyleReadLab_tp_prjtrelease = '';
       $sStyleReadInp_tp_prjtrelease = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_prjtrelease']) && $this->nmgp_cmp_hidden['tp_prjtrelease'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tp_prjtrelease" value="<?php echo $this->form_encode_input($this->tp_prjtrelease) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_prjtrelease_line" id="hidden_field_data_tp_prjtrelease" style="<?php echo $sStyleHidden_tp_prjtrelease; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_prjtrelease_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_prjtrelease_label"><span id="id_label_tp_prjtrelease"><?php echo $this->nm_new_label['tp_prjtrelease']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_prjtrelease']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_prjtrelease'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_prjtrelease"]) &&  $this->nmgp_cmp_readonly["tp_prjtrelease"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_prjtrelease']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_prjtrelease'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_prjtrelease']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_prjtrelease'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_prjtrelease']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_prjtrelease'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_prjtrelease']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_prjtrelease'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_status = $this->tp_status;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_status = $this->tp_status;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;

   $nm_comando = "SELECT TP_RELEASE, TP_RELEASENAME  FROM AKSESSMR.TBL_PROJECTRELEASE  ORDER BY TP_RELEASENAME";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_status = $old_value_tp_status;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_prjtrelease'][] = $rs->fields[0];
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
   $tp_prjtrelease_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_prjtrelease_1))
          {
              foreach ($this->tp_prjtrelease_1 as $tmp_tp_prjtrelease)
              {
                  if (trim($tmp_tp_prjtrelease) === trim($cadaselect[1])) { $tp_prjtrelease_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_prjtrelease) === trim($cadaselect[1])) { $tp_prjtrelease_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tp_prjtrelease" value="<?php echo $this->form_encode_input($tp_prjtrelease) . "\">" . $tp_prjtrelease_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tp_prjtrelease();
   $x = 0 ; 
   $tp_prjtrelease_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_prjtrelease_1))
          {
              foreach ($this->tp_prjtrelease_1 as $tmp_tp_prjtrelease)
              {
                  if (trim($tmp_tp_prjtrelease) === trim($cadaselect[1])) { $tp_prjtrelease_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_prjtrelease) === trim($cadaselect[1])) { $tp_prjtrelease_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tp_prjtrelease_look))
          {
              $tp_prjtrelease_look = $this->tp_prjtrelease;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tp_prjtrelease\" class=\"css_tp_prjtrelease_line\" style=\"" .  $sStyleReadLab_tp_prjtrelease . "\">" . $this->form_encode_input($tp_prjtrelease_look) . "</span><span id=\"id_read_off_tp_prjtrelease\" style=\"" . $sStyleReadInp_tp_prjtrelease . "\">";
   echo " <span id=\"idAjaxSelect_tp_prjtrelease\"><select class=\"sc-js-input scFormObjectOdd css_tp_prjtrelease_obj\" style=\"\" id=\"id_sc_field_tp_prjtrelease\" name=\"tp_prjtrelease\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_prjtrelease'][] = ''; 
   echo "  <option value=\"\"></option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tp_prjtrelease) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tp_prjtrelease)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_prjtrelease_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_prjtrelease_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tp_batch']))
   {
       $this->nm_new_label['tp_batch'] = "Batch";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_batch = $this->tp_batch;
   $sStyleHidden_tp_batch = '';
   if (isset($this->nmgp_cmp_hidden['tp_batch']) && $this->nmgp_cmp_hidden['tp_batch'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_batch']);
       $sStyleHidden_tp_batch = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_batch = 'display: none;';
   $sStyleReadInp_tp_batch = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_batch']) && $this->nmgp_cmp_readonly['tp_batch'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_batch']);
       $sStyleReadLab_tp_batch = '';
       $sStyleReadInp_tp_batch = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_batch']) && $this->nmgp_cmp_hidden['tp_batch'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tp_batch" value="<?php echo $this->form_encode_input($this->tp_batch) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_batch_line" id="hidden_field_data_tp_batch" style="<?php echo $sStyleHidden_tp_batch; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_batch_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_batch_label"><span id="id_label_tp_batch"><?php echo $this->nm_new_label['tp_batch']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_batch"]) &&  $this->nmgp_cmp_readonly["tp_batch"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_batch']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_batch'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_batch']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_batch'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_batch']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_batch'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_batch']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_batch'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_status = $this->tp_status;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_status = $this->tp_status;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;

   $nm_comando = "SELECT KODESP, NAMABATCH  FROM AKSESSMR.TBL_BATCH  ORDER BY NAMABATCH";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_status = $old_value_tp_status;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_batch'][] = $rs->fields[0];
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
   $tp_batch_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_batch_1))
          {
              foreach ($this->tp_batch_1 as $tmp_tp_batch)
              {
                  if (trim($tmp_tp_batch) === trim($cadaselect[1])) { $tp_batch_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_batch) === trim($cadaselect[1])) { $tp_batch_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tp_batch" value="<?php echo $this->form_encode_input($tp_batch) . "\">" . $tp_batch_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tp_batch();
   $x = 0 ; 
   $tp_batch_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_batch_1))
          {
              foreach ($this->tp_batch_1 as $tmp_tp_batch)
              {
                  if (trim($tmp_tp_batch) === trim($cadaselect[1])) { $tp_batch_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_batch) === trim($cadaselect[1])) { $tp_batch_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tp_batch_look))
          {
              $tp_batch_look = $this->tp_batch;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tp_batch\" class=\"css_tp_batch_line\" style=\"" .  $sStyleReadLab_tp_batch . "\">" . $this->form_encode_input($tp_batch_look) . "</span><span id=\"id_read_off_tp_batch\" style=\"" . $sStyleReadInp_tp_batch . "\">";
   echo " <span id=\"idAjaxSelect_tp_batch\"><select class=\"sc-js-input scFormObjectOdd css_tp_batch_obj\" style=\"\" id=\"id_sc_field_tp_batch\" name=\"tp_batch\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_batch'][] = ''; 
   echo "  <option value=\"\">Pilh Batch</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tp_batch) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tp_batch)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_batch_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_batch_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_idlop']))
    {
        $this->nm_new_label['tp_idlop'] = "ID LOP";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_idlop = $this->tp_idlop;
   $sStyleHidden_tp_idlop = '';
   if (isset($this->nmgp_cmp_hidden['tp_idlop']) && $this->nmgp_cmp_hidden['tp_idlop'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_idlop']);
       $sStyleHidden_tp_idlop = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_idlop = 'display: none;';
   $sStyleReadInp_tp_idlop = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_idlop']) && $this->nmgp_cmp_readonly['tp_idlop'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_idlop']);
       $sStyleReadLab_tp_idlop = '';
       $sStyleReadInp_tp_idlop = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_idlop']) && $this->nmgp_cmp_hidden['tp_idlop'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_idlop" value="<?php echo $this->form_encode_input($tp_idlop) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_idlop_line" id="hidden_field_data_tp_idlop" style="<?php echo $sStyleHidden_tp_idlop; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_idlop_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_idlop_label"><span id="id_label_tp_idlop"><?php echo $this->nm_new_label['tp_idlop']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_idlop"]) &&  $this->nmgp_cmp_readonly["tp_idlop"] == "on") { 

 ?>
<input type="hidden" name="tp_idlop" value="<?php echo $this->form_encode_input($tp_idlop) . "\">" . $tp_idlop . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_idlop" class="sc-ui-readonly-tp_idlop css_tp_idlop_line" style="<?php echo $sStyleReadLab_tp_idlop; ?>"><?php echo $this->form_encode_input($this->tp_idlop); ?></span><span id="id_read_off_tp_idlop" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_idlop; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_idlop_obj" style="" id="id_sc_field_tp_idlop" type=text name="tp_idlop" value="<?php echo $this->form_encode_input($tp_idlop) ?>"
 size=20 maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_idlop_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_idlop_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_namalop']))
    {
        $this->nm_new_label['tp_namalop'] = "Nama LOP";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_namalop = $this->tp_namalop;
   $sStyleHidden_tp_namalop = '';
   if (isset($this->nmgp_cmp_hidden['tp_namalop']) && $this->nmgp_cmp_hidden['tp_namalop'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_namalop']);
       $sStyleHidden_tp_namalop = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_namalop = 'display: none;';
   $sStyleReadInp_tp_namalop = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_namalop']) && $this->nmgp_cmp_readonly['tp_namalop'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_namalop']);
       $sStyleReadLab_tp_namalop = '';
       $sStyleReadInp_tp_namalop = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_namalop']) && $this->nmgp_cmp_hidden['tp_namalop'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_namalop" value="<?php echo $this->form_encode_input($tp_namalop) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_namalop_line" id="hidden_field_data_tp_namalop" style="<?php echo $sStyleHidden_tp_namalop; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_namalop_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_namalop_label"><span id="id_label_tp_namalop"><?php echo $this->nm_new_label['tp_namalop']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_namalop"]) &&  $this->nmgp_cmp_readonly["tp_namalop"] == "on") { 

 ?>
<input type="hidden" name="tp_namalop" value="<?php echo $this->form_encode_input($tp_namalop) . "\">" . $tp_namalop . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_namalop" class="sc-ui-readonly-tp_namalop css_tp_namalop_line" style="<?php echo $sStyleReadLab_tp_namalop; ?>"><?php echo $this->form_encode_input($this->tp_namalop); ?></span><span id="id_read_off_tp_namalop" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_namalop; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_namalop_obj" style="" id="id_sc_field_tp_namalop" type=text name="tp_namalop" value="<?php echo $this->form_encode_input($tp_namalop) ?>"
 size=40 maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'words', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_namalop_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_namalop_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tp_templateproject']))
   {
       $this->nm_new_label['tp_templateproject'] = "Project Template";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_templateproject = $this->tp_templateproject;
   $sStyleHidden_tp_templateproject = '';
   if (isset($this->nmgp_cmp_hidden['tp_templateproject']) && $this->nmgp_cmp_hidden['tp_templateproject'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_templateproject']);
       $sStyleHidden_tp_templateproject = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_templateproject = 'display: none;';
   $sStyleReadInp_tp_templateproject = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_templateproject']) && $this->nmgp_cmp_readonly['tp_templateproject'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_templateproject']);
       $sStyleReadLab_tp_templateproject = '';
       $sStyleReadInp_tp_templateproject = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_templateproject']) && $this->nmgp_cmp_hidden['tp_templateproject'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tp_templateproject" value="<?php echo $this->form_encode_input($this->tp_templateproject) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_templateproject_line" id="hidden_field_data_tp_templateproject" style="<?php echo $sStyleHidden_tp_templateproject; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_templateproject_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_templateproject_label"><span id="id_label_tp_templateproject"><?php echo $this->nm_new_label['tp_templateproject']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_templateproject']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_templateproject'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_templateproject"]) &&  $this->nmgp_cmp_readonly["tp_templateproject"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_templateproject']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_templateproject'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_templateproject']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_templateproject'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_templateproject']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_templateproject'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_templateproject']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_templateproject'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_status = $this->tp_status;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_status = $this->tp_status;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;

   $nm_comando = "SELECT IDTEMPLATE, TEMPLATENAME  FROM AKSESSMR.TB_MASTER_TEMPLATE  ORDER BY TEMPLATENAME";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_status = $old_value_tp_status;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_templateproject'][] = $rs->fields[0];
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
   $tp_templateproject_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_templateproject_1))
          {
              foreach ($this->tp_templateproject_1 as $tmp_tp_templateproject)
              {
                  if (trim($tmp_tp_templateproject) === trim($cadaselect[1])) { $tp_templateproject_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_templateproject) === trim($cadaselect[1])) { $tp_templateproject_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tp_templateproject" value="<?php echo $this->form_encode_input($tp_templateproject) . "\">" . $tp_templateproject_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tp_templateproject();
   $x = 0 ; 
   $tp_templateproject_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_templateproject_1))
          {
              foreach ($this->tp_templateproject_1 as $tmp_tp_templateproject)
              {
                  if (trim($tmp_tp_templateproject) === trim($cadaselect[1])) { $tp_templateproject_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_templateproject) === trim($cadaselect[1])) { $tp_templateproject_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tp_templateproject_look))
          {
              $tp_templateproject_look = $this->tp_templateproject;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tp_templateproject\" class=\"css_tp_templateproject_line\" style=\"" .  $sStyleReadLab_tp_templateproject . "\">" . $this->form_encode_input($tp_templateproject_look) . "</span><span id=\"id_read_off_tp_templateproject\" style=\"" . $sStyleReadInp_tp_templateproject . "\">";
   echo " <span id=\"idAjaxSelect_tp_templateproject\"><select class=\"sc-js-input scFormObjectOdd css_tp_templateproject_obj\" style=\"\" id=\"id_sc_field_tp_templateproject\" name=\"tp_templateproject\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_templateproject'][] = ''; 
   echo "  <option value=\"\"></option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tp_templateproject) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tp_templateproject)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_templateproject_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_templateproject_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_targetwaktu']))
    {
        $this->nm_new_label['tp_targetwaktu'] = "Target(hari)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_targetwaktu = $this->tp_targetwaktu;
   if (!isset($this->nmgp_cmp_hidden['tp_targetwaktu']))
   {
       $this->nmgp_cmp_hidden['tp_targetwaktu'] = 'off';
   }
   $sStyleHidden_tp_targetwaktu = '';
   if (isset($this->nmgp_cmp_hidden['tp_targetwaktu']) && $this->nmgp_cmp_hidden['tp_targetwaktu'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_targetwaktu']);
       $sStyleHidden_tp_targetwaktu = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_targetwaktu = 'display: none;';
   $sStyleReadInp_tp_targetwaktu = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_targetwaktu']) && $this->nmgp_cmp_readonly['tp_targetwaktu'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_targetwaktu']);
       $sStyleReadLab_tp_targetwaktu = '';
       $sStyleReadInp_tp_targetwaktu = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_targetwaktu']) && $this->nmgp_cmp_hidden['tp_targetwaktu'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_targetwaktu" value="<?php echo $this->form_encode_input($tp_targetwaktu) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_targetwaktu_line" id="hidden_field_data_tp_targetwaktu" style="<?php echo $sStyleHidden_tp_targetwaktu; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_targetwaktu_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_targetwaktu_label"><span id="id_label_tp_targetwaktu"><?php echo $this->nm_new_label['tp_targetwaktu']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_targetwaktu']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_targetwaktu'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_targetwaktu"]) &&  $this->nmgp_cmp_readonly["tp_targetwaktu"] == "on") { 

 ?>
<input type="hidden" name="tp_targetwaktu" value="<?php echo $this->form_encode_input($tp_targetwaktu) . "\">" . $tp_targetwaktu . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_targetwaktu" class="sc-ui-readonly-tp_targetwaktu css_tp_targetwaktu_line" style="<?php echo $sStyleReadLab_tp_targetwaktu; ?>"><?php echo $this->form_encode_input($this->tp_targetwaktu); ?></span><span id="id_read_off_tp_targetwaktu" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_targetwaktu; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_targetwaktu_obj" style="" id="id_sc_field_tp_targetwaktu" type=text name="tp_targetwaktu" value="<?php echo $this->form_encode_input($tp_targetwaktu) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tp_targetwaktu']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tp_targetwaktu']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_targetwaktu_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_targetwaktu_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tp_jenisproject']))
   {
       $this->nm_new_label['tp_jenisproject'] = "Jenis Project";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_jenisproject = $this->tp_jenisproject;
   $sStyleHidden_tp_jenisproject = '';
   if (isset($this->nmgp_cmp_hidden['tp_jenisproject']) && $this->nmgp_cmp_hidden['tp_jenisproject'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_jenisproject']);
       $sStyleHidden_tp_jenisproject = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_jenisproject = 'display: none;';
   $sStyleReadInp_tp_jenisproject = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_jenisproject']) && $this->nmgp_cmp_readonly['tp_jenisproject'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_jenisproject']);
       $sStyleReadLab_tp_jenisproject = '';
       $sStyleReadInp_tp_jenisproject = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_jenisproject']) && $this->nmgp_cmp_hidden['tp_jenisproject'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tp_jenisproject" value="<?php echo $this->form_encode_input($this->tp_jenisproject) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_jenisproject_line" id="hidden_field_data_tp_jenisproject" style="<?php echo $sStyleHidden_tp_jenisproject; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_jenisproject_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_jenisproject_label"><span id="id_label_tp_jenisproject"><?php echo $this->nm_new_label['tp_jenisproject']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_jenisproject']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_jenisproject'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_jenisproject"]) &&  $this->nmgp_cmp_readonly["tp_jenisproject"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_jenisproject']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_jenisproject'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_jenisproject']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_jenisproject'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_jenisproject']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_jenisproject'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_jenisproject']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_jenisproject'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_status = $this->tp_status;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_status = $this->tp_status;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;

   $nm_comando = "SELECT TJ_IDJENIS, TJ_NAMAJENIS  FROM AKSESSMR.TBL_JENISPROJECT  ORDER BY TJ_NAMAJENIS";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_status = $old_value_tp_status;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_jenisproject'][] = $rs->fields[0];
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
   $tp_jenisproject_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_jenisproject_1))
          {
              foreach ($this->tp_jenisproject_1 as $tmp_tp_jenisproject)
              {
                  if (trim($tmp_tp_jenisproject) === trim($cadaselect[1])) { $tp_jenisproject_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_jenisproject) === trim($cadaselect[1])) { $tp_jenisproject_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tp_jenisproject" value="<?php echo $this->form_encode_input($tp_jenisproject) . "\">" . $tp_jenisproject_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tp_jenisproject();
   $x = 0 ; 
   $tp_jenisproject_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_jenisproject_1))
          {
              foreach ($this->tp_jenisproject_1 as $tmp_tp_jenisproject)
              {
                  if (trim($tmp_tp_jenisproject) === trim($cadaselect[1])) { $tp_jenisproject_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_jenisproject) === trim($cadaselect[1])) { $tp_jenisproject_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tp_jenisproject_look))
          {
              $tp_jenisproject_look = $this->tp_jenisproject;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tp_jenisproject\" class=\"css_tp_jenisproject_line\" style=\"" .  $sStyleReadLab_tp_jenisproject . "\">" . $this->form_encode_input($tp_jenisproject_look) . "</span><span id=\"id_read_off_tp_jenisproject\" style=\"" . $sStyleReadInp_tp_jenisproject . "\">";
   echo " <span id=\"idAjaxSelect_tp_jenisproject\"><select class=\"sc-js-input scFormObjectOdd css_tp_jenisproject_obj\" style=\"\" id=\"id_sc_field_tp_jenisproject\" name=\"tp_jenisproject\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_jenisproject'][] = ''; 
   echo "  <option value=\"\"></option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tp_jenisproject) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tp_jenisproject)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_jenisproject_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_jenisproject_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_projectname']))
    {
        $this->nm_new_label['tp_projectname'] = "Nama Project";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_projectname = $this->tp_projectname;
   $sStyleHidden_tp_projectname = '';
   if (isset($this->nmgp_cmp_hidden['tp_projectname']) && $this->nmgp_cmp_hidden['tp_projectname'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_projectname']);
       $sStyleHidden_tp_projectname = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_projectname = 'display: none;';
   $sStyleReadInp_tp_projectname = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_projectname']) && $this->nmgp_cmp_readonly['tp_projectname'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_projectname']);
       $sStyleReadLab_tp_projectname = '';
       $sStyleReadInp_tp_projectname = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_projectname']) && $this->nmgp_cmp_hidden['tp_projectname'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_projectname" value="<?php echo $this->form_encode_input($tp_projectname) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_projectname_line" id="hidden_field_data_tp_projectname" style="<?php echo $sStyleHidden_tp_projectname; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_projectname_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_projectname_label"><span id="id_label_tp_projectname"><?php echo $this->nm_new_label['tp_projectname']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_projectname']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_projectname'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php
$tp_projectname_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($tp_projectname));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_projectname"]) &&  $this->nmgp_cmp_readonly["tp_projectname"] == "on") { 

 ?>
<input type="hidden" name="tp_projectname" value="<?php echo $this->form_encode_input($tp_projectname) . "\">" . $tp_projectname_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_projectname" class="sc-ui-readonly-tp_projectname css_tp_projectname_line" style="<?php echo $sStyleReadLab_tp_projectname; ?>"><?php echo $this->form_encode_input($tp_projectname_val); ?></span><span id="id_read_off_tp_projectname" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_projectname; ?>">
 <textarea  class="sc-js-input scFormObjectOdd css_tp_projectname_obj" style="white-space: pre-wrap;" name="tp_projectname" id="id_sc_field_tp_projectname" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $tp_projectname; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_projectname_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_projectname_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['tp_planfinish']))
           {
               $this->nmgp_cmp_readonly['tp_planfinish'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['tp_planstart']))
    {
        $this->nm_new_label['tp_planstart'] = "Tgl Mulai(Plan)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_planstart = $this->tp_planstart;
   $sStyleHidden_tp_planstart = '';
   if (isset($this->nmgp_cmp_hidden['tp_planstart']) && $this->nmgp_cmp_hidden['tp_planstart'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_planstart']);
       $sStyleHidden_tp_planstart = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_planstart = 'display: none;';
   $sStyleReadInp_tp_planstart = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_planstart']) && $this->nmgp_cmp_readonly['tp_planstart'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_planstart']);
       $sStyleReadLab_tp_planstart = '';
       $sStyleReadInp_tp_planstart = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_planstart']) && $this->nmgp_cmp_hidden['tp_planstart'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_planstart" value="<?php echo $this->form_encode_input($tp_planstart) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_planstart_line" id="hidden_field_data_tp_planstart" style="<?php echo $sStyleHidden_tp_planstart; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_planstart_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_planstart_label"><span id="id_label_tp_planstart"><?php echo $this->nm_new_label['tp_planstart']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_planstart']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_planstart'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_planstart"]) &&  $this->nmgp_cmp_readonly["tp_planstart"] == "on") { 

 ?>
<input type="hidden" name="tp_planstart" value="<?php echo $this->form_encode_input($tp_planstart) . "\">" . $tp_planstart . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_planstart" class="sc-ui-readonly-tp_planstart css_tp_planstart_line" style="<?php echo $sStyleReadLab_tp_planstart; ?>"><?php echo $this->form_encode_input($tp_planstart); ?></span><span id="id_read_off_tp_planstart" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_planstart; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_planstart_obj" style="" id="id_sc_field_tp_planstart" type=text name="tp_planstart" value="<?php echo $this->form_encode_input($tp_planstart) ?>"
 size=10 alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['tp_planstart']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['tp_planstart']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$tmp_form_data = $this->field_config['tp_planstart']['date_format'];
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_planstart_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_planstart_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['tp_status']))
           {
               $this->nmgp_cmp_readonly['tp_status'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['tp_planfinish']))
    {
        $this->nm_new_label['tp_planfinish'] = "Tgl Selesai(Plan)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_planfinish = $this->tp_planfinish;
   $sStyleHidden_tp_planfinish = '';
   if (isset($this->nmgp_cmp_hidden['tp_planfinish']) && $this->nmgp_cmp_hidden['tp_planfinish'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_planfinish']);
       $sStyleHidden_tp_planfinish = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_planfinish = 'display: none;';
   $sStyleReadInp_tp_planfinish = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["tp_planfinish"]) &&  $this->nmgp_cmp_readonly["tp_planfinish"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_planfinish']);
       $sStyleReadLab_tp_planfinish = '';
       $sStyleReadInp_tp_planfinish = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_planfinish']) && $this->nmgp_cmp_hidden['tp_planfinish'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_planfinish" value="<?php echo $this->form_encode_input($tp_planfinish) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_planfinish_line" id="hidden_field_data_tp_planfinish" style="<?php echo $sStyleHidden_tp_planfinish; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_planfinish_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_planfinish_label"><span id="id_label_tp_planfinish"><?php echo $this->nm_new_label['tp_planfinish']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_planfinish']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_planfinish'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["tp_planfinish"]) &&  $this->nmgp_cmp_readonly["tp_planfinish"] == "on")) { 

 ?>
<input type="hidden" name="tp_planfinish" value="<?php echo $this->form_encode_input($tp_planfinish) . "\"><span id=\"id_ajax_label_tp_planfinish\">" . $tp_planfinish . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_tp_planfinish" class="sc-ui-readonly-tp_planfinish css_tp_planfinish_line" style="<?php echo $sStyleReadLab_tp_planfinish; ?>"><?php echo $this->form_encode_input($tp_planfinish); ?></span><span id="id_read_off_tp_planfinish" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_planfinish; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_planfinish_obj" style="" id="id_sc_field_tp_planfinish" type=text name="tp_planfinish" value="<?php echo $this->form_encode_input($tp_planfinish) ?>"
 size=10 alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['tp_planfinish']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['tp_planfinish']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><?php
$tmp_form_data = $this->field_config['tp_planfinish']['date_format'];
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_planfinish_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_planfinish_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_status']))
    {
        $this->nm_new_label['tp_status'] = "Status Project";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_status = $this->tp_status;
   if (!isset($this->nmgp_cmp_hidden['tp_status']))
   {
       $this->nmgp_cmp_hidden['tp_status'] = 'off';
   }
   $sStyleHidden_tp_status = '';
   if (isset($this->nmgp_cmp_hidden['tp_status']) && $this->nmgp_cmp_hidden['tp_status'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_status']);
       $sStyleHidden_tp_status = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_status = 'display: none;';
   $sStyleReadInp_tp_status = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["tp_status"]) &&  $this->nmgp_cmp_readonly["tp_status"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_status']);
       $sStyleReadLab_tp_status = '';
       $sStyleReadInp_tp_status = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_status']) && $this->nmgp_cmp_hidden['tp_status'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_status" value="<?php echo $this->form_encode_input($tp_status) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_status_line" id="hidden_field_data_tp_status" style="<?php echo $sStyleHidden_tp_status; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_status_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_status_label"><span id="id_label_tp_status"><?php echo $this->nm_new_label['tp_status']; ?></span></span><br>
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["tp_status"]) &&  $this->nmgp_cmp_readonly["tp_status"] == "on")) { 

 ?>
<input type="hidden" name="tp_status" value="<?php echo $this->form_encode_input($tp_status) . "\"><span id=\"id_ajax_label_tp_status\">" . $tp_status . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_tp_status" class="sc-ui-readonly-tp_status css_tp_status_line" style="<?php echo $sStyleReadLab_tp_status; ?>"><?php echo $this->form_encode_input($this->tp_status); ?></span><span id="id_read_off_tp_status" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_status; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_status_obj" style="" id="id_sc_field_tp_status" type=text name="tp_status" value="<?php echo $this->form_encode_input($tp_status) ?>"
 size=5 alt="{datatype: 'integer', maxLength: 5, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tp_status']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tp_status']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_status_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_tp_status_dumb = ('' == $sStyleHidden_tp_status) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_tp_status_dumb" style="<?php echo $sStyleHidden_tp_status_dumb; ?>"></TD>
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
   if (!isset($this->nm_new_label['tp_divre']))
   {
       $this->nm_new_label['tp_divre'] = "Divre";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_divre = $this->tp_divre;
   $sStyleHidden_tp_divre = '';
   if (isset($this->nmgp_cmp_hidden['tp_divre']) && $this->nmgp_cmp_hidden['tp_divre'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_divre']);
       $sStyleHidden_tp_divre = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_divre = 'display: none;';
   $sStyleReadInp_tp_divre = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_divre']) && $this->nmgp_cmp_readonly['tp_divre'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_divre']);
       $sStyleReadLab_tp_divre = '';
       $sStyleReadInp_tp_divre = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_divre']) && $this->nmgp_cmp_hidden['tp_divre'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tp_divre" value="<?php echo $this->form_encode_input($this->tp_divre) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_divre_line" id="hidden_field_data_tp_divre" style="<?php echo $sStyleHidden_tp_divre; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_divre_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_divre_label"><span id="id_label_tp_divre"><?php echo $this->nm_new_label['tp_divre']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_divre']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_divre'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_divre"]) &&  $this->nmgp_cmp_readonly["tp_divre"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_divre']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_divre'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_divre']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_divre'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_divre']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_divre'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_divre']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_divre'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_status = $this->tp_status;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_status = $this->tp_status;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;

   $nm_comando = "SELECT MD_IDDIVRE, MD_KODEDIVRE  FROM AKSESSMR.TBL_MAS_DIVRE WHERE MD_IDDIVRE='" . $_SESSION['iddivre'] . "'  ORDER BY MD_KODEDIVRE";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_status = $old_value_tp_status;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_divre'][] = $rs->fields[0];
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
   $tp_divre_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_divre_1))
          {
              foreach ($this->tp_divre_1 as $tmp_tp_divre)
              {
                  if (trim($tmp_tp_divre) === trim($cadaselect[1])) { $tp_divre_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_divre) === trim($cadaselect[1])) { $tp_divre_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tp_divre" value="<?php echo $this->form_encode_input($tp_divre) . "\">" . $tp_divre_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tp_divre();
   $x = 0 ; 
   $tp_divre_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_divre_1))
          {
              foreach ($this->tp_divre_1 as $tmp_tp_divre)
              {
                  if (trim($tmp_tp_divre) === trim($cadaselect[1])) { $tp_divre_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_divre) === trim($cadaselect[1])) { $tp_divre_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tp_divre_look))
          {
              $tp_divre_look = $this->tp_divre;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tp_divre\" class=\"css_tp_divre_line\" style=\"" .  $sStyleReadLab_tp_divre . "\">" . $this->form_encode_input($tp_divre_look) . "</span><span id=\"id_read_off_tp_divre\" style=\"" . $sStyleReadInp_tp_divre . "\">";
   echo " <span id=\"idAjaxSelect_tp_divre\"><select class=\"sc-js-input scFormObjectOdd css_tp_divre_obj\" style=\"\" id=\"id_sc_field_tp_divre\" name=\"tp_divre\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_divre'][] = ''; 
   echo "  <option value=\"\">Pilih Divre</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tp_divre) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tp_divre)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_divre_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_divre_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tp_witel']))
   {
       $this->nm_new_label['tp_witel'] = "Witel";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_witel = $this->tp_witel;
   $sStyleHidden_tp_witel = '';
   if (isset($this->nmgp_cmp_hidden['tp_witel']) && $this->nmgp_cmp_hidden['tp_witel'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_witel']);
       $sStyleHidden_tp_witel = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_witel = 'display: none;';
   $sStyleReadInp_tp_witel = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_witel']) && $this->nmgp_cmp_readonly['tp_witel'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_witel']);
       $sStyleReadLab_tp_witel = '';
       $sStyleReadInp_tp_witel = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_witel']) && $this->nmgp_cmp_hidden['tp_witel'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tp_witel" value="<?php echo $this->form_encode_input($this->tp_witel) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_witel_line" id="hidden_field_data_tp_witel" style="<?php echo $sStyleHidden_tp_witel; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_witel_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_witel_label"><span id="id_label_tp_witel"><?php echo $this->nm_new_label['tp_witel']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_witel']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_witel'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_witel"]) &&  $this->nmgp_cmp_readonly["tp_witel"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_witel']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_witel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_witel']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_witel'] = array(); 
}
if ($this->tp_divre != "")
{ 
   $this->nm_clear_val("tp_divre");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_witel']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_witel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_witel']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_witel'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_status = $this->tp_status;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_status = $this->tp_status;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;

   $nm_comando = "SELECT MW_IDWITEL, MW_NAMAWITEL  FROM AKSESSMR.TBL_MAS_WITEL  WHERE MW_IDDIVRE='$this->tp_divre' and MW_IDWITEL='" . $_SESSION['idwitel'] . "' ORDER BY MW_NAMAWITEL";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_status = $old_value_tp_status;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_witel'][] = $rs->fields[0];
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
} 
   $x = 0; 
   $tp_witel_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_witel_1))
          {
              foreach ($this->tp_witel_1 as $tmp_tp_witel)
              {
                  if (trim($tmp_tp_witel) === trim($cadaselect[1])) { $tp_witel_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_witel) === trim($cadaselect[1])) { $tp_witel_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tp_witel" value="<?php echo $this->form_encode_input($tp_witel) . "\">" . $tp_witel_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tp_witel();
   $x = 0 ; 
   $tp_witel_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_witel_1))
          {
              foreach ($this->tp_witel_1 as $tmp_tp_witel)
              {
                  if (trim($tmp_tp_witel) === trim($cadaselect[1])) { $tp_witel_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_witel) === trim($cadaselect[1])) { $tp_witel_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tp_witel_look))
          {
              $tp_witel_look = $this->tp_witel;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tp_witel\" class=\"css_tp_witel_line\" style=\"" .  $sStyleReadLab_tp_witel . "\">" . $this->form_encode_input($tp_witel_look) . "</span><span id=\"id_read_off_tp_witel\" style=\"" . $sStyleReadInp_tp_witel . "\">";
   echo " <span id=\"idAjaxSelect_tp_witel\"><select class=\"sc-js-input scFormObjectOdd css_tp_witel_obj\" style=\"\" id=\"id_sc_field_tp_witel\" name=\"tp_witel\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_witel'][] = ''; 
   echo "  <option value=\"\">Pilih Witel</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tp_witel) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tp_witel)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_witel_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_witel_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tp_datel']))
   {
       $this->nm_new_label['tp_datel'] = "Datel";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_datel = $this->tp_datel;
   $sStyleHidden_tp_datel = '';
   if (isset($this->nmgp_cmp_hidden['tp_datel']) && $this->nmgp_cmp_hidden['tp_datel'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_datel']);
       $sStyleHidden_tp_datel = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_datel = 'display: none;';
   $sStyleReadInp_tp_datel = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_datel']) && $this->nmgp_cmp_readonly['tp_datel'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_datel']);
       $sStyleReadLab_tp_datel = '';
       $sStyleReadInp_tp_datel = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_datel']) && $this->nmgp_cmp_hidden['tp_datel'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tp_datel" value="<?php echo $this->form_encode_input($this->tp_datel) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_datel_line" id="hidden_field_data_tp_datel" style="<?php echo $sStyleHidden_tp_datel; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_datel_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_datel_label"><span id="id_label_tp_datel"><?php echo $this->nm_new_label['tp_datel']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_datel']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_datel'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_datel"]) &&  $this->nmgp_cmp_readonly["tp_datel"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_datel']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_datel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_datel']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_datel'] = array(); 
}
if ($this->tp_witel != "")
{ 
   $this->nm_clear_val("tp_witel");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_datel']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_datel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_datel']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_datel'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_status = $this->tp_status;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_status = $this->tp_status;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;

   $nm_comando = "SELECT MD_IDDATEL, MD_NAMADATEL  FROM AKSESSMR.TBL_MAS_DATEL  WHERE MD_IDWITEL='$this->tp_witel'  ORDER BY MD_NAMADATEL";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_status = $old_value_tp_status;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_datel'][] = $rs->fields[0];
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
} 
   $x = 0; 
   $tp_datel_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_datel_1))
          {
              foreach ($this->tp_datel_1 as $tmp_tp_datel)
              {
                  if (trim($tmp_tp_datel) === trim($cadaselect[1])) { $tp_datel_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_datel) === trim($cadaselect[1])) { $tp_datel_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tp_datel" value="<?php echo $this->form_encode_input($tp_datel) . "\">" . $tp_datel_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tp_datel();
   $x = 0 ; 
   $tp_datel_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_datel_1))
          {
              foreach ($this->tp_datel_1 as $tmp_tp_datel)
              {
                  if (trim($tmp_tp_datel) === trim($cadaselect[1])) { $tp_datel_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_datel) === trim($cadaselect[1])) { $tp_datel_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tp_datel_look))
          {
              $tp_datel_look = $this->tp_datel;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tp_datel\" class=\"css_tp_datel_line\" style=\"" .  $sStyleReadLab_tp_datel . "\">" . $this->form_encode_input($tp_datel_look) . "</span><span id=\"id_read_off_tp_datel\" style=\"" . $sStyleReadInp_tp_datel . "\">";
   echo " <span id=\"idAjaxSelect_tp_datel\"><select class=\"sc-js-input scFormObjectOdd css_tp_datel_obj\" style=\"\" id=\"id_sc_field_tp_datel\" name=\"tp_datel\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_datel'][] = ''; 
   echo "  <option value=\"\"></option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tp_datel) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tp_datel)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_datel_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_datel_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tp_sto']))
   {
       $this->nm_new_label['tp_sto'] = "STO";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_sto = $this->tp_sto;
   $sStyleHidden_tp_sto = '';
   if (isset($this->nmgp_cmp_hidden['tp_sto']) && $this->nmgp_cmp_hidden['tp_sto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_sto']);
       $sStyleHidden_tp_sto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_sto = 'display: none;';
   $sStyleReadInp_tp_sto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_sto']) && $this->nmgp_cmp_readonly['tp_sto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_sto']);
       $sStyleReadLab_tp_sto = '';
       $sStyleReadInp_tp_sto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_sto']) && $this->nmgp_cmp_hidden['tp_sto'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tp_sto" value="<?php echo $this->form_encode_input($this->tp_sto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_sto_line" id="hidden_field_data_tp_sto" style="<?php echo $sStyleHidden_tp_sto; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_sto_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_sto_label"><span id="id_label_tp_sto"><?php echo $this->nm_new_label['tp_sto']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_sto']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_sto'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_sto"]) &&  $this->nmgp_cmp_readonly["tp_sto"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_sto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_sto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_sto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_sto'] = array(); 
}
if ($this->tp_datel != "")
{ 
   $this->nm_clear_val("tp_datel");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_sto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_sto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_sto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_sto'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_status = $this->tp_status;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_status = $this->tp_status;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;

   $nm_comando = "SELECT MS_IDSTO, MS_NAMASTO  FROM AKSESSMR.TBL_MAS_STO  WHERE MS_DATEL='$this->tp_datel'  ORDER BY MS_NAMASTO";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_status = $old_value_tp_status;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_sto'][] = $rs->fields[0];
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
} 
   $x = 0; 
   $tp_sto_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_sto_1))
          {
              foreach ($this->tp_sto_1 as $tmp_tp_sto)
              {
                  if (trim($tmp_tp_sto) === trim($cadaselect[1])) { $tp_sto_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_sto) === trim($cadaselect[1])) { $tp_sto_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tp_sto" value="<?php echo $this->form_encode_input($tp_sto) . "\">" . $tp_sto_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tp_sto();
   $x = 0 ; 
   $tp_sto_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_sto_1))
          {
              foreach ($this->tp_sto_1 as $tmp_tp_sto)
              {
                  if (trim($tmp_tp_sto) === trim($cadaselect[1])) { $tp_sto_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_sto) === trim($cadaselect[1])) { $tp_sto_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tp_sto_look))
          {
              $tp_sto_look = $this->tp_sto;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tp_sto\" class=\"css_tp_sto_line\" style=\"" .  $sStyleReadLab_tp_sto . "\">" . $this->form_encode_input($tp_sto_look) . "</span><span id=\"id_read_off_tp_sto\" style=\"" . $sStyleReadInp_tp_sto . "\">";
   echo " <span id=\"idAjaxSelect_tp_sto\"><select class=\"sc-js-input scFormObjectOdd css_tp_sto_obj\" style=\"\" id=\"id_sc_field_tp_sto\" name=\"tp_sto\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_sto'][] = ''; 
   echo "  <option value=\"\">Pilih STO</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tp_sto) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tp_sto)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_sto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_sto_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_lokasi']))
    {
        $this->nm_new_label['tp_lokasi'] = "Lokasi";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_lokasi = $this->tp_lokasi;
   $sStyleHidden_tp_lokasi = '';
   if (isset($this->nmgp_cmp_hidden['tp_lokasi']) && $this->nmgp_cmp_hidden['tp_lokasi'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_lokasi']);
       $sStyleHidden_tp_lokasi = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_lokasi = 'display: none;';
   $sStyleReadInp_tp_lokasi = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_lokasi']) && $this->nmgp_cmp_readonly['tp_lokasi'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_lokasi']);
       $sStyleReadLab_tp_lokasi = '';
       $sStyleReadInp_tp_lokasi = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_lokasi']) && $this->nmgp_cmp_hidden['tp_lokasi'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_lokasi" value="<?php echo $this->form_encode_input($tp_lokasi) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_lokasi_line" id="hidden_field_data_tp_lokasi" style="<?php echo $sStyleHidden_tp_lokasi; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_lokasi_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_lokasi_label"><span id="id_label_tp_lokasi"><?php echo $this->nm_new_label['tp_lokasi']; ?></span></span><br>
<?php
$tp_lokasi_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($tp_lokasi));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_lokasi"]) &&  $this->nmgp_cmp_readonly["tp_lokasi"] == "on") { 

 ?>
<input type="hidden" name="tp_lokasi" value="<?php echo $this->form_encode_input($tp_lokasi) . "\">" . $tp_lokasi_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_lokasi" class="sc-ui-readonly-tp_lokasi css_tp_lokasi_line" style="<?php echo $sStyleReadLab_tp_lokasi; ?>"><?php echo $this->form_encode_input($tp_lokasi_val); ?></span><span id="id_read_off_tp_lokasi" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_lokasi; ?>">
 <textarea  class="sc-js-input scFormObjectOdd css_tp_lokasi_obj" style="white-space: pre-wrap;" name="tp_lokasi" id="id_sc_field_tp_lokasi" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $tp_lokasi; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_lokasi_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_lokasi_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tp_mitra']))
   {
       $this->nm_new_label['tp_mitra'] = "Mitra";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_mitra = $this->tp_mitra;
   $sStyleHidden_tp_mitra = '';
   if (isset($this->nmgp_cmp_hidden['tp_mitra']) && $this->nmgp_cmp_hidden['tp_mitra'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_mitra']);
       $sStyleHidden_tp_mitra = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_mitra = 'display: none;';
   $sStyleReadInp_tp_mitra = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_mitra']) && $this->nmgp_cmp_readonly['tp_mitra'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_mitra']);
       $sStyleReadLab_tp_mitra = '';
       $sStyleReadInp_tp_mitra = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_mitra']) && $this->nmgp_cmp_hidden['tp_mitra'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tp_mitra" value="<?php echo $this->form_encode_input($this->tp_mitra) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_mitra_line" id="hidden_field_data_tp_mitra" style="<?php echo $sStyleHidden_tp_mitra; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_mitra_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_mitra_label"><span id="id_label_tp_mitra"><?php echo $this->nm_new_label['tp_mitra']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_mitra']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['php_cmp_required']['tp_mitra'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_mitra"]) &&  $this->nmgp_cmp_readonly["tp_mitra"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_mitra']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_mitra'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_mitra']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_mitra'] = array(); 
}
if ($this->tp_divre != "" && $this->tp_witel != "")
{ 
   $this->nm_clear_val("tp_divre");
   $this->nm_clear_val("tp_witel");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_mitra']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_mitra'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_mitra']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_mitra'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_status = $this->tp_status;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_status = $this->tp_status;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;

   $nm_comando = "SELECT TM_IDMITRA, TM_NAMAMITRA  FROM AKSESSMR.TBL_MITRA  WHERE TM_DIVRE='$this->tp_divre' AND TM_WITEL='$this->tp_witel'  ORDER BY TM_NAMAMITRA";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_status = $old_value_tp_status;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_mitra'][] = $rs->fields[0];
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
} 
   $x = 0; 
   $tp_mitra_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_mitra_1))
          {
              foreach ($this->tp_mitra_1 as $tmp_tp_mitra)
              {
                  if (trim($tmp_tp_mitra) === trim($cadaselect[1])) { $tp_mitra_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_mitra) === trim($cadaselect[1])) { $tp_mitra_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="tp_mitra" value="<?php echo $this->form_encode_input($tp_mitra) . "\">" . $tp_mitra_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tp_mitra();
   $x = 0 ; 
   $tp_mitra_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tp_mitra_1))
          {
              foreach ($this->tp_mitra_1 as $tmp_tp_mitra)
              {
                  if (trim($tmp_tp_mitra) === trim($cadaselect[1])) { $tp_mitra_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->tp_mitra) === trim($cadaselect[1])) { $tp_mitra_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($tp_mitra_look))
          {
              $tp_mitra_look = $this->tp_mitra;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tp_mitra\" class=\"css_tp_mitra_line\" style=\"" .  $sStyleReadLab_tp_mitra . "\">" . $this->form_encode_input($tp_mitra_look) . "</span><span id=\"id_read_off_tp_mitra\" style=\"" . $sStyleReadInp_tp_mitra . "\">";
   echo " <span id=\"idAjaxSelect_tp_mitra\"><select class=\"sc-js-input scFormObjectOdd css_tp_mitra_obj\" style=\"\" id=\"id_sc_field_tp_mitra\" name=\"tp_mitra\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['Lookup_tp_mitra'][] = ''; 
   echo "  <option value=\"\">Pilih Mitra</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tp_mitra) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tp_mitra)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_mitra_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_mitra_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_nokontrak']))
    {
        $this->nm_new_label['tp_nokontrak'] = "No.Kontrak";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_nokontrak = $this->tp_nokontrak;
   $sStyleHidden_tp_nokontrak = '';
   if (isset($this->nmgp_cmp_hidden['tp_nokontrak']) && $this->nmgp_cmp_hidden['tp_nokontrak'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_nokontrak']);
       $sStyleHidden_tp_nokontrak = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_nokontrak = 'display: none;';
   $sStyleReadInp_tp_nokontrak = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_nokontrak']) && $this->nmgp_cmp_readonly['tp_nokontrak'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_nokontrak']);
       $sStyleReadLab_tp_nokontrak = '';
       $sStyleReadInp_tp_nokontrak = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_nokontrak']) && $this->nmgp_cmp_hidden['tp_nokontrak'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_nokontrak" value="<?php echo $this->form_encode_input($tp_nokontrak) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_nokontrak_line" id="hidden_field_data_tp_nokontrak" style="<?php echo $sStyleHidden_tp_nokontrak; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_nokontrak_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_nokontrak_label"><span id="id_label_tp_nokontrak"><?php echo $this->nm_new_label['tp_nokontrak']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_nokontrak"]) &&  $this->nmgp_cmp_readonly["tp_nokontrak"] == "on") { 

 ?>
<input type="hidden" name="tp_nokontrak" value="<?php echo $this->form_encode_input($tp_nokontrak) . "\">" . $tp_nokontrak . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_nokontrak" class="sc-ui-readonly-tp_nokontrak css_tp_nokontrak_line" style="<?php echo $sStyleReadLab_tp_nokontrak; ?>"><?php echo $this->form_encode_input($this->tp_nokontrak); ?></span><span id="id_read_off_tp_nokontrak" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_nokontrak; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_nokontrak_obj" style="" id="id_sc_field_tp_nokontrak" type=text name="tp_nokontrak" value="<?php echo $this->form_encode_input($tp_nokontrak) ?>"
 size=30 maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_nokontrak_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_nokontrak_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_ponumber']))
    {
        $this->nm_new_label['tp_ponumber'] = "PO.Number";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_ponumber = $this->tp_ponumber;
   $sStyleHidden_tp_ponumber = '';
   if (isset($this->nmgp_cmp_hidden['tp_ponumber']) && $this->nmgp_cmp_hidden['tp_ponumber'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_ponumber']);
       $sStyleHidden_tp_ponumber = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_ponumber = 'display: none;';
   $sStyleReadInp_tp_ponumber = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_ponumber']) && $this->nmgp_cmp_readonly['tp_ponumber'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_ponumber']);
       $sStyleReadLab_tp_ponumber = '';
       $sStyleReadInp_tp_ponumber = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_ponumber']) && $this->nmgp_cmp_hidden['tp_ponumber'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_ponumber" value="<?php echo $this->form_encode_input($tp_ponumber) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_ponumber_line" id="hidden_field_data_tp_ponumber" style="<?php echo $sStyleHidden_tp_ponumber; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_ponumber_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_ponumber_label"><span id="id_label_tp_ponumber"><?php echo $this->nm_new_label['tp_ponumber']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_ponumber"]) &&  $this->nmgp_cmp_readonly["tp_ponumber"] == "on") { 

 ?>
<input type="hidden" name="tp_ponumber" value="<?php echo $this->form_encode_input($tp_ponumber) . "\">" . $tp_ponumber . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_ponumber" class="sc-ui-readonly-tp_ponumber css_tp_ponumber_line" style="<?php echo $sStyleReadLab_tp_ponumber; ?>"><?php echo $this->form_encode_input($this->tp_ponumber); ?></span><span id="id_read_off_tp_ponumber" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_ponumber; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_ponumber_obj" style="" id="id_sc_field_tp_ponumber" type=text name="tp_ponumber" value="<?php echo $this->form_encode_input($tp_ponumber) ?>"
 size=30 maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_ponumber_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_ponumber_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_nilai']))
    {
        $this->nm_new_label['tp_nilai'] = "Nilai Rekon";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_nilai = $this->tp_nilai;
   $sStyleHidden_tp_nilai = '';
   if (isset($this->nmgp_cmp_hidden['tp_nilai']) && $this->nmgp_cmp_hidden['tp_nilai'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_nilai']);
       $sStyleHidden_tp_nilai = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_nilai = 'display: none;';
   $sStyleReadInp_tp_nilai = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_nilai']) && $this->nmgp_cmp_readonly['tp_nilai'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_nilai']);
       $sStyleReadLab_tp_nilai = '';
       $sStyleReadInp_tp_nilai = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_nilai']) && $this->nmgp_cmp_hidden['tp_nilai'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_nilai" value="<?php echo $this->form_encode_input($tp_nilai) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_nilai_line" id="hidden_field_data_tp_nilai" style="<?php echo $sStyleHidden_tp_nilai; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_nilai_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_nilai_label"><span id="id_label_tp_nilai"><?php echo $this->nm_new_label['tp_nilai']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_nilai"]) &&  $this->nmgp_cmp_readonly["tp_nilai"] == "on") { 

 ?>
<input type="hidden" name="tp_nilai" value="<?php echo $this->form_encode_input($tp_nilai) . "\">" . $tp_nilai . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_nilai" class="sc-ui-readonly-tp_nilai css_tp_nilai_line" style="<?php echo $sStyleReadLab_tp_nilai; ?>"><?php echo $this->form_encode_input($this->tp_nilai); ?></span><span id="id_read_off_tp_nilai" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_nilai; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_nilai_obj" style="" id="id_sc_field_tp_nilai" type=text name="tp_nilai" value="<?php echo $this->form_encode_input($tp_nilai) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tp_nilai']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tp_nilai']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_nilai_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_nilai_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_summary']))
    {
        $this->nm_new_label['tp_summary'] = "Deskripsi Project";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_summary = $this->tp_summary;
   $sStyleHidden_tp_summary = '';
   if (isset($this->nmgp_cmp_hidden['tp_summary']) && $this->nmgp_cmp_hidden['tp_summary'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_summary']);
       $sStyleHidden_tp_summary = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_summary = 'display: none;';
   $sStyleReadInp_tp_summary = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_summary']) && $this->nmgp_cmp_readonly['tp_summary'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_summary']);
       $sStyleReadLab_tp_summary = '';
       $sStyleReadInp_tp_summary = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_summary']) && $this->nmgp_cmp_hidden['tp_summary'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_summary" value="<?php echo $this->form_encode_input($tp_summary) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_summary_line" id="hidden_field_data_tp_summary" style="<?php echo $sStyleHidden_tp_summary; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_summary_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_summary_label"><span id="id_label_tp_summary"><?php echo $this->nm_new_label['tp_summary']; ?></span></span><br>
<?php
$tp_summary_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($tp_summary));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_summary"]) &&  $this->nmgp_cmp_readonly["tp_summary"] == "on") { 

 ?>
<input type="hidden" name="tp_summary" value="<?php echo $this->form_encode_input($tp_summary) . "\">" . $tp_summary_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_summary" class="sc-ui-readonly-tp_summary css_tp_summary_line" style="<?php echo $sStyleReadLab_tp_summary; ?>"><?php echo $this->form_encode_input($tp_summary_val); ?></span><span id="id_read_off_tp_summary" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_summary; ?>">
 <textarea  class="sc-js-input scFormObjectOdd css_tp_summary_obj" style="white-space: pre-wrap;" name="tp_summary" id="id_sc_field_tp_summary" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $tp_summary; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_summary_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_summary_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_rab']))
    {
        $this->nm_new_label['tp_rab'] = "Nilai DRM";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_rab = $this->tp_rab;
   $sStyleHidden_tp_rab = '';
   if (isset($this->nmgp_cmp_hidden['tp_rab']) && $this->nmgp_cmp_hidden['tp_rab'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_rab']);
       $sStyleHidden_tp_rab = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_rab = 'display: none;';
   $sStyleReadInp_tp_rab = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_rab']) && $this->nmgp_cmp_readonly['tp_rab'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_rab']);
       $sStyleReadLab_tp_rab = '';
       $sStyleReadInp_tp_rab = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_rab']) && $this->nmgp_cmp_hidden['tp_rab'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_rab" value="<?php echo $this->form_encode_input($tp_rab) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_rab_line" id="hidden_field_data_tp_rab" style="<?php echo $sStyleHidden_tp_rab; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_rab_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_rab_label"><span id="id_label_tp_rab"><?php echo $this->nm_new_label['tp_rab']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_rab"]) &&  $this->nmgp_cmp_readonly["tp_rab"] == "on") { 

 ?>
<input type="hidden" name="tp_rab" value="<?php echo $this->form_encode_input($tp_rab) . "\">" . $tp_rab . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_rab" class="sc-ui-readonly-tp_rab css_tp_rab_line" style="<?php echo $sStyleReadLab_tp_rab; ?>"><?php echo $this->form_encode_input($this->tp_rab); ?></span><span id="id_read_off_tp_rab" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_rab; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_rab_obj" style="" id="id_sc_field_tp_rab" type=text name="tp_rab" value="<?php echo $this->form_encode_input($tp_rab) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tp_rab']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tp_rab']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_rab_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_rab_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tp_jmldistribusi']))
    {
        $this->nm_new_label['tp_jmldistribusi'] = "Jml Distribusi";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tp_jmldistribusi = $this->tp_jmldistribusi;
   $sStyleHidden_tp_jmldistribusi = '';
   if (isset($this->nmgp_cmp_hidden['tp_jmldistribusi']) && $this->nmgp_cmp_hidden['tp_jmldistribusi'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tp_jmldistribusi']);
       $sStyleHidden_tp_jmldistribusi = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tp_jmldistribusi = 'display: none;';
   $sStyleReadInp_tp_jmldistribusi = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tp_jmldistribusi']) && $this->nmgp_cmp_readonly['tp_jmldistribusi'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tp_jmldistribusi']);
       $sStyleReadLab_tp_jmldistribusi = '';
       $sStyleReadInp_tp_jmldistribusi = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tp_jmldistribusi']) && $this->nmgp_cmp_hidden['tp_jmldistribusi'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tp_jmldistribusi" value="<?php echo $this->form_encode_input($tp_jmldistribusi) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_tp_jmldistribusi_line" id="hidden_field_data_tp_jmldistribusi" style="<?php echo $sStyleHidden_tp_jmldistribusi; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tp_jmldistribusi_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_tp_jmldistribusi_label"><span id="id_label_tp_jmldistribusi"><?php echo $this->nm_new_label['tp_jmldistribusi']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tp_jmldistribusi"]) &&  $this->nmgp_cmp_readonly["tp_jmldistribusi"] == "on") { 

 ?>
<input type="hidden" name="tp_jmldistribusi" value="<?php echo $this->form_encode_input($tp_jmldistribusi) . "\">" . $tp_jmldistribusi . ""; ?>
<?php } else { ?>
<span id="id_read_on_tp_jmldistribusi" class="sc-ui-readonly-tp_jmldistribusi css_tp_jmldistribusi_line" style="<?php echo $sStyleReadLab_tp_jmldistribusi; ?>"><?php echo $this->form_encode_input($this->tp_jmldistribusi); ?></span><span id="id_read_off_tp_jmldistribusi" style="white-space: nowrap;<?php echo $sStyleReadInp_tp_jmldistribusi; ?>">
 <input class="sc-js-input scFormObjectOdd css_tp_jmldistribusi_obj" style="" id="id_sc_field_tp_jmldistribusi" type=text name="tp_jmldistribusi" value="<?php echo $this->form_encode_input($tp_jmldistribusi) ?>"
 size=22 alt="{datatype: 'integer', maxLength: 22, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['tp_jmldistribusi']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['tp_jmldistribusi']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tp_jmldistribusi_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tp_jmldistribusi_text"></span></td></tr></table></td></tr></table> </TD>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R")
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "nm_move ('novo');", "nm_move ('novo');", "sc_b_new_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bincluir", "nm_atualiza ('incluir');", "nm_atualiza ('incluir');", "sc_b_ins_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "" . $this->NM_cancel_insert_new . " document.F5.submit();", "" . $this->NM_cancel_insert_new . " document.F5.submit();", "sc_b_sai_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "balterar", "nm_atualiza ('alterar');", "nm_atualiza ('alterar');", "sc_b_upd_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_edit_project_method_mob");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_edit_project_method_mob");
 parent.scAjaxDetailHeight("form_edit_project_method_mob", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_edit_project_method_mob", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_edit_project_method_mob", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_edit_project_method_mob']['sc_modal'])
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
