<?php

class grid_V_RESUME_DETAILPROJECT_xls
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida']) {
          $this->monta_html();
      }
      else { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['opcao'] = "";
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
      { 
          $this->Arquivo    = "sc_xls";
          $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
          $this->Arquivo   .= "_grid_V_RESUME_DETAILPROJECT";
          $this->Arquivo   .= ".xls";
          $this->Tit_doc    = "grid_V_RESUME_DETAILPROJECT.xls";
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['xls_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['xls_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['xls_name']);
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_V_RESUME_DETAILPROJECT']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_V_RESUME_DETAILPROJECT']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_V_RESUME_DETAILPROJECT']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();
      $this->count_span = 0;

      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['ppo_projectid'])) ? $this->New_label['ppo_projectid'] : "PPO PROJECTID"; 
          if ($Cada_col == "ppo_projectid" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
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
          $SC_Label = (isset($this->New_label['taskproses'])) ? $this->New_label['taskproses'] : "TASKPROSES"; 
          if ($Cada_col == "taskproses" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['taskprosesname'])) ? $this->New_label['taskprosesname'] : "TASKPROSESNAME"; 
          if ($Cada_col == "taskprosesname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ppo_tahapanproject'])) ? $this->New_label['ppo_tahapanproject'] : "PPO TAHAPANPROJECT"; 
          if ($Cada_col == "ppo_tahapanproject" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
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
          $SC_Label = (isset($this->New_label['ppo_tasktahapan'])) ? $this->New_label['ppo_tasktahapan'] : "PPO TASKTAHAPAN"; 
          if ($Cada_col == "ppo_tasktahapan" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ppo_tasknumber'])) ? $this->New_label['ppo_tasknumber'] : "PPO TASKNUMBER"; 
          if ($Cada_col == "ppo_tasknumber" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
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
          $SC_Label = (isset($this->New_label['ppo_status'])) ? $this->New_label['ppo_status'] : "PPO STATUS"; 
          if ($Cada_col == "ppo_status" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['statusname'])) ? $this->New_label['statusname'] : "STATUSNAME"; 
          if ($Cada_col == "statusname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ppo_tglmulaiplan'])) ? $this->New_label['ppo_tglmulaiplan'] : "PPO TGLMULAIPLAN"; 
          if ($Cada_col == "ppo_tglmulaiplan" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ppo_targethari'])) ? $this->New_label['ppo_targethari'] : "PPO TARGETHARI"; 
          if ($Cada_col == "ppo_targethari" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
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
          $SC_Label = (isset($this->New_label['ppo_targetselesai'])) ? $this->New_label['ppo_targetselesai'] : "PPO TARGETSELESAI"; 
          if ($Cada_col == "ppo_targetselesai" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ppo_tglmulaiactual'])) ? $this->New_label['ppo_tglmulaiactual'] : "PPO TGLMULAIACTUAL"; 
          if ($Cada_col == "ppo_tglmulaiactual" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ppo_tglselesaiactual'])) ? $this->New_label['ppo_tglselesaiactual'] : "PPO TGLSELESAIACTUAL"; 
          if ($Cada_col == "ppo_tglselesaiactual" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['sisatarget'])) ? $this->New_label['sisatarget'] : "SISATARGET"; 
          if ($Cada_col == "sisatarget" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
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
          $SC_Label = (isset($this->New_label['realisasi'])) ? $this->New_label['realisasi'] : "REALISASI"; 
          if ($Cada_col == "realisasi" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
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
          $SC_Label = (isset($this->New_label['ketrealiasisijmlhari'])) ? $this->New_label['ketrealiasisijmlhari'] : "KETREALIASISIJMLHARI"; 
          if ($Cada_col == "ketrealiasisijmlhari" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                  $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $SC_Label);
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida_label']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida_label'])
      { 
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
          return;
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->ppo_projectid = $Busca_temp['ppo_projectid']; 
          $tmp_pos = strpos($this->ppo_projectid, "##@@");
          if ($tmp_pos !== false && !is_array($this->ppo_projectid))
          {
              $this->ppo_projectid = substr($this->ppo_projectid, 0, $tmp_pos);
          }
          $this->taskproses = $Busca_temp['taskproses']; 
          $tmp_pos = strpos($this->taskproses, "##@@");
          if ($tmp_pos !== false && !is_array($this->taskproses))
          {
              $this->taskproses = substr($this->taskproses, 0, $tmp_pos);
          }
          $this->taskprosesname = $Busca_temp['taskprosesname']; 
          $tmp_pos = strpos($this->taskprosesname, "##@@");
          if ($tmp_pos !== false && !is_array($this->taskprosesname))
          {
              $this->taskprosesname = substr($this->taskprosesname, 0, $tmp_pos);
          }
          $this->ppo_tahapanproject = $Busca_temp['ppo_tahapanproject']; 
          $tmp_pos = strpos($this->ppo_tahapanproject, "##@@");
          if ($tmp_pos !== false && !is_array($this->ppo_tahapanproject))
          {
              $this->ppo_tahapanproject = substr($this->ppo_tahapanproject, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['where_pesq_filtro'];
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT PPO_PROJECTID, TASKPROSES, TASKPROSESNAME, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_TASKNUMBER, PPO_STATUS, STATUSNAME, str_replace (convert(char(10),PPO_TGLMULAIPLAN,102), '.', '-') + ' ' + convert(char(8),PPO_TGLMULAIPLAN,20), PPO_TARGETHARI, str_replace (convert(char(10),PPO_TARGETSELESAI,102), '.', '-') + ' ' + convert(char(8),PPO_TARGETSELESAI,20), str_replace (convert(char(10),PPO_TGLMULAIACTUAL,102), '.', '-') + ' ' + convert(char(8),PPO_TGLMULAIACTUAL,20), str_replace (convert(char(10),PPO_TGLSELESAIACTUAL,102), '.', '-') + ' ' + convert(char(8),PPO_TGLSELESAIACTUAL,20), SISATARGET, REALISASI, KETREALIASISIJMLHARI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT PPO_PROJECTID, TASKPROSES, TASKPROSESNAME, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_TASKNUMBER, PPO_STATUS, STATUSNAME, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, SISATARGET, REALISASI, KETREALIASISIJMLHARI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT PPO_PROJECTID, TASKPROSES, TASKPROSESNAME, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_TASKNUMBER, PPO_STATUS, STATUSNAME, convert(char(23),PPO_TGLMULAIPLAN,121), PPO_TARGETHARI, convert(char(23),PPO_TARGETSELESAI,121), convert(char(23),PPO_TGLMULAIACTUAL,121), convert(char(23),PPO_TGLSELESAIACTUAL,121), SISATARGET, REALISASI, KETREALIASISIJMLHARI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT PPO_PROJECTID, TASKPROSES, TASKPROSESNAME, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_TASKNUMBER, PPO_STATUS, STATUSNAME, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, SISATARGET, REALISASI, KETREALIASISIJMLHARI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT PPO_PROJECTID, TASKPROSES, TASKPROSESNAME, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_TASKNUMBER, PPO_STATUS, STATUSNAME, EXTEND(PPO_TGLMULAIPLAN, YEAR TO FRACTION), PPO_TARGETHARI, EXTEND(PPO_TARGETSELESAI, YEAR TO FRACTION), EXTEND(PPO_TGLMULAIACTUAL, YEAR TO FRACTION), EXTEND(PPO_TGLSELESAIACTUAL, YEAR TO FRACTION), SISATARGET, REALISASI, KETREALIASISIJMLHARI from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT PPO_PROJECTID, TASKPROSES, TASKPROSESNAME, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_TASKNUMBER, PPO_STATUS, STATUSNAME, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, SISATARGET, REALISASI, KETREALIASISIJMLHARI from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['order_grid'];
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
         $this->ppo_projectid = $rs->fields[0] ;  
         $this->ppo_projectid = (string)$this->ppo_projectid;
         $this->taskproses = $rs->fields[1] ;  
         $this->taskprosesname = $rs->fields[2] ;  
         $this->ppo_tahapanproject = $rs->fields[3] ;  
         $this->ppo_tahapanproject = (string)$this->ppo_tahapanproject;
         $this->ppo_tasktahapan = $rs->fields[4] ;  
         $this->ppo_tasknumber = $rs->fields[5] ;  
         $this->ppo_tasknumber = (string)$this->ppo_tasknumber;
         $this->ppo_status = $rs->fields[6] ;  
         $this->statusname = $rs->fields[7] ;  
         $this->ppo_tglmulaiplan = $rs->fields[8] ;  
         $this->ppo_targethari = $rs->fields[9] ;  
         $this->ppo_targethari =  str_replace(",", ".", $this->ppo_targethari);
         $this->ppo_targethari = (string)$this->ppo_targethari;
         $this->ppo_targetselesai = $rs->fields[10] ;  
         $this->ppo_tglmulaiactual = $rs->fields[11] ;  
         $this->ppo_tglselesaiactual = $rs->fields[12] ;  
         $this->sisatarget = $rs->fields[13] ;  
         $this->sisatarget = (string)$this->sisatarget;
         $this->realisasi = $rs->fields[14] ;  
         $this->realisasi = (string)$this->realisasi;
         $this->ketrealiasisijmlhari = $rs->fields[15] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if (isset($this->NM_Row_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
         { 
             foreach ($this->NM_Row_din as $row => $height) 
             { 
                 $this->Nm_ActiveSheet->getRowDimension($row)->setRowHeight($height);
             } 
         } 
         $rs->MoveNext();
      }
      if (isset($this->NM_Col_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['embutida'])
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
   //----- ppo_projectid
   function NM_export_ppo_projectid()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->ppo_projectid))
         {
             $this->ppo_projectid = sc_convert_encoding($this->ppo_projectid, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ppo_projectid))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->ppo_projectid);
         $this->Xls_col++;
   }
   //----- taskproses
   function NM_export_taskproses()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->taskproses = html_entity_decode($this->taskproses, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->taskproses = strip_tags($this->taskproses);
         if (!NM_is_utf8($this->taskproses))
         {
             $this->taskproses = sc_convert_encoding($this->taskproses, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->taskproses, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- taskprosesname
   function NM_export_taskprosesname()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->taskprosesname = html_entity_decode($this->taskprosesname, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->taskprosesname = strip_tags($this->taskprosesname);
         if (!NM_is_utf8($this->taskprosesname))
         {
             $this->taskprosesname = sc_convert_encoding($this->taskprosesname, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->taskprosesname, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_tahapanproject
   function NM_export_ppo_tahapanproject()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->ppo_tahapanproject))
         {
             $this->ppo_tahapanproject = sc_convert_encoding($this->ppo_tahapanproject, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ppo_tahapanproject))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->ppo_tahapanproject);
         $this->Xls_col++;
   }
   //----- ppo_tasktahapan
   function NM_export_ppo_tasktahapan()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->ppo_tasktahapan = html_entity_decode($this->ppo_tasktahapan, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ppo_tasktahapan = strip_tags($this->ppo_tasktahapan);
         if (!NM_is_utf8($this->ppo_tasktahapan))
         {
             $this->ppo_tasktahapan = sc_convert_encoding($this->ppo_tasktahapan, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ppo_tasktahapan, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_tasknumber
   function NM_export_ppo_tasknumber()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->ppo_tasknumber))
         {
             $this->ppo_tasknumber = sc_convert_encoding($this->ppo_tasknumber, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ppo_tasknumber))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->ppo_tasknumber);
         $this->Xls_col++;
   }
   //----- ppo_status
   function NM_export_ppo_status()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->ppo_status = html_entity_decode($this->ppo_status, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ppo_status = strip_tags($this->ppo_status);
         if (!NM_is_utf8($this->ppo_status))
         {
             $this->ppo_status = sc_convert_encoding($this->ppo_status, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ppo_status, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- statusname
   function NM_export_statusname()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->statusname = html_entity_decode($this->statusname, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->statusname = strip_tags($this->statusname);
         if (!NM_is_utf8($this->statusname))
         {
             $this->statusname = sc_convert_encoding($this->statusname, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->statusname, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_tglmulaiplan
   function NM_export_ppo_tglmulaiplan()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
      if (!empty($this->ppo_tglmulaiplan))
      {
         if (substr($this->ppo_tglmulaiplan, 10, 1) == "-") 
         { 
             $this->ppo_tglmulaiplan = substr($this->ppo_tglmulaiplan, 0, 10) . " " . substr($this->ppo_tglmulaiplan, 11);
         } 
         if (substr($this->ppo_tglmulaiplan, 13, 1) == ".") 
         { 
            $this->ppo_tglmulaiplan = substr($this->ppo_tglmulaiplan, 0, 13) . ":" . substr($this->ppo_tglmulaiplan, 14, 2) . ":" . substr($this->ppo_tglmulaiplan, 17);
         } 
         $conteudo_x =  $this->ppo_tglmulaiplan;
         nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->ppo_tglmulaiplan, "YYYY-MM-DD HH:II:SS  ");
             $this->ppo_tglmulaiplan = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         } 
      }
         if (!NM_is_utf8($this->ppo_tglmulaiplan))
         {
             $this->ppo_tglmulaiplan = sc_convert_encoding($this->ppo_tglmulaiplan, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ppo_tglmulaiplan, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_targethari
   function NM_export_ppo_targethari()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->ppo_targethari))
         {
             $this->ppo_targethari = sc_convert_encoding($this->ppo_targethari, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ppo_targethari))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0.0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->ppo_targethari);
         $this->Xls_col++;
   }
   //----- ppo_targetselesai
   function NM_export_ppo_targetselesai()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
      if (!empty($this->ppo_targetselesai))
      {
         if (substr($this->ppo_targetselesai, 10, 1) == "-") 
         { 
             $this->ppo_targetselesai = substr($this->ppo_targetselesai, 0, 10) . " " . substr($this->ppo_targetselesai, 11);
         } 
         if (substr($this->ppo_targetselesai, 13, 1) == ".") 
         { 
            $this->ppo_targetselesai = substr($this->ppo_targetselesai, 0, 13) . ":" . substr($this->ppo_targetselesai, 14, 2) . ":" . substr($this->ppo_targetselesai, 17);
         } 
         $conteudo_x =  $this->ppo_targetselesai;
         nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->ppo_targetselesai, "YYYY-MM-DD HH:II:SS  ");
             $this->ppo_targetselesai = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         } 
      }
         if (!NM_is_utf8($this->ppo_targetselesai))
         {
             $this->ppo_targetselesai = sc_convert_encoding($this->ppo_targetselesai, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ppo_targetselesai, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_tglmulaiactual
   function NM_export_ppo_tglmulaiactual()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
      if (!empty($this->ppo_tglmulaiactual))
      {
         if (substr($this->ppo_tglmulaiactual, 10, 1) == "-") 
         { 
             $this->ppo_tglmulaiactual = substr($this->ppo_tglmulaiactual, 0, 10) . " " . substr($this->ppo_tglmulaiactual, 11);
         } 
         if (substr($this->ppo_tglmulaiactual, 13, 1) == ".") 
         { 
            $this->ppo_tglmulaiactual = substr($this->ppo_tglmulaiactual, 0, 13) . ":" . substr($this->ppo_tglmulaiactual, 14, 2) . ":" . substr($this->ppo_tglmulaiactual, 17);
         } 
         $conteudo_x =  $this->ppo_tglmulaiactual;
         nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->ppo_tglmulaiactual, "YYYY-MM-DD HH:II:SS  ");
             $this->ppo_tglmulaiactual = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         } 
      }
         if (!NM_is_utf8($this->ppo_tglmulaiactual))
         {
             $this->ppo_tglmulaiactual = sc_convert_encoding($this->ppo_tglmulaiactual, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ppo_tglmulaiactual, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_tglselesaiactual
   function NM_export_ppo_tglselesaiactual()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
      if (!empty($this->ppo_tglselesaiactual))
      {
         if (substr($this->ppo_tglselesaiactual, 10, 1) == "-") 
         { 
             $this->ppo_tglselesaiactual = substr($this->ppo_tglselesaiactual, 0, 10) . " " . substr($this->ppo_tglselesaiactual, 11);
         } 
         if (substr($this->ppo_tglselesaiactual, 13, 1) == ".") 
         { 
            $this->ppo_tglselesaiactual = substr($this->ppo_tglselesaiactual, 0, 13) . ":" . substr($this->ppo_tglselesaiactual, 14, 2) . ":" . substr($this->ppo_tglselesaiactual, 17);
         } 
         $conteudo_x =  $this->ppo_tglselesaiactual;
         nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->ppo_tglselesaiactual, "YYYY-MM-DD HH:II:SS  ");
             $this->ppo_tglselesaiactual = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         } 
      }
         if (!NM_is_utf8($this->ppo_tglselesaiactual))
         {
             $this->ppo_tglselesaiactual = sc_convert_encoding($this->ppo_tglselesaiactual, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ppo_tglselesaiactual, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- sisatarget
   function NM_export_sisatarget()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->sisatarget))
         {
             $this->sisatarget = sc_convert_encoding($this->sisatarget, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->sisatarget))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->sisatarget);
         $this->Xls_col++;
   }
   //----- realisasi
   function NM_export_realisasi()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!NM_is_utf8($this->realisasi))
         {
             $this->realisasi = sc_convert_encoding($this->realisasi, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->realisasi))
         {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->realisasi);
         $this->Xls_col++;
   }
   //----- ketrealiasisijmlhari
   function NM_export_ketrealiasisijmlhari()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         $this->ketrealiasisijmlhari = html_entity_decode($this->ketrealiasisijmlhari, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ketrealiasisijmlhari = strip_tags($this->ketrealiasisijmlhari);
         if (!NM_is_utf8($this->ketrealiasisijmlhari))
         {
             $this->ketrealiasisijmlhari = sc_convert_encoding($this->ketrealiasisijmlhari, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ketrealiasisijmlhari, PHPExcel_Cell_DataType::TYPE_STRING);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_V_RESUME_DETAILPROJECT'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> - V_RESUME_DETAILPROJECT :: Excel</TITLE>
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
<form name="Fdown" method="get" action="grid_V_RESUME_DETAILPROJECT_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_V_RESUME_DETAILPROJECT"> 
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
