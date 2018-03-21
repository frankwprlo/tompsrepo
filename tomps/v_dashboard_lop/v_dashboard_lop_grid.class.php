<?php
class v_dashboard_lop_grid
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Tot;
   var $Lin_impressas;
   var $Lin_final;
   var $Rows_span;
   var $NM_colspan;
   var $rs_grid;
   var $nm_grid_ini;
   var $nm_grid_sem_reg;
   var $nm_prim_linha;
   var $Rec_ini;
   var $Rec_fim;
   var $nmgp_reg_start;
   var $nmgp_reg_inicial;
   var $nmgp_reg_final;
   var $SC_seq_register;
   var $SC_seq_page;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $NM_raiz_img; 
   var $Ind_lig_mult; 
   var $NM_opcao; 
   var $NM_flag_antigo; 
   var $nm_campos_cab = array();
   var $nm_campos_rod = array();
   var $NM_cmp_hidden = array();
   var $nmgp_botoes = array();
   var $Cmps_ord_def = array();
   var $nmgp_label_quebras = array();
   var $nmgp_prim_pag_pdf;
   var $Campos_Mens_erro;
   var $Print_All;
   var $NM_field_over;
   var $NM_field_click;
   var $NM_bg_tot;
   var $NM_bg_sub_tot;
   var $NM_cont_body; 
   var $NM_emb_tree_no; 
   var $progress_fp;
   var $progress_tot;
   var $progress_now;
   var $progress_lim_tot;
   var $progress_lim_now;
   var $progress_lim_qtd;
   var $progress_grid;
   var $progress_pdf;
   var $progress_res;
   var $progress_graf;
   var $count_ger;
   var $sum_kickoffmeeting;
   var $sum_survey;
   var $sum_rab_apd_kml;
   var $sum_njki_justifikasi_nodin;
   var $sum_perijinan;
   var $sum_deliverymaterial;
   var $sum_bctr;
   var $sum_gelarhdpetanamtiang;
   var $sum_gelarkabel;
   var $sum_pasangterminalterminasijumperodf;
   var $sum_pasangterminalterminasjumperodc;
   var $sum_pasangterminalodp;
   var $sum_terminasiodp;
   var $sum_testcomm;
   var $sum_ujiterima;
   var $sum_bautrekon;
   var $sum_amandemenbast;
   var $sum_grir;
   var $sum_newentry;
   var $sum_inprogress;
   var $sum_others;
   var $sum_complete;
   var $tahapan;
   var $tp_witel;
   var $kickoffmeeting;
   var $survey;
   var $rab_apd_kml;
   var $njki_justifikasi_nodin;
   var $perijinan;
   var $deliverymaterial;
   var $bctr;
   var $gelarhdpetanamtiang;
   var $gelarkabel;
   var $pasangterminalterminasijumperodf;
   var $pasangterminalterminasjumperodc;
   var $pasangterminalodp;
   var $terminasiodp;
   var $testcomm;
   var $ujiterima;
   var $bautrekon;
   var $amandemenbast;
   var $grir;
   var $newentry;
   var $inprogress;
   var $others;
   var $complete;
//--- 
 function monta_grid($linhas = 0)
 {
   global $nm_saida;

   clearstatcache();
   $this->NM_cor_embutida();
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['usr_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid($linhas);
       $this->nm_fim_grid();
   } 
   else 
   { 
       $this->cabecalho();
       $nm_saida->saida(" <TR>\r\n");
       $nm_saida->saida("  <TD id='sc_grid_content' style='padding: 0px;' colspan=3>\r\n");
       $nm_saida->saida("    <table width='100%' cellspacing=0 cellpadding=0>\r\n");
       $nmgrp_apl_opcao= (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['v_dashboard_lop'])) ? "pdf" : $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'];
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_barra_top();
           $this->nmgp_embbed_placeholder_top();
       } 
       $this->grid();
       if ($nmgrp_apl_opcao != "pdf")
       { 
           $this->nmgp_embbed_placeholder_bot();
           $this->nmgp_barra_bot();
       } 
       $nm_saida->saida("   </table>\r\n");
       $nm_saida->saida("  </TD>\r\n");
       $nm_saida->saida(" </TR>\r\n");
       $this->rodape();
       $flag_apaga_pdf_log = TRUE;
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf")
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "igual";
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'];
 }
 function resume($linhas = 0)
 {
    $this->Lin_impressas = 0;
    $this->Lin_final     = FALSE;
    $this->grid($linhas);
 }
//--- 
 function inicializa()
 {
   global $nm_saida, $NM_run_iframe,
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det,
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $this->Ind_lig_mult = 0;
   $this->nm_data    = new nm_data("en_us");
   $this->Css_Cmp = array();
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "v_dashboard_lop/v_dashboard_lop_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = trim(substr($cada_css, 1, $Pos1 - 1));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['doc_word'])
       { 
           $this->Css_Cmp[$Tag] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag] = "";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'] = array();
   }
   $this->force_toolbar = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['force_toolbar']);
   } 
   $this->width_tabula_quebra  = "0px";
   $this->width_tabula_display = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View || $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'])
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['mostra_edit'] = "N";
   }
   $this->NM_cont_body   = 0; 
   $this->NM_emb_tree_no = false; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ind_tree'] = 0;
   }
   elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['emb_tree_no']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['emb_tree_no'])
   { 
       $this->NM_emb_tree_no = true; 
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("v_dashboard_lop", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->nmgp_botoes['first'] = "on";
   $this->nmgp_botoes['back'] = "on";
   $this->nmgp_botoes['forward'] = "on";
   $this->nmgp_botoes['last'] = "on";
   $this->nmgp_botoes['pdf'] = "on";
   $this->nmgp_botoes['xls'] = "on";
   $this->nmgp_botoes['print'] = "on";
   $this->nmgp_botoes['goto'] = "on";
   $this->nmgp_botoes['qtline'] = "on";
   $this->nmgp_botoes['navpage'] = "on";
   $this->nmgp_botoes['summary'] = "on";
   $this->nmgp_botoes['groupby'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   $this->Cmps_ord_def['TP_WITEL'] = " asc";
   $this->Cmps_ord_def['KickoffMeeting'] = " asc";
   $this->Cmps_ord_def['Survey'] = " asc";
   $this->Cmps_ord_def['RAB_APD_KML'] = " asc";
   $this->Cmps_ord_def['NJKI_Justifikasi_NODIN'] = " asc";
   $this->Cmps_ord_def['Perijinan'] = " asc";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->sc_proc_grid = false; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['doc_word'])
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq_ant'];  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->tp_witel = $Busca_temp['tp_witel']; 
       $tmp_pos = strpos($this->tp_witel, "##@@");
       if ($tmp_pos !== false && !is_array($this->tp_witel))
       {
           $this->tp_witel = substr($this->tp_witel, 0, $tmp_pos);
       }
       $this->kickoffmeeting = $Busca_temp['kickoffmeeting']; 
       $tmp_pos = strpos($this->kickoffmeeting, "##@@");
       if ($tmp_pos !== false && !is_array($this->kickoffmeeting))
       {
           $this->kickoffmeeting = substr($this->kickoffmeeting, 0, $tmp_pos);
       }
       $this->survey = $Busca_temp['survey']; 
       $tmp_pos = strpos($this->survey, "##@@");
       if ($tmp_pos !== false && !is_array($this->survey))
       {
           $this->survey = substr($this->survey, 0, $tmp_pos);
       }
       $this->rab_apd_kml = $Busca_temp['rab_apd_kml']; 
       $tmp_pos = strpos($this->rab_apd_kml, "##@@");
       if ($tmp_pos !== false && !is_array($this->rab_apd_kml))
       {
           $this->rab_apd_kml = substr($this->rab_apd_kml, 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "muda_qt_linhas";
   } 

   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['maximized']) {
       $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['dashboard_app'];
       if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['v_dashboard_lop'])) {
           $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['v_dashboard_lop'];

           $this->nmgp_botoes['first']     = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['back']      = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['last']      = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['forward']   = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
           $this->nmgp_botoes['summary']   = $tmpDashboardButtons['grid_summary']   ? 'on' : 'off';
           $this->nmgp_botoes['qsearch']   = $tmpDashboardButtons['grid_qsearch']   ? 'on' : 'off';
           $this->nmgp_botoes['dynsearch'] = $tmpDashboardButtons['grid_dynsearch'] ? 'on' : 'off';
           $this->nmgp_botoes['filter']    = $tmpDashboardButtons['grid_filter']    ? 'on' : 'off';
           $this->nmgp_botoes['sel_col']   = $tmpDashboardButtons['grid_sel_col']   ? 'on' : 'off';
           $this->nmgp_botoes['sort_col']  = $tmpDashboardButtons['grid_sort_col']  ? 'on' : 'off';
           $this->nmgp_botoes['goto']      = $tmpDashboardButtons['grid_goto']      ? 'on' : 'off';
           $this->nmgp_botoes['qtline']    = $tmpDashboardButtons['grid_lineqty']   ? 'on' : 'off';
           $this->nmgp_botoes['navpage']   = $tmpDashboardButtons['grid_navpage']   ? 'on' : 'off';
           $this->nmgp_botoes['pdf']       = $tmpDashboardButtons['grid_pdf']       ? 'on' : 'off';
           $this->nmgp_botoes['xls']       = $tmpDashboardButtons['grid_xls']       ? 'on' : 'off';
           $this->nmgp_botoes['xml']       = $tmpDashboardButtons['grid_xml']       ? 'on' : 'off';
           $this->nmgp_botoes['csv']       = $tmpDashboardButtons['grid_csv']       ? 'on' : 'off';
           $this->nmgp_botoes['rtf']       = $tmpDashboardButtons['grid_rtf']       ? 'on' : 'off';
           $this->nmgp_botoes['word']      = $tmpDashboardButtons['grid_word']      ? 'on' : 'off';
           $this->nmgp_botoes['print']     = $tmpDashboardButtons['grid_print']     ? 'on' : 'off';
           $this->nmgp_botoes['new']       = $tmpDashboardButtons['grid_new']       ? 'on' : 'off';
       }
   }

   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "v_dashboard_lop/v_dashboard_lop_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "v_dashboard_lop_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_pdf'] != "pdf")  
       { 
           $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
       } 
       else 
       { 
           $_SESSION['scriptcase']['contr_link_emb'] = "pdf";
       } 
   } 
   else 
   { 
       $this->nm_location = $_SESSION['scriptcase']['contr_link_emb'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new v_dashboard_lop_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] = 10;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['rows'];  
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_select'] = array(); 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_quebra'] = array(); 
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "igual" ;  
       }
       else
       { 
           $Ordem_tem_quebra = false;
           foreach($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_quebra'] as $campo => $resto) 
           {
               foreach($resto as $sqldef => $ordem) 
               {
                   if ($sqldef == $nmgp_ordem) 
                   { 
                       $Ordem_tem_quebra = true;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "inicio" ;  
                       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_grid'] = ""; 
                       $ordem = ($ordem == "asc") ? "desc" : "asc";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_quebra'][$campo][$nmgp_ordem] = $ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_cmp'] = $nmgp_ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_label'] = trim($ordem);
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_grid'] = $nmgp_ordem  ; 
           }
       }
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao']       = "igual" ; 
   } 
// 
   $this->count_ger = 0;
   $this->sum_kickoffmeeting = 0;
   $this->sum_survey = 0;
   $this->sum_rab_apd_kml = 0;
   $this->sum_njki_justifikasi_nodin = 0;
   $this->sum_perijinan = 0;
   $this->sum_deliverymaterial = 0;
   $this->sum_bctr = 0;
   $this->sum_gelarhdpetanamtiang = 0;
   $this->sum_gelarkabel = 0;
   $this->sum_pasangterminalterminasijumperodf = 0;
   $this->sum_pasangterminalterminasjumperodc = 0;
   $this->sum_pasangterminalodp = 0;
   $this->sum_terminasiodp = 0;
   $this->sum_testcomm = 0;
   $this->sum_ujiterima = 0;
   $this->sum_bautrekon = 0;
   $this->sum_amandemenbast = 0;
   $this->sum_grir = 0;
   $this->sum_newentry = 0;
   $this->sum_inprogress = 0;
   $this->sum_others = 0;
   $this->sum_complete = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "final" || $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid'] == "all") 
   { 
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][1] ;  
       $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][1];
   } 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_total']);
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][1];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] = 0 ; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] > 0) 
   { 
       $this->nmgp_reg_start--; 
   } 
   $this->nm_grid_ini = $this->nmgp_reg_start + 1; 
   if ($this->nmgp_reg_start != 0) 
   { 
       $this->nm_grid_ini++;
   }  
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT TP_WITEL, KickoffMeeting, Survey, RAB_APD_KML, NJKI_Justifikasi_NODIN, Perijinan, DeliveryMaterial, BCTR, GelarHDPETanamTiang, GelarKabel, PasangTerminalTerminasiJumperODF, PasangTerminalTerminasJumperODC, PasangTerminalODP, TerminasiODP, TestComm, UjiTerima, BAUTRekon, AmandemenBAST, GRIR, NewEntry, Inprogress, Others, Complete from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_desc']; 
   } 
   elseif (!empty($campos_order_select)) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $campos_order_select; 
   } 
   elseif (!empty($campos_order)) 
   { 
       $nmgp_order_by = " order by " . $campos_order; 
   } 
   if (substr(trim($nmgp_order_by), -1) == ",")
   {
       $nmgp_order_by = " " . substr(trim($nmgp_order_by), 0, -1);
   }
   if (trim($nmgp_order_by) == "order by")
   {
       $nmgp_order_by = "";
   }
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
   }  
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->force_toolbar = true;
       $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
   }  
   else 
   { 
       $this->tp_witel = $this->rs_grid->fields[0] ;  
       $this->tp_witel = (string)$this->tp_witel;
       $this->kickoffmeeting = $this->rs_grid->fields[1] ;  
       $this->kickoffmeeting = (string)$this->kickoffmeeting;
       $this->survey = $this->rs_grid->fields[2] ;  
       $this->survey = (string)$this->survey;
       $this->rab_apd_kml = $this->rs_grid->fields[3] ;  
       $this->rab_apd_kml = (string)$this->rab_apd_kml;
       $this->njki_justifikasi_nodin = $this->rs_grid->fields[4] ;  
       $this->njki_justifikasi_nodin = (string)$this->njki_justifikasi_nodin;
       $this->perijinan = $this->rs_grid->fields[5] ;  
       $this->perijinan = (string)$this->perijinan;
       $this->deliverymaterial = $this->rs_grid->fields[6] ;  
       $this->deliverymaterial = (string)$this->deliverymaterial;
       $this->bctr = $this->rs_grid->fields[7] ;  
       $this->bctr = (string)$this->bctr;
       $this->gelarhdpetanamtiang = $this->rs_grid->fields[8] ;  
       $this->gelarhdpetanamtiang = (string)$this->gelarhdpetanamtiang;
       $this->gelarkabel = $this->rs_grid->fields[9] ;  
       $this->gelarkabel = (string)$this->gelarkabel;
       $this->pasangterminalterminasijumperodf = $this->rs_grid->fields[10] ;  
       $this->pasangterminalterminasijumperodf = (string)$this->pasangterminalterminasijumperodf;
       $this->pasangterminalterminasjumperodc = $this->rs_grid->fields[11] ;  
       $this->pasangterminalterminasjumperodc = (string)$this->pasangterminalterminasjumperodc;
       $this->pasangterminalodp = $this->rs_grid->fields[12] ;  
       $this->pasangterminalodp = (string)$this->pasangterminalodp;
       $this->terminasiodp = $this->rs_grid->fields[13] ;  
       $this->terminasiodp = (string)$this->terminasiodp;
       $this->testcomm = $this->rs_grid->fields[14] ;  
       $this->testcomm = (string)$this->testcomm;
       $this->ujiterima = $this->rs_grid->fields[15] ;  
       $this->ujiterima = (string)$this->ujiterima;
       $this->bautrekon = $this->rs_grid->fields[16] ;  
       $this->bautrekon = (string)$this->bautrekon;
       $this->amandemenbast = $this->rs_grid->fields[17] ;  
       $this->amandemenbast = (string)$this->amandemenbast;
       $this->grir = $this->rs_grid->fields[18] ;  
       $this->grir = (string)$this->grir;
       $this->newentry = $this->rs_grid->fields[19] ;  
       $this->newentry =  str_replace(",", ".", $this->newentry);
       $this->newentry = (string)$this->newentry;
       $this->inprogress = $this->rs_grid->fields[20] ;  
       $this->inprogress =  str_replace(",", ".", $this->inprogress);
       $this->inprogress = (string)$this->inprogress;
       $this->others = $this->rs_grid->fields[21] ;  
       $this->others =  str_replace(",", ".", $this->others);
       $this->others = (string)$this->others;
       $this->complete = $this->rs_grid->fields[22] ;  
       $this->complete =  str_replace(",", ".", $this->complete);
       $this->complete = (string)$this->complete;
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $this->SC_sep_quebra = false;
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->tp_witel = $this->rs_grid->fields[0] ;  
           $this->kickoffmeeting = $this->rs_grid->fields[1] ;  
           $this->survey = $this->rs_grid->fields[2] ;  
           $this->rab_apd_kml = $this->rs_grid->fields[3] ;  
           $this->njki_justifikasi_nodin = $this->rs_grid->fields[4] ;  
           $this->perijinan = $this->rs_grid->fields[5] ;  
           $this->deliverymaterial = $this->rs_grid->fields[6] ;  
           $this->bctr = $this->rs_grid->fields[7] ;  
           $this->gelarhdpetanamtiang = $this->rs_grid->fields[8] ;  
           $this->gelarkabel = $this->rs_grid->fields[9] ;  
           $this->pasangterminalterminasijumperodf = $this->rs_grid->fields[10] ;  
           $this->pasangterminalterminasjumperodc = $this->rs_grid->fields[11] ;  
           $this->pasangterminalodp = $this->rs_grid->fields[12] ;  
           $this->terminasiodp = $this->rs_grid->fields[13] ;  
           $this->testcomm = $this->rs_grid->fields[14] ;  
           $this->ujiterima = $this->rs_grid->fields[15] ;  
           $this->bautrekon = $this->rs_grid->fields[16] ;  
           $this->amandemenbast = $this->rs_grid->fields[17] ;  
           $this->grir = $this->rs_grid->fields[18] ;  
           $this->newentry = $this->rs_grid->fields[19] ;  
           $this->inprogress = $this->rs_grid->fields[20] ;  
           $this->others = $this->rs_grid->fields[21] ;  
           $this->complete = $this->rs_grid->fields[22] ;  
       } 
   } 
   $this->nmgp_reg_inicial = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final'] + 1;
   $this->nmgp_reg_final   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid'];
   $this->nmgp_reg_final   = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Resume LOP Divre :: PDF</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
           if ($_SESSION['scriptcase']['proc_mobile'])
           {
?>
              <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
           }
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
 <META http-equiv="Pragma" content="no-cache">
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
 <SCRIPT LANGUAGE="Javascript" SRC="<?php echo $this->Ini->path_js; ?>/nm_gauge.js"></SCRIPT>
