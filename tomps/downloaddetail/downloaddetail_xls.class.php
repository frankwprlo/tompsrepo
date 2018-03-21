<?php

class downloaddetail_xls
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
      $this->Arquivo   .= "_downloaddetail";
      $this->Arquivo   .= ".xlsx";
      $this->Tit_doc    = "downloaddetail.xlsx";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['downloaddetail']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['downloaddetail']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['downloaddetail']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->tp_mitra = $Busca_temp['tp_mitra']; 
          $tmp_pos = strpos($this->tp_mitra, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_mitra))
          {
              $this->tp_mitra = substr($this->tp_mitra, 0, $tmp_pos);
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
          $this->tp_status = $Busca_temp['tp_status']; 
          $tmp_pos = strpos($this->tp_status, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_status))
          {
              $this->tp_status = substr($this->tp_status, 0, $tmp_pos);
          }
          $this->tp_templateproject = $Busca_temp['tp_templateproject']; 
          $tmp_pos = strpos($this->tp_templateproject, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_templateproject))
          {
              $this->tp_templateproject = substr($this->tp_templateproject, 0, $tmp_pos);
          }
          $this->tp_prjtrelease = $Busca_temp['tp_prjtrelease']; 
          $tmp_pos = strpos($this->tp_prjtrelease, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_prjtrelease))
          {
              $this->tp_prjtrelease = substr($this->tp_prjtrelease, 0, $tmp_pos);
          }
          $this->tp_jenisproject = $Busca_temp['tp_jenisproject']; 
          $tmp_pos = strpos($this->tp_jenisproject, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_jenisproject))
          {
              $this->tp_jenisproject = substr($this->tp_jenisproject, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['xls_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['xls_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['xls_name']);
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, str_replace (convert(char(10),TP_PLANSTART,102), '.', '-') + ' ' + convert(char(8),TP_PLANSTART,20), str_replace (convert(char(10),TP_PLANFINISH,102), '.', '-') + ' ' + convert(char(8),TP_PLANFINISH,20), str_replace (convert(char(10),TP_ENTRYDATE,102), '.', '-') + ' ' + convert(char(8),TP_ENTRYDATE,20), TP_ENTRYBY, str_replace (convert(char(10),TP_UPDATEDATE,102), '.', '-') + ' ' + convert(char(8),TP_UPDATEDATE,20), TP_UPDATEBY, TP_SUMMARY, TP_STATUS, str_replace (convert(char(10),TP_ACTUALSTART,102), '.', '-') + ' ' + convert(char(8),TP_ACTUALSTART,20), str_replace (convert(char(10),TP_ACTUALFINISH,102), '.', '-') + ' ' + convert(char(8),TP_ACTUALFINISH,20), TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, str_replace (convert(char(10),PPO_ENTRYDATE,102), '.', '-') + ' ' + convert(char(8),PPO_ENTRYDATE,20), PPO_ENTRYBY, str_replace (convert(char(10),PPO_UPDATEDATE,102), '.', '-') + ' ' + convert(char(8),PPO_UPDATEDATE,20), PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, str_replace (convert(char(10),PPO_TGLMULAIPLAN,102), '.', '-') + ' ' + convert(char(8),PPO_TGLMULAIPLAN,20), PPO_TARGETHARI, str_replace (convert(char(10),PPO_TARGETSELESAI,102), '.', '-') + ' ' + convert(char(8),PPO_TARGETSELESAI,20), str_replace (convert(char(10),PPO_TGLMULAIACTUAL,102), '.', '-') + ' ' + convert(char(8),PPO_TGLMULAIACTUAL,20), str_replace (convert(char(10),PPO_TGLSELESAIACTUAL,102), '.', '-') + ' ' + convert(char(8),PPO_TGLSELESAIACTUAL,20), PPO_TASKNUMBER, PPO_REALAKTUAL, STATUSNAME, MS_NAMASTO, MD_NAMADATEL, TM_NAMAMITRA, STATUSPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_REALAKTUAL, STATUSNAME, MS_NAMASTO, MD_NAMADATEL, TM_NAMAMITRA, STATUSPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, convert(char(23),TP_PLANSTART,121), convert(char(23),TP_PLANFINISH,121), convert(char(23),TP_ENTRYDATE,121), TP_ENTRYBY, convert(char(23),TP_UPDATEDATE,121), TP_UPDATEBY, TP_SUMMARY, TP_STATUS, convert(char(23),TP_ACTUALSTART,121), convert(char(23),TP_ACTUALFINISH,121), TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, convert(char(23),PPO_ENTRYDATE,121), PPO_ENTRYBY, convert(char(23),PPO_UPDATEDATE,121), PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, convert(char(23),PPO_TGLMULAIPLAN,121), PPO_TARGETHARI, convert(char(23),PPO_TARGETSELESAI,121), convert(char(23),PPO_TGLMULAIACTUAL,121), convert(char(23),PPO_TGLSELESAIACTUAL,121), PPO_TASKNUMBER, PPO_REALAKTUAL, STATUSNAME, MS_NAMASTO, MD_NAMADATEL, TM_NAMAMITRA, STATUSPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_REALAKTUAL, STATUSNAME, MS_NAMASTO, MD_NAMADATEL, TM_NAMAMITRA, STATUSPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, EXTEND(TP_PLANSTART, YEAR TO DAY), EXTEND(TP_PLANFINISH, YEAR TO DAY), EXTEND(TP_ENTRYDATE, YEAR TO DAY), TP_ENTRYBY, EXTEND(TP_UPDATEDATE, YEAR TO DAY), TP_UPDATEBY, LOTOFILE(TP_SUMMARY, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_informix', 'client') as tp_summary, TP_STATUS, EXTEND(TP_ACTUALSTART, YEAR TO DAY), EXTEND(TP_ACTUALFINISH, YEAR TO DAY), TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, EXTEND(PPO_ENTRYDATE, YEAR TO DAY), PPO_ENTRYBY, EXTEND(PPO_UPDATEDATE, YEAR TO DAY), PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, EXTEND(PPO_TGLMULAIPLAN, YEAR TO DAY), PPO_TARGETHARI, EXTEND(PPO_TARGETSELESAI, YEAR TO DAY), EXTEND(PPO_TGLMULAIACTUAL, YEAR TO DAY), EXTEND(PPO_TGLSELESAIACTUAL, YEAR TO DAY), PPO_TASKNUMBER, PPO_REALAKTUAL, STATUSNAME, MS_NAMASTO, MD_NAMADATEL, TM_NAMAMITRA, STATUSPROJECT from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_REALAKTUAL, STATUSNAME, MS_NAMASTO, MD_NAMADATEL, TM_NAMAMITRA, STATUSPROJECT from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['tp_id'])) ? $this->New_label['tp_id'] : "ID"; 
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
          $SC_Label = (isset($this->New_label['tp_batch'])) ? $this->New_label['tp_batch'] : "BATCH"; 
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
          $SC_Label = (isset($this->New_label['tp_projectname'])) ? $this->New_label['tp_projectname'] : "PROJECTNAME"; 
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
          $SC_Label = (isset($this->New_label['tp_lokasi'])) ? $this->New_label['tp_lokasi'] : "LOKASI"; 
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
          $SC_Label = (isset($this->New_label['tp_mitra'])) ? $this->New_label['tp_mitra'] : "MITRA"; 
          if ($Cada_col == "tp_mitra" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tp_witel'])) ? $this->New_label['tp_witel'] : "WITEL"; 
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
          $SC_Label = (isset($this->New_label['tp_sto'])) ? $this->New_label['tp_sto'] : "STO"; 
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
          $SC_Label = (isset($this->New_label['tp_odp'])) ? $this->New_label['tp_odp'] : "ODP"; 
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
          $SC_Label = (isset($this->New_label['tp_planstart'])) ? $this->New_label['tp_planstart'] : "PLANSTART"; 
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
          $SC_Label = (isset($this->New_label['tp_planfinish'])) ? $this->New_label['tp_planfinish'] : "PLANFINISH"; 
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
          $SC_Label = (isset($this->New_label['tp_entrydate'])) ? $this->New_label['tp_entrydate'] : "ENTRYDATE"; 
          if ($Cada_col == "tp_entrydate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tp_entryby'])) ? $this->New_label['tp_entryby'] : "ENTRYBY"; 
          if ($Cada_col == "tp_entryby" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tp_updatedate'])) ? $this->New_label['tp_updatedate'] : "UPDATEDATE"; 
          if ($Cada_col == "tp_updatedate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tp_updateby'])) ? $this->New_label['tp_updateby'] : "UPDATEBY"; 
          if ($Cada_col == "tp_updateby" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tp_summary'])) ? $this->New_label['tp_summary'] : "SUMMARY"; 
          if ($Cada_col == "tp_summary" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tp_status'])) ? $this->New_label['tp_status'] : "STATUS"; 
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
          $SC_Label = (isset($this->New_label['tp_actualstart'])) ? $this->New_label['tp_actualstart'] : "ACTUALSTART"; 
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
          $SC_Label = (isset($this->New_label['tp_actualfinish'])) ? $this->New_label['tp_actualfinish'] : "ACTUALFINISH"; 
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
          $SC_Label = (isset($this->New_label['tp_templateproject'])) ? $this->New_label['tp_templateproject'] : "TEMPLATEPROJECT"; 
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
          $SC_Label = (isset($this->New_label['tp_jenisproject'])) ? $this->New_label['tp_jenisproject'] : "JENISPROJECT"; 
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
          $SC_Label = (isset($this->New_label['tp_prjtrelease'])) ? $this->New_label['tp_prjtrelease'] : "PRJTRELEASE"; 
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
          $SC_Label = (isset($this->New_label['tp_targetwaktu'])) ? $this->New_label['tp_targetwaktu'] : "TARGETWAKTU"; 
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
          $SC_Label = (isset($this->New_label['tp_datel'])) ? $this->New_label['tp_datel'] : "DATEL"; 
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
          $SC_Label = (isset($this->New_label['tp_nokontrak'])) ? $this->New_label['tp_nokontrak'] : "NOKONTRAK"; 
          if ($Cada_col == "tp_nokontrak" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tp_ponumber'])) ? $this->New_label['tp_ponumber'] : "PONUMBER"; 
          if ($Cada_col == "tp_ponumber" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_id'])) ? $this->New_label['ppo_id'] : "PPO ID"; 
          if ($Cada_col == "ppo_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_projectid'])) ? $this->New_label['ppo_projectid'] : "PPO PROJECTID"; 
          if ($Cada_col == "ppo_projectid" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_tahapanproject'])) ? $this->New_label['ppo_tahapanproject'] : "PPO TAHAPANPROJECT"; 
          if ($Cada_col == "ppo_tahapanproject" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_tasktahapan'])) ? $this->New_label['ppo_tasktahapan'] : "PPO TASKTAHAPAN"; 
          if ($Cada_col == "ppo_tasktahapan" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_entrydate'])) ? $this->New_label['ppo_entrydate'] : "PPO ENTRYDATE"; 
          if ($Cada_col == "ppo_entrydate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_entryby'])) ? $this->New_label['ppo_entryby'] : "PPO ENTRYBY"; 
          if ($Cada_col == "ppo_entryby" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_updatedate'])) ? $this->New_label['ppo_updatedate'] : "PPO UPDATEDATE"; 
          if ($Cada_col == "ppo_updatedate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_updateby'])) ? $this->New_label['ppo_updateby'] : "PPO UPDATEBY"; 
          if ($Cada_col == "ppo_updateby" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_note'])) ? $this->New_label['ppo_note'] : "PPO NOTE"; 
          if ($Cada_col == "ppo_note" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_evident_one'])) ? $this->New_label['ppo_evident_one'] : "PPO EVIDENT ONE"; 
          if ($Cada_col == "ppo_evident_one" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_evident_two'])) ? $this->New_label['ppo_evident_two'] : "PPO EVIDENT TWO"; 
          if ($Cada_col == "ppo_evident_two" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_evident_three'])) ? $this->New_label['ppo_evident_three'] : "PPO EVIDENT THREE"; 
          if ($Cada_col == "ppo_evident_three" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_status'])) ? $this->New_label['ppo_status'] : "PPO STATUS"; 
          if ($Cada_col == "ppo_status" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_tglmulaiplan'])) ? $this->New_label['ppo_tglmulaiplan'] : "PPO TGLMULAIPLAN"; 
          if ($Cada_col == "ppo_tglmulaiplan" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_targethari'])) ? $this->New_label['ppo_targethari'] : "PPO TARGETHARI"; 
          if ($Cada_col == "ppo_targethari" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_targetselesai'])) ? $this->New_label['ppo_targetselesai'] : "PPO TARGETSELESAI"; 
          if ($Cada_col == "ppo_targetselesai" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_tglmulaiactual'])) ? $this->New_label['ppo_tglmulaiactual'] : "PPO TGLMULAIACTUAL"; 
          if ($Cada_col == "ppo_tglmulaiactual" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_tglselesaiactual'])) ? $this->New_label['ppo_tglselesaiactual'] : "PPO TGLSELESAIACTUAL"; 
          if ($Cada_col == "ppo_tglselesaiactual" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_tasknumber'])) ? $this->New_label['ppo_tasknumber'] : "PPO TASKNUMBER"; 
          if ($Cada_col == "ppo_tasknumber" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ppo_realaktual'])) ? $this->New_label['ppo_realaktual'] : "PPO REALAKTUAL"; 
          if ($Cada_col == "ppo_realaktual" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['statusname'])) ? $this->New_label['statusname'] : "STATUSNAME"; 
          if ($Cada_col == "statusname" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ms_namasto'])) ? $this->New_label['ms_namasto'] : "MS NAMASTO"; 
          if ($Cada_col == "ms_namasto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['md_namadatel'])) ? $this->New_label['md_namadatel'] : "MD NAMADATEL"; 
          if ($Cada_col == "md_namadatel" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tm_namamitra'])) ? $this->New_label['tm_namamitra'] : "TM NAMAMITRA"; 
          if ($Cada_col == "tm_namamitra" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['statusproject'])) ? $this->New_label['statusproject'] : "STATUSPROJECT"; 
          if ($Cada_col == "statusproject" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
      } 
      $this->SC_seq_register = 0;
      while (!$rs->EOF)
      {
          $this->SC_seq_register++;
         $this->Xls_col = 0;
         $this->Xls_row++;
         $this->tp_id = $rs->fields[0] ;  
         $this->tp_id = (string)$this->tp_id;
         $this->tp_batch = $rs->fields[1] ;  
         $this->tp_projectname = $rs->fields[2] ;  
         $this->tp_lokasi = $rs->fields[3] ;  
         $this->tp_mitra = $rs->fields[4] ;  
         $this->tp_mitra = (string)$this->tp_mitra;
         $this->tp_witel = $rs->fields[5] ;  
         $this->tp_witel = (string)$this->tp_witel;
         $this->tp_sto = $rs->fields[6] ;  
         $this->tp_sto = (string)$this->tp_sto;
         $this->tp_odp = $rs->fields[7] ;  
         $this->tp_odp = (string)$this->tp_odp;
         $this->tp_planstart = $rs->fields[8] ;  
         $this->tp_planfinish = $rs->fields[9] ;  
         $this->tp_entrydate = $rs->fields[10] ;  
         $this->tp_entryby = $rs->fields[11] ;  
         $this->tp_updatedate = $rs->fields[12] ;  
         $this->tp_updateby = $rs->fields[13] ;  
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $this->tp_summary = "";  
              if (is_file($rs_grid->fields[14])) 
              { 
                  $this->tp_summary = file_get_contents($rs_grid->fields[14]);  
              } 
          } 
         else
         { 
             $this->tp_summary = $rs->fields[14] ;  
         } 
         $this->tp_status = $rs->fields[15] ;  
         $this->tp_status = (string)$this->tp_status;
         $this->tp_actualstart = $rs->fields[16] ;  
         $this->tp_actualfinish = $rs->fields[17] ;  
         $this->tp_templateproject = $rs->fields[18] ;  
         $this->tp_templateproject = (string)$this->tp_templateproject;
         $this->tp_jenisproject = $rs->fields[19] ;  
         $this->tp_jenisproject = (string)$this->tp_jenisproject;
         $this->tp_prjtrelease = $rs->fields[20] ;  
         $this->tp_prjtrelease = (string)$this->tp_prjtrelease;
         $this->tp_targetwaktu = $rs->fields[21] ;  
         $this->tp_targetwaktu = (string)$this->tp_targetwaktu;
         $this->tp_datel = $rs->fields[22] ;  
         $this->tp_datel = (string)$this->tp_datel;
         $this->tp_nokontrak = $rs->fields[23] ;  
         $this->tp_ponumber = $rs->fields[24] ;  
         $this->ppo_id = $rs->fields[25] ;  
         $this->ppo_id = (string)$this->ppo_id;
         $this->ppo_projectid = $rs->fields[26] ;  
         $this->ppo_projectid = (string)$this->ppo_projectid;
         $this->ppo_tahapanproject = $rs->fields[27] ;  
         $this->ppo_tahapanproject = (string)$this->ppo_tahapanproject;
         $this->ppo_tasktahapan = $rs->fields[28] ;  
         $this->ppo_entrydate = $rs->fields[29] ;  
         $this->ppo_entryby = $rs->fields[30] ;  
         $this->ppo_updatedate = $rs->fields[31] ;  
         $this->ppo_updateby = $rs->fields[32] ;  
         $this->ppo_note = $rs->fields[33] ;  
         $this->ppo_evident_one = $rs->fields[34] ;  
         $this->ppo_evident_two = $rs->fields[35] ;  
         $this->ppo_evident_three = $rs->fields[36] ;  
         $this->ppo_status = $rs->fields[37] ;  
         $this->ppo_tglmulaiplan = $rs->fields[38] ;  
         $this->ppo_targethari = $rs->fields[39] ;  
         $this->ppo_targethari = (string)$this->ppo_targethari;
         $this->ppo_targetselesai = $rs->fields[40] ;  
         $this->ppo_tglmulaiactual = $rs->fields[41] ;  
         $this->ppo_tglselesaiactual = $rs->fields[42] ;  
         $this->ppo_tasknumber = $rs->fields[43] ;  
         $this->ppo_tasknumber = (string)$this->ppo_tasknumber;
         $this->ppo_realaktual = $rs->fields[44] ;  
         $this->ppo_realaktual =  str_replace(",", ".", $this->ppo_realaktual);
         $this->ppo_realaktual = (string)$this->ppo_realaktual;
         $this->statusname = $rs->fields[45] ;  
         $this->ms_namasto = $rs->fields[46] ;  
         $this->md_namadatel = $rs->fields[47] ;  
         $this->tm_namamitra = $rs->fields[48] ;  
         $this->statusproject = $rs->fields[49] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['field_order'] as $Cada_col)
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
   //----- tp_mitra
   function NM_export_tp_mitra()
   {
         if (!NM_is_utf8($this->tp_mitra))
         {
             $this->tp_mitra = sc_convert_encoding($this->tp_mitra, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_mitra))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_mitra);
         $this->Xls_col++;
   }
   //----- tp_witel
   function NM_export_tp_witel()
   {
         if (!NM_is_utf8($this->tp_witel))
         {
             $this->tp_witel = sc_convert_encoding($this->tp_witel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_witel))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_witel);
         $this->Xls_col++;
   }
   //----- tp_sto
   function NM_export_tp_sto()
   {
         if (!NM_is_utf8($this->tp_sto))
         {
             $this->tp_sto = sc_convert_encoding($this->tp_sto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_sto))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_sto);
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
   //----- tp_entrydate
   function NM_export_tp_entrydate()
   {
         $this->tp_entrydate = substr($this->tp_entrydate, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->tp_entrydate) || $this->tp_entrydate == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_entrydate, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_entrydate);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- tp_entryby
   function NM_export_tp_entryby()
   {
         $this->tp_entryby = html_entity_decode($this->tp_entryby, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tp_entryby = strip_tags($this->tp_entryby);
         if (!NM_is_utf8($this->tp_entryby))
         {
             $this->tp_entryby = sc_convert_encoding($this->tp_entryby, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_entryby, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tp_updatedate
   function NM_export_tp_updatedate()
   {
         $this->tp_updatedate = substr($this->tp_updatedate, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->tp_updatedate) || $this->tp_updatedate == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_updatedate, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_updatedate);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- tp_updateby
   function NM_export_tp_updateby()
   {
         $this->tp_updateby = html_entity_decode($this->tp_updateby, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tp_updateby = strip_tags($this->tp_updateby);
         if (!NM_is_utf8($this->tp_updateby))
         {
             $this->tp_updateby = sc_convert_encoding($this->tp_updateby, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_updateby, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tp_summary
   function NM_export_tp_summary()
   {
         $this->tp_summary = html_entity_decode($this->tp_summary, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tp_summary = strip_tags($this->tp_summary);
         if (!NM_is_utf8($this->tp_summary))
         {
             $this->tp_summary = sc_convert_encoding($this->tp_summary, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_summary, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tp_status
   function NM_export_tp_status()
   {
         if (!NM_is_utf8($this->tp_status))
         {
             $this->tp_status = sc_convert_encoding($this->tp_status, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_status))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_status);
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
   //----- tp_jenisproject
   function NM_export_tp_jenisproject()
   {
         if (!NM_is_utf8($this->tp_jenisproject))
         {
             $this->tp_jenisproject = sc_convert_encoding($this->tp_jenisproject, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_jenisproject))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_jenisproject);
         $this->Xls_col++;
   }
   //----- tp_prjtrelease
   function NM_export_tp_prjtrelease()
   {
         if (!NM_is_utf8($this->tp_prjtrelease))
         {
             $this->tp_prjtrelease = sc_convert_encoding($this->tp_prjtrelease, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_prjtrelease))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_prjtrelease);
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
   //----- tp_datel
   function NM_export_tp_datel()
   {
         if (!NM_is_utf8($this->tp_datel))
         {
             $this->tp_datel = sc_convert_encoding($this->tp_datel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->tp_datel))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_datel);
         $this->Xls_col++;
   }
   //----- tp_nokontrak
   function NM_export_tp_nokontrak()
   {
         $this->tp_nokontrak = html_entity_decode($this->tp_nokontrak, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tp_nokontrak = strip_tags($this->tp_nokontrak);
         if (!NM_is_utf8($this->tp_nokontrak))
         {
             $this->tp_nokontrak = sc_convert_encoding($this->tp_nokontrak, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_nokontrak, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tp_ponumber
   function NM_export_tp_ponumber()
   {
         $this->tp_ponumber = html_entity_decode($this->tp_ponumber, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tp_ponumber = strip_tags($this->tp_ponumber);
         if (!NM_is_utf8($this->tp_ponumber))
         {
             $this->tp_ponumber = sc_convert_encoding($this->tp_ponumber, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tp_ponumber, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_id
   function NM_export_ppo_id()
   {
         if (!NM_is_utf8($this->ppo_id))
         {
             $this->ppo_id = sc_convert_encoding($this->ppo_id, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ppo_id))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_id);
         $this->Xls_col++;
   }
   //----- ppo_projectid
   function NM_export_ppo_projectid()
   {
         if (!NM_is_utf8($this->ppo_projectid))
         {
             $this->ppo_projectid = sc_convert_encoding($this->ppo_projectid, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ppo_projectid))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_projectid);
         $this->Xls_col++;
   }
   //----- ppo_tahapanproject
   function NM_export_ppo_tahapanproject()
   {
         if (!NM_is_utf8($this->ppo_tahapanproject))
         {
             $this->ppo_tahapanproject = sc_convert_encoding($this->ppo_tahapanproject, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ppo_tahapanproject))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_tahapanproject);
         $this->Xls_col++;
   }
   //----- ppo_tasktahapan
   function NM_export_ppo_tasktahapan()
   {
         $this->ppo_tasktahapan = html_entity_decode($this->ppo_tasktahapan, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ppo_tasktahapan = strip_tags($this->ppo_tasktahapan);
         if (!NM_is_utf8($this->ppo_tasktahapan))
         {
             $this->ppo_tasktahapan = sc_convert_encoding($this->ppo_tasktahapan, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_tasktahapan, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_entrydate
   function NM_export_ppo_entrydate()
   {
         $this->ppo_entrydate = substr($this->ppo_entrydate, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->ppo_entrydate) || $this->ppo_entrydate == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_entrydate, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_entrydate);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- ppo_entryby
   function NM_export_ppo_entryby()
   {
         $this->ppo_entryby = html_entity_decode($this->ppo_entryby, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ppo_entryby = strip_tags($this->ppo_entryby);
         if (!NM_is_utf8($this->ppo_entryby))
         {
             $this->ppo_entryby = sc_convert_encoding($this->ppo_entryby, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_entryby, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_updatedate
   function NM_export_ppo_updatedate()
   {
         $this->ppo_updatedate = substr($this->ppo_updatedate, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->ppo_updatedate) || $this->ppo_updatedate == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_updatedate, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_updatedate);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- ppo_updateby
   function NM_export_ppo_updateby()
   {
         $this->ppo_updateby = html_entity_decode($this->ppo_updateby, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ppo_updateby = strip_tags($this->ppo_updateby);
         if (!NM_is_utf8($this->ppo_updateby))
         {
             $this->ppo_updateby = sc_convert_encoding($this->ppo_updateby, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_updateby, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_note
   function NM_export_ppo_note()
   {
         $this->ppo_note = html_entity_decode($this->ppo_note, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ppo_note = strip_tags($this->ppo_note);
         if (!NM_is_utf8($this->ppo_note))
         {
             $this->ppo_note = sc_convert_encoding($this->ppo_note, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_note, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_evident_one
   function NM_export_ppo_evident_one()
   {
         $this->ppo_evident_one = html_entity_decode($this->ppo_evident_one, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ppo_evident_one = strip_tags($this->ppo_evident_one);
         if (!NM_is_utf8($this->ppo_evident_one))
         {
             $this->ppo_evident_one = sc_convert_encoding($this->ppo_evident_one, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_evident_one, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_evident_two
   function NM_export_ppo_evident_two()
   {
         $this->ppo_evident_two = html_entity_decode($this->ppo_evident_two, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ppo_evident_two = strip_tags($this->ppo_evident_two);
         if (!NM_is_utf8($this->ppo_evident_two))
         {
             $this->ppo_evident_two = sc_convert_encoding($this->ppo_evident_two, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_evident_two, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_evident_three
   function NM_export_ppo_evident_three()
   {
         $this->ppo_evident_three = html_entity_decode($this->ppo_evident_three, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ppo_evident_three = strip_tags($this->ppo_evident_three);
         if (!NM_is_utf8($this->ppo_evident_three))
         {
             $this->ppo_evident_three = sc_convert_encoding($this->ppo_evident_three, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_evident_three, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_status
   function NM_export_ppo_status()
   {
         $this->ppo_status = html_entity_decode($this->ppo_status, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ppo_status = strip_tags($this->ppo_status);
         if (!NM_is_utf8($this->ppo_status))
         {
             $this->ppo_status = sc_convert_encoding($this->ppo_status, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_status, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ppo_tglmulaiplan
   function NM_export_ppo_tglmulaiplan()
   {
         $this->ppo_tglmulaiplan = substr($this->ppo_tglmulaiplan, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->ppo_tglmulaiplan) || $this->ppo_tglmulaiplan == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_tglmulaiplan, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_tglmulaiplan);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- ppo_targethari
   function NM_export_ppo_targethari()
   {
         if (!NM_is_utf8($this->ppo_targethari))
         {
             $this->ppo_targethari = sc_convert_encoding($this->ppo_targethari, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ppo_targethari))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_targethari);
         $this->Xls_col++;
   }
   //----- ppo_targetselesai
   function NM_export_ppo_targetselesai()
   {
         $this->ppo_targetselesai = substr($this->ppo_targetselesai, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->ppo_targetselesai) || $this->ppo_targetselesai == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_targetselesai, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_targetselesai);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- ppo_tglmulaiactual
   function NM_export_ppo_tglmulaiactual()
   {
         $this->ppo_tglmulaiactual = substr($this->ppo_tglmulaiactual, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->ppo_tglmulaiactual) || $this->ppo_tglmulaiactual == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_tglmulaiactual, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_tglmulaiactual);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- ppo_tglselesaiactual
   function NM_export_ppo_tglselesaiactual()
   {
         $this->ppo_tglselesaiactual = substr($this->ppo_tglselesaiactual, 0, 10);
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         if (empty($this->ppo_tglselesaiactual) || $this->ppo_tglselesaiactual == "0000-00-00")
         {
             $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_tglselesaiactual, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_tglselesaiactual);
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode($this->SC_date_conf_region);
         }
         $this->Xls_col++;
   }
   //----- ppo_tasknumber
   function NM_export_ppo_tasknumber()
   {
         if (!NM_is_utf8($this->ppo_tasknumber))
         {
             $this->ppo_tasknumber = sc_convert_encoding($this->ppo_tasknumber, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ppo_tasknumber))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_tasknumber);
         $this->Xls_col++;
   }
   //----- ppo_realaktual
   function NM_export_ppo_realaktual()
   {
         if (!NM_is_utf8($this->ppo_realaktual))
         {
             $this->ppo_realaktual = sc_convert_encoding($this->ppo_realaktual, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
         if (is_numeric($this->ppo_realaktual))
         {
             $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getNumberFormat()->setFormatCode('#,##0');
         }
         $this->Nm_ActiveSheet->setCellValue($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ppo_realaktual);
         $this->Xls_col++;
   }
   //----- statusname
   function NM_export_statusname()
   {
         $this->statusname = html_entity_decode($this->statusname, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->statusname = strip_tags($this->statusname);
         if (!NM_is_utf8($this->statusname))
         {
             $this->statusname = sc_convert_encoding($this->statusname, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->statusname, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- ms_namasto
   function NM_export_ms_namasto()
   {
         $this->ms_namasto = html_entity_decode($this->ms_namasto, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ms_namasto = strip_tags($this->ms_namasto);
         if (!NM_is_utf8($this->ms_namasto))
         {
             $this->ms_namasto = sc_convert_encoding($this->ms_namasto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->ms_namasto, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- md_namadatel
   function NM_export_md_namadatel()
   {
         $this->md_namadatel = html_entity_decode($this->md_namadatel, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->md_namadatel = strip_tags($this->md_namadatel);
         if (!NM_is_utf8($this->md_namadatel))
         {
             $this->md_namadatel = sc_convert_encoding($this->md_namadatel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->md_namadatel, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- tm_namamitra
   function NM_export_tm_namamitra()
   {
         $this->tm_namamitra = html_entity_decode($this->tm_namamitra, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tm_namamitra = strip_tags($this->tm_namamitra);
         if (!NM_is_utf8($this->tm_namamitra))
         {
             $this->tm_namamitra = sc_convert_encoding($this->tm_namamitra, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->tm_namamitra, PHPExcel_Cell_DataType::TYPE_STRING);
         $this->Xls_col++;
   }
   //----- statusproject
   function NM_export_statusproject()
   {
         $this->statusproject = html_entity_decode($this->statusproject, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->statusproject = strip_tags($this->statusproject);
         if (!NM_is_utf8($this->statusproject))
         {
             $this->statusproject = sc_convert_encoding($this->statusproject, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->Nm_ActiveSheet->getStyle($this->calc_cell($this->Xls_col) . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
         $this->Nm_ActiveSheet->setCellValueExplicit($this->calc_cell($this->Xls_col) . $this->Xls_row, $this->statusproject, PHPExcel_Cell_DataType::TYPE_STRING);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['downloaddetail'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Download Data Detail :: Excel</TITLE>
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
<form name="Fdown" method="get" action="downloaddetail_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="downloaddetail"> 
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
