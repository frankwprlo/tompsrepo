<?php
//
class project_edit_update_main_updatetask_detail_mob_apl
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
   var $ppo_id;
   var $ppo_projectid;
   var $ppo_tahapanproject;
   var $ppo_tasktahapan;
   var $ppo_entrydate;
   var $ppo_entryby;
   var $ppo_updatedate;
   var $ppo_updateby;
   var $ppo_note;
   var $ppo_evident_one;
   var $ppo_evident_one_scfile_name;
   var $ppo_evident_one_ul_name;
   var $ppo_evident_one_ul_type;
   var $ppo_evident_one_limpa;
   var $ppo_evident_one_salva;
   var $ppo_evident_two;
   var $ppo_evident_three;
   var $ppo_status;
   var $ppo_status_1;
   var $ppo_tglmulaiplan;
   var $ppo_targethari;
   var $ppo_targetselesai;
   var $ppo_tglmulaiactual;
   var $ppo_tglselesaiactual;
   var $ppo_tasknumber;
   var $ppo_idtasktahapan;
   var $keterangan;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
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
          if (isset($this->NM_ajax_info['param']['keterangan']))
          {
              $this->keterangan = $this->NM_ajax_info['param']['keterangan'];
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
          if (isset($this->NM_ajax_info['param']['ppo_evident_one']))
          {
              $this->ppo_evident_one = $this->NM_ajax_info['param']['ppo_evident_one'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_evident_one_limpa']))
          {
              $this->ppo_evident_one_limpa = $this->NM_ajax_info['param']['ppo_evident_one_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_evident_one_salva']))
          {
              $this->ppo_evident_one_salva = $this->NM_ajax_info['param']['ppo_evident_one_salva'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_evident_one_ul_name']))
          {
              $this->ppo_evident_one_ul_name = $this->NM_ajax_info['param']['ppo_evident_one_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_evident_one_ul_type']))
          {
              $this->ppo_evident_one_ul_type = $this->NM_ajax_info['param']['ppo_evident_one_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_id']))
          {
              $this->ppo_id = $this->NM_ajax_info['param']['ppo_id'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_idtasktahapan']))
          {
              $this->ppo_idtasktahapan = $this->NM_ajax_info['param']['ppo_idtasktahapan'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_note']))
          {
              $this->ppo_note = $this->NM_ajax_info['param']['ppo_note'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_projectid']))
          {
              $this->ppo_projectid = $this->NM_ajax_info['param']['ppo_projectid'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_status']))
          {
              $this->ppo_status = $this->NM_ajax_info['param']['ppo_status'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_tahapanproject']))
          {
              $this->ppo_tahapanproject = $this->NM_ajax_info['param']['ppo_tahapanproject'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_targethari']))
          {
              $this->ppo_targethari = $this->NM_ajax_info['param']['ppo_targethari'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_targetselesai']))
          {
              $this->ppo_targetselesai = $this->NM_ajax_info['param']['ppo_targetselesai'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_tasktahapan']))
          {
              $this->ppo_tasktahapan = $this->NM_ajax_info['param']['ppo_tasktahapan'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_tglmulaiactual']))
          {
              $this->ppo_tglmulaiactual = $this->NM_ajax_info['param']['ppo_tglmulaiactual'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_tglmulaiplan']))
          {
              $this->ppo_tglmulaiplan = $this->NM_ajax_info['param']['ppo_tglmulaiplan'];
          }
          if (isset($this->NM_ajax_info['param']['ppo_tglselesaiactual']))
          {
              $this->ppo_tglselesaiactual = $this->NM_ajax_info['param']['ppo_tglselesaiactual'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
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
      if (isset($this->usr_login) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($this->var_tglmulaiaktual) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['var_tglmulaiaktual'] = $this->var_tglmulaiaktual;
      }
      if (isset($this->var_templateproject) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['var_templateproject'] = $this->var_templateproject;
      }
      if (isset($this->var_milestone) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['var_milestone'] = $this->var_milestone;
      }
      if (isset($_POST["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_POST["var_tglmulaiaktual"]) && isset($this->var_tglmulaiaktual)) 
      {
          $_SESSION['var_tglmulaiaktual'] = $this->var_tglmulaiaktual;
      }
      if (isset($_POST["var_templateproject"]) && isset($this->var_templateproject)) 
      {
          $_SESSION['var_templateproject'] = $this->var_templateproject;
      }
      if (isset($_POST["var_milestone"]) && isset($this->var_milestone)) 
      {
          $_SESSION['var_milestone'] = $this->var_milestone;
      }
      if (isset($_GET["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_GET["var_tglmulaiaktual"]) && isset($this->var_tglmulaiaktual)) 
      {
          $_SESSION['var_tglmulaiaktual'] = $this->var_tglmulaiaktual;
      }
      if (isset($_GET["var_templateproject"]) && isset($this->var_templateproject)) 
      {
          $_SESSION['var_templateproject'] = $this->var_templateproject;
      }
      if (isset($_GET["var_milestone"]) && isset($this->var_milestone)) 
      {
          $_SESSION['var_milestone'] = $this->var_milestone;
      }
      if (isset($this->nm_run_menu) && $this->nm_run_menu == 1)
      { 
          $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['nm_run_menu'] = 1;
      } 
      if (isset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['embutida_parms']);
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
                 nm_limpa_str_project_edit_update_main_updatetask_detail_mob($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
          if (isset($this->var_tglmulaiaktual)) 
          {
              $_SESSION['var_tglmulaiaktual'] = $this->var_tglmulaiaktual;
          }
          if (isset($this->var_templateproject)) 
          {
              $_SESSION['var_templateproject'] = $this->var_templateproject;
          }
          if (isset($this->var_milestone)) 
          {
              $_SESSION['var_milestone'] = $this->var_milestone;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['sc_redir_insert'] = $this->sc_redir_insert;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
          if (isset($this->var_tglmulaiaktual)) 
          {
              $_SESSION['var_tglmulaiaktual'] = $this->var_tglmulaiaktual;
          }
          if (isset($this->var_templateproject)) 
          {
              $_SESSION['var_templateproject'] = $this->var_templateproject;
          }
          if (isset($this->var_milestone)) 
          {
              $_SESSION['var_milestone'] = $this->var_milestone;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new project_edit_update_main_updatetask_detail_mob_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("en_us");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['initialize'];
          if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']))
          {
              foreach ($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail'] as $I_conf => $Conf_opt)
              {
                  $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob'][$I_conf]  = $Conf_opt;
              }
          }
      } 
      else 
      { 
         $this->nm_data = new nm_data("en_us");
      } 
      $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask_detail_mob']['upload_field_info']['ppo_evident_one'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'project_edit_update_main_updatetask_detail_mob',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/.+$/i',
          'upload_max_size'  => null,
          'upload_file_height' => '',
          'upload_file_width'  => '',
          'upload_file_aspect' => '',
          'upload_file_type'   => 'N0',
      );

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['project_edit_update_main_updatetask_detail_mob']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['project_edit_update_main_updatetask_detail_mob'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['project_edit_update_main_updatetask_detail_mob']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['project_edit_update_main_updatetask_detail_mob']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('project_edit_update_main_updatetask_detail_mob') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['project_edit_update_main_updatetask_detail_mob']['label'] = "Update Progress Tahapan Project";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "project_edit_update_main_updatetask_detail_mob")
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
      $this->Ini->Str_btn_form = (isset($_SESSION['scriptcase']['str_button_all'])) ? $_SESSION['scriptcase']['str_button_all'] : "scriptcase8_WhiteSmoke";
      $_SESSION['scriptcase']['str_button_all'] = $this->Ini->Str_btn_form;
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



      $_SESSION['scriptcase']['error_icon']['project_edit_update_main_updatetask_detail_mob']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['project_edit_update_main_updatetask_detail_mob'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_call'] : $this->Embutida_call;

       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['ppo_evident_one_ul_name']) && '' != $this->NM_ajax_info['param']['ppo_evident_one_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_field_ul_name'][$this->ppo_evident_one_ul_name]))
          {
              $this->NM_ajax_info['param']['ppo_evident_one_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_field_ul_name'][$this->ppo_evident_one_ul_name];
          }
          $this->ppo_evident_one = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['ppo_evident_one_ul_name'];
          $this->ppo_evident_one_scfile_name = substr($this->NM_ajax_info['param']['ppo_evident_one_ul_name'], 12);
          $this->ppo_evident_one_scfile_type = $this->NM_ajax_info['param']['ppo_evident_one_ul_type'];
          $this->ppo_evident_one_ul_name = $this->NM_ajax_info['param']['ppo_evident_one_ul_name'];
          $this->ppo_evident_one_ul_type = $this->NM_ajax_info['param']['ppo_evident_one_ul_type'];
      }
      elseif (isset($this->ppo_evident_one_ul_name) && '' != $this->ppo_evident_one_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_field_ul_name'][$this->ppo_evident_one_ul_name]))
          {
              $this->ppo_evident_one_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_field_ul_name'][$this->ppo_evident_one_ul_name];
          }
          $this->ppo_evident_one = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->ppo_evident_one_ul_name;
          $this->ppo_evident_one_scfile_name = substr($this->ppo_evident_one_ul_name, 12);
          $this->ppo_evident_one_scfile_type = $this->ppo_evident_one_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['new']  = "off";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['insert'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "off";
      $this->nmgp_botoes['first'] = "on";
      $this->nmgp_botoes['back'] = "on";
      $this->nmgp_botoes['forward'] = "on";
      $this->nmgp_botoes['last'] = "on";
      $this->nmgp_botoes['summary'] = "off";
      $this->nmgp_botoes['navpage'] = "on";
      $this->nmgp_botoes['goto'] = "off";
      $this->nmgp_botoes['qtline'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_orig'] = " where PPO_PROJECTID=" . $_SESSION['var_projectid'] . "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_pesq'] = " where PPO_PROJECTID=" . $_SESSION['var_projectid'] . "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['project_edit_update_main_updatetask_detail_mob']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['project_edit_update_main_updatetask_detail_mob'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['project_edit_update_main_updatetask_detail_mob'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['exit'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dados_form'];
          if (!isset($this->ppo_entrydate)){$this->ppo_entrydate = $this->nmgp_dados_form['ppo_entrydate'];} 
          if (!isset($this->ppo_entryby)){$this->ppo_entryby = $this->nmgp_dados_form['ppo_entryby'];} 
          if (!isset($this->ppo_updatedate)){$this->ppo_updatedate = $this->nmgp_dados_form['ppo_updatedate'];} 
          if (!isset($this->ppo_updateby)){$this->ppo_updateby = $this->nmgp_dados_form['ppo_updateby'];} 
          if (!isset($this->ppo_evident_two)){$this->ppo_evident_two = $this->nmgp_dados_form['ppo_evident_two'];} 
          if (!isset($this->ppo_evident_three)){$this->ppo_evident_three = $this->nmgp_dados_form['ppo_evident_three'];} 
          if (!isset($this->ppo_tasknumber)){$this->ppo_tasknumber = $this->nmgp_dados_form['ppo_tasknumber'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("project_edit_update_main_updatetask_detail_mob", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
      if (isset($_GET['nm_cal_display']))
      {
          if ($this->Embutida_proc)
          { 
              include_once($this->Ini->path_embutida . 'project_edit_update_main_updatetask_detail/project_edit_update_main_updatetask_detail_mob_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'project_edit_update_main_updatetask_detail_mob_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'project_edit_update_main_updatetask_detail_mob_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'project_edit_update_main_updatetask_detail_mob_help.txt');
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
          require_once($this->Ini->path_embutida . 'project_edit_update_main_updatetask_detail/project_edit_update_main_updatetask_detail_mob_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "project_edit_update_main_updatetask_detail_mob_erro.class.php"); 
      }
      $this->Erro      = new project_edit_update_main_updatetask_detail_mob_erro();
      $this->Erro->Ini = $this->Ini;
      if ($nm_opc_lookup != "lookup" && $nm_opc_php != "formphp")
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opcao']))
         { 
             if ($this->ppo_id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail_mob']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opc_ant'];
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->sc_evento = $this->nmgp_opcao;
      if (isset($this->ppo_id)) { $this->nm_limpa_alfa($this->ppo_id); }
      if (isset($this->ppo_projectid)) { $this->nm_limpa_alfa($this->ppo_projectid); }
      if (isset($this->ppo_tahapanproject)) { $this->nm_limpa_alfa($this->ppo_tahapanproject); }
      if (isset($this->ppo_tasktahapan)) { $this->nm_limpa_alfa($this->ppo_tasktahapan); }
      if (isset($this->ppo_note)) { $this->nm_limpa_alfa($this->ppo_note); }
      if (isset($this->ppo_status)) { $this->nm_limpa_alfa($this->ppo_status); }
      if (isset($this->ppo_targethari)) { $this->nm_limpa_alfa($this->ppo_targethari); }
      if (isset($this->ppo_idtasktahapan)) { $this->nm_limpa_alfa($this->ppo_idtasktahapan); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- ppo_tglmulaiactual
      $this->field_config['ppo_tglmulaiactual']                 = array();
      $this->field_config['ppo_tglmulaiactual']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['ppo_tglmulaiactual']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['ppo_tglmulaiactual']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DT', 'ppo_tglmulaiactual');
      //-- ppo_tglselesaiactual
      $this->field_config['ppo_tglselesaiactual']                 = array();
      $this->field_config['ppo_tglselesaiactual']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['ppo_tglselesaiactual']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['ppo_tglselesaiactual']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DT', 'ppo_tglselesaiactual');
      //-- ppo_projectid
      $this->field_config['ppo_projectid']               = array();
      $this->field_config['ppo_projectid']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['ppo_projectid']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['ppo_projectid']['symbol_dec'] = '';
      $this->field_config['ppo_projectid']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['ppo_projectid']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- ppo_idtasktahapan
      $this->field_config['ppo_idtasktahapan']               = array();
      $this->field_config['ppo_idtasktahapan']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['ppo_idtasktahapan']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['ppo_idtasktahapan']['symbol_dec'] = '';
      $this->field_config['ppo_idtasktahapan']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['ppo_idtasktahapan']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- ppo_tglmulaiplan
      $this->field_config['ppo_tglmulaiplan']                 = array();
      $this->field_config['ppo_tglmulaiplan']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['ppo_tglmulaiplan']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['ppo_tglmulaiplan']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'ppo_tglmulaiplan');
      //-- ppo_targethari
      $this->field_config['ppo_targethari']               = array();
      $this->field_config['ppo_targethari']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['ppo_targethari']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['ppo_targethari']['symbol_dec'] = '';
      $this->field_config['ppo_targethari']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['ppo_targethari']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- ppo_targetselesai
      $this->field_config['ppo_targetselesai']                 = array();
      $this->field_config['ppo_targetselesai']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['ppo_targetselesai']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['ppo_targetselesai']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'ppo_targetselesai');
      //-- ppo_entrydate
      $this->field_config['ppo_entrydate']                 = array();
      $this->field_config['ppo_entrydate']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['ppo_entrydate']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['ppo_entrydate']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'ppo_entrydate');
      //-- ppo_updatedate
      $this->field_config['ppo_updatedate']                 = array();
      $this->field_config['ppo_updatedate']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['ppo_updatedate']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['ppo_updatedate']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'ppo_updatedate');
      //-- ppo_tasknumber
      $this->field_config['ppo_tasknumber']               = array();
      $this->field_config['ppo_tasknumber']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['ppo_tasknumber']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['ppo_tasknumber']['symbol_dec'] = '';
      $this->field_config['ppo_tasknumber']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['ppo_tasknumber']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
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
         $this->keterangan = "&nbsp;";
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_ppo_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_id');
          }
          if ('validate_ppo_status' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_status');
          }
          if ('validate_ppo_tglmulaiactual' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_tglmulaiactual');
          }
          if ('validate_ppo_tglselesaiactual' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_tglselesaiactual');
          }
          if ('validate_ppo_evident_one' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_evident_one');
          }
          if ('validate_ppo_note' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_note');
          }
          if ('validate_ppo_projectid' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_projectid');
          }
          if ('validate_ppo_tahapanproject' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_tahapanproject');
          }
          if ('validate_ppo_idtasktahapan' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_idtasktahapan');
          }
          if ('validate_ppo_tasktahapan' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_tasktahapan');
          }
          if ('validate_ppo_tglmulaiplan' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_tglmulaiplan');
          }
          if ('validate_ppo_targethari' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_targethari');
          }
          if ('validate_ppo_targetselesai' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ppo_targetselesai');
          }
          project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_ppo_status_onchange' == $this->NM_ajax_opcao)
          {
              $this->PPO_STATUS_onChange();
          }
          project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
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
          $_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['recarga'] = $this->nmgp_opcao;
          if ($this->sc_evento == "update")
          {
              $this->NM_close_db(); 
              $this->nmgp_redireciona(2); 
          }
          if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
          {
              $this->NM_close_db(); 
              $this->nmgp_redireciona(2); 
          }
          if ($this->sc_evento == "delete")
          {
              $this->NM_close_db(); 
              $this->nmgp_redireciona(2); 
          }
      }
      if ($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao)
      {
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
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
          project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
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
           case 'ppo_id':
               return "IDTable";
               break;
           case 'ppo_status':
               return "Status Project";
               break;
           case 'ppo_tglmulaiactual':
               return "Tgl Mulai(aktual)";
               break;
           case 'ppo_tglselesaiactual':
               return "Tgl Selesai(aktual)";
               break;
           case 'ppo_evident_one':
               return "Dokumen";
               break;
           case 'keterangan':
               return "Keterangan";
               break;
           case 'ppo_note':
               return "Catatan";
               break;
           case 'ppo_projectid':
               return "ID Project";
               break;
           case 'ppo_tahapanproject':
               return "Tahapan Project";
               break;
           case 'ppo_idtasktahapan':
               return "ID Tahapan Task";
               break;
           case 'ppo_tasktahapan':
               return "Tahapan Task";
               break;
           case 'ppo_tglmulaiplan':
               return "Tgl Mulai(Plan)";
               break;
           case 'ppo_targethari':
               return "Target(hari)";
               break;
           case 'ppo_targetselesai':
               return "Tgl Selesai(Plan)";
               break;
           case 'ppo_entrydate':
               return "Tgl Entry";
               break;
           case 'ppo_entryby':
               return "Petugas Entry";
               break;
           case 'ppo_updatedate':
               return "Tgl Update";
               break;
           case 'ppo_updateby':
               return "Petugas Update";
               break;
           case 'ppo_evident_two':
               return "Dokumen(2)";
               break;
           case 'ppo_evident_three':
               return "Dokumen(3)";
               break;
           case 'ppo_tasknumber':
               return "PPO TASKNUMBER";
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
              if (!isset($this->NM_ajax_info['errList']['geral_project_edit_update_main_updatetask_detail_mob']) || !is_array($this->NM_ajax_info['errList']['geral_project_edit_update_main_updatetask_detail_mob']))
              {
                  $this->NM_ajax_info['errList']['geral_project_edit_update_main_updatetask_detail_mob'] = array();
              }
              $this->NM_ajax_info['errList']['geral_project_edit_update_main_updatetask_detail_mob'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ('' == $filtro || 'ppo_id' == $filtro)
        $this->ValidateField_ppo_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_status' == $filtro)
        $this->ValidateField_ppo_status($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_tglmulaiactual' == $filtro)
        $this->ValidateField_ppo_tglmulaiactual($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_tglselesaiactual' == $filtro)
        $this->ValidateField_ppo_tglselesaiactual($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_evident_one' == $filtro)
        $this->ValidateField_ppo_evident_one($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_note' == $filtro)
        $this->ValidateField_ppo_note($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_projectid' == $filtro)
        $this->ValidateField_ppo_projectid($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_tahapanproject' == $filtro)
        $this->ValidateField_ppo_tahapanproject($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_idtasktahapan' == $filtro)
        $this->ValidateField_ppo_idtasktahapan($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_tasktahapan' == $filtro)
        $this->ValidateField_ppo_tasktahapan($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_tglmulaiplan' == $filtro)
        $this->ValidateField_ppo_tglmulaiplan($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_targethari' == $filtro)
        $this->ValidateField_ppo_targethari($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $filtro || 'ppo_targetselesai' == $filtro)
        $this->ValidateField_ppo_targetselesai($Campos_Crit, $Campos_Falta, $Campos_Erros);
      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
//-- converter datas   
          $this->nm_converte_datas();
//---
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

    function ValidateField_ppo_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_id']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_id'] == "on")) 
      { 
          if ($this->ppo_id == "")  
          { 
              $Campos_Falta[] =  "IDTable" ; 
              if (!isset($Campos_Erros['ppo_id']))
              {
                  $Campos_Erros['ppo_id'] = array();
              }
              $Campos_Erros['ppo_id'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['ppo_id']) || !is_array($this->NM_ajax_info['errList']['ppo_id']))
                  {
                      $this->NM_ajax_info['errList']['ppo_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_id'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->ppo_id) > 22) 
          { 
              $Campos_Crit .= "IDTable " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 22 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['ppo_id']))
              {
                  $Campos_Erros['ppo_id'] = array();
              }
              $Campos_Erros['ppo_id'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 22 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['ppo_id']) || !is_array($this->NM_ajax_info['errList']['ppo_id']))
              {
                  $this->NM_ajax_info['errList']['ppo_id'] = array();
              }
              $this->NM_ajax_info['errList']['ppo_id'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 22 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
   if ($this->nmgp_opcao == "incluir")
   { 
      $Teste_trab = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $Teste_trab = NM_conv_charset($Teste_trab, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
;
   } 
      $Teste_trab = $Teste_trab . chr(10) . chr(13) ; 
      $Teste_compara = $this->ppo_id ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          $Teste_critica = 0 ; 
          for ($x = 0; $x < mb_strlen($this->ppo_id, $_SESSION['scriptcase']['charset']); $x++) 
          { 
               for ($y = 0; $y < mb_strlen($Teste_trab, $_SESSION['scriptcase']['charset']); $y++) 
               { 
                    if (sc_substr($Teste_compara, $x, 1) == sc_substr($Teste_trab, $y, 1) ) 
                    { 
                        break ; 
                    } 
               } 
               if (sc_substr($Teste_compara, $x, 1) != sc_substr($Teste_trab, $y, 1) )  
               { 
                  $Teste_critica = 1 ; 
               } 
          } 
          if ($Teste_critica == 1) 
          { 
              $Campos_Crit .= "IDTable " . $this->Ini->Nm_lang['lang_errm_ivch']; 
              if (!isset($Campos_Erros['ppo_id']))
              {
                  $Campos_Erros['ppo_id'] = array();
              }
              $Campos_Erros['ppo_id'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
              if (!isset($this->NM_ajax_info['errList']['ppo_id']) || !is_array($this->NM_ajax_info['errList']['ppo_id']))
              {
                  $this->NM_ajax_info['errList']['ppo_id'] = array();
              }
              $this->NM_ajax_info['errList']['ppo_id'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
          } 
      } 
    } // ValidateField_ppo_id

    function ValidateField_ppo_status(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->ppo_status == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_status']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_status'] == "on"))
      {
          $Campos_Falta[] = "Status Project" ; 
          if (!isset($Campos_Erros['ppo_status']))
          {
              $Campos_Erros['ppo_status'] = array();
          }
          $Campos_Erros['ppo_status'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['ppo_status']) || !is_array($this->NM_ajax_info['errList']['ppo_status']))
          {
              $this->NM_ajax_info['errList']['ppo_status'] = array();
          }
          $this->NM_ajax_info['errList']['ppo_status'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->ppo_status) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']) && !in_array($this->ppo_status, $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']))
          {
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['ppo_status']))
              {
                  $Campos_Erros['ppo_status'] = array();
              }
              $Campos_Erros['ppo_status'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['ppo_status']) || !is_array($this->NM_ajax_info['errList']['ppo_status']))
              {
                  $this->NM_ajax_info['errList']['ppo_status'] = array();
              }
              $this->NM_ajax_info['errList']['ppo_status'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
    } // ValidateField_ppo_status

    function ValidateField_ppo_tglmulaiactual(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->ppo_tglmulaiactual, $this->field_config['ppo_tglmulaiactual']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['ppo_tglmulaiactual']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['ppo_tglmulaiactual']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['ppo_tglmulaiactual']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['ppo_tglmulaiactual']['date_sep']) ; 
          if (trim($this->ppo_tglmulaiactual) != "")  
          { 
              if ($teste_validade->Data($this->ppo_tglmulaiactual, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Mulai(aktual); " ; 
                  if (!isset($Campos_Erros['ppo_tglmulaiactual']))
                  {
                      $Campos_Erros['ppo_tglmulaiactual'] = array();
                  }
                  $Campos_Erros['ppo_tglmulaiactual'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['ppo_tglmulaiactual']) || !is_array($this->NM_ajax_info['errList']['ppo_tglmulaiactual']))
                  {
                      $this->NM_ajax_info['errList']['ppo_tglmulaiactual'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_tglmulaiactual'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['ppo_tglmulaiactual']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_ppo_tglmulaiactual

    function ValidateField_ppo_tglselesaiactual(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->ppo_tglselesaiactual, $this->field_config['ppo_tglselesaiactual']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['ppo_tglselesaiactual']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['ppo_tglselesaiactual']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['ppo_tglselesaiactual']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['ppo_tglselesaiactual']['date_sep']) ; 
          if (trim($this->ppo_tglselesaiactual) != "")  
          { 
              if ($teste_validade->Data($this->ppo_tglselesaiactual, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Selesai(aktual); " ; 
                  if (!isset($Campos_Erros['ppo_tglselesaiactual']))
                  {
                      $Campos_Erros['ppo_tglselesaiactual'] = array();
                  }
                  $Campos_Erros['ppo_tglselesaiactual'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['ppo_tglselesaiactual']) || !is_array($this->NM_ajax_info['errList']['ppo_tglselesaiactual']))
                  {
                      $this->NM_ajax_info['errList']['ppo_tglselesaiactual'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_tglselesaiactual'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['ppo_tglselesaiactual']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_ppo_tglselesaiactual

    function ValidateField_ppo_evident_one(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->ppo_evident_one;
            if (!function_exists('sc_upload_unprotect_chars'))
            {
                include_once 'project_edit_update_main_updatetask_detail_mob_doc_name.php';
            }
            $this->ppo_evident_one = sc_upload_unprotect_chars($this->ppo_evident_one);
            $this->ppo_evident_one_scfile_name = sc_upload_unprotect_chars($this->ppo_evident_one_scfile_name);
            if ("" != $this->ppo_evident_one && "S" != $this->ppo_evident_one_limpa && !$teste_validade->ArqExtensao($this->ppo_evident_one, array()))
            {
                $Campos_Crit .= "Dokumen: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['ppo_evident_one']))
                {
                    $Campos_Erros['ppo_evident_one'] = array();
                }
                $Campos_Erros['ppo_evident_one'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['ppo_evident_one']) || !is_array($this->NM_ajax_info['errList']['ppo_evident_one']))
                {
                    $this->NM_ajax_info['errList']['ppo_evident_one'] = array();
                }
                $this->NM_ajax_info['errList']['ppo_evident_one'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
        }
    } // ValidateField_ppo_evident_one

    function ValidateField_ppo_note(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_note']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['php_cmp_required']['ppo_note'] == "on")) 
      { 
          if ($this->ppo_note == "")  
          { 
              $Campos_Falta[] =  "Catatan" ; 
              if (!isset($Campos_Erros['ppo_note']))
              {
                  $Campos_Erros['ppo_note'] = array();
              }
              $Campos_Erros['ppo_note'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['ppo_note']) || !is_array($this->NM_ajax_info['errList']['ppo_note']))
                  {
                      $this->NM_ajax_info['errList']['ppo_note'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_note'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->ppo_note) > 255) 
          { 
              $Campos_Crit .= "Catatan " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['ppo_note']))
              {
                  $Campos_Erros['ppo_note'] = array();
              }
              $Campos_Erros['ppo_note'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['ppo_note']) || !is_array($this->NM_ajax_info['errList']['ppo_note']))
              {
                  $this->NM_ajax_info['errList']['ppo_note'] = array();
              }
              $this->NM_ajax_info['errList']['ppo_note'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_ppo_note

    function ValidateField_ppo_projectid(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->ppo_projectid == "")  
      { 
          $this->ppo_projectid = 0;
          $this->sc_force_zero[] = 'ppo_projectid';
      } 
      nm_limpa_numero($this->ppo_projectid, $this->field_config['ppo_projectid']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->ppo_projectid != '')  
          { 
              $iTestSize = 5;
              if (strlen($this->ppo_projectid) > $iTestSize)  
              { 
                  $Campos_Crit .= "ID Project: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['ppo_projectid']))
                  {
                      $Campos_Erros['ppo_projectid'] = array();
                  }
                  $Campos_Erros['ppo_projectid'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['ppo_projectid']) || !is_array($this->NM_ajax_info['errList']['ppo_projectid']))
                  {
                      $this->NM_ajax_info['errList']['ppo_projectid'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_projectid'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->ppo_projectid, 5, 0, -0, 99999, "N") == false)  
              { 
                  $Campos_Crit .= "ID Project; " ; 
                  if (!isset($Campos_Erros['ppo_projectid']))
                  {
                      $Campos_Erros['ppo_projectid'] = array();
                  }
                  $Campos_Erros['ppo_projectid'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['ppo_projectid']) || !is_array($this->NM_ajax_info['errList']['ppo_projectid']))
                  {
                      $this->NM_ajax_info['errList']['ppo_projectid'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_projectid'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_ppo_projectid

    function ValidateField_ppo_tahapanproject(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->ppo_tahapanproject) > 60) 
          { 
              $Campos_Crit .= "Tahapan Project " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['ppo_tahapanproject']))
              {
                  $Campos_Erros['ppo_tahapanproject'] = array();
              }
              $Campos_Erros['ppo_tahapanproject'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['ppo_tahapanproject']) || !is_array($this->NM_ajax_info['errList']['ppo_tahapanproject']))
              {
                  $this->NM_ajax_info['errList']['ppo_tahapanproject'] = array();
              }
              $this->NM_ajax_info['errList']['ppo_tahapanproject'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_ppo_tahapanproject

    function ValidateField_ppo_idtasktahapan(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->ppo_idtasktahapan == "")  
      { 
          $this->ppo_idtasktahapan = 0;
          $this->sc_force_zero[] = 'ppo_idtasktahapan';
      } 
      nm_limpa_numero($this->ppo_idtasktahapan, $this->field_config['ppo_idtasktahapan']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->ppo_idtasktahapan != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->ppo_idtasktahapan) > $iTestSize)  
              { 
                  $Campos_Crit .= "ID Tahapan Task: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['ppo_idtasktahapan']))
                  {
                      $Campos_Erros['ppo_idtasktahapan'] = array();
                  }
                  $Campos_Erros['ppo_idtasktahapan'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['ppo_idtasktahapan']) || !is_array($this->NM_ajax_info['errList']['ppo_idtasktahapan']))
                  {
                      $this->NM_ajax_info['errList']['ppo_idtasktahapan'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_idtasktahapan'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->ppo_idtasktahapan, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "ID Tahapan Task; " ; 
                  if (!isset($Campos_Erros['ppo_idtasktahapan']))
                  {
                      $Campos_Erros['ppo_idtasktahapan'] = array();
                  }
                  $Campos_Erros['ppo_idtasktahapan'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['ppo_idtasktahapan']) || !is_array($this->NM_ajax_info['errList']['ppo_idtasktahapan']))
                  {
                      $this->NM_ajax_info['errList']['ppo_idtasktahapan'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_idtasktahapan'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_ppo_idtasktahapan

    function ValidateField_ppo_tasktahapan(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->ppo_tasktahapan) > 60) 
          { 
              $Campos_Crit .= "Tahapan Task " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['ppo_tasktahapan']))
              {
                  $Campos_Erros['ppo_tasktahapan'] = array();
              }
              $Campos_Erros['ppo_tasktahapan'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['ppo_tasktahapan']) || !is_array($this->NM_ajax_info['errList']['ppo_tasktahapan']))
              {
                  $this->NM_ajax_info['errList']['ppo_tasktahapan'] = array();
              }
              $this->NM_ajax_info['errList']['ppo_tasktahapan'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_ppo_tasktahapan

    function ValidateField_ppo_tglmulaiplan(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->ppo_tglmulaiplan, $this->field_config['ppo_tglmulaiplan']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao == "incluir")
      { 
          $guarda_datahora = $this->field_config['ppo_tglmulaiplan']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['ppo_tglmulaiplan']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['ppo_tglmulaiplan']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['ppo_tglmulaiplan']['date_sep']) ; 
          if (trim($this->ppo_tglmulaiplan) != "")  
          { 
              if ($teste_validade->Data($this->ppo_tglmulaiplan, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Mulai(Plan); " ; 
                  if (!isset($Campos_Erros['ppo_tglmulaiplan']))
                  {
                      $Campos_Erros['ppo_tglmulaiplan'] = array();
                  }
                  $Campos_Erros['ppo_tglmulaiplan'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['ppo_tglmulaiplan']) || !is_array($this->NM_ajax_info['errList']['ppo_tglmulaiplan']))
                  {
                      $this->NM_ajax_info['errList']['ppo_tglmulaiplan'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_tglmulaiplan'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['ppo_tglmulaiplan']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_ppo_tglmulaiplan

    function ValidateField_ppo_targethari(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->ppo_targethari == "")  
      { 
          $this->ppo_targethari = 0;
          $this->sc_force_zero[] = 'ppo_targethari';
      } 
      nm_limpa_numero($this->ppo_targethari, $this->field_config['ppo_targethari']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->ppo_targethari != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->ppo_targethari) > $iTestSize)  
              { 
                  $Campos_Crit .= "Target(hari): " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['ppo_targethari']))
                  {
                      $Campos_Erros['ppo_targethari'] = array();
                  }
                  $Campos_Erros['ppo_targethari'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['ppo_targethari']) || !is_array($this->NM_ajax_info['errList']['ppo_targethari']))
                  {
                      $this->NM_ajax_info['errList']['ppo_targethari'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_targethari'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->ppo_targethari, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Target(hari); " ; 
                  if (!isset($Campos_Erros['ppo_targethari']))
                  {
                      $Campos_Erros['ppo_targethari'] = array();
                  }
                  $Campos_Erros['ppo_targethari'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['ppo_targethari']) || !is_array($this->NM_ajax_info['errList']['ppo_targethari']))
                  {
                      $this->NM_ajax_info['errList']['ppo_targethari'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_targethari'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_ppo_targethari

    function ValidateField_ppo_targetselesai(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->ppo_targetselesai, $this->field_config['ppo_targetselesai']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao == "incluir")
      { 
          $guarda_datahora = $this->field_config['ppo_targetselesai']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['ppo_targetselesai']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['ppo_targetselesai']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['ppo_targetselesai']['date_sep']) ; 
          if (trim($this->ppo_targetselesai) != "")  
          { 
              if ($teste_validade->Data($this->ppo_targetselesai, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Selesai(Plan); " ; 
                  if (!isset($Campos_Erros['ppo_targetselesai']))
                  {
                      $Campos_Erros['ppo_targetselesai'] = array();
                  }
                  $Campos_Erros['ppo_targetselesai'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['ppo_targetselesai']) || !is_array($this->NM_ajax_info['errList']['ppo_targetselesai']))
                  {
                      $this->NM_ajax_info['errList']['ppo_targetselesai'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_targetselesai'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['ppo_targetselesai']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_ppo_targetselesai
//
//--------------------------------------------------------------------------------------
   function upload_img_doc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros) 
   {
     global $nm_browser;
     if (!empty($Campos_Crit) || !empty($Campos_Falta))
     {
          return;
     }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->ppo_evident_one == "none") 
          { 
              $this->ppo_evident_one = ""; 
          } 
          if ($this->ppo_evident_one != "") 
          { 
              if (is_file($this->ppo_evident_one))  
              { 
                  if ($this->nmgp_opcao == "incluir")
                  { 
                      $this->SC_DOC_ppo_evident_one = $this->ppo_evident_one;
                  } 
                  else 
                  { 
                      $arq_ppo_evident_one = fopen($this->ppo_evident_one, "r") ; 
                      $reg_ppo_evident_one = fread($arq_ppo_evident_one, filesize($this->ppo_evident_one)) ; 
                      fclose($arq_ppo_evident_one) ;  
                  } 
                  $this->ppo_evident_one =  trim($this->ppo_evident_one_scfile_name) ;  
                  $dir_doc = $this->Ini->path_doc . "" . "/"; 
                 if ($this->nmgp_opcao != "incluir")
                 { 
                  if (is_dir($dir_doc))  
                  { 
                      $_test_file = $this->fetchUniqueUploadName($this->ppo_evident_one_scfile_name, $dir_doc, "ppo_evident_one");
                      if (trim($this->ppo_evident_one_scfile_name) != $_test_file)
                      {
                          $this->ppo_evident_one_scfile_name = $_test_file;
                          $this->ppo_evident_one = $_test_file;
                      }
                      $arq_ppo_evident_one = fopen($dir_doc . trim($this->ppo_evident_one_scfile_name), "w") ; 
                      fwrite($arq_ppo_evident_one, $reg_ppo_evident_one) ;  
                      fclose($arq_ppo_evident_one) ;  
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Dokumen: " . $this->Ini->Nm_lang['lang_errm_nfdr']; 
                      if (!isset($Campos_Erros['ppo_evident_one']))
                      {
                          $Campos_Erros['ppo_evident_one'] = array();
                      }
                      $Campos_Erros['ppo_evident_one'][] = $this->Ini->Nm_lang['lang_errm_nfdr'];
                      if (!isset($this->NM_ajax_info['errList']['ppo_evident_one']) || !is_array($this->NM_ajax_info['errList']['ppo_evident_one']))
                      {
                          $this->NM_ajax_info['errList']['ppo_evident_one'] = array();
                      }
                      $this->NM_ajax_info['errList']['ppo_evident_one'][] = $this->Ini->Nm_lang['lang_errm_nfdr'];
                  } 
                 } 
              } 
              else 
              { 
                  $Campos_Crit .= "Dokumen " . $this->Ini->Nm_lang['lang_errm_upld']; 
                  $this->ppo_evident_one = "";
                  if (!isset($Campos_Erros['ppo_evident_one']))
                  {
                      $Campos_Erros['ppo_evident_one'] = array();
                  }
                  $Campos_Erros['ppo_evident_one'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  if (!isset($this->NM_ajax_info['errList']['ppo_evident_one']) || !is_array($this->NM_ajax_info['errList']['ppo_evident_one']))
                  {
                      $this->NM_ajax_info['errList']['ppo_evident_one'] = array();
                  }
                  $this->NM_ajax_info['errList']['ppo_evident_one'][] = $this->Ini->Nm_lang['lang_errm_upld'];
              } 
          } 
          elseif (!empty($this->ppo_evident_one_salva) && $this->ppo_evident_one_limpa != "S")
          {
              $this->ppo_evident_one = $this->ppo_evident_one_salva;
          }
      } 
      elseif (!empty($this->ppo_evident_one_salva) && $this->ppo_evident_one_limpa != "S")
      {
          $this->ppo_evident_one = $this->ppo_evident_one_salva;
      }
   }

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
    $this->nmgp_dados_form['ppo_id'] = $this->ppo_id;
    $this->nmgp_dados_form['ppo_status'] = $this->ppo_status;
    $this->nmgp_dados_form['ppo_tglmulaiactual'] = (strlen(trim($this->ppo_tglmulaiactual)) > 19) ? str_replace(".", ":", $this->ppo_tglmulaiactual) : trim($this->ppo_tglmulaiactual);
    $this->nmgp_dados_form['ppo_tglselesaiactual'] = (strlen(trim($this->ppo_tglselesaiactual)) > 19) ? str_replace(".", ":", $this->ppo_tglselesaiactual) : trim($this->ppo_tglselesaiactual);
    if (empty($this->ppo_evident_one))
    {
        $this->ppo_evident_one = $this->nmgp_dados_form['ppo_evident_one'];
    }
    $this->nmgp_dados_form['ppo_evident_one'] = $this->ppo_evident_one;
    $this->nmgp_dados_form['ppo_evident_one_limpa'] = $this->ppo_evident_one_limpa;
    $this->nmgp_dados_form['keterangan'] = $this->keterangan;
    $this->nmgp_dados_form['ppo_note'] = $this->ppo_note;
    $this->nmgp_dados_form['ppo_projectid'] = $this->ppo_projectid;
    $this->nmgp_dados_form['ppo_tahapanproject'] = $this->ppo_tahapanproject;
    $this->nmgp_dados_form['ppo_idtasktahapan'] = $this->ppo_idtasktahapan;
    $this->nmgp_dados_form['ppo_tasktahapan'] = $this->ppo_tasktahapan;
    $this->nmgp_dados_form['ppo_tglmulaiplan'] = (strlen(trim($this->ppo_tglmulaiplan)) > 19) ? str_replace(".", ":", $this->ppo_tglmulaiplan) : trim($this->ppo_tglmulaiplan);
    $this->nmgp_dados_form['ppo_targethari'] = $this->ppo_targethari;
    $this->nmgp_dados_form['ppo_targetselesai'] = (strlen(trim($this->ppo_targetselesai)) > 19) ? str_replace(".", ":", $this->ppo_targetselesai) : trim($this->ppo_targetselesai);
    $this->nmgp_dados_form['ppo_entrydate'] = (strlen(trim($this->ppo_entrydate)) > 19) ? str_replace(".", ":", $this->ppo_entrydate) : trim($this->ppo_entrydate);
    $this->nmgp_dados_form['ppo_entryby'] = $this->ppo_entryby;
    $this->nmgp_dados_form['ppo_updatedate'] = (strlen(trim($this->ppo_updatedate)) > 19) ? str_replace(".", ":", $this->ppo_updatedate) : trim($this->ppo_updatedate);
    $this->nmgp_dados_form['ppo_updateby'] = $this->ppo_updateby;
    $this->nmgp_dados_form['ppo_evident_two'] = $this->ppo_evident_two;
    $this->nmgp_dados_form['ppo_evident_three'] = $this->ppo_evident_three;
    $this->nmgp_dados_form['ppo_tasknumber'] = $this->ppo_tasknumber;
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->formatado = false;
      nm_limpa_data($this->ppo_tglmulaiactual, $this->field_config['ppo_tglmulaiactual']['date_sep']) ; 
      nm_limpa_data($this->ppo_tglselesaiactual, $this->field_config['ppo_tglselesaiactual']['date_sep']) ; 
      nm_limpa_numero($this->ppo_projectid, $this->field_config['ppo_projectid']['symbol_grp']) ; 
      nm_limpa_numero($this->ppo_idtasktahapan, $this->field_config['ppo_idtasktahapan']['symbol_grp']) ; 
      nm_limpa_data($this->ppo_tglmulaiplan, $this->field_config['ppo_tglmulaiplan']['date_sep']) ; 
      nm_limpa_numero($this->ppo_targethari, $this->field_config['ppo_targethari']['symbol_grp']) ; 
      nm_limpa_data($this->ppo_targetselesai, $this->field_config['ppo_targetselesai']['date_sep']) ; 
      nm_limpa_data($this->ppo_entrydate, $this->field_config['ppo_entrydate']['date_sep']) ; 
      nm_limpa_data($this->ppo_updatedate, $this->field_config['ppo_updatedate']['date_sep']) ; 
      nm_limpa_numero($this->ppo_tasknumber, $this->field_config['ppo_tasknumber']['symbol_grp']) ; 
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
      if ($Nome_Campo == "ppo_projectid")
      {
          nm_limpa_numero($this->ppo_projectid, $this->field_config['ppo_projectid']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "ppo_idtasktahapan")
      {
          nm_limpa_numero($this->ppo_idtasktahapan, $this->field_config['ppo_idtasktahapan']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "ppo_targethari")
      {
          nm_limpa_numero($this->ppo_targethari, $this->field_config['ppo_targethari']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "ppo_tasknumber")
      {
          nm_limpa_numero($this->ppo_tasknumber, $this->field_config['ppo_tasknumber']['symbol_grp']) ; 
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
      if ((!empty($this->ppo_tglmulaiactual) && 'null' != $this->ppo_tglmulaiactual) || (!empty($format_fields) && isset($format_fields['ppo_tglmulaiactual'])))
      {
          nm_volta_data($this->ppo_tglmulaiactual, $this->field_config['ppo_tglmulaiactual']['date_format']) ; 
          nmgp_Form_Datas($this->ppo_tglmulaiactual, $this->field_config['ppo_tglmulaiactual']['date_format'], $this->field_config['ppo_tglmulaiactual']['date_sep']) ;  
      }
      elseif ('null' == $this->ppo_tglmulaiactual || '' == $this->ppo_tglmulaiactual)
      {
          $this->ppo_tglmulaiactual = '';
      }
      if ((!empty($this->ppo_tglselesaiactual) && 'null' != $this->ppo_tglselesaiactual) || (!empty($format_fields) && isset($format_fields['ppo_tglselesaiactual'])))
      {
          nm_volta_data($this->ppo_tglselesaiactual, $this->field_config['ppo_tglselesaiactual']['date_format']) ; 
          nmgp_Form_Datas($this->ppo_tglselesaiactual, $this->field_config['ppo_tglselesaiactual']['date_format'], $this->field_config['ppo_tglselesaiactual']['date_sep']) ;  
      }
      elseif ('null' == $this->ppo_tglselesaiactual || '' == $this->ppo_tglselesaiactual)
      {
          $this->ppo_tglselesaiactual = '';
      }
      if (!empty($this->ppo_projectid) || (!empty($format_fields) && isset($format_fields['ppo_projectid'])))
      {
          nmgp_Form_Num_Val($this->ppo_projectid, $this->field_config['ppo_projectid']['symbol_grp'], $this->field_config['ppo_projectid']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['ppo_projectid']['symbol_fmt']) ; 
      }
      if (!empty($this->ppo_idtasktahapan) || (!empty($format_fields) && isset($format_fields['ppo_idtasktahapan'])))
      {
          nmgp_Form_Num_Val($this->ppo_idtasktahapan, $this->field_config['ppo_idtasktahapan']['symbol_grp'], $this->field_config['ppo_idtasktahapan']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['ppo_idtasktahapan']['symbol_fmt']) ; 
      }
      if ((!empty($this->ppo_tglmulaiplan) && 'null' != $this->ppo_tglmulaiplan) || (!empty($format_fields) && isset($format_fields['ppo_tglmulaiplan'])))
      {
          nm_volta_data($this->ppo_tglmulaiplan, $this->field_config['ppo_tglmulaiplan']['date_format']) ; 
          nmgp_Form_Datas($this->ppo_tglmulaiplan, $this->field_config['ppo_tglmulaiplan']['date_format'], $this->field_config['ppo_tglmulaiplan']['date_sep']) ;  
      }
      elseif ('null' == $this->ppo_tglmulaiplan || '' == $this->ppo_tglmulaiplan)
      {
          $this->ppo_tglmulaiplan = '';
      }
      if (!empty($this->ppo_targethari) || (!empty($format_fields) && isset($format_fields['ppo_targethari'])))
      {
          nmgp_Form_Num_Val($this->ppo_targethari, $this->field_config['ppo_targethari']['symbol_grp'], $this->field_config['ppo_targethari']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['ppo_targethari']['symbol_fmt']) ; 
      }
      if ((!empty($this->ppo_targetselesai) && 'null' != $this->ppo_targetselesai) || (!empty($format_fields) && isset($format_fields['ppo_targetselesai'])))
      {
          nm_volta_data($this->ppo_targetselesai, $this->field_config['ppo_targetselesai']['date_format']) ; 
          nmgp_Form_Datas($this->ppo_targetselesai, $this->field_config['ppo_targetselesai']['date_format'], $this->field_config['ppo_targetselesai']['date_sep']) ;  
      }
      elseif ('null' == $this->ppo_targetselesai || '' == $this->ppo_targetselesai)
      {
          $this->ppo_targetselesai = '';
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
//
//-- 
   function nm_converte_datas($use_null = true, $bForce = false)
   {
      $guarda_format_hora = $this->field_config['ppo_tglmulaiactual']['date_format'];
      if ($this->ppo_tglmulaiactual != "")  
      { 
          nm_conv_data($this->ppo_tglmulaiactual, $this->field_config['ppo_tglmulaiactual']['date_format']) ; 
          $this->ppo_tglmulaiactual_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->ppo_tglmulaiactual_hora = substr($this->ppo_tglmulaiactual_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->ppo_tglmulaiactual_hora = substr($this->ppo_tglmulaiactual_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->ppo_tglmulaiactual_hora = substr($this->ppo_tglmulaiactual_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->ppo_tglmulaiactual_hora = substr($this->ppo_tglmulaiactual_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->ppo_tglmulaiactual_hora = substr($this->ppo_tglmulaiactual_hora, 0, -4);
          }
      } 
      if ($this->ppo_tglmulaiactual == "" && $use_null)  
      { 
          $this->ppo_tglmulaiactual = "null" ; 
      } 
      $this->field_config['ppo_tglmulaiactual']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['ppo_tglselesaiactual']['date_format'];
      if ($this->ppo_tglselesaiactual != "")  
      { 
          nm_conv_data($this->ppo_tglselesaiactual, $this->field_config['ppo_tglselesaiactual']['date_format']) ; 
          $this->ppo_tglselesaiactual_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->ppo_tglselesaiactual_hora = substr($this->ppo_tglselesaiactual_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->ppo_tglselesaiactual_hora = substr($this->ppo_tglselesaiactual_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->ppo_tglselesaiactual_hora = substr($this->ppo_tglselesaiactual_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->ppo_tglselesaiactual_hora = substr($this->ppo_tglselesaiactual_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->ppo_tglselesaiactual_hora = substr($this->ppo_tglselesaiactual_hora, 0, -4);
          }
      } 
      if ($this->ppo_tglselesaiactual == "" && $use_null)  
      { 
          $this->ppo_tglselesaiactual = "null" ; 
      } 
      $this->field_config['ppo_tglselesaiactual']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['ppo_tglmulaiplan']['date_format'];
      if ($this->ppo_tglmulaiplan != "")  
      { 
          nm_conv_data($this->ppo_tglmulaiplan, $this->field_config['ppo_tglmulaiplan']['date_format']) ; 
          $this->ppo_tglmulaiplan_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->ppo_tglmulaiplan_hora = substr($this->ppo_tglmulaiplan_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->ppo_tglmulaiplan_hora = substr($this->ppo_tglmulaiplan_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->ppo_tglmulaiplan_hora = substr($this->ppo_tglmulaiplan_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->ppo_tglmulaiplan_hora = substr($this->ppo_tglmulaiplan_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->ppo_tglmulaiplan_hora = substr($this->ppo_tglmulaiplan_hora, 0, -4);
          }
      } 
      if ($this->ppo_tglmulaiplan == "" && $use_null)  
      { 
          $this->ppo_tglmulaiplan = "null" ; 
      } 
      $this->field_config['ppo_tglmulaiplan']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['ppo_targetselesai']['date_format'];
      if ($this->ppo_targetselesai != "")  
      { 
          nm_conv_data($this->ppo_targetselesai, $this->field_config['ppo_targetselesai']['date_format']) ; 
          $this->ppo_targetselesai_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->ppo_targetselesai_hora = substr($this->ppo_targetselesai_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->ppo_targetselesai_hora = substr($this->ppo_targetselesai_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->ppo_targetselesai_hora = substr($this->ppo_targetselesai_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->ppo_targetselesai_hora = substr($this->ppo_targetselesai_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->ppo_targetselesai_hora = substr($this->ppo_targetselesai_hora, 0, -4);
          }
      } 
      if ($this->ppo_targetselesai == "" && $use_null)  
      { 
          $this->ppo_targetselesai = "null" ; 
      } 
      $this->field_config['ppo_targetselesai']['date_format'] = $guarda_format_hora;
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
          $this->ajax_return_values_ppo_id();
          $this->ajax_return_values_ppo_status();
          $this->ajax_return_values_ppo_tglmulaiactual();
          $this->ajax_return_values_ppo_tglselesaiactual();
          $this->ajax_return_values_ppo_evident_one();
          $this->ajax_return_values_keterangan();
          $this->ajax_return_values_ppo_note();
          $this->ajax_return_values_ppo_projectid();
          $this->ajax_return_values_ppo_tahapanproject();
          $this->ajax_return_values_ppo_idtasktahapan();
          $this->ajax_return_values_ppo_tasktahapan();
          $this->ajax_return_values_ppo_tglmulaiplan();
          $this->ajax_return_values_ppo_targethari();
          $this->ajax_return_values_ppo_targetselesai();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['ppo_id']['keyVal'] = project_edit_update_main_updatetask_detail_mob_pack_protect_string($this->nmgp_dados_form['ppo_id']);
          }
   } // ajax_return_values

          //----- ppo_id
   function ajax_return_values_ppo_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- ppo_status
   function ajax_return_values_ppo_status($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_status", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_status);
              $aLookup = array();
              $this->_tmp_lookup_ppo_status = $this->ppo_status;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'] = array(); 
}
$aLookup[] = array(project_edit_update_main_updatetask_detail_mob_pack_protect_string('') => project_edit_update_main_updatetask_detail_mob_pack_protect_string(''));
$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_ppo_tglmulaiactual = $this->ppo_tglmulaiactual;
   $old_value_ppo_tglselesaiactual = $this->ppo_tglselesaiactual;
   $old_value_ppo_projectid = $this->ppo_projectid;
   $old_value_ppo_idtasktahapan = $this->ppo_idtasktahapan;
   $old_value_ppo_tglmulaiplan = $this->ppo_tglmulaiplan;
   $old_value_ppo_targethari = $this->ppo_targethari;
   $old_value_ppo_targetselesai = $this->ppo_targetselesai;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_ppo_tglmulaiactual = $this->ppo_tglmulaiactual;
   $unformatted_value_ppo_tglselesaiactual = $this->ppo_tglselesaiactual;
   $unformatted_value_ppo_projectid = $this->ppo_projectid;
   $unformatted_value_ppo_idtasktahapan = $this->ppo_idtasktahapan;
   $unformatted_value_ppo_tglmulaiplan = $this->ppo_tglmulaiplan;
   $unformatted_value_ppo_targethari = $this->ppo_targethari;
   $unformatted_value_ppo_targetselesai = $this->ppo_targetselesai;

   $nm_comando = "SELECT STATUSID, STATUSNAME  FROM TB_TASKTSTATUS  ORDER BY STATUSNAME";

   $this->ppo_tglmulaiactual = $old_value_ppo_tglmulaiactual;
   $this->ppo_tglselesaiactual = $old_value_ppo_tglselesaiactual;
   $this->ppo_projectid = $old_value_ppo_projectid;
   $this->ppo_idtasktahapan = $old_value_ppo_idtasktahapan;
   $this->ppo_tglmulaiplan = $old_value_ppo_tglmulaiplan;
   $this->ppo_targethari = $old_value_ppo_targethari;
   $this->ppo_targetselesai = $old_value_ppo_targetselesai;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $aLookup[] = array(project_edit_update_main_updatetask_detail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => project_edit_update_main_updatetask_detail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1])));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"ppo_status\"";
          if (isset($this->NM_ajax_info['select_html']['ppo_status']) && !empty($this->NM_ajax_info['select_html']['ppo_status']))
          {
              $sSelComp = $this->NM_ajax_info['select_html']['ppo_status'];
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->ppo_status == $sValue)
                  {
                      $this->_tmp_lookup_ppo_status = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['ppo_status'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['ppo_status']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['ppo_status']['valList'][$i] = project_edit_update_main_updatetask_detail_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['ppo_status']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['ppo_status']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['ppo_status']['labList'] = $aLabel;
          }
   }

          //----- ppo_tglmulaiactual
   function ajax_return_values_ppo_tglmulaiactual($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_tglmulaiactual", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_tglmulaiactual);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_tglmulaiactual'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- ppo_tglselesaiactual
   function ajax_return_values_ppo_tglselesaiactual($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_tglselesaiactual", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_tglselesaiactual);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_tglselesaiactual'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- ppo_evident_one
   function ajax_return_values_ppo_evident_one($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_evident_one", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_evident_one);
              $aLookup = array();
              $sTmpExtension = pathinfo($this->ppo_evident_one, PATHINFO_EXTENSION);
              $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
              $sTmpFile      = 'sc_ppo_evident_one_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['download_filenames'][$sTmpFile] = $this->ppo_evident_one;
              $tmp_file_ppo_evident_one = trim(NM_charset_to_utf8($this->ppo_evident_one));
              $tmp_icon_ppo_evident_one = '';
              if ('' != $tmp_file_ppo_evident_one)
              {
                  $tmp_icon_ppo_evident_one = $this->gera_icone($tmp_file_ppo_evident_one);
              }
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_evident_one'] = array(
                       'row'    => '',
               'type'    => 'documento',
               'valList' => array($sTmpValue),
               'docLink' => "<a href=\"javascript:nm_mostra_doc('0', '" . $sTmpFile . "', 'project_edit_update_main_updatetask_detail')\">" . $tmp_file_ppo_evident_one . "</a>",
               'docIcon' => $tmp_icon_ppo_evident_one,
              );
              if ('navigate_form' == $this->NM_ajax_opcao)
              {
                  $this->NM_ajax_info['fldList']['ppo_evident_one_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
          }
   }

          //----- keterangan
   function ajax_return_values_keterangan($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("keterangan", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->keterangan);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['keterangan'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- ppo_note
   function ajax_return_values_ppo_note($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_note", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_note);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_note'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- ppo_projectid
   function ajax_return_values_ppo_projectid($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_projectid", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_projectid);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_projectid'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- ppo_tahapanproject
   function ajax_return_values_ppo_tahapanproject($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_tahapanproject", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_tahapanproject);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_tahapanproject'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- ppo_idtasktahapan
   function ajax_return_values_ppo_idtasktahapan($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_idtasktahapan", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_idtasktahapan);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_idtasktahapan'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- ppo_tasktahapan
   function ajax_return_values_ppo_tasktahapan($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_tasktahapan", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_tasktahapan);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_tasktahapan'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- ppo_tglmulaiplan
   function ajax_return_values_ppo_tglmulaiplan($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_tglmulaiplan", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_tglmulaiplan);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_tglmulaiplan'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- ppo_targethari
   function ajax_return_values_ppo_targethari($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_targethari", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_targethari);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_targethari'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- ppo_targetselesai
   function ajax_return_values_ppo_targetselesai($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ppo_targetselesai", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ppo_targetselesai);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ppo_targetselesai'] = array(
                       'row'    => '',
               'type'    => 'label',
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['upload_dir'][$fieldName][] = $newName;
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
      if (!isset($this->ppo_updateby)){$this->ppo_updateby =  $_SESSION['usr_login'];}  
      if ('incluir' == $this->nmgp_opcao) { $this->ppo_entryby = "" . $_SESSION['usr_login'] . ""; } 
      if ('alterar' == $this->nmgp_opcao || 'igual' == $this->nmgp_opcao) { $this->ppo_updateby = "" . $_SESSION['usr_login'] . ""; } 
      $NM_val_form['ppo_id'] = $this->ppo_id;
      $NM_val_form['ppo_status'] = $this->ppo_status;
      $NM_val_form['ppo_tglmulaiactual'] = $this->ppo_tglmulaiactual;
      $NM_val_form['ppo_tglselesaiactual'] = $this->ppo_tglselesaiactual;
      $NM_val_form['ppo_evident_one'] = $this->ppo_evident_one;
      $NM_val_form['keterangan'] = $this->keterangan;
      $NM_val_form['ppo_note'] = $this->ppo_note;
      $NM_val_form['ppo_projectid'] = $this->ppo_projectid;
      $NM_val_form['ppo_tahapanproject'] = $this->ppo_tahapanproject;
      $NM_val_form['ppo_idtasktahapan'] = $this->ppo_idtasktahapan;
      $NM_val_form['ppo_tasktahapan'] = $this->ppo_tasktahapan;
      $NM_val_form['ppo_tglmulaiplan'] = $this->ppo_tglmulaiplan;
      $NM_val_form['ppo_targethari'] = $this->ppo_targethari;
      $NM_val_form['ppo_targetselesai'] = $this->ppo_targetselesai;
      $NM_val_form['ppo_entrydate'] = $this->ppo_entrydate;
      $NM_val_form['ppo_entryby'] = $this->ppo_entryby;
      $NM_val_form['ppo_updatedate'] = $this->ppo_updatedate;
      $NM_val_form['ppo_updateby'] = $this->ppo_updateby;
      $NM_val_form['ppo_evident_two'] = $this->ppo_evident_two;
      $NM_val_form['ppo_evident_three'] = $this->ppo_evident_three;
      $NM_val_form['ppo_tasknumber'] = $this->ppo_tasknumber;
      if ($this->ppo_id == "")  
      { 
          $this->ppo_id = 0;
      } 
      if ($this->ppo_projectid == "")  
      { 
          $this->ppo_projectid = 0;
          $this->sc_force_zero[] = 'ppo_projectid';
      } 
      if ($this->ppo_tahapanproject == "")  
      { 
          $this->ppo_tahapanproject = 0;
          $this->sc_force_zero[] = 'ppo_tahapanproject';
      } 
      if ($this->ppo_targethari == "")  
      { 
          $this->ppo_targethari = 0;
          $this->sc_force_zero[] = 'ppo_targethari';
      } 
      if ($this->ppo_tasknumber == "")  
      { 
          $this->ppo_tasknumber = 0;
          $this->sc_force_zero[] = 'ppo_tasknumber';
      } 
      if ($this->ppo_idtasktahapan == "")  
      { 
          $this->ppo_idtasktahapan = 0;
          $this->sc_force_zero[] = 'ppo_idtasktahapan';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql);
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->ppo_tasktahapan_before_qstr = $this->ppo_tasktahapan;
          $this->ppo_tasktahapan = substr($this->Db->qstr($this->ppo_tasktahapan), 1, -1); 
          if ($this->ppo_tasktahapan == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ppo_tasktahapan = "null"; 
              $NM_val_null[] = "ppo_tasktahapan";
          } 
          if ($this->ppo_entrydate == "")  
          { 
              $this->ppo_entrydate = "null"; 
              $NM_val_null[] = "ppo_entrydate";
          } 
          $this->ppo_entryby_before_qstr = $this->ppo_entryby;
          $this->ppo_entryby = substr($this->Db->qstr($this->ppo_entryby), 1, -1); 
          if ($this->ppo_entryby == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ppo_entryby = "null"; 
              $NM_val_null[] = "ppo_entryby";
          } 
          if ($this->ppo_updatedate == "")  
          { 
              $this->ppo_updatedate = "null"; 
              $NM_val_null[] = "ppo_updatedate";
          } 
          $this->ppo_updateby_before_qstr = $this->ppo_updateby;
          $this->ppo_updateby = substr($this->Db->qstr($this->ppo_updateby), 1, -1); 
          if ($this->ppo_updateby == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ppo_updateby = "null"; 
              $NM_val_null[] = "ppo_updateby";
          } 
          $this->ppo_note_before_qstr = $this->ppo_note;
          $this->ppo_note = substr($this->Db->qstr($this->ppo_note), 1, -1); 
          if ($this->ppo_note == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ppo_note = "null"; 
              $NM_val_null[] = "ppo_note";
          } 
          $this->ppo_evident_one_original_filename = $this->ppo_evident_one; 
          $this->ppo_evident_one_before_qstr = $this->ppo_evident_one;
          $this->ppo_evident_one = substr($this->Db->qstr($this->ppo_evident_one), 1, -1); 
          if ($this->ppo_evident_one == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ppo_evident_one = "null"; 
              $NM_val_null[] = "ppo_evident_one";
          } 
          $this->ppo_evident_two_before_qstr = $this->ppo_evident_two;
          $this->ppo_evident_two = substr($this->Db->qstr($this->ppo_evident_two), 1, -1); 
          if ($this->ppo_evident_two == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ppo_evident_two = "null"; 
              $NM_val_null[] = "ppo_evident_two";
          } 
          $this->ppo_evident_three_before_qstr = $this->ppo_evident_three;
          $this->ppo_evident_three = substr($this->Db->qstr($this->ppo_evident_three), 1, -1); 
          if ($this->ppo_evident_three == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ppo_evident_three = "null"; 
              $NM_val_null[] = "ppo_evident_three";
          } 
          $this->ppo_status_before_qstr = $this->ppo_status;
          $this->ppo_status = substr($this->Db->qstr($this->ppo_status), 1, -1); 
          if ($this->ppo_status == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->ppo_status = "null"; 
              $NM_val_null[] = "ppo_status";
          } 
          if ($this->ppo_tglmulaiplan == "")  
          { 
              $this->ppo_tglmulaiplan = "null"; 
              $NM_val_null[] = "ppo_tglmulaiplan";
          } 
          if ($this->ppo_targetselesai == "")  
          { 
              $this->ppo_targetselesai = "null"; 
              $NM_val_null[] = "ppo_targetselesai";
          } 
          if ($this->ppo_tglmulaiactual == "")  
          { 
              $this->ppo_tglmulaiactual = "null"; 
              $NM_val_null[] = "ppo_tglmulaiactual";
          } 
          if ($this->ppo_tglselesaiactual == "")  
          { 
              $this->ppo_tglselesaiactual = "null"; 
              $NM_val_null[] = "ppo_tglselesaiactual";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_ex_update = true; 
          $SC_ex_upd_or = true; 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['foreign_key'] as $sFKName => $sFKValue)
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
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
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
              $this->ppo_updatedate =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->ppo_updatedate_hora =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $NM_val_form['ppo_updatedate'] = $this->ppo_updatedate;
              $this->NM_ajax_changed['ppo_updatedate'] = true;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET PPO_NOTE = '$this->ppo_note', PPO_STATUS = '$this->ppo_status', PPO_TGLMULAIACTUAL = #$this->ppo_tglmulaiactual#, PPO_TGLSELESAIACTUAL = #$this->ppo_tglselesaiactual#";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET PPO_NOTE = '$this->ppo_note', PPO_STATUS = '$this->ppo_status', PPO_TGLMULAIACTUAL = " . $this->Ini->date_delim . $this->ppo_tglmulaiactual . $this->Ini->date_delim1 . ", PPO_TGLSELESAIACTUAL = " . $this->Ini->date_delim . $this->ppo_tglselesaiactual . $this->Ini->date_delim1 . "";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET PPO_NOTE = '$this->ppo_note', PPO_STATUS = '$this->ppo_status', PPO_TGLMULAIACTUAL = " . $this->Ini->date_delim . $this->ppo_tglmulaiactual . $this->Ini->date_delim1 . ", PPO_TGLSELESAIACTUAL = " . $this->Ini->date_delim . $this->ppo_tglselesaiactual . $this->Ini->date_delim1 . "";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET PPO_NOTE = '$this->ppo_note', PPO_STATUS = '$this->ppo_status', PPO_TGLMULAIACTUAL = EXTEND('$this->ppo_tglmulaiactual', YEAR TO DAY), PPO_TGLSELESAIACTUAL = EXTEND('$this->ppo_tglselesaiactual', YEAR TO DAY)";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET PPO_NOTE = '$this->ppo_note', PPO_STATUS = '$this->ppo_status', PPO_TGLMULAIACTUAL = " . $this->Ini->date_delim . $this->ppo_tglmulaiactual . $this->Ini->date_delim1 . ", PPO_TGLSELESAIACTUAL = " . $this->Ini->date_delim . $this->ppo_tglselesaiactual . $this->Ini->date_delim1 . "";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET PPO_NOTE = '$this->ppo_note', PPO_STATUS = '$this->ppo_status', PPO_TGLMULAIACTUAL = " . $this->Ini->date_delim . $this->ppo_tglmulaiactual . $this->Ini->date_delim1 . ", PPO_TGLSELESAIACTUAL = " . $this->Ini->date_delim . $this->ppo_tglselesaiactual . $this->Ini->date_delim1 . "";  
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET PPO_NOTE = '$this->ppo_note', PPO_STATUS = '$this->ppo_status', PPO_TGLMULAIACTUAL = " . $this->Ini->date_delim . $this->ppo_tglmulaiactual . $this->Ini->date_delim1 . ", PPO_TGLSELESAIACTUAL = " . $this->Ini->date_delim . $this->ppo_tglselesaiactual . $this->Ini->date_delim1 . "";  
              } 
              if (isset($NM_val_form['ppo_projectid']) && $NM_val_form['ppo_projectid'] != $this->nmgp_dados_select['ppo_projectid']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " PPO_PROJECTID = $this->ppo_projectid"; 
                  $comando_oracle        .= " PPO_PROJECTID = $this->ppo_projectid"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_tahapanproject']) && $NM_val_form['ppo_tahapanproject'] != $this->nmgp_dados_select['ppo_tahapanproject']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " PPO_TAHAPANPROJECT = $this->ppo_tahapanproject"; 
                  $comando_oracle        .= " PPO_TAHAPANPROJECT = $this->ppo_tahapanproject"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_tasktahapan']) && $NM_val_form['ppo_tasktahapan'] != $this->nmgp_dados_select['ppo_tasktahapan']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " PPO_TASKTAHAPAN = '$this->ppo_tasktahapan'"; 
                  $comando_oracle        .= " PPO_TASKTAHAPAN = '$this->ppo_tasktahapan'"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_entrydate']) && $NM_val_form['ppo_entrydate'] != $this->nmgp_dados_select['ppo_entrydate']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $comando        .= " PPO_ENTRYDATE = #$this->ppo_entrydate#"; 
                  } 
                  else 
                  { 
                      $comando        .= " PPO_ENTRYDATE = " . $this->Ini->date_delim . $this->ppo_entrydate . $this->Ini->date_delim1 . ""; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $comando_oracle        .= " PPO_ENTRYDATE = EXTEND('" . $this->ppo_entrydate . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $comando_oracle        .= " PPO_ENTRYDATE = " . $this->Ini->date_delim . $this->ppo_entrydate . $this->Ini->date_delim1 . ""; 
                  } 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_entryby']) && $NM_val_form['ppo_entryby'] != $this->nmgp_dados_select['ppo_entryby']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " PPO_ENTRYBY = '$this->ppo_entryby'"; 
                  $comando_oracle        .= " PPO_ENTRYBY = '$this->ppo_entryby'"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_updatedate']) && $NM_val_form['ppo_updatedate'] != $this->nmgp_dados_select['ppo_updatedate']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $comando        .= " PPO_UPDATEDATE = #$this->ppo_updatedate#"; 
                  } 
                  else 
                  { 
                      $comando        .= " PPO_UPDATEDATE = " . $this->Ini->date_delim . $this->ppo_updatedate . $this->Ini->date_delim1 . ""; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $comando_oracle        .= " PPO_UPDATEDATE = EXTEND('" . $this->ppo_updatedate . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $comando_oracle        .= " PPO_UPDATEDATE = " . $this->Ini->date_delim . $this->ppo_updatedate . $this->Ini->date_delim1 . ""; 
                  } 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_updateby']) && $NM_val_form['ppo_updateby'] != $this->nmgp_dados_select['ppo_updateby']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " PPO_UPDATEBY = '$this->ppo_updateby'"; 
                  $comando_oracle        .= " PPO_UPDATEBY = '$this->ppo_updateby'"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_evident_two']) && $NM_val_form['ppo_evident_two'] != $this->nmgp_dados_select['ppo_evident_two']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " PPO_EVIDENT_TWO = '$this->ppo_evident_two'"; 
                  $comando_oracle        .= " PPO_EVIDENT_TWO = '$this->ppo_evident_two'"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_evident_three']) && $NM_val_form['ppo_evident_three'] != $this->nmgp_dados_select['ppo_evident_three']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " PPO_EVIDENT_THREE = '$this->ppo_evident_three'"; 
                  $comando_oracle        .= " PPO_EVIDENT_THREE = '$this->ppo_evident_three'"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_tglmulaiplan']) && $NM_val_form['ppo_tglmulaiplan'] != $this->nmgp_dados_select['ppo_tglmulaiplan']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $comando        .= " PPO_TGLMULAIPLAN = #$this->ppo_tglmulaiplan#"; 
                  } 
                  else 
                  { 
                      $comando        .= " PPO_TGLMULAIPLAN = " . $this->Ini->date_delim . $this->ppo_tglmulaiplan . $this->Ini->date_delim1 . ""; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $comando_oracle        .= " PPO_TGLMULAIPLAN = EXTEND('" . $this->ppo_tglmulaiplan . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $comando_oracle        .= " PPO_TGLMULAIPLAN = " . $this->Ini->date_delim . $this->ppo_tglmulaiplan . $this->Ini->date_delim1 . ""; 
                  } 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_targethari']) && $NM_val_form['ppo_targethari'] != $this->nmgp_dados_select['ppo_targethari']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " PPO_TARGETHARI = $this->ppo_targethari"; 
                  $comando_oracle        .= " PPO_TARGETHARI = $this->ppo_targethari"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_targetselesai']) && $NM_val_form['ppo_targetselesai'] != $this->nmgp_dados_select['ppo_targetselesai']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $comando        .= " PPO_TARGETSELESAI = #$this->ppo_targetselesai#"; 
                  } 
                  else 
                  { 
                      $comando        .= " PPO_TARGETSELESAI = " . $this->Ini->date_delim . $this->ppo_targetselesai . $this->Ini->date_delim1 . ""; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $comando_oracle        .= " PPO_TARGETSELESAI = EXTEND('" . $this->ppo_targetselesai . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $comando_oracle        .= " PPO_TARGETSELESAI = " . $this->Ini->date_delim . $this->ppo_targetselesai . $this->Ini->date_delim1 . ""; 
                  } 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_tasknumber']) && $NM_val_form['ppo_tasknumber'] != $this->nmgp_dados_select['ppo_tasknumber']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " PPO_TASKNUMBER = $this->ppo_tasknumber"; 
                  $comando_oracle        .= " PPO_TASKNUMBER = $this->ppo_tasknumber"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['ppo_idtasktahapan']) && $NM_val_form['ppo_idtasktahapan'] != $this->nmgp_dados_select['ppo_idtasktahapan']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " PPO_IDTASKTAHAPAN = $this->ppo_idtasktahapan"; 
                  $comando_oracle        .= " PPO_IDTASKTAHAPAN = $this->ppo_idtasktahapan"; 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              $aDoNotUpdate = array();
              $temp_cmd_sql = "";
              if ($this->ppo_evident_one_limpa == "S") 
              { 
                  if ($this->ppo_evident_one != "null") 
                  { 
                      $this->ppo_evident_one = ''; 
                  } 
                  if ($SC_ex_update || $SC_tem_cmp_update || $SC_ex_upd_or) 
                  { 
                      $temp_cmd_sql .= ", PPO_EVIDENT_ONE = '" . $this->ppo_evident_one . "'"; 
                      $comando_oracle .= ", PPO_EVIDENT_ONE = '" . $this->ppo_evident_one . "'"; 
                  } 
                  else 
                  { 
                     $temp_cmd_sql .= " PPO_EVIDENT_ONE = '" . $this->ppo_evident_one . "'"; 
                     $comando_oracle .= " PPO_EVIDENT_ONE = '" . $this->ppo_evident_one . "'"; 
                     $SC_ex_upd_or = true; 
                     $SC_ex_update = true; 
                  } 
                  $this->ppo_evident_one = "";
              } 
              else 
              { 
                  if ($this->ppo_evident_one != "none" && $this->ppo_evident_one != "") 
                  { 
                      $NM_conteudo =  $this->ppo_evident_one;
                      if ($SC_ex_update || $SC_tem_cmp_update || $SC_ex_upd_or) 
                      { 
                          $temp_cmd_sql .= ", PPO_EVIDENT_ONE = '$NM_conteudo'" ; 
                          $comando_oracle .= ", PPO_EVIDENT_ONE = '$NM_conteudo'" ; 
                      } 
                      else 
                      { 
                          $temp_cmd_sql .= " PPO_EVIDENT_ONE = '$NM_conteudo'" ; 
                          $comando_oracle .= " PPO_EVIDENT_ONE = '$NM_conteudo'" ; 
                          $SC_ex_upd_or = true; 
                          $SC_ex_update = true; 
                      } 
                  } 
                  else
                  {
                      $aDoNotUpdate[] = "ppo_evident_one";
                  }
              } 
              if (!empty($temp_cmd_sql)) 
              { 
                  $comando .= $temp_cmd_sql;
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  $comando = $comando_oracle;  
                  $SC_ex_update = $SC_ex_upd_or;
              }   
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE PPO_ID = $this->ppo_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE PPO_ID = $this->ppo_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE PPO_ID = $this->ppo_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE PPO_ID = $this->ppo_id ";  
              }  
              else  
              {
                  $comando .= " WHERE PPO_ID = $this->ppo_id ";  
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
                                  project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
              }   
              if ($this->ppo_evident_one_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['ppo_evident_one_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
          $this->ppo_tasktahapan = $this->ppo_tasktahapan_before_qstr;
          $this->ppo_entryby = $this->ppo_entryby_before_qstr;
          $this->ppo_updateby = $this->ppo_updateby_before_qstr;
          $this->ppo_note = $this->ppo_note_before_qstr;
          $this->ppo_evident_one = $this->ppo_evident_one_before_qstr;
          $this->ppo_evident_two = $this->ppo_evident_two_before_qstr;
          $this->ppo_evident_three = $this->ppo_evident_three_before_qstr;
          $this->ppo_status = $this->ppo_status_before_qstr;
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['db_changed'] = true;


              if     (isset($NM_val_form) && isset($NM_val_form['ppo_id'])) { $this->ppo_id = $NM_val_form['ppo_id']; }
              elseif (isset($this->ppo_id)) { $this->nm_limpa_alfa($this->ppo_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['ppo_projectid'])) { $this->ppo_projectid = $NM_val_form['ppo_projectid']; }
              elseif (isset($this->ppo_projectid)) { $this->nm_limpa_alfa($this->ppo_projectid); }
              if     (isset($NM_val_form) && isset($NM_val_form['ppo_tahapanproject'])) { $this->ppo_tahapanproject = $NM_val_form['ppo_tahapanproject']; }
              elseif (isset($this->ppo_tahapanproject)) { $this->nm_limpa_alfa($this->ppo_tahapanproject); }
              if     (isset($NM_val_form) && isset($NM_val_form['ppo_tasktahapan'])) { $this->ppo_tasktahapan = $NM_val_form['ppo_tasktahapan']; }
              elseif (isset($this->ppo_tasktahapan)) { $this->nm_limpa_alfa($this->ppo_tasktahapan); }
              if     (isset($NM_val_form) && isset($NM_val_form['ppo_note'])) { $this->ppo_note = $NM_val_form['ppo_note']; }
              elseif (isset($this->ppo_note)) { $this->nm_limpa_alfa($this->ppo_note); }
              if     (isset($NM_val_form) && isset($NM_val_form['ppo_status'])) { $this->ppo_status = $NM_val_form['ppo_status']; }
              elseif (isset($this->ppo_status)) { $this->nm_limpa_alfa($this->ppo_status); }
              if     (isset($NM_val_form) && isset($NM_val_form['ppo_targethari'])) { $this->ppo_targethari = $NM_val_form['ppo_targethari']; }
              elseif (isset($this->ppo_targethari)) { $this->nm_limpa_alfa($this->ppo_targethari); }
              if     (isset($NM_val_form) && isset($NM_val_form['ppo_idtasktahapan'])) { $this->ppo_idtasktahapan = $NM_val_form['ppo_idtasktahapan']; }
              elseif (isset($this->ppo_idtasktahapan)) { $this->nm_limpa_alfa($this->ppo_idtasktahapan); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $bChange_ppo_evident_one = false;
              if (isset($this->ppo_evident_one_original_filename) && '' != $this->ppo_evident_one_original_filename && $this->ppo_evident_one_original_filename != $this->ppo_evident_one)
              {
                  $sTmpOrig_ppo_evident_one = $this->ppo_evident_one;
                  $this->ppo_evident_one    = $this->ppo_evident_one_original_filename;
                  $bChange_ppo_evident_one  = true;
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('ppo_id', 'ppo_status', 'ppo_tglmulaiactual', 'ppo_tglselesaiactual', 'ppo_evident_one', 'keterangan', 'ppo_note', 'ppo_projectid', 'ppo_tahapanproject', 'ppo_idtasktahapan', 'ppo_tasktahapan', 'ppo_tglmulaiplan', 'ppo_targethari', 'ppo_targetselesai'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              if ($bChange_ppo_evident_one)
              {
                  $this->ppo_evident_one                   = $sTmpOrig_ppo_evident_one;
                  $this->ppo_evident_one_original_filename = '';
              }

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
              $this->ppo_entrydate =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->ppo_entrydate_hora =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
          $bInsertOk = true;
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 0) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_pkey']); 
              $this->nmgp_opcao = "nada"; 
              $GLOBALS["erro_incl"] = 1; 
              $bInsertOk = false;
              $this->sc_evento = 'insert';
          } 
          $rs1->Close(); 
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              $dir_file = $this->Ini->path_doc . "" . "/"; 
              $_test_file = $this->fetchUniqueUploadName($this->ppo_evident_one_scfile_name, $dir_file, "ppo_evident_one");
              if (trim($this->ppo_evident_one_scfile_name) != $_test_file)
              {
                  $this->ppo_evident_one_scfile_name = $_test_file;
                  $this->ppo_evident_one = $_test_file;
              }
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_IDTASKTAHAPAN) VALUES ($this->ppo_id, $this->ppo_projectid, $this->ppo_tahapanproject, '$this->ppo_tasktahapan', #$this->ppo_entrydate#, '$this->ppo_entryby', #$this->ppo_updatedate#, '$this->ppo_updateby', '$this->ppo_note', '$this->ppo_evident_one', '$this->ppo_evident_two', '$this->ppo_evident_three', '$this->ppo_status', #$this->ppo_tglmulaiplan#, $this->ppo_targethari, #$this->ppo_targetselesai#, #$this->ppo_tglmulaiactual#, #$this->ppo_tglselesaiactual#, $this->ppo_tasknumber, $this->ppo_idtasktahapan)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_IDTASKTAHAPAN) VALUES (" . $NM_seq_auto . "$this->ppo_id, $this->ppo_projectid, $this->ppo_tahapanproject, '$this->ppo_tasktahapan', " . $this->Ini->date_delim . $this->ppo_entrydate . $this->Ini->date_delim1 . ", '$this->ppo_entryby', " . $this->Ini->date_delim . $this->ppo_updatedate . $this->Ini->date_delim1 . ", '$this->ppo_updateby', '$this->ppo_note', '$this->ppo_evident_one', '$this->ppo_evident_two', '$this->ppo_evident_three', '$this->ppo_status', " . $this->Ini->date_delim . $this->ppo_tglmulaiplan . $this->Ini->date_delim1 . ", $this->ppo_targethari, " . $this->Ini->date_delim . $this->ppo_targetselesai . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->ppo_tglmulaiactual . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->ppo_tglselesaiactual . $this->Ini->date_delim1 . ", $this->ppo_tasknumber, $this->ppo_idtasktahapan)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_IDTASKTAHAPAN) VALUES (" . $NM_seq_auto . "$this->ppo_id, $this->ppo_projectid, $this->ppo_tahapanproject, '$this->ppo_tasktahapan', " . $this->Ini->date_delim . $this->ppo_entrydate . $this->Ini->date_delim1 . ", '$this->ppo_entryby', " . $this->Ini->date_delim . $this->ppo_updatedate . $this->Ini->date_delim1 . ", '$this->ppo_updateby', '$this->ppo_note', '$this->ppo_evident_one', '$this->ppo_evident_two', '$this->ppo_evident_three', '$this->ppo_status', " . $this->Ini->date_delim . $this->ppo_tglmulaiplan . $this->Ini->date_delim1 . ", $this->ppo_targethari, " . $this->Ini->date_delim . $this->ppo_targetselesai . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->ppo_tglmulaiactual . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->ppo_tglselesaiactual . $this->Ini->date_delim1 . ", $this->ppo_tasknumber, $this->ppo_idtasktahapan)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_IDTASKTAHAPAN) VALUES (" . $NM_seq_auto . "$this->ppo_id, $this->ppo_projectid, $this->ppo_tahapanproject, '$this->ppo_tasktahapan', EXTEND('$this->ppo_entrydate', YEAR TO DAY), '$this->ppo_entryby', EXTEND('$this->ppo_updatedate', YEAR TO DAY), '$this->ppo_updateby', '$this->ppo_note', '$this->ppo_evident_one', '$this->ppo_evident_two', '$this->ppo_evident_three', '$this->ppo_status', EXTEND('$this->ppo_tglmulaiplan', YEAR TO DAY), $this->ppo_targethari, EXTEND('$this->ppo_targetselesai', YEAR TO DAY), EXTEND('$this->ppo_tglmulaiactual', YEAR TO DAY), EXTEND('$this->ppo_tglselesaiactual', YEAR TO DAY), $this->ppo_tasknumber, $this->ppo_idtasktahapan)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_IDTASKTAHAPAN) VALUES (" . $NM_seq_auto . "$this->ppo_id, $this->ppo_projectid, $this->ppo_tahapanproject, '$this->ppo_tasktahapan', " . $this->Ini->date_delim . $this->ppo_entrydate . $this->Ini->date_delim1 . ", '$this->ppo_entryby', " . $this->Ini->date_delim . $this->ppo_updatedate . $this->Ini->date_delim1 . ", '$this->ppo_updateby', '$this->ppo_note', '$this->ppo_evident_one', '$this->ppo_evident_two', '$this->ppo_evident_three', '$this->ppo_status', " . $this->Ini->date_delim . $this->ppo_tglmulaiplan . $this->Ini->date_delim1 . ", $this->ppo_targethari, " . $this->Ini->date_delim . $this->ppo_targetselesai . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->ppo_tglmulaiactual . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->ppo_tglselesaiactual . $this->Ini->date_delim1 . ", $this->ppo_tasknumber, $this->ppo_idtasktahapan)"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_IDTASKTAHAPAN) VALUES (" . $NM_seq_auto . "$this->ppo_id, $this->ppo_projectid, $this->ppo_tahapanproject, '$this->ppo_tasktahapan', " . $this->Ini->date_delim . $this->ppo_entrydate . $this->Ini->date_delim1 . ", '$this->ppo_entryby', " . $this->Ini->date_delim . $this->ppo_updatedate . $this->Ini->date_delim1 . ", '$this->ppo_updateby', '$this->ppo_note', '$this->ppo_evident_one', '$this->ppo_evident_two', '$this->ppo_evident_three', '$this->ppo_status', " . $this->Ini->date_delim . $this->ppo_tglmulaiplan . $this->Ini->date_delim1 . ", $this->ppo_targethari, " . $this->Ini->date_delim . $this->ppo_targetselesai . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->ppo_tglmulaiactual . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->ppo_tglselesaiactual . $this->Ini->date_delim1 . ", $this->ppo_tasknumber, $this->ppo_idtasktahapan)"; 
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
                              project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total']);
              }

              $dir_doc = $this->Ini->path_doc . "" . "/"; 
              $arq_ppo_evident_one = fopen($this->SC_DOC_ppo_evident_one, "r") ; 
              $reg_ppo_evident_one = fread($arq_ppo_evident_one, filesize($this->SC_DOC_ppo_evident_one)) ; 
              fclose($arq_ppo_evident_one) ;  
              $arq_ppo_evident_one = fopen($dir_doc . trim($this->ppo_evident_one_scfile_name), "w") ; 
              fwrite($arq_ppo_evident_one, $reg_ppo_evident_one) ;  
              fclose($arq_ppo_evident_one) ;  
              $this->sc_evento = "insert"; 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['return_edit'] = "new";
              } 
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
          $this->ppo_id = substr($this->Db->qstr($this->ppo_id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where PPO_ID = $this->ppo_id "); 
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
                          project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total']);
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
    if ("update" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        $_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'on';
           
if ($this->ppo_status =='2') 
	{$this->inprogress_2();
}
if ($this->ppo_status =='4') {$this->pending_4();
}


if ($this->ppo_status  == '3' && $this->ppo_tahapanproject  != '4')  {
$this->close_selain_tahapan_4();
}




if ($this->ppo_status =='3' && $this->ppo_tahapanproject  == '4') 
{$this->close_tahapan_khusus_4();
}	


$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'off'; 
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['parms'] = "ppo_id?#?$this->ppo_id?@?"; 
      }
      $this->nmgp_dados_form['ppo_evident_one'] = ""; 
      $this->ppo_evident_one_limpa = ""; 
      $this->ppo_evident_one_salva = ""; 
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->ppo_id = substr($this->Db->qstr($this->ppo_id), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "R")
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->ppo_id)) 
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
      if ($this->nmgp_opcao != "nada" && (trim($this->ppo_id) == "")) 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "F" && $this->sc_evento == "insert")
      {
          $this->nmgp_opcao = "final";
      }
      $sc_where = trim("PPO_PROJECTID=" . $_SESSION['var_projectid'] . "");
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total']))
      { 
          $nmgp_select = "SELECT count(*) from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_project_edit_update_main_updatetask_detail_mob = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total'] = $qt_geral_reg_project_edit_update_main_updatetask_detail_mob;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->ppo_id))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "PPO_ID < $this->ppo_id "; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Key_Where = "PPO_ID < $this->ppo_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Key_Where = "PPO_ID < $this->ppo_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Key_Where = "PPO_ID < $this->ppo_id "; 
              }
              else  
              {
                  $Key_Where = "PPO_ID < $this->ppo_id "; 
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] = $rt->fields[0];
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_project_edit_update_main_updatetask_detail_mob = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] > $qt_geral_reg_project_edit_update_main_updatetask_detail_mob)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] = $qt_geral_reg_project_edit_update_main_updatetask_detail_mob; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] = $qt_geral_reg_project_edit_update_main_updatetask_detail_mob; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_project_edit_update_main_updatetask_detail_mob) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] = 0;
      }
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, str_replace (convert(char(10),PPO_ENTRYDATE,102), '.', '-') + ' ' + convert(char(8),PPO_ENTRYDATE,20), PPO_ENTRYBY, str_replace (convert(char(10),PPO_UPDATEDATE,102), '.', '-') + ' ' + convert(char(8),PPO_UPDATEDATE,20), PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, str_replace (convert(char(10),PPO_TGLMULAIPLAN,102), '.', '-') + ' ' + convert(char(8),PPO_TGLMULAIPLAN,20), PPO_TARGETHARI, str_replace (convert(char(10),PPO_TARGETSELESAI,102), '.', '-') + ' ' + convert(char(8),PPO_TARGETSELESAI,20), str_replace (convert(char(10),PPO_TGLMULAIACTUAL,102), '.', '-') + ' ' + convert(char(8),PPO_TGLMULAIACTUAL,20), str_replace (convert(char(10),PPO_TGLSELESAIACTUAL,102), '.', '-') + ' ' + convert(char(8),PPO_TGLSELESAIACTUAL,20), PPO_TASKNUMBER, PPO_IDTASKTAHAPAN from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, convert(char(23),PPO_ENTRYDATE,121), PPO_ENTRYBY, convert(char(23),PPO_UPDATEDATE,121), PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, convert(char(23),PPO_TGLMULAIPLAN,121), PPO_TARGETHARI, convert(char(23),PPO_TARGETSELESAI,121), convert(char(23),PPO_TGLMULAIACTUAL,121), convert(char(23),PPO_TGLSELESAIACTUAL,121), PPO_TASKNUMBER, PPO_IDTASKTAHAPAN from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_IDTASKTAHAPAN from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, EXTEND(PPO_ENTRYDATE, YEAR TO DAY), PPO_ENTRYBY, EXTEND(PPO_UPDATEDATE, YEAR TO DAY), PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, EXTEND(PPO_TGLMULAIPLAN, YEAR TO DAY), PPO_TARGETHARI, EXTEND(PPO_TARGETSELESAI, YEAR TO DAY), EXTEND(PPO_TGLMULAIACTUAL, YEAR TO DAY), EXTEND(PPO_TGLSELESAIACTUAL, YEAR TO DAY), PPO_TASKNUMBER, PPO_IDTASKTAHAPAN from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, PPO_TASKTAHAPAN, PPO_ENTRYDATE, PPO_ENTRYBY, PPO_UPDATEDATE, PPO_UPDATEBY, PPO_NOTE, PPO_EVIDENT_ONE, PPO_EVIDENT_TWO, PPO_EVIDENT_THREE, PPO_STATUS, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_IDTASKTAHAPAN from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = "PPO_PROJECTID=" . $_SESSION['var_projectid'] . "";
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_adm_clientes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_adm_clientes']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (!empty($sc_where))
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                     $aWhere[] = "PPO_ID = $this->ppo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                  {
                     $aWhere[] = "PPO_ID = $this->ppo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  {
                     $aWhere[] = "PPO_ID = $this->ppo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  {
                     $aWhere[] = "PPO_ID = $this->ppo_id"; 
                  }  
                  else  
                  {
                     $aWhere[] = "PPO_ID = $this->ppo_id"; 
                  }
              } 
              else
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                      $aWhere[] = "PPO_ID = $this->ppo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                  {
                      $aWhere[] = "PPO_ID = $this->ppo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  {
                      $aWhere[] = "PPO_ID = $this->ppo_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  {
                      $aWhere[] = "PPO_ID = $this->ppo_id"; 
                  }  
                  else  
                  {
                      $aWhere[] = "PPO_ID = $this->ppo_id"; 
                  }
              } 
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "PPO_ID";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start']) ;  
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['empty_filter'] = true;
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
              $this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes['update'] = "off";
              $this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes['delete'] = "off";
              return; 
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->ppo_id = $rs->fields[0] ; 
              $this->nmgp_dados_select['ppo_id'] = $this->ppo_id;
              $this->ppo_projectid = $rs->fields[1] ; 
              $this->nmgp_dados_select['ppo_projectid'] = $this->ppo_projectid;
              $this->ppo_tahapanproject = $rs->fields[2] ; 
              $this->nmgp_dados_select['ppo_tahapanproject'] = $this->ppo_tahapanproject;
              $this->ppo_tasktahapan = $rs->fields[3] ; 
              $this->nmgp_dados_select['ppo_tasktahapan'] = $this->ppo_tasktahapan;
              $this->ppo_entrydate = $rs->fields[4] ; 
              $this->nmgp_dados_select['ppo_entrydate'] = $this->ppo_entrydate;
              $this->ppo_entryby = $rs->fields[5] ; 
              $this->nmgp_dados_select['ppo_entryby'] = $this->ppo_entryby;
              $this->ppo_updatedate = $rs->fields[6] ; 
              $this->nmgp_dados_select['ppo_updatedate'] = $this->ppo_updatedate;
              $this->ppo_updateby = $rs->fields[7] ; 
              $this->nmgp_dados_select['ppo_updateby'] = $this->ppo_updateby;
              $this->ppo_note = $rs->fields[8] ; 
              $this->nmgp_dados_select['ppo_note'] = $this->ppo_note;
              $this->ppo_evident_one = $rs->fields[9] ; 
              $this->nmgp_dados_select['ppo_evident_one'] = $this->ppo_evident_one;
              $this->ppo_evident_two = $rs->fields[10] ; 
              $this->nmgp_dados_select['ppo_evident_two'] = $this->ppo_evident_two;
              $this->ppo_evident_three = $rs->fields[11] ; 
              $this->nmgp_dados_select['ppo_evident_three'] = $this->ppo_evident_three;
              $this->ppo_status = $rs->fields[12] ; 
              $this->nmgp_dados_select['ppo_status'] = $this->ppo_status;
              $this->ppo_tglmulaiplan = $rs->fields[13] ; 
              $this->nmgp_dados_select['ppo_tglmulaiplan'] = $this->ppo_tglmulaiplan;
              $this->ppo_targethari = $rs->fields[14] ; 
              $this->nmgp_dados_select['ppo_targethari'] = $this->ppo_targethari;
              $this->ppo_targetselesai = $rs->fields[15] ; 
              $this->nmgp_dados_select['ppo_targetselesai'] = $this->ppo_targetselesai;
              $this->ppo_tglmulaiactual = $rs->fields[16] ; 
              $this->nmgp_dados_select['ppo_tglmulaiactual'] = $this->ppo_tglmulaiactual;
              $this->ppo_tglselesaiactual = $rs->fields[17] ; 
              $this->nmgp_dados_select['ppo_tglselesaiactual'] = $this->ppo_tglselesaiactual;
              $this->ppo_tasknumber = $rs->fields[18] ; 
              $this->nmgp_dados_select['ppo_tasknumber'] = $this->ppo_tasknumber;
              $this->ppo_idtasktahapan = $rs->fields[19] ; 
              $this->nmgp_dados_select['ppo_idtasktahapan'] = $this->ppo_idtasktahapan;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->ppo_id = (string)$this->ppo_id; 
              $this->ppo_projectid = (string)$this->ppo_projectid; 
              $this->ppo_tahapanproject = (string)$this->ppo_tahapanproject; 
              $this->ppo_targethari = (string)$this->ppo_targethari; 
              $this->ppo_tasknumber = (string)$this->ppo_tasknumber; 
              $this->ppo_idtasktahapan = (string)$this->ppo_idtasktahapan; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['parms'] = "ppo_id?#?$this->ppo_id?@?";
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['sub_dir'][0]  = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] < $qt_geral_reg_project_edit_update_main_updatetask_detail_mob;
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opcao']   = '';
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
              $this->ppo_id = "";  
              $this->ppo_projectid = "";  
              $this->ppo_tahapanproject = "";  
              $this->ppo_tasktahapan = "";  
              $this->ppo_entrydate = "";  
              $this->ppo_entrydate_hora = "" ;  
              $this->ppo_entryby = "";  
              $this->ppo_updatedate = "";  
              $this->ppo_updatedate_hora = "" ;  
              $this->ppo_updateby = "";  
              $this->ppo_note = "";  
              $this->ppo_evident_one = "";  
              $this->ppo_evident_one_ul_name = "" ;  
              $this->ppo_evident_one_ul_type = "" ;  
              $this->ppo_evident_two = "";  
              $this->ppo_evident_three = "";  
              $this->ppo_status = "";  
              $this->ppo_tglmulaiplan = "";  
              $this->ppo_tglmulaiplan_hora = "" ;  
              $this->ppo_targethari = "";  
              $this->ppo_targetselesai = "";  
              $this->ppo_targetselesai_hora = "" ;  
              $this->ppo_tglmulaiactual = "";  
              $this->ppo_tglmulaiactual_hora = "" ;  
              $this->ppo_tglselesaiactual = "";  
              $this->ppo_tglselesaiactual_hora = "" ;  
              $this->ppo_tasknumber = "";  
              $this->ppo_idtasktahapan = "";  
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['foreign_key'] as $sFKName => $sFKValue)
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
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['reg_start'] + 1;
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

// 
 function gera_icone($doc) 
 {
    $cam_icone = "";
    $path =  $this->Ini->root . $this->Ini->path_icones . "/";
    if (is_dir($path))
    {
        $nm_icones = nm_list_icon($path); 
        $nm_tipo = strtolower(substr($doc, strrpos($doc, ".") + 1));
        $nm_tipo = str_replace(array('docx', 'xlsx'), array('doc', 'xls'), $nm_tipo);
        if (isset($nm_icones[$nm_tipo]) && !empty($nm_icones[$nm_tipo]))
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones[$nm_tipo];
        }
        else
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones["default"];
        }
    }
    return $cam_icone;
 } 
//
function PPO_STATUS_onChange()
{
$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_var_tglmulaiaktual)) {$this->sc_temp_var_tglmulaiaktual = (isset($_SESSION['var_tglmulaiaktual'])) ? $_SESSION['var_tglmulaiaktual'] : "";}
           
$original_ppo_note = $this->ppo_note;
$original_ppo_status = $this->ppo_status;
$original_ppo_tglselesaiactual = $this->ppo_tglselesaiactual;
$original_ppo_tglmulaiactual = $this->ppo_tglmulaiactual;
$original_ppo_targethari = $this->ppo_targethari;
$original_ppo_projectid = $this->ppo_projectid;

$this->ppo_note  = '';
if ($this->ppo_status  == 3 )
{
$this->sc_field_readonly("ppo_tglmulaiactual", 'on');
$this->sc_field_readonly("ppo_tglselesaiactual", 'off');
$this->ppo_tglmulaiactual =$this->sc_temp_var_tglmulaiaktual;
	
$this->ppo_tglselesaiactual =
         $this->nm_data->CalculaData($this->ppo_tglmulaiactual , 'yyyy-mm-dd', '+', $this->ppo_targethari , 0, 0, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
$this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes["update"] = "on";;	
} elseif ($this->ppo_status  == 2) {
		
						$check_sql = "SELECT COUNT(PPO_ID) AS JMLREC FROM TBL_PROJECT_DETAIL
WHERE PPO_STATUS=2 AND PPO_PROJECTID=$this->ppo_projectid 
";
 
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

if ($this->rs[0][0] > 0)     
{
$error_message = 'tidak bisa merubah ke inprogress , masih ada task yg berstatus inprogress.'; 

 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $error_message;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_project_edit_update_main_updatetask_detail_mob' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $error_message;
 }
;
$this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes["update"] = "off";;
} else {
$this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes["update"] = "on";;	
	}
						}
else {
	$this->sc_field_readonly("ppo_tglmulaiactual", 'on');
	$this->sc_field_readonly("ppo_tglselesaiactual", 'on');
$this->ppo_tglmulaiactual =$this->sc_temp_var_tglmulaiaktual;
$this->ppo_tglselesaiactual =
         $this->nm_data->CalculaData($this->ppo_tglmulaiactual , 'yyyy-mm-dd', '+', $this->ppo_targethari , 0, 0, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
	$this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes["update"] = "on";;

}





					




if (isset($this->sc_temp_var_tglmulaiaktual)) { $_SESSION['var_tglmulaiaktual'] = $this->sc_temp_var_tglmulaiaktual;}
$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'off';
$modificado_ppo_note = $this->ppo_note;
$modificado_ppo_status = $this->ppo_status;
$modificado_ppo_tglselesaiactual = $this->ppo_tglselesaiactual;
$modificado_ppo_tglmulaiactual = $this->ppo_tglmulaiactual;
$modificado_ppo_targethari = $this->ppo_targethari;
$modificado_ppo_projectid = $this->ppo_projectid;
$this->nm_formatar_campos('ppo_note', 'ppo_status', 'ppo_tglselesaiactual', 'ppo_tglmulaiactual', 'ppo_targethari', 'ppo_projectid');
if ($original_ppo_note !== $modificado_ppo_note || isset($this->nmgp_cmp_readonly['ppo_note']) || (isset($bFlagRead_ppo_note) && $bFlagRead_ppo_note))
{
    $this->ajax_return_values_ppo_note(true);
}
if ($original_ppo_status !== $modificado_ppo_status || isset($this->nmgp_cmp_readonly['ppo_status']) || (isset($bFlagRead_ppo_status) && $bFlagRead_ppo_status))
{
    $this->ajax_return_values_ppo_status(true);
}
if ($original_ppo_tglselesaiactual !== $modificado_ppo_tglselesaiactual || isset($this->nmgp_cmp_readonly['ppo_tglselesaiactual']) || (isset($bFlagRead_ppo_tglselesaiactual) && $bFlagRead_ppo_tglselesaiactual))
{
    $this->ajax_return_values_ppo_tglselesaiactual(true);
}
if ($original_ppo_tglmulaiactual !== $modificado_ppo_tglmulaiactual || isset($this->nmgp_cmp_readonly['ppo_tglmulaiactual']) || (isset($bFlagRead_ppo_tglmulaiactual) && $bFlagRead_ppo_tglmulaiactual))
{
    $this->ajax_return_values_ppo_tglmulaiactual(true);
}
if ($original_ppo_targethari !== $modificado_ppo_targethari || isset($this->nmgp_cmp_readonly['ppo_targethari']) || (isset($bFlagRead_ppo_targethari) && $bFlagRead_ppo_targethari))
{
    $this->ajax_return_values_ppo_targethari(true);
}
if ($original_ppo_projectid !== $modificado_ppo_projectid || isset($this->nmgp_cmp_readonly['ppo_projectid']) || (isset($bFlagRead_ppo_projectid) && $bFlagRead_ppo_projectid))
{
    $this->ajax_return_values_ppo_projectid(true);
}
project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
exit;
}
function close_selain_tahapan_4()
{
$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_var_milestone)) {$this->sc_temp_var_milestone = (isset($_SESSION['var_milestone'])) ? $_SESSION['var_milestone'] : "";}
if (!isset($this->sc_temp_var_templateproject)) {$this->sc_temp_var_templateproject = (isset($_SESSION['var_templateproject'])) ? $_SESSION['var_templateproject'] : "";}
           
$jmltask = "SELECT TARGETWAKTU FROM TB_MASTER_TEMPLATE WHERE IDTEMPLATE='$this->sc_temp_var_templateproject'";
 
      $nm_select = $jmltask; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_jltask = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rs_jltask[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_jltask = false;
          $this->rs_jltask_erro = $this->Db->ErrorMsg();
      } 
;

if (isset($this->rs_jltask[0][0]))     
{
    $rec_rs_jltask  = $this->rs_jltask[0][0];
}
$this->prosen_total_satu  = ($this->sc_temp_var_milestone/$rec_rs_jltask )*100;
$check_sql = "SELECT PPO_TASKTAHAPAN,PPO_IDTASKTAHAPAN,PPO_TAHAPANPROJECT,PPO_STATUS,PPO_TGLMULAIPLAN,PPO_TARGETSELESAI FROM TBL_PROJECT_DETAIL WHERE PPO_PROJECTID=$this->ppo_projectid  AND PPO_ID=$this->ppo_id +1";
 
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
    $this->ppo_tasktahapan_next  = $this->rs[0][0];
    $this->ppo_idtasktahapan_next  = $this->rs[0][1];
	$this->ppo_tahapanproject_next  = $this->rs[0][2];
	$this->ppo_status_next  = $this->rs[0][3];
	$this->ppo_tglmulaiplan_next  = $this->rs[0][4];
	$this->ppo_targetselesai_next  = $this->rs[0][5];
}
		else     
{
    $this->ppo_tasktahapan_next  = '';
    $this->ppo_idtasktahapan_next  = '';
	$this->ppo_tahapanproject_next  = '';
	$this->ppo_status_next  = '';
	$this->ppo_tglmulaiplan_next  = '';
	$this->ppo_targetselesai_next  = '';
		}	

     $nm_select ="UPDATE TBL_PROJECT SET TP_STATUS = '2',  TP_PROSENTASE = round($this->prosen_total_satu ,2),  TP_TASKAKTIF = '$this->ppo_tasktahapan_next',  TP_TASKAKTIF_NUMBER = '$this->ppo_idtasktahapan_next',  TP_TAHAPANAKTIF = '$this->ppo_tahapanproject_next',  TP_TASKAKTIFSTATUS = '$this->ppo_status_next',  TP_TASKAKTIFPLANSTART = '$this->ppo_tglmulaiplan_next',  TP_TASKAKTIFPLANFINISH = '$this->ppo_targetselesai_next' WHERE TP_ID=$this->ppo_projectid "; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
$sql = "SELECT COUNT(TMT_ID) as JMLALLREC FROM AKSESSMR.TB_MASTERTAHAPAN_TASK
WHERE TMT_TAHAPANPROJECT='$this->ppo_tahapanproject' AND TMT_TASKTAMPLATE='$this->sc_temp_var_templateproject'";
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rfs = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rfs[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rfs = false;
          $this->rfs_erro = $this->Db->ErrorMsg();
      } 
;
if (isset($this->rfs[0][0]))     
{
    $jmlallrecord  = $this->rfs[0][0];
}

$check_sql = "SELECT COUNT(PPO_ID) AS JMLREC FROM TBL_PROJECT_DETAIL WHERE PPO_TAHAPANPROJECT='$this->ppo_tahapanproject' AND PPO_STATUS='$this->ppo_status' AND PPO_PROJECTID='$this->ppo_projectid'";
 
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
    $jmlrecord  = $this->rs[0][0];
	$hasil  = ($jmlrecord /$jmlallrecord )*100;
	

	if ($hasil =='100') {
				$update_progress = "UPDATE TBL_PROJECT_PROGRESS SET TPP_TGLSELESAIACTUAL='$this->ppo_tglselesaiactual',
TPP_PROSENTASEPROJECT = '$hasil',
     TPP_LASTUPDATE = now() WHERE TPP_IDPROJECT='$this->ppo_projectid' AND  TPP_PROJECTPHASE='$this->ppo_tahapanproject'";
				
     $nm_select = $update_progress; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
				} else 				
	
	{
$update_table  = 'TBL_PROJECT_PROGRESS';      
$update_where  = "TPP_IDPROJECT = '$this->ppo_projectid' and TPP_PROJECTPHASE = '$this->ppo_tahapanproject'"; 
$update_fields = array(   
     "TPP_PROSENTASEPROJECT = '$hasil'",
     "TPP_LASTUPDATE = now()");

$update_sql = 'UPDATE ' . $update_table
    . ' SET '   . implode(', ', $update_fields)
    . ' WHERE ' . $update_where;

     $nm_select = $update_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
}

} else {
	$error_message = 'data2 tidak ditemukan.'; 

 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $error_message;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_project_edit_update_main_updatetask_detail_mob' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $error_message;
 }
;
	}
if (isset($this->sc_temp_var_templateproject)) { $_SESSION['var_templateproject'] = $this->sc_temp_var_templateproject;}
if (isset($this->sc_temp_var_milestone)) { $_SESSION['var_milestone'] = $this->sc_temp_var_milestone;}
$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'off';
}
function close_tahapan_khusus_4()
{
$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_var_milestone)) {$this->sc_temp_var_milestone = (isset($_SESSION['var_milestone'])) ? $_SESSION['var_milestone'] : "";}
if (!isset($this->sc_temp_var_templateproject)) {$this->sc_temp_var_templateproject = (isset($_SESSION['var_templateproject'])) ? $_SESSION['var_templateproject'] : "";}
           
$jmltask = "SELECT TARGETWAKTU FROM TB_MASTER_TEMPLATE WHERE IDTEMPLATE='$this->sc_temp_var_templateproject'";
 
      $nm_select = $jmltask; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_jltask = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rs_jltask[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_jltask = false;
          $this->rs_jltask_erro = $this->Db->ErrorMsg();
      } 
;

if (isset($this->rs_jltask[0][0]))     
{
    $rec_rs_jltask  = $this->rs_jltask[0][0];
}
$this->prosen_total_satu  = ($this->sc_temp_var_milestone/$rec_rs_jltask )*100;

$sql = "SELECT COUNT(TMT_ID) as JMLALLREC FROM TB_MASTERTAHAPAN_TASK
WHERE TMT_TAHAPANPROJECT='$this->ppo_tahapanproject' AND TMT_TASKTAMPLATE='$this->sc_temp_var_templateproject'";
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rfs = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rfs[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rfs = false;
          $this->rfs_erro = $this->Db->ErrorMsg();
      } 
;
if (isset($this->rfs[0][0]))     
{
    $jmlallrecord  = $this->rfs[0][0];
}
$check_sql = "SELECT COUNT(PPO_ID) AS JMLREC FROM TBL_PROJECT_DETAIL WHERE PPO_TAHAPANPROJECT='$this->ppo_tahapanproject' AND PPO_STATUS='$this->ppo_status' AND PPO_PROJECTID='$this->ppo_projectid'";
 
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
    $jmlrecord  = $this->rs[0][0];
	$this->hasil  = ($jmlrecord /$jmlallrecord )*100;

	if ($this->hasil =='100'){	

     $nm_select ="UPDATE TBL_PROJECT SET       TP_STATUS = 1,  	TP_ACTUALFINISH = '$this->ppo_tglselesaiactual',  	TP_PROSENTASE = round($this->prosen_total_satu ,2),  	TP_TASKAKTIF = '',  	TP_TASKAKTIF_NUMBER = null,  	TP_TAHAPANAKTIF = '',  	TP_TASKAKTIFSTATUS = null,  	TP_TASKAKTIFPLANSTART = null,  	TP_TASKAKTIFPLANFINISH = null WHERE TP_ID = $this->ppo_projectid "; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;

     $nm_select ="UPDATE TBL_PROJECT_PROGRESS SET TPP_TGLSELESAIACTUAL='$this->ppo_tglselesaiactual',  TPP_PROSENTASEPROJECT = $this->hasil ,  TPP_LASTUPDATE = now()   WHERE TPP_IDPROJECT=$this->ppo_projectid  AND  TPP_PROJECTPHASE=$this->ppo_tahapanproject "; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
} else {

     $nm_select ="UPDATE TBL_PROJECT_PROGRESS SET TPP_TGLSELESAIACTUAL='$this->ppo_tglselesaiactual',  TPP_PROSENTASEPROJECT = $this->hasil ,  TPP_LASTUPDATE = now()   WHERE TPP_IDPROJECT=$this->ppo_projectid  AND  TPP_PROJECTPHASE=$this->ppo_tahapanproject "; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
$check_sql = "SELECT PPO_TASKTAHAPAN,PPO_IDTASKTAHAPAN,PPO_TAHAPANPROJECT,PPO_STATUS,PPO_TGLMULAIPLAN,PPO_TARGETSELESAI FROM TBL_PROJECT_DETAIL WHERE PPO_PROJECTID=$this->ppo_projectid  AND PPO_ID=$this->ppo_id +1";
 
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
    $this->ppo_tasktahapan_next  = $this->rs[0][0];
    $this->ppo_idtasktahapan_next  = $this->rs[0][1];
	$this->ppo_tahapanproject_next  = $this->rs[0][2];
	$this->ppo_status_next  = $this->rs[0][3];
	$this->ppo_tglmulaiplan_next  = $this->rs[0][4];
	$this->ppo_targetselesai_next  = $this->rs[0][5];
}
		else     
{
    $this->ppo_tasktahapan_next  = '';
    $this->ppo_idtasktahapan_next  = '';
	$this->ppo_tahapanproject_next  = '';
	$this->ppo_status_next  = '';		
	$this->ppo_tglmulaiplan_next  = '';
	$this->ppo_targetselesai_next  = '';
		}	

     $nm_select ="UPDATE TBL_PROJECT SET TP_STATUS = '2',  TP_PROSENTASE = round($this->prosen_total_satu ,2),  TP_TASKAKTIF = '$this->ppo_tasktahapan_next',  TP_TASKAKTIF_NUMBER = '$this->ppo_idtasktahapan_next',  TP_TAHAPANAKTIF = '$this->ppo_tahapanproject_next',  TP_TASKAKTIFSTATUS = '$this->ppo_status_next',  TP_TASKAKTIFPLANSTART = '$this->ppo_tglmulaiplan_next',  TP_TASKAKTIFPLANFINISH = '$this->ppo_targetselesai_next' WHERE TP_ID=$this->ppo_projectid "; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
		}
					} else {
	$error_message = 'data1 tidak ditemukan.'; 

 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $error_message;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_project_edit_update_main_updatetask_detail_mob' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $error_message;
 }
;
	}
if (isset($this->sc_temp_var_templateproject)) { $_SESSION['var_templateproject'] = $this->sc_temp_var_templateproject;}
if (isset($this->sc_temp_var_milestone)) { $_SESSION['var_milestone'] = $this->sc_temp_var_milestone;}
$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'off';
}
function inprogress_2()
{
$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'on';
           

     $nm_select ="UPDATE TBL_PROJECT SET TP_TASKAKTIF = '$this->ppo_tasktahapan',       TP_TASKAKTIF_NUMBER = '$this->ppo_idtasktahapan',TP_TAHAPANAKTIF = '$this->ppo_tahapanproject', TP_TASKAKTIFSTATUS = '2' ,TP_TASKAKTIFPLANSTART = '$this->ppo_tglmulaiplan',  TP_TASKAKTIFPLANFINISH = '$this->ppo_targetselesai' WHERE TP_ID = $this->ppo_projectid "; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'off';
}
function pending_4()
{
$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'on';
           

     $nm_select ="UPDATE TBL_PROJECT SET TP_TASKAKTIF = '$this->ppo_tasktahapan',       TP_TASKAKTIF_NUMBER = '$this->ppo_idtasktahapan',TP_TAHAPANAKTIF = '$this->ppo_tahapanproject', TP_TASKAKTIFSTATUS = '4',TP_TASKAKTIFPLANSTART = '$this->ppo_tglmulaiplan',  TP_TASKAKTIFPLANFINISH = '$this->ppo_targetselesai' WHERE TP_ID = $this->ppo_projectid "; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
$_SESSION['scriptcase']['project_edit_update_main_updatetask_detail_mob']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
//-- 
   if ($this->ppo_evident_one != "" && $this->ppo_evident_one != "none")   
   { 
       $sTmpExtension = pathinfo($this->ppo_evident_one, PATHINFO_EXTENSION);
       $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
       $sTmpFile_ppo_evident_one = 'sc_ppo_evident_one_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['download_filenames'][$sTmpFile_ppo_evident_one] = $this->ppo_evident_one;
   } 
        $this->initFormPages();
    include_once("project_edit_update_main_updatetask_detail_mob_form0.php");
        $this->hideFormPages();
 }

        function initFormPages() {
        } // initFormPages

        function hideFormPages() {
        } // hideFormPages

    function form_encode_input($string)
    {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['csrf_token'];
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

   function Form_lookup_ppo_status()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'] = array(); 
    }

   $old_value_ppo_tglmulaiactual = $this->ppo_tglmulaiactual;
   $old_value_ppo_tglselesaiactual = $this->ppo_tglselesaiactual;
   $old_value_ppo_projectid = $this->ppo_projectid;
   $old_value_ppo_idtasktahapan = $this->ppo_idtasktahapan;
   $old_value_ppo_tglmulaiplan = $this->ppo_tglmulaiplan;
   $old_value_ppo_targethari = $this->ppo_targethari;
   $old_value_ppo_targetselesai = $this->ppo_targetselesai;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_ppo_tglmulaiactual = $this->ppo_tglmulaiactual;
   $unformatted_value_ppo_tglselesaiactual = $this->ppo_tglselesaiactual;
   $unformatted_value_ppo_projectid = $this->ppo_projectid;
   $unformatted_value_ppo_idtasktahapan = $this->ppo_idtasktahapan;
   $unformatted_value_ppo_tglmulaiplan = $this->ppo_tglmulaiplan;
   $unformatted_value_ppo_targethari = $this->ppo_targethari;
   $unformatted_value_ppo_targetselesai = $this->ppo_targetselesai;

   $nm_comando = "SELECT STATUSID, STATUSNAME  FROM TB_TASKTSTATUS  ORDER BY STATUSNAME";

   $this->ppo_tglmulaiactual = $old_value_ppo_tglmulaiactual;
   $this->ppo_tglselesaiactual = $old_value_ppo_tglselesaiactual;
   $this->ppo_projectid = $old_value_ppo_projectid;
   $this->ppo_idtasktahapan = $old_value_ppo_idtasktahapan;
   $this->ppo_tglmulaiplan = $old_value_ppo_tglmulaiplan;
   $this->ppo_targethari = $old_value_ppo_targethari;
   $this->ppo_targetselesai = $old_value_ppo_targetselesai;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['Lookup_ppo_status'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function SC_fast_search($field, $arg_search, $data_search)
   {
      if (empty($data_search)) 
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
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
          $this->SC_monta_condicao($comando, "PPO_ID", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_PROJECTID", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_TAHAPANPROJECT", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_TASKTAHAPAN", $arg_search, $data_search);
      }
      {
          $this->SC_monta_condicao($comando, "PPO_ENTRYDATE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_ENTRYBY", $arg_search, $data_search);
      }
      {
          $this->SC_monta_condicao($comando, "PPO_UPDATEDATE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_UPDATEBY", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_NOTE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_EVIDENT_ONE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_EVIDENT_TWO", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_EVIDENT_THREE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_ID", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $data_lookup = $this->SC_lookup_ppo_status($arg_search, $data_search);
          if (is_array($data_lookup) && !empty($data_lookup)) 
          {
              $this->SC_monta_condicao($comando, "PPO_STATUS", $arg_search, $data_lookup);
          }
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_EVIDENT_ONE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_NOTE", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_PROJECTID", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_TAHAPANPROJECT", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_IDTASKTAHAPAN", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_TASKTAHAPAN", $arg_search, $data_search);
      }
      if ($field == "SC_all_Cmp") 
      {
          $this->SC_monta_condicao($comando, "PPO_TARGETHARI", $arg_search, $data_search);
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter_form'] . " and (PPO_PROJECTID=" . $_SESSION['var_projectid'] . ") and (" . $comando . ")";
      }
      else
      {
          $sc_where = " where PPO_PROJECTID=" . $_SESSION['var_projectid'] . " and (" . $comando . ")";
      }
      $nmgp_select = "SELECT count(*) from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_project_edit_update_main_updatetask_detail_mob = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['total'] = $qt_geral_reg_project_edit_update_main_updatetask_detail_mob;
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
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
      $nm_numeric[] = "ppo_id";$nm_numeric[] = "ppo_projectid";$nm_numeric[] = "ppo_tahapanproject";$nm_numeric[] = "ppo_targethari";$nm_numeric[] = "ppo_tasknumber";$nm_numeric[] = "ppo_idtasktahapan";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['decimal_db'] == ".")
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
      $Nm_datas['ppo_entrydate'] = "date";$Nm_datas['ppo_updatedate'] = "date";$Nm_datas['ppo_tglmulaiplan'] = "date";$Nm_datas['ppo_targetselesai'] = "date";$Nm_datas['ppo_tglmulaiactual'] = "date";$Nm_datas['ppo_tglselesaiactual'] = "date";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['SC_sep_date1'];
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
       $nmgp_saida_form = "project_edit_update_main_updatetask_detail_mob_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['nm_run_menu'] = 2;
       $nmgp_saida_form = "project_edit_update_main_updatetask_detail_mob_fim.php";
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
       project_edit_update_main_updatetask_detail_mob_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail_mob']['masterValue']);
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
