<?php
class list_project_inwitel_grid
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
   var $prepare;
   var $perijinan;
   var $inst_testcomm;
   var $closing;
   var $tp_id;
   var $tp_thn_release;
   var $tp_releasename;
   var $tp_batch;
   var $tp_idlop;
   var $mw_namawitel;
   var $md_namadatel;
   var $ms_namasto;
   var $statusname;
   var $tm_namamitra;
   var $tp_projectname;
   var $tj_namajenis;
   var $tp_lokasi;
   var $tp_odp;
   var $tp_planstart;
   var $tp_planfinish;
   var $tp_targetwaktu;
   var $tp_prosentase;
   var $tp_mitra;
   var $tp_witel;
   var $tp_sto;
   var $tp_entrydate;
   var $tp_entryby;
   var $tp_updatedate;
   var $tp_updateby;
   var $tp_summary;
   var $tp_status;
   var $tp_actualstart;
   var $tp_actualfinish;
   var $tp_templateproject;
   var $tp_jenisproject;
   var $tp_prjtrelease;
   var $tp_datel;
   var $templatename;
   var $tp_nokontrak;
   var $tp_ponumber;
   var $v_resume_detailproject;
   var $NM_cont_emb_linha;
//--- 
 function monta_grid($linhas = 0)
 {
   global $script_case_init, $nm_saida;
   $GLOBALS["script_case_init"] = $this->Ini->sc_page;

   clearstatcache();
   $this->NM_cor_embutida();
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['usr_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (!is_file($this->Ini->link_v_resume_detailproject_cons_emb))
   {
       $this->NM_cmp_hidden['detaiil'] = "off";
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['embutida'] = true;
       $_SESSION['scriptcase']['v_resume_detailproject']['protect_modal'] = $this->Ini->sc_page;
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['exibe_titulos'] = "S";
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['exibe_total'] = "S";
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['exibe_seq'] = "S";
       include_once ($this->Ini->link_v_resume_detailproject_cons_emb);
       $this->v_resume_detailproject = new v_resume_detailproject_apl ;
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['embutida'] = false;
       unset($_SESSION['scriptcase']['v_resume_detailproject']['protect_modal']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
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
       $nmgrp_apl_opcao= (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['list_project_inwitel'])) ? "pdf" : $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'];
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
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf")
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "igual";
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'];
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
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "list_project_inwitel/list_project_inwitel_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = trim(substr($cada_css, 1, $Pos1 - 1));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['doc_word'])
       { 
           $this->Css_Cmp[$Tag] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag] = "";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['Lig_Md5'] = array();
   }
   $this->force_toolbar = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['force_toolbar']);
   } 
   $this->width_tabula_quebra  = "0px";
   $this->width_tabula_display = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View || $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq'])
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['mostra_edit'] = "N";
   }
   $this->NM_cont_emb_linha = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['emb_linha'];
   $this->NM_cont_body   = 0; 
   $this->NM_emb_tree_no = false; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ind_tree'] = 0;
   }
   elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['emb_tree_no']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['emb_tree_no'])
   { 
       $this->NM_emb_tree_no = true; 
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("list_project_inwitel", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->nmgp_botoes['first'] = "on";
   $this->nmgp_botoes['back'] = "on";
   $this->nmgp_botoes['forward'] = "on";
   $this->nmgp_botoes['last'] = "on";
   $this->nmgp_botoes['filter'] = "on";
   $this->nmgp_botoes['pdf'] = "on";
   $this->nmgp_botoes['xls'] = "on";
   $this->nmgp_botoes['goto'] = "on";
   $this->nmgp_botoes['qtline'] = "on";
   $this->nmgp_botoes['navpage'] = "on";
   $this->nmgp_botoes['summary'] = "on";
   $this->nmgp_botoes['sel_col'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   $this->Cmps_ord_def['TP_ID'] = " asc";
   $this->Cmps_ord_def['TP_THN_RELEASE'] = " asc";
   $this->Cmps_ord_def['TP_RELEASENAME'] = " asc";
   $this->Cmps_ord_def['TP_BATCH'] = " asc";
   $this->Cmps_ord_def['TP_IDLOP'] = " asc";
   $this->Cmps_ord_def['MW_NAMAWITEL'] = " asc";
   $this->Cmps_ord_def['MD_NAMADATEL'] = " asc";
   $this->Cmps_ord_def['MS_NAMASTO'] = " asc";
   $this->Cmps_ord_def['STATUSNAME'] = " asc";
   $this->Cmps_ord_def['TM_NAMAMITRA'] = " asc";
   $this->Cmps_ord_def['TP_PROJECTNAME'] = " asc";
   $this->Cmps_ord_def['TJ_NAMAJENIS'] = " asc";
   $this->Cmps_ord_def['TP_LOKASI'] = " asc";
   $this->Cmps_ord_def['TP_ODP'] = " asc";
   $this->Cmps_ord_def['TP_PLANSTART'] = " asc";
   $this->Cmps_ord_def['TP_PLANFINISH'] = " asc";
   $this->Cmps_ord_def['TP_TARGETWAKTU'] = " asc";
   $this->Cmps_ord_def['TP_PROSENTASE'] = " asc";
   $this->Cmps_ord_def['TP_MITRA'] = " asc";
   $this->Cmps_ord_def['TP_WITEL'] = " asc";
   $this->Cmps_ord_def['TP_STO'] = " asc";
   $this->Cmps_ord_def['TP_ENTRYDATE'] = " asc";
   $this->Cmps_ord_def['TP_ENTRYBY'] = " asc";
   $this->Cmps_ord_def['TP_UPDATEDATE'] = " asc";
   $this->Cmps_ord_def['TP_UPDATEBY'] = " asc";
   $this->Cmps_ord_def['TP_SUMMARY'] = " asc";
   $this->Cmps_ord_def['TP_STATUS'] = " asc";
   $this->Cmps_ord_def['TP_ACTUALSTART'] = " asc";
   $this->Cmps_ord_def['TP_ACTUALFINISH'] = " asc";
   $this->Cmps_ord_def['TP_TEMPLATEPROJECT'] = " asc";
   $this->Cmps_ord_def['TP_JENISPROJECT'] = " asc";
   $this->Cmps_ord_def['TP_PRJTRELEASE'] = " asc";
   $this->Cmps_ord_def['TP_DATEL'] = " asc";
   $this->Cmps_ord_def['TEMPLATENAME'] = " asc";
   $this->Cmps_ord_def['TP_NOKONTRAK'] = " asc";
   $this->Cmps_ord_def['TP_PONUMBER'] = " asc";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->sc_proc_grid = false; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['doc_word'])
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq_ant'];  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campos_busca'];
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
       $this->tp_idlop = $Busca_temp['tp_idlop']; 
       $tmp_pos = strpos($this->tp_idlop, "##@@");
       if ($tmp_pos !== false && !is_array($this->tp_idlop))
       {
           $this->tp_idlop = substr($this->tp_idlop, 0, $tmp_pos);
       }
       $this->tp_status = $Busca_temp['tp_status']; 
       $tmp_pos = strpos($this->tp_status, "##@@");
       if ($tmp_pos !== false && !is_array($this->tp_status))
       {
           $this->tp_status = substr($this->tp_status, 0, $tmp_pos);
       }
       $this->tp_jenisproject = $Busca_temp['tp_jenisproject']; 
       $tmp_pos = strpos($this->tp_jenisproject, "##@@");
       if ($tmp_pos !== false && !is_array($this->tp_jenisproject))
       {
           $this->tp_jenisproject = substr($this->tp_jenisproject, 0, $tmp_pos);
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
       $this->tp_mitra = $Busca_temp['tp_mitra']; 
       $tmp_pos = strpos($this->tp_mitra, "##@@");
       if ($tmp_pos !== false && !is_array($this->tp_mitra))
       {
           $this->tp_mitra = substr($this->tp_mitra, 0, $tmp_pos);
       }
       $this->tp_id = $Busca_temp['tp_id']; 
       $tmp_pos = strpos($this->tp_id, "##@@");
       if ($tmp_pos !== false && !is_array($this->tp_id))
       {
           $this->tp_id = substr($this->tp_id, 0, $tmp_pos);
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
   } 
   else 
   { 
       $this->tp_planstart_2 = ""; 
       $this->tp_planfinish_2 = ""; 
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "muda_qt_linhas";
   } 
       ob_start(); 
   $_SESSION['scriptcase']['list_project_inwitel']['contr_erro'] = 'on';
if (!isset($_SESSION['user_group'])) {$_SESSION['user_group'] = "";}
if (!isset($this->sc_temp_user_group)) {$this->sc_temp_user_group = (isset($_SESSION['user_group'])) ? $_SESSION['user_group'] : "";}
if (!isset($_SESSION['priv_mitra'])) {$_SESSION['priv_mitra'] = "";}
if (!isset($this->sc_temp_priv_mitra)) {$this->sc_temp_priv_mitra = (isset($_SESSION['priv_mitra'])) ? $_SESSION['priv_mitra'] : "";}
 if ($this->sc_temp_priv_mitra == 'Y') {
$this->nm_where_dinamico = " AND TP_MITRA='$this->sc_temp_user_group'";	
	}
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_dinamico']) || $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_dinamico'] != $this->nm_where_dinamico) {
    $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_dinamico'] = $this->nm_where_dinamico;
    unset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio']);
}

