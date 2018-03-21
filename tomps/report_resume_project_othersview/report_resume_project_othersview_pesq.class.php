<?php

class report_resume_project_othersview_pesq
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $cmp_formatado;
   var $nm_data;
   var $Campos_Mens_erro;

   var $comando;
   var $comando_sum;
   var $comando_filtro;
   var $comando_ini;
   var $comando_fim;
   var $NM_operador;
   var $NM_data_qp;
   var $NM_path_filter;
   var $NM_curr_fil;
   var $nm_location;
   var $nmgp_botoes = array();
   var $NM_fil_ant = array();

   /**
    * @access  public
    */
   function __construct()
   {
   }

   /**
    * @access  public
    * @global  string  $bprocessa  
    */
   function monta_busca()
   {
      global $bprocessa;
      include("../_lib/css/" . $this->Ini->str_schema_filter . "_filter.php");
      $this->Ini->Str_btn_filter = "scriptcase8_WhiteSmoke/scriptcase8_WhiteSmoke" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_filter_css  = "scriptcase8_WhiteSmoke/scriptcase8_WhiteSmoke.css";
      include($this->Ini->path_btn . $this->Ini->Str_btn_filter);
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['path_libs_php'] = $this->Ini->path_lib_php;
      $this->Img_sep_filter = "/" . trim($str_toolbar_separator);
      $this->Block_img_col  = trim($str_block_col);
      $this->Block_img_exp  = trim($str_block_exp);
      $this->Bubble_tail    = trim($str_bubble_tail);
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_config_btn.php", "F", "nmButtonOutput"); 
      $this->init();
      if ($this->NM_ajax_flag)
      {
          ob_start();
          $this->Arr_result = array();
          $this->processa_ajax();
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          if ($this->Db)
          {
              $this->Db->Close(); 
          }
          exit;
      }
      if (isset($bprocessa) && "pesq" == $bprocessa)
      {
         $this->processa_busca();
      }
      else
      {
         $this->monta_formulario();
      }
   }

   /**
    * @access  public
    */
   function monta_formulario()
   {
      $this->monta_html_ini();
      $this->monta_form();
      $this->monta_html_fim();
   }

   /**
    * @access  public
    */
   function init()
   {
      global $bprocessa;
      $_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                  $this->Ini->Nm_lang['lang_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_mnth_june'],
                                  $this->Ini->Nm_lang['lang_mnth_july'],
                                  $this->Ini->Nm_lang['lang_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_june'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_july'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                  $this->Ini->Nm_lang['lang_days_sund'],
                                  $this->Ini->Nm_lang['lang_days_mond'],
                                  $this->Ini->Nm_lang['lang_days_tued'],
                                  $this->Ini->Nm_lang['lang_days_wend'],
                                  $this->Ini->Nm_lang['lang_days_thud'],
                                  $this->Ini->Nm_lang['lang_days_frid'],
                                  $this->Ini->Nm_lang['lang_days_satd']);
      $_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_days_sund'],
                                  $this->Ini->Nm_lang['lang_shrt_days_mond'],
                                  $this->Ini->Nm_lang['lang_shrt_days_tued'],
                                  $this->Ini->Nm_lang['lang_shrt_days_wend'],
                                  $this->Ini->Nm_lang['lang_shrt_days_thud'],
                                  $this->Ini->Nm_lang['lang_shrt_days_frid'],
                                  $this->Ini->Nm_lang['lang_shrt_days_satd']);
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_functions.php", "", "") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->nm_data = new nm_data("en_us");
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $this->NM_path_filter = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/filters/";
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['opcao'] = "igual";
   }

   function processa_ajax()
   {
      global $NM_filters, $NM_filters_del, $nmgp_save_name, $nmgp_save_option, $NM_fields_refresh, $NM_parms_refresh, $Campo_bi, $Opc_bi, $NM_operador;
//-- ajax metodos ---
      if ($this->NM_ajax_opcao == "ajax_filter_save")
      {
          ob_end_clean();
          ob_end_clean();
          $this->salva_filtro();
          $this->NM_fil_ant = $this->gera_array_filtros();
          $Nome_filter = "";
          $Opt_filter  = "<option value=\"\"></option>\r\n";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              if ($_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Tipo_filter[1] = sc_convert_encoding($Tipo_filter[1], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  $Opt_filter .= "<option value=\"\">" . report_resume_project_othersview_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . report_resume_project_othersview_pack_protect_string($Tipo_filter[0]) . "\">.." . report_resume_project_othersview_pack_protect_string($Cada_filter) .  "</option>\r\n";
          }
          $Ajax_select  = "<SELECT id=\"sel_recup_filters_bot\" name=\"NM_filters_bot\" onChange=\"nm_submit_filter(this, 'bot')\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_bot", 'value' => $Ajax_select);
          $Ajax_select = "<SELECT id=\"sel_filters_del_bot\" name=\"NM_filters_del_bot\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_del_bot", 'value' => $Ajax_select);
      }

      if ($this->NM_ajax_opcao == "ajax_filter_delete")
      {
          ob_end_clean();
          ob_end_clean();
          $this->apaga_filtro();
          $this->NM_fil_ant = $this->gera_array_filtros();
          $Nome_filter = "";
          $Opt_filter  = "<option value=\"\"></option>\r\n";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              if ($_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Tipo_filter[1] = sc_convert_encoding($Tipo_filter[1], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter  = $Tipo_filter[1];
                  $Opt_filter .= "<option value=\"\">" .  report_resume_project_othersview_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . report_resume_project_othersview_pack_protect_string($Tipo_filter[0]) . "\">.." . report_resume_project_othersview_pack_protect_string($Cada_filter) .  "</option>\r\n";
          }
          $Ajax_select  = "<SELECT id=\"sel_recup_filters_bot\" name=\"NM_filters_bot\" onChange=\"nm_submit_filter(this, 'bot')\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_bot", 'value' => $Ajax_select);
          $Ajax_select = "<SELECT id=\"sel_filters_del_bot\" name=\"NM_filters_del_bot\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_del_bot", 'value' => $Ajax_select);
      }
      if ($this->NM_ajax_opcao == "ajax_filter_select")
      {
          $this->Arr_result = $this->recupera_filtro();
      }

      if ($this->NM_ajax_opcao == 'autocomp_tp_batch')
      {
          $tp_batch = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tp_batch($tp_batch);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_tp_jenisproject')
      {
          $tp_jenisproject = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tp_jenisproject($tp_jenisproject);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_tp_prjtrelease')
      {
          $tp_prjtrelease = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tp_prjtrelease($tp_prjtrelease);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_tp_templateproject')
      {
          $tp_templateproject = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tp_templateproject($tp_templateproject);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_tp_status')
      {
          $tp_status = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tp_status($tp_status);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_tp_divre')
      {
          $tp_divre = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tp_divre($tp_divre);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_tp_witel')
      {
          $tp_witel = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tp_witel($tp_witel);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_tp_datel')
      {
          $tp_datel = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tp_datel($tp_datel);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_tp_mitra')
      {
          $tp_mitra = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tp_mitra($tp_mitra);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
   }
   function lookup_ajax_tp_batch($tp_batch)
   {
      $tp_batch = substr($this->Db->qstr($tp_batch), 1, -1);
            $tp_batch_look = substr($this->Db->qstr($tp_batch), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct TP_BATCH from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and  TP_BATCH like '%" . $tp_batch . "%' order by TP_BATCH"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_tp_jenisproject($tp_jenisproject)
   {
      $tp_jenisproject = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $tp_jenisproject);
      $tp_jenisproject = substr($this->Db->qstr($tp_jenisproject), 1, -1);
            $tp_jenisproject_look = substr($this->Db->qstr($tp_jenisproject), 1, -1); 
      $nmgp_def_dados = array(); 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_JENISPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and   CAST (TP_JENISPROJECT AS TEXT)  like '%" . $tp_jenisproject . "%' order by TP_JENISPROJECT"; 
      }
      else
      {
          $nm_comando = "select distinct TP_JENISPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and  TP_JENISPROJECT like '%" . $tp_jenisproject . "%' order by TP_JENISPROJECT"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_tp_prjtrelease($tp_prjtrelease)
   {
      $tp_prjtrelease = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $tp_prjtrelease);
      $tp_prjtrelease = substr($this->Db->qstr($tp_prjtrelease), 1, -1);
            $tp_prjtrelease_look = substr($this->Db->qstr($tp_prjtrelease), 1, -1); 
      $nmgp_def_dados = array(); 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_PRJTRELEASE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and   CAST (TP_PRJTRELEASE AS TEXT)  like '%" . $tp_prjtrelease . "%' order by TP_PRJTRELEASE"; 
      }
      else
      {
          $nm_comando = "select distinct TP_PRJTRELEASE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and  TP_PRJTRELEASE like '%" . $tp_prjtrelease . "%' order by TP_PRJTRELEASE"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_tp_templateproject($tp_templateproject)
   {
      $tp_templateproject = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $tp_templateproject);
      $tp_templateproject = substr($this->Db->qstr($tp_templateproject), 1, -1);
            $tp_templateproject_look = substr($this->Db->qstr($tp_templateproject), 1, -1); 
      $nmgp_def_dados = array(); 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and   CAST (TP_TEMPLATEPROJECT AS TEXT)  like '%" . $tp_templateproject . "%' order by TP_TEMPLATEPROJECT"; 
      }
      else
      {
          $nm_comando = "select distinct TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and  TP_TEMPLATEPROJECT like '%" . $tp_templateproject . "%' order by TP_TEMPLATEPROJECT"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_tp_status($tp_status)
   {
      $tp_status = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $tp_status);
      $tp_status = substr($this->Db->qstr($tp_status), 1, -1);
            $tp_status_look = substr($this->Db->qstr($tp_status), 1, -1); 
      $nmgp_def_dados = array(); 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_STATUS from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and   CAST (TP_STATUS AS TEXT)  like '%" . $tp_status . "%' order by TP_STATUS"; 
      }
      else
      {
          $nm_comando = "select distinct TP_STATUS from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and  TP_STATUS like '%" . $tp_status . "%' order by TP_STATUS"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_tp_divre($tp_divre)
   {
      $tp_divre = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $tp_divre);
      $tp_divre = substr($this->Db->qstr($tp_divre), 1, -1);
            $tp_divre_look = substr($this->Db->qstr($tp_divre), 1, -1); 
      $nmgp_def_dados = array(); 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_DIVRE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and   CAST (TP_DIVRE AS TEXT)  like '%" . $tp_divre . "%' order by TP_DIVRE"; 
      }
      else
      {
          $nm_comando = "select distinct TP_DIVRE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and  TP_DIVRE like '%" . $tp_divre . "%' order by TP_DIVRE"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_tp_witel($tp_witel)
   {
      $tp_witel = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $tp_witel);
      $tp_witel = substr($this->Db->qstr($tp_witel), 1, -1);
            $tp_witel_look = substr($this->Db->qstr($tp_witel), 1, -1); 
      $nmgp_def_dados = array(); 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_WITEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and   CAST (TP_WITEL AS TEXT)  like '%" . $tp_witel . "%' order by TP_WITEL"; 
      }
      else
      {
          $nm_comando = "select distinct TP_WITEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and  TP_WITEL like '%" . $tp_witel . "%' order by TP_WITEL"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_tp_datel($tp_datel)
   {
      $tp_datel = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $tp_datel);
      $tp_datel = substr($this->Db->qstr($tp_datel), 1, -1);
            $tp_datel_look = substr($this->Db->qstr($tp_datel), 1, -1); 
      $nmgp_def_dados = array(); 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_DATEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and   CAST (TP_DATEL AS TEXT)  like '%" . $tp_datel . "%' order by TP_DATEL"; 
      }
      else
      {
          $nm_comando = "select distinct TP_DATEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and  TP_DATEL like '%" . $tp_datel . "%' order by TP_DATEL"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_tp_mitra($tp_mitra)
   {
      $tp_mitra = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $tp_mitra);
      $tp_mitra = substr($this->Db->qstr($tp_mitra), 1, -1);
            $tp_mitra_look = substr($this->Db->qstr($tp_mitra), 1, -1); 
      $nmgp_def_dados = array(); 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_MITRA from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and   CAST (TP_MITRA AS TEXT)  like '%" . $tp_mitra . "%' order by TP_MITRA"; 
      }
      else
      {
          $nm_comando = "select distinct TP_MITRA from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and  TP_MITRA like '%" . $tp_mitra . "%' order by TP_MITRA"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   

   /**
    * @access  public
    */
   function processa_busca()
   {
      $this->inicializa_vars();
      $this->trata_campos();
      if (!empty($this->Campos_Mens_erro)) 
      {
          scriptcase_error_display($this->Campos_Mens_erro, ""); 
          $this->monta_formulario();
      }
      else
      {
          $this->finaliza_resultado();
      }
   }

   /**
    * @access  public
    */
   function and_or()
   {
      $posWhere = strpos(strtolower($this->comando), "where");
      if (FALSE === $posWhere)
      {
         $this->comando     .= " where (";
         $this->comando_sum .= " and (";
         $this->comando_fim  = " ) ";
      }
      if ($this->comando_ini == "ini")
      {
          if (FALSE !== $posWhere)
          {
              $this->comando     .= " and ( ";
              $this->comando_sum .= " and ( ";
              $this->comando_fim  = " ) ";
          }
         $this->comando_ini  = "";
      }
      elseif ("or" == $this->NM_operador)
      {
         $this->comando        .= " or ";
         $this->comando_sum    .= " or ";
         $this->comando_filtro .= " or ";
      }
      else
      {
         $this->comando        .= " and ";
         $this->comando_sum    .= " and ";
         $this->comando_filtro .= " and ";
      }
   }

   /**
    * @access  public
    * @param  string  $nome  
    * @param  string  $condicao  
    * @param  mixed  $campo  
    * @param  mixed  $campo2  
    * @param  string  $nome_campo  
    * @param  string  $tp_campo  
    * @global  array  $nmgp_tab_label  
    */
   function monta_condicao($nome, $condicao, $campo, $campo2 = "", $nome_campo="", $tp_campo="")
   {
      global $nmgp_tab_label;
      $condicao   = strtoupper($condicao);
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $Nm_numeric = array();
      $nm_esp_postgres = array();
      $nm_ini_lower = "";
      $nm_fim_lower = "";
      $Nm_numeric[] = "tp_id";$Nm_numeric[] = "tp_mitra";$Nm_numeric[] = "tp_witel";$Nm_numeric[] = "tp_sto";$Nm_numeric[] = "tp_odp";$Nm_numeric[] = "tp_status";$Nm_numeric[] = "tp_templateproject";$Nm_numeric[] = "tp_jenisproject";$Nm_numeric[] = "tp_prjtrelease";$Nm_numeric[] = "tp_targetwaktu";$Nm_numeric[] = "tp_datel";$Nm_numeric[] = "tp_divre";$Nm_numeric[] = "tp_nilai";$Nm_numeric[] = "tp_rab";$Nm_numeric[] = "tp_jmldistribusi";$Nm_numeric[] = "tp_taskaktif_number";$Nm_numeric[] = "tp_prosentase";$Nm_numeric[] = "tp_taskaktifstatus";$Nm_numeric[] = "grouptaskaktif";
      $campo_join = strtolower(str_replace(".", "_", $nome));
      if (in_array($campo_join, $Nm_numeric))
      {
          if ($condicao == "EP" || $condicao == "NE")
          {
              return;
          }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['decimal_db'] == ".")
         {
            $nm_aspas  = "";
            $nm_aspas1 = "";
         }
         if ($condicao != "IN")
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['decimal_db'] == ".")
            {
               $campo  = str_replace(",", ".", $campo);
               $campo2 = str_replace(",", ".", $campo2);
            }
            if ($campo == "")
            {
               $campo = 0;
            }
            if ($campo2 == "")
            {
               $campo2 = 0;
            }
         }
      }
      $Nm_datas[] = "TP_PLANSTART";$Nm_datas[] = "TP_PLANFINISH";$Nm_datas[] = "TP_ENTRYDATE";$Nm_datas[] = "TP_UPDATEDATE";$Nm_datas[] = "TP_ACTUALSTART";$Nm_datas[] = "TP_ACTUALFINISH";$Nm_datas[] = "TP_ISCHANGETEMPDATE";$Nm_datas[] = "TP_TASKAKTIFPLANSTART";$Nm_datas[] = "TP_TASKAKTIFPLANFINISH";
      if (in_array($campo_join, $Nm_datas))
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['SC_sep_date1'];
          }
      }
      if ($campo == "" && $condicao != "NU" && $condicao != "NN" && $condicao != "EP" && $condicao != "NE")
      {
         return;
      }
      else
      {
         $tmp_pos = strpos($campo, "##@@");
         if ($tmp_pos === false)
         {
             $res_lookup = $campo;
         }
         else
         {
             $res_lookup = substr($campo, $tmp_pos + 4);
             $campo = substr($campo, 0, $tmp_pos);
             if ($campo == "" && $condicao != "NU" && $condicao != "NN" && $condicao != "EP" && $condicao != "NE")
             {
                 return;
             }
         }
         $tmp_pos = strpos($this->cmp_formatado[$nome_campo], "##@@");
         if ($tmp_pos !== false)
         {
             $this->cmp_formatado[$nome_campo] = substr($this->cmp_formatado[$nome_campo], $tmp_pos + 4);
         }
         $this->and_or();
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $campo2 = substr($this->Db->qstr($campo2), 1, -1);
         $nome_sum = "AKSESSMR.V_TABLE_PROJECT.$nome";
         if ($tp_campo == "TIMESTAMP")
         {
             $tp_campo = "DATETIME";
         }
         if (in_array($campo_join, $Nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "II" || $condicao == "QP" || $condicao == "NP"))
         {
             $nome     = "CAST ($nome AS TEXT)";
             $nome_sum = "CAST ($nome_sum AS TEXT)";
         }
         if (in_array($campo_join, $nm_esp_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
         {
             $nome     = "CAST ($nome AS TEXT)";
             $nome_sum = "CAST ($nome_sum AS TEXT)";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD hh24:mi:ss')";
             }
         }
         elseif (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD')";
             }
         }
         elseif (substr($tp_campo, 0, 4) == "TIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'hh24:mi:ss')";
             }
         }
         if (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase) && !$this->Date_part)
         {
             $nome     = "str_replace (convert(char(10),$nome,102), '.', '-') + ' ' + convert(char(8),$nome,20)";
             $nome_sum = "str_replace (convert(char(10),$nome_sum,102), '.', '-') + ' ' + convert(char(8),$nome_sum,20)";
         }
         if ($tp_campo == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "convert(char(10),$nome,121)";
                 $nome_sum = "convert(char(10),$nome_sum,121)";
             }
         }
         if ($tp_campo == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "convert(char(19),$nome,121)";
                 $nome_sum = "convert(char(19),$nome_sum,121)";
             }
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) && !$this->Date_part)
         {
             $nome     = "TO_DATE(TO_CHAR($nome, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
             $nome_sum = "TO_DATE(TO_CHAR($nome_sum, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
             $tp_campo = "DATETIME";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix) && !$this->Date_part)
         {
             $nome     = "EXTEND($nome, YEAR TO FRACTION)";
             $nome_sum = "EXTEND($nome_sum, YEAR TO FRACTION)";
         }
         elseif (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix) && !$this->Date_part)
         {
             $nome     = "EXTEND($nome, YEAR TO DAY)";
             $nome_sum = "EXTEND($nome_sum, YEAR TO DAY)";
         }
         switch ($condicao)
         {
            case "EQ":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " = " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower. " = " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
            break;
            case "II":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " like '" . $campo . "%'";
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " like '" . $campo . "%'";
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " like '" . $campo . "%'";
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
            break;
             case "QP";     // 
             case "NP";     // 
                $concat = " " . $this->NM_operador . " ";
                if ($condicao == "QP")
                {
                    $op_all    = " like ";
                    $lang_like = $this->Ini->Nm_lang['lang_srch_like'];
                }
                else
                {
                    $op_all    = " not like ";
                    $lang_like = $this->Ini->Nm_lang['lang_srch_not_like'];
                }
               $NM_cond    = "";
               $NM_cmd     = "";
               $NM_cmd_sum = "";
               if (substr($tp_campo, 0, 4) == "DATE" && $this->Date_part)
               {
                   if ($this->NM_data_qp['ano'] != "____")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_year'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['ano'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%Y', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%Y', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(year from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(year from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('year' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('year' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(year from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(year from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'YYYY')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'YYYY')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(year, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(year, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "year(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "year(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['mes'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_mnth'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['mes'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%m', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%m', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(month from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(month from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('month' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('month' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(month from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(month from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'MM')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'MM')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(month, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(month, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "month(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "month(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['dia'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_days'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['dia'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%d', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%d', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(day from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(day from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('day' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('day' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(day from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(day from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'DD')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'DD')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(day, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(day, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "day(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "day(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                   }
               }
               if (strpos($tp_campo, "TIME") !== false && $this->Date_part)
               {
                   if ($this->NM_data_qp['hor'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_time'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['hor'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%H', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%H', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(hour from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(hour from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('hour' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('hour' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(hour from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(hour from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'HH24')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'HH24')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(hour, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(hour, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "hour(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "hour(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['min'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_mint'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['min'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%M', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%M', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(minute from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(minute from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('minute' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('minute' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(minute from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(minute from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'MI')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'MI')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(minute, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(minute, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "minute(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "minute(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['seg'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_scnd'] . " " . $this->Lang_date_part . " " . $this->NM_data_qp['seg'];
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%S', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%S', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(second from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(second from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('second' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('second' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(second from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(second from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'SS')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'SS')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(second, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(second, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       else
                       {
                           $NM_cmd     .= "second(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "second(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                   }
               }
               if ($this->Date_part)
               {
                   if (!empty($NM_cmd))
                   {
                       $NM_cmd     = " (" . $NM_cmd . ")";
                       $NM_cmd_sum = " (" . $NM_cmd_sum . ")";
                       $this->comando        .= $NM_cmd;
                       $this->comando_sum    .= $NM_cmd_sum;
                       $this->comando_filtro .= $NM_cmd;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . ": " . $NM_cond . "##*@@";
                   }
               }
               else
               {
                   $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . "'%" . $campo . "%'";
                   $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . $op_all . "'%" . $campo . "%'";
                   $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . "'%" . $campo . "%'";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $lang_like . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
               }
            break;
            case "DF":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " <> " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
            break;
            case "GT":     // 
               $this->comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
            break;
            case "GE":     // 
               $this->comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
            break;
            case "LT":     // 
               $this->comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
            break;
            case "LE":     // 
               $this->comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo] . "##*@@";
            break;
            case "BW":     // 
               $this->comando        .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_filtro .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"] . "##*@@";
            break;
            case "IN":     // 
               $nm_sc_valores = explode(",", $campo);
               $cond_str = "";
               $nm_cond  = "";
               if (!empty($nm_sc_valores))
               {
                   foreach ($nm_sc_valores as $nm_sc_valor)
                   {
                      if (in_array($campo_join, $Nm_numeric) && substr_count($nm_sc_valor, ".") > 1)
                      {
                         $nm_sc_valor = str_replace(".", "", $nm_sc_valor);
                      }
                      if ("" != $cond_str)
                      {
                         $cond_str .= ",";
                         $nm_cond  .= " " . $this->Ini->Nm_lang['lang_srch_orr_cond'] . " ";
                      }
                      $cond_str .= $nm_aspas . $nm_sc_valor . $nm_aspas1;
                      $nm_cond  .= $nm_aspas . $nm_sc_valor . $nm_aspas1;
                   }
               }
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_like'] . " " . $nm_cond . "##*@@";
            break;
            case "NU":     // 
               $this->comando        .= " $nome IS NULL ";
               $this->comando_sum    .= " $nome_sum IS NULL ";
               $this->comando_filtro .= " $nome IS NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_null'] . "##*@@";
            break;
            case "NN":     // 
               $this->comando        .= " $nome IS NOT NULL ";
               $this->comando_sum    .= " $nome_sum IS NOT NULL ";
               $this->comando_filtro .= " $nome IS NOT NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
            break;
            case "EP":     // 
               $this->comando        .= " $nome = '' ";
               $this->comando_sum    .= " $nome_sum = '' ";
               $this->comando_filtro .= " $nome = '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_empty'] . "##*@@";
            break;
            case "NE":     // 
               $this->comando        .= " $nome <> '' ";
               $this->comando_sum    .= " $nome_sum <> '' ";
               $this->comando_filtro .= " $nome <> '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
            break;
         }
      }
   }

   function nm_prep_date(&$val, $tp, $tsql, &$cond, $format_nd, $tp_nd)
   {
       $fill_dt = false;
       if ($tsql == "TIMESTAMP")
       {
           $tsql = "DATETIME";
       }
       $cond = strtoupper($cond);
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access) && $tp != "ND")
       {
           if ($cond == "EP")
           {
               $cond = "NU";
           }
           if ($cond == "NE")
           {
               $cond = "NN";
           }
       }
       if ($cond == "NU" || $cond == "NN" || $cond == "EP" || $cond == "NE")
       {
           $val    = array();
           $val[0] = "";
           return;
       }
       if ($cond != "II" && $cond != "QP" && $cond != "NP")
       {
           $fill_dt = true;
       }
       if ($fill_dt)
       {
           $val[0]['dia'] = (!empty($val[0]['dia']) && strlen($val[0]['dia']) == 1) ? "0" . $val[0]['dia'] : $val[0]['dia'];
           $val[0]['mes'] = (!empty($val[0]['mes']) && strlen($val[0]['mes']) == 1) ? "0" . $val[0]['mes'] : $val[0]['mes'];
           if ($tp == "DH")
           {
               $val[0]['hor'] = (!empty($val[0]['hor']) && strlen($val[0]['hor']) == 1) ? "0" . $val[0]['hor'] : $val[0]['hor'];
               $val[0]['min'] = (!empty($val[0]['min']) && strlen($val[0]['min']) == 1) ? "0" . $val[0]['min'] : $val[0]['min'];
               $val[0]['seg'] = (!empty($val[0]['seg']) && strlen($val[0]['seg']) == 1) ? "0" . $val[0]['seg'] : $val[0]['seg'];
           }
           if ($cond == "BW")
           {
               $val[1]['dia'] = (!empty($val[1]['dia']) && strlen($val[1]['dia']) == 1) ? "0" . $val[1]['dia'] : $val[1]['dia'];
               $val[1]['mes'] = (!empty($val[1]['mes']) && strlen($val[1]['mes']) == 1) ? "0" . $val[1]['mes'] : $val[1]['mes'];
               if ($tp == "DH")
               {
                   $val[1]['hor'] = (!empty($val[1]['hor']) && strlen($val[1]['hor']) == 1) ? "0" . $val[1]['hor'] : $val[1]['hor'];
                   $val[1]['min'] = (!empty($val[1]['min']) && strlen($val[1]['min']) == 1) ? "0" . $val[1]['min'] : $val[1]['min'];
                   $val[1]['seg'] = (!empty($val[1]['seg']) && strlen($val[1]['seg']) == 1) ? "0" . $val[1]['seg'] : $val[1]['seg'];
               }
           }
       }
       if ($cond == "BW")
       {
           $this->NM_data_1 = array();
           $this->NM_data_1['ano'] = (isset($val[0]['ano']) && !empty($val[0]['ano'])) ? $val[0]['ano'] : "____";
           $this->NM_data_1['mes'] = (isset($val[0]['mes']) && !empty($val[0]['mes'])) ? $val[0]['mes'] : "__";
           $this->NM_data_1['dia'] = (isset($val[0]['dia']) && !empty($val[0]['dia'])) ? $val[0]['dia'] : "__";
           $this->NM_data_1['hor'] = (isset($val[0]['hor']) && !empty($val[0]['hor'])) ? $val[0]['hor'] : "__";
           $this->NM_data_1['min'] = (isset($val[0]['min']) && !empty($val[0]['min'])) ? $val[0]['min'] : "__";
           $this->NM_data_1['seg'] = (isset($val[0]['seg']) && !empty($val[0]['seg'])) ? $val[0]['seg'] : "__";
           $this->data_menor($this->NM_data_1);
           $this->NM_data_2 = array();
           $this->NM_data_2['ano'] = (isset($val[1]['ano']) && !empty($val[1]['ano'])) ? $val[1]['ano'] : "____";
           $this->NM_data_2['mes'] = (isset($val[1]['mes']) && !empty($val[1]['mes'])) ? $val[1]['mes'] : "__";
           $this->NM_data_2['dia'] = (isset($val[1]['dia']) && !empty($val[1]['dia'])) ? $val[1]['dia'] : "__";
           $this->NM_data_2['hor'] = (isset($val[1]['hor']) && !empty($val[1]['hor'])) ? $val[1]['hor'] : "__";
           $this->NM_data_2['min'] = (isset($val[1]['min']) && !empty($val[1]['min'])) ? $val[1]['min'] : "__";
           $this->NM_data_2['seg'] = (isset($val[1]['seg']) && !empty($val[1]['seg'])) ? $val[1]['seg'] : "__";
           $this->data_maior($this->NM_data_2);
           $val = array();
           if ($tp == "ND")
           {
               $out_dt1 = $format_nd;
               $out_dt1 = str_replace("yyyy", $this->NM_data_1['ano'], $out_dt1);
               $out_dt1 = str_replace("mm",   $this->NM_data_1['mes'], $out_dt1);
               $out_dt1 = str_replace("dd",   $this->NM_data_1['dia'], $out_dt1);
               $out_dt1 = str_replace("hh",   "", $out_dt1);
               $out_dt1 = str_replace("ii",   "", $out_dt1);
               $out_dt1 = str_replace("ss",   "", $out_dt1);
               $out_dt2 = $format_nd;
               $out_dt2 = str_replace("yyyy", $this->NM_data_2['ano'], $out_dt2);
               $out_dt2 = str_replace("mm",   $this->NM_data_2['mes'], $out_dt2);
               $out_dt2 = str_replace("dd",   $this->NM_data_2['dia'], $out_dt2);
               $out_dt2 = str_replace("hh",   "", $out_dt2);
               $out_dt2 = str_replace("ii",   "", $out_dt2);
               $out_dt2 = str_replace("ss",   "", $out_dt2);
               $val[0] = $out_dt1;
               $val[1] = $out_dt2;
               return;
           }
           if ($tsql == "TIME")
           {
               $val[0] = $this->NM_data_1['hor'] . ":" . $this->NM_data_1['min'] . ":" . $this->NM_data_1['seg'];
               $val[1] = $this->NM_data_2['hor'] . ":" . $this->NM_data_2['min'] . ":" . $this->NM_data_2['seg'];
           }
           elseif (substr($tsql, 0, 4) == "DATE")
           {
               $val[0] = $this->NM_data_1['ano'] . "-" . $this->NM_data_1['mes'] . "-" . $this->NM_data_1['dia'];
               $val[1] = $this->NM_data_2['ano'] . "-" . $this->NM_data_2['mes'] . "-" . $this->NM_data_2['dia'];
               if (strpos($tsql, "TIME") !== false)
               {
                   $val[0] .= " " . $this->NM_data_1['hor'] . ":" . $this->NM_data_1['min'] . ":" . $this->NM_data_1['seg'];
                   $val[1] .= " " . $this->NM_data_2['hor'] . ":" . $this->NM_data_2['min'] . ":" . $this->NM_data_2['seg'];
               }
           }
           return;
       }
       $this->NM_data_qp = array();
       $this->NM_data_qp['ano'] = (isset($val[0]['ano']) && $val[0]['ano'] != "") ? $val[0]['ano'] : "____";
       $this->NM_data_qp['mes'] = (isset($val[0]['mes']) && $val[0]['mes'] != "") ? $val[0]['mes'] : "__";
       $this->NM_data_qp['dia'] = (isset($val[0]['dia']) && $val[0]['dia'] != "") ? $val[0]['dia'] : "__";
       $this->NM_data_qp['hor'] = (isset($val[0]['hor']) && $val[0]['hor'] != "") ? $val[0]['hor'] : "__";
       $this->NM_data_qp['min'] = (isset($val[0]['min']) && $val[0]['min'] != "") ? $val[0]['min'] : "__";
       $this->NM_data_qp['seg'] = (isset($val[0]['seg']) && $val[0]['seg'] != "") ? $val[0]['seg'] : "__";
       if ($tp != "ND" && ($cond == "LE" || $cond == "LT" || $cond == "GE" || $cond == "GT"))
       {
           $count_fill = 0;
           foreach ($this->NM_data_qp as $x => $tx)
           {
               if (substr($tx, 0, 2) != "__")
               {
                   $count_fill++;
               }
           }
           if ($count_fill > 1)
           {
               if ($cond == "LE" || $cond == "GT")
               {
                   $this->data_maior($this->NM_data_qp);
               }
               else
               {
                   $this->data_menor($this->NM_data_qp);
               }
               if ($tsql == "TIME")
               {
                   $val[0] = $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
               }
               elseif (substr($tsql, 0, 4) == "DATE")
               {
                   $val[0] = $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
                   if (strpos($tsql, "TIME") !== false)
                   {
                       $val[0] .= " " . $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
                   }
               }
               return;
           }
       }
       foreach ($this->NM_data_qp as $x => $tx)
       {
           if (substr($tx, 0, 2) == "__" && ($x == "dia" || $x == "mes" || $x == "ano"))
           {
               if (substr($tsql, 0, 4) == "DATE")
               {
                   $this->Date_part = true;
                   break;
               }
           }
           if (substr($tx, 0, 2) == "__" && ($x == "hor" || $x == "min" || $x == "seg"))
           {
               if (strpos($tsql, "TIME") !== false && ($tp == "DH" || ($tp == "DT" && $cond != "LE" && $cond != "LT" && $cond != "GE" && $cond != "GT")))
               {
                   $this->Date_part = true;
                   break;
               }
           }
       }
       if ($this->Date_part)
       {
           $this->Ini_date_part = "";
           $this->End_date_part = "";
           $this->Ini_date_char = "";
           $this->End_date_char = "";
           if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $this->Ini_date_part = "'";
               $this->End_date_part = "'";
           }
           if ($tp != "ND")
           {
               if ($cond == "EQ")
               {
                   $this->Operador_date_part = " = ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_equl'];
               }
               elseif ($cond == "II")
               {
                   $this->Operador_date_part = " like ";
                   $this->Ini_date_part = "'";
                   $this->End_date_part = "%'";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_strt'];
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
               elseif ($cond == "DF")
               {
                   $this->Operador_date_part = " <> ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_diff'];
               }
               elseif ($cond == "GT")
               {
                   $this->Operador_date_part = " > ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['pesq_cond_maior'];
               }
               elseif ($cond == "GE")
               {
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_grtr_equl'];
                   $this->Operador_date_part = " >= ";
               }
               elseif ($cond == "LT")
               {
                   $this->Operador_date_part = " < ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_less'];
               }
               elseif ($cond == "LE")
               {
                   $this->Operador_date_part = " <= ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_less_equl'];
               }
               elseif ($cond == "NP")
               {
                   $this->Operador_date_part = " not like ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_diff'];
                   $this->Ini_date_part = "'%";
                   $this->End_date_part = "%'";
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
               else
               {
                   $this->Operador_date_part = " like ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_equl'];
                   $this->Ini_date_part = "'%";
                   $this->End_date_part = "%'";
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
           }
           if ($cond == "DF")
           {
               $cond = "NP";
           }
           if ($cond != "NP")
           {
               $cond = "QP";
           }
       }
       $val = array();
       if ($tp != "ND" && ($cond == "QP" || $cond == "NP"))
       {
           $val[0] = "";
           if (substr($tsql, 0, 4) == "DATE")
           {
               $val[0] .= $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
               if (strpos($tsql, "TIME") !== false)
               {
                   $val[0] .= " ";
               }
           }
           if (strpos($tsql, "TIME") !== false)
           {
               $val[0] .= $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
           }
           return;
       }
       if ($cond == "II" || $cond == "DF" || $cond == "EQ" || $cond == "LT" || $cond == "GE")
       {
           $this->data_menor($this->NM_data_qp);
       }
       else
       {
           $this->data_maior($this->NM_data_qp);
       }
       if ($tsql == "TIME")
       {
           $val[0] = $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
           return;
       }
       $format_sql = "";
       if (substr($tsql, 0, 4) == "DATE")
       {
           $format_sql .= $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
           if (strpos($tsql, "TIME") !== false)
           {
               $format_sql .= " ";
           }
       }
       if (strpos($tsql, "TIME") !== false)
       {
           $format_sql .=  $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
       }
       if ($tp != "ND")
       {
           $val[0] = $format_sql;
           return;
       }
       if ($tp == "ND")
       {
           $format_nd = str_replace("yyyy", $this->NM_data_qp['ano'], $format_nd);
           $format_nd = str_replace("mm",   $this->NM_data_qp['mes'], $format_nd);
           $format_nd = str_replace("dd",   $this->NM_data_qp['dia'], $format_nd);
           $format_nd = str_replace("hh",   $this->NM_data_qp['hor'], $format_nd);
           $format_nd = str_replace("ii",   $this->NM_data_qp['min'], $format_nd);
           $format_nd = str_replace("ss",   $this->NM_data_qp['seg'], $format_nd);
           $val[0] = $format_nd;
           return;
       }
   }
   function data_menor(&$data_arr)
   {
       $data_arr["ano"] = ("____" == $data_arr["ano"]) ? "0001" : $data_arr["ano"];
       $data_arr["mes"] = ("__" == $data_arr["mes"])   ? "01" : $data_arr["mes"];
       $data_arr["dia"] = ("__" == $data_arr["dia"])   ? "01" : $data_arr["dia"];
       $data_arr["hor"] = ("__" == $data_arr["hor"])   ? "00" : $data_arr["hor"];
       $data_arr["min"] = ("__" == $data_arr["min"])   ? "00" : $data_arr["min"];
       $data_arr["seg"] = ("__" == $data_arr["seg"])   ? "00" : $data_arr["seg"];
   }

   function data_maior(&$data_arr)
   {
       $data_arr["ano"] = ("____" == $data_arr["ano"]) ? "9999" : $data_arr["ano"];
       $data_arr["mes"] = ("__" == $data_arr["mes"])   ? "12" : $data_arr["mes"];
       $data_arr["hor"] = ("__" == $data_arr["hor"])   ? "23" : $data_arr["hor"];
       $data_arr["min"] = ("__" == $data_arr["min"])   ? "59" : $data_arr["min"];
       $data_arr["seg"] = ("__" == $data_arr["seg"])   ? "59" : $data_arr["seg"];
       if ("__" == $data_arr["dia"])
       {
           $data_arr["dia"] = "31";
           if ($data_arr["mes"] == "04" || $data_arr["mes"] == "06" || $data_arr["mes"] == "09" || $data_arr["mes"] == "11")
           {
               $data_arr["dia"] = 30;
           }
           elseif ($data_arr["mes"] == "02")
           { 
                if  ($data_arr["ano"] % 4 == 0)
                {
                     $data_arr["dia"] = 29;
                }
                else 
                {
                     $data_arr["dia"] = 28;
                }
           }
       }
   }

   /**
    * @access  public
    * @param  string  $nm_data_hora  
    */
   function limpa_dt_hor_pesq(&$nm_data_hora)
   {
      $nm_data_hora = str_replace("Y", "", $nm_data_hora); 
      $nm_data_hora = str_replace("M", "", $nm_data_hora); 
      $nm_data_hora = str_replace("D", "", $nm_data_hora); 
      $nm_data_hora = str_replace("H", "", $nm_data_hora); 
      $nm_data_hora = str_replace("I", "", $nm_data_hora); 
      $nm_data_hora = str_replace("S", "", $nm_data_hora); 
      $tmp_pos = strpos($nm_data_hora, "--");
      if ($tmp_pos !== FALSE)
      {
          $nm_data_hora = str_replace("--", "-", $nm_data_hora); 
      }
      $tmp_pos = strpos($nm_data_hora, "::");
      if ($tmp_pos !== FALSE)
      {
          $nm_data_hora = str_replace("::", ":", $nm_data_hora); 
      }
   }

   /**
    * @access  public
    */
   function retorna_pesq()
   {
      global $nm_apl_dependente;
   $NM_retorno = "./";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML>
<HEAD>
 <TITLE>Form Filter Data</TITLE>
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
</HEAD>
<BODY class="scGridPage">
<FORM style="display:none;" name="form_ok" method="POST" action="<?php echo $NM_retorno; ?>" target="_self">
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="pesq"> 
</FORM>
<SCRIPT type="text/javascript">
 self.parent.tb_remove();
<?php
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['orig_pesq']) && $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['orig_pesq'] == "res")  
    { 
        echo "parent.nm_gp_move('pesq', '0');";
    } 
    else 
    { 
        echo "parent.nm_gp_submit_ajax('inicio', 'save_grid');";
    } 
?>
</SCRIPT>
</BODY>
</HTML>
<?php
}

   /**
    * @access  public
    */
   function monta_html_ini()
   {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Form Filter Data</TITLE>
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
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_filter.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_filter<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_error.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_error<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Str_btn_filter_css ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_form.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>report_resume_project_othersview/report_resume_project_othersview_fil_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
</HEAD>
<BODY class="scFilterPage">
<?php echo $this->Ini->Ajax_result_set ?>
<SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_js . "/browserSniffer.js" ?>"></SCRIPT>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery/js/jquery.js"></script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/scInput.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/jquery.scInput.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/jquery.scInput2.js"></script>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <script type="text/javascript">var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';</script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></script>
 <script type="text/javascript" src="report_resume_project_othersview_ajax_search.js"></script>
 <script type="text/javascript" src="report_resume_project_othersview_ajax.js"></script>
 <script type="text/javascript">
   var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax ?>';
   var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax ?>';
   var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax ?>';
   var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax ?>';
 </script>
<?php
$Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<div id="id_debug_window" style="display: none; position: absolute; left: 50px; top: 50px"><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo $Cod_Btn ?>&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>
 <SCRIPT type="text/javascript">

<?php
if (is_file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js"))
{
    $Tb_err_js = file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js");
    foreach ($Tb_err_js as $Lines)
    {
        if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Lines = sc_convert_encoding($Lines, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        echo $Lines;
    }
}
 if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
 {
    $Msg_Inval = sc_convert_encoding("Inv�lido", $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
var SC_crit_inv = "<?php echo $Msg_Inval ?>";
var nmdg_Form = "F1";

 $(function() {

   SC_carga_evt_jquery();
   scLoadScInput('input:text.sc-js-input');
 });
var NM_index = 0;
var NM_hidden = new Array();
var NM_IE = (navigator.userAgent.indexOf('MSIE') > -1) ? 1 : 0;
function NM_hitTest(o, l)
{
    function getOffset(o){
        for(var r = {l: o.offsetLeft, t: o.offsetTop, r: o.offsetWidth, b: o.offsetHeight};
            o = o.offsetParent; r.l += o.offsetLeft, r.t += o.offsetTop);
        return r.r += r.l, r.b += r.t, r;
    }
    for(var b, s, r = [], a = getOffset(o), j = isNaN(l.length), i = (j ? l = [l] : l).length; i;
        b = getOffset(l[--i]), (a.l == b.l || (a.l > b.l ? a.l <= b.r : b.l <= a.r))
        && (a.t == b.t || (a.t > b.t ? a.t <= b.b : b.t <= a.b)) && (r[r.length] = l[i]));
    return j ? !!r.length : r;
}
var tem_obj = false;
function NM_show_menu(nn)
{
    if (!NM_IE)
    {
         return;
    }
    x = document.getElementById(nn);
    x.style.display = "block";
    obj_sel = document.body;
    tem_obj = true;
    x.ieFix = NM_hitTest(x, obj_sel.getElementsByTagName("select"));
    for (i = 0; i <  x.ieFix.length; i++)
    {
      if (x.ieFix[i].style.visibility != "hidden")
      {
          x.ieFix[i].style.visibility = "hidden";
          NM_hidden[NM_index] = x.ieFix[i];
          NM_index++;
      }
    }
}
function NM_hide_menu()
{
    if (!NM_IE)
    {
         return;
    }
    obj_del = document.body;
    if (tem_obj && obj_del == obj_sel)
    {
        for(var i = NM_hidden.length; i; NM_hidden[--i].style.visibility = "visible");
    }
    NM_index = 0;
    NM_hidden = new Array();
}
 function nm_campos_between(nm_campo, nm_cond, nm_nome_obj)
 {
  if (nm_cond.value == "bw")
  {
   nm_campo.style.display = "";
  }
  else
  {
    if (nm_campo)
    {
      nm_campo.style.display = "none";
    }
  }
  if (document.getElementById('id_hide_' + nm_nome_obj))
  {
      if (nm_cond.value == "nu" || nm_cond.value == "nn" || nm_cond.value == "ep" || nm_cond.value == "ne")
      {
          document.getElementById('id_hide_' + nm_nome_obj).style.display = 'none';
      }
      else
      {
          document.getElementById('id_hide_' + nm_nome_obj).style.display = '';
      }
  }
 }
 function nm_save_form(pos)
 {
  if (pos == 'top' && document.F1.nmgp_save_name_top.value == '')
  {
      return;
  }
  if (pos == 'bot' && document.F1.nmgp_save_name_bot.value == '')
  {
      return;
  }
  var str_out = "";
  str_out += 'SC_tp_thn_release_cond#NMF#' + search_get_sel_txt('SC_tp_thn_release_cond') + '@NMF@';
  str_out += 'SC_tp_thn_release#NMF#' + search_get_select('SC_tp_thn_release') + '@NMF@';
  str_out += 'SC_tp_batch_cond#NMF#' + search_get_sel_txt('SC_tp_batch_cond') + '@NMF@';
  str_out += 'SC_tp_batch#NMF#' + search_get_text('SC_tp_batch') + '@NMF@';
  str_out += 'id_ac_tp_batch#NMF#' + search_get_text('id_ac_tp_batch') + '@NMF@';
  str_out += 'SC_tp_jenisproject_cond#NMF#' + search_get_sel_txt('SC_tp_jenisproject_cond') + '@NMF@';
  str_out += 'SC_tp_jenisproject#NMF#' + search_get_text('SC_tp_jenisproject') + '@NMF@';
  str_out += 'id_ac_tp_jenisproject#NMF#' + search_get_text('id_ac_tp_jenisproject') + '@NMF@';
  str_out += 'SC_tp_prjtrelease_cond#NMF#' + search_get_sel_txt('SC_tp_prjtrelease_cond') + '@NMF@';
  str_out += 'SC_tp_prjtrelease#NMF#' + search_get_text('SC_tp_prjtrelease') + '@NMF@';
  str_out += 'id_ac_tp_prjtrelease#NMF#' + search_get_text('id_ac_tp_prjtrelease') + '@NMF@';
  str_out += 'SC_tp_templateproject_cond#NMF#' + search_get_sel_txt('SC_tp_templateproject_cond') + '@NMF@';
  str_out += 'SC_tp_templateproject#NMF#' + search_get_text('SC_tp_templateproject') + '@NMF@';
  str_out += 'id_ac_tp_templateproject#NMF#' + search_get_text('id_ac_tp_templateproject') + '@NMF@';
  str_out += 'SC_tp_status_cond#NMF#' + search_get_sel_txt('SC_tp_status_cond') + '@NMF@';
  str_out += 'SC_tp_status#NMF#' + search_get_text('SC_tp_status') + '@NMF@';
  str_out += 'id_ac_tp_status#NMF#' + search_get_text('id_ac_tp_status') + '@NMF@';
  str_out += 'SC_tp_planstart_cond#NMF#' + search_get_sel_txt('SC_tp_planstart_cond') + '@NMF@';
  str_out += 'SC_tp_planstart_dia#NMF#' + search_get_sel_txt('SC_tp_planstart_dia') + '@NMF@';
  str_out += 'SC_tp_planstart_mes#NMF#' + search_get_sel_txt('SC_tp_planstart_mes') + '@NMF@';
  str_out += 'SC_tp_planstart_ano#NMF#' + search_get_sel_txt('SC_tp_planstart_ano') + '@NMF@';
  str_out += 'SC_tp_planstart_input_2_dia#NMF#' + search_get_sel_txt('SC_tp_planstart_input_2_dia') + '@NMF@';
  str_out += 'SC_tp_planstart_input_2_mes#NMF#' + search_get_sel_txt('SC_tp_planstart_input_2_mes') + '@NMF@';
  str_out += 'SC_tp_planstart_input_2_ano#NMF#' + search_get_sel_txt('SC_tp_planstart_input_2_ano') + '@NMF@';
  str_out += 'SC_tp_planstart_hor#NMF#' + search_get_sel_txt('SC_tp_planstart_hor') + '@NMF@';
  str_out += 'SC_tp_planstart_min#NMF#' + search_get_sel_txt('SC_tp_planstart_min') + '@NMF@';
  str_out += 'SC_tp_planstart_seg#NMF#' + search_get_sel_txt('SC_tp_planstart_seg') + '@NMF@';
  str_out += 'SC_tp_planstart_input_2_hor#NMF#' + search_get_sel_txt('SC_tp_planstart_input_2_hor') + '@NMF@';
  str_out += 'SC_tp_planstart_input_2_min#NMF#' + search_get_sel_txt('SC_tp_planstart_input_2_min') + '@NMF@';
  str_out += 'SC_tp_planstart_input_2_seg#NMF#' + search_get_sel_txt('SC_tp_planstart_input_2_seg') + '@NMF@';
  str_out += 'SC_tp_planfinish_cond#NMF#' + search_get_sel_txt('SC_tp_planfinish_cond') + '@NMF@';
  str_out += 'SC_tp_planfinish_dia#NMF#' + search_get_sel_txt('SC_tp_planfinish_dia') + '@NMF@';
  str_out += 'SC_tp_planfinish_mes#NMF#' + search_get_sel_txt('SC_tp_planfinish_mes') + '@NMF@';
  str_out += 'SC_tp_planfinish_ano#NMF#' + search_get_sel_txt('SC_tp_planfinish_ano') + '@NMF@';
  str_out += 'SC_tp_planfinish_input_2_dia#NMF#' + search_get_sel_txt('SC_tp_planfinish_input_2_dia') + '@NMF@';
  str_out += 'SC_tp_planfinish_input_2_mes#NMF#' + search_get_sel_txt('SC_tp_planfinish_input_2_mes') + '@NMF@';
  str_out += 'SC_tp_planfinish_input_2_ano#NMF#' + search_get_sel_txt('SC_tp_planfinish_input_2_ano') + '@NMF@';
  str_out += 'SC_tp_planfinish_hor#NMF#' + search_get_sel_txt('SC_tp_planfinish_hor') + '@NMF@';
  str_out += 'SC_tp_planfinish_min#NMF#' + search_get_sel_txt('SC_tp_planfinish_min') + '@NMF@';
  str_out += 'SC_tp_planfinish_seg#NMF#' + search_get_sel_txt('SC_tp_planfinish_seg') + '@NMF@';
  str_out += 'SC_tp_planfinish_input_2_hor#NMF#' + search_get_sel_txt('SC_tp_planfinish_input_2_hor') + '@NMF@';
  str_out += 'SC_tp_planfinish_input_2_min#NMF#' + search_get_sel_txt('SC_tp_planfinish_input_2_min') + '@NMF@';
  str_out += 'SC_tp_planfinish_input_2_seg#NMF#' + search_get_sel_txt('SC_tp_planfinish_input_2_seg') + '@NMF@';
  str_out += 'SC_tp_divre_cond#NMF#' + search_get_sel_txt('SC_tp_divre_cond') + '@NMF@';
  str_out += 'SC_tp_divre#NMF#' + search_get_text('SC_tp_divre') + '@NMF@';
  str_out += 'id_ac_tp_divre#NMF#' + search_get_text('id_ac_tp_divre') + '@NMF@';
  str_out += 'SC_tp_witel_cond#NMF#' + search_get_sel_txt('SC_tp_witel_cond') + '@NMF@';
  str_out += 'SC_tp_witel#NMF#' + search_get_text('SC_tp_witel') + '@NMF@';
  str_out += 'id_ac_tp_witel#NMF#' + search_get_text('id_ac_tp_witel') + '@NMF@';
  str_out += 'SC_tp_datel_cond#NMF#' + search_get_sel_txt('SC_tp_datel_cond') + '@NMF@';
  str_out += 'SC_tp_datel#NMF#' + search_get_text('SC_tp_datel') + '@NMF@';
  str_out += 'id_ac_tp_datel#NMF#' + search_get_text('id_ac_tp_datel') + '@NMF@';
  str_out += 'SC_tp_mitra_cond#NMF#' + search_get_sel_txt('SC_tp_mitra_cond') + '@NMF@';
  str_out += 'SC_tp_mitra#NMF#' + search_get_text('SC_tp_mitra') + '@NMF@';
  str_out += 'id_ac_tp_mitra#NMF#' + search_get_text('id_ac_tp_mitra') + '@NMF@';
  str_out += 'NM_operador#NMF#' + search_get_text('SC_NM_operador');
  str_out  = str_out.replace(/[+]/g, "__NM_PLUS__");
  str_out  = str_out.replace(/[&]/g, "__NM_AMP__");
  str_out  = str_out.replace(/[%]/g, "__NM_PRC__");
  var save_name = search_get_text('SC_nmgp_save_name_' + pos);
  var save_opt  = search_get_sel_txt('SC_nmgp_save_option_' + pos);
  ajax_save_filter(save_name, save_opt, str_out, pos);
 }
 function nm_submit_filter(obj_sel, pos)
 {
  index   = obj_sel.selectedIndex;
  if (obj_sel.options[index].value == "") 
  {
      return false;
  }
  ajax_select_filter(obj_sel.options[index].value);
 }
 function nm_submit_filter_del(pos)
 {
  if (pos == 'top')
  {
      obj_sel = document.F1.elements['NM_filters_del_top'];
  }
  if (pos == 'bot')
  {
      obj_sel = document.F1.elements['NM_filters_del_bot'];
  }
  index   = obj_sel.selectedIndex;
  if (index == -1 || obj_sel.options[index].value == "") 
  {
      return false;
  }
  parm = obj_sel.options[index].value;
  ajax_delete_filter(parm);
 }
 function search_get_select(obj_id)
 {
    var index = document.getElementById(obj_id).selectedIndex;
    if (index != -1) {
        return document.getElementById(obj_id).options[index].value;
    }
    else {
        return '';
    }
 }
 function search_get_selmult(obj_id)
 {
    var obj = document.getElementById(obj_id);
    var val = "_NM_array_";
    for (iSelect = 0; iSelect < obj.length; iSelect++)
    {
        if (obj[iSelect].selected)
        {
            val += "#NMARR#" + obj[iSelect].value;
        }
    }
    return val;
 }
 function search_get_Dselelect(obj_id)
 {
    var obj = document.getElementById(obj_id);
    var val = "_NM_array_";
    for (iSelect = 0; iSelect < obj.length; iSelect++)
    {
         val += "#NMARR#" + obj[iSelect].value;
    }
    return val;
 }
 function search_get_radio(obj_id)
 {
    var val  = "";
    if (document.getElementById(obj_id)) {
       var Nobj = document.getElementById(obj_id).name;
       var obj  = document.getElementsByName(Nobj);
       for (iRadio = 0; iRadio < obj.length; iRadio++) {
           if (obj[iRadio].checked) {
               val = obj[iRadio].value;
           }
       }
    }
    return val;
 }
 function search_get_checkbox(obj_id)
 {
    var val  = "_NM_array_";
    if (document.getElementById(obj_id)) {
       var Nobj = document.getElementById(obj_id).name;
       var obj  = document.getElementsByName(Nobj);
       if (!obj.length) {
           if (obj.checked) {
               val += "#NMARR#" + obj.value;
           }
       }
       else {
           for (iCheck = 0; iCheck < obj.length; iCheck++) {
               if (obj[iCheck].checked) {
                   val += "#NMARR#" + obj[iCheck].value;
               }
           }
       }
    }
    return val;
 }
 function search_get_text(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return (obj) ? obj.value : '';
 }
 function search_get_sel_txt(obj_id)
 {
    var val = "";
    obj_part  = document.getElementById(obj_id);
    if (obj_part && obj_part.type.substr(0, 6) == 'select')
    {
        val = search_get_select(obj_id);
    }
    else
    {
        val = (obj_part) ? obj_part.value : '';
    }
    return val;
 }
 function search_get_html(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return obj.innerHTML;
 }
function nm_open_popup(parms)
{
    NovaJanela = window.open (parms, '', 'resizable, scrollbars');
}
 </SCRIPT>
<script type="text/javascript">
 $(function() {
   $("#id_ac_tp_batch").autocomplete({
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tp_batch",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_tp_batch").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tp_batch").val( $(this).val() );
       }
     }
   });
   $("#id_ac_tp_mitra").autocomplete({
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tp_mitra",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_tp_mitra").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tp_mitra").val( $(this).val() );
       }
     }
   });
   $("#id_ac_tp_witel").autocomplete({
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tp_witel",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_tp_witel").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tp_witel").val( $(this).val() );
       }
     }
   });
   $("#id_ac_tp_status").autocomplete({
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tp_status",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_tp_status").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tp_status").val( $(this).val() );
       }
     }
   });
   $("#id_ac_tp_templateproject").autocomplete({
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tp_templateproject",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_tp_templateproject").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tp_templateproject").val( $(this).val() );
       }
     }
   });
   $("#id_ac_tp_jenisproject").autocomplete({
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tp_jenisproject",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_tp_jenisproject").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tp_jenisproject").val( $(this).val() );
       }
     }
   });
   $("#id_ac_tp_prjtrelease").autocomplete({
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tp_prjtrelease",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_tp_prjtrelease").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tp_prjtrelease").val( $(this).val() );
       }
     }
   });
   $("#id_ac_tp_datel").autocomplete({
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tp_datel",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_tp_datel").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tp_datel").val( $(this).val() );
       }
     }
   });
   $("#id_ac_tp_divre").autocomplete({
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tp_divre",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_tp_divre").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tp_divre").val( $(this).val() );
       }
     }
   });
 });
