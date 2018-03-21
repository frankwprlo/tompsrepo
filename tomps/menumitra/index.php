<?php
include_once('menumitra_session.php');
session_start();
if (!function_exists("sc_check_mobile"))
{
    include_once("../_lib/lib/php/nm_check_mobile.php");
}
$_SESSION['scriptcase']['device_mobile'] = sc_check_mobile();
if ($_SESSION['scriptcase']['device_mobile'])
{
    if (!isset($_SESSION['scriptcase']['display_mobile']))
    {
        $_SESSION['scriptcase']['display_mobile'] = true;
    }
    if ($_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'out' == $_POST['_sc_force_mobile'])
    {
        $_SESSION['scriptcase']['display_mobile'] = false;
    }
    elseif (!$_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'in' == $_POST['_sc_force_mobile'])
    {
        $_SESSION['scriptcase']['display_mobile'] = true;
    }
}
else
{
    $_SESSION['scriptcase']['display_mobile'] = false;
}
    $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'] = "/libdemo/prod";
    $_SESSION['scriptcase']['menumitra']['glo_nm_perfil']    = "conn_mysql_1";
    $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] = "";

ob_start();

class menumitra_class
{
  var $Db;

 function sc_Include($path, $tp, $name)
 {
     if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
     {
         include_once($path);
     }
 } // sc_Include

 function menumitra_menu()
 {
    global $menumitra_menuData, $nm_data_fixa;
     if (isset($_POST["nmgp_idioma"]))  
     { 
         $Temp_lang = explode(";" , $_POST["nmgp_idioma"]);  
         if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
          { 
             $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
         } 
         if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
         { 
             $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
         } 
     } 
   
     if (isset($_POST["nmgp_schema"]))  
     { 
         $_SESSION['scriptcase']['str_schema_all'] = $_POST["nmgp_schema"] . "/" . $_POST["nmgp_schema"];
     } 
   
           $nm_versao_sc  = "" ; 
           $_SESSION['scriptcase']['menumitra']['contr_erro'] = 'off';
           $Campos_Mens_erro = "";
           $sc_site_ssl   = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? true : false;
           $NM_dir_atual = getcwd();
           if (empty($NM_dir_atual))
           {
               $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
               $str_path_sys          = str_replace("\\", '/', $str_path_sys);
           }
           else
           {
               $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
               $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
           }
      //check publication with the prod
      $str_path_apl_url = $_SERVER['PHP_SELF'];
      $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
      $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
      $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
      //check prod
      if(empty($_SESSION['scriptcase']['menumitra']['glo_nm_path_prod']))
      {
              /*check prod*/$_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
      }
$this->sc_charset['UTF-8'] = 'utf-8';
$this->sc_charset['ISO-2022-JP'] = 'iso-2022-jp';
$this->sc_charset['ISO-2022-KR'] = 'iso-2022-kr';
$this->sc_charset['ISO-8859-1'] = 'iso-8859-1';
$this->sc_charset['ISO-8859-2'] = 'iso-8859-2';
$this->sc_charset['ISO-8859-3'] = 'iso-8859-3';
$this->sc_charset['ISO-8859-4'] = 'iso-8859-4';
$this->sc_charset['ISO-8859-5'] = 'iso-8859-5';
$this->sc_charset['ISO-8859-6'] = 'iso-8859-6';
$this->sc_charset['ISO-8859-7'] = 'iso-8859-7';
$this->sc_charset['ISO-8859-8'] = 'iso-8859-8';
$this->sc_charset['ISO-8859-8-I'] = 'iso-8859-8-i';
$this->sc_charset['ISO-8859-9'] = 'iso-8859-9';
$this->sc_charset['ISO-8859-10'] = 'iso-8859-10';
$this->sc_charset['ISO-8859-13'] = 'iso-8859-13';
$this->sc_charset['ISO-8859-14'] = 'iso-8859-14';
$this->sc_charset['ISO-8859-15'] = 'iso-8859-15';
$this->sc_charset['WINDOWS-1250'] = 'windows-1250';
$this->sc_charset['WINDOWS-1251'] = 'windows-1251';
$this->sc_charset['WINDOWS-1252'] = 'windows-1252';
$this->sc_charset['TIS-620'] = 'tis-620';
$this->sc_charset['WINDOWS-1253'] = 'windows-1253';
$this->sc_charset['WINDOWS-1254'] = 'windows-1254';
$this->sc_charset['WINDOWS-1255'] = 'windows-1255';
$this->sc_charset['WINDOWS-1256'] = 'windows-1256';
$this->sc_charset['WINDOWS-1257'] = 'windows-1257';
$this->sc_charset['KOI8-R'] = 'koi8-r';
$this->sc_charset['BIG-5'] = 'big5';
$this->sc_charset['EUC-CN'] = 'EUC-CN';
$this->sc_charset['GB18030'] = 'GB18030';
$this->sc_charset['GB2312'] = 'gb2312';
$this->sc_charset['EUC-JP'] = 'euc-jp';
$this->sc_charset['SJIS'] = 'shift-jis';
$this->sc_charset['EUC-KR'] = 'euc-kr';
$_SESSION['scriptcase']['charset_entities']['UTF-8'] = 'UTF-8';
$_SESSION['scriptcase']['charset_entities']['ISO-8859-1'] = 'ISO-8859-1';
$_SESSION['scriptcase']['charset_entities']['ISO-8859-5'] = 'ISO-8859-5';
$_SESSION['scriptcase']['charset_entities']['ISO-8859-15'] = 'ISO-8859-15';
$_SESSION['scriptcase']['charset_entities']['WINDOWS-1251'] = 'cp1251';
$_SESSION['scriptcase']['charset_entities']['WINDOWS-1252'] = 'cp1252';
$_SESSION['scriptcase']['charset_entities']['BIG-5'] = 'BIG5';
$_SESSION['scriptcase']['charset_entities']['EUC-CN'] = 'GB2312';
$_SESSION['scriptcase']['charset_entities']['GB2312'] = 'GB2312';
$_SESSION['scriptcase']['charset_entities']['SJIS'] = 'Shift_JIS';
$_SESSION['scriptcase']['charset_entities']['EUC-JP'] = 'EUC-JP';
$_SESSION['scriptcase']['charset_entities']['KOI8-R'] = 'KOI8-R';
$str_path_web   = $_SERVER['PHP_SELF'];
$str_path_web   = str_replace("\\", '/', $str_path_web);
$str_path_web   = str_replace('//', '/', $str_path_web);
$str_root       = substr($str_path_sys, 0, -1 * strlen($str_path_web));
$path_link      = substr($str_path_web, 0, strrpos($str_path_web, '/'));
$path_link      = substr($path_link, 0, strrpos($path_link, '/')) . '/';
$path_btn       = $str_root . $path_link . "_lib/buttons/";
$path_imag_cab  = $path_link . "_lib/img";
$this->force_mobile = false;
$this->path_botoes    = '../_lib/img';
$this->path_imag_apl  = $str_root . $path_link . "_lib/img";
$path_help      = $path_link . "_lib/webhelp/";
$path_libs      = $str_root . $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'] . "/lib/php";
$path_third     = $str_root . $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'] . "/third";
$path_adodb     = $str_root . $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'] . "/third/adodb";
$path_apls      = $str_root . substr($path_link, 0, strrpos($path_link, '/'));
$path_img_old   = $str_root . $path_link . "menumitra/img";
$this->path_css = $str_root . $path_link . "_lib/css/";
$this->url_css = "../_lib/css/";
$path_lib_php   = $str_root . $path_link . "_lib/lib/php";
$menu_mobile_hide          = 'N';
$menu_mobile_inicial_state = 'escondido';
$menu_mobile_hide_onclick  = 'S';
$menutree_mobile_float     = 'S';
$menu_mobile_hide_icon     = 'N';
$menu_mobile_hide_icon_menu_position     = 'right';
$mobile_menu_mobile_hide          = 'S';
$mobile_menu_mobile_inicial_state = 'escondido';
$mobile_menu_mobile_hide_onclick  = 'S';
$mobile_menutree_mobile_float     = 'S';
$mobile_menu_mobile_hide_icon     = 'N';
$mobile_menu_mobile_hide_icon_menu_position     = 'right';

$this->sc_Include($path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
 if(function_exists('set_php_timezone')) set_php_timezone('menumitra');
if (isset($_SESSION['scriptcase']['user_logout']))
{
    foreach ($_SESSION['scriptcase']['user_logout'] as $ind => $parms)
    {
        if (isset($_SESSION[$parms['V']]) && $_SESSION[$parms['V']] == $parms['U'])
        {
            unset($_SESSION['scriptcase']['user_logout'][$ind]);
            $nm_apl_dest = $parms['R'];
            $dir = explode("/", $nm_apl_dest);
            if (count($dir) == 1)
            {
                $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
                $nm_apl_dest = $path_link . SC_dir_app_name($nm_apl_dest) . "/";
            }
?>
            <html>
            <body>
            <form name="FRedirect" method="POST" action="<?php echo $nm_apl_dest; ?>" target="<?php echo $parms['T']; ?>">
            </form>
            <script>
             document.FRedirect.submit();
            </script>
            </body>
            </html>
<?php
            exit;
        }
    }
}
if (!defined("SC_ERROR_HANDLER"))
{
    define("SC_ERROR_HANDLER", 1);
    include_once(dirname(__FILE__) . "/menumitra_erro.php");
}
include_once(dirname(__FILE__) . "/menumitra_erro.class.php"); 
$this->Erro = new menumitra_erro();
$str_path = substr($_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'], 0, strrpos($_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'], '/') + 1);
if (!is_file($str_root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
{
    unset($_SESSION['scriptcase']['nm_sc_retorno']);
    unset($_SESSION['scriptcase']['menumitra']['glo_nm_conexao']);
}

/* Path definitions */
$menumitra_menuData         = array();
$menumitra_menuData['path'] = array();
$menumitra_menuData['url']  = array();
$NM_dir_atual = getcwd();
if (empty($NM_dir_atual))
{
    $menumitra_menuData['path']['sys'] = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
    $menumitra_menuData['path']['sys'] = str_replace("\\", '/', $str_path_sys);
    $menumitra_menuData['path']['sys'] = str_replace('//', '/', $str_path_sys);
}
else
{
    $sc_nm_arquivo                                   = explode("/", $_SERVER['PHP_SELF']);
    $menumitra_menuData['path']['sys'] = str_replace("\\", "/", str_replace("\\\\", "\\", getcwd())) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
}
$menumitra_menuData['url']['web']   = $_SERVER['PHP_SELF'];
$menumitra_menuData['url']['web']   = str_replace("\\", '/', $menumitra_menuData['url']['web']);
$menumitra_menuData['path']['root'] = substr($menumitra_menuData['path']['sys'],  0, -1 * strlen($menumitra_menuData['url']['web']));
$menumitra_menuData['path']['app']  = substr($menumitra_menuData['path']['sys'],  0, strrpos($menumitra_menuData['path']['sys'],  '/'));
$menumitra_menuData['path']['link'] = substr($menumitra_menuData['path']['app'],  0, strrpos($menumitra_menuData['path']['app'],  '/'));
$menumitra_menuData['path']['link'] = substr($menumitra_menuData['path']['link'], 0, strrpos($menumitra_menuData['path']['link'], '/')) . '/';
$menumitra_menuData['path']['app'] .= '/';
$menumitra_menuData['url']['app']   = substr($menumitra_menuData['url']['web'],  0, strrpos($menumitra_menuData['url']['web'],  '/'));
$menumitra_menuData['url']['link']  = substr($menumitra_menuData['url']['app'],  0, strrpos($menumitra_menuData['url']['app'],  '/'));
if ($_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] == "S")
{
    $menumitra_menuData['url']['link']  = substr($menumitra_menuData['url']['link'], 0, strrpos($menumitra_menuData['url']['link'], '/'));
}
$menumitra_menuData['url']['link']  .= '/';
$menumitra_menuData['url']['app']   .= '/';

$nm_img_fun_menu = ""; 
if (!isset($_SESSION['scriptcase']['str_lang']) || empty($_SESSION['scriptcase']['str_lang']))
{
    $_SESSION['scriptcase']['str_lang'] = "en_us";
}
if (!isset($_SESSION['scriptcase']['str_conf_reg']) || empty($_SESSION['scriptcase']['str_conf_reg']))
{
    $_SESSION['scriptcase']['str_conf_reg'] = "en_us";
}
$this->str_lang        = $_SESSION['scriptcase']['str_lang'];
$this->str_conf_reg    = $_SESSION['scriptcase']['str_conf_reg'];
if (!function_exists("NM_is_utf8"))
{
   include_once("../_lib/lib/php/nm_utf8.php");
}
if (!function_exists("SC_dir_app_ini"))
{
    include_once("../_lib/lib/php/nm_ctrl_app_name.php");
}
SC_dir_app_ini('projectamo');
if ($_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] == "S")
{
    $path_apls     = substr($path_apls, 0, strrpos($path_apls, '/'));
}
$path_apls     .= "/";
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Meadow/Sc9_Meadow";
include("../_lib/lang/". $this->str_lang .".lang.php");
include("../_lib/css/" . $this->str_schema_all . "_menutab.php");
include("../_lib/css/" . $this->str_schema_all . "_menuH.php");
if(isset($pagina_schemamenu) && !empty($pagina_schemamenu) && is_file("../_lib/menuicons/". $pagina_schemamenu .".php"))
{
    include("../_lib/menuicons/". $pagina_schemamenu .".php");
}
$this->img_sep_toolbar = trim($str_toolbar_separator);
include("../_lib/lang/config_region.php");
include("../_lib/lang/lang_config_region.php");
$this->regionalDefault();
$Str_btn_menu = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
$Str_btn_css  = trim($str_button) . "/" . trim($str_button) . ".css";
$this->css_menutab_active_close_icon    = trim($css_menutab_active_close_icon);
$this->css_menutab_inactive_close_icon  = trim($css_menutab_inactive_close_icon);
$this->breadcrumbline_separator  = trim($breadcrumbline_separator);
include($path_btn . $Str_btn_menu);
if (!function_exists("nmButtonOutput"))
{
   include_once("../_lib/lib/php/nm_gp_config_btn.php");
}
asort($this->Nm_lang_conf_region);
$this->sc_Include($path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
$this->sc_Include($path_lib_php . "/nm_functions.php", "", "") ; 
$this->nm_data = new nm_data("en_us");
include_once("menumitra_toolbar.php");

$this->tab_grupo[0] = "projectamo/";
if ($_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] != "S")
{
    $this->tab_grupo[0] = "";
}

