<?php

class project_edit_update_main_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['project_edit_update_main']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['project_edit_update_main']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->tp_idlop = $Busca_temp['tp_idlop']; 
          $tmp_pos = strpos($this->tp_idlop, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_idlop))
          {
              $this->tp_idlop = substr($this->tp_idlop, 0, $tmp_pos);
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
          $this->tp_status = $Busca_temp['tp_status']; 
          $tmp_pos = strpos($this->tp_status, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_status))
          {
              $this->tp_status = substr($this->tp_status, 0, $tmp_pos);
          }
          $this->tp_id = $Busca_temp['tp_id']; 
          $tmp_pos = strpos($this->tp_id, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_id))
          {
              $this->tp_id = substr($this->tp_id, 0, $tmp_pos);
          }
          $this->tp_projectname = $Busca_temp['tp_projectname']; 
          $tmp_pos = strpos($this->tp_projectname, "##@@");
          if ($tmp_pos !== false && !is_array($this->tp_projectname))
          {
              $this->tp_projectname = substr($this->tp_projectname, 0, $tmp_pos);
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
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false)
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['project_edit_update_main']['contr_total_geral'] = "OK";
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
function cek_jadwal()
{
$_SESSION['scriptcase']['project_edit_update_main']['contr_erro'] = 'on';
   
$check_button = "SELECT TPC_GENERATETASK,TPC_PROGRESSTASK,TPC_JADWALPROJECT,TPC_ODPNEW
 FROM AKSESSMR.TBL_PROJECT_CONTROL
WHERE TPC_IDPROJECT='$this->tp_id'";
 
      $nm_select = $check_button; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs_button = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->rs_button[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs_button = false;
          $this->rs_button_erro = $this->Db->ErrorMsg();
      } 
;
if (isset($this->rs_button[0][0]))     
{
    $tpc_generatetask  	= $this->rs_button[0][0];
    $tpc_progresstask  	= $this->rs_button[0][1];
	$tpc_jadwalproject  = $this->rs_button[0][2];
	$tpc_odpnew  		= $this->rs_button[0][3];
	
	if ($tpc_odpnew  == 'Y' && $this->tp_jmldistribusi  > 0){
	$this->nmgp_botoes["generate_odp_new"] = "off";;	
	}
	elseif ($tpc_odpnew  == 'N' && $this->tp_jmldistribusi  < 1) {
	$this->nmgp_botoes["generate_odp_new"] = "on";;	
	} else {
	$this->nmgp_botoes["generate_odp_new"] = "on";;	
	}

	if ($tpc_jadwalproject  == 'Y') {
	$this->nmgp_botoes["generatejadwal"] = "off";;
	} else {
	$this->nmgp_botoes["generatejadwal"] = "on";;
	}

} else {
    $tpc_generatetask  	= '';
    $tpc_progresstask  	= '';
	$tpc_jadwalproject  = '';
	$tpc_odpnew  		= '';	
$this->nmgp_botoes["generate_odp_new"] = "on";;
$this->nmgp_botoes["generatejadwal"] = "on";;	
}
$_SESSION['scriptcase']['project_edit_update_main']['contr_erro'] = 'off';
}
}

?>
