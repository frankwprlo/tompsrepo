<?php

class v_table_project_copy_resumo
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $total;
   var $tipo;
   var $nm_data;
   var $NM_res_sem_reg;
   var $NM_export;
   var $prim_linha;
   var $que_linha;
   var $css_line_back; 
   var $css_line_fonf; 
   var $comando_grafico;
   var $resumo_campos;
   var $nm_location;
   var $Print_All;
   var $NM_raiz_img; 
   var $NM_tit_val; 
   var $NM_totaliz_hrz; 
   var $link_graph_tot; 
   var $Tot_ger; 
   var $array_total_md_namadatel;
   var $array_total_tm_namamitra;
   var $array_total_statusname;
   var $array_total_geral;
   var $array_tot_lin;
   var $array_final;
   var $array_links;
   var $array_links_tit;
   var $array_export;
   var $quant_colunas;
   var $conv_col;
   var $count_ger;
   var $sum_tp_odp;
   var $avg_prepare;
   var $avg_perijinan;
   var $avg_inst_testcomm;
   var $avg_closing;
   var $avg_pencapaian;
   var $sc_proc_quebra_md_namadatel;
   var $count_md_namadatel;
   var $sum_md_namadatel_tp_odp;
   var $avg_md_namadatel_prepare;
   var $avg_md_namadatel_perijinan;
   var $avg_md_namadatel_inst_testcomm;
   var $avg_md_namadatel_closing;
   var $avg_md_namadatel_pencapaian;
   var $sc_proc_quebra_tm_namamitra;
   var $count_tm_namamitra;
   var $sum_tm_namamitra_tp_odp;
   var $avg_tm_namamitra_prepare;
   var $avg_tm_namamitra_perijinan;
   var $avg_tm_namamitra_inst_testcomm;
   var $avg_tm_namamitra_closing;
   var $avg_tm_namamitra_pencapaian;
   var $sc_proc_quebra_statusname;
   var $count_statusname;
   var $sum_statusname_tp_odp;
   var $avg_statusname_prepare;
   var $avg_statusname_perijinan;
   var $avg_statusname_inst_testcomm;
   var $avg_statusname_closing;
   var $avg_statusname_pencapaian;

   //---- 
   function __construct($tipo = "")
   {
      $this->Graf_left_dat   = false;
      $this->Graf_left_tot   = false;
      $this->NM_export       = false;
      $this->NM_totaliz_hrz  = false;
      $this->link_graph_tot  = array();
      $this->array_final     = array();
      $this->array_links     = array();
      $this->array_links_tit = array();
      $this->array_export    = array();
      $this->resumo_campos            = array();
      $this->comando_grafico          = array();
      $this->array_total_md_namadatel = array();
      $this->array_total_tm_namamitra = array();
      $this->array_total_statusname   = array();
      $this->array_general_total = array();
      $this->nm_data = new nm_data("en_us");
      if ("" != $tipo && "out" == strtolower($tipo))
      {
         $this->NM_tipo = "out";
      }
      else
      {
         $this->NM_tipo = "pag";
      }
   }

   //---- 
   function initializeButtons()
   {
      $this->nmgp_botoes['groupby'] = "on";
      $this->nmgp_botoes['chart_exit'] = isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['dashboard_info']['under_dashboard'] ? "off" : "on";
      $this->nmgp_botoes['chart_detail'] = "on";
      $this->nmgp_botoes['chart_exit'] = isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['dashboard_info']['under_dashboard'] ? "off" : "on";
      $this->nmgp_botoes['chart_exit'] = isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['dashboard_info']['under_dashboard'] ? "off" : "on";

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['v_table_project_copy'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['v_table_project_copy'];

              $this->nmgp_botoes['first']          = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['back']           = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['last']           = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['forward']        = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['summary']        = $tmpDashboardButtons['grid_summary']   ? 'on' : 'off';
              $this->nmgp_botoes['qsearch']        = $tmpDashboardButtons['grid_qsearch']   ? 'on' : 'off';
              $this->nmgp_botoes['dynsearch']      = $tmpDashboardButtons['grid_dynsearch'] ? 'on' : 'off';
              $this->nmgp_botoes['filter']         = $tmpDashboardButtons['grid_filter']    ? 'on' : 'off';
              $this->nmgp_botoes['sel_col']        = $tmpDashboardButtons['grid_sel_col']   ? 'on' : 'off';
              $this->nmgp_botoes['sort_col']       = $tmpDashboardButtons['grid_sort_col']  ? 'on' : 'off';
              $this->nmgp_botoes['goto']           = $tmpDashboardButtons['grid_goto']      ? 'on' : 'off';
              $this->nmgp_botoes['qtline']         = $tmpDashboardButtons['grid_lineqty']   ? 'on' : 'off';
              $this->nmgp_botoes['navpage']        = $tmpDashboardButtons['grid_navpage']   ? 'on' : 'off';
              $this->nmgp_botoes['pdf']            = $tmpDashboardButtons['grid_pdf']       ? 'on' : 'off';
              $this->nmgp_botoes['xls']            = $tmpDashboardButtons['grid_xls']       ? 'on' : 'off';
              $this->nmgp_botoes['xml']            = $tmpDashboardButtons['grid_xml']       ? 'on' : 'off';
              $this->nmgp_botoes['csv']            = $tmpDashboardButtons['grid_csv']       ? 'on' : 'off';
              $this->nmgp_botoes['rtf']            = $tmpDashboardButtons['grid_rtf']       ? 'on' : 'off';
              $this->nmgp_botoes['word']           = $tmpDashboardButtons['grid_word']      ? 'on' : 'off';
              $this->nmgp_botoes['print']          = $tmpDashboardButtons['grid_print']     ? 'on' : 'off';
              $this->nmgp_botoes['chart_conf']     = $tmpDashboardButtons['chart_conf']     ? 'on' : 'off';
              $this->nmgp_botoes['chart_settings'] = $tmpDashboardButtons['chart_settings'] ? 'on' : 'off';
              $this->nmgp_botoes['groupby']        = $tmpDashboardButtons['sel_groupby']    ? 'on' : 'off';
              $this->nmgp_botoes['chart_detail']   = $tmpDashboardButtons['chart_detail']   ? 'on' : 'off';
              $this->nmgp_botoes['new']            = $tmpDashboardButtons['grid_new']       ? 'on' : 'off';
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['v_table_project_copy']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['v_table_project_copy']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['v_table_project_copy']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
   }

   //---- 
   function resumo_export()
   { 
      $this->NM_export = true;
      $this->monta_resumo();
   } 

   function monta_resumo($b_export = false)
   {
       global $nm_saida;

       $this->initializeButtons();

      $this->NM_res_sem_reg = false;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_pesq_filtro'];
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['campos_busca']))
     { 
         $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['campos_busca'];
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
       $tp_id_2 = $Busca_temp['tp_id_input_2']; 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "pdf")
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_resumo']);
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['res_hrz']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['res_hrz'] = $this->NM_totaliz_hrz;
      } 
      $this->NM_totaliz_hrz = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['res_hrz'];
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']) && !$this->NM_export)
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("v_table_project_copy", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['iframe_menu'] && !$this->NM_export && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['array_graf_pdf'] = array();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "pdf")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_resumo'] = "";
      }
      $this->inicializa_vars();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['contr_array_resumo'] == "OK" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['contr_total_geral'] == "OK")
      {
          $this->array_total_md_namadatel = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['md_namadatel'];
          $this->array_total_tm_namamitra = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['tm_namamitra'];
          $this->array_total_statusname = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['statusname'];
      }
      else
      {
          $this->array_total_md_namadatel = array();
          $this->array_total_tm_namamitra = array();
          $this->array_total_statusname = array();
          $this->totaliza_php_gbmitra();
      }
      $this->array_total_geral = array();
      $this->array_total_geral[0] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][1];
      $this->array_total_geral[1] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][2];
      $this->array_total_geral[2] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][3];
      $this->array_total_geral[3] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][4];
      $this->array_total_geral[4] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][5];
      $this->array_total_geral[5] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][6];
      $this->array_total_geral[6] = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][7];
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][1]) || $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][1] == 0)
      {
          $this->NM_res_sem_reg = true;
      }
      $this->compat_arrays();
      $this->resumo_init();
      if ($this->NM_res_sem_reg)
      {
          $this->resumo_sem_reg();
          $this->resumo_final();
          return;
      }
      $this->completeMatrix();
      $this->buildMatrix();
      if ($b_export)
      {
          return;
      }
      if (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
      {
          require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
          $this->Graf  = new v_table_project_copy_grafico();
          $this->Graf->Db     = $this->Db;
          $this->Graf->Erro   = $this->Erro;
          $this->Graf->Ini    = $this->Ini;
          $this->Graf->Lookup = $this->Lookup;
          $this->Graf->monta_grafico();
          exit;
      }
      $this->drawMatrix();
      $this->resumo_final();
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['contr_label_graf'] = array();
      if (isset($this->nmgp_label_quebras) && !empty($this->nmgp_label_quebras))
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['contr_label_graf'] = $this->nmgp_label_quebras;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['contr_array_resumo'] = "OK";
   }

   function completeMatrix()
   {
       $this->comp_align       = array();
       $this->comp_display     = array();
       $this->comp_field       = array();
       $this->comp_field_nm    = array();
       $this->comp_fill        = array();
       $this->comp_group       = array();
       $this->comp_index       = array();
       $this->comp_label       = array();
       $this->comp_links_fl    = array();
       $this->comp_links_gr    = array();
       $this->comp_order       = array();
       $this->comp_order_start = array();
       $this->comp_order_col   = '';
       $this->comp_order_level = '';
       $this->comp_order_sort  = '';
       $this->comp_sum         = array();
       $this->comp_sum_order   = array();
       $this->comp_sum_display = array();
       $this->comp_sum_dummy   = array();
       $this->comp_sum_fn      = array();
       $this->comp_sum_lnk     = array();
       $this->comp_sum_css     = array();
       $this->comp_sum_fill_0  = false;
       $this->comp_tabular     = true;
       $this->comp_tab_hover   = false;
       $this->comp_tab_seq     = false ;
       $this->comp_tab_extend  = true;
       $this->comp_tab_label   = false;
       $this->comp_totals_a    = array();
       $this->comp_totals_al   = array();
       $this->comp_totals_g    = array();
       $this->comp_totals_x    = array();
       $this->comp_totals_y    = array();
       $this->comp_x_axys      = array();
       $this->comp_y_axys      = array();

       $this->build_total_row  = array();

       $this->show_totals_x    = false;
       $this->show_totals_y    = true;
       //-----
       $Lab_md_namadatel = "MD NAMADATEL";
       $Lab_tm_namamitra = "TM NAMAMITRA";
       $Lab_statusname = "STATUSNAME";
       $this->comp_field = array(
           $Lab_md_namadatel,
           $Lab_tm_namamitra,
           $Lab_statusname,
       );

       //-----
       $this->comp_field_nm = array(
           'md_namadatel' => 0,
           'tm_namamitra' => 1,
           'statusname' => 2,
       );

       //-----
       $this->comp_sum = array(
           2 => "LOP",
           3 => "Jml ODP",
           4 => "Preparing",
           5 => "Perijinan",
           6 => "Instalasi & 
TestComm",
           7 => "Closing",
           8 => "Pencapaian(%)",
       );

       //-----
       $this->comp_sum_order = array(
           2,
           3,
           4,
           5,
           6,
           7,
           8,
       );

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['summarizing_fields_order']['gbmitra']))
       {
           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['summarizing_fields_order']['gbmitra'][] = $i_sum;
           }
       }
       else
       {
           $this->comp_sum_order = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['summarizing_fields_order']['gbmitra'];
       }

       //-----
       $this->comp_sum_display = array(
           2 => true,
           3 => true,
           4 => true,
           5 => true,
           6 => true,
           7 => true,
           8 => true,
       );

           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['summarizing_fields_display']['gbmitra'][$i_sum]))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['summarizing_fields_display']['gbmitra'][$i_sum] = array('label' => $l_sum, 'display' => $this->comp_sum_display[$i_sum]);
               }
               else
               {
                   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['summarizing_fields_display']['gbmitra'][$i_sum]['label']))
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['summarizing_fields_display']['gbmitra'][$i_sum]['label'] = $l_sum;
                   }
                   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['summarizing_fields_display']['gbmitra'][$i_sum]['display']))
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['summarizing_fields_display']['gbmitra'][$i_sum]['display'] = $this->comp_sum_display[$i_sum];
                   }
               }
           }
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['summarizing_fields_display']['gbmitra'] as $i_sum => $d_sum)
           {
               $this->comp_sum_display[$i_sum] = $d_sum['display'];
           }

       //-----
       $this->comp_sum_dummy = array(
           0,
           0,
           0,
           0,
           0,
           0,
           0,
           0,
       );

       //-----
       $this->comp_sum_fn = array(
           2 => "C",
           3 => "S",
           4 => "A",
           5 => "A",
           6 => "A",
           7 => "A",
           8 => "A",
       );

       //-----
       $this->comp_sum_lnk = array(
           2 => array('field' => "nm_count", 'show' => false),
           3 => array('field' => "tp_odp", 'show' => true),
           4 => array('field' => "prepare", 'show' => true),
           5 => array('field' => "perijinan", 'show' => true),
           6 => array('field' => "inst_testcomm", 'show' => true),
           7 => array('field' => "closing", 'show' => true),
           8 => array('field' => "pencapaian", 'show' => true),
       );

       //-----
       $this->comp_sum_css = array(
           2 => "css___nm_count_nm___cnt",
           3 => "css_tp_odp_sum",
           4 => "css_prepare_avg",
           5 => "css_perijinan_avg",
           6 => "css_inst_testcomm_avg",
           7 => "css_closing_avg",
           8 => "css_pencapaian_avg",
       );

       //-----
       foreach ($this->array_total_md_namadatel as $i_md_namadatel => $d_md_namadatel) {
           if (!in_array($i_md_namadatel, $this->comp_label[0], true)) {
               $this->comp_index[0][ $d_md_namadatel[9] ] = $d_md_namadatel[8];
               $this->comp_label[0][ $d_md_namadatel[9] ] = $d_md_namadatel[8];
           }
           foreach ($this->array_total_tm_namamitra[$i_md_namadatel] as $i_tm_namamitra => $d_tm_namamitra) {
               if (!in_array($i_tm_namamitra, $this->comp_label[1][ $d_md_namadatel[9] ], true)) {
                   $this->comp_index[1][ $d_tm_namamitra[9] ] = $d_tm_namamitra[8];
                   $this->comp_label[1][ $d_md_namadatel[9] ][ $d_tm_namamitra[9] ] = $d_tm_namamitra[8];
               }
               foreach ($this->array_total_statusname[$i_md_namadatel][$i_tm_namamitra] as $i_statusname => $d_statusname) {
                   if (!in_array($i_statusname, $this->comp_label[2][ $d_md_namadatel[9] ][ $d_tm_namamitra[9] ], true)) {
                       $this->comp_index[2][ $d_statusname[9] ] = $d_statusname[8];
                       $this->comp_label[2][ $d_md_namadatel[9] ][ $d_tm_namamitra[9] ][ $d_statusname[9] ] = $d_statusname[8];
                   }
               }
           }
       }

       //-----
       $this->comp_x_axys = array();
       $this->comp_y_axys = array(0, 1, 2);

       //-----
       $this->comp_align = array('', '', '');

       //-----
       $this->comp_links_gr = array(0, 1, 2);

       //-----
       $this->comp_links_fl = array(
           array('name' => 'md_namadatel', 'prot' => '@aspass@'),
           array('name' => 'tm_namamitra', 'prot' => '@aspass@'),
           array('name' => 'statusname', 'prot' => '@aspass@'),
       );

       //-----
       $this->comp_fill = array(
           0 => true,
           1 => true,
           2 => true,
       );

       //-----
       $this->comp_display = array(
           0 => 'label',
           1 => 'label',
           2 => 'label',
       );

       //-----
       $this->comp_order = array(
           0 => 'label',
           1 => 'label',
           2 => 'label',
       );
       $this->comp_order_start = array(
           0 => 'asc',
           1 => 'asc',
           2 => 'asc',
       );
       $this->comp_order_invert = array(
           0 => false,
           1 => false,
           2 => false,
       );
       $this->comp_order_enabled = array(
           0 => false,
           1 => false,
           2 => false,
       );

       //-----
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_group_by'] = $this->comp_field;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_x_axys']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_x_axys'] = $this->comp_x_axys;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_y_axys']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_y_axys'] = $this->comp_y_axys;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_fill']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_fill'] = $this->comp_fill;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order'] = $this->comp_order;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_start']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_start'] = $this->comp_order_start;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular'] = $this->comp_tabular;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular_hover']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular_hover'] = $this->comp_tabular && $this->comp_tab_hover;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular_seq']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular_seq'] = $this->comp_tabular && $this->comp_tab_seq;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular_label']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular_label'] = $this->comp_tabular && $this->comp_tab_label;
       }

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_col']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_col'] = 0;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_level']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_level'] = 0;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_sort']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_sort'] = '';
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ajax_nav'] && isset($_POST['parm']))
       { 
           $todo  = explode("*scout", $_POST['parm']);
           foreach ($todo as $param)
           {
               $cadapar = explode("*scin", $param);
               $_POST[$cadapar[0]] = $cadapar[1];
           }
        } 
       if (isset($_POST['change_sort']) && 'Y' == $_POST['change_sort'])
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_sort'] = $_POST['sort_ord'];
           if ('' == $_POST['sort_ord'])
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_col']  = 0;
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_col']  = $_POST['sort_col'];
           }
       }
       if (isset($_POST['change_sort']) && 'NEW' == $_POST['change_sort']) {
           for ($i = 0; $i < sizeof($this->comp_label); $i++) {
               if ($i == $_POST['sort_col']) {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_start'][$i] = $_POST['sort_ord'];
               }
           }
       }

       $this->comp_x_axys      = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_x_axys'];
       $this->comp_y_axys      = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_y_axys'];
       $this->comp_fill        = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_fill'];
       $this->comp_order       = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order'];
       $this->comp_order_start = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_start'];
       $this->comp_order_col   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_col'];
       $this->comp_order_level = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_level'];
       $this->comp_order_sort  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_sort'];
       $this->comp_tabular     = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular'];
       $this->comp_tab_hover   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular_hover'];
       $this->comp_tab_seq     = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular_seq'];
       $this->comp_tab_label   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_tabular_label'];

       //-----
       for ($i = 0; $i < sizeof($this->comp_label); $i++) {
           if ('label' == $this->comp_order[$i]) {
               if (('desc' == $this->comp_order_start[$i] && !$this->comp_order_invert[$i]) || ('asc' == $this->comp_order_start[$i] && $this->comp_order_invert[$i]))
               {
                   $sortFn = 'arsort';
                   arsort($this->comp_index[$i]);
               }
               else
               {
                   $sortFn = 'asort';
                   asort($this->comp_index[$i]);
               }
               $this->comp_label[$i] = $this->arrangeLabelList($this->comp_label[$i], $i, $sortFn);
           }
           else {
               if (('desc' == $this->comp_order_start[$i] && !$this->comp_order_invert[$i]) || ('asc' == $this->comp_order_start[$i] && $this->comp_order_invert[$i]))
               {
                   $sortFn = 'krsort';
                   krsort($this->comp_index[$i]);
               }
               else
               {
                   $sortFn = 'ksort';
                   ksort($this->comp_index[$i]);
               }
               $this->comp_label[$i] = $this->arrangeLabelList($this->comp_label[$i], $i, $sortFn);
           }
       }

       //-----
       foreach ($this->comp_label[0] as $i_md_namadatel => $l_md_namadatel) {
           if (isset($this->array_total_md_namadatel[$i_md_namadatel])) {
               $this->comp_group[$i_md_namadatel] = array();
           }
           foreach ($this->comp_label[1][$i_md_namadatel] as $i_tm_namamitra => $l_tm_namamitra) {
               if (isset($this->array_total_tm_namamitra[$i_md_namadatel][$i_tm_namamitra])) {
                   $this->comp_group[$i_md_namadatel][$i_tm_namamitra] = array();
               }
               foreach ($this->comp_label[2][$i_md_namadatel][$i_tm_namamitra] as $i_statusname => $l_statusname) {
                   if (isset($this->array_total_statusname[$i_md_namadatel][$i_tm_namamitra][$i_statusname])) {
                       $this->comp_group[$i_md_namadatel][$i_tm_namamitra][$i_statusname] = array();
                   }
               }
           }
       }

   }

   function arrangeLabelList($label, $level, $method) {
       $new_label = $label;

       if (0 == $level) {
           if ('reverse' == $method) {
               $new_label = array_reverse($new_label, true);
           }
           elseif ('asort' == $method) {
               asort($new_label);
           }
           else {
               ksort($new_label);
           }
       }
       else {
           foreach ($label as $i => $sub_label) {
               $new_label[$i] = $this->arrangeLabelList($sub_label, $level - 1, $method);
           }
       }

       return $new_label;
   }

   function getCompData($level, $params = array()) {
       if (0 == $level) {
           $return = $this->array_total_md_namadatel;
       }
       elseif (1 == $level) {
           $return = $this->array_total_tm_namamitra;
       }
       elseif (2 == $level) {
           $return = $this->array_total_statusname;
       }

       if (array() == $params) {
           return $return;
       }

       foreach ($params as $i_param => $param) {
           if (!isset($return[$param])) {
               return 0;
           }

           $return = $return[$param];
       }

       return $return;
   }   

   function buildMatrix()
   {
       $this->build_labels = $this->getXAxys();
       $this->build_data   = $this->getYAxys();
   }

   function getXAxys()
   {
       $a_axys = array();

       if (0 == sizeof($this->comp_x_axys))
       {
           if (0 < sizeof($this->comp_sum))
           {
               foreach ($this->comp_sum_order as $i_sum)
               {
                   if ($this->comp_sum_display[$i_sum])
                   {
                       $l_sum = $this->comp_sum[$i_sum];
                       $chart    = '0|' . ($i_sum - 1) . '|';
                       $a_axys[] = array(
                           'group'    => 1,
                           'value'    => $i_sum,
                           'label'    => $l_sum,
                           'function' => $this->comp_sum_fn[$i_sum],
                           'params'   => array($i_sum - 1),
                           'children' => array(),
                           'chart'    => '',
                           'css'      => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                       );
                   }
               }
           }
           else
           {
               $a_axys = array();
           }
           $a_labels[] = $a_axys;
       }
       else
       {
           foreach ($this->comp_index[0] as $i_group => $l_group)
           {
               $a_params = array($i_group);
               $a_axys[] = array(
                   'group'    => 0,
                   'value'    => $i_group,
                   'label'    => $l_group,
                   'params'   => $a_params,
                   'children' => $this->addChildren(1, $this->comp_fill[1], $this->comp_group[$i_group], $a_params),
               );
           }

           $a_labels = array();
           $this->addChildrenLabel($a_axys, $a_labels);
       }

       if ($this->show_totals_x && 0 < sizeof($this->comp_x_axys))
       {
           $a_labels[0][] = array(
               'group'   => -1,
               'value'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
               'label'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
               'params'  => array(),
               'colspan' => sizeof($this->comp_sum),
               'rowspan' => sizeof($this->comp_x_axys),
           );
           foreach ($this->comp_sum_order as $i_sum)
           {
               if ($this->comp_sum_display[$i_sum])
               {
                   $s_label = $this->comp_sum[$i_sum];
                   $a_labels[sizeof($this->comp_x_axys)][] = array(
                       'group'    => -1,
                       'value'    => $s_label,
                       'label'    => $s_label,
                       'function' => $this->comp_sum_fn[$i_sum],
                       'params'   => array(),
                       'chart'    => '',
                           'css'      => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                   );
               }
           }
       }

       return $a_labels;
   }

   function addChildren($group, $fill, $children, $params)
   {
       if (!isset($this->comp_x_axys[$group]))
       {
           if (0 < sizeof($this->comp_sum))
           {
               $a_sum = array();
               foreach ($this->comp_sum_order as $i_sum)
               {
                   if ($this->comp_sum_display[$i_sum])
                   {
                       $l_sum = $this->comp_sum[$i_sum];
                       $chart    = $group . '|' . ($i_sum - 1) . '|' . implode('|', $params);
                       $params_n = array_merge($params, array($i_sum - 1));
                       $a_sum[] = array(
                           'group'    => $group,
                           'value'    => $i_sum,
                           'label'    => $l_sum,
                           'function' => $this->comp_sum_fn[$i_sum],
                           'params'   => $params_n,
                           'children' => array(),
                           'chart'    => '',
                           'css'      => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                       );
                   }
               }
               return $a_sum;
           }
           else
           {
               return array();
           }
       }

       $a_axys = array();

       if ($fill)
       {
           foreach ($this->comp_index[$group] as $i_group => $l_group)
           {
               $params_n = array_merge($params, array($i_group));
               $a_axys[] = array(
                   'group'    => $group,
                   'value'    => $i_group,
                   'label'    => $l_group,
                   'params'   => $params_n,
                   'children' => $this->addChildren($group + 1, $this->comp_fill[$group + 1], $children[$i_group], $params_n),
               );
           }
       }
       else
       {
           foreach ($children as $i_group => $a_group)
           {
               $params_n = array_merge($params, array($i_group));
               $a_axys[] = array(
                   'group'    => $group,
                   'value'    => $i_group,
                   'label'    => $this->comp_index[$group][$i_group],
                   'params'   => $params_n,
                   'children' => $this->addChildren($group + 1, $this->comp_fill[$group + 1], $children[$i_group], $params_n),
               );
           }
       }

       return $a_axys;
   }

   function countChildren($children)
   {
       if (empty($children))
       {
           return 1;
       }

       $i = 0;
       foreach ($children as $data)
       {
           $i += $this->countChildren($data['children']);
       }
       return $i;
   }

   function addChildrenLabel($children, &$a_labels)
   {
       foreach ($children as $a_cols)
       {
           $a_labels[$a_cols['group']][] = array(
               'group'    => $a_cols['group'],
               'value'    => $a_cols['value'],
               'label'    => $a_cols['label'],
               'function' => isset($a_cols['function']) ? $a_cols['function'] : '',
               'params'   => $a_cols['params'],
               'colspan'  => $this->countChildren($a_cols['children']),
               'chart'    => '',
               'css'      => isset($a_cols['css'])   ? $a_cols['css']   : '',
           );
           if (!empty($a_cols['children']))
           {
               $this->addChildrenLabel($a_cols['children'], $a_labels);
           }
       }
   }

   function getYAxys()
   {
       $a_axys = array();

       $this->addYChildren(0, $this->comp_group, $a_axys, array());
       $this->fixOrder($a_axys);
       $this->orderBy($a_axys, $this->comp_order_sort, $this->comp_order_col - 1, 0, array());
       $this->comp_chart_axys = $a_axys;

       $a_data              = array();
       $i_row               = 0;
       $this->subtotal_data = array();
       $this->addYChildrenData($a_axys, $a_data, $i_row, 0, array(), array());

       if (!empty($this->subtotal_data))
       {
           end($this->subtotal_data);
           $i_max = key($this->subtotal_data);
           for ($i = $i_max; $i >= 0; $i--)
           {
               $this->build_total_row[] = true;
               $a_data[] = $this->subtotal_data[$i];
           }
       }

       $this->makeTabular($a_data);

       $this->buildTotalsY($a_data);

       return $a_data;
   }

   function addYChildren($group, $tree, &$axys, $param)
   {
       $comp_label = $this->comp_label[$group];
       $tmp_param  = $param;
       while (!empty($tmp_param))
       {
           $tmp_index  = array_shift($tmp_param);
           $comp_label = $comp_label[$tmp_index];
       }
       foreach ($comp_label as $i_group => $l_group)
       {
           if (isset($tree[$i_group]))
           {
               $new_param = array_merge($param, array($i_group));
               if (in_array($group, $this->comp_y_axys))
               {
                   if (!isset($axys[$i_group]))
                   {
                       $axys[$i_group] = array(
                           'group'    => $group,
                           'value'    => $i_group,
                           'label'    => $l_group,
                           'children' => array(),
                       );
                   }
                   $this->addYChildren($group + 1, $tree[$i_group], $axys[$i_group]['children'], $new_param);
               }
               else
               {
                   $this->addYChildren($group + 1, $tree[$i_group], $axys, $new_param);
               }
           }
       }
   }

   function fixOrder(&$axys)
   {
       $n_axys = array();
       $key    = key($axys);
       $group  = $axys[$key]['group'];

       foreach ($this->comp_index[$group] as $i_group => $l_group)
       {
           if (isset($axys[$i_group]))
           {
               $n_axys[$i_group] = $axys[$i_group];
           }
           if (!empty($n_axys[$i_group]['children']))
           {
               $this->fixOrder($n_axys[$i_group]['children']);
           }
       }

       $axys = $n_axys;
   }

   function orderBy(&$axys, $ord, $col, $level, $keys)
   {
       if (-1 == $col || '' == $ord)
       {
           return;
       }

       if ($this->comp_order_level <= $level)
       {
           $n_axys = array();
           $o_axys = array();

           foreach ($axys as $i_group => $d_group)
           {
               $o_axys[$i_group] = 0;
           }

           $a_order = $this->getOrderArray($this->getCompData($level), $ord, $col, $keys, $o_axys);

           foreach ($a_order as $i_group => $v_group)
           {
               $n_axys[$i_group] = $axys[$i_group];
           }

           $axys = $n_axys;
       }

       foreach ($axys as $i_group => $d_group)
       {
           if (!empty($d_group['children']))
           {
               $n_keys = array_merge($keys, array($i_group));
               $this->orderBy($axys[$i_group]['children'], $ord, $col, $level + 1, $n_keys);
           }
       }
   }

   function getOrderArray($data, $ord, $col, $keys, $elem)
   {
       while (!empty($keys))
       {
           $key = key($keys);

           if (isset($data[ $keys[$key] ]))
           {
               $data = $data[ $keys[$key] ];
           }

           unset($keys[$key]);
       }

       foreach ($elem as $i_group => $v_group)
       {
           if (isset($data[$i_group]) && isset($data[$i_group][$col]))
           {
               $elem[$i_group] = $data[$i_group][$col];
           }
       }

       if ('a' == $ord)
       {
           asort($elem);
       }
       else
       {
           arsort($elem);
       }

       return $elem;
   }

   function addYChildrenData($axys, &$data, &$row, $level, $params, $tab_col)
   {
       foreach ($axys as $i_data)
       {
           $params_n = array_merge($params, array($i_data['value']));
           if (sizeof($this->comp_y_axys) > $level + 1)
           {
               $tab_col[$level]['label'] = $i_data['label'];
               $tab_col[$level]['group'] = $i_data['group'];
           }
           $b_subtotal = !(!$this->comp_tabular || ($this->comp_tabular && sizeof($this->comp_y_axys) == $level + 1));
           if (1)
           {
               $new_data = array();
               if ($this->comp_tabular)
               {
                   foreach ($tab_col as $i_tab_col => $a_col_data)
                   {
                       $new_data[] = array(
                           'level'  => $level,
                           'label'  => $a_col_data['label'],
                           'link'   => '',
                       );
                   }
               }
               if (!$b_subtotal)
               {
                   $new_data[] = array(
                       'level'  => $level,
                       'group'  => $i_data['group'],
                       'value'  => $i_data['value'],
                       'label'  => $i_data['label'],
                       'params' => $params_n,
                       'link'   => '',
                   );
               }
               elseif ($this->comp_tab_extend && $this->comp_tab_hover)
               {
                   $last_item                           = count($new_data) - 1;
                   $new_data[$last_item]['colspan']    = sizeof($this->comp_y_axys) - sizeof($params_n) + 1;
                   $new_data[$last_item]['display_as'] = 'subtotal';
                   if (!$this->comp_tab_label)
                   {
                       $new_data[$last_item]['label'] = $this->Ini->Nm_lang['lang_othr_chrt_totl'];
                   }
                   $new_data[$last_item]['link'] = '';
               }
               else
               {
                   $last_item = count($new_data) - 1;
                   $new_data[] = array(
                       'level'      => $level,
                       'group'      => $i_data['group'],
                       'value'      => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
                       'label'      => $this->comp_tab_label ? $new_data[$last_item]['label'] : $this->Ini->Nm_lang['lang_othr_chrt_totl'],
                       'params'     => $params_n,
                       'link'       => '',
                       'colspan'    => sizeof($this->comp_y_axys) - sizeof($params_n),
                       'display_as' => 'subtotal'
                   );
               }
               $a_columns = 1 == sizeof($this->build_labels)
                          ? current($this->build_labels)
                          : $this->build_labels[sizeof($this->build_labels) - 1];
               if (0 < sizeof($this->comp_x_axys))
               {
                   $this->initTotalsX();
               }
               $i = 0;
               foreach ($a_columns as $a_col_data)
               {
                   if (-1 < $a_col_data['group'])
                   {
                       $val = $this->getCellValue($a_col_data['params'], $params_n);
                       $fmt = isset($a_col_data['params']) ? $a_col_data['params'][sizeof($a_col_data['params']) - 1] : 0;
                       $key = '';
                       $lnk = $this->getDataLinkParams($params_n, $a_col_data['params']);
                       if (1 == sizeof($this->comp_x_axys))
                       {
                           $key = $this->addTotalsG($i_data, $a_col_data, $params, $val);
                       }
                       unset($a_col_data['chart']);
                       if (sizeof($this->comp_y_axys) - 1 > $level)
                       {
                           $a_chart_params = $a_col_data['params'];
                           unset($a_chart_params[sizeof($a_col_data['params']) - 1]);
                           if (0 < sizeof($params_n))
                           {
                               for ($j = 0; $j < sizeof($params_n); $j++)
                               {
                                   $a_chart_params[] = $params_n[$j];
                               }
                           }
                           $a_col_data['chart'] = ($i_data['group'] + 1). '|' . $fmt . '|' . implode('|', $a_chart_params);
                       }
                       $new_data[] = array(
                           'level'     => -1,
                           'value'     => $val,
                           'format'    => $fmt,
                           'link_fld'  => $fmt + 1,
                           'link_data' => $lnk,
                           'chart'     => '',
                           'css'       => isset($a_col_data['css'])   ? $a_col_data['css']   : '',
                           'subtotal'  => $b_subtotal,
                       );
                       $aCellColP = $a_col_data['params'];
                       if (0 < sizeof($this->comp_x_axys))
                       {
                           $i_col_x = array_pop($a_col_data['params']);
                           $this->addTotalsX($i_col_x, $val, $key);
                           if (0 == $level && 0 < sizeof($this->comp_x_axys))
                           {
                               $this->addTotalsA ('anal', $i_col_x, $val, $a_col_data['params'][0]);
                               $this->addTotalsAL('anal', $i_col_x, $val, $i_data['value']);
                           }
                       }
                       if (($this->comp_tabular || 0 == $level) && !$b_subtotal)
                       {
                           $iTotalP   = array_pop($aCellColP);
                           $aCellParams = array(
                               'col' => $aCellColP,
                               'row' => array(),
                               'fnc' => $iTotalP
                           );
                           $this->addTotalsY($i, $val, $a_col_data['function'], $fmt, $aCellParams);
                       }
                       $i++;
                   }
               }
               if (0 < sizeof($this->comp_x_axys))
               {
                   $this->buildTotalsX($new_data, $i, $level, $i_data['label'], $b_subtotal);
               }
               if (!$b_subtotal)
               {
                   $this->build_total_row[$row] = false;
                   $data[$row] = $new_data;
                   $row++;
               }
               elseif ($this->show_totals_y && !empty($this->comp_sum))
               {
                   if (!isset($this->subtotal_data[$level]))
                   {
                       $this->subtotal_data[$level] = $new_data;
                   }
                   else
                   {
                       end($this->subtotal_data);
                       $i_max = key($this->subtotal_data);
                       for ($i = $i_max; $i >= $level; $i--)
                       {
                           $this->build_total_row[$row] = true;
                           $data[$row] = $this->subtotal_data[$i];
                           $row++;
                           if ($i != $level)
                           {
                               unset($this->subtotal_data[$i]);
                           }
                       }
                       $this->subtotal_data[$level] = $new_data;
                   }
               }
           }
           $this->addYChildrenData($i_data['children'], $data, $row, $level + 1, $params_n, $tab_col);
       }
   }

   function getDataLinkParams($param, $col)
   {
       $a_par = array();

       if (1 < sizeof($col))
       {
           for ($i = 0; $i < sizeof($col) - 1; $i++)
           {
               $a_par[] = $col[$i];
           }
       }

       return implode('|', array_merge($a_par, $param));
   }

   function getDataLink($field, $data, $value)
   {
       if (!isset($this->comp_sum_lnk[$field]) || !$this->comp_sum_lnk[$field]['show'])
       {
           return $value;
       }

       $s_link_field = $this->comp_sum_lnk[$field]['field'];

       $a_link = array(
       );

       if (!isset($a_link[$s_link_field]))
       {
           return $value;
       }

       $a_data = explode('|', $data);
       $a_par  = array();
       $b_ok   = true;

       foreach ($a_link[$s_link_field]['param'] as $s_param => $a_param)
       {
           if ('C' == $a_param['type'])
           {
               if (!isset($a_data[ $this->comp_field_nm[ $a_param['value'] ] ]))
               {
                   $b_ok = false;
               }
               else
               {
                   $a_par[$s_param] = $a_data[ $this->comp_field_nm[ $a_param['value'] ] ];
               }
           }
           else
           {
               $a_par[$s_param] = $a_param['value'];
           }
       }

       if (!$b_ok)
       {
           return $value;
       }

       $b_modal = false;
       if (false !== strpos($a_link[$s_link_field]['html'], '__NM_FLD_PAR_M__'))
       {
           $b_modal                       = true;
           $a_link[$s_link_field]['html'] = str_replace('__NM_FLD_PAR_M__', '__NM_FLD_PAR__', $a_link[$s_link_field]['html']);
       }

       $return = str_replace('__NM_FLD_PAR__', $this->getDataLinkValue($a_par), $a_link[$s_link_field]['html']) . $value . '</a>';

       return $b_modal ? $this->getModalLink($return) :  $return;
   }

   function getDataLinkValue($param)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $i . '?#?' . $v;
       }

       return implode('?@?', $a_links);
   }

   function getModalLink($param)
   {
       return str_replace(array('?#?', '?@?'), array('*scin', '*scout'), $param);
   }

   function getLabelLink($param, $i_tmp = -1, $bProtect = true)
   {
       $a_links = array();

       if (-1 == $i_tmp)
       {
           foreach ($param as $i => $v)
           {
               $i_fld     = $i + sizeof($this->comp_x_axys);
               $a_links[] = $this->comp_links_fl[$i_fld]['name'] . '?#?' . $this->comp_links_fl[$i_fld]['prot'] . addslashes($this->getChartText($v, $bProtect)) . $this->comp_links_fl[$i_fld]['prot'];
           }
       }
       else
       {
           for ($i = 0; $i <= $i_tmp; $i++)
           {
               $v         = $param[$i];
               $i_fld     = $i + sizeof($this->comp_x_axys);
               $a_links[] = $this->comp_links_fl[$i_fld]['name'] . '?#?' . $this->comp_links_fl[$i_fld]['prot'] . addslashes($this->getChartText($v, $bProtect)) . $this->comp_links_fl[$i_fld]['prot'];
           }
       }

       $Parms_Res  = implode('?@?', $a_links);
       $Md5_Res    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_table_project_copy@SC_par@" . md5($Parms_Res);
       $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['LigR_Md5'][md5($Parms_Res)] = $Parms_Res;
       return $Md5_Res;
   }

   function getChartLink($param, $bProtect = true)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $this->comp_links_fl[$i]['name'] . '?#?' . $this->comp_links_fl[$i]['prot'] . $this->getChartText($v, $bProtect) . $this->comp_links_fl[$i]['prot'];
       }

       return implode('?@?', $a_links);
   }

   function getCellValue($aColPar, $aRowPar)
   {
       $i_tot = array_pop($aColPar);
       $a_val = (0 == sizeof($this->comp_x_axys))
              ? array_merge($aRowPar, array($i_tot))
              : array_merge($aColPar, $aRowPar, array($i_tot));
       return $this->getCompDataCell($a_val, $this->getCompData(sizeof($aColPar) + sizeof($aRowPar) - 1));
   }

   function getCompDataCell($par, $data)
   {
       $key = key($par);
       $cur = $par[$key];
       if (is_array($data[$cur]))
       {
           unset($par[$key]);
           return $this->getCompDataCell($par, $data[$cur]);
       }
       elseif (isset($data[$cur]))
       {
           return $data[$cur];
       }
       elseif (!$this->comp_sum_fill_0)
       {
           return '';
       }
       else
       {
           return 0;
       }
   }

   function makeTabular(&$a_data)
   {
       if ($this->comp_tabular)
       {
           $a_labels = array();
           if ($this->comp_tab_hover)
           {
               foreach ($a_data as $row => $columns)
               {
                   for ($i = 0; $i < sizeof($this->comp_y_axys) - 1; $i++)
                   {
                      if (!isset($a_labels[$i]))
                      {
                          $a_labels[$i] = '';
                      }
                      if (isset($a_data[$row][$i]) && !isset($a_data[$row][$i]['display_as']))
                      {
                          if ($a_labels[$i] == $columns[$i]['label'])
                          {
                              $a_data[$row][$i]['display_as'] = 'none';
                          }
                          else
                          {
                              $a_data[$row][$i]['display_as'] = 'auto';
                          }
                      }
                      $a_labels[$i] = $columns[$i]['label'];
                   }
               }
           }
           else
           {
               foreach ($a_data as $row => $columns)
               {
                   for ($i = 0; $i < sizeof($this->comp_y_axys) - 1; $i++)
                   {
                       if (!isset($a_labels[$i]))
                       {
                           $a_labels[$i] = array(
                               'old'  => $columns[$i]['label'],
                               'row'  => $row,
                               'span' => 1,
                           );
                       }
                       elseif ($a_labels[$i]['old'] == $columns[$i]['label'])
                       {
                           unset($a_data[$row][$i]);
                           $a_labels[$i]['span']++;
                       }
                       else
                       {
                           $a_data[ $a_labels[$i]['row'] ][$i]['rowspan'] = $a_labels[$i]['span'];
                           $a_labels[$i]['old']  = $columns[$i]['label'];
                           $a_labels[$i]['row']  = $row;
                           $a_labels[$i]['span'] = 1;
                       }
                   }
               }
               foreach ($a_labels as $i_col => $a_col_data)
               {
                   $a_data[ $a_col_data['row'] ][$i_col]['rowspan'] = $a_col_data['span'];
               }
           }
       }
   }

   function initTotalsX()
   {
       $this->comp_totals_x = array();

       if (!$this->show_totals_x)
       {
           return;
       }

       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               $this->comp_totals_x[$i_sum - 1] = array('values' => array(), 'chart' => '');
           }
       }
   }

   function addTotalsX($col, $val, $chart)
   {
       if (!$this->show_totals_x)
       {
           return;
       }

       $this->comp_totals_x[$col]['chart']    = $chart;
       $this->comp_totals_x[$col]['values'][] = $val;
   }

   function buildTotalsX(&$row, $col, $level, $label, $sub)
   {
       if (!$this->show_totals_x)
       {
           return;
       }

       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               $i_temp[$i_sum - 1] = '';
           }
       }

       $key = key($this->comp_totals_x);

       for ($i = 0; $i < sizeof($this->comp_totals_x[$key]['values']); $i++)
       {
           foreach ($this->comp_sum_order as $i_sum)
           {
               if ($this->comp_sum_display[$i_sum])
               {
                   $l_sum = $this->comp_sum[$i_sum];
                   if ('' == $i_temp[$i_sum - 1])
                   {
                       $i_temp[$i_sum - 1] = $this->comp_totals_x[$i_sum - 1]['values'][$i];
                   }
                   elseif ('M' == $this->comp_sum_fn[$i_sum] && '' !== $this->comp_totals_x[$i_sum - 1]['values'][$i])
                   {
                       $i_temp[$i_sum - 1] = min($i_temp[$i_sum - 1], $this->comp_totals_x[$i_sum - 1]['values'][$i]);
                   }
                   elseif ('X' == $this->comp_sum_fn[$i_sum])
                   {
                       $i_temp[$i_sum - 1] = max($i_temp[$i_sum - 1], $this->comp_totals_x[$i_sum - 1]['values'][$i]);
                   }
                   else
                   {
                       $i_temp[$i_sum - 1] += $this->comp_totals_x[$i_sum - 1]['values'][$i];
                   }
               }
           }
       }
       foreach ($this->comp_sum as $i_sum => $l_sum)
       {
           if ('A' == $this->comp_sum_fn[$i_sum])
           {
               $i_temp[$i_sum - 1] /= sizeof($this->comp_totals_x[$i_sum - 1]['values']);
           }
           if ('%' == $this->comp_sum_fn[$i_sum])
           {
               $i_temp[$i_sum - 1] = 100.00;
           }
       }
       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               $row[] = array(
                   'total'  => true,
                   'level'  => -1,
                   'value'  => $i_temp[$i_sum - 1],
                   'format' => $i_sum - 1,
                   'chart'  => '',
               );
               if (0 == $level && 0 < sizeof($this->comp_x_axys))
               {
                   $this->addTotalsA('sint', $i_sum - 1, $i_temp[$i_sum - 1], $label);
               }
               if (($this->comp_tabular || 0 == $level) && !$sub)
               {
                   $aCellParams = array(
                       'col' => false,
                       'row' => array(),
                       'fnc' => $i_sum - 1
                   );
                   $this->addTotalsY($col + ($i_sum - 1), $i_temp[$i_sum - 1], $this->comp_sum_fn[$i_sum], $i_sum - 1, $aCellParams);
               }
           }
       }
   }

   function addTotalsA($mode, $col, $val, $label)
   {
       if (!isset($this->comp_totals_a[$col]))
       {
           $this->comp_totals_a[$col] = array(
               'labels' => array(),
               'values' => array(
                   'anal' => array(),
                   'sint' => array(),
               ),
           );
       }
       if ('sint' == $mode)
       {
           $this->comp_totals_a[$col]['labels'][]         = $label;
           $this->comp_totals_a[$col]['values']['sint'][] = $val;
       }
       elseif ('anal' == $mode)
       {
           if (isset($this->comp_index[ $this->comp_x_axys[0] ][$label]))
           {
               $label = $this->comp_index[ $this->comp_x_axys[0] ][$label];
           }
           $this->comp_totals_a[$col]['values']['anal'][$label][] = $val;
       }
   }

   function addTotalsAL($mode, $col, $val, $label)
   {
       if (!isset($this->comp_totals_al[$col]))
       {
           $this->comp_totals_al[$col] = array(
               'labels' => array(),
               'values' => array(
                   'anal' => array(),
                   'sint' => array(),
               ),
           );
       }
       if ('sint' == $mode)
       {
           $this->comp_totals_al[$col]['labels'][]         = $label;
           $this->comp_totals_al[$col]['values']['sint'][] = $val;
       }
       elseif ('anal' == $mode)
       {
           if (isset($this->comp_index[ $this->comp_y_axys[0] ][$label]))
           {
               $label = $this->comp_index[ $this->comp_y_axys[0] ][$label];
           }
           $this->comp_totals_al[$col]['values']['anal'][$label][] = $val;
       }
   }

   function addTotalsY($col, $val, $fun, $fmt, $par = array())
   {
       if (!$this->show_totals_y)
       {
           return;
       }

       if (!isset($this->comp_totals_y[$col]))
       {
           $this->comp_totals_y[$col] = array(
               'format'   => $fmt,
               'function' => $fun,
               'param_c'  => empty($par) ? false : $par['col'],
               'param_r'  => empty($par) ? false : $par['row'],
               'param_f'  => empty($par) ? ''    : $par['fnc'],
               'values'   => array(),
           );
       }
       $this->comp_totals_y[$col]['values'][] = $val;
   }

   function buildTotalsY(&$matrix)
   {
       if (!$this->show_totals_y)
       {
           return;
       }

       $row = sizeof($matrix);

       $this->build_total_row[$row] = true;

       $matrix[$row][] = array(
           'group'      => -1,
           'value'      => $this->Ini->Nm_lang['lang_msgs_totl'],
           'label'      => $this->Ini->Nm_lang['lang_msgs_totl'],
           'params'     => array(),
           'colspan'    => $this->comp_tabular ? sizeof($this->comp_y_axys) : 1,
           'display_as' => $this->comp_tab_hover ? 'total' : 'total'
       );

       $aTotals = array();
       foreach ($this->comp_totals_y as $cols)
       {
           $iSum           = empty($cols['param_c']) ? $this->getColumnTotal(false, $cols['param_f']) : $this->getColumnTotal($cols['param_c'], $cols['param_f']);
           if ($cols['function'] == "%") {
               $iSum = 100.00;
           }
           $aTotals[]      = $iSum;
           $matrix[$row][] = array(
               'total'  => true,
               'level'  => -1,
               'value'  => $iSum,
               'format' => $cols['format'],
           );
           $this->array_general_total[] = $iSum;
       }

       if (1 == sizeof($this->comp_x_axys))
       {
           $i_count = 0;
           $aLabels = array();
           foreach ($this->comp_index[0] as $group_label)
           {
               $aLabels[] = $group_label;
               foreach ($this->comp_sum as $i_sum => $l_sum)
               {
                   $this->comp_totals_al[$i_sum - 1]['values']['sint'][] = $aTotals[$i_count];
                   $i_count++;
               }
           }
           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               $this->comp_totals_al[$i_sum - 1]['labels'] = $aLabels;
           }
       }
   }

   function addTotalsG($line, $column, $param, $value)
   {
       $s_item  = $column['params'][0];
       $i_total = $column['params'][1];
       $param[] = $line['value'];
       $s_key   = 'G|' . $i_total . '|' . implode('|', $param);

       if (!isset($this->comp_totals_g[$s_key]))
       {
           $this->comp_totals_g[$s_key] = array(
               'title'    => $this->getChartText($this->comp_sum[$i_total + 1]),
               'show_sub' => true,
               'subtitle' => $this->getChartText($this->getChartSubtitle($param, 1)),
               'label_x'  => $this->getChartText($this->comp_field[0]),
               'label_y'  => $this->getChartText($this->comp_sum[$i_total + 1]),
               'labels'   => array(),
               'values'   => array(
                   'sint' => array(0 => array()),
               ),
           );
       }

       $this->comp_totals_g[$s_key]['labels'][]            = isset($this->comp_index[0][$s_item]) ? $this->comp_index[0][$s_item] : $s_item;
       $this->comp_totals_g[$s_key]['values']['sint'][0][] = $value;

       return $s_key;
   }

   function getColumnTotal($param_c, $param_f)
   {
       if (false == $param_c)
       {
           $final_data = $this->array_total_geral;
           $param_f   -= 1;
       }
       else
       {
           if (1 == count($this->comp_x_axys)) {
               $return = $this->array_total_md_namadatel;
           }
           elseif (2 == count($this->comp_x_axys)) {
               $return = $this->array_total_tm_namamitra;
           }
           elseif (3 == count($this->comp_x_axys)) {
               $return = $this->array_total_statusname;
           }
           $final_data = $this->getColumnTotalData($param_c, $return);
       }
       return $final_data[$param_f];
   }

   function getColumnTotalData($param_c, $data)
   {
       $elem = array_shift($param_c);

       if (empty($param_c))
       {
            return $data[$elem];
       }
       else
       {
           return $this->getColumnTotalData($param_c, $data[$elem]);
       }
   }

   function buildColumnTotal($fun, $rows)
   {
       $total = '';

       foreach ($rows as $val)
       {
           if ('' == $total)
           {
               $total = $val;
           }
           elseif ('M' == $fun && '' !== $val)
           {
               $total = min($total, $val);
           }
           elseif ('X' == $fun)
           {
               $total = max($total, $val);
           }
           else
           {
               $total += $val;
           }
       }

       if ('A' == $fun)
       {
           $total /= sizeof($rows);
       }
       if ('%' == $fun)
       {
           $total = 100.00;
       }
       if ('W' == $fun || 'V' == $fun || 'P' == $fun)
       {
           $total = "";
       }

       return $total;
   }

   function getFusionLink($originalLink)
   {
       $linkParts = explode('!!!', $originalLink);

       if (1 == count($linkParts)) {
           return $originalLink;
       }

       $linkParts[1] = md5($linkParts[1]);

       return implode('', $linkParts);
   }

   function getKeysTotals(&$a_keys, &$a_totals, $data, $param)
   {
       for ($i = 0; $i < sizeof($this->comp_x_axys); $i++)
       {
           $key_param = key($param);
           unset($param[$key_param]);
       }
       $list_data = $this->comp_chart_axys;
       foreach ($param as $now_param)
       {
           $list_data = $list_data[$now_param]['children'];
       }
       $list_data = array_keys($list_data);
       $size = sizeof($this->comp_sum_dummy);
       foreach ($list_data as $k_group)
       {
           if (isset($data[$k_group])) {
               $totals = $data[$k_group];
           }
           else {
               $totals = $this->comp_sum_dummy;
           }
           $a_keys[] = $k_group;
           $count    = 0;
           foreach ($totals as $i_total => $v_total)
           {
               if ($count == $size)
               {
                   break;
               }
               $a_totals[$i_total][] = $v_total;
               $count++;
           }
       }
       if (!empty($param))
       {
           $a_indexes = $this->getRealIndexes($this->comp_chart_axys, $param);
           foreach ($a_keys as $i => $v)
           {
               if (!in_array($v, $a_indexes))
               {
                   unset($a_keys[$i]);
                   foreach ($a_totals as $t => $l)
                   {
                       unset($a_totals[$t][$i]);
                   }
               }
           }
           $a_keys = array_values($a_keys);
           foreach ($a_totals as $t => $l)
           {
               $a_totals[$t] = array_values($a_totals[$t]);
           }
       }
   }

   function getRealIndexes($data, $param)
   {
       if (empty($param))
       {
           $a_indexes = array();
           foreach ($data as $i => $v)
           {
               $a_indexes[] = $i;
           }
           return $a_indexes;
       }
       else
       {
           $key = key($param);
           $val = $param[$key];
           unset($param[$key]);
           return $this->getRealIndexes($data[$val]['children'], $param);
       }
   }

   function getGroupLabels($group, $keys)
   {
       $a_labels = array();
       foreach ($keys as $key)
       {
           $a_labels[] = isset($this->comp_index[$group][$key]) ? $this->comp_index[$group][$key] : $key;
       }
       return $a_labels;
   }

   function getChartSubtitle($param, $s = 0)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $this->comp_field[$i + $s] . ' = ' . $this->comp_index[$i + $s][$v];
       }

       return implode(' :: ', $a_links);
   }

   function getAnaliticCharts($total, &$chart_data)
   {
       $chart_data['labels_anal']           = array();
       $chart_data['legend']                = $this->comp_field[1];
       $chart_data['values']['anal']        = array();
       $chart_data['values']['anal_values'] = array();
       $chart_data['values']['anal_links']  = array();

       foreach ($this->comp_index[0] as $i_0 => $v_0)
       {
           $chart_data['labels_anal'][] = $v_0;
       }
       foreach ($this->comp_index[1] as $i_1 => $v_1)
       {
           $chart_data['values']['anal'][$v_1] = array();
           foreach ($this->comp_index[0] as $i_0 => $v_0)
           {
               $vCompData                                  = $this->getCompData(1, array($i_0, $i_1, $total));
               $chart_data['values']['anal'][$v_1][]       = isset($vCompData) ? $vCompData : 0;
               $chart_data['values']['anal_values'][$v_1]  = $i_1;
               $chart_data['values']['anal_links'][$i_1][] = $this->getChartLink(array($i_0, $i_1), -1);
           }
       }
   }

   function getChartText($s, $bProtect = true)
   {
       if (!$bProtect)
       {
           return $s;
       }
       if ('UTF-8' != $_SESSION['scriptcase']['charset'])
       {
           $s = sc_convert_encoding($s, 'UTF-8', $_SESSION['scriptcase']['charset']);
       }
       return function_exists('html_entity_decode') ? html_entity_decode($s, ENT_COMPAT | ENT_HTML401, 'UTF-8') : $s;
   }

   function drawMatrix()
   {
       global $nm_saida;

       if ($this->NM_export)
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_export']['label'] = $this->build_labels;
           $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_export']['data']  = $this->build_data;
           return;
       }

       $nm_saida->saida("<tr id=\"summary_body\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ajax_nav'])
       { 
           $_SESSION['scriptcase']['saida_html'] = "";
       } 
       $nm_saida->saida("<td class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
       $nm_saida->saida("<table class=\"scGridTabela\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");

       $this->drawMatrixLabels();
      if ($this->comp_tab_hover)
      {
          $nm_saida->saida("    <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("        $(function() {\r\n");
          $nm_saida->saida("            $(\".scGridSummaryLine\").click(function() {\r\n");
          $nm_saida->saida("              var bHasClicked = $(this).find(\".scGridSummaryLineOdd\").hasClass(\"scGridSummaryClickedLine\") || $(this).find(\".scGridSummaryLineEven\").hasClass(\"scGridSummaryClickedLine\") || $(this).find(\".scGridSummarySubtotal\").hasClass(\"scGridSummaryClickedSubtotal\") || $(this).find(\".scGridSummaryTotal\").hasClass(\"scGridSummaryClickedTotal\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryLineOdd\").removeClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryLineEven\").removeClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryGroupbyVisible\").removeClass(\"scGridSummaryClickedGroupbyVisible\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryGroupbyInvisible\").removeClass(\"scGridSummaryClickedGroupbyInvisible\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryGroupbyInvisibleDisplay\").removeClass(\"scGridSummaryClickedGroupbyInvisibleDisplay\");\r\n");
          $nm_saida->saida("              $(\".scGridSummarySubtotal\").removeClass(\"scGridSummaryClickedSubtotal\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryTotal\").removeClass(\"scGridSummaryClickedTotal\");\r\n");
          $nm_saida->saida("              if (!bHasClicked) {\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryLineOdd\").addClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryLineEven\").addClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryGroupbyVisible\").addClass(\"scGridSummaryClickedGroupbyVisible\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryGroupbyInvisible\").addClass(\"scGridSummaryClickedGroupbyInvisible\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryGroupbyInvisibleDisplay\").addClass(\"scGridSummaryClickedGroupbyInvisibleDisplay\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummarySubtotal\").addClass(\"scGridSummaryClickedSubtotal\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryTotal\").addClass(\"scGridSummaryClickedTotal\");\r\n");
          $nm_saida->saida("              }\r\n");
          $nm_saida->saida("            });\r\n");
          $nm_saida->saida("        });\r\n");
          $nm_saida->saida("    </script>\r\n");
      }

       $s_class   = 'scGridSummaryLineOdd';
       $s_class_v = 'scGridSummaryGroupbyVisible';
        $iSeqCount = 0;
       foreach ($this->build_data as $row_i => $lines)
       {
           $this->prim_linha = false;
           $sTrClass         = $this->comp_tab_hover ? ' class="scGridSummaryLine"' : '';
           $nm_saida->saida(" <tr $sTrClass>\r\n");
           if ($this->comp_tab_seq)
           {
               if ($this->build_total_row[$row_i])
               {
                   $sSeqDisplay = '&nbsp;';
               }
               else
               {
                   $iSeqCount++;
                   $sSeqDisplay = $iSeqCount;
               }
               $nm_saida->saida(" <td class=\"scGridSummaryGroupbyVisible scGridSummaryGroupbySeq\">$sSeqDisplay</td>\r\n");
           }
           foreach ($lines as $col_i => $columns)
           {
               $this->NM_graf_left = $this->Graf_left_dat;
               if (0 <= $columns['level'])
               {
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida'])
                   {
                       $columns['label'] = ($columns['label'] == "") ? "&nbsp;" : $columns['label'];
                       $s_label   = '' != $columns['link'] ? "<a href=\"javascript: nm_link_cons('" . $columns['link'] . "')\" class=\"" . (isset($columns['display_as']) && 'none' == $columns['display_as'] ? 'scGridSummaryGroupbyInvisibleLink' : 'scGridSummaryGroupbyVisibleLink') . "\">" . $columns['label'] . '</a>' : $columns['label'];
                   }
                   else
                   {
                       $s_label   = $columns['label'];
                   }
                   $s_style   = '';
                   $s_text    = $this->comp_tabular ? $s_label : str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $columns['level']) . $s_label;
                   $s_class_v = 'scGridSummaryGroupbyVisible';
                   if (isset($columns['display_as']) && 'none' == $columns['display_as'])
                   {
                       $s_text    = '<span class="scGridSummaryGroupbyInvisibleDisplay">' . $s_text . '</span>';
                       $s_class_v = 'scGridSummaryGroupbyInvisible';
                   }
                   elseif (isset($columns['display_as']) && 'subtotal' == $columns['display_as'])
                   {
                       $s_class_v = 'scGridSummarySubtotal';
                   }
                   elseif (isset($columns['display_as']) && 'total' == $columns['display_as'])
                   {
                       $s_class_v = 'scGridSummaryTotal';
                   }
               }
               else
               {
                   $s_style = '';
                   if (isset($columns['total']) && $columns['total'])
                   {
                       $s_style   = ' style="text-align: right"';
                       $s_text    = $this->formatValue($columns['format'], $columns['value']);
                       $s_class_v = 'scGridSummaryTotal';
                       $this->NM_graf_left = $this->Graf_left_tot;
                   }
                   elseif (isset($columns['subtotal']) && $columns['subtotal'])
                   {
                       $s_text    = $this->formatValue($columns['format'], $columns['value']);
                       $s_class_v = 'scGridSummarySubtotal';
                   }
                   else
                   {
                       $s_text    = $this->getDataLink($columns['link_fld'], $columns['link_data'], $this->formatValue($columns['format'], $columns['value']));
                       $s_class_v = $s_class;
                   }
               }
               $css     = ('' != $columns['css']) ? ' ' . $columns['css'] . '_field' : '';
               $colspan = (isset($columns['colspan']) && 1 < $columns['colspan']) ? ' colspan="' . $columns['colspan'] . '"' : '';
               $rowspan = (isset($columns['rowspan']) && 1 < $columns['rowspan']) ? ' rowspan="' . $columns['rowspan'] . '"' : '';
               $chart   = (($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida']) && isset($columns['chart']) && '' != $columns['chart'] && isset($this->comp_chart_data[ $columns['chart'] ]))
                        ? nmButtonOutput($this->arr_buttons, "bgraf", "nm_graf_submit_2('" . $columns['chart'] . "')", "nm_graf_submit_2('" . $columns['chart'] . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->comp_chart_data[ $columns['chart'] ]['label_x'] . " X " . $this->comp_chart_data[ $columns['chart'] ]['label_y'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "") : '';
               if ($this->NM_graf_left)
               {
                   $nm_saida->saida("  <td" . $s_style . " class=\"" . $s_class_v . $css . "\"" . $colspan . "" . $rowspan . ">" . $chart . "" . $s_text . "</td>\r\n");
               }
               else
               {
                   $nm_saida->saida("  <td" . $s_style . " class=\"" . $s_class_v . $css . "\"" . $colspan . "" . $rowspan . ">" . $s_text . "" . $chart . "</td>\r\n");
               }
           }
           $nm_saida->saida(" </tr>\r\n");
           if ('scGridSummaryLineOdd' == $s_class)
           {
               $s_class                   = 'scGridSummaryLineEven';
               $this->Ini->cor_link_dados = 'scGridFieldEvenLink';
           }
           else
           {
               $s_class                   = 'scGridSummaryLineOdd';
               $this->Ini->cor_link_dados = 'scGridFieldOddLink';
           }
       }

       $nm_saida->saida("</table>\r\n");
       $nm_saida->saida("</td>\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ajax_nav'])
       { 
           $this->Ini->Arr_result['setValue'][] = array('field' => 'summary_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
           $_SESSION['scriptcase']['saida_html'] = "";
       } 
       $nm_saida->saida("</tr>\r\n");
   }

   function drawMatrixLabels()
   {
       global $nm_saida;

       $this->prim_linha = true;

       $nm_saida->saida("    <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("        $(function() {\r\n");
       $nm_saida->saida("            $(\".sc-ui-sort\").mouseover(function() {\r\n");
       $nm_saida->saida("                $(this).css(\"cursor\", \"pointer\");\r\n");
       $nm_saida->saida("            }).click(function() {\r\n");
       $nm_saida->saida("                var newOrder, colOrder;\r\n");
       $nm_saida->saida("                if ($(this).hasClass(\"sc-ui-sort-desc\")) {\r\n");
       $nm_saida->saida("                    $(this).removeClass(\"sc-ui-sort-desc\").addClass(\"sc-ui-sort-asc\");\r\n");
       $nm_saida->saida("                    newOrder = \"asc\";\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                else {\r\n");
       $nm_saida->saida("                    $(this).removeClass(\"sc-ui-sort-asc\").addClass(\"sc-ui-sort-desc\");\r\n");
       $nm_saida->saida("                    newOrder = \"desc\";\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                colOrder = $(this).attr(\"id\").substr(11);\r\n");
       $nm_saida->saida("                changeSort(colOrder, newOrder, false);\r\n");
       $nm_saida->saida("            });\r\n");
       $nm_saida->saida("        });\r\n");
       $nm_saida->saida("    </script>\r\n");

       $apl_cab_resumo = $this->Ini->Nm_lang['lang_othr_smry_msge'];

       $b_display     = false;
       $b_display_seq = false;
       foreach ($this->build_labels as $lines)
       {
           $nm_saida->saida(" <tr>\r\n");
           if ($this->comp_tab_seq && !$b_display_seq) {
               $nm_saida->saida("  <td class=\"scGridSummaryLabel\" rowspan=\"" . sizeof($this->build_labels) . "\">&nbsp;</td>\r\n");
               $b_display_seq = true;
           }

           if (!$b_display)
           {
               if ($this->comp_tabular)
               {
                   foreach ($this->comp_y_axys as $iYAxysIndex)
                   {
                       $hasOrder = !isset($this->comp_order_enabled[$iYAxysIndex]) || $this->comp_order_enabled[$iYAxysIndex];
                       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_start'][$iYAxysIndex]))
                       {
                           $sInitialOrder   = '';
                           $sInitialDisplay = '; display: none';
                           $sInitialSrc     = '';
                       }
                       elseif ('asc' == $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['pivot_order_start'][$iYAxysIndex])
                       {
                           $sInitialOrder   = ' sc-ui-sort-asc';
                           $sInitialDisplay = '';
                           $sInitialSrc     = $this->Ini->Label_summary_sort_asc;
                       }
                       else
                       {
                           $sInitialOrder   = ' sc-ui-sort-desc';
                           $sInitialDisplay = '';
                           $sInitialSrc     = $this->Ini->Label_summary_sort_desc;
                       }
                       $nm_saida->saida("  <td class=\"scGridSummaryLabel\" rowspan=\"" . sizeof($this->build_labels) . "\">\r\n");
                       if ($hasOrder) {
                           $nm_saida->saida("    <span class=\"sc-ui-sort" . $sInitialOrder . "\" id=\"sc-id-sort-" . $iYAxysIndex . "\">\r\n");
                       }
                       $nm_saida->saida("   " . $this->comp_field[$iYAxysIndex] . "\r\n");
                       if ($hasOrder) {
                           $nm_saida->saida("     <img style=\"vertical-align: middle" . $sInitialDisplay . "\" src=\"" . $this->Ini->path_img_global . "/" . $sInitialSrc . "\" border=\"0\"/>\r\n");
                           $nm_saida->saida("    </span>\r\n");
                       }
                       $nm_saida->saida("  </td>\r\n");
                   }
               }
               else
               {
                   $nm_saida->saida("  <td class=\"scGridSummaryLabel\" rowspan=\"" . sizeof($this->build_labels) . "\"" . sizeof($this->comp_y_axys) . ">\r\n");
                       if (0 < $this->comp_order_col)
                       {
                       $nm_saida->saida("    <a href=\"javascript: changeSort('0', '0', true)\" class=\"scGridLabelLink \">\r\n");
                       }
                   $nm_saida->saida("   " . $apl_cab_resumo . "\r\n");
                       if (0 < $this->comp_order_col)
                       {
                       $nm_saida->saida("    <IMG style=\"vertical-align: middle\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_summary_sort_asc . "\" BORDER=\"0\"/>\r\n");
                       $nm_saida->saida("    </a>\r\n");
                       }
               $nm_saida->saida("  </td>\r\n");
               }
               $b_display = true;
           }
           foreach ($lines as $columns)
           {
               $this->NM_graf_left = $this->Graf_left_dat;
               if (isset($columns['group']) && $columns['group'] == -1)
               {
                   $this->NM_graf_left = $this->Graf_left_tot;
               }
               if ('' == $columns['function'] && '' != $this->comp_align[ $columns['group'] ])
               {
                   $style = ' style="text-align: ' . $this->comp_align[ $columns['group'] ] . '"';
               }
               else
               {
                   $style = '';
               }
               $css       = ('' != $columns['css']) ? ' ' . $columns['css'] . '_label' : '';
               $colspan   = (isset($columns['colspan']) && 1 < $columns['colspan']) ? ' colspan="' . $columns['colspan'] . '"' : '';
               $rowspan   = (isset($columns['rowspan']) && 1 < $columns['rowspan']) ? ' rowspan="' . $columns['rowspan'] . '"' : '';
               $col_label = $this->getColumnLabel($columns['label'], $columns['params'][0], $css);
               $col_float = $columns['label'] != $col_label ? 'float: left' : '';
               $chart   = (($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida']) && isset($columns['chart']) && '' != $columns['chart'] && isset($this->comp_chart_data[ $columns['chart'] ]))
                        ? nmButtonOutput($this->arr_buttons, "bgraf", "nm_graf_submit_2('" . $columns['chart'] . "')", "nm_graf_submit_2('" . $columns['chart'] . "')", "", "", "", "$col_float", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->comp_chart_data[ $columns['chart'] ]['label_x'] . " X " . $this->comp_chart_data[ $columns['chart'] ]['label_y'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "") : '';
               if ($this->NM_graf_left)
               {
                   $nm_saida->saida("  <td" . $style . " class=\"scGridSummaryLabel" . $css . "\"" . $colspan . "" . $rowspan . ">" . $chart . "" . $col_label . "</td>\r\n");
               }
               else
               {
                   $nm_saida->saida("  <td" . $style . " class=\"scGridSummaryLabel" . $css . "\"" . $colspan . "" . $rowspan . ">" . $col_label . "" . $chart . "</td>\r\n");
               }
           }
           $nm_saida->saida(" </tr>\r\n");
       }
   }

   function getColumnLabel($label, $col, $css="")
   {
       if (0 != sizeof($this->comp_x_axys))
       {
           return $label;
       }

       return $label;
   }

   function formatValue($total, $valor_campo)
   {
       $isNegative = 0 > $valor_campo;
       if ($total == 1)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "");
       }
       if ($total == 2)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']);
       }
       if ($total == 3)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "");
       }
       if ($total == 4)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "");
       }
       if ($total == 5)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "");
       }
       if ($total == 6)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "");
       }
       if ($total == 7)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "");
       }
       return $valor_campo;
   }

   //---- 
   function resumo_init()
   {
      $this->monta_css();
      if ($this->NM_export)
      {
          return;
      }
      $this->monta_html_ini();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
      {
          $this->monta_barra_top();
          $this->monta_embbed_placeholder_top();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
      {
          $this->monta_barra_top();
          $this->monta_embbed_placeholder_mobile_top();
      }
   }

   function monta_css()
   {
      global $nm_saida, $nmgp_tipo_pdf, $nmgp_cor_print;
       $compl_css = "";
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida'])
       {
           include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida'])
       {
          if (($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
           { 
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['v_table_project_copy']))
               {
                   $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['v_table_project_copy']) . "_";
               } 
           } 
           else 
           { 
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['v_table_project_copy']))
               {
                   $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['v_table_project_copy']) . "_";
               } 
           }
       }
       $temp_css  = explode("/", $compl_css);
       if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
       $this->css_scGridPage          = $compl_css . "scGridPage";
       $this->css_scGridToolbar       = $compl_css . "scGridToolbar";
       $this->css_scGridToolbarPadd   = $compl_css . "scGridToolbarPadding";
       $this->css_css_toolbar_obj     = $compl_css . "css_toolbar_obj";
       $this->css_scGridHeader        = $compl_css . "scGridHeader";
       $this->css_scGridHeaderFont    = $compl_css . "scGridHeaderFont";
       $this->css_scGridFooter        = $compl_css . "scGridFooter";
       $this->css_scGridFooterFont    = $compl_css . "scGridFooterFont";
       $this->css_scGridTotal         = $compl_css . "scGridTotal";
       $this->css_scGridTotalFont     = $compl_css . "scGridTotalFont";
       $this->css_scGridFieldEven     = $compl_css . "scGridFieldEven";
       $this->css_scGridFieldEvenFont = $compl_css . "scGridFieldEvenFont";
       $this->css_scGridFieldEvenVert = $compl_css . "scGridFieldEvenVert";
       $this->css_scGridFieldEvenLink = $compl_css . "scGridFieldEvenLink";
       $this->css_scGridFieldOdd      = $compl_css . "scGridFieldOdd";
       $this->css_scGridFieldOddFont  = $compl_css . "scGridFieldOddFont";
       $this->css_scGridFieldOddVert  = $compl_css . "scGridFieldOddVert";
       $this->css_scGridFieldOddLink  = $compl_css . "scGridFieldOddLink";
       $this->css_scGridLabel         = $compl_css . "scGridLabel";
       $this->css_scGridLabelFont     = $compl_css . "scGridLabelFont";
       $this->css_scGridLabelLink     = $compl_css . "scGridLabelLink";
       $this->css_scGridTabela        = $compl_css . "scGridTabela";
       $this->css_scGridTabelaTd      = $compl_css . "scGridTabelaTd";
       $this->css_scAppDivMoldura     = $compl_css . "scAppDivMoldura";
       $this->css_scAppDivHeader      = $compl_css . "scAppDivHeader";
       $this->css_scAppDivHeaderText  = $compl_css . "scAppDivHeaderText";
       $this->css_scAppDivContent     = $compl_css . "scAppDivContent";
       $this->css_scAppDivContentText = $compl_css . "scAppDivContentText";
       $this->css_scAppDivToolbar     = $compl_css . "scAppDivToolbar";
       $this->css_scAppDivToolbarInput= $compl_css . "scAppDivToolbarInput";
   }

   function resumo_sem_reg()
   {
      global $nm_saida;
      $res_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
      $nm_saida->saida("  <TR id=\"summary_body\">\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("   <TD class=\"scGridFieldOdd scGridFieldOddFont\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
      $nm_saida->saida("     " . $res_sem_reg . "\r\n");
      $nm_saida->saida("   </TD>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'summary_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("  </TR>\r\n");
   }

   function resumo_sem_reg_chart()
   {
      global $nm_saida;
      $res_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
      $displayMessage = $this->NM_res_sem_reg ? '' : ' style="display: none"';
      $nm_saida->saida("  <TR id=\"rec_not_found_chart\"" . $displayMessage . ">\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("   <TD class=\"scGridFieldOdd scGridFieldOddFont\" align=\"center\" style=\"vertical-align: top;font-family:" . $this->Ini->texto_fonte_tipo_impar . ";font-size:12px;color:#000000;\">\r\n");
      $nm_saida->saida("     " . $res_sem_reg . "\r\n");
      $nm_saida->saida("   </TD>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ajax_nav'])
      { 
         if ($this->NM_res_sem_reg)
         {
              $this->Ini->Arr_result['setDisplay'][] = array('field' => 'rec_not_found_chart', 'value' => '');
              $this->Ini->Arr_result['setVisibility'][] = array('field' => 'res_chart_table', 'value' => 'hidden');
         }
         else
         {
              $this->Ini->Arr_result['setDisplay'][] = array('field' => 'rec_not_found_chart', 'value' => 'none');
              $this->Ini->Arr_result['setDisplay'][] = array('field' => 'res_chart_table', 'value' => '');
              $this->Ini->Arr_result['setVisibility'][] = array('field' => 'res_chart_table', 'value' => 'visible');
         }
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("  </TR>\r\n");
   }

   //---- 
   function resumo_final()
   {
      if ($this->NM_export)
      {
          return;
      }
      $this->monta_html_fim();
   }

   //---- 
   function inicializa_vars()
   {
      $this->Tot_ger = false;
      require_once($this->Ini->path_aplicacao . "v_table_project_copy_total.class.php"); 
      $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['print_all'];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['doc_word'])
      { 
          $this->NM_raiz_img = $this->Ini->root; 
      } 
      else 
      { 
          $this->NM_raiz_img = ""; 
      } 
      if ($this->Print_All)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] = "print";
          $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_res_prt; 
      }
      else
      {
          $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_res; 
      }
      $this->Total   = new v_table_project_copy_total($this->Ini->sc_page);
      $this->prep_modulos("Total");
      if ($this->NM_export)
      {
          return;
      }
      $this->que_linha = "impar";
      $this->css_line_back = $this->css_scGridFieldOdd;
      $this->css_line_fonf = $this->css_scGridFieldOddFont;
      $this->Ini->cor_link_dados = $this->css_scGridFieldOddLink;
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['LigR_Md5'] = array();
   }

   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   //---- 
   function totaliza()
   {
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'] as $ind => $val)
      {
          if ($ind > 0)
          {
              $this->array_total_geral[$ind - 1] = $val;
          }
      }
      $this->array_total_md_namadatel = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['md_namadatel'];
      $this->array_total_tm_namamitra = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['tm_namamitra'];
      $this->array_total_statusname = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['statusname'];
      ksort($this->array_total_md_namadatel);
      ksort($this->array_total_tm_namamitra);
      ksort($this->array_total_statusname);
   }

   //----- 
   function monta_html_ini($first_table = true)
   {
      global $nm_saida, $nmgp_tipo_pdf, $nmgp_cor_print;

      if ($first_table)
      {

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida'])
      { 
          $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px; width: 100%;\">\r\n");
          return;
      } 
if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['doc_word'])
{
       $nm_saida->saida("<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:word\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
}
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['responsive_chart']['active']) {
$nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
$nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
}
      $nm_saida->saida("<HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
      $nm_saida->saida("<HEAD>\r\n");
      $nm_saida->saida(" <TITLE>Resume Project Detail by Lokasi</TITLE>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['doc_word'])
{
      $nm_saida->saida(" <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
}
      $nm_saida->saida(" <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n");
       $css_body = "";
      $nm_saida->saida(" <style type=\"text/css\">\r\n");
      $nm_saida->saida("  BODY { " . $css_body . " }\r\n");
      $nm_saida->saida(" </style>\r\n");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['doc_word'])
      { 
           $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form.css\" /> \r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery-ui.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput2.js\"></script>\r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"v_table_project_copy_ajax.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("   var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("   var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("   var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("   var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida(" </script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"v_table_project_copy_jquery.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\">var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';</script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid.css\"  type=\"text/css\"/> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"  type=\"text/css\"/> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['num_css']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['num_css'] = rand(0, 1000);
      }
      $NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_v_table_project_copy_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['num_css'] . '.css', 'w');
      if (($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
      {
          $NM_css_file = $this->Ini->str_schema_all . "_grid_bw.css";
          $NM_css_dir  = $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      }
      else
      {
          $NM_css_file = $this->Ini->str_schema_all . "_grid.css";
          $NM_css_dir  = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      }
      if (is_file($this->Ini->path_css . $NM_css_file))
      {
          $NM_css_attr = file($this->Ini->path_css . $NM_css_file);
          foreach ($NM_css_attr as $NM_line_css)
          {
              $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
              @fwrite($NM_css, "    " .  $NM_line_css . "\r\n");
          }
      }
      if (is_file($this->Ini->path_css . $NM_css_dir))
      {
          $NM_css_attr = file($this->Ini->path_css . $NM_css_dir);
          foreach ($NM_css_attr as $NM_line_css)
          {
              $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
              @fwrite($NM_css, "    " .  $NM_line_css . "\r\n");
          }
      }
      @fclose($NM_css);
     $this->Ini->summary_css = $this->Ini->path_imag_temp . '/sc_css_v_table_project_copy_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['num_css'] . '.css';
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] == "print")
     {
         $nm_saida->saida("  <style type=\"text/css\">\r\n");
         $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_v_table_project_copy_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['num_css'] . '.css');
         foreach ($NM_css as $cada_css)
         {
              $nm_saida->saida("  " . str_replace("rn", "", $cada_css) . "\r\n");
         }
         $nm_saida->saida("  </style>\r\n");
     }
     else
     {
         $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->summary_css . "\" type=\"text/css\" media=\"screen\" />\r\n");
     }
      $nm_saida->saida(" <style type=\"text/css\">\r\n");
       $nm_saida->saida(" .scGridTabela TD { white-space: nowrap }\r\n");
      $nm_saida->saida(" </style>\r\n");
$nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "v_table_project_copy/v_table_project_copy_res_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     function scBtnGroupByShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).done(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnGroupByHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSaveGridShow(origem, embbed, pos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"POST\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: \"\",\r\n");
           $nm_saida->saida("         data: \"path_img=" . $this->Ini->path_img_global . "&path_btn=" . $this->Ini->path_botoes . "&path_grid_sv=" . $this->Ini->path_grid_sv . "&script_case_init=" . $this->Ini->sc_page . "&script_case_session=" . session_id() . "&script_origem=\" + origem + \"&embbed_groupby=\" + embbed + \"&toolbar_pos=\" + pos\r\n");
           $nm_saida->saida("       }).done(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_save_grid_placeholder_\" + pos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("         $(\"#sc_id_save_grid_placeholder_\" + pos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_save_grid_placeholder_\" + pos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSaveGridHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_save_grid_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSelCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).done(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSelCamposHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnOrderCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).done(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnOrderCamposHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   </script>\r\n");

if ($_SESSION['scriptcase']['proc_mobile'])
{
       $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\" />\r\n");
}

      $nm_saida->saida("</HEAD>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['responsive_chart']['active']) {
          $summary_width = "width=\"100%\"";
          $chart_height = " style=\"height: 100%\"";
      }
      else {
          $chart_height = '';
          if ($_SESSION['scriptcase']['proc_mobile'])
          {
              $summary_width = "width=\"100%\"";
          }
          else
          {
              $summary_width = "width=\"\"";
          }
      }
      $nm_saida->saida(" <BODY class=\"" . $this->css_scGridPage . "\">\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida'])
      {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none; position: absolute; left: 50px; top: 50px\"><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
      }
      $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] == "pdf")
      { 
              $nm_saida->saida("  <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_othr_smry_msge'] . "</H1></div>\r\n");
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['doc_word'])
      { 
          $nm_saida->saida("      <STYLE>\r\n");
          $nm_saida->saida("       .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;color:black;}\r\n");
          $nm_saida->saida("      </STYLE>\r\n");
          $nm_saida->saida("      <div id=\"tooltip\" style=\"position:absolute;visibility:hidden;border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;padding:1px;color:black;\"></div>\r\n");
      } 

      }

      $nm_saida->saida("<TABLE id=\"main_table_res\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" " . $summary_width . $chart_height . ">\r\n");
      $nm_saida->saida(" <TR>\r\n");
      $nm_saida->saida("  <TD" . $chart_height . ">\r\n");
      $nm_saida->saida("  <div class=\"scGridBorder\"" . $chart_height . ">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"scGridLabel\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
      $nm_saida->saida("  <table width='100%' cellspacing=0 cellpadding=0" . $chart_height . ">\r\n");
      $nm_saida->saida("<TR>\r\n");
      $nm_saida->saida("<TD style=\"padding: 0px\">\r\n");
      $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px; border-collapse: collapse;  vertical-align: top; width: 100%;\">\r\n");
   }

   //-----  top
   function monta_barra_top_normal()
   {
      global $nm_url_saida, $nm_apl_dependente, $nm_saida;
      $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida'])
      {
         $nm_saida->saida(" <TR align=\"center\" id=\"obj_barra_top\">\r\n");
         $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
         $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");
         $nm_saida->saida("    <TR>\r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\">\r\n");
         $NM_btn = false;
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\">\r\n");
         $NM_btn = false;
         if (is_file("v_table_project_copy_help.txt") && !$this->grid_emb_form && !$this->NM_res_sem_reg)
         {
            $Arq_WebHelp = file("v_table_project_copy_help.txt"); 
            if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
            {
                $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                $Tmp = explode(";", $Arq_WebHelp[0]); 
                foreach ($Tmp as $Cada_help)
                {
                    $Tmp1 = explode(":", $Cada_help); 
                    if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "res" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                    {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "Rhelp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                    }
                }
            }
         }
      if ($this->nmgp_botoes['chart_exit'] == 'on' && !$this->grid_emb_form)
      {
         if ($nm_apl_dependente == 1) 
         { 
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.FRES.action='$nm_url_saida'; document.FRES.submit()", "document.FRES.action='$nm_url_saida'; document.FRES.submit()", "Rsai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         } 
         elseif (!$this->Ini->SC_Link_View && !$this->aba_iframe) 
         { 
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.FRES.action='$nm_url_saida'; document.FRES.submit()", "document.FRES.action='$nm_url_saida'; document.FRES.submit()", "Rsai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         } 
      }
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\">\r\n");
         $NM_btn = false;
         $nm_saida->saida("     </TD>\r\n");
         $nm_saida->saida("    </TR>\r\n");
         $nm_saida->saida("   </TABLE>\r\n");
         $nm_saida->saida("  </TD>\r\n");
         $nm_saida->saida(" </TR>\r\n");
      }
   }

   //-----  top
   function monta_barra_top_mobile()
   {
      global $nm_url_saida, $nm_apl_dependente, $nm_saida;
      $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida'])
      {
         $nm_saida->saida(" <TR align=\"center\" id=\"obj_barra_top\">\r\n");
         $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
         $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");
         $nm_saida->saida("    <TR>\r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\">\r\n");
         $NM_btn = false;
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\">\r\n");
         $NM_btn = false;
         if (is_file("v_table_project_copy_help.txt") && !$this->grid_emb_form && !$this->NM_res_sem_reg)
         {
            $Arq_WebHelp = file("v_table_project_copy_help.txt"); 
            if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
            {
                $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                $Tmp = explode(";", $Arq_WebHelp[0]); 
                foreach ($Tmp as $Cada_help)
                {
                    $Tmp1 = explode(":", $Cada_help); 
                    if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "res" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                    {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "')", "Rhelp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                    }
                }
            }
         }
      if ($this->nmgp_botoes['chart_exit'] == 'on' && !$this->grid_emb_form)
      {
         if ($nm_apl_dependente == 1) 
         { 
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.FRES.action='$nm_url_saida'; document.FRES.submit()", "document.FRES.action='$nm_url_saida'; document.FRES.submit()", "Rsai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         } 
         elseif (!$this->Ini->SC_Link_View && !$this->aba_iframe) 
         { 
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.FRES.action='$nm_url_saida'; document.FRES.submit()", "document.FRES.action='$nm_url_saida'; document.FRES.submit()", "Rsai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
         } 
      }
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\">\r\n");
         $NM_btn = false;
         $nm_saida->saida("     </TD>\r\n");
         $nm_saida->saida("    </TR>\r\n");
         $nm_saida->saida("   </TABLE>\r\n");
         $nm_saida->saida("  </TD>\r\n");
         $nm_saida->saida(" </TR>\r\n");
      }
   }

   function monta_barra_top()
   {
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->monta_barra_top_mobile();
       }
       else
       {
           $this->monta_barra_top_normal();
       }
   }
   function monta_barra_bot()
   {
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->monta_barra_bot_mobile();
       }
       else
       {
           $this->monta_barra_bot_normal();
       }
   }
   function monta_embbed_placeholder_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function monta_embbed_placeholder_mobile_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   //----- 
   function monta_html_fim()
   {
      global $nm_saida;
      $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
      $nm_saida->saida("</TABLE>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['embutida'])
      { 
          return;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['doc_word'])
      { 
      $nm_saida->saida("</BODY>\r\n");
      $nm_saida->saida("</HTML>\r\n");
          return;
      } 
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['doc_word'])
{ 
      $nm_saida->saida("</TABLE>\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("</TD>\r\n");
      $nm_saida->saida("</TR>\r\n");
      $nm_saida->saida("</TABLE>\r\n");
       $nm_saida->saida("<script type=\"text/javascript\">\r\n");
       $nm_saida->saida("function summaryConfig() {\r\n");
       $nm_saida->saida("  tb_show('', 'v_table_project_copy_config_pivot.php?nome_apl=v_table_project_copy&sc_page=" . NM_encode_input($this->Ini->sc_page) . "&language=en_us&TB_iframe=true&modal=true&height=300&width=500', '');\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function changeSort(col, ord, oldSort) {\r\n");
       $nm_saida->saida("  Parm_change  = 'change_sort*scin';\r\n");
       $nm_saida->saida("  Parm_change += oldSort ? 'Y' : 'NEW';\r\n");
       $nm_saida->saida("  Parm_change += '*scoutsort_col*scin';\r\n");
       $nm_saida->saida("  Parm_change +=  col;\r\n");
       $nm_saida->saida("  Parm_change += '*scoutsort_ord*scin';\r\n");
       $nm_saida->saida("  Parm_change +=  ord;\r\n");
       $nm_saida->saida("  nm_gp_submit_ajax('resumo', Parm_change);\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("</script>\r\n");
       $nm_saida->saida("<form name=\"refresh_config\" method=\"post\" action=\"./\" style=\"display: none\">\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"nmgp_opcao\" value=\"resumo\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"change_sort\" value=\"N\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"sort_col\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"sort_ord\" />\r\n");
       $nm_saida->saida("</form>\r\n");
}
      $nm_saida->saida("<FORM name=\"F3\" method=\"post\" action=\"./\"\r\n");
      $nm_saida->saida("                                  target = \"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_chave\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_opcao\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_ordem\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_chave_det\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_quant_linhas\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_url_saida\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_parms\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_outra_jan\" value=\"\"/>\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_orig_pesq\" value=\"\"/>\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
      $nm_saida->saida("</FORM>\r\n");
      $nm_saida->saida("<form name=\"FRES\" method=\"post\" \r\n");
      $nm_saida->saida("                    action=\"\" \r\n");
      $nm_saida->saida("                    target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
      $nm_saida->saida("</form> \r\n");
      $nm_saida->saida("<form name=\"FCONS\" method=\"post\" \r\n");
      $nm_saida->saida("                    action=\"./\" \r\n");
      $nm_saida->saida("                    target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_opcao\" value=\"link_res\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_parms_where\" value=\"\" />\r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
      $nm_saida->saida("</form> \r\n");
   $nm_saida->saida("   <form name=\"F4\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"rec\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"rec\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_call_php\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
   $nm_saida->saida("   </form> \r\n");
      $nm_saida->saida("<form name=\"Fgraf\" method=\"post\" \r\n");
      $nm_saida->saida("                   action=\"./\" \r\n");
      $nm_saida->saida("                   target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_opcao\" value=\"grafico\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"campo\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nivel_quebra\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"campo_val\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_parms\" value=\"\" />\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"script_case_session\" value=\"" . NM_encode_input(session_id()) . "\" />\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"summary_css\" value=\"" . NM_encode_input($this->Ini->summary_css) . "\"/> \r\n");
      $nm_saida->saida("</form> \r\n");
      $nm_saida->saida("<SCRIPT language=\"Javascript\">\r\n");
      $nm_saida->saida(" function nm_link_cons(x) \r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("     document.FCONS.nmgp_parms_where.value = x;\r\n");
      $nm_saida->saida("     document.FCONS.submit();\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_gp_submit_ajax(opc, parm) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    ajax_navigate_res(opc, parm); \r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function nm_gp_move(x, y, z, p, g, crt) \r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("  document.F3.nmgp_opcao.value = x;\r\n");
      $nm_saida->saida("  document.F3.target = \"_self\"; \r\n");
      $nm_saida->saida("  if (y == 1) \r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.target = \"_blank\"; \r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  if (\"busca\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.nmgp_orig_pesq.value = z; \r\n");
      $nm_saida->saida("      z = '';\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  if (z != null && z != '') \r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("     document.F3.nmgp_tipo_pdf.value = z;\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  document.F3.script_case_init.value = \"" . NM_encode_input($this->Ini->sc_page) . "\" ;\r\n");
      $nm_saida->saida("  if (\"xls_res\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      if (!extension_loaded("zip"))
      {
      $nm_saida->saida("      alert (\"" . html_entity_decode($this->Ini->Nm_lang['lang_othr_prod_xtzp'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\");\r\n");
      $nm_saida->saida("      return false;\r\n");
      } 
      $nm_saida->saida("  }\r\n");
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['v_table_project_copy_iframe_params'] = array(
          'str_tmp'    => $this->Ini->path_imag_temp,
          'str_prod'   => $this->Ini->path_prod,
          'str_btn'    => $this->Ini->Str_btn_css,
          'str_lang'   => $this->Ini->str_lang,
          'str_schema' => $this->Ini->str_schema_all,
      );
      $prep_parm_pdf = "nmgp_opcao?#?pdf_res?@?scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?script_case_session?#?" . session_id() . "?@?pbfile?#?" . $str_pbfile . "?@?jspath?#?" . $this->Ini->path_js . "?@?sc_apbgcol?#?" . $this->Ini->path_css . "?#?";
      $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@v_table_project_copy@SC_par@" . md5($prep_parm_pdf);
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
      $nm_saida->saida("  if (\"pdf\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      window.location = \"" . $this->Ini->path_link . "v_table_project_copy/v_table_project_copy_iframe.php?nmgp_parms=" . $Md5_pdf . "&sc_tp_pdf=\" + z + \"&sc_parms_pdf=\" + p + \"&sc_create_charts=\" + crt + \"&sc_graf_pdf=\" + g;\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  else\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.submit();\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    if (apl_lig.substr(0, 7) == \"http://\" || apl_lig.substr(0, 8) == \"https://\")\r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        if (target == '_blank') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            window.open (apl_lig);\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        else\r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            window.location = apl_lig;\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        return;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    if (target == 'modal') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        par_modal = '?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&script_case_session=" . session_id() . "&nmgp_outra_jan=true&nmgp_url_saida=modal';\r\n");
      $nm_saida->saida("        if (opc != null && opc != '') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            par_modal += '&nmgp_opcao=grid';\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        if (parms != null && parms != '') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            par_modal += '&nmgp_parms=' + parms;\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');\r\n");
      $nm_saida->saida("        return;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.target               = target; \r\n");
      $nm_saida->saida("    if (target == '_blank') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.action               = apl_lig  ;\r\n");
      $nm_saida->saida("    if (opc != null && opc != '') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    else\r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_opcao.value = \"\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
      $nm_saida->saida("    document.F3.nmgp_parms.value = parms ;\r\n");
      $nm_saida->saida("    document.F3.submit() ;\r\n");
      $nm_saida->saida("    document.F3.nmgp_outra_jan.value = \"\";\r\n");
      $nm_saida->saida("    document.F3.nmgp_parms.value = \"\";\r\n");
      $nm_saida->saida("    document.F3.action = \"./\";\r\n");
      $nm_saida->saida(" } \r\n");
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
      $nm_saida->saida("                  elm.style.top = nm_evt.pageY + 2;\r\n");
      $nm_saida->saida("                  elm.style.left = nm_evt.pageX + 14;\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              else\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  elm.style.top = nm_evt.y + document.body.scrollTop + 10;\r\n");
      $nm_saida->saida("                  elm.style.left = nm_evt.x + document.body.scrollLeft + 10;\r\n");
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
      $nm_saida->saida(" function nm_graf_submit(campo, nivel, campo_val, parms, target) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    document.Fgraf.campo.value = campo ;\r\n");
      $nm_saida->saida("    document.Fgraf.nivel_quebra.value = nivel ;\r\n");
      $nm_saida->saida("    document.Fgraf.campo_val.value = campo_val ;\r\n");
      $nm_saida->saida("    document.Fgraf.nmgp_parms.value   = parms ;\r\n");
      $nm_saida->saida("    if (target != null) \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.Fgraf.target = target; \r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.Fgraf.submit() ;\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function nm_graf_submit_2(chart)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("    var oldAction = document.Fgraf.action;\r\n");
      $nm_saida->saida("    document.Fgraf.action = nm_url_rand(document.Fgraf.action);\r\n");
      $nm_saida->saida("    document.Fgraf.nmgp_parms.value = chart;\r\n");
      $nm_saida->saida("    document.Fgraf.target = \"_blank\";\r\n");
      $nm_saida->saida("    document.Fgraf.submit();\r\n");
      $nm_saida->saida("    document.Fgraf.action = oldAction;\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function nm_open_popup(parms)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("     NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_url_rand(v_str_url)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("  str_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';\r\n");
      $nm_saida->saida("  str_rand  = v_str_url;\r\n");
      $nm_saida->saida("  str_rand += (-1 == v_str_url.indexOf('?')) ? '?' : '&';\r\n");
      $nm_saida->saida("  str_rand += 'r=';\r\n");
      $nm_saida->saida("  for (i = 0; i < 8; i++)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("   str_rand += str_chars.charAt(Math.round(str_chars.length * Math.random()));\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  return str_rand;\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida("</SCRIPT>\r\n");
      $nm_saida->saida("</BODY>\r\n");
      $nm_saida->saida("</HTML>\r\n");
   }

   function monta_html_ini_pdf()
   {
      global $nm_saida;
       $tp_quebra = "";
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['num_css']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['num_css']))
       {
           $NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_v_table_project_copy_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['num_css'] . '.css', 'a');
           $NM_css_file = $this->Ini->root . $this->Ini->path_link . "v_table_project_copy/v_table_project_copy_res_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']). ".css";
           if (is_file($NM_css_file))
           {
               $NM_css_attr = file($NM_css_file);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   @fwrite($NM_css, "    " . $NM_line_css . "\r\n");
               }
           }
           @fclose($NM_css);
       }
       $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['print_all'];
       $tp_quebra = "<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>";
       if ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['print_all'])
       {
       $tp_quebra = "<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>";
       }
       $nm_saida->saida("" . $tp_quebra . "\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['responsive_chart']['active']) {
           $summary_width = "width=\"100%\"";
       }
       else {
           if ($_SESSION['scriptcase']['proc_mobile'])
           {
               $summary_width = "width=\"100%\"";
           }
           else
           {
               $summary_width = "width=\"100%\"";
           }
       }
       $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" align=\"center\" valign=\"top\" " . $summary_width . ">\r\n");
       $nm_saida->saida("<TR>\r\n");
       $nm_saida->saida("<TD style=\"padding: 0px\">\r\n");
       $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px; width: 100%;\">\r\n");
   }
   function monta_html_fim_pdf()
   {
      global $nm_saida;
      $nm_saida->saida("</TABLE>\r\n");
      $nm_saida->saida("</TD>\r\n");
      $nm_saida->saida("</TR>\r\n");
      $nm_saida->saida("</TABLE>\r\n");
   }

   //---- 
   function inicializa_arrays()
   {
      $this->array_total_md_namadatel = array();
      $this->array_total_tm_namamitra = array();
      $this->array_total_statusname = array();
      $this->array_total_geral = array();
   }

   //---- 
   function adiciona_registro($sum_tp_odp, $avg_prepare, $avg_perijinan, $avg_inst_testcomm, $avg_closing, $avg_pencapaian, $quebra_md_namadatel, $quebra_tm_namamitra, $quebra_statusname, $quebra_md_namadatel_orig, $quebra_tm_namamitra_orig, $quebra_statusname_orig)
   {
      //----- MD NAMADATEL
      if (!isset($this->array_total_md_namadatel[$quebra_md_namadatel_orig]))
      {
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][0] = 1;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][1] = $sum_tp_odp;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][2] = $avg_prepare;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][3] = $avg_perijinan;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][4] = $avg_inst_testcomm;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][5] = $avg_closing;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][6] = $avg_pencapaian;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][7] = 1;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][8] = $quebra_md_namadatel;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][9] = $quebra_md_namadatel_orig;
      }
      else
      {
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][0]++;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][1] += $sum_tp_odp;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][2] += $avg_prepare;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][3] += $avg_perijinan;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][4] += $avg_inst_testcomm;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][5] += $avg_closing;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][6] += $avg_pencapaian;
         $this->array_total_md_namadatel[$quebra_md_namadatel_orig][7]++;
      }
      //----- TM NAMAMITRA
      if (!isset($this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig]))
      {
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][0] = 1;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][1] = $sum_tp_odp;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][2] = $avg_prepare;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][3] = $avg_perijinan;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][4] = $avg_inst_testcomm;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][5] = $avg_closing;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][6] = $avg_pencapaian;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][7] = 1;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][8] = $quebra_tm_namamitra;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][9] = $quebra_tm_namamitra_orig;
      }
      else
      {
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][0]++;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][1] += $sum_tp_odp;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][2] += $avg_prepare;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][3] += $avg_perijinan;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][4] += $avg_inst_testcomm;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][5] += $avg_closing;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][6] += $avg_pencapaian;
         $this->array_total_tm_namamitra[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][7]++;
      }
      //----- STATUSNAME
      if (!isset($this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig]))
      {
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][0] = 1;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][1] = $sum_tp_odp;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][2] = $avg_prepare;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][3] = $avg_perijinan;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][4] = $avg_inst_testcomm;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][5] = $avg_closing;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][6] = $avg_pencapaian;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][7] = 1;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][8] = $quebra_statusname;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][9] = $quebra_statusname_orig;
      }
      else
      {
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][0]++;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][1] += $sum_tp_odp;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][2] += $avg_prepare;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][3] += $avg_perijinan;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][4] += $avg_inst_testcomm;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][5] += $avg_closing;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][6] += $avg_pencapaian;
         $this->array_total_statusname[$quebra_md_namadatel_orig][$quebra_tm_namamitra_orig][$quebra_statusname_orig][7]++;
      }
      //----- Total
      if (empty($this->array_total_geral))
      {
         $this->array_total_geral[0] = 1;
         $this->array_total_geral[1] = $sum_tp_odp;
         $this->array_total_geral[2] = $avg_prepare;
         $this->array_total_geral[3] = $avg_perijinan;
         $this->array_total_geral[4] = $avg_inst_testcomm;
         $this->array_total_geral[5] = $avg_closing;
         $this->array_total_geral[6] = $avg_pencapaian;
         $this->array_total_geral[7] = 1;
      }
      else
      {
         $this->array_total_geral[0]++;
         $this->array_total_geral[1] += $sum_tp_odp;
         $this->array_total_geral[2] += $avg_prepare;
         $this->array_total_geral[3] += $avg_perijinan;
         $this->array_total_geral[4] += $avg_inst_testcomm;
         $this->array_total_geral[5] += $avg_closing;
         $this->array_total_geral[6] += $avg_pencapaian;
         $this->array_total_geral[7]++;
      }
   }

   //---- Compat arrays
   function compat_arrays()
   {
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['md_namadatel'] as $campo_md_namadatel => $dados_md_namadatel)
      {
         $this->array_total_md_namadatel[$campo_md_namadatel][2] = $dados_md_namadatel[1];
         $this->array_total_md_namadatel[$campo_md_namadatel][3] = $dados_md_namadatel[2];
         $this->array_total_md_namadatel[$campo_md_namadatel][4] = $dados_md_namadatel[3];
         $this->array_total_md_namadatel[$campo_md_namadatel][5] = $dados_md_namadatel[4];
         $this->array_total_md_namadatel[$campo_md_namadatel][6] = $dados_md_namadatel[5];
         $this->array_total_md_namadatel[$campo_md_namadatel][7] = $dados_md_namadatel[6];
         $this->array_total_md_namadatel[$campo_md_namadatel][1] = $dados_md_namadatel[7];
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['tm_namamitra'][$campo_md_namadatel] as $campo_tm_namamitra => $dados_tm_namamitra)
         {
            $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][2] = $dados_tm_namamitra[1];
            $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][3] = $dados_tm_namamitra[2];
            $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][4] = $dados_tm_namamitra[3];
            $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][5] = $dados_tm_namamitra[4];
            $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][6] = $dados_tm_namamitra[5];
            $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][7] = $dados_tm_namamitra[6];
            $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][1] = $dados_tm_namamitra[7];
            foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['statusname'][$campo_md_namadatel][$campo_tm_namamitra] as $campo_statusname => $dados_statusname)
            {
               $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][2] = $dados_statusname[1];
               $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][3] = $dados_statusname[2];
               $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][4] = $dados_statusname[3];
               $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][5] = $dados_statusname[4];
               $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][6] = $dados_statusname[5];
               $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][7] = $dados_statusname[6];
               $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][1] = $dados_statusname[7];
            }
         }
      }
   }
   //---- 
   function finaliza_arrays()
   {
      foreach ($this->array_total_md_namadatel as $campo_md_namadatel => $dados_md_namadatel)
      {
         nmgp_Trunc_Num($this->array_total_md_namadatel[$campo_md_namadatel][1], 0);
         if ($this->array_total_md_namadatel[$campo_md_namadatel][0] != 0) {$this->array_total_md_namadatel[$campo_md_namadatel][2] /= $this->array_total_md_namadatel[$campo_md_namadatel][0];}
         nmgp_Trunc_Num($this->array_total_md_namadatel[$campo_md_namadatel][2], 2);
         if ($this->array_total_md_namadatel[$campo_md_namadatel][0] != 0) {$this->array_total_md_namadatel[$campo_md_namadatel][3] /= $this->array_total_md_namadatel[$campo_md_namadatel][0];}
         nmgp_Trunc_Num($this->array_total_md_namadatel[$campo_md_namadatel][3], 2);
         if ($this->array_total_md_namadatel[$campo_md_namadatel][0] != 0) {$this->array_total_md_namadatel[$campo_md_namadatel][4] /= $this->array_total_md_namadatel[$campo_md_namadatel][0];}
         nmgp_Trunc_Num($this->array_total_md_namadatel[$campo_md_namadatel][4], 2);
         if ($this->array_total_md_namadatel[$campo_md_namadatel][0] != 0) {$this->array_total_md_namadatel[$campo_md_namadatel][5] /= $this->array_total_md_namadatel[$campo_md_namadatel][0];}
         nmgp_Trunc_Num($this->array_total_md_namadatel[$campo_md_namadatel][5], 2);
         if ($this->array_total_md_namadatel[$campo_md_namadatel][0] != 0) {$this->array_total_md_namadatel[$campo_md_namadatel][6] /= $this->array_total_md_namadatel[$campo_md_namadatel][0];}
         nmgp_Trunc_Num($this->array_total_md_namadatel[$campo_md_namadatel][6], 2);
         foreach ($this->array_total_tm_namamitra[$campo_md_namadatel] as $campo_tm_namamitra => $dados_tm_namamitra)
         {
            nmgp_Trunc_Num($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][1], 0);
            if ($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][0] != 0) {$this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][2] /= $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][0];}
            nmgp_Trunc_Num($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][2], 2);
            if ($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][0] != 0) {$this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][3] /= $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][0];}
            nmgp_Trunc_Num($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][3], 2);
            if ($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][0] != 0) {$this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][4] /= $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][0];}
            nmgp_Trunc_Num($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][4], 2);
            if ($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][0] != 0) {$this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][5] /= $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][0];}
            nmgp_Trunc_Num($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][5], 2);
            if ($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][0] != 0) {$this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][6] /= $this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][0];}
            nmgp_Trunc_Num($this->array_total_tm_namamitra[$campo_md_namadatel][$campo_tm_namamitra][6], 2);
            foreach ($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra] as $campo_statusname => $dados_statusname)
            {
               nmgp_Trunc_Num($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][1], 0);
               if ($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][0] != 0) {$this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][2] /= $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][0];}
               nmgp_Trunc_Num($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][2], 2);
               if ($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][0] != 0) {$this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][3] /= $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][0];}
               nmgp_Trunc_Num($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][3], 2);
               if ($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][0] != 0) {$this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][4] /= $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][0];}
               nmgp_Trunc_Num($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][4], 2);
               if ($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][0] != 0) {$this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][5] /= $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][0];}
               nmgp_Trunc_Num($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][5], 2);
               if ($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][0] != 0) {$this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][6] /= $this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][0];}
               nmgp_Trunc_Num($this->array_total_statusname[$campo_md_namadatel][$campo_tm_namamitra][$campo_statusname][6], 2);
            }
         }
      }
      $this->array_total_geral[2] /= $this->array_total_geral[0];
      $this->array_total_geral[3] /= $this->array_total_geral[0];
      $this->array_total_geral[4] /= $this->array_total_geral[0];
      $this->array_total_geral[5] /= $this->array_total_geral[0];
      $this->array_total_geral[6] /= $this->array_total_geral[0];
   }

   function prepara_resumo()
   {
      $this->inicializa_vars();
      $this->resumo_init();
      $this->inicializa_arrays();
   }

   function finaliza_resumo()
   {
      $this->finaliza_arrays();
   }

