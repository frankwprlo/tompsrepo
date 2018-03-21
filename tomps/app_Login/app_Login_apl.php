<?php
//
class app_Login_apl
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
   var $captcha_code;
   var $Nav_permite_ava     = true;
   var $Nav_permite_ret     = true;
   var $Apl_com_erro        = false;
   var $app_is_initializing = false;
   var $Ini;
   var $Erro;
   var $Db;
   var $login;
   var $pswd;
   var $links;
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
   var $NM_case_insensitive;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['captcha_code']))
          {
              $this->captcha_code = $this->NM_ajax_info['param']['captcha_code'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['links']))
          {
              $this->links = $this->NM_ajax_info['param']['links'];
          }
          if (isset($this->NM_ajax_info['param']['login']))
          {
              $this->login = $this->NM_ajax_info['param']['login'];
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
          if (isset($this->NM_ajax_info['param']['pswd']))
          {
              $this->pswd = $this->NM_ajax_info['param']['pswd'];
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
      if (isset($this->facebook_error_code) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['facebook_error_code'] = $this->facebook_error_code;
      }
      if (isset($this->facebook_error_msg) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['facebook_error_msg'] = $this->facebook_error_msg;
      }
      if (isset($this->facebook_user) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['facebook_user'] = $this->facebook_user;
      }
      if (isset($this->facebook_email) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['facebook_email'] = $this->facebook_email;
      }
      if (isset($this->facebook_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['facebook_name'] = $this->facebook_name;
      }
      if (isset($this->google_error_code) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_error_code'] = $this->google_error_code;
      }
      if (isset($this->google_error_msg) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_error_msg'] = $this->google_error_msg;
      }
      if (isset($this->google_user) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_user'] = $this->google_user;
      }
      if (isset($this->google_email) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_email'] = $this->google_email;
      }
      if (isset($this->google_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['google_name'] = $this->google_name;
      }
      if (isset($this->logged_date_login) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['logged_date_login'] = $this->logged_date_login;
      }
      if (isset($this->usr_login) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($this->usr_email) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_email'] = $this->usr_email;
      }
      if (isset($this->user_group) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['user_group'] = $this->user_group;
      }
      if (isset($this->priv_mitra) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['priv_mitra'] = $this->priv_mitra;
      }
      if (isset($this->usr_priv_admin) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_priv_admin'] = $this->usr_priv_admin;
      }
      if (isset($this->usr_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_name'] = $this->usr_name;
      }
      if (isset($this->groups) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['groups'] = $this->groups;
      }
      if (isset($this->iddivre) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['iddivre'] = $this->iddivre;
      }
      if (isset($this->idwitel) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['idwitel'] = $this->idwitel;
      }
      if (isset($this->usr_priv_lokasi) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['usr_priv_lokasi'] = $this->usr_priv_lokasi;
      }
      if (isset($this->groupsname) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['groupsname'] = $this->groupsname;
      }
      if (isset($this->kodewitel) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['kodewitel'] = $this->kodewitel;
      }
      if (isset($this->kodedivre) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['kodedivre'] = $this->kodedivre;
      }
      if (isset($this->twitter_user) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['twitter_user'] = $this->twitter_user;
      }
      if (isset($this->twitter_email) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['twitter_email'] = $this->twitter_email;
      }
      if (isset($this->twitter_name) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['twitter_name'] = $this->twitter_name;
      }
      if (isset($_POST["facebook_error_code"]) && isset($this->facebook_error_code)) 
      {
          $_SESSION['facebook_error_code'] = $this->facebook_error_code;
      }
      if (isset($_POST["facebook_error_msg"]) && isset($this->facebook_error_msg)) 
      {
          $_SESSION['facebook_error_msg'] = $this->facebook_error_msg;
      }
      if (isset($_POST["facebook_user"]) && isset($this->facebook_user)) 
      {
          $_SESSION['facebook_user'] = $this->facebook_user;
      }
      if (isset($_POST["facebook_email"]) && isset($this->facebook_email)) 
      {
          $_SESSION['facebook_email'] = $this->facebook_email;
      }
      if (isset($_POST["facebook_name"]) && isset($this->facebook_name)) 
      {
          $_SESSION['facebook_name'] = $this->facebook_name;
      }
      if (isset($_POST["google_error_code"]) && isset($this->google_error_code)) 
      {
          $_SESSION['google_error_code'] = $this->google_error_code;
      }
      if (isset($_POST["google_error_msg"]) && isset($this->google_error_msg)) 
      {
          $_SESSION['google_error_msg'] = $this->google_error_msg;
      }
      if (isset($_POST["google_user"]) && isset($this->google_user)) 
      {
          $_SESSION['google_user'] = $this->google_user;
      }
      if (isset($_POST["google_email"]) && isset($this->google_email)) 
      {
          $_SESSION['google_email'] = $this->google_email;
      }
      if (isset($_POST["google_name"]) && isset($this->google_name)) 
      {
          $_SESSION['google_name'] = $this->google_name;
      }
      if (isset($_POST["logged_date_login"]) && isset($this->logged_date_login)) 
      {
          $_SESSION['logged_date_login'] = $this->logged_date_login;
      }
      if (isset($_POST["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_POST["usr_email"]) && isset($this->usr_email)) 
      {
          $_SESSION['usr_email'] = $this->usr_email;
      }
      if (isset($_POST["user_group"]) && isset($this->user_group)) 
      {
          $_SESSION['user_group'] = $this->user_group;
      }
      if (isset($_POST["priv_mitra"]) && isset($this->priv_mitra)) 
      {
          $_SESSION['priv_mitra'] = $this->priv_mitra;
      }
      if (isset($_POST["usr_priv_admin"]) && isset($this->usr_priv_admin)) 
      {
          $_SESSION['usr_priv_admin'] = $this->usr_priv_admin;
      }
      if (isset($_POST["usr_name"]) && isset($this->usr_name)) 
      {
          $_SESSION['usr_name'] = $this->usr_name;
      }
      if (isset($_POST["groups"]) && isset($this->groups)) 
      {
          $_SESSION['groups'] = $this->groups;
      }
      if (isset($_POST["iddivre"]) && isset($this->iddivre)) 
      {
          $_SESSION['iddivre'] = $this->iddivre;
      }
      if (isset($_POST["idwitel"]) && isset($this->idwitel)) 
      {
          $_SESSION['idwitel'] = $this->idwitel;
      }
      if (isset($_POST["usr_priv_lokasi"]) && isset($this->usr_priv_lokasi)) 
      {
          $_SESSION['usr_priv_lokasi'] = $this->usr_priv_lokasi;
      }
      if (isset($_POST["groupsname"]) && isset($this->groupsname)) 
      {
          $_SESSION['groupsname'] = $this->groupsname;
      }
      if (isset($_POST["kodewitel"]) && isset($this->kodewitel)) 
      {
          $_SESSION['kodewitel'] = $this->kodewitel;
      }
      if (isset($_POST["kodedivre"]) && isset($this->kodedivre)) 
      {
          $_SESSION['kodedivre'] = $this->kodedivre;
      }
      if (isset($_POST["twitter_user"]) && isset($this->twitter_user)) 
      {
          $_SESSION['twitter_user'] = $this->twitter_user;
      }
      if (isset($_POST["twitter_email"]) && isset($this->twitter_email)) 
      {
          $_SESSION['twitter_email'] = $this->twitter_email;
      }
      if (isset($_POST["twitter_name"]) && isset($this->twitter_name)) 
      {
          $_SESSION['twitter_name'] = $this->twitter_name;
      }
      if (isset($_GET["facebook_error_code"]) && isset($this->facebook_error_code)) 
      {
          $_SESSION['facebook_error_code'] = $this->facebook_error_code;
      }
      if (isset($_GET["facebook_error_msg"]) && isset($this->facebook_error_msg)) 
      {
          $_SESSION['facebook_error_msg'] = $this->facebook_error_msg;
      }
      if (isset($_GET["facebook_user"]) && isset($this->facebook_user)) 
      {
          $_SESSION['facebook_user'] = $this->facebook_user;
      }
      if (isset($_GET["facebook_email"]) && isset($this->facebook_email)) 
      {
          $_SESSION['facebook_email'] = $this->facebook_email;
      }
      if (isset($_GET["facebook_name"]) && isset($this->facebook_name)) 
      {
          $_SESSION['facebook_name'] = $this->facebook_name;
      }
      if (isset($_GET["google_error_code"]) && isset($this->google_error_code)) 
      {
          $_SESSION['google_error_code'] = $this->google_error_code;
      }
      if (isset($_GET["google_error_msg"]) && isset($this->google_error_msg)) 
      {
          $_SESSION['google_error_msg'] = $this->google_error_msg;
      }
      if (isset($_GET["google_user"]) && isset($this->google_user)) 
      {
          $_SESSION['google_user'] = $this->google_user;
      }
      if (isset($_GET["google_email"]) && isset($this->google_email)) 
      {
          $_SESSION['google_email'] = $this->google_email;
      }
      if (isset($_GET["google_name"]) && isset($this->google_name)) 
      {
          $_SESSION['google_name'] = $this->google_name;
      }
      if (isset($_GET["logged_date_login"]) && isset($this->logged_date_login)) 
      {
          $_SESSION['logged_date_login'] = $this->logged_date_login;
      }
      if (isset($_GET["usr_login"]) && isset($this->usr_login)) 
      {
          $_SESSION['usr_login'] = $this->usr_login;
      }
      if (isset($_GET["usr_email"]) && isset($this->usr_email)) 
      {
          $_SESSION['usr_email'] = $this->usr_email;
      }
      if (isset($_GET["user_group"]) && isset($this->user_group)) 
      {
          $_SESSION['user_group'] = $this->user_group;
      }
      if (isset($_GET["priv_mitra"]) && isset($this->priv_mitra)) 
      {
          $_SESSION['priv_mitra'] = $this->priv_mitra;
      }
      if (isset($_GET["usr_priv_admin"]) && isset($this->usr_priv_admin)) 
      {
          $_SESSION['usr_priv_admin'] = $this->usr_priv_admin;
      }
      if (isset($_GET["usr_name"]) && isset($this->usr_name)) 
      {
          $_SESSION['usr_name'] = $this->usr_name;
      }
      if (isset($_GET["groups"]) && isset($this->groups)) 
      {
          $_SESSION['groups'] = $this->groups;
      }
      if (isset($_GET["iddivre"]) && isset($this->iddivre)) 
      {
          $_SESSION['iddivre'] = $this->iddivre;
      }
      if (isset($_GET["idwitel"]) && isset($this->idwitel)) 
      {
          $_SESSION['idwitel'] = $this->idwitel;
      }
      if (isset($_GET["usr_priv_lokasi"]) && isset($this->usr_priv_lokasi)) 
      {
          $_SESSION['usr_priv_lokasi'] = $this->usr_priv_lokasi;
      }
      if (isset($_GET["groupsname"]) && isset($this->groupsname)) 
      {
          $_SESSION['groupsname'] = $this->groupsname;
      }
      if (isset($_GET["kodewitel"]) && isset($this->kodewitel)) 
      {
          $_SESSION['kodewitel'] = $this->kodewitel;
      }
      if (isset($_GET["kodedivre"]) && isset($this->kodedivre)) 
      {
          $_SESSION['kodedivre'] = $this->kodedivre;
      }
      if (isset($_GET["twitter_user"]) && isset($this->twitter_user)) 
      {
          $_SESSION['twitter_user'] = $this->twitter_user;
      }
      if (isset($_GET["twitter_email"]) && isset($this->twitter_email)) 
      {
          $_SESSION['twitter_email'] = $this->twitter_email;
      }
      if (isset($_GET["twitter_name"]) && isset($this->twitter_name)) 
      {
          $_SESSION['twitter_name'] = $this->twitter_name;
      }
      if (isset($this->nm_run_menu) && $this->nm_run_menu == 1)
      { 
          $_SESSION['sc_session'][$script_case_init]['app_Login']['nm_run_menu'] = 1;
      } 
      if (isset($_SESSION['sc_session'][$script_case_init]['app_Login']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['app_Login']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['app_Login']['embutida_parms']);
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
                 nm_limpa_str_app_Login($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->facebook_error_code)) 
          {
              $_SESSION['facebook_error_code'] = $this->facebook_error_code;
          }
          if (isset($this->facebook_error_msg)) 
          {
              $_SESSION['facebook_error_msg'] = $this->facebook_error_msg;
          }
          if (isset($this->facebook_user)) 
          {
              $_SESSION['facebook_user'] = $this->facebook_user;
          }
          if (isset($this->facebook_email)) 
          {
              $_SESSION['facebook_email'] = $this->facebook_email;
          }
          if (isset($this->facebook_name)) 
          {
              $_SESSION['facebook_name'] = $this->facebook_name;
          }
          if (isset($this->google_error_code)) 
          {
              $_SESSION['google_error_code'] = $this->google_error_code;
          }
          if (isset($this->google_error_msg)) 
          {
              $_SESSION['google_error_msg'] = $this->google_error_msg;
          }
          if (isset($this->google_user)) 
          {
              $_SESSION['google_user'] = $this->google_user;
          }
          if (isset($this->google_email)) 
          {
              $_SESSION['google_email'] = $this->google_email;
          }
          if (isset($this->google_name)) 
          {
              $_SESSION['google_name'] = $this->google_name;
          }
          if (isset($this->logged_date_login)) 
          {
              $_SESSION['logged_date_login'] = $this->logged_date_login;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
          if (isset($this->usr_email)) 
          {
              $_SESSION['usr_email'] = $this->usr_email;
          }
          if (isset($this->user_group)) 
          {
              $_SESSION['user_group'] = $this->user_group;
          }
          if (isset($this->priv_mitra)) 
          {
              $_SESSION['priv_mitra'] = $this->priv_mitra;
          }
          if (isset($this->usr_priv_admin)) 
          {
              $_SESSION['usr_priv_admin'] = $this->usr_priv_admin;
          }
          if (isset($this->usr_name)) 
          {
              $_SESSION['usr_name'] = $this->usr_name;
          }
          if (isset($this->groups)) 
          {
              $_SESSION['groups'] = $this->groups;
          }
          if (isset($this->iddivre)) 
          {
              $_SESSION['iddivre'] = $this->iddivre;
          }
          if (isset($this->idwitel)) 
          {
              $_SESSION['idwitel'] = $this->idwitel;
          }
          if (isset($this->usr_priv_lokasi)) 
          {
              $_SESSION['usr_priv_lokasi'] = $this->usr_priv_lokasi;
          }
          if (isset($this->groupsname)) 
          {
              $_SESSION['groupsname'] = $this->groupsname;
          }
          if (isset($this->kodewitel)) 
          {
              $_SESSION['kodewitel'] = $this->kodewitel;
          }
          if (isset($this->kodedivre)) 
          {
              $_SESSION['kodedivre'] = $this->kodedivre;
          }
          if (isset($this->twitter_user)) 
          {
              $_SESSION['twitter_user'] = $this->twitter_user;
          }
          if (isset($this->twitter_email)) 
          {
              $_SESSION['twitter_email'] = $this->twitter_email;
          }
          if (isset($this->twitter_name)) 
          {
              $_SESSION['twitter_name'] = $this->twitter_name;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['app_Login']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['app_Login']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['app_Login']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['app_Login']['sc_redir_insert'] = $this->sc_redir_insert;
          }
          if (isset($this->facebook_error_code)) 
          {
              $_SESSION['facebook_error_code'] = $this->facebook_error_code;
          }
          if (isset($this->facebook_error_msg)) 
          {
              $_SESSION['facebook_error_msg'] = $this->facebook_error_msg;
          }
          if (isset($this->facebook_user)) 
          {
              $_SESSION['facebook_user'] = $this->facebook_user;
          }
          if (isset($this->facebook_email)) 
          {
              $_SESSION['facebook_email'] = $this->facebook_email;
          }
          if (isset($this->facebook_name)) 
          {
              $_SESSION['facebook_name'] = $this->facebook_name;
          }
          if (isset($this->google_error_code)) 
          {
              $_SESSION['google_error_code'] = $this->google_error_code;
          }
          if (isset($this->google_error_msg)) 
          {
              $_SESSION['google_error_msg'] = $this->google_error_msg;
          }
          if (isset($this->google_user)) 
          {
              $_SESSION['google_user'] = $this->google_user;
          }
          if (isset($this->google_email)) 
          {
              $_SESSION['google_email'] = $this->google_email;
          }
          if (isset($this->google_name)) 
          {
              $_SESSION['google_name'] = $this->google_name;
          }
          if (isset($this->logged_date_login)) 
          {
              $_SESSION['logged_date_login'] = $this->logged_date_login;
          }
          if (isset($this->usr_login)) 
          {
              $_SESSION['usr_login'] = $this->usr_login;
          }
          if (isset($this->usr_email)) 
          {
              $_SESSION['usr_email'] = $this->usr_email;
          }
          if (isset($this->user_group)) 
          {
              $_SESSION['user_group'] = $this->user_group;
          }
          if (isset($this->priv_mitra)) 
          {
              $_SESSION['priv_mitra'] = $this->priv_mitra;
          }
          if (isset($this->usr_priv_admin)) 
          {
              $_SESSION['usr_priv_admin'] = $this->usr_priv_admin;
          }
          if (isset($this->usr_name)) 
          {
              $_SESSION['usr_name'] = $this->usr_name;
          }
          if (isset($this->groups)) 
          {
              $_SESSION['groups'] = $this->groups;
          }
          if (isset($this->iddivre)) 
          {
              $_SESSION['iddivre'] = $this->iddivre;
          }
          if (isset($this->idwitel)) 
          {
              $_SESSION['idwitel'] = $this->idwitel;
          }
          if (isset($this->usr_priv_lokasi)) 
          {
              $_SESSION['usr_priv_lokasi'] = $this->usr_priv_lokasi;
          }
          if (isset($this->groupsname)) 
          {
              $_SESSION['groupsname'] = $this->groupsname;
          }
          if (isset($this->kodewitel)) 
          {
              $_SESSION['kodewitel'] = $this->kodewitel;
          }
          if (isset($this->kodedivre)) 
          {
              $_SESSION['kodedivre'] = $this->kodedivre;
          }
          if (isset($this->twitter_user)) 
          {
              $_SESSION['twitter_user'] = $this->twitter_user;
          }
          if (isset($this->twitter_email)) 
          {
              $_SESSION['twitter_email'] = $this->twitter_email;
          }
          if (isset($this->twitter_name)) 
          {
              $_SESSION['twitter_name'] = $this->twitter_name;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['app_Login']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['app_Login']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['app_Login']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new app_Login_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("en_us");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['initialize'])
          {
              $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
                             if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_form_add_users']))
{
unset($_SESSION['scriptcase']['sc_apl_conf']['app_form_add_users']);
}
;
if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_retrieve_pswd']))
{
unset($_SESSION['scriptcase']['sc_apl_conf']['app_retrieve_pswd']);
}
;
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("en_us");
      } 
      $_SESSION['sc_session'][$script_case_init]['app_Login']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['app_Login']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['app_Login'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['app_Login']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['app_Login']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('app_Login') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['app_Login']['label'] = "Login";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "app_Login")
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
      $this->nm_new_label['login'] = '' . $this->Ini->Nm_lang['lang_sec_users_fild_login'] . '';
      $this->nm_new_label['pswd'] = '' . $this->Ini->Nm_lang['lang_sec_users_fild_pswd'] . '';

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



      $_SESSION['scriptcase']['error_icon']['app_Login']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__icnMensagemAlerta.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['app_Login'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_call'] : $this->Embutida_call;

       $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "off";
      $this->nmgp_botoes['ok'] = "on";
      $this->nmgp_botoes['facebook'] = "off";
      $this->nmgp_botoes['google'] = "off";
      $this->nmgp_botoes['twitter'] = "off";
      $this->nmgp_botoes['paypal'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['app_Login']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['app_Login'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['app_Login'];

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

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['exit'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form'];
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("app_Login", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'app_Login_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'app_Login_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('contr:' == substr($str_link_webhelp, 0, 6))
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
          require_once($this->Ini->path_embutida . 'app_Login/app_Login_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "app_Login_erro.class.php"); 
      }
      $this->Erro      = new app_Login_erro();
      $this->Erro->Ini = $this->Ini;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['app_Login']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['app_Login']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opc_ant'];
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = (!in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) ? true : false;
      $this->sc_evento = $this->nmgp_opcao;
      if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao && 'autocomp_' != substr($this->NM_ajax_opcao, 0, 9)))
      {
      $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($this->sc_temp_kodedivre)) {$this->sc_temp_kodedivre = (isset($_SESSION['kodedivre'])) ? $_SESSION['kodedivre'] : "";}
if (!isset($this->sc_temp_kodewitel)) {$this->sc_temp_kodewitel = (isset($_SESSION['kodewitel'])) ? $_SESSION['kodewitel'] : "";}
if (!isset($this->sc_temp_groupsname)) {$this->sc_temp_groupsname = (isset($_SESSION['groupsname'])) ? $_SESSION['groupsname'] : "";}
if (!isset($this->sc_temp_usr_priv_lokasi)) {$this->sc_temp_usr_priv_lokasi = (isset($_SESSION['usr_priv_lokasi'])) ? $_SESSION['usr_priv_lokasi'] : "";}
if (!isset($this->sc_temp_idwitel)) {$this->sc_temp_idwitel = (isset($_SESSION['idwitel'])) ? $_SESSION['idwitel'] : "";}
if (!isset($this->sc_temp_iddivre)) {$this->sc_temp_iddivre = (isset($_SESSION['iddivre'])) ? $_SESSION['iddivre'] : "";}
if (!isset($this->sc_temp_groups)) {$this->sc_temp_groups = (isset($_SESSION['groups'])) ? $_SESSION['groups'] : "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($this->sc_temp_priv_mitra)) {$this->sc_temp_priv_mitra = (isset($_SESSION['priv_mitra'])) ? $_SESSION['priv_mitra'] : "";}
if (!isset($this->sc_temp_user_group)) {$this->sc_temp_user_group = (isset($_SESSION['user_group'])) ? $_SESSION['user_group'] : "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
                            $this->sc_looged_check_logout();
$date_login = (isset($this->sc_temp_logged_date_login)? $this->sc_temp_logged_date_login : '');$this->sc_logged_out($this->sc_temp_usr_login, $date_login);
unset($_SESSION['scriptcase']['sc_apl_seg']);unset($_SESSION['scriptcase']['pass']);unset($_SESSION['usr_login']);
 unset($this->sc_temp_usr_login);
 unset($_SESSION['usr_email']);
 unset($this->sc_temp_usr_email);
 unset($_SESSION['user_group']);
 unset($this->sc_temp_user_group);
 unset($_SESSION['priv_mitra']);
 unset($this->sc_temp_priv_mitra);
 unset($_SESSION['usr_priv_admin']);
 unset($this->sc_temp_usr_priv_admin);
 unset($_SESSION['usr_name']);
 unset($this->sc_temp_usr_name);
 unset($_SESSION['groups']);
 unset($this->sc_temp_groups);
 unset($_SESSION['iddivre']);
 unset($this->sc_temp_iddivre);
 unset($_SESSION['idwitel']);
 unset($this->sc_temp_idwitel);
 unset($_SESSION['usr_priv_lokasi']);
 unset($this->sc_temp_usr_priv_lokasi);
 unset($_SESSION['groupsname']);
 unset($this->sc_temp_groupsname);
 unset($_SESSION['kodewitel']);
 unset($this->sc_temp_kodewitel);
 unset($_SESSION['kodedivre']);
 unset($this->sc_temp_kodedivre);
;
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
if (isset($this->sc_temp_user_group)) { $_SESSION['user_group'] = $this->sc_temp_user_group;}
if (isset($this->sc_temp_priv_mitra)) { $_SESSION['priv_mitra'] = $this->sc_temp_priv_mitra;}
if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_groups)) { $_SESSION['groups'] = $this->sc_temp_groups;}
if (isset($this->sc_temp_iddivre)) { $_SESSION['iddivre'] = $this->sc_temp_iddivre;}
if (isset($this->sc_temp_idwitel)) { $_SESSION['idwitel'] = $this->sc_temp_idwitel;}
if (isset($this->sc_temp_usr_priv_lokasi)) { $_SESSION['usr_priv_lokasi'] = $this->sc_temp_usr_priv_lokasi;}
if (isset($this->sc_temp_groupsname)) { $_SESSION['groupsname'] = $this->sc_temp_groupsname;}
if (isset($this->sc_temp_kodewitel)) { $_SESSION['kodewitel'] = $this->sc_temp_kodewitel;}
if (isset($this->sc_temp_kodedivre)) { $_SESSION['kodedivre'] = $this->sc_temp_kodedivre;}
if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off'; 
      }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


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
          if ('validate_login' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'login');
          }
          if ('validate_pswd' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'pswd');
          }
          if ('validate_links' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'links');
          }
          app_Login_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              app_Login_pack_ajax_response();
              exit;
          }
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
          $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  app_Login_pack_ajax_response();
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
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  app_Login_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
//
      if (!isset($nm_form_submit) && $this->nmgp_opcao != "nada")
      {
          $this->login = "" ;  
          $this->pswd = "" ;  
          $this->links = "" ;  
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form'] as $NM_campo => $NM_valor)
              {
                  $$NM_campo = $NM_valor;
              }
          }
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['recarga'] = $this->nmgp_opcao;
      }
      if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "" || $campos_erro != "" || !isset($this->bok) || $this->bok != "OK" || $this->nmgp_opcao == "recarga")
      {
          if ($Campos_Crit == "" && empty($Campos_Falta) && $this->Campos_Mens_erro == "" && !isset($this->bok) && $this->nmgp_opcao != "recarga")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos']))
              { 
                  $login = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][0]; 
                  $pswd = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][1]; 
                  $links = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][2]; 
              } 
          }
          $this->nm_gera_html();
          $this->NM_close_db(); 
      }
      elseif (isset($this->bok) && $this->bok == "OK")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'] = array(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][0] = $this->login; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][1] = $this->pswd; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['campos'][2] = $this->links; 
          if (!empty($this->links))
          {
              $trab_saida = $this->links;
              $diretorio = explode("/", $trab_saida);
              if (count($diretorio) > 2 || count($diretorio) == 0 || strtolower(substr($this->links, 0, 7)) == "http://" || strtolower(substr($this->links, 0, 8)) == "https://" || strtolower(substr($this->links, 0, 3)) == "../")
              {
                  $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $trab_saida;
              }
              else
              {
                  if (count($diretorio) == 1)
                  {
                      $limpa_dir = 2;
                      $compoe_url = str_replace(".php", "", $trab_saida);
                      $trab_saida = SC_dir_app_name($compoe_url) . "/";
                  }
                  else
                  {
                     $limpa_dir = 3;
                     $trab_saida = $diretorio[0] . "/";
                     $compoe_url = str_replace(".php", "", $diretorio[1]);
                     $trab_saida .= $compoe_url . "/" . $compoe_url . ".php";
                  }
                  $trab_path             = explode("/", $_SERVER['PHP_SELF']);
                  $trab_count_path       = count($trab_path);
                  $path_retorno_aplicacao  = "";
                  for ($ix = 0; $ix + $limpa_dir < $trab_count_path; $ix++)
                  {
                       $path_retorno_aplicacao .=  $trab_path[$ix] . "/";
                  }
                  $path_retorno_aplicacao .=  $trab_saida;
                  $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $path_retorno_aplicacao;
                  $nm_apl_dependente = 1; 
               }
               $this->NM_close_db(); 
               $this->nmgp_redireciona(); 
               exit;
           }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir'] == "redir")
          {
              $this->nmgp_redireciona(); 
          }
          else
          {
              $contr_menu = "";
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['iframe_menu'])
              {
                  $contr_menu = "glo_menu";
              }
              if (isset($_SESSION['scriptcase']['sc_ult_apl_menu']) && in_array("app_Login", $_SESSION['scriptcase']['sc_ult_apl_menu']))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona_form("app_Login_fim.php", $this->nm_location, $contr_menu); 
              }
              else
              {
                  $this->nm_gera_html();
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['embutida_proc'])
                  { 
                      $this->NM_close_db(); 
                  } 
              }
          }
          $this->NM_close_db(); 
          if ($this->NM_ajax_flag)
          {
              app_Login_pack_ajax_response();
              exit;
          }
      }
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
           case 'login':
               return "" . $this->Ini->Nm_lang['lang_sec_users_fild_login'] . "";
               break;
           case 'pswd':
               return "" . $this->Ini->Nm_lang['lang_sec_users_fild_pswd'] . "";
               break;
           case 'links':
               return "Links";
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

     include_once 'app_Login_securimage.php';
     $img_secur = new securimage();
     $valid = $img_secur->check($this->captcha_code);

     if (!$valid)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CAPTCHA: " . $this->Ini->Nm_lang['lang_othr_cptc_errm'] . "";
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_app_Login']) || !is_array($this->NM_ajax_info['errList']['geral_app_Login']))
              {
                  $this->NM_ajax_info['errList']['geral_app_Login'] = array();
              }
              $this->NM_ajax_info['errList']['geral_app_Login'][] = "CAPTCHA: " . $this->Ini->Nm_lang['lang_othr_cptc_errm'] . "";
          }
     }

     if ('' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_app_Login']) || !is_array($this->NM_ajax_info['errList']['geral_app_Login']))
              {
                  $this->NM_ajax_info['errList']['geral_app_Login'] = array();
              }
              $this->NM_ajax_info['errList']['geral_app_Login'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ('' == $filtro || 'login' == $filtro)
        $this->ValidateField_login($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "login";

      if ('' == $filtro || 'pswd' == $filtro)
        $this->ValidateField_pswd($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "pswd";

      if ('' == $filtro || 'links' == $filtro)
        $this->ValidateField_links($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ('' == $this->scFormFocusErrorName && ( !empty($Campos_Crit) || !empty($Campos_Falta) ))
          $this->scFormFocusErrorName = "links";


      if (empty($Campos_Crit) && empty($Campos_Falta))
      {
      if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
      {
      $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_login = $this->login;
    $original_pswd = $this->pswd;
}
if (!isset($this->sc_temp_kodedivre)) {$this->sc_temp_kodedivre = (isset($_SESSION['kodedivre'])) ? $_SESSION['kodedivre'] : "";}
if (!isset($this->sc_temp_kodewitel)) {$this->sc_temp_kodewitel = (isset($_SESSION['kodewitel'])) ? $_SESSION['kodewitel'] : "";}
if (!isset($this->sc_temp_groupsname)) {$this->sc_temp_groupsname = (isset($_SESSION['groupsname'])) ? $_SESSION['groupsname'] : "";}
if (!isset($this->sc_temp_usr_priv_lokasi)) {$this->sc_temp_usr_priv_lokasi = (isset($_SESSION['usr_priv_lokasi'])) ? $_SESSION['usr_priv_lokasi'] : "";}
if (!isset($this->sc_temp_idwitel)) {$this->sc_temp_idwitel = (isset($_SESSION['idwitel'])) ? $_SESSION['idwitel'] : "";}
if (!isset($this->sc_temp_iddivre)) {$this->sc_temp_iddivre = (isset($_SESSION['iddivre'])) ? $_SESSION['iddivre'] : "";}
if (!isset($this->sc_temp_groups)) {$this->sc_temp_groups = (isset($_SESSION['groups'])) ? $_SESSION['groups'] : "";}
if (!isset($this->sc_temp_user_group)) {$this->sc_temp_user_group = (isset($_SESSION['user_group'])) ? $_SESSION['user_group'] : "";}
if (!isset($this->sc_temp_priv_mitra)) {$this->sc_temp_priv_mitra = (isset($_SESSION['priv_mitra'])) ? $_SESSION['priv_mitra'] : "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
                             if($this->sc_logged_is_blocked()) { if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_priv_mitra)) { $_SESSION['priv_mitra'] = $this->sc_temp_priv_mitra;}
 if (isset($this->sc_temp_user_group)) { $_SESSION['user_group'] = $this->sc_temp_user_group;}
 if (isset($this->sc_temp_groups)) { $_SESSION['groups'] = $this->sc_temp_groups;}
 if (isset($this->sc_temp_iddivre)) { $_SESSION['iddivre'] = $this->sc_temp_iddivre;}
 if (isset($this->sc_temp_idwitel)) { $_SESSION['idwitel'] = $this->sc_temp_idwitel;}
 if (isset($this->sc_temp_usr_priv_lokasi)) { $_SESSION['usr_priv_lokasi'] = $this->sc_temp_usr_priv_lokasi;}
 if (isset($this->sc_temp_groupsname)) { $_SESSION['groupsname'] = $this->sc_temp_groupsname;}
 if (isset($this->sc_temp_kodewitel)) { $_SESSION['kodewitel'] = $this->sc_temp_kodewitel;}
 if (isset($this->sc_temp_kodedivre)) { $_SESSION['kodedivre'] = $this->sc_temp_kodedivre;}
    if ($this->NM_ajax_flag)
    {
        $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
        app_Login_pack_ajax_response();
        exit;
    }
    $Sc_Lixo = ob_get_clean();
    $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro);
    $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
    $this->Campos_Mens_erro = "";
    if ($this->nmgp_opcao == "incluir") {$this->nmgp_opcao = "novo";};
    $this->nm_formatar_campos();
    $this->nm_gera_html();
    $this->NM_close_db();
    exit;
}
}

$slogin = $this->Db->qstr($this->login );
$spswd = $this->Db->qstr(hash("md5",$this->pswd ));

$sql = "SELECT 
		PRIV_ADMIN,
		ACTIVE, 
		\"NAME\", 
		EMAIL,
		PRIV_MITRA,
		KODEMITRA,
		IDDIVRE,
        IDWITEL,
		PRIV_LOKASI
		FROM SEC_USERS 
	    WHERE LOGIN = $slogin
		AND PSWD = ".$spswd."";
	
 
      $nm_select = $sql; 
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
	
if(count($this->rs ) == 0)
{
	;
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .=  $this->Ini->Nm_lang['lang_error_login'] ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_app_Login' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] =  $this->Ini->Nm_lang['lang_error_login'] ;
 }
;
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_priv_mitra)) { $_SESSION['priv_mitra'] = $this->sc_temp_priv_mitra;}
 if (isset($this->sc_temp_user_group)) { $_SESSION['user_group'] = $this->sc_temp_user_group;}
 if (isset($this->sc_temp_groups)) { $_SESSION['groups'] = $this->sc_temp_groups;}
 if (isset($this->sc_temp_iddivre)) { $_SESSION['iddivre'] = $this->sc_temp_iddivre;}
 if (isset($this->sc_temp_idwitel)) { $_SESSION['idwitel'] = $this->sc_temp_idwitel;}
 if (isset($this->sc_temp_usr_priv_lokasi)) { $_SESSION['usr_priv_lokasi'] = $this->sc_temp_usr_priv_lokasi;}
 if (isset($this->sc_temp_groupsname)) { $_SESSION['groupsname'] = $this->sc_temp_groupsname;}
 if (isset($this->sc_temp_kodewitel)) { $_SESSION['kodewitel'] = $this->sc_temp_kodewitel;}
 if (isset($this->sc_temp_kodedivre)) { $_SESSION['kodedivre'] = $this->sc_temp_kodedivre;}
    if ($this->NM_ajax_flag)
    {
        $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
        app_Login_pack_ajax_response();
        exit;
    }
    $Sc_Lixo = ob_get_clean();
    $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro);
    $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
    $this->Campos_Mens_erro = "";
    if ($this->nmgp_opcao == "incluir") {$this->nmgp_opcao = "novo";};
    $this->nm_formatar_campos();
    $this->nm_gera_html();
    $this->NM_close_db();
    exit;
}
}
else if($this->rs[0][1] == 'Y')
{
$check_sql = "SELECT GROUP_ID FROM SEC_USERS_GROUPS WHERE LOGIN=$slogin";
 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rssql = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rssql[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rssql = false;
          $this->rssql_erro = $this->Db->ErrorMsg();
      } 
;

if (isset($this->rssql[0][0]))     
{
    $groups = $this->rssql[0][0];
    };
	$usr_login		= $this->login ;
	$usr_priv_admin 	= ($this->rs[0][0] == 'Y') ? TRUE : FALSE;
	$usr_name		= $this->rs[0][2];
	$usr_email		= $this->rs[0][3];
	$priv_mitra		= $this->rs[0][4];
	$user_group		= $this->rs[0][5];
	$iddivre		= $this->rs[0][6];
	$idwitel		= $this->rs[0][7];
	$usr_priv_lokasi 	= $this->rs[0][8];
	
	 if (isset($usr_login)) {$this->sc_temp_usr_login = $usr_login;}
;
	 if (isset($usr_priv_admin)) {$this->sc_temp_usr_priv_admin = $usr_priv_admin;}
;
	 if (isset($usr_name)) {$this->sc_temp_usr_name = $usr_name;}
;
	 if (isset($usr_email)) {$this->sc_temp_usr_email = $usr_email;}
;
	 if (isset($priv_mitra)) {$this->sc_temp_priv_mitra = $priv_mitra;}
;
	 if (isset($user_group)) {$this->sc_temp_user_group = $user_group;}
;
	 if (isset($groups)) {$this->sc_temp_groups = $groups;}
;
	 if (isset($iddivre)) {$this->sc_temp_iddivre = $iddivre;}
;
	 if (isset($idwitel)) {$this->sc_temp_idwitel = $idwitel;}
;
	 if (isset($usr_priv_lokasi)) {$this->sc_temp_usr_priv_lokasi = $usr_priv_lokasi;}
;
	
$check_sql = "SELECT DESCRIPTION FROM SEC_GROUPS WHERE GROUP_ID='$groups'";
 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rssqlgroup = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rssqlgroup[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rssqlgroup = false;
          $this->rssqlgroup_erro = $this->Db->ErrorMsg();
      } 
;

if (isset($this->rssqlgroup[0][0]))     
{
    $groupsname = $this->rssqlgroup[0][0];
	 if (isset($groupsname)) {$this->sc_temp_groupsname = $groupsname;}
;
    };

$check_sqlkode = "SELECT MW_KODEWITEL FROM TBL_MAS_WITEL
WHERE MW_IDWITEL='$idwitel'";
 
      $nm_select = $check_sqlkode; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rssqlkode = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rssqlkode[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rssqlkode = false;
          $this->rssqlkode_erro = $this->Db->ErrorMsg();
      } 
;

if (isset($this->rssqlkode[0][0]))     
{
    $kodewitel = $this->rssqlkode[0][0];
	 if (isset($kodewitel)) {$this->sc_temp_kodewitel = $kodewitel;}
;
    };

	$check_sqldivre = "SELECT MD_KODEDIVRE FROM TBL_MAS_DIVRE
WHERE MD_IDDIVRE='$iddivre'";
 
      $nm_select = $check_sqldivre; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rssqldivre = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rssqldivre[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rssqldivre = false;
          $this->rssqldivre_erro = $this->Db->ErrorMsg();
      } 
;

if (isset($this->rssqldivre[0][0]))     
{
    $kodedivre = $this->rssqldivre[0][0];
	 if (isset($kodedivre)) {$this->sc_temp_kodedivre = $kodedivre;}
;
    };

	
}
else
{
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .=  $this->Ini->Nm_lang['lang_error_not_active'] ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_app_Login' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] =  $this->Ini->Nm_lang['lang_error_not_active'] ;
 }
