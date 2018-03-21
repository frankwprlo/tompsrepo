<?php

class v_table_project_detail_xml
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;

   var $Arquivo;
   var $Arquivo_view;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("en_us");
   }

   //---- 
   function monta_xml()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nm_data    = new nm_data("en_us");
      $this->Arquivo      = "sc_xml";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo     .= "_v_table_project_detail";
      $this->Arquivo_view = $this->Arquivo . "_view.xml";
      $this->Arquivo     .= ".xml";
      $this->Tit_doc      = "v_table_project_detail.xml";
      $this->Grava_view   = false;
      if (strtolower($_SESSION['scriptcase']['charset']) != strtolower($_SESSION['scriptcase']['charset_html']))
      {
          $this->Grava_view = true;
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['v_table_project_detail']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['v_table_project_detail']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['v_table_project_detail']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->tp_id = $Busca_temp['tp_id']; 
          $tmp_pos = strpos($this->tp_id, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_id))
          {
              $this->tp_id = substr($this->tp_id, 0, $tmp_pos);
          }
          $this->tp_id_2 = $Busca_temp['tp_id_input_2']; 
          $this->tp_batch = $Busca_temp['tp_batch']; 
          $tmp_pos = strpos($this->tp_batch, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_batch))
          {
              $this->tp_batch = substr($this->tp_batch, 0, $tmp_pos);
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
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['xml_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['xml_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT TP_ID, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, TEMPLATENAME, STATUSNAME, TM_NAMAMITRA, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_ODP, str_replace (convert(char(10),TP_PLANSTART,102), '.', '-') + ' ' + convert(char(8),TP_PLANSTART,20), str_replace (convert(char(10),TP_PLANFINISH,102), '.', '-') + ' ' + convert(char(8),TP_PLANFINISH,20), TP_SUMMARY, TP_STATUS, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_MITRA, TP_WITEL, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT TP_ID, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, TEMPLATENAME, STATUSNAME, TM_NAMAMITRA, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_SUMMARY, TP_STATUS, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_MITRA, TP_WITEL, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT TP_ID, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, TEMPLATENAME, STATUSNAME, TM_NAMAMITRA, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_ODP, convert(char(23),TP_PLANSTART,121), convert(char(23),TP_PLANFINISH,121), TP_SUMMARY, TP_STATUS, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_MITRA, TP_WITEL, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT TP_ID, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, TEMPLATENAME, STATUSNAME, TM_NAMAMITRA, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_SUMMARY, TP_STATUS, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_MITRA, TP_WITEL, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT TP_ID, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, TEMPLATENAME, STATUSNAME, TM_NAMAMITRA, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_ODP, EXTEND(TP_PLANSTART, YEAR TO FRACTION), EXTEND(TP_PLANFINISH, YEAR TO FRACTION), TP_SUMMARY, TP_STATUS, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_MITRA, TP_WITEL, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT TP_ID, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, TEMPLATENAME, STATUSNAME, TM_NAMAMITRA, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_SUMMARY, TP_STATUS, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_MITRA, TP_WITEL, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      $xml_charset = $_SESSION['scriptcase']['charset'];
      $xml_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      fwrite($xml_f, "<?xml version=\"1.0\" encoding=\"$xml_charset\" ?>\r\n");
      fwrite($xml_f, "<root>\r\n");
      if ($this->Grava_view)
      {
          $xml_charset_v = $_SESSION['scriptcase']['charset_html'];
          $xml_v         = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view, "w");
          fwrite($xml_v, "<?xml version=\"1.0\" encoding=\"$xml_charset_v\" ?>\r\n");
          fwrite($xml_v, "<root>\r\n");
      }
      $this->SC_seq_register = 0;
      while (!$rs->EOF)
      {
          $this->SC_seq_register++;
         $this->xml_registro = "<v_table_project_detail";
         $this->tp_id = $rs->fields[0] ;  
         $this->tp_id = (string)$this->tp_id;
         $this->mw_namawitel = $rs->fields[1] ;  
         $this->md_namadatel = $rs->fields[2] ;  
         $this->ms_namasto = $rs->fields[3] ;  
         $this->templatename = $rs->fields[4] ;  
         $this->statusname = $rs->fields[5] ;  
         $this->tm_namamitra = $rs->fields[6] ;  
         $this->tp_batch = $rs->fields[7] ;  
         $this->tp_projectname = $rs->fields[8] ;  
         $this->tp_lokasi = $rs->fields[9] ;  
         $this->tp_odp = $rs->fields[10] ;  
         $this->tp_odp = (string)$this->tp_odp;
         $this->tp_planstart = $rs->fields[11] ;  
         $this->tp_planfinish = $rs->fields[12] ;  
         $this->tp_summary = $rs->fields[13] ;  
         $this->tp_status = $rs->fields[14] ;  
         $this->tp_status = (string)$this->tp_status;
         $this->tp_jenisproject = $rs->fields[15] ;  
         $this->tp_jenisproject = (string)$this->tp_jenisproject;
         $this->tp_prjtrelease = $rs->fields[16] ;  
         $this->tp_prjtrelease = (string)$this->tp_prjtrelease;
         $this->tp_targetwaktu = $rs->fields[17] ;  
         $this->tp_targetwaktu = (string)$this->tp_targetwaktu;
         $this->tp_mitra = $rs->fields[18] ;  
         $this->tp_mitra = (string)$this->tp_mitra;
         $this->tp_witel = $rs->fields[19] ;  
         $this->tp_witel = (string)$this->tp_witel;
         $this->tp_templateproject = $rs->fields[20] ;  
         $this->tp_templateproject = (string)$this->tp_templateproject;
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['v_table_project_detail']['contr_erro'] = 'on';
 $progress ='View Progress';

	


$check_sql1 = "SELECT 
SUM(IF(TPP_PROJECTPHASE='1',TPP_PROSENTASEPROJECT)) AS SATU,
SUM(IF(TPP_PROJECTPHASE='2',TPP_PROSENTASEPROJECT)) AS DUA,
SUM(IF(TPP_PROJECTPHASE='3',TPP_PROSENTASEPROJECT)) AS TIGA,
SUM(IF(TPP_PROJECTPHASE='4',TPP_PROSENTASEPROJECT)) AS EMPAT
FROM TBL_PROJECT_PROGRESS
WHERE TPP_IDPROJECT='$this->tp_id ";
 
      $nm_select = $check_sql1; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs1 = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs1[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs1 = false;
          $this->rs1_erro = $this->Db->ErrorMsg();
      } 
;

if (isset($this->rs1[0][0]))     
{
    $this->prepare  = $this->rs1[0][0];
    $this->perijinan  = $this->rs1[0][1];
    $this->inst_testcomm  = $this->rs1[0][2];
    $this->closing  = $this->rs1[0][3];

}
		else     
{
    $this->prepare  = '';
    $this->perijinan  = '';
    $this->inst_testcomm  = '';
    $this->closing  = '';

		}	



$check_sql = "SELECT COUNT(PROJECTPHASEID) AS JMLID FROM AKSESSMR.TB_TAHAPAN_PROJECT
WHERE TEMPLATEPROJECT='$this->tp_templateproject'";
 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
;

if (isset($this->rs[0][0]))     
{
    $jumlahtahapan  = $this->rs[0][0];
	
	$sqlprogress = "SELECT SUM(TPP_PROSENTASEPROJECT) as SUMPROGRESS FROM AKSESSMR.TBL_PROJECT_PROGRESS
	WHERE TPP_IDPROJECT='$this->tp_id'";
	 
      $nm_select = $sqlprogress; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsprogress = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rsprogress[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsprogress = false;
          $this->rsprogress_erro = $this->Db->ErrorMsg();
      } 
;

	if (isset($this->rs[0][0]))     
	{
    	$fieldprogress  = $this->rsprogress[0][0];
    }
$this->pencapaian  = ($fieldprogress /($jumlahtahapan *100))*100;
}
$_SESSION['scriptcase']['v_table_project_detail']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->xml_registro .= " />\r\n";
         fwrite($xml_f, $this->xml_registro);
         if ($this->Grava_view)
         {
            fwrite($xml_v, $this->xml_registro);
         }
         $rs->MoveNext();
      }
      fwrite($xml_f, "</root>");
      fclose($xml_f);
      if ($this->Grava_view)
      {
         fwrite($xml_v, "</root>");
         fclose($xml_v);
      }

      $rs->Close();
   }
   //----- tp_id
   function NM_export_tp_id()
   {
         nmgp_Form_Num_Val($this->tp_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_id))
         {
             $this->tp_id = sc_convert_encoding($this->tp_id, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_id =\"" . $this->trata_dados($this->tp_id) . "\"";
   }
   //----- mw_namawitel
   function NM_export_mw_namawitel()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->mw_namawitel))
         {
             $this->mw_namawitel = sc_convert_encoding($this->mw_namawitel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " mw_namawitel =\"" . $this->trata_dados($this->mw_namawitel) . "\"";
   }
   //----- md_namadatel
   function NM_export_md_namadatel()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->md_namadatel))
         {
             $this->md_namadatel = sc_convert_encoding($this->md_namadatel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " md_namadatel =\"" . $this->trata_dados($this->md_namadatel) . "\"";
   }
   //----- ms_namasto
   function NM_export_ms_namasto()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ms_namasto))
         {
             $this->ms_namasto = sc_convert_encoding($this->ms_namasto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " ms_namasto =\"" . $this->trata_dados($this->ms_namasto) . "\"";
   }
   //----- templatename
   function NM_export_templatename()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->templatename))
         {
             $this->templatename = sc_convert_encoding($this->templatename, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " templatename =\"" . $this->trata_dados($this->templatename) . "\"";
   }
   //----- statusname
   function NM_export_statusname()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->statusname))
         {
             $this->statusname = sc_convert_encoding($this->statusname, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " statusname =\"" . $this->trata_dados($this->statusname) . "\"";
   }
   //----- tm_namamitra
   function NM_export_tm_namamitra()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tm_namamitra))
         {
             $this->tm_namamitra = sc_convert_encoding($this->tm_namamitra, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tm_namamitra =\"" . $this->trata_dados($this->tm_namamitra) . "\"";
   }
   //----- tp_batch
   function NM_export_tp_batch()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_batch))
         {
             $this->tp_batch = sc_convert_encoding($this->tp_batch, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_batch =\"" . $this->trata_dados($this->tp_batch) . "\"";
   }
   //----- tp_projectname
   function NM_export_tp_projectname()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_projectname))
         {
             $this->tp_projectname = sc_convert_encoding($this->tp_projectname, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_projectname =\"" . $this->trata_dados($this->tp_projectname) . "\"";
   }
   //----- tp_lokasi
   function NM_export_tp_lokasi()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_lokasi))
         {
             $this->tp_lokasi = sc_convert_encoding($this->tp_lokasi, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_lokasi =\"" . $this->trata_dados($this->tp_lokasi) . "\"";
   }
   //----- tp_odp
   function NM_export_tp_odp()
   {
         nmgp_Form_Num_Val($this->tp_odp, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_odp))
         {
             $this->tp_odp = sc_convert_encoding($this->tp_odp, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_odp =\"" . $this->trata_dados($this->tp_odp) . "\"";
   }
   //----- tp_planstart
   function NM_export_tp_planstart()
   {
         $conteudo_x =  $this->tp_planstart;
         nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->tp_planstart, "YYYY-MM-DD  ");
             $this->tp_planstart = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_planstart))
         {
             $this->tp_planstart = sc_convert_encoding($this->tp_planstart, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_planstart =\"" . $this->trata_dados($this->tp_planstart) . "\"";
   }
   //----- tp_planfinish
   function NM_export_tp_planfinish()
   {
         $conteudo_x =  $this->tp_planfinish;
         nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->tp_planfinish, "YYYY-MM-DD  ");
             $this->tp_planfinish = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
         } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_planfinish))
         {
             $this->tp_planfinish = sc_convert_encoding($this->tp_planfinish, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_planfinish =\"" . $this->trata_dados($this->tp_planfinish) . "\"";
   }
   //----- tp_summary
   function NM_export_tp_summary()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_summary))
         {
             $this->tp_summary = sc_convert_encoding($this->tp_summary, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_summary =\"" . $this->trata_dados($this->tp_summary) . "\"";
   }
   //----- tp_status
   function NM_export_tp_status()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_status))
         {
             $this->tp_status = sc_convert_encoding($this->tp_status, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_status =\"" . $this->trata_dados($this->tp_status) . "\"";
   }
   //----- tp_jenisproject
   function NM_export_tp_jenisproject()
   {
         nmgp_Form_Num_Val($this->tp_jenisproject, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_jenisproject))
         {
             $this->tp_jenisproject = sc_convert_encoding($this->tp_jenisproject, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_jenisproject =\"" . $this->trata_dados($this->tp_jenisproject) . "\"";
   }
   //----- tp_prjtrelease
   function NM_export_tp_prjtrelease()
   {
         nmgp_Form_Num_Val($this->tp_prjtrelease, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_prjtrelease))
         {
             $this->tp_prjtrelease = sc_convert_encoding($this->tp_prjtrelease, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_prjtrelease =\"" . $this->trata_dados($this->tp_prjtrelease) . "\"";
   }
   //----- tp_targetwaktu
   function NM_export_tp_targetwaktu()
   {
         nmgp_Form_Num_Val($this->tp_targetwaktu, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_targetwaktu))
         {
             $this->tp_targetwaktu = sc_convert_encoding($this->tp_targetwaktu, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_targetwaktu =\"" . $this->trata_dados($this->tp_targetwaktu) . "\"";
   }
   //----- prepare
   function NM_export_prepare()
   {
         nmgp_Form_Num_Val($this->prepare, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->prepare))
         {
             $this->prepare = sc_convert_encoding($this->prepare, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " prepare =\"" . $this->trata_dados($this->prepare) . "\"";
   }
   //----- perijinan
   function NM_export_perijinan()
   {
         nmgp_Form_Num_Val($this->perijinan, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->perijinan))
         {
             $this->perijinan = sc_convert_encoding($this->perijinan, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " perijinan =\"" . $this->trata_dados($this->perijinan) . "\"";
   }
   //----- inst_testcomm
   function NM_export_inst_testcomm()
   {
         nmgp_Form_Num_Val($this->inst_testcomm, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->inst_testcomm))
         {
             $this->inst_testcomm = sc_convert_encoding($this->inst_testcomm, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " inst_testcomm =\"" . $this->trata_dados($this->inst_testcomm) . "\"";
   }
   //----- closing
   function NM_export_closing()
   {
         nmgp_Form_Num_Val($this->closing, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->closing))
         {
             $this->closing = sc_convert_encoding($this->closing, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " closing =\"" . $this->trata_dados($this->closing) . "\"";
   }
   //----- pencapaian
   function NM_export_pencapaian()
   {
         nmgp_Form_Num_Val($this->pencapaian, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "1", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pencapaian))
         {
             $this->pencapaian = sc_convert_encoding($this->pencapaian, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " pencapaian =\"" . $this->trata_dados($this->pencapaian) . "\"";
   }
   //----- tp_mitra
   function NM_export_tp_mitra()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_mitra))
         {
             $this->tp_mitra = sc_convert_encoding($this->tp_mitra, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_mitra =\"" . $this->trata_dados($this->tp_mitra) . "\"";
   }
   //----- tp_witel
   function NM_export_tp_witel()
   {
         nmgp_Form_Num_Val($this->tp_witel, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tp_witel))
         {
             $this->tp_witel = sc_convert_encoding($this->tp_witel, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->xml_registro .= " tp_witel =\"" . $this->trata_dados($this->tp_witel) . "\"";
   }

   //----- 
   function trata_dados($conteudo)
   {
      $str_temp =  $conteudo;
      $str_temp =  str_replace("<br />", "",  $str_temp);
      $str_temp =  str_replace("&", "&amp;",  $str_temp);
      $str_temp =  str_replace("<", "&lt;",   $str_temp);
      $str_temp =  str_replace(">", "&gt;",   $str_temp);
      $str_temp =  str_replace("'", "&apos;", $str_temp);
      $str_temp =  str_replace('"', "&quot;",  $str_temp);
      $str_temp =  str_replace('(', "_",  $str_temp);
      $str_temp =  str_replace(')', "",  $str_temp);
      return ($str_temp);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_detail'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Resume Project Detail :: XML</TITLE>
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
   <td class="scExportTitle" style="height: 25px">XML</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="v_table_project_detail_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="v_table_project_detail"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
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