</script>
 <FORM name="F1" action="./" method="post" target="_self"> 
 <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
 <INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
 <INPUT type="hidden" name="nmgp_opcao" value="busca"> 
 <div id="idJSSpecChar" style="display:none;"></div>
 <div id="id_div_process" style="display: none; position: absolute"><table class="scFilterTable"><tr><td class="scFilterLabelOdd"><?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</td></tr></table></div>
 <div id="id_fatal_error" class="scFilterFieldOdd" style="display:none; position: absolute"></div>
<TABLE id="main_table" align="center" valign="top" width="75%">
<tr>
<td>
<div class="scFilterBorder">
  <div id="id_div_process_block" style="display: none; margin: 10px; whitespace: nowrap"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs'] ?>...</span></div>
<table cellspacing=0 cellpadding=0 width='100%'>
<?php
   }

   /**
    * @access  public
    * @global  string  $bprocessa  
    */
   /**
    * @access  public
    * @global  string  $nm_url_saida  $this->Ini->Nm_lang['pesq_global_nm_url_saida']
    * @global  integer  $nm_apl_dependente  $this->Ini->Nm_lang['pesq_global_nm_apl_dependente']
    * @global  string  $nmgp_parms  
    * @global  string  $bprocessa  $this->Ini->Nm_lang['pesq_global_bprocessa']
    */
   function monta_form()
   {
      global 
             $tp_thn_release_cond, $tp_thn_release,
             $tp_batch_cond, $tp_batch, $tp_batch_autocomp,
             $tp_jenisproject_cond, $tp_jenisproject, $tp_jenisproject_autocomp,
             $tp_prjtrelease_cond, $tp_prjtrelease, $tp_prjtrelease_autocomp,
             $tp_templateproject_cond, $tp_templateproject, $tp_templateproject_autocomp,
             $tp_status_cond, $tp_status, $tp_status_autocomp,
             $tp_planstart_cond, $tp_planstart, $tp_planstart_dia, $tp_planstart_mes, $tp_planstart_ano, $tp_planstart_hor, $tp_planstart_min, $tp_planstart_seg, $tp_planstart_input_2_dia, $tp_planstart_input_2_mes, $tp_planstart_input_2_ano, $tp_planstart_input_2_min, $tp_planstart_input_2_hor, $tp_planstart_input_2_seg,
             $tp_planfinish_cond, $tp_planfinish, $tp_planfinish_dia, $tp_planfinish_mes, $tp_planfinish_ano, $tp_planfinish_hor, $tp_planfinish_min, $tp_planfinish_seg, $tp_planfinish_input_2_dia, $tp_planfinish_input_2_mes, $tp_planfinish_input_2_ano, $tp_planfinish_input_2_min, $tp_planfinish_input_2_hor, $tp_planfinish_input_2_seg,
             $tp_divre_cond, $tp_divre, $tp_divre_autocomp,
             $tp_witel_cond, $tp_witel, $tp_witel_autocomp,
             $tp_datel_cond, $tp_datel, $tp_datel_autocomp,
             $tp_mitra_cond, $tp_mitra, $tp_mitra_autocomp,
             $nm_url_saida, $nm_apl_dependente, $nmgp_parms, $bprocessa, $nmgp_save_name, $NM_operador, $NM_filters, $nmgp_save_option, $NM_filters_del, $Script_BI;
      $Script_BI = "";
      $this->nmgp_botoes['clear'] = "on";
      $this->nmgp_botoes['save'] = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['report_resume_project_othersview']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['report_resume_project_othersview']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['report_resume_project_othersview']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("report_resume_project_othersview", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $nmgp_tab_label = "";
      $delimitador = "##@@";
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      { 
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $tp_thn_release = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_thn_release']; 
          $tp_thn_release_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_thn_release_cond']; 
          $tp_batch = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_batch']; 
          $tp_batch_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_batch_cond']; 
          $tp_jenisproject = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_jenisproject']; 
          $tp_jenisproject_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_jenisproject_cond']; 
          $tp_prjtrelease = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_prjtrelease']; 
          $tp_prjtrelease_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_prjtrelease_cond']; 
          $tp_templateproject = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_templateproject']; 
          $tp_templateproject_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_templateproject_cond']; 
          $tp_status = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_status']; 
          $tp_status_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_status_cond']; 
          $tp_planstart_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_dia']; 
          $tp_planstart_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_mes']; 
          $tp_planstart_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_ano']; 
          $tp_planstart_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_dia']; 
          $tp_planstart_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_mes']; 
          $tp_planstart_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_ano']; 
          $tp_planstart_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_hor']; 
          $tp_planstart_min = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_min']; 
          $tp_planstart_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_seg']; 
          $tp_planstart_input_2_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_hor']; 
          $tp_planstart_input_2_min = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_min']; 
          $tp_planstart_input_2_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_seg']; 
          $tp_planstart_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_cond']; 
          $tp_planfinish_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_dia']; 
          $tp_planfinish_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_mes']; 
          $tp_planfinish_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_ano']; 
          $tp_planfinish_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_dia']; 
          $tp_planfinish_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_mes']; 
          $tp_planfinish_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_ano']; 
          $tp_planfinish_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_hor']; 
          $tp_planfinish_min = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_min']; 
          $tp_planfinish_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_seg']; 
          $tp_planfinish_input_2_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_hor']; 
          $tp_planfinish_input_2_min = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_min']; 
          $tp_planfinish_input_2_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_seg']; 
          $tp_planfinish_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_cond']; 
          $tp_divre = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_divre']; 
          $tp_divre_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_divre_cond']; 
          $tp_witel = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_witel']; 
          $tp_witel_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_witel_cond']; 
          $tp_datel = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_datel']; 
          $tp_datel_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_datel_cond']; 
          $tp_mitra = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_mitra']; 
          $tp_mitra_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_mitra_cond']; 
          $this->NM_operador = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['NM_operador']; 
      } 
      if (!isset($tp_thn_release_cond) || empty($tp_thn_release_cond))
      {
         $tp_thn_release_cond = "eq";
      }
      if (!isset($tp_batch_cond) || empty($tp_batch_cond))
      {
         $tp_batch_cond = "qp";
      }
      if (!isset($tp_jenisproject_cond) || empty($tp_jenisproject_cond))
      {
         $tp_jenisproject_cond = "gt";
      }
      if (!isset($tp_prjtrelease_cond) || empty($tp_prjtrelease_cond))
      {
         $tp_prjtrelease_cond = "gt";
      }
      if (!isset($tp_templateproject_cond) || empty($tp_templateproject_cond))
      {
         $tp_templateproject_cond = "gt";
      }
      if (!isset($tp_status_cond) || empty($tp_status_cond))
      {
         $tp_status_cond = "gt";
      }
      if (!isset($tp_planstart_cond) || empty($tp_planstart_cond))
      {
         $tp_planstart_cond = "eq";
      }
      if (!isset($tp_planfinish_cond) || empty($tp_planfinish_cond))
      {
         $tp_planfinish_cond = "eq";
      }
      if (!isset($tp_divre_cond) || empty($tp_divre_cond))
      {
         $tp_divre_cond = "gt";
      }
      if (!isset($tp_witel_cond) || empty($tp_witel_cond))
      {
         $tp_witel_cond = "gt";
      }
      if (!isset($tp_datel_cond) || empty($tp_datel_cond))
      {
         $tp_datel_cond = "gt";
      }
      if (!isset($tp_mitra_cond) || empty($tp_mitra_cond))
      {
         $tp_mitra_cond = "gt";
      }
      $display_aberto  = "style=display:";
      $display_fechado = "style=display:none";
      $opc_hide_input = array("nu","nn","ep","ne");
      $str_hide_tp_thn_release = (in_array($tp_thn_release_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_batch = (in_array($tp_batch_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_jenisproject = (in_array($tp_jenisproject_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_prjtrelease = (in_array($tp_prjtrelease_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_templateproject = (in_array($tp_templateproject_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_status = (in_array($tp_status_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_planstart = (in_array($tp_planstart_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_planfinish = (in_array($tp_planfinish_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_divre = (in_array($tp_divre_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_witel = (in_array($tp_witel_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_datel = (in_array($tp_datel_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tp_mitra = (in_array($tp_mitra_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;

      $str_display_tp_planstart = ('bw' == $tp_planstart_cond) ? $display_aberto : $display_fechado;
      $str_display_tp_planfinish = ('bw' == $tp_planfinish_cond) ? $display_aberto : $display_fechado;

      if (!isset($tp_thn_release) || $tp_thn_release == "")
      {
          $tp_thn_release = "";
      }
      if (isset($tp_thn_release) && !empty($tp_thn_release))
      {
         $tmp_pos = strpos($tp_thn_release, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_thn_release = substr($tp_thn_release, 0, $tmp_pos);
         }
      }
      if (!isset($tp_batch) || $tp_batch == "")
      {
          $tp_batch = "";
      }
      if (isset($tp_batch) && !empty($tp_batch))
      {
         $tmp_pos = strpos($tp_batch, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_batch = substr($tp_batch, 0, $tmp_pos);
         }
      }
      if (!isset($tp_jenisproject) || $tp_jenisproject == "")
      {
          $tp_jenisproject = "";
      }
      if (isset($tp_jenisproject) && !empty($tp_jenisproject))
      {
         $tmp_pos = strpos($tp_jenisproject, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_jenisproject = substr($tp_jenisproject, 0, $tmp_pos);
         }
      }
      if (!isset($tp_prjtrelease) || $tp_prjtrelease == "")
      {
          $tp_prjtrelease = "";
      }
      if (isset($tp_prjtrelease) && !empty($tp_prjtrelease))
      {
         $tmp_pos = strpos($tp_prjtrelease, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_prjtrelease = substr($tp_prjtrelease, 0, $tmp_pos);
         }
      }
      if (!isset($tp_templateproject) || $tp_templateproject == "")
      {
          $tp_templateproject = "";
      }
      if (isset($tp_templateproject) && !empty($tp_templateproject))
      {
         $tmp_pos = strpos($tp_templateproject, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_templateproject = substr($tp_templateproject, 0, $tmp_pos);
         }
      }
      if (!isset($tp_status) || $tp_status == "")
      {
          $tp_status = "";
      }
      if (isset($tp_status) && !empty($tp_status))
      {
         $tmp_pos = strpos($tp_status, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_status = substr($tp_status, 0, $tmp_pos);
         }
      }
      if (!isset($tp_planstart) || $tp_planstart == "")
      {
          $tp_planstart = "";
      }
      if (isset($tp_planstart) && !empty($tp_planstart))
      {
         $tmp_pos = strpos($tp_planstart, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_planstart = substr($tp_planstart, 0, $tmp_pos);
         }
      }
      if (!isset($tp_planfinish) || $tp_planfinish == "")
      {
          $tp_planfinish = "";
      }
      if (isset($tp_planfinish) && !empty($tp_planfinish))
      {
         $tmp_pos = strpos($tp_planfinish, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_planfinish = substr($tp_planfinish, 0, $tmp_pos);
         }
      }
      if (!isset($tp_divre) || $tp_divre == "")
      {
          $tp_divre = "";
      }
      if (isset($tp_divre) && !empty($tp_divre))
      {
         $tmp_pos = strpos($tp_divre, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_divre = substr($tp_divre, 0, $tmp_pos);
         }
      }
      if (!isset($tp_witel) || $tp_witel == "")
      {
          $tp_witel = "";
      }
      if (isset($tp_witel) && !empty($tp_witel))
      {
         $tmp_pos = strpos($tp_witel, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_witel = substr($tp_witel, 0, $tmp_pos);
         }
      }
      if (!isset($tp_datel) || $tp_datel == "")
      {
          $tp_datel = "";
      }
      if (isset($tp_datel) && !empty($tp_datel))
      {
         $tmp_pos = strpos($tp_datel, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_datel = substr($tp_datel, 0, $tmp_pos);
         }
      }
      if (!isset($tp_mitra) || $tp_mitra == "")
      {
          $tp_mitra = "";
      }
      if (isset($tp_mitra) && !empty($tp_mitra))
      {
         $tmp_pos = strpos($tp_mitra, "##@@");
         if ($tmp_pos === false)
         { }
         else
         {
         $tp_mitra = substr($tp_mitra, 0, $tmp_pos);
         }
      }
?>
 <TR align="center">
  <TD class="scFilterTableTd">
   <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
   <TR valign="top" >
  <TD width="100%" height="">
   <TABLE class="scFilterTable" id="hidden_bloco_0" valign="top" width="100%" style="height: 100%;">
   <tr>





      <TD class="scFilterLabelOdd"><?php echo (isset($this->New_label['tp_thn_release'])) ? $this->New_label['tp_thn_release'] : "Project Release"; ?></TD>
      
      <INPUT type="hidden" id="SC_tp_thn_release_cond" name="tp_thn_release_cond" value="eq">
 
     <TD colspan=2 class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_thn_release" <?php echo $str_hide_tp_thn_release?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['tp_thn_release'])) ? $this->New_label['tp_thn_release'] : "Project Release";
 $nmgp_tab_label .= "tp_thn_release?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>

<?php
      $tp_thn_release_look = substr($this->Db->qstr($tp_thn_release), 1, -1); 
      $nmgp_def_dados = "" ; 
      $nm_comando = "SELECT TMT_TAHUN  FROM TBL_MAS_TAHUN  ORDER BY TMT_TAHUN"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['psq_check_ret']['tp_thn_release'] = array();
         while (!$rs->EOF) 
         { 
            $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['psq_check_ret']['tp_thn_release'][] = trim($rs->fields[0]);
            $nmgp_def_dados .= trim($rs->fields[0]) . "?#?" ; 
            $nmgp_def_dados .= trim($rs->fields[0]) . "?#?N?@?" ; 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
?>
   <span id="idAjaxSelect_tp_thn_release">
      <SELECT class="scFilterObjectOdd" id="SC_tp_thn_release" name="tp_thn_release"  size="1">
       <OPTION value=""></OPTION>
<?php
      $nm_opcoesx = str_replace("?#?@?#?", "?#?@ ?#?", $nmgp_def_dados);
      $nm_opcoes  = explode("?@?", $nm_opcoesx);
      foreach ($nm_opcoes as $nm_opcao)
      {
         if (!empty($nm_opcao))
         {
            $temp_bug_list = explode("?#?", $nm_opcao);
            list($nm_opc_val, $nm_opc_cod, $nm_opc_sel) = $temp_bug_list;
            if ($nm_opc_cod == "@ ") {$nm_opc_cod = trim($nm_opc_cod); }
            if ("" != $tp_thn_release)
            {
                    $tp_thn_release_sel = ($nm_opc_cod === $tp_thn_release) ? "selected" : "";
            }
            else
            {
               $tp_thn_release_sel = ("S" == $nm_opc_sel) ? "selected" : "";
            }
            $nm_sc_valor = $nm_opc_val;
            $nm_opc_val = $nm_sc_valor;
?>
       <OPTION value="<?php echo NM_encode_input($nm_opc_cod . $delimitador . $nm_opc_val); ?>" <?php echo $tp_thn_release_sel; ?>><?php echo $nm_opc_val; ?></OPTION>
<?php
         }
      }
?>
      </SELECT>
   </span>
<?php
?>
        
        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelEven"><?php echo (isset($this->New_label['tp_batch'])) ? $this->New_label['tp_batch'] : "Batch"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_tp_batch_cond" name="tp_batch_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_batch'), this, 'tp_batch')">
       <OPTION value="qp" <?php if ("qp" == $tp_batch_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tp_batch_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tp_batch_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tp_batch_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_batch" <?php echo $str_hide_tp_batch?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['tp_batch'])) ? $this->New_label['tp_batch'] : "Batch";
 $nmgp_tab_label .= "tp_batch?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>
<?php
      if ($tp_batch != "")
      {
      $tp_batch_look = substr($this->Db->qstr($tp_batch), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct TP_BATCH from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_BATCH = '$tp_batch_look' order by TP_BATCH"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$tp_batch]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tp_batch];
      }
      else
      {
          $sAutocompValue = $tp_batch;
      }
?>
<INPUT  type="text" id="SC_tp_batch" name="tp_batch" value="<?php echo NM_encode_input($tp_batch) ?>" size=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tp_batch" name="tp_batch_autocomp" size="30" value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelOdd"><?php echo (isset($this->New_label['tp_jenisproject'])) ? $this->New_label['tp_jenisproject'] : "Jenis Project"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_tp_jenisproject_cond" name="tp_jenisproject_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_jenisproject'), this, 'tp_jenisproject')">
       <OPTION value="gt" <?php if ("gt" == $tp_jenisproject_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tp_jenisproject_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tp_jenisproject_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_jenisproject" <?php echo $str_hide_tp_jenisproject?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['tp_jenisproject'])) ? $this->New_label['tp_jenisproject'] : "Jenis Project";
 $nmgp_tab_label .= "tp_jenisproject?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>
<?php
      if ($tp_jenisproject != "")
      {
      $tp_jenisproject_look = substr($this->Db->qstr($tp_jenisproject), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_jenisproject))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_JENISPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_JENISPROJECT = $tp_jenisproject_look order by TP_JENISPROJECT"; 
      }
      else
      {
          $nm_comando = "select distinct TP_JENISPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_JENISPROJECT = $tp_jenisproject_look order by TP_JENISPROJECT"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 
      }
      if (isset($nmgp_def_dados[0][$tp_jenisproject]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tp_jenisproject];
      }
      else
      {
            nmgp_Form_Num_Val($tp_jenisproject, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $tp_jenisproject;
      }
?>
<INPUT  type="text" id="SC_tp_jenisproject" name="tp_jenisproject" value="<?php echo NM_encode_input($tp_jenisproject) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tp_jenisproject" name="tp_jenisproject_autocomp" size="11" value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelEven"><?php echo (isset($this->New_label['tp_prjtrelease'])) ? $this->New_label['tp_prjtrelease'] : "Release Project"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_tp_prjtrelease_cond" name="tp_prjtrelease_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_prjtrelease'), this, 'tp_prjtrelease')">
       <OPTION value="gt" <?php if ("gt" == $tp_prjtrelease_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tp_prjtrelease_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tp_prjtrelease_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_prjtrelease" <?php echo $str_hide_tp_prjtrelease?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['tp_prjtrelease'])) ? $this->New_label['tp_prjtrelease'] : "Release Project";
 $nmgp_tab_label .= "tp_prjtrelease?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>
<?php
      if ($tp_prjtrelease != "")
      {
      $tp_prjtrelease_look = substr($this->Db->qstr($tp_prjtrelease), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_prjtrelease))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_PRJTRELEASE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_PRJTRELEASE = $tp_prjtrelease_look order by TP_PRJTRELEASE"; 
      }
      else
      {
          $nm_comando = "select distinct TP_PRJTRELEASE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_PRJTRELEASE = $tp_prjtrelease_look order by TP_PRJTRELEASE"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 
      }
      if (isset($nmgp_def_dados[0][$tp_prjtrelease]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tp_prjtrelease];
      }
      else
      {
            nmgp_Form_Num_Val($tp_prjtrelease, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $tp_prjtrelease;
      }
?>
<INPUT  type="text" id="SC_tp_prjtrelease" name="tp_prjtrelease" value="<?php echo NM_encode_input($tp_prjtrelease) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tp_prjtrelease" name="tp_prjtrelease_autocomp" size="11" value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelOdd"><?php echo (isset($this->New_label['tp_templateproject'])) ? $this->New_label['tp_templateproject'] : "Project Template"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_tp_templateproject_cond" name="tp_templateproject_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_templateproject'), this, 'tp_templateproject')">
       <OPTION value="gt" <?php if ("gt" == $tp_templateproject_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tp_templateproject_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tp_templateproject_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_templateproject" <?php echo $str_hide_tp_templateproject?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['tp_templateproject'])) ? $this->New_label['tp_templateproject'] : "Project Template";
 $nmgp_tab_label .= "tp_templateproject?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>
<?php
      if ($tp_templateproject != "")
      {
      $tp_templateproject_look = substr($this->Db->qstr($tp_templateproject), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_templateproject))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_TEMPLATEPROJECT = $tp_templateproject_look order by TP_TEMPLATEPROJECT"; 
      }
      else
      {
          $nm_comando = "select distinct TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_TEMPLATEPROJECT = $tp_templateproject_look order by TP_TEMPLATEPROJECT"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 
      }
      if (isset($nmgp_def_dados[0][$tp_templateproject]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tp_templateproject];
      }
      else
      {
            nmgp_Form_Num_Val($tp_templateproject, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $tp_templateproject;
      }
?>
<INPUT  type="text" id="SC_tp_templateproject" name="tp_templateproject" value="<?php echo NM_encode_input($tp_templateproject) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tp_templateproject" name="tp_templateproject_autocomp" size="11" value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelEven"><?php echo (isset($this->New_label['tp_status'])) ? $this->New_label['tp_status'] : "Status"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_tp_status_cond" name="tp_status_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_status'), this, 'tp_status')">
       <OPTION value="gt" <?php if ("gt" == $tp_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tp_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tp_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_status" <?php echo $str_hide_tp_status?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['tp_status'])) ? $this->New_label['tp_status'] : "Status";
 $nmgp_tab_label .= "tp_status?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>
<?php
      if ($tp_status != "")
      {
      $tp_status_look = substr($this->Db->qstr($tp_status), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_status))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_STATUS from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_STATUS = $tp_status_look order by TP_STATUS"; 
      }
      else
      {
          $nm_comando = "select distinct TP_STATUS from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_STATUS = $tp_status_look order by TP_STATUS"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 
      }
      if (isset($nmgp_def_dados[0][$tp_status]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tp_status];
      }
      else
      {
            nmgp_Form_Num_Val($tp_status, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $tp_status;
      }
?>
<INPUT  type="text" id="SC_tp_status" name="tp_status" value="<?php echo NM_encode_input($tp_status) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tp_status" name="tp_status_autocomp" size="11" value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelOdd"><?php echo (isset($this->New_label['tp_planstart'])) ? $this->New_label['tp_planstart'] : "Tgl Mulai ( Plan )"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_tp_planstart_cond" name="tp_planstart_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_planstart'), this, 'tp_planstart')">
       <OPTION value="eq" <?php if ("eq" == $tp_planstart_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $tp_planstart_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tp_planstart_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $tp_planstart_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_planstart" <?php echo $str_hide_tp_planstart?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['tp_planstart'])) ? $this->New_label['tp_planstart'] : "Tgl Mulai ( Plan )";
 $nmgp_tab_label .= "tp_planstart?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>

<?php
  $Form_base = "ddmmyyyyhhiiss";
  $date_format_show = "";
  $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
  $Lim   = strlen($Str_date);
  $Str   = "";
  $Ult   = "";
  $Arr_D = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_date, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_D[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_D[] = $Str;
  $Prim = true;
  foreach ($Arr_D as $Cada_d)
  {
      if (strpos($Form_base, $Cada_d) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $date_format_show .= $Cada_d;
          $Prim = false;
      }
  }
  $date_format_show .= " ";
  $Str_time = strtolower($_SESSION['scriptcase']['reg_conf']['time_format']);
  $Lim   = strlen($Str_time);
  $Str   = "";
  $Ult   = "";
  $Arr_T = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_time, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_T[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_T[] = $Str;
  $Prim = true;
  foreach ($Arr_T as $Cada_t)
  {
      if (strpos($Form_base, $Cada_t) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['time_sep'] : "";
          $date_format_show .= $Cada_t;
          $Prim = false;
      }
  }
  $Arr_format = array_merge($Arr_D, $Arr_T);
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "(" . $date_format_show .  ")";

?>

         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_dia" name="tp_planstart_dia" value="<?php echo NM_encode_input($tp_planstart_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_mes" name="tp_planstart_mes" value="<?php echo NM_encode_input($tp_planstart_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_ano" name="tp_planstart_ano" value="<?php echo NM_encode_input($tp_planstart_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 
<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_hor" name="tp_planstart_hor" value="<?php echo NM_encode_input($tp_planstart_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_min" name="tp_planstart_min" value="<?php echo NM_encode_input($tp_planstart_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_seg" name="tp_planstart_seg" value="<?php echo NM_encode_input($tp_planstart_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_tp_planstart"  class="scFilterFieldFontOdd">
 <?php echo $date_format_show ?>         </SPAN>
                 </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_tp_planstart"  <?php echo $str_display_tp_planstart; ?> class="scFilterFieldFontOdd">
         <?php echo $date_sep_bw ?>
         <BR>
         
         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_input_2_dia" name="tp_planstart_input_2_dia" value="<?php echo NM_encode_input($tp_planstart_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_input_2_mes" name="tp_planstart_input_2_mes" value="<?php echo NM_encode_input($tp_planstart_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_input_2_ano" name="tp_planstart_input_2_ano" value="<?php echo NM_encode_input($tp_planstart_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 
<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_input_2_hor" name="tp_planstart_input_2_hor" value="<?php echo NM_encode_input($tp_planstart_input_2_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_input_2_min" name="tp_planstart_input_2_min" value="<?php echo NM_encode_input($tp_planstart_input_2_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tp_planstart_input_2_seg" name="tp_planstart_input_2_seg" value="<?php echo NM_encode_input($tp_planstart_input_2_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>

<?php

}

?>
         
        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelEven"><?php echo (isset($this->New_label['tp_planfinish'])) ? $this->New_label['tp_planfinish'] : "Tgl Selesai(Plan)"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_tp_planfinish_cond" name="tp_planfinish_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_planfinish'), this, 'tp_planfinish')">
       <OPTION value="eq" <?php if ("eq" == $tp_planfinish_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $tp_planfinish_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tp_planfinish_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $tp_planfinish_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_planfinish" <?php echo $str_hide_tp_planfinish?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['tp_planfinish'])) ? $this->New_label['tp_planfinish'] : "Tgl Selesai(Plan)";
 $nmgp_tab_label .= "tp_planfinish?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>

<?php
  $Form_base = "ddmmyyyyhhiiss";
  $date_format_show = "";
  $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
  $Lim   = strlen($Str_date);
  $Str   = "";
  $Ult   = "";
  $Arr_D = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_date, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_D[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_D[] = $Str;
  $Prim = true;
  foreach ($Arr_D as $Cada_d)
  {
      if (strpos($Form_base, $Cada_d) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $date_format_show .= $Cada_d;
          $Prim = false;
      }
  }
  $date_format_show .= " ";
  $Str_time = strtolower($_SESSION['scriptcase']['reg_conf']['time_format']);
  $Lim   = strlen($Str_time);
  $Str   = "";
  $Ult   = "";
  $Arr_T = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_time, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_T[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_T[] = $Str;
  $Prim = true;
  foreach ($Arr_T as $Cada_t)
  {
      if (strpos($Form_base, $Cada_t) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['time_sep'] : "";
          $date_format_show .= $Cada_t;
          $Prim = false;
      }
  }
  $Arr_format = array_merge($Arr_D, $Arr_T);
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "(" . $date_format_show .  ")";

?>

         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_dia" name="tp_planfinish_dia" value="<?php echo NM_encode_input($tp_planfinish_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_mes" name="tp_planfinish_mes" value="<?php echo NM_encode_input($tp_planfinish_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_ano" name="tp_planfinish_ano" value="<?php echo NM_encode_input($tp_planfinish_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 
<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_hor" name="tp_planfinish_hor" value="<?php echo NM_encode_input($tp_planfinish_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_min" name="tp_planfinish_min" value="<?php echo NM_encode_input($tp_planfinish_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_seg" name="tp_planfinish_seg" value="<?php echo NM_encode_input($tp_planfinish_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_tp_planfinish"  class="scFilterFieldFontEven">
 <?php echo $date_format_show ?>         </SPAN>
                 </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_tp_planfinish"  <?php echo $str_display_tp_planfinish; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?>
         <BR>
         
         <?php

foreach ($Arr_format as $Part_date)
{
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_input_2_dia" name="tp_planfinish_input_2_dia" value="<?php echo NM_encode_input($tp_planfinish_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_input_2_mes" name="tp_planfinish_input_2_mes" value="<?php echo NM_encode_input($tp_planfinish_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_input_2_ano" name="tp_planfinish_input_2_ano" value="<?php echo NM_encode_input($tp_planfinish_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 
<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_input_2_hor" name="tp_planfinish_input_2_hor" value="<?php echo NM_encode_input($tp_planfinish_input_2_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_input_2_min" name="tp_planfinish_input_2_min" value="<?php echo NM_encode_input($tp_planfinish_input_2_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tp_planfinish_input_2_seg" name="tp_planfinish_input_2_seg" value="<?php echo NM_encode_input($tp_planfinish_input_2_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">

<?php
  }
?>

<?php

}

?>
         
        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelOdd"><?php echo (isset($this->New_label['tp_divre'])) ? $this->New_label['tp_divre'] : "Divre"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_tp_divre_cond" name="tp_divre_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_divre'), this, 'tp_divre')">
       <OPTION value="gt" <?php if ("gt" == $tp_divre_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tp_divre_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tp_divre_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_divre" <?php echo $str_hide_tp_divre?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['tp_divre'])) ? $this->New_label['tp_divre'] : "Divre";
 $nmgp_tab_label .= "tp_divre?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>
<?php
      if ($tp_divre != "")
      {
      $tp_divre_look = substr($this->Db->qstr($tp_divre), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_divre))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_DIVRE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_DIVRE = $tp_divre_look order by TP_DIVRE"; 
      }
      else
      {
          $nm_comando = "select distinct TP_DIVRE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_DIVRE = $tp_divre_look order by TP_DIVRE"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 
      }
      if (isset($nmgp_def_dados[0][$tp_divre]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tp_divre];
      }
      else
      {
            nmgp_Form_Num_Val($tp_divre, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $tp_divre;
      }
?>
<INPUT  type="text" id="SC_tp_divre" name="tp_divre" value="<?php echo NM_encode_input($tp_divre) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tp_divre" name="tp_divre_autocomp" size="11" value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelEven"><?php echo (isset($this->New_label['tp_witel'])) ? $this->New_label['tp_witel'] : "Witel"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_tp_witel_cond" name="tp_witel_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_witel'), this, 'tp_witel')">
       <OPTION value="gt" <?php if ("gt" == $tp_witel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tp_witel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tp_witel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_witel" <?php echo $str_hide_tp_witel?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['tp_witel'])) ? $this->New_label['tp_witel'] : "Witel";
 $nmgp_tab_label .= "tp_witel?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>
<?php
      if ($tp_witel != "")
      {
      $tp_witel_look = substr($this->Db->qstr($tp_witel), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_witel))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_WITEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_WITEL = $tp_witel_look order by TP_WITEL"; 
      }
      else
      {
          $nm_comando = "select distinct TP_WITEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_WITEL = $tp_witel_look order by TP_WITEL"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 
      }
      if (isset($nmgp_def_dados[0][$tp_witel]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tp_witel];
      }
      else
      {
            nmgp_Form_Num_Val($tp_witel, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $tp_witel;
      }
?>
<INPUT  type="text" id="SC_tp_witel" name="tp_witel" value="<?php echo NM_encode_input($tp_witel) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tp_witel" name="tp_witel_autocomp" size="11" value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelOdd"><?php echo (isset($this->New_label['tp_datel'])) ? $this->New_label['tp_datel'] : "Datel"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_tp_datel_cond" name="tp_datel_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_datel'), this, 'tp_datel')">
       <OPTION value="gt" <?php if ("gt" == $tp_datel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tp_datel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tp_datel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_datel" <?php echo $str_hide_tp_datel?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['tp_datel'])) ? $this->New_label['tp_datel'] : "Datel";
 $nmgp_tab_label .= "tp_datel?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>
<?php
      if ($tp_datel != "")
      {
      $tp_datel_look = substr($this->Db->qstr($tp_datel), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_datel))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_DATEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_DATEL = $tp_datel_look order by TP_DATEL"; 
      }
      else
      {
          $nm_comando = "select distinct TP_DATEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_DATEL = $tp_datel_look order by TP_DATEL"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 
      }
      if (isset($nmgp_def_dados[0][$tp_datel]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tp_datel];
      }
      else
      {
            nmgp_Form_Num_Val($tp_datel, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $tp_datel;
      }
?>
<INPUT  type="text" id="SC_tp_datel" name="tp_datel" value="<?php echo NM_encode_input($tp_datel) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tp_datel" name="tp_datel_autocomp" size="11" value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr>





      <TD class="scFilterLabelEven"><?php echo (isset($this->New_label['tp_mitra'])) ? $this->New_label['tp_mitra'] : "ID Mitra"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_tp_mitra_cond" name="tp_mitra_cond" onChange="nm_campos_between(document.getElementById('id_vis_tp_mitra'), this, 'tp_mitra')">
       <OPTION value="gt" <?php if ("gt" == $tp_mitra_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tp_mitra_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tp_mitra_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tp_mitra" <?php echo $str_hide_tp_mitra?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['tp_mitra'])) ? $this->New_label['tp_mitra'] : "ID Mitra";
 $nmgp_tab_label .= "tp_mitra?#?" . $SC_Label . "?@?";
 $date_sep_bw = "";
?>
<?php
      if ($tp_mitra != "")
      {
      $tp_mitra_look = substr($this->Db->qstr($tp_mitra), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_mitra))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_MITRA from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_MITRA = $tp_mitra_look order by TP_MITRA"; 
      }
      else
      {
          $nm_comando = "select distinct TP_MITRA from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_MITRA = $tp_mitra_look order by TP_MITRA"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 
      }
      if (isset($nmgp_def_dados[0][$tp_mitra]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tp_mitra];
      }
      else
      {
            nmgp_Form_Num_Val($tp_mitra, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          $sAutocompValue = $tp_mitra;
      }
?>
<INPUT  type="text" id="SC_tp_mitra" name="tp_mitra" value="<?php echo NM_encode_input($tp_mitra) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tp_mitra" name="tp_mitra_autocomp" size="11" value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr>
   </TABLE>
  </TD>
 </TR>
 </TABLE>
 </TD>
 </TR>
 <TR>
  <TD class="scFilterTableTd" align="center">
<INPUT type="hidden" id="SC_NM_operador" name="NM_operador" value="and">  </TD>
 </TR>
   <INPUT type="hidden" name="nmgp_tab_label" value="<?php echo NM_encode_input($nmgp_tab_label); ?>"> 
   <INPUT type="hidden" name="bprocessa" value="pesq"> 
 <?php
     if ($_SESSION['scriptcase']['proc_mobile'])
     {
     ?>
 <TR align="center">
  <TD class="scFilterTableTd">
   <table width="100%" class="scFilterToolbar"><tr>
    <td class="scFilterToolbarPadding" align="left" width="33%" nowrap>
    </td>
    <td class="scFilterToolbarPadding" align="center" width="33%" nowrap>
   <?php echo nmButtonOutput($this->arr_buttons, "bpesquisa", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200)", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200)", "sc_b_pesq_bot", "", "Submit", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   if ($this->nmgp_botoes['clear'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "blimpar", "limpa_form()", "limpa_form()", "limpa_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (!isset($this->nmgp_botoes['save']) || $this->nmgp_botoes['save'] == "on")
   {
       $this->NM_fil_ant = $this->gera_array_filtros();
?>
     <span id="idAjaxSelect_NM_filters_bot">
       <SELECT class="scFilterToolbar_obj" id="sel_recup_filters_bot" name="NM_filters_bot" onChange="nm_submit_filter(this, 'bot')" size="1">
           <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "           <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
           <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
       </SELECT>
     </span>
<?php
   }
?>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bedit_filter", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus()", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus()", "Ativa_save_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (is_file("report_resume_project_othersview_help.txt"))
   {
      $Arq_WebHelp = file("report_resume_project_othersview_help.txt"); 
      if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
      {
          $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
          $Tmp = explode(";", $Arq_WebHelp[0]); 
          foreach ($Tmp as $Cada_help)
          {
              $Tmp1 = explode(":", $Cada_help); 
              if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "fil" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
              {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "sc_b_help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
              }
          }
      }
   }
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "self.parent.tb_remove()", "self.parent.tb_remove()", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
    </td>
    <td class="scFilterToolbarPadding" align="right" width="33%" nowrap>
    </td>
   </tr></table>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
    </TD></TR><TR><TD>
    <DIV id="Salvar_filters_bot" style="display:none">
     <TABLE align="center" class="scFilterTable">
      <TR>
       <TD class="scFilterBlock">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top" class="scFilterBlockFont"><?php echo $this->Ini->Nm_lang['lang_othr_srch_head'] ?></td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "document.getElementById('Salvar_filters_bot').style.display = 'none'", "document.getElementById('Salvar_filters_bot').style.display = 'none'", "Cancel_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldOdd">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
           <input class="scFilterObjectOdd" type="text" id="SC_nmgp_save_name_bot" name="nmgp_save_name_bot" value="">
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bsalvar", "nm_save_form('bot')", "nm_save_form('bot')", "Save_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldEven">
       <DIV id="Apaga_filters_bot" style="display:''">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
          <div id="idAjaxSelect_NM_filters_del_bot">
           <SELECT class="scFilterObjectOdd" id="sel_filters_del_bot" name="NM_filters_del_bot" size="1">
            <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "            <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
            <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
           </SELECT>
          </div>
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "nm_submit_filter_del('bot')", "nm_submit_filter_del('bot')", "Exc_filtro_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </DIV>
       </TD>
      </TR>
     </TABLE>
    </DIV> 
<?php
   }
?>
  </TD>
 </TR>
     <?php
     }
     else
     {
     ?>
 <TR align="center">
  <TD class="scFilterTableTd">
   <table width="100%" class="scFilterToolbar"><tr>
    <td class="scFilterToolbarPadding" align="left" width="33%" nowrap>
    </td>
    <td class="scFilterToolbarPadding" align="center" width="33%" nowrap>
   <?php echo nmButtonOutput($this->arr_buttons, "bpesquisa", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200)", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200)", "sc_b_pesq_bot", "", "Submit", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   if ($this->nmgp_botoes['clear'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "blimpar", "limpa_form()", "limpa_form()", "limpa_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (!isset($this->nmgp_botoes['save']) || $this->nmgp_botoes['save'] == "on")
   {
       $this->NM_fil_ant = $this->gera_array_filtros();
?>
     <span id="idAjaxSelect_NM_filters_bot">
       <SELECT class="scFilterToolbar_obj" id="sel_recup_filters_bot" name="NM_filters_bot" onChange="nm_submit_filter(this, 'bot')" size="1">
           <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "           <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
           <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
       </SELECT>
     </span>
<?php
   }
?>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bedit_filter", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus()", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus()", "Ativa_save_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (is_file("report_resume_project_othersview_help.txt"))
   {
      $Arq_WebHelp = file("report_resume_project_othersview_help.txt"); 
      if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
      {
          $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
          $Tmp = explode(";", $Arq_WebHelp[0]); 
          foreach ($Tmp as $Cada_help)
          {
              $Tmp1 = explode(":", $Cada_help); 
              if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "fil" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
              {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "sc_b_help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
<?php
              }
          }
      }
   }
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "self.parent.tb_remove()", "self.parent.tb_remove()", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
    </td>
    <td class="scFilterToolbarPadding" align="right" width="33%" nowrap>
    </td>
   </tr></table>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
    </TD></TR><TR><TD>
    <DIV id="Salvar_filters_bot" style="display:none">
     <TABLE align="center" class="scFilterTable">
      <TR>
       <TD class="scFilterBlock">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top" class="scFilterBlockFont"><?php echo $this->Ini->Nm_lang['lang_othr_srch_head'] ?></td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "document.getElementById('Salvar_filters_bot').style.display = 'none'", "document.getElementById('Salvar_filters_bot').style.display = 'none'", "Cancel_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldOdd">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
           <input class="scFilterObjectOdd" type="text" id="SC_nmgp_save_name_bot" name="nmgp_save_name_bot" value="">
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bsalvar", "nm_save_form('bot')", "nm_save_form('bot')", "Save_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldEven">
       <DIV id="Apaga_filters_bot" style="display:''">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
          <div id="idAjaxSelect_NM_filters_del_bot">
           <SELECT class="scFilterObjectOdd" id="sel_filters_del_bot" name="NM_filters_del_bot" size="1">
            <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "            <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
            <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . $Cada_filter ?></option>
<?php
          }
?>
           </SELECT>
          </div>
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "nm_submit_filter_del('bot')", "nm_submit_filter_del('bot')", "Exc_filtro_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </DIV>
       </TD>
      </TR>
     </TABLE>
    </DIV> 
<?php
   }
?>
  </TD>
 </TR>
     <?php
     }
 ?>
<?php
   }

   function monta_html_fim()
   {
       global $bprocessa, $nm_url_saida, $Script_BI;
?>

</TABLE>
   <INPUT type="hidden" name="form_condicao" value="3">
</FORM> 
<?php
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['report_resume_project_othersview']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['report_resume_project_othersview']['start'] == 'filter')
   {
?>
   <FORM style="display:none;" name="form_cancel"  method="POST" action="<?php echo $nm_url_saida; ?>" target="_self"> 
<?php
   }
   else
   {
?>
   <FORM style="display:none;" name="form_cancel"  method="POST" action="./" target="_self"> 
<?php
   }
?>
   <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
   <INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<?php
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['orig_pesq'] == "grid")
   {
       $Ret_cancel_pesq = "volta_grid";
   }
   else
   {
       $Ret_cancel_pesq = "resumo";
   }
?>
   <INPUT type="hidden" name="nmgp_opcao" value="<?php echo $Ret_cancel_pesq; ?>"> 
   </FORM> 
<SCRIPT type="text/javascript">
<?php
   if (empty($this->NM_fil_ant))
   {
?>
      document.getElementById('Apaga_filters_bot').style.display = 'none';
      document.getElementById('sel_recup_filters_bot').style.display = 'none';
<?php
   }
?>
 function nm_submit_form()
 {
    document.F1.submit();
 }
 function limpa_form()
 {
   document.F1.reset();
   if (document.F1.NM_filters)
   {
       document.F1.NM_filters.selectedIndex = -1;
   }
   document.getElementById('Salvar_filters_bot').style.display = 'none';
   nm_campos_between(document.getElementById('id_vis_tp_thn_release'), document.F1.tp_thn_release_cond, 'tp_thn_release');
   document.F1.tp_thn_release.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_batch'), document.F1.tp_batch_cond, 'tp_batch');
   document.F1.tp_batch.value = "";
   document.F1.tp_batch_autocomp.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_jenisproject'), document.F1.tp_jenisproject_cond, 'tp_jenisproject');
   document.F1.tp_jenisproject.value = "";
   document.F1.tp_jenisproject_autocomp.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_prjtrelease'), document.F1.tp_prjtrelease_cond, 'tp_prjtrelease');
   document.F1.tp_prjtrelease.value = "";
   document.F1.tp_prjtrelease_autocomp.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_templateproject'), document.F1.tp_templateproject_cond, 'tp_templateproject');
   document.F1.tp_templateproject.value = "";
   document.F1.tp_templateproject_autocomp.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_status'), document.F1.tp_status_cond, 'tp_status');
   document.F1.tp_status.value = "";
   document.F1.tp_status_autocomp.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_planstart'), document.F1.tp_planstart_cond, 'tp_planstart');
   document.F1.tp_planstart_dia.value = "";
   document.F1.tp_planstart_mes.value = "";
   document.F1.tp_planstart_ano.value = "";
   document.F1.tp_planstart_input_2_dia.value = "";
   document.F1.tp_planstart_input_2_mes.value = "";
   document.F1.tp_planstart_input_2_ano.value = "";
   document.F1.tp_planstart_hor.value = "";
   document.F1.tp_planstart_min.value = "";
   document.F1.tp_planstart_seg.value = "";
   document.F1.tp_planstart_input_2_hor.value = "";
   document.F1.tp_planstart_input_2_min.value = "";
   document.F1.tp_planstart_input_2_seg.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_planfinish'), document.F1.tp_planfinish_cond, 'tp_planfinish');
   document.F1.tp_planfinish_dia.value = "";
   document.F1.tp_planfinish_mes.value = "";
   document.F1.tp_planfinish_ano.value = "";
   document.F1.tp_planfinish_input_2_dia.value = "";
   document.F1.tp_planfinish_input_2_mes.value = "";
   document.F1.tp_planfinish_input_2_ano.value = "";
   document.F1.tp_planfinish_hor.value = "";
   document.F1.tp_planfinish_min.value = "";
   document.F1.tp_planfinish_seg.value = "";
   document.F1.tp_planfinish_input_2_hor.value = "";
   document.F1.tp_planfinish_input_2_min.value = "";
   document.F1.tp_planfinish_input_2_seg.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_divre'), document.F1.tp_divre_cond, 'tp_divre');
   document.F1.tp_divre.value = "";
   document.F1.tp_divre_autocomp.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_witel'), document.F1.tp_witel_cond, 'tp_witel');
   document.F1.tp_witel.value = "";
   document.F1.tp_witel_autocomp.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_datel'), document.F1.tp_datel_cond, 'tp_datel');
   document.F1.tp_datel.value = "";
   document.F1.tp_datel_autocomp.value = "";
   nm_campos_between(document.getElementById('id_vis_tp_mitra'), document.F1.tp_mitra_cond, 'tp_mitra');
   document.F1.tp_mitra.value = "";
   document.F1.tp_mitra_autocomp.value = "";
 }
 function SC_carga_evt_jquery()
 {
    $('#SC_tp_planfinish_dia').bind('change', function() {sc_report_resume_project_othersview_valida_dia(this)});
    $('#SC_tp_planfinish_hor').bind('change', function() {sc_report_resume_project_othersview_valida_hora(this)});
    $('#SC_tp_planfinish_input_2_dia').bind('change', function() {sc_report_resume_project_othersview_valida_dia(this)});
    $('#SC_tp_planfinish_input_2_hor').bind('change', function() {sc_report_resume_project_othersview_valida_hora(this)});
    $('#SC_tp_planfinish_input_2_mes').bind('change', function() {sc_report_resume_project_othersview_valida_mes(this)});
    $('#SC_tp_planfinish_input_2_min').bind('change', function() {sc_report_resume_project_othersview_valida_min(this)});
    $('#SC_tp_planfinish_input_2_seg').bind('change', function() {sc_report_resume_project_othersview_valida_seg(this)});
    $('#SC_tp_planfinish_mes').bind('change', function() {sc_report_resume_project_othersview_valida_mes(this)});
    $('#SC_tp_planfinish_min').bind('change', function() {sc_report_resume_project_othersview_valida_min(this)});
    $('#SC_tp_planfinish_seg').bind('change', function() {sc_report_resume_project_othersview_valida_seg(this)});
    $('#SC_tp_planstart_dia').bind('change', function() {sc_report_resume_project_othersview_valida_dia(this)});
    $('#SC_tp_planstart_hor').bind('change', function() {sc_report_resume_project_othersview_valida_hora(this)});
    $('#SC_tp_planstart_input_2_dia').bind('change', function() {sc_report_resume_project_othersview_valida_dia(this)});
    $('#SC_tp_planstart_input_2_hor').bind('change', function() {sc_report_resume_project_othersview_valida_hora(this)});
    $('#SC_tp_planstart_input_2_mes').bind('change', function() {sc_report_resume_project_othersview_valida_mes(this)});
    $('#SC_tp_planstart_input_2_min').bind('change', function() {sc_report_resume_project_othersview_valida_min(this)});
    $('#SC_tp_planstart_input_2_seg').bind('change', function() {sc_report_resume_project_othersview_valida_seg(this)});
    $('#SC_tp_planstart_mes').bind('change', function() {sc_report_resume_project_othersview_valida_mes(this)});
    $('#SC_tp_planstart_min').bind('change', function() {sc_report_resume_project_othersview_valida_min(this)});
    $('#SC_tp_planstart_seg').bind('change', function() {sc_report_resume_project_othersview_valida_seg(this)});
 }
 function sc_report_resume_project_othersview_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
 function sc_report_resume_project_othersview_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
 function sc_report_resume_project_othersview_valida_hora(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 23))
     {
         if (confirm (Nm_erro['lang_jscr_ivtm'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
 function sc_report_resume_project_othersview_valida_min(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 59))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mint'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
 function sc_report_resume_project_othersview_valida_seg(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 59))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_secd'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { obj.focus(); }, 10);
         }
     }
 }
  mt  = document.getElementById('main_table');
  x_dim();
  function x_dim()
  {
     var W = mt.clientWidth,
         H = mt.clientHeight;
     if (0 == W || 0 == H)
     {
         setTimeout("x_dim()", 50);
     }
     else
     {
         strMaxHeight = Math.min(($(window.parent).height()-80), H);
         self.parent.tb_resize(strMaxHeight + 40, W + 40);
     }
 }
</SCRIPT>
</BODY>
</HTML>
<?php
   }

   function gera_array_filtros()
   {
       $this->NM_fil_ant = array();
       $NM_patch   = "projectamo/report_resume_project_othersview";
       if (is_dir($this->NM_path_filter . $NM_patch))
       {
           $NM_dir = @opendir($this->NM_path_filter . $NM_patch);
           while (FALSE !== ($NM_arq = @readdir($NM_dir)))
           {
             if (@is_file($this->NM_path_filter . $NM_patch . "/" . $NM_arq))
             {
                 $Sc_v6 = false;
                 $NMcmp_filter = file($this->NM_path_filter . $NM_patch . "/" . $NM_arq);
                 $NMcmp_filter = explode("@NMF@", $NMcmp_filter[0]);
                 if (substr($NMcmp_filter[0], 0, 6) == "SC_V6_" || substr($NMcmp_filter[0], 0, 6) == "SC_V8_")
                 {
                     $Name_filter = substr($NMcmp_filter[0], 6);
                     if (!empty($Name_filter))
                     {
                         $nmgp_save_name = str_replace('/', ' ', $Name_filter);
                         $nmgp_save_name = str_replace('\\', ' ', $nmgp_save_name);
                         $nmgp_save_name = str_replace('.', ' ', $nmgp_save_name);
                         $this->NM_fil_ant[$Name_filter][0] = $NM_patch . "/" . $nmgp_save_name;
                         $this->NM_fil_ant[$Name_filter][1] = "" . $this->Ini->Nm_lang['lang_srch_public'] . "";
                         $Sc_v6 = true;
                     }
                 }
                 if (!$Sc_v6)
                 {
                     $this->NM_fil_ant[$NM_arq][0] = $NM_patch . "/" . $NM_arq;
                     $this->NM_fil_ant[$NM_arq][1] = "" . $this->Ini->Nm_lang['lang_srch_public'] . "";
                 }
             }
           }
       }
       return $this->NM_fil_ant;
   }
   /**
    * @access  public
    * @param  string  $NM_operador  $this->Ini->Nm_lang['pesq_global_NM_operador']
    * @param  array  $nmgp_tab_label  
    */
   function inicializa_vars()
   {
      global $NM_operador, $nmgp_tab_label;

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/");  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1);  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz;
      $this->Campos_Mens_erro = ""; 
      $this->nm_data = new nm_data("en_us");
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] = "";
      if (!empty($nmgp_tab_label))
      {
         $nm_tab_campos = explode("?@?", $nmgp_tab_label);
         $nmgp_tab_label = array();
         foreach ($nm_tab_campos as $cada_campo)
         {
             $parte_campo = explode("?#?", $cada_campo);
             $nmgp_tab_label[$parte_campo[0]] = $parte_campo[1];
         }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_orig']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_orig'] = "";
      }
      $this->comando        = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_orig'];
      $this->comando_sum    = "";
      $this->comando_filtro = "";
      $this->comando_ini    = "ini";
      $this->comando_fim    = "";
      $this->NM_operador    = (isset($NM_operador) && ("and" == strtolower($NM_operador) || "or" == strtolower($NM_operador))) ? $NM_operador : "and";
   }

   function salva_filtro()
   {
      global $NM_filters_save, $nmgp_save_name, $nmgp_save_option, $script_case_init;
          $NM_filters_save = str_replace("__NM_PLUS__", "+", $NM_filters_save);
          $NM_str_filter  = "SC_V8_" . $nmgp_save_name . "@NMF@";
          $nmgp_save_name = str_replace('/', ' ', $nmgp_save_name);
          $nmgp_save_name = str_replace('\\', ' ', $nmgp_save_name);
          $nmgp_save_name = str_replace('.', ' ', $nmgp_save_name);
          if (!NM_is_utf8($nmgp_save_name))
          {
              $nmgp_save_name = sc_convert_encoding($nmgp_save_name, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $NM_str_filter  .= $NM_filters_save;
          $NM_patch = $this->NM_path_filter;
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $NM_patch .= "projectamo/";
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $NM_patch .= "report_resume_project_othersview/";
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $Parms_usr  = "";
          $NM_filter = fopen ($NM_patch . $nmgp_save_name, 'w');
          if (!NM_is_utf8($NM_str_filter))
          {
              $NM_str_filter = sc_convert_encoding($NM_str_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          fwrite($NM_filter, $NM_str_filter);
          fclose($NM_filter);
   }
   function recupera_filtro()
   {
      global $NM_filters, $NM_operador, $script_case_init;
      $NM_patch = $this->NM_path_filter . "/" . $NM_filters;
      if (!is_file($NM_patch))
      {
          $NM_filters = sc_convert_encoding($NM_filters, "UTF-8", $_SESSION['scriptcase']['charset']);
          $NM_patch = $this->NM_path_filter . "/" . $NM_filters;
      }
      $return_fields = array();
      $tp_fields     = array();
      $tb_fields_esp = array();
      $tp_fields['SC_tp_thn_release_cond'] = 'cond';
      $tp_fields['SC_tp_thn_release'] = 'select';
      $tp_fields['SC_tp_batch_cond'] = 'cond';
      $tp_fields['SC_tp_batch'] = 'text_aut';
      $tp_fields['id_ac_tp_batch'] = 'text_aut';
      $tp_fields['SC_tp_jenisproject_cond'] = 'cond';
      $tp_fields['SC_tp_jenisproject'] = 'text_aut';
      $tp_fields['id_ac_tp_jenisproject'] = 'text_aut';
      $tp_fields['SC_tp_prjtrelease_cond'] = 'cond';
      $tp_fields['SC_tp_prjtrelease'] = 'text_aut';
      $tp_fields['id_ac_tp_prjtrelease'] = 'text_aut';
      $tp_fields['SC_tp_templateproject_cond'] = 'cond';
      $tp_fields['SC_tp_templateproject'] = 'text_aut';
      $tp_fields['id_ac_tp_templateproject'] = 'text_aut';
      $tp_fields['SC_tp_status_cond'] = 'cond';
      $tp_fields['SC_tp_status'] = 'text_aut';
      $tp_fields['id_ac_tp_status'] = 'text_aut';
      $tp_fields['SC_tp_planstart_cond'] = 'cond';
      $tp_fields['SC_tp_planstart_dia'] = 'text';
      $tp_fields['SC_tp_planstart_mes'] = 'text';
      $tp_fields['SC_tp_planstart_ano'] = 'text';
      $tp_fields['SC_tp_planstart_input_2_dia'] = 'text';
      $tp_fields['SC_tp_planstart_input_2_mes'] = 'text';
      $tp_fields['SC_tp_planstart_input_2_ano'] = 'text';
      $tp_fields['SC_tp_planstart_hor'] = 'text';
      $tp_fields['SC_tp_planstart_min'] = 'text';
      $tp_fields['SC_tp_planstart_seg'] = 'text';
      $tp_fields['SC_tp_planstart_input_2_hor'] = 'text';
      $tp_fields['SC_tp_planstart_input_2_min'] = 'text';
      $tp_fields['SC_tp_planstart_input_2_seg'] = 'text';
      $tp_fields['SC_tp_planfinish_cond'] = 'cond';
      $tp_fields['SC_tp_planfinish_dia'] = 'text';
      $tp_fields['SC_tp_planfinish_mes'] = 'text';
      $tp_fields['SC_tp_planfinish_ano'] = 'text';
      $tp_fields['SC_tp_planfinish_input_2_dia'] = 'text';
      $tp_fields['SC_tp_planfinish_input_2_mes'] = 'text';
      $tp_fields['SC_tp_planfinish_input_2_ano'] = 'text';
      $tp_fields['SC_tp_planfinish_hor'] = 'text';
      $tp_fields['SC_tp_planfinish_min'] = 'text';
      $tp_fields['SC_tp_planfinish_seg'] = 'text';
      $tp_fields['SC_tp_planfinish_input_2_hor'] = 'text';
      $tp_fields['SC_tp_planfinish_input_2_min'] = 'text';
      $tp_fields['SC_tp_planfinish_input_2_seg'] = 'text';
      $tp_fields['SC_tp_divre_cond'] = 'cond';
      $tp_fields['SC_tp_divre'] = 'text_aut';
      $tp_fields['id_ac_tp_divre'] = 'text_aut';
      $tp_fields['SC_tp_witel_cond'] = 'cond';
      $tp_fields['SC_tp_witel'] = 'text_aut';
      $tp_fields['id_ac_tp_witel'] = 'text_aut';
      $tp_fields['SC_tp_datel_cond'] = 'cond';
      $tp_fields['SC_tp_datel'] = 'text_aut';
      $tp_fields['id_ac_tp_datel'] = 'text_aut';
      $tp_fields['SC_tp_mitra_cond'] = 'cond';
      $tp_fields['SC_tp_mitra'] = 'text_aut';
      $tp_fields['id_ac_tp_mitra'] = 'text_aut';
      if (is_file($NM_patch))
      {
          $SC_V8    = false;
          $NMfilter = file($NM_patch);
          $NMcmp_filter = explode("@NMF@", $NMfilter[0]);
          if (substr($NMcmp_filter[0], 0, 5) == "SC_V8")
          {
              $SC_V8 = true;
          }
          if (substr($NMcmp_filter[0], 0, 5) == "SC_V6" || substr($NMcmp_filter[0], 0, 5) == "SC_V8")
          {
              unset($NMcmp_filter[0]);
          }
          foreach ($NMcmp_filter as $Cada_cmp)
          {
              $Cada_cmp = explode("#NMF#", $Cada_cmp);
              if (isset($tb_fields_esp[$Cada_cmp[0]]))
              {
                  $Cada_cmp[0] = $tb_fields_esp[$Cada_cmp[0]];
              }
              if (!$SC_V8 && substr($Cada_cmp[0], 0, 11) != "div_ac_lab_" && substr($Cada_cmp[0], 0, 6) != "id_ac_" && substr($Cada_cmp[0], 0, 11) != "NM_operador")
              {
                  $Cada_cmp[0] = "SC_" . $Cada_cmp[0];
              }
              if (!isset($tp_fields[$Cada_cmp[0]]))
              {
                  continue;
              }
              $list   = array();
              $list_a = array();
              if (substr($Cada_cmp[1], 0, 10) == "_NM_array_")
              {
                  if (substr($Cada_cmp[1], 0, 17) == "_NM_array_#NMARR#")
                  {
                      $Sc_temp = explode("#NMARR#", substr($Cada_cmp[1], 17));
                      foreach ($Sc_temp as $Cada_val)
                      {
                          $list[]   = $Cada_val;
                          $tmp_pos  = strpos($Cada_val, "##@@");
                          $val_a    = ($tmp_pos !== false) ?  substr($Cada_val, $tmp_pos + 4) : $Cada_val;
                          $list_a[] = array('opt' => $Cada_val, 'value' => $val_a);
                      }
                  }
              }
              else
              {
                  $list[0] = $Cada_cmp[1];
              }
              if ($tp_fields[$Cada_cmp[0]] == 'dselect')
              {
                  $return_fields['set_dselect'][] = array('field' => $Cada_cmp[0], 'value' => $list_a);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'fil_order')
              {
                  $return_fields['set_fil_order'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'selmult')
              {
                  $return_fields['set_selmult'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'checkbox')
              {
                  $return_fields['set_checkbox'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              else
              {
                  if (!isset($list[0]))
                  {
                      $list[0] = "";
                  }
                  if ($tp_fields[$Cada_cmp[0]] == 'html')
                  {
                      $return_fields['set_html'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
                  elseif ($tp_fields[$Cada_cmp[0]] == 'radio')
                  {
                      $return_fields['set_radio'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
                  else
                  {
                      $return_fields['set_val'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
              }
          }
          $this->NM_curr_fil = $NM_filters;
      }
      return $return_fields;
   }
   function apaga_filtro()
   {
      global $NM_filters_del;
      if (isset($NM_filters_del) && !empty($NM_filters_del))
      { 
          $NM_patch = $this->NM_path_filter . "/" . $NM_filters_del;
          if (!is_file($NM_patch))
          {
              $NM_filters_del = sc_convert_encoding($NM_filters_del, "UTF-8", $_SESSION['scriptcase']['charset']);
              $NM_patch = $this->NM_path_filter . "/" . $NM_filters_del;
          }
          if (is_file($NM_patch))
          {
              @unlink($NM_patch);
          }
          if ($NM_filters_del == $this->NM_curr_fil)
          {
              $this->NM_curr_fil = "";
          }
      }
   }
   /**
    * @access  public
    */
   function trata_campos()
   {
      global $tp_thn_release_cond, $tp_thn_release,
             $tp_batch_cond, $tp_batch, $tp_batch_autocomp,
             $tp_jenisproject_cond, $tp_jenisproject, $tp_jenisproject_autocomp,
             $tp_prjtrelease_cond, $tp_prjtrelease, $tp_prjtrelease_autocomp,
             $tp_templateproject_cond, $tp_templateproject, $tp_templateproject_autocomp,
             $tp_status_cond, $tp_status, $tp_status_autocomp,
             $tp_planstart_cond, $tp_planstart, $tp_planstart_dia, $tp_planstart_mes, $tp_planstart_ano, $tp_planstart_hor, $tp_planstart_min, $tp_planstart_seg, $tp_planstart_input_2_dia, $tp_planstart_input_2_mes, $tp_planstart_input_2_ano, $tp_planstart_input_2_min, $tp_planstart_input_2_hor, $tp_planstart_input_2_seg,
             $tp_planfinish_cond, $tp_planfinish, $tp_planfinish_dia, $tp_planfinish_mes, $tp_planfinish_ano, $tp_planfinish_hor, $tp_planfinish_min, $tp_planfinish_seg, $tp_planfinish_input_2_dia, $tp_planfinish_input_2_mes, $tp_planfinish_input_2_ano, $tp_planfinish_input_2_min, $tp_planfinish_input_2_hor, $tp_planfinish_input_2_seg,
             $tp_divre_cond, $tp_divre, $tp_divre_autocomp,
             $tp_witel_cond, $tp_witel, $tp_witel_autocomp,
             $tp_datel_cond, $tp_datel, $tp_datel_autocomp,
             $tp_mitra_cond, $tp_mitra, $tp_mitra_autocomp, $nmgp_tab_label;

      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      if (!empty($tp_batch_autocomp) && empty($tp_batch))
      {
          $tp_batch = $tp_batch_autocomp;
      }
      if (!empty($tp_jenisproject_autocomp) && empty($tp_jenisproject))
      {
          $tp_jenisproject = $tp_jenisproject_autocomp;
      }
      if (!empty($tp_prjtrelease_autocomp) && empty($tp_prjtrelease))
      {
          $tp_prjtrelease = $tp_prjtrelease_autocomp;
      }
      if (!empty($tp_templateproject_autocomp) && empty($tp_templateproject))
      {
          $tp_templateproject = $tp_templateproject_autocomp;
      }
      if (!empty($tp_status_autocomp) && empty($tp_status))
      {
          $tp_status = $tp_status_autocomp;
      }
      if (!empty($tp_divre_autocomp) && empty($tp_divre))
      {
          $tp_divre = $tp_divre_autocomp;
      }
      if (!empty($tp_witel_autocomp) && empty($tp_witel))
      {
          $tp_witel = $tp_witel_autocomp;
      }
      if (!empty($tp_datel_autocomp) && empty($tp_datel))
      {
          $tp_datel = $tp_datel_autocomp;
      }
      if (!empty($tp_mitra_autocomp) && empty($tp_mitra))
      {
          $tp_mitra = $tp_mitra_autocomp;
      }
      $tp_thn_release_cond_salva = $tp_thn_release_cond; 
      if (!isset($tp_thn_release_input_2) || $tp_thn_release_input_2 == "")
      {
          $tp_thn_release_input_2 = $tp_thn_release;
      }
      $tp_batch_cond_salva = $tp_batch_cond; 
      if (!isset($tp_batch_input_2) || $tp_batch_input_2 == "")
      {
          $tp_batch_input_2 = $tp_batch;
      }
      $tp_jenisproject_cond_salva = $tp_jenisproject_cond; 
      if (!isset($tp_jenisproject_input_2) || $tp_jenisproject_input_2 == "")
      {
          $tp_jenisproject_input_2 = $tp_jenisproject;
      }
      $tp_prjtrelease_cond_salva = $tp_prjtrelease_cond; 
      if (!isset($tp_prjtrelease_input_2) || $tp_prjtrelease_input_2 == "")
      {
          $tp_prjtrelease_input_2 = $tp_prjtrelease;
      }
      $tp_templateproject_cond_salva = $tp_templateproject_cond; 
      if (!isset($tp_templateproject_input_2) || $tp_templateproject_input_2 == "")
      {
          $tp_templateproject_input_2 = $tp_templateproject;
      }
      $tp_status_cond_salva = $tp_status_cond; 
      if (!isset($tp_status_input_2) || $tp_status_input_2 == "")
      {
          $tp_status_input_2 = $tp_status;
      }
      $tp_planstart_cond_salva = $tp_planstart_cond; 
      if (!isset($tp_planstart_input_2_dia) || $tp_planstart_input_2_dia == "")
      {
          $tp_planstart_input_2_dia = $tp_planstart_dia;
      }
      if (!isset($tp_planstart_input_2_mes) || $tp_planstart_input_2_mes == "")
      {
          $tp_planstart_input_2_mes = $tp_planstart_mes;
      }
      if (!isset($tp_planstart_input_2_ano) || $tp_planstart_input_2_ano == "")
      {
          $tp_planstart_input_2_ano = $tp_planstart_ano;
      }
      if (!isset($tp_planstart_input_2_hor) || $tp_planstart_input_2_hor == "")
      {
          $tp_planstart_input_2_hor = $tp_planstart_hor;
      }
      if (!isset($tp_planstart_input_2_min) || $tp_planstart_input_2_min == "")
      {
          $tp_planstart_input_2_min = $tp_planstart_min;
      }
      if (!isset($tp_planstart_input_2_seg) || $tp_planstart_input_2_seg == "")
      {
          $tp_planstart_input_2_seg = $tp_planstart_seg;
      }
      $tp_planfinish_cond_salva = $tp_planfinish_cond; 
      if (!isset($tp_planfinish_input_2_dia) || $tp_planfinish_input_2_dia == "")
      {
          $tp_planfinish_input_2_dia = $tp_planfinish_dia;
      }
      if (!isset($tp_planfinish_input_2_mes) || $tp_planfinish_input_2_mes == "")
      {
          $tp_planfinish_input_2_mes = $tp_planfinish_mes;
      }
      if (!isset($tp_planfinish_input_2_ano) || $tp_planfinish_input_2_ano == "")
      {
          $tp_planfinish_input_2_ano = $tp_planfinish_ano;
      }
      if (!isset($tp_planfinish_input_2_hor) || $tp_planfinish_input_2_hor == "")
      {
          $tp_planfinish_input_2_hor = $tp_planfinish_hor;
      }
      if (!isset($tp_planfinish_input_2_min) || $tp_planfinish_input_2_min == "")
      {
          $tp_planfinish_input_2_min = $tp_planfinish_min;
      }
      if (!isset($tp_planfinish_input_2_seg) || $tp_planfinish_input_2_seg == "")
      {
          $tp_planfinish_input_2_seg = $tp_planfinish_seg;
      }
      $tp_divre_cond_salva = $tp_divre_cond; 
      if (!isset($tp_divre_input_2) || $tp_divre_input_2 == "")
      {
          $tp_divre_input_2 = $tp_divre;
      }
      $tp_witel_cond_salva = $tp_witel_cond; 
      if (!isset($tp_witel_input_2) || $tp_witel_input_2 == "")
      {
          $tp_witel_input_2 = $tp_witel;
      }
      $tp_datel_cond_salva = $tp_datel_cond; 
      if (!isset($tp_datel_input_2) || $tp_datel_input_2 == "")
      {
          $tp_datel_input_2 = $tp_datel;
      }
      $tp_mitra_cond_salva = $tp_mitra_cond; 
      if (!isset($tp_mitra_input_2) || $tp_mitra_input_2 == "")
      {
          $tp_mitra_input_2 = $tp_mitra;
      }
      $tmp_pos = strpos($tp_thn_release, "##@@");
      if ($tmp_pos === false) {
          $L_lookup = $tp_thn_release;
      }
      else {
          $L_lookup = substr($tp_thn_release, 0, $tmp_pos);
      }
      if (!empty($L_lookup) && !in_array($L_lookup, $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['psq_check_ret']['tp_thn_release'])) {
          if (!empty($this->Campos_Mens_erro)) {$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Project Release : " . $this->Ini->Nm_lang['lang_errm_ajax_data'];
      }
      if ($tp_jenisproject_cond != "in")
      {
          nm_limpa_numero($tp_jenisproject, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      else
      {
          $Nm_sc_valores = explode(",", $tp_jenisproject);
          foreach ($Nm_sc_valores as $II => $Nm_sc_valor)
          {
              $Nm_sc_valor = trim($Nm_sc_valor);
              nm_limpa_numero($Nm_sc_valor, $_SESSION['scriptcase']['reg_conf']['grup_num']); 
              $Nm_sc_valores[$II] = $Nm_sc_valor;
          }
          $tp_jenisproject = implode(",", $Nm_sc_valores);
      }
      if ($tp_prjtrelease_cond != "in")
      {
          nm_limpa_numero($tp_prjtrelease, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      else
      {
          $Nm_sc_valores = explode(",", $tp_prjtrelease);
          foreach ($Nm_sc_valores as $II => $Nm_sc_valor)
          {
              $Nm_sc_valor = trim($Nm_sc_valor);
              nm_limpa_numero($Nm_sc_valor, $_SESSION['scriptcase']['reg_conf']['grup_num']); 
              $Nm_sc_valores[$II] = $Nm_sc_valor;
          }
          $tp_prjtrelease = implode(",", $Nm_sc_valores);
      }
      if ($tp_templateproject_cond != "in")
      {
          nm_limpa_numero($tp_templateproject, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      else
      {
          $Nm_sc_valores = explode(",", $tp_templateproject);
          foreach ($Nm_sc_valores as $II => $Nm_sc_valor)
          {
              $Nm_sc_valor = trim($Nm_sc_valor);
              nm_limpa_numero($Nm_sc_valor, $_SESSION['scriptcase']['reg_conf']['grup_num']); 
              $Nm_sc_valores[$II] = $Nm_sc_valor;
          }
          $tp_templateproject = implode(",", $Nm_sc_valores);
      }
      if ($tp_status_cond != "in")
      {
          nm_limpa_numero($tp_status, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      else
      {
          $Nm_sc_valores = explode(",", $tp_status);
          foreach ($Nm_sc_valores as $II => $Nm_sc_valor)
          {
              $Nm_sc_valor = trim($Nm_sc_valor);
              nm_limpa_numero($Nm_sc_valor, $_SESSION['scriptcase']['reg_conf']['grup_num']); 
              $Nm_sc_valores[$II] = $Nm_sc_valor;
          }
          $tp_status = implode(",", $Nm_sc_valores);
      }
      if ($tp_divre_cond != "in")
      {
          nm_limpa_numero($tp_divre, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      else
      {
          $Nm_sc_valores = explode(",", $tp_divre);
          foreach ($Nm_sc_valores as $II => $Nm_sc_valor)
          {
              $Nm_sc_valor = trim($Nm_sc_valor);
              nm_limpa_numero($Nm_sc_valor, $_SESSION['scriptcase']['reg_conf']['grup_num']); 
              $Nm_sc_valores[$II] = $Nm_sc_valor;
          }
          $tp_divre = implode(",", $Nm_sc_valores);
      }
      if ($tp_witel_cond != "in")
      {
          nm_limpa_numero($tp_witel, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      else
      {
          $Nm_sc_valores = explode(",", $tp_witel);
          foreach ($Nm_sc_valores as $II => $Nm_sc_valor)
          {
              $Nm_sc_valor = trim($Nm_sc_valor);
              nm_limpa_numero($Nm_sc_valor, $_SESSION['scriptcase']['reg_conf']['grup_num']); 
              $Nm_sc_valores[$II] = $Nm_sc_valor;
          }
          $tp_witel = implode(",", $Nm_sc_valores);
      }
      if ($tp_datel_cond != "in")
      {
          nm_limpa_numero($tp_datel, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      else
      {
          $Nm_sc_valores = explode(",", $tp_datel);
          foreach ($Nm_sc_valores as $II => $Nm_sc_valor)
          {
              $Nm_sc_valor = trim($Nm_sc_valor);
              nm_limpa_numero($Nm_sc_valor, $_SESSION['scriptcase']['reg_conf']['grup_num']); 
              $Nm_sc_valores[$II] = $Nm_sc_valor;
          }
          $tp_datel = implode(",", $Nm_sc_valores);
      }
      if ($tp_mitra_cond != "in")
      {
          nm_limpa_numero($tp_mitra, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      else
      {
          $Nm_sc_valores = explode(",", $tp_mitra);
          foreach ($Nm_sc_valores as $II => $Nm_sc_valor)
          {
              $Nm_sc_valor = trim($Nm_sc_valor);
              nm_limpa_numero($Nm_sc_valor, $_SESSION['scriptcase']['reg_conf']['grup_num']); 
              $Nm_sc_valores[$II] = $Nm_sc_valor;
          }
          $tp_mitra = implode(",", $Nm_sc_valores);
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_thn_release'] = $tp_thn_release; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_thn_release_cond'] = $tp_thn_release_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_batch'] = $tp_batch; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_batch_cond'] = $tp_batch_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_jenisproject'] = $tp_jenisproject; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_jenisproject_cond'] = $tp_jenisproject_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_prjtrelease'] = $tp_prjtrelease; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_prjtrelease_cond'] = $tp_prjtrelease_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_templateproject'] = $tp_templateproject; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_templateproject_cond'] = $tp_templateproject_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_status'] = $tp_status; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_status_cond'] = $tp_status_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_dia'] = $tp_planstart_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_mes'] = $tp_planstart_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_ano'] = $tp_planstart_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_dia'] = $tp_planstart_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_mes'] = $tp_planstart_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_ano'] = $tp_planstart_input_2_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_hor'] = $tp_planstart_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_min'] = $tp_planstart_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_seg'] = $tp_planstart_seg; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_hor'] = $tp_planstart_input_2_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_min'] = $tp_planstart_input_2_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2_seg'] = $tp_planstart_input_2_seg; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_cond'] = $tp_planstart_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_dia'] = $tp_planfinish_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_mes'] = $tp_planfinish_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_ano'] = $tp_planfinish_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_dia'] = $tp_planfinish_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_mes'] = $tp_planfinish_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_ano'] = $tp_planfinish_input_2_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_hor'] = $tp_planfinish_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_min'] = $tp_planfinish_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_seg'] = $tp_planfinish_seg; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_hor'] = $tp_planfinish_input_2_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_min'] = $tp_planfinish_input_2_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2_seg'] = $tp_planfinish_input_2_seg; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_cond'] = $tp_planfinish_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_divre'] = $tp_divre; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_divre_cond'] = $tp_divre_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_witel'] = $tp_witel; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_witel_cond'] = $tp_witel_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_datel'] = $tp_datel; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_datel_cond'] = $tp_datel_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_mitra'] = $tp_mitra; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_mitra_cond'] = $tp_mitra_cond_salva; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['NM_operador'] = $this->NM_operador; 
      if ($tp_jenisproject_cond != "in" && $tp_jenisproject_cond != "bw" && !empty($tp_jenisproject) && !is_numeric($tp_jenisproject))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Jenis Project";
      }
      if ($tp_jenisproject_cond == "bw" && ((!empty($tp_jenisproject) && !is_numeric($tp_jenisproject)) || (!empty($tp_jenisproject_input_2) && !is_numeric($tp_jenisproject_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Jenis Project";
      }
      if ($tp_prjtrelease_cond != "in" && $tp_prjtrelease_cond != "bw" && !empty($tp_prjtrelease) && !is_numeric($tp_prjtrelease))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Release Project";
      }
      if ($tp_prjtrelease_cond == "bw" && ((!empty($tp_prjtrelease) && !is_numeric($tp_prjtrelease)) || (!empty($tp_prjtrelease_input_2) && !is_numeric($tp_prjtrelease_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Release Project";
      }
      if ($tp_templateproject_cond != "in" && $tp_templateproject_cond != "bw" && !empty($tp_templateproject) && !is_numeric($tp_templateproject))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Project Template";
      }
      if ($tp_templateproject_cond == "bw" && ((!empty($tp_templateproject) && !is_numeric($tp_templateproject)) || (!empty($tp_templateproject_input_2) && !is_numeric($tp_templateproject_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Project Template";
      }
      if ($tp_status_cond != "in" && $tp_status_cond != "bw" && !empty($tp_status) && !is_numeric($tp_status))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Status";
      }
      if ($tp_status_cond == "bw" && ((!empty($tp_status) && !is_numeric($tp_status)) || (!empty($tp_status_input_2) && !is_numeric($tp_status_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Status";
      }
      if ($tp_divre_cond != "in" && $tp_divre_cond != "bw" && !empty($tp_divre) && !is_numeric($tp_divre))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Divre";
      }
      if ($tp_divre_cond == "bw" && ((!empty($tp_divre) && !is_numeric($tp_divre)) || (!empty($tp_divre_input_2) && !is_numeric($tp_divre_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Divre";
      }
      if ($tp_witel_cond != "in" && $tp_witel_cond != "bw" && !empty($tp_witel) && !is_numeric($tp_witel))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Witel";
      }
      if ($tp_witel_cond == "bw" && ((!empty($tp_witel) && !is_numeric($tp_witel)) || (!empty($tp_witel_input_2) && !is_numeric($tp_witel_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Witel";
      }
      if ($tp_datel_cond != "in" && $tp_datel_cond != "bw" && !empty($tp_datel) && !is_numeric($tp_datel))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Datel";
      }
      if ($tp_datel_cond == "bw" && ((!empty($tp_datel) && !is_numeric($tp_datel)) || (!empty($tp_datel_input_2) && !is_numeric($tp_datel_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : Datel";
      }
      if ($tp_mitra_cond != "in" && $tp_mitra_cond != "bw" && !empty($tp_mitra) && !is_numeric($tp_mitra))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : ID Mitra";
      }
      if ($tp_mitra_cond == "bw" && ((!empty($tp_mitra) && !is_numeric($tp_mitra)) || (!empty($tp_mitra_input_2) && !is_numeric($tp_mitra_input_2)) ))
      {
          if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $this->Ini->Nm_lang['lang_errm_ajax_data'] . " : ID Mitra";
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      $Conteudo = $tp_thn_release;
      if (strpos($Conteudo, "##@@") !== false)
      {
          $Conteudo = substr($Conteudo, strpos($Conteudo, "##@@") + 4);
      }
      $this->cmp_formatado['tp_thn_release'] = $Conteudo;
      $tp_batch_look = substr($this->Db->qstr($tp_batch), 1, -1); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct TP_BATCH from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_BATCH = '$tp_batch_look' order by TP_BATCH"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_batch'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_batch'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tp_batch'] = $tp_batch;
      }
      $tp_jenisproject_look = substr($this->Db->qstr($tp_jenisproject), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_jenisproject))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_JENISPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_JENISPROJECT = $tp_jenisproject_look order by TP_JENISPROJECT"; 
      }
      else
      {
          $nm_comando = "select distinct TP_JENISPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_JENISPROJECT = $tp_jenisproject_look order by TP_JENISPROJECT"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 

      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_jenisproject'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_jenisproject'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tp_jenisproject'] = $tp_jenisproject;
      }
      $tp_prjtrelease_look = substr($this->Db->qstr($tp_prjtrelease), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_prjtrelease))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_PRJTRELEASE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_PRJTRELEASE = $tp_prjtrelease_look order by TP_PRJTRELEASE"; 
      }
      else
      {
          $nm_comando = "select distinct TP_PRJTRELEASE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_PRJTRELEASE = $tp_prjtrelease_look order by TP_PRJTRELEASE"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 

      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_prjtrelease'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_prjtrelease'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tp_prjtrelease'] = $tp_prjtrelease;
      }
      $tp_templateproject_look = substr($this->Db->qstr($tp_templateproject), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_templateproject))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_TEMPLATEPROJECT = $tp_templateproject_look order by TP_TEMPLATEPROJECT"; 
      }
      else
      {
          $nm_comando = "select distinct TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_TEMPLATEPROJECT = $tp_templateproject_look order by TP_TEMPLATEPROJECT"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 

      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_templateproject'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_templateproject'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tp_templateproject'] = $tp_templateproject;
      }
      $tp_status_look = substr($this->Db->qstr($tp_status), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_status))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_STATUS from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_STATUS = $tp_status_look order by TP_STATUS"; 
      }
      else
      {
          $nm_comando = "select distinct TP_STATUS from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_STATUS = $tp_status_look order by TP_STATUS"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 

      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_status'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_status'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tp_status'] = $tp_status;
      }
      $tp_divre_look = substr($this->Db->qstr($tp_divre), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_divre))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_DIVRE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_DIVRE = $tp_divre_look order by TP_DIVRE"; 
      }
      else
      {
          $nm_comando = "select distinct TP_DIVRE from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_DIVRE = $tp_divre_look order by TP_DIVRE"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 

      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_divre'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_divre'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tp_divre'] = $tp_divre;
      }
      $tp_witel_look = substr($this->Db->qstr($tp_witel), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_witel))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_WITEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_WITEL = $tp_witel_look order by TP_WITEL"; 
      }
      else
      {
          $nm_comando = "select distinct TP_WITEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_WITEL = $tp_witel_look order by TP_WITEL"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 

      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_witel'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_witel'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tp_witel'] = $tp_witel;
      }
      $tp_datel_look = substr($this->Db->qstr($tp_datel), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_datel))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_DATEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_DATEL = $tp_datel_look order by TP_DATEL"; 
      }
      else
      {
          $nm_comando = "select distinct TP_DATEL from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_DATEL = $tp_datel_look order by TP_DATEL"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 

      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_datel'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_datel'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tp_datel'] = $tp_datel;
      }
      $tp_mitra_look = substr($this->Db->qstr($tp_mitra), 1, -1); 
      $nmgp_def_dados = array(); 
   if (is_numeric($tp_mitra))
   { 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      {
          $nm_comando = "select distinct TP_MITRA from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_MITRA = $tp_mitra_look order by TP_MITRA"; 
      }
      else
      {
          $nm_comando = "select distinct TP_MITRA from " . $this->Ini->nm_tabela . " where TP_DIVRE=" . $_SESSION['iddivre'] . " and TP_MITRA = $tp_mitra_look order by TP_MITRA"; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      { 
         while (!$rs->EOF) 
         { 
            nmgp_Form_Num_Val($rs->fields[0], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
   } 

      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_mitra'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tp_mitra'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tp_mitra'] = $tp_mitra;
      }

      //----- $tp_thn_release
      $this->Date_part = false;
      if (isset($tp_thn_release))
      {
         $this->monta_condicao("TP_THN_RELEASE", $tp_thn_release_cond, $tp_thn_release, "", "tp_thn_release");
      }

      //----- $tp_batch
      $this->Date_part = false;
      if (isset($tp_batch) || $tp_batch_cond == "nu" || $tp_batch_cond == "nn" || $tp_batch_cond == "ep" || $tp_batch_cond == "ne")
      {
         $this->monta_condicao("TP_BATCH", $tp_batch_cond, $tp_batch, "", "tp_batch");
      }

      //----- $tp_jenisproject
      $this->Date_part = false;
      if (isset($tp_jenisproject) || $tp_jenisproject_cond == "nu" || $tp_jenisproject_cond == "nn" || $tp_jenisproject_cond == "ep" || $tp_jenisproject_cond == "ne")
      {
         $this->monta_condicao("TP_JENISPROJECT", $tp_jenisproject_cond, $tp_jenisproject, "", "tp_jenisproject");
      }

      //----- $tp_prjtrelease
      $this->Date_part = false;
      if (isset($tp_prjtrelease) || $tp_prjtrelease_cond == "nu" || $tp_prjtrelease_cond == "nn" || $tp_prjtrelease_cond == "ep" || $tp_prjtrelease_cond == "ne")
      {
         $this->monta_condicao("TP_PRJTRELEASE", $tp_prjtrelease_cond, $tp_prjtrelease, "", "tp_prjtrelease");
      }

      //----- $tp_templateproject
      $this->Date_part = false;
      if (isset($tp_templateproject) || $tp_templateproject_cond == "nu" || $tp_templateproject_cond == "nn" || $tp_templateproject_cond == "ep" || $tp_templateproject_cond == "ne")
      {
         $this->monta_condicao("TP_TEMPLATEPROJECT", $tp_templateproject_cond, $tp_templateproject, "", "tp_templateproject");
      }

      //----- $tp_status
      $this->Date_part = false;
      if (isset($tp_status) || $tp_status_cond == "nu" || $tp_status_cond == "nn" || $tp_status_cond == "ep" || $tp_status_cond == "ne")
      {
         $this->monta_condicao("TP_STATUS", $tp_status_cond, $tp_status, "", "tp_status");
      }

      //----- $tp_planstart
      $this->Date_part = false;
      if ($tp_planstart_cond != "TP")
      {
          $tp_planstart_cond = strtoupper($tp_planstart_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tp_planstart_ano;
          $Dtxt .= $tp_planstart_mes;
          $Dtxt .= $tp_planstart_dia;
          $Dtxt .= $tp_planstart_hor;
          $Dtxt .= $tp_planstart_min;
          $Dtxt .= $tp_planstart_seg;
          $val[0]['ano'] = $tp_planstart_ano;
          $val[0]['mes'] = $tp_planstart_mes;
          $val[0]['dia'] = $tp_planstart_dia;
          $val[0]['hor'] = $tp_planstart_hor;
          $val[0]['min'] = $tp_planstart_min;
          $val[0]['seg'] = $tp_planstart_seg;
          if ($tp_planstart_cond == "BW")
          {
              $val[1]['ano'] = $tp_planstart_input_2_ano;
              $val[1]['mes'] = $tp_planstart_input_2_mes;
              $val[1]['dia'] = $tp_planstart_input_2_dia;
              $val[1]['hor'] = $tp_planstart_input_2_hor;
              $val[1]['min'] = $tp_planstart_input_2_min;
              $val[1]['seg'] = $tp_planstart_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "DH", "DATETIME", $tp_planstart_cond, "", "datahora");
          $tp_planstart = $val[0];
          $this->cmp_formatado['tp_planstart'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tp_planstart'], "YYYY-MM-DD HH:II:SS");
          $this->cmp_formatado['tp_planstart'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "dmY his"));
          if ($tp_planstart_cond == "BW")
          {
              $tp_planstart_input_2     = $val[1];
              $this->cmp_formatado['tp_planstart_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planstart_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tp_planstart_input_2'], "YYYY-MM-DD HH:II:SS");
              $this->cmp_formatado['tp_planstart_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "dmY his"));
          }
          if (!empty($Dtxt) || $tp_planstart_cond == "NU" || $tp_planstart_cond == "NN"|| $tp_planstart_cond == "EP"|| $tp_planstart_cond == "NE")
          {
              $this->monta_condicao("TP_PLANSTART", $tp_planstart_cond, $tp_planstart, $tp_planstart_input_2, 'tp_planstart', 'DATETIME');
          }
      }

      //----- $tp_planfinish
      $this->Date_part = false;
      if ($tp_planfinish_cond != "TP")
      {
          $tp_planfinish_cond = strtoupper($tp_planfinish_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tp_planfinish_ano;
          $Dtxt .= $tp_planfinish_mes;
          $Dtxt .= $tp_planfinish_dia;
          $Dtxt .= $tp_planfinish_hor;
          $Dtxt .= $tp_planfinish_min;
          $Dtxt .= $tp_planfinish_seg;
          $val[0]['ano'] = $tp_planfinish_ano;
          $val[0]['mes'] = $tp_planfinish_mes;
          $val[0]['dia'] = $tp_planfinish_dia;
          $val[0]['hor'] = $tp_planfinish_hor;
          $val[0]['min'] = $tp_planfinish_min;
          $val[0]['seg'] = $tp_planfinish_seg;
          if ($tp_planfinish_cond == "BW")
          {
              $val[1]['ano'] = $tp_planfinish_input_2_ano;
              $val[1]['mes'] = $tp_planfinish_input_2_mes;
              $val[1]['dia'] = $tp_planfinish_input_2_dia;
              $val[1]['hor'] = $tp_planfinish_input_2_hor;
              $val[1]['min'] = $tp_planfinish_input_2_min;
              $val[1]['seg'] = $tp_planfinish_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "DH", "DATETIME", $tp_planfinish_cond, "", "datahora");
          $tp_planfinish = $val[0];
          $this->cmp_formatado['tp_planfinish'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tp_planfinish'], "YYYY-MM-DD HH:II:SS");
          $this->cmp_formatado['tp_planfinish'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "dmY his"));
          if ($tp_planfinish_cond == "BW")
          {
              $tp_planfinish_input_2     = $val[1];
              $this->cmp_formatado['tp_planfinish_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']['tp_planfinish_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tp_planfinish_input_2'], "YYYY-MM-DD HH:II:SS");
              $this->cmp_formatado['tp_planfinish_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "dmY his"));
          }
          if (!empty($Dtxt) || $tp_planfinish_cond == "NU" || $tp_planfinish_cond == "NN"|| $tp_planfinish_cond == "EP"|| $tp_planfinish_cond == "NE")
          {
              $this->monta_condicao("TP_PLANFINISH", $tp_planfinish_cond, $tp_planfinish, $tp_planfinish_input_2, 'tp_planfinish', 'DATETIME');
          }
      }

      //----- $tp_divre
      $this->Date_part = false;
      if (isset($tp_divre) || $tp_divre_cond == "nu" || $tp_divre_cond == "nn" || $tp_divre_cond == "ep" || $tp_divre_cond == "ne")
      {
         $this->monta_condicao("TP_DIVRE", $tp_divre_cond, $tp_divre, "", "tp_divre");
      }

      //----- $tp_witel
      $this->Date_part = false;
      if (isset($tp_witel) || $tp_witel_cond == "nu" || $tp_witel_cond == "nn" || $tp_witel_cond == "ep" || $tp_witel_cond == "ne")
      {
         $this->monta_condicao("TP_WITEL", $tp_witel_cond, $tp_witel, "", "tp_witel");
      }

      //----- $tp_datel
      $this->Date_part = false;
      if (isset($tp_datel) || $tp_datel_cond == "nu" || $tp_datel_cond == "nn" || $tp_datel_cond == "ep" || $tp_datel_cond == "ne")
      {
         $this->monta_condicao("TP_DATEL", $tp_datel_cond, $tp_datel, "", "tp_datel");
      }

      //----- $tp_mitra
      $this->Date_part = false;
      if (isset($tp_mitra) || $tp_mitra_cond == "nu" || $tp_mitra_cond == "nn" || $tp_mitra_cond == "ep" || $tp_mitra_cond == "ne")
      {
         $this->monta_condicao("TP_MITRA", $tp_mitra_cond, $tp_mitra, "", "tp_mitra");
      }
   }

   /**
    * @access  public
    */
   function finaliza_resultado()
   {
      if ("" == $this->comando_filtro)
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_orig'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['campos_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }

      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($this->comando))
      {
          $this->comando     = NM_conv_charset($this->comando, $_SESSION['scriptcase']['charset'], "UTF-8");
          $this->comando_sum = NM_conv_charset($this->comando_sum, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq_lookup']  = $this->comando_sum . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq']         = $this->comando . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['opcao']              = "pesq";
      if ("" == $this->comando_filtro)
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq_filtro'] = "";
      }
      else
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq_filtro'] = " (" . $this->comando_filtro . ")";
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq_ant'])
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['cond_pesq'] .= $this->NM_operador;
         $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['contr_array_resumo'] = "NAO";
         $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['contr_total_geral']  = "NAO";
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['tot_geral']);
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['where_pesq_ant'] = $this->comando . $this->comando_fim;
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['report_resume_project_othersview']['fast_search']);

      $this->retorna_pesq();
   }
   
   function css_obj_select_ajax($Obj)
   {
      switch ($Obj)
      {
         case "tp_thn_release" : return ('class="scFilterObjectOdd"'); break;
         default       : return ("");
      }
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
}

?>
