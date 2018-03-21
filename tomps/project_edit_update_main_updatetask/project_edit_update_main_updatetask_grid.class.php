<?php
class project_edit_update_main_updatetask_grid
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
   var $sum_ppo_targethari;
   var $sum_realisasi;
   var $realisasi;
   var $aktualbenarmulai;
   var $aktualbenarselesai;
   var $cek;
   var $history;
   var $ppo_id;
   var $ppo_projectid;
   var $ppo_tahapanproject;
   var $tmt_namatahapan;
   var $statusname;
   var $ppo_note;
   var $ppo_tasktahapan;
   var $tmt_target62;
   var $ppo_tglmulaiplan;
   var $ppo_targethari;
   var $ppo_targetselesai;
   var $ppo_tglmulaiactual;
   var $ppo_tglselesaiactual;
   var $ppo_tasknumber;
   var $ppo_entrydate;
   var $ppo_entryby;
//--- 
 function monta_grid($linhas = 0)
 {
   global $nm_saida;

   clearstatcache();
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'] == "sc_free_total")
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
       { 
          include_once($this->Ini->path_embutida . "project_edit_update_main_updatetask/" . $this->Ini->Apl_resumo); 
       } 
       else 
       { 
          include_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
       } 
       $this->Res         = new project_edit_update_main_updatetask_resumo();
       $this->Res->Db     = $this->Db;
       $this->Res->Erro   = $this->Erro;
       $this->Res->Ini    = $this->Ini;
       $this->Res->Lookup = $this->Lookup;
   } 
   $this->NM_cor_embutida();
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['field_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['field_display'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['usr_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['php_cmp_sel']))
   {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
       {
           $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_init'])
   { 
        return; 
   } 
   $this->inicializa();
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['charts_html'] = '';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
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
       $nmgrp_apl_opcao= (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['project_edit_update_main_updatetask'])) ? "pdf" : $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'];
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
       $flag_apaga_pdf_log = TRUE;
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf")
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "igual";
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'];
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
   $NM_css = file($this->Ini->root . $this->Ini->path_link . "project_edit_update_main_updatetask/project_edit_update_main_updatetask_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
   foreach ($NM_css as $cada_css)
   {
       $Pos1 = strpos($cada_css, "{");
       $Pos2 = strpos($cada_css, "}");
       $Tag  = trim(substr($cada_css, 1, $Pos1 - 1));
       $Css  = substr($cada_css, $Pos1 + 1, $Pos2 - $Pos1 - 1);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['doc_word'])
       { 
           $this->Css_Cmp[$Tag] = $Css;
       }
       else
       { 
           $this->Css_Cmp[$Tag] = "";
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Lig_Md5'] = array();
   }
   $this->force_toolbar = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['force_toolbar']);
   } 
   $this->width_tabula_quebra  = "0px";
   $this->width_tabula_display = "none";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['lig_edit'];
   }
   $this->grid_emb_form      = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['mostra_edit'] = "N";
       }
   }
   if ($this->Ini->SC_Link_View || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['mostra_edit'] = "N";
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] = array();
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("project_edit_update_main_updatetask", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->nmgp_botoes['first'] = "on";
   $this->nmgp_botoes['back'] = "on";
   $this->nmgp_botoes['forward'] = "on";
   $this->nmgp_botoes['last'] = "on";
   $this->nmgp_botoes['pdf'] = "on";
   $this->nmgp_botoes['goto'] = "on";
   $this->nmgp_botoes['qtline'] = "on";
   $this->nmgp_botoes['navpage'] = "on";
   $this->nmgp_botoes['summary'] = "on";
   $this->nmgp_botoes['groupby'] = "on";
   $this->nmgp_botoes['gridsave'] = "on";
   $this->nmgp_botoes['updateodp'] = "on";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->sc_proc_grid = false; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['doc_word'])
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq_ant'];  
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->ppo_id = $Busca_temp['ppo_id']; 
       $tmp_pos = strpos($this->ppo_id, "##@@");
       if ($tmp_pos !== false && !is_array($this->ppo_id))
       {
           $this->ppo_id = substr($this->ppo_id, 0, $tmp_pos);
       }
       $ppo_id_2 = $Busca_temp['ppo_id_input_2']; 
       $this->ppo_id_2 = $Busca_temp['ppo_id_input_2']; 
       $this->ppo_projectid = $Busca_temp['ppo_projectid']; 
       $tmp_pos = strpos($this->ppo_projectid, "##@@");
       if ($tmp_pos !== false && !is_array($this->ppo_projectid))
       {
           $this->ppo_projectid = substr($this->ppo_projectid, 0, $tmp_pos);
       }
       $ppo_projectid_2 = $Busca_temp['ppo_projectid_input_2']; 
       $this->ppo_projectid_2 = $Busca_temp['ppo_projectid_input_2']; 
       $this->ppo_tahapanproject = $Busca_temp['ppo_tahapanproject']; 
       $tmp_pos = strpos($this->ppo_tahapanproject, "##@@");
       if ($tmp_pos !== false && !is_array($this->ppo_tahapanproject))
       {
           $this->ppo_tahapanproject = substr($this->ppo_tahapanproject, 0, $tmp_pos);
       }
       $ppo_tahapanproject_2 = $Busca_temp['ppo_tahapanproject_input_2']; 
       $this->ppo_tahapanproject_2 = $Busca_temp['ppo_tahapanproject_input_2']; 
       $this->ppo_tasktahapan = $Busca_temp['ppo_tasktahapan']; 
       $tmp_pos = strpos($this->ppo_tasktahapan, "##@@");
       if ($tmp_pos !== false && !is_array($this->ppo_tasktahapan))
       {
           $this->ppo_tasktahapan = substr($this->ppo_tasktahapan, 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "muda_qt_linhas";
   } 
   $NM_opc_rec = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao']; 
       ob_start(); 
   $_SESSION['scriptcase']['project_edit_update_main_updatetask']['contr_erro'] = 'on';
if (!isset($_SESSION['var_projectid'])) {$_SESSION['var_projectid'] = "";}
if (!isset($this->sc_temp_var_projectid)) {$this->sc_temp_var_projectid = (isset($_SESSION['var_projectid'])) ? $_SESSION['var_projectid'] : "";}
if (!isset($_SESSION['glo_aktualsebelumnya'])) {$_SESSION['glo_aktualsebelumnya'] = "";}
if (!isset($this->sc_temp_glo_aktualsebelumnya)) {$this->sc_temp_glo_aktualsebelumnya = (isset($_SESSION['glo_aktualsebelumnya'])) ? $_SESSION['glo_aktualsebelumnya'] : "";}
if (!isset($_SESSION['glo_aktualbenarselesai'])) {$_SESSION['glo_aktualbenarselesai'] = "";}
if (!isset($this->sc_temp_glo_aktualbenarselesai)) {$this->sc_temp_glo_aktualbenarselesai = (isset($_SESSION['glo_aktualbenarselesai'])) ? $_SESSION['glo_aktualbenarselesai'] : "";}
if (!isset($_SESSION['glo_aktualbenarmulai'])) {$_SESSION['glo_aktualbenarmulai'] = "";}
if (!isset($this->sc_temp_glo_aktualbenarmulai)) {$this->sc_temp_glo_aktualbenarmulai = (isset($_SESSION['glo_aktualbenarmulai'])) ? $_SESSION['glo_aktualbenarmulai'] : "";}
if (!isset($_SESSION['glob_jumlahrealisasi'])) {$_SESSION['glob_jumlahrealisasi'] = "";}
if (!isset($this->sc_temp_glob_jumlahrealisasi)) {$this->sc_temp_glob_jumlahrealisasi = (isset($_SESSION['glob_jumlahrealisasi'])) ? $_SESSION['glob_jumlahrealisasi'] : "";}
if (!isset($_SESSION['glo_jumlahtarget'])) {$_SESSION['glo_jumlahtarget'] = "";}
if (!isset($this->sc_temp_glo_jumlahtarget)) {$this->sc_temp_glo_jumlahtarget = (isset($_SESSION['glo_jumlahtarget'])) ? $_SESSION['glo_jumlahtarget'] : "";}
if (!isset($_SESSION['var_templateproject'])) {$_SESSION['var_templateproject'] = "";}
if (!isset($this->sc_temp_var_templateproject)) {$this->sc_temp_var_templateproject = (isset($_SESSION['var_templateproject'])) ? $_SESSION['var_templateproject'] : "";}
if (!isset($_SESSION['var_tahapanproject'])) {$_SESSION['var_tahapanproject'] = "";}
if (!isset($this->sc_temp_var_tahapanproject)) {$this->sc_temp_var_tahapanproject = (isset($_SESSION['var_tahapanproject'])) ? $_SESSION['var_tahapanproject'] : "";}
 if ( $this->sc_temp_var_tahapanproject  =='3' ) {
	$this->nmgp_botoes["updateodp"] = "on";;
	} else {
	$this->nmgp_botoes["updateodp"] = "off";;
	}
	
$templateproject =$this->sc_temp_var_templateproject;
$this->sc_temp_glo_jumlahtarget='0';
$this->sc_temp_glob_jumlahrealisasi='0';
$this->sc_temp_glo_aktualbenarmulai='0';
$this->sc_temp_glo_aktualbenarselesai='0';
$this->sc_temp_glo_aktualsebelumnya='0';
if ($this->ppo_tahapanproject  != '1') {
$check_sql = "select ppo_tglselesaiactual from TBL_PROJECT_DETAIL
where PPO_PROJECTID='$this->sc_temp_var_projectid' and PPO_TAHAPANPROJECT=$this->sc_temp_var_tahapanproject-1
order by PPO_TASKNUMBER desc limit 1
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

if (isset($this->rs[0][0]))     
{
    $this->sc_temp_glo_aktualsebelumnya = $this->rs[0][0];
}
		else     
{
		    $this->sc_temp_glo_aktualsebelumnya = '';
}
	}
if (isset($this->sc_temp_var_tahapanproject)) {$_SESSION['var_tahapanproject'] = $this->sc_temp_var_tahapanproject;}
if (isset($this->sc_temp_var_templateproject)) {$_SESSION['var_templateproject'] = $this->sc_temp_var_templateproject;}
if (isset($this->sc_temp_glo_jumlahtarget)) {$_SESSION['glo_jumlahtarget'] = $this->sc_temp_glo_jumlahtarget;}
if (isset($this->sc_temp_glob_jumlahrealisasi)) {$_SESSION['glob_jumlahrealisasi'] = $this->sc_temp_glob_jumlahrealisasi;}
if (isset($this->sc_temp_glo_aktualbenarmulai)) {$_SESSION['glo_aktualbenarmulai'] = $this->sc_temp_glo_aktualbenarmulai;}
if (isset($this->sc_temp_glo_aktualbenarselesai)) {$_SESSION['glo_aktualbenarselesai'] = $this->sc_temp_glo_aktualbenarselesai;}
if (isset($this->sc_temp_glo_aktualsebelumnya)) {$_SESSION['glo_aktualsebelumnya'] = $this->sc_temp_glo_aktualsebelumnya;}
if (isset($this->sc_temp_var_projectid)) {$_SESSION['var_projectid'] = $this->sc_temp_var_projectid;}
$_SESSION['scriptcase']['project_edit_update_main_updatetask']['contr_erro'] = 'off'; 
       $this->SC_Buf_onInit = ob_get_clean();; 

   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['maximized']) {
       $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['dashboard_app'];
       if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['project_edit_update_main_updatetask'])) {
           $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['project_edit_update_main_updatetask'];

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

   if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']['insert'] != '')
   {
       $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']['insert'];
       $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']['insert'];
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']['update'] != '')
   {
       $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']['update'];
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']['delete'] != '')
   {
       $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask_detail']['delete'];
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "project_edit_update_main_updatetask/project_edit_update_main_updatetask_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "project_edit_update_main_updatetask_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_pdf'] != "pdf")  
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_pdf'] = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new project_edit_update_main_updatetask_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid']))
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] = 10;
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['rows'];  
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_select']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_select'] = array(); 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_select']['PPO_TAHAPANPROJECT'] = 'ASC'; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_select']['PPO_TASKNUMBER'] = 'ASC'; 
       } 
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'] == "sc_free_total") 
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_quebra']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_quebra'] = array(); 
       } 
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_desc'] = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_cmp']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_label'] = "";  
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       if (!isset($this->Cmps_ord_def[$nmgp_ordem])) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "igual" ;  
       }
       else
       { 
           $Ordem_tem_quebra = false;
           foreach($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_quebra'] as $campo => $resto) 
           {
               foreach($resto as $sqldef => $ordem) 
               {
                   if ($sqldef == $nmgp_ordem) 
                   { 
                       $Ordem_tem_quebra = true;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "inicio" ;  
                       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid'] = ""; 
                       $ordem = ($ordem == "asc") ? "desc" : "asc";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_quebra'][$campo][$nmgp_ordem] = $ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_cmp'] = $nmgp_ordem;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_label'] = trim($ordem);
                   }   
               }   
           }   
           if (!$Ordem_tem_quebra)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid'] = $nmgp_ordem  ; 
           }
       }
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "inicio" ;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid'])  
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_desc'] != " desc")  
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_desc'] = " desc" ; 
           } 
           else   
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_desc'] = " asc" ;  
           } 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_desc'] = $this->Cmps_ord_def[$nmgp_ordem];  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_label'] = trim($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_desc']);  
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_cmp'] = $nmgp_ordem;  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_orig'] = " where PPO_PROJECTID='" . $_SESSION['var_projectid'] . "' AND PPO_TAHAPANPROJECT = '" . $_SESSION['var_tahapanproject'] . "'";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "final" ; 
       } 
       else 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "avanca" ; 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final'] = $rec; 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final'] > 0) 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final']-- ; 
           } 
       } 
   } 
   $this->NM_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao']; 
   if ($this->NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao']       = "igual" ; 
   } 