if (isset($this->sc_temp_priv_mitra)) {$_SESSION['priv_mitra'] = $this->sc_temp_priv_mitra;}
if (isset($this->sc_temp_user_group)) {$_SESSION['user_group'] = $this->sc_temp_user_group;}
$_SESSION['scriptcase']['list_project_inwitel']['contr_erro'] = 'off'; 
       $this->SC_Buf_onInit = ob_get_clean();; 

   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['maximized']) {
       $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['dashboard_app'];
       if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['list_project_inwitel'])) {
           $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['list_project_inwitel'];

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

   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "list_project_inwitel/list_project_inwitel_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "list_project_inwitel_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] != "pdf")  
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new list_project_inwitel_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] = 10;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['rows'];  
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_select']['TP_ID'] = 'DESC'; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_select']; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_quebra'] = array(); 
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "igual" ;  
       }
       else
       { 
           $Ordem_tem_quebra = false;
           foreach($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_quebra'] as $campo => $resto) 
           {
               foreach($resto as $sqldef => $ordem) 
               {
                   if ($sqldef == $nmgp_ordem) 
                   { 
                       $Ordem_tem_quebra = true;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "inicio" ;  
                       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_grid'] = ""; 
                       $ordem = ($ordem == "asc") ? "desc" : "asc";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_quebra'][$campo][$nmgp_ordem] = $ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] = $nmgp_ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] = trim($ordem);
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_grid'] = $nmgp_ordem  ; 
           }
       }
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_orig'] = " where TP_DIVRE=" . $_SESSION['iddivre'] . " AND TP_WITEL=" . $_SESSION['idwitel'] . "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao']       = "igual" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['opcao_print'] = "print" ; 
   } 
// 
   $this->count_ger = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "final" || $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid'] == "all") 
   { 
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['tot_geral'][1] ;  
       $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['tot_geral'][1];
   } 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_total']);
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['tot_geral'][1];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] = 0 ; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] > 0) 
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
       $nmgp_select = "SELECT TP_ID, TP_THN_RELEASE, TP_RELEASENAME, TP_BATCH, TP_IDLOP, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, STATUSNAME, TM_NAMAMITRA, TP_PROJECTNAME, TJ_NAMAJENIS, TP_LOKASI, TP_ODP, str_replace (convert(char(10),TP_PLANSTART,102), '.', '-') + ' ' + convert(char(8),TP_PLANSTART,20), str_replace (convert(char(10),TP_PLANFINISH,102), '.', '-') + ' ' + convert(char(8),TP_PLANFINISH,20), TP_TARGETWAKTU, TP_PROSENTASE, TP_MITRA, TP_WITEL, TP_STO, str_replace (convert(char(10),TP_ENTRYDATE,102), '.', '-') + ' ' + convert(char(8),TP_ENTRYDATE,20), TP_ENTRYBY, str_replace (convert(char(10),TP_UPDATEDATE,102), '.', '-') + ' ' + convert(char(8),TP_UPDATEDATE,20), TP_UPDATEBY, TP_SUMMARY, TP_STATUS, str_replace (convert(char(10),TP_ACTUALSTART,102), '.', '-') + ' ' + convert(char(8),TP_ACTUALSTART,20), str_replace (convert(char(10),TP_ACTUALFINISH,102), '.', '-') + ' ' + convert(char(8),TP_ACTUALFINISH,20), TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_DATEL, TEMPLATENAME, TP_NOKONTRAK, TP_PONUMBER from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT TP_ID, TP_THN_RELEASE, TP_RELEASENAME, TP_BATCH, TP_IDLOP, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, STATUSNAME, TM_NAMAMITRA, TP_PROJECTNAME, TJ_NAMAJENIS, TP_LOKASI, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_TARGETWAKTU, TP_PROSENTASE, TP_MITRA, TP_WITEL, TP_STO, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_DATEL, TEMPLATENAME, TP_NOKONTRAK, TP_PONUMBER from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT TP_ID, TP_THN_RELEASE, TP_RELEASENAME, TP_BATCH, TP_IDLOP, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, STATUSNAME, TM_NAMAMITRA, TP_PROJECTNAME, TJ_NAMAJENIS, TP_LOKASI, TP_ODP, convert(char(23),TP_PLANSTART,121), convert(char(23),TP_PLANFINISH,121), TP_TARGETWAKTU, TP_PROSENTASE, TP_MITRA, TP_WITEL, TP_STO, convert(char(23),TP_ENTRYDATE,121), TP_ENTRYBY, convert(char(23),TP_UPDATEDATE,121), TP_UPDATEBY, TP_SUMMARY, TP_STATUS, convert(char(23),TP_ACTUALSTART,121), convert(char(23),TP_ACTUALFINISH,121), TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_DATEL, TEMPLATENAME, TP_NOKONTRAK, TP_PONUMBER from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT TP_ID, TP_THN_RELEASE, TP_RELEASENAME, TP_BATCH, TP_IDLOP, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, STATUSNAME, TM_NAMAMITRA, TP_PROJECTNAME, TJ_NAMAJENIS, TP_LOKASI, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_TARGETWAKTU, TP_PROSENTASE, TP_MITRA, TP_WITEL, TP_STO, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_DATEL, TEMPLATENAME, TP_NOKONTRAK, TP_PONUMBER from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT TP_ID, TP_THN_RELEASE, TP_RELEASENAME, TP_BATCH, TP_IDLOP, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, STATUSNAME, TM_NAMAMITRA, TP_PROJECTNAME, TJ_NAMAJENIS, TP_LOKASI, TP_ODP, EXTEND(TP_PLANSTART, YEAR TO FRACTION), EXTEND(TP_PLANFINISH, YEAR TO FRACTION), TP_TARGETWAKTU, TP_PROSENTASE, TP_MITRA, TP_WITEL, TP_STO, EXTEND(TP_ENTRYDATE, YEAR TO FRACTION), TP_ENTRYBY, EXTEND(TP_UPDATEDATE, YEAR TO FRACTION), TP_UPDATEBY, TP_SUMMARY, TP_STATUS, EXTEND(TP_ACTUALSTART, YEAR TO FRACTION), EXTEND(TP_ACTUALFINISH, YEAR TO FRACTION), TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_DATEL, TEMPLATENAME, TP_NOKONTRAK, TP_PONUMBER from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT TP_ID, TP_THN_RELEASE, TP_RELEASENAME, TP_BATCH, TP_IDLOP, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, STATUSNAME, TM_NAMAMITRA, TP_PROJECTNAME, TJ_NAMAJENIS, TP_LOKASI, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_TARGETWAKTU, TP_PROSENTASE, TP_MITRA, TP_WITEL, TP_STO, TP_ENTRYDATE, TP_ENTRYBY, TP_UPDATEDATE, TP_UPDATEBY, TP_SUMMARY, TP_STATUS, TP_ACTUALSTART, TP_ACTUALFINISH, TP_TEMPLATEPROJECT, TP_JENISPROJECT, TP_PRJTRELEASE, TP_DATEL, TEMPLATENAME, TP_NOKONTRAK, TP_PONUMBER from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_desc']; 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
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
       $this->tp_id = $this->rs_grid->fields[0] ;  
       $this->tp_id = (string)$this->tp_id;
       $this->tp_thn_release = $this->rs_grid->fields[1] ;  
       $this->tp_releasename = $this->rs_grid->fields[2] ;  
       $this->tp_batch = $this->rs_grid->fields[3] ;  
       $this->tp_idlop = $this->rs_grid->fields[4] ;  
       $this->mw_namawitel = $this->rs_grid->fields[5] ;  
       $this->md_namadatel = $this->rs_grid->fields[6] ;  
       $this->ms_namasto = $this->rs_grid->fields[7] ;  
       $this->statusname = $this->rs_grid->fields[8] ;  
       $this->tm_namamitra = $this->rs_grid->fields[9] ;  
       $this->tp_projectname = $this->rs_grid->fields[10] ;  
       $this->tj_namajenis = $this->rs_grid->fields[11] ;  
       $this->tp_lokasi = $this->rs_grid->fields[12] ;  
       $this->tp_odp = $this->rs_grid->fields[13] ;  
       $this->tp_odp = (string)$this->tp_odp;
       $this->tp_planstart = $this->rs_grid->fields[14] ;  
       $this->tp_planfinish = $this->rs_grid->fields[15] ;  
       $this->tp_targetwaktu = $this->rs_grid->fields[16] ;  
       $this->tp_targetwaktu = (string)$this->tp_targetwaktu;
       $this->tp_prosentase = $this->rs_grid->fields[17] ;  
       $this->tp_prosentase =  str_replace(",", ".", $this->tp_prosentase);
       $this->tp_prosentase = (string)$this->tp_prosentase;
       $this->tp_mitra = $this->rs_grid->fields[18] ;  
       $this->tp_mitra = (string)$this->tp_mitra;
       $this->tp_witel = $this->rs_grid->fields[19] ;  
       $this->tp_witel = (string)$this->tp_witel;
       $this->tp_sto = $this->rs_grid->fields[20] ;  
       $this->tp_sto = (string)$this->tp_sto;
       $this->tp_entrydate = $this->rs_grid->fields[21] ;  
       $this->tp_entryby = $this->rs_grid->fields[22] ;  
       $this->tp_updatedate = $this->rs_grid->fields[23] ;  
       $this->tp_updateby = $this->rs_grid->fields[24] ;  
       $this->tp_summary = $this->rs_grid->fields[25] ;  
       $this->tp_status = $this->rs_grid->fields[26] ;  
       $this->tp_status = (string)$this->tp_status;
       $this->tp_actualstart = $this->rs_grid->fields[27] ;  
       $this->tp_actualfinish = $this->rs_grid->fields[28] ;  
       $this->tp_templateproject = $this->rs_grid->fields[29] ;  
       $this->tp_templateproject = (string)$this->tp_templateproject;
       $this->tp_jenisproject = $this->rs_grid->fields[30] ;  
       $this->tp_jenisproject = (string)$this->tp_jenisproject;
       $this->tp_prjtrelease = $this->rs_grid->fields[31] ;  
       $this->tp_prjtrelease = (string)$this->tp_prjtrelease;
       $this->tp_datel = $this->rs_grid->fields[32] ;  
       $this->tp_datel = (string)$this->tp_datel;
       $this->templatename = $this->rs_grid->fields[33] ;  
       $this->tp_nokontrak = $this->rs_grid->fields[34] ;  
       $this->tp_ponumber = $this->rs_grid->fields[35] ;  
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $this->SC_sep_quebra = false;
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->tp_id = $this->rs_grid->fields[0] ;  
           $this->tp_thn_release = $this->rs_grid->fields[1] ;  
           $this->tp_releasename = $this->rs_grid->fields[2] ;  
           $this->tp_batch = $this->rs_grid->fields[3] ;  
           $this->tp_idlop = $this->rs_grid->fields[4] ;  
           $this->mw_namawitel = $this->rs_grid->fields[5] ;  
           $this->md_namadatel = $this->rs_grid->fields[6] ;  
           $this->ms_namasto = $this->rs_grid->fields[7] ;  
           $this->statusname = $this->rs_grid->fields[8] ;  
           $this->tm_namamitra = $this->rs_grid->fields[9] ;  
           $this->tp_projectname = $this->rs_grid->fields[10] ;  
           $this->tj_namajenis = $this->rs_grid->fields[11] ;  
           $this->tp_lokasi = $this->rs_grid->fields[12] ;  
           $this->tp_odp = $this->rs_grid->fields[13] ;  
           $this->tp_planstart = $this->rs_grid->fields[14] ;  
           $this->tp_planfinish = $this->rs_grid->fields[15] ;  
           $this->tp_targetwaktu = $this->rs_grid->fields[16] ;  
           $this->tp_prosentase = $this->rs_grid->fields[17] ;  
           $this->tp_mitra = $this->rs_grid->fields[18] ;  
           $this->tp_witel = $this->rs_grid->fields[19] ;  
           $this->tp_sto = $this->rs_grid->fields[20] ;  
           $this->tp_entrydate = $this->rs_grid->fields[21] ;  
           $this->tp_entryby = $this->rs_grid->fields[22] ;  
           $this->tp_updatedate = $this->rs_grid->fields[23] ;  
           $this->tp_updateby = $this->rs_grid->fields[24] ;  
           $this->tp_summary = $this->rs_grid->fields[25] ;  
           $this->tp_status = $this->rs_grid->fields[26] ;  
           $this->tp_actualstart = $this->rs_grid->fields[27] ;  
           $this->tp_actualfinish = $this->rs_grid->fields[28] ;  
           $this->tp_templateproject = $this->rs_grid->fields[29] ;  
           $this->tp_jenisproject = $this->rs_grid->fields[30] ;  
           $this->tp_prjtrelease = $this->rs_grid->fields[31] ;  
           $this->tp_datel = $this->rs_grid->fields[32] ;  
           $this->templatename = $this->rs_grid->fields[33] ;  
           $this->tp_nokontrak = $this->rs_grid->fields[34] ;  
           $this->tp_ponumber = $this->rs_grid->fields[35] ;  
       } 
   } 
   $this->nmgp_reg_inicial = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final'] + 1;
   $this->nmgp_reg_final   = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid'];
   $this->nmgp_reg_final   = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   { 
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Resume Project Detail <?php echo $_SESSION['kodewitel'] ?> :: PDF</TITLE>
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
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['pivot_charts']) : 0;
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
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
       $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>Resume Project Detail " . $_SESSION['kodewitel'] . "</TITLE>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
           $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\" />\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
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
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"list_project_inwitel_jquery.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"list_project_inwitel_ajax.js\"></script>\r\n");
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($this->count_ger) . ";\r\n");
           }
           else
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid']) . ";\r\n");
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
           $nm_saida->saida("   gridHeaders = $(\".sc-ui-grid-header-row-list_project_inwitel-1\");\r\n");
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
           $nm_saida->saida("   tableOriginal = $(\"#sc-ui-grid-body-6a770c8f\");\r\n");
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
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               $nm_saida->saida("       $('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ancor_save'] . "').addClass('" . $this->css_scGridFieldOver . "');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ancor_save']);
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
           $nm_saida->saida("       url: \"list_project_inwitel_save_grid.php\",\r\n");
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
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_list_project_inwitel_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
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
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_list_project_inwitel_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['num_css'] . '.css');
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
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_list_project_inwitel_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] != "pdf")
       {
           $nm_saida->saida("  .css_iframes   { margin-bottom: 0px; margin-left: 0px;  margin-right: 0px;  margin-top: 0px; }\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
       { 
           $nm_saida->saida("       .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;color:black;}\r\n");
       } 
       $nm_saida->saida("  </style>\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "list_project_inwitel/list_project_inwitel_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "list_project_inwitel/list_project_inwitel_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
           $nm_saida->saida("  </style>\r\n");
       }
       if (!empty($this->SC_Buf_onInit))
       { 
       $nm_saida->saida("" . $this->SC_Buf_onInit . "\r\n");
       } 
       $nm_saida->saida("  </HEAD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "list_project_inwitel/list_project_inwitel_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $cada_css = ".list_project_inwitel_" . substr($cada_css, 1);
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   { 
       $nm_saida->saida("  <body class=\"" . $this->css_scGridPage . "\" " . $str_iframe_body . " style=\"" . $css_body . "\">\r\n");
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && !$this->Print_All)
       { 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none; position: absolute; left: 50px; top: 50px\"><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
       } 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf" && !$this->Print_All)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['SC_Ind_Groupby'] == "sc_free_total")
           {
           $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['doc_word'])
       { 
           $nm_saida->saida("      <div id=\"tooltip\" style=\"position:absolute;visibility:hidden;border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;padding:1px;color:black;\"></div>\r\n");
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = " width=\"100%\"";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"" . $this->css_scGridLabel . "\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print") 
       { 
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD  colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_A_list_project_inwitel\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_A_list_project_inwitel\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_E_list_project_inwitel\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_E_list_project_inwitel\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <td style=\"padding: 0px;  vertical-align: top;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\"><tr>\r\n");
           $nm_saida->saida("    <TD colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_AL_list_project_inwitel\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_AL_list_project_inwitel\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
        } 
   }  
 }  
 function NM_cor_embutida()
 {  
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['cab_embutida'] = "N";
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['SC_herda_css'] = "N"; 
   $compl_css = "";
   include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['SC_herda_css'] = "N"; 
       $GLOBALS["script_case_init"] = $this->Ini->sc_page;
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['embutida'] = true;
       $_SESSION['scriptcase']['v_resume_detailproject']['protect_modal'] = $this->Ini->sc_page;
       include_once ($this->Ini->link_v_resume_detailproject_cons_emb);
       $this->v_resume_detailproject = new v_resume_detailproject_sub_css ;
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['embutida'] = false;
       unset($_SESSION['scriptcase']['v_resume_detailproject']['protect_modal']);
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['list_project_inwitel']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['list_project_inwitel']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['list_project_inwitel']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['list_project_inwitel']) . "_";
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

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida']) ? "list_project_inwitel_" : "";
   $this->css_sep = " ";
   $this->css_tp_id_label = $compl_css_emb . "css_tp_id_label";
   $this->css_tp_id_grid_line = $compl_css_emb . "css_tp_id_grid_line";
   $this->css_tp_thn_release_label = $compl_css_emb . "css_tp_thn_release_label";
   $this->css_tp_thn_release_grid_line = $compl_css_emb . "css_tp_thn_release_grid_line";
   $this->css_tp_releasename_label = $compl_css_emb . "css_tp_releasename_label";
   $this->css_tp_releasename_grid_line = $compl_css_emb . "css_tp_releasename_grid_line";
   $this->css_tp_batch_label = $compl_css_emb . "css_tp_batch_label";
   $this->css_tp_batch_grid_line = $compl_css_emb . "css_tp_batch_grid_line";
   $this->css_tp_idlop_label = $compl_css_emb . "css_tp_idlop_label";
   $this->css_tp_idlop_grid_line = $compl_css_emb . "css_tp_idlop_grid_line";
   $this->css_mw_namawitel_label = $compl_css_emb . "css_mw_namawitel_label";
   $this->css_mw_namawitel_grid_line = $compl_css_emb . "css_mw_namawitel_grid_line";
   $this->css_md_namadatel_label = $compl_css_emb . "css_md_namadatel_label";
   $this->css_md_namadatel_grid_line = $compl_css_emb . "css_md_namadatel_grid_line";
   $this->css_ms_namasto_label = $compl_css_emb . "css_ms_namasto_label";
   $this->css_ms_namasto_grid_line = $compl_css_emb . "css_ms_namasto_grid_line";
   $this->css_statusname_label = $compl_css_emb . "css_statusname_label";
   $this->css_statusname_grid_line = $compl_css_emb . "css_statusname_grid_line";
   $this->css_tm_namamitra_label = $compl_css_emb . "css_tm_namamitra_label";
   $this->css_tm_namamitra_grid_line = $compl_css_emb . "css_tm_namamitra_grid_line";
   $this->css_tp_projectname_label = $compl_css_emb . "css_tp_projectname_label";
   $this->css_tp_projectname_grid_line = $compl_css_emb . "css_tp_projectname_grid_line";
   $this->css_tj_namajenis_label = $compl_css_emb . "css_tj_namajenis_label";
   $this->css_tj_namajenis_grid_line = $compl_css_emb . "css_tj_namajenis_grid_line";
   $this->css_tp_lokasi_label = $compl_css_emb . "css_tp_lokasi_label";
   $this->css_tp_lokasi_grid_line = $compl_css_emb . "css_tp_lokasi_grid_line";
   $this->css_tp_odp_label = $compl_css_emb . "css_tp_odp_label";
   $this->css_tp_odp_grid_line = $compl_css_emb . "css_tp_odp_grid_line";
   $this->css_tp_planstart_label = $compl_css_emb . "css_tp_planstart_label";
   $this->css_tp_planstart_grid_line = $compl_css_emb . "css_tp_planstart_grid_line";
   $this->css_tp_planfinish_label = $compl_css_emb . "css_tp_planfinish_label";
   $this->css_tp_planfinish_grid_line = $compl_css_emb . "css_tp_planfinish_grid_line";
   $this->css_tp_targetwaktu_label = $compl_css_emb . "css_tp_targetwaktu_label";
   $this->css_tp_targetwaktu_grid_line = $compl_css_emb . "css_tp_targetwaktu_grid_line";
   $this->css_prepare_label = $compl_css_emb . "css_prepare_label";
   $this->css_prepare_grid_line = $compl_css_emb . "css_prepare_grid_line";
   $this->css_perijinan_label = $compl_css_emb . "css_perijinan_label";
   $this->css_perijinan_grid_line = $compl_css_emb . "css_perijinan_grid_line";
   $this->css_inst_testcomm_label = $compl_css_emb . "css_inst_testcomm_label";
   $this->css_inst_testcomm_grid_line = $compl_css_emb . "css_inst_testcomm_grid_line";
   $this->css_closing_label = $compl_css_emb . "css_closing_label";
   $this->css_closing_grid_line = $compl_css_emb . "css_closing_grid_line";
   $this->css_tp_prosentase_label = $compl_css_emb . "css_tp_prosentase_label";
   $this->css_tp_prosentase_grid_line = $compl_css_emb . "css_tp_prosentase_grid_line";
   $this->css_detaiil_label = $compl_css_emb . "css_detaiil_label";
   $this->css_detaiil_grid_line = $compl_css_emb . "css_detaiil_grid_line";
   $this->css_tp_mitra_label = $compl_css_emb . "css_tp_mitra_label";
   $this->css_tp_mitra_grid_line = $compl_css_emb . "css_tp_mitra_grid_line";
   $this->css_tp_witel_label = $compl_css_emb . "css_tp_witel_label";
   $this->css_tp_witel_grid_line = $compl_css_emb . "css_tp_witel_grid_line";
   $this->css_tp_sto_label = $compl_css_emb . "css_tp_sto_label";
   $this->css_tp_sto_grid_line = $compl_css_emb . "css_tp_sto_grid_line";
   $this->css_tp_entrydate_label = $compl_css_emb . "css_tp_entrydate_label";
   $this->css_tp_entrydate_grid_line = $compl_css_emb . "css_tp_entrydate_grid_line";
   $this->css_tp_entryby_label = $compl_css_emb . "css_tp_entryby_label";
   $this->css_tp_entryby_grid_line = $compl_css_emb . "css_tp_entryby_grid_line";
   $this->css_tp_updatedate_label = $compl_css_emb . "css_tp_updatedate_label";
   $this->css_tp_updatedate_grid_line = $compl_css_emb . "css_tp_updatedate_grid_line";
   $this->css_tp_updateby_label = $compl_css_emb . "css_tp_updateby_label";
   $this->css_tp_updateby_grid_line = $compl_css_emb . "css_tp_updateby_grid_line";
   $this->css_tp_summary_label = $compl_css_emb . "css_tp_summary_label";
   $this->css_tp_summary_grid_line = $compl_css_emb . "css_tp_summary_grid_line";
   $this->css_tp_status_label = $compl_css_emb . "css_tp_status_label";
   $this->css_tp_status_grid_line = $compl_css_emb . "css_tp_status_grid_line";
   $this->css_tp_actualstart_label = $compl_css_emb . "css_tp_actualstart_label";
   $this->css_tp_actualstart_grid_line = $compl_css_emb . "css_tp_actualstart_grid_line";
   $this->css_tp_actualfinish_label = $compl_css_emb . "css_tp_actualfinish_label";
   $this->css_tp_actualfinish_grid_line = $compl_css_emb . "css_tp_actualfinish_grid_line";
   $this->css_tp_templateproject_label = $compl_css_emb . "css_tp_templateproject_label";
   $this->css_tp_templateproject_grid_line = $compl_css_emb . "css_tp_templateproject_grid_line";
   $this->css_tp_jenisproject_label = $compl_css_emb . "css_tp_jenisproject_label";
   $this->css_tp_jenisproject_grid_line = $compl_css_emb . "css_tp_jenisproject_grid_line";
   $this->css_tp_prjtrelease_label = $compl_css_emb . "css_tp_prjtrelease_label";
   $this->css_tp_prjtrelease_grid_line = $compl_css_emb . "css_tp_prjtrelease_grid_line";
   $this->css_tp_datel_label = $compl_css_emb . "css_tp_datel_label";
   $this->css_tp_datel_grid_line = $compl_css_emb . "css_tp_datel_grid_line";
   $this->css_templatename_label = $compl_css_emb . "css_templatename_label";
   $this->css_templatename_grid_line = $compl_css_emb . "css_templatename_grid_line";
   $this->css_tp_nokontrak_label = $compl_css_emb . "css_tp_nokontrak_label";
   $this->css_tp_nokontrak_grid_line = $compl_css_emb . "css_tp_nokontrak_grid_line";
   $this->css_tp_ponumber_label = $compl_css_emb . "css_tp_ponumber_label";
   $this->css_tp_ponumber_grid_line = $compl_css_emb . "css_tp_ponumber_grid_line";
 }  
