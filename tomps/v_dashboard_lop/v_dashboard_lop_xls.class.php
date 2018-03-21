<?php

class v_dashboard_lop_xls
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Xls_dados;
   var $Xls_workbook;
   var $Xls_col;
   var $Xls_row;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();
   var $Arquivo;
   var $Tit_doc;
   //---- 
   function __construct()
   {
   }

   //---- 
   function monta_xls()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida']) {
          $this->monta_html();
      }
      else { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "";
      }
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $this->Xls_row = 1;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
      { 
          set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
          require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
          require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
          require_once $this->Ini->path_third . '/phpexcel/PHPExcel/Cell/AdvancedValueBinder.php';
      } 
      $orig_form_dt = strtoupper($_SESSION['scriptcase']['reg_conf']['date_format']);
      $this->SC_date_conf_region = "";
      for ($i = 0; $i < 8; $i++)
      {
          if ($i > 0 && substr($orig_form_dt, $i, 1) != substr($this->SC_date_conf_region, -1, 1)) {
              $this->SC_date_conf_region .= $_SESSION['scriptcase']['reg_conf']['date_sep'];
          }
          $this->SC_date_conf_region .= substr($orig_form_dt, $i, 1);
      }
      $this->Xls_col    = 0;
      $this->nm_data    = new nm_data("en_us");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
      { 
          $this->Arquivo    = "sc_xls";
          $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
          $this->Arquivo   .= "_v_dashboard_lop";
          $this->Arquivo   .= ".xls";
          $this->Tit_doc    = "v_dashboard_lop.xls";
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );;
          $this->Xls_dados = new PHPExcel();
          $this->Xls_dados->setActiveSheetIndex(0);
          $this->Nm_ActiveSheet = $this->Xls_dados->getActiveSheet();
          if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
          {
              $this->Nm_ActiveSheet->setRightToLeft(true);
          }
      }
   }

   //----- 
   function grava_arquivo()
   {
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['xls_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['xls_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['xls_name']);
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();
      $this->count_span = 0;

      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['tp_witel'])) ? $this->New_label['tp_witel'] : "TP WITEL"; 
          if ($Cada_col == "tp_witel" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['kickoffmeeting'])) ? $this->New_label['kickoffmeeting'] : "Kickoff Meeting"; 
          if ($Cada_col == "kickoffmeeting" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['survey'])) ? $this->New_label['survey'] : "Survey"; 
          if ($Cada_col == "survey" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['rab_apd_kml'])) ? $this->New_label['rab_apd_kml'] : "RAB APD KML"; 
          if ($Cada_col == "rab_apd_kml" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['njki_justifikasi_nodin'])) ? $this->New_label['njki_justifikasi_nodin'] : "NJKI Justifikasi NODIN"; 
          if ($Cada_col == "njki_justifikasi_nodin" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['perijinan'])) ? $this->New_label['perijinan'] : "Perijinan"; 
          if ($Cada_col == "perijinan" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['deliverymaterial'])) ? $this->New_label['deliverymaterial'] : "Delivery Material"; 
          if ($Cada_col == "deliverymaterial" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['bctr'])) ? $this->New_label['bctr'] : "BCTR"; 
          if ($Cada_col == "bctr" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['gelarhdpetanamtiang'])) ? $this->New_label['gelarhdpetanamtiang'] : "Gelar HDPE Tanam Tiang"; 
          if ($Cada_col == "gelarhdpetanamtiang" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['gelarkabel'])) ? $this->New_label['gelarkabel'] : "Gelar Kabel"; 
          if ($Cada_col == "gelarkabel" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['pasangterminalterminasijumperodf'])) ? $this->New_label['pasangterminalterminasijumperodf'] : "Pasang Terminal Terminasi Jumper ODF"; 
          if ($Cada_col == "pasangterminalterminasijumperodf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['pasangterminalterminasjumperodc'])) ? $this->New_label['pasangterminalterminasjumperodc'] : "Pasang Terminal Terminas Jumper ODC"; 
          if ($Cada_col == "pasangterminalterminasjumperodc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['pasangterminalodp'])) ? $this->New_label['pasangterminalodp'] : "Pasang Terminal ODP"; 
          if ($Cada_col == "pasangterminalodp" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['terminasiodp'])) ? $this->New_label['terminasiodp'] : "Terminasi ODP"; 
          if ($Cada_col == "terminasiodp" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['testcomm'])) ? $this->New_label['testcomm'] : "Test Comm"; 
          if ($Cada_col == "testcomm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ujiterima'])) ? $this->New_label['ujiterima'] : "Uji Terima"; 
          if ($Cada_col == "ujiterima" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['bautrekon'])) ? $this->New_label['bautrekon'] : "BAUT Rekon"; 
          if ($Cada_col == "bautrekon" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['amandemenbast'])) ? $this->New_label['amandemenbast'] : "Amandemen BAST"; 
          if ($Cada_col == "amandemenbast" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['grir'])) ? $this->New_label['grir'] : "GRIR"; 
          if ($Cada_col == "grir" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['newentry'])) ? $this->New_label['newentry'] : "New Entry"; 
          if ($Cada_col == "newentry" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['inprogress'])) ? $this->New_label['inprogress'] : "Inprogress"; 
          if ($Cada_col == "inprogress" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['others'])) ? $this->New_label['others'] : "Others"; 
          if ($Cada_col == "others" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['complete'])) ? $this->New_label['complete'] : "Complete"; 
          if ($Cada_col == "complete" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_label']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_label'])
      { 
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
          return;
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->tp_witel = $Busca_temp['tp_witel']; 
          $tmp_pos = strpos($this->tp_witel, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_witel))
          {
              $this->tp_witel = substr($this->tp_witel, 0, $tmp_pos);
          }
          $this->kickoffmeeting = $Busca_temp['kickoffmeeting']; 
          $tmp_pos = strpos($this->kickoffmeeting, "##@@");
          if ($tmp_pos !== false && !is_array($this->kickoffmeeting))
          {
              $this->kickoffmeeting = substr($this->kickoffmeeting, 0, $tmp_pos);
          }
          $this->survey = $Busca_temp['survey']; 
          $tmp_pos = strpos($this->survey, "##@@");
          if ($tmp_pos !== false && !is_array($this->survey))
          {
              $this->survey = substr($this->survey, 0, $tmp_pos);
          }
          $this->rab_apd_kml = $Busca_temp['rab_apd_kml']; 
          $tmp_pos = strpos($this->rab_apd_kml, "##@@");
          if ($tmp_pos !== false && !is_array($this->rab_apd_kml))
          {
              $this->rab_apd_kml = substr($this->rab_apd_kml, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq_filtro'];
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         $this->Xls_col = 0;
         $this->Xls_row++;
         $this->tp_witel = $rs->fields[0] ;  
         $this->tp_witel = (string)$this->tp_witel;
         $this->kickoffmeeting = $rs->fields[1] ;  
         $this->kickoffmeeting = (string)$this->kickoffmeeting;
         $this->survey = $rs->fields[2] ;  
         $this->survey = (string)$this->survey;
         $this->rab_apd_kml = $rs->fields[3] ;  
         $this->rab_apd_kml = (string)$this->rab_apd_kml;
         $this->njki_justifikasi_nodin = $rs->fields[4] ;  
         $this->njki_justifikasi_nodin = (string)$this->njki_justifikasi_nodin;
         $this->perijinan = $rs->fields[5] ;  
         $this->perijinan = (string)$this->perijinan;
         $this->deliverymaterial = $rs->fields[6] ;  
         $this->deliverymaterial = (string)$this->deliverymaterial;
         $this->bctr = $rs->fields[7] ;  
         $this->bctr = (string)$this->bctr;
         $this->gelarhdpetanamtiang = $rs->fields[8] ;  
         $this->gelarhdpetanamtiang = (string)$this->gelarhdpetanamtiang;
         $this->gelarkabel = $rs->fields[9] ;  
         $this->gelarkabel = (string)$this->gelarkabel;
         $this->pasangterminalterminasijumperodf = $rs->fields[10] ;  
         $this->pasangterminalterminasijumperodf = (string)$this->pasangterminalterminasijumperodf;
         $this->pasangterminalterminasjumperodc = $rs->fields[11] ;  
         $this->pasangterminalterminasjumperodc = (string)$this->pasangterminalterminasjumperodc;
         $this->pasangterminalodp = $rs->fields[12] ;  
         $this->pasangterminalodp = (string)$this->pasangterminalodp;
         $this->terminasiodp = $rs->fields[13] ;  
         $this->terminasiodp = (string)$this->terminasiodp;
         $this->testcomm = $rs->fields[14] ;  
         $this->testcomm = (string)$this->testcomm;
         $this->ujiterima = $rs->fields[15] ;  
         $this->ujiterima = (string)$this->ujiterima;
         $this->bautrekon = $rs->fields[16] ;  
         $this->bautrekon = (string)$this->bautrekon;
         $this->amandemenbast = $rs->fields[17] ;  
         $this->amandemenbast = (string)$this->amandemenbast;
         $this->grir = $rs->fields[18] ;  
         $this->grir = (string)$this->grir;
         $this->newentry = $rs->fields[19] ;  
         $this->newentry =  str_replace(",", ".", $this->newentry);
         $this->newentry = (string)$this->newentry;
         $this->inprogress = $rs->fields[20] ;  
         $this->inprogress =  str_replace(",", ".", $this->inprogress);
         $this->inprogress = (string)$this->inprogress;
         $this->others = $rs->fields[21] ;  
         $this->others =  str_replace(",", ".", $this->others);
         $this->others = (string)$this->others;
         $this->complete = $rs->fields[22] ;  
         $this->complete =  str_replace(",", ".", $this->complete);
         $this->complete = (string)$this->complete;
         //----- lookup - tp_witel
         $this->look_tp_witel = $this->tp_witel; 
         $this->Lookup->lookup_tp_witel($this->look_tp_witel, $this->tp_witel) ; 
         $this->look_tp_witel = ($this->look_tp_witel == "&nbsp;") ? "" : $this->look_tp_witel; 
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['v_dashboard_lop']['contr_erro'] = 'on';
 $tahapan0 ="21,41,61";
$this->Ini->link_survey_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_survey_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_survey_apl = str_replace("'", "?&?'", $this->Ini->link_survey_apl);
$this->Ini->link_survey_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan0  . "?@?";
$this->Ini->link_survey_parms = str_replace("'", "?&?'", $this->Ini->link_survey_parms);
$this->Ini->link_survey_hint = "";
$this->Ini->link_survey_hint = str_replace("'", "?&?'", $this->Ini->link_survey_hint);
$this->Ini->link_survey_target = "_self";
$this->Ini->link_survey_pos = "";
$this->Ini->link_survey_alt = "";
$this->Ini->link_survey_larg = "";
;
$tahapan1 ="22,42,62";
$this->Ini->link_survey_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_survey_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_survey_apl = str_replace("'", "?&?'", $this->Ini->link_survey_apl);
$this->Ini->link_survey_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan1  . "?@?";
$this->Ini->link_survey_parms = str_replace("'", "?&?'", $this->Ini->link_survey_parms);
$this->Ini->link_survey_hint = "";
$this->Ini->link_survey_hint = str_replace("'", "?&?'", $this->Ini->link_survey_hint);
$this->Ini->link_survey_target = "_self";
$this->Ini->link_survey_pos = "";
$this->Ini->link_survey_alt = "";
$this->Ini->link_survey_larg = "";
;
$tahapan2 = "23,43,63";
$this->Ini->link_rab_apd_kml_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_rab_apd_kml_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_rab_apd_kml_apl = str_replace("'", "?&?'", $this->Ini->link_rab_apd_kml_apl);
$this->Ini->link_rab_apd_kml_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan2  . "?@?";
$this->Ini->link_rab_apd_kml_parms = str_replace("'", "?&?'", $this->Ini->link_rab_apd_kml_parms);
$this->Ini->link_rab_apd_kml_hint = "";
$this->Ini->link_rab_apd_kml_hint = str_replace("'", "?&?'", $this->Ini->link_rab_apd_kml_hint);
$this->Ini->link_rab_apd_kml_target = "_self";
$this->Ini->link_rab_apd_kml_pos = "";
$this->Ini->link_rab_apd_kml_alt = "";
$this->Ini->link_rab_apd_kml_larg = "";
;
$tahapan3 = "24,44,64";
$this->Ini->link_njki_justifikasi_nodin_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_njki_justifikasi_nodin_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_njki_justifikasi_nodin_apl = str_replace("'", "?&?'", $this->Ini->link_njki_justifikasi_nodin_apl);
$this->Ini->link_njki_justifikasi_nodin_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan3  . "?@?";
$this->Ini->link_njki_justifikasi_nodin_parms = str_replace("'", "?&?'", $this->Ini->link_njki_justifikasi_nodin_parms);
$this->Ini->link_njki_justifikasi_nodin_hint = "";
$this->Ini->link_njki_justifikasi_nodin_hint = str_replace("'", "?&?'", $this->Ini->link_njki_justifikasi_nodin_hint);
$this->Ini->link_njki_justifikasi_nodin_target = "_self";
$this->Ini->link_njki_justifikasi_nodin_pos = "";
$this->Ini->link_njki_justifikasi_nodin_alt = "";
$this->Ini->link_njki_justifikasi_nodin_larg = "";
;
$tahapan4 = "28,48,68";
$this->Ini->link_perijinan_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_perijinan_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_perijinan_apl = str_replace("'", "?&?'", $this->Ini->link_perijinan_apl);
$this->Ini->link_perijinan_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan4  . "?@?";
$this->Ini->link_perijinan_parms = str_replace("'", "?&?'", $this->Ini->link_perijinan_parms);
$this->Ini->link_perijinan_hint = "";
$this->Ini->link_perijinan_hint = str_replace("'", "?&?'", $this->Ini->link_perijinan_hint);
$this->Ini->link_perijinan_target = "_self";
$this->Ini->link_perijinan_pos = "";
$this->Ini->link_perijinan_alt = "";
$this->Ini->link_perijinan_larg = "";
;
$tahapan5 = "29,49,69";
$this->Ini->link_deliverymaterial_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_deliverymaterial_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_deliverymaterial_apl = str_replace("'", "?&?'", $this->Ini->link_deliverymaterial_apl);
$this->Ini->link_deliverymaterial_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan5  . "?@?";
$this->Ini->link_deliverymaterial_parms = str_replace("'", "?&?'", $this->Ini->link_deliverymaterial_parms);
$this->Ini->link_deliverymaterial_hint = "";
$this->Ini->link_deliverymaterial_hint = str_replace("'", "?&?'", $this->Ini->link_deliverymaterial_hint);
$this->Ini->link_deliverymaterial_target = "_self";
$this->Ini->link_deliverymaterial_pos = "";
$this->Ini->link_deliverymaterial_alt = "";
$this->Ini->link_deliverymaterial_larg = "";
;
$tahapan6 = "30,50,70";
$this->Ini->link_bctr_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_bctr_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_bctr_apl = str_replace("'", "?&?'", $this->Ini->link_bctr_apl);
$this->Ini->link_bctr_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan6  . "?@?";
$this->Ini->link_bctr_parms = str_replace("'", "?&?'", $this->Ini->link_bctr_parms);
$this->Ini->link_bctr_hint = "";
$this->Ini->link_bctr_hint = str_replace("'", "?&?'", $this->Ini->link_bctr_hint);
$this->Ini->link_bctr_target = "_self";
$this->Ini->link_bctr_pos = "";
$this->Ini->link_bctr_alt = "";
$this->Ini->link_bctr_larg = "";
;
$tahapan7 = "31,51,71";
$this->Ini->link_gelarhdpetanamtiang_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_gelarhdpetanamtiang_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_gelarhdpetanamtiang_apl = str_replace("'", "?&?'", $this->Ini->link_gelarhdpetanamtiang_apl);
$this->Ini->link_gelarhdpetanamtiang_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan7  . "?@?";
$this->Ini->link_gelarhdpetanamtiang_parms = str_replace("'", "?&?'", $this->Ini->link_gelarhdpetanamtiang_parms);
$this->Ini->link_gelarhdpetanamtiang_hint = "";
$this->Ini->link_gelarhdpetanamtiang_hint = str_replace("'", "?&?'", $this->Ini->link_gelarhdpetanamtiang_hint);
$this->Ini->link_gelarhdpetanamtiang_target = "_self";
$this->Ini->link_gelarhdpetanamtiang_pos = "";
$this->Ini->link_gelarhdpetanamtiang_alt = "";
$this->Ini->link_gelarhdpetanamtiang_larg = "";
;
$tahapan8 = "32,52,72";
$this->Ini->link_gelarkabel_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_gelarkabel_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_gelarkabel_apl = str_replace("'", "?&?'", $this->Ini->link_gelarkabel_apl);
$this->Ini->link_gelarkabel_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan8  . "?@?";
$this->Ini->link_gelarkabel_parms = str_replace("'", "?&?'", $this->Ini->link_gelarkabel_parms);
$this->Ini->link_gelarkabel_hint = "";
$this->Ini->link_gelarkabel_hint = str_replace("'", "?&?'", $this->Ini->link_gelarkabel_hint);
$this->Ini->link_gelarkabel_target = "_self";
$this->Ini->link_gelarkabel_pos = "";
$this->Ini->link_gelarkabel_alt = "";
$this->Ini->link_gelarkabel_larg = "";
;
$tahapan9 = "33,53,73";
$this->Ini->link_pasangterminalterminasijumperodf_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_pasangterminalterminasijumperodf_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_pasangterminalterminasijumperodf_apl = str_replace("'", "?&?'", $this->Ini->link_pasangterminalterminasijumperodf_apl);
$this->Ini->link_pasangterminalterminasijumperodf_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan9  . "?@?";
$this->Ini->link_pasangterminalterminasijumperodf_parms = str_replace("'", "?&?'", $this->Ini->link_pasangterminalterminasijumperodf_parms);
$this->Ini->link_pasangterminalterminasijumperodf_hint = "";
$this->Ini->link_pasangterminalterminasijumperodf_hint = str_replace("'", "?&?'", $this->Ini->link_pasangterminalterminasijumperodf_hint);
$this->Ini->link_pasangterminalterminasijumperodf_target = "_self";
$this->Ini->link_pasangterminalterminasijumperodf_pos = "";
$this->Ini->link_pasangterminalterminasijumperodf_alt = "";
$this->Ini->link_pasangterminalterminasijumperodf_larg = "";
;
$tahapan10 = "34,54,74";
$this->Ini->link_pasangterminalterminasjumperodc_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_pasangterminalterminasjumperodc_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_pasangterminalterminasjumperodc_apl = str_replace("'", "?&?'", $this->Ini->link_pasangterminalterminasjumperodc_apl);
$this->Ini->link_pasangterminalterminasjumperodc_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan10  . "?@?";
$this->Ini->link_pasangterminalterminasjumperodc_parms = str_replace("'", "?&?'", $this->Ini->link_pasangterminalterminasjumperodc_parms);
$this->Ini->link_pasangterminalterminasjumperodc_hint = "";
$this->Ini->link_pasangterminalterminasjumperodc_hint = str_replace("'", "?&?'", $this->Ini->link_pasangterminalterminasjumperodc_hint);
$this->Ini->link_pasangterminalterminasjumperodc_target = "_self";
$this->Ini->link_pasangterminalterminasjumperodc_pos = "";
$this->Ini->link_pasangterminalterminasjumperodc_alt = "";
$this->Ini->link_pasangterminalterminasjumperodc_larg = "";
;
$tahapan11 = "35,55,75";
$this->Ini->link_pasangterminalodp_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_pasangterminalodp_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_pasangterminalodp_apl = str_replace("'", "?&?'", $this->Ini->link_pasangterminalodp_apl);
$this->Ini->link_pasangterminalodp_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan11  . "?@?";
$this->Ini->link_pasangterminalodp_parms = str_replace("'", "?&?'", $this->Ini->link_pasangterminalodp_parms);
$this->Ini->link_pasangterminalodp_hint = "";
$this->Ini->link_pasangterminalodp_hint = str_replace("'", "?&?'", $this->Ini->link_pasangterminalodp_hint);
$this->Ini->link_pasangterminalodp_target = "_self";
$this->Ini->link_pasangterminalodp_pos = "";
$this->Ini->link_pasangterminalodp_alt = "";
$this->Ini->link_pasangterminalodp_larg = "";
;
$tahapan12 = "36,56,76";
$this->Ini->link_terminasiodp_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_terminasiodp_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_terminasiodp_apl = str_replace("'", "?&?'", $this->Ini->link_terminasiodp_apl);
$this->Ini->link_terminasiodp_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan12  . "?@?";
$this->Ini->link_terminasiodp_parms = str_replace("'", "?&?'", $this->Ini->link_terminasiodp_parms);
$this->Ini->link_terminasiodp_hint = "";
$this->Ini->link_terminasiodp_hint = str_replace("'", "?&?'", $this->Ini->link_terminasiodp_hint);
$this->Ini->link_terminasiodp_target = "_self";
$this->Ini->link_terminasiodp_pos = "";
$this->Ini->link_terminasiodp_alt = "";
$this->Ini->link_terminasiodp_larg = "";
;
$tahapan13 = "37,57,77";
$this->Ini->link_testcomm_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_testcomm_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_testcomm_apl = str_replace("'", "?&?'", $this->Ini->link_testcomm_apl);
$this->Ini->link_testcomm_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan13  . "?@?";
$this->Ini->link_testcomm_parms = str_replace("'", "?&?'", $this->Ini->link_testcomm_parms);
$this->Ini->link_testcomm_hint = "";
$this->Ini->link_testcomm_hint = str_replace("'", "?&?'", $this->Ini->link_testcomm_hint);
$this->Ini->link_testcomm_target = "_self";
$this->Ini->link_testcomm_pos = "";
$this->Ini->link_testcomm_alt = "";
$this->Ini->link_testcomm_larg = "";
;
$tahapan14 = "38,58,78";
$this->Ini->link_ujiterima_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_ujiterima_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_ujiterima_apl = str_replace("'", "?&?'", $this->Ini->link_ujiterima_apl);
$this->Ini->link_ujiterima_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan14  . "?@?";
$this->Ini->link_ujiterima_parms = str_replace("'", "?&?'", $this->Ini->link_ujiterima_parms);
$this->Ini->link_ujiterima_hint = "";
$this->Ini->link_ujiterima_hint = str_replace("'", "?&?'", $this->Ini->link_ujiterima_hint);
$this->Ini->link_ujiterima_target = "_self";
$this->Ini->link_ujiterima_pos = "";
$this->Ini->link_ujiterima_alt = "";
$this->Ini->link_ujiterima_larg = "";
;
$tahapan15 = "39,59,79";
$this->Ini->link_bautrekon_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_bautrekon_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_bautrekon_apl = str_replace("'", "?&?'", $this->Ini->link_bautrekon_apl);
$this->Ini->link_bautrekon_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan15  . "?@?";
$this->Ini->link_bautrekon_parms = str_replace("'", "?&?'", $this->Ini->link_bautrekon_parms);
$this->Ini->link_bautrekon_hint = "";
$this->Ini->link_bautrekon_hint = str_replace("'", "?&?'", $this->Ini->link_bautrekon_hint);
$this->Ini->link_bautrekon_target = "_self";
$this->Ini->link_bautrekon_pos = "";
$this->Ini->link_bautrekon_alt = "";
$this->Ini->link_bautrekon_larg = "";
;
$tahapan16 = "40,60,80";
$this->Ini->link_amandemenbast_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_amandemenbast_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_amandemenbast_apl = str_replace("'", "?&?'", $this->Ini->link_amandemenbast_apl);
$this->Ini->link_amandemenbast_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan16  . "?@?";
$this->Ini->link_amandemenbast_parms = str_replace("'", "?&?'", $this->Ini->link_amandemenbast_parms);
$this->Ini->link_amandemenbast_hint = "";
$this->Ini->link_amandemenbast_hint = str_replace("'", "?&?'", $this->Ini->link_amandemenbast_hint);
$this->Ini->link_amandemenbast_target = "_self";
$this->Ini->link_amandemenbast_pos = "";
$this->Ini->link_amandemenbast_alt = "";
$this->Ini->link_amandemenbast_larg = "";
;
$tahapan17 = "81,82,83";
$this->Ini->link_grir_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_grir_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_grir_apl = str_replace("'", "?&?'", $this->Ini->link_grir_apl);
$this->Ini->link_grir_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan17  . "?@?";
$this->Ini->link_grir_parms = str_replace("'", "?&?'", $this->Ini->link_grir_parms);
$this->Ini->link_grir_hint = "";
$this->Ini->link_grir_hint = str_replace("'", "?&?'", $this->Ini->link_grir_hint);
$this->Ini->link_grir_target = "_self";
$this->Ini->link_grir_pos = "";
$this->Ini->link_grir_alt = "";
$this->Ini->link_grir_larg = "";
;
$_SESSION['scriptcase']['v_dashboard_lop']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if (isset($this->NM_Row_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
         { 
             foreach ($this->NM_Row_din as $row => $height) 
             { 
                 $this->Nm_ActiveSheet->getRowDimension($row)->setRowHeight($height);
             } 
         } 
         $rs->MoveNext();
      }
      if (isset($this->NM_Col_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
      { 
          $objWriter = new PHPExcel_Writer_Excel5($this->Xls_dados);
          $objWriter->save($this->Xls_f);
      } 
      else 
      { 
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
      } 
      $rs->Close();
   }
   //----- tp_witel
   function NM_export_tp_witel()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->look_tp_witel))
         {
             $this->look_tp_witel = sc_convert_encoding($this->look_tp_witel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->look_tp_witel))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->look_tp_witel);
         $this->Xls_col++;
   }
   //----- kickoffmeeting
   function NM_export_kickoffmeeting()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->kickoffmeeting))
         {
             $this->kickoffmeeting = sc_convert_encoding($this->kickoffmeeting, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->kickoffmeeting))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->kickoffmeeting);
         $this->Xls_col++;
   }
   //----- survey
   function NM_export_survey()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->survey))
         {
             $this->survey = sc_convert_encoding($this->survey, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->survey))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->survey);
         $this->Xls_col++;
   }
   //----- rab_apd_kml
   function NM_export_rab_apd_kml()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->rab_apd_kml))
         {
             $this->rab_apd_kml = sc_convert_encoding($this->rab_apd_kml, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->rab_apd_kml))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->rab_apd_kml);
         $this->Xls_col++;
   }
   //----- njki_justifikasi_nodin
   function NM_export_njki_justifikasi_nodin()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->njki_justifikasi_nodin))
         {
             $this->njki_justifikasi_nodin = sc_convert_encoding($this->njki_justifikasi_nodin, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->njki_justifikasi_nodin))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->njki_justifikasi_nodin);
         $this->Xls_col++;
   }
   //----- perijinan
   function NM_export_perijinan()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->perijinan))
         {
             $this->perijinan = sc_convert_encoding($this->perijinan, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->perijinan))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->perijinan);
         $this->Xls_col++;
   }
   //----- deliverymaterial
   function NM_export_deliverymaterial()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->deliverymaterial))
         {
             $this->deliverymaterial = sc_convert_encoding($this->deliverymaterial, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->deliverymaterial))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->deliverymaterial);
         $this->Xls_col++;
   }
   //----- bctr
   function NM_export_bctr()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->bctr))
         {
             $this->bctr = sc_convert_encoding($this->bctr, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->bctr))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->bctr);
         $this->Xls_col++;
   }
   //----- gelarhdpetanamtiang
   function NM_export_gelarhdpetanamtiang()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->gelarhdpetanamtiang))
         {
             $this->gelarhdpetanamtiang = sc_convert_encoding($this->gelarhdpetanamtiang, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->gelarhdpetanamtiang))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->gelarhdpetanamtiang);
         $this->Xls_col++;
   }
   //----- gelarkabel
   function NM_export_gelarkabel()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->gelarkabel))
         {
             $this->gelarkabel = sc_convert_encoding($this->gelarkabel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->gelarkabel))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->gelarkabel);
         $this->Xls_col++;
   }
   //----- pasangterminalterminasijumperodf
   function NM_export_pasangterminalterminasijumperodf()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->pasangterminalterminasijumperodf))
         {
             $this->pasangterminalterminasijumperodf = sc_convert_encoding($this->pasangterminalterminasijumperodf, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->pasangterminalterminasijumperodf))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->pasangterminalterminasijumperodf);
         $this->Xls_col++;
   }
   //----- pasangterminalterminasjumperodc
   function NM_export_pasangterminalterminasjumperodc()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->pasangterminalterminasjumperodc))
         {
             $this->pasangterminalterminasjumperodc = sc_convert_encoding($this->pasangterminalterminasjumperodc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->pasangterminalterminasjumperodc))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->pasangterminalterminasjumperodc);
         $this->Xls_col++;
   }
   //----- pasangterminalodp
   function NM_export_pasangterminalodp()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->pasangterminalodp))
         {
             $this->pasangterminalodp = sc_convert_encoding($this->pasangterminalodp, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->pasangterminalodp))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->pasangterminalodp);
         $this->Xls_col++;
   }
   //----- terminasiodp
   function NM_export_terminasiodp()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->terminasiodp))
         {
             $this->terminasiodp = sc_convert_encoding($this->terminasiodp, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->terminasiodp))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->terminasiodp);
         $this->Xls_col++;
   }
   //----- testcomm
   function NM_export_testcomm()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->testcomm))
         {
             $this->testcomm = sc_convert_encoding($this->testcomm, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->testcomm))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->testcomm);
         $this->Xls_col++;
   }
   //----- ujiterima
   function NM_export_ujiterima()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->ujiterima))
         {
             $this->ujiterima = sc_convert_encoding($this->ujiterima, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ujiterima))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->ujiterima);
         $this->Xls_col++;
   }
   //----- bautrekon
   function NM_export_bautrekon()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->bautrekon))
         {
             $this->bautrekon = sc_convert_encoding($this->bautrekon, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->bautrekon))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->bautrekon);
         $this->Xls_col++;
   }
   //----- amandemenbast
   function NM_export_amandemenbast()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->amandemenbast))
         {
             $this->amandemenbast = sc_convert_encoding($this->amandemenbast, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->amandemenbast))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->amandemenbast);
         $this->Xls_col++;
   }
   //----- grir
   function NM_export_grir()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->grir))
         {
             $this->grir = sc_convert_encoding($this->grir, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->grir))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->grir);
         $this->Xls_col++;
   }
   //----- newentry
   function NM_export_newentry()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->newentry))
         {
             $this->newentry = sc_convert_encoding($this->newentry, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->newentry))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->newentry);
         $this->Xls_col++;
   }
   //----- inprogress
   function NM_export_inprogress()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->inprogress))
         {
             $this->inprogress = sc_convert_encoding($this->inprogress, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->inprogress))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->inprogress);
         $this->Xls_col++;
   }
   //----- others
   function NM_export_others()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->others))
         {
             $this->others = sc_convert_encoding($this->others, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->others))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->others);
         $this->Xls_col++;
   }
   //----- complete
   function NM_export_complete()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->complete))
         {
             $this->complete = sc_convert_encoding($this->complete, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->complete))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->complete);
         $this->Xls_col++;
   }

   function calc_cell($col)
   {
       $arr_alfa = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
       $val_ret = "";
       $result = $col + 1;
       while ($result > 26)
       {
           $cel      = $result % 26;
           $result   = $result / 26;
           if ($cel == 0)
           {
               $cel    = 26;
               $result--;
           }
           $val_ret = $arr_alfa[$cel] . $val_ret;
       }
       $val_ret = $arr_alfa[$result] . $val_ret;
       return $val_ret;
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT")
       {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT")
       {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       nm_conv_form_data($dt_out, $form_in, $form_out);
       return $dt_out;
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Resume LOP Divre :: Excel</TITLE>
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
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">XLS</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="v_dashboard_lop_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="v_dashboard_lop"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
}

?>