;
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
 if (isset($this->sc_temp_priv_mitra)) { $_SESSION['priv_mitra'] = $this->sc_temp_priv_mitra;}
 if (isset($this->sc_temp_user_group)) { $_SESSION['user_group'] = $this->sc_temp_user_group;}
 if (isset($this->sc_temp_groups)) { $_SESSION['groups'] = $this->sc_temp_groups;}
 if (isset($this->sc_temp_iddivre)) { $_SESSION['iddivre'] = $this->sc_temp_iddivre;}
 if (isset($this->sc_temp_idwitel)) { $_SESSION['idwitel'] = $this->sc_temp_idwitel;}
 if (isset($this->sc_temp_usr_priv_lokasi)) { $_SESSION['usr_priv_lokasi'] = $this->sc_temp_usr_priv_lokasi;}
 if (isset($this->sc_temp_groupsname)) { $_SESSION['groupsname'] = $this->sc_temp_groupsname;}
 if (isset($this->sc_temp_kodewitel)) { $_SESSION['kodewitel'] = $this->sc_temp_kodewitel;}
 if (isset($this->sc_temp_kodedivre)) { $_SESSION['kodedivre'] = $this->sc_temp_kodedivre;}
    if ($this->NM_ajax_flag)
    {
        $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
        app_Login_pack_ajax_response();
        exit;
    }
    $Sc_Lixo = ob_get_clean();
    $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro);
    $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
    $this->Campos_Mens_erro = "";
    if ($this->nmgp_opcao == "incluir") {$this->nmgp_opcao = "novo";};
    $this->nm_formatar_campos();
    $this->nm_gera_html();
    $this->NM_close_db();
    exit;
}
}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
if (isset($this->sc_temp_priv_mitra)) { $_SESSION['priv_mitra'] = $this->sc_temp_priv_mitra;}
if (isset($this->sc_temp_user_group)) { $_SESSION['user_group'] = $this->sc_temp_user_group;}
if (isset($this->sc_temp_groups)) { $_SESSION['groups'] = $this->sc_temp_groups;}
if (isset($this->sc_temp_iddivre)) { $_SESSION['iddivre'] = $this->sc_temp_iddivre;}
if (isset($this->sc_temp_idwitel)) { $_SESSION['idwitel'] = $this->sc_temp_idwitel;}
if (isset($this->sc_temp_usr_priv_lokasi)) { $_SESSION['usr_priv_lokasi'] = $this->sc_temp_usr_priv_lokasi;}
if (isset($this->sc_temp_groupsname)) { $_SESSION['groupsname'] = $this->sc_temp_groupsname;}
if (isset($this->sc_temp_kodewitel)) { $_SESSION['kodewitel'] = $this->sc_temp_kodewitel;}
if (isset($this->sc_temp_kodedivre)) { $_SESSION['kodedivre'] = $this->sc_temp_kodedivre;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_login != $this->login || (isset($bFlagRead_login) && $bFlagRead_login)))
    {
        $this->ajax_return_values_login(true);
    }
    if (($original_pswd != $this->pswd || (isset($bFlagRead_pswd) && $bFlagRead_pswd)))
    {
        $this->ajax_return_values_pswd(true);
    }
}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off'; 
      }
      }
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

      if (empty($Campos_Crit) && empty($Campos_Falta) && empty($this->Campos_Mens_erro))
      {
          if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
          {
              $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_login = $this->login;
}
                            $this->sc_validate_success();
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_login != $this->login || (isset($bFlagRead_login) && $bFlagRead_login)))
    {
        $this->ajax_return_values_login(true);
    }
}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off'; 
          }
      }
   }

    function ValidateField_login(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['php_cmp_required']['login']) || $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['php_cmp_required']['login'] == "on")) 
      { 
          if ($this->login == "")  
          { 
              $Campos_Falta[] =  "" . $this->Ini->Nm_lang['lang_sec_users_fild_login'] . "" ; 
              if (!isset($Campos_Erros['login']))
              {
                  $Campos_Erros['login'] = array();
              }
              $Campos_Erros['login'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['login']) || !is_array($this->NM_ajax_info['errList']['login']))
                  {
                      $this->NM_ajax_info['errList']['login'] = array();
                  }
                  $this->NM_ajax_info['errList']['login'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->login) > 60) 
          { 
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_sec_users_fild_login'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['login']))
              {
                  $Campos_Erros['login'] = array();
              }
              $Campos_Erros['login'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['login']) || !is_array($this->NM_ajax_info['errList']['login']))
              {
                  $this->NM_ajax_info['errList']['login'] = array();
              }
              $this->NM_ajax_info['errList']['login'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_login

    function ValidateField_pswd(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['php_cmp_required']['pswd']) || $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['php_cmp_required']['pswd'] == "on")) 
      { 
          if ($this->pswd == "")  
          { 
              $Campos_Falta[] =  "" . $this->Ini->Nm_lang['lang_sec_users_fild_pswd'] . "" ; 
              if (!isset($Campos_Erros['pswd']))
              {
                  $Campos_Erros['pswd'] = array();
              }
              $Campos_Erros['pswd'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['pswd']) || !is_array($this->NM_ajax_info['errList']['pswd']))
                  {
                      $this->NM_ajax_info['errList']['pswd'] = array();
                  }
                  $this->NM_ajax_info['errList']['pswd'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->pswd) > 32) 
          { 
              $Campos_Crit .= "" . $this->Ini->Nm_lang['lang_sec_users_fild_pswd'] . " " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 32 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['pswd']))
              {
                  $Campos_Erros['pswd'] = array();
              }
              $Campos_Erros['pswd'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['pswd']) || !is_array($this->NM_ajax_info['errList']['pswd']))
              {
                  $this->NM_ajax_info['errList']['pswd'] = array();
              }
              $this->NM_ajax_info['errList']['pswd'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 32 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
    } // ValidateField_pswd

    function ValidateField_links(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->links) != "")  
          { 
          } 
      } 
    } // ValidateField_links

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
    $this->nmgp_dados_form['login'] = $this->login;
    $this->nmgp_dados_form['pswd'] = $this->pswd;
    $this->nmgp_dados_form['links'] = $this->links;
    $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->formatado = false;
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
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
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

   function ajax_return_values()
   {
          $this->ajax_return_values_login();
          $this->ajax_return_values_pswd();
          $this->ajax_return_values_links();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          }
   } // ajax_return_values

          //----- login
   function ajax_return_values_login($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("login", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->login);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['login'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- pswd
   function ajax_return_values_pswd($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("pswd", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->pswd);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['pswd'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array(''),
              );
          }
   }

          //----- links
   function ajax_return_values_links($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("links", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->links);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['links'] = array(
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['upload_dir'][$fieldName][] = $newName;
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
//
function fb_return()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_facebook_name)) {$this->sc_temp_facebook_name = (isset($_SESSION['facebook_name'])) ? $_SESSION['facebook_name'] : "";}
if (!isset($this->sc_temp_facebook_email)) {$this->sc_temp_facebook_email = (isset($_SESSION['facebook_email'])) ? $_SESSION['facebook_email'] : "";}
if (!isset($this->sc_temp_facebook_user)) {$this->sc_temp_facebook_user = (isset($_SESSION['facebook_user'])) ? $_SESSION['facebook_user'] : "";}
if (!isset($this->sc_temp_facebook_error_msg)) {$this->sc_temp_facebook_error_msg = (isset($_SESSION['facebook_error_msg'])) ? $_SESSION['facebook_error_msg'] : "";}
if (!isset($this->sc_temp_facebook_error_code)) {$this->sc_temp_facebook_error_code = (isset($_SESSION['facebook_error_code'])) ? $_SESSION['facebook_error_code'] : "";}
                             
if(!empty($this->sc_temp_facebook_error_code))
{
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'urlencode($this->sc_temp_facebook_error_msg)';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_app_Login' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'urlencode($this->sc_temp_facebook_error_msg)';
 }
;
}
else
{
$this->get_social("facebook", $this->sc_temp_facebook_user, $this->sc_temp_facebook_email, $this->sc_temp_facebook_name);
}
if (isset($this->sc_temp_facebook_error_code)) { $_SESSION['facebook_error_code'] = $this->sc_temp_facebook_error_code;}
if (isset($this->sc_temp_facebook_error_msg)) { $_SESSION['facebook_error_msg'] = $this->sc_temp_facebook_error_msg;}
if (isset($this->sc_temp_facebook_user)) { $_SESSION['facebook_user'] = $this->sc_temp_facebook_user;}
if (isset($this->sc_temp_facebook_email)) { $_SESSION['facebook_email'] = $this->sc_temp_facebook_email;}
if (isset($this->sc_temp_facebook_name)) { $_SESSION['facebook_name'] = $this->sc_temp_facebook_name;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function get_social($resource, $user_id, $email, $name)
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_usr_name)) {$this->sc_temp_usr_name = (isset($_SESSION['usr_name'])) ? $_SESSION['usr_name'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
                             
if(empty($user_id)) return;

	$sql = "SELECT 
				ACTIVE, 
				\"NAME\",
				LOGIN
			FROM SEC_USERS 
				WHERE EMAIL = ". $this->Db->qstr($email).
		" OR login = (
		SELECT
			login
		FROM
			SEC_USERS_social
		WHERE
			resource = '". $resource ."'
			AND resource_id = ". $this->Db->qstr($user_id) .")";
	

	 
      $nm_select = $sql; 
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

	if(count($this->rs ) == 0)
	{
	$this->link_user($resource, $user_id, $email, $name);
		;
	$this->sc_logged_in_fail($user_id);
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .=  $this->Ini->Nm_lang['lang_error_login'] ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_app_Login' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] =  $this->Ini->Nm_lang['lang_error_login'] ;
 }
;
	}
	else if($this->rs[0][0] == 'Y')
	{
		$usr_login		= $this->rs[0][2];
		$usr_name		= $this->rs[0][1];
		$usr_email		= $email;
		 if (isset($usr_login)) {$this->sc_temp_usr_login = $usr_login;}
;
		 if (isset($usr_name)) {$this->sc_temp_usr_name = $usr_name;}
;
		 if (isset($usr_email)) {$this->sc_temp_usr_email = $usr_email;}
;
	$this->sc_validate_success();
	}
	else
	{
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .=  $this->Ini->Nm_lang['lang_error_not_active'] ;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_app_Login' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] =  $this->Ini->Nm_lang['lang_error_not_active'] ;
 }