     $_SESSION['scriptcase']['menu_atual'] = "menumitra";
     $_SESSION['scriptcase']['menu_apls']['menumitra'] = array();
     if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
     {
         foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
         {
             if (isset($_SESSION['scriptcase']['menumitra']['glo_nm_conexao']) && $_SESSION['scriptcase']['menumitra']['glo_nm_conexao'] == $NM_con_orig)
             {
/*NM*/           $_SESSION['scriptcase']['menumitra']['glo_nm_conexao'] = $NM_con_dest;
             }
             if (isset($_SESSION['scriptcase']['menumitra']['glo_nm_perfil']) && $_SESSION['scriptcase']['menumitra']['glo_nm_perfil'] == $NM_con_orig)
             {
/*NM*/           $_SESSION['scriptcase']['menumitra']['glo_nm_perfil'] = $NM_con_dest;
             }
             if (isset($_SESSION['scriptcase']['menumitra']['glo_con_' . $NM_con_orig]))
             {
                 $_SESSION['scriptcase']['menumitra']['glo_con_' . $NM_con_orig] = $NM_con_dest;
             }
         }
     }
$_SESSION['scriptcase']['charset'] = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "ISO-8859-1";
ini_set('default_charset', $_SESSION['scriptcase']['charset']);
$_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
foreach ($this->Nm_conf_reg[$this->str_conf_reg] as $ind => $dados)
{
    if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
    {
        $this->Nm_conf_reg[$this->str_conf_reg][$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
    }
}
foreach ($this->Nm_lang as $ind => $dados)
{
    if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
    {
        $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
        $this->Nm_lang[$ind] = $dados;
    }
    if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
    {
        $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
    }
}
if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
{
    $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
}
$_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
$_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
$_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
if (is_dir($path_img_old))
{
    $Res_dir_img = @opendir($path_img_old);
    if ($Res_dir_img)
    {
        while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
        {
           $Str_arquivo = "/" . $Str_arquivo;
           if (@is_file($path_img_old . $Str_arquivo) && '.' != $Str_arquivo && '..' != $path_img_old . $Str_arquivo)
           {
               @unlink($path_img_old . $Str_arquivo);
           }
        }
    }
    @closedir($Res_dir_img);
    rmdir($path_img_old);
}
//
if (isset($_GET) && !empty($_GET))
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
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
if (isset($_POST) && !empty($_POST))
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
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
if (isset($script_case_init))
{
    $_SESSION['sc_session'][1]['menumitra']['init'] = $script_case_init;
}
else
if (!isset($_SESSION['sc_session'][1]['menumitra']['init']))
{
    $_SESSION['sc_session'][1]['menumitra']['init'] = "";
}
$script_case_init = $_SESSION['sc_session'][1]['menumitra']['init'];
if (isset($nmgp_parms) && !empty($nmgp_parms)) 
{ 
    $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
    $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
    $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
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
       $Tmp_par   = $cadapar[0];;
       $$Tmp_par = $cadapar[1];
       $_SESSION[$cadapar[0]] = $cadapar[1];
       $ix++;
     }
} 
if (isset($_SESSION['sc_session']['SC_parm_violation']))
{
    unset($_SESSION['sc_session']['SC_parm_violation']);
    echo "<html>";
    echo "<body>";
    echo "<table align=\"center\" width=\"50%\" border=1 height=\"50px\">";
    echo "<tr>";
    echo "   <td align=\"center\">";
    echo "       <b><font size=4>" . $this->Nm_lang['lang_errm_ajax_data'] . "</font>";
    echo "   </b></td>";
    echo " </tr>";
    echo "</table>";
    echo "</body>";
    echo "</html>";
    exit;
}
$nm_url_saida = "";
if (isset($nmgp_url_saida))
{
    $nm_url_saida = $nmgp_url_saida;
    if (isset($script_case_init))
    {
        $nm_url_saida .= "?script_case_init=" . NM_encode_input($script_case_init) . "&script_case_session=" . session_id();
    }
}
if (isset($_POST["nmgp_idioma"]) || isset($_POST["nmgp_schema"]))  
{ 
    $nm_url_saida = $_SESSION['scriptcase']['sc_saida_menumitra'];
}
elseif (!empty($nm_url_saida))
{
    $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]  = $nm_url_saida;
    $_SESSION['scriptcase']['sc_saida_menumitra'] = $nm_url_saida;
}
else
{
    $_SESSION['scriptcase']['sc_saida_menumitra'] = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "javascript:window.close()";
}
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Meadow/Sc9_Meadow";
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['menumitra'] = "on";
} 
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['menumitra']) || $_SESSION['scriptcase']['sc_apl_seg']['menumitra'] != "on")
{ 
    $NM_Mens_Erro = $this->Nm_lang['lang_errm_unth_user'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

    <HTML>
     <HEAD>
      <TITLE></TITLE>
     <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
      <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>      <META http-equiv="Pragma" content="no-cache"/>
      <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $str_schema_all ?>_menuH.css" /> 
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $str_schema_all ?>_menuH<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_grid.css" /> 
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
     </HEAD>
     <body>
       <table align="center" class="scGridBorder"><tr><td style="padding: 0">
       <table style="width: 100%" class="scGridTabela"><tr class="scGridFieldOdd"><td class="scGridFieldOddFont" style="padding: 15px 30px; text-align: center">
        <?php echo $NM_Mens_Erro; ?>
        <br />
        <form name="Fseg" method="post" target="_self">
         <input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($script_case_init) ?>"/> 
         <input type=hidden name="script_case_session" value="<?php echo NM_encode_input(session_id()) ?>"> 
         <input type="button" name="sc_sai_seg" value="OK" onclick="nm_saida()"> 
        </form> 
       </td></tr></table>
       </td></tr></table>
<?php
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']))
              {
?>
<br /><br /><br />
<table align="center" class="scGridBorder" style="width: 450px"><tr><td style="padding: 0">
 <table style="width: 100%" class="scGridTabela">
  <tr class="scGridFieldOdd">
   <td class="scGridFieldOddFont" style="padding: 15px 30px">
    <?php echo $this->Nm_lang['lang_errm_unth_hwto']; ?>
   </td>
  </tr>
 </table>
</td></tr></table>
<?php
              }
?>
     </body>
     <?php
     if ((isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true') || (isset($_SESSION['scriptcase']['sc_outra_jan']) && ($_SESSION['scriptcase']['sc_outra_jan'] == 'menutree' || $_SESSION['scriptcase']['sc_outra_jan'] == 'menu')))
     {
       $saida_final = 'window.close();';
     }
     else
     {
       $saida_final = 'history.back();';
     }
     ?>
    <script type="text/javascript">
      function nm_saida()
      {
<?php 
             echo $saida_final;
?> 
      }
     </script> 
<?php
    exit;
} 
$this->sc_Include($path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
include_once($path_adodb . "/adodb.inc.php"); 
$this->sc_Include($path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
 if(function_exists('set_php_timezone')) set_php_timezone('menumitra'); 
perfil_lib($path_libs);
if (!isset($_SESSION['sc_session'][1]['SC_Check_Perfil']))
{
    if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($path_libs, $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod']);
    $_SESSION['sc_session'][1]['SC_Check_Perfil'] = true;
}
$nm_falta_var    = ""; 
$nm_falta_var_db = ""; 
if (isset($_SESSION['scriptcase']['menumitra']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['menumitra']['glo_nm_conexao']))
{
    db_conect_devel($_SESSION['scriptcase']['menumitra']['glo_nm_conexao'], $str_root . $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'], 'projectamo', 2); 
}
if (isset($_SESSION['scriptcase']['menumitra']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['menumitra']['glo_nm_perfil']))
{
   $_SESSION['scriptcase']['glo_perfil'] = $_SESSION['scriptcase']['menumitra']['glo_nm_perfil'];
}
if (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
{
    $_SESSION['scriptcase']['glo_senha_protect'] = "";
    carrega_perfil($_SESSION['scriptcase']['glo_perfil'], $path_libs, "");
    if (empty($_SESSION['scriptcase']['glo_senha_protect']))
    {
        $nm_falta_var .= "Perfil=" . $_SESSION['scriptcase']['glo_perfil'] . "; ";
    }
}
if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
{
    $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
    if (strlen($SC_temp) == 2)
    {
       $_SESSION['scriptcase']['menumitra']['SC_sep_date']  = substr($SC_temp, 0, 1); 
       $_SESSION['scriptcase']['menumitra']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
   }
   else
    {
       $_SESSION['scriptcase']['menumitra']['SC_sep_date']  = $SC_temp; 
       $_SESSION['scriptcase']['menumitra']['SC_sep_date1'] = $SC_temp; 
   }
}
if (!isset($_SESSION['scriptcase']['glo_tpbanco']))
{
    $nm_falta_var_db .= "glo_tpbanco; ";
}
else
{
    $nm_tpbanco = $_SESSION['scriptcase']['glo_tpbanco']; 
}
if (!isset($_SESSION['scriptcase']['glo_servidor']))
{
    $nm_falta_var_db .= "glo_servidor; ";
}
else
{
    $nm_servidor = $_SESSION['scriptcase']['glo_servidor']; 
}
if (!isset($_SESSION['scriptcase']['glo_banco']))
{
    $nm_falta_var_db .= "glo_banco; ";
}
else
{
    $nm_banco = $_SESSION['scriptcase']['glo_banco']; 
}
if (!isset($_SESSION['scriptcase']['glo_usuario']))
{
    $nm_falta_var_db .= "glo_usuario; ";
}
else
{
    $nm_usuario = $_SESSION['scriptcase']['glo_usuario']; 
}
if (!isset($_SESSION['scriptcase']['glo_senha']))
{
    $nm_falta_var_db .= "glo_senha; ";
}
else
{
    $nm_senha = $_SESSION['scriptcase']['glo_senha']; 
}
$nm_con_db2 = array();
$nm_database_encoding = "";
if (isset($_SESSION['scriptcase']['glo_database_encoding']))
{
    $nm_database_encoding = $_SESSION['scriptcase']['glo_database_encoding']; 
}
$nm_arr_db_extra_args = array();
if (isset($_SESSION['scriptcase']['glo_use_ssl']))
{
    $nm_arr_db_extra_args['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
{
    $nm_arr_db_extra_args['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
{
    $nm_arr_db_extra_args['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
{
    $nm_arr_db_extra_args['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
{
    $nm_arr_db_extra_args['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
}
if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
{
    $nm_arr_db_extra_args['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_autocommit']))
{
    $nm_con_db2['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']))
{
    $nm_con_db2['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']))
{
    $nm_con_db2['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']))
{
    $nm_con_db2['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
}
if (isset($_SESSION['scriptcase']['glo_db2_i5_query_optimize']))
{
    $nm_con_db2['db2_i5_query_optimize'] = $_SESSION['scriptcase']['glo_db2_i5_query_optimize']; 
}
$nm_con_persistente = "";
$nm_con_use_schema  = "";
if (isset($_SESSION['scriptcase']['glo_use_persistent']))
{
    $nm_con_persistente = $_SESSION['scriptcase']['glo_use_persistent']; 
}
if (isset($_SESSION['scriptcase']['glo_use_schema']))
{
    $nm_con_use_schema = $_SESSION['scriptcase']['glo_use_schema']; 
}
if (!empty($nm_falta_var) || !empty($nm_falta_var_db))
{
    if (empty($nm_falta_var_db))
    {
        echo "<table width=\"80%\"  border=\"1\" height=\"117\">";
        echo "<tr>";
        echo "   <td class=\"css_menu_sel\">";
        echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_glob'] . "</font>";
        echo "  " . $nm_falta_var;
        echo "   </b></td>";
        echo " </tr>";
        echo "</table>";
    }
    else
    {
        echo "<table width=\"80%\"  border=\"1\" height=\"117\">";
        echo "<tr>";
        echo "   <td class=\"css_menu_sel\">";
        echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_dbcn_data'] . "</font>";
        echo "   </b></td>";
        echo " </tr>";
        echo "</table>";
    }
    if (isset($_SESSION['scriptcase']['nm_ret_exec']) && '' != $_SESSION['scriptcase']['nm_ret_exec'])
    { 
        if (isset($_SESSION['sc_session'][1]['menumitra']['sc_outra_jan']) && $_SESSION['sc_session'][1]['menumitra']['sc_outra_jan'])
        {
            echo "<a href='javascript:window.close()'><img border='0' src='" . $path_imag_cab . "/scriptcase__NM__exit.gif' title='" . $this->Nm_lang['lang_btns_menu_rtrn_hint'] . "' align=absmiddle></a> \n" ; 
        } 
        else 
        { 
            echo "<a href='" . $_SESSION['scriptcase']['nm_ret_exec'] . "><img border='0' src='" . $path_imag_cab . "/scriptcase__NM__exit.gif' title='" . $this->Nm_lang['lang_btns_menu_rtrn_hint'] . "' align=absmiddle></a> \n" ; 
        } 
    } 
    exit ;
} 
if (isset($_SESSION['scriptcase']['glo_db_master_usr']) && !empty($_SESSION['scriptcase']['glo_db_master_usr']))
{
    $nm_usuario = $_SESSION['scriptcase']['glo_db_master_usr']; 
}
if (isset($_SESSION['scriptcase']['glo_db_master_pass']) && !empty($_SESSION['scriptcase']['glo_db_master_pass']))
{
    $nm_senha = $_SESSION['scriptcase']['glo_db_master_pass']; 
}
if (isset($_SESSION['scriptcase']['glo_db_master_cript']) && !empty($_SESSION['scriptcase']['glo_db_master_cript']))
{
    $_SESSION['scriptcase']['glo_senha_protect'] = $_SESSION['scriptcase']['glo_db_master_cript']; 
}
$sc_tem_trans_banco = false;
$this->nm_bases_access    = array("access", "ado_access");
$this->nm_bases_db2       = array("db2", "db2_odbc", "odbc_db2", "odbc_db2v6");
$this->nm_bases_ibase     = array("ibase", "firebird", "borland_ibase");
$this->nm_bases_informix  = array("informix", "informix72", "pdo_informix");
$this->nm_bases_mssql     = array("mssql", "ado_mssql", "odbc_mssql", "mssqlnative", "pdo_sqlsrv", "pdo_dblib");
$this->nm_bases_mysql     = array("mysql", "mysqlt", "mysqli", "maxsql", "pdo_mysql");
$this->nm_bases_postgres  = array("postgres", "postgres64", "postgres7", "pdo_pgsql");
$this->nm_bases_oracle    = array("oci8", "oci805", "oci8po", "odbc_oracle", "oracle");
$this->nm_bases_sqlite    = array("sqlite", "sqlite3", "pdosqlite");
$this->nm_bases_sybase    = array("sybase", "pdo_sybase_odbc");
$this->nm_bases_vfp       = array("vfp");
$this->nm_bases_odbc      = array("odbc", "progress");
$_SESSION['scriptcase']['sc_num_page'] = 1;
$_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1DcXGH9FUDSN7D5JeDMvsVcB/DurGVoFGHQNmH9BqDSNOHQFUDENOHENiH5F/ZuBOHQXGDQX7HAN7HuFaHuNOZSrCH5FqDoXGHQJmZ1BiHABYHuBOHgBYVkJqHEXCHMFGDcXGZ9XGHABYHQFaDMrwVcB/DWXCHMFaDcFYVIJsHAN7HQNUHgvCHArCHEXCDoJsHQFYH9BiHArYHuJwDMrwV9BUDuX7HMJsHQNwH9BqHIrwHuBODMrYZSXeDuFYVoXGDcJeZ9rqD1BeHuX7DMvsZSNiDWBmVErqHQBiZ1BOHABYHQFGHgvCHEJqDWFqHMB/DcXGZSFUD1vOV5BqDMrwVcB/DWXCHMraHQBqZ1FGDSBeHuXGHgvCHArCH5FGDoXGHQJKDuBqHIrwHuraHgNKDkBODuFqDoFGDcBqVIJwD1rwHQrqHgBYVkJ3H5BmDoXGHQXsZSBiZ1N7HQNUDMrwV9BUDWF/HMJwHQNmZSBOD1rwHuFUHgvCHEJqH5F/HMB/HQJKZ9XGHAN7HuraDMrwVcB/H5XKVEraDcFYH9BqHINKZMFaDMrYZSXeDuFYVoXGDcJeZ9rqD1BeV5BqHgvsDkB/V5X7VorqDcBqZ1FaD1rKV5XGDMNKZSJ3H5X/ZuJsHQXGZSFUHAveV5BOHuNODkBODuX7VoX7DcBqZ1B/Z1vOD5raHgBOVkXeHEFqVoX7DcBwDQFGD1BOV5JwDMBYVIBODWFYVENUHQBiZ1B/HABYV5JsDMzGHAFKV5FaZuBOHQJeDuBOZ1rwVWXGHuBYDkFCDuX7VoX7D9BsH9B/Z1BeZMB/HgvCZSJGH5FYDoF7D9NwH9X7DSBYV5JeHuBYVcFKH5FqVoB/D9XOH9B/D1zGD5FaDMrYZSXeDuFYVoXGDcJeZ9rqD1BeV5BqHgvsDkB/V5X7DoX7D9BsH9FaD1rwZMB/DMNKZSJ3H5FGZuFaHQBiDuBqD1NKV5JeDMvOZSNiHEX/VErqDcNwVIJsHIBOZMBqHgveHErsDWBmDoJeHQXOZSBiHAveD5NUHgNKDkBOV5FYHMBiHQNmZ1BiDSvOZMBODEBOHEXeDuFYHMB/HQXODQJsZ1rwD5NUHuvmV9FeHEF/HMFUHQBiZSBqHIBOD5XGHgBOHErCDWF/VoBiDcJUZSX7Z1BYHuFaDMrwDkBOV5FYDoraD9BsZSFaHArYV5X7DEBeHEJGH5F/DoJeDcJeDuBOZ1N7V5JeHuvmVcrsDWXCHMBiD9BsVIraD1rwV5X7HgBeHENiH5FGDoBqHQBiDuBqHArYHuJwDMvOV9BUDWXKVoF7HQBiZ1BiHAzGD5BOHgNKHErCDWXCHMXGHQBiZSFUHANOHuFaHuNOZSrCH5FqDoXGHQJmZ1FGHIBeZMFaHgBOHArCHEXCHIB/D9JKDQFaZ1vCV5XGHgrwVIFCHEFYVENUD9XGZ1FaDSrYHQJwDEBODkFeH5FYVoFGHQJKDQJsHABYV5JeHgrYDkBODWJeVoX7D9BsH9B/Z1NOZMJwDMzGHArCDWF/VoBiDcJUZSX7Z1BYHuFaDMvOZSNiDWB3VoF7HQBqZ1BiHAvsD5JeHgveHErsDuJeHIJsD9XsZ9JeD1BeD5F7DMvmVcBUDuX7VoJwHQBiH9B/Z1BeHuJsHgBOHEFiHEB3ZuBqHQNwDQFaHIrwHuFaHuNOZSrCH5FqDoXGHQJmZ1FGHANOD5XGDMBYHEXeV5XCDoXGD9JKDQFGD1BeD5B/HuBYVcFCH5FqHMBiD9BsVIraD1rwV5X7HgBeHErsHEB7VoBiHQBiDQNUZ1rKVWFU";
 $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['menumitra']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['menumitra']['glo_nm_conexao']))
{ 
   $this->Db = db_conect_devel($_SESSION['scriptcase']['menumitra']['glo_nm_conexao'], $str_root . $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'], 'projectamo'); 
} 
else 
{ 
   $this->Db = db_conect($nm_tpbanco, $nm_servidor, $nm_usuario, $nm_senha, $nm_banco, $glo_senha_protect, "S", $nm_con_persistente, $nm_con_db2, $nm_database_encoding, $nm_arr_db_extra_args); 
} 
$this->nm_tpbanco = $nm_tpbanco; 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_ibase) && function_exists('ibase_timefmt'))
{
    ibase_timefmt('%Y-%m-%d %H:%M:%S');
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_sybase))
{
   $this->Db->fetchMode = ADODB_FETCH_BOTH;
   $this->Db->Execute("set dateformat ymd");
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_mssql))
{
   $this->Db->Execute("set dateformat ymd");
} 
if (in_array(strtolower($nm_tpbanco), $this->nm_bases_oracle))
{
   $this->Db->Execute("alter session set nls_date_format         = 'yyyy-mm-dd hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_timestamp_format    = 'yyyy-mm-dd hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_timestamp_tz_format = 'yyyy-mm-dd hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_time_format         = 'hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_time_tz_format      = 'hh24:mi:ss'");
   $this->Db->Execute("alter session set nls_numeric_characters  = '.,'");
   $_SESSION['sc_session'][$this->Ini->sc_page]['menumitra']['decimal_db'] = ".";
} 
//
/* Dados do menu em sessao */
$_SESSION['nm_menu'] = array('prod' => $str_root . $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'] . '/third/COOLjsMenu/',
                              'url' => $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod'] . '/third/COOLjsMenu/');

if ((isset($nmgp_outra_jan) && $nmgp_outra_jan == "true") || (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'menumitra'))
{
    $_SESSION['sc_session'][1]['menumitra']['sc_outra_jan'] = true;
     unset($_SESSION['scriptcase']['sc_outra_jan']);
    $_SESSION['scriptcase']['sc_saida_menumitra'] = "javascript:window.close()";
}
/* Menu configuration variables */
$menumitra_menuData['iframe'] = TRUE;

if (!isset($_SESSION['scriptcase']['sc_apl_seg']))
{
    $_SESSION['scriptcase']['sc_apl_seg'] = array();
}
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("v_table_project_copy_for_report_mitra") . "/v_table_project_copy_for_report_mitra_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra'] = "on";
} 
if (is_file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("v_table_project_copy_for_report_mitra") . "/v_table_project_copy_for_report_mitra_ini.txt"))
{
    $sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("v_table_project_copy_for_report_mitra") . "/v_table_project_copy_for_report_mitra_ini.txt");
    if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("list_project_inwitel") . "/list_project_inwitel_ini.txt"))
{
    $sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("list_project_inwitel") . "/list_project_inwitel_ini.txt");
    if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['list_project_inwitel']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['list_project_inwitel'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['list_project_inwitel'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("v_table_project_copy_mitra") . "/v_table_project_copy_mitra_ini.txt"))
{
    $sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("v_table_project_copy_mitra") . "/v_table_project_copy_mitra_ini.txt");
    if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_mitra']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_mitra'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_mitra'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("v_table_project_copy_for_report_mitra") . "/v_table_project_copy_for_report_mitra_ini.txt"))
{
    $sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("v_table_project_copy_for_report_mitra") . "/v_table_project_copy_for_report_mitra_ini.txt");
    if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("report_mitra_other") . "/report_mitra_other_ini.txt"))
{
    $sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("report_mitra_other") . "/report_mitra_other_ini.txt");
    if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['report_mitra_other']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['report_mitra_other'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['report_mitra_other'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("report_realisasiproject_mitra") . "/report_realisasiproject_mitra_ini.txt"))
{
    $sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("report_realisasiproject_mitra") . "/report_realisasiproject_mitra_ini.txt");
    if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['report_realisasiproject_mitra']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['report_realisasiproject_mitra'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['report_realisasiproject_mitra'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("app_change_pswd") . "/app_change_pswd_ini.txt"))
{
    $sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("app_change_pswd") . "/app_change_pswd_ini.txt");
    if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd'] = "on";
    } 
}
if (is_file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("app_Login") . "/app_Login_ini.txt"))
{
    $sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("app_Login") . "/app_Login_ini.txt");
    if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
    {
        if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_Login']))
        {
            $_SESSION['scriptcase']['sc_apl_seg']['app_Login'] = "on";
        }
    }
    if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
    { 
        $_SESSION['scriptcase']['sc_apl_seg']['app_Login'] = "on";
    } 
}
/* Menu items */

