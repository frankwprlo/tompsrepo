<?php

class update_ptosentase_project_total
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
      if (isset($_SESSION['sc_session'][$this->sc_page]['update_ptosentase_project']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['update_ptosentase_project']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['update_ptosentase_project']['campos_busca'];
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
   }

   //---- 
   function quebra_geral_sc_free_total($res_limit=false)
   {
      global $nada, $nm_lang ;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['update_ptosentase_project']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['update_ptosentase_project']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['update_ptosentase_project']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['update_ptosentase_project']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['update_ptosentase_project']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['update_ptosentase_project']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['update_ptosentase_project']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['update_ptosentase_project']['contr_total_geral'] = "OK";
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
function ambil_akhir()
{
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'on';
             
$check_sql = "SELECT PPO_TARGETSELESAI
FROM TBL_PROJECT_DETAIL WHERE PPO_TASKTAHAPAN='GR, IR' AND PPO_PROJECTID=$this->tp_id ";
 
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
    $this->akhirdetail  = $this->rs[0][0];
}
		else     
{
		    $this->akhirdetail  = '';
}
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'off';
}
function ambil_awal()
{
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'on';
             
$check_sql = "SELECT PPO_TGLMULAIPLAN
FROM TBL_PROJECT_DETAIL WHERE PPO_TASKTAHAPAN='Kickoff Meeting' AND PPO_PROJECTID=$this->tp_id ";
 
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
    $this->awaldetail  = $this->rs[0][0];
}
		else     
{
		    $this->awaldetail  = '';
}
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'off';
}
function ambil_milestone()
{
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'on';
             
if ($this->maxiddetail  <> 99) {
$check_sql = "SELECT TMT_TARGET62 FROM TB_MASTERTAHAPAN_TASK WHERE TMT_ID=$this->maxiddetail ";
 
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
    $this->milestone  = $this->rs[0][0];
}
		else     
{
		    $this->milestone  = 0;
}
	} else {
	$this->milestone =0;
	}
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'off';
}
function cek_anomali()
{
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'on';
             
if ($this->tp_templateproject  == 2 && $this->tp_targetwaktu  == 30) 
	{
	$this->anomali ='ok';
	} 
elseif ($this->tp_templateproject  == 3 && $this->tp_targetwaktu  == 60) 
	{
	$this->anomali ='ok';
	} 
elseif ($this->tp_templateproject  == 4 && $this->tp_targetwaktu  == 90) 
	{
	$this->anomali ='ok';
	} 
else 
	{
	$this->anomali  = 'cek';
	}

$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'off';
}
function max_iddetail()
{
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'on';
             
$check_sql = "SELECT MAX(PPO_IDTASKTAHAPAN) FROM TBL_PROJECT_DETAIL WHERE PPO_STATUS=3 AND PPO_PROJECTID=$this->tp_id 
ORDER BY PPO_TAHAPANPROJECT ASC,PPO_TASKNUMBER ASC ";
 
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
    $this->maxiddetail  = $this->rs[0][0];
}
		else     
{
		    $this->maxiddetail  = 99;
}
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'off';
}
function update_data()
{
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'on';
             
$check_sql = "SELECT TMT_TAHAPANPROJECT,TMT_TASKTAHAPAN,TMT_TASKNUMBER,TMT_TARGET90,TMT_ID FROM AKSESSMR.TB_MASTERTAHAPAN_TASK
WHERE TMT_TASKTAMPLATE=$this->tp_templateproject 
ORDER BY TMT_TAHAPANPROJECT ASC,TMT_TASKNUMBER ASC
";
 
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
;
}
else
{
   while(!$this->rs->EOF)
    {
		$field_total  += $this->rs->fields[0];
	    $tmt_tahapanproject =$this->rs[0][0];
		$tmt_tasktahapan =$this->rs[0][1];   
		$tmt_tasknumber =$this->rs[0][2];
        $tmt_target90  	= $this->rs[0][3];
	    $tmt_id =$this->rs[0][4];

	   $add_days  = $tmt_target90 ;  
	$add_months = 0;  
	$add_years = 0;   
	$glob_mileage=$this->tp_planstart ;
	$ppo_tglmulaiplan  = $glob_mileage;
	$ppo_targetselesai  = 
         $this->nm_data->CalculaData($ppo_tglmulaiplan , 'yyyy-mm-dd', '+', $add_days, $add_months, $add_years, "aaaa-mm-dd",  'yyyy-mm-dd'); 
      ;
	$glob_mileage = $ppo_targetselesai ;
	$update_table  = 'AKSESSMR.TBL_PROJECT_DETAIL';      
	$update_where  = "PPO_PROJECTID='$this->tp_id' AND PPO_TAHAPANPROJECT='$tmt_tahapanproject' AND 		PPO_TASKNUMBER='$tmt_id'"; 
	$update_fields = array("PPO_TGLMULAIPLAN = '$ppo_tglmulaiplan'",
					   "PPO_TGLMULAIACTUAL = '$ppo_tglmulaiplan'",
					   "PPO_TARGETSELESAI = '$ppo_targetselesai'",
					   "PPO_TGLSELESAIACTUAL = '$ppo_targetselesai'",
					   "PPO_TARGETHARI = '$ppo_targetselesai'"
					  );
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
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      ;	
	   
		$this->rs->MoveNext();
    }
    $this->rs->Close();
}
$_SESSION['scriptcase']['update_ptosentase_project']['contr_erro'] = 'off';
}
}

?>