//
   function nm_acumula_resumo($nm_tipo="resumo")
   {
     global $nm_lang;
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['campos_busca']))
     { 
         $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['campos_busca'];
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
       $tp_id_2 = $Busca_temp['tp_id_input_2']; 
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
     $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_orig'];
     $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_pesq'];
     $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_pesq_filtro'];
     $this->nm_field_dinamico = array();
     $this->nm_order_dinamico = array();
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ""; 
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
     else 
     { 
         $nmgp_select = "SELECT TP_ID, MW_NAMAWITEL, MD_NAMADATEL, MS_NAMASTO, TEMPLATENAME, STATUSNAME, TM_NAMAMITRA, TP_BATCH, TP_PROJECTNAME, TP_LOKASI, TP_ODP, TP_PLANSTART, TP_PLANFINISH, TP_SUMMARY, TP_STATUS, TP_JENISPROJECT, TP_PRJTRELEASE, TP_TARGETWAKTU, TP_MITRA, TP_WITEL, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
     } 
     $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_pesq']; 
     $campos_order = "";
     $format       = $this->Ini->Get_Gb_date_format('', 'md_namadatel');
     $campos_order = $this->Ini->Get_date_order_groupby("MD_NAMADATEL", 'asc', $format, $campos_order);
     $format       = $this->Ini->Get_Gb_date_format('', 'tm_namamitra');
     $campos_order = $this->Ini->Get_date_order_groupby("TM_NAMAMITRA", 'asc', $format, $campos_order);
     $format       = $this->Ini->Get_Gb_date_format('', 'statusname');
     $campos_order = $this->Ini->Get_date_order_groupby("STATUSNAME", 'asc', $format, $campos_order);
     $nmgp_select .= $nmgp_order_by; 
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
     $rs_res = $this->Db->Execute($nmgp_select) ; 
     if ($rs_res === false && !$rs_graf->EOF) 
     { 
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
// 
     if ($nm_tipo != "resumo") 
     {  
          $this->nm_acum_res_unit($rs_res, $nm_tipo);
     }  
     else  
     {  
         while (!$rs_res->EOF) 
         {  
                $this->nm_acum_res_unit($rs_res, "resumo");
                $rs_res->MoveNext();
         }  
     }  
     $rs_res->Close();
   }
// 
   function nm_acum_res_unit($rs_res, $nm_tipo="resumo")
   {
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['campos_busca']))
            { 
                $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['campos_busca'];
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
            $this->tp_id = $rs_res->fields[0] ;  
            $this->mw_namawitel = $rs_res->fields[1] ;  
            $this->md_namadatel = $rs_res->fields[2] ;  
            $this->ms_namasto = $rs_res->fields[3] ;  
            $this->templatename = $rs_res->fields[4] ;  
            $this->statusname = $rs_res->fields[5] ;  
            $this->tm_namamitra = $rs_res->fields[6] ;  
            $this->tp_batch = $rs_res->fields[7] ;  
            $this->tp_projectname = $rs_res->fields[8] ;  
            $this->tp_lokasi = $rs_res->fields[9] ;  
            $this->tp_odp = $rs_res->fields[10] ;  
            $this->tp_planstart = $rs_res->fields[11] ;  
            $this->tp_planfinish = $rs_res->fields[12] ;  
            $this->tp_summary = $rs_res->fields[13] ;  
            $this->tp_status = $rs_res->fields[14] ;  
            $this->tp_jenisproject = $rs_res->fields[15] ;  
            $this->tp_prjtrelease = $rs_res->fields[16] ;  
            $this->tp_targetwaktu = $rs_res->fields[17] ;  
            $this->tp_mitra = $rs_res->fields[18] ;  
            $this->tp_witel = $rs_res->fields[19] ;  
            $this->tp_templateproject = $rs_res->fields[20] ;  
            $_SESSION['scriptcase']['v_table_project_copy']['contr_erro'] = 'on';
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



$check_sql = "SELECT COUNT(PROJECTPHASEID) AS JMLID FROM TB_TAHAPAN_PROJECT
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
	
	$sqlprogress = "SELECT SUM(TPP_PROSENTASEPROJECT) as SUMPROGRESS FROM TBL_PROJECT_PROGRESS
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
$_SESSION['scriptcase']['v_table_project_copy']['contr_erro'] = 'off'; 
            $this->md_namadatel_orig = $this->md_namadatel;
            $this->tm_namamitra_orig = $this->tm_namamitra;
            $this->statusname_orig = $this->statusname;
            if ($nm_tipo == "resumo")
            {
                $this->adiciona_registro($this->tp_odp, $this->prepare, $this->perijinan, $this->inst_testcomm, $this->closing, $this->pencapaian, $this->md_namadatel, $this->tm_namamitra, $this->statusname, $this->md_namadatel_orig,  $this->tm_namamitra_orig,  $this->statusname_orig);
            }
   }
