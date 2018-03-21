<?php
//
class tracking_project_viewdetail_mob_apl
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
   var $tp_id;
   var $tp_batch;
   var $tp_batch_1;
   var $tp_projectname;
   var $tp_lokasi;
   var $tp_mitra;
   var $tp_mitra_1;
   var $tp_witel;
   var $tp_witel_1;
   var $tp_sto;
   var $tp_sto_1;
   var $tp_odp;
   var $tp_planstart;
   var $tp_planfinish;
   var $tp_entrydate;
   var $tp_entryby;
   var $tp_updatedate;
   var $tp_updateby;
   var $tp_summary;
   var $tp_status;
   var $tp_actualstart;
   var $tp_actualfinish;
   var $tp_templateproject;
   var $tp_templateproject_1;
   var $tp_jenisproject;
   var $tp_jenisproject_1;
   var $tp_prjtrelease;
   var $tp_prjtrelease_1;
   var $tp_targetwaktu;
   var $tp_datel;
   var $tp_datel_1;
   var $tp_nokontrak;
   var $tp_ponumber;
   var $tp_divre;
   var $tp_divre_1;
   var $tp_idlop;
   var $tp_namalop;
   var $tp_nilai;
   var $tp_rab;
   var $tp_is_change_template;
   var $tp_ischangetempby;
   var $tp_ischangetempdate;
   var $tp_jmldistribusi;
   var $tp_taskaktif;
   var $tp_taskaktif_number;
   var $tp_prosentase;
   var $tp_tahapanaktif;
   var $tp_taskaktifstatus;
   var $tp_taskaktifplanstart;
   var $tp_taskaktifplanfinish;
   var $tp_jmlport;
   var $tp_thn_release;
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
          if (isset($this->NM_ajax_info['param']['nmgp_refresh_fields']))
          {
              $this->nmgp_refresh_fields = $this->NM_ajax_info['param']['nmgp_refresh_fields'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['tp_actualfinish']))
          {
              $this->tp_actualfinish = $this->NM_ajax_info['param']['tp_actualfinish'];
          }
          if (isset($this->NM_ajax_info['param']['tp_actualstart']))
          {
              $this->tp_actualstart = $this->NM_ajax_info['param']['tp_actualstart'];
          }
          if (isset($this->NM_ajax_info['param']['tp_batch']))
          {
              $this->tp_batch = $this->NM_ajax_info['param']['tp_batch'];
          }
          if (isset($this->NM_ajax_info['param']['tp_datel']))
          {
              $this->tp_datel = $this->NM_ajax_info['param']['tp_datel'];
          }
          if (isset($this->NM_ajax_info['param']['tp_divre']))
          {
              $this->tp_divre = $this->NM_ajax_info['param']['tp_divre'];
          }
          if (isset($this->NM_ajax_info['param']['tp_entryby']))
          {
              $this->tp_entryby = $this->NM_ajax_info['param']['tp_entryby'];
          }
          if (isset($this->NM_ajax_info['param']['tp_entrydate']))
          {
              $this->tp_entrydate = $this->NM_ajax_info['param']['tp_entrydate'];
          }
          if (isset($this->NM_ajax_info['param']['tp_id']))
          {
              $this->tp_id = $this->NM_ajax_info['param']['tp_id'];
          }
          if (isset($this->NM_ajax_info['param']['tp_idlop']))
          {
              $this->tp_idlop = $this->NM_ajax_info['param']['tp_idlop'];
          }
          if (isset($this->NM_ajax_info['param']['tp_is_change_template']))
          {
              $this->tp_is_change_template = $this->NM_ajax_info['param']['tp_is_change_template'];
          }
          if (isset($this->NM_ajax_info['param']['tp_ischangetempby']))
          {
              $this->tp_ischangetempby = $this->NM_ajax_info['param']['tp_ischangetempby'];
          }
          if (isset($this->NM_ajax_info['param']['tp_ischangetempdate']))
          {
              $this->tp_ischangetempdate = $this->NM_ajax_info['param']['tp_ischangetempdate'];
          }
          if (isset($this->NM_ajax_info['param']['tp_jenisproject']))
          {
              $this->tp_jenisproject = $this->NM_ajax_info['param']['tp_jenisproject'];
          }
          if (isset($this->NM_ajax_info['param']['tp_jmldistribusi']))
          {
              $this->tp_jmldistribusi = $this->NM_ajax_info['param']['tp_jmldistribusi'];
          }
          if (isset($this->NM_ajax_info['param']['tp_jmlport']))
          {
              $this->tp_jmlport = $this->NM_ajax_info['param']['tp_jmlport'];
          }
          if (isset($this->NM_ajax_info['param']['tp_lokasi']))
          {
              $this->tp_lokasi = $this->NM_ajax_info['param']['tp_lokasi'];
          }
          if (isset($this->NM_ajax_info['param']['tp_mitra']))
          {
              $this->tp_mitra = $this->NM_ajax_info['param']['tp_mitra'];
          }
          if (isset($this->NM_ajax_info['param']['tp_namalop']))
          {
              $this->tp_namalop = $this->NM_ajax_info['param']['tp_namalop'];
          }
          if (isset($this->NM_ajax_info['param']['tp_nilai']))
          {
              $this->tp_nilai = $this->NM_ajax_info['param']['tp_nilai'];
          }
          if (isset($this->NM_ajax_info['param']['tp_nokontrak']))
          {
              $this->tp_nokontrak = $this->NM_ajax_info['param']['tp_nokontrak'];
          }
          if (isset($this->NM_ajax_info['param']['tp_odp']))
          {
              $this->tp_odp = $this->NM_ajax_info['param']['tp_odp'];
          }
          if (isset($this->NM_ajax_info['param']['tp_planfinish']))
          {
              $this->tp_planfinish = $this->NM_ajax_info['param']['tp_planfinish'];
          }
          if (isset($this->NM_ajax_info['param']['tp_planstart']))
          {
              $this->tp_planstart = $this->NM_ajax_info['param']['tp_planstart'];
          }
          if (isset($this->NM_ajax_info['param']['tp_ponumber']))
          {
              $this->tp_ponumber = $this->NM_ajax_info['param']['tp_ponumber'];
          }
          if (isset($this->NM_ajax_info['param']['tp_prjtrelease']))
          {
              $this->tp_prjtrelease = $this->NM_ajax_info['param']['tp_prjtrelease'];
          }
          if (isset($this->NM_ajax_info['param']['tp_projectname']))
          {
              $this->tp_projectname = $this->NM_ajax_info['param']['tp_projectname'];
          }
          if (isset($this->NM_ajax_info['param']['tp_prosentase']))
          {
              $this->tp_prosentase = $this->NM_ajax_info['param']['tp_prosentase'];
          }
          if (isset($this->NM_ajax_info['param']['tp_rab']))
          {
              $this->tp_rab = $this->NM_ajax_info['param']['tp_rab'];
          }
          if (isset($this->NM_ajax_info['param']['tp_status']))
          {
              $this->tp_status = $this->NM_ajax_info['param']['tp_status'];
          }
          if (isset($this->NM_ajax_info['param']['tp_sto']))
          {
              $this->tp_sto = $this->NM_ajax_info['param']['tp_sto'];
          }
          if (isset($this->NM_ajax_info['param']['tp_summary']))
          {
              $this->tp_summary = $this->NM_ajax_info['param']['tp_summary'];
          }
          if (isset($this->NM_ajax_info['param']['tp_tahapanaktif']))
          {
              $this->tp_tahapanaktif = $this->NM_ajax_info['param']['tp_tahapanaktif'];
          }
          if (isset($this->NM_ajax_info['param']['tp_targetwaktu']))
          {
              $this->tp_targetwaktu = $this->NM_ajax_info['param']['tp_targetwaktu'];
          }
          if (isset($this->NM_ajax_info['param']['tp_taskaktif']))
          {
              $this->tp_taskaktif = $this->NM_ajax_info['param']['tp_taskaktif'];
          }
          if (isset($this->NM_ajax_info['param']['tp_taskaktif_number']))
          {
              $this->tp_taskaktif_number = $this->NM_ajax_info['param']['tp_taskaktif_number'];
          }
          if (isset($this->NM_ajax_info['param']['tp_taskaktifplanfinish']))
          {
              $this->tp_taskaktifplanfinish = $this->NM_ajax_info['param']['tp_taskaktifplanfinish'];
          }
          if (isset($this->NM_ajax_info['param']['tp_taskaktifplanstart']))
          {
              $this->tp_taskaktifplanstart = $this->NM_ajax_info['param']['tp_taskaktifplanstart'];
          }
          if (isset($this->NM_ajax_info['param']['tp_taskaktifstatus']))
          {
              $this->tp_taskaktifstatus = $this->NM_ajax_info['param']['tp_taskaktifstatus'];
          }
          if (isset($this->NM_ajax_info['param']['tp_templateproject']))
          {
              $this->tp_templateproject = $this->NM_ajax_info['param']['tp_templateproject'];
          }
          if (isset($this->NM_ajax_info['param']['tp_thn_release']))
          {
              $this->tp_thn_release = $this->NM_ajax_info['param']['tp_thn_release'];
          }
          if (isset($this->NM_ajax_info['param']['tp_updateby']))
          {
              $this->tp_updateby = $this->NM_ajax_info['param']['tp_updateby'];
          }
          if (isset($this->NM_ajax_info['param']['tp_updatedate']))
          {
              $this->tp_updatedate = $this->NM_ajax_info['param']['tp_updatedate'];
          }
          if (isset($this->NM_ajax_info['param']['tp_witel']))
          {
              $this->tp_witel = $this->NM_ajax_info['param']['tp_witel'];
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
      if (isset($this->idwitel) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['idwitel'] = $this->idwitel;
      }
      if (isset($this->usr_login) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($this->iddivre) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['iddivre'] = $this->iddivre;
      }
      if (isset($_POST["var_projectid"]) && isset($this->var_projectid)) 
      {
          $_SESSION['var_projectid'] = $this->var_projectid;
      }
      if (isset($_POST["idwitel"]) && isset($this->idwitel)) 
      {
          $_SESSION['idwitel'] = $this->idwitel;
      }
      if (isset($_POST["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_POST["iddivre"]) && isset($this->iddivre)) 
      {
          $_SESSION['iddivre'] = $this->iddivre;
      }
      if (isset($_GET["var_projectid"]) && isset($this->var_projectid)) 
      {
          $_SESSION['var_projectid'] = $this->var_projectid;
      }
      if (isset($_GET["idwitel"]) && isset($this->idwitel)) 
      {
          $_SESSION['idwitel'] = $this->idwitel;
      }
      if (isset($_GET["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_GET["iddivre"]) && isset($this->iddivre)) 
      {
          $_SESSION['iddivre'] = $this->iddivre;
      }
      if (isset($this->nm_run_menu) && $this->nm_run_menu == 1)
      { 
          $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['nm_run_menu'] = 1;
      } 
      if (isset($_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['embutida_parms']);
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
                 nm_limpa_str_tracking_project_viewdetail_mob($cadapar[1]);
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
          if (isset($this->idwitel)) 
          {
              $_SESSION['idwitel'] = $this->idwitel;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
          if (isset($this->iddivre)) 
          {
              $_SESSION['iddivre'] = $this->iddivre;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['sc_redir_insert'] = $this->sc_redir_insert;
          }
          if (isset($this->var_projectid)) 
          {
              $_SESSION['var_projectid'] = $this->var_projectid;
          }
          if (isset($this->idwitel)) 
          {
              $_SESSION['idwitel'] = $this->idwitel;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
          if (isset($this->iddivre)) 
          {
              $_SESSION['iddivre'] = $this->iddivre;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new tracking_project_viewdetail_mob_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("en_us");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['initialize'];
          if (isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail']))
          {
              foreach ($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail'] as $I_conf => $Conf_opt)
              {
                  $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob'][$I_conf]  = $Conf_opt;
              }
          }
      } 
      else 
      { 
         $this->nm_data = new nm_data("en_us");
      } 
      $_SESSION['sc_session'][$script_case_init]['tracking_project_viewdetail_mob']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['tracking_project_viewdetail_mob']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['tracking_project_viewdetail_mob'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['tracking_project_viewdetail_mob']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['tracking_project_viewdetail_mob']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('tracking_project_viewdetail_mob') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['tracking_project_viewdetail_mob']['label'] = "Form Update Data Proyek";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "tracking_project_viewdetail_mob")
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



      $_SESSION['scriptcase']['error_icon']['tracking_project_viewdetail_mob']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['tracking_project_viewdetail_mob'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_call'] : $this->Embutida_call;

       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['new']  = "off";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['insert'] = "off";
      $this->nmgp_botoes['update'] = "off";
      $this->nmgp_botoes['delete'] = "off";
      $this->nmgp_botoes['first'] = "off";
      $this->nmgp_botoes['back'] = "off";
      $this->nmgp_botoes['forward'] = "off";
      $this->nmgp_botoes['last'] = "off";
      $this->nmgp_botoes['summary'] = "off";
      $this->nmgp_botoes['navpage'] = "off";
      $this->nmgp_botoes['goto'] = "off";
      $this->nmgp_botoes['qtline'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_orig'] = " where TP_ID=" . $_SESSION['var_projectid'] . "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_pesq'] = " where TP_ID=" . $_SESSION['var_projectid'] . "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['tracking_project_viewdetail_mob']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['tracking_project_viewdetail_mob'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['tracking_project_viewdetail_mob'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['exit'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dados_form'];
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("tracking_project_viewdetail_mob", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
              include_once($this->Ini->path_embutida . 'tracking_project_viewdetail/tracking_project_viewdetail_mob_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'tracking_project_viewdetail_mob_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'tracking_project_viewdetail_mob_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'tracking_project_viewdetail_mob_help.txt');
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
          require_once($this->Ini->path_embutida . 'tracking_project_viewdetail/tracking_project_viewdetail_mob_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "tracking_project_viewdetail_mob_erro.class.php"); 
      }
      $this->Erro      = new tracking_project_viewdetail_mob_erro();
      $this->Erro->Ini = $this->Ini;
      if ($nm_opc_lookup != "lookup" && $nm_opc_php != "formphp")
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opcao']))
         { 
             if ($this->tp_id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['tracking_project_viewdetail_mob']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opc_ant'];
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->sc_evento = $this->nmgp_opcao;
      if (isset($this->tp_id)) { $this->nm_limpa_alfa($this->tp_id); }
      if (isset($this->tp_batch)) { $this->nm_limpa_alfa($this->tp_batch); }
      if (isset($this->tp_projectname)) { $this->nm_limpa_alfa($this->tp_projectname); }
      if (isset($this->tp_lokasi)) { $this->nm_limpa_alfa($this->tp_lokasi); }
      if (isset($this->tp_mitra)) { $this->nm_limpa_alfa($this->tp_mitra); }
      if (isset($this->tp_witel)) { $this->nm_limpa_alfa($this->tp_witel); }
      if (isset($this->tp_sto)) { $this->nm_limpa_alfa($this->tp_sto); }
      if (isset($this->tp_odp)) { $this->nm_limpa_alfa($this->tp_odp); }
      if (isset($this->tp_entryby)) { $this->nm_limpa_alfa($this->tp_entryby); }
      if (isset($this->tp_updateby)) { $this->nm_limpa_alfa($this->tp_updateby); }
      if (isset($this->tp_status)) { $this->nm_limpa_alfa($this->tp_status); }
      if (isset($this->tp_templateproject)) { $this->nm_limpa_alfa($this->tp_templateproject); }
      if (isset($this->tp_jenisproject)) { $this->nm_limpa_alfa($this->tp_jenisproject); }
      if (isset($this->tp_prjtrelease)) { $this->nm_limpa_alfa($this->tp_prjtrelease); }
      if (isset($this->tp_targetwaktu)) { $this->nm_limpa_alfa($this->tp_targetwaktu); }
      if (isset($this->tp_datel)) { $this->nm_limpa_alfa($this->tp_datel); }
      if (isset($this->tp_nokontrak)) { $this->nm_limpa_alfa($this->tp_nokontrak); }
      if (isset($this->tp_ponumber)) { $this->nm_limpa_alfa($this->tp_ponumber); }
      if (isset($this->tp_divre)) { $this->nm_limpa_alfa($this->tp_divre); }
      if (isset($this->tp_idlop)) { $this->nm_limpa_alfa($this->tp_idlop); }
      if (isset($this->tp_namalop)) { $this->nm_limpa_alfa($this->tp_namalop); }
      if (isset($this->tp_nilai)) { $this->nm_limpa_alfa($this->tp_nilai); }
      if (isset($this->tp_rab)) { $this->nm_limpa_alfa($this->tp_rab); }
      if (isset($this->tp_is_change_template)) { $this->nm_limpa_alfa($this->tp_is_change_template); }
      if (isset($this->tp_ischangetempby)) { $this->nm_limpa_alfa($this->tp_ischangetempby); }
      if (isset($this->tp_jmldistribusi)) { $this->nm_limpa_alfa($this->tp_jmldistribusi); }
      if (isset($this->tp_taskaktif)) { $this->nm_limpa_alfa($this->tp_taskaktif); }
      if (isset($this->tp_taskaktif_number)) { $this->nm_limpa_alfa($this->tp_taskaktif_number); }
      if (isset($this->tp_prosentase)) { $this->nm_limpa_alfa($this->tp_prosentase); }
      if (isset($this->tp_tahapanaktif)) { $this->nm_limpa_alfa($this->tp_tahapanaktif); }
      if (isset($this->tp_taskaktifstatus)) { $this->nm_limpa_alfa($this->tp_taskaktifstatus); }
      if (isset($this->tp_jmlport)) { $this->nm_limpa_alfa($this->tp_jmlport); }
      if (isset($this->tp_thn_release)) { $this->nm_limpa_alfa($this->tp_thn_release); }
      if ($nm_opc_lookup == "lookup")
      { 
          if ($GLOBALS['F'] == "tp_status")
          { 
              $nm_parms   = substr($GLOBALS['P0'], 1, strlen($GLOBALS['P0']) - 2);
              $array_vars = explode(",", $nm_parms);
              $this->tp_status = $array_vars[0];
              $tp_status       = $this->tp_status;
              $this->tp_status       = $tp_status;
              $this->lookup_tp_status($conteudo);
              $conteudo = str_replace("&", "&amp;", $conteudo); 
              $conteudo = str_replace("\/" , "\/", $conteudo); 
              echo "<html><head></head>";
              echo " <body onload=\"p=document.layers?parentLayer:window.parent;p.jsrsLoaded('" . $GLOBALS['C'] . "');\">";
              echo "  jsrsPayload:";
              echo "  <br>";
              echo "  <form name=\"jsrs_Form\"><textarea name=\"jsrs_Payload\">";
              echo "$conteudo";
              echo " </textarea></form></body></html>";
          } 
          $this->NM_close_db(); 
          exit;
      } 
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- tp_id
      $this->field_config['tp_id']               = array();
      $this->field_config['tp_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tp_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tp_id']['symbol_dec'] = '';
      $this->field_config['tp_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tp_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tp_targetwaktu
      $this->field_config['tp_targetwaktu']               = array();
      $this->field_config['tp_targetwaktu']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tp_targetwaktu']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tp_targetwaktu']['symbol_dec'] = '';
      $this->field_config['tp_targetwaktu']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tp_targetwaktu']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tp_prosentase
      $this->field_config['tp_prosentase']               = array();
      $this->field_config['tp_prosentase']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tp_prosentase']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tp_prosentase']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_num'];
      $this->field_config['tp_prosentase']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tp_prosentase']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tp_planstart
      $this->field_config['tp_planstart']                 = array();
      $this->field_config['tp_planstart']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tp_planstart']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tp_planstart']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tp_planstart');
      //-- tp_planfinish
      $this->field_config['tp_planfinish']                 = array();
      $this->field_config['tp_planfinish']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tp_planfinish']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tp_planfinish']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tp_planfinish');
      //-- tp_nilai
      $this->field_config['tp_nilai']               = array();
      $this->field_config['tp_nilai']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tp_nilai']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tp_nilai']['symbol_dec'] = '';
      $this->field_config['tp_nilai']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tp_nilai']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tp_rab
      $this->field_config['tp_rab']               = array();
      $this->field_config['tp_rab']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tp_rab']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tp_rab']['symbol_dec'] = '';
      $this->field_config['tp_rab']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tp_rab']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tp_jmldistribusi
      $this->field_config['tp_jmldistribusi']               = array();
      $this->field_config['tp_jmldistribusi']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tp_jmldistribusi']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tp_jmldistribusi']['symbol_dec'] = '';
      $this->field_config['tp_jmldistribusi']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tp_jmldistribusi']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tp_odp
      $this->field_config['tp_odp']               = array();
      $this->field_config['tp_odp']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tp_odp']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tp_odp']['symbol_dec'] = '';
      $this->field_config['tp_odp']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tp_odp']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tp_jmlport
      $this->field_config['tp_jmlport']               = array();
      $this->field_config['tp_jmlport']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tp_jmlport']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tp_jmlport']['symbol_dec'] = '';
      $this->field_config['tp_jmlport']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tp_jmlport']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tp_actualstart
      $this->field_config['tp_actualstart']                 = array();
      $this->field_config['tp_actualstart']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tp_actualstart']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tp_actualstart']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tp_actualstart');
      //-- tp_actualfinish
      $this->field_config['tp_actualfinish']                 = array();
      $this->field_config['tp_actualfinish']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tp_actualfinish']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tp_actualfinish']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tp_actualfinish');
      //-- tp_entrydate
      $this->field_config['tp_entrydate']                 = array();
      $this->field_config['tp_entrydate']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tp_entrydate']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tp_entrydate']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tp_entrydate');
      //-- tp_updatedate
      $this->field_config['tp_updatedate']                 = array();
      $this->field_config['tp_updatedate']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tp_updatedate']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tp_updatedate']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tp_updatedate');
      //-- tp_taskaktif_number
      $this->field_config['tp_taskaktif_number']               = array();
      $this->field_config['tp_taskaktif_number']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tp_taskaktif_number']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tp_taskaktif_number']['symbol_dec'] = '';
      $this->field_config['tp_taskaktif_number']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tp_taskaktif_number']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tp_taskaktifstatus
      $this->field_config['tp_taskaktifstatus']               = array();
      $this->field_config['tp_taskaktifstatus']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['tp_taskaktifstatus']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['tp_taskaktifstatus']['symbol_dec'] = '';
      $this->field_config['tp_taskaktifstatus']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['tp_taskaktifstatus']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- tp_taskaktifplanstart
      $this->field_config['tp_taskaktifplanstart']                 = array();
      $this->field_config['tp_taskaktifplanstart']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tp_taskaktifplanstart']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tp_taskaktifplanstart']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tp_taskaktifplanstart');
      //-- tp_taskaktifplanfinish
      $this->field_config['tp_taskaktifplanfinish']                 = array();
      $this->field_config['tp_taskaktifplanfinish']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tp_taskaktifplanfinish']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tp_taskaktifplanfinish']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tp_taskaktifplanfinish');
      //-- tp_ischangetempdate
      $this->field_config['tp_ischangetempdate']                 = array();
      $this->field_config['tp_ischangetempdate']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['tp_ischangetempdate']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['tp_ischangetempdate']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'tp_ischangetempdate');
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
          if ('validate_tp_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_id');
          }
          if ('validate_tp_thn_release' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_thn_release');
          }
          if ('validate_tp_prjtrelease' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_prjtrelease');
          }
          if ('validate_tp_batch' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_batch');
          }
          if ('validate_tp_divre' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_divre');
          }
          if ('validate_tp_witel' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_witel');
          }
          if ('validate_tp_datel' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_datel');
          }
          if ('validate_tp_sto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_sto');
          }
          if ('validate_tp_idlop' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_idlop');
          }
          if ('validate_tp_namalop' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_namalop');
          }
          if ('validate_tp_mitra' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_mitra');
          }
          if ('validate_tp_templateproject' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_templateproject');
          }
          if ('validate_tp_targetwaktu' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_targetwaktu');
          }
          if ('validate_tp_jenisproject' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_jenisproject');
          }
          if ('validate_tp_projectname' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_projectname');
          }
          if ('validate_tp_status' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_status');
          }
          if ('validate_tp_prosentase' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_prosentase');
          }
          if ('validate_tp_planstart' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_planstart');
          }
          if ('validate_tp_planfinish' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_planfinish');
          }
          if ('validate_tp_lokasi' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_lokasi');
          }
          if ('validate_tp_nokontrak' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_nokontrak');
          }
          if ('validate_tp_ponumber' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_ponumber');
          }
          if ('validate_tp_nilai' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_nilai');
          }
          if ('validate_tp_summary' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_summary');
          }
          if ('validate_tp_rab' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_rab');
          }
          if ('validate_tp_jmldistribusi' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_jmldistribusi');
          }
          if ('validate_tp_odp' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_odp');
          }
          if ('validate_tp_jmlport' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_jmlport');
          }
          if ('validate_tp_actualstart' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_actualstart');
          }
          if ('validate_tp_actualfinish' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_actualfinish');
          }
          if ('validate_tp_entrydate' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_entrydate');
          }
          if ('validate_tp_entryby' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_entryby');
          }
          if ('validate_tp_updatedate' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_updatedate');
          }
          if ('validate_tp_updateby' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_updateby');
          }
          if ('validate_tp_taskaktif' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_taskaktif');
          }
          if ('validate_tp_taskaktif_number' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_taskaktif_number');
          }
          if ('validate_tp_tahapanaktif' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_tahapanaktif');
          }
          if ('validate_tp_taskaktifstatus' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_taskaktifstatus');
          }
          if ('validate_tp_taskaktifplanstart' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_taskaktifplanstart');
          }
          if ('validate_tp_taskaktifplanfinish' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_taskaktifplanfinish');
          }
          if ('validate_tp_is_change_template' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_is_change_template');
          }
          if ('validate_tp_ischangetempby' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_ischangetempby');
          }
          if ('validate_tp_ischangetempdate' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'tp_ischangetempdate');
          }
          tracking_project_viewdetail_mob_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_tp_odp_onchange' == $this->NM_ajax_opcao)
          {
              $this->TP_ODP_onChange();
          }
          if ('event_tp_planstart_onchange' == $this->NM_ajax_opcao)
          {
              $this->TP_PLANSTART_onChange();
          }
          if ('event_tp_templateproject_onchange' == $this->NM_ajax_opcao)
          {
              $this->TP_TEMPLATEPROJECT_onChange();
          }
          tracking_project_viewdetail_mob_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              tracking_project_viewdetail_mob_pack_ajax_response();
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
          if ($this->nmgp_opcao != "incluir")
          {
              $this->scFormFocusErrorName = '';
          }
          $_SESSION['scriptcase']['tracking_project_viewdetail_mob']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  tracking_project_viewdetail_mob_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['recarga'] = $this->nmgp_opcao;
      }
      if ($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao)
      {
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          tracking_project_viewdetail_mob_pack_ajax_response();
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
          tracking_project_viewdetail_mob_pack_ajax_response();
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
   function lookup_tp_status(&$conteudo)
   {
      global  $tp_status;
      $this->nm_tira_formatacao();
      $this->formatado = false;
      $Salva_opc = $this->nmgp_opcao;
      $this->nmgp_opcao = "lookup_rpc";
      $this->nm_converte_datas();
      $this->nmgp_opcao = $Salva_opc;
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      $nm_comando = "SELECT STATUSNAME 
FROM TB_PROJECTSTATUS 
WHERE STATUSID = $this->tp_status 
ORDER BY STATUSNAME"; 
      if ($this->tp_status == "")
      { 
          $conteudo = ""; 
          $this->nm_formatar_campos();
          return; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      {
          $conteudo = (isset($rs->fields[0])) ? $rs->fields[0] : ""; 
          $rs->Close() ; 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      {  
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0; 
      $this->nm_formatar_campos();
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
           case 'tp_id':
               return "ID Project";
               break;
           case 'tp_thn_release':
               return "Project Release";
               break;
           case 'tp_prjtrelease':
               return "Sub-Release";
               break;
           case 'tp_batch':
               return "Batch";
               break;
           case 'tp_divre':
               return "Divre";
               break;
           case 'tp_witel':
               return "Witel";
               break;
           case 'tp_datel':
               return "Datel";
               break;
           case 'tp_sto':
               return "STO";
               break;
           case 'tp_idlop':
               return "ID LOP";
               break;
           case 'tp_namalop':
               return "Nama LOP";
               break;
           case 'tp_mitra':
               return "Mitra";
               break;
           case 'tp_templateproject':
               return "Project Template";
               break;
           case 'tp_targetwaktu':
               return "Target(hari)";
               break;
           case 'tp_jenisproject':
               return "Jenis Project";
               break;
           case 'tp_projectname':
               return "Nama Project";
               break;
           case 'tp_status':
               return "Status Project";
               break;
           case 'tp_prosentase':
               return "Prosentasi Project";
               break;
           case 'tp_planstart':
               return "Tgl Mulai(Plan)";
               break;
           case 'tp_planfinish':
               return "Tgl Selesai(Plan)";
               break;
           case 'tp_lokasi':
               return "Lokasi";
               break;
           case 'tp_nokontrak':
               return "No.Kontrak";
               break;
           case 'tp_ponumber':
               return "PO.Number";
               break;
           case 'tp_nilai':
               return "Nilai Rekon";
               break;
           case 'tp_summary':
               return "Deskripsi Project";
               break;
           case 'tp_rab':
               return "Nilai DRM";
               break;
           case 'tp_jmldistribusi':
               return "Jml Distribusi";
               break;
           case 'tp_odp':
               return "Jumlah ODP";
               break;
           case 'tp_jmlport':
               return "Jml Port";
               break;
           case 'tp_actualstart':
               return "Tgl Mulai(aktual)";
               break;
           case 'tp_actualfinish':
               return "Tgl Selesai(aktual)";
               break;
           case 'tp_entrydate':
               return "Tgl Entry";
               break;
           case 'tp_entryby':
               return "Entry Oleh";
               break;
           case 'tp_updatedate':
               return "Tgl Update";
               break;
           case 'tp_updateby':
               return "Update Oleh";
               break;
           case 'tp_taskaktif':
               return "Task Aktif";
               break;
           case 'tp_taskaktif_number':
               return "Task Aktif Number";
               break;
           case 'tp_tahapanaktif':
               return "Tahapan Aktif";
               break;
           case 'tp_taskaktifstatus':
               return "Task Aktif Status";
               break;
           case 'tp_taskaktifplanstart':
               return "Tgl Plan Mulai Task";
               break;
           case 'tp_taskaktifplanfinish':
               return "Tgl Plan Finish Task";
               break;
           case 'tp_is_change_template':
               return "Template Pernah Berubah?";
               break;
           case 'tp_ischangetempby':
               return "Yang mengubah Template";
               break;
           case 'tp_ischangetempdate':
               return "Tgl Mengubah Template";
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
     $this->scFormFocusErrorName = '';
     $this->sc_force_zero = array();

     if ('' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_tracking_project_viewdetail_mob']) || !is_array($this->NM_ajax_info['errList']['geral_tracking_project_viewdetail_mob']))
              {
                  $this->NM_ajax_info['errList']['geral_tracking_project_viewdetail_mob'] = array();
              }
              $this->NM_ajax_info['errList']['geral_tracking_project_viewdetail_mob'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ('' == $filtro || 'tp_id' == $filtro)
        $this->ValidateField_tp_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_id";

      if ('' == $filtro || 'tp_thn_release' == $filtro)
        $this->ValidateField_tp_thn_release($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_thn_release";

      if ('' == $filtro || 'tp_prjtrelease' == $filtro)
        $this->ValidateField_tp_prjtrelease($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_prjtrelease";

      if ('' == $filtro || 'tp_batch' == $filtro)
        $this->ValidateField_tp_batch($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_batch";

      if ('' == $filtro || 'tp_divre' == $filtro)
        $this->ValidateField_tp_divre($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_divre";

      if ('' == $filtro || 'tp_witel' == $filtro)
        $this->ValidateField_tp_witel($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_witel";

      if ('' == $filtro || 'tp_datel' == $filtro)
        $this->ValidateField_tp_datel($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_datel";

      if ('' == $filtro || 'tp_sto' == $filtro)
        $this->ValidateField_tp_sto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_sto";

      if ('' == $filtro || 'tp_idlop' == $filtro)
        $this->ValidateField_tp_idlop($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_idlop";

      if ('' == $filtro || 'tp_namalop' == $filtro)
        $this->ValidateField_tp_namalop($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_namalop";

      if ('' == $filtro || 'tp_mitra' == $filtro)
        $this->ValidateField_tp_mitra($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_mitra";

      if ('' == $filtro || 'tp_templateproject' == $filtro)
        $this->ValidateField_tp_templateproject($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_templateproject";

      if ('' == $filtro || 'tp_targetwaktu' == $filtro)
        $this->ValidateField_tp_targetwaktu($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_targetwaktu";

      if ('' == $filtro || 'tp_jenisproject' == $filtro)
        $this->ValidateField_tp_jenisproject($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_jenisproject";

      if ('' == $filtro || 'tp_projectname' == $filtro)
        $this->ValidateField_tp_projectname($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_projectname";

      if ('' == $filtro || 'tp_status' == $filtro)
        $this->ValidateField_tp_status($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_status";

      if ('' == $filtro || 'tp_prosentase' == $filtro)
        $this->ValidateField_tp_prosentase($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_prosentase";

      if ('' == $filtro || 'tp_planstart' == $filtro)
        $this->ValidateField_tp_planstart($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_planstart";

      if ('' == $filtro || 'tp_planfinish' == $filtro)
        $this->ValidateField_tp_planfinish($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_planfinish";

      if ('' == $filtro || 'tp_lokasi' == $filtro)
        $this->ValidateField_tp_lokasi($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_lokasi";

      if ('' == $filtro || 'tp_nokontrak' == $filtro)
        $this->ValidateField_tp_nokontrak($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_nokontrak";

      if ('' == $filtro || 'tp_ponumber' == $filtro)
        $this->ValidateField_tp_ponumber($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_ponumber";

      if ('' == $filtro || 'tp_nilai' == $filtro)
        $this->ValidateField_tp_nilai($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_nilai";

      if ('' == $filtro || 'tp_summary' == $filtro)
        $this->ValidateField_tp_summary($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_summary";

      if ('' == $filtro || 'tp_rab' == $filtro)
        $this->ValidateField_tp_rab($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_rab";

      if ('' == $filtro || 'tp_jmldistribusi' == $filtro)
        $this->ValidateField_tp_jmldistribusi($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_jmldistribusi";

      if ('' == $filtro || 'tp_odp' == $filtro)
        $this->ValidateField_tp_odp($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_odp";

      if ('' == $filtro || 'tp_jmlport' == $filtro)
        $this->ValidateField_tp_jmlport($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_jmlport";

      if ('' == $filtro || 'tp_actualstart' == $filtro)
        $this->ValidateField_tp_actualstart($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_actualstart";

      if ('' == $filtro || 'tp_actualfinish' == $filtro)
        $this->ValidateField_tp_actualfinish($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_actualfinish";

      if ('' == $filtro || 'tp_entrydate' == $filtro)
        $this->ValidateField_tp_entrydate($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_entrydate";

      if ('' == $filtro || 'tp_entryby' == $filtro)
        $this->ValidateField_tp_entryby($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_entryby";

      if ('' == $filtro || 'tp_updatedate' == $filtro)
        $this->ValidateField_tp_updatedate($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_updatedate";

      if ('' == $filtro || 'tp_updateby' == $filtro)
        $this->ValidateField_tp_updateby($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_updateby";

      if ('' == $filtro || 'tp_taskaktif' == $filtro)
        $this->ValidateField_tp_taskaktif($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_taskaktif";

      if ('' == $filtro || 'tp_taskaktif_number' == $filtro)
        $this->ValidateField_tp_taskaktif_number($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_taskaktif_number";

      if ('' == $filtro || 'tp_tahapanaktif' == $filtro)
        $this->ValidateField_tp_tahapanaktif($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_tahapanaktif";

      if ('' == $filtro || 'tp_taskaktifstatus' == $filtro)
        $this->ValidateField_tp_taskaktifstatus($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_taskaktifstatus";

      if ('' == $filtro || 'tp_taskaktifplanstart' == $filtro)
        $this->ValidateField_tp_taskaktifplanstart($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_taskaktifplanstart";

      if ('' == $filtro || 'tp_taskaktifplanfinish' == $filtro)
        $this->ValidateField_tp_taskaktifplanfinish($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_taskaktifplanfinish";

      if ('' == $filtro || 'tp_is_change_template' == $filtro)
        $this->ValidateField_tp_is_change_template($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_is_change_template";

      if ('' == $filtro || 'tp_ischangetempby' == $filtro)
        $this->ValidateField_tp_ischangetempby($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_ischangetempby";

      if ('' == $filtro || 'tp_ischangetempdate' == $filtro)
        $this->ValidateField_tp_ischangetempdate($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "tp_ischangetempdate";

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

    function ValidateField_tp_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_id == "")  
      { 
          $this->tp_id = 0;
      } 
      nm_limpa_numero($this->tp_id, $this->field_config['tp_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir")
      { 
          if ($this->tp_id != '')  
          { 
              $iTestSize = 10;
              if (strlen($this->tp_id) > $iTestSize)  
              { 
                  $Campos_Crit .= "ID Project: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tp_id']))
                  {
                      $Campos_Erros['tp_id'] = array();
                  }
                  $Campos_Erros['tp_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tp_id']) || !is_array($this->NM_ajax_info['errList']['tp_id']))
                  {
                      $this->NM_ajax_info['errList']['tp_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tp_id, 10, 0, 0, 0, "N") == false)  
              { 
                  $Campos_Crit .= "ID Project; " ; 
                  if (!isset($Campos_Erros['tp_id']))
                  {
                      $Campos_Erros['tp_id'] = array();
                  }
                  $Campos_Erros['tp_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_id']) || !is_array($this->NM_ajax_info['errList']['tp_id']))
                  {
                      $this->NM_ajax_info['errList']['tp_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_tp_id

    function ValidateField_tp_thn_release(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_thn_release) > 4) 
          { 
              $Campos_Crit .= "Project Release " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 4 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_thn_release']))
              {
                  $Campos_Erros['tp_thn_release'] = array();
              }
              $Campos_Erros['tp_thn_release'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 4 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_thn_release']) || !is_array($this->NM_ajax_info['errList']['tp_thn_release']))
              {
                  $this->NM_ajax_info['errList']['tp_thn_release'] = array();
              }
              $this->NM_ajax_info['errList']['tp_thn_release'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 4 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_thn_release

    function ValidateField_tp_prjtrelease(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_prjtrelease == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_prjtrelease']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_prjtrelease'] == "on"))
      {
          $Campos_Falta[] = "Sub-Release" ; 
          if (!isset($Campos_Erros['tp_prjtrelease']))
          {
              $Campos_Erros['tp_prjtrelease'] = array();
          }
          $Campos_Erros['tp_prjtrelease'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['tp_prjtrelease']) || !is_array($this->NM_ajax_info['errList']['tp_prjtrelease']))
          {
              $this->NM_ajax_info['errList']['tp_prjtrelease'] = array();
          }
          $this->NM_ajax_info['errList']['tp_prjtrelease'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->tp_prjtrelease) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease']) && !in_array($this->tp_prjtrelease, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease']))
          {
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['tp_prjtrelease']))
              {
                  $Campos_Erros['tp_prjtrelease'] = array();
              }
              $Campos_Erros['tp_prjtrelease'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['tp_prjtrelease']) || !is_array($this->NM_ajax_info['errList']['tp_prjtrelease']))
              {
                  $this->NM_ajax_info['errList']['tp_prjtrelease'] = array();
              }
              $this->NM_ajax_info['errList']['tp_prjtrelease'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
    } // ValidateField_tp_prjtrelease

    function ValidateField_tp_batch(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
               if (!empty($this->tp_batch) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch']) && !in_array($this->tp_batch, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch']))
               {
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['tp_batch']))
                   {
                       $Campos_Erros['tp_batch'] = array();
                   }
                   $Campos_Erros['tp_batch'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['tp_batch']) || !is_array($this->NM_ajax_info['errList']['tp_batch']))
                   {
                       $this->NM_ajax_info['errList']['tp_batch'] = array();
                   }
                   $this->NM_ajax_info['errList']['tp_batch'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
    } // ValidateField_tp_batch

    function ValidateField_tp_divre(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_divre == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_divre']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_divre'] == "on"))
      {
          $Campos_Falta[] = "Divre" ; 
          if (!isset($Campos_Erros['tp_divre']))
          {
              $Campos_Erros['tp_divre'] = array();
          }
          $Campos_Erros['tp_divre'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['tp_divre']) || !is_array($this->NM_ajax_info['errList']['tp_divre']))
          {
              $this->NM_ajax_info['errList']['tp_divre'] = array();
          }
          $this->NM_ajax_info['errList']['tp_divre'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->tp_divre) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre']) && !in_array($this->tp_divre, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre']))
          {
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['tp_divre']))
              {
                  $Campos_Erros['tp_divre'] = array();
              }
              $Campos_Erros['tp_divre'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['tp_divre']) || !is_array($this->NM_ajax_info['errList']['tp_divre']))
              {
                  $this->NM_ajax_info['errList']['tp_divre'] = array();
              }
              $this->NM_ajax_info['errList']['tp_divre'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
    } // ValidateField_tp_divre

    function ValidateField_tp_witel(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_witel == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_witel']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_witel'] == "on"))
      {
          $Campos_Falta[] = "Witel" ; 
          if (!isset($Campos_Erros['tp_witel']))
          {
              $Campos_Erros['tp_witel'] = array();
          }
          $Campos_Erros['tp_witel'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['tp_witel']) || !is_array($this->NM_ajax_info['errList']['tp_witel']))
          {
              $this->NM_ajax_info['errList']['tp_witel'] = array();
          }
          $this->NM_ajax_info['errList']['tp_witel'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->tp_witel) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel']) && !in_array($this->tp_witel, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel']))
          {
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['tp_witel']))
              {
                  $Campos_Erros['tp_witel'] = array();
              }
              $Campos_Erros['tp_witel'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['tp_witel']) || !is_array($this->NM_ajax_info['errList']['tp_witel']))
              {
                  $this->NM_ajax_info['errList']['tp_witel'] = array();
              }
              $this->NM_ajax_info['errList']['tp_witel'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
    } // ValidateField_tp_witel

    function ValidateField_tp_datel(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_datel == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_datel']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_datel'] == "on"))
      {
          $Campos_Falta[] = "Datel" ; 
          if (!isset($Campos_Erros['tp_datel']))
          {
              $Campos_Erros['tp_datel'] = array();
          }
          $Campos_Erros['tp_datel'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['tp_datel']) || !is_array($this->NM_ajax_info['errList']['tp_datel']))
          {
              $this->NM_ajax_info['errList']['tp_datel'] = array();
          }
          $this->NM_ajax_info['errList']['tp_datel'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->tp_datel) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel']) && !in_array($this->tp_datel, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel']))
          {
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['tp_datel']))
              {
                  $Campos_Erros['tp_datel'] = array();
              }
              $Campos_Erros['tp_datel'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['tp_datel']) || !is_array($this->NM_ajax_info['errList']['tp_datel']))
              {
                  $this->NM_ajax_info['errList']['tp_datel'] = array();
              }
              $this->NM_ajax_info['errList']['tp_datel'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
    } // ValidateField_tp_datel

    function ValidateField_tp_sto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_sto == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_sto']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_sto'] == "on"))
      {
          $Campos_Falta[] = "STO" ; 
          if (!isset($Campos_Erros['tp_sto']))
          {
              $Campos_Erros['tp_sto'] = array();
          }
          $Campos_Erros['tp_sto'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['tp_sto']) || !is_array($this->NM_ajax_info['errList']['tp_sto']))
          {
              $this->NM_ajax_info['errList']['tp_sto'] = array();
          }
          $this->NM_ajax_info['errList']['tp_sto'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->tp_sto) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto']) && !in_array($this->tp_sto, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto']))
          {
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['tp_sto']))
              {
                  $Campos_Erros['tp_sto'] = array();
              }
              $Campos_Erros['tp_sto'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['tp_sto']) || !is_array($this->NM_ajax_info['errList']['tp_sto']))
              {
                  $this->NM_ajax_info['errList']['tp_sto'] = array();
              }
              $this->NM_ajax_info['errList']['tp_sto'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
    } // ValidateField_tp_sto

    function ValidateField_tp_idlop(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_idlop) > 20) 
          { 
              $Campos_Crit .= "ID LOP " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_idlop']))
              {
                  $Campos_Erros['tp_idlop'] = array();
              }
              $Campos_Erros['tp_idlop'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_idlop']) || !is_array($this->NM_ajax_info['errList']['tp_idlop']))
              {
                  $this->NM_ajax_info['errList']['tp_idlop'] = array();
              }
              $this->NM_ajax_info['errList']['tp_idlop'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_idlop

    function ValidateField_tp_namalop(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      $this->tp_namalop = sc_strtolower($this->tp_namalop); 
      $this->tp_namalop = ucwords($this->tp_namalop) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_namalop) > 40) 
          { 
              $Campos_Crit .= "Nama LOP " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_namalop']))
              {
                  $Campos_Erros['tp_namalop'] = array();
              }
              $Campos_Erros['tp_namalop'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_namalop']) || !is_array($this->NM_ajax_info['errList']['tp_namalop']))
              {
                  $this->NM_ajax_info['errList']['tp_namalop'] = array();
              }
              $this->NM_ajax_info['errList']['tp_namalop'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 40 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
          $this->tp_namalop = ucwords($this->tp_namalop) ; 
      } 
    } // ValidateField_tp_namalop

    function ValidateField_tp_mitra(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_mitra == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_mitra']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_mitra'] == "on"))
      {
          $Campos_Falta[] = "Mitra" ; 
          if (!isset($Campos_Erros['tp_mitra']))
          {
              $Campos_Erros['tp_mitra'] = array();
          }
          $Campos_Erros['tp_mitra'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['tp_mitra']) || !is_array($this->NM_ajax_info['errList']['tp_mitra']))
          {
              $this->NM_ajax_info['errList']['tp_mitra'] = array();
          }
          $this->NM_ajax_info['errList']['tp_mitra'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->tp_mitra) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra']) && !in_array($this->tp_mitra, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra']))
          {
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['tp_mitra']))
              {
                  $Campos_Erros['tp_mitra'] = array();
              }
              $Campos_Erros['tp_mitra'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['tp_mitra']) || !is_array($this->NM_ajax_info['errList']['tp_mitra']))
              {
                  $this->NM_ajax_info['errList']['tp_mitra'] = array();
              }
              $this->NM_ajax_info['errList']['tp_mitra'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
    } // ValidateField_tp_mitra

    function ValidateField_tp_templateproject(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_templateproject == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_templateproject']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_templateproject'] == "on"))
      {
          $Campos_Falta[] = "Project Template" ; 
          if (!isset($Campos_Erros['tp_templateproject']))
          {
              $Campos_Erros['tp_templateproject'] = array();
          }
          $Campos_Erros['tp_templateproject'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['tp_templateproject']) || !is_array($this->NM_ajax_info['errList']['tp_templateproject']))
          {
              $this->NM_ajax_info['errList']['tp_templateproject'] = array();
          }
          $this->NM_ajax_info['errList']['tp_templateproject'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->tp_templateproject) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject']) && !in_array($this->tp_templateproject, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject']))
          {
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['tp_templateproject']))
              {
                  $Campos_Erros['tp_templateproject'] = array();
              }
              $Campos_Erros['tp_templateproject'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['tp_templateproject']) || !is_array($this->NM_ajax_info['errList']['tp_templateproject']))
              {
                  $this->NM_ajax_info['errList']['tp_templateproject'] = array();
              }
              $this->NM_ajax_info['errList']['tp_templateproject'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
    } // ValidateField_tp_templateproject

    function ValidateField_tp_targetwaktu(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_numero($this->tp_targetwaktu, $this->field_config['tp_targetwaktu']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tp_targetwaktu != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tp_targetwaktu) > $iTestSize)  
              { 
                  $Campos_Crit .= "Target(hari): " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tp_targetwaktu']))
                  {
                      $Campos_Erros['tp_targetwaktu'] = array();
                  }
                  $Campos_Erros['tp_targetwaktu'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tp_targetwaktu']) || !is_array($this->NM_ajax_info['errList']['tp_targetwaktu']))
                  {
                      $this->NM_ajax_info['errList']['tp_targetwaktu'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_targetwaktu'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tp_targetwaktu, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Target(hari); " ; 
                  if (!isset($Campos_Erros['tp_targetwaktu']))
                  {
                      $Campos_Erros['tp_targetwaktu'] = array();
                  }
                  $Campos_Erros['tp_targetwaktu'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_targetwaktu']) || !is_array($this->NM_ajax_info['errList']['tp_targetwaktu']))
                  {
                      $this->NM_ajax_info['errList']['tp_targetwaktu'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_targetwaktu'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_targetwaktu']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_targetwaktu'] == "on") 
           { 
              $Campos_Falta[] = "Target(hari)" ; 
              if (!isset($Campos_Erros['tp_targetwaktu']))
              {
                  $Campos_Erros['tp_targetwaktu'] = array();
              }
              $Campos_Erros['tp_targetwaktu'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tp_targetwaktu']) || !is_array($this->NM_ajax_info['errList']['tp_targetwaktu']))
                  {
                      $this->NM_ajax_info['errList']['tp_targetwaktu'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_targetwaktu'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
    } // ValidateField_tp_targetwaktu

    function ValidateField_tp_jenisproject(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_jenisproject == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_jenisproject']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_jenisproject'] == "on"))
      {
          $Campos_Falta[] = "Jenis Project" ; 
          if (!isset($Campos_Erros['tp_jenisproject']))
          {
              $Campos_Erros['tp_jenisproject'] = array();
          }
          $Campos_Erros['tp_jenisproject'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['tp_jenisproject']) || !is_array($this->NM_ajax_info['errList']['tp_jenisproject']))
          {
              $this->NM_ajax_info['errList']['tp_jenisproject'] = array();
          }
          $this->NM_ajax_info['errList']['tp_jenisproject'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->tp_jenisproject) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject']) && !in_array($this->tp_jenisproject, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject']))
          {
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['tp_jenisproject']))
              {
                  $Campos_Erros['tp_jenisproject'] = array();
              }
              $Campos_Erros['tp_jenisproject'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['tp_jenisproject']) || !is_array($this->NM_ajax_info['errList']['tp_jenisproject']))
              {
                  $this->NM_ajax_info['errList']['tp_jenisproject'] = array();
              }
              $this->NM_ajax_info['errList']['tp_jenisproject'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
    } // ValidateField_tp_jenisproject

    function ValidateField_tp_projectname(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_projectname']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_projectname'] == "on")) 
      { 
          if ($this->tp_projectname == "")  
          { 
              $Campos_Falta[] =  "Nama Project" ; 
              if (!isset($Campos_Erros['tp_projectname']))
              {
                  $Campos_Erros['tp_projectname'] = array();
              }
              $Campos_Erros['tp_projectname'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tp_projectname']) || !is_array($this->NM_ajax_info['errList']['tp_projectname']))
                  {
                      $this->NM_ajax_info['errList']['tp_projectname'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_projectname'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_projectname) > 100) 
          { 
              $Campos_Crit .= "Nama Project " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_projectname']))
              {
                  $Campos_Erros['tp_projectname'] = array();
              }
              $Campos_Erros['tp_projectname'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_projectname']) || !is_array($this->NM_ajax_info['errList']['tp_projectname']))
              {
                  $this->NM_ajax_info['errList']['tp_projectname'] = array();
              }
              $this->NM_ajax_info['errList']['tp_projectname'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_projectname

    function ValidateField_tp_status(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->tp_status) > 5) 
          { 
              $Campos_Crit .= "Status Project " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 5 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_status']))
              {
                  $Campos_Erros['tp_status'] = array();
              }
              $Campos_Erros['tp_status'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 5 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_status']) || !is_array($this->NM_ajax_info['errList']['tp_status']))
              {
                  $this->NM_ajax_info['errList']['tp_status'] = array();
              }
              $this->NM_ajax_info['errList']['tp_status'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 5 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_status

    function ValidateField_tp_prosentase(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_prosentase == "")  
      { 
          $this->tp_prosentase = 0;
          $this->sc_force_zero[] = 'tp_prosentase';
      } 
      if (!empty($this->field_config['tp_prosentase']['symbol_dec']))
      {
          nm_limpa_valor($this->tp_prosentase, $this->field_config['tp_prosentase']['symbol_dec'], $this->field_config['tp_prosentase']['symbol_grp']) ; 
          if ('.' == substr($this->tp_prosentase, 0, 1))
          {
              if ('' == str_replace('0', '', substr($this->tp_prosentase, 1)))
              {
                  $this->tp_prosentase = '';
              }
              else
              {
                  $this->tp_prosentase = '0' . $this->tp_prosentase;
              }
          }
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tp_prosentase != '')  
          { 
              $iTestSize = 6;
              if (strlen($this->tp_prosentase) > $iTestSize)  
              { 
                  $Campos_Crit .= "Prosentasi Project: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tp_prosentase']))
                  {
                      $Campos_Erros['tp_prosentase'] = array();
                  }
                  $Campos_Erros['tp_prosentase'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tp_prosentase']) || !is_array($this->NM_ajax_info['errList']['tp_prosentase']))
                  {
                      $this->NM_ajax_info['errList']['tp_prosentase'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_prosentase'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tp_prosentase, 3, 2, -0, 99999, "N") == false)  
              { 
                  $Campos_Crit .= "Prosentasi Project; " ; 
                  if (!isset($Campos_Erros['tp_prosentase']))
                  {
                      $Campos_Erros['tp_prosentase'] = array();
                  }
                  $Campos_Erros['tp_prosentase'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_prosentase']) || !is_array($this->NM_ajax_info['errList']['tp_prosentase']))
                  {
                      $this->NM_ajax_info['errList']['tp_prosentase'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_prosentase'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_tp_prosentase

    function ValidateField_tp_planstart(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->tp_planstart, $this->field_config['tp_planstart']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['tp_planstart']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['tp_planstart']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['tp_planstart']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['tp_planstart']['date_sep']) ; 
          if (trim($this->tp_planstart) != "")  
          { 
              if ($teste_validade->Data($this->tp_planstart, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Mulai(Plan); " ; 
                  if (!isset($Campos_Erros['tp_planstart']))
                  {
                      $Campos_Erros['tp_planstart'] = array();
                  }
                  $Campos_Erros['tp_planstart'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_planstart']) || !is_array($this->NM_ajax_info['errList']['tp_planstart']))
                  {
                      $this->NM_ajax_info['errList']['tp_planstart'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_planstart'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif ((!$this->NM_ajax_flag || 'validate_tp_planstart' != $this->NM_ajax_opcao) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_planstart']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_planstart'] == "on")) 
           { 
              $Campos_Falta[] = "Tgl Mulai(Plan)" ; 
              if (!isset($Campos_Erros['tp_planstart']))
              {
                  $Campos_Erros['tp_planstart'] = array();
              }
              $Campos_Erros['tp_planstart'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tp_planstart']) || !is_array($this->NM_ajax_info['errList']['tp_planstart']))
                  {
                      $this->NM_ajax_info['errList']['tp_planstart'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_planstart'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
          $this->field_config['tp_planstart']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_tp_planstart

    function ValidateField_tp_planfinish(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->tp_planfinish, $this->field_config['tp_planfinish']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao == "incluir")
      { 
          $guarda_datahora = $this->field_config['tp_planfinish']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['tp_planfinish']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['tp_planfinish']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['tp_planfinish']['date_sep']) ; 
          if (trim($this->tp_planfinish) != "")  
          { 
              if ($teste_validade->Data($this->tp_planfinish, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Selesai(Plan); " ; 
                  if (!isset($Campos_Erros['tp_planfinish']))
                  {
                      $Campos_Erros['tp_planfinish'] = array();
                  }
                  $Campos_Erros['tp_planfinish'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_planfinish']) || !is_array($this->NM_ajax_info['errList']['tp_planfinish']))
                  {
                      $this->NM_ajax_info['errList']['tp_planfinish'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_planfinish'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif ((!$this->NM_ajax_flag || 'validate_tp_planfinish' != $this->NM_ajax_opcao) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_planfinish']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['php_cmp_required']['tp_planfinish'] == "on")) 
           { 
              $Campos_Falta[] = "Tgl Selesai(Plan)" ; 
              if (!isset($Campos_Erros['tp_planfinish']))
              {
                  $Campos_Erros['tp_planfinish'] = array();
              }
              $Campos_Erros['tp_planfinish'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['tp_planfinish']) || !is_array($this->NM_ajax_info['errList']['tp_planfinish']))
                  {
                      $this->NM_ajax_info['errList']['tp_planfinish'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_planfinish'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
          $this->field_config['tp_planfinish']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_tp_planfinish

    function ValidateField_tp_lokasi(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      $this->tp_lokasi = sc_strtoupper($this->tp_lokasi); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_lokasi) > 100) 
          { 
              $Campos_Crit .= "Lokasi " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_lokasi']))
              {
                  $Campos_Erros['tp_lokasi'] = array();
              }
              $Campos_Erros['tp_lokasi'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_lokasi']) || !is_array($this->NM_ajax_info['errList']['tp_lokasi']))
              {
                  $this->NM_ajax_info['errList']['tp_lokasi'] = array();
              }
              $this->NM_ajax_info['errList']['tp_lokasi'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_lokasi

    function ValidateField_tp_nokontrak(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_nokontrak) > 30) 
          { 
              $Campos_Crit .= "No.Kontrak " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_nokontrak']))
              {
                  $Campos_Erros['tp_nokontrak'] = array();
              }
              $Campos_Erros['tp_nokontrak'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_nokontrak']) || !is_array($this->NM_ajax_info['errList']['tp_nokontrak']))
              {
                  $this->NM_ajax_info['errList']['tp_nokontrak'] = array();
              }
              $this->NM_ajax_info['errList']['tp_nokontrak'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_nokontrak

    function ValidateField_tp_ponumber(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_ponumber) > 30) 
          { 
              $Campos_Crit .= "PO.Number " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_ponumber']))
              {
                  $Campos_Erros['tp_ponumber'] = array();
              }
              $Campos_Erros['tp_ponumber'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_ponumber']) || !is_array($this->NM_ajax_info['errList']['tp_ponumber']))
              {
                  $this->NM_ajax_info['errList']['tp_ponumber'] = array();
              }
              $this->NM_ajax_info['errList']['tp_ponumber'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_ponumber

    function ValidateField_tp_nilai(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_nilai == "")  
      { 
          $this->tp_nilai = 0;
          $this->sc_force_zero[] = 'tp_nilai';
      } 
      nm_limpa_numero($this->tp_nilai, $this->field_config['tp_nilai']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tp_nilai != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tp_nilai) > $iTestSize)  
              { 
                  $Campos_Crit .= "Nilai Rekon: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tp_nilai']))
                  {
                      $Campos_Erros['tp_nilai'] = array();
                  }
                  $Campos_Erros['tp_nilai'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tp_nilai']) || !is_array($this->NM_ajax_info['errList']['tp_nilai']))
                  {
                      $this->NM_ajax_info['errList']['tp_nilai'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_nilai'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tp_nilai, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Nilai Rekon; " ; 
                  if (!isset($Campos_Erros['tp_nilai']))
                  {
                      $Campos_Erros['tp_nilai'] = array();
                  }
                  $Campos_Erros['tp_nilai'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_nilai']) || !is_array($this->NM_ajax_info['errList']['tp_nilai']))
                  {
                      $this->NM_ajax_info['errList']['tp_nilai'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_nilai'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_tp_nilai

    function ValidateField_tp_summary(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_summary) > 32767) 
          { 
              $Campos_Crit .= "Deskripsi Project " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_summary']))
              {
                  $Campos_Erros['tp_summary'] = array();
              }
              $Campos_Erros['tp_summary'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_summary']) || !is_array($this->NM_ajax_info['errList']['tp_summary']))
              {
                  $this->NM_ajax_info['errList']['tp_summary'] = array();
              }
              $this->NM_ajax_info['errList']['tp_summary'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32767 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_summary

    function ValidateField_tp_rab(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_rab == "")  
      { 
          $this->tp_rab = 0;
          $this->sc_force_zero[] = 'tp_rab';
      } 
      nm_limpa_numero($this->tp_rab, $this->field_config['tp_rab']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tp_rab != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tp_rab) > $iTestSize)  
              { 
                  $Campos_Crit .= "Nilai DRM: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tp_rab']))
                  {
                      $Campos_Erros['tp_rab'] = array();
                  }
                  $Campos_Erros['tp_rab'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tp_rab']) || !is_array($this->NM_ajax_info['errList']['tp_rab']))
                  {
                      $this->NM_ajax_info['errList']['tp_rab'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_rab'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tp_rab, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Nilai DRM; " ; 
                  if (!isset($Campos_Erros['tp_rab']))
                  {
                      $Campos_Erros['tp_rab'] = array();
                  }
                  $Campos_Erros['tp_rab'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_rab']) || !is_array($this->NM_ajax_info['errList']['tp_rab']))
                  {
                      $this->NM_ajax_info['errList']['tp_rab'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_rab'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_tp_rab

    function ValidateField_tp_jmldistribusi(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_jmldistribusi == "")  
      { 
          $this->tp_jmldistribusi = 0;
          $this->sc_force_zero[] = 'tp_jmldistribusi';
      } 
      nm_limpa_numero($this->tp_jmldistribusi, $this->field_config['tp_jmldistribusi']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tp_jmldistribusi != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tp_jmldistribusi) > $iTestSize)  
              { 
                  $Campos_Crit .= "Jml Distribusi: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tp_jmldistribusi']))
                  {
                      $Campos_Erros['tp_jmldistribusi'] = array();
                  }
                  $Campos_Erros['tp_jmldistribusi'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tp_jmldistribusi']) || !is_array($this->NM_ajax_info['errList']['tp_jmldistribusi']))
                  {
                      $this->NM_ajax_info['errList']['tp_jmldistribusi'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_jmldistribusi'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tp_jmldistribusi, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Jml Distribusi; " ; 
                  if (!isset($Campos_Erros['tp_jmldistribusi']))
                  {
                      $Campos_Erros['tp_jmldistribusi'] = array();
                  }
                  $Campos_Erros['tp_jmldistribusi'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_jmldistribusi']) || !is_array($this->NM_ajax_info['errList']['tp_jmldistribusi']))
                  {
                      $this->NM_ajax_info['errList']['tp_jmldistribusi'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_jmldistribusi'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_tp_jmldistribusi

    function ValidateField_tp_odp(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_odp == "")  
      { 
          $this->tp_odp = 0;
          $this->sc_force_zero[] = 'tp_odp';
      } 
      nm_limpa_numero($this->tp_odp, $this->field_config['tp_odp']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tp_odp != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tp_odp) > $iTestSize)  
              { 
                  $Campos_Crit .= "Jumlah ODP: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tp_odp']))
                  {
                      $Campos_Erros['tp_odp'] = array();
                  }
                  $Campos_Erros['tp_odp'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tp_odp']) || !is_array($this->NM_ajax_info['errList']['tp_odp']))
                  {
                      $this->NM_ajax_info['errList']['tp_odp'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_odp'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tp_odp, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Jumlah ODP; " ; 
                  if (!isset($Campos_Erros['tp_odp']))
                  {
                      $Campos_Erros['tp_odp'] = array();
                  }
                  $Campos_Erros['tp_odp'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_odp']) || !is_array($this->NM_ajax_info['errList']['tp_odp']))
                  {
                      $this->NM_ajax_info['errList']['tp_odp'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_odp'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_tp_odp

    function ValidateField_tp_jmlport(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_jmlport == "")  
      { 
          $this->tp_jmlport = 0;
          $this->sc_force_zero[] = 'tp_jmlport';
      } 
      nm_limpa_numero($this->tp_jmlport, $this->field_config['tp_jmlport']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tp_jmlport != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tp_jmlport) > $iTestSize)  
              { 
                  $Campos_Crit .= "Jml Port: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tp_jmlport']))
                  {
                      $Campos_Erros['tp_jmlport'] = array();
                  }
                  $Campos_Erros['tp_jmlport'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tp_jmlport']) || !is_array($this->NM_ajax_info['errList']['tp_jmlport']))
                  {
                      $this->NM_ajax_info['errList']['tp_jmlport'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_jmlport'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tp_jmlport, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Jml Port; " ; 
                  if (!isset($Campos_Erros['tp_jmlport']))
                  {
                      $Campos_Erros['tp_jmlport'] = array();
                  }
                  $Campos_Erros['tp_jmlport'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_jmlport']) || !is_array($this->NM_ajax_info['errList']['tp_jmlport']))
                  {
                      $this->NM_ajax_info['errList']['tp_jmlport'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_jmlport'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_tp_jmlport

    function ValidateField_tp_actualstart(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->tp_actualstart, $this->field_config['tp_actualstart']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['tp_actualstart']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['tp_actualstart']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['tp_actualstart']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['tp_actualstart']['date_sep']) ; 
          if (trim($this->tp_actualstart) != "")  
          { 
              if ($teste_validade->Data($this->tp_actualstart, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Mulai(aktual); " ; 
                  if (!isset($Campos_Erros['tp_actualstart']))
                  {
                      $Campos_Erros['tp_actualstart'] = array();
                  }
                  $Campos_Erros['tp_actualstart'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_actualstart']) || !is_array($this->NM_ajax_info['errList']['tp_actualstart']))
                  {
                      $this->NM_ajax_info['errList']['tp_actualstart'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_actualstart'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['tp_actualstart']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_tp_actualstart

    function ValidateField_tp_actualfinish(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->tp_actualfinish, $this->field_config['tp_actualfinish']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['tp_actualfinish']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['tp_actualfinish']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['tp_actualfinish']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['tp_actualfinish']['date_sep']) ; 
          if (trim($this->tp_actualfinish) != "")  
          { 
              if ($teste_validade->Data($this->tp_actualfinish, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Selesai(aktual); " ; 
                  if (!isset($Campos_Erros['tp_actualfinish']))
                  {
                      $Campos_Erros['tp_actualfinish'] = array();
                  }
                  $Campos_Erros['tp_actualfinish'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_actualfinish']) || !is_array($this->NM_ajax_info['errList']['tp_actualfinish']))
                  {
                      $this->NM_ajax_info['errList']['tp_actualfinish'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_actualfinish'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['tp_actualfinish']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_tp_actualfinish

    function ValidateField_tp_entrydate(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->tp_entrydate, $this->field_config['tp_entrydate']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['tp_entrydate']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['tp_entrydate']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['tp_entrydate']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['tp_entrydate']['date_sep']) ; 
          if (trim($this->tp_entrydate) != "")  
          { 
              if ($teste_validade->Data($this->tp_entrydate, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Entry; " ; 
                  if (!isset($Campos_Erros['tp_entrydate']))
                  {
                      $Campos_Erros['tp_entrydate'] = array();
                  }
                  $Campos_Erros['tp_entrydate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_entrydate']) || !is_array($this->NM_ajax_info['errList']['tp_entrydate']))
                  {
                      $this->NM_ajax_info['errList']['tp_entrydate'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_entrydate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['tp_entrydate']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_tp_entrydate

    function ValidateField_tp_entryby(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_entryby) > 10) 
          { 
              $Campos_Crit .= "Entry Oleh " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_entryby']))
              {
                  $Campos_Erros['tp_entryby'] = array();
              }
              $Campos_Erros['tp_entryby'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_entryby']) || !is_array($this->NM_ajax_info['errList']['tp_entryby']))
              {
                  $this->NM_ajax_info['errList']['tp_entryby'] = array();
              }
              $this->NM_ajax_info['errList']['tp_entryby'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_entryby

    function ValidateField_tp_updatedate(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->tp_updatedate, $this->field_config['tp_updatedate']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['tp_updatedate']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['tp_updatedate']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['tp_updatedate']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['tp_updatedate']['date_sep']) ; 
          if (trim($this->tp_updatedate) != "")  
          { 
              if ($teste_validade->Data($this->tp_updatedate, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Update; " ; 
                  if (!isset($Campos_Erros['tp_updatedate']))
                  {
                      $Campos_Erros['tp_updatedate'] = array();
                  }
                  $Campos_Erros['tp_updatedate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_updatedate']) || !is_array($this->NM_ajax_info['errList']['tp_updatedate']))
                  {
                      $this->NM_ajax_info['errList']['tp_updatedate'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_updatedate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['tp_updatedate']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_tp_updatedate

    function ValidateField_tp_updateby(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_updateby) > 10) 
          { 
              $Campos_Crit .= "Update Oleh " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_updateby']))
              {
                  $Campos_Erros['tp_updateby'] = array();
              }
              $Campos_Erros['tp_updateby'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_updateby']) || !is_array($this->NM_ajax_info['errList']['tp_updateby']))
              {
                  $this->NM_ajax_info['errList']['tp_updateby'] = array();
              }
              $this->NM_ajax_info['errList']['tp_updateby'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_updateby

    function ValidateField_tp_taskaktif(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_taskaktif) > 60) 
          { 
              $Campos_Crit .= "Task Aktif " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_taskaktif']))
              {
                  $Campos_Erros['tp_taskaktif'] = array();
              }
              $Campos_Erros['tp_taskaktif'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_taskaktif']) || !is_array($this->NM_ajax_info['errList']['tp_taskaktif']))
              {
                  $this->NM_ajax_info['errList']['tp_taskaktif'] = array();
              }
              $this->NM_ajax_info['errList']['tp_taskaktif'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_taskaktif

    function ValidateField_tp_taskaktif_number(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_taskaktif_number == "")  
      { 
          $this->tp_taskaktif_number = 0;
          $this->sc_force_zero[] = 'tp_taskaktif_number';
      } 
      nm_limpa_numero($this->tp_taskaktif_number, $this->field_config['tp_taskaktif_number']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tp_taskaktif_number != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tp_taskaktif_number) > $iTestSize)  
              { 
                  $Campos_Crit .= "Task Aktif Number: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tp_taskaktif_number']))
                  {
                      $Campos_Erros['tp_taskaktif_number'] = array();
                  }
                  $Campos_Erros['tp_taskaktif_number'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tp_taskaktif_number']) || !is_array($this->NM_ajax_info['errList']['tp_taskaktif_number']))
                  {
                      $this->NM_ajax_info['errList']['tp_taskaktif_number'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_taskaktif_number'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tp_taskaktif_number, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Task Aktif Number; " ; 
                  if (!isset($Campos_Erros['tp_taskaktif_number']))
                  {
                      $Campos_Erros['tp_taskaktif_number'] = array();
                  }
                  $Campos_Erros['tp_taskaktif_number'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_taskaktif_number']) || !is_array($this->NM_ajax_info['errList']['tp_taskaktif_number']))
                  {
                      $this->NM_ajax_info['errList']['tp_taskaktif_number'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_taskaktif_number'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_tp_taskaktif_number

    function ValidateField_tp_tahapanaktif(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_tahapanaktif) > 60) 
          { 
              $Campos_Crit .= "Tahapan Aktif " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_tahapanaktif']))
              {
                  $Campos_Erros['tp_tahapanaktif'] = array();
              }
              $Campos_Erros['tp_tahapanaktif'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_tahapanaktif']) || !is_array($this->NM_ajax_info['errList']['tp_tahapanaktif']))
              {
                  $this->NM_ajax_info['errList']['tp_tahapanaktif'] = array();
              }
              $this->NM_ajax_info['errList']['tp_tahapanaktif'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_tahapanaktif

    function ValidateField_tp_taskaktifstatus(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->tp_taskaktifstatus == "")  
      { 
          $this->tp_taskaktifstatus = 0;
          $this->sc_force_zero[] = 'tp_taskaktifstatus';
      } 
      nm_limpa_numero($this->tp_taskaktifstatus, $this->field_config['tp_taskaktifstatus']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->tp_taskaktifstatus != '')  
          { 
              $iTestSize = 22;
              if (strlen($this->tp_taskaktifstatus) > $iTestSize)  
              { 
                  $Campos_Crit .= "Task Aktif Status: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['tp_taskaktifstatus']))
                  {
                      $Campos_Erros['tp_taskaktifstatus'] = array();
                  }
                  $Campos_Erros['tp_taskaktifstatus'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['tp_taskaktifstatus']) || !is_array($this->NM_ajax_info['errList']['tp_taskaktifstatus']))
                  {
                      $this->NM_ajax_info['errList']['tp_taskaktifstatus'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_taskaktifstatus'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->tp_taskaktifstatus, 22, 0, -0, 1.0E+22, "N") == false)  
              { 
                  $Campos_Crit .= "Task Aktif Status; " ; 
                  if (!isset($Campos_Erros['tp_taskaktifstatus']))
                  {
                      $Campos_Erros['tp_taskaktifstatus'] = array();
                  }
                  $Campos_Erros['tp_taskaktifstatus'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_taskaktifstatus']) || !is_array($this->NM_ajax_info['errList']['tp_taskaktifstatus']))
                  {
                      $this->NM_ajax_info['errList']['tp_taskaktifstatus'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_taskaktifstatus'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
    } // ValidateField_tp_taskaktifstatus

    function ValidateField_tp_taskaktifplanstart(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->tp_taskaktifplanstart, $this->field_config['tp_taskaktifplanstart']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['tp_taskaktifplanstart']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['tp_taskaktifplanstart']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['tp_taskaktifplanstart']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['tp_taskaktifplanstart']['date_sep']) ; 
          if (trim($this->tp_taskaktifplanstart) != "")  
          { 
              if ($teste_validade->Data($this->tp_taskaktifplanstart, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Plan Mulai Task; " ; 
                  if (!isset($Campos_Erros['tp_taskaktifplanstart']))
                  {
                      $Campos_Erros['tp_taskaktifplanstart'] = array();
                  }
                  $Campos_Erros['tp_taskaktifplanstart'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_taskaktifplanstart']) || !is_array($this->NM_ajax_info['errList']['tp_taskaktifplanstart']))
                  {
                      $this->NM_ajax_info['errList']['tp_taskaktifplanstart'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_taskaktifplanstart'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['tp_taskaktifplanstart']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_tp_taskaktifplanstart

    function ValidateField_tp_taskaktifplanfinish(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->tp_taskaktifplanfinish, $this->field_config['tp_taskaktifplanfinish']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['tp_taskaktifplanfinish']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['tp_taskaktifplanfinish']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['tp_taskaktifplanfinish']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['tp_taskaktifplanfinish']['date_sep']) ; 
          if (trim($this->tp_taskaktifplanfinish) != "")  
          { 
              if ($teste_validade->Data($this->tp_taskaktifplanfinish, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Plan Finish Task; " ; 
                  if (!isset($Campos_Erros['tp_taskaktifplanfinish']))
                  {
                      $Campos_Erros['tp_taskaktifplanfinish'] = array();
                  }
                  $Campos_Erros['tp_taskaktifplanfinish'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_taskaktifplanfinish']) || !is_array($this->NM_ajax_info['errList']['tp_taskaktifplanfinish']))
                  {
                      $this->NM_ajax_info['errList']['tp_taskaktifplanfinish'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_taskaktifplanfinish'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['tp_taskaktifplanfinish']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_tp_taskaktifplanfinish

    function ValidateField_tp_is_change_template(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_is_change_template) > 1) 
          { 
              $Campos_Crit .= "Template Pernah Berubah? " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_is_change_template']))
              {
                  $Campos_Erros['tp_is_change_template'] = array();
              }
              $Campos_Erros['tp_is_change_template'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_is_change_template']) || !is_array($this->NM_ajax_info['errList']['tp_is_change_template']))
              {
                  $this->NM_ajax_info['errList']['tp_is_change_template'] = array();
              }
              $this->NM_ajax_info['errList']['tp_is_change_template'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_is_change_template

    function ValidateField_tp_ischangetempby(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->tp_ischangetempby) > 20) 
          { 
              $Campos_Crit .= "Yang mengubah Template " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['tp_ischangetempby']))
              {
                  $Campos_Erros['tp_ischangetempby'] = array();
              }
              $Campos_Erros['tp_ischangetempby'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['tp_ischangetempby']) || !is_array($this->NM_ajax_info['errList']['tp_ischangetempby']))
              {
                  $this->NM_ajax_info['errList']['tp_ischangetempby'] = array();
              }
              $this->NM_ajax_info['errList']['tp_ischangetempby'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_tp_ischangetempby

    function ValidateField_tp_ischangetempdate(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      nm_limpa_data($this->tp_ischangetempdate, $this->field_config['tp_ischangetempdate']['date_sep']) ; 
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['tp_ischangetempdate']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['tp_ischangetempdate']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['tp_ischangetempdate']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['tp_ischangetempdate']['date_sep']) ; 
          if (trim($this->tp_ischangetempdate) != "")  
          { 
              if ($teste_validade->Data($this->tp_ischangetempdate, $Format_Data, $trab_dt_min, $trab_dt_max) == false)  
              { 
                  $Campos_Crit .= "Tgl Mengubah Template; " ; 
                  if (!isset($Campos_Erros['tp_ischangetempdate']))
                  {
                      $Campos_Erros['tp_ischangetempdate'] = array();
                  }
                  $Campos_Erros['tp_ischangetempdate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['tp_ischangetempdate']) || !is_array($this->NM_ajax_info['errList']['tp_ischangetempdate']))
                  {
                      $this->NM_ajax_info['errList']['tp_ischangetempdate'] = array();
                  }
                  $this->NM_ajax_info['errList']['tp_ischangetempdate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['tp_ischangetempdate']['date_format'] = $guarda_datahora; 
       } 
    } // ValidateField_tp_ischangetempdate

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
    $this->nmgp_dados_form['tp_id'] = $this->tp_id;
    $this->nmgp_dados_form['tp_thn_release'] = $this->tp_thn_release;
    $this->nmgp_dados_form['tp_prjtrelease'] = $this->tp_prjtrelease;
    $this->nmgp_dados_form['tp_batch'] = $this->tp_batch;
    $this->nmgp_dados_form['tp_divre'] = $this->tp_divre;
    $this->nmgp_dados_form['tp_witel'] = $this->tp_witel;
    $this->nmgp_dados_form['tp_datel'] = $this->tp_datel;
    $this->nmgp_dados_form['tp_sto'] = $this->tp_sto;
    $this->nmgp_dados_form['tp_idlop'] = $this->tp_idlop;
    $this->nmgp_dados_form['tp_namalop'] = $this->tp_namalop;
    $this->nmgp_dados_form['tp_mitra'] = $this->tp_mitra;
    $this->nmgp_dados_form['tp_templateproject'] = $this->tp_templateproject;
    $this->nmgp_dados_form['tp_targetwaktu'] = $this->tp_targetwaktu;
    $this->nmgp_dados_form['tp_jenisproject'] = $this->tp_jenisproject;
    $this->nmgp_dados_form['tp_projectname'] = $this->tp_projectname;
    $this->nmgp_dados_form['tp_status'] = $this->tp_status;
    $this->nmgp_dados_form['tp_prosentase'] = $this->tp_prosentase;
    $this->nmgp_dados_form['tp_planstart'] = (strlen(trim($this->tp_planstart)) > 19) ? str_replace(".", ":", $this->tp_planstart) : trim($this->tp_planstart);
    $this->nmgp_dados_form['tp_planfinish'] = (strlen(trim($this->tp_planfinish)) > 19) ? str_replace(".", ":", $this->tp_planfinish) : trim($this->tp_planfinish);
    $this->nmgp_dados_form['tp_lokasi'] = $this->tp_lokasi;
    $this->nmgp_dados_form['tp_nokontrak'] = $this->tp_nokontrak;
    $this->nmgp_dados_form['tp_ponumber'] = $this->tp_ponumber;
    $this->nmgp_dados_form['tp_nilai'] = $this->tp_nilai;
    $this->nmgp_dados_form['tp_summary'] = $this->tp_summary;
    $this->nmgp_dados_form['tp_rab'] = $this->tp_rab;
    $this->nmgp_dados_form['tp_jmldistribusi'] = $this->tp_jmldistribusi;
    $this->nmgp_dados_form['tp_odp'] = $this->tp_odp;
    $this->nmgp_dados_form['tp_jmlport'] = $this->tp_jmlport;
    $this->nmgp_dados_form['tp_actualstart'] = (strlen(trim($this->tp_actualstart)) > 19) ? str_replace(".", ":", $this->tp_actualstart) : trim($this->tp_actualstart);
    $this->nmgp_dados_form['tp_actualfinish'] = (strlen(trim($this->tp_actualfinish)) > 19) ? str_replace(".", ":", $this->tp_actualfinish) : trim($this->tp_actualfinish);
    $this->nmgp_dados_form['tp_entrydate'] = (strlen(trim($this->tp_entrydate)) > 19) ? str_replace(".", ":", $this->tp_entrydate) : trim($this->tp_entrydate);
    $this->nmgp_dados_form['tp_entryby'] = $this->tp_entryby;
    $this->nmgp_dados_form['tp_updatedate'] = (strlen(trim($this->tp_updatedate)) > 19) ? str_replace(".", ":", $this->tp_updatedate) : trim($this->tp_updatedate);
    $this->nmgp_dados_form['tp_updateby'] = $this->tp_updateby;
    $this->nmgp_dados_form['tp_taskaktif'] = $this->tp_taskaktif;
    $this->nmgp_dados_form['tp_taskaktif_number'] = $this->tp_taskaktif_number;
    $this->nmgp_dados_form['tp_tahapanaktif'] = $this->tp_tahapanaktif;
    $this->nmgp_dados_form['tp_taskaktifstatus'] = $this->tp_taskaktifstatus;
    $this->nmgp_dados_form['tp_taskaktifplanstart'] = (strlen(trim($this->tp_taskaktifplanstart)) > 19) ? str_replace(".", ":", $this->tp_taskaktifplanstart) : trim($this->tp_taskaktifplanstart);
    $this->nmgp_dados_form['tp_taskaktifplanfinish'] = (strlen(trim($this->tp_taskaktifplanfinish)) > 19) ? str_replace(".", ":", $this->tp_taskaktifplanfinish) : trim($this->tp_taskaktifplanfinish);
    $this->nmgp_dados_form['tp_is_change_template'] = $this->tp_is_change_template;
    $this->nmgp_dados_form['tp_ischangetempby'] = $this->tp_ischangetempby;
    $this->nmgp_dados_form['tp_ischangetempdate'] = (strlen(trim($this->tp_ischangetempdate)) > 19) ? str_replace(".", ":", $this->tp_ischangetempdate) : trim($this->tp_ischangetempdate);
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->formatado = false;
      nm_limpa_numero($this->tp_id, $this->field_config['tp_id']['symbol_grp']) ; 
      nm_limpa_numero($this->tp_targetwaktu, $this->field_config['tp_targetwaktu']['symbol_grp']) ; 
      if (!empty($this->field_config['tp_prosentase']['symbol_dec']))
      {
         nm_limpa_valor($this->tp_prosentase, $this->field_config['tp_prosentase']['symbol_dec'], $this->field_config['tp_prosentase']['symbol_grp']);
      }
      nm_limpa_data($this->tp_planstart, $this->field_config['tp_planstart']['date_sep']) ; 
      nm_limpa_data($this->tp_planfinish, $this->field_config['tp_planfinish']['date_sep']) ; 
      nm_limpa_numero($this->tp_nilai, $this->field_config['tp_nilai']['symbol_grp']) ; 
      nm_limpa_numero($this->tp_rab, $this->field_config['tp_rab']['symbol_grp']) ; 
      nm_limpa_numero($this->tp_jmldistribusi, $this->field_config['tp_jmldistribusi']['symbol_grp']) ; 
      nm_limpa_numero($this->tp_odp, $this->field_config['tp_odp']['symbol_grp']) ; 
      nm_limpa_numero($this->tp_jmlport, $this->field_config['tp_jmlport']['symbol_grp']) ; 
      nm_limpa_data($this->tp_actualstart, $this->field_config['tp_actualstart']['date_sep']) ; 
      nm_limpa_data($this->tp_actualfinish, $this->field_config['tp_actualfinish']['date_sep']) ; 
      nm_limpa_data($this->tp_entrydate, $this->field_config['tp_entrydate']['date_sep']) ; 
      nm_limpa_data($this->tp_updatedate, $this->field_config['tp_updatedate']['date_sep']) ; 
      nm_limpa_numero($this->tp_taskaktif_number, $this->field_config['tp_taskaktif_number']['symbol_grp']) ; 
      nm_limpa_numero($this->tp_taskaktifstatus, $this->field_config['tp_taskaktifstatus']['symbol_grp']) ; 
      nm_limpa_data($this->tp_taskaktifplanstart, $this->field_config['tp_taskaktifplanstart']['date_sep']) ; 
      nm_limpa_data($this->tp_taskaktifplanfinish, $this->field_config['tp_taskaktifplanfinish']['date_sep']) ; 
      nm_limpa_data($this->tp_ischangetempdate, $this->field_config['tp_ischangetempdate']['date_sep']) ; 
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
      if ($Nome_Campo == "tp_id")
      {
          nm_limpa_numero($this->tp_id, $this->field_config['tp_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "tp_targetwaktu")
      {
          nm_limpa_numero($this->tp_targetwaktu, $this->field_config['tp_targetwaktu']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "tp_prosentase")
      {
          if (!empty($this->field_config['tp_prosentase']['symbol_dec']))
          {
             nm_limpa_valor($this->tp_prosentase, $this->field_config['tp_prosentase']['symbol_dec'], $this->field_config['tp_prosentase']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "tp_nilai")
      {
          nm_limpa_numero($this->tp_nilai, $this->field_config['tp_nilai']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "tp_rab")
      {
          nm_limpa_numero($this->tp_rab, $this->field_config['tp_rab']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "tp_jmldistribusi")
      {
          nm_limpa_numero($this->tp_jmldistribusi, $this->field_config['tp_jmldistribusi']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "tp_odp")
      {
          nm_limpa_numero($this->tp_odp, $this->field_config['tp_odp']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "tp_jmlport")
      {
          nm_limpa_numero($this->tp_jmlport, $this->field_config['tp_jmlport']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "tp_taskaktif_number")
      {
          nm_limpa_numero($this->tp_taskaktif_number, $this->field_config['tp_taskaktif_number']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "tp_taskaktifstatus")
      {
          nm_limpa_numero($this->tp_taskaktifstatus, $this->field_config['tp_taskaktifstatus']['symbol_grp']) ; 
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
      if (!empty($this->tp_id) || (!empty($format_fields) && isset($format_fields['tp_id'])))
      {
          nmgp_Form_Num_Val($this->tp_id, $this->field_config['tp_id']['symbol_grp'], $this->field_config['tp_id']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tp_id']['symbol_fmt']) ; 
      }
      if (!empty($this->tp_targetwaktu) || (!empty($format_fields) && isset($format_fields['tp_targetwaktu'])))
      {
          nmgp_Form_Num_Val($this->tp_targetwaktu, $this->field_config['tp_targetwaktu']['symbol_grp'], $this->field_config['tp_targetwaktu']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tp_targetwaktu']['symbol_fmt']) ; 
      }
      if (!empty($this->tp_prosentase) || (!empty($format_fields) && isset($format_fields['tp_prosentase'])))
      {
          nmgp_Form_Num_Val($this->tp_prosentase, $this->field_config['tp_prosentase']['symbol_grp'], $this->field_config['tp_prosentase']['symbol_dec'], "2", "S", "", "", "", "-", $this->field_config['tp_prosentase']['symbol_fmt']) ; 
      }
      if ((!empty($this->tp_planstart) && 'null' != $this->tp_planstart) || (!empty($format_fields) && isset($format_fields['tp_planstart'])))
      {
          nm_volta_data($this->tp_planstart, $this->field_config['tp_planstart']['date_format']) ; 
          nmgp_Form_Datas($this->tp_planstart, $this->field_config['tp_planstart']['date_format'], $this->field_config['tp_planstart']['date_sep']) ;  
      }
      elseif ('null' == $this->tp_planstart || '' == $this->tp_planstart)
      {
          $this->tp_planstart = '';
      }
      if ((!empty($this->tp_planfinish) && 'null' != $this->tp_planfinish) || (!empty($format_fields) && isset($format_fields['tp_planfinish'])))
      {
          nm_volta_data($this->tp_planfinish, $this->field_config['tp_planfinish']['date_format']) ; 
          nmgp_Form_Datas($this->tp_planfinish, $this->field_config['tp_planfinish']['date_format'], $this->field_config['tp_planfinish']['date_sep']) ;  
      }
      elseif ('null' == $this->tp_planfinish || '' == $this->tp_planfinish)
      {
          $this->tp_planfinish = '';
      }
      if (!empty($this->tp_nilai) || (!empty($format_fields) && isset($format_fields['tp_nilai'])))
      {
          nmgp_Form_Num_Val($this->tp_nilai, $this->field_config['tp_nilai']['symbol_grp'], $this->field_config['tp_nilai']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tp_nilai']['symbol_fmt']) ; 
      }
      if (!empty($this->tp_rab) || (!empty($format_fields) && isset($format_fields['tp_rab'])))
      {
          nmgp_Form_Num_Val($this->tp_rab, $this->field_config['tp_rab']['symbol_grp'], $this->field_config['tp_rab']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tp_rab']['symbol_fmt']) ; 
      }
      if (!empty($this->tp_jmldistribusi) || (!empty($format_fields) && isset($format_fields['tp_jmldistribusi'])))
      {
          nmgp_Form_Num_Val($this->tp_jmldistribusi, $this->field_config['tp_jmldistribusi']['symbol_grp'], $this->field_config['tp_jmldistribusi']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tp_jmldistribusi']['symbol_fmt']) ; 
      }
      if (!empty($this->tp_odp) || (!empty($format_fields) && isset($format_fields['tp_odp'])))
      {
          nmgp_Form_Num_Val($this->tp_odp, $this->field_config['tp_odp']['symbol_grp'], $this->field_config['tp_odp']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tp_odp']['symbol_fmt']) ; 
      }
      if (!empty($this->tp_jmlport) || (!empty($format_fields) && isset($format_fields['tp_jmlport'])))
      {
          nmgp_Form_Num_Val($this->tp_jmlport, $this->field_config['tp_jmlport']['symbol_grp'], $this->field_config['tp_jmlport']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tp_jmlport']['symbol_fmt']) ; 
      }
      if ((!empty($this->tp_actualstart) && 'null' != $this->tp_actualstart) || (!empty($format_fields) && isset($format_fields['tp_actualstart'])))
      {
          nm_volta_data($this->tp_actualstart, $this->field_config['tp_actualstart']['date_format']) ; 
          nmgp_Form_Datas($this->tp_actualstart, $this->field_config['tp_actualstart']['date_format'], $this->field_config['tp_actualstart']['date_sep']) ;  
      }
      elseif ('null' == $this->tp_actualstart || '' == $this->tp_actualstart)
      {
          $this->tp_actualstart = '';
      }
      if ((!empty($this->tp_actualfinish) && 'null' != $this->tp_actualfinish) || (!empty($format_fields) && isset($format_fields['tp_actualfinish'])))
      {
          nm_volta_data($this->tp_actualfinish, $this->field_config['tp_actualfinish']['date_format']) ; 
          nmgp_Form_Datas($this->tp_actualfinish, $this->field_config['tp_actualfinish']['date_format'], $this->field_config['tp_actualfinish']['date_sep']) ;  
      }
      elseif ('null' == $this->tp_actualfinish || '' == $this->tp_actualfinish)
      {
          $this->tp_actualfinish = '';
      }
      if ((!empty($this->tp_entrydate) && 'null' != $this->tp_entrydate) || (!empty($format_fields) && isset($format_fields['tp_entrydate'])))
      {
          nm_volta_data($this->tp_entrydate, $this->field_config['tp_entrydate']['date_format']) ; 
          nmgp_Form_Datas($this->tp_entrydate, $this->field_config['tp_entrydate']['date_format'], $this->field_config['tp_entrydate']['date_sep']) ;  
      }
      elseif ('null' == $this->tp_entrydate || '' == $this->tp_entrydate)
      {
          $this->tp_entrydate = '';
      }
      if ((!empty($this->tp_updatedate) && 'null' != $this->tp_updatedate) || (!empty($format_fields) && isset($format_fields['tp_updatedate'])))
      {
          nm_volta_data($this->tp_updatedate, $this->field_config['tp_updatedate']['date_format']) ; 
          nmgp_Form_Datas($this->tp_updatedate, $this->field_config['tp_updatedate']['date_format'], $this->field_config['tp_updatedate']['date_sep']) ;  
      }
      elseif ('null' == $this->tp_updatedate || '' == $this->tp_updatedate)
      {
          $this->tp_updatedate = '';
      }
      if (!empty($this->tp_taskaktif_number) || (!empty($format_fields) && isset($format_fields['tp_taskaktif_number'])))
      {
          nmgp_Form_Num_Val($this->tp_taskaktif_number, $this->field_config['tp_taskaktif_number']['symbol_grp'], $this->field_config['tp_taskaktif_number']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tp_taskaktif_number']['symbol_fmt']) ; 
      }
      if (!empty($this->tp_taskaktifstatus) || (!empty($format_fields) && isset($format_fields['tp_taskaktifstatus'])))
      {
          nmgp_Form_Num_Val($this->tp_taskaktifstatus, $this->field_config['tp_taskaktifstatus']['symbol_grp'], $this->field_config['tp_taskaktifstatus']['symbol_dec'], "0", "S", "", "", "", "-", $this->field_config['tp_taskaktifstatus']['symbol_fmt']) ; 
      }
      if ((!empty($this->tp_taskaktifplanstart) && 'null' != $this->tp_taskaktifplanstart) || (!empty($format_fields) && isset($format_fields['tp_taskaktifplanstart'])))
      {
          nm_volta_data($this->tp_taskaktifplanstart, $this->field_config['tp_taskaktifplanstart']['date_format']) ; 
          nmgp_Form_Datas($this->tp_taskaktifplanstart, $this->field_config['tp_taskaktifplanstart']['date_format'], $this->field_config['tp_taskaktifplanstart']['date_sep']) ;  
      }
      elseif ('null' == $this->tp_taskaktifplanstart || '' == $this->tp_taskaktifplanstart)
      {
          $this->tp_taskaktifplanstart = '';
      }
      if ((!empty($this->tp_taskaktifplanfinish) && 'null' != $this->tp_taskaktifplanfinish) || (!empty($format_fields) && isset($format_fields['tp_taskaktifplanfinish'])))
      {
          nm_volta_data($this->tp_taskaktifplanfinish, $this->field_config['tp_taskaktifplanfinish']['date_format']) ; 
          nmgp_Form_Datas($this->tp_taskaktifplanfinish, $this->field_config['tp_taskaktifplanfinish']['date_format'], $this->field_config['tp_taskaktifplanfinish']['date_sep']) ;  
      }
      elseif ('null' == $this->tp_taskaktifplanfinish || '' == $this->tp_taskaktifplanfinish)
      {
          $this->tp_taskaktifplanfinish = '';
      }
      if ((!empty($this->tp_ischangetempdate) && 'null' != $this->tp_ischangetempdate) || (!empty($format_fields) && isset($format_fields['tp_ischangetempdate'])))
      {
          nm_volta_data($this->tp_ischangetempdate, $this->field_config['tp_ischangetempdate']['date_format']) ; 
          nmgp_Form_Datas($this->tp_ischangetempdate, $this->field_config['tp_ischangetempdate']['date_format'], $this->field_config['tp_ischangetempdate']['date_sep']) ;  
      }
      elseif ('null' == $this->tp_ischangetempdate || '' == $this->tp_ischangetempdate)
      {
          $this->tp_ischangetempdate = '';
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
      $guarda_format_hora = $this->field_config['tp_planstart']['date_format'];
      if ($this->tp_planstart != "")  
      { 
          nm_conv_data($this->tp_planstart, $this->field_config['tp_planstart']['date_format']) ; 
          $this->tp_planstart_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->tp_planstart_hora = substr($this->tp_planstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tp_planstart_hora = substr($this->tp_planstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->tp_planstart_hora = substr($this->tp_planstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->tp_planstart_hora = substr($this->tp_planstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->tp_planstart_hora = substr($this->tp_planstart_hora, 0, -4);
          }
          $this->tp_planstart .= " " . $this->tp_planstart_hora ; 
      } 
      if ($this->tp_planstart == "" && $use_null)  
      { 
          $this->tp_planstart = "null" ; 
      } 
      $this->field_config['tp_planstart']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['tp_planfinish']['date_format'];
      if ($this->tp_planfinish != "")  
      { 
          nm_conv_data($this->tp_planfinish, $this->field_config['tp_planfinish']['date_format']) ; 
          $this->tp_planfinish_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->tp_planfinish_hora = substr($this->tp_planfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tp_planfinish_hora = substr($this->tp_planfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->tp_planfinish_hora = substr($this->tp_planfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->tp_planfinish_hora = substr($this->tp_planfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->tp_planfinish_hora = substr($this->tp_planfinish_hora, 0, -4);
          }
          $this->tp_planfinish .= " " . $this->tp_planfinish_hora ; 
      } 
      if ($this->tp_planfinish == "" && $use_null)  
      { 
          $this->tp_planfinish = "null" ; 
      } 
      $this->field_config['tp_planfinish']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['tp_actualstart']['date_format'];
      if ($this->tp_actualstart != "")  
      { 
          nm_conv_data($this->tp_actualstart, $this->field_config['tp_actualstart']['date_format']) ; 
          $this->tp_actualstart_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->tp_actualstart_hora = substr($this->tp_actualstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tp_actualstart_hora = substr($this->tp_actualstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->tp_actualstart_hora = substr($this->tp_actualstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->tp_actualstart_hora = substr($this->tp_actualstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->tp_actualstart_hora = substr($this->tp_actualstart_hora, 0, -4);
          }
          $this->tp_actualstart .= " " . $this->tp_actualstart_hora ; 
      } 
      if ($this->tp_actualstart == "" && $use_null)  
      { 
          $this->tp_actualstart = "null" ; 
      } 
      $this->field_config['tp_actualstart']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['tp_actualfinish']['date_format'];
      if ($this->tp_actualfinish != "")  
      { 
          nm_conv_data($this->tp_actualfinish, $this->field_config['tp_actualfinish']['date_format']) ; 
          $this->tp_actualfinish_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->tp_actualfinish_hora = substr($this->tp_actualfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tp_actualfinish_hora = substr($this->tp_actualfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->tp_actualfinish_hora = substr($this->tp_actualfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->tp_actualfinish_hora = substr($this->tp_actualfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->tp_actualfinish_hora = substr($this->tp_actualfinish_hora, 0, -4);
          }
          $this->tp_actualfinish .= " " . $this->tp_actualfinish_hora ; 
      } 
      if ($this->tp_actualfinish == "" && $use_null)  
      { 
          $this->tp_actualfinish = "null" ; 
      } 
      $this->field_config['tp_actualfinish']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['tp_entrydate']['date_format'];
      if ($this->tp_entrydate != "")  
      { 
          nm_conv_data($this->tp_entrydate, $this->field_config['tp_entrydate']['date_format']) ; 
          $this->tp_entrydate_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->tp_entrydate_hora = substr($this->tp_entrydate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tp_entrydate_hora = substr($this->tp_entrydate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->tp_entrydate_hora = substr($this->tp_entrydate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->tp_entrydate_hora = substr($this->tp_entrydate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->tp_entrydate_hora = substr($this->tp_entrydate_hora, 0, -4);
          }
          $this->tp_entrydate .= " " . $this->tp_entrydate_hora ; 
      } 
      if ($this->tp_entrydate == "" && $use_null)  
      { 
          $this->tp_entrydate = "null" ; 
      } 
      $this->field_config['tp_entrydate']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['tp_updatedate']['date_format'];
      if ($this->tp_updatedate != "")  
      { 
          nm_conv_data($this->tp_updatedate, $this->field_config['tp_updatedate']['date_format']) ; 
          $this->tp_updatedate_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->tp_updatedate_hora = substr($this->tp_updatedate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tp_updatedate_hora = substr($this->tp_updatedate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->tp_updatedate_hora = substr($this->tp_updatedate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->tp_updatedate_hora = substr($this->tp_updatedate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->tp_updatedate_hora = substr($this->tp_updatedate_hora, 0, -4);
          }
          $this->tp_updatedate .= " " . $this->tp_updatedate_hora ; 
      } 
      if ($this->tp_updatedate == "" && $use_null)  
      { 
          $this->tp_updatedate = "null" ; 
      } 
      $this->field_config['tp_updatedate']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['tp_taskaktifplanstart']['date_format'];
      if ($this->tp_taskaktifplanstart != "")  
      { 
          nm_conv_data($this->tp_taskaktifplanstart, $this->field_config['tp_taskaktifplanstart']['date_format']) ; 
          $this->tp_taskaktifplanstart_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->tp_taskaktifplanstart_hora = substr($this->tp_taskaktifplanstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tp_taskaktifplanstart_hora = substr($this->tp_taskaktifplanstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->tp_taskaktifplanstart_hora = substr($this->tp_taskaktifplanstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->tp_taskaktifplanstart_hora = substr($this->tp_taskaktifplanstart_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->tp_taskaktifplanstart_hora = substr($this->tp_taskaktifplanstart_hora, 0, -4);
          }
          $this->tp_taskaktifplanstart .= " " . $this->tp_taskaktifplanstart_hora ; 
      } 
      if ($this->tp_taskaktifplanstart == "" && $use_null)  
      { 
          $this->tp_taskaktifplanstart = "null" ; 
      } 
      $this->field_config['tp_taskaktifplanstart']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['tp_taskaktifplanfinish']['date_format'];
      if ($this->tp_taskaktifplanfinish != "")  
      { 
          nm_conv_data($this->tp_taskaktifplanfinish, $this->field_config['tp_taskaktifplanfinish']['date_format']) ; 
          $this->tp_taskaktifplanfinish_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->tp_taskaktifplanfinish_hora = substr($this->tp_taskaktifplanfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tp_taskaktifplanfinish_hora = substr($this->tp_taskaktifplanfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->tp_taskaktifplanfinish_hora = substr($this->tp_taskaktifplanfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->tp_taskaktifplanfinish_hora = substr($this->tp_taskaktifplanfinish_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->tp_taskaktifplanfinish_hora = substr($this->tp_taskaktifplanfinish_hora, 0, -4);
          }
          $this->tp_taskaktifplanfinish .= " " . $this->tp_taskaktifplanfinish_hora ; 
      } 
      if ($this->tp_taskaktifplanfinish == "" && $use_null)  
      { 
          $this->tp_taskaktifplanfinish = "null" ; 
      } 
      $this->field_config['tp_taskaktifplanfinish']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['tp_ischangetempdate']['date_format'];
      if ($this->tp_ischangetempdate != "")  
      { 
          nm_conv_data($this->tp_ischangetempdate, $this->field_config['tp_ischangetempdate']['date_format']) ; 
          $this->tp_ischangetempdate_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->tp_ischangetempdate_hora = substr($this->tp_ischangetempdate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->tp_ischangetempdate_hora = substr($this->tp_ischangetempdate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->tp_ischangetempdate_hora = substr($this->tp_ischangetempdate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->tp_ischangetempdate_hora = substr($this->tp_ischangetempdate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->tp_ischangetempdate_hora = substr($this->tp_ischangetempdate_hora, 0, -4);
          }
          $this->tp_ischangetempdate .= " " . $this->tp_ischangetempdate_hora ; 
      } 
      if ($this->tp_ischangetempdate == "" && $use_null)  
      { 
          $this->tp_ischangetempdate = "null" ; 
      } 
      $this->field_config['tp_ischangetempdate']['date_format'] = $guarda_format_hora;
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
          $this->ajax_return_values_tp_id();
          $this->ajax_return_values_tp_thn_release();
          $this->ajax_return_values_tp_prjtrelease();
          $this->ajax_return_values_tp_batch();
          $this->ajax_return_values_tp_divre();
          $this->ajax_return_values_tp_witel();
          $this->ajax_return_values_tp_datel();
          $this->ajax_return_values_tp_sto();
          $this->ajax_return_values_tp_idlop();
          $this->ajax_return_values_tp_namalop();
          $this->ajax_return_values_tp_mitra();
          $this->ajax_return_values_tp_templateproject();
          $this->ajax_return_values_tp_targetwaktu();
          $this->ajax_return_values_tp_jenisproject();
          $this->ajax_return_values_tp_projectname();
          $this->ajax_return_values_tp_status();
          $this->ajax_return_values_tp_prosentase();
          $this->ajax_return_values_tp_planstart();
          $this->ajax_return_values_tp_planfinish();
          $this->ajax_return_values_tp_lokasi();
          $this->ajax_return_values_tp_nokontrak();
          $this->ajax_return_values_tp_ponumber();
          $this->ajax_return_values_tp_nilai();
          $this->ajax_return_values_tp_summary();
          $this->ajax_return_values_tp_rab();
          $this->ajax_return_values_tp_jmldistribusi();
          $this->ajax_return_values_tp_odp();
          $this->ajax_return_values_tp_jmlport();
          $this->ajax_return_values_tp_actualstart();
          $this->ajax_return_values_tp_actualfinish();
          $this->ajax_return_values_tp_entrydate();
          $this->ajax_return_values_tp_entryby();
          $this->ajax_return_values_tp_updatedate();
          $this->ajax_return_values_tp_updateby();
          $this->ajax_return_values_tp_taskaktif();
          $this->ajax_return_values_tp_taskaktif_number();
          $this->ajax_return_values_tp_tahapanaktif();
          $this->ajax_return_values_tp_taskaktifstatus();
          $this->ajax_return_values_tp_taskaktifplanstart();
          $this->ajax_return_values_tp_taskaktifplanfinish();
          $this->ajax_return_values_tp_is_change_template();
          $this->ajax_return_values_tp_ischangetempby();
          $this->ajax_return_values_tp_ischangetempdate();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['tp_id']['keyVal'] = tracking_project_viewdetail_mob_pack_protect_string($this->nmgp_dados_form['tp_id']);
          }
   } // ajax_return_values

          //----- tp_id
   function ajax_return_values_tp_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_thn_release
   function ajax_return_values_tp_thn_release($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_thn_release", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_thn_release);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_thn_release'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_prjtrelease
   function ajax_return_values_tp_prjtrelease($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_prjtrelease", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_prjtrelease);
              $aLookup = array();
              $this->_tmp_lookup_tp_prjtrelease = $this->tp_prjtrelease;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease'] = array(); 
}
$aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string('') => tracking_project_viewdetail_mob_pack_protect_string(''));
$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT TP_RELEASE, TP_RELEASENAME  FROM TBL_PROJECTRELEASE  ORDER BY TP_RELEASENAME";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1])));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease'][] = $rs->fields[0];
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
          $sSelComp = "name=\"tp_prjtrelease\"";
          if (isset($this->NM_ajax_info['select_html']['tp_prjtrelease']) && !empty($this->NM_ajax_info['select_html']['tp_prjtrelease']))
          {
              $sSelComp = $this->NM_ajax_info['select_html']['tp_prjtrelease'];
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

                  if ($this->tp_prjtrelease == $sValue)
                  {
                      $this->_tmp_lookup_tp_prjtrelease = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tp_prjtrelease'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tp_prjtrelease']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tp_prjtrelease']['valList'][$i] = tracking_project_viewdetail_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tp_prjtrelease']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tp_prjtrelease']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tp_prjtrelease']['labList'] = $aLabel;
          }
   }

          //----- tp_batch
   function ajax_return_values_tp_batch($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_batch", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_batch);
              $aLookup = array();
              $this->_tmp_lookup_tp_batch = $this->tp_batch;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch'] = array(); 
}
$aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string('') => tracking_project_viewdetail_mob_pack_protect_string('Pilh Batch'));
$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT KODESP, NAMABATCH  FROM TBL_BATCH  ORDER BY NAMABATCH";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1])));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch'][] = $rs->fields[0];
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
          $sSelComp = "name=\"tp_batch\"";
          if (isset($this->NM_ajax_info['select_html']['tp_batch']) && !empty($this->NM_ajax_info['select_html']['tp_batch']))
          {
              $sSelComp = $this->NM_ajax_info['select_html']['tp_batch'];
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

                  if ($this->tp_batch == $sValue)
                  {
                      $this->_tmp_lookup_tp_batch = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tp_batch'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tp_batch']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tp_batch']['valList'][$i] = tracking_project_viewdetail_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tp_batch']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tp_batch']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tp_batch']['labList'] = $aLabel;
          }
   }

          //----- tp_divre
   function ajax_return_values_tp_divre($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_divre", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_divre);
              $aLookup = array();
              $this->_tmp_lookup_tp_divre = $this->tp_divre;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre'] = array(); 
}
$aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string('') => tracking_project_viewdetail_mob_pack_protect_string('Pilih Divre'));
$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT MD_IDDIVRE, MD_KODEDIVRE  FROM TBL_MAS_DIVRE WHERE MD_IDDIVRE='" . $_SESSION['iddivre'] . "'  ORDER BY MD_KODEDIVRE";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1])));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre'][] = $rs->fields[0];
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
          $sSelComp = "name=\"tp_divre\"";
          if (isset($this->NM_ajax_info['select_html']['tp_divre']) && !empty($this->NM_ajax_info['select_html']['tp_divre']))
          {
              $sSelComp = $this->NM_ajax_info['select_html']['tp_divre'];
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

                  if ($this->tp_divre == $sValue)
                  {
                      $this->_tmp_lookup_tp_divre = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tp_divre'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tp_divre']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tp_divre']['valList'][$i] = tracking_project_viewdetail_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tp_divre']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tp_divre']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tp_divre']['labList'] = $aLabel;
          }
   }

          //----- tp_witel
   function ajax_return_values_tp_witel($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_witel", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_witel);
              $aLookup = array();
              $this->_tmp_lookup_tp_witel = $this->tp_witel;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel'] = array(); 
}
$aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string('') => tracking_project_viewdetail_mob_pack_protect_string('Pilih Witel'));
$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel'][] = '';
if ($this->tp_divre != "")
{ 
   $this->nm_clear_val("tp_divre");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT MW_IDWITEL, MW_NAMAWITEL  FROM TBL_MAS_WITEL  WHERE MW_IDDIVRE='$this->tp_divre' and MW_IDWITEL='" . $_SESSION['idwitel'] . "' ORDER BY MW_NAMAWITEL";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1])));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel'][] = $rs->fields[0];
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
} 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"tp_witel\"";
          if (isset($this->NM_ajax_info['select_html']['tp_witel']) && !empty($this->NM_ajax_info['select_html']['tp_witel']))
          {
              $sSelComp = $this->NM_ajax_info['select_html']['tp_witel'];
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

                  if ($this->tp_witel == $sValue)
                  {
                      $this->_tmp_lookup_tp_witel = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tp_witel'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tp_witel']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tp_witel']['valList'][$i] = tracking_project_viewdetail_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tp_witel']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tp_witel']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tp_witel']['labList'] = $aLabel;
          }
   }

          //----- tp_datel
   function ajax_return_values_tp_datel($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_datel", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_datel);
              $aLookup = array();
              $this->_tmp_lookup_tp_datel = $this->tp_datel;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel'] = array(); 
}
$aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string('') => tracking_project_viewdetail_mob_pack_protect_string(''));
$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel'][] = '';
if ($this->tp_witel != "")
{ 
   $this->nm_clear_val("tp_witel");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT MD_IDDATEL, MD_NAMADATEL  FROM TBL_MAS_DATEL  WHERE MD_IDWITEL='$this->tp_witel'  ORDER BY MD_NAMADATEL";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1])));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel'][] = $rs->fields[0];
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
} 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"tp_datel\"";
          if (isset($this->NM_ajax_info['select_html']['tp_datel']) && !empty($this->NM_ajax_info['select_html']['tp_datel']))
          {
              $sSelComp = $this->NM_ajax_info['select_html']['tp_datel'];
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

                  if ($this->tp_datel == $sValue)
                  {
                      $this->_tmp_lookup_tp_datel = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tp_datel'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tp_datel']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tp_datel']['valList'][$i] = tracking_project_viewdetail_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tp_datel']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tp_datel']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tp_datel']['labList'] = $aLabel;
          }
   }

          //----- tp_sto
   function ajax_return_values_tp_sto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_sto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_sto);
              $aLookup = array();
              $this->_tmp_lookup_tp_sto = $this->tp_sto;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto'] = array(); 
}
$aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string('') => tracking_project_viewdetail_mob_pack_protect_string('Pilih STO'));
$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto'][] = '';
if ($this->tp_datel != "")
{ 
   $this->nm_clear_val("tp_datel");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT MS_IDSTO, MS_NAMASTO  FROM TBL_MAS_STO  WHERE MS_DATEL='$this->tp_datel'  ORDER BY MS_NAMASTO";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1])));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto'][] = $rs->fields[0];
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
} 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"tp_sto\"";
          if (isset($this->NM_ajax_info['select_html']['tp_sto']) && !empty($this->NM_ajax_info['select_html']['tp_sto']))
          {
              $sSelComp = $this->NM_ajax_info['select_html']['tp_sto'];
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

                  if ($this->tp_sto == $sValue)
                  {
                      $this->_tmp_lookup_tp_sto = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tp_sto'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tp_sto']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tp_sto']['valList'][$i] = tracking_project_viewdetail_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tp_sto']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tp_sto']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tp_sto']['labList'] = $aLabel;
          }
   }

          //----- tp_idlop
   function ajax_return_values_tp_idlop($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_idlop", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_idlop);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_idlop'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_namalop
   function ajax_return_values_tp_namalop($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_namalop", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_namalop);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_namalop'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_mitra
   function ajax_return_values_tp_mitra($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_mitra", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_mitra);
              $aLookup = array();
              $this->_tmp_lookup_tp_mitra = $this->tp_mitra;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra'] = array(); 
}
$aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string('') => tracking_project_viewdetail_mob_pack_protect_string('Pilih Mitra'));
$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra'][] = '';
if ($this->tp_divre != "" && $this->tp_witel != "")
{ 
   $this->nm_clear_val("tp_divre");
   $this->nm_clear_val("tp_witel");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT TM_IDMITRA, TM_NAMAMITRA  FROM TBL_MITRA  WHERE TM_DIVRE='$this->tp_divre' AND TM_WITEL='$this->tp_witel'  ORDER BY TM_NAMAMITRA";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1])));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra'][] = $rs->fields[0];
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
} 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"tp_mitra\"";
          if (isset($this->NM_ajax_info['select_html']['tp_mitra']) && !empty($this->NM_ajax_info['select_html']['tp_mitra']))
          {
              $sSelComp = $this->NM_ajax_info['select_html']['tp_mitra'];
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

                  if ($this->tp_mitra == $sValue)
                  {
                      $this->_tmp_lookup_tp_mitra = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tp_mitra'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tp_mitra']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tp_mitra']['valList'][$i] = tracking_project_viewdetail_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tp_mitra']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tp_mitra']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tp_mitra']['labList'] = $aLabel;
          }
   }

          //----- tp_templateproject
   function ajax_return_values_tp_templateproject($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_templateproject", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_templateproject);
              $aLookup = array();
              $this->_tmp_lookup_tp_templateproject = $this->tp_templateproject;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject'] = array(); 
}
$aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string('') => tracking_project_viewdetail_mob_pack_protect_string(''));
$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT IDTEMPLATE, TEMPLATENAME  FROM TB_MASTER_TEMPLATE  ORDER BY TEMPLATENAME";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1])));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject'][] = $rs->fields[0];
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
          $sSelComp = "name=\"tp_templateproject\"";
          if (isset($this->NM_ajax_info['select_html']['tp_templateproject']) && !empty($this->NM_ajax_info['select_html']['tp_templateproject']))
          {
              $sSelComp = $this->NM_ajax_info['select_html']['tp_templateproject'];
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

                  if ($this->tp_templateproject == $sValue)
                  {
                      $this->_tmp_lookup_tp_templateproject = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tp_templateproject'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tp_templateproject']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tp_templateproject']['valList'][$i] = tracking_project_viewdetail_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tp_templateproject']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tp_templateproject']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tp_templateproject']['labList'] = $aLabel;
          }
   }

          //----- tp_targetwaktu
   function ajax_return_values_tp_targetwaktu($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_targetwaktu", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_targetwaktu);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_targetwaktu'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_jenisproject
   function ajax_return_values_tp_jenisproject($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_jenisproject", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_jenisproject);
              $aLookup = array();
              $this->_tmp_lookup_tp_jenisproject = $this->tp_jenisproject;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject'] = array(); 
}
$aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string('') => tracking_project_viewdetail_mob_pack_protect_string(''));
$_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT TJ_IDJENIS, TJ_NAMAJENIS  FROM TBL_JENISPROJECT  ORDER BY TJ_NAMAJENIS";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1])));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject'][] = $rs->fields[0];
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
          $sSelComp = "name=\"tp_jenisproject\"";
          if (isset($this->NM_ajax_info['select_html']['tp_jenisproject']) && !empty($this->NM_ajax_info['select_html']['tp_jenisproject']))
          {
              $sSelComp = $this->NM_ajax_info['select_html']['tp_jenisproject'];
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

                  if ($this->tp_jenisproject == $sValue)
                  {
                      $this->_tmp_lookup_tp_jenisproject = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['tp_jenisproject'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['tp_jenisproject']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['tp_jenisproject']['valList'][$i] = tracking_project_viewdetail_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['tp_jenisproject']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['tp_jenisproject']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['tp_jenisproject']['labList'] = $aLabel;
          }
   }

          //----- tp_projectname
   function ajax_return_values_tp_projectname($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_projectname", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_projectname);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_projectname'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_status
   function ajax_return_values_tp_status($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_status", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_status);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_status'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
              $orig_tp_status = $this->tp_status;
              $tp_status      = $this->tp_status;
              $this->tp_status = $tp_status;
              $this->lookup_tp_status($conteudo);
              $this->tp_status = $orig_tp_status;
              $this->NM_ajax_info['fldList']['tp_status']['lookupCons'] = tracking_project_viewdetail_mob_pack_protect_string(NM_charset_to_utf8($conteudo));
          }
   }

          //----- tp_prosentase
   function ajax_return_values_tp_prosentase($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_prosentase", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_prosentase);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_prosentase'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_planstart
   function ajax_return_values_tp_planstart($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_planstart", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_planstart);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_planstart'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_planfinish
   function ajax_return_values_tp_planfinish($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_planfinish", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_planfinish);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_planfinish'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_lokasi
   function ajax_return_values_tp_lokasi($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_lokasi", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_lokasi);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_lokasi'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_nokontrak
   function ajax_return_values_tp_nokontrak($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_nokontrak", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_nokontrak);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_nokontrak'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_ponumber
   function ajax_return_values_tp_ponumber($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_ponumber", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_ponumber);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_ponumber'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_nilai
   function ajax_return_values_tp_nilai($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_nilai", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_nilai);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_nilai'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_summary
   function ajax_return_values_tp_summary($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_summary", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_summary);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_summary'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_rab
   function ajax_return_values_tp_rab($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_rab", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_rab);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_rab'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_jmldistribusi
   function ajax_return_values_tp_jmldistribusi($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_jmldistribusi", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_jmldistribusi);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_jmldistribusi'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_odp
   function ajax_return_values_tp_odp($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_odp", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_odp);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_odp'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_jmlport
   function ajax_return_values_tp_jmlport($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_jmlport", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_jmlport);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_jmlport'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_actualstart
   function ajax_return_values_tp_actualstart($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_actualstart", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_actualstart);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_actualstart'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_actualfinish
   function ajax_return_values_tp_actualfinish($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_actualfinish", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_actualfinish);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_actualfinish'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_entrydate
   function ajax_return_values_tp_entrydate($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_entrydate", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_entrydate);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_entrydate'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_entryby
   function ajax_return_values_tp_entryby($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_entryby", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_entryby);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_entryby'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_updatedate
   function ajax_return_values_tp_updatedate($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_updatedate", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_updatedate);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_updatedate'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_updateby
   function ajax_return_values_tp_updateby($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_updateby", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_updateby);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_updateby'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_taskaktif
   function ajax_return_values_tp_taskaktif($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_taskaktif", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_taskaktif);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_taskaktif'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_taskaktif_number
   function ajax_return_values_tp_taskaktif_number($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_taskaktif_number", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_taskaktif_number);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_taskaktif_number'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_tahapanaktif
   function ajax_return_values_tp_tahapanaktif($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_tahapanaktif", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_tahapanaktif);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_tahapanaktif'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_taskaktifstatus
   function ajax_return_values_tp_taskaktifstatus($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_taskaktifstatus", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_taskaktifstatus);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_taskaktifstatus'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_taskaktifplanstart
   function ajax_return_values_tp_taskaktifplanstart($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_taskaktifplanstart", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_taskaktifplanstart);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_taskaktifplanstart'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_taskaktifplanfinish
   function ajax_return_values_tp_taskaktifplanfinish($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_taskaktifplanfinish", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_taskaktifplanfinish);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_taskaktifplanfinish'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- tp_is_change_template
   function ajax_return_values_tp_is_change_template($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_is_change_template", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_is_change_template);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_is_change_template'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_ischangetempby
   function ajax_return_values_tp_ischangetempby($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_ischangetempby", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_ischangetempby);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_ischangetempby'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- tp_ischangetempdate
   function ajax_return_values_tp_ischangetempdate($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("tp_ischangetempdate", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->tp_ischangetempdate);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['tp_ischangetempdate'] = array(
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['upload_dir'][$fieldName][] = $newName;
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
//
   function nm_troca_decimal($sc_parm1, $sc_parm2) 
   { 
      $this->tp_prosentase = str_replace($sc_parm1, $sc_parm2, $this->tp_prosentase); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->tp_prosentase = "'" . $this->tp_prosentase . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->tp_prosentase = str_replace("'", "", $this->tp_prosentase); 
   } 
//----------- 

   function return_after_insert()
   {
      global $sc_where;
      $sc_where_pos = " WHERE ((TP_ID < $this->tp_id))";
      if ('' != $sc_where)
      {
          if ('where ' == strtolower(substr(trim($sc_where), 0, 6)))
          {
              $sc_where = substr(trim($sc_where), 6);
          }
          if ('and ' == strtolower(substr(trim($sc_where), 0, 4)))
          {
              $sc_where = substr(trim($sc_where), 4);
          }
          $sc_where_pos .= ' AND (' . $sc_where . ')';
          $sc_where = ' WHERE ' . $sc_where;
      }
      if ('' != $this->tp_id)
      {
          $nmgp_sel_count = 'SELECT COUNT(*) FROM ' . $this->Ini->nm_tabela . $sc_where_pos;
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count;
          $rsc = $this->Db->Execute($nmgp_sel_count);
          if ($rsc === false && !$rsc->EOF)
          {
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg());
              exit;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start'] = $rsc->fields[0];
          $rsc->Close();
      }
   }

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
      if (!isset($this->tp_updateby)){$this->tp_updateby =  $_SESSION['usr_login'];}  
      if ('incluir' == $this->nmgp_opcao) { $this->tp_entryby = "" . $_SESSION['usr_login'] . ""; } 
      if ('alterar' == $this->nmgp_opcao || 'igual' == $this->nmgp_opcao) { $this->tp_updateby = "" . $_SESSION['usr_login'] . ""; } 
      $NM_val_form['tp_id'] = $this->tp_id;
      $NM_val_form['tp_thn_release'] = $this->tp_thn_release;
      $NM_val_form['tp_prjtrelease'] = $this->tp_prjtrelease;
      $NM_val_form['tp_batch'] = $this->tp_batch;
      $NM_val_form['tp_divre'] = $this->tp_divre;
      $NM_val_form['tp_witel'] = $this->tp_witel;
      $NM_val_form['tp_datel'] = $this->tp_datel;
      $NM_val_form['tp_sto'] = $this->tp_sto;
      $NM_val_form['tp_idlop'] = $this->tp_idlop;
      $NM_val_form['tp_namalop'] = $this->tp_namalop;
      $NM_val_form['tp_mitra'] = $this->tp_mitra;
      $NM_val_form['tp_templateproject'] = $this->tp_templateproject;
      $NM_val_form['tp_targetwaktu'] = $this->tp_targetwaktu;
      $NM_val_form['tp_jenisproject'] = $this->tp_jenisproject;
      $NM_val_form['tp_projectname'] = $this->tp_projectname;
      $NM_val_form['tp_status'] = $this->tp_status;
      $NM_val_form['tp_prosentase'] = $this->tp_prosentase;
      $NM_val_form['tp_planstart'] = $this->tp_planstart;
      $NM_val_form['tp_planfinish'] = $this->tp_planfinish;
      $NM_val_form['tp_lokasi'] = $this->tp_lokasi;
      $NM_val_form['tp_nokontrak'] = $this->tp_nokontrak;
      $NM_val_form['tp_ponumber'] = $this->tp_ponumber;
      $NM_val_form['tp_nilai'] = $this->tp_nilai;
      $NM_val_form['tp_summary'] = $this->tp_summary;
      $NM_val_form['tp_rab'] = $this->tp_rab;
      $NM_val_form['tp_jmldistribusi'] = $this->tp_jmldistribusi;
      $NM_val_form['tp_odp'] = $this->tp_odp;
      $NM_val_form['tp_jmlport'] = $this->tp_jmlport;
      $NM_val_form['tp_actualstart'] = $this->tp_actualstart;
      $NM_val_form['tp_actualfinish'] = $this->tp_actualfinish;
      $NM_val_form['tp_entrydate'] = $this->tp_entrydate;
      $NM_val_form['tp_entryby'] = $this->tp_entryby;
      $NM_val_form['tp_updatedate'] = $this->tp_updatedate;
      $NM_val_form['tp_updateby'] = $this->tp_updateby;
      $NM_val_form['tp_taskaktif'] = $this->tp_taskaktif;
      $NM_val_form['tp_taskaktif_number'] = $this->tp_taskaktif_number;
      $NM_val_form['tp_tahapanaktif'] = $this->tp_tahapanaktif;
      $NM_val_form['tp_taskaktifstatus'] = $this->tp_taskaktifstatus;
      $NM_val_form['tp_taskaktifplanstart'] = $this->tp_taskaktifplanstart;
      $NM_val_form['tp_taskaktifplanfinish'] = $this->tp_taskaktifplanfinish;
      $NM_val_form['tp_is_change_template'] = $this->tp_is_change_template;
      $NM_val_form['tp_ischangetempby'] = $this->tp_ischangetempby;
      $NM_val_form['tp_ischangetempdate'] = $this->tp_ischangetempdate;
      if ($this->tp_id == "")  
      { 
          $this->tp_id = 0;
      } 
      if ($this->tp_mitra == "")  
      { 
          $this->tp_mitra = 0;
          $this->sc_force_zero[] = 'tp_mitra';
      } 
      if ($this->tp_witel == "")  
      { 
          $this->tp_witel = 0;
          $this->sc_force_zero[] = 'tp_witel';
      } 
      if ($this->tp_sto == "")  
      { 
          $this->tp_sto = 0;
          $this->sc_force_zero[] = 'tp_sto';
      } 
      if ($this->tp_odp == "")  
      { 
          $this->tp_odp = 0;
          $this->sc_force_zero[] = 'tp_odp';
      } 
      if ($this->tp_status == "")  
      { 
          $this->tp_status = 0;
          $this->sc_force_zero[] = 'tp_status';
      } 
      if ($this->tp_templateproject == "")  
      { 
          $this->tp_templateproject = 0;
          $this->sc_force_zero[] = 'tp_templateproject';
      } 
      if ($this->tp_jenisproject == "")  
      { 
          $this->tp_jenisproject = 0;
          $this->sc_force_zero[] = 'tp_jenisproject';
      } 
      if ($this->tp_prjtrelease == "")  
      { 
          $this->tp_prjtrelease = 0;
          $this->sc_force_zero[] = 'tp_prjtrelease';
      } 
      if ($this->tp_targetwaktu == "")  
      { 
          $this->tp_targetwaktu = 0;
          $this->sc_force_zero[] = 'tp_targetwaktu';
      } 
      if ($this->tp_datel == "")  
      { 
          $this->tp_datel = 0;
          $this->sc_force_zero[] = 'tp_datel';
      } 
      if ($this->tp_divre == "")  
      { 
          $this->tp_divre = 0;
          $this->sc_force_zero[] = 'tp_divre';
      } 
      if ($this->tp_nilai == "")  
      { 
          $this->tp_nilai = 0;
          $this->sc_force_zero[] = 'tp_nilai';
      } 
      if ($this->tp_rab == "")  
      { 
          $this->tp_rab = 0;
          $this->sc_force_zero[] = 'tp_rab';
      } 
      if ($this->tp_jmldistribusi == "")  
      { 
          $this->tp_jmldistribusi = 0;
          $this->sc_force_zero[] = 'tp_jmldistribusi';
      } 
      if ($this->tp_taskaktif_number == "")  
      { 
          $this->tp_taskaktif_number = 0;
          $this->sc_force_zero[] = 'tp_taskaktif_number';
      } 
      if ($this->tp_prosentase == "")  
      { 
          $this->tp_prosentase = 0;
          $this->sc_force_zero[] = 'tp_prosentase';
      } 
      if ($this->tp_taskaktifstatus == "")  
      { 
          $this->tp_taskaktifstatus = 0;
          $this->sc_force_zero[] = 'tp_taskaktifstatus';
      } 
      if ($this->tp_jmlport == "")  
      { 
          $this->tp_jmlport = 0;
          $this->sc_force_zero[] = 'tp_jmlport';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql);
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->tp_batch_before_qstr = $this->tp_batch;
          $this->tp_batch = substr($this->Db->qstr($this->tp_batch), 1, -1); 
          if ($this->tp_batch == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_batch = "null"; 
              $NM_val_null[] = "tp_batch";
          } 
          $this->tp_projectname_before_qstr = $this->tp_projectname;
          $this->tp_projectname = substr($this->Db->qstr($this->tp_projectname), 1, -1); 
          if ($this->tp_projectname == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_projectname = "null"; 
              $NM_val_null[] = "tp_projectname";
          } 
          $this->tp_lokasi_before_qstr = $this->tp_lokasi;
          $this->tp_lokasi = substr($this->Db->qstr($this->tp_lokasi), 1, -1); 
          if ($this->tp_lokasi == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_lokasi = "null"; 
              $NM_val_null[] = "tp_lokasi";
          } 
          if ($this->tp_planstart == "")  
          { 
              $this->tp_planstart = "null"; 
              $NM_val_null[] = "tp_planstart";
          } 
          if ($this->tp_planfinish == "")  
          { 
              $this->tp_planfinish = "null"; 
              $NM_val_null[] = "tp_planfinish";
          } 
          if ($this->tp_entrydate == "")  
          { 
              $this->tp_entrydate = "null"; 
              $NM_val_null[] = "tp_entrydate";
          } 
          $this->tp_entryby_before_qstr = $this->tp_entryby;
          $this->tp_entryby = substr($this->Db->qstr($this->tp_entryby), 1, -1); 
          if ($this->tp_entryby == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_entryby = "null"; 
              $NM_val_null[] = "tp_entryby";
          } 
          if ($this->tp_updatedate == "")  
          { 
              $this->tp_updatedate = "null"; 
              $NM_val_null[] = "tp_updatedate";
          } 
          $this->tp_updateby_before_qstr = $this->tp_updateby;
          $this->tp_updateby = substr($this->Db->qstr($this->tp_updateby), 1, -1); 
          if ($this->tp_updateby == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_updateby = "null"; 
              $NM_val_null[] = "tp_updateby";
          } 
          $this->tp_summary_before_qstr = $this->tp_summary;
          $this->tp_summary = substr($this->Db->qstr($this->tp_summary), 1, -1); 
          if ($this->tp_summary == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_summary = "null"; 
              $NM_val_null[] = "tp_summary";
          } 
          if ($this->tp_actualstart == "")  
          { 
              $this->tp_actualstart = "null"; 
              $NM_val_null[] = "tp_actualstart";
          } 
          if ($this->tp_actualfinish == "")  
          { 
              $this->tp_actualfinish = "null"; 
              $NM_val_null[] = "tp_actualfinish";
          } 
          $this->tp_nokontrak_before_qstr = $this->tp_nokontrak;
          $this->tp_nokontrak = substr($this->Db->qstr($this->tp_nokontrak), 1, -1); 
          if ($this->tp_nokontrak == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_nokontrak = "null"; 
              $NM_val_null[] = "tp_nokontrak";
          } 
          $this->tp_ponumber_before_qstr = $this->tp_ponumber;
          $this->tp_ponumber = substr($this->Db->qstr($this->tp_ponumber), 1, -1); 
          if ($this->tp_ponumber == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_ponumber = "null"; 
              $NM_val_null[] = "tp_ponumber";
          } 
          $this->tp_idlop_before_qstr = $this->tp_idlop;
          $this->tp_idlop = substr($this->Db->qstr($this->tp_idlop), 1, -1); 
          if ($this->tp_idlop == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_idlop = "null"; 
              $NM_val_null[] = "tp_idlop";
          } 
          $this->tp_namalop_before_qstr = $this->tp_namalop;
          $this->tp_namalop = substr($this->Db->qstr($this->tp_namalop), 1, -1); 
          if ($this->tp_namalop == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_namalop = "null"; 
              $NM_val_null[] = "tp_namalop";
          } 
          $this->tp_is_change_template_before_qstr = $this->tp_is_change_template;
          $this->tp_is_change_template = substr($this->Db->qstr($this->tp_is_change_template), 1, -1); 
          if ($this->tp_is_change_template == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_is_change_template = "null"; 
              $NM_val_null[] = "tp_is_change_template";
          } 
          $this->tp_ischangetempby_before_qstr = $this->tp_ischangetempby;
          $this->tp_ischangetempby = substr($this->Db->qstr($this->tp_ischangetempby), 1, -1); 
          if ($this->tp_ischangetempby == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_ischangetempby = "null"; 
              $NM_val_null[] = "tp_ischangetempby";
          } 
          if ($this->tp_ischangetempdate == "")  
          { 
              $this->tp_ischangetempdate = "null"; 
              $NM_val_null[] = "tp_ischangetempdate";
          } 
          $this->tp_taskaktif_before_qstr = $this->tp_taskaktif;
          $this->tp_taskaktif = substr($this->Db->qstr($this->tp_taskaktif), 1, -1); 
          if ($this->tp_taskaktif == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_taskaktif = "null"; 
              $NM_val_null[] = "tp_taskaktif";
          } 
          $this->tp_tahapanaktif_before_qstr = $this->tp_tahapanaktif;
          $this->tp_tahapanaktif = substr($this->Db->qstr($this->tp_tahapanaktif), 1, -1); 
          if ($this->tp_tahapanaktif == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_tahapanaktif = "null"; 
              $NM_val_null[] = "tp_tahapanaktif";
          } 
          if ($this->tp_taskaktifplanstart == "")  
          { 
              $this->tp_taskaktifplanstart = "null"; 
              $NM_val_null[] = "tp_taskaktifplanstart";
          } 
          if ($this->tp_taskaktifplanfinish == "")  
          { 
              $this->tp_taskaktifplanfinish = "null"; 
              $NM_val_null[] = "tp_taskaktifplanfinish";
          } 
          $this->tp_thn_release_before_qstr = $this->tp_thn_release;
          $this->tp_thn_release = substr($this->Db->qstr($this->tp_thn_release), 1, -1); 
          if ($this->tp_thn_release == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->tp_thn_release = "null"; 
              $NM_val_null[] = "tp_thn_release";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_ex_update = true; 
          $SC_ex_upd_or = true; 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id ";
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 tracking_project_viewdetail_mob_pack_ajax_response();
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
              $this->tp_updatedate =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->tp_updatedate_hora =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $NM_val_form['tp_updatedate'] = $this->tp_updatedate;
              $this->NM_ajax_changed['tp_updatedate'] = true;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET TP_BATCH = '$this->tp_batch', TP_PROJECTNAME = '$this->tp_projectname', TP_LOKASI = '$this->tp_lokasi', TP_MITRA = $this->tp_mitra, TP_WITEL = $this->tp_witel, TP_STO = $this->tp_sto, TP_ODP = $this->tp_odp, TP_PLANSTART = #$this->tp_planstart#, TP_ENTRYDATE = #$this->tp_entrydate#, TP_ENTRYBY = '$this->tp_entryby', TP_UPDATEDATE = #$this->tp_updatedate#, TP_UPDATEBY = '$this->tp_updateby', TP_SUMMARY = '$this->tp_summary', TP_ACTUALSTART = #$this->tp_actualstart#, TP_ACTUALFINISH = #$this->tp_actualfinish#, TP_TEMPLATEPROJECT = $this->tp_templateproject, TP_JENISPROJECT = $this->tp_jenisproject, TP_PRJTRELEASE = $this->tp_prjtrelease, TP_TARGETWAKTU = $this->tp_targetwaktu, TP_DATEL = $this->tp_datel, TP_NOKONTRAK = '$this->tp_nokontrak', TP_PONUMBER = '$this->tp_ponumber', TP_DIVRE = $this->tp_divre, TP_IDLOP = '$this->tp_idlop', TP_NAMALOP = '$this->tp_namalop', TP_NILAI = $this->tp_nilai, TP_RAB = $this->tp_rab, TP_IS_CHANGE_TEMPLATE = '$this->tp_is_change_template', TP_ISCHANGETEMPBY = '$this->tp_ischangetempby', TP_ISCHANGETEMPDATE = #$this->tp_ischangetempdate#, TP_JMLDISTRIBUSI = $this->tp_jmldistribusi, TP_TASKAKTIF = '$this->tp_taskaktif', TP_TASKAKTIF_NUMBER = $this->tp_taskaktif_number, TP_PROSENTASE = $this->tp_prosentase, TP_TAHAPANAKTIF = '$this->tp_tahapanaktif', TP_TASKAKTIFSTATUS = $this->tp_taskaktifstatus, TP_TASKAKTIFPLANSTART = #$this->tp_taskaktifplanstart#, TP_TASKAKTIFPLANFINISH = #$this->tp_taskaktifplanfinish#, TP_JMLPORT = $this->tp_jmlport, TP_THN_RELEASE = '$this->tp_thn_release'";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET TP_BATCH = '$this->tp_batch', TP_PROJECTNAME = '$this->tp_projectname', TP_LOKASI = '$this->tp_lokasi', TP_MITRA = $this->tp_mitra, TP_WITEL = $this->tp_witel, TP_STO = $this->tp_sto, TP_ODP = $this->tp_odp, TP_PLANSTART = " . $this->Ini->date_delim . $this->tp_planstart . $this->Ini->date_delim1 . ", TP_ENTRYDATE = " . $this->Ini->date_delim . $this->tp_entrydate . $this->Ini->date_delim1 . ", TP_ENTRYBY = '$this->tp_entryby', TP_UPDATEDATE = " . $this->Ini->date_delim . $this->tp_updatedate . $this->Ini->date_delim1 . ", TP_UPDATEBY = '$this->tp_updateby', TP_SUMMARY = '$this->tp_summary', TP_ACTUALSTART = " . $this->Ini->date_delim . $this->tp_actualstart . $this->Ini->date_delim1 . ", TP_ACTUALFINISH = " . $this->Ini->date_delim . $this->tp_actualfinish . $this->Ini->date_delim1 . ", TP_TEMPLATEPROJECT = $this->tp_templateproject, TP_JENISPROJECT = $this->tp_jenisproject, TP_PRJTRELEASE = $this->tp_prjtrelease, TP_TARGETWAKTU = $this->tp_targetwaktu, TP_DATEL = $this->tp_datel, TP_NOKONTRAK = '$this->tp_nokontrak', TP_PONUMBER = '$this->tp_ponumber', TP_DIVRE = $this->tp_divre, TP_IDLOP = '$this->tp_idlop', TP_NAMALOP = '$this->tp_namalop', TP_NILAI = $this->tp_nilai, TP_RAB = $this->tp_rab, TP_IS_CHANGE_TEMPLATE = '$this->tp_is_change_template', TP_ISCHANGETEMPBY = '$this->tp_ischangetempby', TP_ISCHANGETEMPDATE = " . $this->Ini->date_delim . $this->tp_ischangetempdate . $this->Ini->date_delim1 . ", TP_JMLDISTRIBUSI = $this->tp_jmldistribusi, TP_TASKAKTIF = '$this->tp_taskaktif', TP_TASKAKTIF_NUMBER = $this->tp_taskaktif_number, TP_PROSENTASE = $this->tp_prosentase, TP_TAHAPANAKTIF = '$this->tp_tahapanaktif', TP_TASKAKTIFSTATUS = $this->tp_taskaktifstatus, TP_TASKAKTIFPLANSTART = " . $this->Ini->date_delim . $this->tp_taskaktifplanstart . $this->Ini->date_delim1 . ", TP_TASKAKTIFPLANFINISH = " . $this->Ini->date_delim . $this->tp_taskaktifplanfinish . $this->Ini->date_delim1 . ", TP_JMLPORT = $this->tp_jmlport, TP_THN_RELEASE = '$this->tp_thn_release'";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET TP_BATCH = '$this->tp_batch', TP_PROJECTNAME = '$this->tp_projectname', TP_LOKASI = '$this->tp_lokasi', TP_MITRA = $this->tp_mitra, TP_WITEL = $this->tp_witel, TP_STO = $this->tp_sto, TP_ODP = $this->tp_odp, TP_PLANSTART = " . $this->Ini->date_delim . $this->tp_planstart . $this->Ini->date_delim1 . ", TP_ENTRYDATE = " . $this->Ini->date_delim . $this->tp_entrydate . $this->Ini->date_delim1 . ", TP_ENTRYBY = '$this->tp_entryby', TP_UPDATEDATE = " . $this->Ini->date_delim . $this->tp_updatedate . $this->Ini->date_delim1 . ", TP_UPDATEBY = '$this->tp_updateby', TP_SUMMARY = '$this->tp_summary', TP_ACTUALSTART = " . $this->Ini->date_delim . $this->tp_actualstart . $this->Ini->date_delim1 . ", TP_ACTUALFINISH = " . $this->Ini->date_delim . $this->tp_actualfinish . $this->Ini->date_delim1 . ", TP_TEMPLATEPROJECT = $this->tp_templateproject, TP_JENISPROJECT = $this->tp_jenisproject, TP_PRJTRELEASE = $this->tp_prjtrelease, TP_TARGETWAKTU = $this->tp_targetwaktu, TP_DATEL = $this->tp_datel, TP_NOKONTRAK = '$this->tp_nokontrak', TP_PONUMBER = '$this->tp_ponumber', TP_DIVRE = $this->tp_divre, TP_IDLOP = '$this->tp_idlop', TP_NAMALOP = '$this->tp_namalop', TP_NILAI = $this->tp_nilai, TP_RAB = $this->tp_rab, TP_IS_CHANGE_TEMPLATE = '$this->tp_is_change_template', TP_ISCHANGETEMPBY = '$this->tp_ischangetempby', TP_ISCHANGETEMPDATE = " . $this->Ini->date_delim . $this->tp_ischangetempdate . $this->Ini->date_delim1 . ", TP_JMLDISTRIBUSI = $this->tp_jmldistribusi, TP_TASKAKTIF = '$this->tp_taskaktif', TP_TASKAKTIF_NUMBER = $this->tp_taskaktif_number, TP_PROSENTASE = $this->tp_prosentase, TP_TAHAPANAKTIF = '$this->tp_tahapanaktif', TP_TASKAKTIFSTATUS = $this->tp_taskaktifstatus, TP_TASKAKTIFPLANSTART = " . $this->Ini->date_delim . $this->tp_taskaktifplanstart . $this->Ini->date_delim1 . ", TP_TASKAKTIFPLANFINISH = " . $this->Ini->date_delim . $this->tp_taskaktifplanfinish . $this->Ini->date_delim1 . ", TP_JMLPORT = $this->tp_jmlport, TP_THN_RELEASE = '$this->tp_thn_release'";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET TP_BATCH = '$this->tp_batch', TP_PROJECTNAME = '$this->tp_projectname', TP_LOKASI = '$this->tp_lokasi', TP_MITRA = $this->tp_mitra, TP_WITEL = $this->tp_witel, TP_STO = $this->tp_sto, TP_ODP = $this->tp_odp, TP_PLANSTART = EXTEND('$this->tp_planstart', YEAR TO FRACTION), TP_ENTRYDATE = EXTEND('$this->tp_entrydate', YEAR TO FRACTION), TP_ENTRYBY = '$this->tp_entryby', TP_UPDATEDATE = EXTEND('$this->tp_updatedate', YEAR TO FRACTION), TP_UPDATEBY = '$this->tp_updateby', TP_SUMMARY = '$this->tp_summary', TP_ACTUALSTART = EXTEND('$this->tp_actualstart', YEAR TO FRACTION), TP_ACTUALFINISH = EXTEND('$this->tp_actualfinish', YEAR TO FRACTION), TP_TEMPLATEPROJECT = $this->tp_templateproject, TP_JENISPROJECT = $this->tp_jenisproject, TP_PRJTRELEASE = $this->tp_prjtrelease, TP_TARGETWAKTU = $this->tp_targetwaktu, TP_DATEL = $this->tp_datel, TP_NOKONTRAK = '$this->tp_nokontrak', TP_PONUMBER = '$this->tp_ponumber', TP_DIVRE = $this->tp_divre, TP_IDLOP = '$this->tp_idlop', TP_NAMALOP = '$this->tp_namalop', TP_NILAI = $this->tp_nilai, TP_RAB = $this->tp_rab, TP_IS_CHANGE_TEMPLATE = '$this->tp_is_change_template', TP_ISCHANGETEMPBY = '$this->tp_ischangetempby', TP_ISCHANGETEMPDATE = EXTEND('$this->tp_ischangetempdate', YEAR TO FRACTION), TP_JMLDISTRIBUSI = $this->tp_jmldistribusi, TP_TASKAKTIF = '$this->tp_taskaktif', TP_TASKAKTIF_NUMBER = $this->tp_taskaktif_number, TP_PROSENTASE = $this->tp_prosentase, TP_TAHAPANAKTIF = '$this->tp_tahapanaktif', TP_TASKAKTIFSTATUS = $this->tp_taskaktifstatus, TP_TASKAKTIFPLANSTART = EXTEND('$this->tp_taskaktifplanstart', YEAR TO FRACTION), TP_TASKAKTIFPLANFINISH = EXTEND('$this->tp_taskaktifplanfinish', YEAR TO FRACTION), TP_JMLPORT = $this->tp_jmlport, TP_THN_RELEASE = '$this->tp_thn_release'";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET TP_BATCH = '$this->tp_batch', TP_PROJECTNAME = '$this->tp_projectname', TP_LOKASI = '$this->tp_lokasi', TP_MITRA = $this->tp_mitra, TP_WITEL = $this->tp_witel, TP_STO = $this->tp_sto, TP_ODP = $this->tp_odp, TP_PLANSTART = " . $this->Ini->date_delim . $this->tp_planstart . $this->Ini->date_delim1 . ", TP_ENTRYDATE = " . $this->Ini->date_delim . $this->tp_entrydate . $this->Ini->date_delim1 . ", TP_ENTRYBY = '$this->tp_entryby', TP_UPDATEDATE = " . $this->Ini->date_delim . $this->tp_updatedate . $this->Ini->date_delim1 . ", TP_UPDATEBY = '$this->tp_updateby', TP_SUMMARY = '$this->tp_summary', TP_ACTUALSTART = " . $this->Ini->date_delim . $this->tp_actualstart . $this->Ini->date_delim1 . ", TP_ACTUALFINISH = " . $this->Ini->date_delim . $this->tp_actualfinish . $this->Ini->date_delim1 . ", TP_TEMPLATEPROJECT = $this->tp_templateproject, TP_JENISPROJECT = $this->tp_jenisproject, TP_PRJTRELEASE = $this->tp_prjtrelease, TP_TARGETWAKTU = $this->tp_targetwaktu, TP_DATEL = $this->tp_datel, TP_NOKONTRAK = '$this->tp_nokontrak', TP_PONUMBER = '$this->tp_ponumber', TP_DIVRE = $this->tp_divre, TP_IDLOP = '$this->tp_idlop', TP_NAMALOP = '$this->tp_namalop', TP_NILAI = $this->tp_nilai, TP_RAB = $this->tp_rab, TP_IS_CHANGE_TEMPLATE = '$this->tp_is_change_template', TP_ISCHANGETEMPBY = '$this->tp_ischangetempby', TP_ISCHANGETEMPDATE = " . $this->Ini->date_delim . $this->tp_ischangetempdate . $this->Ini->date_delim1 . ", TP_JMLDISTRIBUSI = $this->tp_jmldistribusi, TP_TASKAKTIF = '$this->tp_taskaktif', TP_TASKAKTIF_NUMBER = $this->tp_taskaktif_number, TP_PROSENTASE = $this->tp_prosentase, TP_TAHAPANAKTIF = '$this->tp_tahapanaktif', TP_TASKAKTIFSTATUS = $this->tp_taskaktifstatus, TP_TASKAKTIFPLANSTART = " . $this->Ini->date_delim . $this->tp_taskaktifplanstart . $this->Ini->date_delim1 . ", TP_TASKAKTIFPLANFINISH = " . $this->Ini->date_delim . $this->tp_taskaktifplanfinish . $this->Ini->date_delim1 . ", TP_JMLPORT = $this->tp_jmlport, TP_THN_RELEASE = '$this->tp_thn_release'";  
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando_oracle = "UPDATE " . $this->Ini->nm_tabela . " SET TP_BATCH = '$this->tp_batch', TP_PROJECTNAME = '$this->tp_projectname', TP_LOKASI = '$this->tp_lokasi', TP_MITRA = $this->tp_mitra, TP_WITEL = $this->tp_witel, TP_STO = $this->tp_sto, TP_ODP = $this->tp_odp, TP_PLANSTART = " . $this->Ini->date_delim . $this->tp_planstart . $this->Ini->date_delim1 . ", TP_ENTRYDATE = " . $this->Ini->date_delim . $this->tp_entrydate . $this->Ini->date_delim1 . ", TP_ENTRYBY = '$this->tp_entryby', TP_UPDATEDATE = " . $this->Ini->date_delim . $this->tp_updatedate . $this->Ini->date_delim1 . ", TP_UPDATEBY = '$this->tp_updateby', TP_SUMMARY = '$this->tp_summary', TP_ACTUALSTART = " . $this->Ini->date_delim . $this->tp_actualstart . $this->Ini->date_delim1 . ", TP_ACTUALFINISH = " . $this->Ini->date_delim . $this->tp_actualfinish . $this->Ini->date_delim1 . ", TP_TEMPLATEPROJECT = $this->tp_templateproject, TP_JENISPROJECT = $this->tp_jenisproject, TP_PRJTRELEASE = $this->tp_prjtrelease, TP_TARGETWAKTU = $this->tp_targetwaktu, TP_DATEL = $this->tp_datel, TP_NOKONTRAK = '$this->tp_nokontrak', TP_PONUMBER = '$this->tp_ponumber', TP_DIVRE = $this->tp_divre, TP_IDLOP = '$this->tp_idlop', TP_NAMALOP = '$this->tp_namalop', TP_NILAI = $this->tp_nilai, TP_RAB = $this->tp_rab, TP_IS_CHANGE_TEMPLATE = '$this->tp_is_change_template', TP_ISCHANGETEMPBY = '$this->tp_ischangetempby', TP_ISCHANGETEMPDATE = " . $this->Ini->date_delim . $this->tp_ischangetempdate . $this->Ini->date_delim1 . ", TP_JMLDISTRIBUSI = $this->tp_jmldistribusi, TP_TASKAKTIF = '$this->tp_taskaktif', TP_TASKAKTIF_NUMBER = $this->tp_taskaktif_number, TP_PROSENTASE = $this->tp_prosentase, TP_TAHAPANAKTIF = '$this->tp_tahapanaktif', TP_TASKAKTIFSTATUS = $this->tp_taskaktifstatus, TP_TASKAKTIFPLANSTART = " . $this->Ini->date_delim . $this->tp_taskaktifplanstart . $this->Ini->date_delim1 . ", TP_TASKAKTIFPLANFINISH = " . $this->Ini->date_delim . $this->tp_taskaktifplanfinish . $this->Ini->date_delim1 . ", TP_JMLPORT = $this->tp_jmlport, TP_THN_RELEASE = '$this->tp_thn_release'";  
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET TP_BATCH = '$this->tp_batch', TP_PROJECTNAME = '$this->tp_projectname', TP_LOKASI = '$this->tp_lokasi', TP_MITRA = $this->tp_mitra, TP_WITEL = $this->tp_witel, TP_STO = $this->tp_sto, TP_ODP = $this->tp_odp, TP_PLANSTART = " . $this->Ini->date_delim . $this->tp_planstart . $this->Ini->date_delim1 . ", TP_ENTRYDATE = " . $this->Ini->date_delim . $this->tp_entrydate . $this->Ini->date_delim1 . ", TP_ENTRYBY = '$this->tp_entryby', TP_UPDATEDATE = " . $this->Ini->date_delim . $this->tp_updatedate . $this->Ini->date_delim1 . ", TP_UPDATEBY = '$this->tp_updateby', TP_SUMMARY = '$this->tp_summary', TP_ACTUALSTART = " . $this->Ini->date_delim . $this->tp_actualstart . $this->Ini->date_delim1 . ", TP_ACTUALFINISH = " . $this->Ini->date_delim . $this->tp_actualfinish . $this->Ini->date_delim1 . ", TP_TEMPLATEPROJECT = $this->tp_templateproject, TP_JENISPROJECT = $this->tp_jenisproject, TP_PRJTRELEASE = $this->tp_prjtrelease, TP_TARGETWAKTU = $this->tp_targetwaktu, TP_DATEL = $this->tp_datel, TP_NOKONTRAK = '$this->tp_nokontrak', TP_PONUMBER = '$this->tp_ponumber', TP_DIVRE = $this->tp_divre, TP_IDLOP = '$this->tp_idlop', TP_NAMALOP = '$this->tp_namalop', TP_NILAI = $this->tp_nilai, TP_RAB = $this->tp_rab, TP_IS_CHANGE_TEMPLATE = '$this->tp_is_change_template', TP_ISCHANGETEMPBY = '$this->tp_ischangetempby', TP_ISCHANGETEMPDATE = " . $this->Ini->date_delim . $this->tp_ischangetempdate . $this->Ini->date_delim1 . ", TP_JMLDISTRIBUSI = $this->tp_jmldistribusi, TP_TASKAKTIF = '$this->tp_taskaktif', TP_TASKAKTIF_NUMBER = $this->tp_taskaktif_number, TP_PROSENTASE = $this->tp_prosentase, TP_TAHAPANAKTIF = '$this->tp_tahapanaktif', TP_TASKAKTIFSTATUS = $this->tp_taskaktifstatus, TP_TASKAKTIFPLANSTART = " . $this->Ini->date_delim . $this->tp_taskaktifplanstart . $this->Ini->date_delim1 . ", TP_TASKAKTIFPLANFINISH = " . $this->Ini->date_delim . $this->tp_taskaktifplanfinish . $this->Ini->date_delim1 . ", TP_JMLPORT = $this->tp_jmlport, TP_THN_RELEASE = '$this->tp_thn_release'";  
              } 
              if (isset($NM_val_form['tp_planfinish']) && $NM_val_form['tp_planfinish'] != $this->nmgp_dados_select['tp_planfinish']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $comando        .= " TP_PLANFINISH = #$this->tp_planfinish#"; 
                  } 
                  else 
                  { 
                      $comando        .= " TP_PLANFINISH = " . $this->Ini->date_delim . $this->tp_planfinish . $this->Ini->date_delim1 . ""; 
                  } 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $comando_oracle        .= " TP_PLANFINISH = EXTEND('" . $this->tp_planfinish . "', YEAR TO FRACTION)"; 
                  } 
                  else
                  { 
                      $comando_oracle        .= " TP_PLANFINISH = " . $this->Ini->date_delim . $this->tp_planfinish . $this->Ini->date_delim1 . ""; 
                  } 
                  $SC_ex_update = true; 
                  $SC_ex_upd_or = true; 
              } 
              if (isset($NM_val_form['tp_status']) && $NM_val_form['tp_status'] != $this->nmgp_dados_select['tp_status']) 
              { 
                  if ($SC_ex_update || $SC_tem_cmp_update) 
                  { 
                      $comando        .= ","; 
                      $comando_oracle .= ","; 
                  } 
                  $comando        .= " TP_STATUS = $this->tp_status"; 
                  $comando_oracle        .= " TP_STATUS = $this->tp_status"; 
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
                  $comando .= " WHERE TP_ID = $this->tp_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE TP_ID = $this->tp_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE TP_ID = $this->tp_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE TP_ID = $this->tp_id ";  
              }  
              else  
              {
                  $comando .= " WHERE TP_ID = $this->tp_id ";  
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
                                  tracking_project_viewdetail_mob_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
              }   
          $this->tp_batch = $this->tp_batch_before_qstr;
          $this->tp_projectname = $this->tp_projectname_before_qstr;
          $this->tp_lokasi = $this->tp_lokasi_before_qstr;
          $this->tp_entryby = $this->tp_entryby_before_qstr;
          $this->tp_updateby = $this->tp_updateby_before_qstr;
          $this->tp_summary = $this->tp_summary_before_qstr;
          $this->tp_nokontrak = $this->tp_nokontrak_before_qstr;
          $this->tp_ponumber = $this->tp_ponumber_before_qstr;
          $this->tp_idlop = $this->tp_idlop_before_qstr;
          $this->tp_namalop = $this->tp_namalop_before_qstr;
          $this->tp_is_change_template = $this->tp_is_change_template_before_qstr;
          $this->tp_ischangetempby = $this->tp_ischangetempby_before_qstr;
          $this->tp_taskaktif = $this->tp_taskaktif_before_qstr;
          $this->tp_tahapanaktif = $this->tp_tahapanaktif_before_qstr;
          $this->tp_thn_release = $this->tp_thn_release_before_qstr;
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['db_changed'] = true;


              if     (isset($NM_val_form) && isset($NM_val_form['tp_id'])) { $this->tp_id = $NM_val_form['tp_id']; }
              elseif (isset($this->tp_id)) { $this->nm_limpa_alfa($this->tp_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_batch'])) { $this->tp_batch = $NM_val_form['tp_batch']; }
              elseif (isset($this->tp_batch)) { $this->nm_limpa_alfa($this->tp_batch); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_projectname'])) { $this->tp_projectname = $NM_val_form['tp_projectname']; }
              elseif (isset($this->tp_projectname)) { $this->nm_limpa_alfa($this->tp_projectname); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_lokasi'])) { $this->tp_lokasi = $NM_val_form['tp_lokasi']; }
              elseif (isset($this->tp_lokasi)) { $this->nm_limpa_alfa($this->tp_lokasi); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_mitra'])) { $this->tp_mitra = $NM_val_form['tp_mitra']; }
              elseif (isset($this->tp_mitra)) { $this->nm_limpa_alfa($this->tp_mitra); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_witel'])) { $this->tp_witel = $NM_val_form['tp_witel']; }
              elseif (isset($this->tp_witel)) { $this->nm_limpa_alfa($this->tp_witel); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_sto'])) { $this->tp_sto = $NM_val_form['tp_sto']; }
              elseif (isset($this->tp_sto)) { $this->nm_limpa_alfa($this->tp_sto); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_odp'])) { $this->tp_odp = $NM_val_form['tp_odp']; }
              elseif (isset($this->tp_odp)) { $this->nm_limpa_alfa($this->tp_odp); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_entryby'])) { $this->tp_entryby = $NM_val_form['tp_entryby']; }
              elseif (isset($this->tp_entryby)) { $this->nm_limpa_alfa($this->tp_entryby); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_updateby'])) { $this->tp_updateby = $NM_val_form['tp_updateby']; }
              elseif (isset($this->tp_updateby)) { $this->nm_limpa_alfa($this->tp_updateby); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_status'])) { $this->tp_status = $NM_val_form['tp_status']; }
              elseif (isset($this->tp_status)) { $this->nm_limpa_alfa($this->tp_status); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_templateproject'])) { $this->tp_templateproject = $NM_val_form['tp_templateproject']; }
              elseif (isset($this->tp_templateproject)) { $this->nm_limpa_alfa($this->tp_templateproject); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_jenisproject'])) { $this->tp_jenisproject = $NM_val_form['tp_jenisproject']; }
              elseif (isset($this->tp_jenisproject)) { $this->nm_limpa_alfa($this->tp_jenisproject); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_prjtrelease'])) { $this->tp_prjtrelease = $NM_val_form['tp_prjtrelease']; }
              elseif (isset($this->tp_prjtrelease)) { $this->nm_limpa_alfa($this->tp_prjtrelease); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_targetwaktu'])) { $this->tp_targetwaktu = $NM_val_form['tp_targetwaktu']; }
              elseif (isset($this->tp_targetwaktu)) { $this->nm_limpa_alfa($this->tp_targetwaktu); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_datel'])) { $this->tp_datel = $NM_val_form['tp_datel']; }
              elseif (isset($this->tp_datel)) { $this->nm_limpa_alfa($this->tp_datel); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_nokontrak'])) { $this->tp_nokontrak = $NM_val_form['tp_nokontrak']; }
              elseif (isset($this->tp_nokontrak)) { $this->nm_limpa_alfa($this->tp_nokontrak); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_ponumber'])) { $this->tp_ponumber = $NM_val_form['tp_ponumber']; }
              elseif (isset($this->tp_ponumber)) { $this->nm_limpa_alfa($this->tp_ponumber); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_divre'])) { $this->tp_divre = $NM_val_form['tp_divre']; }
              elseif (isset($this->tp_divre)) { $this->nm_limpa_alfa($this->tp_divre); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_idlop'])) { $this->tp_idlop = $NM_val_form['tp_idlop']; }
              elseif (isset($this->tp_idlop)) { $this->nm_limpa_alfa($this->tp_idlop); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_namalop'])) { $this->tp_namalop = $NM_val_form['tp_namalop']; }
              elseif (isset($this->tp_namalop)) { $this->nm_limpa_alfa($this->tp_namalop); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_nilai'])) { $this->tp_nilai = $NM_val_form['tp_nilai']; }
              elseif (isset($this->tp_nilai)) { $this->nm_limpa_alfa($this->tp_nilai); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_rab'])) { $this->tp_rab = $NM_val_form['tp_rab']; }
              elseif (isset($this->tp_rab)) { $this->nm_limpa_alfa($this->tp_rab); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_is_change_template'])) { $this->tp_is_change_template = $NM_val_form['tp_is_change_template']; }
              elseif (isset($this->tp_is_change_template)) { $this->nm_limpa_alfa($this->tp_is_change_template); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_ischangetempby'])) { $this->tp_ischangetempby = $NM_val_form['tp_ischangetempby']; }
              elseif (isset($this->tp_ischangetempby)) { $this->nm_limpa_alfa($this->tp_ischangetempby); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_jmldistribusi'])) { $this->tp_jmldistribusi = $NM_val_form['tp_jmldistribusi']; }
              elseif (isset($this->tp_jmldistribusi)) { $this->nm_limpa_alfa($this->tp_jmldistribusi); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_taskaktif'])) { $this->tp_taskaktif = $NM_val_form['tp_taskaktif']; }
              elseif (isset($this->tp_taskaktif)) { $this->nm_limpa_alfa($this->tp_taskaktif); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_taskaktif_number'])) { $this->tp_taskaktif_number = $NM_val_form['tp_taskaktif_number']; }
              elseif (isset($this->tp_taskaktif_number)) { $this->nm_limpa_alfa($this->tp_taskaktif_number); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_prosentase'])) { $this->tp_prosentase = $NM_val_form['tp_prosentase']; }
              elseif (isset($this->tp_prosentase)) { $this->nm_limpa_alfa($this->tp_prosentase); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_tahapanaktif'])) { $this->tp_tahapanaktif = $NM_val_form['tp_tahapanaktif']; }
              elseif (isset($this->tp_tahapanaktif)) { $this->nm_limpa_alfa($this->tp_tahapanaktif); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_taskaktifstatus'])) { $this->tp_taskaktifstatus = $NM_val_form['tp_taskaktifstatus']; }
              elseif (isset($this->tp_taskaktifstatus)) { $this->nm_limpa_alfa($this->tp_taskaktifstatus); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_jmlport'])) { $this->tp_jmlport = $NM_val_form['tp_jmlport']; }
              elseif (isset($this->tp_jmlport)) { $this->nm_limpa_alfa($this->tp_jmlport); }
              if     (isset($NM_val_form) && isset($NM_val_form['tp_thn_release'])) { $this->tp_thn_release = $NM_val_form['tp_thn_release']; }
              elseif (isset($this->tp_thn_release)) { $this->nm_limpa_alfa($this->tp_thn_release); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('tp_id', 'tp_thn_release', 'tp_prjtrelease', 'tp_batch', 'tp_divre', 'tp_witel', 'tp_datel', 'tp_sto', 'tp_idlop', 'tp_namalop', 'tp_mitra', 'tp_templateproject', 'tp_targetwaktu', 'tp_jenisproject', 'tp_projectname', 'tp_status', 'tp_prosentase', 'tp_planstart', 'tp_planfinish', 'tp_lokasi', 'tp_nokontrak', 'tp_ponumber', 'tp_nilai', 'tp_summary', 'tp_rab', 'tp_jmldistribusi', 'tp_odp', 'tp_jmlport', 'tp_actualstart', 'tp_actualfinish', 'tp_entrydate', 'tp_entryby', 'tp_updatedate', 'tp_updateby', 'tp_taskaktif', 'tp_taskaktif_number', 'tp_tahapanaktif', 'tp_taskaktifstatus', 'tp_taskaktifplanstart', 'tp_taskaktifplanfinish', 'tp_is_change_template', 'tp_ischangetempby', 'tp_ischangetempdate'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "TP_ID, ";
          } 
              $this->tp_entrydate =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
              $this->tp_entrydate_hora =  date('Y') . "-" . date('m')  . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s');
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      tracking_project_viewdetail_mob_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, TP_ISCHANGETEMPDATE, TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, TP_TASKAKTIFPLANSTART, TP_TASKAKTIFPLANFINISH, TP_JMLPORT, TP_THN_RELEASE) VALUES ('$this->tp_batch', '$this->tp_projectname', '$this->tp_lokasi', $this->tp_mitra, $this->tp_witel, $this->tp_sto, $this->tp_odp, #$this->tp_planstart#, #$this->tp_planfinish#, #$this->tp_entrydate#, '$this->tp_entryby', #$this->tp_updatedate#, '$this->tp_updateby', '$this->tp_summary', $this->tp_status, #$this->tp_actualstart#, #$this->tp_actualfinish#, $this->tp_templateproject, $this->tp_jenisproject, $this->tp_prjtrelease, $this->tp_targetwaktu, $this->tp_datel, '$this->tp_nokontrak', '$this->tp_ponumber', $this->tp_divre, '$this->tp_idlop', '$this->tp_namalop', $this->tp_nilai, $this->tp_rab, '$this->tp_is_change_template', '$this->tp_ischangetempby', #$this->tp_ischangetempdate#, $this->tp_jmldistribusi, '$this->tp_taskaktif', $this->tp_taskaktif_number, $this->tp_prosentase, '$this->tp_tahapanaktif', $this->tp_taskaktifstatus, #$this->tp_taskaktifplanstart#, #$this->tp_taskaktifplanfinish#, $this->tp_jmlport, '$this->tp_thn_release')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, TP_ISCHANGETEMPDATE, TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, TP_TASKAKTIFPLANSTART, TP_TASKAKTIFPLANFINISH, TP_JMLPORT, TP_THN_RELEASE) VALUES (" . $NM_seq_auto . "'$this->tp_batch', '$this->tp_projectname', '$this->tp_lokasi', $this->tp_mitra, $this->tp_witel, $this->tp_sto, $this->tp_odp, " . $this->Ini->date_delim . $this->tp_planstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_planfinish . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_entrydate . $this->Ini->date_delim1 . ", '$this->tp_entryby', " . $this->Ini->date_delim . $this->tp_updatedate . $this->Ini->date_delim1 . ", '$this->tp_updateby', '$this->tp_summary', $this->tp_status, " . $this->Ini->date_delim . $this->tp_actualstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_actualfinish . $this->Ini->date_delim1 . ", $this->tp_templateproject, $this->tp_jenisproject, $this->tp_prjtrelease, $this->tp_targetwaktu, $this->tp_datel, '$this->tp_nokontrak', '$this->tp_ponumber', $this->tp_divre, '$this->tp_idlop', '$this->tp_namalop', $this->tp_nilai, $this->tp_rab, '$this->tp_is_change_template', '$this->tp_ischangetempby', " . $this->Ini->date_delim . $this->tp_ischangetempdate . $this->Ini->date_delim1 . ", $this->tp_jmldistribusi, '$this->tp_taskaktif', $this->tp_taskaktif_number, $this->tp_prosentase, '$this->tp_tahapanaktif', $this->tp_taskaktifstatus, " . $this->Ini->date_delim . $this->tp_taskaktifplanstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_taskaktifplanfinish . $this->Ini->date_delim1 . ", $this->tp_jmlport, '$this->tp_thn_release')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, TP_ISCHANGETEMPDATE, TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, TP_TASKAKTIFPLANSTART, TP_TASKAKTIFPLANFINISH, TP_JMLPORT, TP_THN_RELEASE) VALUES (" . $NM_seq_auto . "'$this->tp_batch', '$this->tp_projectname', '$this->tp_lokasi', $this->tp_mitra, $this->tp_witel, $this->tp_sto, $this->tp_odp, " . $this->Ini->date_delim . $this->tp_planstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_planfinish . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_entrydate . $this->Ini->date_delim1 . ", '$this->tp_entryby', " . $this->Ini->date_delim . $this->tp_updatedate . $this->Ini->date_delim1 . ", '$this->tp_updateby', '$this->tp_summary', $this->tp_status, " . $this->Ini->date_delim . $this->tp_actualstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_actualfinish . $this->Ini->date_delim1 . ", $this->tp_templateproject, $this->tp_jenisproject, $this->tp_prjtrelease, $this->tp_targetwaktu, $this->tp_datel, '$this->tp_nokontrak', '$this->tp_ponumber', $this->tp_divre, '$this->tp_idlop', '$this->tp_namalop', $this->tp_nilai, $this->tp_rab, '$this->tp_is_change_template', '$this->tp_ischangetempby', " . $this->Ini->date_delim . $this->tp_ischangetempdate . $this->Ini->date_delim1 . ", $this->tp_jmldistribusi, '$this->tp_taskaktif', $this->tp_taskaktif_number, $this->tp_prosentase, '$this->tp_tahapanaktif', $this->tp_taskaktifstatus, " . $this->Ini->date_delim . $this->tp_taskaktifplanstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_taskaktifplanfinish . $this->Ini->date_delim1 . ", $this->tp_jmlport, '$this->tp_thn_release')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, TP_ISCHANGETEMPDATE, TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, TP_TASKAKTIFPLANSTART, TP_TASKAKTIFPLANFINISH, TP_JMLPORT, TP_THN_RELEASE) VALUES (" . $NM_seq_auto . "'$this->tp_batch', '$this->tp_projectname', '$this->tp_lokasi', $this->tp_mitra, $this->tp_witel, $this->tp_sto, $this->tp_odp, EXTEND('$this->tp_planstart', YEAR TO FRACTION), EXTEND('$this->tp_planfinish', YEAR TO FRACTION), EXTEND('$this->tp_entrydate', YEAR TO FRACTION), '$this->tp_entryby', EXTEND('$this->tp_updatedate', YEAR TO FRACTION), '$this->tp_updateby', '$this->tp_summary', $this->tp_status, EXTEND('$this->tp_actualstart', YEAR TO FRACTION), EXTEND('$this->tp_actualfinish', YEAR TO FRACTION), $this->tp_templateproject, $this->tp_jenisproject, $this->tp_prjtrelease, $this->tp_targetwaktu, $this->tp_datel, '$this->tp_nokontrak', '$this->tp_ponumber', $this->tp_divre, '$this->tp_idlop', '$this->tp_namalop', $this->tp_nilai, $this->tp_rab, '$this->tp_is_change_template', '$this->tp_ischangetempby', EXTEND('$this->tp_ischangetempdate', YEAR TO FRACTION), $this->tp_jmldistribusi, '$this->tp_taskaktif', $this->tp_taskaktif_number, $this->tp_prosentase, '$this->tp_tahapanaktif', $this->tp_taskaktifstatus, EXTEND('$this->tp_taskaktifplanstart', YEAR TO FRACTION), EXTEND('$this->tp_taskaktifplanfinish', YEAR TO FRACTION), $this->tp_jmlport, '$this->tp_thn_release')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, TP_ISCHANGETEMPDATE, TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, TP_TASKAKTIFPLANSTART, TP_TASKAKTIFPLANFINISH, TP_JMLPORT, TP_THN_RELEASE) VALUES (" . $NM_seq_auto . "'$this->tp_batch', '$this->tp_projectname', '$this->tp_lokasi', $this->tp_mitra, $this->tp_witel, $this->tp_sto, $this->tp_odp, " . $this->Ini->date_delim . $this->tp_planstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_planfinish . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_entrydate . $this->Ini->date_delim1 . ", '$this->tp_entryby', " . $this->Ini->date_delim . $this->tp_updatedate . $this->Ini->date_delim1 . ", '$this->tp_updateby', '$this->tp_summary', $this->tp_status, " . $this->Ini->date_delim . $this->tp_actualstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_actualfinish . $this->Ini->date_delim1 . ", $this->tp_templateproject, $this->tp_jenisproject, $this->tp_prjtrelease, $this->tp_targetwaktu, $this->tp_datel, '$this->tp_nokontrak', '$this->tp_ponumber', $this->tp_divre, '$this->tp_idlop', '$this->tp_namalop', $this->tp_nilai, $this->tp_rab, '$this->tp_is_change_template', '$this->tp_ischangetempby', " . $this->Ini->date_delim . $this->tp_ischangetempdate . $this->Ini->date_delim1 . ", $this->tp_jmldistribusi, '$this->tp_taskaktif', $this->tp_taskaktif_number, $this->tp_prosentase, '$this->tp_tahapanaktif', $this->tp_taskaktifstatus, " . $this->Ini->date_delim . $this->tp_taskaktifplanstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_taskaktifplanfinish . $this->Ini->date_delim1 . ", $this->tp_jmlport, '$this->tp_thn_release')"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, TP_ISCHANGETEMPDATE, TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, TP_TASKAKTIFPLANSTART, TP_TASKAKTIFPLANFINISH, TP_JMLPORT, TP_THN_RELEASE) VALUES (" . $NM_seq_auto . "'$this->tp_batch', '$this->tp_projectname', '$this->tp_lokasi', $this->tp_mitra, $this->tp_witel, $this->tp_sto, $this->tp_odp, " . $this->Ini->date_delim . $this->tp_planstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_planfinish . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_entrydate . $this->Ini->date_delim1 . ", '$this->tp_entryby', " . $this->Ini->date_delim . $this->tp_updatedate . $this->Ini->date_delim1 . ", '$this->tp_updateby', '$this->tp_summary', $this->tp_status, " . $this->Ini->date_delim . $this->tp_actualstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_actualfinish . $this->Ini->date_delim1 . ", $this->tp_templateproject, $this->tp_jenisproject, $this->tp_prjtrelease, $this->tp_targetwaktu, $this->tp_datel, '$this->tp_nokontrak', '$this->tp_ponumber', $this->tp_divre, '$this->tp_idlop', '$this->tp_namalop', $this->tp_nilai, $this->tp_rab, '$this->tp_is_change_template', '$this->tp_ischangetempby', " . $this->Ini->date_delim . $this->tp_ischangetempdate . $this->Ini->date_delim1 . ", $this->tp_jmldistribusi, '$this->tp_taskaktif', $this->tp_taskaktif_number, $this->tp_prosentase, '$this->tp_tahapanaktif', $this->tp_taskaktifstatus, " . $this->Ini->date_delim . $this->tp_taskaktifplanstart . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->tp_taskaktifplanfinish . $this->Ini->date_delim1 . ", $this->tp_jmlport, '$this->tp_thn_release')"; 
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
                              tracking_project_viewdetail_mob_pack_ajax_response();
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
                          tracking_project_viewdetail_mob_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->tp_id =  $rsy->fields[0];
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
                  $this->tp_id = $rsy->fields[0];
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
                  $this->tp_id = $rsy->fields[0];
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
                  $this->tp_id = $rsy->fields[0];
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
                  $this->tp_id = $rsy->fields[0];
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
                  $this->tp_id = $rsy->fields[0];
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
                  $this->tp_id = $rsy->fields[0];
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
                  $this->tp_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['total']);
              }

              $this->sc_evento = "insert"; 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao   = "igual"; 
              $this->nmgp_opc_ant = "igual"; 
              $this->return_after_insert();
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->tp_id = substr($this->Db->qstr($this->tp_id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id"; 
              $rs1 = $this->Db->Execute("select count(*) from " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where TP_ID = $this->tp_id "); 
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
                          tracking_project_viewdetail_mob_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['total']);
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
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['parms'] = "tp_id?#?$this->tp_id?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->tp_id = substr($this->Db->qstr($this->tp_id), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter'] . ")";
          }
      }
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "inicio")
      { 
          $this->nmgp_opcao = "igual"; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, str_replace (convert(char(10),TP_PLANSTART,102), '.', '-') + ' ' + convert(char(8),TP_PLANSTART,20), str_replace (convert(char(10),TP_PLANFINISH,102), '.', '-') + ' ' + convert(char(8),TP_PLANFINISH,20), str_replace (convert(char(10),TP_ENTRYDATE,102), '.', '-') + ' ' + convert(char(8),TP_ENTRYDATE,20), TP_ENTRYBY, str_replace (convert(char(10),TP_UPDATEDATE,102), '.', '-') + ' ' + convert(char(8),TP_UPDATEDATE,20), TP_UPDATEBY, TP_SUMMARY, TP_STATUS, str_replace (convert(char(10),TP_ACTUALSTART,102), '.', '-') + ' ' + convert(char(8),TP_ACTUALSTART,20), str_replace (convert(char(10),TP_ACTUALFINISH,102), '.', '-') + ' ' + convert(char(8),TP_ACTUALFINISH,20), TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, str_replace (convert(char(10),TP_ISCHANGETEMPDATE,102), '.', '-') + ' ' + convert(char(8),TP_ISCHANGETEMPDATE,20), TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, str_replace (convert(char(10),TP_TASKAKTIFPLANSTART,102), '.', '-') + ' ' + convert(char(8),TP_TASKAKTIFPLANSTART,20), str_replace (convert(char(10),TP_TASKAKTIFPLANFINISH,102), '.', '-') + ' ' + convert(char(8),TP_TASKAKTIFPLANFINISH,20), TP_JMLPORT, TP_THN_RELEASE from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, convert(char(23),TP_PLANSTART,121), convert(char(23),TP_PLANFINISH,121), convert(char(23),TP_ENTRYDATE,121), TP_ENTRYBY, convert(char(23),TP_UPDATEDATE,121), TP_UPDATEBY, TP_SUMMARY, TP_STATUS, convert(char(23),TP_ACTUALSTART,121), convert(char(23),TP_ACTUALFINISH,121), TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, convert(char(23),TP_ISCHANGETEMPDATE,121), TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, convert(char(23),TP_TASKAKTIFPLANSTART,121), convert(char(23),TP_TASKAKTIFPLANFINISH,121), TP_JMLPORT, TP_THN_RELEASE from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, TP_ISCHANGETEMPDATE, TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, TP_TASKAKTIFPLANSTART, TP_TASKAKTIFPLANFINISH, TP_JMLPORT, TP_THN_RELEASE from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, EXTEND(TP_PLANSTART, YEAR TO FRACTION), EXTEND(TP_PLANFINISH, YEAR TO FRACTION), EXTEND(TP_ENTRYDATE, YEAR TO FRACTION), TP_ENTRYBY, EXTEND(TP_UPDATEDATE, YEAR TO FRACTION), TP_UPDATEBY, TP_SUMMARY, TP_STATUS, EXTEND(TP_ACTUALSTART, YEAR TO FRACTION), EXTEND(TP_ACTUALFINISH, YEAR TO FRACTION), TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, EXTEND(TP_ISCHANGETEMPDATE, YEAR TO FRACTION), TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, EXTEND(TP_TASKAKTIFPLANSTART, YEAR TO FRACTION), EXTEND(TP_TASKAKTIFPLANFINISH, YEAR TO FRACTION), TP_JMLPORT, TP_THN_RELEASE from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT TP_ID, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_MITRA, TP_WITEL, TP_STO, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_DATEL, TP_NOKONTRAK, TP_PONUMBER, TP_DIVRE, TP_IDLOP, TP_NAMALOP, TP_NILAI, TP_RAB, TP_IS_CHANGE_TEMPLATE, TP_ISCHANGETEMPBY, TP_ISCHANGETEMPDATE, TP_JMLDISTRIBUSI, TP_TASKAKTIF, TP_TASKAKTIF_NUMBER, TP_PROSENTASE, TP_TAHAPANAKTIF, TP_TASKAKTIFSTATUS, TP_TASKAKTIFPLANSTART, TP_TASKAKTIFPLANFINISH, TP_JMLPORT, TP_THN_RELEASE from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = "TP_ID=" . $_SESSION['var_projectid'] . "";
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_adm_clientes']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_adm_clientes']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (!empty($sc_where))
              {
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  {
                     $aWhere[] = "TP_ID = $this->tp_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                  {
                     $aWhere[] = "TP_ID = $this->tp_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  {
                     $aWhere[] = "TP_ID = $this->tp_id"; 
                  }  
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  {
                     $aWhere[] = "TP_ID = $this->tp_id"; 
                  }  
                  else  
                  {
                     $aWhere[] = "TP_ID = $this->tp_id"; 
                  }
              } 
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "TP_ID";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "insert" || $this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start']) ;  
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['empty_filter'] = true;
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
              $this->tp_id = $rs->fields[0] ; 
              $this->nmgp_dados_select['tp_id'] = $this->tp_id;
              $this->tp_batch = $rs->fields[1] ; 
              $this->nmgp_dados_select['tp_batch'] = $this->tp_batch;
              $this->tp_projectname = $rs->fields[2] ; 
              $this->nmgp_dados_select['tp_projectname'] = $this->tp_projectname;
              $this->tp_lokasi = $rs->fields[3] ; 
              $this->nmgp_dados_select['tp_lokasi'] = $this->tp_lokasi;
              $this->tp_mitra = $rs->fields[4] ; 
              $this->nmgp_dados_select['tp_mitra'] = $this->tp_mitra;
              $this->tp_witel = $rs->fields[5] ; 
              $this->nmgp_dados_select['tp_witel'] = $this->tp_witel;
              $this->tp_sto = $rs->fields[6] ; 
              $this->nmgp_dados_select['tp_sto'] = $this->tp_sto;
              $this->tp_odp = $rs->fields[7] ; 
              $this->nmgp_dados_select['tp_odp'] = $this->tp_odp;
              $this->tp_planstart = $rs->fields[8] ; 
              if (substr($this->tp_planstart, 10, 1) == "-") 
              { 
                 $this->tp_planstart = substr($this->tp_planstart, 0, 10) . " " . substr($this->tp_planstart, 11);
              } 
              if (substr($this->tp_planstart, 13, 1) == ".") 
              { 
                 $this->tp_planstart = substr($this->tp_planstart, 0, 13) . ":" . substr($this->tp_planstart, 14, 2) . ":" . substr($this->tp_planstart, 17);
              } 
              $this->nmgp_dados_select['tp_planstart'] = $this->tp_planstart;
              $this->tp_planfinish = $rs->fields[9] ; 
              if (substr($this->tp_planfinish, 10, 1) == "-") 
              { 
                 $this->tp_planfinish = substr($this->tp_planfinish, 0, 10) . " " . substr($this->tp_planfinish, 11);
              } 
              if (substr($this->tp_planfinish, 13, 1) == ".") 
              { 
                 $this->tp_planfinish = substr($this->tp_planfinish, 0, 13) . ":" . substr($this->tp_planfinish, 14, 2) . ":" . substr($this->tp_planfinish, 17);
              } 
              $this->nmgp_dados_select['tp_planfinish'] = $this->tp_planfinish;
              $this->tp_entrydate = $rs->fields[10] ; 
              if (substr($this->tp_entrydate, 10, 1) == "-") 
              { 
                 $this->tp_entrydate = substr($this->tp_entrydate, 0, 10) . " " . substr($this->tp_entrydate, 11);
              } 
              if (substr($this->tp_entrydate, 13, 1) == ".") 
              { 
                 $this->tp_entrydate = substr($this->tp_entrydate, 0, 13) . ":" . substr($this->tp_entrydate, 14, 2) . ":" . substr($this->tp_entrydate, 17);
              } 
              $this->nmgp_dados_select['tp_entrydate'] = $this->tp_entrydate;
              $this->tp_entryby = $rs->fields[11] ; 
              $this->nmgp_dados_select['tp_entryby'] = $this->tp_entryby;
              $this->tp_updatedate = $rs->fields[12] ; 
              if (substr($this->tp_updatedate, 10, 1) == "-") 
              { 
                 $this->tp_updatedate = substr($this->tp_updatedate, 0, 10) . " " . substr($this->tp_updatedate, 11);
              } 
              if (substr($this->tp_updatedate, 13, 1) == ".") 
              { 
                 $this->tp_updatedate = substr($this->tp_updatedate, 0, 13) . ":" . substr($this->tp_updatedate, 14, 2) . ":" . substr($this->tp_updatedate, 17);
              } 
              $this->nmgp_dados_select['tp_updatedate'] = $this->tp_updatedate;
              $this->tp_updateby = $rs->fields[13] ; 
              $this->nmgp_dados_select['tp_updateby'] = $this->tp_updateby;
              $this->tp_summary = $rs->fields[14] ; 
              $this->nmgp_dados_select['tp_summary'] = $this->tp_summary;
              $this->tp_status = $rs->fields[15] ; 
              $this->nmgp_dados_select['tp_status'] = $this->tp_status;
              $this->tp_actualstart = $rs->fields[16] ; 
              if (substr($this->tp_actualstart, 10, 1) == "-") 
              { 
                 $this->tp_actualstart = substr($this->tp_actualstart, 0, 10) . " " . substr($this->tp_actualstart, 11);
              } 
              if (substr($this->tp_actualstart, 13, 1) == ".") 
              { 
                 $this->tp_actualstart = substr($this->tp_actualstart, 0, 13) . ":" . substr($this->tp_actualstart, 14, 2) . ":" . substr($this->tp_actualstart, 17);
              } 
              $this->nmgp_dados_select['tp_actualstart'] = $this->tp_actualstart;
              $this->tp_actualfinish = $rs->fields[17] ; 
              if (substr($this->tp_actualfinish, 10, 1) == "-") 
              { 
                 $this->tp_actualfinish = substr($this->tp_actualfinish, 0, 10) . " " . substr($this->tp_actualfinish, 11);
              } 
              if (substr($this->tp_actualfinish, 13, 1) == ".") 
              { 
                 $this->tp_actualfinish = substr($this->tp_actualfinish, 0, 13) . ":" . substr($this->tp_actualfinish, 14, 2) . ":" . substr($this->tp_actualfinish, 17);
              } 
              $this->nmgp_dados_select['tp_actualfinish'] = $this->tp_actualfinish;
              $this->tp_templateproject = $rs->fields[18] ; 
              $this->nmgp_dados_select['tp_templateproject'] = $this->tp_templateproject;
              $this->tp_jenisproject = $rs->fields[19] ; 
              $this->nmgp_dados_select['tp_jenisproject'] = $this->tp_jenisproject;
              $this->tp_prjtrelease = $rs->fields[20] ; 
              $this->nmgp_dados_select['tp_prjtrelease'] = $this->tp_prjtrelease;
              $this->tp_targetwaktu = $rs->fields[21] ; 
              $this->nmgp_dados_select['tp_targetwaktu'] = $this->tp_targetwaktu;
              $this->tp_datel = $rs->fields[22] ; 
              $this->nmgp_dados_select['tp_datel'] = $this->tp_datel;
              $this->tp_nokontrak = $rs->fields[23] ; 
              $this->nmgp_dados_select['tp_nokontrak'] = $this->tp_nokontrak;
              $this->tp_ponumber = $rs->fields[24] ; 
              $this->nmgp_dados_select['tp_ponumber'] = $this->tp_ponumber;
              $this->tp_divre = $rs->fields[25] ; 
              $this->nmgp_dados_select['tp_divre'] = $this->tp_divre;
              $this->tp_idlop = $rs->fields[26] ; 
              $this->nmgp_dados_select['tp_idlop'] = $this->tp_idlop;
              $this->tp_namalop = $rs->fields[27] ; 
              $this->nmgp_dados_select['tp_namalop'] = $this->tp_namalop;
              $this->tp_nilai = $rs->fields[28] ; 
              $this->nmgp_dados_select['tp_nilai'] = $this->tp_nilai;
              $this->tp_rab = $rs->fields[29] ; 
              $this->nmgp_dados_select['tp_rab'] = $this->tp_rab;
              $this->tp_is_change_template = $rs->fields[30] ; 
              $this->nmgp_dados_select['tp_is_change_template'] = $this->tp_is_change_template;
              $this->tp_ischangetempby = $rs->fields[31] ; 
              $this->nmgp_dados_select['tp_ischangetempby'] = $this->tp_ischangetempby;
              $this->tp_ischangetempdate = $rs->fields[32] ; 
              if (substr($this->tp_ischangetempdate, 10, 1) == "-") 
              { 
                 $this->tp_ischangetempdate = substr($this->tp_ischangetempdate, 0, 10) . " " . substr($this->tp_ischangetempdate, 11);
              } 
              if (substr($this->tp_ischangetempdate, 13, 1) == ".") 
              { 
                 $this->tp_ischangetempdate = substr($this->tp_ischangetempdate, 0, 13) . ":" . substr($this->tp_ischangetempdate, 14, 2) . ":" . substr($this->tp_ischangetempdate, 17);
              } 
              $this->nmgp_dados_select['tp_ischangetempdate'] = $this->tp_ischangetempdate;
              $this->tp_jmldistribusi = $rs->fields[33] ; 
              $this->nmgp_dados_select['tp_jmldistribusi'] = $this->tp_jmldistribusi;
              $this->tp_taskaktif = $rs->fields[34] ; 
              $this->nmgp_dados_select['tp_taskaktif'] = $this->tp_taskaktif;
              $this->tp_taskaktif_number = $rs->fields[35] ; 
              $this->nmgp_dados_select['tp_taskaktif_number'] = $this->tp_taskaktif_number;
              $this->tp_prosentase = $rs->fields[36] ; 
              $this->nmgp_dados_select['tp_prosentase'] = $this->tp_prosentase;
              $this->tp_tahapanaktif = $rs->fields[37] ; 
              $this->nmgp_dados_select['tp_tahapanaktif'] = $this->tp_tahapanaktif;
              $this->tp_taskaktifstatus = $rs->fields[38] ; 
              $this->nmgp_dados_select['tp_taskaktifstatus'] = $this->tp_taskaktifstatus;
              $this->tp_taskaktifplanstart = $rs->fields[39] ; 
              if (substr($this->tp_taskaktifplanstart, 10, 1) == "-") 
              { 
                 $this->tp_taskaktifplanstart = substr($this->tp_taskaktifplanstart, 0, 10) . " " . substr($this->tp_taskaktifplanstart, 11);
              } 
              if (substr($this->tp_taskaktifplanstart, 13, 1) == ".") 
              { 
                 $this->tp_taskaktifplanstart = substr($this->tp_taskaktifplanstart, 0, 13) . ":" . substr($this->tp_taskaktifplanstart, 14, 2) . ":" . substr($this->tp_taskaktifplanstart, 17);
              } 
              $this->nmgp_dados_select['tp_taskaktifplanstart'] = $this->tp_taskaktifplanstart;
              $this->tp_taskaktifplanfinish = $rs->fields[40] ; 
              if (substr($this->tp_taskaktifplanfinish, 10, 1) == "-") 
              { 
                 $this->tp_taskaktifplanfinish = substr($this->tp_taskaktifplanfinish, 0, 10) . " " . substr($this->tp_taskaktifplanfinish, 11);
              } 
              if (substr($this->tp_taskaktifplanfinish, 13, 1) == ".") 
              { 
                 $this->tp_taskaktifplanfinish = substr($this->tp_taskaktifplanfinish, 0, 13) . ":" . substr($this->tp_taskaktifplanfinish, 14, 2) . ":" . substr($this->tp_taskaktifplanfinish, 17);
              } 
              $this->nmgp_dados_select['tp_taskaktifplanfinish'] = $this->tp_taskaktifplanfinish;
              $this->tp_jmlport = $rs->fields[41] ; 
              $this->nmgp_dados_select['tp_jmlport'] = $this->tp_jmlport;
              $this->tp_thn_release = $rs->fields[42] ; 
              $this->nmgp_dados_select['tp_thn_release'] = $this->tp_thn_release;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->tp_id = (string)$this->tp_id; 
              $this->tp_mitra = (string)$this->tp_mitra; 
              $this->tp_witel = (string)$this->tp_witel; 
              $this->tp_sto = (string)$this->tp_sto; 
              $this->tp_odp = (string)$this->tp_odp; 
              $this->tp_status = (string)$this->tp_status; 
              $this->tp_templateproject = (string)$this->tp_templateproject; 
              $this->tp_jenisproject = (string)$this->tp_jenisproject; 
              $this->tp_prjtrelease = (string)$this->tp_prjtrelease; 
              $this->tp_targetwaktu = (string)$this->tp_targetwaktu; 
              $this->tp_datel = (string)$this->tp_datel; 
              $this->tp_divre = (string)$this->tp_divre; 
              $this->tp_nilai = (string)$this->tp_nilai; 
              $this->tp_rab = (string)$this->tp_rab; 
              $this->tp_jmldistribusi = (string)$this->tp_jmldistribusi; 
              $this->tp_taskaktif_number = (string)$this->tp_taskaktif_number; 
              $this->tp_prosentase = (string)$this->tp_prosentase; 
              $this->tp_taskaktifstatus = (string)$this->tp_taskaktifstatus; 
              $this->tp_jmlport = (string)$this->tp_jmlport; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['parms'] = "tp_id?#?$this->tp_id?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['reg_start'] < $qt_geral_reg_tracking_project_viewdetail_mob;
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opcao']   = '';
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
              $this->tp_id = "";  
              $this->tp_batch = "";  
              $this->tp_projectname = "";  
              $this->tp_lokasi = "";  
              $this->tp_mitra = "";  
              $this->tp_witel = "";  
              $this->tp_sto = "";  
              $this->tp_odp = "";  
              $this->tp_planstart = "";  
              $this->tp_planstart_hora = "" ;  
              $this->tp_planfinish = "";  
              $this->tp_planfinish_hora = "" ;  
              $this->tp_entrydate = "";  
              $this->tp_entrydate_hora = "" ;  
              $this->tp_entryby = "";  
              $this->tp_updatedate = "";  
              $this->tp_updatedate_hora = "" ;  
              $this->tp_updateby = "";  
              $this->tp_summary = "";  
              $this->tp_status = "";  
              $this->tp_actualstart = "";  
              $this->tp_actualstart_hora = "" ;  
              $this->tp_actualfinish = "";  
              $this->tp_actualfinish_hora = "" ;  
              $this->tp_templateproject = "";  
              $this->tp_jenisproject = "";  
              $this->tp_prjtrelease = "";  
              $this->tp_targetwaktu = "";  
              $this->tp_datel = "";  
              $this->tp_nokontrak = "";  
              $this->tp_ponumber = "";  
              $this->tp_divre = "";  
              $this->tp_idlop = "";  
              $this->tp_namalop = "";  
              $this->tp_nilai = "";  
              $this->tp_rab = "";  
              $this->tp_is_change_template = "";  
              $this->tp_ischangetempby = "";  
              $this->tp_ischangetempdate = "";  
              $this->tp_ischangetempdate_hora = "" ;  
              $this->tp_jmldistribusi = "";  
              $this->tp_taskaktif = "";  
              $this->tp_taskaktif_number = "";  
              $this->tp_prosentase = "";  
              $this->tp_tahapanaktif = "";  
              $this->tp_taskaktifstatus = "";  
              $this->tp_taskaktifplanstart = "";  
              $this->tp_taskaktifplanstart_hora = "" ;  
              $this->tp_taskaktifplanfinish = "";  
              $this->tp_taskaktifplanfinish_hora = "" ;  
              $this->tp_jmlport = "";  
              $this->tp_thn_release = "";  
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['foreign_key'] as $sFKName => $sFKValue)
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
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//
function TP_ODP_onChange()
{
$_SESSION['scriptcase']['tracking_project_viewdetail_mob']['contr_erro'] = 'on';
       
$original_tp_odp = $this->tp_odp;




$odpakhir = $tp_awalodp  + $this->tp_odp ;
$tp_akhirodp  = str_pad($odpakhir,3,"0",STR_PAD_LEFT);
$this->sc_field_readonly("tp_akhirodp", 'on');

$modificado_tp_odp = $this->tp_odp;
$this->nm_formatar_campos('tp_odp');
if ($original_tp_odp !== $modificado_tp_odp || isset($this->nmgp_cmp_readonly['tp_odp']) || (isset($bFlagRead_tp_odp) && $bFlagRead_tp_odp))
{
    $this->ajax_return_values_tp_odp(true);
}
tracking_project_viewdetail_mob_pack_ajax_response();
exit;
$_SESSION['scriptcase']['tracking_project_viewdetail_mob']['contr_erro'] = 'off';
}
function TP_PLANSTART_onChange()
{
$_SESSION['scriptcase']['tracking_project_viewdetail_mob']['contr_erro'] = 'on';
       
$original_tp_targetwaktu = $this->tp_targetwaktu;
$original_tp_planfinish = $this->tp_planfinish;
$original_tp_planstart = $this->tp_planstart;



$add_days  = $this->tp_targetwaktu ;  
$add_months = 0;  
$add_years = 0;   
$this->tp_planfinish  = 
         $this->nm_data->CalculaData($this->tp_planstart , 'yyyy-mm-dd', '+', $add_days, $add_months, $add_years, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
$this->sc_field_readonly("tp_planfinish", 'on');


$modificado_tp_targetwaktu = $this->tp_targetwaktu;
$modificado_tp_planfinish = $this->tp_planfinish;
$modificado_tp_planstart = $this->tp_planstart;
$this->nm_formatar_campos('tp_targetwaktu', 'tp_planfinish', 'tp_planstart');
if ($original_tp_targetwaktu !== $modificado_tp_targetwaktu || isset($this->nmgp_cmp_readonly['tp_targetwaktu']) || (isset($bFlagRead_tp_targetwaktu) && $bFlagRead_tp_targetwaktu))
{
    $this->ajax_return_values_tp_targetwaktu(true);
}
if ($original_tp_planfinish !== $modificado_tp_planfinish || isset($this->nmgp_cmp_readonly['tp_planfinish']) || (isset($bFlagRead_tp_planfinish) && $bFlagRead_tp_planfinish))
{
    $this->ajax_return_values_tp_planfinish(true);
}
if ($original_tp_planstart !== $modificado_tp_planstart || isset($this->nmgp_cmp_readonly['tp_planstart']) || (isset($bFlagRead_tp_planstart) && $bFlagRead_tp_planstart))
{
    $this->ajax_return_values_tp_planstart(true);
}
tracking_project_viewdetail_mob_pack_ajax_response();
exit;
$_SESSION['scriptcase']['tracking_project_viewdetail_mob']['contr_erro'] = 'off';
}
function TP_TEMPLATEPROJECT_onChange()
{
$_SESSION['scriptcase']['tracking_project_viewdetail_mob']['contr_erro'] = 'on';
       
$original_tp_templateproject = $this->tp_templateproject;
$original_tp_targetwaktu = $this->tp_targetwaktu;
$original_tp_planfinish = $this->tp_planfinish;



$check_sql = "SELECT TARGETWAKTU FROM TB_MASTER_TEMPLATE WHERE IDTEMPLATE='$this->tp_templateproject'";
 
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
    $this->tp_targetwaktu  = $this->rs[0][0];
} else {
$this->tp_targetwaktu  = '';
}

$this->tp_planfinish  = '';
$this->sc_field_readonly("tp_planfinish", 'on');


$modificado_tp_templateproject = $this->tp_templateproject;
$modificado_tp_targetwaktu = $this->tp_targetwaktu;
$modificado_tp_planfinish = $this->tp_planfinish;
$this->nm_formatar_campos('tp_templateproject', 'tp_targetwaktu', 'tp_planfinish');
if ($original_tp_templateproject !== $modificado_tp_templateproject || isset($this->nmgp_cmp_readonly['tp_templateproject']) || (isset($bFlagRead_tp_templateproject) && $bFlagRead_tp_templateproject))
{
    $this->ajax_return_values_tp_templateproject(true);
}
if ($original_tp_targetwaktu !== $modificado_tp_targetwaktu || isset($this->nmgp_cmp_readonly['tp_targetwaktu']) || (isset($bFlagRead_tp_targetwaktu) && $bFlagRead_tp_targetwaktu))
{
    $this->ajax_return_values_tp_targetwaktu(true);
}
if ($original_tp_planfinish !== $modificado_tp_planfinish || isset($this->nmgp_cmp_readonly['tp_planfinish']) || (isset($bFlagRead_tp_planfinish) && $bFlagRead_tp_planfinish))
{
    $this->ajax_return_values_tp_planfinish(true);
}
tracking_project_viewdetail_mob_pack_ajax_response();
exit;
$_SESSION['scriptcase']['tracking_project_viewdetail_mob']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              tracking_project_viewdetail_mob_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("tracking_project_viewdetail_mob_form0.php");
        $this->hideFormPages();
 }

        function initFormPages() {
        } // initFormPages

        function hideFormPages() {
        } // hideFormPages

    function form_encode_input($string)
    {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['csrf_token'];
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

   function Form_lookup_tp_prjtrelease()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT TP_RELEASE, TP_RELEASENAME  FROM TBL_PROJECTRELEASE  ORDER BY TP_RELEASENAME";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_prjtrelease'][] = $rs->fields[0];
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
   function Form_lookup_tp_batch()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT KODESP, NAMABATCH  FROM TBL_BATCH  ORDER BY NAMABATCH";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_batch'][] = $rs->fields[0];
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
   function Form_lookup_tp_divre()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT MD_IDDIVRE, MD_KODEDIVRE  FROM TBL_MAS_DIVRE WHERE MD_IDDIVRE='" . $_SESSION['iddivre'] . "'  ORDER BY MD_KODEDIVRE";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_divre'][] = $rs->fields[0];
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
   function Form_lookup_tp_witel()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel'] = array(); 
}
if ($this->tp_divre != "")
{ 
   $this->nm_clear_val("tp_divre");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT MW_IDWITEL, MW_NAMAWITEL  FROM TBL_MAS_WITEL  WHERE MW_IDDIVRE='$this->tp_divre' and MW_IDWITEL='" . $_SESSION['idwitel'] . "' ORDER BY MW_NAMAWITEL";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_witel'][] = $rs->fields[0];
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
} 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_tp_datel()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel'] = array(); 
}
if ($this->tp_witel != "")
{ 
   $this->nm_clear_val("tp_witel");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT MD_IDDATEL, MD_NAMADATEL  FROM TBL_MAS_DATEL  WHERE MD_IDWITEL='$this->tp_witel'  ORDER BY MD_NAMADATEL";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_datel'][] = $rs->fields[0];
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
} 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_tp_sto()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto'] = array(); 
}
if ($this->tp_datel != "")
{ 
   $this->nm_clear_val("tp_datel");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT MS_IDSTO, MS_NAMASTO  FROM TBL_MAS_STO  WHERE MS_DATEL='$this->tp_datel'  ORDER BY MS_NAMASTO";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_sto'][] = $rs->fields[0];
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
} 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_tp_mitra()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra'] = array(); 
}
if ($this->tp_divre != "" && $this->tp_witel != "")
{ 
   $this->nm_clear_val("tp_divre");
   $this->nm_clear_val("tp_witel");
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT TM_IDMITRA, TM_NAMAMITRA  FROM TBL_MITRA  WHERE TM_DIVRE='$this->tp_divre' AND TM_WITEL='$this->tp_witel'  ORDER BY TM_NAMAMITRA";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_mitra'][] = $rs->fields[0];
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
} 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_tp_templateproject()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT IDTEMPLATE, TEMPLATENAME  FROM TB_MASTER_TEMPLATE  ORDER BY TEMPLATENAME";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_templateproject'][] = $rs->fields[0];
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
   function Form_lookup_tp_jenisproject()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject'] = array(); 
    }

   $old_value_tp_id = $this->tp_id;
   $old_value_tp_targetwaktu = $this->tp_targetwaktu;
   $old_value_tp_prosentase = $this->tp_prosentase;
   $old_value_tp_planstart = $this->tp_planstart;
   $old_value_tp_planfinish = $this->tp_planfinish;
   $old_value_tp_nilai = $this->tp_nilai;
   $old_value_tp_rab = $this->tp_rab;
   $old_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $old_value_tp_odp = $this->tp_odp;
   $old_value_tp_jmlport = $this->tp_jmlport;
   $old_value_tp_actualstart = $this->tp_actualstart;
   $old_value_tp_actualfinish = $this->tp_actualfinish;
   $old_value_tp_entrydate = $this->tp_entrydate;
   $old_value_tp_updatedate = $this->tp_updatedate;
   $old_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $old_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $old_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $old_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $old_value_tp_ischangetempdate = $this->tp_ischangetempdate;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_tp_id = $this->tp_id;
   $unformatted_value_tp_targetwaktu = $this->tp_targetwaktu;
   $unformatted_value_tp_prosentase = $this->tp_prosentase;
   $unformatted_value_tp_planstart = $this->tp_planstart;
   $unformatted_value_tp_planfinish = $this->tp_planfinish;
   $unformatted_value_tp_nilai = $this->tp_nilai;
   $unformatted_value_tp_rab = $this->tp_rab;
   $unformatted_value_tp_jmldistribusi = $this->tp_jmldistribusi;
   $unformatted_value_tp_odp = $this->tp_odp;
   $unformatted_value_tp_jmlport = $this->tp_jmlport;
   $unformatted_value_tp_actualstart = $this->tp_actualstart;
   $unformatted_value_tp_actualfinish = $this->tp_actualfinish;
   $unformatted_value_tp_entrydate = $this->tp_entrydate;
   $unformatted_value_tp_updatedate = $this->tp_updatedate;
   $unformatted_value_tp_taskaktif_number = $this->tp_taskaktif_number;
   $unformatted_value_tp_taskaktifstatus = $this->tp_taskaktifstatus;
   $unformatted_value_tp_taskaktifplanstart = $this->tp_taskaktifplanstart;
   $unformatted_value_tp_taskaktifplanfinish = $this->tp_taskaktifplanfinish;
   $unformatted_value_tp_ischangetempdate = $this->tp_ischangetempdate;

   $nm_comando = "SELECT TJ_IDJENIS, TJ_NAMAJENIS  FROM TBL_JENISPROJECT  ORDER BY TJ_NAMAJENIS";

   $this->tp_id = $old_value_tp_id;
   $this->tp_targetwaktu = $old_value_tp_targetwaktu;
   $this->tp_prosentase = $old_value_tp_prosentase;
   $this->tp_planstart = $old_value_tp_planstart;
   $this->tp_planfinish = $old_value_tp_planfinish;
   $this->tp_nilai = $old_value_tp_nilai;
   $this->tp_rab = $old_value_tp_rab;
   $this->tp_jmldistribusi = $old_value_tp_jmldistribusi;
   $this->tp_odp = $old_value_tp_odp;
   $this->tp_jmlport = $old_value_tp_jmlport;
   $this->tp_actualstart = $old_value_tp_actualstart;
   $this->tp_actualfinish = $old_value_tp_actualfinish;
   $this->tp_entrydate = $old_value_tp_entrydate;
   $this->tp_updatedate = $old_value_tp_updatedate;
   $this->tp_taskaktif_number = $old_value_tp_taskaktif_number;
   $this->tp_taskaktifstatus = $old_value_tp_taskaktifstatus;
   $this->tp_taskaktifplanstart = $old_value_tp_taskaktifplanstart;
   $this->tp_taskaktifplanfinish = $old_value_tp_taskaktifplanfinish;
   $this->tp_ischangetempdate = $old_value_tp_ischangetempdate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['Lookup_tp_jenisproject'][] = $rs->fields[0];
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
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              tracking_project_viewdetail_mob_pack_ajax_response();
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
          $this->SC_monta_condicao($comando, "TP_ID", $arg_search, $data_search);
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter_form'] . " and (TP_ID=" . $_SESSION['var_projectid'] . ") and (" . $comando . ")";
      }
      else
      {
          $sc_where = " where TP_ID=" . $_SESSION['var_projectid'] . " and (" . $comando . ")";
      }
      $nmgp_select = "SELECT count(*) from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_tracking_project_viewdetail_mob = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['total'] = $qt_geral_reg_tracking_project_viewdetail_mob;
      $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          tracking_project_viewdetail_mob_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          tracking_project_viewdetail_mob_pack_ajax_response();
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
      $nm_numeric[] = "tp_id";$nm_numeric[] = "tp_mitra";$nm_numeric[] = "tp_witel";$nm_numeric[] = "tp_sto";$nm_numeric[] = "tp_odp";$nm_numeric[] = "tp_status";$nm_numeric[] = "tp_templateproject";$nm_numeric[] = "tp_jenisproject";$nm_numeric[] = "tp_prjtrelease";$nm_numeric[] = "tp_targetwaktu";$nm_numeric[] = "tp_datel";$nm_numeric[] = "tp_divre";$nm_numeric[] = "tp_nilai";$nm_numeric[] = "tp_rab";$nm_numeric[] = "tp_jmldistribusi";$nm_numeric[] = "tp_taskaktif_number";$nm_numeric[] = "tp_prosentase";$nm_numeric[] = "tp_taskaktifstatus";$nm_numeric[] = "tp_jmlport";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['decimal_db'] == ".")
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
      $Nm_datas['tp_planstart'] = "datetime";$Nm_datas['tp_planfinish'] = "datetime";$Nm_datas['tp_entrydate'] = "datetime";$Nm_datas['tp_updatedate'] = "datetime";$Nm_datas['tp_actualstart'] = "datetime";$Nm_datas['tp_actualfinish'] = "datetime";$Nm_datas['tp_ischangetempdate'] = "datetime";$Nm_datas['tp_taskaktifplanstart'] = "datetime";$Nm_datas['tp_taskaktifplanfinish'] = "datetime";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['SC_sep_date1'];
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
       $nmgp_saida_form = "tracking_project_viewdetail_mob_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['nm_run_menu'] = 2;
       $nmgp_saida_form = "tracking_project_viewdetail_mob_fim.php";
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
       tracking_project_viewdetail_mob_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['tracking_project_viewdetail_mob']['masterValue']);
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
