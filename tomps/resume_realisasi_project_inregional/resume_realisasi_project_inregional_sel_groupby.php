<?php
   include_once('resume_realisasi_project_inregional_session.php');
   session_start();
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
   $Sel_Groupby = new resume_realisasi_project_inregional_sel_Groupby(); 
   $Sel_Groupby->Sel_Groupby_init();
   
class resume_realisasi_project_inregional_sel_Groupby
{
function Sel_Groupby_init()
{
   global $opc_ret, $sc_init, $path_img, $path_btn, $groupby_atual, $embbed, $tbar_pos, $_POST, $_GET;
   if (isset($_POST['script_case_init']))
   {
       $opc_ret  = $_POST['opc_ret'];
       $sc_init  = $_POST['script_case_init'];
       $path_img = $_POST['path_img'];
       $path_btn = $_POST['path_btn'];
       $embbed   = isset($_POST['embbed_groupby']) && 'Y' == $_POST['embbed_groupby'];
       $tbar_pos = isset($_POST['toolbar_pos']) ? $_POST['toolbar_pos'] : '';
   }
   elseif (isset($_GET['script_case_init']))
   {
       $opc_ret  = $_GET['opc_ret'];
       $sc_init  = $_GET['script_case_init'];
       $path_img = $_GET['path_img'];
       $path_btn = $_GET['path_btn'];
       $embbed   = isset($_GET['embbed_groupby']) && 'Y' == $_GET['embbed_groupby'];
       $tbar_pos = isset($_GET['toolbar_pos']) ? $_GET['toolbar_pos'] : '';
   }
   
   $groupby_atual = $_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['SC_Ind_Groupby'];
   if (isset($_POST['fsel_ok']) && $_POST['fsel_ok'] == "OK" && isset($_POST['sel_groupby']))
   {
       $this->campos_sel   = isset($_POST['campos_sel'])   ? $_POST['campos_sel']   : "";
       $this->xaxys_fields = isset($_POST['xaxys_fields']) ? $_POST['xaxys_fields'] : "";
       $this->summ_fields  = isset($_POST['summ_fields'])  ? $_POST['summ_fields']  : "";
       $this->drill_down   = isset($_POST['drill_down'])   ? 'Y' == $_POST['drill_down'] : false;
       $this->Sel_processa_out($_POST['sel_groupby']);
   }
   else
   {
       if ($embbed)
       {
           ob_start();
           $this->Sel_processa_form();
           $Temp = ob_get_clean();
           echo NM_charset_to_utf8($Temp);
       }
       else
       {
           $this->Sel_processa_form();
       }
   }
   exit;
   
}
function Sel_processa_out($sel_groupby)
{
   global $sc_init, $groupby_atual, $opc_ret, $embbed;
   if ($sel_groupby != $groupby_atual)
   {
       $_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['SC_Ind_Groupby']     = $sel_groupby;
       $_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['contr_array_resumo'] = "NAO";
       $_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['contr_total_geral']  = "NAO";
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['ordem_quebra']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['ordem_select']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['tot_geral']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['arr_total']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['pivot_group_by']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['pivot_x_axys']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['pivot_y_axys']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['pivot_fill']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['pivot_order']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['pivot_order_col']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['pivot_order_level']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['pivot_order_sort']);
       unset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['pivot_tabular']);
   }
?>
    <script language="javascript"> 
<?php
   if (!$embbed)
   {
?>
      self.parent.tb_remove(); 
<?php
   }
?>
<?php
   $parms_res = "";
   $sParent = $embbed ? '' : 'parent.';
   echo $sParent . "nm_gp_submit_ajax('" . $opc_ret . "', '" . $parms_res . "')"; 
?>
   </script>
<?php
}
   
