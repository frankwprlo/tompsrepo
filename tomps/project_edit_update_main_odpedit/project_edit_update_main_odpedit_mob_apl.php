<?php
//
class project_edit_update_main_odpedit_mob_apl
{
   var $has_where_params = false;
   var $NM_is_redirected = false;
   var $NM_non_ajax_info = false;
   var $NM_ajax_flag    = false;
   var $NM_ajax_opcao   = '';
   var $NM_ajax_retorno = '';
   var $NM_ajax_info    = array('result'            => '',
                                'param'             => array(),
                                'autoComp'          => '',
                                'rsSize'            => '',
                                'msgDisplay'        => '',
                                'errList'           => array(),
                                'fldList'           => array(),
                                'focus'             => '',
                                'navStatus'         => array(),
                                'navSummary'        => array(),
                                'navPage'           => array(),
                                'redir'             => array(),
                                'blockDisplay'      => array(),
                                'fieldDisplay'      => array(),
                                'fieldLabel'        => array(),
                                'readOnly'          => array(),
                                'btnVars'           => array(),
                                'ajaxAlert'         => '',
                                'ajaxMessage'       => '',
                                'ajaxJavascript'    => array(),
                                'buttonDisplay'     => array(),
                                'buttonDisplayVert' => array(),
                                'calendarReload'    => false,
                                'quickSearchRes'    => false,
                                'displayMsg'        => false,
                                'displayMsgTxt'     => '',
                                'dyn_search'        => array(),
                                'empty_filter'      => '',
                               );
   var $NM_ajax_force_values = false;
   var $Nav_permite_ava     = true;
   var $Nav_permite_ret     = true;
   var $Apl_com_erro        = false;
   var $app_is_initializing = false;
   var $Ini;
   var $Erro;
   var $Db;
   var $tpmo_id;
   var $tpmo_projectid;
   var $tpmo_namanode;
   var $tpmo_awal;
   var $tpmo_jmlodp;
   var $tpmo_akhir;
   var $tpmo_entryby;
   var $tpmo_entrydate;
   var $tpmo_updateby;
   var $tpmo_updatedate;
   var $tpmo_merk;
   var $tpmo_kapport;
   var $tpmo_nosp;
   var $detail;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
   var $sc_insert_on;
   var $nmgp_clone;
   var $nmgp_return_img = array();
   var $nmgp_dados_form = array();
   var $nmgp_dados_select = array();
   var $nm_location;
   var $nm_flag_iframe;
   var $nm_flag_saida_novo;
   var $nmgp_botoes = array();
   var $nmgp_url_saida;
   var $nmgp_form_show;
   var $nmgp_form_empty;
   var $nmgp_cmp_readonly = array();
   var $nmgp_cmp_hidden = array();
   var $form_paginacao = 'parcial';
   var $lig_edit_lookup      = false;
   var $lig_edit_lookup_call = false;
   var $lig_edit_lookup_cb   = '';
   var $lig_edit_lookup_row  = '';
   var $is_calendar_app = false;
   var $Embutida_call  = false;
   var $Embutida_ronly = false;
   var $Embutida_proc  = false;
   var $Embutida_form  = false;
   var $Grid_editavel  = false;
   var $url_webhelp = '';
   var $nm_todas_criticas;
   var $Campos_Mens_erro;
   var $nm_new_label = array();
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['detail']))
          {
              $this->detail = $this->NM_ajax_info['param']['detail'];
          }
          if (isset($this->NM_ajax_info['param']['nm_form_submit']))
          {
              $this->nm_form_submit = $this->NM_ajax_info['param']['nm_form_submit'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ancora']))
          {
              $this->nmgp_ancora = $this->NM_ajax_info['param']['nmgp_ancora'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_dyn_search']))
          {
              $this->nmgp_arg_dyn_search = $this->NM_ajax_info['param']['nmgp_arg_dyn_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_num_form']))
          {
              $this->nmgp_num_form = $this->NM_ajax_info['param']['nmgp_num_form'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_opcao']))
          {
              $this->nmgp_opcao = $this->NM_ajax_info['param']['nmgp_opcao'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ordem']))
          {
              $this->nmgp_ordem = $this->NM_ajax_info['param']['nmgp_ordem'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_parms']))
          {
              $this->nmgp_parms = $this->NM_ajax_info['param']['nmgp_parms'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['tpmo_akhir']))
          {
              $this->tpmo_akhir = $this->NM_ajax_info['param']['tpmo_akhir'];
          }
          if (isset($this->NM_ajax_info['param']['tpmo_awal']))
          {
              $this->tpmo_awal = $this->NM_ajax_info['param']['tpmo_awal'];
          }
          if (isset($this->NM_ajax_info['param']['tpmo_id']))
          {
              $this->tpmo_id = $this->NM_ajax_info['param']['tpmo_id'];
          }
          if (isset($this->NM_ajax_info['param']['tpmo_jmlodp']))
          {
              $this->tpmo_jmlodp = $this->NM_ajax_info['param']['tpmo_jmlodp'];
          }
          if (isset($this->NM_ajax_info['param']['tpmo_kapport']))
          {
              $this->tpmo_kapport = $this->NM_ajax_info['param']['tpmo_kapport'];
          }
          if (isset($this->NM_ajax_info['param']['tpmo_merk']))
          {
              $this->tpmo_merk = $this->NM_ajax_info['param']['tpmo_merk'];
          }
          if (isset($this->NM_ajax_info['param']['tpmo_namanode']))
          {
              $this->tpmo_namanode = $this->NM_ajax_info['param']['tpmo_namanode'];
          }
          if (isset($this->NM_ajax_info['param']['tpmo_nosp']))
          {
              $this->tpmo_nosp = $this->NM_ajax_info['param']['tpmo_nosp'];
          }
          if (isset($this->NM_ajax_info['param']['tpmo_projectid']))
          {
              $this->tpmo_projectid = $this->NM_ajax_info['param']['tpmo_projectid'];
          }
          if (isset($this->nmgp_refresh_fields))
          {
              $this->nmgp_refresh_fields = explode('_#fld#_', $this->nmgp_refresh_fields);
              $this->nmgp_opcao          = 'recarga';
          }
          if (!isset($this->nmgp_refresh_row))
          {
              $this->nmgp_refresh_row = '';
          }
      }

      $this->sc_conv_var = array();
      if (!empty($_FILES))
      {
          foreach ($_FILES as $nmgp_campo => $nmgp_valores)
          {
               if (isset($this->sc_conv_var[$nmgp_campo]))
               {
                   $nmgp_campo = $this->sc_conv_var[$nmgp_campo];
               }
               elseif (isset($this->sc_conv_var[strtolower($nmgp_campo)]))
               {
                   $nmgp_campo = $this->sc_conv_var[strtolower($nmgp_campo)];
               }
               $tmp_scfile_name     = $nmgp_campo . "_scfile_name";
               $tmp_scfile_type     = $nmgp_campo . "_scfile_type";
               $this->$nmgp_campo = is_array($nmgp_valores['tmp_name']) ? $nmgp_valores['tmp_name'][0] : $nmgp_valores['tmp_name'];
               $this->$tmp_scfile_type   = is_array($nmgp_valores['type'])     ? $nmgp_valores['type'][0]     : $nmgp_valores['type'];
               $this->$tmp_scfile_name   = is_array($nmgp_valores['name'])     ? $nmgp_valores['name'][0]     : $nmgp_valores['name'];
          }
      }
      $Sc_lig_md5 = false;
      if (!empty($_POST))
      {
          foreach ($_POST as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                      $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (isset($this->sc_conv_var[$nmgp_var]))
               {
                   $nmgp_var = $this->sc_conv_var[$nmgp_var];
               }
               elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
               {
                   $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
               }
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (!empty($_GET))
      {
          foreach ($_GET as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                       $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (isset($this->sc_conv_var[$nmgp_var]))
               {
                   $nmgp_var = $this->sc_conv_var[$nmgp_var];
               }
               elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
               {
                   $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
               }
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
      {
          $_SESSION['sc_session']['SC_parm_violation'] = true;
      }
      if (isset($nmgp_parms) && $nmgp_parms == "SC_null")
      {
          $nmgp_parms = "";
      }
      if (isset($this->var_projectid) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['var_projectid'] = $this->var_projectid;
      }
      if (isset($this->usr_login) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_POST["var_projectid"]) && isset($this->var_projectid)) 
      {
          $_SESSION['var_projectid'] = $this->var_projectid;
      }
      if (isset($_POST["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_GET["var_projectid"]) && isset($this->var_projectid)) 
      {
          $_SESSION['var_projectid'] = $this->var_projectid;
      }
      if (isset($_GET["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($this->nm_run_menu) && $this->nm_run_menu == 1)
      { 
          $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['nm_run_menu'] = 1;
      } 
      if (isset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['embutida_parms']);
      } 
      if (isset($this->nmgp_parms) && !empty($this->nmgp_parms)) 
      { 
          if (isset($_SESSION['nm_aba_bg_color'])) 
          { 
              unset($_SESSION['nm_aba_bg_color']);
          }   
          $nmgp_parms = NM_decode_input($nmgp_parms);
          $nmgp_parms = str_replace("@aspass@", "'", $this->nmgp_parms);
          $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
          $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
          $todo  = explode("?@?", $todox);
          $ix = 0;
          while (!empty($todo[$ix]))
          {
             $cadapar = explode("?#?", $todo[$ix]);
             if (1 < sizeof($cadapar))
             {
                if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                {
                    $cadapar[0] = substr($cadapar[0], 11);
                    $cadapar[1] = $_SESSION[$cadapar[1]];
                }
                 if (isset($this->sc_conv_var[$cadapar[0]]))
                 {
                     $cadapar[0] = $this->sc_conv_var[$cadapar[0]];
                 }
                 elseif (isset($this->sc_conv_var[strtolower($cadapar[0])]))
                 {
                     $cadapar[0] = $this->sc_conv_var[strtolower($cadapar[0])];
                 }
                 nm_limpa_str_project_edit_update_main_odpedit_mob($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->var_projectid)) 
          {
              $_SESSION['var_projectid'] = $this->var_projectid;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['total']);
          }
          if (!isset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['total']))
          {
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['reg_start'] = "";
              unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['sc_redir_insert'] = $this->sc_redir_insert;
          }
          if (isset($this->var_projectid)) 
          {
              $_SESSION['var_projectid'] = $this->var_projectid;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['parms']);
              $todo  = explode("?@?", $todox);
              $ix = 0;
              while (!empty($todo[$ix]))
              {
                 $cadapar = explode("?#?", $todo[$ix]);
                 if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                 {
                     $cadapar[0] = substr($cadapar[0], 11);
                     $cadapar[1] = $_SESSION[$cadapar[1]];
                 }
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
                 $ix++;
              }
          }
      } 

      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new project_edit_update_main_odpedit_mob_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("en_us");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['initialize'];
          if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit']))
          {
              foreach ($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit'] as $I_conf => $Conf_opt)
              {
                  $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob'][$I_conf]  = $Conf_opt;
              }
          }
      } 
      else 
      { 
         $this->nm_data = new nm_data("en_us");
      } 
      $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_odpedit_mob']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['project_edit_update_main_odpedit_mob']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['project_edit_update_main_odpedit_mob'];
          }
          elseif (isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']]))
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']] as $init => $resto)
              {
                  if ($this->Ini->sc_page == $init)
                  {
                      $this->sc_init_menu = $init;
                      break;
                  }
              }
          }
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['project_edit_update_main_odpedit_mob']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['project_edit_update_main_odpedit_mob']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('project_edit_update_main_odpedit_mob') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['project_edit_update_main_odpedit_mob']['label'] = "Master ODP";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "project_edit_update_main_odpedit_mob")
                  {
                      $achou = true;
                  }
                  elseif ($achou)
                  {
                      unset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu][$apl]);
                      $this->Change_Menu = true;
                  }
              }
          }
      }
      if (!function_exists("nmButtonOutput"))
      {
          include_once($this->Ini->path_lib_php . "nm_gp_config_btn.php");
      }
      include("../_lib/css/" . $this->Ini->str_schema_all . "_form.php");
      $this->Ini->Str_btn_form    = trim($str_button);
      include($this->Ini->path_btn . $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form . $_SESSION['scriptcase']['reg_conf']['css_dir'] . '.php');
      $this->Db = $this->Ini->Db; 
      $this->Ini->Img_sep_form    = "/" . trim($str_toolbar_separator);
      $this->Ini->Color_bg_ajax   = "" == trim($str_ajax_bg)         ? "#000" : $str_ajax_bg;
      $this->Ini->Border_c_ajax   = "" == trim($str_ajax_border_c)   ? ""     : $str_ajax_border_c;
      $this->Ini->Border_s_ajax   = "" == trim($str_ajax_border_s)   ? ""     : $str_ajax_border_s;
      $this->Ini->Border_w_ajax   = "" == trim($str_ajax_border_w)   ? ""     : $str_ajax_border_w;
      $this->Ini->Block_img_exp   = "" == trim($str_block_exp)       ? ""     : $str_block_exp;
      $this->Ini->Block_img_col   = "" == trim($str_block_col)       ? ""     : $str_block_col;
      $this->Ini->Msg_ico_title   = "" == trim($str_msg_ico_title)   ? ""     : $str_msg_ico_title;
      $this->Ini->Msg_ico_body    = "" == trim($str_msg_ico_body)    ? ""     : $str_msg_ico_body;
      $this->Ini->Err_ico_title   = "" == trim($str_err_ico_title)   ? ""     : $str_err_ico_title;
      $this->Ini->Err_ico_body    = "" == trim($str_err_ico_body)    ? ""     : $str_err_ico_body;
      $this->Ini->Cal_ico_back    = "" == trim($str_cal_ico_back)    ? ""     : $str_cal_ico_back;
      $this->Ini->Cal_ico_for     = "" == trim($str_cal_ico_for)     ? ""     : $str_cal_ico_for;
      $this->Ini->Cal_ico_close   = "" == trim($str_cal_ico_close)   ? ""     : $str_cal_ico_close;
      $this->Ini->Tab_space       = "" == trim($str_tab_space)       ? ""     : $str_tab_space;
      $this->Ini->Bubble_tail     = "" == trim($str_bubble_tail)     ? ""     : $str_bubble_tail;
      $this->Ini->Label_sort_pos  = "" == trim($str_label_sort_pos)  ? ""     : $str_label_sort_pos;
      $this->Ini->Label_sort      = "" == trim($str_label_sort)      ? ""     : $str_label_sort;
      $this->Ini->Label_sort_asc  = "" == trim($str_label_sort_asc)  ? ""     : $str_label_sort_asc;
      $this->Ini->Label_sort_desc = "" == trim($str_label_sort_desc) ? ""     : $str_label_sort_desc;
      $this->Ini->Img_status_ok   = "" == trim($str_img_status_ok)   ? ""     : $str_img_status_ok;
      $this->Ini->Img_status_err  = "" == trim($str_img_status_err)  ? ""     : $str_img_status_err;
      $this->Ini->Css_status      = "scFormInputError";
      $this->Ini->Error_icon_span = "" == trim($str_error_icon_span) ? false  : "message" == $str_error_icon_span;
      $this->Ini->Img_qs_search        = "" == trim($img_qs_search)        ? "scriptcase__NM__qs_lupa.png"  : $img_qs_search;
      $this->Ini->Img_qs_clean         = "" == trim($img_qs_clean)         ? "scriptcase__NM__qs_close.png" : $img_qs_clean;
      $this->Ini->Str_qs_image_padding = "" == trim($str_qs_image_padding) ? "0"                            : $str_qs_image_padding;
      $this->Ini->App_div_tree_img_col = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp = trim($app_div_str_tree_exp);



      $_SESSION['scriptcase']['error_icon']['project_edit_update_main_odpedit_mob']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['project_edit_update_main_odpedit_mob'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_call'] : $this->Embutida_call;

       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "on";
      $this->nmgp_botoes['first'] = "on";
      $this->nmgp_botoes['back'] = "on";
      $this->nmgp_botoes['forward'] = "on";
      $this->nmgp_botoes['last'] = "on";
      $this->nmgp_botoes['summary'] = "on";
      $this->nmgp_botoes['navpage'] = "on";
      $this->nmgp_botoes['goto'] = "on";
      $this->nmgp_botoes['qtline'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_orig'] = " where TPMO_PROJECTID=" . $_SESSION['var_projectid'] . "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_pesq'] = " where TPMO_PROJECTID=" . $_SESSION['var_projectid'] . "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_odpedit_mob']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['project_edit_update_main_odpedit_mob'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['project_edit_update_main_odpedit_mob'];

              $this->nmgp_botoes['update']     = $tmpDashboardButtons['form_update']    ? 'on' : 'off';
              $this->nmgp_botoes['new']        = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['insert']     = $tmpDashboardButtons['form_insert']    ? 'on' : 'off';
              $this->nmgp_botoes['delete']     = $tmpDashboardButtons['form_delete']    ? 'on' : 'off';
              $this->nmgp_botoes['copy']       = $tmpDashboardButtons['form_copy']      ? 'on' : 'off';
              $this->nmgp_botoes['first']      = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['back']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['last']       = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['forward']    = $tmpDashboardButtons['form_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['navpage']    = $tmpDashboardButtons['form_navpage']   ? 'on' : 'off';
              $this->nmgp_botoes['goto']       = $tmpDashboardButtons['form_goto']      ? 'on' : 'off';
              $this->nmgp_botoes['qtline']     = $tmpDashboardButtons['form_lineqty']   ? 'on' : 'off';
              $this->nmgp_botoes['summary']    = $tmpDashboardButtons['form_summary']   ? 'on' : 'off';
              $this->nmgp_botoes['qsearch']    = $tmpDashboardButtons['form_qsearch']   ? 'on' : 'off';
              $this->nmgp_botoes['dynsearch']  = $tmpDashboardButtons['form_dynsearch'] ? 'on' : 'off';
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['exit'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dados_form'];
          if (!isset($this->tpmo_entryby)){$this->tpmo_entryby = $this->nmgp_dados_form['tpmo_entryby'];} 
          if (!isset($this->tpmo_entrydate)){$this->tpmo_entrydate = $this->nmgp_dados_form['tpmo_entrydate'];} 
          if (!isset($this->tpmo_updateby)){$this->tpmo_updateby = $this->nmgp_dados_form['tpmo_updateby'];} 
          if (!isset($this->tpmo_updatedate)){$this->tpmo_updatedate = $this->nmgp_dados_form['tpmo_updatedate'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("project_edit_update_main_odpedit_mob", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
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
      nm_gc($this->Ini->path_libs);
      $this->Ini->Gd_missing  = true;
      if(function_exists("getProdVersion"))
      {
         $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
         if(function_exists("gd_info"))
         {
            $this->Ini->Gd_missing = false;
         }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 

      if (is_file($this->Ini->path_aplicacao . 'project_edit_update_main_odpedit_mob_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'project_edit_update_main_odpedit_mob_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('form:' == substr($str_link_webhelp, 0, 5))
                  {
                      $arr_link_parts = explode(':', $str_link_webhelp);
                      if ('' != $arr_link_parts[1] && is_file($this->Ini->root . $this->Ini->path_help . $arr_link_parts[1]))
                      {
                          $this->url_webhelp = $this->Ini->path_help . $arr_link_parts[1];
                      }
                  }
              }
          }
      }

      if (is_dir($this->Ini->path_aplicacao . 'img'))
      {
          $Res_dir_img = @opendir($this->Ini->path_aplicacao . 'img');
          if ($Res_dir_img)
          {
              while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
              {
                 if (@is_file($this->Ini->path_aplicacao . 'img/' . $Str_arquivo) && '.' != $Str_arquivo && '..' != $this->Ini->path_aplicacao . 'img/' . $Str_arquivo)
                 {
                     @unlink($this->Ini->path_aplicacao . 'img/' . $Str_arquivo);
                 }
              }
          }
          @closedir($Res_dir_img);
          rmdir($this->Ini->path_aplicacao . 'img');
      }

      if ($this->Embutida_proc)
      { 
          require_once($this->Ini->path_embutida . 'project_edit_update_main_odpedit/project_edit_update_main_odpedit_mob_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "project_edit_update_main_odpedit_mob_erro.class.php"); 
      }
      $this->Erro      = new project_edit_update_main_odpedit_mob_erro();
      $this->Erro->Ini = $this->Ini;
      if ($nm_opc_lookup != "lookup" && $nm_opc_php != "formphp")
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opcao']))
         { 
             if ($this->tpmo_id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_odpedit_mob']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opc_ant'];
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      if ($this->nmgp_opcao == "excluir")
      {
          $GLOBALS['script_case_init'] = $this->Ini->sc_page;
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_form'] = false;
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_proc'] = true;
          $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['reg_start'] = "";
          unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['total']);
          require_once($this->Ini->root . $this->Ini->path_link  . SC_dir_app_name('odp_master_edit_detail_mob') . "/index.php");
          require_once($this->Ini->root . $this->Ini->path_link  . SC_dir_app_name('odp_master_edit_detail_mob') . "/odp_master_edit_detail_mob_apl.php");
          $this->odp_master_edit_detail_mob = new odp_master_edit_detail_mob_apl;
      }
      $this->sc_evento = $this->nmgp_opcao;
      $this->sc_insert_on = false;
      if (isset($this->tpmo_id)) { $this->nm_limpa_alfa($this->tpmo_id); }
      if (isset($this->tpmo_projectid)) { $this->nm_limpa_alfa($this->tpmo_projectid); }
      if (isset($this->tpmo_namanode)) { $this->nm_limpa_alfa($this->tpmo_namanode); }
      if (isset($this->tpmo_awal)) { $this->nm_limpa_alfa($this->tpmo_awal); }
      if (isset($this->tpmo_jmlodp)) { $this->nm_limpa_alfa($this->tpmo_jmlodp); }
      if (isset($this->tpmo_akhir)) { $this->nm_limpa_alfa($this->tpmo_akhir); }
      if (isset($this->tpmo_merk)) { $this->nm_limpa_alfa($this->tpmo_merk); }
      if (isset($this->tpmo_kapport)) { $this->nm_limpa_alfa($this->tpmo_kapport); }
      if (isset($this->tpmo_nosp)) { $this->nm_limpa_alfa($this->tpmo_nosp); }
      if (isset($this->detail)) { $this->nm_limpa_alfa($this->detail); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- tpmo_id
      $this->field_config['tpmo_id']               = array();
      $this->field_config['tpmo_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tpmo_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tpmo_id']['symbol_dec'] = '';
      $this->field_config['tpmo_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tpmo_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tpmo_jmlodp
      $this->field_config['tpmo_jmlodp']               = array();
      $this->field_config['tpmo_jmlodp']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tpmo_jmlodp']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tpmo_jmlodp']['symbol_dec'] = '';
      $this->field_config['tpmo_jmlodp']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tpmo_jmlodp']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tpmo_kapport
      $this->field_config['tpmo_kapport']               = array();
      $this->field_config['tpmo_kapport']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tpmo_kapport']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tpmo_kapport']['symbol_dec'] = '';
      $this->field_config['tpmo_kapport']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tpmo_kapport']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tpmo_entrydate
      $this->field_config['tpmo_entrydate']                 = array();
      $this->field_config['tpmo_entrydate']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tpmo_entrydate']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tpmo_entrydate']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tpmo_entrydate');
      //-- tpmo_updatedate
      $this->field_config['tpmo_updatedate']                 = array();
      $this->field_config['tpmo_updatedate']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tpmo_updatedate']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tpmo_updatedate']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tpmo_updatedate');
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();

      if ('' != $_SESSION['scriptcase']['change_regional_old'])
      {
          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_old'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $this->nm_tira_formatacao();

          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_new'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $guarda_formatado = $this->formatado;
          $this->nm_formatar_campos();
          $this->formatado = $guarda_formatado;

          $_SESSION['scriptcase']['change_regional_old'] = '';
          $_SESSION['scriptcase']['change_regional_new'] = '';
      }

      if ($nm_form_submit == 1 && ($this->nmgp_opcao == 'inicio' || $this->nmgp_opcao == 'igual'))
      {
          $this->nm_tira_formatacao();
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_tpmo_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tpmo_id');
          }
          if ('validate_tpmo_projectid' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tpmo_projectid');
          }
          if ('validate_tpmo_namanode' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tpmo_namanode');
          }
          if ('validate_tpmo_awal' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tpmo_awal');
          }
          if ('validate_tpmo_jmlodp' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tpmo_jmlodp');
          }
          if ('validate_tpmo_akhir' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tpmo_akhir');
          }
          if ('validate_tpmo_merk' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tpmo_merk');
          }
          if ('validate_tpmo_kapport' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tpmo_kapport');
          }
          if ('validate_tpmo_nosp' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tpmo_nosp');
          }
          if ('validate_detail' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'detail');
          }
          project_edit_update_main_odpedit_mob_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          if ('event_tpmo_jmlodp_onchange' == $this->NM_ajax_opcao)
          {
              $this->TPMO_JMLODP_onChange();
          }
          project_edit_update_main_odpedit_mob_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              project_edit_update_main_odpedit_mob_pack_ajax_response();
              exit;
          }
          $this->nm_formatar_campos();
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          $this->nm_gera_html();
          $this->NM_close_db(); 
          $this->nmgp_opcao = ""; 
          exit; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  project_edit_update_main_odpedit_mob_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir" && $nm_apl_dependente == 1) 
              { 
                  $this->nm_flag_saida_novo = "S";; 
              }
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
      elseif (isset($nm_form_submit) && 1 == $nm_form_submit && $this->nmgp_opcao != "menu_link" && $this->nmgp_opcao != "recarga_mobile")
      {
      }
//
      if ($this->nmgp_opcao != "nada")
      {
          $this->nm_acessa_banco();
      }
      else
      {
           if ($this->nmgp_opc_ant == "incluir") 
           { 
               $this->nm_proc_onload(false);
           }
           else
           { 
              $this->nm_guardar_campos();
           }
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['recarga'] = $this->nmgp_opcao;
      }
      if ($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao)
      {
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          project_edit_update_main_odpedit_mob_pack_ajax_response();
          exit;
      }
      $this->nm_formatar_campos();
      if ($this->NM_ajax_flag)
      {
          $this->NM_ajax_info['result'] = 'OK';
          if ('alterar' == $this->NM_ajax_info['param']['nmgp_opcao'])
          {
              $this->NM_ajax_info['msgDisplay'] = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_ajax_frmu']);
          }
          project_edit_update_main_odpedit_mob_pack_ajax_response();
          exit;
      }
      $this->nm_gera_html();
      $this->NM_close_db(); 
      $this->nmgp_opcao = ""; 
      if ($this->Change_Menu)
      {
          $apl_menu  = $_SESSION['scriptcase']['menu_atual'];
          $Arr_rastro = array();
          if (isset($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) && count($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) > 1)
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu] as $menu => $apls)
              {
                 $Arr_rastro[] = "'<a href=\"" . $apls['link'] . "?script_case_init=" . $this->sc_init_menu . "&script_case_session=" . session_id() . "\" target=\"#NMIframe#\">" . $apls['label'] . "</a>'";
              }
              $ult_apl = count($Arr_rastro) - 1;
              unset($Arr_rastro[$ult_apl]);
              $rastro = implode(",", $Arr_rastro);
?>
  <script type="text/javascript">
     link_atual = new Array (<?php echo $rastro ?>);
     parent.writeFastMenu(link_atual);
  </script>
<?php
          }
          else
          {
?>
  <script type="text/javascript">
     parent.clearFastMenu();
  </script>
<?php
          }
      }
   }
//
//--------------------------------------------------------------------------------------
   function NM_has_trans()
   {
       return !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access);
   }
//
//--------------------------------------------------------------------------------------
   function NM_commit_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->CommitTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_rollback_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->RollbackTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_close_db()
   {
       if ($this->Db && !$this->Embutida_proc)
       { 
           $this->Db->Close(); 
       } 
   }
//
//--------------------------------------------------------------------------------------
   function Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, $mode = 3) 
   {
       switch ($mode)
       {
           case 1:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 2:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta, true);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 3:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;
       }
   }

   function Formata_Campos_Falta($Campos_Falta, $table = false) 
   {
       $Campos_Falta = array_unique($Campos_Falta);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_reqd'] . ' ' . implode('; ', $Campos_Falta);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Falta);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Falta as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_reqd'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Crit($Campos_Crit, $table = false) 
   {
       $Campos_Crit = array_unique($Campos_Crit);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . implode('; ', $Campos_Crit);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Crit);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Crit as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_flds'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros($Campos_Erros) 
   {
       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= '<tr>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Recupera_Nome_Campo($campo) . ':</td>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', array_unique($erros)) . '</td>';
           $sError .= '</tr>';
       }

       $sError .= '</table>';

       return $sError;
   }

   function Recupera_Nome_Campo($campo) 
   {
       switch($campo)
       {
           case 'tpmo_id':
               return "IDTable";
               break;
           case 'tpmo_projectid':
               return "Project ID";
               break;
           case 'tpmo_namanode':
               return "Nama Node";
               break;
           case 'tpmo_awal':
               return "Nomor Awal";
               break;
           case 'tpmo_jmlodp':
               return "Jml ODP";
               break;
           case 'tpmo_akhir':
               return "Nomor Akhir";
               break;
           case 'tpmo_merk':
               return "Merk";
               break;
           case 'tpmo_kapport':
               return "Kap. Port";
               break;
           case 'tpmo_nosp':
               return "NoSP";
               break;
           case 'detail':
               return "ODP Detail";
               break;
           case 'tpmo_entryby':
               return "TPMO ENTRYBY";
               break;
           case 'tpmo_entrydate':
               return "TPMO ENTRYDATE";
               break;
           case 'tpmo_updateby':
               return "TPMO UPDATEBY";
               break;
           case 'tpmo_updatedate':
               return "TPMO UPDATEDATE";
               break;
       }

       return $campo;
   }

   function dateDefaultFormat()
   {
       if (isset($this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']))
       {
           $sDate = str_replace('yyyy', 'Y', $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']);
           $sDate = str_replace('mm',   'm', $sDate);
           $sDate = str_replace('dd',   'd', $sDate);
           return substr(chunk_split($sDate, 1, $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_sep']), 0, -1);
       }
       elseif ('en_us' == $this->Ini->str_lang)
       {
           return 'm/d/Y';
       }
       else
       {
           return 'd/m/Y';
       }
   } // dateDefaultFormat

//
//--------------------------------------------------------------------------------------
   function Valida_campos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser, $teste_validade;
//---------------------------------------------------------
     $this->sc_force_zero = array();

     if ('' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_project_edit_update_main_odpedit_mob']) || !is_array($this->NM_ajax_info['errList']['geral_project_edit_update_main_odpedit_mob']))
              {
                  $this->NM_ajax_info['errList']['geral_project_edit_update_main_odpedit_mob'] = array();
              }
              $this->NM_ajax_info['errList']['geral_project_edit_update_main_odpedit_mob'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ('' == $filtro || 'tpmo_id' == $filtro)
        $this->ValidateField_tpmo_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'tpmo_projectid' == $filtro)
        $this->ValidateField_tpmo_projectid($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'tpmo_namanode' == $filtro)
        $this->ValidateField_tpmo_namanode($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'tpmo_awal' == $filtro)
        $this->ValidateField_tpmo_awal($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'tpmo_jmlodp' == $filtro)
        $this->ValidateField_tpmo_jmlodp($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'tpmo_akhir' == $filtro)
        $this->ValidateField_tpmo_akhir($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'tpmo_merk' == $filtro)
        $this->ValidateField_tpmo_merk($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'tpmo_kapport' == $filtro)
        $this->ValidateField_tpmo_kapport($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'tpmo_nosp' == $filtro)
        $this->ValidateField_tpmo_nosp($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'detail' == $filtro)
        $this->ValidateField_detail($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if (!empty($Campos_Crit) || !empty($Campos_Falta) || !empty($this->Campos_Mens_erro))
      {
          if (!empty($this->sc_force_zero))
          {
              foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
              {
                  eval('$this->' . $sc_force_zero_field . ' = "";');
                  unset($this->sc_force_zero[$i_force_zero]);
              }
          }
      }
   }

    function ValidateField_tpmo_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tpmo_id == "")  
      { 
          $this->tpmo_id = 0;
      } 
      nm_limpa_numero($this->tpmo_id, $this->field_config['tpmo_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->tpmo_id != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tpmo_id) > $iTestSize)  
              { 
                  $Campos_Crit .= "IDTable: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tpmo_id']))
                  {
                      $Campos_Erros['tpmo_id'] = array();
                  }
                  $Campos_Erros['tpmo_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tpmo_id']) || !is_array($this->NM_ajax_info['errList']['tpmo_id']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tpmo_id, 22, 0, 0, 0, "N") == false)  
              { 
                  $Campos_Crit .= "IDTable; " ; 
                  if (!isset($Campos_Erros['tpmo_id']))
                  {
                      $Campos_Erros['tpmo_id'] = array();
                  }
                  $Campos_Erros['tpmo_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tpmo_id']) || !is_array($this->NM_ajax_info['errList']['tpmo_id']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_tpmo_id

    function ValidateField_tpmo_projectid(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_projectid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_projectid'] == "on")) 
      { 
          if ($this->tpmo_projectid == "")  
          { 
              $Campos_Falta[] =  "Project ID" ; 
              if (!isset($Campos_Erros['tpmo_projectid']))
              {
                  $Campos_Erros['tpmo_projectid'] = array();
              }
              $Campos_Erros['tpmo_projectid'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tpmo_projectid']) || !is_array($this->NM_ajax_info['errList']['tpmo_projectid']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_projectid'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_projectid'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tpmo_projectid) > 22) 
          { 
              $Campos_Crit .= "Project ID " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 22 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tpmo_projectid']))
              {
                  $Campos_Erros['tpmo_projectid'] = array();
              }
              $Campos_Erros['tpmo_projectid'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 22 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tpmo_projectid']) || !is_array($this->NM_ajax_info['errList']['tpmo_projectid']))
              {
                  $this->NM_ajax_info['errList']['tpmo_projectid'] = array();
              }
              $this->NM_ajax_info['errList']['tpmo_projectid'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 22 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tpmo_projectid

    function ValidateField_tpmo_namanode(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_namanode']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_namanode'] == "on")) 
      { 
          if ($this->tpmo_namanode == "")  
          { 
              $Campos_Falta[] =  "Nama Node" ; 
              if (!isset($Campos_Erros['tpmo_namanode']))
              {
                  $Campos_Erros['tpmo_namanode'] = array();
              }
              $Campos_Erros['tpmo_namanode'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tpmo_namanode']) || !is_array($this->NM_ajax_info['errList']['tpmo_namanode']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_namanode'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_namanode'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tpmo_namanode) > 20) 
          { 
              $Campos_Crit .= "Nama Node " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tpmo_namanode']))
              {
                  $Campos_Erros['tpmo_namanode'] = array();
              }
              $Campos_Erros['tpmo_namanode'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tpmo_namanode']) || !is_array($this->NM_ajax_info['errList']['tpmo_namanode']))
              {
                  $this->NM_ajax_info['errList']['tpmo_namanode'] = array();
              }
              $this->NM_ajax_info['errList']['tpmo_namanode'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tpmo_namanode

    function ValidateField_tpmo_awal(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_awal']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_awal'] == "on")) 
      { 
          if ($this->tpmo_awal == "")  
          { 
              $Campos_Falta[] =  "Nomor Awal" ; 
              if (!isset($Campos_Erros['tpmo_awal']))
              {
                  $Campos_Erros['tpmo_awal'] = array();
              }
              $Campos_Erros['tpmo_awal'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tpmo_awal']) || !is_array($this->NM_ajax_info['errList']['tpmo_awal']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_awal'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_awal'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tpmo_awal) > 6) 
          { 
              $Campos_Crit .= "Nomor Awal " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 6 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tpmo_awal']))
              {
                  $Campos_Erros['tpmo_awal'] = array();
              }
              $Campos_Erros['tpmo_awal'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 6 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tpmo_awal']) || !is_array($this->NM_ajax_info['errList']['tpmo_awal']))
              {
                  $this->NM_ajax_info['errList']['tpmo_awal'] = array();
              }
              $this->NM_ajax_info['errList']['tpmo_awal'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 6 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tpmo_awal

    function ValidateField_tpmo_jmlodp(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_numero($this->tpmo_jmlodp, $this->field_config['tpmo_jmlodp']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tpmo_jmlodp != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tpmo_jmlodp) > $iTestSize)  
              { 
                  $Campos_Crit .= "Jml ODP: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tpmo_jmlodp']))
                  {
                      $Campos_Erros['tpmo_jmlodp'] = array();
                  }
                  $Campos_Erros['tpmo_jmlodp'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tpmo_jmlodp']) || !is_array($this->NM_ajax_info['errList']['tpmo_jmlodp']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_jmlodp'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_jmlodp'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tpmo_jmlodp, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Jml ODP; " ; 
                  if (!isset($Campos_Erros['tpmo_jmlodp']))
                  {
                      $Campos_Erros['tpmo_jmlodp'] = array();
                  }
                  $Campos_Erros['tpmo_jmlodp'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tpmo_jmlodp']) || !is_array($this->NM_ajax_info['errList']['tpmo_jmlodp']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_jmlodp'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_jmlodp'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_jmlodp']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_jmlodp'] == "on") 
           { 
              $Campos_Falta[] = "Jml ODP" ; 
              if (!isset($Campos_Erros['tpmo_jmlodp']))
              {
                  $Campos_Erros['tpmo_jmlodp'] = array();
              }
              $Campos_Erros['tpmo_jmlodp'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tpmo_jmlodp']) || !is_array($this->NM_ajax_info['errList']['tpmo_jmlodp']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_jmlodp'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_jmlodp'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
    } // ValidateField_tpmo_jmlodp

    function ValidateField_tpmo_akhir(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_akhir']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_akhir'] == "on")) 
      { 
          if ($this->tpmo_akhir == "")  
          { 
              $Campos_Falta[] =  "Nomor Akhir" ; 
              if (!isset($Campos_Erros['tpmo_akhir']))
              {
                  $Campos_Erros['tpmo_akhir'] = array();
              }
              $Campos_Erros['tpmo_akhir'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tpmo_akhir']) || !is_array($this->NM_ajax_info['errList']['tpmo_akhir']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_akhir'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_akhir'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tpmo_akhir) > 6) 
          { 
              $Campos_Crit .= "Nomor Akhir " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 6 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tpmo_akhir']))
              {
                  $Campos_Erros['tpmo_akhir'] = array();
              }
              $Campos_Erros['tpmo_akhir'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 6 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tpmo_akhir']) || !is_array($this->NM_ajax_info['errList']['tpmo_akhir']))
              {
                  $this->NM_ajax_info['errList']['tpmo_akhir'] = array();
              }
              $this->NM_ajax_info['errList']['tpmo_akhir'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 6 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tpmo_akhir

    function ValidateField_tpmo_merk(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tpmo_merk) > 20) 
          { 
              $Campos_Crit .= "Merk " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tpmo_merk']))
              {
                  $Campos_Erros['tpmo_merk'] = array();
              }
              $Campos_Erros['tpmo_merk'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tpmo_merk']) || !is_array($this->NM_ajax_info['errList']['tpmo_merk']))
              {
                  $this->NM_ajax_info['errList']['tpmo_merk'] = array();
              }
              $this->NM_ajax_info['errList']['tpmo_merk'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tpmo_merk

    function ValidateField_tpmo_kapport(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_numero($this->tpmo_kapport, $this->field_config['tpmo_kapport']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tpmo_kapport != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tpmo_kapport) > $iTestSize)  
              { 
                  $Campos_Crit .= "Kap. Port: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tpmo_kapport']))
                  {
                      $Campos_Erros['tpmo_kapport'] = array();
                  }
                  $Campos_Erros['tpmo_kapport'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tpmo_kapport']) || !is_array($this->NM_ajax_info['errList']['tpmo_kapport']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_kapport'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_kapport'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tpmo_kapport, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Kap. Port; " ; 
                  if (!isset($Campos_Erros['tpmo_kapport']))
                  {
                      $Campos_Erros['tpmo_kapport'] = array();
                  }
                  $Campos_Erros['tpmo_kapport'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tpmo_kapport']) || !is_array($this->NM_ajax_info['errList']['tpmo_kapport']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_kapport'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_kapport'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_kapport']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['php_cmp_required']['tpmo_kapport'] == "on") 
           { 
              $Campos_Falta[] = "Kap. Port" ; 
              if (!isset($Campos_Erros['tpmo_kapport']))
              {
                  $Campos_Erros['tpmo_kapport'] = array();
              }
              $Campos_Erros['tpmo_kapport'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tpmo_kapport']) || !is_array($this->NM_ajax_info['errList']['tpmo_kapport']))
                  {
                      $this->NM_ajax_info['errList']['tpmo_kapport'] = array();
                  }
                  $this->NM_ajax_info['errList']['tpmo_kapport'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
    } // ValidateField_tpmo_kapport

    function ValidateField_tpmo_nosp(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tpmo_nosp) > 60) 
          { 
              $Campos_Crit .= "NoSP " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tpmo_nosp']))
              {
                  $Campos_Erros['tpmo_nosp'] = array();
              }
              $Campos_Erros['tpmo_nosp'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tpmo_nosp']) || !is_array($this->NM_ajax_info['errList']['tpmo_nosp']))
              {
                  $this->NM_ajax_info['errList']['tpmo_nosp'] = array();
              }
              $this->NM_ajax_info['errList']['tpmo_nosp'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tpmo_nosp

    function ValidateField_detail(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->detail) != "")  
          { 
          } 
      } 
    } // ValidateField_detail

    function removeDuplicateDttmError($aErrDate, &$aErrTime)
    {
        if (empty($aErrDate) || empty($aErrTime))
        {
            return;
        }

        foreach ($aErrDate as $sErrDate)
        {
            foreach ($aErrTime as $iErrTime => $sErrTime)
            {
                if ($sErrDate == $sErrTime)
                {
                    unset($aErrTime[$iErrTime]);
                }
            }
        }
    } // removeDuplicateDttmError

   function nm_guardar_campos()
   {
    global
           $sc_seq_vert;
    $this->nmgp_dados_form['tpmo_id'] = $this->tpmo_id;
    $this->nmgp_dados_form['tpmo_projectid'] = $this->tpmo_projectid;
    $this->nmgp_dados_form['tpmo_namanode'] = $this->tpmo_namanode;
    $this->nmgp_dados_form['tpmo_awal'] = $this->tpmo_awal;
    $this->nmgp_dados_form['tpmo_jmlodp'] = $this->tpmo_jmlodp;
    $this->nmgp_dados_form['tpmo_akhir'] = $this->tpmo_akhir;
    $this->nmgp_dados_form['tpmo_merk'] = $this->tpmo_merk;
    $this->nmgp_dados_form['tpmo_kapport'] = $this->tpmo_kapport;
    $this->nmgp_dados_form['tpmo_nosp'] = $this->tpmo_nosp;
    $this->nmgp_dados_form['detail'] = $this->detail;
    $this->nmgp_dados_form['tpmo_entryby'] = $this->tpmo_entryby;
    $this->nmgp_dados_form['tpmo_entrydate'] = (strlen(trim($this->tpmo_entrydate)) > 19) ? str_replace(".", ":", $this->tpmo_entrydate) : trim($this->tpmo_entrydate);
    $this->nmgp_dados_form['tpmo_updateby'] = $this->tpmo_updateby;
    $this->nmgp_dados_form['tpmo_updatedate'] = (strlen(trim($this->tpmo_updatedate)) > 19) ? str_replace(".", ":", $this->tpmo_updatedate) : trim($this->tpmo_updatedate);
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->formatado = false;
      nm_limpa_numero($this->tpmo_id, $this->field_config['tpmo_id']['symbol_grp']) ; 
      nm_limpa_numero($this->tpmo_jmlodp, $this->field_config['tpmo_jmlodp']['symbol_grp']) ; 
      nm_limpa_numero($this->tpmo_kapport, $this->field_config['tpmo_kapport']['symbol_grp']) ; 
      nm_limpa_data($this->tpmo_entrydate, $this->field_config['tpmo_entrydate']['date_sep']) ; 
      nm_limpa_data($this->tpmo_updatedate, $this->field_config['tpmo_updatedate']['date_sep']) ; 
   }
   function sc_add_currency(&$value, $symbol, $pos)
   {
       if ('' == $value)
       {
           return;
       }
       $value = (1 == $pos || 3 == $pos) ? $symbol . ' ' . $value : $value . ' ' . $symbol;
   }
   function sc_remove_currency(&$value, $symbol_dec, $symbol_tho, $symbol_mon)
   {
       $value = preg_replace('~&#x0*([0-9a-f]+);~i', '', $value);
       $sNew  = str_replace($symbol_mon, '', $value);
       if ($sNew != $value)
       {
           $value = str_replace(' ', '', $sNew);
           return;
       }
       $aTest = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', $symbol_dec, $symbol_tho);
       $sNew  = '';
       for ($i = 0; $i < strlen($value); $i++)
       {
           if ($this->sc_test_currency_char($value[$i], $aTest))
           {
               $sNew .= $value[$i];
           }
       }
       $value = $sNew;
   }
   function sc_test_currency_char($char, $test)
   {
       $found = false;
       foreach ($test as $test_char)
       {
           if ($char === $test_char)
           {
               $found = true;
           }
       }
       return $found;
   }
   function nm_clear_val($Nome_Campo)
   {
      if ($Nome_Campo == "tpmo_id")
      {
          nm_limpa_numero($this->tpmo_id, $this->field_config['tpmo_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "tpmo_jmlodp")
      {
          nm_limpa_numero($this->tpmo_jmlodp, $this->field_config['tpmo_jmlodp']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "tpmo_kapport")
      {
          nm_limpa_numero($this->tpmo_kapport, $this->field_config['tpmo_kapport']['symbol_grp']) ; 
      }
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
      if (!empty($this->tpmo_id) || (!empty($format_fields) && isset($format_fields['tpmo_id'])))
      {
          nmgp_Form_Num_Val($this->tpmo_id, $this->field_config['tpmo_id']['symbol_grp'], $this->field_config['tpmo_id']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tpmo_id']['symbol_fmt']) ; 
      }
      if (!empty($this->tpmo_jmlodp) || (!empty($format_fields) && isset($format_fields['tpmo_jmlodp'])))
      {
          nmgp_Form_Num_Val($this->tpmo_jmlodp, $this->field_config['tpmo_jmlodp']['symbol_grp'], $this->field_config['tpmo_jmlodp']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tpmo_jmlodp']['symbol_fmt']) ; 
      }
      if (!empty($this->tpmo_kapport) || (!empty($format_fields) && isset($format_fields['tpmo_kapport'])))
      {
          nmgp_Form_Num_Val($this->tpmo_kapport, $this->field_config['tpmo_kapport']['symbol_grp'], $this->field_config['tpmo_kapport']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tpmo_kapport']['symbol_fmt']) ; 
      }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $new_campo = '';
          $a_mask_ord  = array();
          $i_mask_size = -1;

          foreach (explode(';', $nm_mask) as $str_mask)
          {
              $a_mask_ord[ $this->nm_conta_mask_chars($str_mask) ] = $str_mask;
          }
          ksort($a_mask_ord);

          foreach ($a_mask_ord as $i_size => $s_mask)
          {
              if (-1 == $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
              elseif (strlen($nm_campo) >= $i_size && strlen($nm_campo) > $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
          }
          $nm_mask = $a_mask_ord[$i_mask_size];

          for ($i = 0; $i < strlen($nm_mask); $i++)
          {
              $test_mask = substr($nm_mask, $i, 1);
              
              if ('9' == $test_mask || 'a' == $test_mask || '*' == $test_mask)
              {
                  $new_campo .= substr($nm_campo, 0, 1);
                  $nm_campo   = substr($nm_campo, 1);
              }
              else
              {
                  $new_campo .= $test_mask;
              }
          }

                  $nm_campo = $new_campo;

          return;
      }

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
              if ($cont1 < $cont2 && $tam_campo <= $cont2 && $tam_campo > $cont1)
              {
                  $trab_mask = $ver_duas[1];
              }
              elseif ($cont1 > $cont2 && $tam_campo <= $cont2)
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
   function nm_conta_mask_chars($sMask)
   {
       $iLength = 0;

       for ($i = 0; $i < strlen($sMask); $i++)
       {
           if (in_array($sMask[$i], array('9', 'a', '*')))
           {
               $iLength++;
           }
       }

       return $iLength;
   }
   function nm_tira_mask(&$nm_campo, $nm_mask, $nm_chars = '')
   { 
      $mask_dados = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $tam_mask   = strlen($nm_mask);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $raw_campo = $this->sc_clear_mask($nm_campo, $nm_chars);
          $raw_mask  = $this->sc_clear_mask($nm_mask, $nm_chars);
          $new_campo = '';

          $test_mask = substr($raw_mask, 0, 1);
          $raw_mask  = substr($raw_mask, 1);

          while ('' != $raw_campo)
          {
              $test_val  = substr($raw_campo, 0, 1);
              $raw_campo = substr($raw_campo, 1);
              $ord       = ord($test_val);
              $found     = false;

              switch ($test_mask)
              {
                  case '9':
                      if (48 <= $ord && 57 >= $ord)
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case 'a':
                      if ((65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case '*':
                      if ((48 <= $ord && 57 >= $ord) || (65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;
              }

              if ($found)
              {
                  $test_mask = substr($raw_mask, 0, 1);
                  $raw_mask  = substr($raw_mask, 1);
              }
          }

          $nm_campo = $new_campo;

          return;
      }

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
          for ($x=0; $x < strlen($mask_dados); $x++)
          {
              if (is_numeric(substr($mask_dados, $x, 1)))
              {
                  $trab_saida .= substr($mask_dados, $x, 1);
              }
          }
          $nm_campo = $trab_saida;
          return;
      }
      if ($tam_mask > $tam_campo)
      {
         $mask_desfaz = "";
         for ($mask_ind = 0; $tam_mask > $tam_campo; $mask_ind++)
         {
              $mask_char = substr($trab_mask, $mask_ind, 1);
              if ($mask_char == "z")
              {
                  $tam_mask--;
              }
              else
              {
                  $mask_desfaz .= $mask_char;
              }
              if ($mask_ind == $tam_campo)
              {
                  $tam_mask = $tam_campo;
              }
         }
         $trab_mask = $mask_desfaz . substr($trab_mask, $mask_ind);
      }
      $mask_saida = "";
      for ($mask_ind = strlen($trab_mask); $mask_ind > 0; $mask_ind--)
      {
          $mask_char = substr($trab_mask, $mask_ind - 1, 1);
          if ($mask_char == "x" || $mask_char == "z")
          {
              if ($tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
              }
          }
          else
          {
              if ($mask_char != substr($mask_dados, $tam_campo - 1, 1) && $tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
                  $mask_ind--;
              }
          }
          $tam_campo--;
      }
      if ($tam_campo > 0)
      {
         $mask_saida = substr($mask_dados, 0, $tam_campo) . $mask_saida;
      }
      $nm_campo = $mask_saida;
   }

   function sc_clear_mask($value, $chars)
   {
       $new = '';

       for ($i = 0; $i < strlen($value); $i++)
       {
           if (false === strpos($chars, $value[$i]))
           {
               $new .= $value[$i];
           }
       }

       return $new;
   }
//
   function nm_limpa_alfa(&$str)
   {
       if (get_magic_quotes_gpc())
       {
           if (is_array($str))
           {
               $x = 0;
               foreach ($str as $cada_str)
               {
                   $str[$x] = stripslashes($str[$x]);
                   $x++;
               }
           }
           else
           {
               $str = stripslashes($str);
           }
       }
   }
   function nm_conv_data_db($dt_in, $form_in, $form_out, $replaces = array())
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
       nm_conv_form_data($dt_out, $form_in, $form_out, $replaces);
       return $dt_out;
   }

   function returnWhere($aCond, $sOp = 'AND')
   {
       $aWhere = array();
       foreach ($aCond as $sCond)
       {
           $this->handleWhereCond($sCond);
           if ('' != $sCond)
           {
               $aWhere[] = $sCond;
           }
       }
       if (empty($aWhere))
       {
           return '';
       }
       else
       {
           return ' WHERE (' . implode(') ' . $sOp . ' (', $aWhere) . ')';
       }
   } // returnWhere

   function handleWhereCond(&$sCond)
   {
       $sCond = trim($sCond);
       if ('where' == strtolower(substr($sCond, 0, 5)))
       {
           $sCond = trim(substr($sCond, 5));
       }
   } // handleWhereCond

   function ajax_return_values()
   {
          $this->ajax_return_values_tpmo_id();
          $this->ajax_return_values_tpmo_projectid();
          $this->ajax_return_values_tpmo_namanode();
          $this->ajax_return_values_tpmo_awal();
          $this->ajax_return_values_tpmo_jmlodp();
          $this->ajax_return_values_tpmo_akhir();
          $this->ajax_return_values_tpmo_merk();
          $this->ajax_return_values_tpmo_kapport();
          $this->ajax_return_values_tpmo_nosp();
          $this->ajax_return_values_detail();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['tpmo_id']['keyVal'] = project_edit_update_main_odpedit_mob_pack_protect_string($this->nmgp_dados_form['tpmo_id']);
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['foreign_key']['po_tpmoid'] = $this->nmgp_dados_form['tpmo_id'];
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['foreign_key']['po_idproject'] = $this->nmgp_dados_form['tpmo_projectid'];
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['where_filter'] = "PO_TPMOID = " . $this->nmgp_dados_form['tpmo_id'] . " AND PO_IDPROJECT = " . $this->nmgp_dados_form['tpmo_projectid'] . "";
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['where_detal']  = "PO_TPMOID = " . $this->nmgp_dados_form['tpmo_id'] . " AND PO_IDPROJECT = " . $this->nmgp_dados_form['tpmo_projectid'] . "";
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total'] < 0)
              {
                  $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['where_filter'] = "1 <> 1";
              }
              $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['reg_start'] = "";
              unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['total']);
              foreach ($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob'] as $i => $v)
              {
                  $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail'][$i] = $v;
              }
              if (isset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['total']))
              {
                  unset($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['total']);
              }
          }
   } // ajax_return_values

          //----- tpmo_id
   function ajax_return_values_tpmo_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tpmo_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tpmo_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tpmo_id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tpmo_projectid
   function ajax_return_values_tpmo_projectid($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tpmo_projectid", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tpmo_projectid);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tpmo_projectid'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tpmo_namanode
   function ajax_return_values_tpmo_namanode($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tpmo_namanode", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tpmo_namanode);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tpmo_namanode'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tpmo_awal
   function ajax_return_values_tpmo_awal($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tpmo_awal", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tpmo_awal);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tpmo_awal'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tpmo_jmlodp
   function ajax_return_values_tpmo_jmlodp($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tpmo_jmlodp", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tpmo_jmlodp);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tpmo_jmlodp'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tpmo_akhir
   function ajax_return_values_tpmo_akhir($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tpmo_akhir", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tpmo_akhir);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tpmo_akhir'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tpmo_merk
   function ajax_return_values_tpmo_merk($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tpmo_merk", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tpmo_merk);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tpmo_merk'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tpmo_kapport
   function ajax_return_values_tpmo_kapport($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tpmo_kapport", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tpmo_kapport);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tpmo_kapport'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tpmo_nosp
   function ajax_return_values_tpmo_nosp($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tpmo_nosp", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tpmo_nosp);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tpmo_nosp'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- detail
   function ajax_return_values_detail($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("detail", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->detail);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['detail'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

    function fetchUniqueUploadName($originalName, $uploadDir, $fieldName)
    {
        $originalName = trim($originalName);
        if ('' == $originalName)
        {
            return $originalName;
        }
        if (!@is_dir($uploadDir))
        {
            return $originalName;
        }
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['upload_dir'][$fieldName][] = $newName;
            return $newName;
        }
    } // fetchUniqueUploadName

    function fetchFileNextName($uniqueName, $uniqueList)
    {
        $aPathinfo     = pathinfo($uniqueName);
        $fileExtension = $aPathinfo['extension'];
        $fileName      = $aPathinfo['filename'];
        $foundName     = false;
        $nameIt        = 1;
        if ('' != $fileExtension)
        {
            $fileExtension = '.' . $fileExtension;
        }
        while (!$foundName)
        {
            $testName = $fileName . '(' . $nameIt . ')' . $fileExtension;
            if (in_array($testName, $uniqueList))
            {
                $nameIt++;
            }
            else
            {
                $foundName = true;
                return $testName;
            }
        }
    } // fetchFileNextName

   function ajax_add_parameters()
   {
   } // ajax_add_parameters
  function nm_proc_onload($bFormat = true)
  {
      $this->nm_guardar_campos();
      if ($bFormat) $this->nm_formatar_campos();
  }
//
//----------------------------------------------------
//-----> 
//----------------------------------------------------
//----------- 


   function temRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'SELECT COUNT(*) FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       if ($rsc === false && !$rsc->EOF)
       {
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg());
           exit; 
       }
       $iTotal = $rsc->fields[0];
       $rsc->Close();
       return 0 < $iTotal;
   } // temRegistros

   function deletaRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'DELETE FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       $bResult = $rsc;
       $rsc->Close();
       return $bResult == true;
   } // deletaRegistros

   function nm_acessa_banco() 
   { 
      global  $nm_form_submit, $teste_validade, $sc_where;
 
      $NM_val_null = array();
      $NM_val_form = array();
      $this->sc_erro_insert = "";
      $this->sc_erro_update = "";
      $this->sc_erro_delete = "";
      if (!empty($this->sc_force_zero))
      {
          foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
          {
              eval('if ($this->' . $sc_force_zero_field . ' == 0) {$this->' . $sc_force_zero_field . ' = "";}');
          }
      }
      $this->sc_force_zero = array();
    if ("excluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'on';
                 /* AKSESSMR.TB_PROJECT_ODP */
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
          $sc_cmd_dependency = "SELECT COUNT(*) FROM AKSESSMR.TB_PROJECT_ODP WHERE PO_TPMOID = '" . $this->tpmo_id  . "'";
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      {
          $sc_cmd_dependency = "SELECT COUNT(*) FROM AKSESSMR.TB_PROJECT_ODP WHERE PO_TPMOID = '" . $this->tpmo_id  . "'";
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      {
          $sc_cmd_dependency = "SELECT COUNT(*) FROM AKSESSMR.TB_PROJECT_ODP WHERE PO_TPMOID = '" . $this->tpmo_id  . "'";
      }
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      {
          $sc_cmd_dependency = "SELECT COUNT(*) FROM AKSESSMR.TB_PROJECT_ODP WHERE PO_TPMOID = '" . $this->tpmo_id  . "'";
      }
      else
      {
          $sc_cmd_dependency = "SELECT COUNT(*) FROM AKSESSMR.TB_PROJECT_ODP WHERE PO_TPMOID = '" . $this->tpmo_id  . "'";
      }
       
      $nm_select = $sc_cmd_dependency; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->dataset_AKSESSMR_TB_PROJECT_ODP = array();
      $this->dataset_aksessmr_tb_project_odp = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->dataset_AKSESSMR_TB_PROJECT_ODP[$y] [$x] = $rx->fields[$x];
                      $this->dataset_aksessmr_tb_project_odp[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->dataset_AKSESSMR_TB_PROJECT_ODP = false;
          $this->dataset_AKSESSMR_TB_PROJECT_ODP_erro = $this->Db->ErrorMsg();
          $this->dataset_aksessmr_tb_project_odp = false;
          $this->dataset_aksessmr_tb_project_odp_erro = $this->Db->ErrorMsg();
      } 
;

      if($this->dataset_AKSESSMR_TB_PROJECT_ODP[0][0] > 0)
      {
          
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "" . $this->Ini->Nm_lang['lang_errm_dele_rhcr'] . "";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_project_edit_update_main_odpedit_mob' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "" . $this->Ini->Nm_lang['lang_errm_dele_rhcr'] . "";
 }
;
      }
$_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $this->nmgp_opcao ; 
          if ($this->nmgp_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          else
          { 
              $this->sc_evento = ""; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->NM_rollback_db(); 
          $this->Campos_Mens_erro = ""; 
      }
      $SC_tem_cmp_update = true; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $salva_opcao = $this->nmgp_opcao; 
      if ($this->sc_evento != "novo" && $this->sc_evento != "incluir") 
      { 
          $this->sc_evento = ""; 
      } 
      if (!in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access) && !$this->Ini->sc_tem_trans_banco && in_array($this->nmgp_opcao, array('excluir', 'incluir', 'alterar')))
      { 
          $this->Db->BeginTrans(); 
          $this->Ini->sc_tem_trans_banco = true; 
      } 
      if (!isset($this->tpmo_updateby)){$this->tpmo_updateby =  $_SESSION['usr_login'];}  
      if ('incluir' == $this->nmgp_opcao) { $this->tpmo_entryby = "'" . $_SESSION['usr_login'] . "'"; } 
      if ('alterar' == $this->nmgp_opcao || 'igual' == $this->nmgp_opcao) { $this->tpmo_updateby = "'" . $_SESSION['usr_login'] . "'"; } 
      $NM_val_form['tpmo_id'] = $this->tpmo_id;
      $NM_val_form['tpmo_projectid'] = $this->tpmo_projectid;
      $NM_val_form['tpmo_namanode'] = $this->tpmo_namanode;
      $NM_val_form['tpmo_awal'] = $this->tpmo_awal;
      $NM_val_form['tpmo_jmlodp'] = $this->tpmo_jmlodp;
      $NM_val_form['tpmo_akhir'] = $this->tpmo_akhir;
      $NM_val_form['tpmo_merk'] = $this->tpmo_merk;
      $NM_val_form['tpmo_kapport'] = $this->tpmo_kapport;
      $NM_val_form['tpmo_nosp'] = $this->tpmo_nosp;
      $NM_val_form['detail'] = $this->detail;
      $NM_val_form['tpmo_entryby'] = $this->tpmo_entryby;
      $NM_val_form['tpmo_entrydate'] = $this->tpmo_entrydate;
      $NM_val_form['tpmo_updateby'] = $this->tpmo_updateby;
      $NM_val_form['tpmo_updatedate'] = $this->tpmo_updatedate;
      if ($this->tpmo_id == "")  
      { 
          $this->tpmo_id = 0;
      } 
      if ($this->tpmo_projectid == "")  
      { 
          $this->tpmo_projectid = 0;
          $this->sc_force_zero[] = 'tpmo_projectid';
      } 
      if ($this->tpmo_jmlodp == "")  
      { 
          $this->tpmo_jmlodp = 0;
          $this->sc_force_zero[] = 'tpmo_jmlodp';
      } 
      if ($this->tpmo_kapport == "")  
      { 
          $this->tpmo_kapport = 0;
          $this->sc_force_zero[] = 'tpmo_kapport';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql);
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->tpmo_namanode_before_qstr = $this->tpmo_namanode;
          $this->tpmo_namanode = substr($this->Db->qstr($this->tpmo_namanode), 1, -1); 
          if ($this->tpmo_namanode == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tpmo_namanode = "null"; 
              $NM_val_null[] = "tpmo_namanode";
          } 
          $this->tpmo_awal_before_qstr = $this->tpmo_awal;
          $this->tpmo_awal = substr($this->Db->qstr($this->tpmo_awal), 1, -1); 
          if ($this->tpmo_awal == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tpmo_awal = "null"; 
              $NM_val_null[] = "tpmo_awal";
          } 
          $this->tpmo_akhir_before_qstr = $this->tpmo_akhir;
          $this->tpmo_akhir = substr($this->Db->qstr($this->tpmo_akhir), 1, -1); 
          if ($this->tpmo_akhir == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tpmo_akhir = "null"; 
              $NM_val_null[] = "tpmo_akhir";
          } 
          $this->tpmo_entryby_before_qstr = $this->tpmo_entryby;
          $this->tpmo_entryby = substr($this->Db->qstr($this->tpmo_entryby), 1, -1); 
          if ($this->tpmo_entryby == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tpmo_entryby = "null"; 
              $NM_val_null[] = "tpmo_entryby";
          } 
          if ($this->tpmo_entrydate == "")  
          { 
              $this->tpmo_entrydate = "null"; 
              $NM_val_null[] = "tpmo_entrydate";
          } 
          $this->tpmo_updateby_before_qstr = $this->tpmo_updateby;
          $this->tpmo_updateby = substr($this->Db->qstr($this->tpmo_updateby), 1, -1); 
          if ($this->tpmo_updateby == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tpmo_updateby = "null"; 
              $NM_val_null[] = "tpmo_updateby";
          } 
          if ($this->tpmo_updatedate == "")  
          { 
              $this->tpmo_updatedate = "null"; 
              $NM_val_null[] = "tpmo_updatedate";
          } 
          $this->tpmo_merk_before_qstr = $this->tpmo_merk;
          $this->tpmo_merk = substr($this->Db->qstr($this->tpmo_merk), 1, -1); 
          if ($this->tpmo_merk == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tpmo_merk = "null"; 
              $NM_val_null[] = "tpmo_merk";
          } 
          $this->tpmo_nosp_before_qstr = $this->tpmo_nosp;
          $this->tpmo_nosp = substr($this->Db->qstr($this->tpmo_nosp), 1, -1); 
          if ($this->tpmo_nosp == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tpmo_nosp = "null"; 
              $NM_val_null[] = "tpmo_nosp";
          } 
          $this->detail_before_qstr = $this->detail;
          $this->detail = substr($this->Db->qstr($this->detail), 1, -1); 
          if ($this->detail == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->detail = "null"; 
              $NM_val_null[] = "detail";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_ex_update = true; 
          $SC_ex_upd_or = true; 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 project_edit_update_main_odpedit_mob_pack_ajax_response();
              }
              exit; 
          }  
          $bUpdateOk = true;
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $bUpdateOk = false;
              $this->sc_evento = 'update';
          } 
          $aUpdateOk = array();
          $bUpdateOk = $bUpdateOk && empty($aUpdateOk);
          if ($bUpdateOk)
          { 
              $rs1->Close(); 
              $this->tpmo_updatedate =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->tpmo_updatedate_hora =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $NM_val_form['tpmo_updatedate'] = $this->tpmo_updatedate;
              $this->NM_ajax_changed['tpmo_updatedate'] = true;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET TPMO_PROJECTID = $this->tpmo_projectid, TPMO_NAMANODE = '$this->tpmo_namanode', TPMO_AWAL = '$this->tpmo_awal', TPMO_JMLODP = $this->tpmo_jmlodp, TPMO_AKHIR = '$this->tpmo_akhir', TPMO_MERK = '$this->tpmo_merk', TPMO_KAPPORT = $this->tpmo_kapport, TPMO_NOSP = '$this->tpmo_nosp'";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET TPMO_PROJECTID = $this->tpmo_projectid, TPMO_NAMANODE = '$this->tpmo_namanode', TPMO_AWAL = '$this->tpmo_awal', TPMO_JMLODP = $this->tpmo_jmlodp, TPMO_AKHIR = '$this->tpmo_akhir', TPMO_MERK = '$this->tpmo_merk', TPMO_KAPPORT = $this->tpmo_kapport, TPMO_NOSP = '$this->tpmo_nosp'";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET TPMO_PROJECTID = $this->tpmo_projectid, TPMO_NAMANODE = '$this->tpmo_namanode', TPMO_AWAL = '$this->tpmo_awal', TPMO_JMLODP = $this->tpmo_jmlodp, TPMO_AKHIR = '$this->tpmo_akhir', TPMO_MERK = '$this->tpmo_merk', TPMO_KAPPORT = $this->tpmo_kapport, TPMO_NOSP = '$this->tpmo_nosp'";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET TPMO_PROJECTID = $this->tpmo_projectid, TPMO_NAMANODE = '$this->tpmo_namanode', TPMO_AWAL = '$this->tpmo_awal', TPMO_JMLODP = $this->tpmo_jmlodp, TPMO_AKHIR = '$this->tpmo_akhir', TPMO_MERK = '$this->tpmo_merk', TPMO_KAPPORT = $this->tpmo_kapport, TPMO_NOSP = '$this->tpmo_nosp'";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET TPMO_PROJECTID = $this->tpmo_projectid, TPMO_NAMANODE = '$this->tpmo_namanode', TPMO_AWAL = '$this->tpmo_awal', TPMO_JMLODP = $this->tpmo_jmlodp, TPMO_AKHIR = '$this->tpmo_akhir', TPMO_MERK = '$this->tpmo_merk', TPMO_KAPPORT = $this->tpmo_kapport, TPMO_NOSP = '$this->tpmo_nosp'";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET TPMO_PROJECTID = $this->tpmo_projectid, TPMO_NAMANODE = '$this->tpmo_namanode', TPMO_AWAL = '$this->tpmo_awal', TPMO_JMLODP = $this->tpmo_jmlodp, TPMO_AKHIR = '$this->tpmo_akhir', TPMO_MERK = '$this->tpmo_merk', TPMO_KAPPORT = $this->tpmo_kapport, TPMO_NOSP = '$this->tpmo_nosp'";  
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET TPMO_PROJECTID = $this->tpmo_projectid, TPMO_NAMANODE = '$this->tpmo_namanode', TPMO_AWAL = '$this->tpmo_awal', TPMO_JMLODP = $this->tpmo_jmlodp, TPMO_AKHIR = '$this->tpmo_akhir', TPMO_MERK = '$this->tpmo_merk', TPMO_KAPPORT = $this->tpmo_kapport, TPMO_NOSP = '$this->tpmo_nosp'";  
              } 
              if (isset($NM_val_form['tpmo_entryby']) && $NM_val_form['tpmo_entryby'] != $this->nmgp_dados_select['tpmo_entryby']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " TPMO_ENTRYBY = '$this->tpmo_entryby'"; 
                  $comando_oracle        .= " TPMO_ENTRYBY = '$this->tpmo_entryby'"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['tpmo_entrydate']) && $NM_val_form['tpmo_entrydate'] != $this->nmgp_dados_select['tpmo_entrydate']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $comando        .= " TPMO_ENTRYDATE = #$this->tpmo_entrydate#"; 
                  } 
                  else 
                  { 
                      $comando        .= " TPMO_ENTRYDATE = " . $this->Ini->date_delim . $this->tpmo_entrydate . $this->Ini->date_delim1 . ""; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $comando_oracle        .= " TPMO_ENTRYDATE = EXTEND('" . $this->tpmo_entrydate . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $comando_oracle        .= " TPMO_ENTRYDATE = " . $this->Ini->date_delim . $this->tpmo_entrydate . $this->Ini->date_delim1 . ""; 
                  } 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['tpmo_updateby']) && $NM_val_form['tpmo_updateby'] != $this->nmgp_dados_select['tpmo_updateby']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " TPMO_UPDATEBY = '$this->tpmo_updateby'"; 
                  $comando_oracle        .= " TPMO_UPDATEBY = '$this->tpmo_updateby'"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['tpmo_updatedate']) && $NM_val_form['tpmo_updatedate'] != $this->nmgp_dados_select['tpmo_updatedate']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $comando        .= " TPMO_UPDATEDATE = #$this->tpmo_updatedate#"; 
                  } 
                  else 
                  { 
                      $comando        .= " TPMO_UPDATEDATE = " . $this->Ini->date_delim . $this->tpmo_updatedate . $this->Ini->date_delim1 . ""; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $comando_oracle        .= " TPMO_UPDATEDATE = EXTEND('" . $this->tpmo_updatedate . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $comando_oracle        .= " TPMO_UPDATEDATE = " . $this->Ini->date_delim . $this->tpmo_updatedate . $this->Ini->date_delim1 . ""; 
                  } 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              $aDoNotUpdate = array();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  $comando = $comando_oracle;  
                  $SC_ex_update = $SC_ex_upd_or;
              }   
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE TPMO_ID = $this->tpmo_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE TPMO_ID = $this->tpmo_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE TPMO_ID = $this->tpmo_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE TPMO_ID = $this->tpmo_id ";  
              }  
              else  
              {
                  $comando .= " WHERE TPMO_ID = $this->tpmo_id ";  
              }  
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                $comando = str_replace("EXTEND('', YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND('', YEAR TO DAY)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO DAY)", "null", $comando) ; 
              }  
              if ($SC_ex_update || $SC_tem_cmp_update)
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
                  $rs = $this->Db->Execute($comando);  
                  if ($rs === false) 
                  { 
                      if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                      {
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $this->Db->ErrorMsg(), true); 
                          if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                          { 
                              $this->sc_erro_update = $this->Db->ErrorMsg();  
                              $this->NM_rollback_db(); 
                              if ($this->NM_ajax_flag)
                              {
                                  project_edit_update_main_odpedit_mob_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
              }   
          $this->tpmo_namanode = $this->tpmo_namanode_before_qstr;
          $this->tpmo_awal = $this->tpmo_awal_before_qstr;
          $this->tpmo_akhir = $this->tpmo_akhir_before_qstr;
          $this->tpmo_entryby = $this->tpmo_entryby_before_qstr;
          $this->tpmo_updateby = $this->tpmo_updateby_before_qstr;
          $this->tpmo_merk = $this->tpmo_merk_before_qstr;
          $this->tpmo_nosp = $this->tpmo_nosp_before_qstr;
          $this->detail = $this->detail_before_qstr;
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['db_changed'] = true;


              if     (isset($NM_val_form) && isset($NM_val_form['tpmo_id'])) { $this->tpmo_id = $NM_val_form['tpmo_id']; }
              elseif (isset($this->tpmo_id)) { $this->nm_limpa_alfa($this->tpmo_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['tpmo_projectid'])) { $this->tpmo_projectid = $NM_val_form['tpmo_projectid']; }
              elseif (isset($this->tpmo_projectid)) { $this->nm_limpa_alfa($this->tpmo_projectid); }
              if     (isset($NM_val_form) && isset($NM_val_form['tpmo_namanode'])) { $this->tpmo_namanode = $NM_val_form['tpmo_namanode']; }
              elseif (isset($this->tpmo_namanode)) { $this->nm_limpa_alfa($this->tpmo_namanode); }
              if     (isset($NM_val_form) && isset($NM_val_form['tpmo_awal'])) { $this->tpmo_awal = $NM_val_form['tpmo_awal']; }
              elseif (isset($this->tpmo_awal)) { $this->nm_limpa_alfa($this->tpmo_awal); }
              if     (isset($NM_val_form) && isset($NM_val_form['tpmo_jmlodp'])) { $this->tpmo_jmlodp = $NM_val_form['tpmo_jmlodp']; }
              elseif (isset($this->tpmo_jmlodp)) { $this->nm_limpa_alfa($this->tpmo_jmlodp); }
              if     (isset($NM_val_form) && isset($NM_val_form['tpmo_akhir'])) { $this->tpmo_akhir = $NM_val_form['tpmo_akhir']; }
              elseif (isset($this->tpmo_akhir)) { $this->nm_limpa_alfa($this->tpmo_akhir); }
              if     (isset($NM_val_form) && isset($NM_val_form['tpmo_merk'])) { $this->tpmo_merk = $NM_val_form['tpmo_merk']; }
              elseif (isset($this->tpmo_merk)) { $this->nm_limpa_alfa($this->tpmo_merk); }
              if     (isset($NM_val_form) && isset($NM_val_form['tpmo_kapport'])) { $this->tpmo_kapport = $NM_val_form['tpmo_kapport']; }
              elseif (isset($this->tpmo_kapport)) { $this->nm_limpa_alfa($this->tpmo_kapport); }
              if     (isset($NM_val_form) && isset($NM_val_form['tpmo_nosp'])) { $this->tpmo_nosp = $NM_val_form['tpmo_nosp']; }
              elseif (isset($this->tpmo_nosp)) { $this->nm_limpa_alfa($this->tpmo_nosp); }
              if     (isset($NM_val_form) && isset($NM_val_form['detail'])) { $this->detail = $NM_val_form['detail']; }
              elseif (isset($this->detail)) { $this->nm_limpa_alfa($this->detail); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('tpmo_id', 'tpmo_projectid', 'tpmo_namanode', 'tpmo_awal', 'tpmo_jmlodp', 'tpmo_akhir', 'tpmo_merk', 'tpmo_kapport', 'tpmo_nosp', 'detail'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "TPMO_ID, ";
          } 
              $this->tpmo_entrydate =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->tpmo_entrydate_hora =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      project_edit_update_main_odpedit_mob_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, TPMO_ENTRYDATE, TPMO_UPDATEBY, TPMO_UPDATEDATE, TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP) VALUES ($this->tpmo_projectid, '$this->tpmo_namanode', '$this->tpmo_awal', $this->tpmo_jmlodp, '$this->tpmo_akhir', '$this->tpmo_entryby', #$this->tpmo_entrydate#, '$this->tpmo_updateby', #$this->tpmo_updatedate#, '$this->tpmo_merk', $this->tpmo_kapport, '$this->tpmo_nosp')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, TPMO_ENTRYDATE, TPMO_UPDATEBY, TPMO_UPDATEDATE, TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP) VALUES (" . $NM_seq_auto . "$this->tpmo_projectid, '$this->tpmo_namanode', '$this->tpmo_awal', $this->tpmo_jmlodp, '$this->tpmo_akhir', '$this->tpmo_entryby', " . $this->Ini->date_delim . $this->tpmo_entrydate . $this->Ini->date_delim1 . ", '$this->tpmo_updateby', " . $this->Ini->date_delim . $this->tpmo_updatedate . $this->Ini->date_delim1 . ", '$this->tpmo_merk', $this->tpmo_kapport, '$this->tpmo_nosp')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, TPMO_ENTRYDATE, TPMO_UPDATEBY, TPMO_UPDATEDATE, TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP) VALUES (" . $NM_seq_auto . "$this->tpmo_projectid, '$this->tpmo_namanode', '$this->tpmo_awal', $this->tpmo_jmlodp, '$this->tpmo_akhir', '$this->tpmo_entryby', " . $this->Ini->date_delim . $this->tpmo_entrydate . $this->Ini->date_delim1 . ", '$this->tpmo_updateby', " . $this->Ini->date_delim . $this->tpmo_updatedate . $this->Ini->date_delim1 . ", '$this->tpmo_merk', $this->tpmo_kapport, '$this->tpmo_nosp')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, TPMO_ENTRYDATE, TPMO_UPDATEBY, TPMO_UPDATEDATE, TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP) VALUES (" . $NM_seq_auto . "$this->tpmo_projectid, '$this->tpmo_namanode', '$this->tpmo_awal', $this->tpmo_jmlodp, '$this->tpmo_akhir', '$this->tpmo_entryby', EXTEND('$this->tpmo_entrydate', YEAR TO DAY), '$this->tpmo_updateby', EXTEND('$this->tpmo_updatedate', YEAR TO DAY), '$this->tpmo_merk', $this->tpmo_kapport, '$this->tpmo_nosp')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, TPMO_ENTRYDATE, TPMO_UPDATEBY, TPMO_UPDATEDATE, TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP) VALUES (" . $NM_seq_auto . "$this->tpmo_projectid, '$this->tpmo_namanode', '$this->tpmo_awal', $this->tpmo_jmlodp, '$this->tpmo_akhir', '$this->tpmo_entryby', " . $this->Ini->date_delim . $this->tpmo_entrydate . $this->Ini->date_delim1 . ", '$this->tpmo_updateby', " . $this->Ini->date_delim . $this->tpmo_updatedate . $this->Ini->date_delim1 . ", '$this->tpmo_merk', $this->tpmo_kapport, '$this->tpmo_nosp')"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, TPMO_ENTRYDATE, TPMO_UPDATEBY, TPMO_UPDATEDATE, TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP) VALUES (" . $NM_seq_auto . "$this->tpmo_projectid, '$this->tpmo_namanode', '$this->tpmo_awal', $this->tpmo_jmlodp, '$this->tpmo_akhir', '$this->tpmo_entryby', " . $this->Ini->date_delim . $this->tpmo_entrydate . $this->Ini->date_delim1 . ", '$this->tpmo_updateby', " . $this->Ini->date_delim . $this->tpmo_updatedate . $this->Ini->date_delim1 . ", '$this->tpmo_merk', $this->tpmo_kapport, '$this->tpmo_nosp')"; 
              }
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                $comando = str_replace("EXTEND('', YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND('', YEAR TO DAY)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO DAY)", "null", $comando) ; 
              }  
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
              $rs = $this->Db->Execute($comando); 
              if ($rs === false)  
              { 
                  if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                  {
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg(), true); 
                      if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                      { 
                          $this->sc_erro_insert = $this->Db->ErrorMsg();  
                          $this->nmgp_opcao     = 'refresh_insert';
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              project_edit_update_main_odpedit_mob_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select @@identity"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          project_edit_update_main_odpedit_mob_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->tpmo_id =  $rsy->fields[0];
                 $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_id()"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->tpmo_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SELECT dbinfo('sqlca.sqlerrd1') FROM " . $this->Ini->nm_tabela; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->tpmo_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select .currval from dual"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->tpmo_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
              { 
                  $str_tabela = "SYSIBM.SYSDUMMY1"; 
                  if($this->Ini->nm_con_use_schema == "N") 
                  { 
                          $str_tabela = "SYSDUMMY1"; 
                  } 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SELECT IDENTITY_VAL_LOCAL() FROM " . $str_tabela; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->tpmo_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select CURRVAL('')"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->tpmo_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select gen_id(, 0) from " . $this->Ini->nm_tabela; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->tpmo_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_rowid()"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->tpmo_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->sc_insert_on = true; 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao   = "igual"; 
              $this->nmgp_opc_ant = "igual"; 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->tpmo_id = substr($this->Db->qstr($this->tpmo_id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';
          if ($bDelecaoOk)
          {
              $sDetailWhere = "PO_TPMOID = " . $this->tpmo_id . " AND PO_IDPROJECT = " . $this->tpmo_projectid . "";
              $this->odp_master_edit_detail_mob->ini_controle();
              if ($this->odp_master_edit_detail_mob->temRegistros($sDetailWhere))
              {
                  $bDelecaoOk = false;
                  $sMsgErro   = $this->Ini->Nm_lang['lang_errm_fkvi'];
              }
          }

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_dele_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $this->sc_evento = 'delete';
          } 
          else 
          { 
              $rs1->Close(); 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where TPMO_ID = $this->tpmo_id "); 
              }  
              if ($rs === false) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dele'], $this->Db->ErrorMsg(), true); 
                  if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                  { 
                      $this->sc_erro_delete = $this->Db->ErrorMsg();  
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          project_edit_update_main_odpedit_mob_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total']);
              }

              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }
          }

          }
          else
          {
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "igual"; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $sMsgErro); 
          }

      }  
      if (!empty($this->sc_force_zero))
      {
          foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
          {
              eval('if ($this->' . $sc_force_zero_field . ' == 0) {$this->' . $sc_force_zero_field . ' = "";}');
          }
      }
      $this->sc_force_zero = array();
      if (!empty($NM_val_null))
      {
          foreach ($NM_val_null as $i_val_null => $sc_val_null_field)
          {
              eval('$this->' . $sc_val_null_field . ' = "";');
          }
      }
    if ("insert" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        $_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
     $check_sql = "SELECT TPMO_NAMANODE,TPMO_AWAL,TPMO_JMLODP,TPMO_AKHIR FROM TBL_PROJECT_MASTER_ODP
WHERE TPMO_PROJECTID=$this->tpmo_projectid   AND TPMO_ID=$this->tpmo_id ";

 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
;
$field_total  = 0;
if (false == $this->rs )
{
    
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'Error while accessing database.';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_project_edit_update_main_odpedit_mob' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'Error while accessing database.';
 }
;
}
else
{
   while(!$this->rs->EOF)
    {
		$field_total  += $this->rs->fields[2];
	    $namanode  = $this->rs->fields[0];
	    $awal  = $this->rs->fields[1];
	    $jmlodp  = $this->rs->fields[2];
	    $akhir  = $this->rs->fields[3];
	   
	for ($j=$awal ; $j<=$akhir ; $j++) {
	$odpnumber = str_pad($j,3,"0",STR_PAD_LEFT);
	$insert_table  = 'TB_PROJECT_ODP';      
	$insert_fields = array(   
     'PO_TIPENODE' => "'ODP'",
	 'PO_NAMANODE' => "'$this->tpmo_namanode /$odpnumber'",
     'PO_MERK' => "'$this->tpmo_merk'",
	 'PO_KAPPORT' => "'$this->tpmo_kapport'",
	 'PO_NOSP' => "'$this->tpmo_nosp'",
	 'PO_IDPROJECT' => "'$this->tpmo_projectid'",		
	 'PO_TGLENTRY'  => "now()",
	 'PO_ENTRYBY'  => "'$this->sc_temp_usr_login'",
	 'PO_TPMOID'  => "$this->tpmo_id ");
	$insert_sql = 'INSERT INTO ' . $insert_table
    . ' ('   . implode(', ', array_keys($insert_fields))   . ')'
    . ' VALUES ('    . implode(', ', array_values($insert_fields)) . ')';
	
     $nm_select = $insert_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_odpedit_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
																}

		$this->rs->MoveNext();
    }
	$this->rs->Close();

     $nm_select ="update TBL_PROJECT_CONTROL set TPC_ODPNEW='Y' where TPC_IDPROJECT=$this->tpmo_projectid "; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_odpedit_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;$this->update_jml_odp();

}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
$_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'off'; 
    }
    if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada") {
      $_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'on';
     

$delete_table  = 'TB_PROJECT_ODP';      
$delete_where  = "PO_TPMOID='$this->tpmo_id' AND PO_IDPROJECT = '$this->tpmo_projectid'"; 

$delete_sql = 'DELETE FROM ' . $delete_table
    . ' WHERE '      . $delete_where;

     $nm_select = $delete_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_odpedit_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
$_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $salva_opcao ; 
          if ($salva_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->sc_evento = ""; 
          $this->NM_rollback_db(); 
          return; 
      }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['parms'] = "tpmo_id?#?$this->tpmo_id?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->tpmo_id = substr($this->Db->qstr($this->tpmo_id), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "R")
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->tpmo_id)) 
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
          else 
          { 
              $this->nmgp_opcao = "igual"; 
          } 
      } 
      if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) 
      { 
          $this->nmgp_opcao = "inicio";
      } 
      if ($this->nmgp_opcao != "nada" && (trim($this->tpmo_id) == "")) 
      { 
          if ($this->nmgp_opcao == "avanca")  
          { 
              $this->nmgp_opcao = "final"; 
          } 
          elseif ($this->nmgp_opcao != "novo")
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "F" && $this->sc_evento == "insert")
      {
          $this->nmgp_opcao = "final";
      }
      $sc_where = trim("TPMO_PROJECTID=" . $_SESSION['var_projectid'] . "");
      if (substr(strtolower($sc_where), 0, 5) == "where")
      {
          $sc_where  = substr($sc_where , 5);
      }
      if (!empty($sc_where))
      {
          $sc_where = " where " . $sc_where . " ";
      }
      if ('' != $sc_where_filter)
      {
          $sc_where = ('' != $sc_where) ? $sc_where . ' and (' . $sc_where_filter . ')' : ' where ' . $sc_where_filter;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total']))
      { 
          $nmgp_select = "SELECT count(*) from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_project_edit_update_main_odpedit_mob = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total'] = $qt_geral_reg_project_edit_update_main_odpedit_mob;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->tpmo_id))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "TPMO_ID < $this->tpmo_id "; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Key_Where = "TPMO_ID < $this->tpmo_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Key_Where = "TPMO_ID < $this->tpmo_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Key_Where = "TPMO_ID < $this->tpmo_id "; 
              }
              else  
              {
                  $Key_Where = "TPMO_ID < $this->tpmo_id "; 
              }
              $Where_Start = (empty($sc_where)) ? " where " . $Key_Where :  $sc_where . " and (" . $Key_Where . ")";
              $nmgp_select = "SELECT count(*) from " . $this->Ini->nm_tabela . $Where_Start; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rt = $this->Db->Execute($nmgp_select) ; 
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit ; 
              }  
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] = $rt->fields[0];
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_project_edit_update_main_odpedit_mob = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] > $qt_geral_reg_project_edit_update_main_odpedit_mob)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] = $qt_geral_reg_project_edit_update_main_odpedit_mob; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] = $qt_geral_reg_project_edit_update_main_odpedit_mob; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_project_edit_update_main_odpedit_mob) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total'] + 1; 
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT TPMO_ID, TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, str_replace (convert(char(10),TPMO_ENTRYDATE,102), '.', '-') + ' ' + convert(char(8),TPMO_ENTRYDATE,20), TPMO_UPDATEBY, str_replace (convert(char(10),TPMO_UPDATEDATE,102), '.', '-') + ' ' + convert(char(8),TPMO_UPDATEDATE,20), TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT TPMO_ID, TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, convert(char(23),TPMO_ENTRYDATE,121), TPMO_UPDATEBY, convert(char(23),TPMO_UPDATEDATE,121), TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT TPMO_ID, TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, TPMO_ENTRYDATE, TPMO_UPDATEBY, TPMO_UPDATEDATE, TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT TPMO_ID, TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, EXTEND(TPMO_ENTRYDATE, YEAR TO DAY), TPMO_UPDATEBY, EXTEND(TPMO_UPDATEDATE, YEAR TO DAY), TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT TPMO_ID, TPMO_PROJECTID, TPMO_NAMANODE, TPMO_AWAL, TPMO_JMLODP, TPMO_AKHIR, TPMO_ENTRYBY, TPMO_ENTRYDATE, TPMO_UPDATEBY, TPMO_UPDATEDATE, TPMO_MERK, TPMO_KAPPORT, TPMO_NOSP from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = "TPMO_PROJECTID=" . $_SESSION['var_projectid'] . "";
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_adm_clientes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_adm_clientes']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (!empty($sc_where))
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                     $aWhere[] = "TPMO_ID = $this->tpmo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                  {
                     $aWhere[] = "TPMO_ID = $this->tpmo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  {
                     $aWhere[] = "TPMO_ID = $this->tpmo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  {
                     $aWhere[] = "TPMO_ID = $this->tpmo_id"; 
                  }  
                  else  
                  {
                     $aWhere[] = "TPMO_ID = $this->tpmo_id"; 
                  }
              } 
              else
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                      $aWhere[] = "TPMO_ID = $this->tpmo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                  {
                      $aWhere[] = "TPMO_ID = $this->tpmo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  {
                      $aWhere[] = "TPMO_ID = $this->tpmo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  {
                      $aWhere[] = "TPMO_ID = $this->tpmo_id"; 
                  }  
                  else  
                  {
                      $aWhere[] = "TPMO_ID = $this->tpmo_id"; 
                  }
              } 
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "TPMO_ID";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start']) ;  
              } 
          } 
          if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs->EOF) 
          { 
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['empty_filter'] = true;
                  return; 
              }
              if ($this->nmgp_botoes['insert'] != "on")
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
              }
              $this->nmgp_opcao = "novo"; 
              $this->nm_flag_saida_novo = "S"; 
              $rs->Close(); 
              if ($this->aba_iframe)
              {
                  $this->NM_ajax_info['buttonDisplay']['exit'] = $this->nmgp_botoes['exit'] = 'off';
              }
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd_extr']); 
              $this->nmgp_opcao = "novo"; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->tpmo_id = $rs->fields[0] ; 
              $this->nmgp_dados_select['tpmo_id'] = $this->tpmo_id;
              $this->tpmo_projectid = $rs->fields[1] ; 
              $this->nmgp_dados_select['tpmo_projectid'] = $this->tpmo_projectid;
              $this->tpmo_namanode = $rs->fields[2] ; 
              $this->nmgp_dados_select['tpmo_namanode'] = $this->tpmo_namanode;
              $this->tpmo_awal = $rs->fields[3] ; 
              $this->nmgp_dados_select['tpmo_awal'] = $this->tpmo_awal;
              $this->tpmo_jmlodp = $rs->fields[4] ; 
              $this->nmgp_dados_select['tpmo_jmlodp'] = $this->tpmo_jmlodp;
              $this->tpmo_akhir = $rs->fields[5] ; 
              $this->nmgp_dados_select['tpmo_akhir'] = $this->tpmo_akhir;
              $this->tpmo_entryby = $rs->fields[6] ; 
              $this->nmgp_dados_select['tpmo_entryby'] = $this->tpmo_entryby;
              $this->tpmo_entrydate = $rs->fields[7] ; 
              $this->nmgp_dados_select['tpmo_entrydate'] = $this->tpmo_entrydate;
              $this->tpmo_updateby = $rs->fields[8] ; 
              $this->nmgp_dados_select['tpmo_updateby'] = $this->tpmo_updateby;
              $this->tpmo_updatedate = $rs->fields[9] ; 
              $this->nmgp_dados_select['tpmo_updatedate'] = $this->tpmo_updatedate;
              $this->tpmo_merk = $rs->fields[10] ; 
              $this->nmgp_dados_select['tpmo_merk'] = $this->tpmo_merk;
              $this->tpmo_kapport = $rs->fields[11] ; 
              $this->nmgp_dados_select['tpmo_kapport'] = $this->tpmo_kapport;
              $this->tpmo_nosp = $rs->fields[12] ; 
              $this->nmgp_dados_select['tpmo_nosp'] = $this->tpmo_nosp;
              $this->detail = $rs->fields[13] ; 
              $this->nmgp_dados_select['detail'] = $this->detail;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->tpmo_id = (string)$this->tpmo_id; 
              $this->tpmo_projectid = (string)$this->tpmo_projectid; 
              $this->tpmo_jmlodp = (string)$this->tpmo_jmlodp; 
              $this->tpmo_kapport = (string)$this->tpmo_kapport; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['parms'] = "tpmo_id?#?$this->tpmo_id?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] < $qt_geral_reg_project_edit_update_main_odpedit_mob;
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opcao']   = '';
          }
      } 
      if ($this->nmgp_opcao == "novo" || $this->nmgp_opcao == "refresh_insert") 
      { 
          $this->sc_evento_old = $this->sc_evento;
          $this->sc_evento = "novo";
          if ('refresh_insert' == $this->nmgp_opcao)
          {
              $this->nmgp_opcao = 'novo';
          }
          else
          {
              $this->nm_formatar_campos();
              $this->tpmo_id = "";  
              $this->tpmo_projectid = "" . $_SESSION['var_projectid'] . "";  
              $this->tpmo_namanode = "";  
              $this->tpmo_awal = "";  
              $this->tpmo_jmlodp = "";  
              $this->tpmo_akhir = "";  
              $this->tpmo_entryby = "";  
              $this->tpmo_entrydate = "";  
              $this->tpmo_entrydate_hora = "" ;  
              $this->tpmo_updateby = "";  
              $this->tpmo_updatedate = "";  
              $this->tpmo_updatedate_hora = "" ;  
              $this->tpmo_merk = "";  
              $this->tpmo_kapport = "";  
              $this->tpmo_nosp = "";  
              $this->detail = "";  
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
      }  
//
//
//-- 
      if ($this->nmgp_opcao != "novo") 
      {
      }
      if (!isset($this->nmgp_refresh_fields)) 
      { 
          $this->nm_proc_onload();
      }
      $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['odp_master_edit_detail_mob_script_case_init'] ]['odp_master_edit_detail_mob']['embutida_parms'] = "var_projectid*scin" . $this->nmgp_dados_form['tpmo_projectid'] . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scout";
  }
   function NM_gera_nav_page() 
   {
       $this->SC_nav_page = "";
       $Arr_result        = array();
       $Ind_result        = 0;
       $Reg_Page   = 1;
       $Max_link   = 5;
       $Mid_link   = ceil($Max_link / 2);
       $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['reg_start'] + 1;
       $rec_fim    = ($rec_fim > $rec_tot) ? $rec_tot : $rec_fim;
       if ($rec_tot == 0)
       {
           return;
       }
       $Qtd_Pages  = ceil($rec_tot / $Reg_Page);
       $Page_Atu   = ceil($rec_fim / $Reg_Page);
       $Link_ini   = 1;
       if ($Page_Atu > $Max_link)
       {
           $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
       }
       elseif ($Page_Atu > $Mid_link)
       {
           $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
       }
       if (($Qtd_Pages - $Link_ini) < $Max_link)
       {
           $Link_ini = ($Qtd_Pages - $Max_link) + 1;
       }
       if ($Link_ini < 1)
       {
           $Link_ini = 1;
       }
       for ($x = 0; $x < $Max_link && $Link_ini <= $Qtd_Pages; $x++)
       {
           $rec = (($Link_ini - 1) * $Reg_Page) + 1;
           if ($Link_ini == $Page_Atu)
           {
               $Arr_result[$Ind_result] = '<span class="scFormToolbarNavOpen" style="vertical-align: middle;">' . $Link_ini . '</span>';
           }
           else
           {
               $Arr_result[$Ind_result] = '<a class="scFormToolbarNav" style="vertical-align: middle;" href="javascript: nm_navpage(' . $rec . ')">' . $Link_ini . '</a>';
           }
           $Link_ini++;
           $Ind_result++;
           if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
           {
               $Arr_result[$Ind_result] = '<img src="' . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . '" align="absmiddle" style="vertical-align: middle;">';
               $Ind_result++;
           }
       }
       if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
       {
           krsort($Arr_result);
       }
       foreach ($Arr_result as $Ind_result => $Lin_result)
       {
           $this->SC_nav_page .= $Lin_result;
       }
   }
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//
function TPMO_JMLODP_onChange()
{
$_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'on';
     
$original_tpmo_awal = $this->tpmo_awal;
$original_tpmo_jmlodp = $this->tpmo_jmlodp;
$original_tpmo_akhir = $this->tpmo_akhir;



$odpakhir = $this->tpmo_awal  + $this->tpmo_jmlodp -1;
$this->tpmo_akhir  = str_pad($odpakhir,3,"0",STR_PAD_LEFT);
$this->sc_field_readonly("tpmo_akhir", 'on');

$modificado_tpmo_awal = $this->tpmo_awal;
$modificado_tpmo_jmlodp = $this->tpmo_jmlodp;
$modificado_tpmo_akhir = $this->tpmo_akhir;
$this->nm_formatar_campos('tpmo_awal', 'tpmo_jmlodp', 'tpmo_akhir');
if ($original_tpmo_awal !== $modificado_tpmo_awal || isset($this->nmgp_cmp_readonly['tpmo_awal']) || (isset($bFlagRead_tpmo_awal) && $bFlagRead_tpmo_awal))
{
    $this->ajax_return_values_tpmo_awal(true);
}
if ($original_tpmo_jmlodp !== $modificado_tpmo_jmlodp || isset($this->nmgp_cmp_readonly['tpmo_jmlodp']) || (isset($bFlagRead_tpmo_jmlodp) && $bFlagRead_tpmo_jmlodp))
{
    $this->ajax_return_values_tpmo_jmlodp(true);
}
if ($original_tpmo_akhir !== $modificado_tpmo_akhir || isset($this->nmgp_cmp_readonly['tpmo_akhir']) || (isset($bFlagRead_tpmo_akhir) && $bFlagRead_tpmo_akhir))
{
    $this->ajax_return_values_tpmo_akhir(true);
}
project_edit_update_main_odpedit_mob_pack_ajax_response();
exit;
$_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'off';
}
function update_jml_odp()
{
$_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_var_projectid)) {$this->sc_temp_var_projectid = (isset($_SESSION['var_projectid'])) ? $_SESSION['var_projectid'] : "";}
     
$check_sql = "SELECT COUNT(PO_ID) AS JMLODP,SUM(PO_KAPPORT) AS JMLPORT FROM TB_PROJECT_ODP WHERE PO_IDPROJECT=$this->sc_temp_var_projectid";
 
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
    $this->jmlodp  = $this->rs[0][0];
    $this->jmlport  = $this->rs[0][1];

     $nm_select ="update TBL_PROJECT set TP_ODP=$this->jmlodp ,TP_JMLPORT=$this->jmlport  where TP_ID=$this->sc_temp_var_projectid"; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_odpedit_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
}
		else     
{
    $this->jmlodp  = '';
    $this->jmlport  = '';
}
if (isset($this->sc_temp_var_projectid)) { $_SESSION['var_projectid'] = $this->sc_temp_var_projectid;}
$_SESSION['scriptcase']['project_edit_update_main_odpedit_mob']['contr_erro'] = 'off';
}
//
 function nm_gera_html()
 {
    global
           $nm_url_saida, $nmgp_url_saida, $nm_saida_global, $nm_apl_dependente, $glo_subst, $sc_check_excl, $sc_check_incl, $nmgp_num_form, $NM_run_iframe;
     if ($this->Embutida_proc)
     {
         return;
     }
     if ($this->nmgp_form_show == 'off')
     {
         exit;
     }
      if (isset($NM_run_iframe) && $NM_run_iframe == 1)
      {
          $this->nmgp_botoes['exit'] = "off";
      }
     $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opc_ant'] = $this->nmgp_opcao;
     }
     else
     {
         $this->nmgp_opcao = $this->nmgp_opc_ant;
     }
     if (!empty($this->Campos_Mens_erro)) 
     {
         $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
         $this->Campos_Mens_erro = "";
     }
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              project_edit_update_main_odpedit_mob_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("project_edit_update_main_odpedit_mob_form0.php");
        $this->hideFormPages();
 }

        function initFormPages() {
        } // initFormPages

        function hideFormPages() {
        } // hideFormPages

    function form_encode_input($string)
    {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input

   function jqueryCalendarDtFormat($sFormat, $sSep)
   {
       $sFormat = chunk_split(str_replace('yyyy', 'yy', $sFormat), 2, $sSep);

       if ($sSep == substr($sFormat, -1))
       {
           $sFormat = substr($sFormat, 0, -1);
       }

       return $sFormat;
   } // jqueryCalendarDtFormat

   function jqueryCalendarTimeStart($sFormat)
   {
       $aDateParts = explode(';', $sFormat);

       if (2 == sizeof($aDateParts))
       {
           $sTime = $aDateParts[1];
       }
       else
       {
           $sTime = 'hh:mm:ss';
       }

       return str_replace(array('h', 'm', 'i', 's'), array('0', '0', '0', '0'), $sTime);
   } // jqueryCalendarTimeStart

   function jqueryCalendarWeekInit($sDay)
   {
       switch ($sDay) {
           case 'MO': return 1; break;
           case 'TU': return 2; break;
           case 'WE': return 3; break;
           case 'TH': return 4; break;
           case 'FR': return 5; break;
           case 'SA': return 6; break;
           default  : return 7; break;
       }
   } // jqueryCalendarWeekInit

   function jqueryIconFile($sModule)
   {
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && 'image' == $this->arr_buttons['bcalendario']['type'])
           {
               $sImage = $this->arr_buttons['bcalendario']['image'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && 'image' == $this->arr_buttons['bcalculadora']['type'])
           {
               $sImage = $this->arr_buttons['bcalculadora']['image'];
           }
       }

       return $this->Ini->path_icones . '/' . $sImage;
   } // jqueryIconFile


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['csrf_token'];
    }

    function scCsrfGenerateToken()
    {
        $aSources = array(
            'abcdefghijklmnopqrstuvwxyz',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '1234567890',
            '!@$*()-_[]{},.;:'
        );

        $sRandom = '';

        $aSourcesSizes = array();
        $iSourceSize   = sizeof($aSources) - 1;
        for ($i = 0; $i <= $iSourceSize; $i++)
        {
            $aSourcesSizes[$i] = strlen($aSources[$i]) - 1;
        }

        for ($i = 0; $i < 64; $i++)
        {
            $iSource = $this->scCsrfRandom(0, $iSourceSize);
            $sRandom .= substr($aSources[$iSource], $this->scCsrfRandom(0, $aSourcesSizes[$iSource]), 1);
        }

        return $sRandom;
    }

    function scCsrfRandom($iMin, $iMax)
    {
        return mt_rand($iMin, $iMax);
    }

        function addUrlParam($url, $param, $value) {
                $urlParts  = explode('?', $url);
                $urlParams = isset($urlParts[1]) ? explode('&', $urlParts[1]) : array();
                $objParams = array();
                foreach ($urlParams as $paramInfo) {
                        $paramParts = explode('=', $paramInfo);
                        $objParams[ $paramParts[0] ] = isset($paramParts[1]) ? $paramParts[1] : '';
                }
                $objParams[$param] = $value;
                $urlParams = array();
                foreach ($objParams as $paramName => $paramValue) {
                        $urlParams[] = $paramName . '=' . $paramValue;
                }
                return $urlParts[0] . '?' . implode('&', $urlParams);
        }
 function allowedCharsCharset($charlist)
 {
     if ($_SESSION['scriptcase']['charset'] != 'UTF-8')
     {
         $charlist = NM_conv_charset($charlist, $_SESSION['scriptcase']['charset'], 'UTF-8');
     }
     return str_replace("'", "\'", $charlist);
 }

 function new_date_format($type, $field)
 {
     $new_date_format = '';

     if ('DT' == $type)
     {
         $date_format  = $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = $this->field_config[$field]['date_display'];
         $time_format  = '';
         $time_sep     = '';
         $time_display = '';
     }
     elseif ('DH' == $type)
     {
         $date_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , 0, strpos($this->field_config[$field]['date_format'] , ';')) : $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], 0, strpos($this->field_config[$field]['date_display'], ';')) : $this->field_config[$field]['date_display'];
         $time_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , strpos($this->field_config[$field]['date_format'] , ';') + 1) : '';
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], strpos($this->field_config[$field]['date_display'], ';') + 1) : '';
     }
     elseif ('HH' == $type)
     {
         $date_format  = '';
         $date_sep     = '';
         $date_display = '';
         $time_format  = $this->field_config[$field]['date_format'];
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = $this->field_config[$field]['date_display'];
     }

     if ('DT' == $type || 'DH' == $type)
     {
         $date_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_format); $i++)
         {
             $char = strtolower(substr($date_format, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $date_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $date_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $disp_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_display); $i++)
         {
             $char = strtolower(substr($date_display, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $disp_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $disp_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $date_final = array();
         foreach ($date_array as $date_part)
         {
             if (in_array($date_part, $disp_array))
             {
                 $date_final[] = $date_part;
             }
         }

         $date_format = implode($date_sep, $date_final);
     }
     if ('HH' == $type || 'DH' == $type)
     {
         $time_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_format); $i++)
         {
             $char = strtolower(substr($time_format, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $time_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $time_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $disp_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_display); $i++)
         {
             $char = strtolower(substr($time_display, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $disp_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $disp_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $time_final = array();
         foreach ($time_array as $time_part)
         {
             if (in_array($time_part, $disp_array))
             {
                 $time_final[] = $time_part;
             }
         }

         $time_format = implode($time_sep, $time_final);
     }

     if ('DT' == $type)
     {
         $old_date_format = $date_format;
     }
     elseif ('DH' == $type)
     {
         $old_date_format = $date_format . ';' . $time_format;
     }
     elseif ('HH' == $type)
     {
         $old_date_format = $time_format;
     }

     for ($i = 0; $i < strlen($old_date_format); $i++)
     {
         $char = substr($old_date_format, $i, 1);
         if ('/' == $char)
         {
             $new_date_format .= $date_sep;
         }
         elseif (':' == $char)
         {
             $new_date_format .= $time_sep;
         }
         else
         {
             $new_date_format .= $char;
         }
     }

     $this->field_config[$field]['date_format'] = $new_date_format;
     if ('DH' == $type)
     {
         $new_date_format                                      = explode(';', $new_date_format);
         $this->field_config[$field]['date_format_js']        = $new_date_format[0];
         $this->field_config[$field . '_hora']['date_format'] = $new_date_format[1];
         $this->field_config[$field . '_hora']['time_sep']    = $this->field_config[$field]['time_sep'];
     }
 } // new_date_format

   function SC_fast_search($field, $arg_search, $data_search)
   {
      if (empty($data_search)) 
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              project_edit_update_main_odpedit_mob_pack_ajax_response();
              exit;
          }
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_ID", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_PROJECTID", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_NAMANODE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_AWAL", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_JMLODP", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_AKHIR", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_ENTRYBY", $arg_search, $data_search);
      }
      {
          $this->SC_monta_condicao($comando, "TPMO_ENTRYDATE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_UPDATEBY", $arg_search, $data_search);
      }
      {
          $this->SC_monta_condicao($comando, "TPMO_UPDATEDATE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_MERK", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_KAPPORT", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_NOSP", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_ID", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_PROJECTID", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_NAMANODE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_AWAL", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_JMLODP", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_AKHIR", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_MERK", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_KAPPORT", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "TPMO_NOSP", $arg_search, $data_search);
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter_form'] . " and (TPMO_PROJECTID=" . $_SESSION['var_projectid'] . ") and (" . $comando . ")";
      }
      else
      {
          $sc_where = " where TPMO_PROJECTID=" . $_SESSION['var_projectid'] . " and (" . $comando . ")";
      }
      $nmgp_select = "SELECT count(*) from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_project_edit_update_main_odpedit_mob = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['total'] = $qt_geral_reg_project_edit_update_main_odpedit_mob;
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          project_edit_update_main_odpedit_mob_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          project_edit_update_main_odpedit_mob_pack_ajax_response();
          exit;
      }
   }
   function SC_monta_condicao(&$comando, $nome, $condicao, $campo, $tp_campo="")
   {
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $nm_numeric = array();
      $Nm_datas   = array();
      $nm_esp_postgres = array();
      $campo_join = strtolower(str_replace(".", "_", $nome));
      $nm_ini_lower = "";
      $nm_fim_lower = "";
      $nm_numeric[] = "tpmo_id";$nm_numeric[] = "tpmo_projectid";$nm_numeric[] = "tpmo_jmlodp";$nm_numeric[] = "tpmo_kapport";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['decimal_db'] == ".")
         {
             $nm_aspas  = "";
             $nm_aspas1 = "";
         }
         if (is_array($campo))
         {
             foreach ($campo as $Ind => $Cmp)
             {
                if (!is_numeric($Cmp))
                {
                    return;
                }
                if ($Cmp == "")
                {
                    $campo[$Ind] = 0;
                }
             }
         }
         else
         {
             if (!is_numeric($campo))
             {
                 return;
             }
             if ($campo == "")
             {
                $campo = 0;
             }
         }
      }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS TEXT)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_esp_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
         {
             $nome      = "CAST ($nome AS TEXT)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
      $Nm_datas['tpmo_entrydate'] = "date";$Nm_datas['tpmo_updatedate'] = "date";
         if (isset($Nm_datas[$campo_join]))
         {
             for ($x = 0; $x < strlen($campo); $x++)
             {
                 $tst = substr($campo, $x, 1);
                 if (!is_numeric($tst) && ($tst != "-" && $tst != ":" && $tst != " "))
                 {
                     return;
                 }
             }
         }
          if (isset($Nm_datas[$campo_join]))
          {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['SC_sep_date1'];
              }
          }
      if (isset($Nm_datas[$campo_join]) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP" || strtoupper($condicao) == "DF"))
      {
          if (strtoupper($condicao) == "DF")
          {
              $condicao = "NP";
          }
          if (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD')";
          }
          elseif ($Nm_datas[$campo_join] == "time" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'hh24:mi:ss')";
          }
          elseif (substr($Nm_datas[$campo_join], 0, 4) == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          {
              $nome = "str_replace (convert(char(10)," . $nome . ",102), '.', '-') + ' ' + convert(char(8)," . $nome . ",20)";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $nome = "convert(char(10)," . $nome . ",121)";
          }
          elseif (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $nome = "convert(char(19)," . $nome . ",121)";
          }
          elseif (($Nm_datas[$campo_join] == "times" || $Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $nome  = "TO_DATE(TO_CHAR(" . $nome . ", 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "datetime" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $nome = "EXTEND(" . $nome . ", YEAR TO FRACTION)";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $nome = "EXTEND(" . $nome . ", YEAR TO DAY)";
          }
      }
         $comando .= (!empty($comando) ? " or " : "");
         if (is_array($campo))
         {
             $prep = "";
             foreach ($campo as $Ind => $Cmp)
             {
                 $prep .= (!empty($prep)) ? "," : "";
                 $Cmp   = substr($this->Db->qstr($Cmp), 1, -1);
                 $prep .= $nm_aspas . $Cmp . $nm_aspas1;
             }
             $prep .= (empty($prep)) ? $nm_aspas . $nm_aspas1 : "";
             $comando .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $prep . ")";
             return;
         }
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         switch (strtoupper($condicao))
         {
            case "EQ":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_aspas . $campo . $nm_aspas1;
            break;
            case "II":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " like '" . $campo . "%'";
            break;
            case "QP":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower ." like '%" . $campo . "%'";
            break;
            case "NP":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower ." not like '%" . $campo . "%'";
            break;
            case "DF":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_aspas . $campo . $nm_aspas1;
            break;
            case "GT":     // 
               $comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
            break;
            case "GE":     // 
               $comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
            break;
            case "LT":     // 
               $comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
            break;
            case "LE":     // 
               $comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
            break;
         }
   }
function nmgp_redireciona($tipo=0)
{
   global $nm_apl_dependente;
   if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $_SESSION['scriptcase']['sc_tp_saida'] != "D" && $nm_apl_dependente != 1) 
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['nm_sc_retorno'];
   }
   else
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page];
   }
   if ($tipo == 2)
   {
       $nmgp_saida_form = "project_edit_update_main_odpedit_mob_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['nm_run_menu'] = 2;
       $nmgp_saida_form = "project_edit_update_main_odpedit_mob_fim.php";
   }
   $diretorio = explode("/", $nmgp_saida_form);
   $cont = count($diretorio);
   $apl = $diretorio[$cont - 1];
   $apl = str_replace(".php", "", $apl);
   $pos = strpos($apl, "?");
   if ($pos !== false)
   {
       $apl = substr($apl, 0, $pos);
   }
   if ($tipo != 1 && $tipo != 2)
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page][$apl]['where_orig']);
   }
   if ($this->NM_ajax_flag)
   {
       $sTarget = '_self';
       $this->NM_ajax_info['redir']['metodo']              = 'post';
       $this->NM_ajax_info['redir']['action']              = $nmgp_saida_form;
       $this->NM_ajax_info['redir']['target']              = $sTarget;
       $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       $this->NM_ajax_info['redir']['script_case_session'] = session_id();
       if (0 == $tipo)
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida'] = $this->nm_location;
       }
       project_edit_update_main_odpedit_mob_pack_ajax_response();
       exit;
   }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

   if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
   {
?>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
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
   <BODY>
   <FORM name="form_ok" method="POST" action="<?php echo $this->form_encode_input($nmgp_saida_form); ?>" target="_self">
<?php
   if ($tipo == 0)
   {
?>
     <INPUT type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($this->nm_location); ?>"> 
<?php
   }
?>
     <INPUT type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
     <INPUT type="hidden" name="script_case_session" value="<?php echo $this->form_encode_input(session_id()); ?>"> 
   </FORM>
   <SCRIPT type="text/javascript">
      bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
      function scLigEditLookupCall()
      {
<?php
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['sc_modal'])
   {
?>
        parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
   elseif ($this->lig_edit_lookup)
   {
?>
        opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
?>
      }
      if (bLigEditLookupCall)
      {
        scLigEditLookupCall();
      }
<?php
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_odpedit_mob']['masterValue']);
?>
}
<?php
    }
}
?>
      document.form_ok.submit();
   </SCRIPT>
   </BODY>
   </HTML>
<?php
  exit;
}
    function sc_field_readonly($sField, $sStatus, $iSeq = '')
    {
        if ('on' != $sStatus && 'off' != $sStatus)
        {
            return;
        }

        $sFieldDateTime = '';

        $sFlagVar        = 'bFlagRead_' . $sField;
        $this->$sFlagVar = 'on' == $sStatus;

        $this->nmgp_cmp_readonly[$sField]                = $sStatus;
        $this->NM_ajax_info['readOnly'][$sField . $iSeq] = $sStatus;
        if ('' != $sFieldDateTime)
        {
            $this->NM_ajax_info['readOnly'][$sFieldDateTime . $iSeq] = $sStatus;
        }
    } // sc_field_readonly
}
?>
