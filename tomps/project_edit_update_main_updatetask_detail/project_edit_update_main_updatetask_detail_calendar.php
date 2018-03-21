<?php
// Definicao do campo e valor
   $sField      = $_GET['field'];
   $sValue      = $_GET['value'];
   $sInter      = $_GET['inter'];
   $sFormat     = $_GET['format'];
   $sWeekIni    = $_GET['week_ini'];
   $sTimeFormat = $_GET['time_format'];
// Definicao da data
   $iDay   = date('j');
   $iMonth = date('n');
   $iYear  = date('Y');
   if ('ppo_tglmulaiplan' == $sField)
   {
       $this->nm_data->SetaData($sValue, $sFormat);
       $iDay   = ($this->nm_data->FormataSaida('j') > 0 && $this->nm_data->FormataSaida('j') < 32) ? $this->nm_data->FormataSaida('j') : $iDay;
       $iMonth = ($this->nm_data->FormataSaida('n') > 0 && $this->nm_data->FormataSaida('n') < 13) ? $this->nm_data->FormataSaida('n') : $iMonth;
       $iYear  = (is_numeric($this->nm_data->FormataSaida('Y')) && $this->nm_data->FormataSaida('Y') > 0) ? $this->nm_data->FormataSaida('Y') : $iYear;
   }
   if ('ppo_targetselesai' == $sField)
   {
       $this->nm_data->SetaData($sValue, $sFormat);
       $iDay   = ($this->nm_data->FormataSaida('j') > 0 && $this->nm_data->FormataSaida('j') < 32) ? $this->nm_data->FormataSaida('j') : $iDay;
       $iMonth = ($this->nm_data->FormataSaida('n') > 0 && $this->nm_data->FormataSaida('n') < 13) ? $this->nm_data->FormataSaida('n') : $iMonth;
       $iYear  = (is_numeric($this->nm_data->FormataSaida('Y')) && $this->nm_data->FormataSaida('Y') > 0) ? $this->nm_data->FormataSaida('Y') : $iYear;
   }
   if ('ppo_tglmulaiactual' == $sField)
   {
       $this->nm_data->SetaData($sValue, $sFormat);
       $iDay   = ($this->nm_data->FormataSaida('j') > 0 && $this->nm_data->FormataSaida('j') < 32) ? $this->nm_data->FormataSaida('j') : $iDay;
       $iMonth = ($this->nm_data->FormataSaida('n') > 0 && $this->nm_data->FormataSaida('n') < 13) ? $this->nm_data->FormataSaida('n') : $iMonth;
       $iYear  = (is_numeric($this->nm_data->FormataSaida('Y')) && $this->nm_data->FormataSaida('Y') > 0) ? $this->nm_data->FormataSaida('Y') : $iYear;
   }
   if ('ppo_tglselesaiactual' == $sField)
   {
       $this->nm_data->SetaData($sValue, $sFormat);
       $iDay   = ($this->nm_data->FormataSaida('j') > 0 && $this->nm_data->FormataSaida('j') < 32) ? $this->nm_data->FormataSaida('j') : $iDay;
       $iMonth = ($this->nm_data->FormataSaida('n') > 0 && $this->nm_data->FormataSaida('n') < 13) ? $this->nm_data->FormataSaida('n') : $iMonth;
       $iYear  = (is_numeric($this->nm_data->FormataSaida('Y')) && $this->nm_data->FormataSaida('Y') > 0) ? $this->nm_data->FormataSaida('Y') : $iYear;
   }
   if ('' == $sInter || 1 > $sInter)
   {
      $sInter = 10;
   }
// Definicao do idioma
   $sLang = 'en_us';
