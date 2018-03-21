<?php

class monitoring_lop_inwitel_xls
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
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $this->Xls_row = 1;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
      require_once $this->Ini->path_third . '/phpexcel/PHPExcel/Cell/AdvancedValueBinder.php';
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
      $this->Arquivo    = "sc_xls";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_monitoring_lop_inwitel";
      $this->Arquivo   .= ".xlsx";
      $this->Tit_doc    = "monitoring_lop_inwitel.xlsx";
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

   //----- 
   function grava_arquivo()
   {
      global $nm_lang;
      global
             $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['monitoring_lop_inwitel']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['monitoring_lop_inwitel']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['monitoring_lop_inwitel']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->tp_thn_release = $Busca_temp['tp_thn_release']; 
          $tmp_pos = strpos($this->tp_thn_release, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_thn_release))
          {
              $this->tp_thn_release = substr($this->tp_thn_release, 0, $tmp_pos);
          }
          $this->tp_prjtrelease = $Busca_temp['tp_prjtrelease']; 
          $tmp_pos = strpos($this->tp_prjtrelease, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_prjtrelease))
          {
              $this->tp_prjtrelease = substr($this->tp_prjtrelease, 0, $tmp_pos);
          }
          $this->tp_batch = $Busca_temp['tp_batch']; 
          $tmp_pos = strpos($this->tp_batch, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_batch))
          {
              $this->tp_batch = substr($this->tp_batch, 0, $tmp_pos);
          }
          $this->tp_witel = $Busca_temp['tp_witel']; 
          $tmp_pos = strpos($this->tp_witel, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_witel))
          {
              $this->tp_witel = substr($this->tp_witel, 0, $tmp_pos);
          }
          $this->tp_datel = $Busca_temp['tp_datel']; 
          $tmp_pos = strpos($this->tp_datel, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_datel))
          {
              $this->tp_datel = substr($this->tp_datel, 0, $tmp_pos);
          }
          $this->tp_sto = $Busca_temp['tp_sto']; 
          $tmp_pos = strpos($this->tp_sto, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_sto))
          {
              $this->tp_sto = substr($this->tp_sto, 0, $tmp_pos);
          }
          $this->tp_projectname = $Busca_temp['tp_projectname']; 
          $tmp_pos = strpos($this->tp_projectname, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_projectname))
          {
              $this->tp_projectname = substr($this->tp_projectname, 0, $tmp_pos);
          }
          $this->tp_lokasi = $Busca_temp['tp_lokasi']; 
          $tmp_pos = strpos($this->tp_lokasi, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_lokasi))
          {
              $this->tp_lokasi = substr($this->tp_lokasi, 0, $tmp_pos);
          }
          $this->tp_status = $Busca_temp['tp_status']; 
          $tmp_pos = strpos($this->tp_status, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_status))
          {
              $this->tp_status = substr($this->tp_status, 0, $tmp_pos);
          }
          $this->tp_planfinish = $Busca_temp['tp_planfinish']; 
          $tmp_pos = strpos($this->tp_planfinish, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_planfinish))
          {
              $this->tp_planfinish = substr($this->tp_planfinish, 0, $tmp_pos);
          }
          $this->tp_planfinish_2 = $Busca_temp['tp_planfinish_input_2']; 
          $this->tp_jenisproject = $Busca_temp['tp_jenisproject']; 
          $tmp_pos = strpos($this->tp_jenisproject, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_jenisproject))
          {
              $this->tp_jenisproject = substr($this->tp_jenisproject, 0, $tmp_pos);
          }
          $this->tp_namalop = $Busca_temp['tp_namalop']; 
          $tmp_pos = strpos($this->tp_namalop, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_namalop))
          {
              $this->tp_namalop = substr($this->tp_namalop, 0, $tmp_pos);
          }
          $this->remainsnew = $Busca_temp['remainsnew']; 
          $tmp_pos = strpos($this->remainsnew, "##@@");
          if ($tmp_pos !== false && !is_array($this->remainsnew))
          {
              $this->remainsnew = substr($this->remainsnew, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['xls_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['xls_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['xls_name']);
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT TP_THN_RELEASE, TP_PRJTRELEASE, TP_BATCH, TP_WITEL, TP_DATEL, TP_STO, TP_JENISPROJECT, TP_LOKASI, TP_PROJECTNAME, str_replace (convert(char(10),TP_PLANSTART,102), '.', '-') + ' ' + convert(char(8),TP_PLANSTART,20), str_replace (convert(char(10),TP_PLANFINISH,102), '.', '-') + ' ' + convert(char(8),TP_PLANFINISH,20), TP_ODP, TP_NILAI, TP_RAB, TP_STATUS, KICKOFF_MEETING, SURVEY, RAB_APD_KML, NJKI_JUSTIFIKASI_NODIN, PERIJINAN, DELIVERY_MATERIAL, TCBR, HDPE_TANAM_TIANG, GELAR_KABEL, PASANG_TERMINAL_ODF, PASANG_TERMINAL_ODC, PASANG_TERMINAL_ODP, TERMINASI, TEST_COMM, UJI_TERIMA, REKON_AMANDEMEN, BAUT_BAST, GR_IR, TP_ID, str_replace (convert(char(10),TP_ACTUALSTART,102), '.', '-') + ' ' + convert(char(8),TP_ACTUALSTART,20), str_replace (convert(char(10),TP_ACTUALFINISH,102), '.', '-') + ' ' + convert(char(8),TP_ACTUALFINISH,20), TP_TEMPLATEPROJECT, TP_TARGETWAKTU, TP_JMLDISTRIBUSI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT TP_THN_RELEASE, TP_PRJTRELEASE, TP_BATCH, TP_WITEL, TP_DATEL, TP_STO, TP_JENISPROJECT, TP_LOKASI, TP_PROJECTNAME, TP_PLANSTART, TP_PLANFINISH, TP_ODP, TP_NILAI, TP_RAB, TP_STATUS, KICKOFF_MEETING, SURVEY, RAB_APD_KML, NJKI_JUSTIFIKASI_NODIN, PERIJINAN, DELIVERY_MATERIAL, TCBR, HDPE_TANAM_TIANG, GELAR_KABEL, PASANG_TERMINAL_ODF, PASANG_TERMINAL_ODC, PASANG_TERMINAL_ODP, TERMINASI, TEST_COMM, UJI_TERIMA, REKON_AMANDEMEN, BAUT_BAST, GR_IR, TP_ID, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_TARGETWAKTU, TP_JMLDISTRIBUSI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT TP_THN_RELEASE, TP_PRJTRELEASE, TP_BATCH, TP_WITEL, TP_DATEL, TP_STO, TP_JENISPROJECT, TP_LOKASI, TP_PROJECTNAME, convert(char(23),TP_PLANSTART,121), convert(char(23),TP_PLANFINISH,121), TP_ODP, TP_NILAI, TP_RAB, TP_STATUS, KICKOFF_MEETING, SURVEY, RAB_APD_KML, NJKI_JUSTIFIKASI_NODIN, PERIJINAN, DELIVERY_MATERIAL, TCBR, HDPE_TANAM_TIANG, GELAR_KABEL, PASANG_TERMINAL_ODF, PASANG_TERMINAL_ODC, PASANG_TERMINAL_ODP, TERMINASI, TEST_COMM, UJI_TERIMA, REKON_AMANDEMEN, BAUT_BAST, GR_IR, TP_ID, convert(char(23),TP_ACTUALSTART,121), convert(char(23),TP_ACTUALFINISH,121), TP_TEMPLATEPROJECT, TP_TARGETWAKTU, TP_JMLDISTRIBUSI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT TP_THN_RELEASE, TP_PRJTRELEASE, TP_BATCH, TP_WITEL, TP_DATEL, TP_STO, TP_JENISPROJECT, TP_LOKASI, TP_PROJECTNAME, TP_PLANSTART, TP_PLANFINISH, TP_ODP, TP_NILAI, TP_RAB, TP_STATUS, KICKOFF_MEETING, SURVEY, RAB_APD_KML, NJKI_JUSTIFIKASI_NODIN, PERIJINAN, DELIVERY_MATERIAL, TCBR, HDPE_TANAM_TIANG, GELAR_KABEL, PASANG_TERMINAL_ODF, PASANG_TERMINAL_ODC, PASANG_TERMINAL_ODP, TERMINASI, TEST_COMM, UJI_TERIMA, REKON_AMANDEMEN, BAUT_BAST, GR_IR, TP_ID, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_TARGETWAKTU, TP_JMLDISTRIBUSI from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT TP_THN_RELEASE, TP_PRJTRELEASE, TP_BATCH, TP_WITEL, TP_DATEL, TP_STO, TP_JENISPROJECT, TP_LOKASI, TP_PROJECTNAME, EXTEND(TP_PLANSTART, YEAR TO DAY), EXTEND(TP_PLANFINISH, YEAR TO DAY), TP_ODP, TP_NILAI, TP_RAB, TP_STATUS, KICKOFF_MEETING, SURVEY, RAB_APD_KML, NJKI_JUSTIFIKASI_NODIN, PERIJINAN, DELIVERY_MATERIAL, TCBR, HDPE_TANAM_TIANG, GELAR_KABEL, PASANG_TERMINAL_ODF, PASANG_TERMINAL_ODC, PASANG_TERMINAL_ODP, TERMINASI, TEST_COMM, UJI_TERIMA, REKON_AMANDEMEN, BAUT_BAST, GR_IR, TP_ID, EXTEND(TP_ACTUALSTART, YEAR TO DAY), EXTEND(TP_ACTUALFINISH, YEAR TO DAY), TP_TEMPLATEPROJECT, TP_TARGETWAKTU, TP_JMLDISTRIBUSI from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT TP_THN_RELEASE, TP_PRJTRELEASE, TP_BATCH, TP_WITEL, TP_DATEL, TP_STO, TP_JENISPROJECT, TP_LOKASI, TP_PROJECTNAME, TP_PLANSTART, TP_PLANFINISH, TP_ODP, TP_NILAI, TP_RAB, TP_STATUS, KICKOFF_MEETING, SURVEY, RAB_APD_KML, NJKI_JUSTIFIKASI_NODIN, PERIJINAN, DELIVERY_MATERIAL, TCBR, HDPE_TANAM_TIANG, GELAR_KABEL, PASANG_TERMINAL_ODF, PASANG_TERMINAL_ODC, PASANG_TERMINAL_ODP, TERMINASI, TEST_COMM, UJI_TERIMA, REKON_AMANDEMEN, BAUT_BAST, GR_IR, TP_ID, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_TARGETWAKTU, TP_JMLDISTRIBUSI from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['tp_thn_release'])) ? $this->New_label['tp_thn_release'] : "Release Project"; 
          if ($Cada_col == "tp_thn_release" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_prjtrelease'])) ? $this->New_label['tp_prjtrelease'] : "Sub-Release"; 
          if ($Cada_col == "tp_prjtrelease" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_batch'])) ? $this->New_label['tp_batch'] : "Batch"; 
          if ($Cada_col == "tp_batch" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_witel'])) ? $this->New_label['tp_witel'] : "Kode Witel"; 
          if ($Cada_col == "tp_witel" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_datel'])) ? $this->New_label['tp_datel'] : "Kode Datel"; 
          if ($Cada_col == "tp_datel" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_sto'])) ? $this->New_label['tp_sto'] : "Kode STO"; 
          if ($Cada_col == "tp_sto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_jenisproject'])) ? $this->New_label['tp_jenisproject'] : "Jenis Project"; 
          if ($Cada_col == "tp_jenisproject" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_lokasi'])) ? $this->New_label['tp_lokasi'] : "Lokasi Project"; 
          if ($Cada_col == "tp_lokasi" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_projectname'])) ? $this->New_label['tp_projectname'] : "Nama Project"; 
          if ($Cada_col == "tp_projectname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_planstart'])) ? $this->New_label['tp_planstart'] : "Tgl Mulai ( Plan )"; 
          if ($Cada_col == "tp_planstart" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_planfinish'])) ? $this->New_label['tp_planfinish'] : "Tgl Selesai ( Plan )"; 
          if ($Cada_col == "tp_planfinish" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_odp'])) ? $this->New_label['tp_odp'] : "Jml ODP"; 
          if ($Cada_col == "tp_odp" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_nilai'])) ? $this->New_label['tp_nilai'] : "Nilai Rekon"; 
          if ($Cada_col == "tp_nilai" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_rab'])) ? $this->New_label['tp_rab'] : "Nilai DRM"; 
          if ($Cada_col == "tp_rab" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['remainsnew'])) ? $this->New_label['remainsnew'] : "Tgl Sekarang - Tgl Plan Selesai"; 
          if ($Cada_col == "remainsnew" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_status'])) ? $this->New_label['tp_status'] : "Kode Status"; 
          if ($Cada_col == "tp_status" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['kickoff_meeting'])) ? $this->New_label['kickoff_meeting'] : "Kickoff Meeting"; 
          if ($Cada_col == "kickoff_meeting" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['survey'])) ? $this->New_label['survey'] : "Survey"; 
          if ($Cada_col == "survey" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['rab_apd_kml'])) ? $this->New_label['rab_apd_kml'] : "RAB APD KML"; 
          if ($Cada_col == "rab_apd_kml" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['njki_justifikasi_nodin'])) ? $this->New_label['njki_justifikasi_nodin'] : "Njki Justifikasi Nodin"; 
          if ($Cada_col == "njki_justifikasi_nodin" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['perijinan'])) ? $this->New_label['perijinan'] : "Perijinan"; 
          if ($Cada_col == "perijinan" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['delivery_material'])) ? $this->New_label['delivery_material'] : "Delivery Material"; 
          if ($Cada_col == "delivery_material" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tcbr'])) ? $this->New_label['tcbr'] : "TCBR"; 
          if ($Cada_col == "tcbr" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['hdpe_tanam_tiang'])) ? $this->New_label['hdpe_tanam_tiang'] : "HDPE Tanam Tiang"; 
          if ($Cada_col == "hdpe_tanam_tiang" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['gelar_kabel'])) ? $this->New_label['gelar_kabel'] : "Gelar Kabel"; 
          if ($Cada_col == "gelar_kabel" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['pasang_terminal_odf'])) ? $this->New_label['pasang_terminal_odf'] : "Pasang Terminal ODF"; 
          if ($Cada_col == "pasang_terminal_odf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['pasang_terminal_odc'])) ? $this->New_label['pasang_terminal_odc'] : "Pasang Terminal ODC"; 
          if ($Cada_col == "pasang_terminal_odc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['pasang_terminal_odp'])) ? $this->New_label['pasang_terminal_odp'] : "Pasang Terminal ODP"; 
          if ($Cada_col == "pasang_terminal_odp" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['terminasi'])) ? $this->New_label['terminasi'] : "Terminasi"; 
          if ($Cada_col == "terminasi" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['test_comm'])) ? $this->New_label['test_comm'] : "Test Comm"; 
          if ($Cada_col == "test_comm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['uji_terima'])) ? $this->New_label['uji_terima'] : "Uji Terima"; 
          if ($Cada_col == "uji_terima" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['rekon_amandemen'])) ? $this->New_label['rekon_amandemen'] : "Rekon Amandemen"; 
          if ($Cada_col == "rekon_amandemen" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['baut_bast'])) ? $this->New_label['baut_bast'] : "Baut Bast"; 
          if ($Cada_col == "baut_bast" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['gr_ir'])) ? $this->New_label['gr_ir'] : "GR IR"; 
          if ($Cada_col == "gr_ir" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_id'])) ? $this->New_label['tp_id'] : "Project ID"; 
          if ($Cada_col == "tp_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_actualstart'])) ? $this->New_label['tp_actualstart'] : "Tgl Mulai ( actual )"; 
          if ($Cada_col == "tp_actualstart" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_actualfinish'])) ? $this->New_label['tp_actualfinish'] : "Tgl Selesai ( actual )"; 
          if ($Cada_col == "tp_actualfinish" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_templateproject'])) ? $this->New_label['tp_templateproject'] : "Nama Template"; 
          if ($Cada_col == "tp_templateproject" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_targetwaktu'])) ? $this->New_label['tp_targetwaktu'] : "Target"; 
          if ($Cada_col == "tp_targetwaktu" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tp_jmldistribusi'])) ? $this->New_label['tp_jmldistribusi'] : "Jml Distribusi"; 
          if ($Cada_col == "tp_jmldistribusi" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $SC_Label);
              $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getFont()->setBold(true);
              $this->Nm_ActiveSheet->getColumnDimension($this->calc_cell($this->Xls_col))->setAutoSize(true);
              $this->Xls_col++;
          }
      } 
      $this->SC_seq_register = 0;
      while (!$rs->EOF)
      {
          $this->SC_seq_register++;
         $this->Xls_col = 0;
         $this->Xls_row++;
         $this->tp_thn_release = $rs->fields[0] ;  
         $this->tp_prjtrelease = $rs->fields[1] ;  
         $this->tp_prjtrelease = (string)$this->tp_prjtrelease;
         $this->tp_batch = $rs->fields[2] ;  
         $this->tp_witel = $rs->fields[3] ;  
         $this->tp_witel = (string)$this->tp_witel;
         $this->tp_datel = $rs->fields[4] ;  
         $this->tp_datel = (string)$this->tp_datel;
         $this->tp_sto = $rs->fields[5] ;  
         $this->tp_sto = (string)$this->tp_sto;
         $this->tp_jenisproject = $rs->fields[6] ;  
         $this->tp_jenisproject = (string)$this->tp_jenisproject;
         $this->tp_lokasi = $rs->fields[7] ;  
         $this->tp_projectname = $rs->fields[8] ;  
         $this->tp_planstart = $rs->fields[9] ;  
         $this->tp_planfinish = $rs->fields[10] ;  
         $this->tp_odp = $rs->fields[11] ;  
         $this->tp_odp = (string)$this->tp_odp;
         $this->tp_nilai = $rs->fields[12] ;  
         $this->tp_nilai = (string)$this->tp_nilai;
         $this->tp_rab = $rs->fields[13] ;  
         $this->tp_rab = (string)$this->tp_rab;
         $this->tp_status = $rs->fields[14] ;  
         $this->tp_status = (string)$this->tp_status;
         $this->kickoff_meeting = $rs->fields[15] ;  
         $this->survey = $rs->fields[16] ;  
         $this->rab_apd_kml = $rs->fields[17] ;  
         $this->njki_justifikasi_nodin = $rs->fields[18] ;  
         $this->perijinan = $rs->fields[19] ;  
         $this->delivery_material = $rs->fields[20] ;  
         $this->tcbr = $rs->fields[21] ;  
         $this->hdpe_tanam_tiang = $rs->fields[22] ;  
         $this->gelar_kabel = $rs->fields[23] ;  
         $this->pasang_terminal_odf = $rs->fields[24] ;  
         $this->pasang_terminal_odc = $rs->fields[25] ;  
         $this->pasang_terminal_odp = $rs->fields[26] ;  
         $this->terminasi = $rs->fields[27] ;  
         $this->test_comm = $rs->fields[28] ;  
         $this->uji_terima = $rs->fields[29] ;  
         $this->rekon_amandemen = $rs->fields[30] ;  
         $this->baut_bast = $rs->fields[31] ;  
         $this->gr_ir = $rs->fields[32] ;  
         $this->tp_id = $rs->fields[33] ;  
         $this->tp_id = (string)$this->tp_id;
         $this->tp_actualstart = $rs->fields[34] ;  
         $this->tp_actualfinish = $rs->fields[35] ;  
         $this->tp_templateproject = $rs->fields[36] ;  
         $this->tp_templateproject = (string)$this->tp_templateproject;
         $this->tp_targetwaktu = $rs->fields[37] ;  
         $this->tp_targetwaktu = (string)$this->tp_targetwaktu;
         $this->tp_jmldistribusi = $rs->fields[38] ;  
         $this->tp_jmldistribusi = (string)$this->tp_jmldistribusi;
         //----- lookup - tp_prjtrelease
         $this->look_tp_prjtrelease = $this->tp_prjtrelease; 
         $this->Lookup->lookup_tp_prjtrelease($this->look_tp_prjtrelease, $this->tp_prjtrelease) ; 
         $this->look_tp_prjtrelease = ($this->look_tp_prjtrelease == "&nbsp;") ? "" : $this->look_tp_prjtrelease; 
         //----- lookup - tp_witel
         $this->look_tp_witel = $this->tp_witel; 
         $this->Lookup->lookup_tp_witel($this->look_tp_witel, $this->tp_witel) ; 
         $this->look_tp_witel = ($this->look_tp_witel == "&nbsp;") ? "" : $this->look_tp_witel; 
         //----- lookup - tp_datel
         $this->look_tp_datel = $this->tp_datel; 
         $this->Lookup->lookup_tp_datel($this->look_tp_datel, $this->tp_datel) ; 
         $this->look_tp_datel = ($this->look_tp_datel == "&nbsp;") ? "" : $this->look_tp_datel; 
         //----- lookup - tp_sto
         $this->look_tp_sto = $this->tp_sto; 
         $this->Lookup->lookup_tp_sto($this->look_tp_sto, $this->tp_sto) ; 
         $this->look_tp_sto = ($this->look_tp_sto == "&nbsp;") ? "" : $this->look_tp_sto; 
         //----- lookup - tp_jenisproject
         $this->look_tp_jenisproject = $this->tp_jenisproject; 
         $this->Lookup->lookup_tp_jenisproject($this->look_tp_jenisproject, $this->tp_jenisproject) ; 
         $this->look_tp_jenisproject = ($this->look_tp_jenisproject == "&nbsp;") ? "" : $this->look_tp_jenisproject; 
         //----- lookup - tp_status
         $this->look_tp_status = $this->tp_status; 
         $this->Lookup->lookup_tp_status($this->look_tp_status, $this->tp_status) ; 
         $this->look_tp_status = ($this->look_tp_status == "&nbsp;") ? "" : $this->look_tp_status; 
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['monitoring_lop_inwitel']['contr_erro'] = 'on';
 

$current_date = date('Y-m-d');
$this->remainsnew  = $this->nm_data->Dif_Datas($this->tp_planfinish , 'aaaa-mm-dd', $current_date, 'aaaa-mm-dd');



$_SESSION['scriptcase']['monitoring_lop_inwitel']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if (isset($this->NM_Row_din[$this->Xls_row]))
         { 
             $this->Nm_ActiveSheet->getRowDimension($this->Xls_row)->setRowHeight($this->NM_Row_din[$this->Xls_row]);
         } 
         $rs->MoveNext();
      }
      if (isset($this->NM_Col_din))
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      $rs->Close();
      $objWriter = new PHPExcel_Writer_Excel2007($this->Xls_dados);
      $objWriter->save($this->Xls_f);
   }
   //----- tp_thn_release
   function NM_export_tp_thn_release()
   {
         $this->tp_thn_release = html_entity_decode($this->tp_thn_release, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tp_thn_release = strip_tags($this->tp_thn_release);
         if (!NM_is_utf8($this->tp_thn_release))
         {
             $this->tp_thn_release = sc_convert_encoding($this->tp_thn_release, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_thn_release, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tp_prjtrelease
   function NM_export_tp_prjtrelease()
   {
         if (!NM_is_utf8($this->look_tp_prjtrelease))
         {
             $this->look_tp_prjtrelease = sc_convert_encoding($this->look_tp_prjtrelease, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->look_tp_prjtrelease))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->look_tp_prjtrelease);
         $this->Xls_col++;
   }
   //----- tp_batch
   function NM_export_tp_batch()
   {
         $this->tp_batch = html_entity_decode($this->tp_batch, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tp_batch = strip_tags($this->tp_batch);
         if (!NM_is_utf8($this->tp_batch))
         {
             $this->tp_batch = sc_convert_encoding($this->tp_batch, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_batch, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tp_witel
   function NM_export_tp_witel()
   {
         if (!NM_is_utf8($this->look_tp_witel))
         {
             $this->look_tp_witel = sc_convert_encoding($this->look_tp_witel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->look_tp_witel))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->look_tp_witel);
         $this->Xls_col++;
   }
   //----- tp_datel
   function NM_export_tp_datel()
   {
         if (!NM_is_utf8($this->look_tp_datel))
         {
             $this->look_tp_datel = sc_convert_encoding($this->look_tp_datel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->look_tp_datel))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->look_tp_datel);
         $this->Xls_col++;
   }
   //----- tp_sto
   function NM_export_tp_sto()
   {
         if (!NM_is_utf8($this->look_tp_sto))
         {
             $this->look_tp_sto = sc_convert_encoding($this->look_tp_sto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->look_tp_sto))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->look_tp_sto);
         $this->Xls_col++;
   }
   //----- tp_jenisproject
   function NM_export_tp_jenisproject()
   {
         if (!NM_is_utf8($this->look_tp_jenisproject))
         {
             $this->look_tp_jenisproject = sc_convert_encoding($this->look_tp_jenisproject, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->look_tp_jenisproject))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->look_tp_jenisproject);
         $this->Xls_col++;
   }
   //----- tp_lokasi
   function NM_export_tp_lokasi()
   {
         $this->tp_lokasi = html_entity_decode($this->tp_lokasi, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tp_lokasi = strip_tags($this->tp_lokasi);
         if (!NM_is_utf8($this->tp_lokasi))
         {
             $this->tp_lokasi = sc_convert_encoding($this->tp_lokasi, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_lokasi, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tp_projectname
   function NM_export_tp_projectname()
   {
         $this->tp_projectname = html_entity_decode($this->tp_projectname, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tp_projectname = strip_tags($this->tp_projectname);
         if (!NM_is_utf8($this->tp_projectname))
         {
             $this->tp_projectname = sc_convert_encoding($this->tp_projectname, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_projectname, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tp_planstart
   function NM_export_tp_planstart()
   {
         $this->tp_planstart = substr($this->tp_planstart, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->tp_planstart) || $this->tp_planstart == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_planstart, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_planstart);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- tp_planfinish
   function NM_export_tp_planfinish()
   {
         $this->tp_planfinish = substr($this->tp_planfinish, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->tp_planfinish) || $this->tp_planfinish == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_planfinish, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_planfinish);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- tp_odp
   function NM_export_tp_odp()
   {
         if (!NM_is_utf8($this->tp_odp))
         {
             $this->tp_odp = sc_convert_encoding($this->tp_odp, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_odp))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_odp);
         $this->Xls_col++;
   }
   //----- tp_nilai
   function NM_export_tp_nilai()
   {
         if (!NM_is_utf8($this->tp_nilai))
         {
             $this->tp_nilai = sc_convert_encoding($this->tp_nilai, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_nilai))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_nilai);
         $this->Xls_col++;
   }
   //----- tp_rab
   function NM_export_tp_rab()
   {
         if (!NM_is_utf8($this->tp_rab))
         {
             $this->tp_rab = sc_convert_encoding($this->tp_rab, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_rab))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_rab);
         $this->Xls_col++;
   }
   //----- remainsnew
   function NM_export_remainsnew()
   {
         if (!NM_is_utf8($this->remainsnew))
         {
             $this->remainsnew = sc_convert_encoding($this->remainsnew, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->remainsnew))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->remainsnew);
         $this->Xls_col++;
   }
   //----- tp_status
   function NM_export_tp_status()
   {
         if (!NM_is_utf8($this->look_tp_status))
         {
             $this->look_tp_status = sc_convert_encoding($this->look_tp_status, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->look_tp_status))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->look_tp_status);
         $this->Xls_col++;
   }
   //----- kickoff_meeting
   function NM_export_kickoff_meeting()
   {
      if (!empty($this->kickoff_meeting))
      {
         $conteudo_x =  $this->kickoff_meeting;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->kickoff_meeting, "");
             $this->kickoff_meeting = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->kickoff_meeting))
         {
             $this->kickoff_meeting = sc_convert_encoding($this->kickoff_meeting, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->kickoff_meeting, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- survey
   function NM_export_survey()
   {
      if (!empty($this->survey))
      {
         $conteudo_x =  $this->survey;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->survey, "");
             $this->survey = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->survey))
         {
             $this->survey = sc_convert_encoding($this->survey, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->survey, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- rab_apd_kml
   function NM_export_rab_apd_kml()
   {
      if (!empty($this->rab_apd_kml))
      {
         $conteudo_x =  $this->rab_apd_kml;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->rab_apd_kml, "");
             $this->rab_apd_kml = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->rab_apd_kml))
         {
             $this->rab_apd_kml = sc_convert_encoding($this->rab_apd_kml, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->rab_apd_kml, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- njki_justifikasi_nodin
   function NM_export_njki_justifikasi_nodin()
   {
      if (!empty($this->njki_justifikasi_nodin))
      {
         $conteudo_x =  $this->njki_justifikasi_nodin;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->njki_justifikasi_nodin, "");
             $this->njki_justifikasi_nodin = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->njki_justifikasi_nodin))
         {
             $this->njki_justifikasi_nodin = sc_convert_encoding($this->njki_justifikasi_nodin, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->njki_justifikasi_nodin, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- perijinan
   function NM_export_perijinan()
   {
      if (!empty($this->perijinan))
      {
         $conteudo_x =  $this->perijinan;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->perijinan, "");
             $this->perijinan = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->perijinan))
         {
             $this->perijinan = sc_convert_encoding($this->perijinan, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->perijinan, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- delivery_material
   function NM_export_delivery_material()
   {
      if (!empty($this->delivery_material))
      {
         $conteudo_x =  $this->delivery_material;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->delivery_material, "");
             $this->delivery_material = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->delivery_material))
         {
             $this->delivery_material = sc_convert_encoding($this->delivery_material, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->delivery_material, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tcbr
   function NM_export_tcbr()
   {
      if (!empty($this->tcbr))
      {
         $conteudo_x =  $this->tcbr;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->tcbr, "");
             $this->tcbr = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->tcbr))
         {
             $this->tcbr = sc_convert_encoding($this->tcbr, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tcbr, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- hdpe_tanam_tiang
   function NM_export_hdpe_tanam_tiang()
   {
      if (!empty($this->hdpe_tanam_tiang))
      {
         $conteudo_x =  $this->hdpe_tanam_tiang;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->hdpe_tanam_tiang, "");
             $this->hdpe_tanam_tiang = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->hdpe_tanam_tiang))
         {
             $this->hdpe_tanam_tiang = sc_convert_encoding($this->hdpe_tanam_tiang, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->hdpe_tanam_tiang, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- gelar_kabel
   function NM_export_gelar_kabel()
   {
      if (!empty($this->gelar_kabel))
      {
         $conteudo_x =  $this->gelar_kabel;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->gelar_kabel, "");
             $this->gelar_kabel = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->gelar_kabel))
         {
             $this->gelar_kabel = sc_convert_encoding($this->gelar_kabel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->gelar_kabel, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- pasang_terminal_odf
   function NM_export_pasang_terminal_odf()
   {
      if (!empty($this->pasang_terminal_odf))
      {
         $conteudo_x =  $this->pasang_terminal_odf;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->pasang_terminal_odf, "");
             $this->pasang_terminal_odf = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->pasang_terminal_odf))
         {
             $this->pasang_terminal_odf = sc_convert_encoding($this->pasang_terminal_odf, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->pasang_terminal_odf, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- pasang_terminal_odc
   function NM_export_pasang_terminal_odc()
   {
      if (!empty($this->pasang_terminal_odc))
      {
         $conteudo_x =  $this->pasang_terminal_odc;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->pasang_terminal_odc, "");
             $this->pasang_terminal_odc = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->pasang_terminal_odc))
         {
             $this->pasang_terminal_odc = sc_convert_encoding($this->pasang_terminal_odc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->pasang_terminal_odc, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- pasang_terminal_odp
   function NM_export_pasang_terminal_odp()
   {
      if (!empty($this->pasang_terminal_odp))
      {
         $conteudo_x =  $this->pasang_terminal_odp;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->pasang_terminal_odp, "");
             $this->pasang_terminal_odp = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->pasang_terminal_odp))
         {
             $this->pasang_terminal_odp = sc_convert_encoding($this->pasang_terminal_odp, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->pasang_terminal_odp, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- terminasi
   function NM_export_terminasi()
   {
      if (!empty($this->terminasi))
      {
         $conteudo_x =  $this->terminasi;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->terminasi, "");
             $this->terminasi = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->terminasi))
         {
             $this->terminasi = sc_convert_encoding($this->terminasi, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->terminasi, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- test_comm
   function NM_export_test_comm()
   {
      if (!empty($this->test_comm))
      {
         $conteudo_x =  $this->test_comm;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->test_comm, "");
             $this->test_comm = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->test_comm))
         {
             $this->test_comm = sc_convert_encoding($this->test_comm, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->test_comm, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- uji_terima
   function NM_export_uji_terima()
   {
      if (!empty($this->uji_terima))
      {
         $conteudo_x =  $this->uji_terima;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->uji_terima, "");
             $this->uji_terima = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->uji_terima))
         {
             $this->uji_terima = sc_convert_encoding($this->uji_terima, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->uji_terima, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- rekon_amandemen
   function NM_export_rekon_amandemen()
   {
      if (!empty($this->rekon_amandemen))
      {
         $conteudo_x =  $this->rekon_amandemen;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->rekon_amandemen, "");
             $this->rekon_amandemen = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->rekon_amandemen))
         {
             $this->rekon_amandemen = sc_convert_encoding($this->rekon_amandemen, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->rekon_amandemen, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- baut_bast
   function NM_export_baut_bast()
   {
      if (!empty($this->baut_bast))
      {
         $conteudo_x =  $this->baut_bast;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->baut_bast, "");
             $this->baut_bast = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->baut_bast))
         {
             $this->baut_bast = sc_convert_encoding($this->baut_bast, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->baut_bast, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- gr_ir
   function NM_export_gr_ir()
   {
      if (!empty($this->gr_ir))
      {
         $conteudo_x =  $this->gr_ir;
         nm_conv_limpa_dado($conteudo_x, "");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->gr_ir, "");
             $this->gr_ir = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
      }
         if (!NM_is_utf8($this->gr_ir))
         {
             $this->gr_ir = sc_convert_encoding($this->gr_ir, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->gr_ir, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tp_id
   function NM_export_tp_id()
   {
         if (!NM_is_utf8($this->tp_id))
         {
             $this->tp_id = sc_convert_encoding($this->tp_id, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_id))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_id);
         $this->Xls_col++;
   }
   //----- tp_actualstart
   function NM_export_tp_actualstart()
   {
         $this->tp_actualstart = substr($this->tp_actualstart, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->tp_actualstart) || $this->tp_actualstart == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_actualstart, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_actualstart);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- tp_actualfinish
   function NM_export_tp_actualfinish()
   {
         $this->tp_actualfinish = substr($this->tp_actualfinish, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->tp_actualfinish) || $this->tp_actualfinish == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_actualfinish, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_actualfinish);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- tp_templateproject
   function NM_export_tp_templateproject()
   {
         if (!NM_is_utf8($this->tp_templateproject))
         {
             $this->tp_templateproject = sc_convert_encoding($this->tp_templateproject, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_templateproject))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_templateproject);
         $this->Xls_col++;
   }
   //----- tp_targetwaktu
   function NM_export_tp_targetwaktu()
   {
         if (!NM_is_utf8($this->tp_targetwaktu))
         {
             $this->tp_targetwaktu = sc_convert_encoding($this->tp_targetwaktu, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_targetwaktu))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_targetwaktu);
         $this->Xls_col++;
   }
   //----- tp_jmldistribusi
   function NM_export_tp_jmldistribusi()
   {
         if (!NM_is_utf8($this->tp_jmldistribusi))
         {
             $this->tp_jmldistribusi = sc_convert_encoding($this->tp_jmldistribusi, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_jmldistribusi))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_jmldistribusi);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['monitoring_lop_inwitel'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Monitoring List of Project <?php echo $_SESSION['kodewitel'] ?> :: Excel</TITLE>
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
<form name="Fdown" method="get" action="monitoring_lop_inwitel_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="monitoring_lop_inwitel"> 
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