</HEAD>
<BODY scrolling="no">
<table class="scGridTabela" style="padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;"><tr class="scGridFieldOddVert"><td>
<?php echo $this->Ini->Nm_lang['lang_pdff_gnrt']; ?>...<br>
<?php
           $this->progress_grid    = $this->rs_grid->RecordCount();
           $this->progress_pdf     = 0;
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['pivot_charts']) : 0;
           $this->progress_graf    = 0;
           $this->progress_tot     = 0;
           $this->progress_now     = 0;
           $this->progress_lim_tot = 0;
           $this->progress_lim_now = 0;
           if (-1 < $this->progress_grid)
           {
               $this->progress_lim_qtd = (250 < $this->progress_grid) ? 250 : $this->progress_grid;
               $this->progress_lim_tot = floor($this->progress_grid / $this->progress_lim_qtd);
               $this->progress_pdf     = floor($this->progress_grid * 0.25) + 1;
               $this->progress_tot     = $this->progress_grid + $this->progress_pdf + $this->progress_res + $this->progress_graf;
               $str_pbfile             = isset($_GET['pbfile']) ? urldecode($_GET['pbfile']) : $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
               $this->progress_fp      = fopen($str_pbfile, 'w');
               fwrite($this->progress_fp, "PDF\n");
               fwrite($this->progress_fp, $this->Ini->path_js   . "\n");
               fwrite($this->progress_fp, $this->Ini->path_prod . "/img/\n");
               fwrite($this->progress_fp, $this->progress_tot   . "\n");
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_strt'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               fwrite($this->progress_fp, "1_#NM#_" . $lang_protect . "...\n");
               flush();
           }
       }
       $nm_fundo_pagina = ""; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
       $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>Resume LOP Divre</TITLE>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
           $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\" />\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
       { 
           $nm_saida->saida("   <form name=\"form_ajax_redir_1\" method=\"post\" style=\"display: none\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_outra_jan\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . session_id() . "\">\r\n");
           $nm_saida->saida("   </form>\r\n");
           $nm_saida->saida("   <form name=\"form_ajax_redir_2\" method=\"post\" style=\"display: none\"> \r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_url_saida\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . session_id() . "\">\r\n");
           $nm_saida->saida("   </form>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"v_dashboard_lop_jquery.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"v_dashboard_lop_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery-ui.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';</script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <style type=\"text/css\"> \r\n");
           $nm_saida->saida("     .scGridLabelFont a img[src\$='" . $this->Ini->Label_sort_desc . "'], \r\n");
           $nm_saida->saida("     .scGridLabelFont a img[src\$='" . $this->Ini->Label_sort_asc . "'], \r\n");
           $nm_saida->saida("     .scGridLabelFont a img[src\$='" . $this->arr_buttons['bgraf']['image'] . "'], \r\n");
           $nm_saida->saida("     .scGridLabelFont a img[src\$='" . $this->arr_buttons['bconf_graf']['image'] . "']{opacity:1!important;} \r\n");
           $nm_saida->saida("     .scGridLabelFont a img{opacity:0;transition:all .2s;} \r\n");
           $nm_saida->saida("     .scGridLabelFont:HOVER a img{opacity:1;transition:all .2s;} \r\n");
           $nm_saida->saida("   </style> \r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           $nm_saida->saida("   var SC_Link_View = false;\r\n");
           if ($this->Ini->SC_Link_View)
           {
               $nm_saida->saida("   SC_Link_View = true;\r\n");
           }
           $nm_saida->saida("   var scQSInit = true;\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($this->count_ger) . ";\r\n");
           }
           else
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid']) . ";\r\n");
           }
           $gridWidthCorrection = '';
           if (false !== strpos($this->Ini->grid_table_width, 'calc')) {
               $gridWidthCalc = substr($this->Ini->grid_table_width, strpos($this->Ini->grid_table_width, '(') + 1);
               $gridWidthCalc = substr($gridWidthCalc, 0, strpos($gridWidthCalc, ')'));
               $gridWidthParts = explode(' ', $gridWidthCalc);
               if (3 == count($gridWidthParts) && 'px' == substr($gridWidthParts[2], -2)) {
                   $gridWidthParts[2] = substr($gridWidthParts[2], 0, -2) / 2;
                   $gridWidthCorrection = $gridWidthParts[1] . ' ' . $gridWidthParts[2];
               }
           }
           $nm_saida->saida("  function scSetFixedHeaders() {\r\n");
           $nm_saida->saida("   var divScroll, gridHeaders, headerPlaceholder;\r\n");
           $nm_saida->saida("   gridHeaders = $(\".sc-ui-grid-header-row-v_dashboard_lop-1\");\r\n");
           $nm_saida->saida("   headerPlaceholder = $(\"#sc-id-fixedheaders-placeholder\");\r\n");
           $nm_saida->saida("   scSetFixedHeadersContents(gridHeaders, headerPlaceholder);\r\n");
           $nm_saida->saida("   scSetFixedHeadersSize(gridHeaders);\r\n");
           $nm_saida->saida("   scSetFixedHeadersPosition(gridHeaders, headerPlaceholder);\r\n");
           $nm_saida->saida("   if (scIsHeaderVisible(gridHeaders)) {\r\n");
           $nm_saida->saida("    headerPlaceholder.hide();\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   else {\r\n");
           $nm_saida->saida("    headerPlaceholder.show();\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scSetFixedHeadersPosition(gridHeaders, headerPlaceholder) {\r\n");
           $nm_saida->saida("   headerPlaceholder.css({\"top\": 0" . $gridWidthCorrection . ", \"left\": (Math.floor(gridHeaders.position().left) - $(document).scrollLeft()" . $gridWidthCorrection . ") + \"px\"});\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scIsHeaderVisible(gridHeaders) {\r\n");
           $nm_saida->saida("   return gridHeaders.offset().top > $(document).scrollTop();\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scSetFixedHeadersContents(gridHeaders, headerPlaceholder) {\r\n");
           $nm_saida->saida("   var i, htmlContent;\r\n");
           $nm_saida->saida("   htmlContent = \"<table id=\\\"sc-id-fixed-headers\\\" class=\\\"scGridTabela\\\">\";\r\n");
           $nm_saida->saida("   for (i = 0; i < gridHeaders.length; i++) {\r\n");
           $nm_saida->saida("    htmlContent += \"<tr class=\\\"scGridLabel\\\" id=\\\"sc-id-fixed-headers-row-\" + i + \"\\\">\" + $(gridHeaders[i]).html() + \"</tr>\";\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   htmlContent += \"</table>\";\r\n");
           $nm_saida->saida("   headerPlaceholder.html(htmlContent);\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function scSetFixedHeadersSize(gridHeaders) {\r\n");
           $nm_saida->saida("   var i, j, headerColumns, gridColumns, cellHeight, cellWidth, tableOriginal, tableHeaders;\r\n");
           $nm_saida->saida("   tableOriginal = $(\"#sc-ui-grid-body-164d0390\");\r\n");
           $nm_saida->saida("   tableHeaders = document.getElementById(\"sc-id-fixed-headers\");\r\n");
           $nm_saida->saida("   $(tableHeaders).css(\"width\", $(tableOriginal).outerWidth());\r\n");
           $nm_saida->saida("   for (i = 0; i < gridHeaders.length; i++) {\r\n");
           $nm_saida->saida("    headerColumns = $(\"#sc-id-fixed-headers-row-\" + i).find(\"td\");\r\n");
           $nm_saida->saida("    gridColumns = $(gridHeaders[i]).find(\"td\");\r\n");
           $nm_saida->saida("    for (j = 0; j < gridColumns.length; j++) {\r\n");
           $nm_saida->saida("     if (window.getComputedStyle(gridColumns[j])) {\r\n");
           $nm_saida->saida("      cellWidth = window.getComputedStyle(gridColumns[j]).width;\r\n");
           $nm_saida->saida("      cellHeight = window.getComputedStyle(gridColumns[j]).height;\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     else {\r\n");
           $nm_saida->saida("      cellWidth = $(gridColumns[j]).width() + \"px\";\r\n");
           $nm_saida->saida("      cellHeight = $(gridColumns[j]).height() + \"px\";\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $(headerColumns[j]).css({\r\n");
           $nm_saida->saida("      \"width\": cellWidth,\r\n");
           $nm_saida->saida("      \"height\": cellHeight\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("    }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  function SC_init_jquery(isScrollNav){ \r\n");
           $nm_saida->saida("   \$(function(){ \r\n");
           $nm_saida->saida("     $('#id_F0_top').keyup(function(e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("          return false; \r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#id_F0_bot').keyup(function(e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("          return false; \r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }); \r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  SC_init_jquery(false);\r\n");
           $nm_saida->saida("   \$(window).on('load', function() {\r\n");
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               $nm_saida->saida("       $('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ancor_save'] . "').addClass('" . $this->css_scGridFieldOver . "');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ancor_save']);
           }
           $nm_saida->saida("   });\r\n");
           $nm_saida->saida("   function scBtnGroupByShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGroupByHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_groupby_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSaveGridShow(origem, embbed, pos) {\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"POST\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: \"v_dashboard_lop_save_grid.php\",\r\n");
           $nm_saida->saida("       data: \"path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_grid_sv=" . $this->Ini->path_grid_sv . "&script_case_init=" . $this->Ini->sc_page . "&script_case_session=" . session_id() . "&script_origem=\" + origem + \"&embbed_groupby=\" + embbed + \"&toolbar_pos=\" + pos\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + pos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + pos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + pos).show();\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSaveGridHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_save_grid_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_save_grid_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSelCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSelCamposHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_sel_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnOrderCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnOrderCamposHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_order_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   </script> \r\n");
       } 
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && !$this->Print_All && $this->NM_opcao != "print" && $this->NM_opcao != "pdf")
       {
           $write_css = false;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_v_dashboard_lop_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
       {
           $this->NM_field_over  = 0;
           $this->NM_field_click = 0;
           $Css_sub_cons = array();
           if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
           { 
               $NM_css_file = $this->Ini->str_schema_all . "_grid_bw.css";
               $NM_css_dir  = $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw'])) 
               { 
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw'] as $Apl => $Css_apl)
                   {
                       $Css_sub_cons[] = $Css_apl;
                       $Css_sub_cons[] = str_replace(".css", $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css", $Css_apl);
                   }
               } 
           } 
           else 
           { 
               $NM_css_file = $this->Ini->str_schema_all . "_grid.css";
               $NM_css_dir  = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css'])) 
               { 
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css'] as $Apl => $Css_apl)
                   {
                       $Css_sub_cons[] = $Css_apl;
                       $Css_sub_cons[] = str_replace(".css", $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css", $Css_apl);
                   }
               } 
           } 
           if (is_file($this->Ini->path_css . $NM_css_file))
           {
               $NM_css_attr = file($this->Ini->path_css . $NM_css_file);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   if (substr(trim($NM_line_css), 0, 12) == ".scGridTotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
                   if (substr(trim($NM_line_css), 0, 15) == ".scGridSubtotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_sub_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
                   if (substr(trim($NM_line_css), 0, 16) == ".scGridFieldOver" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_over = 1;
                   }
                   if (substr(trim($NM_line_css), 0, 17) == ".scGridFieldClick" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_click = 1;
                   }
                   $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                   if ($write_css) {@fwrite($NM_css, "    " .  $NM_line_css . "\r\n");}
               }
           }
           if (is_file($this->Ini->path_css . $NM_css_dir))
           {
               $NM_css_attr = file($this->Ini->path_css . $NM_css_dir);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   if (substr(trim($NM_line_css), 0, 12) == ".scGridTotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
                   if (substr(trim($NM_line_css), 0, 15) == ".scGridSubtotal")
                   {
                       $tmp_pos = strpos($NM_line_css, "background-color:");
                       if ($tmp_pos !== false)
                       {
                           $tmp_pos += 17;
                           $tmp_pos1 = strpos($NM_line_css, ";", $tmp_pos);
                           if ($tmp_pos1 === false)
                           {
                               $tmp_pos1 = strpos($NM_line_css, "}", $tmp_pos);
                           }
                           $this->NM_bg_sub_tot = trim(substr($NM_line_css, $tmp_pos, ($tmp_pos1 - $tmp_pos)));
                       }
                   }
                   if (substr(trim($NM_line_css), 0, 16) == ".scGridFieldOver" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_over = 1;
                   }
                   if (substr(trim($NM_line_css), 0, 17) == ".scGridFieldClick" && strpos($NM_line_css, "background-color:") !== false)
                   {
                       $this->NM_field_click = 1;
                   }
                   $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                   if ($write_css) {@fwrite($NM_css, "    " .  $NM_line_css . "\r\n");}
               }
           }
           if (!empty($Css_sub_cons))
           {
               $Css_sub_cons = array_unique($Css_sub_cons);
               foreach ($Css_sub_cons as $Cada_css_sub)
               {
                   if (is_file($this->Ini->path_css . $Cada_css_sub))
                   {
                       $compl_css = str_replace(".", "_", $Cada_css_sub);
                       $temp_css  = explode("/", $compl_css);
                       if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
                       $NM_css_attr = file($this->Ini->path_css . $Cada_css_sub);
                       foreach ($NM_css_attr as $NM_line_css)
                       {
                           $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
                           if ($write_css) {@fwrite($NM_css, "    ." .  $compl_css . "_" . substr(trim($NM_line_css), 1) . "\r\n");}
                       }
                   }
               }
           }
       }
       if ($write_css) {@fclose($NM_css);}
           $this->NM_css_val_embed .= "win";
           $this->NM_css_ajx_embed .= "ult_set";
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       elseif ($this->NM_opcao == "print" || $this->Print_All)
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_v_dashboard_lop_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['num_css'] . '.css');
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("  </style>\r\n");
       }
       else
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_v_dashboard_lop_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_pdf'] != "pdf")
       {
           $nm_saida->saida("  .css_iframes   { margin-bottom: 0px; margin-left: 0px;  margin-right: 0px;  margin-top: 0px; }\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
       { 
           $nm_saida->saida("       .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;color:black;}\r\n");
       } 
       $nm_saida->saida("  </style>\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "v_dashboard_lop/v_dashboard_lop_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "v_dashboard_lop/v_dashboard_lop_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
           $nm_saida->saida("  </style>\r\n");
       }
       $nm_saida->saida("  </HEAD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "v_dashboard_lop/v_dashboard_lop_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $cada_css = ".v_dashboard_lop_" . substr($cada_css, 1);
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['doc_word'] && ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] == "print")) 
       {
           if ($this->Print_All) 
           {
               $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           }
           $nm_saida->saida("  <body class=\"" . $this->css_scGridPage . "\" " . $str_iframe_body . " style=\"-webkit-print-color-adjust: exact;" . $css_body . "\">\r\n");
           $nm_saida->saida("   <TABLE id=\"sc_table_print\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" " . $this->Tab_width . ">\r\n");
           $nm_saida->saida("     <TR>\r\n");
           $nm_saida->saida("       <TD>\r\n");
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "prit_web_page()", "prit_web_page()", "Bprint_print", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
           $nm_saida->saida("           $Cod_Btn \r\n");
           $nm_saida->saida("       </TD>\r\n");
           $nm_saida->saida("     </TR>\r\n");
           $nm_saida->saida("   </TABLE>\r\n");
           $nm_saida->saida("  <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     function prit_web_page()\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("        document.getElementById('sc_table_print').style.display = 'none';\r\n");
           $nm_saida->saida("        var is_safari = navigator.userAgent.indexOf(\"Safari\") > -1;\r\n");
           $nm_saida->saida("        var is_chrome = navigator.userAgent.indexOf('Chrome') > -1\r\n");
           $nm_saida->saida("        if ((is_chrome) && (is_safari)) {is_safari=false;}\r\n");
           $nm_saida->saida("        window.print();\r\n");
           $nm_saida->saida("        if (is_safari) {setTimeout(\"window.close()\", 1000);} else {window.close();}\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("  </script>\r\n");
       }
       else
       {
           $nm_saida->saida("  <body class=\"" . $this->css_scGridPage . "\" " . $str_iframe_body . " style=\"" . $css_body . "\">\r\n");
       }
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && !$this->Print_All)
       { 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none; position: absolute; left: 50px; top: 50px\"><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
       } 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf" && !$this->Print_All)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_Ind_Groupby'] == "sc_free_total")
           {
           $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['doc_word'])
       { 
           $nm_saida->saida("      <div id=\"tooltip\" style=\"position:absolute;visibility:hidden;border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;padding:1px;color:black;\"></div>\r\n");
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = "";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"" . $this->css_scGridLabel . "\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print") 
       { 
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD  colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_A_v_dashboard_lop\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_A_v_dashboard_lop\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_E_v_dashboard_lop\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_E_v_dashboard_lop\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <td style=\"padding: 0px;  vertical-align: top;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\"><tr>\r\n");
           $nm_saida->saida("    <TD colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_AL_v_dashboard_lop\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_AL_v_dashboard_lop\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
        } 
   }  
 }  
 function NM_cor_embutida()
 {  
   $compl_css = "";
   include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   {
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['v_dashboard_lop']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['v_dashboard_lop']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['v_dashboard_lop']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['v_dashboard_lop']) . "_";
           } 
       }
   }
   $temp_css  = explode("/", $compl_css);
   if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
   $this->css_scGridPage           = $compl_css . "scGridPage";
   $this->css_scGridPageLink       = $compl_css . "scGridPageLink";
   $this->css_scGridToolbar        = $compl_css . "scGridToolbar";
   $this->css_scGridToolbarPadd    = $compl_css . "scGridToolbarPadding";
   $this->css_css_toolbar_obj      = $compl_css . "css_toolbar_obj";
   $this->css_scGridHeader         = $compl_css . "scGridHeader";
   $this->css_scGridHeaderFont     = $compl_css . "scGridHeaderFont";
   $this->css_scGridFooter         = $compl_css . "scGridFooter";
   $this->css_scGridFooterFont     = $compl_css . "scGridFooterFont";
   $this->css_scGridBlock          = $compl_css . "scGridBlock";
   $this->css_scGridBlockFont      = $compl_css . "scGridBlockFont";
   $this->css_scGridBlockAlign     = $compl_css . "scGridBlockAlign";
   $this->css_scGridTotal          = $compl_css . "scGridTotal";
   $this->css_scGridTotalFont      = $compl_css . "scGridTotalFont";
   $this->css_scGridSubtotal       = $compl_css . "scGridSubtotal";
   $this->css_scGridSubtotalFont   = $compl_css . "scGridSubtotalFont";
   $this->css_scGridFieldEven      = $compl_css . "scGridFieldEven";
   $this->css_scGridFieldEvenFont  = $compl_css . "scGridFieldEvenFont";
   $this->css_scGridFieldEvenVert  = $compl_css . "scGridFieldEvenVert";
   $this->css_scGridFieldEvenLink  = $compl_css . "scGridFieldEvenLink";
   $this->css_scGridFieldOdd       = $compl_css . "scGridFieldOdd";
   $this->css_scGridFieldOddFont   = $compl_css . "scGridFieldOddFont";
   $this->css_scGridFieldOddVert   = $compl_css . "scGridFieldOddVert";
   $this->css_scGridFieldOddLink   = $compl_css . "scGridFieldOddLink";
   $this->css_scGridFieldClick     = $compl_css . "scGridFieldClick";
   $this->css_scGridFieldOver      = $compl_css . "scGridFieldOver";
   $this->css_scGridLabel          = $compl_css . "scGridLabel";
   $this->css_scGridLabelVert      = $compl_css . "scGridLabelVert";
   $this->css_scGridLabelFont      = $compl_css . "scGridLabelFont";
   $this->css_scGridLabelLink      = $compl_css . "scGridLabelLink";
   $this->css_scGridTabela         = $compl_css . "scGridTabela";
   $this->css_scGridTabelaTd       = $compl_css . "scGridTabelaTd";
   $this->css_scGridBlockBg        = $compl_css . "scGridBlockBg";
   $this->css_scGridBlockLineBg    = $compl_css . "scGridBlockLineBg";
   $this->css_scGridBlockSpaceBg   = $compl_css . "scGridBlockSpaceBg";
   $this->css_scGridLabelNowrap    = "";
   $this->css_scAppDivMoldura      = $compl_css . "scAppDivMoldura";
   $this->css_scAppDivHeader       = $compl_css . "scAppDivHeader";
   $this->css_scAppDivHeaderText   = $compl_css . "scAppDivHeaderText";
   $this->css_scAppDivContent      = $compl_css . "scAppDivContent";
   $this->css_scAppDivContentText  = $compl_css . "scAppDivContentText";
   $this->css_scAppDivToolbar      = $compl_css . "scAppDivToolbar";
   $this->css_scAppDivToolbarInput = $compl_css . "scAppDivToolbarInput";

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida']) ? "v_dashboard_lop_" : "";
   $this->css_sep = " ";
   $this->css_tp_witel_label = $compl_css_emb . "css_tp_witel_label";
   $this->css_tp_witel_grid_line = $compl_css_emb . "css_tp_witel_grid_line";
   $this->css_kickoffmeeting_label = $compl_css_emb . "css_kickoffmeeting_label";
   $this->css_kickoffmeeting_grid_line = $compl_css_emb . "css_kickoffmeeting_grid_line";
   $this->css_survey_label = $compl_css_emb . "css_survey_label";
   $this->css_survey_grid_line = $compl_css_emb . "css_survey_grid_line";
   $this->css_rab_apd_kml_label = $compl_css_emb . "css_rab_apd_kml_label";
   $this->css_rab_apd_kml_grid_line = $compl_css_emb . "css_rab_apd_kml_grid_line";
   $this->css_njki_justifikasi_nodin_label = $compl_css_emb . "css_njki_justifikasi_nodin_label";
   $this->css_njki_justifikasi_nodin_grid_line = $compl_css_emb . "css_njki_justifikasi_nodin_grid_line";
   $this->css_perijinan_label = $compl_css_emb . "css_perijinan_label";
   $this->css_perijinan_grid_line = $compl_css_emb . "css_perijinan_grid_line";
   $this->css_deliverymaterial_label = $compl_css_emb . "css_deliverymaterial_label";
   $this->css_deliverymaterial_grid_line = $compl_css_emb . "css_deliverymaterial_grid_line";
   $this->css_bctr_label = $compl_css_emb . "css_bctr_label";
   $this->css_bctr_grid_line = $compl_css_emb . "css_bctr_grid_line";
   $this->css_gelarhdpetanamtiang_label = $compl_css_emb . "css_gelarhdpetanamtiang_label";
   $this->css_gelarhdpetanamtiang_grid_line = $compl_css_emb . "css_gelarhdpetanamtiang_grid_line";
   $this->css_gelarkabel_label = $compl_css_emb . "css_gelarkabel_label";
   $this->css_gelarkabel_grid_line = $compl_css_emb . "css_gelarkabel_grid_line";
   $this->css_pasangterminalterminasijumperodf_label = $compl_css_emb . "css_pasangterminalterminasijumperodf_label";
   $this->css_pasangterminalterminasijumperodf_grid_line = $compl_css_emb . "css_pasangterminalterminasijumperodf_grid_line";
   $this->css_pasangterminalterminasjumperodc_label = $compl_css_emb . "css_pasangterminalterminasjumperodc_label";
   $this->css_pasangterminalterminasjumperodc_grid_line = $compl_css_emb . "css_pasangterminalterminasjumperodc_grid_line";
   $this->css_pasangterminalodp_label = $compl_css_emb . "css_pasangterminalodp_label";
   $this->css_pasangterminalodp_grid_line = $compl_css_emb . "css_pasangterminalodp_grid_line";
   $this->css_terminasiodp_label = $compl_css_emb . "css_terminasiodp_label";
   $this->css_terminasiodp_grid_line = $compl_css_emb . "css_terminasiodp_grid_line";
   $this->css_testcomm_label = $compl_css_emb . "css_testcomm_label";
   $this->css_testcomm_grid_line = $compl_css_emb . "css_testcomm_grid_line";
   $this->css_ujiterima_label = $compl_css_emb . "css_ujiterima_label";
   $this->css_ujiterima_grid_line = $compl_css_emb . "css_ujiterima_grid_line";
   $this->css_bautrekon_label = $compl_css_emb . "css_bautrekon_label";
   $this->css_bautrekon_grid_line = $compl_css_emb . "css_bautrekon_grid_line";
   $this->css_amandemenbast_label = $compl_css_emb . "css_amandemenbast_label";
   $this->css_amandemenbast_grid_line = $compl_css_emb . "css_amandemenbast_grid_line";
   $this->css_grir_label = $compl_css_emb . "css_grir_label";
   $this->css_grir_grid_line = $compl_css_emb . "css_grir_grid_line";
   $this->css_newentry_label = $compl_css_emb . "css_newentry_label";
   $this->css_newentry_grid_line = $compl_css_emb . "css_newentry_grid_line";
   $this->css_inprogress_label = $compl_css_emb . "css_inprogress_label";
   $this->css_inprogress_grid_line = $compl_css_emb . "css_inprogress_grid_line";
   $this->css_others_label = $compl_css_emb . "css_others_label";
   $this->css_others_grid_line = $compl_css_emb . "css_others_grid_line";
   $this->css_complete_label = $compl_css_emb . "css_complete_label";
   $this->css_complete_grid_line = $compl_css_emb . "css_complete_grid_line";
 }  