function Sel_processa_form()
{
   global $sc_init, $path_img, $path_btn, $groupby_atual, $opc_ret, $embbed, $tbar_pos;
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "en_us";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $this->Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       include_once($NM_arq_lang);
   }
   $_SESSION['scriptcase']['charset']  = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "ISO-8859-1";
   foreach ($this->Nm_lang as $ind => $dados)
   {
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
      {
          $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
          $this->Nm_lang[$ind] = $dados;
      }
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
      {
          $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
   }
   $display_free_gb  = false;
   $arr_campos_free  = array();
   $arr_date_format  = array();
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc8_Ceropegia/Sc8_Ceropegia";
   include("../_lib/css/" . $str_schema_all . "_grid.php");
   $Str_btn_grid = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
   include("../_lib/buttons/" . $Str_btn_grid);
   if (!function_exists("nmButtonOutput"))
   {
       include_once("../_lib/lib/php/nm_gp_config_btn.php");
   }
   $bStartFree   = true;
   $bSummaryPage = isset($_GET['opc_ret']) && 'resumo' == $_GET['opc_ret'];
   if (!$embbed)
   {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Resume Realisasi Project Regional Detail Divre <?php echo $_SESSION['kodedivre'] ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_tab'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_tab_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" /> 
 <script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
 <script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery-ui.js"></script>
 <script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js"></script>
 <script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>
<?php
   }
?>
<?php
if ($embbed)
{
?>
 <script language="javascript" type="text/javascript">
  function scSubmitGroupBy(sPos) {
   $.ajax({
    type: "POST",
    url: "resume_realisasi_project_inregional_sel_groupby.php",
    data: {
     script_case_init: $("#sc_id_gby_script_case_init").val(),
     script_case_session: $("#sc_id_gby_script_case_session").val(),
     path_img: $("#sc_id_gby_path_img").val(),
     path_btn: $("#sc_id_gby_path_btn").val(),
     opc_ret: $("#sc_id_gby_opc_ret").val(),
     campos_sel: $("#sc_id_gby_campos_sel").val(),
     xaxys_fields: $("#sc_id_gby_xaxys_fields").val(),
     summ_fields: $("#sc_id_gby_summ_fields").val(),
     fsel_ok: $("#sc_id_gby_fsel_ok").val(),
     sel_groupby: $(".sc_ui_gby_selected:checked").val(),
     embbed_groupby: 'Y'
    }
   }).done(function(data) {
    scBtnGroupByHide(sPos);
    $("#sc_id_groupby_placeholder_" + sPos).find("td").html("");
    $("#sc_id_groupby_placeholder_" + sPos).find("td").html(data);
   });
  }
  </script>
<?php
}
?>
 <script language="javascript" type="text/javascript">
<?php
if ($bSummaryPage)
{
    $aOptions = array();
    foreach ($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_control'] as $quebra_nome => $_arr_fields)
    {
        if(is_array($_arr_fields))
        {
            foreach ($_arr_fields as $_key_total => $d_field)
            {
                $l_field = $d_field['cmp_res'];
                $aOptions[] = "sc_id_item_summ_" . $quebra_nome . "_" . $_key_total . ": \"" . str_replace('"', '\"', $d_field['select']) . "\"";
            }
        }
    }
?>
  var scTotalOptions = {<?php echo implode(', ', $aOptions); ?>};
<?php
}
?>
  $(function() {
   $(".scAppDivTabLine").find("li").mouseover(function() {
    $(this).css("cursor", "pointer");
   });
   $(".sc_ui_litem").mouseover(function() {
    $(this).css("cursor", "all-scroll");
   });
   $("#sc_id_available").sortable({
    connectWith: ".sc_ui_sort_groupby",
    placeholder: "scAppDivSelectFieldsPlaceholder"
   }).disableSelection();
   $("#sc_id_yaxys").sortable({
    connectWith: ".sc_ui_sort_groupby",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    update: function(event, ui) {
     $("#sc_id_sel_groupby_sc_free_group_by").prop("checked", true);
    }
   }).disableSelection();
<?php
if ($bSummaryPage)
{
?>
   $("#sc_id_xaxys").sortable({
    connectWith: ".sc_ui_sort_groupby",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    update: function(event, ui) {
     $("#sc_id_sel_groupby_sc_free_group_by").prop("checked", true);
    }
   }).disableSelection();
   $(".sc_ui_sort_summ_available").sortable({
    helper: "clone",
    connectWith: ".sc_ui_sort_summ",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var idx, elm, eid, nid, fieldName, opName;
     if ($(ui.item[0]).hasClass('scAppDivSelectFieldsDisabled')) {
      $(this).sortable("cancel");
      return;
     }
     sc_group_by = $(this).attr('id').substr(21);
     idx = $("#sc_id_summ_selected_" + sc_group_by).children().index($(ui.item[0]));
     if (idx == -1) return;
     elm = $(ui.item[0]).clone(true).removeClass("box ui-draggable ui-draggable-dragging").addClass("box-clone");
     eid = elm.attr("id");
     nid = 'selected_' + eid;
     elm.attr("id", nid).find(".sc-ui-total-options").html(scTotalOptions[eid]);
     if(elm.attr("id", nid).find(".sc-ui-total-options").find('option').length == 1)
     {
         elm.attr("id", nid).find(".sc-ui-total-options").hide();
     }
     $("#sc_id_summ_selected_" + sc_group_by).children(":eq(" + idx + ")").after(elm);
     $(this).sortable("cancel");
     $("#" + eid).addClass("scAppDivSelectFieldsDisabled");
<?php
   if (!$embbed)
   {
?>
     ajusta_window();
<?php
   }
?>
    }
   }).disableSelection();
   $(".sc_ui_sort_summ_selected").sortable({
    connectWith: ".sc_ui_sort_summ",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     eid = $(ui.item[0]).attr("id").substr(9);
     $(this).sortable("cancel");
     $(ui.item[0]).remove();
     $("#" + eid).removeClass("scAppDivSelectFieldsDisabled");
<?php
   if (!$embbed)
   {
?>
     ajusta_window();
<?php
   }
?>
    }
   });
<?php
}
?>
   $("#sc_id_show_static").click(function() {
    scShowStatic();
    scShowTotalFields();
   });
   $("#sc_id_show_free").click(function() {
    scShowFree();
    scShowTotalFields();
   });
   $("radio[name=sel_groupby]").click(function() {
    $('.totalization_fields').hide();
    $('#id_totalization_fields_' + $("input[name=sel_groupby]:checked").val());
   });
   scUpdateListHeight();
  });
  function scShowTotalFields()
  {
    $('#sc_id_summary_fields > table').hide();
    $('#id_totalization_fields_' + $('input[name=sel_groupby]:checked').val()).show();
  }
  function scUpdateListHeight() {
   $("#sc_id_available").css("min-height", "<?php echo sizeof($arr_campos_free) * 29 ?>px");
   $("#sc_id_yaxys").css("min-height", "<?php echo sizeof($arr_campos_free) * 29 ?>px");
   $("#sc_id_xaxys").css("min-height", "<?php echo sizeof($arr_campos_free) * 29 ?>px");
<?php
if ($bSummaryPage)
{
  $max_height = 1;
  if (isset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_display']))
  {
    foreach ($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_display'] as $_quebra_nome => $_i_sum)
    {
      if (count($_i_sum) > $max_height)
      {
          $max_height = count($_i_sum);
      }
    }
  }
?>
   $(".sc_ui_sort_summ_available").css("min-height", "<?php echo $max_height * 29 ?>px");
   $(".sc_ui_sort_summ_selected").css("min-height", "<?php echo $max_height * 29 ?>px");
<?php
}
?>
  }
  function scPackGroupBy() {
   var fieldList, i, fieldName, selectedFields = new Array, xaxysFields = new Array, summFields = new Array;
<?php
if ($bSummaryPage)
{
?>
   fieldList = $("#sc_id_xaxys").sortable("toArray");
   for (i = 0; i < fieldList.length; i++) {
    fieldName = fieldList[i].substr(11);
    selectedFields.push(fieldName);
    xaxysFields.push(fieldName);
   }
   $("#sc_id_gby_xaxys_fields").val(xaxysFields.join("@?@"));
   fieldList = $("#sc_id_summ_selected_" + $("input[name=sel_groupby]:checked").val()).sortable("toArray");
   for (i = 0; i < fieldList.length; i++) {
    fieldName = $("#" + fieldList[i]).find("select").val();
    summFields.push(fieldName);
   }
   $("#sc_id_gby_summ_fields").val(summFields.join("@?@"));
<?php
}
?>
   fieldList = $("#sc_id_yaxys").sortable("toArray");
   for (i = 0; i < fieldList.length; i++) {
    fieldName = fieldList[i].substr(11);
    selectedFields.push(fieldName);
   }
   $("#sc_id_gby_campos_sel").val(selectedFields.join("@?@"));
  }
  function scShowStatic() {
    if($('#sc_id_static_groupby input[type=radio]').length == 1)
    {
        $('#sc_id_static_groupby input[type=radio]').click();
    }
    $("#sc_id_static_groupby").show();
    $("#sc_id_free_groupby").hide();
    $("#sc_id_show_static").addClass("scTabActive").removeClass("scTabInactive");
    $("#sc_id_show_free").addClass("scTabInactive").removeClass("scTabActive");
<?php
   if (!$embbed)
   {
?>
   ajusta_window();
<?php
   }
?>
  }
  function scShowFree() {
    if($('#sc_id_free_groupby input[type=radio]').length == 1)
    {
        $('#sc_id_free_groupby input[type=radio]').click();
    }
    $("#sc_id_static_groupby").hide();
    $("#sc_id_free_groupby").show();
    $("#sc_id_show_static").addClass("scTabInactive").removeClass("scTabActive");
    $("#sc_id_show_free").addClass("scTabActive").removeClass("scTabInactive");
<?php
   if (!$embbed)
   {
?>
   ajusta_window();
<?php
   }
?>
  }
 </script>
 <style type="text/css">
  .sc_ui_sortable {
   list-style-type: none;
   margin: 0;
   min-width: 225px;
  }
  .sc_ui_sortable li {
   margin: 0 3px 3px 3px;
   padding: 3px 3px 3px 15px;
   height: 18px;
  }
  .sc_ui_sortable li span {
   position: absolute;
   margin-left: -1.3em;
  }
  .sc_ui_ulist {
   min-width: 225px;
  }
  .sc_ui_ulist_total {
   width: 250px;
  }
  .sc_ui_litem {
  }
  .sc_ui_litem_total {
   height: 25px;
  }
 </style>
<?php
   if (!$embbed)
   {
?>
</HEAD>
<BODY class="scGridPage" style="margin: 0px; overflow-x: hidden">
<?php
   }
?>
<FORM name="Fsel_quebras" method="POST">
  <INPUT type="hidden" name="script_case_init" id="sc_id_gby_script_case_init" value="<?php echo NM_encode_input($sc_init); ?>"> 
  <INPUT type="hidden" name="script_case_session" id="sc_id_gby_script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
  <INPUT type="hidden" name="path_img" id="sc_id_gby_path_img" value="<?php echo NM_encode_input($path_img); ?>"> 
  <INPUT type="hidden" name="path_btn" id="sc_id_gby_path_btn" value="<?php echo NM_encode_input($path_btn); ?>"> 
  <INPUT type="hidden" name="opc_ret" id="sc_id_gby_opc_ret" value="<?php echo NM_encode_input($opc_ret); ?>"> 
  <INPUT type="hidden" name="campos_sel" id="sc_id_gby_campos_sel" value="">
  <INPUT type="hidden" name="xaxys_fields" id="sc_id_gby_xaxys_fields" value="">
  <INPUT type="hidden" name="summ_fields" id="sc_id_gby_summ_fields" value="">
  <INPUT type="hidden" name="fsel_ok" id="sc_id_gby_fsel_ok" value="OK"> 
<?php
if ($embbed)
{
    echo "<div class='scAppDivMoldura'>";
    echo "<table id=\"main_table\" style=\"width: 100%\" cellspacing=0 cellpadding=0>";
}
elseif ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; right: 20px; min-width: 500px\">";
}
else
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; left: 20px; min-width: 500px\">";
}
?>
<?php
if (!$embbed)
{
?>
<tr>
<td>
<div class="scGridBorder">
<table width='100%' cellspacing=0 cellpadding=0>
<?php
}
?>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivHeader scAppDivHeaderText':'scGridLabelVert'; ?>">
   <?php echo $this->Nm_lang['lang_btns_grpby_hint']; ?>
  </td>
 </tr>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivContent css_scAppDivContentText':'scGridTabelaTd'; ?>">
   <table class="<?php echo ($embbed)? '':'scGridTabela'; ?>" style="border-width: 0; border-collapse: collapse; width:100%;" cellspacing=0 cellpadding=0>
    <tr class="<?php echo ($embbed)? '':'scGridFieldOddVert'; ?>">
     <td style="vertical-align: top">
      <table cellspacing=0 cellpadding=0 style="width: 100%">