;
		if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
 if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
    if ($this->NM_ajax_flag)
    {
        $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
        app_Login_pack_ajax_response();
        exit;
    }
    $Sc_Lixo = ob_get_clean();
    $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro);
    $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
    $this->Campos_Mens_erro = "";
    if ($this->nmgp_opcao == "incluir") {$this->nmgp_opcao = "novo";};
    $this->nm_formatar_campos();
    $this->nm_gera_html();
    $this->NM_close_db();
    exit;
}
}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_name)) { $_SESSION['usr_name'] = $this->sc_temp_usr_name;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function go_return()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_google_name)) {$this->sc_temp_google_name = (isset($_SESSION['google_name'])) ? $_SESSION['google_name'] : "";}
if (!isset($this->sc_temp_google_email)) {$this->sc_temp_google_email = (isset($_SESSION['google_email'])) ? $_SESSION['google_email'] : "";}
if (!isset($this->sc_temp_google_user)) {$this->sc_temp_google_user = (isset($_SESSION['google_user'])) ? $_SESSION['google_user'] : "";}
if (!isset($this->sc_temp_google_error_msg)) {$this->sc_temp_google_error_msg = (isset($_SESSION['google_error_msg'])) ? $_SESSION['google_error_msg'] : "";}
if (!isset($this->sc_temp_google_error_code)) {$this->sc_temp_google_error_code = (isset($_SESSION['google_error_code'])) ? $_SESSION['google_error_code'] : "";}
                             