$sOutputBuffer = ob_get_contents();
ob_end_clean();

 $nm_var_lab[0] = "Home";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[0]))
{
    $nm_var_lab[0] = sc_convert_encoding($nm_var_lab[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[1] = "List Project";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[1]))
{
    $nm_var_lab[1] = sc_convert_encoding($nm_var_lab[1], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[2] = "Edit/Update Project Mitra";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[2]))
{
    $nm_var_lab[2] = sc_convert_encoding($nm_var_lab[2], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[3] = "Resume Project All Mitra";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[3]))
{
    $nm_var_lab[3] = sc_convert_encoding($nm_var_lab[3], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[4] = "Report Other";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[4]))
{
    $nm_var_lab[4] = sc_convert_encoding($nm_var_lab[4], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[5] = "Realisasi Project Mitra";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[5]))
{
    $nm_var_lab[5] = sc_convert_encoding($nm_var_lab[5], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[6] = "Logout";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[6]))
{
    $nm_var_lab[6] = sc_convert_encoding($nm_var_lab[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[0] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[0]))
{
    $nm_var_hint[0] = sc_convert_encoding($nm_var_hint[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[1] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[1]))
{
    $nm_var_hint[1] = sc_convert_encoding($nm_var_hint[1], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[2] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[2]))
{
    $nm_var_hint[2] = sc_convert_encoding($nm_var_hint[2], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[3] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[3]))
{
    $nm_var_hint[3] = sc_convert_encoding($nm_var_hint[3], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[4] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[4]))
{
    $nm_var_hint[4] = sc_convert_encoding($nm_var_hint[4], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[5] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[5]))
{
    $nm_var_hint[5] = sc_convert_encoding($nm_var_hint[5], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[6] = "Klik untuk kelaur dari aplikasi .";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[6]))
{
    $nm_var_hint[6] = sc_convert_encoding($nm_var_hint[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
$saida_apl = $_SESSION['scriptcase']['sc_saida_menumitra'];
if (isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']) == "on")
{
    $menumitra_menuData['data'] .= "item_7|.|" . $nm_var_lab[0] . "|menumitra_form_php.php?sc_item_menu=item_7&sc_apl_menu=v_table_project_copy_for_report_mitra&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[0] . "|scriptcase__NM__ico__NM__sc_menu_home3_e.png|" . $this->menumitra_target('_self') . "|" . "\n";
}

if (isset($_SESSION['scriptcase']['sc_apl_seg']['list_project_inwitel']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['list_project_inwitel']) == "on")
{
    $menumitra_menuData['data'] .= "item_30|.|" . $nm_var_lab[1] . "|menumitra_form_php.php?sc_item_menu=item_30&sc_apl_menu=list_project_inwitel&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[1] . "||" . $this->menumitra_target('_self') . "|" . "\n";
}

if (isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_mitra']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_mitra']) == "on")
{
    $menumitra_menuData['data'] .= "item_28|.|" . $nm_var_lab[2] . "|menumitra_form_php.php?sc_item_menu=item_28&sc_apl_menu=v_table_project_copy_mitra&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[2] . "|scriptcase__NM__ico__NM__sc_menu_form_e.png|" . $this->menumitra_target('_self') . "|" . "\n";
}

if (isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']) == "on")
{
    $menumitra_menuData['data'] .= "item_15|.|" . $nm_var_lab[3] . "|menumitra_form_php.php?sc_item_menu=item_15&sc_apl_menu=v_table_project_copy_for_report_mitra&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[3] . "||" . $this->menumitra_target('_self') . "|" . "\n";
}

if (isset($_SESSION['scriptcase']['sc_apl_seg']['report_mitra_other']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['report_mitra_other']) == "on")
{
    $menumitra_menuData['data'] .= "item_29|.|" . $nm_var_lab[4] . "|menumitra_form_php.php?sc_item_menu=item_29&sc_apl_menu=report_mitra_other&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[4] . "||" . $this->menumitra_target('_self') . "|" . "\n";
}

if (isset($_SESSION['scriptcase']['sc_apl_seg']['report_realisasiproject_mitra']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['report_realisasiproject_mitra']) == "on")
{
    $menumitra_menuData['data'] .= "item_16|.|" . $nm_var_lab[5] . "|menumitra_form_php.php?sc_item_menu=item_16&sc_apl_menu=report_realisasiproject_mitra&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[5] . "||" . $this->menumitra_target('_self') . "|" . "\n";
}

if (isset($_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd']) == "on")
{
    $menumitra_menuData['data'] .= "item_26|.|" . $this->Nm_lang['lang_change_pswd'] . "|menumitra_form_php.php?sc_item_menu=item_26&sc_apl_menu=app_change_pswd&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "|" . $this->Nm_lang['lang_change_pswd'] . "||" . $this->menumitra_target('_self') . "|" . "\n";
}

if (isset($_SESSION['scriptcase']['sc_apl_seg']['app_Login']) && strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_Login']) == "on")
{
    $menumitra_menuData['data'] .= "item_32|.|" . $nm_var_lab[6] . "|menumitra_form_php.php?sc_item_menu=item_32&sc_apl_menu=app_Login&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "|" . $nm_var_hint[6] . "||" . $this->menumitra_target('_parent') . "|" . "\n";
}


$menumitra_menuData['data'] = array();
$str_disabled = "N";
$str_link = "menumitra_form_php.php?sc_item_menu=item_7&sc_apl_menu=v_table_project_copy_for_report_mitra&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "scriptcase__NM__ico__NM__sc_menu_home3_e.png";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($str_icon) && isset($arr_menuicons['cons']['active']))
    {
        $str_icon = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menumitra_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[0] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[0] . "",
        'id'       => "item_7",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menumitra_target('_self') . "\"",
        'sc_id'    => "item_7",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menumitra_form_php.php?sc_item_menu=item_30&sc_apl_menu=list_project_inwitel&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['list_project_inwitel']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['list_project_inwitel']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($str_icon) && isset($arr_menuicons['cons']['active']))
    {
        $str_icon = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menumitra_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[1] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[1] . "",
        'id'       => "item_30",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menumitra_target('_self') . "\"",
        'sc_id'    => "item_30",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menumitra_form_php.php?sc_item_menu=item_28&sc_apl_menu=v_table_project_copy_mitra&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_mitra']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_mitra']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "scriptcase__NM__ico__NM__sc_menu_form_e.png";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($str_icon) && isset($arr_menuicons['cons']['active']))
    {
        $str_icon = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menumitra_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[2] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[2] . "",
        'id'       => "item_28",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menumitra_target('_self') . "\"",
        'sc_id'    => "item_28",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menumitra_form_php.php?sc_item_menu=item_15&sc_apl_menu=v_table_project_copy_for_report_mitra&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($str_icon) && isset($arr_menuicons['cons']['active']))
    {
        $str_icon = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menumitra_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[3] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[3] . "",
        'id'       => "item_15",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menumitra_target('_self') . "\"",
        'sc_id'    => "item_15",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menumitra_form_php.php?sc_item_menu=item_29&sc_apl_menu=report_mitra_other&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['report_mitra_other']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['report_mitra_other']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($str_icon) && isset($arr_menuicons['cons']['active']))
    {
        $str_icon = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menumitra_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[4] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[4] . "",
        'id'       => "item_29",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menumitra_target('_self') . "\"",
        'sc_id'    => "item_29",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menumitra_form_php.php?sc_item_menu=item_16&sc_apl_menu=report_realisasiproject_mitra&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['report_realisasiproject_mitra']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['report_realisasiproject_mitra']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($str_icon) && isset($arr_menuicons['cons']['active']))
    {
        $str_icon = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menumitra_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[5] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[5] . "",
        'id'       => "item_16",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menumitra_target('_self') . "\"",
        'sc_id'    => "item_16",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menumitra_form_php.php?sc_item_menu=item_26&sc_apl_menu=app_change_pswd&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_change_pswd']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($str_icon) && isset($arr_menuicons['contr']['active']))
    {
        $str_icon = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $menumitra_menuData['data'][] = array(
        'label'    => "" . $this->Nm_lang['lang_change_pswd'] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $this->Nm_lang['lang_change_pswd'] . "",
        'id'       => "item_26",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menumitra_target('_self') . "\"",
        'sc_id'    => "item_26",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menumitra_form_php.php?sc_item_menu=item_32&sc_apl_menu=app_Login&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['app_Login']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['app_Login']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($str_icon) && isset($arr_menuicons['contr']['active']))
    {
        $str_icon = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba) && isset($arr_menuicons['contr']['active']))
    {
        $icon_aba = $arr_menuicons['contr']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['contr']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['contr']['inactive'];
    }
    $menumitra_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[6] . "",
        'level'    => "0",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[6] . "",
        'id'       => "item_32",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " item-target=\"" . $this->menumitra_target('_parent') . "\"",
        'sc_id'    => "item_32",
        'disabled' => $str_disabled,
    );

if (isset($_SESSION['scriptcase']['sc_def_menu']['menumitra']))
{
    $arr_menu_usu = $this->nm_arr_menu_recursiv($_SESSION['scriptcase']['sc_def_menu']['menumitra']);
    $this->nm_gera_menus($str_menu_usu, $arr_menu_usu, 1, 'menumitra');
    $menumitra_menuData['data'] = $str_menu_usu;
}
if (is_file("menumitra_help.txt"))
{
    $Arq_WebHelp = file("menumitra_help.txt"); 
    if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
    {
        $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
        $Tmp = explode(";", $Arq_WebHelp[0]); 
        foreach ($Tmp as $Cada_help)
        {
            $Tmp1 = explode(":", $Cada_help); 
            if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "menu" && is_file($str_root . $path_help . $Tmp1[1]))
            {
                $str_disabled = "N";
                $str_link = "" . $path_help . $Tmp1[1] . "";
                $str_icon = "";
                $icon_aba = "";
                $icon_aba_inactive = "";
                if(empty($str_icon) && isset($arr_menuicons['']['active']))
                {
                    $str_icon = $arr_menuicons['']['active'];
                }
                if(empty($icon_aba) && isset($arr_menuicons['']['active']))
                {
                    $icon_aba = $arr_menuicons['']['active'];
                }
                if(empty($icon_aba_inactive) && isset($arr_menuicons['']['inactive']))
                {
                    $icon_aba_inactive = $arr_menuicons['']['inactive'];
                }
                $menumitra_menuData['data'][] = array(
                    'label'    => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'level'    => "0",
                    'link'     => $str_link,
                    'hint'     => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'id'       => "item_Help",
                    'icon'     => $str_icon,
                    'icon_aba' => $icon_aba,
                    'icon_aba_inactive' => $icon_aba_inactive,
                    'target'   => "" . $this->menumitra_target('_blank') . "",
                    'sc_id'    => "item_Help",
                    'disabled' => $str_disabled,
                );
            }
        }
    }
}

if (isset($_SESSION['scriptcase']['sc_menu_del']['menumitra']) && !empty($_SESSION['scriptcase']['sc_menu_del']['menumitra']))
{
    $nivel = 0;
    $exclui_menu = false;
    foreach ($menumitra_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_del']['menumitra']))
       {
          $nivel = $cada_menu['level'];
          $exclui_menu = true;
          unset($menumitra_menuData['data'][$i_menu]);
       }
       elseif ( empty($cada_menu) || ($exclui_menu && $nivel < $cada_menu['level']))
       {
          unset($menumitra_menuData['data'][$i_menu]);
       }
       else
       {
          $exclui_menu = false;
       }
    }
    $Temp_menu = array();
    foreach ($menumitra_menuData['data'] as $i_menu => $cada_menu)
    {
        $Temp_menu[] = $cada_menu;
    }
    $menumitra_menuData['data'] = $Temp_menu;
}

if (isset($_SESSION['scriptcase']['sc_menu_disable']['menumitra']) && !empty($_SESSION['scriptcase']['sc_menu_disable']['menumitra']))
{
    $disable_menu = false;
    foreach ($menumitra_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_disable']['menumitra']))
       {
          $nivel = $cada_menu['level'];
          $disable_menu = true;
          $menumitra_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu) && $disable_menu && $nivel < $cada_menu['level'])
       { 
          $menumitra_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu))
       {
          $disable_menu = false;
       }
    }
}

$level_to_delete = false;
foreach ($menumitra_menuData['data'] as $chave => $cada_menu)
{
        if($level_to_delete !== false && $menumitra_menuData['data'][$chave]['level'] > $level_to_delete)
        {
                unset($menumitra_menuData['data'][$chave]);
        }
        else
        {
                $level_to_delete = false;
                
                if ($menumitra_menuData['data'][$chave]['disabled'] == 'Y')
                {
                        $level_to_delete = $menumitra_menuData['data'][$chave]['level'];
                        unset($menumitra_menuData['data'][$chave]);
                }
        }
}
$menumitra_menuData['data'] = array_values($menumitra_menuData['data']);
$flag = 1;
while ($flag == 1)
{
    $flag = 0;
    foreach ($menumitra_menuData['data'] as $chave => $cada_menu)
    {
        if (!empty($cada_menu))
        {
            if (isset($menumitra_menuData['data'][$chave + 1]) && !empty($menumitra_menuData['data'][$chave + 1]))
            {
                if ($menumitra_menuData['data'][$chave]['link'] == "#")
                {
                    if ($menumitra_menuData['data'][$chave]['level'] >= $menumitra_menuData['data'][$chave + 1]['level'] )
                    {
                        unset($menumitra_menuData['data'][$chave]);
                        $flag = 1;
                    }
                }
            }
            elseif ($menumitra_menuData['data'][$chave]['link'] == "#")
            {
                unset($menumitra_menuData['data'][$chave]);
            }
        }
    }
    $menumitra_menuData['data'] = array_values($menumitra_menuData['data']);
}

if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
    $_SESSION['scriptcase']['menu_mobile'] = "menumitra";
    include('menumitra_mobile.php');
    exit;
}
/* HTML header */
if ($menumitra_menuData['iframe'])
{
    $menumitra_menuData['height'] = '100%';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?> style="height: 100%; overflow-y: scroll">
<head>
 <title>Telco Management Project System</title>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <?php
 if ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
 {
  ?>
   <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' />
  <?php
 }
 ?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_btngrp.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_btngrp.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_btngrp.css'); } ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menutab.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menutab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuH<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuH.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_menuH.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_menuH.css'); } ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $Str_btn_css ?>" /> 
<link rel="stylesheet" type="text/css" href="../_lib/css/_menuTheme/sys_Mac_Obra_hor_<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir']; ?>.css<?php if (@is_file($this->path_css . '_menuTheme/' . "sys_Mac_Obra" . '_' . hor . '.css')) { echo '?scp=' . md5($this->path_css . '_menuTheme/' . "sys_Mac_Obra" . '_' . hor . '.css'); } ?>" />
<style>
   .scTabText {
   }</style>
<script>
var is_menu_vertical = false;
</script>
</head>
<body style="height: 100%" class='scMenuHPage'>
<?php

if ('' != $sOutputBuffer)
{
    echo $sOutputBuffer;
}

    $NM_scr_iframe = (isset($_POST['hid_scr_iframe'])) ? $_POST['hid_scr_iframe'] : "";   
}
else
{
    $menumitra_menuData['height'] = '30px';
}

/* JS files */
?>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod']; ?>/third/jquery/js/jquery.js"></script>
<script  type="text/javascript" src="<?php echo $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod']; ?>/third/jquery_plugin/contextmenu/jquery.contextmenu.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['scriptcase']['menumitra']['glo_nm_path_prod']; ?>/third/jquery_plugin/contextmenu/contextmenu.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_contextmenu.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_contextmenu.css<?php if (@is_file($this->path_css . $this->str_schema_all . '_contextmenu.css')) { echo '?scp=' . md5($this->path_css . $this->str_schema_all . '_contextmenu.css'); } ?>" /> 
<?php
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
?>
<?php
$larg_table = "100%";
$col_span   = "";
$strAlign = 'align=\'center\'';
?>
<?php
$str_bmenu = nmButtonOutput($this->arr_buttons, "bmenu", "showMenu();", "showMenu();", "bmenu", "", "" . $this->Nm_lang['lang_btns_menu'] . "", "position:absolute; top:0px; left:0px; z-index:9999;", "absmiddle", "", "0px", $this->path_botoes, "", "" . $this->Nm_lang['lang_btns_menu_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
    $menu_mobile_hide          = $mobile_menu_mobile_hide;
    $menu_mobile_inicial_state = $mobile_menu_mobile_inicial_state;
    $menu_mobile_hide_onclick  = $mobile_menu_mobile_hide_onclick;
    $menutree_mobile_float     = $mobile_menutree_mobile_float;
    $menu_mobile_hide_icon     = $mobile_menu_mobile_hide_icon;
    $menu_mobile_hide_icon_menu_position     = $mobile_menu_mobile_hide_icon_menu_position;
}
if($menu_mobile_hide == 'S')
{
    if($menu_mobile_inicial_state =='escondido')
    {
            $str_menu_display="hide";
            $str_btn_display="show";
    }
    else
    {
        $str_menu_display="show";
        $str_btn_display="hide";
    }
    if($menu_mobile_hide_icon != 'S')
    {
        $str_btn_display="show";
    }
?>
<script>
    $( document ).ready(function() {
        $('#bmenu').<?php echo $str_btn_display; ?>();
        $('#idMenuCell').<?php echo $str_menu_display; ?>();
        <?php
        if($menutree_mobile_float != 'S')
        {
        ?>
            $('#id_toolbar').<?php echo $str_menu_display; ?>();
        <?php
        }
        ?>
        if($('.scMenuHHeader').length)
        {
                  $(".scMenuHHeader").css("padding-left", $('#bmenu').outerWidth());
        }
        else if($('.scMenuToolbar').length)
        {
                  $(".scMenuToolbar").css("padding-left", $('#bmenu').outerWidth());
        }
        <?php
                if($menutree_mobile_float == 'S')
                {
                ?>
                    str_html_menu = $('#idMenuCell').html();
                    $('#idMenuCell').remove()
                    $( 'body' ).prepend( "<div id='idMenuCell' style='position:absolute; top:0px; left:0px;display:<?php echo (($menu_mobile_inicial_state =='escondido')?'none':''); ?>'>"+ str_html_menu +"</div>" );
              <?php
              if($menu_mobile_hide_icon != 'S')
              {
                  if($menu_mobile_hide_icon_menu_position == 'right')
                  {
                          ?>
                          $('#idMenuCell').css('left', $('#bmenu').outerWidth());
                          <?php
                      }
                  else
                  {
                          ?>
                          $('#idMenuCell').css('top', $('#bmenu').outerHeight());
                          <?php
                      }
              }
                }
        ?>
    });
    function showMenu()
    {
      <?php
      if($menu_mobile_hide_icon == 'S')
      {
      ?>
                $('#bmenu').hide();
      <?php
      }
      ?>
            $('#idMenuCell').fadeToggle();
      <?php
      if($menutree_mobile_float != 'S')
      {
      ?>
                $('#id_toolbar').fadeToggle();
  setTimeout(function(){ scToggleOverflow(); }, 600);
      <?php
      }
      ?>
    }
    function HideMenu()
    {
      <?php
      if($menu_mobile_hide_icon == 'S')
      {
      ?>
                $('#bmenu').show();
      <?php
      }
      ?>
            $('#idMenuCell').fadeToggle();
      <?php
      if($menutree_mobile_float != 'S')
      {
      ?>
                $('#id_toolbar').fadeToggle();
  setTimeout(function(){ scToggleOverflow(); }, 600);
      <?php
      }
      ?>
    }
</script>
<?php
echo $str_bmenu;
}
?>
<script>
                        $( document ).ready(function() {
                                        $.contextMenu({
                                                        selector:'#contrl_abas > li',
                                                        leftButton: true,
                                                        callback: function(key, options)
                                                        {
                                                                                                        switch(key)
                                                                                                        {
                                                                                                                        case 'close':
                                                                                                                                        contextMenuCloseTab($(this).attr('id'));
                                                                                                                        break;

                                                                                                                        case 'closeall':
                                                                                                                                        contextMenuCloseAllTabs();
                                                                                                                        break;

                                                                                                                        case 'closeothers':
                                                                                                                                        contextMenuCloseOthersTabs($(this).attr('id'));
                                                                                                                        break;

                                                                                                                        case 'closeright':
                                                                                                                                        contextMenuCloseRight($(this).attr('id'));
                                                                                                                        break;

                                                                                                                        case 'closeleft':
                                                                                                                                        contextMenuCloseLeft($(this).attr('id'));
                                                                                                                        break;
                                                                                                        }
                                                                                        },
                                                        items: {
                                                                                                        "close": {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_close']); ?>'},
                                                                                                        "closeall": {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_closeall']); ?>'},
                                                                                                        "closeothers" : {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_closeothers']); ?>'},
                                                                                                        "closeright" : {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_closeright']); ?>'},
                                                                                                        "closeleft" : {name: '<?php echo str_replace("'", "\'", $this->Nm_lang['lang_othr_contextmenu_closeleft']); ?>'},
                                                                                        }
                                        });
                        });

                        function contextMenuCloseAllTabs()
                        {
                                        $( "#contrl_abas li" ).each(function( index ) {
                                                        contextMenuCloseTab($( this ).attr('id'));
                                        });
                        }

                        function contextMenuCloseTab(str_id)
                        {
                                        if(str_id.indexOf('aba_td_') >= 0)
                                        {
                                                        str_id = str_id.substr(7);
                                        }
                                        del_aba_td( str_id );
                        }

                        function contextMenuCloseRight(str_id)
                        {
                                        bol_start_del = false;
                                        $( "#contrl_abas li" ).each(function( index ) {

                                                        if(bol_start_del)
                                                        {
                                                                        contextMenuCloseTab($( this ).attr('id'));
                                                        }

                                                        if(str_id == $( this ).attr('id'))
                                                        {
                                                                        bol_start_del = true;
                                                        }
                                        });
                        }


                        function contextMenuCloseLeft(str_id)
                        {
                                        $( "#contrl_abas li" ).each(function( index ) {

                                                        if(str_id == $( this ).attr('id'))
                                                        {
                                                                         return false;
                                                        }
                                                        else
                                                        {
                                                                        contextMenuCloseTab($( this ).attr('id'));
                                                        }
                                        });
                        }

                        function contextMenuCloseOthersTabs(str_id)
                        {
                                        $( "#contrl_abas li" ).each(function( index ) {
                                                        if(str_id != $( this ).attr('id'))
                                                        {
                                                                        contextMenuCloseTab($( this ).attr('id'));
                                                        }
                                        });
                        }

function expandMenu()
{
    $('#idMenuHeader').hide();
    $('#idMenuLine').hide();
    $('#id_toolbar').hide();
    $('#id_expand').hide();
    $('#id_collapse').show();
}

function collapseMenu()
{
    $('#idMenuHeader').show();
    $('#idMenuLine').show();
    $('#id_toolbar').show();
    $('#id_expand').show();
    $('#id_collapse').hide();
}
Iframe_atual = "menumitra_iframe";
function writeFastMenu(arr_link)
{
    var link_ok = "";
    for (i = 0; i < arr_link.length; i++) 
    {
        if (link_ok != "")
        {
            link_ok += "<img src='<?php echo $path_imag_cab . "/" . $this->breadcrumbline_separator; ?>'>";
        }
        link_ok += arr_link[i].replace(/#NMIframe#/g, Iframe_atual);
    }
    document.getElementById('links_apls_itens').innerHTML = link_ok;
    document.getElementById('links_apls').style.display = '';
}
function clearFastMenu()
{
    document.getElementById('links_apls_itens').innerHTML = '';
    document.getElementById('links_apls').style.display = 'none';
}
Tab_iframes        = new Array();
Tab_labels         = new Array();
Tab_hints          = new Array();
Tab_icons          = new Array();
Tab_icons_inactive = new Array();
Tab_abas           = new Array();
Tab_refresh        = new Array();
Tab_links          = new Array();
var scScrollInterval = divOverflow = false;
Tab_ico_def        = new Array();
Tab_ico_ina_def    = new Array();
<?php
 foreach ($arr_menuicons as $tp => $icon)
 {
    echo "Tab_ico_def['$tp']     = '" . $icon['active'] . "';\r\n";
    echo "Tab_ico_ina_def['$tp'] = '" . $icon['inactive'] . "';\r\n";
 }
?>
Aba_atual    = "";
<?php
 $seq = 0;
echo "Tab_iframes[" . $seq . "] = \"menumitra\";\r\n";
echo "Tab_labels['menumitra'] = \"Home\";\r\n";
echo "Tab_hints['menumitra'] = \"Home\";\r\n";
echo "Tab_icons['menumitra'] = \"scriptcase__NM__ico__NM__sc_menu_home_e.png\";\r\n";
echo "Tab_icons_inactive['menumitra'] = \"scriptcase__NM__ico__NM__sc_menu_home_d.png\";\r\n";
echo "Tab_abas['menumitra']   = \"none\";\r\n";
echo "Tab_refresh['menumitra']   = \"\";\r\n";
echo "Tab_links['menumitra']   = \"\";\r\n";
         $seq++;
 foreach ($menumitra_menuData['data'] as $ind => $dados_menu)
 {
     if ($dados_menu['link'] != "#")
     {
         if(empty($dados_menu['hint']))
         {
             $dados_menu['hint'] = $dados_menu['label'];
         }
         echo "Tab_iframes[" . $seq . "] = \"" . $dados_menu['id'] . "\";\r\n";
         echo "Tab_labels['" . $dados_menu['id'] . "'] = \"" . str_replace('"', '\"', $dados_menu['label']) . "\";\r\n";
         echo "Tab_hints['" . $dados_menu['id'] . "'] = \"" . str_replace('"', '\"', $dados_menu['hint']) . "\";\r\n";
         echo "Tab_icons['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_aba'] . "\";\r\n";
         echo "Tab_icons_inactive['" . $dados_menu['id'] . "'] = \"" . $dados_menu['icon_aba_inactive'] . "\";\r\n";
         echo "Tab_abas['" . $dados_menu['id'] . "']   = \"none\";\r\n";
         echo "Tab_refresh['" . $dados_menu['id'] . "']   = \"\";\r\n";
         echo "Tab_links['" . $dados_menu['id'] . "']   = \"\";\r\n";
         $seq++;
     }
 }
?>
Qtd_apls = <?php echo $seq ?>;
function createIframe(str_id, str_label, str_hint, str_img_on, str_img_off, str_link, tp_apl)
{
    apl_exist = false;
    Tab_icons[str_id] = str_img_on;
    Tab_icons_inactive[str_id] = str_img_off;
    Tab_refresh[str_id] = "";
    if (tp_apl == null || tp_apl == '')
    {
        tp_apl = 'others';
    }
    if (Tab_icons[str_id] == '')
    {
        Tab_icons[str_id] = Tab_ico_def[tp_apl];
    }
    if (Tab_icons_inactive[str_id] == '')
    {
        Tab_icons_inactive[str_id] = Tab_ico_ina_def[tp_apl];
    }
    for (i = 0; i < Qtd_apls; i++)
    {
        if (Tab_iframes[i] == str_id) {
            apl_exist = true;
        }
    }
    if (apl_exist)
    {
        if (Tab_abas[str_id] != 'show') {
            createAba(str_id);
        }
        var iframe = document.getElementById('iframe_' + str_id);
        iframe.src = str_link;
        mudaIframe(str_id);
        return;
    }
    var iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    iframe.id = 'iframe_' + str_id;
    iframe.name = 'menumitra_' + str_id + '_iframe';
    iframe.src = str_link;
    $('#Iframe_control').append(iframe);
    $('#iframe_' + str_id).addClass( 'scMenuIframe');
    Tab_iframes[Qtd_apls] = str_id;
    Tab_labels[str_id] = str_label;
    Tab_hints[str_id] = str_hint;
    Tab_abas[str_id]   = 'none';
    Tab_links[str_id]   = '';
    Qtd_apls++;
    createAba(str_id);
    mudaIframe(str_id);
}
function createAba(str_id)
{
    var tmp = "";
    var html_icon = "";
        html_icon += "<img id='aba_td_" + str_id + "_icon_active' src='<?php echo $this->path_botoes; ?>/"+ (Tab_icons[str_id] != '' ? Tab_icons[str_id] : 'scriptcase__NM__ico__NM__sc_menu_others_e.png') +"' align='absmiddle' class='scTabIcon'>";
        html_icon += "<img id='aba_td_" + str_id + "_icon_inactive' src='<?php echo $this->path_botoes; ?>/"+ (Tab_icons_inactive[str_id] != '' ? Tab_icons_inactive[str_id] : 'scriptcase__NM__ico__NM__sc_menu_others_d.png') +"' align='absmiddle' class='scTabIcon' style='display:none;'>";
    tmp  = "<li id='aba_td_" + str_id + "' style='cursor:pointer' class='lslide scTabActive' title=\"" + Tab_hints[str_id] + "\">";
    tmp += "<div style='display:inline-block;' onclick=\"mudaIframe('" + str_id + "');\">";
    tmp += html_icon;
    tmp += "</div>";
    var home_style="";
    if(str_id === 'menumitra'){ home_style=";padding-left:4px;min-height:14px;"; }
    tmp += "<div id='aba_td_txt_" + str_id + "' style='display:inline-block;cursor:pointer"+home_style+"' class='scTabText' onclick=\"mudaIframe('" + str_id + "');\">";
    tmp += Tab_labels[str_id];
    tmp += "</div>";
    tmp += "<div id='aba_td_3_" + str_id + "' style='display:none;'>...</div>";
if(str_id !== 'menumitra'){
    tmp += "<div style='display:inline-block;'>";
    tmp += "    <img id='aba_td_img_" + str_id + "' src='<?php echo $this->path_botoes . "/" . $this->css_menutab_active_close_icon; ?>' onclick=\"del_aba_td('" + str_id + "');\" align='absmiddle' class='scTabCloseIcon' style='cursor:pointer; z-index:9999;'>";
    tmp += "</div>";
}
    tmp += "</li>";
    $('#contrl_abas').append(tmp);
    Tab_abas[str_id] = 'show';
}
function mudaIframe(str_id)
{
    $('#iframe_menumitra').hide();
    if (Aba_atual != "")
    {
        Tab_links[Aba_atual] = document.getElementById('links_apls_itens').innerHTML;
        document.getElementById('links_apls_itens').innerHTML = '';
        $('#links_apls').hide();
    }
    if (str_id != "" && Tab_links[str_id] != "")
    {
        document.getElementById('links_apls_itens').innerHTML = Tab_links[str_id];
        $('#links_apls').show();
    }
    if (str_id == "")
    {
        $('#iframe_' + Aba_atual).prop('src', '');
        $('#links_abas').hide();
    }
    else
    {
        $('#aba_td_' + Aba_atual).removeClass( 'scTabActive' );
        $('#aba_td_' + Aba_atual).addClass( 'scTabInactive' );
        $('#aba_td_' + Aba_atual+'_icon_active').hide();
        $('#aba_td_' + Aba_atual+'_icon_inactive').show();
        $('#aba_td_img_' + Aba_atual).prop( 'src', '<?php echo $this->path_botoes . "/" . $this->css_menutab_inactive_close_icon; ?>' );
    }
    for (i = 0; i < Tab_iframes.length; i++) 
    {
        if (Tab_iframes[i] == str_id) 
        {
            $('#iframe_' + Tab_iframes[i]).show();
            Aba_atual    = str_id;
            $('#aba_td_' + Aba_atual).removeClass( 'scTabInactive' );
            $('#aba_td_' + Aba_atual).addClass( 'scTabActive' );
            $('#aba_td_' + Aba_atual+'_icon_active').show();
            $('#aba_td_' + Aba_atual+'_icon_inactive').hide();
            $('#aba_td_img_' + Aba_atual).prop( 'src', '<?php echo $this->path_botoes . "/" . $this->css_menutab_active_close_icon; ?>' );
            Iframe_atual = "menumitra_" + Tab_iframes[i] + '_iframe';
            $('#iframe_' + Tab_iframes[i]).contents().find('body').css('width', '+=1px');
        } else {
            $('#iframe_' + Tab_iframes[i]).hide();
        }
    }
    if (Tab_refresh[str_id] == 'S' && typeof document.getElementById('iframe_' + str_id).contentWindow.nm_move === 'function')
    {
        Tab_refresh[str_id] = '';
        document.getElementById('iframe_' + str_id).contentWindow.nm_move('igual');
    }
}
function del_aba_td(str_id)
{
    if(str_id === 'menumitra') { return false; }
    $('#aba_td_' + str_id).remove();
    Tab_abas[str_id] = 'none';
    $('#iframe_' + str_id).prop('src', '');
    Tab_links[str_id] = "";
    if (Aba_atual == str_id)
    {
        str_id = "";
        for (i = 0; i < Tab_iframes.length; i++) 
        {
            if (Tab_abas[Tab_iframes[i]] == 'show' && Tab_refresh[Tab_iframes[i]] == 'S')
            {
                str_id = Tab_iframes[i];
            }
        }
        if (str_id == "")
        {
            for (i = 0; i < Tab_iframes.length; i++) 
            {
                if (Tab_abas[Tab_iframes[i]] == 'show')
                {
                    str_id = Tab_iframes[i];
                }
            }
        }
        if (str_id == "" && Aba_atual != "menumitra")
        {
            document.getElementById('iframe_menumitra').click();
        }
        else
        {
            mudaIframe(str_id);
        }
    }
  scToggleOverflow();
}
$( document ).ready(function() { scToggleOverflow() });
function scToggleOverflow() {
  var width_offset = 0;
  if (is_menu_vertical === true) { width_offset = $('#idDivMenu').parent()[0].offsetWidth + 2; };
  $('.scTabLine').css('width', ($('#main_menu_table')[0].offsetWidth - width_offset) + 'px');
  var hasOverflow, scrollElement;
  scrollElement = $('#div_contrl_abas')[0];
  if (scrollElement.offsetHeight < scrollElement.scrollHeight || scrollElement.offsetWidth < scrollElement.scrollWidth) {
      hasOverflow = true;
  } else {
      hasOverflow = false;
  }
  if (divOverflow === hasOverflow){ return false; }
  if (hasOverflow === true) {
      $('.scTabScroll').show();
      $('#div_contrl_abas').toggleClass('div-overflow');
  } else {
      $('.scTabScroll').hide();
      $('#div_contrl_abas').toggleClass('div-overflow');
  }
  divOverflow = hasOverflow;
}
function scTabScroll(axis) {
  if (axis == 'stop') {
      clearInterval(scScrollInterval);
      return;
  }
  if (axis == 'left') {
      scScrollInterval = setInterval("$('#div_contrl_abas').scrollLeft($('#div_contrl_abas').scrollLeft() - 3)", 2);
  } else {
      scScrollInterval = setInterval("$('#div_contrl_abas').scrollLeft($('#div_contrl_abas').scrollLeft() + 3)", 2);
  }
}
function openMenuItem(str_id)
{
    str_target_sv = "";
    if (str_id != "iframe_menumitra")
    {
        str_target_sv = str_id + "_iframe";
        str_id        = str_id.replace("menumitra_","");
    }
    str_link   = $('#' + str_id).attr('item-href');
    str_target = $('#' + str_id).attr('item-target');
    str_id = str_id.replace('iframe_menumitra', 'menumitra');
    if (str_target == "menumitra_iframe" && str_link != '' && str_link != '#' && str_link != 'javascript:')
    {
        str_target = (str_target_sv != "") ? str_target_sv : str_target;
        mudaIframe(str_id);
        $('#links_abas').css('display','');
        if (Tab_abas[str_id] != 'show')
        {
            createAba(str_id);
      scToggleOverflow();
        }
    }
    //test link type
    if (str_link != '' && str_link != '#' && str_link != 'javascript:')
    {
        if (str_link.substring(0, 11) == 'javascript:')
        {
            eval(str_link.substring(11));
        }
        else if (str_link != '#' && str_target != '_parent')
        {
            window.open(str_link, str_target);
        }
        else if (str_link != '#' && str_target == '_parent')
        {
            document.location = str_link;
        }
        <?php
        if ($menu_mobile_hide == 'S' && $menu_mobile_hide_onclick == 'S')
        {
        ?>
            HideMenu();
        <?php
        }
        ?>
    }
}
</script>

    <?php
    if(isset($expand_icon) && !empty($expand_icon) && isset($collapse_icon) && !empty($collapse_icon))
    {
      ?>
        <a href='#' onclick='expandMenu();' id='id_expand' class='scMenuExpand' style='z-index: 9999;'><img src='<?php echo $path_imag_cab . '/' . $expand_icon; ?>' border=0 /></a>
        <a href='#' onclick='collapseMenu();' id='id_collapse' class='scMenuCollapse' style='z-index: 9999;'><img src='<?php echo $path_imag_cab . '/' . $collapse_icon; ?>' border=0 /></a>
      <?php
    }
    ?>
<table id="main_menu_table" <?php echo $strAlign; ?> style="border-collapse: collapse; border-width: 0px; height:100%; width: <?php echo $larg_table; ?>" cellpadding=0 cellspacing=0>
  <tr id='idMenuHeader'>
    <td style="padding: 0px" valign="top" <?php echo $col_span; ?>>
<style>
#lin1_col1 { font-size:22px; width:500px; color: #FFFFFF; }
#lin1_col2 { font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:right; color: #FFFFFF;  }
#lin2_col1 { font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:15px; }
#lin2_col2 { font-family:Arial, Helvetica, sans-serif; font-size:12px; text-align:right; color: #FFFFFF;  }

</style>

<table width="100%" height="67px" class="scMenuHHeader">
        <tr>
                <td width="5px"></td>
        <td width="67px" class="scMenuHHeaderFont"></td>
               <td class="scMenuHHeaderFont"><span id="lin1_col1"><?php echo "Telco Management Project System" ?></span><br /><span id="lin2_col1"></span></td>
               <td align="right" class="scMenuHHeaderFont"><span  id="lin1_col2"></span><br /><span id="lin2_col2"></span></td>
        <td width="5px"></td>
    </tr>
</table>
    </td>
  </tr>
  <tr class="scMenuHTableCssAlt" id='idMenuLine'>
      <td <?php echo $strAlign; ?> valign="top" class="scMenuLine" style="width:100%; height:30;padding: 0px;" id='idMenuCell'>
<div id="scScrollFix" style="height: 1px"></div>
<script type="text/javascript">
function fnScrollFix() {
 var txt = document.getElementById("scScrollFix").innerHTML;
 if ("&nbsp;" == txt) { txt = "&nbsp;&nbsp;"; } else { txt = "&nbsp;"; }
 document.getElementById("scScrollFix").innerHTML = txt;
 setTimeout("fnScrollFix()", 500);
}
setTimeout("fnScrollFix()", 500);
</script>
<div id="idDivMenu">
<table style='width:100%'><tr><?php
echo $this->menumitra_escreveMenu($menumitra_menuData['data'], $path_imag_cab, $strAlign);
?></tr></table>
</div>
<?php
/* Iframe control */
if ($menumitra_menuData['iframe'])
{
?>
    </td>
  </tr>
<?php echo $this->nm_show_toolbarmenu('', $saida_apl, $menumitra_menuData, $path_imag_cab); ?><?php echo $this->nm_gera_degrade(1, $bg_line_degrade, $path_imag_cab); ?>  <tr>
        <td id="links_abas" style="display: none;">
          <div class='scTabLine'>
          <?php if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['display_mobile'] === false) { ?>
            <div class='scTabScroll left' style='float:left;display:none;' onmousedown='scTabScroll("left");' onmouseup='scTabScroll("stop");' onmouseout='scTabScroll("stop");'></div>
            <div class='scTabScroll right' style='float:right;display:none;'onmousedown='scTabScroll("right");' onmouseup='scTabScroll("stop");' onmouseout='scTabScroll("stop");'></div>
          <?php } ?>
            <div id='div_contrl_abas' class='scTabCtrl' style='overflow:hidden;white-space: nowrap;'>
              <ul id='contrl_abas' style='margin:0px; padding:0px;'></ul>
            </div>
          </div>
        </td>
        </tr><tr>
        <td id="links_apls" style="display: none;">
            <div id="links_apls_itens" class='scMenuBreadcrumbLine'></div>
        </td>
        </tr><tr>
    <td id="Iframe_control" style="border-width: 1px; height: 100%; padding: 0px;vertical-align:top;text-align:center;">
<?php
$link_default = "";
if (isset($_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra']) && $_SESSION['scriptcase']['sc_apl_seg']['v_table_project_copy_for_report_mitra'] == "on") 
{ 
    $SCR  = "";
    $link_default = " onclick=\"openMenuItem('iframe_menumitra');\" item-href=\"menumitra_form_php.php?sc_item_menu=menumitra&sc_apl_menu=v_table_project_copy_for_report_mitra&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . "\"  item-target=\"menumitra_iframe\"";
} 
else
{ 
    $SCR  = ($NM_scr_iframe != "" ? $NM_scr_iframe : "menumitra_pag_ini.php");
} 
?>
      <iframe id="iframe_menumitra" name="menumitra_iframe" frameborder="0" class="scMenuIframe" style="width: 100%; height: 100%;"  src="<?php echo $SCR; ?>" <?php echo $link_default ?>></iframe>
<?php
 foreach ($menumitra_menuData['data'] as $ind => $dados_menu)
 {
     if ($dados_menu['link'] != "#")
     {
         echo "      <iframe id=\"iframe_" . $dados_menu['id'] . "\" name= \"menumitra_" . $dados_menu['id'] . "_iframe\" frameborder=\"0\" class=\"scMenuIframe\" style=\"display: none;width: 100%; height: 100%;\" src=\"\"></iframe>
";
     }
 }
}
?></td>
  </tr>
  <tr>
    <td style="padding: 0px">
<style>
#rod_col1 { margin:0px; padding: 3px 0px 0px 5px; float:left; overflow:hidden;}
#rod_col2 { margin:0px; padding: 3px 5px 0px 0px; float:right; overflow:hidden; text-align:right;}

</style>

<div style="width: 100%; height:20px;" class="scMenuHFooter">
        <span class="scMenuHFooterFont" id="rod_col1"></span>
        <span class="scMenuHFooterFont" id="rod_col2"><?php echo "Copyright @ 2017 TOMPS. All Rights Reserved." ?></span>
</div>    </td>
  </tr>
</table>
</body>
</html>
<?php

if (isset($link_default) && !empty($link_default))
{
    echo "<script>";
    echo "   document.getElementById('iframe_menumitra').click()";
    echo "</script>";
}

}

/* Target control */
function menumitra_escreveMenu($arr_menu, $path_imag_cab = '', $strAlign = '')
{
    global $nm_data_fixa;
    $last      = '';
    $itemClass = ' topfirst';
    $subSize   = 2;
    $subCount  = array();
    $tabSpace  = 1;
    $intMult   = 2;
    $aMenuItemList = array();
    foreach ($arr_menu as $ind => $resto)
    {
        $aMenuItemList[] = $resto;
    }
?>
<td <?php echo $strAlign; ?>>
<ul id="css3menu1" class="topmenu" style="">
<?php
    for ($i = 0; $i < sizeof($aMenuItemList); $i++) {
        if (0 == $aMenuItemList[$i]['level']) {
            $last = $aMenuItemList[$i]['id'];
        }
    }
    for ($i = 0; $i < sizeof($aMenuItemList); $i++) {
        if ($last == $aMenuItemList[$i]['id']) {
            $itemClass = ' toplast';
        }
        $htmlClass = '';
        if (0 == $aMenuItemList[$i]['level']) {
            $htmlClass = ' class="topmenu' . $itemClass;
            if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] < $aMenuItemList[$i + 1]['level']) {
                $htmlClass .= ' toproot';
            }
            $htmlClass .= '"';
        }
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><li<?php echo $htmlClass; ?>>
<?php
        $tabSpace++;
        if ('' != $aMenuItemList[$i]['icon'] && file_exists($this->path_imag_apl . "/" . $aMenuItemList[$i]['icon'])) {
            $iconHtml = '<img src="../_lib/img/' . $aMenuItemList[$i]['icon'] . '" border="0" />';
        }
        else {
            $iconHtml = '';
        }
        $sDisabledClass = '';
        if ('Y' == $aMenuItemList[$i]['disabled']) {
            $aMenuItemList[$i]['link']   = '#';
            $aMenuItemList[$i]['target'] = '';
            $sDisabledClass               = 0 == $aMenuItemList[$i]['level'] ? ' class="scdisabledmain"' : ' class="scdisabledsub"';
        }
        if (empty($aMenuItemList[$i]['link'])) {
            $aMenuItemList[$i]['link']   = '#';
        }
        if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] < $aMenuItemList[$i + 1]['level']) {
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><a href="javascript:" onclick="openMenuItem('menumitra_<?php echo $aMenuItemList[$i]['id']; ?>');" item-href="<?php echo $aMenuItemList[$i]['link']; ?>" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>" <?php echo $aMenuItemList[$i]['target']; ?> <?php echo $sDisabledClass; ?>><span><?php echo $iconHtml . $aMenuItemList[$i]['label']; ?></span></a>
<?php
            if (0 != $subSize && 0 < $aMenuItemList[$i + 1]['level']) {
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--div class="submenu" abre-->
<?php
                $tabSpace++;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--div class="column" abre-->
<?php
                $tabSpace++;
            }
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><ul>
<?php
            $tabSpace++;
        }
        else {
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><a href="javascript:" onclick="openMenuItem('menumitra_<?php echo $aMenuItemList[$i]['id']; ?>');" item-href="<?php echo $aMenuItemList[$i]['link']; ?>" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>"<?php echo $aMenuItemList[$i]['target'] . $sDisabledClass; ?>><?php echo $iconHtml . $aMenuItemList[$i]['label']; ?></a>
<?php
        }
        if (($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == $aMenuItemList[$i + 1]['level']) || 
            ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > $aMenuItemList[$i + 1]['level']) ||
            (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > 0) ||
            (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == 0)) {
            $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></li>
<?php
            if (0 != $subSize && 0 < $aMenuItemList[$i]['level']) {
                if (!isset($subCount[ $aMenuItemList[$i]['level'] ])) {
                    $subCount[ $aMenuItemList[$i]['level'] ] = 0;
                }
                $subCount[ $aMenuItemList[$i]['level'] ]++;
            }
            if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > $aMenuItemList[$i + 1]['level']) {
                for ($j = 0; $j < $aMenuItemList[$i]['level'] - $aMenuItemList[$i + 1]['level']; $j++) {
                    unset($subCount[ $aMenuItemList[$i]['level'] - $j]);
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></ul>
<?php
                    if (0 != $subSize && 0 < $aMenuItemList[$i]['level']) {
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="column" fecha-->
<?php
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="submenu" fecha-->
<?php
                    }
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></li>
<?php
                }
            }
            elseif (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > 0) {
                for ($j = 0; $j < $aMenuItemList[$i]['level']; $j++) {
                    unset($subCount[ $aMenuItemList[$i]['level'] - $j]);
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></ul>
<?php
                    if (0 != $subSize && 0 < $aMenuItemList[$i]['level']) {
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="column" fecha-->
<?php
                        $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--/div class="submenu" fecha-->
<?php
                    }
                    $tabSpace--;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?></li>
<?php
                }
            }
            if ($subSize == $subCount[ $aMenuItemList[$i]['level'] ]) {
                $subCount[ $aMenuItemList[$i]['level'] ] = 0;
?>
<?php echo str_repeat(' ', $tabSpace * $intMult); ?><!--quebra-->
<?php
            }
        }
        $itemClass = '';
    }