<?php
    $has_group_by_static  = false;
    $has_group_by_dynamic = false;
    $has_total_dynamic    = false;
    $iTabCount            = 0;
    foreach ($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['SC_All_Groupby'] as $QB => $Tp)
    {
        if (!in_array($QB, $_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['SC_Groupby_hide']))
        {
            if ($QB != "sc_free_group_by")
            {
                $has_group_by_static = true;
                $iTabCount++;
                break;
            }
        }
    }
    if (1 < $iTabCount)
    {
?>
 <tr>
  <td>
   <ul class="scAppDivTabLine">
<?php
        if ($has_group_by_static)
        {
            $sTabClass = ('sc_free_group_by' == $groupby_atual) ? 'scTabInactive' : 'scTabActive';
?>
    <li id="sc_id_show_static" class="<?php echo $sTabClass; ?>"><a><?php echo $this->Nm_lang['lang_othr_groupby_static']; ?></a></li>
<?php
        }
        if ($has_group_by_dynamic)
        {
            $sTabClass = ('sc_free_group_by' == $groupby_atual) ? 'scTabActive' : 'scTabInactive';
?>
    <li id="sc_id_show_free" class="<?php echo $sTabClass; ?>"><a><?php echo $this->Nm_lang['lang_othr_groupby_dynamic']; ?></a></li>
<?php
        }
?>
   </ul>
  </td>
 </tr>
<?php
    }