//
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

   function totaliza_php_gbmitra()
   {
      $this->sc_proc_grid = true;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_pesq_filtro'];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['contr_total_geral'] == "OK" && $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['contr_array_resumo'] == "OK")
      {
          return;
      }
      //----- 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
         $nmgp_select = "SELECT TP_ID, MD_NAMADATEL, STATUSNAME, TM_NAMAMITRA, TP_ODP, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
         $nmgp_select = "SELECT TP_ID, MD_NAMADATEL, STATUSNAME, TM_NAMAMITRA, TP_ODP, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
         $nmgp_select = "SELECT TP_ID, MD_NAMADATEL, STATUSNAME, TM_NAMAMITRA, TP_ODP, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
         $nmgp_select = "SELECT TP_ID, MD_NAMADATEL, STATUSNAME, TM_NAMAMITRA, TP_ODP, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
         $nmgp_select = "SELECT TP_ID, MD_NAMADATEL, STATUSNAME, TM_NAMAMITRA, TP_ODP, TP_TEMPLATEPROJECT from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['where_pesq'] ; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   $campos_order = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ordem_quebra'] as $campo => $resto) 
   {
       foreach($resto as $sqldef => $ordem) 
       {
           $format       = $this->Ini->Get_Gb_date_format($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['SC_Ind_Groupby'], $campo);
           $campos_order = $this->Ini->Get_date_order_groupby($sqldef, $ordem, $format, $campos_order);
       }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ordem_grid'])) 
   { 
       if (!empty($campos_order)) 
       { 
           $campos_order .= ", ";
       } 
       $nmgp_order_by = " order by " . $campos_order . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['ordem_desc']; 
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
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['order_grid'] = $nmgp_order_by;
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
      $this->inicializa_arrays();
      $this->nm_grid_colunas = 0;
      while (!$this->rs_grid->EOF) 
      {
         $this->tp_id = $this->rs_grid->fields[0] ;  
         $this->tp_id = (string)$this->tp_id;  
         $this->md_namadatel = $this->rs_grid->fields[1] ;  
         $this->statusname = $this->rs_grid->fields[2] ;  
         $this->tm_namamitra = $this->rs_grid->fields[3] ;  
         $this->tp_odp = $this->rs_grid->fields[4] ;  
         $this->tp_odp = (string)$this->tp_odp;  
         $this->tp_templateproject = $this->rs_grid->fields[5] ;  
         $this->tp_templateproject = (string)$this->tp_templateproject;  
         $md_namadatel_orig = $this->md_namadatel;
         $tm_namamitra_orig = $this->tm_namamitra;
         $statusname_orig = $this->statusname;
         $_SESSION['scriptcase']['v_table_project_copy']['contr_erro'] = 'on';
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



$check_sql = "SELECT COUNT(PROJECTPHASEID) AS JMLID FROM TB_TAHAPAN_PROJECT
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
	
	$sqlprogress = "SELECT SUM(TPP_PROSENTASEPROJECT) as SUMPROGRESS FROM TBL_PROJECT_PROGRESS
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
$_SESSION['scriptcase']['v_table_project_copy']['contr_erro'] = 'off';
         $this->arg_sum_md_namadatel = " = " . $this->Db->qstr($this->md_namadatel);
         $this->arg_sum_statusname = " = " . $this->Db->qstr($this->statusname);
         $this->arg_sum_tm_namamitra = " = " . $this->Db->qstr($this->tm_namamitra);
         $this->adiciona_registro(NM_encode_input(sc_strip_script($this->tp_odp)), NM_encode_input(sc_strip_script($this->prepare)), NM_encode_input(sc_strip_script($this->perijinan)), NM_encode_input(sc_strip_script($this->inst_testcomm)), NM_encode_input(sc_strip_script($this->closing)), NM_encode_input(sc_strip_script($this->pencapaian)), sc_strip_script($this->md_namadatel), sc_strip_script($this->tm_namamitra), sc_strip_script($this->statusname), sc_strip_script($md_namadatel_orig), sc_strip_script($tm_namamitra_orig), sc_strip_script($statusname_orig));
         $this->rs_grid->MoveNext();
      }
      $this->finaliza_arrays();
      $this->rs_grid->Close();
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][2] = $this->array_total_geral[1];
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][3] = $this->array_total_geral[2];
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][4] = $this->array_total_geral[3];
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][5] = $this->array_total_geral[4];
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][6] = $this->array_total_geral[5];
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][7] = $this->array_total_geral[6];
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['contr_array_resumo'] = "OK";
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][1] = $this->array_total_geral[0];
      $count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][1];
      $sum_tp_odp = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][2];
      $avg_prepare = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][3];
      $avg_perijinan = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][4];
      $avg_inst_testcomm = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][5];
      $avg_closing = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][6];
      $avg_pencapaian = $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['tot_geral'][7];
      $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['contr_total_geral'] = "OK";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['SC_Ind_Groupby'] == "gbmitra")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['md_namadatel'] = $this->array_total_md_namadatel;
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['tm_namamitra'] = $this->array_total_tm_namamitra;
          $_SESSION['sc_session'][$this->Ini->sc_page]['v_table_project_copy']['arr_total']['statusname'] = $this->array_total_statusname;
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
}
?>