// 
//----- 
 function cabecalho()
 {
   global
          $nm_saida;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['cab']))
   {
       return; 
   }
   $nm_cab_filtro   = ""; 
   $nm_cab_filtrobr = ""; 
   $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
   $Lim   = strlen($Str_date);
   $Ult   = "";
   $Arr_D = array();
   for ($I = 0; $I < $Lim; $I++)
   {
       $Char = substr($Str_date, $I, 1);
       if ($Char != $Ult)
       {
           $Arr_D[] = $Char;
       }
       $Ult = $Char;
   }
   $Prim = true;
   $Str  = "";
   foreach ($Arr_D as $Cada_d)
   {
       $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
       $Str .= $Cada_d;
       $Prim = false;
   }
   $Str = str_replace("a", "Y", $Str);
   $Str = str_replace("y", "Y", $Str);
   $nm_data_fixa = date($Str); 
   $this->sc_proc_grid = false; 
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq'];
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq'], 0, $trab_pos);
       $nm_cab_filtrobr = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and . "<br />", $nm_cab_filtro);
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $nm_cab_filtro;
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       if ($trab_pos === false)
       {
       }
       else  
       {  
          $nm_cab_filtro = substr($nm_cab_filtro, 0, $trab_pos) . " " .  $nm_cond_filtro_or . $nm_cond_filtro_and . substr($nm_cab_filtro, $trab_pos + 5);
          $nm_cab_filtro = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and, $nm_cab_filtro);
       }   
   }   
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS"); 
   $nm_saida->saida(" <TR id=\"sc_grid_head\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf")
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\" colspan=3 style=\"vertical-align: top\">\r\n");
   } 
   else 
   { 
       $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
   } 
   $nm_saida->saida("   <TABLE width=\"100%\" class=\"" . $this->css_scGridHeader . "\">\r\n");
   $nm_saida->saida("    <TR align=\"center\">\r\n");
   $nm_saida->saida("     <TD style=\"padding: 0px\">\r\n");
   $nm_saida->saida("      <TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\">\r\n");
   $nm_saida->saida("       <TR align=\"center\" valign=\"middle\">\r\n");
   $nm_saida->saida("        <TD align=\"left\" rowspan=\"2\" class=\"" . $this->css_scGridHeaderFont . "\">\r\n");
   $nm_saida->saida("          \r\n");
   $nm_saida->saida("        </TD>\r\n");
   $nm_saida->saida("        <TD class=\"" . $this->css_scGridHeaderFont . "\">\r\n");
   $nm_saida->saida("          Resume LOP Divre\r\n");
   $nm_saida->saida("        </TD>\r\n");
   $nm_saida->saida("       </TR>\r\n");
   $nm_saida->saida("       <TR align=\"right\" valign=\"middle\">\r\n");
   $nm_saida->saida("        <TD class=\"" . $this->css_scGridHeaderFont . "\">\r\n");
   $nm_saida->saida("          \r\n");
   $nm_saida->saida("        </TD>\r\n");
   $nm_saida->saida("       </TR>\r\n");
   $nm_saida->saida("      </TABLE>\r\n");
   $nm_saida->saida("     </TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   $nm_saida->saida(" </TR>\r\n");
 }
// 
//----- 
 function rodape()
 {
   global
          $nm_saida;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['maximized'])
   {
       return; 
   }
   $nm_cab_filtro   = ""; 
   $nm_cab_filtrobr = ""; 
   $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
   $Lim   = strlen($Str_date);
   $Ult   = "";
   $Arr_D = array();
   for ($I = 0; $I < $Lim; $I++)
   {
       $Char = substr($Str_date, $I, 1);
       if ($Char != $Ult)
       {
           $Arr_D[] = $Char;
       }
       $Ult = $Char;
   }
   $Prim = true;
   $Str  = "";
   foreach ($Arr_D as $Cada_d)
   {
       $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
       $Str .= $Cada_d;
       $Prim = false;
   }
   $Str = str_replace("a", "Y", $Str);
   $Str = str_replace("y", "Y", $Str);
   $nm_data_fixa = date($Str); 
   $this->sc_proc_grid = false; 
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq'];
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cond_pesq'], 0, $trab_pos);
       $nm_cab_filtrobr = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and . "<br />", $nm_cab_filtro);
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $nm_cab_filtro;
       while ($pos_tmp)
       {
          $pos = strpos($tmp, "##*@@", $pos);
          if ($pos !== false)
          {
              $trab_pos = $pos;
              $pos += 4;
          }
          else
          {
              $pos_tmp = false;
          }
       }
       if ($trab_pos === false)
       {
       }
       else  
       {  
          $nm_cab_filtro = substr($nm_cab_filtro, 0, $trab_pos) . " " .  $nm_cond_filtro_or . $nm_cond_filtro_and . substr($nm_cab_filtro, $trab_pos + 5);
          $nm_cab_filtro = str_replace("##*@@", ", " . $nm_cond_filtro_or . $nm_cond_filtro_and, $nm_cab_filtro);
       }   
   }   
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS"); 
   $nm_saida->saida(" <TR id=\"sc_grid_foot\">\r\n");
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
   $sc_data_cab1 = $this->nm_data->FormataSaida("j/n/Y @?#?@a@?#?@t g:i:s A");
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sv_dt_foot']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sv_dt_foot'] = array();
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sv_dt_foot'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sv_dt_foot'][1] = $sc_data_cab1;
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sv_dt_foot']['fix'] = $nm_data_fixa;
   $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\">\r\n");
   $nm_saida->saida("   <TABLE width=\"100%\" class=\"" . $this->css_scGridFooter . "\">\r\n");
   $nm_saida->saida("    <TR align=\"center\">\r\n");
   $nm_saida->saida("     <TD>\r\n");
   $nm_saida->saida("      <TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\">\r\n");
   $nm_saida->saida("       <TR align=\"center\" valign=\"middle\">\r\n");
   $nm_saida->saida("        <TD align=\"left\" rowspan=\"2\" class=\"" . $this->css_scGridFooterFont . "\">\r\n");
   $nm_saida->saida("          \r\n");
   $nm_saida->saida("        </TD>\r\n");
   $nm_saida->saida("        <TD class=\"" . $this->css_scGridFooterFont . "\">\r\n");
   $nm_saida->saida("          \r\n");
   $nm_saida->saida("        </TD>\r\n");
   $nm_saida->saida("       </TR>\r\n");
   $nm_saida->saida("       <TR align=\"right\" valign=\"middle\">\r\n");
   $nm_saida->saida("        <TD class=\"" . $this->css_scGridFooterFont . "\">\r\n");
   $nm_saida->saida("          " . $sc_data_cab1 . "\r\n");
   $nm_saida->saida("        </TD>\r\n");
   $nm_saida->saida("       </TR>\r\n");
   $nm_saida->saida("      </TABLE>\r\n");
   $nm_saida->saida("     </TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("  </TD>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_foot', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida(" </TR>\r\n");
 }