?>
<style>
	.GroupByOptions {
		padding: 10px;
	}

	.GroupByOptions > div input {
		float: left;
		position: relative;
		top: -10px;
	}

	.GroupByOptions > div label span {
		display: block;
		font-weight: normal;
		font-size:12px;
		opacity: 0.7;
	}

	.GroupByOptions > div label {
		font-weight: bold;
	}

	.GroupByOptions > div {
		padding: 5px 0;
		border-width: 0px 0px 1px 0px;
		border-style: solid;
	}

	.GroupByOptions > div:last-child {
		border-bottom: none;
	}

	tr#sc_id_free_groupby > td > table {
		margin: 10px;
	}

	.SummaryBox > td #sc_id_summary_fields {
		padding: 10px;
		border-width: 1px;
		border-style: solid;
	}

	.SummaryBox > td ul {
		margin-top: 5px;
	}

	.SummaryBox > td {
		border-width: 1px;
		border-style: solid;
	}

	.SummaryBox > td .scAppDivHeader {
		border: none;
		height: 30px;
		padding: 0 10px;
		line-height: 30px;
		text-transform: uppercase;
		font-size: 11px;
	}

	.SummaryBox > td {
		border: none;
		padding-top: 10px;
	}

	.SummaryBox > td .scAppDivHeader:before {
		content: "";
		display: inline-block;
		width: 16px;
		height: 16px;
		float: left;
		position: relative;
		top: 7px;
		margin-right: 3px;
		background-position: center center;
		background-repeat: no-repeat;
	}

