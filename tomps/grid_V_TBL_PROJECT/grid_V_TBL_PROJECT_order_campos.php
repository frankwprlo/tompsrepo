<?php
   include_once('grid_V_TBL_PROJECT_session.php');
   session_start();
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
    $Ord_Cmp = new grid_V_TBL_PROJECT_Ord_cmp(); 
    $Ord_Cmp->Ord_cmp_init();
   
class grid_V_TBL_PROJECT_Ord_cmp
{
function Ord_cmp_init()
{
  global $sc_init, $path_img, $path_btn, $tab_ger_campos, $tab_def_campos, $tab_converte, $tab_labels, $embbed, $tbar_pos, $_POST, $_GET;
   if (isset($_POST['script_case_init']))
   {
       $sc_init    = $_POST['script_case_init'];
       $path_img   = $_POST['path_img'];
       $path_btn   = $_POST['path_btn'];
       $use_alias  = (isset($_POST['use_alias']))  ? $_POST['use_alias']  : "S";
       $fsel_ok    = (isset($_POST['fsel_ok']))    ? $_POST['fsel_ok']    : "";
       $campos_sel = (isset($_POST['campos_sel'])) ? $_POST['campos_sel'] : "";
       $sel_regra  = (isset($_POST['sel_regra']))  ? $_POST['sel_regra']  : "";
       $embbed     = isset($_POST['embbed_groupby']) && 'Y' == $_POST['embbed_groupby'];
       $tbar_pos   = isset($_POST['toolbar_pos']) ? $_POST['toolbar_pos'] : '';
   }
   elseif (isset($_GET['script_case_init']))
   {
       $sc_init    = $_GET['script_case_init'];
       $path_img   = $_GET['path_img'];
       $path_btn   = $_GET['path_btn'];
       $use_alias  = (isset($_GET['use_alias']))  ? $_GET['use_alias']  : "S";
       $fsel_ok    = (isset($_GET['fsel_ok']))    ? $_GET['fsel_ok']    : "";
       $campos_sel = (isset($_GET['campos_sel'])) ? $_GET['campos_sel'] : "";
       $sel_regra  = (isset($_GET['sel_regra']))  ? $_GET['sel_regra']  : "";
       $embbed     = isset($_GET['embbed_groupby']) && 'Y' == $_GET['embbed_groupby'];
       $tbar_pos   = isset($_GET['toolbar_pos']) ? $_GET['toolbar_pos'] : '';
   }
   $STR_lang    = (isset($_SESSION['scriptcase']['str_lang']) && !empty($_SESSION['scriptcase']['str_lang'])) ? $_SESSION['scriptcase']['str_lang'] : "en_us";
   $NM_arq_lang = "../_lib/lang/" . $STR_lang . ".lang.php";
   $this->Nm_lang = array();
   if (is_file($NM_arq_lang))
   {
       include_once($NM_arq_lang);
   }
   
   $tab_ger_campos = array();
   $tab_def_campos = array();
   $tab_labels     = array();
   $tab_ger_campos['tp_id'] = "on";
   $tab_def_campos['tp_id'] = "TP_ID";
   $tab_converte["TP_ID"]   = "tp_id";
   $tab_labels["tp_id"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_id"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_id"] : "TP ID";
   $tab_ger_campos['tp_thn_release'] = "on";
   $tab_def_campos['tp_thn_release'] = "TP_THN_RELEASE";
   $tab_converte["TP_THN_RELEASE"]   = "tp_thn_release";
   $tab_labels["tp_thn_release"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_thn_release"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_thn_release"] : "TP THN RELEASE";
   $tab_ger_campos['tp_idlop'] = "on";
   $tab_def_campos['tp_idlop'] = "TP_IDLOP";
   $tab_converte["TP_IDLOP"]   = "tp_idlop";
   $tab_labels["tp_idlop"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_idlop"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_idlop"] : "TP IDLOP";
   $tab_ger_campos['tp_batch'] = "on";
   $tab_def_campos['tp_batch'] = "TP_BATCH";
   $tab_converte["TP_BATCH"]   = "tp_batch";
   $tab_labels["tp_batch"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_batch"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_batch"] : "TP BATCH";
   $tab_ger_campos['tp_projectname'] = "on";
   $tab_def_campos['tp_projectname'] = "TP_PROJECTNAME";
   $tab_converte["TP_PROJECTNAME"]   = "tp_projectname";
   $tab_labels["tp_projectname"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_projectname"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_projectname"] : "TP PROJECTNAME";
   $tab_ger_campos['tp_lokasi'] = "on";
   $tab_def_campos['tp_lokasi'] = "TP_LOKASI";
   $tab_converte["TP_LOKASI"]   = "tp_lokasi";
   $tab_labels["tp_lokasi"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_lokasi"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_lokasi"] : "TP LOKASI";
   $tab_ger_campos['tp_mitra'] = "on";
   $tab_def_campos['tp_mitra'] = "TP_MITRA";
   $tab_converte["TP_MITRA"]   = "tp_mitra";
   $tab_labels["tp_mitra"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_mitra"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_mitra"] : "TP MITRA";
   $tab_ger_campos['tp_odp'] = "on";
   $tab_def_campos['tp_odp'] = "TP_ODP";
   $tab_converte["TP_ODP"]   = "tp_odp";
   $tab_labels["tp_odp"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_odp"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_odp"] : "TP ODP";
   $tab_ger_campos['tp_jmlport'] = "on";
   $tab_def_campos['tp_jmlport'] = "TP_JMLPORT";
   $tab_converte["TP_JMLPORT"]   = "tp_jmlport";
   $tab_labels["tp_jmlport"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_jmlport"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_jmlport"] : "TP JMLPORT";
   $tab_ger_campos['tp_jmldistribusi'] = "on";
   $tab_def_campos['tp_jmldistribusi'] = "TP_JMLDISTRIBUSI";
   $tab_converte["TP_JMLDISTRIBUSI"]   = "tp_jmldistribusi";
   $tab_labels["tp_jmldistribusi"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_jmldistribusi"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_jmldistribusi"] : "TP JMLDISTRIBUSI";
   $tab_ger_campos['tp_planstart'] = "on";
   $tab_def_campos['tp_planstart'] = "TP_PLANSTART";
   $tab_converte["TP_PLANSTART"]   = "tp_planstart";
   $tab_labels["tp_planstart"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_planstart"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_planstart"] : "TP PLANSTART";
   $tab_ger_campos['tp_planfinish'] = "on";
   $tab_def_campos['tp_planfinish'] = "TP_PLANFINISH";
   $tab_converte["TP_PLANFINISH"]   = "tp_planfinish";
   $tab_labels["tp_planfinish"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_planfinish"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_planfinish"] : "TP PLANFINISH";
   $tab_ger_campos['tp_summary'] = "on";
   $tab_def_campos['tp_summary'] = "TP_SUMMARY";
   $tab_converte["TP_SUMMARY"]   = "tp_summary";
   $tab_labels["tp_summary"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_summary"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_summary"] : "TP SUMMARY";
   $tab_ger_campos['tp_status'] = "on";
   $tab_def_campos['tp_status'] = "TP_STATUS";
   $tab_converte["TP_STATUS"]   = "tp_status";
   $tab_labels["tp_status"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_status"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_status"] : "TP STATUS";
   $tab_ger_campos['tp_actualstart'] = "on";
   $tab_def_campos['tp_actualstart'] = "TP_ACTUALSTART";
   $tab_converte["TP_ACTUALSTART"]   = "tp_actualstart";
   $tab_labels["tp_actualstart"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_actualstart"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_actualstart"] : "TP ACTUALSTART";
   $tab_ger_campos['tp_actualfinish'] = "on";
   $tab_def_campos['tp_actualfinish'] = "TP_ACTUALFINISH";
   $tab_converte["TP_ACTUALFINISH"]   = "tp_actualfinish";
   $tab_labels["tp_actualfinish"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_actualfinish"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_actualfinish"] : "TP ACTUALFINISH";
   $tab_ger_campos['tp_templateproject'] = "on";
   $tab_def_campos['tp_templateproject'] = "TP_TEMPLATEPROJECT";
   $tab_converte["TP_TEMPLATEPROJECT"]   = "tp_templateproject";
   $tab_labels["tp_templateproject"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_templateproject"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_templateproject"] : "TP TEMPLATEPROJECT";
   $tab_ger_campos['tp_jenisproject'] = "on";
   $tab_def_campos['tp_jenisproject'] = "TP_JENISPROJECT";
   $tab_converte["TP_JENISPROJECT"]   = "tp_jenisproject";
   $tab_labels["tp_jenisproject"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_jenisproject"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_jenisproject"] : "TP JENISPROJECT";
   $tab_ger_campos['tp_prjtrelease'] = "on";
   $tab_def_campos['tp_prjtrelease'] = "TP_PRJTRELEASE";
   $tab_converte["TP_PRJTRELEASE"]   = "tp_prjtrelease";
   $tab_labels["tp_prjtrelease"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_prjtrelease"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_prjtrelease"] : "TP PRJTRELEASE";
   $tab_ger_campos['tp_targetwaktu'] = "on";
   $tab_def_campos['tp_targetwaktu'] = "TP_TARGETWAKTU";
   $tab_converte["TP_TARGETWAKTU"]   = "tp_targetwaktu";
   $tab_labels["tp_targetwaktu"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_targetwaktu"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_targetwaktu"] : "TP TARGETWAKTU";
   $tab_ger_campos['tp_ponumber'] = "on";
   $tab_def_campos['tp_ponumber'] = "TP_PONUMBER";
   $tab_converte["TP_PONUMBER"]   = "tp_ponumber";
   $tab_labels["tp_ponumber"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_ponumber"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_ponumber"] : "TP PONUMBER";
   $tab_ger_campos['tp_nokontrak'] = "on";
   $tab_def_campos['tp_nokontrak'] = "TP_NOKONTRAK";
   $tab_converte["TP_NOKONTRAK"]   = "tp_nokontrak";
   $tab_labels["tp_nokontrak"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_nokontrak"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_nokontrak"] : "TP NOKONTRAK";
   $tab_ger_campos['realisasi'] = "on";
   $tab_def_campos['realisasi'] = "REALISASI";
   $tab_converte["REALISASI"]   = "realisasi";
   $tab_labels["realisasi"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["realisasi"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["realisasi"] : "REALISASI";
   $tab_ger_campos['tm_namamitra'] = "on";
   $tab_def_campos['tm_namamitra'] = "TM_NAMAMITRA";
   $tab_converte["TM_NAMAMITRA"]   = "tm_namamitra";
   $tab_labels["tm_namamitra"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tm_namamitra"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tm_namamitra"] : "TM NAMAMITRA";
   $tab_ger_campos['statusname'] = "on";
   $tab_def_campos['statusname'] = "STATUSNAME";
   $tab_converte["STATUSNAME"]   = "statusname";
   $tab_labels["statusname"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["statusname"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["statusname"] : "STATUSNAME";
   $tab_ger_campos['templatename'] = "on";
   $tab_def_campos['templatename'] = "TEMPLATENAME";
   $tab_converte["TEMPLATENAME"]   = "templatename";
   $tab_labels["templatename"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["templatename"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["templatename"] : "TEMPLATENAME";
   $tab_ger_campos['md_kodedivre'] = "on";
   $tab_def_campos['md_kodedivre'] = "MD_KODEDIVRE";
   $tab_converte["MD_KODEDIVRE"]   = "md_kodedivre";
   $tab_labels["md_kodedivre"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["md_kodedivre"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["md_kodedivre"] : "MD KODEDIVRE";
   $tab_ger_campos['mw_namawitel'] = "on";
   $tab_def_campos['mw_namawitel'] = "MW_NAMAWITEL";
   $tab_converte["MW_NAMAWITEL"]   = "mw_namawitel";
   $tab_labels["mw_namawitel"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["mw_namawitel"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["mw_namawitel"] : "MW NAMAWITEL";
   $tab_ger_campos['md_namadatel'] = "on";
   $tab_def_campos['md_namadatel'] = "MD_NAMADATEL";
   $tab_converte["MD_NAMADATEL"]   = "md_namadatel";
   $tab_labels["md_namadatel"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["md_namadatel"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["md_namadatel"] : "MD NAMADATEL";
   $tab_ger_campos['ms_namasto'] = "on";
   $tab_def_campos['ms_namasto'] = "MS_NAMASTO";
   $tab_converte["MS_NAMASTO"]   = "ms_namasto";
   $tab_labels["ms_namasto"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["ms_namasto"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["ms_namasto"] : "MS NAMASTO";
   $tab_ger_campos['tp_releasename'] = "on";
   $tab_def_campos['tp_releasename'] = "TP_RELEASENAME";
   $tab_converte["TP_RELEASENAME"]   = "tp_releasename";
   $tab_labels["tp_releasename"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_releasename"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_releasename"] : "TP RELEASENAME";
   $tab_ger_campos['tj_namajenis'] = "on";
   $tab_def_campos['tj_namajenis'] = "TJ_NAMAJENIS";
   $tab_converte["TJ_NAMAJENIS"]   = "tj_namajenis";
   $tab_labels["tj_namajenis"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tj_namajenis"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tj_namajenis"] : "TJ NAMAJENIS";
   $tab_ger_campos['tp_nilai'] = "on";
   $tab_def_campos['tp_nilai'] = "TP_NILAI";
   $tab_converte["TP_NILAI"]   = "tp_nilai";
   $tab_labels["tp_nilai"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_nilai"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_nilai"] : "TP NILAI";
   $tab_ger_campos['tp_rab'] = "on";
   $tab_def_campos['tp_rab'] = "TP_RAB";
   $tab_converte["TP_RAB"]   = "tp_rab";
   $tab_labels["tp_rab"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_rab"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_rab"] : "TP RAB";
   $tab_ger_campos['tp_prosentase'] = "on";
   $tab_def_campos['tp_prosentase'] = "TP_PROSENTASE";
   $tab_converte["TP_PROSENTASE"]   = "tp_prosentase";
   $tab_labels["tp_prosentase"]   = (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_prosentase"])) ? $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['labels']["tp_prosentase"] : "TP PROSENTASE";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_V_TBL_PROJECT']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_V_TBL_PROJECT']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_V_TBL_PROJECT']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           if ($NM_cada_opc == "off")
           {
              $tab_ger_campos[$NM_cada_field] = "none";
           }
       }
   }
   if (!isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['ordem_select']))
   {
       $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['ordem_select'] = array();
   }
   
   if ($fsel_ok == "cmp")
   {
       $this->Sel_processa_out_sel($campos_sel);
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
function Sel_processa_out_sel($campos_sel)
{
   global $tab_ger_campos, $sc_init, $tab_def_campos, $tab_converte, $embbed;
   $arr_temp = array();
   $campos_sel = explode("@?@", $campos_sel);
   $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['ordem_select'] = array();
   $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['ordem_grid']   = "";
   $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['ordem_cmp']    = "";
   foreach ($campos_sel as $campo_sort)
   {
       $ordem = (substr($campo_sort, 0, 1) == "+") ? "asc" : "desc";
       $campo = substr($campo_sort, 1);
       if (isset($tab_converte[$campo]))
       {
           $_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['ordem_select'][$campo] = $ordem;
       }
   }
?>
    <script language="javascript"> 
<?php
   if (!$embbed)
   {
?>
      self.parent.tb_remove(); 
      parent.nm_gp_submit_ajax('inicio', ''); 
<?php
   }
   else
   {
?>
      nm_gp_submit_ajax('inicio', ''); 
<?php
   }
?>
   </script>
<?php
}
   
function Sel_processa_form()
{
  global $sc_init, $path_img, $path_btn, $tab_ger_campos, $tab_def_campos, $tab_converte, $tab_labels, $embbed, $tbar_pos;
   $size = 10;
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
   $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc8_Ceropegia/Sc8_Ceropegia";
   include("../_lib/css/" . $str_schema_all . "_grid.php");
   $Str_btn_grid = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
   include("../_lib/buttons/" . $Str_btn_grid);
   if (!function_exists("nmButtonOutput"))
   {
       include_once("../_lib/lib/php/nm_gp_config_btn.php");
   }
   if (!$embbed)
   {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Nm_lang['lang_othr_grid_titl'] ?> - V_TBL_PROJECT</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_div_dir'] ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" /> 
</HEAD>
<BODY class="scGridPage" style="margin: 0px; overflow-x: hidden">
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery-ui.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>
<?php
   }
?>
<script language="javascript"> 
<?php
if ($embbed)
{
?>
  function scSubmitOrderCampos(sPos, sType) {
    $("#id_fsel_ok_sel_ord").val(sType);
    if(sType == 'cmp')
    {
       scPackSelectedOrd();
    }
   return new Promise(function(resolve, reject) {$.ajax({
    type: "POST",
    url: "grid_V_TBL_PROJECT_order_campos.php",
    data: {
     script_case_init: $("#id_script_case_init_sel_ord").val(),
     script_case_session: $("#id_script_case_session_sel_ord").val(),
     path_img: $("#id_path_img_sel_ord").val(),
     path_btn: $("#id_path_btn_sel_ord").val(),
     campos_sel: $("#id_campos_sel_sel_ord").val(),
     sel_regra: $("#id_sel_regra_sel_ord").val(),
     fsel_ok: $("#id_fsel_ok_sel_ord").val(),
     embbed_groupby: 'Y'
    }
   }).done(function(data) {
    scBtnOrderCamposHide(sPos);
    $("#sc_id_order_campos_placeholder_" + sPos).find("td").html("");
    var execString = data.toString().replace(/(\<.*?\>)/g, '');
    eval(execString).then(function(){resolve()});
   });});
  }
<?php
}
?>
 // Submeter o formularior
 //-------------------------------------
 function submit_form_Fsel_ord()
 {
     scPackSelectedOrd();
      document.Fsel_ord.submit();
 }
 function scPackSelectedOrd() {
  var fieldList, fieldName, i, selectedFields = new Array;
 fieldList = $("#sc_id_fldord_selected").sortable("toArray");
 for (i = 0; i < fieldList.length; i++) {
  fieldName  = fieldList[i].substr(14);
  selectedFields.push($("#sc_id_class_" + fieldName).val() + fieldName);
 }
 $("#id_campos_sel_sel_ord").val( selectedFields.join("@?@") );
 }
 </script>
<FORM name="Fsel_ord" method="POST">
  <INPUT type="hidden" name="script_case_init"    id="id_script_case_init_sel_ord"    value="<?php echo NM_encode_input($sc_init); ?>"> 
  <INPUT type="hidden" name="script_case_session" id="id_script_case_session_sel_ord" value="<?php echo NM_encode_input(session_id()); ?>"> 
  <INPUT type="hidden" name="path_img"            id="id_path_img_sel_ord"            value="<?php echo NM_encode_input($path_img); ?>"> 
  <INPUT type="hidden" name="path_btn"            id="id_path_btn_sel_ord"            value="<?php echo NM_encode_input($path_btn); ?>"> 
  <INPUT type="hidden" name="fsel_ok"             id="id_fsel_ok_sel_ord"             value=""> 
<?php
if ($embbed)
{
    echo "<div class='scAppDivMoldura'>";
    echo "<table id=\"main_table\" style=\"width: 100%\" cellspacing=0 cellpadding=0>";
}
elseif ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; right: 20px\">";
}
else
{
    echo "<table id=\"main_table\" style=\"position: relative; top: 20px; left: 20px\">";
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
   <?php echo $this->Nm_lang['lang_btns_sort_hint']; ?>
  </td>
 </tr>
 <tr>
  <td class="<?php echo ($embbed)? 'scAppDivContent css_scAppDivContentText':'scGridTabelaTd'; ?>">
   <table class="<?php echo ($embbed)? '':'scGridTabela'; ?>" style="border-width: 0; border-collapse: collapse; width:100%;" cellspacing=0 cellpadding=0>
    <tr class="<?php echo ($embbed)? '':'scGridFieldOddVert'; ?>">
     <td style="vertical-align: top">
     <table>
   <tr><td style="vertical-align: top">
 <script language="javascript" type="text/javascript">
  $(function() {
   $(".sc_ui_litem").mouseover(function() {
    $(this).css("cursor", "all-scroll");
   });
   $("#sc_id_fldord_available").sortable({
    connectWith: ".sc_ui_fldord_selected",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var fieldName = $(ui.item[0]).find("select").attr("id");
     $("#" + fieldName).show();
     $('#f_sel_sub').css('display', 'inline-block');
    }
   }).disableSelection();
   $("#sc_id_fldord_selected").sortable({
    connectWith: ".sc_ui_fldord_available",
    placeholder: "scAppDivSelectFieldsPlaceholder",
    remove: function(event, ui) {
     var fieldName = $(ui.item[0]).find("select").attr("id");
     $("#" + fieldName).hide();
     $('#f_sel_sub').css('display', 'inline-block');
    }
   });
   scUpdateListHeight();
  });
  function scUpdateListHeight() {
   $("#sc_id_fldord_available").css("min-height", "<?php echo sizeof($tab_ger_campos) * 26 ?>px");
   $("#sc_id_fldord_selected").css("min-height", "<?php echo sizeof($tab_ger_campos) * 26 ?>px");
  }
 </script>
 <style type="text/css">
  .sc_ui_sortable_ord {
   list-style-type: none;
   margin: 0;
   min-width: 225px;
  }
  .sc_ui_sortable_ord li {
   margin: 0 3px 3px 3px;
   padding: 1px 3px 1px 15px;
   min-height: 18px;
  }
  .sc_ui_sortable_ord li span {
   position: absolute;
   margin-left: -1.3em;
  }
 </style>
    <ul class="sc_ui_sort_groupby sc_ui_sortable_ord sc_ui_fldord_available scAppDivSelectFields" id="sc_id_fldord_available">
<?php
   foreach ($tab_ger_campos as $NM_cada_field => $NM_cada_opc)
   {
       if ($NM_cada_opc != "none")
       {
           if (!isset($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['ordem_select'][$tab_def_campos[$NM_cada_field]]))
           {
?>
     <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemord_<?php echo NM_encode_input($tab_def_campos[$NM_cada_field]); ?>">
      <?php echo $tab_labels[$NM_cada_field]; ?>
      <select id="sc_id_class_<?php echo NM_encode_input($tab_def_campos[$NM_cada_field]); ?>" class="scAppDivToolbarInput" style="display: none">
       <option value="+">Asc</option>
       <option value="-">Desc</option>
      </select><br/>
     </li>
<?php
           }
       }
   }
?>
    </ul>
   </td>
   <td style="vertical-align: top">
    <ul class="sc_ui_sort_groupby sc_ui_sortable_ord sc_ui_fldord_selected scAppDivSelectFields" id="sc_id_fldord_selected">
<?php
   foreach ($_SESSION['sc_session'][$sc_init]['grid_V_TBL_PROJECT']['ordem_select'] as $NM_cada_field => $NM_cada_opc)
   {
       if (isset($tab_converte[$NM_cada_field]))
       {
           $sAscSelected  = " selected";
           $sDescSelected = "";
           if ($NM_cada_opc == "desc")
           {
               $sAscSelected  = "";
               $sDescSelected = " selected";
           }
?>
     <li class="sc_ui_litem scAppDivSelectFieldsEnabled" id="sc_id_itemord_<?php echo $NM_cada_field; ?>">
      <?php echo $tab_labels[$tab_converte[$NM_cada_field]]; ?>
      <select id="sc_id_class_<?php echo NM_encode_input($tab_def_campos[ $tab_converte[$NM_cada_field] ]); ?>" class="scAppDivToolbarInput" onchange="$('#f_sel_sub').css('display', 'inline-block');">
       <option value="+"<?php echo $sAscSelected; ?>>Asc</option>
       <option value="-"<?php echo $sDescSelected; ?>>Desc</option>
      </select>
     </li>
<?php
       }
   }
?>
    </ul>
    <input type="hidden" name="campos_sel" id="id_campos_sel_sel_ord" value="">
   </td>
   </tr>
   </table>
   </td>
   </tr>
   </table>
  </td>
 </tr>
   <tr><td class="<?php echo ($embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>">
<?php
   if (!$embbed)
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bok", "document.Fsel_ord.fsel_ok.value='cmp';submit_form_Fsel_ord()", "document.Fsel_ord.fsel_ok.value='cmp';submit_form_Fsel_ord()", "f_sel_sub", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
   <?php echo nmButtonOutput($this->arr_buttons, "bapply", "scSubmitOrderCampos('" . NM_encode_input($tbar_pos) . "', 'cmp')", "scSubmitOrderCampos('" . NM_encode_input($tbar_pos) . "', 'cmp')", "f_sel_sub", "", "", "display: none;", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
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
   <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnOrderCamposHide('" . NM_encode_input($tbar_pos) . "')", "scBtnOrderCamposHide('" . NM_encode_input($tbar_pos) . "')", "Bsair", "", "", "", "absmiddle", "", "0px", $path_btn, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
   </td>
   </tr>
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
var bFixed = false;
function ajusta_window_Fsel_ord()
{
<?php
   if ($embbed)
   {
?>
  return false;
<?php
   }
?>
  var mt = $(document.getElementById("main_table"));
  if (0 == mt.width() || 0 == mt.height())
  {
    setTimeout("ajusta_window_Fsel_ord()", 50);
    return;
  }
  else if(!bFixed)
  {
    var oOrig = $(document.Fsel_ord.sel_orig),
        oDest = $(document.Fsel_ord.sel_dest),
        mHeight = Math.max(oOrig.height(), oDest.height()),
        mWidth = Math.max(oOrig.width() + 5, oDest.width() + 5);
    oOrig.height(mHeight);
    oOrig.width(mWidth);
    oDest.height(mHeight);
    oDest.width(mWidth + 15);
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
      self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
      setTimeout("ajusta_window_Fsel_ord()", 50);
      return;
    }
  }
  strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());
  self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);
}
$( document ).ready(function() {
  ajusta_window_Fsel_ord();
});
</script>
<script>
    ajusta_window_Fsel_ord();
</script>
</BODY>
</HTML>
<?php
}
}