?>
</ul>
</td>
<?php
}
function menumitra_target($str_target)
{
    global $menumitra_menuData;
    if ('_blank' == $str_target)
    {
        return '_blank';
    }
    elseif ('_parent' == $str_target)
    {
        return '_parent';
    }
    elseif ($menumitra_menuData['iframe'])
    {
        return 'menumitra_iframe';
    }
    else
    {
        return $str_target;
    }
}

function nm_show_toolbarmenu($col_span, $saida_apl, $menumitra_menuData, $path_imag_cab)
{
}

   function nm_prot_aspas($str_item)
   {
       return str_replace('"', '\"', $str_item);
   }

   function nm_gera_menus(&$str_line_ret, $arr_menu_usu, $int_level, $nome_aplicacao)
   {
       global $menumitra_menuData; 
       foreach ($arr_menu_usu as $arr_item)
       {
           $str_line   = array();
           $str_line['label']    = $this->nm_prot_aspas($arr_item['label']);
           $str_line['level']    = $int_level - 1;
           $str_line['link']     = "";
           $nome_apl = $arr_item['link'];
           $pos = strrpos($nome_apl, "/");
           if ($pos !== false)
           {
               $nome_apl = substr($nome_apl, $pos + 1);
           }
           if ('' != $arr_item['link'])
           {
               if ($arr_item['target'] == '_parent')
               {
                    $str_line['link'] = "menumitra_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . ""; 
               }
               else
               {
                    $str_line['link'] = "menumitra_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($menumitra_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menumitra']['glo_nm_usa_grupo'] . ""; 
               }
           }
           elseif ($arr_item['target'] == '_parent')
           {
           }
           $str_line['hint']     = ('' != $arr_item['hint']) ? $this->nm_prot_aspas($arr_item['hint']) : '';
           $str_line['id']       = $arr_item['id'];
           $str_line['icon']     = ('' != $arr_item['icon_on']) ? $arr_item['icon_on'] : '';
           $str_line['icon_aba'] = (isset($arr_item['icon_aba']) && '' != $arr_item['icon_aba']) ? $arr_item['icon_aba'] : '';
           $str_line['icon_aba_inactive'] = (isset($arr_item['icon_aba_inactive']) && '' != $arr_item['icon_aba_inactive']) ? $arr_item['icon_aba_inactive'] : '';
           if ('' == $arr_item['link'] && $arr_item['target'] == '_parent')
           {
               $str_line['target'] = '_parent';
           }
           else
           {
                $str_line['target'] = ('' != $arr_item['target'] && '' != $arr_item['link']) ?  $this->menumitra_target( $arr_item['target']) : "_self"; 
           }
           $str_line['target']   = ' item-target="' . $str_line['target']  . '" ';
           $str_line['sc_id']    = $arr_item['id'];
           $str_line['disabled'] = "N";
           $str_line_ret[] = $str_line;
           if (!empty($arr_item['menu_itens']))
           {
               $this->nm_gera_menus($str_line_ret, $arr_item['menu_itens'], $int_level + 1, $nome_aplicacao);
           }
       }
   }

   function nm_arr_menu_recursiv($arr, $id_pai = '')
   {
         $arr_return = array();
         foreach ($arr as $id_menu => $arr_menu)
         {
             if ($id_pai == $arr_menu['pai']) 
             {
                 $arr_return[] = array('label'      => $arr_menu['label'],
                                        'link'       => $arr_menu['link'],
                                        'target'     => $arr_menu['target'],
                                        'icon_on'    => $arr_menu['icon'],
                                        'icon_aba'   => $arr_menu['icon_aba'],
                                        'icon_aba_inactive'   => $arr_menu['icon_aba_inactive'],
                                        'hint'       => $arr_menu['hint'],
                                        'id'         => $id_menu,
                                        'menu_itens' => $this->nm_arr_menu_recursiv($arr, $id_menu));
             }
         }
         return $arr_return;
   }
   //1 horizontal
   //2 vertical
   function nm_gera_degrade($menu_opc, $bg_line_degrade, $path_imag_cab)
   {
       $str_retorno = "";
       //have bg color degrade
       if(!empty($bg_line_degrade) && count($bg_line_degrade)>0)
       {
           if($menu_opc == 1)
           {
               foreach($bg_line_degrade as $bg_color)
               {
                   if(!empty($bg_color))
                   {
                       $str_retorno .= "<tr style=\"height:1px; padding: 0px;\">\r\n";
                       $str_retorno .= "  <td style=\"height:1px; padding: 0px;\" bgcolor=\"". $bg_color ."\"><img src='". $path_imag_cab ."/transparent.png' border=\"0\" style=\"height:1px;\"></td>\r\n";
                       $str_retorno .= "</tr>\r\n";
                   }
               }
           }
           elseif($menu_opc == 2)
           {
               foreach($bg_line_degrade as $bg_color)
               {
                   if(!empty($bg_color))
                   {
                       $str_retorno .= "<td style=\"width:1px; padding: 0px;\" bgcolor=\"". $bg_color ."\">\r\n";
                       $str_retorno .= "<img src='" . $path_imag_cab . "/transparent.png' border=\"0\" style=\"width:1px;\">\r\n";
                       $str_retorno .= "</td>\r\n";
                   }
               }
           }
       }
       return $str_retorno;
   }
   function Gera_sc_init($apl_menu)
   {
        if (!isset($_SESSION['scriptcase']['menumitra']['sc_init'][$apl_menu]))
        {
            $_SESSION['scriptcase']['menumitra']['sc_init'][$apl_menu] = rand(2, 10000);
        }
        $_SESSION['sc_session'][$_SESSION['scriptcase']['menumitra']['sc_init'][$apl_menu]] = array();
        return  $_SESSION['scriptcase']['menumitra']['sc_init'][$apl_menu];
   }