</style>
<script type="text/javascript">
$(function() {
	$(".SummaryBoxDiv").on("click", function() {
		$('#sc_id_summary_fields').toggle();
		$(this).toggleClass("open");
	});
});
</script>
 <tr id="sc_id_static_groupby">
  <td>
  <div class="GroupByOptions">
<?php
     if (!in_array("groupbywitel", $_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['SC_Groupby_hide']))
     {
        if ($groupby_atual == "groupbywitel")
        {
            $check = " checked";
            $bStartFree = false;
        }
        else
        {
            $check = "";
        }
?>
      <div>
      <input type="radio" class="scAppDivToolbarInput sc_ui_gby_selected" onclick='scShowTotalFields();' name="sel_groupby" value="groupbywitel" id="sc_id_sel_groupby_groupbywitel"<?php echo $check ?> style='display:' />
      <label for="sc_id_sel_groupby_groupbywitel">
        Group by Witel
<?php
    $prep_labels = array();
    $prep_labels[] = "Release Project";
    $prep_labels[] = "Witel";
?>
        <span>
        <?php echo implode($prep_labels, ', ');?>
        </span>
      </label>
      </div>
<?php
     }
?>
<?php
     if (!in_array("groupbywiteldanmitra", $_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['SC_Groupby_hide']))
     {
        if ($groupby_atual == "groupbywiteldanmitra")
        {
            $check = " checked";
            $bStartFree = false;
        }
        else
        {
            $check = "";
        }
?>
      <div>
      <input type="radio" class="scAppDivToolbarInput sc_ui_gby_selected" onclick='scShowTotalFields();' name="sel_groupby" value="groupbywiteldanmitra" id="sc_id_sel_groupby_groupbywiteldanmitra"<?php echo $check ?> style='display:' />
      <label for="sc_id_sel_groupby_groupbywiteldanmitra">
        Group by Witel & Mitra
<?php
    $prep_labels = array();
    $prep_labels[] = "Release Project";
?>
        <span>
        <?php echo implode($prep_labels, ', ');?>
        </span>
      </label>
      </div>
<?php
     }