// 
 function label_grid($linhas = 0)
 {
   global 
           $nm_saida;
   static $nm_seq_titulos   = 0; 
   $contr_embutida = false;
   $salva_htm_emb  = "";
   if (1 < $linhas)
   {
      $this->Lin_impressas++;
   }
   $nm_seq_titulos++; 
   $tmp_header_row = $nm_seq_titulos;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_label'])
      { 
          if (!isset($_SESSION['scriptcase']['saida_var']) || !$_SESSION['scriptcase']['saida_var']) 
          { 
              $_SESSION['scriptcase']['saida_var']  = true;
              $_SESSION['scriptcase']['saida_html'] = "";
              $contr_embutida = true;
          } 
          else 
          { 
              $salva_htm_emb = $_SESSION['scriptcase']['saida_html'];
              $_SESSION['scriptcase']['saida_html'] = "";
          } 
      } 
   $nm_saida->saida("    <TR class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-v_dashboard_lop-" . $tmp_header_row . "\" align=\"center\">\r\n");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_label'])
      { 
       $nm_saida->saida("      <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
      } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'])
   {
       $nm_saida->saida("      <TD class=\"" . $this->css_scGridLabelFont . "\">&nbsp;</TD>\r\n");
   }
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C1_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C2_label\" colspan=4 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C2_label'] . "\">Preparing</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C3_label\" colspan=2 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C3_label'] . "\">Perijinan & Delivery Material</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C4_label\" colspan=8 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C4_label'] . "\">Instalasi & Test Comm</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C5_label\" colspan=4 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C5_label'] . "\">Closing</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C6_label\" colspan=4 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C6_label'] . "\">Project Status</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   $nm_saida->saida("    <TR id=\"tit_v_dashboard_lop__SCCS__" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-v_dashboard_lop-" . $tmp_header_row . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_label']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_complete_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_complete_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
   } 
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_label'])
     { 
         if (isset($_SESSION['scriptcase']['saida_var']) && $_SESSION['scriptcase']['saida_var'])
         { 
             $Cod_Html = $_SESSION['scriptcase']['saida_html'];
             $pos_tag = strpos($Cod_Html, "<TD ");
             $Cod_Html = substr($Cod_Html, $pos_tag);
             $pos      = 0;
             $pos_tag  = false;
             $pos_tmp  = true; 
             $tmp      = $Cod_Html;
             while ($pos_tmp)
             {
                $pos = strpos($tmp, "</TR>", $pos);
                if ($pos !== false)
                {
                    $pos_tag = $pos;
                    $pos += 4;
                }
                else
                {
                    $pos_tmp = false;
                }
             }
             $Cod_Html = substr($Cod_Html, 0, $pos_tag);
             $Nm_temp = explode("</TD>", $Cod_Html);
             $css_emb = "<style type=\"text/css\">";
             $NM_css = file($this->Ini->root . $this->Ini->path_link . "v_dashboard_lop/v_dashboard_lop_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
             foreach ($NM_css as $cada_css)
             {
                 $css_emb .= ".v_dashboard_lop_" . substr($cada_css, 1);
             }
             $css_emb .= "</style>";
             $Cod_Html = $css_emb . $Cod_Html;
             $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cols_emb'] = count($Nm_temp) - 1;
             if ($contr_embutida) 
             { 
                 $_SESSION['scriptcase']['saida_var']  = false;
                 $nm_saida->saida($Cod_Html);
             } 
             else 
             { 
                 $_SESSION['scriptcase']['saida_html'] = $salva_htm_emb . $Cod_Html;
             } 
         } 
     } 
   } 
 }
 function NM_label_tp_witel()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_witel'])) ? $this->New_label['tp_witel'] : "TP WITEL"; 
   if (!isset($this->NM_cmp_hidden['tp_witel']) || $this->NM_cmp_hidden['tp_witel'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_witel_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_witel_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_cmp'] == 'TP_WITEL')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_WITEL')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_kickoffmeeting()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['kickoffmeeting'])) ? $this->New_label['kickoffmeeting'] : "Kickoff Meeting"; 
   if (!isset($this->NM_cmp_hidden['kickoffmeeting']) || $this->NM_cmp_hidden['kickoffmeeting'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_kickoffmeeting_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_kickoffmeeting_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_cmp'] == 'KickoffMeeting')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('KickoffMeeting')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_survey()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['survey'])) ? $this->New_label['survey'] : "Survey"; 
   if (!isset($this->NM_cmp_hidden['survey']) || $this->NM_cmp_hidden['survey'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_survey_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_survey_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_cmp'] == 'Survey')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('Survey')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_rab_apd_kml()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['rab_apd_kml'])) ? $this->New_label['rab_apd_kml'] : "RAB APD KML"; 
   if (!isset($this->NM_cmp_hidden['rab_apd_kml']) || $this->NM_cmp_hidden['rab_apd_kml'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_rab_apd_kml_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_rab_apd_kml_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_cmp'] == 'RAB_APD_KML')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('RAB_APD_KML')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_njki_justifikasi_nodin()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['njki_justifikasi_nodin'])) ? $this->New_label['njki_justifikasi_nodin'] : "NJKI Justifikasi NODIN"; 
   if (!isset($this->NM_cmp_hidden['njki_justifikasi_nodin']) || $this->NM_cmp_hidden['njki_justifikasi_nodin'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_njki_justifikasi_nodin_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_njki_justifikasi_nodin_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_cmp'] == 'NJKI_Justifikasi_NODIN')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('NJKI_Justifikasi_NODIN')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_perijinan()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['perijinan'])) ? $this->New_label['perijinan'] : "Perijinan"; 
   if (!isset($this->NM_cmp_hidden['perijinan']) || $this->NM_cmp_hidden['perijinan'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_perijinan_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_perijinan_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_cmp'] == 'Perijinan')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ordem_label'] == "desc")
          {
              $nome_img = $this->Ini->Label_sort_desc;
          }
          else
          {
              $nome_img = $this->Ini->Label_sort_asc;
          }
      }
      if (empty($this->Ini->Label_sort_pos) || $this->Ini->Label_sort_pos == "right")
      {
          $this->Ini->Label_sort_pos = "right_field";
      }
      if (empty($nome_img))
      {
          $link_img = nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_field")
      {
          $link_img = nl2br($SC_Label) . "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>";
      }
      elseif ($this->Ini->Label_sort_pos == "left_field")
      {
          $link_img = "<IMG SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "right_cell")
      {
          $link_img = "<IMG style=\"float: right\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
      elseif ($this->Ini->Label_sort_pos == "left_cell")
      {
          $link_img = "<IMG style=\"float: left\" SRC=\"" . $this->Ini->path_img_global . "/" . $nome_img . "\" BORDER=\"0\"/>" . nl2br($SC_Label);
      }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('Perijinan')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_deliverymaterial()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['deliverymaterial'])) ? $this->New_label['deliverymaterial'] : "Delivery Material"; 
   if (!isset($this->NM_cmp_hidden['deliverymaterial']) || $this->NM_cmp_hidden['deliverymaterial'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_deliverymaterial_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_deliverymaterial_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_bctr()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['bctr'])) ? $this->New_label['bctr'] : "BCTR"; 
   if (!isset($this->NM_cmp_hidden['bctr']) || $this->NM_cmp_hidden['bctr'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_bctr_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_bctr_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_gelarhdpetanamtiang()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['gelarhdpetanamtiang'])) ? $this->New_label['gelarhdpetanamtiang'] : "Gelar HDPE Tanam Tiang"; 
   if (!isset($this->NM_cmp_hidden['gelarhdpetanamtiang']) || $this->NM_cmp_hidden['gelarhdpetanamtiang'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_gelarhdpetanamtiang_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_gelarhdpetanamtiang_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_gelarkabel()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['gelarkabel'])) ? $this->New_label['gelarkabel'] : "Gelar Kabel"; 
   if (!isset($this->NM_cmp_hidden['gelarkabel']) || $this->NM_cmp_hidden['gelarkabel'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_gelarkabel_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_gelarkabel_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_pasangterminalterminasijumperodf()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pasangterminalterminasijumperodf'])) ? $this->New_label['pasangterminalterminasijumperodf'] : "Pasang Terminal Terminasi Jumper ODF"; 
   if (!isset($this->NM_cmp_hidden['pasangterminalterminasijumperodf']) || $this->NM_cmp_hidden['pasangterminalterminasijumperodf'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_pasangterminalterminasijumperodf_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pasangterminalterminasijumperodf_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_pasangterminalterminasjumperodc()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pasangterminalterminasjumperodc'])) ? $this->New_label['pasangterminalterminasjumperodc'] : "Pasang Terminal Terminas Jumper ODC"; 
   if (!isset($this->NM_cmp_hidden['pasangterminalterminasjumperodc']) || $this->NM_cmp_hidden['pasangterminalterminasjumperodc'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_pasangterminalterminasjumperodc_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pasangterminalterminasjumperodc_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_pasangterminalodp()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['pasangterminalodp'])) ? $this->New_label['pasangterminalodp'] : "Pasang Terminal ODP"; 
   if (!isset($this->NM_cmp_hidden['pasangterminalodp']) || $this->NM_cmp_hidden['pasangterminalodp'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_pasangterminalodp_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_pasangterminalodp_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_terminasiodp()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['terminasiodp'])) ? $this->New_label['terminasiodp'] : "Terminasi ODP"; 
   if (!isset($this->NM_cmp_hidden['terminasiodp']) || $this->NM_cmp_hidden['terminasiodp'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_terminasiodp_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_terminasiodp_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_testcomm()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['testcomm'])) ? $this->New_label['testcomm'] : "Test Comm"; 
   if (!isset($this->NM_cmp_hidden['testcomm']) || $this->NM_cmp_hidden['testcomm'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_testcomm_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_testcomm_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ujiterima()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ujiterima'])) ? $this->New_label['ujiterima'] : "Uji Terima"; 
   if (!isset($this->NM_cmp_hidden['ujiterima']) || $this->NM_cmp_hidden['ujiterima'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ujiterima_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ujiterima_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_bautrekon()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['bautrekon'])) ? $this->New_label['bautrekon'] : "BAUT Rekon"; 
   if (!isset($this->NM_cmp_hidden['bautrekon']) || $this->NM_cmp_hidden['bautrekon'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_bautrekon_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_bautrekon_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_amandemenbast()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['amandemenbast'])) ? $this->New_label['amandemenbast'] : "Amandemen BAST"; 
   if (!isset($this->NM_cmp_hidden['amandemenbast']) || $this->NM_cmp_hidden['amandemenbast'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_amandemenbast_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_amandemenbast_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_grir()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['grir'])) ? $this->New_label['grir'] : "GRIR"; 
   if (!isset($this->NM_cmp_hidden['grir']) || $this->NM_cmp_hidden['grir'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_grir_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_grir_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_newentry()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['newentry'])) ? $this->New_label['newentry'] : "New Entry"; 
   if (!isset($this->NM_cmp_hidden['newentry']) || $this->NM_cmp_hidden['newentry'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_newentry_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_newentry_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_inprogress()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['inprogress'])) ? $this->New_label['inprogress'] : "Inprogress"; 
   if (!isset($this->NM_cmp_hidden['inprogress']) || $this->NM_cmp_hidden['inprogress'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_inprogress_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_inprogress_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_others()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['others'])) ? $this->New_label['others'] : "Others"; 
   if (!isset($this->NM_cmp_hidden['others']) || $this->NM_cmp_hidden['others'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_others_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_others_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_complete()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['complete'])) ? $this->New_label['complete'] : "Complete"; 
   if (!isset($this->NM_cmp_hidden['complete']) || $this->NM_cmp_hidden['complete'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_complete_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_complete_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida;
   $fecha_tr               = "</tr>";
   $this->Ini->qual_linha  = "par";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ini_cor_grid']);
       }
   }
   static $nm_seq_execucoes = 0; 
   static $nm_seq_titulos   = 0; 
   $this->SC_ancora = "";
   $this->Rows_span = 1;
   $nm_seq_execucoes++; 
   $nm_seq_titulos++; 
   $this->nm_prim_linha  = true; 
   $this->Ini->nm_cont_lin = 0; 
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['where_pesq_filtro'];
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['v_dashboard_lop']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_v_dashboard_lop#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['cab_embutida'] != "S")
               {
                   $this->label_grid($linhas);
               }
               $this->NM_calc_span();
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridFieldOdd . "\"  style=\"padding: 0px; font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\" colspan = \"" . $this->NM_colspan . "\" align=\"center\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "\r\n");
               $nm_saida->saida("  </td></tr>\r\n");
               $nm_saida->saida("  </table></td></tr></table>\r\n");
               $this->Lin_final = $this->rs_grid->EOF;
               if ($this->Lin_final)
               {
                   $this->rs_grid->Close();
               }
           }
       }
       else
       {
           $nm_saida->saida(" <TR> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && 
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print") 
           { 
           $nm_saida->saida("    <TD >\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_v_dashboard_lop\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_EL_v_dashboard_lop\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
           } 
           $nm_saida->saida("  <td id=\"sc_grid_body\" class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_A_v_dashboard_lop', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_D_v_dashboard_lop', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_E_v_dashboard_lop', 'value' => 'NM_Blank_Page.htm');
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" &&
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print") 
           { 
               $nm_saida->saida("</TABLE></TD>\r\n");
               $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_v_dashboard_lop\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_DL_v_dashboard_lop\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               $nm_saida->saida("</TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_v_dashboard_lop\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_D_v_dashboard_lop\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    </TR>\r\n");
           } 
       $nm_saida->saida("</TABLE>\r\n");
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_v_dashboard_lop#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
       $nm_saida->saida(" <TR> \r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print") 
       { 
           $nm_saida->saida("    <TD  colspan=3>\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_v_dashboard_lop\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_EL_v_dashboard_lop\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
       } 
       $nm_id_aplicacao = " id=\"apl_v_dashboard_lop#?#1\"";
   } 
   $nm_saida->saida("  <TD id=\"sc_grid_body\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-164d0390\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final'] = 0;
   } 
   $this->nmgp_prim_pag_pdf = false;
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $this->Ini->link_survey_apl = "";
   $this->Ini->link_rab_apd_kml_apl = "";
   $this->Ini->link_njki_justifikasi_nodin_apl = "";
   $this->Ini->link_perijinan_apl = "";
   $this->Ini->link_deliverymaterial_apl = "";
   $this->Ini->link_bctr_apl = "";
   $this->Ini->link_gelarhdpetanamtiang_apl = "";
   $this->Ini->link_gelarkabel_apl = "";
   $this->Ini->link_pasangterminalterminasijumperodf_apl = "";
   $this->Ini->link_pasangterminalterminasjumperodc_apl = "";
   $this->Ini->link_pasangterminalodp_apl = "";
   $this->Ini->link_terminasiodp_apl = "";
   $this->Ini->link_testcomm_apl = "";
   $this->Ini->link_ujiterima_apl = "";
   $this->Ini->link_bautrekon_apl = "";
   $this->Ini->link_amandemenbast_apl = "";
   $this->Ini->link_grir_apl = "";
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
          //---------- Gauge ----------
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf" && -1 < $this->progress_grid)
          {
              $this->progress_now++;
              if (0 == $this->progress_lim_now)
              {
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_rows'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
                  fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n");
              }
              $this->progress_lim_now++;
              if ($this->progress_lim_tot == $this->progress_lim_now)
              {
                  $this->progress_lim_now = 0;
              }
          }
          $this->Lin_impressas++;
          $this->tp_witel = $this->rs_grid->fields[0] ;  
          $this->tp_witel = (string)$this->tp_witel;
          $this->kickoffmeeting = $this->rs_grid->fields[1] ;  
          $this->kickoffmeeting = (string)$this->kickoffmeeting;
          $this->survey = $this->rs_grid->fields[2] ;  
          $this->survey = (string)$this->survey;
          $this->rab_apd_kml = $this->rs_grid->fields[3] ;  
          $this->rab_apd_kml = (string)$this->rab_apd_kml;
          $this->njki_justifikasi_nodin = $this->rs_grid->fields[4] ;  
          $this->njki_justifikasi_nodin = (string)$this->njki_justifikasi_nodin;
          $this->perijinan = $this->rs_grid->fields[5] ;  
          $this->perijinan = (string)$this->perijinan;
          $this->deliverymaterial = $this->rs_grid->fields[6] ;  
          $this->deliverymaterial = (string)$this->deliverymaterial;
          $this->bctr = $this->rs_grid->fields[7] ;  
          $this->bctr = (string)$this->bctr;
          $this->gelarhdpetanamtiang = $this->rs_grid->fields[8] ;  
          $this->gelarhdpetanamtiang = (string)$this->gelarhdpetanamtiang;
          $this->gelarkabel = $this->rs_grid->fields[9] ;  
          $this->gelarkabel = (string)$this->gelarkabel;
          $this->pasangterminalterminasijumperodf = $this->rs_grid->fields[10] ;  
          $this->pasangterminalterminasijumperodf = (string)$this->pasangterminalterminasijumperodf;
          $this->pasangterminalterminasjumperodc = $this->rs_grid->fields[11] ;  
          $this->pasangterminalterminasjumperodc = (string)$this->pasangterminalterminasjumperodc;
          $this->pasangterminalodp = $this->rs_grid->fields[12] ;  
          $this->pasangterminalodp = (string)$this->pasangterminalodp;
          $this->terminasiodp = $this->rs_grid->fields[13] ;  
          $this->terminasiodp = (string)$this->terminasiodp;
          $this->testcomm = $this->rs_grid->fields[14] ;  
          $this->testcomm = (string)$this->testcomm;
          $this->ujiterima = $this->rs_grid->fields[15] ;  
          $this->ujiterima = (string)$this->ujiterima;
          $this->bautrekon = $this->rs_grid->fields[16] ;  
          $this->bautrekon = (string)$this->bautrekon;
          $this->amandemenbast = $this->rs_grid->fields[17] ;  
          $this->amandemenbast = (string)$this->amandemenbast;
          $this->grir = $this->rs_grid->fields[18] ;  
          $this->grir = (string)$this->grir;
          $this->newentry = $this->rs_grid->fields[19] ;  
          $this->newentry =  str_replace(",", ".", $this->newentry);
          $this->newentry = (string)$this->newentry;
          $this->inprogress = $this->rs_grid->fields[20] ;  
          $this->inprogress =  str_replace(",", ".", $this->inprogress);
          $this->inprogress = (string)$this->inprogress;
          $this->others = $this->rs_grid->fields[21] ;  
          $this->others =  str_replace(",", ".", $this->others);
          $this->others = (string)$this->others;
          $this->complete = $this->rs_grid->fields[22] ;  
          $this->complete =  str_replace(",", ".", $this->complete);
          $this->complete = (string)$this->complete;
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final'] + 1; 
          $this->SC_sep_quebra = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['rows_emb']++;
          $this->Ini->link_survey_apl = "";
          $this->Ini->link_rab_apd_kml_apl = "";
          $this->Ini->link_njki_justifikasi_nodin_apl = "";
          $this->Ini->link_perijinan_apl = "";
          $this->Ini->link_deliverymaterial_apl = "";
          $this->Ini->link_bctr_apl = "";
          $this->Ini->link_gelarhdpetanamtiang_apl = "";
          $this->Ini->link_gelarkabel_apl = "";
          $this->Ini->link_pasangterminalterminasijumperodf_apl = "";
          $this->Ini->link_pasangterminalterminasjumperodc_apl = "";
          $this->Ini->link_pasangterminalodp_apl = "";
          $this->Ini->link_terminasiodp_apl = "";
          $this->Ini->link_testcomm_apl = "";
          $this->Ini->link_ujiterima_apl = "";
          $this->Ini->link_bautrekon_apl = "";
          $this->Ini->link_amandemenbast_apl = "";
          $this->Ini->link_grir_apl = "";
          $this->sc_proc_grid = true;
          $_SESSION['scriptcase']['v_dashboard_lop']['contr_erro'] = 'on';
 $tahapan0 ="21,41,61";
$this->Ini->link_survey_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_survey_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_survey_apl = str_replace("'", "\'", $this->Ini->link_survey_apl);
$this->Ini->link_survey_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan0  . "?@?";
$this->Ini->link_survey_parms = str_replace("'", "\'", $this->Ini->link_survey_parms);
$this->Ini->link_survey_hint = "";
$this->Ini->link_survey_hint = str_replace("'", "\'", $this->Ini->link_survey_hint);
$this->Ini->link_survey_target = "_self";
$this->Ini->link_survey_pos = "";
$this->Ini->link_survey_alt = "";
$this->Ini->link_survey_larg = "";
;
$tahapan1 ="22,42,62";
$this->Ini->link_survey_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_survey_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_survey_apl = str_replace("'", "\'", $this->Ini->link_survey_apl);
$this->Ini->link_survey_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan1  . "?@?";
$this->Ini->link_survey_parms = str_replace("'", "\'", $this->Ini->link_survey_parms);
$this->Ini->link_survey_hint = "";
$this->Ini->link_survey_hint = str_replace("'", "\'", $this->Ini->link_survey_hint);
$this->Ini->link_survey_target = "_self";
$this->Ini->link_survey_pos = "";
$this->Ini->link_survey_alt = "";
$this->Ini->link_survey_larg = "";
;
$tahapan2 = "23,43,63";
$this->Ini->link_rab_apd_kml_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_rab_apd_kml_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_rab_apd_kml_apl = str_replace("'", "\'", $this->Ini->link_rab_apd_kml_apl);
$this->Ini->link_rab_apd_kml_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan2  . "?@?";
$this->Ini->link_rab_apd_kml_parms = str_replace("'", "\'", $this->Ini->link_rab_apd_kml_parms);
$this->Ini->link_rab_apd_kml_hint = "";
$this->Ini->link_rab_apd_kml_hint = str_replace("'", "\'", $this->Ini->link_rab_apd_kml_hint);
$this->Ini->link_rab_apd_kml_target = "_self";
$this->Ini->link_rab_apd_kml_pos = "";
$this->Ini->link_rab_apd_kml_alt = "";
$this->Ini->link_rab_apd_kml_larg = "";
;
$tahapan3 = "24,44,64";
$this->Ini->link_njki_justifikasi_nodin_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_njki_justifikasi_nodin_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_njki_justifikasi_nodin_apl = str_replace("'", "\'", $this->Ini->link_njki_justifikasi_nodin_apl);
$this->Ini->link_njki_justifikasi_nodin_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan3  . "?@?";
$this->Ini->link_njki_justifikasi_nodin_parms = str_replace("'", "\'", $this->Ini->link_njki_justifikasi_nodin_parms);
$this->Ini->link_njki_justifikasi_nodin_hint = "";
$this->Ini->link_njki_justifikasi_nodin_hint = str_replace("'", "\'", $this->Ini->link_njki_justifikasi_nodin_hint);
$this->Ini->link_njki_justifikasi_nodin_target = "_self";
$this->Ini->link_njki_justifikasi_nodin_pos = "";
$this->Ini->link_njki_justifikasi_nodin_alt = "";
$this->Ini->link_njki_justifikasi_nodin_larg = "";
;
$tahapan4 = "28,48,68";
$this->Ini->link_perijinan_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_perijinan_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_perijinan_apl = str_replace("'", "\'", $this->Ini->link_perijinan_apl);
$this->Ini->link_perijinan_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan4  . "?@?";
$this->Ini->link_perijinan_parms = str_replace("'", "\'", $this->Ini->link_perijinan_parms);
$this->Ini->link_perijinan_hint = "";
$this->Ini->link_perijinan_hint = str_replace("'", "\'", $this->Ini->link_perijinan_hint);
$this->Ini->link_perijinan_target = "_self";
$this->Ini->link_perijinan_pos = "";
$this->Ini->link_perijinan_alt = "";
$this->Ini->link_perijinan_larg = "";
;
$tahapan5 = "29,49,69";
$this->Ini->link_deliverymaterial_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_deliverymaterial_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_deliverymaterial_apl = str_replace("'", "\'", $this->Ini->link_deliverymaterial_apl);
$this->Ini->link_deliverymaterial_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan5  . "?@?";
$this->Ini->link_deliverymaterial_parms = str_replace("'", "\'", $this->Ini->link_deliverymaterial_parms);
$this->Ini->link_deliverymaterial_hint = "";
$this->Ini->link_deliverymaterial_hint = str_replace("'", "\'", $this->Ini->link_deliverymaterial_hint);
$this->Ini->link_deliverymaterial_target = "_self";
$this->Ini->link_deliverymaterial_pos = "";
$this->Ini->link_deliverymaterial_alt = "";
$this->Ini->link_deliverymaterial_larg = "";
;
$tahapan6 = "30,50,70";
$this->Ini->link_bctr_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_bctr_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_bctr_apl = str_replace("'", "\'", $this->Ini->link_bctr_apl);
$this->Ini->link_bctr_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan6  . "?@?";
$this->Ini->link_bctr_parms = str_replace("'", "\'", $this->Ini->link_bctr_parms);
$this->Ini->link_bctr_hint = "";
$this->Ini->link_bctr_hint = str_replace("'", "\'", $this->Ini->link_bctr_hint);
$this->Ini->link_bctr_target = "_self";
$this->Ini->link_bctr_pos = "";
$this->Ini->link_bctr_alt = "";
$this->Ini->link_bctr_larg = "";
;
$tahapan7 = "31,51,71";
$this->Ini->link_gelarhdpetanamtiang_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_gelarhdpetanamtiang_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_gelarhdpetanamtiang_apl = str_replace("'", "\'", $this->Ini->link_gelarhdpetanamtiang_apl);
$this->Ini->link_gelarhdpetanamtiang_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan7  . "?@?";
$this->Ini->link_gelarhdpetanamtiang_parms = str_replace("'", "\'", $this->Ini->link_gelarhdpetanamtiang_parms);
$this->Ini->link_gelarhdpetanamtiang_hint = "";
$this->Ini->link_gelarhdpetanamtiang_hint = str_replace("'", "\'", $this->Ini->link_gelarhdpetanamtiang_hint);
$this->Ini->link_gelarhdpetanamtiang_target = "_self";
$this->Ini->link_gelarhdpetanamtiang_pos = "";
$this->Ini->link_gelarhdpetanamtiang_alt = "";
$this->Ini->link_gelarhdpetanamtiang_larg = "";
;
$tahapan8 = "32,52,72";
$this->Ini->link_gelarkabel_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_gelarkabel_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_gelarkabel_apl = str_replace("'", "\'", $this->Ini->link_gelarkabel_apl);
$this->Ini->link_gelarkabel_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan8  . "?@?";
$this->Ini->link_gelarkabel_parms = str_replace("'", "\'", $this->Ini->link_gelarkabel_parms);
$this->Ini->link_gelarkabel_hint = "";
$this->Ini->link_gelarkabel_hint = str_replace("'", "\'", $this->Ini->link_gelarkabel_hint);
$this->Ini->link_gelarkabel_target = "_self";
$this->Ini->link_gelarkabel_pos = "";
$this->Ini->link_gelarkabel_alt = "";
$this->Ini->link_gelarkabel_larg = "";
;
$tahapan9 = "33,53,73";
$this->Ini->link_pasangterminalterminasijumperodf_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_pasangterminalterminasijumperodf_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_pasangterminalterminasijumperodf_apl = str_replace("'", "\'", $this->Ini->link_pasangterminalterminasijumperodf_apl);
$this->Ini->link_pasangterminalterminasijumperodf_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan9  . "?@?";
$this->Ini->link_pasangterminalterminasijumperodf_parms = str_replace("'", "\'", $this->Ini->link_pasangterminalterminasijumperodf_parms);
$this->Ini->link_pasangterminalterminasijumperodf_hint = "";
$this->Ini->link_pasangterminalterminasijumperodf_hint = str_replace("'", "\'", $this->Ini->link_pasangterminalterminasijumperodf_hint);
$this->Ini->link_pasangterminalterminasijumperodf_target = "_self";
$this->Ini->link_pasangterminalterminasijumperodf_pos = "";
$this->Ini->link_pasangterminalterminasijumperodf_alt = "";
$this->Ini->link_pasangterminalterminasijumperodf_larg = "";
;
$tahapan10 = "34,54,74";
$this->Ini->link_pasangterminalterminasjumperodc_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_pasangterminalterminasjumperodc_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_pasangterminalterminasjumperodc_apl = str_replace("'", "\'", $this->Ini->link_pasangterminalterminasjumperodc_apl);
$this->Ini->link_pasangterminalterminasjumperodc_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan10  . "?@?";
$this->Ini->link_pasangterminalterminasjumperodc_parms = str_replace("'", "\'", $this->Ini->link_pasangterminalterminasjumperodc_parms);
$this->Ini->link_pasangterminalterminasjumperodc_hint = "";
$this->Ini->link_pasangterminalterminasjumperodc_hint = str_replace("'", "\'", $this->Ini->link_pasangterminalterminasjumperodc_hint);
$this->Ini->link_pasangterminalterminasjumperodc_target = "_self";
$this->Ini->link_pasangterminalterminasjumperodc_pos = "";
$this->Ini->link_pasangterminalterminasjumperodc_alt = "";
$this->Ini->link_pasangterminalterminasjumperodc_larg = "";
;
$tahapan11 = "35,55,75";
$this->Ini->link_pasangterminalodp_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_pasangterminalodp_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_pasangterminalodp_apl = str_replace("'", "\'", $this->Ini->link_pasangterminalodp_apl);
$this->Ini->link_pasangterminalodp_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan11  . "?@?";
$this->Ini->link_pasangterminalodp_parms = str_replace("'", "\'", $this->Ini->link_pasangterminalodp_parms);
$this->Ini->link_pasangterminalodp_hint = "";
$this->Ini->link_pasangterminalodp_hint = str_replace("'", "\'", $this->Ini->link_pasangterminalodp_hint);
$this->Ini->link_pasangterminalodp_target = "_self";
$this->Ini->link_pasangterminalodp_pos = "";
$this->Ini->link_pasangterminalodp_alt = "";
$this->Ini->link_pasangterminalodp_larg = "";
;
$tahapan12 = "36,56,76";
$this->Ini->link_terminasiodp_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_terminasiodp_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_terminasiodp_apl = str_replace("'", "\'", $this->Ini->link_terminasiodp_apl);
$this->Ini->link_terminasiodp_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan12  . "?@?";
$this->Ini->link_terminasiodp_parms = str_replace("'", "\'", $this->Ini->link_terminasiodp_parms);
$this->Ini->link_terminasiodp_hint = "";
$this->Ini->link_terminasiodp_hint = str_replace("'", "\'", $this->Ini->link_terminasiodp_hint);
$this->Ini->link_terminasiodp_target = "_self";
$this->Ini->link_terminasiodp_pos = "";
$this->Ini->link_terminasiodp_alt = "";
$this->Ini->link_terminasiodp_larg = "";
;
$tahapan13 = "37,57,77";
$this->Ini->link_testcomm_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_testcomm_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_testcomm_apl = str_replace("'", "\'", $this->Ini->link_testcomm_apl);
$this->Ini->link_testcomm_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan13  . "?@?";
$this->Ini->link_testcomm_parms = str_replace("'", "\'", $this->Ini->link_testcomm_parms);
$this->Ini->link_testcomm_hint = "";
$this->Ini->link_testcomm_hint = str_replace("'", "\'", $this->Ini->link_testcomm_hint);
$this->Ini->link_testcomm_target = "_self";
$this->Ini->link_testcomm_pos = "";
$this->Ini->link_testcomm_alt = "";
$this->Ini->link_testcomm_larg = "";
;
$tahapan14 = "38,58,78";
$this->Ini->link_ujiterima_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_ujiterima_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_ujiterima_apl = str_replace("'", "\'", $this->Ini->link_ujiterima_apl);
$this->Ini->link_ujiterima_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan14  . "?@?";
$this->Ini->link_ujiterima_parms = str_replace("'", "\'", $this->Ini->link_ujiterima_parms);
$this->Ini->link_ujiterima_hint = "";
$this->Ini->link_ujiterima_hint = str_replace("'", "\'", $this->Ini->link_ujiterima_hint);
$this->Ini->link_ujiterima_target = "_self";
$this->Ini->link_ujiterima_pos = "";
$this->Ini->link_ujiterima_alt = "";
$this->Ini->link_ujiterima_larg = "";
;
$tahapan15 = "39,59,79";
$this->Ini->link_bautrekon_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_bautrekon_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_bautrekon_apl = str_replace("'", "\'", $this->Ini->link_bautrekon_apl);
$this->Ini->link_bautrekon_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan15  . "?@?";
$this->Ini->link_bautrekon_parms = str_replace("'", "\'", $this->Ini->link_bautrekon_parms);
$this->Ini->link_bautrekon_hint = "";
$this->Ini->link_bautrekon_hint = str_replace("'", "\'", $this->Ini->link_bautrekon_hint);
$this->Ini->link_bautrekon_target = "_self";
$this->Ini->link_bautrekon_pos = "";
$this->Ini->link_bautrekon_alt = "";
$this->Ini->link_bautrekon_larg = "";
;
$tahapan16 = "40,60,80";
$this->Ini->link_amandemenbast_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_amandemenbast_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_amandemenbast_apl = str_replace("'", "\'", $this->Ini->link_amandemenbast_apl);
$this->Ini->link_amandemenbast_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan16  . "?@?";
$this->Ini->link_amandemenbast_parms = str_replace("'", "\'", $this->Ini->link_amandemenbast_parms);
$this->Ini->link_amandemenbast_hint = "";
$this->Ini->link_amandemenbast_hint = str_replace("'", "\'", $this->Ini->link_amandemenbast_hint);
$this->Ini->link_amandemenbast_target = "_self";
$this->Ini->link_amandemenbast_pos = "";
$this->Ini->link_amandemenbast_alt = "";
$this->Ini->link_amandemenbast_larg = "";
;
$tahapan17 = "81,82,83";
$this->Ini->link_grir_apl_or = 'v_dashboard_lop_detail';
$this->Ini->link_grir_apl = $this->Ini->path_link . "" . SC_dir_app_name('v_dashboard_lop_detail') . "/";
$this->Ini->link_grir_apl = str_replace("'", "\'", $this->Ini->link_grir_apl);
$this->Ini->link_grir_parms = "var_witel?#?" . $this->tp_witel  . "?@?" . "in_stmt?#?" . $tahapan17  . "?@?";
$this->Ini->link_grir_parms = str_replace("'", "\'", $this->Ini->link_grir_parms);
$this->Ini->link_grir_hint = "";
$this->Ini->link_grir_hint = str_replace("'", "\'", $this->Ini->link_grir_hint);
$this->Ini->link_grir_target = "_self";
$this->Ini->link_grir_pos = "";
$this->Ini->link_grir_alt = "";
$this->Ini->link_grir_larg = "";
;
$_SESSION['scriptcase']['v_dashboard_lop']['contr_erro'] = 'off';
          if (($nm_houve_quebra == "S" || $nm_inicio_pag == 0) && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_grid'])
          { 
              $this->label_grid($linhas);
              $nm_houve_quebra = "N";
          } 
          $nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['final']; 
          $this->Ini->cor_link_dados = ($this->Ini->cor_link_dados == $this->css_scGridFieldOddLink) ? $this->css_scGridFieldEvenLink : $this->css_scGridFieldOddLink; 
          $this->Ini->qual_linha   = ($this->Ini->qual_linha == "par") ? "impar" : "par";
          if ("impar" == $this->Ini->qual_linha)
          {
              $this->css_line_back = $this->css_scGridFieldOdd;
              $this->css_line_fonf = $this->css_scGridFieldOddFont;
          }
          else
          {
              $this->css_line_back = $this->css_scGridFieldEven;
              $this->css_line_fonf = $this->css_scGridFieldEvenFont;
          }
          $NM_destaque = " onmouseover=\"over_tr(this, '" . $this->css_line_back . "');\" onmouseout=\"out_tr(this, '" . $this->css_line_back . "');\" onclick=\"click_tr(this, '" . $this->css_line_back . "');\"";
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
          }
          $this->SC_ancora = $this->SC_seq_page;
          $nm_saida->saida("    <TR  class=\"" . $this->css_line_back . "\"" . $NM_destaque . " id=\"SC_ancor" . $this->SC_ancora . "\">\r\n");
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->Css_Cmp['css_complete_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">&nbsp;</TD>\r\n");
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_complete_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . $teste . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . $teste . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
          } 
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
      $this->Lin_final = $this->rs_grid->EOF;
      if ($this->Lin_final)
      {
         $this->rs_grid->Close();
      }
   } 
   else
   {
      $this->rs_grid->Close();
   }
   if (!$this->rs_grid->EOF) 
   { 
       if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
       {
           $nm_saida->saida("    </TBODY>");
       }
   } 
   if ($this->rs_grid->EOF) 
   { 
  
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['exibe_total'] == "S")
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_Ind_Groupby'] . "_top";
           $this->$Gb_geral() ;
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_Ind_Groupby'] . "_bot";
           $this->$Gb_geral() ;
       } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida_grid'])
   { 
       return; 
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && empty($this->nm_grid_sem_reg) && 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print") 
   { 
       $nm_saida->saida("</TABLE></TD>\r\n");
       $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_v_dashboard_lop\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_DL_v_dashboard_lop\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       $nm_saida->saida("</TD>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_v_dashboard_lop\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_D_v_dashboard_lop\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
           $nm_saida->saida("    </TABLE>\r\n");
           $nm_saida->saida("    </TD>\r\n");
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao']       = "igual" ; 
   } 
 }
 function NM_grid_tp_witel()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_witel']) || $this->NM_cmp_hidden['tp_witel'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_witel)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          $this->Lookup->lookup_tp_witel($conteudo , $this->tp_witel) ; 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_witel_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_witel_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_witel_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_kickoffmeeting()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['kickoffmeeting']) || $this->NM_cmp_hidden['kickoffmeeting'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->kickoffmeeting)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_kickoffmeeting_grid_line . "\"  style=\"" . $this->Css_Cmp['css_kickoffmeeting_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_kickoffmeeting_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_survey()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['survey']) || $this->NM_cmp_hidden['survey'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->survey)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_survey_grid_line . "\"  style=\"" . $this->Css_Cmp['css_survey_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_survey_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_survey_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_survey_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_survey_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_survey_parms;
  }
  if (!empty($this->Ini->link_survey_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_survey_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_survey_target . "', '" . $this->Ini->link_survey_pos . "', '" . $this->Ini->link_survey_alt . "', '" . $this->Ini->link_survey_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_survey_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_survey_grid_line . "\" style=\"" . $this->Css_Cmp['css_survey_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_survey_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_survey_target . "', '', '" . $this->Ini->link_survey_alt . "', '" . $this->Ini->link_survey_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_survey_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_survey_grid_line . "\" style=\"" . $this->Css_Cmp['css_survey_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_rab_apd_kml()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['rab_apd_kml']) || $this->NM_cmp_hidden['rab_apd_kml'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->rab_apd_kml)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_rab_apd_kml_grid_line . "\"  style=\"" . $this->Css_Cmp['css_rab_apd_kml_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_rab_apd_kml_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_rab_apd_kml_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_rab_apd_kml_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_rab_apd_kml_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_rab_apd_kml_parms;
  }
  if (!empty($this->Ini->link_rab_apd_kml_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_rab_apd_kml_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_rab_apd_kml_target . "', '" . $this->Ini->link_rab_apd_kml_pos . "', '" . $this->Ini->link_rab_apd_kml_alt . "', '" . $this->Ini->link_rab_apd_kml_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_rab_apd_kml_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_rab_apd_kml_grid_line . "\" style=\"" . $this->Css_Cmp['css_rab_apd_kml_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_rab_apd_kml_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_rab_apd_kml_target . "', '', '" . $this->Ini->link_rab_apd_kml_alt . "', '" . $this->Ini->link_rab_apd_kml_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_rab_apd_kml_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_rab_apd_kml_grid_line . "\" style=\"" . $this->Css_Cmp['css_rab_apd_kml_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_njki_justifikasi_nodin()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['njki_justifikasi_nodin']) || $this->NM_cmp_hidden['njki_justifikasi_nodin'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->njki_justifikasi_nodin)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_njki_justifikasi_nodin_grid_line . "\"  style=\"" . $this->Css_Cmp['css_njki_justifikasi_nodin_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_njki_justifikasi_nodin_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_njki_justifikasi_nodin_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_njki_justifikasi_nodin_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_njki_justifikasi_nodin_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_njki_justifikasi_nodin_parms;
  }
  if (!empty($this->Ini->link_njki_justifikasi_nodin_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_njki_justifikasi_nodin_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_njki_justifikasi_nodin_target . "', '" . $this->Ini->link_njki_justifikasi_nodin_pos . "', '" . $this->Ini->link_njki_justifikasi_nodin_alt . "', '" . $this->Ini->link_njki_justifikasi_nodin_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_njki_justifikasi_nodin_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_njki_justifikasi_nodin_grid_line . "\" style=\"" . $this->Css_Cmp['css_njki_justifikasi_nodin_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_njki_justifikasi_nodin_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_njki_justifikasi_nodin_target . "', '', '" . $this->Ini->link_njki_justifikasi_nodin_alt . "', '" . $this->Ini->link_njki_justifikasi_nodin_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_njki_justifikasi_nodin_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_njki_justifikasi_nodin_grid_line . "\" style=\"" . $this->Css_Cmp['css_njki_justifikasi_nodin_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_perijinan()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['perijinan']) || $this->NM_cmp_hidden['perijinan'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->perijinan)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_perijinan_grid_line . "\"  style=\"" . $this->Css_Cmp['css_perijinan_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_perijinan_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_perijinan_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_perijinan_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_perijinan_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_perijinan_parms;
  }
  if (!empty($this->Ini->link_perijinan_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_perijinan_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_perijinan_target . "', '" . $this->Ini->link_perijinan_pos . "', '" . $this->Ini->link_perijinan_alt . "', '" . $this->Ini->link_perijinan_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_perijinan_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_perijinan_grid_line . "\" style=\"" . $this->Css_Cmp['css_perijinan_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_perijinan_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_perijinan_target . "', '', '" . $this->Ini->link_perijinan_alt . "', '" . $this->Ini->link_perijinan_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_perijinan_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_perijinan_grid_line . "\" style=\"" . $this->Css_Cmp['css_perijinan_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_deliverymaterial()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['deliverymaterial']) || $this->NM_cmp_hidden['deliverymaterial'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->deliverymaterial)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_deliverymaterial_grid_line . "\"  style=\"" . $this->Css_Cmp['css_deliverymaterial_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_deliverymaterial_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_deliverymaterial_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_deliverymaterial_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_deliverymaterial_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_deliverymaterial_parms;
  }
  if (!empty($this->Ini->link_deliverymaterial_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_deliverymaterial_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_deliverymaterial_target . "', '" . $this->Ini->link_deliverymaterial_pos . "', '" . $this->Ini->link_deliverymaterial_alt . "', '" . $this->Ini->link_deliverymaterial_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_deliverymaterial_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_deliverymaterial_grid_line . "\" style=\"" . $this->Css_Cmp['css_deliverymaterial_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_deliverymaterial_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_deliverymaterial_target . "', '', '" . $this->Ini->link_deliverymaterial_alt . "', '" . $this->Ini->link_deliverymaterial_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_deliverymaterial_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_deliverymaterial_grid_line . "\" style=\"" . $this->Css_Cmp['css_deliverymaterial_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_bctr()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['bctr']) || $this->NM_cmp_hidden['bctr'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->bctr)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_bctr_grid_line . "\"  style=\"" . $this->Css_Cmp['css_bctr_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_bctr_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_bctr_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_bctr_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_bctr_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_bctr_parms;
  }
  if (!empty($this->Ini->link_bctr_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_bctr_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_bctr_target . "', '" . $this->Ini->link_bctr_pos . "', '" . $this->Ini->link_bctr_alt . "', '" . $this->Ini->link_bctr_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_bctr_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_bctr_grid_line . "\" style=\"" . $this->Css_Cmp['css_bctr_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_bctr_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_bctr_target . "', '', '" . $this->Ini->link_bctr_alt . "', '" . $this->Ini->link_bctr_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_bctr_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_bctr_grid_line . "\" style=\"" . $this->Css_Cmp['css_bctr_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_gelarhdpetanamtiang()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['gelarhdpetanamtiang']) || $this->NM_cmp_hidden['gelarhdpetanamtiang'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->gelarhdpetanamtiang)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_gelarhdpetanamtiang_grid_line . "\"  style=\"" . $this->Css_Cmp['css_gelarhdpetanamtiang_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_gelarhdpetanamtiang_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_gelarhdpetanamtiang_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_gelarhdpetanamtiang_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_gelarhdpetanamtiang_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_gelarhdpetanamtiang_parms;
  }
  if (!empty($this->Ini->link_gelarhdpetanamtiang_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_gelarhdpetanamtiang_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_gelarhdpetanamtiang_target . "', '" . $this->Ini->link_gelarhdpetanamtiang_pos . "', '" . $this->Ini->link_gelarhdpetanamtiang_alt . "', '" . $this->Ini->link_gelarhdpetanamtiang_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_gelarhdpetanamtiang_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_gelarhdpetanamtiang_grid_line . "\" style=\"" . $this->Css_Cmp['css_gelarhdpetanamtiang_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_gelarhdpetanamtiang_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_gelarhdpetanamtiang_target . "', '', '" . $this->Ini->link_gelarhdpetanamtiang_alt . "', '" . $this->Ini->link_gelarhdpetanamtiang_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_gelarhdpetanamtiang_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_gelarhdpetanamtiang_grid_line . "\" style=\"" . $this->Css_Cmp['css_gelarhdpetanamtiang_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_gelarkabel()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['gelarkabel']) || $this->NM_cmp_hidden['gelarkabel'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->gelarkabel)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_gelarkabel_grid_line . "\"  style=\"" . $this->Css_Cmp['css_gelarkabel_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_gelarkabel_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_gelarkabel_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_gelarkabel_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_gelarkabel_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_gelarkabel_parms;
  }
  if (!empty($this->Ini->link_gelarkabel_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_gelarkabel_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_gelarkabel_target . "', '" . $this->Ini->link_gelarkabel_pos . "', '" . $this->Ini->link_gelarkabel_alt . "', '" . $this->Ini->link_gelarkabel_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_gelarkabel_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_gelarkabel_grid_line . "\" style=\"" . $this->Css_Cmp['css_gelarkabel_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_gelarkabel_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_gelarkabel_target . "', '', '" . $this->Ini->link_gelarkabel_alt . "', '" . $this->Ini->link_gelarkabel_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_gelarkabel_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_gelarkabel_grid_line . "\" style=\"" . $this->Css_Cmp['css_gelarkabel_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_pasangterminalterminasijumperodf()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pasangterminalterminasijumperodf']) || $this->NM_cmp_hidden['pasangterminalterminasijumperodf'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pasangterminalterminasijumperodf)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pasangterminalterminasijumperodf_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pasangterminalterminasijumperodf_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_pasangterminalterminasijumperodf_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_pasangterminalterminasijumperodf_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_pasangterminalterminasijumperodf_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_pasangterminalterminasijumperodf_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_pasangterminalterminasijumperodf_parms;
  }
  if (!empty($this->Ini->link_pasangterminalterminasijumperodf_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_pasangterminalterminasijumperodf_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_pasangterminalterminasijumperodf_target . "', '" . $this->Ini->link_pasangterminalterminasijumperodf_pos . "', '" . $this->Ini->link_pasangterminalterminasijumperodf_alt . "', '" . $this->Ini->link_pasangterminalterminasijumperodf_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_pasangterminalterminasijumperodf_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_pasangterminalterminasijumperodf_grid_line . "\" style=\"" . $this->Css_Cmp['css_pasangterminalterminasijumperodf_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_pasangterminalterminasijumperodf_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_pasangterminalterminasijumperodf_target . "', '', '" . $this->Ini->link_pasangterminalterminasijumperodf_alt . "', '" . $this->Ini->link_pasangterminalterminasijumperodf_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_pasangterminalterminasijumperodf_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_pasangterminalterminasijumperodf_grid_line . "\" style=\"" . $this->Css_Cmp['css_pasangterminalterminasijumperodf_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_pasangterminalterminasjumperodc()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pasangterminalterminasjumperodc']) || $this->NM_cmp_hidden['pasangterminalterminasjumperodc'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pasangterminalterminasjumperodc)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pasangterminalterminasjumperodc_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pasangterminalterminasjumperodc_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_pasangterminalterminasjumperodc_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_pasangterminalterminasjumperodc_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_pasangterminalterminasjumperodc_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_pasangterminalterminasjumperodc_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_pasangterminalterminasjumperodc_parms;
  }
  if (!empty($this->Ini->link_pasangterminalterminasjumperodc_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_pasangterminalterminasjumperodc_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_pasangterminalterminasjumperodc_target . "', '" . $this->Ini->link_pasangterminalterminasjumperodc_pos . "', '" . $this->Ini->link_pasangterminalterminasjumperodc_alt . "', '" . $this->Ini->link_pasangterminalterminasjumperodc_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_pasangterminalterminasjumperodc_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_pasangterminalterminasjumperodc_grid_line . "\" style=\"" . $this->Css_Cmp['css_pasangterminalterminasjumperodc_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_pasangterminalterminasjumperodc_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_pasangterminalterminasjumperodc_target . "', '', '" . $this->Ini->link_pasangterminalterminasjumperodc_alt . "', '" . $this->Ini->link_pasangterminalterminasjumperodc_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_pasangterminalterminasjumperodc_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_pasangterminalterminasjumperodc_grid_line . "\" style=\"" . $this->Css_Cmp['css_pasangterminalterminasjumperodc_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_pasangterminalodp()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['pasangterminalodp']) || $this->NM_cmp_hidden['pasangterminalodp'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->pasangterminalodp)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_pasangterminalodp_grid_line . "\"  style=\"" . $this->Css_Cmp['css_pasangterminalodp_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_pasangterminalodp_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_pasangterminalodp_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_pasangterminalodp_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_pasangterminalodp_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_pasangterminalodp_parms;
  }
  if (!empty($this->Ini->link_pasangterminalodp_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_pasangterminalodp_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_pasangterminalodp_target . "', '" . $this->Ini->link_pasangterminalodp_pos . "', '" . $this->Ini->link_pasangterminalodp_alt . "', '" . $this->Ini->link_pasangterminalodp_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_pasangterminalodp_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_pasangterminalodp_grid_line . "\" style=\"" . $this->Css_Cmp['css_pasangterminalodp_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_pasangterminalodp_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_pasangterminalodp_target . "', '', '" . $this->Ini->link_pasangterminalodp_alt . "', '" . $this->Ini->link_pasangterminalodp_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_pasangterminalodp_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_pasangterminalodp_grid_line . "\" style=\"" . $this->Css_Cmp['css_pasangterminalodp_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_terminasiodp()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['terminasiodp']) || $this->NM_cmp_hidden['terminasiodp'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->terminasiodp)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_terminasiodp_grid_line . "\"  style=\"" . $this->Css_Cmp['css_terminasiodp_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_terminasiodp_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_terminasiodp_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_terminasiodp_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_terminasiodp_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_terminasiodp_parms;
  }
  if (!empty($this->Ini->link_terminasiodp_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_terminasiodp_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_terminasiodp_target . "', '" . $this->Ini->link_terminasiodp_pos . "', '" . $this->Ini->link_terminasiodp_alt . "', '" . $this->Ini->link_terminasiodp_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_terminasiodp_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_terminasiodp_grid_line . "\" style=\"" . $this->Css_Cmp['css_terminasiodp_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_terminasiodp_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_terminasiodp_target . "', '', '" . $this->Ini->link_terminasiodp_alt . "', '" . $this->Ini->link_terminasiodp_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_terminasiodp_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_terminasiodp_grid_line . "\" style=\"" . $this->Css_Cmp['css_terminasiodp_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_testcomm()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['testcomm']) || $this->NM_cmp_hidden['testcomm'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->testcomm)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_testcomm_grid_line . "\"  style=\"" . $this->Css_Cmp['css_testcomm_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_testcomm_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_testcomm_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_testcomm_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_testcomm_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_testcomm_parms;
  }
  if (!empty($this->Ini->link_testcomm_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_testcomm_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_testcomm_target . "', '" . $this->Ini->link_testcomm_pos . "', '" . $this->Ini->link_testcomm_alt . "', '" . $this->Ini->link_testcomm_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_testcomm_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_testcomm_grid_line . "\" style=\"" . $this->Css_Cmp['css_testcomm_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_testcomm_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_testcomm_target . "', '', '" . $this->Ini->link_testcomm_alt . "', '" . $this->Ini->link_testcomm_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_testcomm_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_testcomm_grid_line . "\" style=\"" . $this->Css_Cmp['css_testcomm_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_ujiterima()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ujiterima']) || $this->NM_cmp_hidden['ujiterima'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ujiterima)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ujiterima_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ujiterima_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_ujiterima_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_ujiterima_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_ujiterima_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_ujiterima_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_ujiterima_parms;
  }
  if (!empty($this->Ini->link_ujiterima_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_ujiterima_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_ujiterima_target . "', '" . $this->Ini->link_ujiterima_pos . "', '" . $this->Ini->link_ujiterima_alt . "', '" . $this->Ini->link_ujiterima_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_ujiterima_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_ujiterima_grid_line . "\" style=\"" . $this->Css_Cmp['css_ujiterima_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_ujiterima_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_ujiterima_target . "', '', '" . $this->Ini->link_ujiterima_alt . "', '" . $this->Ini->link_ujiterima_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_ujiterima_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_ujiterima_grid_line . "\" style=\"" . $this->Css_Cmp['css_ujiterima_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_bautrekon()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['bautrekon']) || $this->NM_cmp_hidden['bautrekon'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->bautrekon)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_bautrekon_grid_line . "\"  style=\"" . $this->Css_Cmp['css_bautrekon_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_bautrekon_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_bautrekon_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_bautrekon_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_bautrekon_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_bautrekon_parms;
  }
  if (!empty($this->Ini->link_bautrekon_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_bautrekon_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_bautrekon_target . "', '" . $this->Ini->link_bautrekon_pos . "', '" . $this->Ini->link_bautrekon_alt . "', '" . $this->Ini->link_bautrekon_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_bautrekon_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_bautrekon_grid_line . "\" style=\"" . $this->Css_Cmp['css_bautrekon_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_bautrekon_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_bautrekon_target . "', '', '" . $this->Ini->link_bautrekon_alt . "', '" . $this->Ini->link_bautrekon_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_bautrekon_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_bautrekon_grid_line . "\" style=\"" . $this->Css_Cmp['css_bautrekon_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_amandemenbast()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['amandemenbast']) || $this->NM_cmp_hidden['amandemenbast'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->amandemenbast)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_amandemenbast_grid_line . "\"  style=\"" . $this->Css_Cmp['css_amandemenbast_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_amandemenbast_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_amandemenbast_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_amandemenbast_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_amandemenbast_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_amandemenbast_parms;
  }
  if (!empty($this->Ini->link_amandemenbast_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_amandemenbast_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_amandemenbast_target . "', '" . $this->Ini->link_amandemenbast_pos . "', '" . $this->Ini->link_amandemenbast_alt . "', '" . $this->Ini->link_amandemenbast_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_amandemenbast_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_amandemenbast_grid_line . "\" style=\"" . $this->Css_Cmp['css_amandemenbast_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_amandemenbast_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_amandemenbast_target . "', '', '" . $this->Ini->link_amandemenbast_alt . "', '" . $this->Ini->link_amandemenbast_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_amandemenbast_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_amandemenbast_grid_line . "\" style=\"" . $this->Css_Cmp['css_amandemenbast_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_grir()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['grir']) || $this->NM_cmp_hidden['grir'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->grir)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_grir_grid_line . "\"  style=\"" . $this->Css_Cmp['css_grir_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf"  && $conteudo != "&nbsp;" && !empty($this->Ini->link_grir_apl)) { 
  if (isset($this->Ini->sc_lig_md5[$this->Ini->link_grir_apl_or]) && $this->Ini->sc_lig_md5[$this->Ini->link_grir_apl_or] == "S") {
      $Parms_Lig  = $this->Ini->link_grir_parms;
      $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($Parms_Lig);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
  } else {
      $Md5_Lig  = $this->Ini->link_grir_parms;
  }
  if (!empty($this->Ini->link_grir_pos)) { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit6('" . $this->Ini->link_grir_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_grir_target . "', '" . $this->Ini->link_grir_pos . "', '" . $this->Ini->link_grir_alt . "', '" . $this->Ini->link_grir_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_grir_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_grir_grid_line . "\" style=\"" . $this->Css_Cmp['css_grir_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  } else { 
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_grir_apl . "', '$this->nm_location', '" . $Md5_Lig . "', '" . $this->Ini->link_grir_target . "', '', '" . $this->Ini->link_grir_alt . "', '" . $this->Ini->link_grir_larg . "')\" onMouseover=\"nm_mostra_hint(this, event, '" . $this->Ini->link_grir_hint . "')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_grir_grid_line . "\" style=\"" . $this->Css_Cmp['css_grir_grid_line'] . "\">" . $conteudo . "</a>\r\n");
  }
 } else {
   $nm_saida->saida("$conteudo \r\n");
} 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_newentry()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['newentry']) || $this->NM_cmp_hidden['newentry'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->newentry)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_newentry_grid_line . "\"  style=\"" . $this->Css_Cmp['css_newentry_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_newentry_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_inprogress()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['inprogress']) || $this->NM_cmp_hidden['inprogress'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->inprogress)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_inprogress_grid_line . "\"  style=\"" . $this->Css_Cmp['css_inprogress_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_inprogress_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_others()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['others']) || $this->NM_cmp_hidden['others'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->others)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_others_grid_line . "\"  style=\"" . $this->Css_Cmp['css_others_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_others_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_complete()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['complete']) || $this->NM_cmp_hidden['complete'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->complete)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_complete_grid_line . "\"  style=\"" . $this->Css_Cmp['css_complete_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_complete_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 24;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'])
   {
       $this->NM_colspan++;
   }
   foreach ($this->NM_cmp_hidden as $Cmp => $Hidden)
   {
       if ($Hidden == "off")
       {
           $this->NM_colspan--;
       }
   }
 }
 function quebra_geral_sc_free_total_top() 
 {
   global $nm_saida; 
   if (isset($this->NM_tbody_open) && $this->NM_tbody_open)
   {
       $nm_saida->saida("    </TBODY>");
   }
   $this->NM_calc_span();
    $nm_saida->saida("<tr>\r\n");
    $nm_saida->saida("<td class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . "; height: 20px;\">&nbsp;</td>\r\n");
    $nm_saida->saida("<td class=\"" . $this->css_scGridTotal . "\" style=\"height: 20px;\" colspan=\"" . ($this->NM_colspan - 1) . "\">&nbsp;</td>\r\n");
    $nm_saida->saida("</tr>\r\n");
 }
 function quebra_geral_sc_free_total_bot() 
 {
   global 
          $nm_saida, $nm_data; 
   $this->Tot->quebra_geral_sc_free_total(); 
   $NM_cmp_tot['kickoffmeeting']['S'] = 2;
   $NM_cmp_tot['survey']['S'] = 3;
   $NM_cmp_tot['rab_apd_kml']['S'] = 4;
   $NM_cmp_tot['njki_justifikasi_nodin']['S'] = 5;
   $NM_cmp_tot['perijinan']['S'] = 6;
   $NM_cmp_tot['deliverymaterial']['S'] = 7;
   $NM_cmp_tot['bctr']['S'] = 8;
   $NM_cmp_tot['gelarhdpetanamtiang']['S'] = 9;
   $NM_cmp_tot['gelarkabel']['S'] = 10;
   $NM_cmp_tot['pasangterminalterminasijumperodf']['S'] = 11;
   $NM_cmp_tot['pasangterminalterminasjumperodc']['S'] = 12;
   $NM_cmp_tot['pasangterminalodp']['S'] = 13;
   $NM_cmp_tot['terminasiodp']['S'] = 14;
   $NM_cmp_tot['testcomm']['S'] = 15;
   $NM_cmp_tot['ujiterima']['S'] = 16;
   $NM_cmp_tot['bautrekon']['S'] = 17;
   $NM_cmp_tot['amandemenbast']['S'] = 18;
   $NM_cmp_tot['grir']['S'] = 19;
   $NM_cmp_tot['newentry']['S'] = 20;
   $NM_cmp_tot['inprogress']['S'] = 21;
   $NM_cmp_tot['others']['S'] = 22;
   $NM_cmp_tot['complete']['S'] = 23;
   $NM_tipos_tot = array('S' => '' . $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . '');
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf" && !$this->Print_All)
   {
      $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" .  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][0] . "</H1></div>";
   }
   $tit_lin_sumariza      =  $nm_nivel_book_pdf . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][0] . "(" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][1] . ")";
   $tit_lin_sumariza_orig =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][0] . "(" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][1] . ")";
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
   $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra  . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
  $prim_lin_tit = true;
  foreach ($NM_tipos_tot as $Tipo_Sum => $Tit_sum)
  {
   if (!$prim_lin_tit)
   {
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
       $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   }
   $prim_lin_tit = false;
   $tit_lin_sumariza_atu = $tit_lin_sumariza . "&nbsp;-&nbsp;" . $Tit_sum;
   $colspan  = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'])
   {
       $colspan++;
   }
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "tp_witel" && (!isset($this->NM_cmp_hidden['tp_witel']) || $this->NM_cmp_hidden['tp_witel'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "kickoffmeeting" && (!isset($this->NM_cmp_hidden['kickoffmeeting']) || $this->NM_cmp_hidden['kickoffmeeting'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['kickoffmeeting'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['kickoffmeeting'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_kickoffmeeting_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_kickoffmeeting_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "survey" && (!isset($this->NM_cmp_hidden['survey']) || $this->NM_cmp_hidden['survey'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['survey'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['survey'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_survey_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_survey_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "rab_apd_kml" && (!isset($this->NM_cmp_hidden['rab_apd_kml']) || $this->NM_cmp_hidden['rab_apd_kml'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['rab_apd_kml'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['rab_apd_kml'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_rab_apd_kml_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_rab_apd_kml_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "njki_justifikasi_nodin" && (!isset($this->NM_cmp_hidden['njki_justifikasi_nodin']) || $this->NM_cmp_hidden['njki_justifikasi_nodin'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['njki_justifikasi_nodin'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['njki_justifikasi_nodin'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_njki_justifikasi_nodin_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_njki_justifikasi_nodin_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "perijinan" && (!isset($this->NM_cmp_hidden['perijinan']) || $this->NM_cmp_hidden['perijinan'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['perijinan'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['perijinan'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_perijinan_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_perijinan_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "deliverymaterial" && (!isset($this->NM_cmp_hidden['deliverymaterial']) || $this->NM_cmp_hidden['deliverymaterial'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['deliverymaterial'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['deliverymaterial'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_deliverymaterial_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_deliverymaterial_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "bctr" && (!isset($this->NM_cmp_hidden['bctr']) || $this->NM_cmp_hidden['bctr'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['bctr'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['bctr'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_bctr_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_bctr_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "gelarhdpetanamtiang" && (!isset($this->NM_cmp_hidden['gelarhdpetanamtiang']) || $this->NM_cmp_hidden['gelarhdpetanamtiang'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['gelarhdpetanamtiang'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['gelarhdpetanamtiang'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_gelarhdpetanamtiang_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_gelarhdpetanamtiang_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "gelarkabel" && (!isset($this->NM_cmp_hidden['gelarkabel']) || $this->NM_cmp_hidden['gelarkabel'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['gelarkabel'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['gelarkabel'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_gelarkabel_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_gelarkabel_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "pasangterminalterminasijumperodf" && (!isset($this->NM_cmp_hidden['pasangterminalterminasijumperodf']) || $this->NM_cmp_hidden['pasangterminalterminasijumperodf'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['pasangterminalterminasijumperodf'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['pasangterminalterminasijumperodf'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_pasangterminalterminasijumperodf_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_pasangterminalterminasijumperodf_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "pasangterminalterminasjumperodc" && (!isset($this->NM_cmp_hidden['pasangterminalterminasjumperodc']) || $this->NM_cmp_hidden['pasangterminalterminasjumperodc'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['pasangterminalterminasjumperodc'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['pasangterminalterminasjumperodc'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_pasangterminalterminasjumperodc_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_pasangterminalterminasjumperodc_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "pasangterminalodp" && (!isset($this->NM_cmp_hidden['pasangterminalodp']) || $this->NM_cmp_hidden['pasangterminalodp'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['pasangterminalodp'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['pasangterminalodp'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_pasangterminalodp_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_pasangterminalodp_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "terminasiodp" && (!isset($this->NM_cmp_hidden['terminasiodp']) || $this->NM_cmp_hidden['terminasiodp'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['terminasiodp'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['terminasiodp'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_terminasiodp_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_terminasiodp_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "testcomm" && (!isset($this->NM_cmp_hidden['testcomm']) || $this->NM_cmp_hidden['testcomm'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['testcomm'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['testcomm'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_testcomm_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_testcomm_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "ujiterima" && (!isset($this->NM_cmp_hidden['ujiterima']) || $this->NM_cmp_hidden['ujiterima'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['ujiterima'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['ujiterima'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_ujiterima_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_ujiterima_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "bautrekon" && (!isset($this->NM_cmp_hidden['bautrekon']) || $this->NM_cmp_hidden['bautrekon'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['bautrekon'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['bautrekon'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_bautrekon_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_bautrekon_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "amandemenbast" && (!isset($this->NM_cmp_hidden['amandemenbast']) || $this->NM_cmp_hidden['amandemenbast'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['amandemenbast'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['amandemenbast'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_amandemenbast_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_amandemenbast_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "grir" && (!isset($this->NM_cmp_hidden['grir']) || $this->NM_cmp_hidden['grir'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['grir'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['grir'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_grir_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_grir_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "newentry" && (!isset($this->NM_cmp_hidden['newentry']) || $this->NM_cmp_hidden['newentry'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['newentry'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['newentry'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_newentry_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_newentry_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "inprogress" && (!isset($this->NM_cmp_hidden['inprogress']) || $this->NM_cmp_hidden['inprogress'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['inprogress'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['inprogress'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_inprogress_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_inprogress_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "others" && (!isset($this->NM_cmp_hidden['others']) || $this->NM_cmp_hidden['others'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['others'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['others'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_others_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_others_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "complete" && (!isset($this->NM_cmp_hidden['complete']) || $this->NM_cmp_hidden['complete'] != "off"))
    {
      if ($colspan > 0)
      {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo = "&nbsp;"; 
      if (isset($NM_cmp_tot['complete'][$Tipo_Sum]))
      {
          $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['tot_geral'][$NM_cmp_tot['complete'][$Tipo_Sum]] ; 
          if ($Tipo_Sum == "C" || $Tipo_Sum == "D")
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          }
          else
          {
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          }
      }
          $NM_css_field =  ""; 
      if ($Tipo_Sum == "S") {$NM_css_field = " css_complete_S_tot_ger";} 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_complete_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
   }
   if ($colspan > 0)
   {
          $NM_css_field = ""; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\"   " . "colspan=\"" . $colspan . "\"" . ">&nbsp;</TD>\r\n");
   }
       $nm_saida->saida("    </TR>\r\n");
    $tit_lin_sumariza = "<span style='opacity: 0;'>" . $tit_lin_sumariza_orig . "</span>";
   }
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
   function nmgp_barra_top_normal()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn = false;
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_top\" name=\"F0_top\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_top\" name=\"sc_truta_f0_top\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_top\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=hidden id=\"script_session_f0_top\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/>\r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_top\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr>\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print") 
      {
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0')", "nm_gp_move('xls', '0')", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "v_dashboard_lop/v_dashboard_lop_config_print.php?nm_opc=AM&nm_cor=AM&language=en_us&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&KeepThis=true&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_Ind_Groupby'] != "sc_free_total")
        {
        }
          if (is_file("v_dashboard_lop_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("v_dashboard_lop_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'])
      {
         if ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='$nm_url_saida'; document.F5.submit()", "document.F5.action='$nm_url_saida'; document.F5.submit()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
         elseif (!$this->Ini->SC_Link_View && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.F5.action='$nm_url_saida'; document.F5.submit()", "document.F5.action='$nm_url_saida'; document.F5.submit()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
      }
      elseif ($this->nmgp_botoes['exit'] == "on")
      {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_modal'])
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove()", "self.parent.tb_remove()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
        }
        else
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "window.close()", "window.close()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
        }
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'] && $this->force_toolbar)
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_top', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'] && $this->force_toolbar)
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_bot_normal()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn = false;
      $this->NM_calc_span();
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_bot\" name=\"F0_bot\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_bot\" name=\"sc_truta_f0_bot\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_bot\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=hidden id=\"script_session_f0_bot\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/>\r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_bot\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr>\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print") 
      {
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'];
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "birpara", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav)", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav)", "brec_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $Page_Atu   = ceil($this->nmgp_reg_inicial / $Reg_Page);
              $nm_saida->saida("          <input id=\"rec_f0_bot\" type=\"text\" class=\"" . $this->css_css_toolbar_obj . "\" name=\"rec\" value=\"" . NM_encode_input($Page_Atu) . "\" style=\"width:25px;vertical-align: middle;\"/> \r\n");
              $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['qtline'] == "on" && $this->Ini->Apl_paginacao != "FULL")
          {
              $nm_saida->saida("          <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
              $nm_saida->saida("          <select class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" id=\"quant_linhas_f0_bot\" name=\"nmgp_quant_linhas\" onchange=\"sc_ind = document.getElementById('quant_linhas_f0_bot').selectedIndex; nm_gp_submit_ajax('muda_qt_linhas', document.getElementById('quant_linhas_f0_bot').options[sc_ind].value)\"> \r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] == 10) ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] == 20) ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] == 50) ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']))
          {
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio_off", "nm_gp_submit_rec('ini')", "nm_gp_submit_rec('ini')", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini')", "nm_gp_submit_rec('ini')", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']))
          {
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna_off", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'];
              $Max_link   = 5;
              $Mid_link   = ceil($Max_link / 2);
              $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
              $Qtd_Pages  = ceil($this->count_ger / $Reg_Page);
              $Page_Atu   = ceil($this->nmgp_reg_final / $Reg_Page);
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
                      $nm_saida->saida("            <span class=\"scGridToolbarNavOpen\" style=\"vertical-align: middle;\">" . $Link_ini . "</span>\r\n");
                  }
                  else
                  {
                      $nm_saida->saida("            <a class=\"scGridToolbarNav\" style=\"vertical-align: middle;\" href=\"javascript: nm_gp_submit_rec(" . $rec . ")\">" . $Link_ini . "</a>\r\n");
                  }
                  $Link_ini++;
                  if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
                  {
                      $nm_saida->saida("            <img src=\"" . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
                  }
              }
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim')", "nm_gp_submit_rec('fim')", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if (is_file("v_dashboard_lop_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("v_dashboard_lop_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_bot', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_top_mobile()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn = false;
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_top\" name=\"F0_top\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_top\" name=\"sc_truta_f0_top\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_top\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=hidden id=\"script_session_f0_top\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/>\r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_top\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr>\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print") 
      {
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0')", "nm_gp_move('xls', '0')", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "v_dashboard_lop/v_dashboard_lop_config_print.php?nm_opc=AM&nm_cor=AM&language=en_us&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&KeepThis=true&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['SC_Ind_Groupby'] != "sc_free_total")
        {
        }
          if (is_file("v_dashboard_lop_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("v_dashboard_lop_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_psq'])
      {
         if ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='$nm_url_saida'; document.F5.submit()", "document.F5.action='$nm_url_saida'; document.F5.submit()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
         elseif (!$this->Ini->SC_Link_View && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.F5.action='$nm_url_saida'; document.F5.submit()", "document.F5.action='$nm_url_saida'; document.F5.submit()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
      }
      elseif ($this->nmgp_botoes['exit'] == "on")
      {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_modal'])
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove()", "self.parent.tb_remove()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
        }
        else
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "window.close()", "window.close()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
        }
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'] && $this->force_toolbar)
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_top', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'] && $this->force_toolbar)
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_bot_mobile()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn = false;
      $this->NM_calc_span();
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_bot\" name=\"F0_bot\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_bot\" name=\"sc_truta_f0_bot\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_bot\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=hidden id=\"script_session_f0_bot\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/>\r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_bot\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr>\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_bot\"  colspan=3 class=\"" . $this->css_scGridTabelaTd . "\" valign=\"top\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print") 
      {
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'];
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "birpara", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav)", "var rec_nav = ((document.getElementById('rec_f0_bot').value - 1) * " . NM_encode_input($Reg_Page) . ") + 1; nm_gp_submit_ajax('muda_rec_linhas', rec_nav)", "brec_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $Page_Atu   = ceil($this->nmgp_reg_inicial / $Reg_Page);
              $nm_saida->saida("          <input id=\"rec_f0_bot\" type=\"text\" class=\"" . $this->css_css_toolbar_obj . "\" name=\"rec\" value=\"" . NM_encode_input($Page_Atu) . "\" style=\"width:25px;vertical-align: middle;\"/> \r\n");
              $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['qtline'] == "on" && $this->Ini->Apl_paginacao != "FULL")
          {
              $nm_saida->saida("          <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border: 0px;vertical-align: middle;\">" . $this->Ini->Nm_lang['lang_btns_rows'] . "</span>\r\n");
              $nm_saida->saida("          <select class=\"" . $this->css_css_toolbar_obj . "\" style=\"vertical-align: middle;\" id=\"quant_linhas_f0_bot\" name=\"nmgp_quant_linhas\" onchange=\"sc_ind = document.getElementById('quant_linhas_f0_bot').selectedIndex; nm_gp_submit_ajax('muda_qt_linhas', document.getElementById('quant_linhas_f0_bot').options[sc_ind].value)\"> \r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] == 10) ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] == 20) ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] == 50) ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']))
          {
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio_off", "nm_gp_submit_rec('ini')", "nm_gp_submit_rec('ini')", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_inicio", "nm_gp_submit_rec('ini')", "nm_gp_submit_rec('ini')", "first_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']))
          {
              if ($this->Rec_ini == 0)
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna_off", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
              else
              {
                  $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_retorna", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "nm_gp_submit_rec('" . $this->Rec_ini . "')", "back_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                  $nm_saida->saida("           $Cod_Btn \r\n");
              }
                  $NM_btn = true;
          }
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['qt_lin_grid'];
              $Max_link   = 5;
              $Mid_link   = ceil($Max_link / 2);
              $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
              $Qtd_Pages  = ceil($this->count_ger / $Reg_Page);
              $Page_Atu   = ceil($this->nmgp_reg_final / $Reg_Page);
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
                      $nm_saida->saida("            <span class=\"scGridToolbarNavOpen\" style=\"vertical-align: middle;\">" . $Link_ini . "</span>\r\n");
                  }
                  else
                  {
                      $nm_saida->saida("            <a class=\"scGridToolbarNav\" style=\"vertical-align: middle;\" href=\"javascript: nm_gp_submit_rec(" . $rec . ")\">" . $Link_ini . "</a>\r\n");
                  }
                  $Link_ini++;
                  if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
                  {
                      $nm_saida->saida("            <img src=\"" . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . "\" align=\"absmiddle\" style=\"vertical-align: middle;\">\r\n");
                  }
              }
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim')", "nm_gp_submit_rec('fim')", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if (is_file("v_dashboard_lop_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("v_dashboard_lop_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_bot', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
          $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_top()
   {
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_barra_top_mobile();
       }
       else
       {
           $this->nmgp_barra_top_normal();
       }
   }
   function nmgp_barra_bot()
   {
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_barra_bot_mobile();
       }
       else
       {
           $this->nmgp_barra_bot_normal();
       }
   }
   function nmgp_embbed_placeholder_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function nmgp_embbed_placeholder_bot()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_bot\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td colspan=3>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
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
 function check_btns()
 {
 }
 function nm_fim_grid($flag_apaga_pdf_log = TRUE)
 {
   global
   $nm_saida, $nm_url_saida, $NMSC_modal;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
        return;
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" &&
        $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao_print'] != "print" && !$this->Print_All) 
   { 
      $nm_saida->saida("     <tr><td colspan=3  class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\"> \r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_B_v_dashboard_lop\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_B_v_dashboard_lop\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
      $nm_saida->saida("     </td></tr> \r\n");
   } 
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   <div id=\"sc-id-fixedheaders-placeholder\" style=\"display: none; position: fixed; top: 0\"></div>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['embutida'])
   { 
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']))
       {
           $temp = array();
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] as $NM_aplic => $resto)
           {
               $temp[] = $NM_aplic;
           }
           $temp = array_unique($temp);
           foreach ($temp as $NM_aplic)
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
               { 
                   $this->Ini->Arr_result['setArr'][] = array('var' => ' NM_tab_' . $NM_aplic, 'value' => '');
               } 
               $nm_saida->saida("   NM_tab_" . $NM_aplic . " = new Array();\r\n");
           }
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] as $NM_aplic => $resto)
           {
               foreach ($resto as $NM_ind => $NM_quebra)
               {
                   foreach ($NM_quebra as $NM_nivel => $NM_tipo)
                   {
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
                       { 
                           $this->Ini->Arr_result['setVar'][] = array('var' => ' NM_tab_' . $NM_aplic . '[' . $NM_ind . ']', 'value' => $NM_tipo . $NM_nivel);
                       } 
                       $nm_saida->saida("   NM_tab_" . $NM_aplic . "[" . $NM_ind . "] = '" . $NM_tipo . $NM_nivel . "';\r\n");
                   }
               }
           }
       }
   }
   $nm_saida->saida("   function NM_liga_tbody(tbody, Obj, Apl)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      Nivel = parseInt (Obj[tbody].substr(3));\r\n");
   $nm_saida->saida("      for (ind = tbody + 1; ind < Obj.length; ind++)\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("           Nv = parseInt (Obj[ind].substr(3));\r\n");
   $nm_saida->saida("           Tp = Obj[ind].substr(0, 3);\r\n");
   $nm_saida->saida("           if (Nivel == Nv && Tp == 'top')\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               break;\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           if (((Nivel + 1) == Nv && Tp == 'top') || (Nivel == Nv && Tp == 'bot'))\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.getElementById('tbody_' + Apl + '_' + ind + '_' + Tp).style.display='';\r\n");
   $nm_saida->saida("           } \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function NM_apaga_tbody(tbody, Obj, Apl)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      Nivel = Obj[tbody].substr(3);\r\n");
   $nm_saida->saida("      for (ind = tbody + 1; ind < Obj.length; ind++)\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("           Nv = Obj[ind].substr(3);\r\n");
   $nm_saida->saida("           Tp = Obj[ind].substr(0, 3);\r\n");
   $nm_saida->saida("           if ((Nivel == Nv && Tp == 'top') || Nv < Nivel)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               break;\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           if ((Nivel != Nv) || (Nivel == Nv && Tp == 'bot'))\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.getElementById('tbody_' + Apl + '_' + ind + '_' + Tp).style.display='none';\r\n");
   $nm_saida->saida("               if (Tp == 'top')\r\n");
   $nm_saida->saida("               {\r\n");
   $nm_saida->saida("                   document.getElementById('b_open_' + Apl + '_' + ind).style.display='';\r\n");
   $nm_saida->saida("                   document.getElementById('b_close_' + Apl + '_' + ind).style.display='none';\r\n");
   $nm_saida->saida("               } \r\n");
   $nm_saida->saida("           } \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   NM_obj_ant = '';\r\n");
   $nm_saida->saida("   function NM_apaga_div_lig(obj_nome)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      if (NM_obj_ant != '')\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_obj_ant.style.display='none';\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      obj = document.getElementById(obj_nome);\r\n");
   $nm_saida->saida("      NM_obj_ant = obj;\r\n");
   $nm_saida->saida("      ind_time = setTimeout(\"obj.style.display='none'\", 300);\r\n");
   $nm_saida->saida("      return ind_time;\r\n");
   $nm_saida->saida("   }\r\n");
   $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
   if (@is_file($str_pbfile) && $flag_apaga_pdf_log)
   {
      @unlink($str_pbfile);
   }
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   $nm_saida->saida("  $(window).scroll(function() {\r\n");
   $nm_saida->saida("   scSetFixedHeaders();\r\n");
   $nm_saida->saida("  }).resize(function() {\r\n");
   $nm_saida->saida("   scSetFixedHeaders();\r\n");
   $nm_saida->saida("  });\r\n");
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           if ($this->arr_buttons['bcons_avanca']['type'] != 'image')
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca_off']['style']);
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
                   }
               } 
           } 
           else 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
               }
           } 
           if ($this->arr_buttons['bcons_final']['type'] != 'image')
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final_off']['style']);
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
                   }
               } 
           } 
           else 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
               }
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           if ($this->arr_buttons['bcons_avanca']['type'] != 'image')
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca_off']['style']);
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
                   }
               } 
           } 
           else 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
               }
           } 
           if ($this->arr_buttons['bcons_final']['type'] != 'image')
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final_off']['style']);
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
                   }
               } 
           } 
           else 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
               }
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "");
       }
   }
   if (isset($this->redir_modal) && !empty($this->redir_modal))
   {
       echo $this->redir_modal;
   }
   $nm_saida->saida("   </script>\r\n");
   if ($this->grid_emb_form || $this->grid_emb_form_full)
   {
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("      parent.scAjaxDetailHeight('v_dashboard_lop', $(document).innerHeight());\r\n");
       $nm_saida->saida("   </script>\r\n");
   }
   $nm_saida->saida("   </HTML>\r\n");
 }
//--- 
//--- 
 function form_navegacao()
 {
   global
   $nm_saida, $nm_url_saida;
   $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
   $nm_saida->saida("   <form name=\"F3\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_chave\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_ordem\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"v_dashboard_lop\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parm_acum\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_quant_linhas\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_url_saida\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_outra_jan\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_orig_pesq\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F4\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"rec\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"rec\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_call_php\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F5\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"v_dashboard_lop_pesq.class.php\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fprint\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"v_dashboard_lop_iframe_prt.php\" \r\n");
   $nm_saida->saida("                     target=\"jan_print\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"path_botoes\" value=\"" . $this->Ini->path_botoes . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"tp_print\" value=\"AM\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"cor_print\" value=\"AM\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("  <form name=\"Fdoc_word\" method=\"post\" \r\n");
   $nm_saida->saida("        action=\"./\" \r\n");
   $nm_saida->saida("        target=\"_self\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"doc_word\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_word\" value=\"AM\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_navegator_print\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\"> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("    document.Fdoc_word.nmgp_navegator_print.value = navigator.appName;\r\n");
   $nm_saida->saida("   function nm_gp_word_conf(cor)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
   $nm_saida->saida("       document.Fdoc_word.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   var obj_tr      = \"\";\r\n");
   $nm_saida->saida("   var css_tr      = \"\";\r\n");
   $nm_saida->saida("   var field_over  = " . $this->NM_field_over . ";\r\n");
   $nm_saida->saida("   var field_click = " . $this->NM_field_click . ";\r\n");
   $nm_saida->saida("   function over_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_over != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj.className = '" . $this->css_scGridFieldOver . "';\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function out_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_over != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj.className = class_obj;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function click_tr(obj, class_obj)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (field_click != 1)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (obj_tr != \"\")\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           obj_tr.className = css_tr;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       css_tr        = class_obj;\r\n");
   $nm_saida->saida("       if (obj_tr == obj)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           obj_tr     = '';\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       obj_tr        = obj;\r\n");
   $nm_saida->saida("       css_tr        = class_obj;\r\n");
   $nm_saida->saida("       obj.className = '" . $this->css_scGridFieldClick . "';\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   var tem_hint;\r\n");
   $nm_saida->saida("   function nm_mostra_hint(nm_obj, nm_evt, nm_mens)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (nm_mens == \"\")\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       tem_hint = true;\r\n");
   $nm_saida->saida("       if (document.layers)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           theString=\"<DIV CLASS='ttip'>\" + nm_mens + \"</DIV>\";\r\n");
   $nm_saida->saida("           document.tooltip.document.write(theString);\r\n");
   $nm_saida->saida("           document.tooltip.document.close();\r\n");
   $nm_saida->saida("           document.tooltip.left = nm_evt.pageX + 14;\r\n");
   $nm_saida->saida("           document.tooltip.top = nm_evt.pageY + 2;\r\n");
   $nm_saida->saida("           document.tooltip.visibility = \"show\";\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if(document.getElementById)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("              nmdg_nav = navigator.appName;\r\n");
   $nm_saida->saida("              elm = document.getElementById(\"tooltip\");\r\n");
   $nm_saida->saida("              elml = nm_obj;\r\n");
   $nm_saida->saida("              elm.innerHTML = nm_mens;\r\n");
   $nm_saida->saida("              if (nmdg_nav == \"Netscape\")\r\n");
   $nm_saida->saida("              {\r\n");
   $nm_saida->saida("                  elm.style.height = elml.style.height;\r\n");
   $nm_saida->saida("                  elm.style.top = nm_evt.pageY + 2 + 'px';\r\n");
   $nm_saida->saida("                  elm.style.left = nm_evt.pageX + 14 + 'px';\r\n");
   $nm_saida->saida("              }\r\n");
   $nm_saida->saida("              else\r\n");
   $nm_saida->saida("              {\r\n");
   $nm_saida->saida("                  elm.style.top = nm_evt.y + document.body.scrollTop + 10 + 'px';\r\n");
   $nm_saida->saida("                  elm.style.left = nm_evt.x + document.body.scrollLeft + 10 + 'px';\r\n");
   $nm_saida->saida("              }\r\n");
   $nm_saida->saida("              elm.style.visibility = \"visible\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_apaga_hint()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (!tem_hint)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           return;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       tem_hint = false;\r\n");
   $nm_saida->saida("       if (document.layers)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.tooltip.visibility = \"hidden\";\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if(document.getElementById)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("              elm.style.visibility = \"hidden\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   if ($this->Rec_ini == 0)
   {
       $nm_saida->saida("   nm_gp_ini = \"ini\";\r\n");
   }
   else
   {
       $nm_saida->saida("   nm_gp_ini = \"\";\r\n");
   }
   $nm_saida->saida("   nm_gp_rec_ini = \"" . $this->Rec_ini . "\";\r\n");
   $nm_saida->saida("   nm_gp_rec_fim = \"" . $this->Rec_fim . "\";\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['ajax_nav'])
   {
       if ($this->Rec_ini == 0)
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_ini', 'value' => "ini");
       }
       else
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_ini', 'value' => "");
       }
       $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_rec_ini', 'value' => $this->Rec_ini);
       $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_rec_fim', 'value' => $this->Rec_fim);
   }
   $nm_saida->saida("   function nm_gp_submit_rec(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (nm_gp_ini == \"ini\" && (campo == \"ini\" || campo == nm_gp_rec_ini)) \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          return; \r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      if (nm_gp_fim == \"fim\" && (campo == \"fim\" || campo == nm_gp_rec_fim)) \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          return; \r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      nm_gp_submit_ajax(\"rec\", campo); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit_ajax(opc, parm) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      return ajax_navigate(opc, parm); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit2(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      nm_gp_submit_ajax(\"ordem\", campo); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit3(parms, parm_acum, opc, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F3.target               = \"_self\"; \r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parm_acum.value = parm_acum ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_opcao.value     = opc ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = \"\";\r\n");
   $nm_saida->saida("      document.F3.action               = \"./\"  ;\r\n");
   $nm_saida->saida("      if (ancor != null) {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit4(apl_lig, apl_saida, parms, target, opc, apl_name, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F3.target = target; \r\n");
   $nm_saida->saida("      if (\"dbifrm_widget\" == target.substr(0, 13)) {\r\n");
   $nm_saida->saida("          var targetIframe = $(parent.document).find(\"[name='\" + target + \"']\");\r\n");
   $nm_saida->saida("          apl_lig = parent.scIframeSCInit && parent.scIframeSCInit[target] ? addUrlParam(apl_lig, \"script_case_init\", parent.scIframeSCInit[target]) : apl_lig;\r\n");
   $nm_saida->saida("          targetIframe.attr(\"src\", apl_lig);\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.action = apl_lig  ;\r\n");
   $nm_saida->saida("      if (opc == 'igual' || opc == 'novo') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = opc;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      if (opc != null && opc != '') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"igual\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value   = apl_saida ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value       = parms ;\r\n");
   $nm_saida->saida("      if (target == '_blank') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("          window.open('','jan_sc','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (ancor != null && target == '_self') {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w, m_confirm, apl_name, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      parms = parms.replace(/@percent@/g, \"%\"); \r\n");
   $nm_saida->saida("      if (m_confirm != null && m_confirm != '') \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          if (confirm(m_confirm))\r\n");
   $nm_saida->saida("          { }\r\n");
   $nm_saida->saida("          else\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("             return;\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (apl_lig.substr(0, 7) == \"http://\" || apl_lig.substr(0, 8) == \"https://\")\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          if (target == '_blank') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.open (apl_lig);\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          else\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.location = apl_lig;\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          return;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (target == 'modal' || target == 'modal_rpdf') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          par_modal = '?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nmgp_outra_jan=true&nmgp_url_saida=modal&SC_lig_apl_orig=v_dashboard_lop';\r\n");
   $nm_saida->saida("          if (opc != null && opc != '') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              par_modal += '&nmgp_opcao=grid';\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          if (parms != null && parms != '') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              par_modal += '&nmgp_parms=' + parms;\r\n");
   $nm_saida->saida("          }\r\n");
   $Sc_parent = "";
   if ($this->grid_emb_form || $this->grid_emb_form_full)
   {
       $Sc_parent = "parent.";
   }
   $nm_saida->saida("          if (target == 'modal') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("               " . $Sc_parent . "tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          else \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("               " . $Sc_parent . "tb_show('', apl_lig + par_modal + '&TB_iframe=true&height=' + modal_h + '&width=' + modal_w, '');\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          return;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.target = target; \r\n");
   $nm_saida->saida("      if (target == '_blank') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_ancor_ult_lig = ancor;\r\n");
   $nm_saida->saida("          document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
   $nm_saida->saida("          window.open('','jan_sc','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("          document.F3.target = \"jan_sc\"; \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (\"dbifrm_widget\" == target.substr(0, 13)) {\r\n");
   $nm_saida->saida("          var targetIframe = $(parent.document).find(\"[name='\" + target + \"']\");\r\n");
   $nm_saida->saida("          apl_lig = parent.scIframeSCInit && parent.scIframeSCInit[target] ? addUrlParam(apl_lig, \"script_case_init\", parent.scIframeSCInit[target]) : apl_lig;\r\n");
   $nm_saida->saida("          targetIframe.attr(\"src\", apl_lig);\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.action = apl_lig;\r\n");
   $nm_saida->saida("      if (opc != null && opc != '') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      if (ancor != null && target == '_self') {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      document.F3.nmgp_outra_jan.value   = \"\" ;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function addUrlParam(sUrl, sParam, sValue) {\r\n");
   $nm_saida->saida("           var baseUrl, urlParams = [], objParams = {}, tmp, i;\r\n");
   $nm_saida->saida("           tmp = sUrl.split(\"?\");\r\n");
   $nm_saida->saida("           baseUrl = tmp[0];\r\n");
   $nm_saida->saida("           if (tmp[1]) {\r\n");
   $nm_saida->saida("                   urlParams = tmp[1].split(\"&\");\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           for (i = 0; i < urlParams.length; i++) {\r\n");
   $nm_saida->saida("                   tmp = urlParams[i].split(\"=\");\r\n");
   $nm_saida->saida("                   objParams[ tmp[0] ] = tmp[1] ? tmp[1] : \"\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           objParams[sParam] = sValue;\r\n");
   $nm_saida->saida("           urlParams = [];\r\n");
   $nm_saida->saida("           for (tmp in objParams) {\r\n");
   $nm_saida->saida("                   urlParams.push(tmp + \"=\" + objParams[tmp]);\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           return baseUrl + \"?\" + urlParams.join(\"&\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_submit6(apl_lig, apl_saida, parms, target, pos, alt, larg, opc, modal_h, modal_w, m_confirm, apl_name, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (apl_lig.substr(0, 7) == \"http://\" || apl_lig.substr(0, 8) == \"https://\")\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          if (target == '_blank') \r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.open (apl_lig);\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          else\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              window.location = apl_lig;\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("          return;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      if (pos == \"A\") {obj = document.getElementById('nmsc_iframe_liga_A_v_dashboard_lop');} \r\n");
   $nm_saida->saida("      if (pos == \"B\") {obj = document.getElementById('nmsc_iframe_liga_B_v_dashboard_lop');} \r\n");
   $nm_saida->saida("      if (pos == \"E\") {obj = document.getElementById('nmsc_iframe_liga_E_v_dashboard_lop');} \r\n");
   $nm_saida->saida("      if (pos == \"D\") {obj = document.getElementById('nmsc_iframe_liga_D_v_dashboard_lop');} \r\n");
   $nm_saida->saida("      obj.style.height = (alt == parseInt(alt)) ? alt + 'px' : alt;\r\n");
   $nm_saida->saida("      obj.style.width  = (larg == parseInt(larg)) ? larg + 'px' : larg;\r\n");
   $nm_saida->saida("      document.F3.target = target; \r\n");
   $nm_saida->saida("      document.F3.action = apl_lig  ;\r\n");
   $nm_saida->saida("      if (opc != null && opc != '') \r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          document.F3.nmgp_opcao.value = \"\" ;\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      if (ancor != null && target == '_self') {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_submit_modal(parms, t_parent) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (t_parent == 'S' && typeof parent.tb_show == 'function')\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("           parent.tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("         tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_move(tipo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F6.target = \"_self\"; \r\n");
   $nm_saida->saida("      document.F6.submit() ;\r\n");
   $nm_saida->saida("      return;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_move(x, y, z, p, g, crt) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       document.F3.action           = \"./\"  ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_parms.value = \"SC_null\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_orig_pesq.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_url_saida.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_opcao.value = x; \r\n");
   $nm_saida->saida("       document.F3.nmgp_outra_jan.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.target = \"_self\"; \r\n");
   $nm_saida->saida("       if (y == 1) \r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.target = \"_blank\"; \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (\"busca\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.nmgp_orig_pesq.value = z; \r\n");
   $nm_saida->saida("           z = '';\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (z != null && z != '') \r\n");
   $nm_saida->saida("       { \r\n");
   $nm_saida->saida("           document.F3.nmgp_tipo_pdf.value = z; \r\n");
   $nm_saida->saida("       } \r\n");
   $nm_saida->saida("       if (\"xls\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   if (!extension_loaded("zip"))
   {
       $nm_saida->saida("           alert (\"" . html_entity_decode($this->Ini->Nm_lang['lang_othr_prod_xtzp'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\");\r\n");
       $nm_saida->saida("           return false;\r\n");
   } 
   $nm_saida->saida("       }\r\n");
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['v_dashboard_lop_iframe_params'] = array(
       'str_tmp'    => $this->Ini->path_imag_temp,
       'str_prod'   => $this->Ini->path_prod,
       'str_btn'    => $this->Ini->Str_btn_css,
       'str_lang'   => $this->Ini->str_lang,
       'str_schema' => $this->Ini->str_schema_all,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?script_case_session?#?" . session_id() . "?@?pbfile?#?" . $str_pbfile . "?@?jspath?#?" . $this->Ini->path_js . "?@?sc_apbgcol?#?" . $this->Ini->path_css . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_dashboard_lop@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
   $nm_saida->saida("       if (\"pdf\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           window.location = \"" . $this->Ini->path_link . "v_dashboard_lop/v_dashboard_lop_iframe.php?nmgp_parms=" . $Md5_pdf . "&sc_tp_pdf=\" + z + \"&sc_parms_pdf=\" + p + \"&sc_create_charts=\" + crt + \"&sc_graf_pdf=\" + g;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if ((x == 'igual' || x == 'edit') && NM_ancor_ult_lig != \"\")\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("                ajax_save_ancor(\"F3\", NM_ancor_ult_lig);\r\n");
   $nm_saida->saida("                NM_ancor_ult_lig = \"\";\r\n");
   $nm_saida->saida("            } else {\r\n");
   $nm_saida->saida("                document.F3.submit() ;\r\n");
   $nm_saida->saida("            } \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_print_conf(tp, cor)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.Fprint.tp_print.value = tp;\r\n");
   $nm_saida->saida("       document.Fprint.cor_print.value = cor;\r\n");
   $nm_saida->saida("       window.open('','jan_print','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("       document.Fprint.submit() ;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   nm_img = new Image();\r\n");
   $nm_saida->saida("   function nm_mostra_img(imagem, altura, largura)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       tb_show(\"\", imagem, \"\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_mostra_doc(campo1, campo2)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (campo2 + \"?nmgp_parms=\" + campo1, \"ScriptCase\", \"resizable\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_escreve_window()\r\n");
   $nm_saida->saida("   {\r\n");
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['v_dashboard_lop']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Doc = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Doc = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Doc = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['campo_psq_ret'] . "\");\r\n");
          $nm_saida->saida("          }\r\n");
      }
          $nm_saida->saida("          else\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = null;\r\n");
          $nm_saida->saida("          }\r\n");
      $nm_saida->saida("          if (Obj_Form.value != document.Fpesq.nm_ret_psq.value)\r\n");
      $nm_saida->saida("          {\r\n");
      $nm_saida->saida("              Obj_Form.value = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              if (null != Obj_Readonly)\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Readonly.innerHTML = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              }\r\n");
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['js_apos_busca'] . "();\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              else if (Obj_Form.onchange && Obj_Form.onchange != '')\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form.onchange();\r\n");
      $nm_saida->saida("              }\r\n");
     }
     else
     {
      $nm_saida->saida("              if (Obj_Form.onchange && Obj_Form.onchange != '')\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form.onchange();\r\n");
      $nm_saida->saida("              }\r\n");
     }
      $nm_saida->saida("          }\r\n");
      $nm_saida->saida("      }\r\n");
   }
   $nm_saida->saida("      document.F5.action = \"v_dashboard_lop_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_dashboard_lop']['reg_start']))
   {
       $nm_saida->saida("      parent.scAjaxDetailStatus('v_dashboard_lop');\r\n");
       $nm_saida->saida("      parent.scAjaxDetailHeight('v_dashboard_lop', $(document).innerHeight());\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
}
?>