// 
   $this->count_ger = 0;
   $this->sum_ppo_targethari = 0;
   $this->sum_realisasi = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'] != "sc_free_total") 
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "final" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid'] == "all") 
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'];
           $this->Tot->$Gb_geral();
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][1] ;  
           $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][1];
       } 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_total']);
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'] == "sc_free_total")
       { 
           $this->totaliza_php_sc_free_total() ; 
       } 
       else 
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'];
           $this->Tot->$Gb_geral();
       } 
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][1] ;  
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][1];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] = 0 ; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] > 0) 
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
       $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, TMT_NAMATAHAPAN, STATUSNAME, PPO_NOTE, PPO_TASKTAHAPAN, TMT_TARGET62, str_replace (convert(char(10),PPO_TGLMULAIPLAN,102), '.', '-') + ' ' + convert(char(8),PPO_TGLMULAIPLAN,20), PPO_TARGETHARI, str_replace (convert(char(10),PPO_TARGETSELESAI,102), '.', '-') + ' ' + convert(char(8),PPO_TARGETSELESAI,20), str_replace (convert(char(10),PPO_TGLMULAIACTUAL,102), '.', '-') + ' ' + convert(char(8),PPO_TGLMULAIACTUAL,20), str_replace (convert(char(10),PPO_TGLSELESAIACTUAL,102), '.', '-') + ' ' + convert(char(8),PPO_TGLSELESAIACTUAL,20), PPO_TASKNUMBER, str_replace (convert(char(10),PPO_ENTRYDATE,102), '.', '-') + ' ' + convert(char(8),PPO_ENTRYDATE,20), PPO_ENTRYBY from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, TMT_NAMATAHAPAN, STATUSNAME, PPO_NOTE, PPO_TASKTAHAPAN, TMT_TARGET62, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_ENTRYDATE, PPO_ENTRYBY from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, TMT_NAMATAHAPAN, STATUSNAME, PPO_NOTE, PPO_TASKTAHAPAN, TMT_TARGET62, convert(char(23),PPO_TGLMULAIPLAN,121), PPO_TARGETHARI, convert(char(23),PPO_TARGETSELESAI,121), convert(char(23),PPO_TGLMULAIACTUAL,121), convert(char(23),PPO_TGLSELESAIACTUAL,121), PPO_TASKNUMBER, convert(char(23),PPO_ENTRYDATE,121), PPO_ENTRYBY from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, TMT_NAMATAHAPAN, STATUSNAME, PPO_NOTE, PPO_TASKTAHAPAN, TMT_TARGET62, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_ENTRYDATE, PPO_ENTRYBY from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, TMT_NAMATAHAPAN, STATUSNAME, PPO_NOTE, PPO_TASKTAHAPAN, TMT_TARGET62, EXTEND(PPO_TGLMULAIPLAN, YEAR TO FRACTION), PPO_TARGETHARI, EXTEND(PPO_TARGETSELESAI, YEAR TO FRACTION), EXTEND(PPO_TGLMULAIACTUAL, YEAR TO FRACTION), EXTEND(PPO_TGLSELESAIACTUAL, YEAR TO FRACTION), PPO_TASKNUMBER, EXTEND(PPO_ENTRYDATE, YEAR TO FRACTION), PPO_ENTRYBY from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT PPO_ID, PPO_PROJECTID, PPO_TAHAPANPROJECT, TMT_NAMATAHAPAN, STATUSNAME, PPO_NOTE, PPO_TASKTAHAPAN, TMT_TARGET62, PPO_TGLMULAIPLAN, PPO_TARGETHARI, PPO_TARGETSELESAI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER, PPO_ENTRYDATE, PPO_ENTRYBY from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_desc']; 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
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
       $this->ppo_id = $this->rs_grid->fields[0] ;  
       $this->ppo_id = (string)$this->ppo_id;
       $this->ppo_projectid = $this->rs_grid->fields[1] ;  
       $this->ppo_projectid = (string)$this->ppo_projectid;
       $this->ppo_tahapanproject = $this->rs_grid->fields[2] ;  
       $this->ppo_tahapanproject = (string)$this->ppo_tahapanproject;
       $this->tmt_namatahapan = $this->rs_grid->fields[3] ;  
       $this->statusname = $this->rs_grid->fields[4] ;  
       $this->ppo_note = $this->rs_grid->fields[5] ;  
       $this->ppo_tasktahapan = $this->rs_grid->fields[6] ;  
       $this->tmt_target62 = $this->rs_grid->fields[7] ;  
       $this->tmt_target62 = (string)$this->tmt_target62;
       $this->ppo_tglmulaiplan = $this->rs_grid->fields[8] ;  
       $this->ppo_targethari = $this->rs_grid->fields[9] ;  
       $this->ppo_targethari = (string)$this->ppo_targethari;
       $this->ppo_targetselesai = $this->rs_grid->fields[10] ;  
       $this->ppo_tglmulaiactual = $this->rs_grid->fields[11] ;  
       $this->ppo_tglselesaiactual = $this->rs_grid->fields[12] ;  
       $this->ppo_tasknumber = $this->rs_grid->fields[13] ;  
       $this->ppo_tasknumber = (string)$this->ppo_tasknumber;
       $this->ppo_entrydate = $this->rs_grid->fields[14] ;  
       $this->ppo_entryby = $this->rs_grid->fields[15] ;  
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $this->SC_seq_page = 0;
       $this->SC_sep_quebra = false;
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->ppo_id = $this->rs_grid->fields[0] ;  
           $this->ppo_projectid = $this->rs_grid->fields[1] ;  
           $this->ppo_tahapanproject = $this->rs_grid->fields[2] ;  
           $this->tmt_namatahapan = $this->rs_grid->fields[3] ;  
           $this->statusname = $this->rs_grid->fields[4] ;  
           $this->ppo_note = $this->rs_grid->fields[5] ;  
           $this->ppo_tasktahapan = $this->rs_grid->fields[6] ;  
           $this->tmt_target62 = $this->rs_grid->fields[7] ;  
           $this->ppo_tglmulaiplan = $this->rs_grid->fields[8] ;  
           $this->ppo_targethari = $this->rs_grid->fields[9] ;  
           $this->ppo_targetselesai = $this->rs_grid->fields[10] ;  
           $this->ppo_tglmulaiactual = $this->rs_grid->fields[11] ;  
           $this->ppo_tglselesaiactual = $this->rs_grid->fields[12] ;  
           $this->ppo_tasknumber = $this->rs_grid->fields[13] ;  
           $this->ppo_entrydate = $this->rs_grid->fields[14] ;  
           $this->ppo_entryby = $this->rs_grid->fields[15] ;  
       } 
   } 
   $this->nmgp_reg_inicial = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final'] + 1;
   $this->nmgp_reg_final   = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid'];
   $this->nmgp_reg_final   = ($this->nmgp_reg_final > $this->count_ger) ? $this->count_ger : $this->nmgp_reg_final;
   if ($NM_opc_rec == "rec") 
   { 
       $_SESSION['scriptcase']['project_edit_update_main_updatetask']['contr_erro'] = 'on';
if (!isset($_SESSION['var_tahapanproject'])) {$_SESSION['var_tahapanproject'] = "";}
if (!isset($this->sc_temp_var_tahapanproject)) {$this->sc_temp_var_tahapanproject = (isset($_SESSION['var_tahapanproject'])) ? $_SESSION['var_tahapanproject'] : "";}
 if ( $this->sc_temp_var_tahapanproject  =='3' ) {
	$this->nmgp_botoes["updateodp"] = "on";;
	} else {
	$this->nmgp_botoes["updateodp"] = "off";;
	}
if (isset($this->sc_temp_var_tahapanproject)) {$_SESSION['var_tahapanproject'] = $this->sc_temp_var_tahapanproject;}
$_SESSION['scriptcase']['project_edit_update_main_updatetask']['contr_erro'] = 'off'; 
   } 
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   { 
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['pdf_res'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>View :: PDF</TITLE>
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
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['pivot_charts']) : 0;
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
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['doc_word'])
       {
           $nm_saida->saida("  <html xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" xmlns:m=\"http://schemas.microsoft.com/office/2004/12/omml\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
       $nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
       $nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>View</TITLE>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
           $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\" />\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['doc_word'])
       {
           $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
           $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"project_edit_update_main_updatetask_jquery.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"project_edit_update_main_updatetask_ajax.js\"></script>\r\n");
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
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           $nm_saida->saida("   var SC_Link_View = false;\r\n");
           if ($this->Ini->SC_Link_View)
           {
               $nm_saida->saida("   SC_Link_View = true;\r\n");
           }
           $nm_saida->saida("   var scQSInit = true;\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] || $this->Ini->Apl_paginacao == "FULL")
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($this->count_ger) . ";\r\n");
           }
           else
           {
               $nm_saida->saida("   var scQtReg  = " . NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid']) . ";\r\n");
           }
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
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ancor_save']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ancor_save']))
           {
               $nm_saida->saida("       var catTopPosition = jQuery('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ancor_save'] . "').offset().top;\r\n");
               $nm_saida->saida("       jQuery('html, body').animate({scrollTop:catTopPosition}, 'fast');\r\n");
               $nm_saida->saida("       $('#SC_ancor" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ancor_save'] . "').addClass('" . $this->css_scGridFieldOver . "');\r\n");
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ancor_save']);
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
           $nm_saida->saida("       url: \"project_edit_update_main_updatetask_save_grid.php\",\r\n");
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
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['num_css'] = rand(0, 1000);
       }
       $write_css = true;
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && !$this->Print_All && $this->NM_opcao != "print" && $this->NM_opcao != "pdf")
       {
           $write_css = false;
       }
       if ($write_css) {$NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_project_edit_update_main_updatetask_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['num_css'] . '.css', 'w');}
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
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
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_project_edit_update_main_updatetask_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['num_css'] . '.css');
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
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_project_edit_update_main_updatetask_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
       }
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       $nm_saida->saida("  <style type=\"text/css\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_pdf'] != "pdf")
       {
           $nm_saida->saida("  .css_iframes   { margin-bottom: 0px; margin-left: 0px;  margin-right: 0px;  margin-top: 0px; }\r\n");
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
       { 
           $nm_saida->saida("       .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;color:black;}\r\n");
       } 
       $nm_saida->saida("  </style>\r\n");
       if (!$write_css)
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "project_edit_update_main_updatetask/project_edit_update_main_updatetask_grid_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
       }
       else
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_link . "project_edit_update_main_updatetask/project_edit_update_main_updatetask_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $this->Ini->nm_ger_css_emb)
   {
       $this->Ini->nm_ger_css_emb = false;
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
       $NM_css = file($this->Ini->root . $this->Ini->path_link . "project_edit_update_main_updatetask/project_edit_update_main_updatetask_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
       foreach ($NM_css as $cada_css)
       {
           $cada_css = ".project_edit_update_main_updatetask_" . substr($cada_css, 1);
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
       }
           $nm_saida->saida("  </style>\r\n");
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   { 
       $nm_saida->saida("  <body class=\"" . $this->css_scGridPage . "\" " . $str_iframe_body . " style=\"" . $css_body . "\">\r\n");
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && !$this->Print_All)
       { 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none; position: absolute; left: 50px; top: 50px\"><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
       } 
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf" && !$this->Print_All)
       { 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'] == "sc_free_total")
           {
           $nm_saida->saida("          <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
           }
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['doc_word'])
       { 
           $nm_saida->saida("      <div id=\"tooltip\" style=\"position:absolute;visibility:hidden;border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;padding:1px;color:black;\"></div>\r\n");
       } 
       $this->Tab_align  = "center";
       $this->Tab_valign = "top";
       $this->Tab_width = "";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
       { 
           $this->form_navegacao();
           if ($NM_run_iframe != 1) {$this->check_btns();}
       } 
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $this->Tab_align . "\" valign=\"" . $this->Tab_valign . "\" " . $this->Tab_width . ">\r\n");
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"" . $this->css_scGridLabel . "\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print") 
       { 
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD  colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_A_project_edit_update_main_updatetask\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_A_project_edit_update_main_updatetask\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
           $nm_saida->saida("    <TR>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_E_project_edit_update_main_updatetask\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_E_project_edit_update_main_updatetask\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <td style=\"padding: 0px;  vertical-align: top;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\"><tr>\r\n");
           $nm_saida->saida("    <TD colspan=3 style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_AL_project_edit_update_main_updatetask\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_AL_project_edit_update_main_updatetask\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
        } 
   }  
 }  
 function NM_cor_embutida()
 {  
   $compl_css = "";
   include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   {
       $this->arr_buttons = array_merge($this->arr_buttons, $this->Ini->arr_buttons_usr);
       $this->NM_css_val_embed = "sznmxizkjnvl";
       $this->NM_css_ajx_embed = "Ajax_res";
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_herda_css'] == "N")
   {
       if (($this->NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($this->NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['project_edit_update_main_updatetask']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['project_edit_update_main_updatetask']) . "_";
           } 
       } 
       else 
       { 
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['project_edit_update_main_updatetask']))
           {
               $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['project_edit_update_main_updatetask']) . "_";
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

   $compl_css_emb = ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida']) ? "project_edit_update_main_updatetask_" : "";
   $this->css_sep = " ";
   $this->css_ppo_id_label = $compl_css_emb . "css_ppo_id_label";
   $this->css_ppo_id_grid_line = $compl_css_emb . "css_ppo_id_grid_line";
   $this->css_ppo_projectid_label = $compl_css_emb . "css_ppo_projectid_label";
   $this->css_ppo_projectid_grid_line = $compl_css_emb . "css_ppo_projectid_grid_line";
   $this->css_ppo_tahapanproject_label = $compl_css_emb . "css_ppo_tahapanproject_label";
   $this->css_ppo_tahapanproject_grid_line = $compl_css_emb . "css_ppo_tahapanproject_grid_line";
   $this->css_tmt_namatahapan_label = $compl_css_emb . "css_tmt_namatahapan_label";
   $this->css_tmt_namatahapan_grid_line = $compl_css_emb . "css_tmt_namatahapan_grid_line";
   $this->css_statusname_label = $compl_css_emb . "css_statusname_label";
   $this->css_statusname_grid_line = $compl_css_emb . "css_statusname_grid_line";
   $this->css_ppo_note_label = $compl_css_emb . "css_ppo_note_label";
   $this->css_ppo_note_grid_line = $compl_css_emb . "css_ppo_note_grid_line";
   $this->css_ppo_tasktahapan_label = $compl_css_emb . "css_ppo_tasktahapan_label";
   $this->css_ppo_tasktahapan_grid_line = $compl_css_emb . "css_ppo_tasktahapan_grid_line";
   $this->css_tmt_target62_label = $compl_css_emb . "css_tmt_target62_label";
   $this->css_tmt_target62_grid_line = $compl_css_emb . "css_tmt_target62_grid_line";
   $this->css_ppo_tglmulaiplan_label = $compl_css_emb . "css_ppo_tglmulaiplan_label";
   $this->css_ppo_tglmulaiplan_grid_line = $compl_css_emb . "css_ppo_tglmulaiplan_grid_line";
   $this->css_ppo_targethari_label = $compl_css_emb . "css_ppo_targethari_label";
   $this->css_ppo_targethari_grid_line = $compl_css_emb . "css_ppo_targethari_grid_line";
   $this->css_ppo_targetselesai_label = $compl_css_emb . "css_ppo_targetselesai_label";
   $this->css_ppo_targetselesai_grid_line = $compl_css_emb . "css_ppo_targetselesai_grid_line";
   $this->css_ppo_tglmulaiactual_label = $compl_css_emb . "css_ppo_tglmulaiactual_label";
   $this->css_ppo_tglmulaiactual_grid_line = $compl_css_emb . "css_ppo_tglmulaiactual_grid_line";
   $this->css_realisasi_label = $compl_css_emb . "css_realisasi_label";
   $this->css_realisasi_grid_line = $compl_css_emb . "css_realisasi_grid_line";
   $this->css_ppo_tglselesaiactual_label = $compl_css_emb . "css_ppo_tglselesaiactual_label";
   $this->css_ppo_tglselesaiactual_grid_line = $compl_css_emb . "css_ppo_tglselesaiactual_grid_line";
   $this->css_aktualbenarmulai_label = $compl_css_emb . "css_aktualbenarmulai_label";
   $this->css_aktualbenarmulai_grid_line = $compl_css_emb . "css_aktualbenarmulai_grid_line";
   $this->css_aktualbenarselesai_label = $compl_css_emb . "css_aktualbenarselesai_label";
   $this->css_aktualbenarselesai_grid_line = $compl_css_emb . "css_aktualbenarselesai_grid_line";
   $this->css_cek_label = $compl_css_emb . "css_cek_label";
   $this->css_cek_grid_line = $compl_css_emb . "css_cek_grid_line";
   $this->css_ppo_tasknumber_label = $compl_css_emb . "css_ppo_tasknumber_label";
   $this->css_ppo_tasknumber_grid_line = $compl_css_emb . "css_ppo_tasknumber_grid_line";
   $this->css_history_label = $compl_css_emb . "css_history_label";
   $this->css_history_grid_line = $compl_css_emb . "css_history_grid_line";
   $this->css_ppo_entrydate_label = $compl_css_emb . "css_ppo_entrydate_label";
   $this->css_ppo_entrydate_grid_line = $compl_css_emb . "css_ppo_entrydate_grid_line";
   $this->css_ppo_entryby_label = $compl_css_emb . "css_ppo_entryby_label";
   $this->css_ppo_entryby_grid_line = $compl_css_emb . "css_ppo_entryby_grid_line";
 }  
// 
//----- 
 function cabecalho()
 {
   global
          $nm_saida;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['maximized'])
   {
       return; 
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['cab']))
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
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq_filtro'];
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cond_pesq']))
   {  
       $pos       = 0;
       $trab_pos  = false;
       $pos_tmp   = true; 
       $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cond_pesq'];
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
       $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
       $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
       $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cond_pesq'], 0, $trab_pos);
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf")
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
   $nm_saida->saida("          " . "LOP : " . $_SESSION['var_LOP'] . " , Nama Project : " . $_SESSION['var_namaproject'] . " , Lokasi : " . $_SESSION['var_lokasi'] . "" . "\r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['exibe_titulos'] != "S")
   { 
   } 
   else 
   { 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_label'])
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
   $nm_saida->saida("    <TR class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-project_edit_update_main_updatetask-" . $tmp_header_row . "\" align=\"center\">\r\n");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_label'])
      { 
       $nm_saida->saida("      <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
      } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
   {
       $nm_saida->saida("      <TD class=\"" . $this->css_scGridLabelFont . "\">&nbsp;</TD>\r\n");
   }
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf")
   {
       $nm_saida->saida("      <TD class=\"" . $this->css_scGridLabelFont . "\">&nbsp;</TD>\r\n");
   }
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C1_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C2_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C3_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C4_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C5_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C6_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C7_label\" colspan=3 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C7_label'] . "\">Plan</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C8_label\" colspan=3 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C8_label'] . "\">Aktual</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C9_label\" colspan=3 style=\"" . $this->css_scGridLabelNowrap . $this->Css_Cmp['css_L1C9_label'] . "\">Bantuan Aktual</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C10_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C11_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C12_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . " css_L1C13_label\">&nbsp;</TD>\r\n");
   $nm_saida->saida("    </TR>\r\n");
   $nm_saida->saida("    <TR id=\"tit_project_edit_update_main_updatetask__SCCS__" . $nm_seq_titulos . "\" align=\"center\" class=\"" . $this->css_scGridLabel . " sc-ui-grid-header-row sc-ui-grid-header-row-project_edit_update_main_updatetask-" . $tmp_header_row . "\">\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_label']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_entryby_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq']) { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_entryby_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_entryby_label'] . "\" >&nbsp;</TD>\r\n");
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['field_order'] as $Cada_label)
   { 
       $NM_func_lab = "NM_label_" . $Cada_label;
       $this->$NM_func_lab();
   } 
   $nm_saida->saida("</TR>\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_label'])
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
             $NM_css = file($this->Ini->root . $this->Ini->path_link . "project_edit_update_main_updatetask/project_edit_update_main_updatetask_grid_" .strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css");
             foreach ($NM_css as $cada_css)
             {
                 $css_emb .= ".project_edit_update_main_updatetask_" . substr($cada_css, 1);
             }
             $css_emb .= "</style>";
             $Cod_Html = $css_emb . $Cod_Html;
             $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cols_emb'] = count($Nm_temp) - 1;
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
 function NM_label_ppo_id()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_id'])) ? $this->New_label['ppo_id'] : "ID Table"; 
   if (!isset($this->NM_cmp_hidden['ppo_id']) || $this->NM_cmp_hidden['ppo_id'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_id_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_id_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_projectid()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_projectid'])) ? $this->New_label['ppo_projectid'] : "ID Project"; 
   if (!isset($this->NM_cmp_hidden['ppo_projectid']) || $this->NM_cmp_hidden['ppo_projectid'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_projectid_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_projectid_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_tahapanproject()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_tahapanproject'])) ? $this->New_label['ppo_tahapanproject'] : "ID Tahapan Project"; 
   if (!isset($this->NM_cmp_hidden['ppo_tahapanproject']) || $this->NM_cmp_hidden['ppo_tahapanproject'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_tahapanproject_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_tahapanproject_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_tmt_namatahapan()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tmt_namatahapan'])) ? $this->New_label['tmt_namatahapan'] : "Tahapan Project"; 
   if (!isset($this->NM_cmp_hidden['tmt_namatahapan']) || $this->NM_cmp_hidden['tmt_namatahapan'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tmt_namatahapan_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tmt_namatahapan_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_statusname()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['statusname'])) ? $this->New_label['statusname'] : "Status Task"; 
   if (!isset($this->NM_cmp_hidden['statusname']) || $this->NM_cmp_hidden['statusname'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_statusname_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_statusname_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_note()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_note'])) ? $this->New_label['ppo_note'] : "Catatan"; 
   if (!isset($this->NM_cmp_hidden['ppo_note']) || $this->NM_cmp_hidden['ppo_note'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_note_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_note_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_tasktahapan()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_tasktahapan'])) ? $this->New_label['ppo_tasktahapan'] : "Tahapan Task"; 
   if (!isset($this->NM_cmp_hidden['ppo_tasktahapan']) || $this->NM_cmp_hidden['ppo_tasktahapan'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_tasktahapan_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_tasktahapan_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_tmt_target62()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['tmt_target62'])) ? $this->New_label['tmt_target62'] : "Milestone"; 
   if (!isset($this->NM_cmp_hidden['tmt_target62']) || $this->NM_cmp_hidden['tmt_target62'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_tmt_target62_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_tmt_target62_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_tglmulaiplan()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_tglmulaiplan'])) ? $this->New_label['ppo_tglmulaiplan'] : "Tgl Mulai (Plan)"; 
   if (!isset($this->NM_cmp_hidden['ppo_tglmulaiplan']) || $this->NM_cmp_hidden['ppo_tglmulaiplan'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_tglmulaiplan_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_tglmulaiplan_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_targethari()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_targethari'])) ? $this->New_label['ppo_targethari'] : "Target"; 
   if (!isset($this->NM_cmp_hidden['ppo_targethari']) || $this->NM_cmp_hidden['ppo_targethari'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_targethari_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_targethari_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_targetselesai()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_targetselesai'])) ? $this->New_label['ppo_targetselesai'] : "Tgl Selesai (Plan)"; 
   if (!isset($this->NM_cmp_hidden['ppo_targetselesai']) || $this->NM_cmp_hidden['ppo_targetselesai'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_targetselesai_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_targetselesai_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_tglmulaiactual()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_tglmulaiactual'])) ? $this->New_label['ppo_tglmulaiactual'] : "Tgl Mulai (aktual)"; 
   if (!isset($this->NM_cmp_hidden['ppo_tglmulaiactual']) || $this->NM_cmp_hidden['ppo_tglmulaiactual'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_tglmulaiactual_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_tglmulaiactual_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_realisasi()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['realisasi'])) ? $this->New_label['realisasi'] : "Realisasi"; 
   if (!isset($this->NM_cmp_hidden['realisasi']) || $this->NM_cmp_hidden['realisasi'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_realisasi_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_realisasi_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_tglselesaiactual()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_tglselesaiactual'])) ? $this->New_label['ppo_tglselesaiactual'] : "Tgl Selesai (aktual)"; 
   if (!isset($this->NM_cmp_hidden['ppo_tglselesaiactual']) || $this->NM_cmp_hidden['ppo_tglselesaiactual'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_tglselesaiactual_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_tglselesaiactual_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_aktualbenarmulai()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['aktualbenarmulai'])) ? $this->New_label['aktualbenarmulai'] : "aktualbenarmulai"; 
   if (!isset($this->NM_cmp_hidden['aktualbenarmulai']) || $this->NM_cmp_hidden['aktualbenarmulai'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_aktualbenarmulai_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_aktualbenarmulai_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_aktualbenarselesai()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['aktualbenarselesai'])) ? $this->New_label['aktualbenarselesai'] : "Selesai Ref."; 
   if (!isset($this->NM_cmp_hidden['aktualbenarselesai']) || $this->NM_cmp_hidden['aktualbenarselesai'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_aktualbenarselesai_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_aktualbenarselesai_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_cek()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['cek'])) ? $this->New_label['cek'] : "Cek"; 
   if (!isset($this->NM_cmp_hidden['cek']) || $this->NM_cmp_hidden['cek'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_cek_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_cek_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_tasknumber()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_tasknumber'])) ? $this->New_label['ppo_tasknumber'] : "TaskNo."; 
   if (!isset($this->NM_cmp_hidden['ppo_tasknumber']) || $this->NM_cmp_hidden['ppo_tasknumber'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_tasknumber_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_tasknumber_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_history()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['history'])) ? $this->New_label['history'] : "History"; 
   if (!isset($this->NM_cmp_hidden['history']) || $this->NM_cmp_hidden['history'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_history_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_history_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_entrydate()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_entrydate'])) ? $this->New_label['ppo_entrydate'] : "PPO ENTRYDATE"; 
   if (!isset($this->NM_cmp_hidden['ppo_entrydate']) || $this->NM_cmp_hidden['ppo_entrydate'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_entrydate_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_entrydate_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
   } 
 }
 function NM_label_ppo_entryby()
 {
   global $nm_saida;
   $SC_Label = (isset($this->New_label['ppo_entryby'])) ? $this->New_label['ppo_entryby'] : "PPO ENTRYBY"; 
   if (!isset($this->NM_cmp_hidden['ppo_entryby']) || $this->NM_cmp_hidden['ppo_entryby'] != "off") { 
   $nm_saida->saida("     <TD class=\"" . $this->css_scGridLabelFont . $this->css_sep . $this->css_ppo_entryby_label . "\"  style=\"" . $this->css_scGridLabelNowrap . "" . $this->Css_Cmp['css_ppo_entryby_label'] . "\" >" . nl2br($SC_Label) . "</TD>\r\n");
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['rows_emb'] = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ini_cor_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ini_cor_grid'] == "impar")
       {
           $this->Ini->qual_linha = "impar";
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ini_cor_grid']);
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
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq_filtro'];
   if (!$this->grid_emb_form && isset($_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['project_edit_update_main_updatetask']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
       {
           $this->Lin_impressas++;
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_grid'])
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cols_emb']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cols_emb']))
               {
                   $cont_col = 0;
                   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['field_order'] as $cada_field)
                   {
                       $cont_col++;
                   }
                   $NM_span_sem_reg = $cont_col - 1;
               }
               else
               {
                   $NM_span_sem_reg  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cols_emb'];
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['rows_emb']++;
               $nm_saida->saida("  <TR> <TD class=\"" . $this->css_scGridTabelaTd . " " . "\" colspan = \"$NM_span_sem_reg\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
               $nm_saida->saida("     " . $this->nm_grid_sem_reg . "</TD> </TR>\r\n");
               $nm_saida->saida("##NM@@\r\n");
               $this->rs_grid->Close();
           }
           else
           {
               $nm_saida->saida("<table id=\"apl_project_edit_update_main_updatetask#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridTabelaTd . " " . "\" style=\"font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\">\r\n");
               $nm_id_aplicacao = "";
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['cab_embutida'] != "S")
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
           if ($this->grid_emb_form_full)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['lig_iframe_modal'] = "nmsc_iframe_liga_project_edit_update_main_updatetask";
           }
           $nm_saida->saida(" <TR> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && 
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print") 
           { 
           $nm_saida->saida("    <TD >\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_project_edit_update_main_updatetask\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_EL_project_edit_update_main_updatetask\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
           } 
           $nm_saida->saida("  <td id=\"sc_grid_body\" class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_A_project_edit_update_main_updatetask', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_D_project_edit_update_main_updatetask', 'value' => 'NM_Blank_Page.htm');
               $this->Ini->Arr_result['setSrc'][] = array('field' => 'nmsc_iframe_liga_E_project_edit_update_main_updatetask', 'value' => 'NM_Blank_Page.htm');
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  </td></tr>\r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" &&
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print") 
           { 
               $nm_saida->saida("</TABLE></TD>\r\n");
               $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_project_edit_update_main_updatetask\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_DL_project_edit_update_main_updatetask\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               $nm_saida->saida("</TD>\r\n");
               $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
               $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_project_edit_update_main_updatetask\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_D_project_edit_update_main_updatetask\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
               $nm_saida->saida("    </TD>\r\n");
               $nm_saida->saida("    </TR>\r\n");
           } 
       $nm_saida->saida("</TABLE>\r\n");
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_project_edit_update_main_updatetask#?#$nm_seq_execucoes\" width=\"100%\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\">\r\n");
       $nm_saida->saida(" <TR> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
       $nm_saida->saida(" <TR> \r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && 
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print") 
       { 
           $nm_saida->saida("    <TD  colspan=3>\r\n");
           $nm_saida->saida("    <TABLE cellspacing=0 cellpadding=0 width='100%'>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_EL_project_edit_update_main_updatetask\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_EL_project_edit_update_main_updatetask\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\"><TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" width=\"100%\"><TR>\r\n");
       } 
       $nm_id_aplicacao = " id=\"apl_project_edit_update_main_updatetask#?#1\"";
   } 
   $nm_saida->saida("  <TD id=\"sc_grid_body\" class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top;text-align: center;\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
   { 
       $nm_saida->saida("        <div id=\"div_FBtn_Run\" style=\"display: none\"> \r\n");
       $nm_saida->saida("        <form name=\"Fpesq\" method=post>\r\n");
       $nm_saida->saida("         <input type=hidden name=\"nm_ret_psq\"> \r\n");
       $nm_saida->saida("        </div> \r\n");
   } 
   $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridTabela . "\" id=\"sc-ui-grid-body-5e13f7c1\" align=\"center\" " . $nm_id_aplicacao . " width=\"100%\">\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_grid'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
// 
   $nm_quant_linhas = 0 ;
   $nm_inicio_pag = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final'] = 0;
   } 
   $this->nmgp_prim_pag_pdf = false;
   $this->Ini->cor_link_dados = $this->css_scGridFieldEvenLink;
   $this->NM_flag_antigo = FALSE;
   while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_reg_grid'] && ($linhas == 0 || $linhas > $this->Lin_impressas)) 
   {  
          $this->Rows_span = 1;
          $this->NM_field_style = array();
          //---------- Gauge ----------
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf" && -1 < $this->progress_grid)
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
          $this->ppo_id = $this->rs_grid->fields[0] ;  
          $this->ppo_id = (string)$this->ppo_id;
          $this->ppo_projectid = $this->rs_grid->fields[1] ;  
          $this->ppo_projectid = (string)$this->ppo_projectid;
          $this->ppo_tahapanproject = $this->rs_grid->fields[2] ;  
          $this->ppo_tahapanproject = (string)$this->ppo_tahapanproject;
          $this->tmt_namatahapan = $this->rs_grid->fields[3] ;  
          $this->statusname = $this->rs_grid->fields[4] ;  
          $this->ppo_note = $this->rs_grid->fields[5] ;  
          $this->ppo_tasktahapan = $this->rs_grid->fields[6] ;  
          $this->tmt_target62 = $this->rs_grid->fields[7] ;  
          $this->tmt_target62 = (string)$this->tmt_target62;
          $this->ppo_tglmulaiplan = $this->rs_grid->fields[8] ;  
          $this->ppo_targethari = $this->rs_grid->fields[9] ;  
          $this->ppo_targethari = (string)$this->ppo_targethari;
          $this->ppo_targetselesai = $this->rs_grid->fields[10] ;  
          $this->ppo_tglmulaiactual = $this->rs_grid->fields[11] ;  
          $this->ppo_tglselesaiactual = $this->rs_grid->fields[12] ;  
          $this->ppo_tasknumber = $this->rs_grid->fields[13] ;  
          $this->ppo_tasknumber = (string)$this->ppo_tasknumber;
          $this->ppo_entrydate = $this->rs_grid->fields[14] ;  
          $this->ppo_entryby = $this->rs_grid->fields[15] ;  
          $this->SC_seq_page++; 
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final'] + 1; 
          $this->SC_sep_quebra = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['rows_emb']++;
          $this->sc_proc_grid = true;
          $_SESSION['scriptcase']['project_edit_update_main_updatetask']['contr_erro'] = 'on';
if (!isset($_SESSION['glo_aktualsebelumnya'])) {$_SESSION['glo_aktualsebelumnya'] = "";}
if (!isset($this->sc_temp_glo_aktualsebelumnya)) {$this->sc_temp_glo_aktualsebelumnya = (isset($_SESSION['glo_aktualsebelumnya'])) ? $_SESSION['glo_aktualsebelumnya'] : "";}
if (!isset($_SESSION['glo_aktualbenarselesai'])) {$_SESSION['glo_aktualbenarselesai'] = "";}
if (!isset($this->sc_temp_glo_aktualbenarselesai)) {$this->sc_temp_glo_aktualbenarselesai = (isset($_SESSION['glo_aktualbenarselesai'])) ? $_SESSION['glo_aktualbenarselesai'] : "";}
if (!isset($_SESSION['glob_jumlahrealisasi'])) {$_SESSION['glob_jumlahrealisasi'] = "";}
if (!isset($this->sc_temp_glob_jumlahrealisasi)) {$this->sc_temp_glob_jumlahrealisasi = (isset($_SESSION['glob_jumlahrealisasi'])) ? $_SESSION['glob_jumlahrealisasi'] : "";}
if (!isset($_SESSION['glo_jumlahtarget'])) {$_SESSION['glo_jumlahtarget'] = "";}
if (!isset($this->sc_temp_glo_jumlahtarget)) {$this->sc_temp_glo_jumlahtarget = (isset($_SESSION['glo_jumlahtarget'])) ? $_SESSION['glo_jumlahtarget'] : "";}
 $add_months = 0;  
$add_years = 0;   
$this->realisasi =$this->nm_data->Dif_Datas($this->ppo_tglselesaiactual , 'aaaa-mm-dd', $this->ppo_tglmulaiactual , 'aaaa-mm-dd');
$this->history ='History';
$jumlahtarget =$this->sc_temp_glo_jumlahtarget+$this->ppo_targethari ;
$this->sc_temp_glo_jumlahtarget=$jumlahtarget ;
$jumlahrealisasi =$this->sc_temp_glob_jumlahrealisasi+$this->realisasi ;
$this->sc_temp_glob_jumlahrealisasi=$jumlahrealisasi ;
if ($this->ppo_tahapanproject  == '1') {
if ($this->ppo_tasknumber =='1') {
$this->aktualbenarmulai =$this->ppo_tglmulaiactual ;
$this->aktualbenarselesai  = 
         $this->nm_data->CalculaData($this->aktualbenarmulai , 'yyyy-mm-dd', '+', $this->realisasi , $add_months, $add_years, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
$this->sc_temp_glo_aktualbenarselesai=$this->aktualbenarselesai ;
} else {
$this->aktualbenarmulai =$this->sc_temp_glo_aktualbenarselesai;
$this->aktualbenarselesai  = 
         $this->nm_data->CalculaData($this->aktualbenarmulai , 'yyyy-mm-dd', '+', $this->realisasi , $add_months, $add_years, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
$this->sc_temp_glo_aktualbenarselesai=$this->aktualbenarselesai ;
}
if ($this->ppo_tglmulaiactual  != $this->aktualbenarmulai ) {
	$this->cek ='NOK';
	} else {
	$this->cek ='OK';
	}
								} else {
	if ($this->ppo_tasknumber =='1') {
$this->aktualbenarmulai =$this->sc_temp_glo_aktualsebelumnya;
$this->aktualbenarselesai  = 
         $this->nm_data->CalculaData($this->aktualbenarmulai , 'yyyy-mm-dd', '+', $this->realisasi , $add_months, $add_years, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
$this->sc_temp_glo_aktualbenarselesai=$this->aktualbenarselesai ;
} else {
$this->aktualbenarmulai =$this->sc_temp_glo_aktualbenarselesai;
$this->aktualbenarselesai  = 
         $this->nm_data->CalculaData($this->aktualbenarmulai , 'yyyy-mm-dd', '+', $this->realisasi , $add_months, $add_years, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
$this->sc_temp_glo_aktualbenarselesai=$this->aktualbenarselesai ;
}
if ($this->ppo_tglmulaiactual  != $this->aktualbenarmulai ) {
	$this->cek ='NOK';
	} else {
	$this->cek ='OK';
	}
										}
if (isset($this->sc_temp_glo_jumlahtarget)) {$_SESSION['glo_jumlahtarget'] = $this->sc_temp_glo_jumlahtarget;}
if (isset($this->sc_temp_glob_jumlahrealisasi)) {$_SESSION['glob_jumlahrealisasi'] = $this->sc_temp_glob_jumlahrealisasi;}
if (isset($this->sc_temp_glo_aktualbenarselesai)) {$_SESSION['glo_aktualbenarselesai'] = $this->sc_temp_glo_aktualbenarselesai;}
if (isset($this->sc_temp_glo_aktualsebelumnya)) {$_SESSION['glo_aktualsebelumnya'] = $this->sc_temp_glo_aktualsebelumnya;}
$_SESSION['scriptcase']['project_edit_update_main_updatetask']['contr_erro'] = 'off';
          if (($nm_houve_quebra == "S" || $nm_inicio_pag == 0) && !$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_grid'])
          { 
              $this->label_grid($linhas);
              $nm_houve_quebra = "N";
          } 
          $nm_inicio_pag++;
          if (!$this->NM_flag_antigo)
          {
             $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final']++ ; 
          }
          $seq_det =  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['final']; 
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_grid'])
          {
             $NM_destaque ="";
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
          {
              $temp = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dado_psq_ret'];
              eval("\$teste = \$this->$temp;");
              if ($temp == "ppo_tglmulaiplan")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ppo_targetselesai")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ppo_tglmulaiactual")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ppo_tglselesaiactual")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "aktualbenarmulai")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "aktualbenarselesai")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ppo_entrydate")
              {
                  $conteudo_x = $teste;
                  nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
                  if (is_numeric($conteudo_x) && $conteudo_x > 0) 
                  { 
                      $this->nm_data->SetaData($teste, "YYYY-MM-DD");
                      $teste = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                  } 
              }
              if ($temp == "ppo_updatedate")
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
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra . "; display:" . $this->width_tabula_display . ";\"  style=\"" . $this->Css_Cmp['css_ppo_entryby_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\">&nbsp;</TD>\r\n");
 if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq']){ 
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  style=\"" . $this->Css_Cmp['css_ppo_entryby_grid_line'] . "\" NOWRAP align=\"left\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\">\r\n");
 $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcapture", "document.Fpesq.nm_ret_psq.value='" . $teste . "'; nm_escreve_window();", "document.Fpesq.nm_ret_psq.value='" . $teste . "'; nm_escreve_window();", "", "Rad_psq", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida(" $Cod_Btn</TD>\r\n");
 } 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['mostra_edit'] != "N"){ 
              if ($this->grid_emb_form_full)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['lig_iframe_modal'] = "nmsc_iframe_liga_project_edit_update_main_updatetask";
              }
              $Sc_parent = ($this->grid_emb_form_full) ? "S" : "";
              if (isset($this->Ini->sc_lig_md5["project_edit_update_main_updatetask_detail"]) && $this->Ini->sc_lig_md5["project_edit_update_main_updatetask_detail"] == "S")
              {
                  $Parms_Edt  = "ppo_id*scin" . $this->ppo_id . "*scoutSC_glo_par_var_templateproject*scinvar_templateproject*scoutvar_tglmulaiaktual*scin" . $this->aktualbenarmulai . "*scoutvar_projectid*scin" . $this->ppo_projectid . "*scoutvar_milestone*scin" . $this->tmt_target62 . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scoutsc_redir_atualiz*scinok*scoutsc_redir_insert*scinok*scoutNMSC_modal*scinok*scout";
                  if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard'] && isset($this->Ini->sc_lig_target['A_@scinf_']))
                  {
                      if ('' != $Parms_Edt && '?@?' != substr($Parms_Edt, -3) && '*scout' != substr($Parms_Edt, -6))
                      {
                          $Parms_Edt .= '*scout';
                      }
                      $Parms_Edt .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $this->Ini->sc_lig_target['A_@scinf_'] . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['compact_mode'] ? '1' : '0');
                  }
                  $Md5_Edt    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@project_edit_update_main_updatetask@SC_par@" . md5($Parms_Edt);
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Lig_Md5'][md5($Parms_Edt)] = $Parms_Edt;
              }
              else
              {
                  $Md5_Edt  = "ppo_id*scin" . $this->ppo_id . "*scoutSC_glo_par_var_templateproject*scinvar_templateproject*scoutvar_tglmulaiaktual*scin" . $this->aktualbenarmulai . "*scoutvar_projectid*scin" . $this->ppo_projectid . "*scoutvar_milestone*scin" . $this->tmt_target62 . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scoutsc_redir_atualiz*scinok*scoutsc_redir_insert*scinok*scoutNMSC_modal*scinok*scout";
              }
              $Link_Edit = nmButtonOutput($this->arr_buttons, "bform_editar", "NM_ancor_ult_lig=" . $this->SC_ancora . ";nm_submit_modal('" . $this->Ini->link_project_edit_update_main_updatetask_detail . "?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nmgp_outra_jan=true&nmgp_url_saida=modal&nmgp_opcao=igual&nmgp_parms=" . $Md5_Edt . "&KeepThis=true&TB_iframe=true&height=440&width=630&modal=true', '" . $Sc_parent . "')", "NM_ancor_ult_lig=" . $this->SC_ancora . ";nm_submit_modal('" . $this->Ini->link_project_edit_update_main_updatetask_detail . "?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nmgp_outra_jan=true&nmgp_url_saida=modal&nmgp_opcao=igual&nmgp_parms=" . $Md5_Edt . "&KeepThis=true&TB_iframe=true&height=440&width=630&modal=true', '" . $Sc_parent . "')", "bedit", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\"><tr><td style=\"padding: 0px\">" . $Link_Edit . "</td></tr></table></TD>\r\n");
 } 
 if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['mostra_edit'] == "N"){ 
              if ($this->grid_emb_form_full)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask_detail']['lig_iframe_modal'] = "nmsc_iframe_liga_project_edit_update_main_updatetask";
              }
              $Sc_parent = ($this->grid_emb_form_full) ? "S" : "";
              if (isset($this->Ini->sc_lig_md5["project_edit_update_main_updatetask_detail"]) && $this->Ini->sc_lig_md5["project_edit_update_main_updatetask_detail"] == "S")
              {
                  $Parms_Edt  = "ppo_id*scin" . $this->ppo_id . "*scoutSC_glo_par_var_templateproject*scinvar_templateproject*scoutvar_tglmulaiaktual*scin" . $this->aktualbenarmulai . "*scoutvar_projectid*scin" . $this->ppo_projectid . "*scoutvar_milestone*scin" . $this->tmt_target62 . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scoutsc_redir_atualiz*scinok*scoutsc_redir_insert*scinok*scoutNMSC_modal*scinok*scout";
                  if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard'] && isset($this->Ini->sc_lig_target['A_@scinf_']))
                  {
                      if ('' != $Parms_Edt && '?@?' != substr($Parms_Edt, -3) && '*scout' != substr($Parms_Edt, -6))
                      {
                          $Parms_Edt .= '*scout';
                      }
                      $Parms_Edt .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $this->Ini->sc_lig_target['A_@scinf_'] . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['compact_mode'] ? '1' : '0');
                  }
                  $Md5_Edt    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@project_edit_update_main_updatetask@SC_par@" . md5($Parms_Edt);
                  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Lig_Md5'][md5($Parms_Edt)] = $Parms_Edt;
              }
              else
              {
                  $Md5_Edt  = "ppo_id*scin" . $this->ppo_id . "*scoutSC_glo_par_var_templateproject*scinvar_templateproject*scoutvar_tglmulaiaktual*scin" . $this->aktualbenarmulai . "*scoutvar_projectid*scin" . $this->ppo_projectid . "*scoutvar_milestone*scin" . $this->tmt_target62 . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scoutnmgp_opcao*scinigual*scoutsc_redir_atualiz*scinok*scoutsc_redir_insert*scinok*scoutNMSC_modal*scinok*scout";
              }
              $Link_Edit = nmButtonOutput($this->arr_buttons, "bform_editar", "NM_ancor_ult_lig=" . $this->SC_ancora . ";nm_submit_modal('" . $this->Ini->link_project_edit_update_main_updatetask_detail . "?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nmgp_outra_jan=true&nmgp_url_saida=modal&nmgp_opcao=igual&nmgp_parms=" . $Md5_Edt . "&KeepThis=true&TB_iframe=true&height=440&width=630&modal=true', '" . $Sc_parent . "')", "NM_ancor_ult_lig=" . $this->SC_ancora . ";nm_submit_modal('" . $this->Ini->link_project_edit_update_main_updatetask_detail . "?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nmgp_outra_jan=true&nmgp_url_saida=modal&nmgp_opcao=igual&nmgp_parms=" . $Md5_Edt . "&KeepThis=true&TB_iframe=true&height=440&width=630&modal=true', '" . $Sc_parent . "')", "bedit", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . "\"  NOWRAP align=\"center\" valign=\"top\" WIDTH=\"1px\"  HEIGHT=\"0px\"><table style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\"><tr></tr></table></TD>\r\n");
 } 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['field_order'] as $Cada_col)
          { 
              $NM_func_grid = "NM_grid_" . $Cada_col;
              $this->$NM_func_grid();
          } 
          $nm_saida->saida("</TR>\r\n");
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_grid'] && $this->nm_prim_linha)
          { 
              $nm_saida->saida("##NM@@"); 
              $this->nm_prim_linha = false; 
          } 
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $nm_quant_linhas = 0; 
          } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
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
   if ($this->rs_grid->EOF) 
   { 
  
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['exibe_total'] == "S")
       { 
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'] . "_top";
           $this->$Gb_geral() ;
           $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'] . "_bot";
           $this->$Gb_geral() ;
       } 
   }  
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_grid'])
   {
       $nm_saida->saida("X##NM@@X");
   }
   $nm_saida->saida("</TABLE>");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
   { 
          $nm_saida->saida("       </form>\r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("</TD>");
   $nm_saida->saida($fecha_tr);
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_grid'])
   { 
       return; 
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && empty($this->nm_grid_sem_reg) && 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print") 
   { 
       $nm_saida->saida("</TABLE></TD>\r\n");
       $nm_saida->saida("<TD style=\"padding: 0px; border-width: 0px;\" valign=\"top\" width=1>\r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_DL_project_edit_update_main_updatetask\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_DL_project_edit_update_main_updatetask\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
       $nm_saida->saida("</TD>\r\n");
           $nm_saida->saida("    <TD style=\"padding: 0px; border-width: 0px; vertical-align: top;\">\r\n");
           $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_D_project_edit_update_main_updatetask\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_D_project_edit_update_main_updatetask\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
           $nm_saida->saida("    </TD>\r\n");
           $nm_saida->saida("    </TR>\r\n");
           $nm_saida->saida("    </TABLE>\r\n");
           $nm_saida->saida("    </TD>\r\n");
   } 
           $nm_saida->saida("    </TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   {
       $nm_saida->saida("</TABLE>\r\n");
   }
   if ($this->Print_All) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao']       = "igual" ; 
   } 
 }
 function NM_grid_ppo_id()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_id']) || $this->NM_cmp_hidden['ppo_id'] != "off") { 
          $conteudo = sc_strip_script($this->ppo_id); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_id_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_id_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_id_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ppo_projectid()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_projectid']) || $this->NM_cmp_hidden['ppo_projectid'] != "off") { 
          $conteudo = sc_strip_script($this->ppo_projectid); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_projectid_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_projectid_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_projectid_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ppo_tahapanproject()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_tahapanproject']) || $this->NM_cmp_hidden['ppo_tahapanproject'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ppo_tahapanproject)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_tahapanproject_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_tahapanproject_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_tahapanproject_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tmt_namatahapan()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tmt_namatahapan']) || $this->NM_cmp_hidden['tmt_namatahapan'] != "off") { 
          $conteudo = sc_strip_script($this->tmt_namatahapan); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tmt_namatahapan_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tmt_namatahapan_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tmt_namatahapan_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
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
 function NM_grid_ppo_note()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_note']) || $this->NM_cmp_hidden['ppo_note'] != "off") { 
          $conteudo = sc_strip_script($this->ppo_note); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_note_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_note_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_note_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ppo_tasktahapan()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_tasktahapan']) || $this->NM_cmp_hidden['ppo_tasktahapan'] != "off") { 
          $conteudo = sc_strip_script($this->ppo_tasktahapan); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_tasktahapan_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_tasktahapan_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_tasktahapan_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_tmt_target62()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['tmt_target62']) || $this->NM_cmp_hidden['tmt_target62'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->tmt_target62)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_tmt_target62_grid_line . "\"  style=\"" . $this->Css_Cmp['css_tmt_target62_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_tmt_target62_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ppo_tglmulaiplan()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_tglmulaiplan']) || $this->NM_cmp_hidden['ppo_tglmulaiplan'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ppo_tglmulaiplan)); 
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
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_tglmulaiplan_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_tglmulaiplan_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_tglmulaiplan_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ppo_targethari()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_targethari']) || $this->NM_cmp_hidden['ppo_targethari'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ppo_targethari)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_targethari_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_targethari_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_targethari_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ppo_targetselesai()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_targetselesai']) || $this->NM_cmp_hidden['ppo_targetselesai'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ppo_targetselesai)); 
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
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_targetselesai_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_targetselesai_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_targetselesai_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ppo_tglmulaiactual()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_tglmulaiactual']) || $this->NM_cmp_hidden['ppo_tglmulaiactual'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ppo_tglmulaiactual)); 
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
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_tglmulaiactual_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_tglmulaiactual_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_tglmulaiactual_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_realisasi()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['realisasi']) || $this->NM_cmp_hidden['realisasi'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->realisasi)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_realisasi_grid_line . "\"  style=\"" . $this->Css_Cmp['css_realisasi_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_realisasi_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ppo_tglselesaiactual()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_tglselesaiactual']) || $this->NM_cmp_hidden['ppo_tglselesaiactual'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ppo_tglselesaiactual)); 
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
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_tglselesaiactual_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_tglselesaiactual_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_tglselesaiactual_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_aktualbenarmulai()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['aktualbenarmulai']) || $this->NM_cmp_hidden['aktualbenarmulai'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->aktualbenarmulai)); 
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
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_aktualbenarmulai_grid_line . "\"  style=\"" . $this->Css_Cmp['css_aktualbenarmulai_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_aktualbenarmulai_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_aktualbenarselesai()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['aktualbenarselesai']) || $this->NM_cmp_hidden['aktualbenarselesai'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->aktualbenarselesai)); 
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
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_aktualbenarselesai_grid_line . "\"  style=\"" . $this->Css_Cmp['css_aktualbenarselesai_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_aktualbenarselesai_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_cek()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['cek']) || $this->NM_cmp_hidden['cek'] != "off") { 
          $conteudo = sc_strip_script($this->cek); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_cek_grid_line . "\"  style=\"" . $this->Css_Cmp['css_cek_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_cek_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ppo_tasknumber()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_tasknumber']) || $this->NM_cmp_hidden['ppo_tasknumber'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ppo_tasknumber)); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_tasknumber_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_tasknumber_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_tasknumber_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_history()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['history']) || $this->NM_cmp_hidden['history'] != "off") { 
          $conteudo = sc_strip_script($this->history); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_history_grid_line . "\"  style=\"" . $this->Css_Cmp['css_history_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"  >\r\n");
 if (!$this->Ini->SC_Link_View && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && $_SESSION['scriptcase']['contr_link_emb'] != "pdf" && $conteudo != "&nbsp;"){ $this->Ind_lig_mult++;
       if (isset($this->Ini->sc_lig_md5["log_order"]) && $this->Ini->sc_lig_md5["log_order"] == "S") {
           $Parms_Lig = "nmgp_lig_edit_lapis?#?S?@?var_projectid?#?" . str_replace("'", "@aspass@", $this->ppo_projectid) . "?@?var_tahapanproject?#?" . str_replace("'", "@aspass@", $this->ppo_tahapanproject) . "?@?var_tasknumber?#?" . str_replace("'", "@aspass@", $this->ppo_tasknumber) . "?@?";
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard'] && isset($this->Ini->sc_lig_target['C_@scinf_history']))
           {
               if ('' != $Parms_Lig)
               {
                   $Parms_Lig .= '*scout';
               }
               $Parms_Lig .= 'under_dashboard*scin1*scoutdashboard_app*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['dashboard_app'] . '*scoutown_widget*scin' . $this->Ini->sc_lig_target['C_@scinf_history'] . '*scoutparent_widget*scin' . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['own_widget'] . '*scoutcompact_mode*scin' . ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['compact_mode'] ? '1' : '0');
           }
           $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@project_edit_update_main_updatetask@SC_par@" . md5($Parms_Lig);
           $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
       } else {
           $Md5_Lig = "nmgp_lig_edit_lapis?#?S?@?var_projectid?#?" . str_replace("'", "@aspass@", $this->ppo_projectid) . "?@?var_tahapanproject?#?" . str_replace("'", "@aspass@", $this->ppo_tahapanproject) . "?@?var_tasknumber?#?" . str_replace("'", "@aspass@", $this->ppo_tasknumber) . "?@?";
       }
   $nm_saida->saida("<a href=\"javascript:nm_gp_submit5('" . $this->Ini->link_log_order_cons . "', '$this->nm_location', '$Md5_Lig', '" . (isset($this->Ini->sc_lig_target['C_@scinf_history']) ? $this->Ini->sc_lig_target['C_@scinf_history'] : '_self') . "', 'inicio', '0', '0', '', 'log_order', '" . $this->SC_ancora . "')\" onMouseover=\"nm_mostra_hint(this, event, '')\" onMouseOut=\"nm_apaga_hint()\" class=\"" . $this->Ini->cor_link_dados . $this->css_sep . $this->css_history_grid_line . "\" style=\"" . $this->Css_Cmp['css_history_grid_line'] . "\">" . $conteudo . "</a>\r\n");
} else {
   $nm_saida->saida(" $conteudo \r\n");
       } 
   $nm_saida->saida("</TD>\r\n");
      }
 }
 function NM_grid_ppo_entrydate()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_entrydate']) || $this->NM_cmp_hidden['ppo_entrydate'] != "off") { 
          $conteudo = NM_encode_input(sc_strip_script($this->ppo_entrydate)); 
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
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_entrydate_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_entrydate_grid_line'] . "\" NOWRAP align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_entrydate_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_grid_ppo_entryby()
 {
      global $nm_saida;
      if (!isset($this->NM_cmp_hidden['ppo_entryby']) || $this->NM_cmp_hidden['ppo_entryby'] != "off") { 
          $conteudo = sc_strip_script($this->ppo_entryby); 
          if ($conteudo === "") 
          { 
              $conteudo = "&nbsp;" ;  
              $graf = "" ;  
          } 
   $nm_saida->saida("     <TD rowspan=\"" . $this->Rows_span . "\" class=\"" . $this->css_line_fonf . $this->css_sep . $this->css_ppo_entryby_grid_line . "\"  style=\"" . $this->Css_Cmp['css_ppo_entryby_grid_line'] . "\"  align=\"\" valign=\"\"   HEIGHT=\"0px\"><span id=\"id_sc_field_ppo_entryby_" . $this->SC_seq_page . "\">" . $conteudo . "</span></TD>\r\n");
      }
 }
 function NM_calc_span()
 {
   $this->NM_colspan  = 23;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
   {
       $this->NM_colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida_pdf'] == "pdf")
   {
       $this->NM_colspan--;
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
   $this->totaliza_php_sc_free_total(); 
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['rows_emb']++;
   $nm_nivel_book_pdf = "";
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf" && !$this->Print_All)
   {
      $nm_nivel_book_pdf = "<div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" .  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][0] . "</H1></div>";
   }
   $tit_lin_sumariza      =  $nm_nivel_book_pdf . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][0] . "(" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][1] . ")";
   $tit_lin_sumariza_orig =  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][0] . "(" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][1] . ")";
       $nm_saida->saida("    <TR class=\"" . $this->css_scGridTotal . "\">\r\n");
   $nm_saida->saida("    <TD class=\"" . $this->css_scGridBlockBg . "\" style=\"width: " . $this->width_tabula_quebra  . "; display:" . $this->width_tabula_display . ";\">&nbsp;</TD>\r\n");
   $tit_lin_sumariza_atu = $tit_lin_sumariza;
   $colspan  = 1;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
   {
       $colspan++;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] == "print" || $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf")
   {
       $colspan--;
   } 
   foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['field_order'] as $Cada_cmp)
   {
    if ($Cada_cmp == "ppo_id" && (!isset($this->NM_cmp_hidden['ppo_id']) || $this->NM_cmp_hidden['ppo_id'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "ppo_projectid" && (!isset($this->NM_cmp_hidden['ppo_projectid']) || $this->NM_cmp_hidden['ppo_projectid'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "ppo_tahapanproject" && (!isset($this->NM_cmp_hidden['ppo_tahapanproject']) || $this->NM_cmp_hidden['ppo_tahapanproject'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "tmt_namatahapan" && (!isset($this->NM_cmp_hidden['tmt_namatahapan']) || $this->NM_cmp_hidden['tmt_namatahapan'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "statusname" && (!isset($this->NM_cmp_hidden['statusname']) || $this->NM_cmp_hidden['statusname'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "ppo_note" && (!isset($this->NM_cmp_hidden['ppo_note']) || $this->NM_cmp_hidden['ppo_note'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "ppo_tasktahapan" && (!isset($this->NM_cmp_hidden['ppo_tasktahapan']) || $this->NM_cmp_hidden['ppo_tasktahapan'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "tmt_target62" && (!isset($this->NM_cmp_hidden['tmt_target62']) || $this->NM_cmp_hidden['tmt_target62'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "ppo_tglmulaiplan" && (!isset($this->NM_cmp_hidden['ppo_tglmulaiplan']) || $this->NM_cmp_hidden['ppo_tglmulaiplan'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "ppo_targethari" && (!isset($this->NM_cmp_hidden['ppo_targethari']) || $this->NM_cmp_hidden['ppo_targethari'] != "off"))
    {
      if ($colspan > 0)
      {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\"  " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][2] ; 
      nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_ppo_targethari_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "ppo_targetselesai" && (!isset($this->NM_cmp_hidden['ppo_targetselesai']) || $this->NM_cmp_hidden['ppo_targetselesai'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "ppo_tglmulaiactual" && (!isset($this->NM_cmp_hidden['ppo_tglmulaiactual']) || $this->NM_cmp_hidden['ppo_tglmulaiactual'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "realisasi" && (!isset($this->NM_cmp_hidden['realisasi']) || $this->NM_cmp_hidden['realisasi'] != "off"))
    {
      if ($colspan > 0)
      {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\" style=\"text-align: left;\" NOWRAP " . "colspan=\"" . $colspan . "\"" . ">" . $tit_lin_sumariza_atu . "</TD>\r\n");
          $tit_lin_sumariza_atu = "&nbsp;";
          $colspan = 0;
      }
      $conteudo =  $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][3] ; 
      nmgp_Form_Num_Val($conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . " css_realisasi_tot_ger\"  NOWRAP >" . $conteudo . "</TD>\r\n");
     }
    if ($Cada_cmp == "ppo_tglselesaiactual" && (!isset($this->NM_cmp_hidden['ppo_tglselesaiactual']) || $this->NM_cmp_hidden['ppo_tglselesaiactual'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "aktualbenarmulai" && (!isset($this->NM_cmp_hidden['aktualbenarmulai']) || $this->NM_cmp_hidden['aktualbenarmulai'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "aktualbenarselesai" && (!isset($this->NM_cmp_hidden['aktualbenarselesai']) || $this->NM_cmp_hidden['aktualbenarselesai'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "cek" && (!isset($this->NM_cmp_hidden['cek']) || $this->NM_cmp_hidden['cek'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "ppo_tasknumber" && (!isset($this->NM_cmp_hidden['ppo_tasknumber']) || $this->NM_cmp_hidden['ppo_tasknumber'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "history" && (!isset($this->NM_cmp_hidden['history']) || $this->NM_cmp_hidden['history'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "ppo_entrydate" && (!isset($this->NM_cmp_hidden['ppo_entrydate']) || $this->NM_cmp_hidden['ppo_entrydate'] != "off"))
    {
       $colspan++;
    }
    if ($Cada_cmp == "ppo_entryby" && (!isset($this->NM_cmp_hidden['ppo_entryby']) || $this->NM_cmp_hidden['ppo_entryby'] != "off"))
    {
       $colspan++;
    }
   }
   if ($colspan > 0)
   {
       $nm_saida->saida("     <TD class=\"" . $this->css_scGridTotalFont . "\"   " . "colspan=\"" . $colspan . "\"" . ">&nbsp;</TD>\r\n");
       $nm_saida->saida("    </TR>\r\n");
   }
 } 

   function totaliza_php_sc_free_total()
   {
      $this->sc_proc_grid = true;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq_filtro'];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['contr_total_geral'] == "OK")
      {
          return;
      }
      //----- 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
         $nmgp_select = "SELECT PPO_TAHAPANPROJECT, PPO_TARGETHARI, str_replace (convert(char(10),PPO_TGLMULAIACTUAL,102), '.', '-') + ' ' + convert(char(8),PPO_TGLMULAIACTUAL,20), str_replace (convert(char(10),PPO_TGLSELESAIACTUAL,102), '.', '-') + ' ' + convert(char(8),PPO_TGLSELESAIACTUAL,20), PPO_TASKNUMBER from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
         $nmgp_select = "SELECT PPO_TAHAPANPROJECT, PPO_TARGETHARI, convert(char(23),PPO_TGLMULAIACTUAL,121), convert(char(23),PPO_TGLSELESAIACTUAL,121), PPO_TASKNUMBER from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
         $nmgp_select = "SELECT PPO_TAHAPANPROJECT, PPO_TARGETHARI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
         $nmgp_select = "SELECT PPO_TAHAPANPROJECT, PPO_TARGETHARI, EXTEND(PPO_TGLMULAIACTUAL, YEAR TO FRACTION), EXTEND(PPO_TGLSELESAIACTUAL, YEAR TO FRACTION), PPO_TASKNUMBER from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
         $nmgp_select = "SELECT PPO_TAHAPANPROJECT, PPO_TARGETHARI, PPO_TGLMULAIACTUAL, PPO_TGLSELESAIACTUAL, PPO_TASKNUMBER from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['where_pesq'] ; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ordem_desc']; 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['order_grid'] = $nmgp_order_by;
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
      if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }  
      if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
      { 
         $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
         return;
      }  
      $this->Res->inicializa_arrays();
      $this->nm_grid_colunas = 0;
      while (!$this->rs_grid->EOF) 
      {
         $this->ppo_tahapanproject = $this->rs_grid->fields[0] ;  
         $this->ppo_tahapanproject = (string)$this->ppo_tahapanproject;  
         $this->ppo_targethari = $this->rs_grid->fields[1] ;  
         $this->ppo_targethari = (string)$this->ppo_targethari;  
         $this->ppo_tglmulaiactual = $this->rs_grid->fields[2] ;  
         $this->ppo_tglselesaiactual = $this->rs_grid->fields[3] ;  
         $this->ppo_tasknumber = $this->rs_grid->fields[4] ;  
         $this->ppo_tasknumber = (string)$this->ppo_tasknumber;  
         $_SESSION['scriptcase']['project_edit_update_main_updatetask']['contr_erro'] = 'on';
if (!isset($_SESSION['glo_aktualsebelumnya'])) {$_SESSION['glo_aktualsebelumnya'] = "";}
if (!isset($this->sc_temp_glo_aktualsebelumnya)) {$this->sc_temp_glo_aktualsebelumnya = (isset($_SESSION['glo_aktualsebelumnya'])) ? $_SESSION['glo_aktualsebelumnya'] : "";}
if (!isset($_SESSION['glo_aktualbenarselesai'])) {$_SESSION['glo_aktualbenarselesai'] = "";}
if (!isset($this->sc_temp_glo_aktualbenarselesai)) {$this->sc_temp_glo_aktualbenarselesai = (isset($_SESSION['glo_aktualbenarselesai'])) ? $_SESSION['glo_aktualbenarselesai'] : "";}
if (!isset($_SESSION['glob_jumlahrealisasi'])) {$_SESSION['glob_jumlahrealisasi'] = "";}
if (!isset($this->sc_temp_glob_jumlahrealisasi)) {$this->sc_temp_glob_jumlahrealisasi = (isset($_SESSION['glob_jumlahrealisasi'])) ? $_SESSION['glob_jumlahrealisasi'] : "";}
if (!isset($_SESSION['glo_jumlahtarget'])) {$_SESSION['glo_jumlahtarget'] = "";}
if (!isset($this->sc_temp_glo_jumlahtarget)) {$this->sc_temp_glo_jumlahtarget = (isset($_SESSION['glo_jumlahtarget'])) ? $_SESSION['glo_jumlahtarget'] : "";}
 $add_months = 0;  
$add_years = 0;   

$this->realisasi =$this->nm_data->Dif_Datas($this->ppo_tglselesaiactual , 'aaaa-mm-dd', $this->ppo_tglmulaiactual , 'aaaa-mm-dd');
$this->history ='History';
$jumlahtarget =$this->sc_temp_glo_jumlahtarget+$this->ppo_targethari ;
$this->sc_temp_glo_jumlahtarget=$jumlahtarget ;
$jumlahrealisasi =$this->sc_temp_glob_jumlahrealisasi+$this->realisasi ;
$this->sc_temp_glob_jumlahrealisasi=$jumlahrealisasi ;

if ($this->ppo_tahapanproject  == '1') {
if ($this->ppo_tasknumber =='1') {
$this->aktualbenarmulai =$this->ppo_tglmulaiactual ;
$this->aktualbenarselesai  = 
         $this->nm_data->CalculaData($this->aktualbenarmulai , 'yyyy-mm-dd', '+', $this->realisasi , $add_months, $add_years, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
$this->sc_temp_glo_aktualbenarselesai=$this->aktualbenarselesai ;
} else {
$this->aktualbenarmulai =$this->sc_temp_glo_aktualbenarselesai;
$this->aktualbenarselesai  = 
         $this->nm_data->CalculaData($this->aktualbenarmulai , 'yyyy-mm-dd', '+', $this->realisasi , $add_months, $add_years, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
$this->sc_temp_glo_aktualbenarselesai=$this->aktualbenarselesai ;
}

if ($this->ppo_tglmulaiactual  != $this->aktualbenarmulai ) {
	$this->cek ='NOK';
	} else {
	$this->cek ='OK';
	}
								} else {
	if ($this->ppo_tasknumber =='1') {
$this->aktualbenarmulai =$this->sc_temp_glo_aktualsebelumnya;
$this->aktualbenarselesai  = 
         $this->nm_data->CalculaData($this->aktualbenarmulai , 'yyyy-mm-dd', '+', $this->realisasi , $add_months, $add_years, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
$this->sc_temp_glo_aktualbenarselesai=$this->aktualbenarselesai ;
} else {
$this->aktualbenarmulai =$this->sc_temp_glo_aktualbenarselesai;
$this->aktualbenarselesai  = 
         $this->nm_data->CalculaData($this->aktualbenarmulai , 'yyyy-mm-dd', '+', $this->realisasi , $add_months, $add_years, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
$this->sc_temp_glo_aktualbenarselesai=$this->aktualbenarselesai ;
}

if ($this->ppo_tglmulaiactual  != $this->aktualbenarmulai ) {
	$this->cek ='NOK';
	} else {
	$this->cek ='OK';
	}

										}
if (isset($this->sc_temp_glo_jumlahtarget)) {$_SESSION['glo_jumlahtarget'] = $this->sc_temp_glo_jumlahtarget;}
if (isset($this->sc_temp_glob_jumlahrealisasi)) {$_SESSION['glob_jumlahrealisasi'] = $this->sc_temp_glob_jumlahrealisasi;}
if (isset($this->sc_temp_glo_aktualbenarselesai)) {$_SESSION['glo_aktualbenarselesai'] = $this->sc_temp_glo_aktualbenarselesai;}
if (isset($this->sc_temp_glo_aktualsebelumnya)) {$_SESSION['glo_aktualsebelumnya'] = $this->sc_temp_glo_aktualsebelumnya;}
$_SESSION['scriptcase']['project_edit_update_main_updatetask']['contr_erro'] = 'off';
         $this->realisasi = (strpos(strtolower($this->realisasi), "e")) ? (float)$this->realisasi : $this->realisasi; 
         $this->realisasi = (string)$this->realisasi;  
         $this->Res->adiciona_registro(NM_encode_input(sc_strip_script($this->ppo_targethari)), NM_encode_input(sc_strip_script($this->realisasi)));
         $this->rs_grid->MoveNext();
      }
      $this->Res->finaliza_arrays();
      $this->rs_grid->Close();
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][2] = $this->Res->array_total_geral[1];
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][3] = $this->Res->array_total_geral[2];
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['contr_array_resumo'] = "OK";
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['tot_geral'][1] = $this->Res->array_total_geral[0];
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['contr_total_geral'] = "OK";
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['updateodp'] == "on" && !$this->grid_emb_form) 
      { 
           if (isset($this->Ini->sc_lig_md5["odp_edit"]) && $this->Ini->sc_lig_md5["odp_edit"] == "S") {
               $Parms_Lig  = "SC_glo_par_idproject*scinvar_projectid*scoutscript_case_init*scin" . NM_encode_input($this->Ini->sc_page) . "*scoutscript_case_session*scin" .  session_id() . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scout";
               $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@project_edit_update_main_updatetask@SC_par@" . md5($Parms_Lig);
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
           } else {
               $Md5_Lig  = "SC_glo_par_idproject*scinvar_projectid*scoutscript_case_init*scin" . NM_encode_input($this->Ini->sc_page) . "*scoutscript_case_session*scin" .  session_id() . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scout";
           }
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "updateodp", "nm_gp_submit5('" .  $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link  . "" .  SC_dir_app_name('odp_edit')  . "/index.php', '$this->nm_location', '" .  $Md5_Lig  . "', '_self', '', '', '', '', 'odp_edit')", "nm_gp_submit5('" .  $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link  . "" .  SC_dir_app_name('odp_edit')  . "/index.php', '$this->nm_location', '" .  $Md5_Lig  . "', '_self', '', '', '', '', 'odp_edit')", "sc_updateodp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida("          $Cod_Btn \r\n");
          $NM_btn = true;
      } 
          if (is_file("project_edit_update_main_updatetask_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("project_edit_update_main_updatetask_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_modal'])
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
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'] != "sc_free_total")
        {
        }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'];
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
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] == 10) ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] == 20) ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] == 50) ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['updateodp'] == "on" && !$this->grid_emb_form) 
      { 
           if (isset($this->Ini->sc_lig_md5["odp_edit"]) && $this->Ini->sc_lig_md5["odp_edit"] == "S") {
               $Parms_Lig  = "SC_glo_par_idproject*scinvar_projectid*scoutscript_case_init*scin" . NM_encode_input($this->Ini->sc_page) . "*scoutscript_case_session*scin" .  session_id() . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scout";
               $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@project_edit_update_main_updatetask@SC_par@" . md5($Parms_Lig);
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
           } else {
               $Md5_Lig  = "SC_glo_par_idproject*scinvar_projectid*scoutscript_case_init*scin" . NM_encode_input($this->Ini->sc_page) . "*scoutscript_case_session*scin" .  session_id() . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scout";
           }
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "updateodp", "nm_gp_submit5('" .  $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link  . "" .  SC_dir_app_name('odp_edit')  . "/index.php', '$this->nm_location', '" .  $Md5_Lig  . "', '_self', '', '', '', '', 'odp_edit')", "nm_gp_submit5('" .  $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link  . "" .  SC_dir_app_name('odp_edit')  . "/index.php', '$this->nm_location', '" .  $Md5_Lig  . "', '_self', '', '', '', '', 'odp_edit')", "sc_updateodp_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida("          $Cod_Btn \r\n");
          $NM_btn = true;
      } 
          if (is_file("project_edit_update_main_updatetask_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("project_edit_update_main_updatetask_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
      {
         if ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='$nm_url_saida'; document.F5.submit()", "document.F5.action='$nm_url_saida'; document.F5.submit()", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
         elseif (!$this->Ini->SC_Link_View && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.F5.action='$nm_url_saida'; document.F5.submit()", "document.F5.action='$nm_url_saida'; document.F5.submit()", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
      }
      elseif ($this->nmgp_botoes['exit'] == "on")
      {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_modal'])
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove()", "self.parent.tb_remove()", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
        }
        else
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "window.close()", "window.close()", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
        }
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']))
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
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'];
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim')", "nm_gp_submit_rec('fim')", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['updateodp'] == "on" && !$this->grid_emb_form) 
      { 
           if (isset($this->Ini->sc_lig_md5["odp_edit"]) && $this->Ini->sc_lig_md5["odp_edit"] == "S") {
               $Parms_Lig  = "SC_glo_par_idproject*scinvar_projectid*scoutscript_case_init*scin" . NM_encode_input($this->Ini->sc_page) . "*scoutscript_case_session*scin" .  session_id() . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scout";
               $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@project_edit_update_main_updatetask@SC_par@" . md5($Parms_Lig);
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
           } else {
               $Md5_Lig  = "SC_glo_par_idproject*scinvar_projectid*scoutscript_case_init*scin" . NM_encode_input($this->Ini->sc_page) . "*scoutscript_case_session*scin" .  session_id() . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scout";
           }
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "updateodp", "nm_gp_submit5('" .  $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link  . "" .  SC_dir_app_name('odp_edit')  . "/index.php', '$this->nm_location', '" .  $Md5_Lig  . "', '_self', '', '', '', '', 'odp_edit')", "nm_gp_submit5('" .  $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link  . "" .  SC_dir_app_name('odp_edit')  . "/index.php', '$this->nm_location', '" .  $Md5_Lig  . "', '_self', '', '', '', '', 'odp_edit')", "sc_updateodp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida("          $Cod_Btn \r\n");
          $NM_btn = true;
      } 
          if (is_file("project_edit_update_main_updatetask_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("project_edit_update_main_updatetask_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_modal'])
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
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['SC_Ind_Groupby'] != "sc_free_total")
        {
        }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top;\" width=\"100%\" valign=\"top\">\r\n");
      $nm_saida->saida("         <tr> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['goto'] == "on" && $this->Ini->Apl_paginacao != "FULL" )
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'];
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
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] == 10) ? " selected" : "";
              $nm_saida->saida("           <option value=\"10\" " . $obj_sel . ">10</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] == 20) ? " selected" : "";
              $nm_saida->saida("           <option value=\"20\" " . $obj_sel . ">20</option>\r\n");
              $obj_sel = ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] == 50) ? " selected" : "";
              $nm_saida->saida("           <option value=\"50\" " . $obj_sel . ">50</option>\r\n");
              $nm_saida->saida("          </select>\r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if (!$this->Ini->SC_Link_View && $this->nmgp_botoes['updateodp'] == "on" && !$this->grid_emb_form) 
      { 
           if (isset($this->Ini->sc_lig_md5["odp_edit"]) && $this->Ini->sc_lig_md5["odp_edit"] == "S") {
               $Parms_Lig  = "SC_glo_par_idproject*scinvar_projectid*scoutscript_case_init*scin" . NM_encode_input($this->Ini->sc_page) . "*scoutscript_case_session*scin" .  session_id() . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scout";
               $Md5_Lig    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@project_edit_update_main_updatetask@SC_par@" . md5($Parms_Lig);
               $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Lig_Md5'][md5($Parms_Lig)] = $Parms_Lig;
           } else {
               $Md5_Lig  = "SC_glo_par_idproject*scinvar_projectid*scoutscript_case_init*scin" . NM_encode_input($this->Ini->sc_page) . "*scoutscript_case_session*scin" .  session_id() . "*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scout";
           }
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "updateodp", "nm_gp_submit5('" .  $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link  . "" .  SC_dir_app_name('odp_edit')  . "/index.php', '$this->nm_location', '" .  $Md5_Lig  . "', '_self', '', '', '', '', 'odp_edit')", "nm_gp_submit5('" .  $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link  . "" .  SC_dir_app_name('odp_edit')  . "/index.php', '$this->nm_location', '" .  $Md5_Lig  . "', '_self', '', '', '', '', 'odp_edit')", "sc_updateodp_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
          $nm_saida->saida("          $Cod_Btn \r\n");
          $NM_btn = true;
      } 
          if (is_file("project_edit_update_main_updatetask_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("project_edit_update_main_updatetask_help.txt"); 
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_psq'])
      {
         if ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='$nm_url_saida'; document.F5.submit()", "document.F5.action='$nm_url_saida'; document.F5.submit()", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
         elseif (!$this->Ini->SC_Link_View && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.F5.action='$nm_url_saida'; document.F5.submit()", "document.F5.action='$nm_url_saida'; document.F5.submit()", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
      }
      elseif ($this->nmgp_botoes['exit'] == "on")
      {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_modal'])
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove()", "self.parent.tb_remove()", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
        }
        else
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "window.close()", "window.close()", "sai_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
        }
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
          if ($this->nmgp_botoes['first'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']))
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
          if ($this->nmgp_botoes['back'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']))
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
          if (empty($this->nm_grid_sem_reg) && $this->nmgp_botoes['navpage'] == "on" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']) && $this->Ini->Apl_paginacao != "FULL" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'] != "all")
          {
              $Reg_Page  = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['qt_lin_grid'];
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
          if ($this->nmgp_botoes['forward'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_avanca", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "nm_gp_submit_rec('" . $this->Rec_fim . "')", "forward_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          if ($this->nmgp_botoes['last'] == "on" && empty($this->nm_grid_sem_reg) && $this->Ini->Apl_paginacao != "FULL" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']))
          {
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bcons_final", "nm_gp_submit_rec('fim')", "nm_gp_submit_rec('fim')", "last_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
          }
          $nm_saida->saida("         </td> \r\n");
          $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
   { 
        return;
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" &&
        $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao_print'] != "print" && !$this->Print_All) 
   { 
      $nm_saida->saida("     <tr><td colspan=3  class=\"" . $this->css_scGridTabelaTd . "\" style=\"vertical-align: top\"> \r\n");
      $nm_saida->saida("     <iframe class=\"css_iframes\" id=\"nmsc_iframe_liga_B_project_edit_update_main_updatetask\" marginWidth=\"0px\" marginHeight=\"0px\" frameborder=\"0\" valign=\"top\" height=\"0px\" width=\"0px\" name=\"nm_iframe_liga_B_project_edit_update_main_updatetask\" scrolling=\"auto\" src=\"NM_Blank_Page.htm\"></iframe>\r\n");
      $nm_saida->saida("     </td></tr> \r\n");
   } 
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['embutida'])
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
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
   } 
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
           if ($this->arr_buttons['bcons_avanca']['type'] != 'image')
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca_off']['style']);
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
                   }
               } 
           } 
           else 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
               }
           } 
           if ($this->arr_buttons['bcons_final']['type'] != 'image')
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final_off']['style']);
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
                   }
               } 
           } 
           else 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
               }
           } 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
           if ($this->arr_buttons['bcons_avanca']['type'] != 'image')
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setClass'][] = array('field' => 'forward_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_avanca_off']['style']);
               }
               if ($this->arr_buttons['bcons_avanca']['display'] == 'only_img' || $this->arr_buttons['bcons_avanca']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
                   }
               } 
           } 
           else 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'forward_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_forward_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_avanca_off']['image']);
               }
           } 
           if ($this->arr_buttons['bcons_final']['type'] != 'image')
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
               {
                  $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                  $this->Ini->Arr_result['setClass'][] = array('field' => 'last_bot', 'value' => "scButton_" . $this->arr_buttons['bcons_final_off']['style']);
               }
               if ($this->arr_buttons['bcons_final']['display'] == 'only_img' || $this->arr_buttons['bcons_final']['display'] == 'text_img')
               { 
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
                   {
                       $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
                   }
               } 
           } 
           else 
           { 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
               {
                   $this->Ini->Arr_result['setDisabled'][] = array('field' => 'last_bot', 'value' => "true");
                   $this->Ini->Arr_result['setSrc'][] = array('field' => 'id_img_last_bot', 'value' => $this->Ini->path_botoes . "/" . $this->arr_buttons['bcons_final_off']['image']);
               }
           } 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
       $nm_saida->saida("      parent.scAjaxDetailHeight('project_edit_update_main_updatetask', $(document).innerHeight());\r\n");
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
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"project_edit_update_main_updatetask\"/>\r\n");
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
   $nm_saida->saida("                     action=\"project_edit_update_main_updatetask_pesq.class.php\" \r\n");
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
   $nm_saida->saida("   function updateodp() \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       \r\n");
   $nm_saida->saida("   } \r\n");
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
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['ajax_nav'])
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
   $nm_saida->saida("      ajax_navigate(opc, parm); \r\n");
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
   $nm_saida->saida("          par_modal = '?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nmgp_outra_jan=true&nmgp_url_saida=modal&SC_lig_apl_orig=project_edit_update_main_updatetask';\r\n");
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
   $nm_saida->saida("      if (pos == \"A\") {obj = document.getElementById('nmsc_iframe_liga_A_project_edit_update_main_updatetask');} \r\n");
   $nm_saida->saida("      if (pos == \"B\") {obj = document.getElementById('nmsc_iframe_liga_B_project_edit_update_main_updatetask');} \r\n");
   $nm_saida->saida("      if (pos == \"E\") {obj = document.getElementById('nmsc_iframe_liga_E_project_edit_update_main_updatetask');} \r\n");
   $nm_saida->saida("      if (pos == \"D\") {obj = document.getElementById('nmsc_iframe_liga_D_project_edit_update_main_updatetask');} \r\n");
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['project_edit_update_main_updatetask_iframe_params'] = array(
       'str_tmp'    => $this->Ini->path_imag_temp,
       'str_prod'   => $this->Ini->path_prod,
       'str_btn'    => $this->Ini->Str_btn_css,
       'str_lang'   => $this->Ini->str_lang,
       'str_schema' => $this->Ini->str_schema_all,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?script_case_session?#?" . session_id() . "?@?pbfile?#?" . $str_pbfile . "?@?jspath?#?" . $this->Ini->path_js . "?@?sc_apbgcol?#?" . $this->Ini->path_css . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@project_edit_update_main_updatetask@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
   $nm_saida->saida("       if (\"pdf\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           window.location = \"" . $this->Ini->path_link . "project_edit_update_main_updatetask/project_edit_update_main_updatetask_iframe.php?nmgp_parms=" . $Md5_pdf . "&sc_tp_pdf=\" + z + \"&sc_parms_pdf=\" + p + \"&sc_create_charts=\" + crt + \"&sc_graf_pdf=\" + g;\r\n");
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
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['project_edit_update_main_updatetask']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Doc = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Doc = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Doc = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['campo_psq_ret'] . "\");\r\n");
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
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['js_apos_busca'] . "();\r\n");
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
   $nm_saida->saida("      document.F5.action = \"project_edit_update_main_updatetask_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main_updatetask']['reg_start']))
   {
       $nm_saida->saida("      parent.scAjaxDetailStatus('project_edit_update_main_updatetask');\r\n");
       $nm_saida->saida("      parent.scAjaxDetailHeight('project_edit_update_main_updatetask', $(document).innerHeight());\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
}
?>