?>
  </div>
  </td>
 </tr>
<?php
   $iItemCount = 0;
   if ($bSummaryPage)
   {
       $aSummStatus        = array();
       $arr_start_selected = array();
?>
 <tr id="sc_id_summary" class="SummaryBox" style='display:<?php echo ($has_total_dynamic)?'':'none';?>'>
  <td>
    <div class='scAppDivHeader scAppDivHeaderText SummaryBoxDiv  open' style='cursor:pointer;'><?php echo $this->Nm_lang['lang_othr_totals']; ?></div>
    <div id='sc_id_summary_fields' style='display:'>
    <?php
    foreach ($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_control'] as $nome_quebra => $_arr_fields_totals)
    {
    ?>
      <table class="totalization_fields" id="id_totalization_fields_<?php echo $nome_quebra; ?>" style="display:<?php echo ($groupby_atual == $nome_quebra)?'':'none'; ?>">
       <tr>
        <td style="vertical-align: top">
         <?php echo $this->Nm_lang['lang_othr_groupby_totals_fld']; ?>
         <ul class="sc_ui_sort_summ sc_ui_sort_summ_available sc_ui_sortable sc_ui_ulist sc_ui_ulist_total scAppDivSelectFields" id="sc_id_summ_available_<?php echo $nome_quebra; ?>">
<?php
          if(is_array($_arr_fields_totals) && !empty($_arr_fields_totals))
          {
            foreach ($_arr_fields_totals as $key_total => $d_field)
            {
                $l_field = $d_field['cmp_res'];
                $aSummStatus[$l_field] = array();
                $sLabel = (isset($d_field['label']) && !empty($d_field['label'])) ? $d_field['label'] : $d_field['label_field'];
                $sOpDisplay = '';
                if('NM_Count' == $l_field || (isset($d_field['options']) && count($d_field['options']) == 1))
                {
                    $sOpDisplay = '; display: none';
                }
?>
              <li class="sc_ui_litem sc_ui_litem_total scAppDivSelectFieldsEnabled" id="sc_id_item_summ_<?php echo $nome_quebra; ?>_<?php echo $key_total; ?>"><table cellpading=0 cellspacing=0 border=0 style="width: 100%"><tr><td><?php echo NM_encode_input($sLabel); ?></td><td style="text-align: right" class="sc-ui-total-options"><?php
                foreach ($d_field['options'] as $d_sum)
                {
                    $aSummStatus[$l_field][] = $d_sum['op'];
?>
&nbsp;<span style="position: relative; margin-left: 0<?php echo $sOpDisplay; ?>" class="scAppDivSelectBoxEnabled sc-ui-select-available-<?php echo NM_encode_input($d_sum['op']); ?>"><?php echo NM_encode_input($d_sum['abbrev']); ?></span><?php
                }
?>
</td></tr></table></li>
<?php
            }
          }
?>
         </ul>
        </td>
        <td style="vertical-align: top">
         <?php
         echo $this->Nm_lang['lang_othr_groupby_selected_fld'];
         ?>
         <ul class="sc_ui_sort_summ sc_ui_sort_summ_selected sc_ui_sortable sc_ui_ulist sc_ui_ulist_total scAppDivSelectFields" id="sc_id_summ_selected_<?php echo $nome_quebra; ?>">
<?php
          if(isset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_order'][ $nome_quebra ]) && is_array($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_order'][ $nome_quebra ]) && !empty($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_order'][ $nome_quebra ]))
          {
           foreach ($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_order'][ $nome_quebra ] as $i_sum)
           {
            if ('' != $i_sum && isset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_display'][ $nome_quebra ][$i_sum]))
            {
                $d_sum = $_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_display'][ $nome_quebra ][$i_sum];
                if ($d_sum['display'])
                {
                    $sLabel = $d_sum['label'];
                    $sId    = '';
                    $bFound = false;
                    $iKey   = $key_total;
                    if(isset($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_control'][$nome_quebra]))
                    {
                        foreach ($_SESSION['sc_session'][$sc_init]['resume_realisasi_project_inregional']['summarizing_fields_control'][$nome_quebra] as $_key_total => $d_field)
                        {
                            if(is_array($d_field))
                            {
                                    $l_field = $d_field['cmp_res'];
                                    foreach ($d_field['options'] as $d_option)
                                    {
                                        if ($d_option['index'] == $i_sum)
                                        {
                                            $sLabel = (isset($d_field['label']) && !empty($d_field['label'])) ? $d_field['label'] : $d_field['label_field'];
                                            $sId    = $l_field;
                                            $bFound = true;
                                            $iKey = $_key_total;
                                            $arr_start_selected[ $nome_quebra ][] = $_key_total;
                                        }
                                    }
                                    if ($bFound)
                                    {
                                        break;
                                    }
                            }
                        }
                    }
                    $sSelDisplay = '';
                    if('NM_Count' == $sId || (isset($d_field['options']) && count($d_field['options']) == 1))
                    {
                        $sSelDisplay = ' style="display: none"';
                    }
?>
          <li class="sc_ui_litem sc_ui_litem_total scAppDivSelectFieldsEnabled" id="selected_sc_id_item_summ_<?php echo $nome_quebra; ?>_<?php echo $iKey; ?>"><table cellpadding=0 cellspacing = 0 border=0 style="width: 100%"><tr><td><?php echo NM_encode_input($sLabel); ?></td><td style="text-align: right" class="sc-ui-total-options"><select class="sc-ui-select-<?php echo $sId; ?>"<?php echo $sSelDisplay; ?> onChange=""><?php
                    foreach ($d_field['options'] as $d_option)
                    {
                        $sSelected = $i_sum == $d_option['index'] ? ' selected' : '';
?>
<option value="<?php echo $d_option['index']; ?>" class="sc-ui-select-option-<?php echo $d_option['op']; ?>"<?php echo $sSelected; ?>><?php echo NM_encode_input($d_option['label']); ?></option><?php
                    }
?>
</select></td></tr></table></li>
<?php
                    $iItemCount++;
                }
           }
          }
         }
?>
         </ul>
        </td>
       </tr>
      </table>
    <?php
    }
    ?>
   </div>
   <br />
  </td>
 </tr>
<?php
   }
   if(!empty($arr_start_selected))
   {
   ?>
<script type="text/javascript">
    $(function() {
    <?php
    foreach($arr_start_selected as $_group_name => $_arr_group_start)
    {
        foreach($_arr_group_start as $_key_total_index)
        {
        ?>
        $("#sc_id_item_summ_<?php echo $_group_name; ?>_<?php echo $_key_total_index; ?>").addClass("scAppDivSelectFieldsDisabled");
        <?php
        }
    }
    ?>
   });
</script>
   <?php
   }
?>
   </td>
  </table>
  </td>
  </tr>
   <tr>
  <td class="<?php echo ($embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>">
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bok", "document.Fsel_quebras.submit()", "document.Fsel_quebras.submit()", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bapply", "scSubmitGroupBy('" . $tbar_pos . "')", "scSubmitGroupBy('" . $tbar_pos . "')", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
  &nbsp;&nbsp;&nbsp;
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bsair", "self.parent.tb_remove()", "self.parent.tb_remove()", "Bsair", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnGroupByHide('" . $tbar_pos . "')", "scBtnGroupByHide('" . $tbar_pos . "')", "Bsair", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
   </td></tr>
<?php
if (!$embbed)
{
?>
  </table>
  </div>
  </td>
  </tr>
<?php
}
?>
  </table>
<?php
if ($embbed)
{
?>
    </div>
<?php
}
?>
</FORM>
<script language="javascript">
$(function() {
<?php
   if ($bStartFree)
   {
?>
       scShowFree();
<?php
   }
   else
   {
?>
       scShowStatic();
<?php
   }
?>
});
</script>
<?php
   if (!$embbed)
   {
?>
<script language="javascript"> 
var bFixed = false;
function ajusta_window()
{
  var mt = $(document.getElementById("main_table"));
  if (0 == mt.width() || 0 == mt.height())
  {
    setTimeout("ajusta_window()", 50);
    return;
  }
  else if(!bFixed)
  {
    var oOrig = $(document.Fsel_quebras.sel_groupby),
        mHeight = oOrig.height(),
        mWidth  = oOrig.width() + 5;
    oOrig.height(mHeight);
    oOrig.width(mWidth);
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
      self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
      setTimeout("ajusta_window()", 50);
      return;
    }
  }
  strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
  self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
}
$( document ).ready(function() {
  ajusta_window();
});
</script>
<script>
  ajusta_window();
</script>
</BODY>
</HTML>
<?php
   }
}
}