if(!empty($this->sc_temp_google_error_code))
{
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'urlencode($this->sc_temp_google_error_msg)';
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_app_Login' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] = 'urlencode($this->sc_temp_google_error_msg)';
 }
;
}
else
{
$this->get_social("google", $this->sc_temp_google_user, $this->sc_temp_google_email, $this->sc_temp_google_name);
}
if (isset($this->sc_temp_google_error_code)) { $_SESSION['google_error_code'] = $this->sc_temp_google_error_code;}
if (isset($this->sc_temp_google_error_msg)) { $_SESSION['google_error_msg'] = $this->sc_temp_google_error_msg;}
if (isset($this->sc_temp_google_user)) { $_SESSION['google_user'] = $this->sc_temp_google_user;}
if (isset($this->sc_temp_google_email)) { $_SESSION['google_email'] = $this->sc_temp_google_email;}
if (isset($this->sc_temp_google_name)) { $_SESSION['google_name'] = $this->sc_temp_google_name;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function has_priv($param)
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
                             
return ($param == 'Y' ? 'on' : 'off');

$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function link_user($resource, $usr_id, $email, $name)
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_usr_priv_admin)) {$this->sc_temp_usr_priv_admin = (isset($_SESSION['usr_priv_admin'])) ? $_SESSION['usr_priv_admin'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
                             
	$group_default = 10;

	$sql = "INSERT INTO
				SEC_USERS( LOGIN, \"NAME\", PSWD, EMAIL, ACTIVE )
			VALUES 
				(". $this->Db->qstr($usr_id). ", ".
					$this->Db->qstr($name) . ", ".
					$this->Db->qstr(hash("md5",date("YmdHis"))) . ", ".
					$this->Db->qstr($email) . ", 'Y')";
			
	
	
     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
	
	$sql = "INSERT INTO
				SEC_USERS_social( SEC_USERS_social.login, SEC_USERS_social.resource, SEC_USERS_social.resource_id )
			VALUES 
				(". $this->Db->qstr($usr_id). ", ".
					$this->Db->qstr($resource) . ", ".
					$this->Db->qstr($usr_id) . ")";
			
	
	
     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
									 
	
	$sql = "INSERT INTO
				SEC_USERS_GROUPS( LOGIN, GROUP_ID )
			VALUES 
				(". $this->Db->qstr($usr_id). ", ".
					$this->Db->qstr($group_default) . ")";
			
	
	
     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;

	
	$usr_login			= $usr_id;
	$usr_priv_admin 	= FALSE;
	$usr_email			= $email;
	 if (isset($usr_login)) {$this->sc_temp_usr_login = $usr_login;}
;
	 if (isset($usr_priv_admin)) {$this->sc_temp_usr_priv_admin = $usr_priv_admin;}
;
	 if (isset($usr_email)) {$this->sc_temp_usr_email = $usr_email;}
;
$this->sc_validate_success();
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_usr_priv_admin)) { $_SESSION['usr_priv_admin'] = $this->sc_temp_usr_priv_admin;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_validate_success()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_priv_mitra)) {$this->sc_temp_priv_mitra = (isset($_SESSION['priv_mitra'])) ? $_SESSION['priv_mitra'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
if (!isset($this->sc_temp_namamitra)) {$this->sc_temp_namamitra = (isset($_SESSION['namamitra'])) ? $_SESSION['namamitra'] : "";}
                             
$sql = "SELECT 
		APP_NAME,
		PRIV_ACCESS,
		PRIV_INSERT,
		PRIV_DELETE,
		PRIV_UPDATE,
		PRIV_EXPORT,
		PRIV_PRINT
	      FROM SEC_GROUPS_APPS
	      WHERE GROUP_ID IN
	          (SELECT
		       GROUP_ID
		   FROM
		       SEC_USERS_GROUPS 
		   WHERE
		       LOGIN = '". $this->sc_temp_usr_login ."')";
		
	
 
      $nm_select = $sql; 
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

$arr_default = array(
					'access' => 'off',
					'insert' => 'off',
					'delete' => 'off',
					'update' => 'off',
					'export' => 'btn_display_off',
					'print'  => 'btn_display_off',
					);
if ($this->rs  !== false)
{
	$arr_perm = array();
	while (!$this->rs->EOF)
	{
		$app = $this->rs->fields[0];
		
		if(!isset($arr_perm[$app]))
		{
		   $arr_perm[$app] = $arr_default;
		}
		if( $this->rs->fields[1] == 'Y')
		{
			$arr_perm[$app][ 'access' ] = 'on';
		}
		if($this->rs->fields[2] == 'Y')
		{
			$arr_perm[$app][ 'insert' ] = 'on';
		}
		if($this->rs->fields[3] == 'Y')
		{
			$arr_perm[$app][ 'delete' ] = 'on';
		}
		if($this->rs->fields[4] == 'Y')
		{
			$arr_perm[$app][ 'update' ] = 'on';
		}
		if($this->rs->fields[5] == 'Y')
		{
			$arr_perm[$app]['export'] =  'btn_display_on';
		}
		if($this->rs->fields[6] == 'Y')
		{
			$arr_perm[$app]['print'] =  'btn_display_on';
		}


		$this->rs->MoveNext();	
	}
	$this->rs->Close();
		   
	foreach($arr_perm as $app => $perm)
	{
		$_SESSION['scriptcase']['sc_apl_seg'][$app] = $perm['access'];;
		
		$_SESSION['scriptcase']['sc_apl_conf'][$app]['insert'] = $perm['insert'];
		$_SESSION['scriptcase']['sc_apl_conf'][$app]['delete'] = $perm['delete'];
		$_SESSION['scriptcase']['sc_apl_conf'][$app]['update'] = $perm['update'];
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['xls'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['xls'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['xls'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['xls'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['xls'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'xls';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['word'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['word'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['word'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['word'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['word'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'word';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['pdf'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['pdf'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['pdf'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['pdf'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['pdf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'pdf';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['xml'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['xml'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['xml'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['xml'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['xml'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'xml';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['csv'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['csv'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['csv'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['csv'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['csv'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'csv';
}
;
		if ($perm['export'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['rtf'] = 'on';
}
elseif ($perm['export'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['rtf'] = 'off';
}
elseif ($perm['export'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['rtf'] = 'on';
}
elseif ($perm['export'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['rtf'] = 'off';
}
elseif ($perm['export'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']]['rtf'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['export']] = 'rtf';
}
;
		if ($perm['print'] == 'btn_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['print'] = 'on';
}
elseif ($perm['print'] == 'btn_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['btn_display']['print'] = 'off';
}
elseif ($perm['print'] == 'field_display_on') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['print'] = 'on';
}
elseif ($perm['print'] == 'field_display_off') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app]['field_display']['print'] = 'off';
}
elseif ($perm['print'] == 'field_readonly') {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['print']]['print'] = 'on';
}
else {
    $_SESSION['scriptcase']['sc_apl_conf'][$app][$perm['print']] = 'print';
}
;

	}
 if($this->sc_logged($this->login )):
    ;
    $_SESSION['scriptcase']['user_logout'][] = array('V' => 'logged_user', 'U' => 'logout', 'R' => 'app_Login', 'T' => '_top');;
    if ($this->sc_temp_priv_mitra == 'Y') {
    $check_sqlmitra = "SELECT TM_NAMAMITRA TBL_MITRA WHERE TM_IDMITRA='$user_group'";
     
      $nm_select = $check_sqlmitra; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rssqlmitra = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rssqlmitra[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rssqlmitra = false;
          $this->rssqlmitra_erro = $this->Db->ErrorMsg();
      } 
;
    if (isset($this->rssqlmitra[0][0]))     
      {
        $namamitra = $this->rssqlmitra[0][0];
       if (isset($namamitra)) {$this->sc_temp_namamitra = $namamitra;}
;
      }
       if (isset($this->sc_temp_namamitra)) { $_SESSION['namamitra'] = $this->sc_temp_namamitra;}
 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_priv_mitra)) { $_SESSION['priv_mitra'] = $this->sc_temp_priv_mitra;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('menumitra') . "/", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
              } else {
               if (isset($this->sc_temp_namamitra)) { $_SESSION['namamitra'] = $this->sc_temp_namamitra;}
 if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
 if (isset($this->sc_temp_priv_mitra)) { $_SESSION['priv_mitra'] = $this->sc_temp_priv_mitra;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('menu') . "/", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };  
              }
  endif;		
}
if (isset($this->sc_temp_namamitra)) { $_SESSION['namamitra'] = $this->sc_temp_namamitra;}
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_priv_mitra)) { $_SESSION['priv_mitra'] = $this->sc_temp_priv_mitra;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function tw_return()
{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_twitter_name)) {$this->sc_temp_twitter_name = (isset($_SESSION['twitter_name'])) ? $_SESSION['twitter_name'] : "";}
if (!isset($this->sc_temp_twitter_email)) {$this->sc_temp_twitter_email = (isset($_SESSION['twitter_email'])) ? $_SESSION['twitter_email'] : "";}
if (!isset($this->sc_temp_twitter_user)) {$this->sc_temp_twitter_user = (isset($_SESSION['twitter_user'])) ? $_SESSION['twitter_user'] : "";}
                             $this->get_social("twitter", $this->sc_temp_twitter_user, $this->sc_temp_twitter_email,$this->sc_temp_twitter_name);


if (isset($this->sc_temp_twitter_user)) { $_SESSION['twitter_user'] = $this->sc_temp_twitter_user;}
if (isset($this->sc_temp_twitter_email)) { $_SESSION['twitter_email'] = $this->sc_temp_twitter_email;}
if (isset($this->sc_temp_twitter_name)) { $_SESSION['twitter_name'] = $this->sc_temp_twitter_name;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_logged($user, $ip = '')
	{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
                             
		$str_sql = "SELECT DATE_LOGIN, IP FROM SEC_LOGGED WHERE LOGIN = '". $user ."' AND SC_SESSION <> '_SC_FAIL_SC_'";

		 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->data = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->data = false;
          $this->data_erro = $this->Db->ErrorMsg();
      } 
;

		if($this->data  === FALSE || !isset($this->data->fields[0]))
		{
            $ip = ($ip == '') ? $_SERVER['REMOTE_ADDR'] : $ip;
		$this->sc_logged_in($user, $ip);
			return true;
		}
		else
		{
            if (isset($_SESSION['scriptcase']['sc_apl_conf']['app_logged']))
{
unset($_SESSION['scriptcase']['sc_apl_conf']['app_logged']);
}
;
            $_SESSION['scriptcase']['sc_apl_seg']['app_logged'] = "on";;
			 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('app_logged') . "/", $this->nm_location, "user?#?" . $user . "?@?", "modal", "ret_self", 440, 630);
 };
			return false;
		}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_verify_logged()
	{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($this->sc_temp_logged_user)) {$this->sc_temp_logged_user = (isset($_SESSION['logged_user'])) ? $_SESSION['logged_user'] : "";}
                             
		$str_sql = "SELECT count(*) FROM SEC_LOGGED WHERE LOGIN = '". $this->sc_temp_logged_user . "' AND DATE_LOGIN = '". $this->sc_temp_logged_date_login ."' AND SC_SESSION <> '_SC_FAIL_SC_'";
		 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_logged = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rs_logged[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_logged = false;
          $this->rs_logged_erro = $this->Db->ErrorMsg();
      } 
;
		if($this->rs_logged[0][0] != 1)
		{
			 if (isset($this->sc_temp_logged_user)) { $_SESSION['logged_user'] = $this->sc_temp_logged_user;}
 if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('app_Login') . "/", $this->nm_location, "", "_parent", "ret_self", 440, 630);
 };
		}
if (isset($this->sc_temp_logged_user)) { $_SESSION['logged_user'] = $this->sc_temp_logged_user;}
if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_logged_in($user, $ip = '')
	{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($this->sc_temp_logged_user)) {$this->sc_temp_logged_user = (isset($_SESSION['logged_user'])) ? $_SESSION['logged_user'] : "";}
                             
        $ip = ($ip == '') ? $_SERVER['REMOTE_ADDR'] : $ip;
		$this->sc_temp_logged_user = $user;
		$this->sc_temp_logged_date_login = microtime(true);

        $str_sql = "DELETE FROM SEC_LOGGED WHERE LOGIN = '". $user . "' AND SC_SESSION = '_SC_FAIL_SC_' AND IP = '".$ip."'";
        
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;

    	$str_sql = "INSERT INTO SEC_LOGGED(LOGIN, DATE_LOGIN, SC_SESSION, IP) VALUES ('". $user ."', '". $this->sc_temp_logged_date_login ."', '". session_id() ."', '". $ip ."')";
	    
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
if (isset($this->sc_temp_logged_user)) { $_SESSION['logged_user'] = $this->sc_temp_logged_user;}
if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_logged_in_fail($user, $ip = '')
    {
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
                             
        $ip = ($ip == '') ? $_SERVER['REMOTE_ADDR'] : $ip;
        $str_sql = "INSERT INTO SEC_LOGGED(LOGIN, DATE_LOGIN, SC_SESSION, IP) VALUES ('" . $user . "', '" . microtime(true) . "', '_SC_FAIL_SC_', '" . $ip . "')";
        
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
        return true;
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_logged_is_blocked($ip = '')
    {
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
                             
        $ip = ($ip == '') ? $_SERVER['REMOTE_ADDR'] : $ip;
        $minutes_ago = strtotime("-10 minutes");
        $str_select = "SELECT count(*) FROM SEC_LOGGED WHERE SC_SESSION = '_SC_BLOCKED_SC_' AND IP = '".$ip."' AND DATE_LOGIN > '". $minutes_ago ."'";
         
      $nm_select = $str_select; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_logged = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rs_logged[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_logged = false;
          $this->rs_logged_erro = $this->Db->ErrorMsg();
      } 
;
        if($this->rs_logged  !== FALSE && $this->rs_logged[0][0] == 1)
        {
            $message =  $this->Ini->Nm_lang['lang_user_blocked'] ;
                $message = sprintf($message, 10);
                
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $message;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_app_Login' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $message;
 }
;
                return true;
        }

        $str_select = "SELECT count(*) FROM SEC_LOGGED WHERE SC_SESSION = '_SC_FAIL_SC_' AND IP = '".$ip."' AND DATE_LOGIN > '". $minutes_ago ."'";
         
      $nm_select = $str_select; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_logged = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->rs_logged[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_logged = false;
          $this->rs_logged_erro = $this->Db->ErrorMsg();
      } 
;

        if($this->rs_logged  !== FALSE && $this->rs_logged[0][0] == 10)
        {
            $str_sql = "INSERT INTO SEC_LOGGED(LOGIN, DATE_LOGIN, SC_SESSION, IP) VALUES ('blocked', '". microtime(true) ."', '_SC_BLOCKED_SC_', '". $ip ."')";
            
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
            $message =  $this->Ini->Nm_lang['lang_user_blocked'] ;
                $message = sprintf($message, 10);
                
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $message;
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6))
 {
  $sErrorIndex = ('submit_form' == $this->NM_ajax_opcao) ? 'geral_app_Login' : substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  $this->NM_ajax_info['errList'][$sErrorIndex][] = $message;
 }
;
                return true;
        }
        return false;
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_logged_out($user, $date_login = '')
	{
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_logged_user)) {$this->sc_temp_logged_user = (isset($_SESSION['logged_user'])) ? $_SESSION['logged_user'] : "";}
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
                             
		$date_login = ($date_login == '' ? "" : " AND DATE_LOGIN = '". $date_login ."'");

		$str_sql = "SELECT SC_SESSION FROM SEC_LOGGED WHERE LOGIN = '". $user ."' ". $date_login . " AND SC_SESSION <> '_SC_FAIL_SC_'";
		 
      $nm_select = $str_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->data = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                      $this->data[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->data = false;
          $this->data_erro = $this->Db->ErrorMsg();
      } 
;
		if(isset($this->data[0][0]) && !empty($this->data[0][0]))
        {
			$session_bkp = $_SESSION;
			$sessionid = session_id();
			session_write_close();

			session_id($this->data[0][0]);
			session_start();
			$_SESSION['logged_user'] = 'logout';
			session_write_close();

			session_id($sessionid);
			session_start();
			$_SESSION = $session_bkp;
		}


		$str_sql = "DELETE FROM SEC_LOGGED WHERE LOGIN = '". $user . "' " . $date_login;
		
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                app_Login_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      ;
		 unset($_SESSION['logged_date_login']);
 unset($this->sc_temp_logged_date_login);
 unset($_SESSION['logged_user']);
 unset($this->sc_temp_logged_user);
;
if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
if (isset($this->sc_temp_logged_user)) { $_SESSION['logged_user'] = $this->sc_temp_logged_user;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
}
function sc_looged_check_logout()
    {
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($this->sc_temp_logged_user)) {$this->sc_temp_logged_user = (isset($_SESSION['logged_user'])) ? $_SESSION['logged_user'] : "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
                             
        if(isset($this->sc_temp_logged_user) && ($this->sc_temp_logged_user == 'logout' || empty($this->sc_temp_logged_user)))
        {
             unset($_SESSION['usr_login']);
 unset($this->sc_temp_usr_login);
 unset($_SESSION['logged_user']);
 unset($this->sc_temp_logged_user);
 unset($_SESSION['logged_date_login']);
 unset($this->sc_temp_logged_date_login);
 unset($_SESSION['usr_email']);
 unset($this->sc_temp_usr_email);
;
        }
if (isset($this->sc_temp_usr_login)) { $_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_logged_user)) { $_SESSION['logged_user'] = $this->sc_temp_logged_user;}
if (isset($this->sc_temp_logged_date_login)) { $_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
if (isset($this->sc_temp_usr_email)) { $_SESSION['usr_email'] = $this->sc_temp_usr_email;}
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              app_Login_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1) 
      { 
          $nm_saida_global = $_SESSION['scriptcase']['nm_sc_retorno']; 
      } 
    if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
    $_SESSION['scriptcase']['app_Login']['contr_erro'] = 'on';
                             $_SESSION['scriptcase']['sc_apl_conf']['app_form_add_users']['start'] = 'new';
$_SESSION['scriptcase']['app_Login']['contr_erro'] = 'off'; 
    }
    if (!empty($this->Campos_Mens_erro)) 
    {
        $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
    }
    $this->nm_formatar_campos();
        $this->initFormPages();
    include_once("app_Login_form0.php");
        $this->hideFormPages();
 }

        function initFormPages() {
        } // initFormPages

        function hideFormPages() {
        } // hideFormPages

    function form_encode_input($string)
    {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['csrf_token'];
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
      $this->NM_case_insensitive = (!in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) ? true : false;
      if (empty($data_search)) 
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              app_Login_pack_ajax_response();
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
      if ($this->NM_case_insensitive)
      {
          $comando = str_replace("#lowerI#", "Upper(", $comando);
          $comando = str_replace("#lowerF#", ")", $comando);
      }
      else
      {
          $comando = str_replace("#lowerI#", "", $comando);
          $comando = str_replace("#lowerF#", "", $comando);
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter_form'] . " and (" . $comando . ")";
      }
      else
      {
         $sc_where = " where " . $comando;
      }
      $nmgp_select = "SELECT count(*) from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_app_Login = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['total'] = $qt_geral_reg_app_Login;
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          app_Login_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          app_Login_pack_ajax_response();
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
      $nm_ini_lower = " #lowerI#";
      $nm_fim_lower = "#lowerF#";
      
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['decimal_db'] == ".")
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
         $nm_ini_lower = "";
         $nm_fim_lower = "";
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
         $comando .= (!empty($comando) ? " or " : "");
         if (is_array($campo))
         {
             $prep = "";
             foreach ($campo as $Ind => $Cmp)
             {
                 $prep .= (!empty($prep)) ? "," : "";
                 $Cmp   = substr($this->Db->qstr($Cmp), 1, -1);
                 if ($this->NM_case_insensitive)
                 {
                     $Cmp  = sc_strtoupper($Cmp);
                 }
                 $prep .= $nm_aspas . $Cmp . $nm_aspas1;
             }
             $prep .= (empty($prep)) ? $nm_aspas . $nm_aspas1 : "";
             $comando .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $prep . ")";
             return;
         }
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         if ($this->NM_case_insensitive)
         {
            $campo  = sc_strtoupper($campo);
         }
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
       $nmgp_saida_form = "app_Login_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['nm_run_menu'] = 2;
       $nmgp_saida_form = "app_Login_fim.php";
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
       app_Login_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['masterValue']);
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
function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $opc="", $alt_modal=430, $larg_modal=630)
{
   if (isset($this->NM_is_redirected) && $this->NM_is_redirected)
   {
       return;
   }
   if (is_array($nm_apl_parms))
   {
       $tmp_parms = "";
       foreach ($nm_apl_parms as $par => $val)
       {
           $par = trim($par);
           $val = trim($val);
           $tmp_parms .= str_replace(".", "_", $par) . "?#?";
           if (substr($val, 0, 1) == "$")
           {
               $tmp_parms .= $$val;
           }
           elseif (substr($val, 0, 1) == "{")
           {
               $val        = substr($val, 1, -1);
               $tmp_parms .= $this->$val;
           }
           elseif (substr($val, 0, 1) == "[")
           {
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login'][substr($val, 1, -1)];
           }
           else
           {
               $tmp_parms .= $val;
           }
           $tmp_parms .= "?@?";
       }
       $nm_apl_parms = $tmp_parms;
   }
   if (empty($opc))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['app_Login']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           app_Login_pack_ajax_response();
           exit;
       }
       echo "<SCRIPT language=\"javascript\">";
       if (strtolower($nm_target) == "_blank")
       {
           echo "window.open ('" . $nm_apl_dest . "');";
           echo "</SCRIPT>";
           return;
       }
       else
       {
           echo "window.location='" . $nm_apl_dest . "';";
           echo "</SCRIPT>";
           $this->NM_close_db();
           exit;
       }
   }
   $dir = explode("/", $nm_apl_dest);
   if (count($dir) == 1)
   {
       $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
       $nm_apl_dest = $this->Ini->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
   }
   if ($this->NM_ajax_flag)
   {
       $nm_apl_parms = str_replace("?#?", "*scin", NM_charset_to_utf8($nm_apl_parms));
       $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
       $this->NM_ajax_info['redir']['metodo']     = 'post';
       $this->NM_ajax_info['redir']['action']     = $nm_apl_dest;
       $this->NM_ajax_info['redir']['nmgp_parms'] = $nm_apl_parms;
       $this->NM_ajax_info['redir']['target']     = $nm_target_form;
       $this->NM_ajax_info['redir']['h_modal']    = $alt_modal;
       $this->NM_ajax_info['redir']['w_modal']    = $larg_modal;
       if ($nm_target_form == "_blank")
       {
           $this->NM_ajax_info['redir']['nmgp_outra_jan'] = 'true';
       }
       else
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida']      = $nm_apl_retorno;
           $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
           $this->NM_ajax_info['redir']['script_case_session'] = session_id();
       }
       app_Login_pack_ajax_response();
       exit;
   }
   if ($nm_target == "modal")
   {
       if (!empty($nm_apl_parms))
       {
           $nm_apl_parms = str_replace("?#?", "*scin", $nm_apl_parms);
           $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
           $nm_apl_parms = "nmgp_parms=" . $nm_apl_parms . "&";
       }
       $par_modal = "?script_case_init=" . $this->Ini->sc_page . "&script_case_session=" . session_id() . "&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&";
       $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') })";
       $this->NM_is_redirected = true;
       return;
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
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
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery.js"></SCRIPT>
   </HEAD>
   <BODY>
<?php
   }
?>
<form name="Fredir" method="post" 
                  target="_self"> 
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
<?php
   if ($nm_target_form == "_blank")
   {
?>
  <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
  <input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nm_apl_retorno) ?>">
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
  <input type="hidden" name="script_case_session" value="<?php echo $this->form_encode_input(session_id()); ?>"> 
<?php
   }
?>
</form> 
   <SCRIPT type="text/javascript">
<?php
   if ($nm_target_form == "modal")
   {
?>
       $(document).ready(function(){
           tb_show('', '<?php echo $nm_apl_dest ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&script_case_session=<?php echo session_id() ?> &nmgp_url_saida=modal&nmgp_parms=<?php echo $this->form_encode_input($nm_apl_parms); ?>&nmgp_outra_jan=true&TB_iframe=true&height=<?php echo $alt_modal; ?>&width=<?php echo $larg_modal; ?>&modal=true', '');
       });
<?php
   }
   else
   {
?>
    $(function() {
       document.Fredir.target = "<?php echo $nm_target_form ?>"; 
       document.Fredir.action = "<?php echo $nm_apl_dest ?>";
       document.Fredir.submit();
    });
<?php
   }
?>
   </SCRIPT>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
?>
   </BODY>
   </HTML>
<?php
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
       $this->NM_close_db();
       exit;
   }
}
}
?>