// Definicao da visualizacao
   $sBarBgColor     = ('' != $this->Ini->cor_barra_nav) ? $this->Ini->cor_barra_nav : $this->Ini->cor_bg_grid;
   $sBodyBgColor    = $this->Ini->cor_bg_grid;
   $sDayBgColor     = $this->Ini->cor_grid_impar;
   $sLinkFontColor  = $this->Ini->cor_link_dados;
   $sNowBgColor     = $this->Ini->cor_grid_par;
   $sTitleBgColor   = $this->Ini->cor_titulo;
   $sTitleFontColor = $this->Ini->cor_txt_titulo;
   if ('' != $this->Ini->cor_borda)
   {
       $sTableBorderColor = $this->Ini->cor_borda;
   }
   elseif ('' != $this->Ini->cor_bg_table)
   {
       $sTableBorderColor = $this->Ini->cor_bg_table;
   }
   else
   {
       $sTableBorderColor = '#000000';
   }
   $aDays   = array('en_us' => array($this->Ini->Nm_lang['lang_shrt_days_sund'], $this->Ini->Nm_lang['lang_shrt_days_mond'], $this->Ini->Nm_lang['lang_shrt_days_tued'], $this->Ini->Nm_lang['lang_shrt_days_wend'], $this->Ini->Nm_lang['lang_shrt_days_thud'], $this->Ini->Nm_lang['lang_shrt_days_frid'], $this->Ini->Nm_lang['lang_shrt_days_satd']));
   $aMonths = array('en_us' => array($this->Ini->Nm_lang['lang_mnth_janu'], $this->Ini->Nm_lang['lang_mnth_febr'], $this->Ini->Nm_lang['lang_mnth_marc'], $this->Ini->Nm_lang['lang_mnth_apri'], $this->Ini->Nm_lang['lang_mnth_mayy'], $this->Ini->Nm_lang['lang_mnth_june'], $this->Ini->Nm_lang['lang_mnth_july'], $this->Ini->Nm_lang['lang_mnth_augu'], $this->Ini->Nm_lang['lang_mnth_sept'], $this->Ini->Nm_lang['lang_mnth_octo'], $this->Ini->Nm_lang['lang_mnth_nove'], $this->Ini->Nm_lang['lang_mnth_dece']));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
  <title><?php echo strip_tags($this->Ini->Nm_lang['lang_btns_cldr_hint']); ?></title>
  <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

 if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
 {
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
 }

?>
  <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <script type="text/javascript">
   var sCalIcoBack  = "<?php echo $this->Ini->path_icones . '/' . $this->Ini->Cal_ico_back; ?>";
   var sCalIcoFor   = "<?php echo $this->Ini->path_icones . '/' . $this->Ini->Cal_ico_for; ?>";
   var sCalIcoClose = "<?php echo $this->Ini->path_icones . '/' . $this->Ini->Cal_ico_close; ?>";
   var aDayName     = new Array("<?php echo implode('", "', $aDays[$sLang]); ?>");
   var aMonthName   = new Array("<?php echo implode('", "', $aMonths[$sLang]); ?>");
   var fCallBack    = parent && parent.$ ? parent.calendar_<?php echo $sField; ?>_callback : opener.calendar_<?php echo $sField; ?>_callback;
  </script>
  <script type="text/javascript" src="<?php echo $this->Ini->path_js; ?>/calendar.js"></script>
  <script type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery.js"></script>
  <script type="text/javascript">
   function x_dim() {
    var mt = $(".scCalendarBorder"),
        W  = mt.width(),
        H  = mt.height();
    if (0 == W || 0 == H) {
     setTimeout("x_dim()", 50);
    }
    else {
     self.parent.tb_resize(H + 40, W + 40);
    }
   }
   $(function(){
    x_dim();
   });
  </script>
 </head>
 <body class="scCalendarPage">
 <table style="border-collapse: collapse; border-width: 0px" align="center"><tr><td style="padding: 0px">
  <div id="idCalendar">
   <script type="text/javascript">
    oCal = new nmCalendar(<?php echo $iDay; ?>, <?php echo $iMonth; ?>, <?php echo $iYear; ?>, '<?php echo $this->Ini->path_img_global; ?>', <?php echo $sInter; ?>, '<?php echo $sWeekIni; ?>', '<?php echo $sTimeFormat; ?>');
   </script>
  </div>
 </td></tr></table>
 </body>
</html>