// 
//----- 
 function cabecalho()
 {
   global
          $nm_saida;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq'], 0, $trab_pos);
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
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
   $nm_saida->saida("          Resume Project Detail " . $_SESSION['kodewitel'] . "\r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['maximized'])
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cond_pesq'], 0, $trab_pos);
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
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sv_dt_foot']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sv_dt_foot'] = array();
       $nm_refresch_cab_rod = true;
   } 
   else 
   { 
       $nm_refresch_cab_rod = false;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sv_dt_foot'] as $ind => $val)
   {
       $tmp_var = "sc_data_cab" . $ind;
       if ($$tmp_var != $val)
       {
           $nm_refresch_cab_rod = true;
           break;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'] && $nm_refresch_cab_rod)
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sv_dt_foot'][1] = $sc_data_cab1;
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sv_dt_foot']['fix'] = $nm_data_fixa;
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
   $nm_saida->saida("          " . $nm_cab_filtro . "\r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'] && $nm_refresch_cab_rod)
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_label'])
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
   $nm_saida->saida("    <TR id=\"tit_list_project_inwitel__SCCS__" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-list_project_inwitel-" . $tmp_header_row . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_label']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_ponumber_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_ponumber_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] != "pdf") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_ponumber_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] || ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['exibe_seq'] == "S")) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_ponumber_label'] . "\"  WIDTH=\"\">&nbsp;</TD>\r\n");
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
   } 
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_label'])
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
             $NM_css = file($this->Ini->root . $this->Ini->path_link . "list_project_inwitel/list_project_inwitel_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
             foreach ($NM_css as $cada_css)
             {
                 $css_emb .= ".list_project_inwitel_" . substr($cada_css, 1);
             }
             $css_emb .= "</style>";
             $Cod_Html = $css_emb . $Cod_Html;
             $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cols_emb'] = count($Nm_temp) - 1;
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
     $NM_seq_lab = 1;
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels'] as $NM_cmp => $NM_lab)
     {
         if (empty($NM_lab) || $NM_lab == "&nbsp;")
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels'][$NM_cmp] = "No_Label" . $NM_seq_lab;
             $NM_seq_lab++;
         }
     } 
   } 
 }
 function NM_label_tp_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_id'])) ? $this->New_label['tp_id'] : "ID"; 
   if (!isset($this->NM_cmp_hidden['tp_id']) || $this->NM_cmp_hidden['tp_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_id_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_id_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_ID')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_ID')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_thn_release()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_thn_release'])) ? $this->New_label['tp_thn_release'] : "Project Release"; 
   if (!isset($this->NM_cmp_hidden['tp_thn_release']) || $this->NM_cmp_hidden['tp_thn_release'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_thn_release_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_thn_release_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_THN_RELEASE')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_THN_RELEASE')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_releasename()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_releasename'])) ? $this->New_label['tp_releasename'] : "Sub-<br>Release"; 
   if (!isset($this->NM_cmp_hidden['tp_releasename']) || $this->NM_cmp_hidden['tp_releasename'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_releasename_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_releasename_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_RELEASENAME')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_RELEASENAME')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_batch()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_batch'])) ? $this->New_label['tp_batch'] : "Batch"; 
   if (!isset($this->NM_cmp_hidden['tp_batch']) || $this->NM_cmp_hidden['tp_batch'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_batch_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_batch_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_BATCH')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_BATCH')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_idlop()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_idlop'])) ? $this->New_label['tp_idlop'] : "ID LOP"; 
   if (!isset($this->NM_cmp_hidden['tp_idlop']) || $this->NM_cmp_hidden['tp_idlop'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_idlop_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_idlop_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_IDLOP')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_IDLOP')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_mw_namawitel()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['mw_namawitel'])) ? $this->New_label['mw_namawitel'] : "Witel"; 
   if (!isset($this->NM_cmp_hidden['mw_namawitel']) || $this->NM_cmp_hidden['mw_namawitel'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_mw_namawitel_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_mw_namawitel_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'MW_NAMAWITEL')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('MW_NAMAWITEL')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_md_namadatel()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['md_namadatel'])) ? $this->New_label['md_namadatel'] : "Datel"; 
   if (!isset($this->NM_cmp_hidden['md_namadatel']) || $this->NM_cmp_hidden['md_namadatel'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_md_namadatel_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_md_namadatel_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'MD_NAMADATEL')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('MD_NAMADATEL')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_ms_namasto()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ms_namasto'])) ? $this->New_label['ms_namasto'] : "STO"; 
   if (!isset($this->NM_cmp_hidden['ms_namasto']) || $this->NM_cmp_hidden['ms_namasto'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ms_namasto_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ms_namasto_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'MS_NAMASTO')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('MS_NAMASTO')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_statusname()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['statusname'])) ? $this->New_label['statusname'] : "Status Project"; 
   if (!isset($this->NM_cmp_hidden['statusname']) || $this->NM_cmp_hidden['statusname'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_statusname_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_statusname_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'STATUSNAME')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('STATUSNAME')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tm_namamitra()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tm_namamitra'])) ? $this->New_label['tm_namamitra'] : "Mitra"; 
   if (!isset($this->NM_cmp_hidden['tm_namamitra']) || $this->NM_cmp_hidden['tm_namamitra'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tm_namamitra_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tm_namamitra_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TM_NAMAMITRA')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TM_NAMAMITRA')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_projectname()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_projectname'])) ? $this->New_label['tp_projectname'] : "Nama Project"; 
   if (!isset($this->NM_cmp_hidden['tp_projectname']) || $this->NM_cmp_hidden['tp_projectname'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_projectname_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_projectname_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_PROJECTNAME')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_PROJECTNAME')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tj_namajenis()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tj_namajenis'])) ? $this->New_label['tj_namajenis'] : "Jenis Project"; 
   if (!isset($this->NM_cmp_hidden['tj_namajenis']) || $this->NM_cmp_hidden['tj_namajenis'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tj_namajenis_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tj_namajenis_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TJ_NAMAJENIS')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TJ_NAMAJENIS')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_lokasi()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_lokasi'])) ? $this->New_label['tp_lokasi'] : "Lokasi"; 
   if (!isset($this->NM_cmp_hidden['tp_lokasi']) || $this->NM_cmp_hidden['tp_lokasi'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_lokasi_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_lokasi_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_LOKASI')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_LOKASI')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_odp()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_odp'])) ? $this->New_label['tp_odp'] : "Jml ODP"; 
   if (!isset($this->NM_cmp_hidden['tp_odp']) || $this->NM_cmp_hidden['tp_odp'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_odp_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_odp_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_ODP')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_ODP')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_planstart()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_planstart'])) ? $this->New_label['tp_planstart'] : "Plan Mulai"; 
   if (!isset($this->NM_cmp_hidden['tp_planstart']) || $this->NM_cmp_hidden['tp_planstart'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_planstart_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_planstart_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_PLANSTART')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_PLANSTART')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_planfinish()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_planfinish'])) ? $this->New_label['tp_planfinish'] : "Plan Selesai"; 
   if (!isset($this->NM_cmp_hidden['tp_planfinish']) || $this->NM_cmp_hidden['tp_planfinish'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_planfinish_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_planfinish_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_PLANFINISH')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_PLANFINISH')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_targetwaktu()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_targetwaktu'])) ? $this->New_label['tp_targetwaktu'] : "Target Deploy"; 
   if (!isset($this->NM_cmp_hidden['tp_targetwaktu']) || $this->NM_cmp_hidden['tp_targetwaktu'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_targetwaktu_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_targetwaktu_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_TARGETWAKTU')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_TARGETWAKTU')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_prepare()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['prepare'])) ? $this->New_label['prepare'] : "Preparing (15%)"; 
   if (!isset($this->NM_cmp_hidden['prepare']) || $this->NM_cmp_hidden['prepare'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_prepare_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_prepare_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_perijinan()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['perijinan'])) ? $this->New_label['perijinan'] : "Perijinan (15%)"; 
   if (!isset($this->NM_cmp_hidden['perijinan']) || $this->NM_cmp_hidden['perijinan'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_perijinan_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_perijinan_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_inst_testcomm()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['inst_testcomm'])) ? $this->New_label['inst_testcomm'] : "Inst.& TestComm (50%)"; 
   if (!isset($this->NM_cmp_hidden['inst_testcomm']) || $this->NM_cmp_hidden['inst_testcomm'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_inst_testcomm_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_inst_testcomm_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_closing()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['closing'])) ? $this->New_label['closing'] : "Closing (20%)"; 
   if (!isset($this->NM_cmp_hidden['closing']) || $this->NM_cmp_hidden['closing'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_closing_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_closing_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_tp_prosentase()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_prosentase'])) ? $this->New_label['tp_prosentase'] : "Pencapaian Project"; 
   if (!isset($this->NM_cmp_hidden['tp_prosentase']) || $this->NM_cmp_hidden['tp_prosentase'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_prosentase_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_prosentase_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_PROSENTASE')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_PROSENTASE')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_mitra()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_mitra'])) ? $this->New_label['tp_mitra'] : "TP MITRA"; 
   if (!isset($this->NM_cmp_hidden['tp_mitra']) || $this->NM_cmp_hidden['tp_mitra'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_mitra_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_mitra_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_MITRA')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_MITRA')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_witel()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_witel'])) ? $this->New_label['tp_witel'] : "TP WITEL"; 
   if (!isset($this->NM_cmp_hidden['tp_witel']) || $this->NM_cmp_hidden['tp_witel'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_witel_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_witel_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_WITEL')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
 function NM_label_tp_sto()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_sto'])) ? $this->New_label['tp_sto'] : "TP STO"; 
   if (!isset($this->NM_cmp_hidden['tp_sto']) || $this->NM_cmp_hidden['tp_sto'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_sto_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_sto_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_STO')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_STO')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_entrydate()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_entrydate'])) ? $this->New_label['tp_entrydate'] : "TP ENTRYDATE"; 
   if (!isset($this->NM_cmp_hidden['tp_entrydate']) || $this->NM_cmp_hidden['tp_entrydate'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_entrydate_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_entrydate_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_ENTRYDATE')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_ENTRYDATE')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_entryby()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_entryby'])) ? $this->New_label['tp_entryby'] : "TP ENTRYBY"; 
   if (!isset($this->NM_cmp_hidden['tp_entryby']) || $this->NM_cmp_hidden['tp_entryby'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_entryby_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_entryby_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_ENTRYBY')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_ENTRYBY')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_updatedate()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_updatedate'])) ? $this->New_label['tp_updatedate'] : "TP UPDATEDATE"; 
   if (!isset($this->NM_cmp_hidden['tp_updatedate']) || $this->NM_cmp_hidden['tp_updatedate'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_updatedate_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_updatedate_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_UPDATEDATE')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_UPDATEDATE')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_updateby()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_updateby'])) ? $this->New_label['tp_updateby'] : "TP UPDATEBY"; 
   if (!isset($this->NM_cmp_hidden['tp_updateby']) || $this->NM_cmp_hidden['tp_updateby'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_updateby_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_updateby_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_UPDATEBY')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_UPDATEBY')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_summary()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_summary'])) ? $this->New_label['tp_summary'] : "Summary"; 
   if (!isset($this->NM_cmp_hidden['tp_summary']) || $this->NM_cmp_hidden['tp_summary'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_summary_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_summary_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_SUMMARY')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_SUMMARY')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_status()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_status'])) ? $this->New_label['tp_status'] : "Kode Status"; 
   if (!isset($this->NM_cmp_hidden['tp_status']) || $this->NM_cmp_hidden['tp_status'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_status_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_status_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_STATUS')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_STATUS')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_actualstart()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_actualstart'])) ? $this->New_label['tp_actualstart'] : "TP ACTUALSTART"; 
   if (!isset($this->NM_cmp_hidden['tp_actualstart']) || $this->NM_cmp_hidden['tp_actualstart'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_actualstart_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_actualstart_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_ACTUALSTART')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_ACTUALSTART')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_actualfinish()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_actualfinish'])) ? $this->New_label['tp_actualfinish'] : "TP ACTUALFINISH"; 
   if (!isset($this->NM_cmp_hidden['tp_actualfinish']) || $this->NM_cmp_hidden['tp_actualfinish'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_actualfinish_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_actualfinish_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_ACTUALFINISH')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_ACTUALFINISH')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_templateproject()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_templateproject'])) ? $this->New_label['tp_templateproject'] : "TP TEMPLATEPROJECT"; 
   if (!isset($this->NM_cmp_hidden['tp_templateproject']) || $this->NM_cmp_hidden['tp_templateproject'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_templateproject_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_templateproject_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_TEMPLATEPROJECT')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_TEMPLATEPROJECT')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_jenisproject()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_jenisproject'])) ? $this->New_label['tp_jenisproject'] : "Kode Jenis Project"; 
   if (!isset($this->NM_cmp_hidden['tp_jenisproject']) || $this->NM_cmp_hidden['tp_jenisproject'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_jenisproject_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_jenisproject_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_JENISPROJECT')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_JENISPROJECT')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_prjtrelease()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_prjtrelease'])) ? $this->New_label['tp_prjtrelease'] : "Kode Jenis Project"; 
   if (!isset($this->NM_cmp_hidden['tp_prjtrelease']) || $this->NM_cmp_hidden['tp_prjtrelease'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_prjtrelease_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_prjtrelease_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_PRJTRELEASE')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_PRJTRELEASE')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_datel()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_datel'])) ? $this->New_label['tp_datel'] : "TP DATEL"; 
   if (!isset($this->NM_cmp_hidden['tp_datel']) || $this->NM_cmp_hidden['tp_datel'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_datel_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_datel_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_DATEL')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_DATEL')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_templatename()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['templatename'])) ? $this->New_label['templatename'] : "Project Template"; 
   if (!isset($this->NM_cmp_hidden['templatename']) || $this->NM_cmp_hidden['templatename'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_templatename_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_templatename_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TEMPLATENAME')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TEMPLATENAME')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_nokontrak()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_nokontrak'])) ? $this->New_label['tp_nokontrak'] : "No.Kontrak"; 
   if (!isset($this->NM_cmp_hidden['tp_nokontrak']) || $this->NM_cmp_hidden['tp_nokontrak'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_nokontrak_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_nokontrak_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_NOKONTRAK')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_NOKONTRAK')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
   } 
 }
 function NM_label_tp_ponumber()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tp_ponumber'])) ? $this->New_label['tp_ponumber'] : "PO.Number"; 
   if (!isset($this->NM_cmp_hidden['tp_ponumber']) || $this->NM_cmp_hidden['tp_ponumber'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tp_ponumber_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tp_ponumber_label'] . "\" >\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
      $link_img = "";
      $nome_img = $this->Ini->Label_sort;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_cmp'] == 'TP_PONUMBER')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ordem_label'] == "desc")
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
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit2('TP_PONUMBER')\" class=\"" . $this->css_scGridLabelLink . "\">" . $link_img . "</a>\r\n");
   }
   else
   {
   $nm_saida->saida("" . nl2br($SC_Label) . "\r\n");
   }
   $nm_saida->saida("</TD>\r\n");
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ini_cor_grid']);
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
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['where_pesq_filtro'];
// 
   $SC_Label = (isset($this->New_label['tp_id'])) ? $this->New_label['tp_id'] : "ID"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_id'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_thn_release'])) ? $this->New_label['tp_thn_release'] : "Project Release"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_thn_release'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_releasename'])) ? $this->New_label['tp_releasename'] : "Sub-<br>Release"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_releasename'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_batch'])) ? $this->New_label['tp_batch'] : "Batch"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_batch'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_idlop'])) ? $this->New_label['tp_idlop'] : "ID LOP"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_idlop'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['mw_namawitel'])) ? $this->New_label['mw_namawitel'] : "Witel"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['mw_namawitel'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['md_namadatel'])) ? $this->New_label['md_namadatel'] : "Datel"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['md_namadatel'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['ms_namasto'])) ? $this->New_label['ms_namasto'] : "STO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['ms_namasto'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['statusname'])) ? $this->New_label['statusname'] : "Status Project"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['statusname'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tm_namamitra'])) ? $this->New_label['tm_namamitra'] : "Mitra"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tm_namamitra'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_projectname'])) ? $this->New_label['tp_projectname'] : "Nama Project"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_projectname'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tj_namajenis'])) ? $this->New_label['tj_namajenis'] : "Jenis Project"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tj_namajenis'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_lokasi'])) ? $this->New_label['tp_lokasi'] : "Lokasi"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_lokasi'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_odp'])) ? $this->New_label['tp_odp'] : "Jml ODP"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_odp'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_planstart'])) ? $this->New_label['tp_planstart'] : "Plan Mulai"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_planstart'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_planfinish'])) ? $this->New_label['tp_planfinish'] : "Plan Selesai"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_planfinish'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_targetwaktu'])) ? $this->New_label['tp_targetwaktu'] : "Target Deploy"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_targetwaktu'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['prepare'])) ? $this->New_label['prepare'] : "Preparing (15%)"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['prepare'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['perijinan'])) ? $this->New_label['perijinan'] : "Perijinan (15%)"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['perijinan'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['inst_testcomm'])) ? $this->New_label['inst_testcomm'] : "Inst.& TestComm (50%)"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['inst_testcomm'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['closing'])) ? $this->New_label['closing'] : "Closing (20%)"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['closing'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_prosentase'])) ? $this->New_label['tp_prosentase'] : "Pencapaian Project"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_prosentase'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_mitra'])) ? $this->New_label['tp_mitra'] : "TP MITRA"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_mitra'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_witel'])) ? $this->New_label['tp_witel'] : "TP WITEL"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_witel'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_sto'])) ? $this->New_label['tp_sto'] : "TP STO"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_sto'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_entrydate'])) ? $this->New_label['tp_entrydate'] : "TP ENTRYDATE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_entrydate'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_entryby'])) ? $this->New_label['tp_entryby'] : "TP ENTRYBY"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_entryby'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_updatedate'])) ? $this->New_label['tp_updatedate'] : "TP UPDATEDATE"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_updatedate'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_updateby'])) ? $this->New_label['tp_updateby'] : "TP UPDATEBY"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_updateby'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_summary'])) ? $this->New_label['tp_summary'] : "Summary"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_summary'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_status'])) ? $this->New_label['tp_status'] : "Kode Status"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_status'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_actualstart'])) ? $this->New_label['tp_actualstart'] : "TP ACTUALSTART"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_actualstart'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_actualfinish'])) ? $this->New_label['tp_actualfinish'] : "TP ACTUALFINISH"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_actualfinish'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_templateproject'])) ? $this->New_label['tp_templateproject'] : "TP TEMPLATEPROJECT"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_templateproject'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_jenisproject'])) ? $this->New_label['tp_jenisproject'] : "Kode Jenis Project"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_jenisproject'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_prjtrelease'])) ? $this->New_label['tp_prjtrelease'] : "Kode Jenis Project"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_prjtrelease'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_datel'])) ? $this->New_label['tp_datel'] : "TP DATEL"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_datel'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['templatename'])) ? $this->New_label['templatename'] : "Project Template"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['templatename'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_nokontrak'])) ? $this->New_label['tp_nokontrak'] : "No.Kontrak"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_nokontrak'] = $SC_Label; 
   $SC_Label = (isset($this->New_label['tp_ponumber'])) ? $this->New_label['tp_ponumber'] : "PO.Number"; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['labels']['tp_ponumber'] = $SC_Label; 
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['list_project_inwitel']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_list_project_inwitel#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cab_embutida'] != "S")
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
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && 
               $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print") 
           { 
           $nm_saida->saida("    <TD >\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_list_project_inwitel\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_EL_list_project_inwitel\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
           } 
           $nm_saida->saida("  <td id=\"sc_grid_body\" class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_A_list_project_inwitel', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_D_list_project_inwitel', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_E_list_project_inwitel', 'value' => 'NM_Blank_Page.htm');
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" &&
               $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print") 
           { 
               $nm_saida->saida("</TABLE></TD>\r\n");
               $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_list_project_inwitel\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_DL_list_project_inwitel\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               $nm_saida->saida("</TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_list_project_inwitel\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_D_list_project_inwitel\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    </TR>\r\n");
           } 
       $nm_saida->saida("</TABLE>\r\n");
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_list_project_inwitel#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
       $nm_saida->saida(" <TR> \r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print") 
       { 
           $nm_saida->saida("    <TD  colspan=3>\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_list_project_inwitel\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_EL_list_project_inwitel\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
       } 
       $nm_id_aplicacao = " id=\"apl_list_project_inwitel#?#1\"";
   } 
   $nm_saida->saida("  <TD id=\"sc_grid_body\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;\" width=\"100%\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-6a770c8f\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['cab_embutida'] != "S" )
      { 
          $this->label_grid($linhas);
      } 
   } 
   else 
   { 
      $this->label_grid($linhas);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final'] = 0;
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['SC_Ind_Groupby'] == "sc_free_total")
   {
       $NM_prim_qb = true;
   }
   $this->nmgp_prim_pag_pdf = true;
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   $ini_grid = true;
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
          $this->NM_cont_emb_linha++;
          $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['emb_linha']++;
          //---------- Gauge ----------
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf" && -1 < $this->progress_grid)
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
          $this->tp_id = $this->rs_grid->fields[0] ;  
          $this->tp_id = (string)$this->tp_id;
          $this->tp_thn_release = $this->rs_grid->fields[1] ;  
          $this->tp_releasename = $this->rs_grid->fields[2] ;  
          $this->tp_batch = $this->rs_grid->fields[3] ;  
          $this->tp_idlop = $this->rs_grid->fields[4] ;  
          $this->mw_namawitel = $this->rs_grid->fields[5] ;  
          $this->md_namadatel = $this->rs_grid->fields[6] ;  
          $this->ms_namasto = $this->rs_grid->fields[7] ;  
          $this->statusname = $this->rs_grid->fields[8] ;  
          $this->tm_namamitra = $this->rs_grid->fields[9] ;  
          $this->tp_projectname = $this->rs_grid->fields[10] ;  
          $this->tj_namajenis = $this->rs_grid->fields[11] ;  
          $this->tp_lokasi = $this->rs_grid->fields[12] ;  
          $this->tp_odp = $this->rs_grid->fields[13] ;  
          $this->tp_odp = (string)$this->tp_odp;
          $this->tp_planstart = $this->rs_grid->fields[14] ;  
          $this->tp_planfinish = $this->rs_grid->fields[15] ;  
          $this->tp_targetwaktu = $this->rs_grid->fields[16] ;  
          $this->tp_targetwaktu = (string)$this->tp_targetwaktu;
          $this->tp_prosentase = $this->rs_grid->fields[17] ;  
          $this->tp_prosentase =  str_replace(",", ".", $this->tp_prosentase);
          $this->tp_prosentase = (string)$this->tp_prosentase;
          $this->tp_mitra = $this->rs_grid->fields[18] ;  
          $this->tp_mitra = (string)$this->tp_mitra;
          $this->tp_witel = $this->rs_grid->fields[19] ;  
          $this->tp_witel = (string)$this->tp_witel;
          $this->tp_sto = $this->rs_grid->fields[20] ;  
          $this->tp_sto = (string)$this->tp_sto;
          $this->tp_entrydate = $this->rs_grid->fields[21] ;  
          $this->tp_entryby = $this->rs_grid->fields[22] ;  
          $this->tp_updatedate = $this->rs_grid->fields[23] ;  
          $this->tp_updateby = $this->rs_grid->fields[24] ;  
          $this->tp_summary = $this->rs_grid->fields[25] ;  
          $this->tp_status = $this->rs_grid->fields[26] ;  
          $this->tp_status = (string)$this->tp_status;
          $this->tp_actualstart = $this->rs_grid->fields[27] ;  
          $this->tp_actualfinish = $this->rs_grid->fields[28] ;  
          $this->tp_templateproject = $this->rs_grid->fields[29] ;  
          $this->tp_templateproject = (string)$this->tp_templateproject;
          $this->tp_jenisproject = $this->rs_grid->fields[30] ;  
          $this->tp_jenisproject = (string)$this->tp_jenisproject;
          $this->tp_prjtrelease = $this->rs_grid->fields[31] ;  
          $this->tp_prjtrelease = (string)$this->tp_prjtrelease;
          $this->tp_datel = $this->rs_grid->fields[32] ;  
          $this->tp_datel = (string)$this->tp_datel;
          $this->templatename = $this->rs_grid->fields[33] ;  
          $this->tp_nokontrak = $this->rs_grid->fields[34] ;  
          $this->tp_ponumber = $this->rs_grid->fields[35] ;  
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final'] + 1; 
          if (!$ini_grid) {
              $this->SC_sep_quebra = true;
          }
          else {
              $ini_grid = false;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['rows_emb']++;
          $this->sc_proc_grid = true;
          $_SESSION['scriptcase']['list_project_inwitel']['contr_erro'] = 'on';
 $progress ='View Progress';
$check_sql1 = "SELECT 
SUM(IF(TPP_PROJECTPHASE=1,TPP_PROSENTASEPROJECT,0)) AS SATU,
SUM(IF(TPP_PROJECTPHASE=2,TPP_PROSENTASEPROJECT,0)) AS DUA,
SUM(IF(TPP_PROJECTPHASE=3,TPP_PROSENTASEPROJECT,0)) AS TIGA,
SUM(IF(TPP_PROJECTPHASE=4,TPP_PROSENTASEPROJECT,0)) AS EMPAT
FROM TBL_PROJECT_PROGRESS
WHERE TPP_IDPROJECT='$this->tp_id'";
 
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
if (isset($this->rs1[0][0])) {
    $this->prepare  = $this->rs1[0][0];
    $this->perijinan  = $this->rs1[0][1];
    $this->inst_testcomm  = $this->rs1[0][2];
    $this->closing  = $this->rs1[0][3];
}
$_SESSION['scriptcase']['list_project_inwitel']['contr_erro'] = 'off';
          $nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['final']; 
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
              if ($temp == "tp_planstart")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "tp_planfinish")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "tp_entrydate")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "tp_updatedate")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "tp_actualstart")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "tp_actualfinish")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
          }
          $this->SC_ancora = $this->SC_seq_page;
          $nm_saida->saida("    <TR  class=\"" . $this->css_line_back . "\"" . $NM_destaque . " id=\"SC_ancor" . $this->SC_ancora . "\">\r\n");
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->Css_Cmp['css_tp_ponumber_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">&nbsp;</TD>\r\n");
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_tp_ponumber_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . $teste . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . $teste . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['mostra_edit'] != "N"){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\"><tr><td style=\"padding: 0px\"><img id=\"b_open_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:''\" onclick=\"document.getElementById('b_open_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_close_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">\r\n");
          $nm_saida->saida("<img id=\"b_close_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:none\" onclick=\"document.getElementById('b_close_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_open_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">\r\n");
          $nm_saida->saida("</td></tr></table></TD>\r\n");
 } 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['mostra_edit'] == "N"){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\"><tr><td style=\"padding: 0px\"><img id=\"b_open_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:''\" onclick=\"document.getElementById('b_open_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_close_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">\r\n");
          $nm_saida->saida("<img id=\"b_close_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:none\" onclick=\"document.getElementById('b_close_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_open_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">\r\n");
          $nm_saida->saida("</td></tr></table></TD>\r\n");
 } 
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] != "pdf"){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\"><img id=\"b_open_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:''\" onclick=\"document.getElementById('b_open_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_close_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">\r\n");
          $nm_saida->saida("<img id=\"b_close_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "\" style=\"display:none\" onclick=\"document.getElementById('b_close_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; document.getElementById('b_open_emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = ''; document.getElementById('emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "').style.display = 'none'; return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">\r\n");
          $nm_saida->saida("</TD>\r\n");
 } 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] || ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['exibe_seq'] == "S")) { 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  NOWRAP align=\"right\" valign=\"top\"   HEIGHT=\"0px\">" . $seq_det . "</TD>\r\n");
 } 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] != "pdf")
          { 
              $this->NM_calc_span();
              $nm_saida->saida("</TR>\r\n");
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] != "pdf")
              { 
                  $nm_saida->saida("<TR  class=\"" . $this->css_line_back . "\" id=\"emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "\"  style=\"display:none\">\r\n");
              } 
              else 
              { 
                  $nm_saida->saida("<TR  class=\"" . $this->css_line_back . "\" id=\"emb_list_project_inwitel_linha_" . $this->NM_cont_emb_linha . "\"  style=\"display:''\">\r\n");
              } 
              $nm_saida->saida("<TD class=\"" . $this->css_line_fonf . "\" colspan=\"" . $this->NM_colspan . "\"><TABLE align=\"left\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\"><TR>\r\n");
              $this->NM_grid_detaiil();
              $nm_saida->saida("</TR></TABLE></TD>\r\n");
          }
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
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
   if (method_exists($this->v_resume_detailproject, "close_emb")) 
   {
       $this->v_resume_detailproject->close_emb();
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
  
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_grid'])
   { 
       return; 
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && empty($this->nm_grid_sem_reg) && 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print") 
   { 
       $nm_saida->saida("</TABLE></TD>\r\n");
       $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_list_project_inwitel\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_DL_list_project_inwitel\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       $nm_saida->saida("</TD>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_list_project_inwitel\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_D_list_project_inwitel\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
           $nm_saida->saida("    </TABLE>\r\n");
           $nm_saida->saida("    </TD>\r\n");
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao']       = "igual" ; 
   } 
 }
 function NM_grid_tp_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_id']) || $this->NM_cmp_hidden['tp_id'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_id)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_id_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_id_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_thn_release()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_thn_release']) || $this->NM_cmp_hidden['tp_thn_release'] != "off") { 
          $conteudo = sc_strip_script($this->tp_thn_release); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_thn_release_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_thn_release_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_thn_release_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_releasename()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_releasename']) || $this->NM_cmp_hidden['tp_releasename'] != "off") { 
          $conteudo = sc_strip_script($this->tp_releasename); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_releasename_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_releasename_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_releasename_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_batch()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_batch']) || $this->NM_cmp_hidden['tp_batch'] != "off") { 
          $conteudo = sc_strip_script($this->tp_batch); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_batch_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_batch_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_batch_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_idlop()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_idlop']) || $this->NM_cmp_hidden['tp_idlop'] != "off") { 
          $conteudo = sc_strip_script($this->tp_idlop); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_idlop_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_idlop_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_idlop_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_mw_namawitel()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['mw_namawitel']) || $this->NM_cmp_hidden['mw_namawitel'] != "off") { 
          $conteudo = sc_strip_script($this->mw_namawitel); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_mw_namawitel_grid_line . "\"  style=\"" . $this->Css_Cmp['css_mw_namawitel_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_mw_namawitel_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_md_namadatel()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['md_namadatel']) || $this->NM_cmp_hidden['md_namadatel'] != "off") { 
          $conteudo = sc_strip_script($this->md_namadatel); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_md_namadatel_grid_line . "\"  style=\"" . $this->Css_Cmp['css_md_namadatel_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_md_namadatel_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ms_namasto()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ms_namasto']) || $this->NM_cmp_hidden['ms_namasto'] != "off") { 
          $conteudo = sc_strip_script($this->ms_namasto); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ms_namasto_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ms_namasto_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ms_namasto_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_statusname()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['statusname']) || $this->NM_cmp_hidden['statusname'] != "off") { 
          $conteudo = sc_strip_script($this->statusname); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_statusname_grid_line . "\"  style=\"" . $this->Css_Cmp['css_statusname_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_statusname_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tm_namamitra()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tm_namamitra']) || $this->NM_cmp_hidden['tm_namamitra'] != "off") { 
          $conteudo = sc_strip_script($this->tm_namamitra); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tm_namamitra_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tm_namamitra_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tm_namamitra_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_projectname()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_projectname']) || $this->NM_cmp_hidden['tp_projectname'] != "off") { 
          $conteudo = sc_strip_script($this->tp_projectname); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_projectname_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_projectname_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_projectname_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tj_namajenis()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tj_namajenis']) || $this->NM_cmp_hidden['tj_namajenis'] != "off") { 
          $conteudo = sc_strip_script($this->tj_namajenis); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tj_namajenis_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tj_namajenis_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tj_namajenis_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_lokasi()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_lokasi']) || $this->NM_cmp_hidden['tp_lokasi'] != "off") { 
          $conteudo = sc_strip_script($this->tp_lokasi); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_lokasi_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_lokasi_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_lokasi_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_odp()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_odp']) || $this->NM_cmp_hidden['tp_odp'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_odp)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_odp_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_odp_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_odp_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_planstart()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_planstart']) || $this->NM_cmp_hidden['tp_planstart'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_planstart)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_planstart_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_planstart_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_planstart_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_planfinish()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_planfinish']) || $this->NM_cmp_hidden['tp_planfinish'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_planfinish)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_planfinish_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_planfinish_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_planfinish_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_targetwaktu()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_targetwaktu']) || $this->NM_cmp_hidden['tp_targetwaktu'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_targetwaktu)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_targetwaktu_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_targetwaktu_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_targetwaktu_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_prepare()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['prepare']) || $this->NM_cmp_hidden['prepare'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->prepare)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "1", "%", "V:" . 4 . ":" . 6, $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_prepare_grid_line . "\"  style=\"" . $this->Css_Cmp['css_prepare_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_prepare_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
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
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "1", "%", "V:" . 4 . ":" . 6, $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_perijinan_grid_line . "\"  style=\"" . $this->Css_Cmp['css_perijinan_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_perijinan_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_inst_testcomm()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['inst_testcomm']) || $this->NM_cmp_hidden['inst_testcomm'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->inst_testcomm)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "1", "%", "V:" . 4 . ":" . 6, $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_inst_testcomm_grid_line . "\"  style=\"" . $this->Css_Cmp['css_inst_testcomm_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_inst_testcomm_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_closing()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['closing']) || $this->NM_cmp_hidden['closing'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->closing)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "1", "%", "V:" . 4 . ":" . 6, $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_closing_grid_line . "\"  style=\"" . $this->Css_Cmp['css_closing_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_closing_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_prosentase()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_prosentase']) || $this->NM_cmp_hidden['tp_prosentase'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_prosentase)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "%", "V:" . 4 . ":" . 6, $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_prosentase_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_prosentase_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">\r\n");
 if (!$this->Ini->SC_Link_View && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf" && $conteudo != "&nbsp;"){ $this->Ind_lig_mult++;
       if (isset($this->Ini->sc_lig_md5["progressproject"]) && $this->Ini->sc_lig_md5["progressproject"] == "S") {
           $Parms_Lig = "nmgp_lig_edit_lapis?#?S?@?var_idproject?#?" . str_replace("'", "@aspass@", $this->tp_id) . "?@?var_idlop?#?" . str_replace("'", "@aspass@", $this->tp_idlop) . "?@?var_prosenpencapaian?#?" . str_replace("'", "@aspass@", $this->tp_prosentase) . "?@?var_lokasi?#?" . str_replace("'", "@aspass@", $this->tp_lokasi) . "?@?";
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard'] && isset($this->Ini->sc_lig_target['C_@scinf_tp_prosentase']))
           {
               if ('' != $Parms_Lig)
               {
                   $Parms_Lig .= '*scout';
               }
               $Parms_Lig .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $this->Ini->sc_lig_target['C_@scinf_tp_prosentase'] . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['compact_mode'] ? '1' : '0');
           }
           $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@list_project_inwitel@SC_par@" . md5($Parms_Lig);
           $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
       } else {
           $Md5_Lig = "nmgp_lig_edit_lapis?#?S?@?var_idproject?#?" . str_replace("'", "@aspass@", $this->tp_id) . "?@?var_idlop?#?" . str_replace("'", "@aspass@", $this->tp_idlop) . "?@?var_prosenpencapaian?#?" . str_replace("'", "@aspass@", $this->tp_prosentase) . "?@?var_lokasi?#?" . str_replace("'", "@aspass@", $this->tp_lokasi) . "?@?";
       }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_progressproject_cons . "', '$this->nm_location', '$Md5_Lig', '" . (isset($this->Ini->sc_lig_target['C_@scinf_tp_prosentase']) ? $this->Ini->sc_lig_target['C_@scinf_tp_prosentase'] : '_self') . "', 'inicio', '0', '0', '', 'progressproject', '" . $this->SC_ancora . "')\" onMouseover=\"nm_mostra_hint(this, event, '')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_tp_prosentase_grid_line . "\" style=\"" . $this->Css_Cmp['css_tp_prosentase_grid_line'] . "\">" . $conteudo . "</a>\r\n");
} else {
   $nm_saida->saida(" $conteudo \r\n");
       } 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_detaiil()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['detaiil']) || $this->NM_cmp_hidden['detaiil'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->detaiil)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_detaiil_grid_line . "\"  style=\"" . $this->Css_Cmp['css_detaiil_grid_line'] . "\"  align=\"\" valign=\"\"  >\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['embutida_treeview'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] != "pdf")
          { 
              $link_div = "";
              $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['ind_tree']++;
              $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['ind_tree'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['v_resume_detailproject'][$this->NM_cont_body][1] = 'top';
              if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp)
              { 
                  $link_div  = "<img id=\"b_open_v_resume_detailproject_" . $this->NM_cont_body . "\" style=\"display:''\" onclick=\"document.getElementById('b_open_v_resume_detailproject_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_close_v_resume_detailproject_" . $this->NM_cont_body . "').style.display = ''; NM_liga_tbody(" . $this->NM_cont_body . ", NM_tab_v_resume_detailproject, 'v_resume_detailproject'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_exp . "\">";
                  $link_div .= "<img id=\"b_close_v_resume_detailproject_" . $this->NM_cont_body . "\" style=\"display:none\" onclick=\"document.getElementById('b_close_v_resume_detailproject_" . $this->NM_cont_body . "').style.display = 'none'; document.getElementById('b_open_v_resume_detailproject_" . $this->NM_cont_body . "').style.display = ''; NM_apaga_tbody(" . $this->NM_cont_body . ", NM_tab_v_resume_detailproject, 'v_resume_detailproject'); return false;\" src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Tree_img_col . "\">";
              }
              $nm_saida->saida("<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">");
              $nm_saida->saida("<TR> <TD align=\"left\">");
              $nm_saida->saida("<DIV id=\"tbody_v_resume_detailproject_" . $this->NM_cont_body . "_top\" style=\"display:''\">");
              $nm_saida->saida($link_div . "</DIV></TD></TR>");
              $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['ind_tree']++;
              $this->NM_cont_body = $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['ind_tree'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']['v_resume_detailproject'][$this->NM_cont_body][1] = 'bot';
              $nm_saida->saida("<tr><td>");
              if ('' != $this->Ini->Tree_img_col && '' != $this->Ini->Tree_img_exp)
              { 
                  $nm_saida->saida("<DIV id=\"tbody_v_resume_detailproject_" . $this->NM_cont_body . "_bot\" style=\"display:none\">");
              }
              else
              { 
                  $nm_saida->saida("<DIV id=\"tbody_v_resume_detailproject_" . $this->NM_cont_body . "_bot\" style=\"display:''\">");
              }
          }
          $GLOBALS["script_case_init"] = $this->Ini->sc_page;
          $GLOBALS["nmgp_parms"] = "nmgp_lig_edit_lapis?#?S?@?var_projectid?#?" . str_replace("'", "@aspass@", $this->tp_id) . "?@?";
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['embutida'] = true;
          if (method_exists($this->v_resume_detailproject, "controle") && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] != "pdf")
          {
              $this->v_resume_detailproject->controle();
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['embutida'] = false;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['emb_lig_aba']))
          { 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
              { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['emb_lig_aba'] = array_merge($this->Ini->Init_apl_lig, $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['emb_lig_aba']);
              }
              else 
              { 
                 $this->Ini->Init_apl_lig = array_merge($this->Ini->Init_apl_lig, $_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['emb_lig_aba']);
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_resume_detailproject']['embutida_treeview'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] != "pdf")
          { 
              $nm_saida->saida("</DIV></td></tr>");
              $nm_saida->saida("</table>");
          }
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_tp_mitra()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_mitra']) || $this->NM_cmp_hidden['tp_mitra'] != "off") { 
          $conteudo = sc_strip_script($this->tp_mitra); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_mitra_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_mitra_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_mitra_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
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
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_witel_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_witel_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_witel_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_sto()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_sto']) || $this->NM_cmp_hidden['tp_sto'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_sto)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_sto_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_sto_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_sto_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_entrydate()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_entrydate']) || $this->NM_cmp_hidden['tp_entrydate'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_entrydate)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_entrydate_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_entrydate_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_entrydate_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_entryby()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_entryby']) || $this->NM_cmp_hidden['tp_entryby'] != "off") { 
          $conteudo = sc_strip_script($this->tp_entryby); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_entryby_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_entryby_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_entryby_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_updatedate()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_updatedate']) || $this->NM_cmp_hidden['tp_updatedate'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_updatedate)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_updatedate_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_updatedate_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_updatedate_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_updateby()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_updateby']) || $this->NM_cmp_hidden['tp_updateby'] != "off") { 
          $conteudo = sc_strip_script($this->tp_updateby); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_updateby_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_updateby_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_updateby_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_summary()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_summary']) || $this->NM_cmp_hidden['tp_summary'] != "off") { 
          $conteudo = sc_strip_script($this->tp_summary); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_summary_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_summary_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_summary_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_status()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_status']) || $this->NM_cmp_hidden['tp_status'] != "off") { 
          $conteudo = sc_strip_script($this->tp_status); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_status_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_status_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_status_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_actualstart()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_actualstart']) || $this->NM_cmp_hidden['tp_actualstart'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_actualstart)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_actualstart_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_actualstart_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_actualstart_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_actualfinish()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_actualfinish']) || $this->NM_cmp_hidden['tp_actualfinish'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_actualfinish)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
               $conteudo_x =  $conteudo;
               nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
               if (is_numeric($conteudo_x) && $conteudo_x > 0) 
               { 
                   $this->nm_data->SetaData($conteudo, "YYYY-MM-DD");
                   $conteudo = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_actualfinish_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_actualfinish_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_actualfinish_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_templateproject()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_templateproject']) || $this->NM_cmp_hidden['tp_templateproject'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_templateproject)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_templateproject_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_templateproject_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_templateproject_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_jenisproject()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_jenisproject']) || $this->NM_cmp_hidden['tp_jenisproject'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_jenisproject)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_jenisproject_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_jenisproject_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_jenisproject_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_prjtrelease()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_prjtrelease']) || $this->NM_cmp_hidden['tp_prjtrelease'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_prjtrelease)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_prjtrelease_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_prjtrelease_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_prjtrelease_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_datel()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_datel']) || $this->NM_cmp_hidden['tp_datel'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tp_datel)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_datel_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_datel_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_datel_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_templatename()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['templatename']) || $this->NM_cmp_hidden['templatename'] != "off") { 
          $conteudo = sc_strip_script($this->templatename); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_templatename_grid_line . "\"  style=\"" . $this->Css_Cmp['css_templatename_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_templatename_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_nokontrak()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_nokontrak']) || $this->NM_cmp_hidden['tp_nokontrak'] != "off") { 
          $conteudo = sc_strip_script($this->tp_nokontrak); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_nokontrak_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_nokontrak_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_nokontrak_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tp_ponumber()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tp_ponumber']) || $this->NM_cmp_hidden['tp_ponumber'] != "off") { 
          $conteudo = sc_strip_script($this->tp_ponumber); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tp_ponumber_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tp_ponumber_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tp_ponumber_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 43;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq'])
   {
       $this->NM_colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida_pdf'] == "pdf")
   {
       $this->NM_colspan--;
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['exibe_seq'] != "S" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
       {
           $this->NM_colspan--; 
       }
   } 
   foreach ($this->NM_cmp_hidden as $Cmp => $Hidden)
   {
       if ($Hidden == "off")
       {
           $this->NM_colspan--;
       }
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "list_project_inwitel/list_project_inwitel_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnSelCamposShow('" . $this->Ini->path_link . "list_project_inwitel/list_project_inwitel_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "selcmp_top", "", "Other Column", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0')", "nm_gp_move('xls', '0')", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['SC_Ind_Groupby'] != "sc_free_total")
        {
        }
          if (is_file("list_project_inwitel_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("list_project_inwitel_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if ($this->nmgp_botoes['exit'] == "on")
      {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('busca', '0', '')", "nm_gp_move('busca', '0', '')", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'] && $this->force_toolbar)
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'] && $this->force_toolbar)
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'];
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
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] == 10) ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] == 20) ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] == 50) ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']))
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
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'];
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim')", "nm_gp_submit_rec('fim')", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['summary'] == "on" && empty($this->nm_grid_sem_reg))
          {
              $nm_sumario = "[" . $this->Ini->Nm_lang['lang_othr_smry_info'] . "]";
              $nm_sumario = str_replace("?start?", $this->nmgp_reg_inicial, $nm_sumario);
              if ($this->Ini->Apl_paginacao == "FULL")
              {
                  $nm_sumario = str_replace("?final?", $this->count_ger, $nm_sumario);
              }
              else
              {
                  $nm_sumario = str_replace("?final?", $this->nmgp_reg_final, $nm_sumario);
              }
              $nm_sumario = str_replace("?total?", $this->count_ger, $nm_sumario);
              $nm_saida->saida("           <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border:0px;\">" . $nm_sumario . "</span>\r\n");
              $NM_btn = true;
          }
          if (is_file("list_project_inwitel_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("list_project_inwitel_help.txt"); 
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
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if ($this->nmgp_botoes['sel_col'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $path_fields = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/fields/";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcolumns", "scBtnSelCamposShow('" . $this->Ini->path_link . "list_project_inwitel/list_project_inwitel_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "scBtnSelCamposShow('" . $this->Ini->path_link . "list_project_inwitel/list_project_inwitel_sel_campos.php?path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_fields=" . $path_fields . "&script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&embbed_groupby=Y&toolbar_pos=top', 'top')", "selcmp_top", "", "Other Column", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
      if ($this->nmgp_botoes['xls'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "nm_gp_move('xls', '0')", "nm_gp_move('xls', '0')", "xls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['SC_Ind_Groupby'] != "sc_free_total")
        {
        }
          if (is_file("list_project_inwitel_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("list_project_inwitel_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if ($this->nmgp_botoes['exit'] == "on")
      {
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('busca', '0', '')", "nm_gp_move('busca', '0', '')", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'] && $this->force_toolbar)
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'] && $this->force_toolbar)
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'];
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
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] == 10) ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] == 20) ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] == 50) ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']))
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
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['qt_lin_grid'];
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim')", "nm_gp_submit_rec('fim')", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
          if ($this->nmgp_botoes['summary'] == "on" && empty($this->nm_grid_sem_reg))
          {
              $nm_sumario = "[" . $this->Ini->Nm_lang['lang_othr_smry_info'] . "]";
              $nm_sumario = str_replace("?start?", $this->nmgp_reg_inicial, $nm_sumario);
              if ($this->Ini->Apl_paginacao == "FULL")
              {
                  $nm_sumario = str_replace("?final?", $this->count_ger, $nm_sumario);
              }
              else
              {
                  $nm_sumario = str_replace("?final?", $this->nmgp_reg_final, $nm_sumario);
              }
              $nm_sumario = str_replace("?total?", $this->count_ger, $nm_sumario);
              $nm_saida->saida("           <span class=\"" . $this->css_css_toolbar_obj . "\" style=\"border:0px;\">" . $nm_sumario . "</span>\r\n");
              $NM_btn = true;
          }
          if (is_file("list_project_inwitel_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("list_project_inwitel_help.txt"); 
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
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
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
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
   { 
        return;
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" &&
        $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao_print'] != "print" && !$this->Print_All) 
   { 
      $nm_saida->saida("     <tr><td colspan=3  class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\"> \r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_B_list_project_inwitel\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_B_list_project_inwitel\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
      $nm_saida->saida("     </td></tr> \r\n");
   } 
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   <div id=\"sc-id-fixedheaders-placeholder\" style=\"display: none; position: fixed; top: 0\"></div>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['embutida'])
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
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
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
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
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
       $nm_saida->saida("   document.getElementById('first_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'first_bot', 'value' => "true");
       }
       $nm_saida->saida("   document.getElementById('back_bot').disabled = true;\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
       {
           $this->Ini->Arr_result['setDisabled'][] = array('field' => 'back_bot', 'value' => "true");
       }
   } 
   $nm_saida->saida("  $(window).scroll(function() {\r\n");
   $nm_saida->saida("   scSetFixedHeaders();\r\n");
   $nm_saida->saida("  }).resize(function() {\r\n");
   $nm_saida->saida("   scSetFixedHeaders();\r\n");
   $nm_saida->saida("  });\r\n");
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           if ($this->arr_buttons['bcons_avanca']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca_off']['style']);
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
               }
           } 
           if ($this->arr_buttons['bcons_final']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final_off']['style']);
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
               }
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           if ($this->arr_buttons['bcons_avanca']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('forward_bot').className = \"scButton_" . $this->arr_buttons['bcons_avanca_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca_off']['style']);
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('forward_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_forward_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
               }
           } 
           if ($this->arr_buttons['bcons_final']['type'] != 'image')
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('last_bot').className = \"scButton_" . $this->arr_buttons['bcons_final_off']['style'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final_off']['style']);
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
                   }
               } 
           } 
           else 
           { 
               $nm_saida->saida("   document.getElementById('last_bot').disabled = true;\r\n");
               $nm_saida->saida("   document.getElementById('id_img_last_bot').src = \"" . $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image'] . "\";\r\n");
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
               }
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "");
       }
   }
   if (isset($this->redir_modal) && !empty($this->redir_modal))
   {
       echo $this->redir_modal;
   }
   $nm_saida->saida("   Tab_lig_apls    = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_init    = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_Type    = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_lab     = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_hint    = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_img_on  = new Array();\r\n");
   $nm_saida->saida("   Tab_lig_img_off = new Array();\r\n");
   if (!empty($this->Ini->Init_apl_lig))
   {
       $ix = 0;
       foreach ($this->Ini->Init_apl_lig as $apls_name => $apls_parm)
       {
           $nm_saida->saida("   Tab_lig_apls[" . $ix . "] = '" . $apls_name . "';\r\n");
           $nm_saida->saida("   Tab_lig_init['" . $apls_name . "'] = '" . $apls_parm['ini'] . "';\r\n");
           $nm_saida->saida("   Tab_lig_Type['" . $apls_name . "'] = '" . $apls_parm['type'] . "';\r\n");
           $nm_saida->saida("   Tab_lig_lab['" . $apls_name . "'] = '" . $apls_parm['lab'] . "';\r\n");
           $nm_saida->saida("   Tab_lig_hint['" . $apls_name . "'] = '" . $apls_parm['hint'] . "';\r\n");
           $nm_saida->saida("   Tab_lig_img_on['" . $apls_name . "'] = '" . $apls_parm['img_on'] . "';\r\n");
           $nm_saida->saida("   Tab_lig_img_off['" . $apls_name . "'] = '" . $apls_parm['img_off'] . "';\r\n");
           $ix++;
       }
   }
   $nm_saida->saida("   </script>\r\n");
   if ($this->grid_emb_form || $this->grid_emb_form_full)
   {
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("      parent.scAjaxDetailHeight('list_project_inwitel', $(document).innerHeight());\r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"list_project_inwitel\"/>\r\n");
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
   $nm_saida->saida("                     action=\"list_project_inwitel_pesq.class.php\" \r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['ajax_nav'])
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
   $nm_saida->saida("      var sob_iframe = '';\r\n");
   if ((isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_modal']) || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard'])) {
       $nm_saida->saida("      sob_iframe += 'parent.';\r\n");
       $nm_saida->saida("      eval (\"var func_menu_aba = \" + sob_iframe + \"parent.createIframe\"); \r\n");
       $nm_saida->saida("      if (typeof func_menu_aba !== 'function') \r\n");
       $nm_saida->saida("      { \r\n");
       $nm_saida->saida("          sob_iframe += 'parent.';\r\n");
       $nm_saida->saida("      } \r\n");
   }
   $nm_saida->saida("      eval (\"var func_menu_aba = \" + sob_iframe + \"parent.createIframe\"); \r\n");
   $nm_saida->saida("      eval (\"var aba_atual = \" + sob_iframe + \"parent.Aba_atual\"); \r\n");
   $nm_saida->saida("      if (apl_name != null && apl_name != '' && typeof func_menu_aba === 'function') \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          for (i = 0; i < Tab_lig_apls.length; i++)\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              if (Tab_lig_apls[i] == apl_name)\r\n");
   $nm_saida->saida("              {\r\n");
   $nm_saida->saida("                  if (opc != null && opc != '') \r\n");
   $nm_saida->saida("                  {\r\n");
   $nm_saida->saida("                      opc = \"grid\";\r\n");
   $nm_saida->saida("                  }\r\n");
   $nm_saida->saida("                  else\r\n");
   $nm_saida->saida("                  {\r\n");
   $nm_saida->saida("                      opc = \"igual\";\r\n");
   $nm_saida->saida("                  }\r\n");
   $nm_saida->saida("                  parms = parms.replace(/\\?#\\?/g, \"*scin\"); \r\n");
   $nm_saida->saida("                  parms = parms.replace(/\\?@\\?/g, \"*scout\"); \r\n");
   $nm_saida->saida("                  apl_lig += '?nmgp_parms=' + parms + '&nm_run_menu=1&nmgp_opcao=' + opc + '&script_case_session=" . session_id() . "' + Tab_lig_init[apl_name];\r\n");
   $nm_saida->saida("                  apl_lig += '&Refresh_aba_menu=' + aba_atual;\r\n");
   $nm_saida->saida("                  func_menu_aba(apl_name, Tab_lig_lab[apl_name], Tab_lig_hint[apl_name], Tab_lig_img_on[apl_name], Tab_lig_img_off[apl_name], apl_lig, Tab_lig_Type[apl_name]);\r\n");
   $nm_saida->saida("                  return;\r\n");
   $nm_saida->saida("              }\r\n");
   $nm_saida->saida("          }\r\n");
   $nm_saida->saida("      }\r\n");
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
   $nm_saida->saida("      var sob_iframe = '';\r\n");
   if ((isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_modal']) || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['dashboard_info']['under_dashboard'])) {
       $nm_saida->saida("      sob_iframe += 'parent.';\r\n");
       $nm_saida->saida("      eval (\"var func_menu_aba = \" + sob_iframe + \"parent.createIframe\"); \r\n");
       $nm_saida->saida("      if (typeof func_menu_aba !== 'function') \r\n");
       $nm_saida->saida("      { \r\n");
       $nm_saida->saida("          sob_iframe += 'parent.';\r\n");
       $nm_saida->saida("      } \r\n");
   }
   $nm_saida->saida("      eval (\"var func_menu_aba = \" + sob_iframe + \"parent.createIframe\"); \r\n");
   $nm_saida->saida("      if (apl_name != null && apl_name != '' && typeof func_menu_aba === 'function') \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          for (i = 0; i < Tab_lig_apls.length; i++)\r\n");
   $nm_saida->saida("          {\r\n");
   $nm_saida->saida("              if (Tab_lig_apls[i] == apl_name)\r\n");
   $nm_saida->saida("              {\r\n");
   $nm_saida->saida("                  parms = parms.replace(/\\?#\\?/g, \"*scin\"); \r\n");
   $nm_saida->saida("                  parms = parms.replace(/\\?@\\?/g, \"*scout\"); \r\n");
   $nm_saida->saida("                  apl_lig += '?nmgp_parms=' + parms + '&nm_run_menu=1&nmgp_opcao=' + opc + '&script_case_session=" . session_id() . "' + Tab_lig_init[apl_name];\r\n");
   $nm_saida->saida("                  func_menu_aba(apl_name, Tab_lig_lab[apl_name], Tab_lig_hint[apl_name], Tab_lig_img_on[apl_name], Tab_lig_img_off[apl_name], apl_lig, Tab_lig_Type[apl_name]);\r\n");
   $nm_saida->saida("                  return;\r\n");
   $nm_saida->saida("              }\r\n");
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
   $nm_saida->saida("          par_modal = '?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nmgp_outra_jan=true&nmgp_url_saida=modal&SC_lig_apl_orig=list_project_inwitel';\r\n");
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
   $nm_saida->saida("      if (pos == \"A\") {obj = document.getElementById('nmsc_iframe_liga_A_list_project_inwitel');} \r\n");
   $nm_saida->saida("      if (pos == \"B\") {obj = document.getElementById('nmsc_iframe_liga_B_list_project_inwitel');} \r\n");
   $nm_saida->saida("      if (pos == \"E\") {obj = document.getElementById('nmsc_iframe_liga_E_list_project_inwitel');} \r\n");
   $nm_saida->saida("      if (pos == \"D\") {obj = document.getElementById('nmsc_iframe_liga_D_list_project_inwitel');} \r\n");
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['list_project_inwitel_iframe_params'] = array(
       'str_tmp'    => $this->Ini->path_imag_temp,
       'str_prod'   => $this->Ini->path_prod,
       'str_btn'    => $this->Ini->Str_btn_css,
       'str_lang'   => $this->Ini->str_lang,
       'str_schema' => $this->Ini->str_schema_all,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?script_case_session?#?" . session_id() . "?@?pbfile?#?" . $str_pbfile . "?@?jspath?#?" . $this->Ini->path_js . "?@?sc_apbgcol?#?" . $this->Ini->path_css . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@list_project_inwitel@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
   $nm_saida->saida("       if (\"pdf\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           window.location = \"" . $this->Ini->path_link . "list_project_inwitel/list_project_inwitel_iframe.php?nmgp_parms=" . $Md5_pdf . "&sc_tp_pdf=\" + z + \"&sc_parms_pdf=\" + p + \"&sc_create_charts=\" + crt + \"&sc_graf_pdf=\" + g;\r\n");
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
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['list_project_inwitel']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Doc = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Doc = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Doc = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['campo_psq_ret'] . "\");\r\n");
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
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['js_apos_busca'] . "();\r\n");
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
   $nm_saida->saida("      document.F5.action = \"list_project_inwitel_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['list_project_inwitel']['reg_start']))
   {
       $nm_saida->saida("      parent.scAjaxDetailStatus('list_project_inwitel');\r\n");
       $nm_saida->saida("      parent.scAjaxDetailHeight('list_project_inwitel', $(document).innerHeight());\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
}
?>
