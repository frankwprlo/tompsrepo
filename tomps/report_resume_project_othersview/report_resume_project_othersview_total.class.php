<?php

class report_resume_project_othersview_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function __construct($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("en_us");
      if (isset($_SESSION['sc_session'][$this->sc_page]['report_resume_project_othersview']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['report_resume_project_othersview']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca'];
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
          $this->tp_batch = $Busca_temp['tp_batch']; 
          $tmp_pos = strpos($this->tp_batch, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_batch))
          {
              $this->tp_batch = substr($this->tp_batch, 0, $tmp_pos);
          }
          $this->tp_jenisproject = $Busca_temp['tp_jenisproject']; 
          $tmp_pos = strpos($this->tp_jenisproject, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_jenisproject))
          {
              $this->tp_jenisproject = substr($this->tp_jenisproject, 0, $tmp_pos);
          }
          $this->tp_prjtrelease = $Busca_temp['tp_prjtrelease']; 
          $tmp_pos = strpos($this->tp_prjtrelease, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_prjtrelease))
          {
              $this->tp_prjtrelease = substr($this->tp_prjtrelease, 0, $tmp_pos);
          }
          $this->tp_templateproject = $Busca_temp['tp_templateproject']; 
          $tmp_pos = strpos($this->tp_templateproject, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_templateproject))
          {
              $this->tp_templateproject = substr($this->tp_templateproject, 0, $tmp_pos);
          }
          $this->tp_status = $Busca_temp['tp_status']; 
          $tmp_pos = strpos($this->tp_status, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_status))
          {
              $this->tp_status = substr($this->tp_status, 0, $tmp_pos);
          }
          $this->tp_planstart = $Busca_temp['tp_planstart']; 
          $tmp_pos = strpos($this->tp_planstart, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_planstart))
          {
              $this->tp_planstart = substr($this->tp_planstart, 0, $tmp_pos);
          }
          $tp_planstart_2 = $Busca_temp['tp_planstart_input_2']; 
          $this->tp_planstart_2 = $Busca_temp['tp_planstart_input_2']; 
          $this->tp_planfinish = $Busca_temp['tp_planfinish']; 
          $tmp_pos = strpos($this->tp_planfinish, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_planfinish))
          {
              $this->tp_planfinish = substr($this->tp_planfinish, 0, $tmp_pos);
          }
          $tp_planfinish_2 = $Busca_temp['tp_planfinish_input_2']; 
          $this->tp_planfinish_2 = $Busca_temp['tp_planfinish_input_2']; 
          $this->tp_divre = $Busca_temp['tp_divre']; 
          $tmp_pos = strpos($this->tp_divre, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_divre))
          {
              $this->tp_divre = substr($this->tp_divre, 0, $tmp_pos);
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
          $this->tp_mitra = $Busca_temp['tp_mitra']; 
          $tmp_pos = strpos($this->tp_mitra, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_mitra))
          {
              $this->tp_mitra = substr($this->tp_mitra, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral_groupbywitel($res_limit=false)
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $rt->fields[1] = (string)$rt->fields[1]; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['tot_geral'][2] = $rt->fields[1]; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['contr_total_geral'] = "OK";
   } 

   //-----  ketstatustask
   function quebra_ketstatustask_groupbywitel($ketstatustask, $arg_sum_ketstatustask) 
   {
      global $tot_ketstatustask;
      $tot_ketstatustask = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq'])) 
      { 
         $nm_comando .= " where KETSTATUSTASK" . $arg_sum_ketstatustask ; 
      } 
      else 
      { 
         $nm_comando .= " and KETSTATUSTASK" . $arg_sum_ketstatustask ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_ketstatustask[0] = sc_strip_script($ketstatustask) ; 
      $tot_ketstatustask[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_ketstatustask[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
   } 

   //-----  tp_witel
   function quebra_tp_witel_groupbywitel($ketstatustask, $tp_witel, $arg_sum_ketstatustask, $arg_sum_tp_witel) 
   {
      global $tot_tp_witel;
      $tot_tp_witel = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq'])) 
      { 
         $nm_comando .= " where KETSTATUSTASK" . $arg_sum_ketstatustask . " and TP_WITEL" . $arg_sum_tp_witel ; 
      } 
      else 
      { 
         $nm_comando .= " and KETSTATUSTASK" . $arg_sum_ketstatustask . " and TP_WITEL" . $arg_sum_tp_witel ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_tp_witel[0] = NM_encode_input(sc_strip_script($tp_witel)) ; 
      $tot_tp_witel[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_tp_witel[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
   } 

   //-----  tp_tahapanaktif
   function quebra_tp_tahapanaktif_groupbywitel($ketstatustask, $tp_witel, $tp_tahapanaktif, $arg_sum_ketstatustask, $arg_sum_tp_witel, $arg_sum_tp_tahapanaktif) 
   {
      global $tot_tp_tahapanaktif;
      $tot_tp_tahapanaktif = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq'])) 
      { 
         $nm_comando .= " where KETSTATUSTASK" . $arg_sum_ketstatustask . " and TP_WITEL" . $arg_sum_tp_witel . " and TP_TAHAPANAKTIF" . $arg_sum_tp_tahapanaktif ; 
      } 
      else 
      { 
         $nm_comando .= " and KETSTATUSTASK" . $arg_sum_ketstatustask . " and TP_WITEL" . $arg_sum_tp_witel . " and TP_TAHAPANAKTIF" . $arg_sum_tp_tahapanaktif ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_tp_tahapanaktif[0] = sc_strip_script($tp_tahapanaktif) ; 
      $tot_tp_tahapanaktif[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_tp_tahapanaktif[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
   } 

   //-----  grouptaskaktif
   function quebra_grouptaskaktif_groupbywitel($ketstatustask, $tp_witel, $tp_tahapanaktif, $grouptaskaktif, $arg_sum_ketstatustask, $arg_sum_tp_witel, $arg_sum_tp_tahapanaktif, $arg_sum_grouptaskaktif) 
   {
      global $tot_grouptaskaktif;
      $tot_grouptaskaktif = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*), count(TP_IDLOP) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']; 
      } 
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq'])) 
      { 
         $nm_comando .= " where KETSTATUSTASK" . $arg_sum_ketstatustask . " and TP_WITEL" . $arg_sum_tp_witel . " and TP_TAHAPANAKTIF" . $arg_sum_tp_tahapanaktif . " and GROUPTASKAKTIF" . $arg_sum_grouptaskaktif ; 
      } 
      else 
      { 
         $nm_comando .= " and KETSTATUSTASK" . $arg_sum_ketstatustask . " and TP_WITEL" . $arg_sum_tp_witel . " and TP_TAHAPANAKTIF" . $arg_sum_tp_tahapanaktif . " and GROUPTASKAKTIF" . $arg_sum_grouptaskaktif ; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      $tot_grouptaskaktif[0] = NM_encode_input(sc_strip_script($grouptaskaktif)) ; 
      $tot_grouptaskaktif[1] = $rt->fields[0] ; 
      $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
      $tot_grouptaskaktif[2] = (string)$rt->fields[1]; 
      $rt->Close(); 
   } 


   //----- 
   function Calc_resumo_groupbywitel($destino_resumo)
   {
      global $nm_lang;
      $this->nm_data = new nm_data("en_us");
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['sql_tot_res']);
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca'];
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
          $this->tp_batch = $Busca_temp['tp_batch']; 
          $tmp_pos = strpos($this->tp_batch, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_batch))
          {
              $this->tp_batch = substr($this->tp_batch, 0, $tmp_pos);
          }
          $this->tp_jenisproject = $Busca_temp['tp_jenisproject']; 
          $tmp_pos = strpos($this->tp_jenisproject, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_jenisproject))
          {
              $this->tp_jenisproject = substr($this->tp_jenisproject, 0, $tmp_pos);
          }
          $this->tp_prjtrelease = $Busca_temp['tp_prjtrelease']; 
          $tmp_pos = strpos($this->tp_prjtrelease, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_prjtrelease))
          {
              $this->tp_prjtrelease = substr($this->tp_prjtrelease, 0, $tmp_pos);
          }
          $this->tp_templateproject = $Busca_temp['tp_templateproject']; 
          $tmp_pos = strpos($this->tp_templateproject, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_templateproject))
          {
              $this->tp_templateproject = substr($this->tp_templateproject, 0, $tmp_pos);
          }
          $this->tp_status = $Busca_temp['tp_status']; 
          $tmp_pos = strpos($this->tp_status, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_status))
          {
              $this->tp_status = substr($this->tp_status, 0, $tmp_pos);
          }
          $this->tp_planstart = $Busca_temp['tp_planstart']; 
          $tmp_pos = strpos($this->tp_planstart, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_planstart))
          {
              $this->tp_planstart = substr($this->tp_planstart, 0, $tmp_pos);
          }
          $this->tp_planstart_2 = $Busca_temp['tp_planstart_input_2']; 
          $this->tp_planfinish = $Busca_temp['tp_planfinish']; 
          $tmp_pos = strpos($this->tp_planfinish, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_planfinish))
          {
              $this->tp_planfinish = substr($this->tp_planfinish, 0, $tmp_pos);
          }
          $this->tp_planfinish_2 = $Busca_temp['tp_planfinish_input_2']; 
          $this->tp_divre = $Busca_temp['tp_divre']; 
          $tmp_pos = strpos($this->tp_divre, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_divre))
          {
              $this->tp_divre = substr($this->tp_divre, 0, $tmp_pos);
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
          $this->tp_mitra = $Busca_temp['tp_mitra']; 
          $tmp_pos = strpos($this->tp_mitra, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_mitra))
          {
              $this->tp_mitra = substr($this->tp_mitra, 0, $tmp_pos);
          }
      } 
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq'];
      $ind_qb                = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['SC_Ind_Groupby'];
      $cmp_sql_def   = array('ketstatustask' => "KETSTATUSTASK",'tp_witel' => "TP_WITEL",'tp_tahapanaktif' => "TP_TAHAPANAKTIF",'grouptaskaktif' => "GROUPTASKAKTIF");
      $cmps_quebra_atual = array("ketstatustask","tp_witel","tp_tahapanaktif","grouptaskaktif");
      $ult_cmp_quebra_atual = $cmps_quebra_atual[(count($cmps_quebra_atual) - 1)];
      $arr_tots = "";
      $join     = "";
      $group    = "";
      $i_group  = 1;
      $cmps_gb  = "";
      $cmps_gb1 = "";
      $cmps_gb2 = "";
      $cmps_gbS = array();
      $ind_cmps = 2;
      $ind_alias = "1";
      $cmp_dim   = array();
      $all_group = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $cmp_gb);
          if (!empty($Format_tst))
          {
              $Str_arg_sum = $this->Ini->Get_date_arg_sum($cmp_gb, $Format_tst, $cmp_sql_def[$cmp_gb], false, true);
              $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$cmp_gb] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$cmp_gb], $Format_tst);
          }
          else
          {
              $Str_arg_sql = "";
              $Str_arg_sum = $cmp_sql_def[$cmp_gb] . " *sc# SC." . $cmp_sql_def[$cmp_gb];
          }
          $cmp_dim[$cmp_gb] = $ind_cmps;
          $temp = explode(" and ", $Str_arg_sum);
          foreach ($temp as $cada_parte)
          {
              $temp1 = explode("*sc#", $cada_parte);
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $group .= (empty($group)) ? $i_group : "," . $i_group;
              }
              elseif (!in_array($Str_arg_sql . trim($temp1[0]), $all_group))
              {
                  $group .= (empty($group)) ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
                  $all_group[] = $Str_arg_sql . trim($temp1[0]);
              }
              $cmps_gb1 .= (empty($cmps_gb1)) ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
              $cmps_gb1 .= " as a_cmp_" .  $ind_alias;
              $cmps_gb2 .= (empty($cmps_gb2)) ? $Str_arg_sql . trim($temp1[0]) : "," . $Str_arg_sql . trim($temp1[0]);
              $cmps_gb2 .= " as b_cmp_" .  $ind_alias;
              $join     .= empty($join) ? "" : " and ";
              $join     .= " SC_sel1.a_cmp_" .  $ind_alias . " =  SC_sel2.b_cmp_" .  $ind_alias;
              $ind_cmps++;
              $ind_alias++;
              $i_group++;
          }
      }
      $ind_cmps  = 2;
      $ind_alias = "1";
      $cmp_dim   = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $arr_tots .= "[\$" . $cmp_gb . "_orig]";
          $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $cmp_gb);
          if (!empty($Format_tst))
          {
              $Str_arg_sum = $this->Ini->Get_date_arg_sum($cmp_gb, $Format_tst, $cmp_sql_def[$cmp_gb], false, true);
              $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$cmp_gb] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$cmp_gb], $Format_tst);
          }
          else
          {
              $Str_arg_sql = "";
              $Str_arg_sum = $cmp_sql_def[$cmp_gb] . " *sc# SC." . $cmp_sql_def[$cmp_gb];
          }
          $cmp_dim[$cmp_gb] = $ind_cmps;
          $temp = explode(" and ", $Str_arg_sum);
          foreach ($temp as $cada_parte)
          {
              $temp1 = explode("*sc#", $cada_parte);
              $cmps_gb  .= (empty($cmps_gb)) ? "a_cmp_" .  $ind_alias : "," . "a_cmp_" .  $ind_alias;
              $cmps_gbS['a_cmp_' . $ind_alias] = $Str_arg_sql . trim($temp1[0]);
              $ind_cmps++;
              $ind_alias++;
          }
          $this->Res_Totaliza_groupbywitel($ind_qb, $cmp_gb, $arr_tots, $group, $join, $cmps_gb, $cmps_gb1, $cmps_gb2, $cmps_gbS, $cmp_dim, $cmps_quebra_atual, $cmp_sql_def);
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['arr_total'] = array();
      foreach ($cmps_quebra_atual as $cmp_gb)
      {
          $Arr_tot_name = "array_total_" . $cmp_gb;
          $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['arr_total'][$cmp_gb] = $this->$Arr_tot_name;
      }
   }

   function Res_Totaliza_groupbywitel($ind_qb, $cmp_tot, $arr_tots, $group, $join, $cmps_quebras, $cmps_quebras1, $cmps_quebras2, $cmps_quebrasS, $Cmp_dim, $cmps_quebra_atual, $cmp_sql_def)
   {
      $sc_having = ((isset($parms_sub_sel['having']))) ? "  having " . $parms_sub_sel['having'] : "";
      $Tem_estat_manual = false;
      $where_ok = $this->sc_where_atual;
      $cmp_sql_tp_num = array('tp_id' => 'N','tp_mitra' => 'N','tp_witel' => 'N','tp_sto' => 'N','tp_odp' => 'N','tp_status' => 'N','tp_templateproject' => 'N','tp_jenisproject' => 'N','tp_prjtrelease' => 'N','tp_targetwaktu' => 'N','tp_datel' => 'N','tp_divre' => 'N','tp_nilai' => 'N','tp_rab' => 'N','tp_jmldistribusi' => 'N','tp_taskaktif_number' => 'N','tp_prosentase' => 'N','tp_taskaktifstatus' => 'N','grouptaskaktif' => 'N');
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
         $cmd_simp = "select count(*), count(TP_IDLOP)#@#cmps_quebras#@# from " . $this->Ini->nm_tabela . " " . $where_ok;
         $comando  = "select count(*), count(SC_metric1)#@#cmps_quebras#@# from (";
         $comando .= "select TP_IDLOP as SC_metric1, " . $cmps_quebras1 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . ") SC_sel1 INNER JOIN (";
         $comando .= "select " . $cmps_quebras2 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . " group by " . $group . $sc_having . ") SC_sel2 ";
         $comando .= " ON " . $join;
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
         $cmd_simp = "select count(*), count(TP_IDLOP)#@#cmps_quebras#@# from " . $this->Ini->nm_tabela . " " . $where_ok;
         $comando  = "select count(*), count(SC_metric1)#@#cmps_quebras#@# from (";
         $comando .= "select TP_IDLOP as SC_metric1, " . $cmps_quebras1 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . ") SC_sel1 INNER JOIN (";
         $comando .= "select " . $cmps_quebras2 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . " group by " . $group . $sc_having . ") SC_sel2 ";
         $comando .= " ON " . $join;
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
         $cmd_simp = "select count(*), count(TP_IDLOP)#@#cmps_quebras#@# from " . $this->Ini->nm_tabela . " " . $where_ok;
         $comando  = "select count(*), count(SC_metric1)#@#cmps_quebras#@# from (";
         $comando .= "select TP_IDLOP as SC_metric1, " . $cmps_quebras1 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . ") SC_sel1 INNER JOIN (";
         $comando .= "select " . $cmps_quebras2 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . " group by " . $group . $sc_having . ") SC_sel2 ";
         $comando .= " ON " . $join;
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
         $cmd_simp = "select count(*), count(TP_IDLOP)#@#cmps_quebras#@# from " . $this->Ini->nm_tabela . " " . $where_ok;
         $comando  = "select count(*), count(SC_metric1)#@#cmps_quebras#@# from (";
         $comando .= "select TP_IDLOP as SC_metric1, " . $cmps_quebras1 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . ") SC_sel1 INNER JOIN (";
         $comando .= "select " . $cmps_quebras2 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . " group by " . $group . $sc_having . ") SC_sel2 ";
         $comando .= " ON " . $join;
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
         $cmd_simp = "select count(*), count(TP_IDLOP)#@#cmps_quebras#@# from " . $this->Ini->nm_tabela . " " . $where_ok;
         $comando  = "select count(*), count(SC_metric1)#@#cmps_quebras#@# from (";
         $comando .= "select TP_IDLOP as SC_metric1, " . $cmps_quebras1 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . ") SC_sel1 INNER JOIN (";
         $comando .= "select " . $cmps_quebras2 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . " group by " . $group . $sc_having . ") SC_sel2 ";
         $comando .= " ON " . $join;
      } 
      else 
      { 
         $cmd_simp = "select count(*), count(TP_IDLOP)#@#cmps_quebras#@# from " . $this->Ini->nm_tabela . " " . $where_ok;
         $comando  = "select count(*), count(SC_metric1)#@#cmps_quebras#@# from (";
         $comando .= "select TP_IDLOP as SC_metric1, " . $cmps_quebras1 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . ") SC_sel1 INNER JOIN (";
         $comando .= "select " . $cmps_quebras2 . " from " . $this->Ini->nm_tabela . " " .  $where_ok . " group by " . $group . $sc_having . ") SC_sel2 ";
         $comando .= " ON " . $join;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['sql_tot_res']))
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['sql_tot_res'] = str_replace("#@#cmps_quebras#@#", "", $comando);
      }
      $comando  = str_replace("#@#cmps_quebras#@#", "," . $cmps_quebras, $comando);
      $comando .= " group by " . $cmps_quebras . " order by " .  $cmps_quebras;
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['Res_search_metric_use']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['Res_search_metric_use']))
      {
          $comando = $cmd_simp;
          $cmps_S  = "";
          foreach ($cmps_quebrasS as $alias => $sql)
          {
              $cmps_S .= empty($cmps_S) ? $sql : ", " . $sql;
          }
          $comando = str_replace("#@#cmps_quebras#@#", "," . $cmps_S, $comando);
          $order_group = "";
          foreach ($cmps_quebrasS as $alias => $cada_tst)
          {
              $cada_tst = trim($cada_tst);
              $pos = strpos(" " . $order_group, " " . $cada_tst);
              if ($pos === false)
              {
                  $order_group .= (!empty($order_group)) ? ", " . $cada_tst : $cada_tst;
              }
          }
          $comando .= " group by " . $order_group . " order by " .  $order_group;
      }
      $comando  = $this->Ajust_statistic($comando);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($comando))
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit;
      }
      $format_dimensions = array();
      $format_dimensions['ketstatustask']['reg'] = "S";
      $format_dimensions['ketstatustask']['msk'] = "";
      $format_dimensions['tp_witel']['reg'] = "S";
      $format_dimensions['tp_witel']['msk'] = "";
      $format_dimensions['tp_tahapanaktif']['reg'] = "S";
      $format_dimensions['tp_tahapanaktif']['msk'] = "";
      $format_dimensions['grouptaskaktif']['reg'] = "S";
      $format_dimensions['grouptaskaktif']['msk'] = "";
      while (!$rt->EOF)
      {
          $sql_where = "";
          foreach ($Cmp_dim as $Cada_dim => $Ind_sql)
          {
              $prep_look  = $Cada_dim . "_SC_look";
              $$prep_look = $rt->fields[$Ind_sql];
              $SC_prep = $this->Ini->Get_format_dimension($Ind_sql, 'groupbywitel', $Cada_dim, $rt, $format_dimensions[$Cada_dim]['reg'], $format_dimensions[$Cada_dim]['msk']);
              $SC_orig = $Cada_dim . "_orig";
              $SC_graf = "val_grafico_" . $Cada_dim;
              $$Cada_dim = $SC_prep['fmt'];
              $$SC_orig = $SC_prep['orig'];
              if ($Cada_dim == "ketstatustask") {
              }
              if ($Cada_dim == "tp_witel") {
          nmgp_Form_Num_Val($$Cada_dim, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
              }
              if ($Cada_dim == "tp_tahapanaktif") {
              }
              if ($Cada_dim == "grouptaskaktif") {
          nmgp_Form_Num_Val($$Cada_dim, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
              }
              if (null === $$Cada_dim)
              {
                  $$Cada_dim = '';
              }
              if (null === $$SC_orig)
              {
                  $$SC_orig = '';
              }
              $$SC_graf = $$Cada_dim;
              if ($Tem_estat_manual)
              {
                  $Format_tst = $this->Ini->Get_Gb_date_format($ind_qb, $Cada_dim);
                  if (!empty($Format_tst))
                  {
                      $val_sql  = $rt->fields[$Ind_sql];
                      if ($Format_tst == 'YYYYMMDDHHII')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2] . " " . $rt->fields[$Ind_sql + 3] . ":" . $rt->fields[$Ind_sql + 4];
                      }
                      if ($Format_tst == 'YYYYMMDDHH')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2] . " " . $rt->fields[$Ind_sql + 3];
                      }
                      if ($Format_tst == 'YYYYMMDD2')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1] . "-" . $rt->fields[$Ind_sql + 2];
                      }
                      if ($Format_tst == 'YYYYMM')
                      {
                          $val_sql .= "-" . $rt->fields[$Ind_sql + 1];
                      }
                      if ($Format_tst == 'YYYYHH' || $Format_tst == 'YYYYDD' || $Format_tst == 'YYYYDAYNAME' || $Format_tst == 'YYYYWEEK' || $Format_tst == 'YYYYBIMONTHLY' || $Format_tst == 'YYYYQUARTER' || $Format_tst == 'YYYYFOURMONTHS' || $Format_tst == 'YYYYSEMIANNUAL')
                      {
                          $val_sql .= $rt->fields[$Ind_sql + 1];
                      }
                      if ($Format_tst == 'HHIISS')
                      {
                          $val_sql  = $rt->fields[$Ind_sql] . ":" . $rt->fields[$Ind_sql + 1] . ":" . $rt->fields[$Ind_sql + 2];
                      }
                      if ($Format_tst == 'HHII')
                      {
                          $val_sql  = $rt->fields[$Ind_sql] . ":" . $rt->fields[$Ind_sql + 1];
                      }
                      $Str_arg_sum = $this->Ini->Get_date_arg_sum($val_sql, $Format_tst, $cmp_sql_def[$Cada_dim], true);
                      $Str_arg_sql = ($Str_arg_sum == " is null") ? $cmp_sql_def[$Cada_dim] : $this->Ini->Get_sql_date_groupby($cmp_sql_def[$Cada_dim], $Format_tst);
                  }
                  elseif (isset($cmp_sql_tp_num[$Cada_dim]))
                  {
                      $Str_arg_sql = $cmp_sql_def[$Cada_dim];
                      $Str_arg_sum = " = " . $rt->fields[$Ind_sql];
                  }
                  else
                  {
                      $Str_arg_sql = $cmp_sql_def[$Cada_dim];
                      $Str_arg_sum = " = " . $this->Db->qstr($rt->fields[$Ind_sql]);
                  }
                  $sql_where .= (!empty($sql_where)) ? " and " : "";
                  $sql_where .= $Str_arg_sql . $Str_arg_sum;
              }
          }
          if ($Tem_estat_manual)
          {
              $where_ok = (empty($this->sc_where_atual)) ? " where " . $sql_where : $this->sc_where_atual . " and " . $sql_where;
              $vl_statistic = $this->Calc_statist_manual_groupbywitel($where_ok);
              foreach ($vl_statistic as $ind => $val)
              {
                  $rt->fields[$ind] = $val;
              }
          }
          $rt->fields[1] = str_replace(",", ".", $rt->fields[1]);
          $rt->fields[1] = (strpos(strtolower($rt->fields[1]), "e")) ? (float)$rt->fields[1] : $rt->fields[1]; 
          $rt->fields[1] = (string)$rt->fields[1];
          if ($rt->fields[1] == "") 
          {
              $rt->fields[1] = 0;
          }
          if (substr($rt->fields[1], 0, 1) == ".") 
          {
              $rt->fields[1] = "0" . $rt->fields[1];
          }
          if (substr($rt->fields[1], 0, 2) == "-.") 
          {
              $rt->fields[1] = "-0" . substr($rt->fields[1], 1);
          }
          nmgp_Trunc_Num($rt->fields[1], 0);
          $str_tot = "array_total_" . $cmp_tot;
          if (!isset($this->$str_tot))
          {
              $this->$str_tot = array();
          }
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[0]";
          eval ('$this->' . $str_tot . ' = ' . $rt->fields[0] . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[1]";
          eval('$this->' . $str_tot . ' = ' . $rt->fields[1] . ';');
          $str_grf = "val_grafico_" . $cmp_tot;
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[2]";
          eval ('$this->' . $str_tot . ' = $' . $str_grf . ';');
          $str_tot = "array_total_" . $cmp_tot . $arr_tots . "[3]";
          $str_org = $cmp_tot . "_orig";
          eval ('$this->' . $str_tot . ' = $' . $str_org . ';');
          eval ('ksort($this->array_total_' . $cmp_tot . $arr_tots . ');');
          $rt->MoveNext();
      }
      $rt->Close();
   }
   function Ajust_statistic($comando)
   {
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_vfp) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_odbc))
      {
          $comando = str_replace(array('count(distinct ','varp(','stdevp(','variance(','stddev('), array('sum(','sum(','sum(','sum(','sum('), $comando);
      }
      if ($this->Ini->nm_tp_variance == "P")
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          { 
              $comando = str_replace(array('count(distinct ','varp(','stdevp('), array('count(','var(','stdev('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite) && $this->Ini->sqlite_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) && $this->Ini->Ibase_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          {
                  $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
      }
      if ($this->Ini->nm_tp_variance == "A")
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          { 
              $comando = str_replace(array('count(distinct ','varp(','stdevp('), array('count(','var(','stdev('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite) && $this->Ini->sqlite_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) && $this->Ini->Ibase_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          {
                  $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $comando = str_replace(array('varp(','stdevp('), array('var(','stdev('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $comando = str_replace('stddev(', 'stdev(', $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $comando = str_replace(array('variance(','stddev('), array('variance_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
      }
      return $comando;
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