function sc_logged($user, $ip = '')
	{
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'on';
               
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
$this->nmgp_redireciona_form($_SESSION['scriptcase']['sc_apl_menu_link'] . $this->tab_grupo[0] . "" . SC_dir_app_name('app_logged') . "/", "menumitra_form_php.php", "user?#?" . $user . "?@?","_self", 440, 630);
 };
			return false;
		}
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'off';
}
function sc_verify_logged()
	{
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'on';
if (!isset($_SESSION['logged_date_login'])) {$_SESSION['logged_date_login'] = "";}
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($_SESSION['logged_user'])) {$_SESSION['logged_user'] = "";}
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
			 if (isset($this->sc_temp_logged_user)) {$_SESSION['logged_user'] = $this->sc_temp_logged_user;}
 if (isset($this->sc_temp_logged_date_login)) {$_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($_SESSION['scriptcase']['sc_apl_menu_link'] . $this->tab_grupo[0] . "" . SC_dir_app_name('app_Login') . "/", "menumitra_form_php.php", "","_parent", 440, 630);
 };
		}
if (isset($this->sc_temp_logged_user)) {$_SESSION['logged_user'] = $this->sc_temp_logged_user;}
if (isset($this->sc_temp_logged_date_login)) {$_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'off';
}
function sc_logged_in($user, $ip = '')
	{
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'on';
if (!isset($_SESSION['logged_date_login'])) {$_SESSION['logged_date_login'] = "";}
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($_SESSION['logged_user'])) {$_SESSION['logged_user'] = "";}
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
             echo $this->Nm_lang['lang_errm_dber'] . ": " . $this->Db->ErrorMsg();
             echo "<br>APL: menumitra";
             echo "<br>Line: " . __LINE__;
             if ($sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $sc_tem_trans_banco = false;
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
             echo $this->Nm_lang['lang_errm_dber'] . ": " . $this->Db->ErrorMsg();
             echo "<br>APL: menumitra";
             echo "<br>Line: " . __LINE__;
             if ($sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      ;
if (isset($this->sc_temp_logged_user)) {$_SESSION['logged_user'] = $this->sc_temp_logged_user;}
if (isset($this->sc_temp_logged_date_login)) {$_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'off';
}
function sc_logged_in_fail($user, $ip = '')
    {
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'on';
               
        $ip = ($ip == '') ? $_SERVER['REMOTE_ADDR'] : $ip;
        $str_sql = "INSERT INTO SEC_LOGGED(LOGIN, DATE_LOGIN, SC_SESSION, IP) VALUES ('" . $user . "', '" . microtime(true) . "', '_SC_FAIL_SC_', '" . $ip . "')";
        
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             echo $this->Nm_lang['lang_errm_dber'] . ": " . $this->Db->ErrorMsg();
             echo "<br>APL: menumitra";
             echo "<br>Line: " . __LINE__;
             if ($sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      ;
        return true;
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'off';
}
function sc_logged_is_blocked($ip = '')
    {
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'on';
               
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
            $message = $this->Nm_lang['lang_user_blocked'];
                $message = sprintf($message, 10);
                
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $message;
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
             echo $this->Nm_lang['lang_errm_dber'] . ": " . $this->Db->ErrorMsg();
             echo "<br>APL: menumitra";
             echo "<br>Line: " . __LINE__;
             if ($sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      ;
            $message = $this->Nm_lang['lang_user_blocked'];
                $message = sprintf($message, 10);
                
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= $message;
;
                return true;
        }
        return false;
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'off';
}
function sc_logged_out($user, $date_login = '')
	{
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'on';
if (!isset($_SESSION['logged_user'])) {$_SESSION['logged_user'] = "";}
if (!isset($this->sc_temp_logged_user)) {$this->sc_temp_logged_user = (isset($_SESSION['logged_user'])) ? $_SESSION['logged_user'] : "";}
if (!isset($_SESSION['logged_date_login'])) {$_SESSION['logged_date_login'] = "";}
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
             echo $this->Nm_lang['lang_errm_dber'] . ": " . $this->Db->ErrorMsg();
             echo "<br>APL: menumitra";
             echo "<br>Line: " . __LINE__;
             if ($sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $sc_tem_trans_banco = false;
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
if (isset($this->sc_temp_logged_date_login)) {$_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
if (isset($this->sc_temp_logged_user)) {$_SESSION['logged_user'] = $this->sc_temp_logged_user;}
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'off';
}
function sc_looged_check_logout()
    {
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_email'])) {$_SESSION['usr_email'] = "";}
if (!isset($this->sc_temp_usr_email)) {$this->sc_temp_usr_email = (isset($_SESSION['usr_email'])) ? $_SESSION['usr_email'] : "";}
if (!isset($_SESSION['logged_date_login'])) {$_SESSION['logged_date_login'] = "";}
if (!isset($this->sc_temp_logged_date_login)) {$this->sc_temp_logged_date_login = (isset($_SESSION['logged_date_login'])) ? $_SESSION['logged_date_login'] : "";}
if (!isset($_SESSION['logged_user'])) {$_SESSION['logged_user'] = "";}
if (!isset($this->sc_temp_logged_user)) {$this->sc_temp_logged_user = (isset($_SESSION['logged_user'])) ? $_SESSION['logged_user'] : "";}
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
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
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_logged_user)) {$_SESSION['logged_user'] = $this->sc_temp_logged_user;}
if (isset($this->sc_temp_logged_date_login)) {$_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
if (isset($this->sc_temp_usr_email)) {$_SESSION['usr_email'] = $this->sc_temp_usr_email;}
$_SESSION['scriptcase']['menumitra']['contr_erro'] = 'off';
}
   function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $alt_modal=0, $larg_modal=0)
   {
      global  $menumitra_menuData;
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
                  $tmp_parms .= $_SESSION['sc_session'][1]['menumitra'][substr($val, 1, -1)];
              }
              else
              {
                  $tmp_parms .= $val;
              }
              $tmp_parms .= "?@?";
          }
          $nm_apl_parms = $tmp_parms;
      }
      $nm_apl_retorno = $_SERVER['PHP_SELF'];
      $nm_apl_retorno = str_replace("\\", '/', $nm_apl_retorno);
      $nm_apl_retorno = str_replace('//', '/', $nm_apl_retorno);
      $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
      if (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../" || strtolower(substr($nm_apl_dest, 0, 1)) == "/")
      {
          echo "<SCRIPT type=\"text/javascript\">";
          if (strtolower($nm_target) == "_blank")
          {
              echo "window.open ('" . $nm_apl_dest . "');";
          }
          else
          {
              echo "window.location='" . $nm_apl_dest . "';";
          }
          echo "</SCRIPT>";
          exit;
      }
      $dir = explode("/", $nm_apl_dest);
      if (count($dir) == 1)
      {
          $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
          $nm_apl_dest = $menumitra_menuData['url']['link'] . $this->tab_grupo[0] .$nm_apl_dest . "/" . $nm_apl_dest . ".php";
      }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

      <HTML>
      <HEAD>
       <META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
       <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
       <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
       <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
       <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
       <META http-equiv="Pragma" content="no-cache"/>
      </HEAD>
      <BODY>
      <form name="Fredir" method="post" 
                            target="_self"> 
        <input type="hidden" name="nmgp_parms" value="<?php echo NM_encode_input($nm_apl_parms) ?>"/>
<?php
   if ($nm_target == "_blank")
   {
?>
         <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
        <input type="hidden" name="nmgp_url_saida" value="<?php echo NM_encode_input($nm_apl_retorno) ?>">
        <input type="hidden" name="script_case_init" value="1"/> 
        <input type=hidden name="script_case_session" value="<?php echo NM_encode_input(session_id()) ?>"> 
<?php
   }
?>
         <SCRIPT type="text/javascript">
          document.Fredir.target = "<?php echo $nm_target_form ?>"; 
          document.Fredir.action = "<?php echo $nm_apl_dest ?>";
          document.Fredir.submit();
      </SCRIPT>
      </BODY>
      </HTML>
<?php
     if ($nm_target != "_blank")
     {
         exit;
     }
   }
   function regionalDefault()
   {
       $_SESSION['scriptcase']['reg_conf']['date_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_format'] : "mmddyyyy";
       $_SESSION['scriptcase']['reg_conf']['date_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_sep'] : "/";
       $_SESSION['scriptcase']['reg_conf']['date_week_ini'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema'] : "SU";
       $_SESSION['scriptcase']['reg_conf']['time_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_format'] : "hhiiss";
       $_SESSION['scriptcase']['reg_conf']['time_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_sep'] : ":";
       $_SESSION['scriptcase']['reg_conf']['time_pos_ampm'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm'] : "right_without_space";
       $_SESSION['scriptcase']['reg_conf']['time_simb_am']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am'] : "am";
       $_SESSION['scriptcase']['reg_conf']['time_simb_pm']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm'] : "pm";
       $_SESSION['scriptcase']['reg_conf']['simb_neg']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg'] : "-";
       $_SESSION['scriptcase']['reg_conf']['grup_num']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr'] : ",";
       $_SESSION['scriptcase']['reg_conf']['dec_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec'] : ".";
       $_SESSION['scriptcase']['reg_conf']['neg_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg'] : 2;
       $_SESSION['scriptcase']['reg_conf']['monet_simb']    = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo'] : "$";
       $_SESSION['scriptcase']['reg_conf']['monet_f_pos']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'] : 3;
       $_SESSION['scriptcase']['reg_conf']['monet_f_neg']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'] : 13;
       $_SESSION['scriptcase']['reg_conf']['grup_val']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr'] : ",";
       $_SESSION['scriptcase']['reg_conf']['dec_val']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec'] : ".";
       $_SESSION['scriptcase']['reg_conf']['html_dir']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  " DIR='" . $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] . "'" : "";
       $_SESSION['scriptcase']['reg_conf']['css_dir']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "LTR";
       $_SESSION['scriptcase']['reg_conf']['html_dir_only'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "";
       $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit'] : "1";
       $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'] : "1";
   }

}
if ((isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang") || (isset($_GET['nmgp_opcao']) && $_GET['nmgp_opcao'] == "force_lang"))
{
    if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "force_lang")
    {
        $nmgp_opcao  = $_POST['nmgp_opcao'];
        $nmgp_idioma = $_POST['nmgp_idioma'];
    }
    else
    {
        $nmgp_opcao  = $_GET['nmgp_opcao'];
        $nmgp_idioma = $_GET['nmgp_idioma'];
    }
    $Temp_lang = explode(";" , $nmgp_idioma);
    if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))
    {
        $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
    }
    if (isset($Temp_lang[1]) && !empty($Temp_lang[1]))
    {
        $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
    }
}
$contr_menumitra = new menumitra_class;
$contr_menumitra->menumitra_menu();

?>
