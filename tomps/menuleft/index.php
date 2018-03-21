<?php
include_once('menuleft_session.php');
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
$_SESSION['scriptcase']['menuleft']['glo_nm_path_prod'] = "/libdemo/prod";
$_SESSION['scriptcase']['menuleft']['glo_nm_perfil']    = "conn_mysql_1";
$_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] = "";

ob_start();


class menuleft_class
{
  var $Db;

 function sc_Include($path, $tp, $name)
 {
     if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
     {
         include_once($path);
     }
 } // sc_Include

 function menuleft_menu()
 {
    global $menuleft_menuData;
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
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'off';
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
$nm_url_saida = "";
if (isset($nmgp_url_saida))
{
    $nm_url_saida = $nmgp_url_saida;
    if (isset($script_case_init))
    {
        $nm_url_saida .= "?script_case_init=" . $script_case_init;
    }
}
if (isset($_POST["nmgp_idioma"]) || isset($_POST["nmgp_schema"]))  
{ 
    $nm_url_saida = $_SESSION['scriptcase']['sc_saida_menuleft'];
}
elseif (!empty($nm_url_saida))
{
    $_SESSION['scriptcase']['sc_url_saida'][$script_case_init]  = $nm_url_saida;
    $_SESSION['scriptcase']['sc_saida_menuleft'] = $nm_url_saida;
}
else
{
    $_SESSION['scriptcase']['sc_saida_menuleft'] = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "javascript:window.close()";
}
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
if(empty($_SESSION['scriptcase']['menuleft']['glo_nm_path_prod']))
{
        /*check prod*/$_SESSION['scriptcase']['menuleft']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
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
$this->path_botoes    = '../_lib/img';
$this->path_imag_apl  = $str_root . $path_link . "_lib/img";
$path_help      = $path_link . "_lib/webhelp/";
$path_libs      = $str_root . $_SESSION['scriptcase']['menuleft']['glo_nm_path_prod'] . "/lib/php";
$path_third     = $str_root . $_SESSION['scriptcase']['menuleft']['glo_nm_path_prod'] . "/third";
$url_third      = $_SESSION['scriptcase']['menuleft']['glo_nm_path_prod'] . "/third";
$path_adodb     = $str_root . $_SESSION['scriptcase']['menuleft']['glo_nm_path_prod'] . "/third/adodb";
$path_apls      = $str_root . substr($path_link, 0, strrpos($path_link, '/'));
$path_img_old   = $str_root . $path_link . "menuleft/img";
$this->path_css = $str_root . $path_link . "_lib/css/";
$path_lib_php   = $str_root . $path_link . "_lib/lib/php";
$menu_largura   = '210';
$menu_mobile_hide          = 'N';
$menu_mobile_inicial_state = 'escondido';
$menu_mobile_hide_onclick  = 'S';
$menutree_mobile_float     = 'S';
$menu_mobile_hide_icon     = 'N';
$mobile_menu_mobile_hide          = 'S';
$mobile_menu_mobile_inicial_state = 'aberto';
$mobile_menu_mobile_hide_onclick  = 'S';
$mobile_menutree_mobile_float     = 'S';
$mobile_menu_mobile_hide_icon     = 'N';
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
    include_once(dirname(__FILE__) . "/menuleft_erro.php");
}
include_once(dirname(__FILE__) . "/menuleft_erro.class.php"); 
$this->Erro = new menuleft_erro();
$str_path = substr($_SESSION['scriptcase']['menuleft']['glo_nm_path_prod'], 0, strrpos($_SESSION['scriptcase']['menuleft']['glo_nm_path_prod'], '/') + 1);
if (!is_file($str_root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
{
    unset($_SESSION['scriptcase']['nm_sc_retorno']);
    unset($_SESSION['scriptcase']['menuleft']['glo_nm_conexao']);
}
/* Path definitions */
$menuleft_menuData          = array();
$menuleft_menuData['path']  = array();
$menuleft_menuData['url']   = array();
$NM_dir_atual = getcwd();
if (empty($NM_dir_atual))
{
    $menuleft_menuData['path']['sys'] = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
    $menuleft_menuData['path']['sys'] = str_replace("\\", '/', $str_path_sys);
    $menuleft_menuData['path']['sys'] = str_replace('//', '/', $str_path_sys);
}
else
{
    $sc_nm_arquivo                                   = explode("/", $_SERVER['PHP_SELF']);
    $menuleft_menuData['path']['sys'] = str_replace("\\", "/", str_replace("\\\\", "\\", getcwd())) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
}
$menuleft_menuData['url']['web']   = $_SERVER['PHP_SELF'];
$menuleft_menuData['url']['web']   = str_replace("\\", '/', $menuleft_menuData['url']['web']);
$menuleft_menuData['path']['root'] = substr($menuleft_menuData['path']['sys'],  0, -1 * strlen($menuleft_menuData['url']['web']));
$menuleft_menuData['path']['app']  = substr($menuleft_menuData['path']['sys'],  0, strrpos($menuleft_menuData['path']['sys'],  '/'));
$menuleft_menuData['path']['link'] = substr($menuleft_menuData['path']['app'],  0, strrpos($menuleft_menuData['path']['app'],  '/'));
$menuleft_menuData['path']['link'] = substr($menuleft_menuData['path']['link'], 0, strrpos($menuleft_menuData['path']['link'], '/')) . '/';
$menuleft_menuData['path']['app'] .= '/';
$menuleft_menuData['url']['app']   = substr($menuleft_menuData['url']['web'],  0, strrpos($menuleft_menuData['url']['web'],  '/'));
$menuleft_menuData['url']['link']  = substr($menuleft_menuData['url']['app'],  0, strrpos($menuleft_menuData['url']['app'],  '/'));
if ($_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] == "S")
{
    $menuleft_menuData['url']['link']  = substr($menuleft_menuData['url']['link'], 0, strrpos($menuleft_menuData['url']['link'], '/'));
}
$menuleft_menuData['url']['link']  .= '/';
$menuleft_menuData['url']['app']   .= '/';

/* Menu items */
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
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Rhino/Sc9_Rhino";
if ($_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] == "S")
{
    $path_apls     = substr($path_apls, 0, strrpos($path_apls, '/'));
}
$path_apls     .= "/";
include("../_lib/lang/". $this->str_lang .".lang.php");
include("../_lib/css/" . $this->str_schema_all . "_menuT.php");
if(isset($pagina_schemamenu) && !empty($pagina_schemamenu) && is_file("../_lib/menuicons/". $pagina_schemamenu .".php"))
{
    include("../_lib/menuicons/". $pagina_schemamenu .".php");
}
include("../_lib/lang/config_region.php");
include("../_lib/lang/lang_config_region.php");
$this->sc_Include($path_lib_php . "/nm_functions.php", "", "") ; 
$this->sc_Include($path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
$this->nm_data = new nm_data("en_us");
if(isset($this->Ini->Nm_lang))
{
    $Nm_lang = $this->Ini->Nm_lang;
}
else
{
    $Nm_lang = $this->Nm_lang;
}
$Str_btn_menu = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
$Str_btn_css  = trim($str_button) . "/" . trim($str_button) . ".css";
include($path_btn . $Str_btn_menu);
if (!function_exists("nmButtonOutput"))
{
   include_once("../_lib/lib/php/nm_gp_config_btn.php");
}
asort($this->Nm_lang_conf_region);
$this->tab_grupo[0] = "projectamo/";
if ($_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] != "S")
{
    $this->tab_grupo[0] = "";
}

    $_SESSION['scriptcase']['menu_atual'] = "menuleft";
    $_SESSION['scriptcase']['menu_apls']['menuleft'] = array();
    if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
    {
        foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
        {
            if (isset($_SESSION['scriptcase']['menuleft']['glo_nm_conexao']) && $_SESSION['scriptcase']['menuleft']['glo_nm_conexao'] == $NM_con_orig)
            {
/*NM*/          $_SESSION['scriptcase']['menuleft']['glo_nm_conexao'] = $NM_con_dest;
            }
            if (isset($_SESSION['scriptcase']['menuleft']['glo_nm_perfil']) && $_SESSION['scriptcase']['menuleft']['glo_nm_perfil'] == $NM_con_orig)
            {
/*NM*/          $_SESSION['scriptcase']['menuleft']['glo_nm_perfil'] = $NM_con_dest;
            }
            if (isset($_SESSION['scriptcase']['menuleft']['glo_con_' . $NM_con_orig]))
            {
                $_SESSION['scriptcase']['menuleft']['glo_con_' . $NM_con_orig] = $NM_con_dest;
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
$this->regionalDefault();
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Rhino/Sc9_Rhino";
$_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
$_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
$_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
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
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
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
            $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
        }
         $$nmgp_var = $nmgp_val;
    }
}
if (isset($script_case_init))
{
    $_SESSION['sc_session'][1]['menuleft']['init'] = $script_case_init;
}
elseif (!isset($_SESSION['sc_session'][1]['menuleft']['init']))
{
    $_SESSION['sc_session'][1]['menuleft']['init'] = "";
}
$script_case_init = $_SESSION['sc_session'][1]['menuleft']['init'];
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
       $$cadapar[0] = $cadapar[1];
       $_SESSION[$cadapar[0]] = $cadapar[1];
       $ix++;
     }
} 
$this->str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Rhino/Sc9_Rhino";
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['menuleft'] = "on";
} 
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['menuleft']) || $_SESSION['scriptcase']['sc_apl_seg']['menuleft'] != "on")
{ 
    $NM_Mens_Erro = $this->Nm_lang['lang_errm_unth_user'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">

    <HTML>
     <HEAD>
      <TITLE></TITLE>
     <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
      <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>      <META http-equiv="Pragma" content="no-cache"/>
      <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuT.css" /> 
      <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuT<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
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
 if(function_exists('set_php_timezone')) set_php_timezone('menuleft'); 
perfil_lib($path_libs);
if (!isset($_SESSION['sc_session'][1]['SC_Check_Perfil']))
{
    if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($path_libs, $_SESSION['scriptcase']['menuleft']['glo_nm_path_prod']);
    $_SESSION['sc_session'][1]['SC_Check_Perfil'] = true;
}
$nm_falta_var    = ""; 
$nm_falta_var_db = ""; 
if (isset($_SESSION['scriptcase']['menuleft']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['menuleft']['glo_nm_conexao']))
{
    db_conect_devel($_SESSION['scriptcase']['menuleft']['glo_nm_conexao'], $str_root . $_SESSION['scriptcase']['menuleft']['glo_nm_path_prod'], 'projectamo', 2); 
}
if (isset($_SESSION['scriptcase']['menuleft']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['menuleft']['glo_nm_perfil']))
{
   $_SESSION['scriptcase']['glo_perfil'] = $_SESSION['scriptcase']['menuleft']['glo_nm_perfil'];
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
       $_SESSION['scriptcase']['menuleft']['SC_sep_date']  = substr($SC_temp, 0, 1); 
       $_SESSION['scriptcase']['menuleft']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
   }
   else
    {
       $_SESSION['scriptcase']['menuleft']['SC_sep_date']  = $SC_temp; 
       $_SESSION['scriptcase']['menuleft']['SC_sep_date1'] = $SC_temp; 
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
        if (isset($_SESSION['sc_session'][1]['menuleft']['sc_outra_jan']) && $_SESSION['sc_session'][1]['menuleft']['sc_outra_jan'])
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
$_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1HQFYH9FGHIrKHQXGDMvmDkFCDWXCVEFGHQBqZ1X7HArYHuXGDMvCHArsDWF/DoJsD9JKDQFaHAveD5NUHgNKDkBOV5FYHMBiHQNmZkFGZ1vOZMJwDMveVkJqH5FYHIBOHQXODQFUHANKD5F7DMBOVcFeDWF/HMF7HQNmZSBqHIBOV5X7HgrKVkJqHEXCHMX7HQJKDQFUD1vOD5F7DMrYDkBsH5B3VEF7HQBiZ1FGZ1vOD5rqDEBOHEFiHEFqDoF7DcJUZSBiHIvsVWFaDMrYZSNiDWF/HIF7HQXGZkFGHAvCV5X7DMvCHArCHEFaHIBqDcXGDuBqD1BOD5F7DMBOVcXKH5XKVEX7HQXOH9BqZ1vmV5X7HgBOHArsH5FYHIJwHQXOZSBiD1vOV5FGHuNOVcFKHEFYVoBqDcBwH9BqDSvOZMJwHgBOHErsH5FYHIraHQNmH9FUD1NKD5F7DMrYVIBsH5XKVoX7HQXGH9BOD1vsV5X7DMvCHErCHEFaHIX7HQXOH9BiD1vOD5F7HgrwV9BUDWFYHMF7HQXOZ1BiD1zGD5rqDEBOHEFiHEFqDoF7DcJUZSFGD1BeV5FGHgrYDkFCDWXCVoB/D9BiZ1F7HIveD5BiHgBeDkB/HEB3DoB/HQFYDQJwHANOV5JwHgrKDkFCDWJeVoB/D9BsZkFUHArKHQraDEBeHEXeDuFYVoB/D9NwZ9rqZ1rwHQBOHgrKVcFCH5XCHIF7DcBqZ1B/DSBeV5FaHgvCZSJGDWB3ZuXGHQXGZSFGHIrwVWXGHuBYDkFCDWJeVoraD9BsH9FaD1vsD5FaDErKZSXeH5FYDoJeD9JKDQFGHAveVWJsHgvsDkBODWFaVoFGDcJUZkFUZ1BOD5rqDEBOHEFiHEFqDoF7DcJUZSFGD1BeV5FGHgrYDkBODur/VoraD9XOH9FaD1rKD5BiHgBOHArsH5BmDoBqHQXODQBqHANKV5BODMvsV9BUDWF/VoJwHQNwVIJsHAvmD5BqHgveHErsDWrGZuBqHQJKDQJsZ1vCV5FGHuNOV9FeDWXCHMraDcBqZSB/Z1NOZMBqHgveHEJqHEXCDoBOD9JKDuFaHArYHQBOHgvsV9FeDWXCDoJsDcBwH9B/Z1rYHQJwHgvCZSXeV5FqVoB/D9XsH9FGHABYD5rqHgrKVcBODWF/VENUHQFYZSFaHArKV5XGDErKHErCDWF/VoBiDcJUZSX7Z1BYHuFaHgrwV9BUDWXKVoF7HQNmZ1BOD1zGD5BOHgveHArsDWX7HMBOHQBiDuBqHAvOVWJsDMNOVIBsV5FGVoFGHQXGZSBqHArKV5FUDMrYZSXeV5FqHIJsHQXsZ9XGD1veV5X7HgrKDkB/H5FqVEX7HQXOVIJsD1rKV5FaDErKVkJ3DWF/VoBiDcJUZSX7Z1BYHuFaHgrKVcFCDWXCVoJwDcBqZSFaHAN7D5FaDEBOVkJGHEXCVoB/HQJKDQJsZ1vCV5FGHuNOV9FeDWB3VoX7HQNmZ1BiHAzGZMXGHgveHErsH5X/DoBOHQXOZSBiHAveD5NUHgNKDkBOV5FYHMBiD9BsH9BqD1rKV5FaHgNKDkB/HEFqHMBOHQFYDQBqHINaV5XGDMNOVcFKHEFYVoJwHQXGZkBiD1rKHQJsHgBeHEFiV5B3DoF7D9XsDuFaHAveHuBiHuzGVIBODWFaDoJsD9XOH9B/DSrYD5JeDEBeZSJGDWFqDoXGHQJKDQJsZ1vCV5FGHuNOV9FeDWB3VEFGHQFYVINUHAvsZMNU";
 $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['menuleft']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['menuleft']['glo_nm_conexao']))
{ 
   $this->Db = db_conect_devel($_SESSION['scriptcase']['menuleft']['glo_nm_conexao'], $str_root . $_SESSION['scriptcase']['menuleft']['glo_nm_path_prod'], 'projectamo'); 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['menuleft']['decimal_db'] = ".";
} 
//
if ((isset($nmgp_outra_jan) && $nmgp_outra_jan == "true") || (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'menuleft'))
{
    $_SESSION['sc_session'][1]['menuleft']['sc_outra_jan'] = true;
     unset($_SESSION['scriptcase']['sc_outra_jan']);
    $_SESSION['scriptcase']['sc_saida_menuleft'] = "javascript:window.close()";
}

/* Menu configuration variables */
$menuleft_menuData['iframe'] = TRUE;

$menuleft_menuData['height'] = '100%';
if (!isset($_SESSION['scriptcase']['sc_apl_seg']))
{
    $_SESSION['scriptcase']['sc_apl_seg'] = array();
}
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("mastertemplate") . "/mastertemplate_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['mastertemplate']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['mastertemplate'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['mastertemplate'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("vmastertemplate") . "/vmastertemplate_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['vmastertemplate']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['vmastertemplate'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['vmastertemplate'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("view_tahapanproject") . "/view_tahapanproject_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['view_tahapanproject']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['view_tahapanproject'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['view_tahapanproject'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("tahapan") . "/tahapan_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['tahapan']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['tahapan'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['tahapan'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("form_add_mitra") . "/form_add_mitra_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_add_mitra']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['form_add_mitra'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['form_add_mitra'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("tabs_lokasi") . "/tabs_lokasi_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['tabs_lokasi']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['tabs_lokasi'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['tabs_lokasi'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("form_statusproject") . "/form_statusproject_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_statusproject']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['form_statusproject'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['form_statusproject'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("form_taskstatus") . "/form_taskstatus_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_taskstatus']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['form_taskstatus'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['form_taskstatus'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("jenisproject") . "/jenisproject_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['jenisproject']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['jenisproject'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['jenisproject'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("project_release") . "/project_release_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['project_release']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['project_release'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['project_release'] = "on";
} 
$sc_teste_seg = file($path_apls . $this->tab_grupo[0] . SC_dir_app_name("f_tahun") . "/f_tahun_ini.txt");
if ((!isset($sc_teste_seg[3]) || trim($sc_teste_seg[3]) == "NAO") || (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N")) 
{
    if (!isset($_SESSION['scriptcase']['sc_apl_seg']['f_tahun']))
    {
        $_SESSION['scriptcase']['sc_apl_seg']['f_tahun'] = "on";
    }
}
if (isset($_SESSION['nm_session']['user']['sec']['flag']) && $_SESSION['nm_session']['user']['sec']['flag'] == "N") 
{ 
    $_SESSION['scriptcase']['sc_apl_seg']['f_tahun'] = "on";
} 

$sOutputBuffer = ob_get_contents();
ob_end_clean();

/* JS files */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?> style="height: 100%">
<head>
 <title>menuleft</title>
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
 <link rel="stylesheet" type="text/css" href="<?php echo $url_third; ?>/jquery_plugin/vakata-jstree/themes/default/style.min.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuT.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->str_schema_all ?>_menuT<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $Str_btn_css ?>" /> 
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery/js/jquery.js"></script>
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery/js/jquery-ui.js"></script>
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery_plugin/vakata-jstree/jstree.min.js"></script>
<script  type="text/javascript" src="<?php echo $url_third; ?>/jquery_plugin/layout/jquery.layout.js"></script>
<style>
   .scTabText {
   }</style>
<script>
var is_menu_vertical = false;
</script>
</head>
<body style="height: 100%" scroll="no" class='scMenuTPage'>
<?php
$str_bmenu = nmButtonOutput($this->arr_buttons, "bmenu", "showMenu();", "showMenu();", "bmenu", "", "" . $this->Nm_lang['lang_btns_menu'] . "", "position:absolute; top:4px; left:2px;z-index:9999;", "absmiddle", "", "0px", $this->path_botoes, "", "" . $this->Nm_lang['lang_btns_menu_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
if($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
    $menu_mobile_hide          = $mobile_menu_mobile_hide;
    $menu_mobile_inicial_state = $mobile_menu_mobile_inicial_state;
    $menu_mobile_hide_onclick  = $mobile_menu_mobile_hide_onclick;
    $menutree_mobile_float     = $mobile_menutree_mobile_float;
    $menu_mobile_hide_icon     = $mobile_menu_mobile_hide_icon;
    $menu_largura              = '250';
}
$str_menu_display = 'false';
$str_menu_display_float = false;
if($menu_mobile_hide == 'S')
{
    if($menu_mobile_inicial_state =='escondido')
    {
            $str_menu_display='true';
            $str_btn_display="show";
    }
    else
    {
            $str_menu_display='false';
            $str_btn_display="hide";
    }
    if($menu_mobile_hide_icon != 'S')
    {
        $str_btn_display="show";
    }
?>
<script>
    $( document ).ready(function() {
        <?php if($_SESSION['scriptcase']['display_mobile'] === true) { ?>
        $('#menu-container').width('250px');
        $('#div_contrl_abas').css('-webkit-overflow-scrolling','touch');
        $('.ui-layout-center').css('-webkit-overflow-scrolling','touch');
        $('#div_contrl_abas').css('overflow','auto');
        $('.ui-layout-center').css('overflow','auto');
        <?php } ?>
        $('#bmenu').<?php echo $str_btn_display; ?>();
        <?php
        if($menu_mobile_hide_icon != 'S')
        {
            ?>
            $('#css3menut').css('margin-top', $('#bmenu').outerHeight());

            <?php
        }
        ?>
        $('#bmenu').css('left', '0px');
        $('#bmenu').css('top', $('.scMenuTHeader').height());
        $('#all_menu').show();
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
            myLayout.toggle('west');
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
            myLayout.toggle('west');
    }
</script>
<?php
echo $str_bmenu;
}
else
{
?>
<script>
    $( document ).ready(function() {
        $('#all_menu').show();
    });
</script>
<?php
}
?>
<?php 
        $NM_scr_iframe = (isset($_POST['hid_scr_iframe'])) ? $_POST['hid_scr_iframe'] : "";   
?> 

        <script  type="text/javascript">
                        var myLayout; // a var is required because this page utilizes: myLayout.allowOverflow() method
                        $(document).ready(function () {
                                myLayout = $('body').layout({
                                west__size: <?php echo $menu_largura;?>
                                        ,west__showOverflowOnHover : false
                                        ,east__showOverflowOnHover : false
                                        ,north__slidable           : false
                                        ,north__resizable          : false
                                        ,north__closable           : false
                                        ,north__spacing_open       : 0
                                        ,north__spacing_closed     : 0
                                        ,south__slidable           : false
                                        ,south__resizable          : false
                                        ,south__closable           : false
                                        ,south__spacing_open       : 0
                                        ,south__spacing_closed     : 0
                                        ,west__resizable           : false
                                        ,west__spacing_open        : 0
                                        ,west__spacing_closed      : 0
                                        ,east__resizable           : false
                                        ,east__spacing_open        : 0
                                        ,east__spacing_closed      : 0
                                        ,west__initClosed          : <?php echo $str_menu_display; ?>
                                        ,east__initClosed          : <?php echo $str_menu_display; ?>
                                
                                });
                                $('#css3menut').jstree({
                                        
                                        'plugins' : [ 'wholerow']
                                  }).on("select_node.jstree",function(e, data) {
                                      str_link   = '';
                                      str_target = '';
                                      if(data.instance.is_leaf(data.node))
                                      {
                                        str_link   = data.node.a_attr.href;
                                        str_target = data.node.a_attr.target;
                                      }
                                      else
                                      {
                                        data.instance.toggle_node(data.node);
                                        str_link   = $('#' + data.node.id + ' > a > span > a').attr('href');
                                        str_target = $('#' + data.node.id + ' > a > span > a').attr('target');
                                      }

                                      //test link type
                                      if(str_link != '' && str_target != '')
                                      {
                                          if(str_link.substring(0, 11) == 'javascript:')
                                          {
                                            eval(str_link.substring(11));
                                          }
                                          else if(str_link != '#')
                                          {
                                            if(str_target == '_parent')
                                            {
                                                            str_target = '_self';
                                            }
                                            window.open(str_link, str_target);
                                          }
                                          <?php
                                          if($menu_mobile_hide == 'S' && $menu_mobile_hide_onclick=='S')
                                          {
                                          ?>
                                            if(typeof data.node.a_attr.onclick == 'undefined') {
                                                HideMenu();
                                            }
                                          <?php
                                          }
                                          ?>
                                      }
                                });
                                $('#css3menut').jstree().open_all();
                         });
                </script>
<script type="text/javascript">
var numl = 0;
var toBeHidden = 0;
function NM_show_menu()
{
   return true;
}
function NM_hide_menu()
{
   return true;
}
</script>

<style type="text/css">

        .ui-layout-pane { /* all 'panes' */
                        border: 0px solid #BBB;
                        padding: 0px;
                        overflow: auto;
        }
        .ui-layout-resizer { /* all 'resizer-bars' */
                        background: #DDD;
        }

        .ui-layout-toggler { /* all 'toggler-buttons' */
                        background: #AAA;
        }
        </style>
<?php

 $nm_var_lab[0] = "Master";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[0]))
{
    $nm_var_lab[0] = sc_convert_encoding($nm_var_lab[0], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[1] = "Template Project";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[1]))
{
    $nm_var_lab[1] = sc_convert_encoding($nm_var_lab[1], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[2] = "Tahapan Project";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[2]))
{
    $nm_var_lab[2] = sc_convert_encoding($nm_var_lab[2], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[3] = "Detail Task Project";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[3]))
{
    $nm_var_lab[3] = sc_convert_encoding($nm_var_lab[3], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[4] = "Param Project";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[4]))
{
    $nm_var_lab[4] = sc_convert_encoding($nm_var_lab[4], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[5] = "Mast. Tahapan Project";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[5]))
{
    $nm_var_lab[5] = sc_convert_encoding($nm_var_lab[5], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[6] = "Data Mitra";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[6]))
{
    $nm_var_lab[6] = sc_convert_encoding($nm_var_lab[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[7] = "Param Lokasi";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[7]))
{
    $nm_var_lab[7] = sc_convert_encoding($nm_var_lab[7], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[8] = "Status Project";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[8]))
{
    $nm_var_lab[8] = sc_convert_encoding($nm_var_lab[8], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[9] = "Status Task Tahapan";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[9]))
{
    $nm_var_lab[9] = sc_convert_encoding($nm_var_lab[9], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[10] = "Jenis";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[10]))
{
    $nm_var_lab[10] = sc_convert_encoding($nm_var_lab[10], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[11] = "Release";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[11]))
{
    $nm_var_lab[11] = sc_convert_encoding($nm_var_lab[11], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[12] = "Tahun";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[12]))
{
    $nm_var_lab[12] = sc_convert_encoding($nm_var_lab[12], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_lab[13] = "Exit";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_lab[13]))
{
    $nm_var_lab[13] = sc_convert_encoding($nm_var_lab[13], $_SESSION['scriptcase']['charset'], "UTF-8");
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
 $nm_var_hint[6] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[6]))
{
    $nm_var_hint[6] = sc_convert_encoding($nm_var_hint[6], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[7] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[7]))
{
    $nm_var_hint[7] = sc_convert_encoding($nm_var_hint[7], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[8] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[8]))
{
    $nm_var_hint[8] = sc_convert_encoding($nm_var_hint[8], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[9] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[9]))
{
    $nm_var_hint[9] = sc_convert_encoding($nm_var_hint[9], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[10] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[10]))
{
    $nm_var_hint[10] = sc_convert_encoding($nm_var_hint[10], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[11] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[11]))
{
    $nm_var_hint[11] = sc_convert_encoding($nm_var_hint[11], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[12] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[12]))
{
    $nm_var_hint[12] = sc_convert_encoding($nm_var_hint[12], $_SESSION['scriptcase']['charset'], "UTF-8");
}
 $nm_var_hint[13] = "";
if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($nm_var_hint[13]))
{
    $nm_var_hint[13] = sc_convert_encoding($nm_var_hint[13], $_SESSION['scriptcase']['charset'], "UTF-8");
}

$saida_apl = $_SESSION['scriptcase']['sc_saida_menuleft'];
$menuleft_menuData['data'] = array();
$nextLevelToBeWrite = false;
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$menuleft_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[0] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[0] . "",
    'id'       => "item_3",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
    'sc_id'    => "item_3",
    'disabled' => $str_disabled,
);
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_4&sc_apl_menu=mastertemplate&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['mastertemplate']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['mastertemplate']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[1] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[1] . "",
        'id'       => "item_4",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_4",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_1&sc_apl_menu=vmastertemplate&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['vmastertemplate']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['vmastertemplate']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[2] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[2] . "",
        'id'       => "item_1",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_1",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_2&sc_apl_menu=view_tahapanproject&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['view_tahapanproject']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['view_tahapanproject']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['cons']['active']))
    {
        $icon_aba = $arr_menuicons['cons']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['cons']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['cons']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[3] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[3] . "",
        'id'       => "item_2",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_2",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "#";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
if($this->force_mobile || ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
{
$str_link = "#";
}
$menuleft_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[4] . "",
    'level'    => "0",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[4] . "",
    'id'       => "item_17",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
    'sc_id'    => "item_17",
    'disabled' => $str_disabled,
);
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_21&sc_apl_menu=tahapan&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['tahapan']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['tahapan']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[5] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[5] . "",
        'id'       => "item_21",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_21",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_5&sc_apl_menu=form_add_mitra&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_add_mitra']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_add_mitra']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[6] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[6] . "",
        'id'       => "item_5",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_5",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_12&sc_apl_menu=tabs_lokasi&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['tabs_lokasi']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['tabs_lokasi']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['aba']['active']))
    {
        $icon_aba = $arr_menuicons['aba']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['aba']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['aba']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[7] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[7] . "",
        'id'       => "item_12",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_12",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_18&sc_apl_menu=form_statusproject&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_statusproject']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_statusproject']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[8] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[8] . "",
        'id'       => "item_18",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_18",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_22&sc_apl_menu=form_taskstatus&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['form_taskstatus']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['form_taskstatus']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[9] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[9] . "",
        'id'       => "item_22",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_22",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_19&sc_apl_menu=jenisproject&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['jenisproject']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['jenisproject']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[10] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[10] . "",
        'id'       => "item_19",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_19",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_20&sc_apl_menu=project_release&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['project_release']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['project_release']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[11] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[11] . "",
        'id'       => "item_20",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_20",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "menuleft_form_php.php?sc_item_menu=item_24&sc_apl_menu=f_tahun&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "";
if (!isset($_SESSION['scriptcase']['sc_apl_seg']['f_tahun']) || strtolower($_SESSION['scriptcase']['sc_apl_seg']['f_tahun']) != "on")
{
    $str_link = "#";
    $str_disabled = "Y";
}
    $str_icon = "";
    $icon_aba = "";
    $icon_aba_inactive = "";
    if(empty($icon_aba) && isset($arr_menuicons['form']['active']))
    {
        $icon_aba = $arr_menuicons['form']['active'];
    }
    if(empty($icon_aba_inactive) && isset($arr_menuicons['form']['inactive']))
    {
        $icon_aba_inactive = $arr_menuicons['form']['inactive'];
    }
    $menuleft_menuData['data'][] = array(
        'label'    => "" . $nm_var_lab[12] . "",
        'level'    => "1",
        'link'     => $str_link,
        'hint'     => "" . $nm_var_hint[12] . "",
        'id'       => "item_24",
        'icon'     => $str_icon,
        'icon_aba' => $icon_aba,
        'icon_aba_inactive' => $icon_aba_inactive,
        'target'   => " target=\"" . $this->menuleft_target('_self') . "\"",
        'sc_id'    => "item_24",
        'disabled' => $str_disabled,
    );
$str_disabled = "N";
$str_link = "$saida_apl";
$str_icon = "";
$icon_aba = "";
$icon_aba_inactive = "";
if(empty($icon_aba) && isset($arr_menuicons['others']['active']))
{
    $icon_aba = $arr_menuicons['others']['active'];
}
if(empty($icon_aba_inactive) && isset($arr_menuicons['others']['inactive']))
{
    $icon_aba_inactive = $arr_menuicons['others']['inactive'];
}
$menuleft_menuData['data'][] = array(
    'label'    => "" . $nm_var_lab[13] . "",
    'level'    => "1",
    'link'     => $str_link,
    'hint'     => "" . $nm_var_hint[13] . "",
    'id'       => "item_23",
    'icon'     => $str_icon,
    'icon_aba' => $icon_aba,
    'icon_aba_inactive' => $icon_aba_inactive,
    'target'   => " target=\"" . $this->menuleft_target('_parent') . "\"",
    'sc_id'    => "item_23",
    'disabled' => $str_disabled,
);

if (isset($_SESSION['scriptcase']['sc_def_menu']['menuleft']))
{
    $arr_menu_usu = $this->nm_arr_menu_recursiv($_SESSION['scriptcase']['sc_def_menu']['menuleft']);
    $this->nm_gera_menus($str_menu_usu, $arr_menu_usu, 1, 'menuleft');
    $menuleft_menuData['data'] = $str_menu_usu;
}
if (is_file("menuleft_help.txt"))
{
    $Arq_WebHelp = file("menuleft_help.txt"); 
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
                if(empty($icon_aba) && isset($arr_menuicons['']['active']))
                {
                    $icon_aba = $arr_menuicons['']['active'];
                }
                if(empty($icon_aba_inactive) && isset($arr_menuicons['']['inactive']))
                {
                    $icon_aba_inactive = $arr_menuicons['']['inactive'];
                }
                $menuleft_menuData['data'][] = array(
                    'label'    => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'level'    => "0",
                    'link'     => $str_link,
                    'hint'     => "" . $this->Nm_lang['lang_btns_help_hint'] . "",
                    'id'       => "item_Help",
                    'icon'     => $str_icon,
                    'icon_aba' => $icon_aba,
                    'icon_aba_inactive' => $icon_aba_inactive,
                    'target'   => "" . $this->menuleft_target('_blank') . "",
                    'sc_id'    => "item_Help",
                    'disabled' => $str_disabled,
                );
            }
        }
    }
}

if (isset($_SESSION['scriptcase']['sc_menu_del']['menuleft']) && !empty($_SESSION['scriptcase']['sc_menu_del']['menuleft']))
{
    $nivel = 0;
    $exclui_menu = false;
    foreach ($menuleft_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_del']['menuleft']))
       {
          $nivel = $cada_menu['level'];
          $exclui_menu = true;
          unset($menuleft_menuData['data'][$i_menu]);
       }
       elseif ( empty($cada_menu) || ($exclui_menu && $nivel < $cada_menu['level']))
       {
          unset($menuleft_menuData['data'][$i_menu]);
       }
       else
       {
          $exclui_menu = false;
       }
    }
    $Temp_menu = array();
    foreach ($menuleft_menuData['data'] as $i_menu => $cada_menu)
    {
        $Temp_menu[] = $cada_menu;
    }
    $menuleft_menuData['data'] = $Temp_menu;
}

if (isset($_SESSION['scriptcase']['sc_menu_disable']['menuleft']) && !empty($_SESSION['scriptcase']['sc_menu_disable']['menuleft']))
{
    $disable_menu = false;
    foreach ($menuleft_menuData['data'] as $i_menu => $cada_menu)
    {
       if (in_array($cada_menu['id'], $_SESSION['scriptcase']['sc_menu_disable']['menuleft']))
       {
          $nivel = $cada_menu['level'];
          $disable_menu = true;
          $menuleft_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu) && $disable_menu && $nivel < $cada_menu['level'])
       { 
          $menuleft_menuData['data'][$i_menu]['disabled'] = 'Y';
       }
       elseif (!empty($cada_menu))
       {
          $disable_menu = false;
       }
    }
}

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
if ('' != $sOutputBuffer)
{
    echo "<div class=\"ui-layout-north\">" . $sOutputBuffer . "</div>";
}
?>
<?php
    $_SESSION['scriptcase']['menuleft']['apl_inicial'] = ($NM_scr_iframe != "") ? $NM_scr_iframe : "menuleft_pag_ini.php";
    $_SESSION['scriptcase']['menuleft']['path_link'] = $path_link;
?>
<div class="ui-layout-west">
<table id="main_menutree_table" cellspacing=0 cellpadding=0 class="scMenuTTable" style="height: 100%; width: 100%">
    <tr class="scMenuTTable">
        <td class="scMenuTTableM" valign="top">
                <table cellpadding=0 cellspacing=0>
                    <tr>
                       <td id="all_menu" style="display: none;">
                      <?php
                      echo $this->menuleft_escreveMenu($menuleft_menuData['data']);
                      ?>
                            </td>
                    </tr>
                </table>
        </td>
      </tr>
    </table>
</div>
<div class="ui-layout-center">
  <table cellspacing=0 cellpadding=0 style="height: 100%; width: 100%" cellpadding=0 cellspacing=0>
    <tr>
      
        <td id="Iframe_control" style="border: 0px; height: 100%; width:100%; vertical-align:top;text-align:center;padding: 0px">
        <iframe name="menuleft_iframe" id="iframe_menuleft" frameborder="0" class="scMenuIframe" style="width: 100%; height: 100%;" src="<?php echo $_SESSION['scriptcase']['menuleft']['apl_inicial']?>"></iframe>
      </tr>
    </table>
</div>
<script type="text/javascript">
 function nm_out_menu(link)
 {
    if (link == 'javascript:window.close()')
    {
        window.close();
    }
    else
    {
        window.location = (link);
    }
 }

function expandMenu()
{
    myLayout.toggle('west');

    $('#id_expand').hide();
    $('#id_collapse').show();
}

function collapseMenu()
{
    myLayout.toggle('west');

    $('#id_expand').show();
    $('#id_collapse').hide();
}
Iframe_atual = "menuleft_iframe";
</script>
</body>
</html>
<?php
}
/* Target control */
function menuleft_escreveMenu($arr_menu)
{
    $aMenuItemList = array();
    foreach ($arr_menu as $ind => $resto)
    {
        $aMenuItemList[] = $resto;
    }
?>
<div id="css3menut">
    <ul>
        <?php
            for ($i = 0; $i < sizeof($aMenuItemList); $i++) {
            ?>
            
            <?php
                if ('' != $aMenuItemList[$i]['icon'] && file_exists($this->path_imag_apl . "/" . $aMenuItemList[$i]['icon'])) {
                    $iconHtml = 'data-jstree=\'{ "icon" : "../_lib/img/'. $aMenuItemList[$i]['icon'] .'" }\'';
                }
                else {
                    $iconHtml = '';
                }
                $sDisabledClass = '';
                if ('Y' == $aMenuItemList[$i]['disabled']) {
                    $aMenuItemList[$i]['link']   = '#';
                    $aMenuItemList[$i]['target'] = '';
                    $sDisabledClass               = 0 == $aMenuItemList[$i]['level'] ? ' scMenuTItemDisabled' : ' scMenuTSubItemDisabled';
                }
                if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] < $aMenuItemList[$i + 1]['level']) {
                  if ($aMenuItemList[$i]['link'] == '#')
                  {
                  ?>
                     <li <?php echo $iconHtml; ?>><span class="scMenuTItems<?php echo $sDisabledClass; ?>"><?php echo $aMenuItemList[$i]['label']; ?></span><ul>
                  <?php
                  }
                  else
                  {
                  ?>
                     <li <?php echo $iconHtml; ?>><span class="scMenuTItems scMenuTItem"><a href="<?php echo $aMenuItemList[$i]['link']; ?>" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>"<?php echo $aMenuItemList[$i]['target']; ?> class="scMenuTItem"><?php echo $aMenuItemList[$i]['label']; ?></a></span><ul>
                  <?php
                  }
                }
                else
                {
                  if ($aMenuItemList[$i]['link'] == '#')
                  {
                    ?>
                    <li <?php echo $iconHtml; ?> class="scMenuTItems<?php echo $sDisabledClass; ?>"><a href='#' target=''><?php echo $aMenuItemList[$i]['label']; ?></a>
                    <?php
                  }
                  else
                  {
                    ?>
                    <li <?php echo $iconHtml; ?> class="scMenuTItems scMenuTItem"><a href="<?php echo $aMenuItemList[$i]['link']; ?>" id="<?php echo $aMenuItemList[$i]['id']; ?>" title="<?php echo $aMenuItemList[$i]['hint']; ?>"<?php echo $aMenuItemList[$i]['target']; ?> class="scMenuTItem"><?php echo $aMenuItemList[$i]['label']; ?></a>
                    <?php
                  }
                }
                if ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == $aMenuItemList[$i + 1]['level']) {
                ?>
                    </li>
                <?php
                }
                elseif ($aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > $aMenuItemList[$i + 1]['level']) {
                ?>
                    </li><?php echo str_repeat('</ul></li>', $aMenuItemList[$i]['level'] - $aMenuItemList[$i + 1]['level']); ?>
                <?php
                }
                elseif (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] > 0) {
                ?>
                    </li><?php echo str_repeat('</ul></li>', $aMenuItemList[$i]['level']); ?>
                <?php
                }
                elseif (!$aMenuItemList[$i + 1] && $aMenuItemList[$i]['level'] == 0) {
                ?>
                    </li>
                <?php
                }
            }
        ?>
    </ul>
</div>
<?php
}
/* Target control */
   function menuleft_target($str_target)
   {
       global $menuleft_menuData;
       if ('_blank' == $str_target)
       {
           return '_blank';
       }
       elseif ('_parent' == $str_target)
       {
           return '_parent';
       }
       elseif ($menuleft_menuData['iframe'])
       {
           return 'menuleft_iframe';
       }
       else
       {
           return $str_target;
       }
   }

   function nm_prot_aspas($str_item)
   {
       return str_replace('"', '\"', $str_item);
   }

   function nm_gera_menus(&$str_line_ret, $arr_menu_usu, $int_level, $nome_aplicacao)
   {
       global $menuleft_menuData; 
       $str_marg = str_repeat('&nbsp;', 2);
       $str_marg = '';
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
                    $str_line['link'] = "javascript:parent.nm_out_menu('menuleft_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . "')";  
               }
               else
               {
                    $str_line['link'] = "menuleft_form_php.php?sc_item_menu=" . $arr_item['id'] . "&sc_apl_menu=" . $nome_apl . "&sc_apl_link=" . urlencode($menuleft_menuData['url']['link']) . "&sc_usa_grupo=" . $_SESSION['scriptcase']['menuleft']['glo_nm_usa_grupo'] . ""; 
               }
           }
           elseif ($arr_item['target'] == '_parent')
           {
               $str_line['link'] = "javascript:parent.nm_out_menu('" . $_SESSION['scriptcase']['sc_saida_menuleft'] . "')"; 
           }
           $str_line['hint']     = ('' != $arr_item['hint']) ? $this->nm_prot_aspas($arr_item['hint']) : '';
           $str_line['id']       = $arr_item['id'];
           $str_line['icon']     = ('' != $arr_item['icon_on']) ? $arr_item['icon_on'] : '';
           $str_line['icon_aba'] = (isset($arr_item['icon_aba']) && !empty($arr_item['icon_aba'])) ? $arr_item['icon_aba'] : '';
           $str_line['icon_aba_inactive'] = (isset($arr_item['icon_aba_inactive']) && !empty($arr_item['icon_aba_inactive'])) ? $arr_item['icon_aba_inactive'] : '';
           if ('' == $arr_item['link'] && $arr_item['target'] == '_parent')
           {
               $str_line['target'] = '_parent';
           }
           else
           {
                $str_line['target'] = ('' != $arr_item['target'] && '' != $arr_item['link']) ?  $this->menuleft_target( $arr_item['target']) : "_self"; 
           }
           $str_line['target']   = ' target="' . $str_line['target']  . '" ';
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
   function Gera_sc_init($apl_menu)
   {
        $_SESSION['scriptcase']['menuleft']['sc_init'][$apl_menu] = 1;
        return  1;
   }
function sc_logged($user, $ip = '')
	{
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'on';
               
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
$this->nmgp_redireciona_form($_SESSION['scriptcase']['sc_apl_menu_link'] . $this->tab_grupo[0] . "" . SC_dir_app_name('app_logged') . "/", "menuleft_form_php.php", "user?#?" . $user . "?@?","_self", 440, 630);
 };
			return false;
		}
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'off';
}
function sc_verify_logged()
	{
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'on';
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
$this->nmgp_redireciona_form($_SESSION['scriptcase']['sc_apl_menu_link'] . $this->tab_grupo[0] . "" . SC_dir_app_name('app_Login') . "/", "menuleft_form_php.php", "","_parent", 440, 630);
 };
		}
if (isset($this->sc_temp_logged_user)) {$_SESSION['logged_user'] = $this->sc_temp_logged_user;}
if (isset($this->sc_temp_logged_date_login)) {$_SESSION['logged_date_login'] = $this->sc_temp_logged_date_login;}
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'off';
}
function sc_logged_in($user, $ip = '')
	{
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'on';
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
             echo "<br>APL: menuleft";
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
             echo "<br>APL: menuleft";
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
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'off';
}
function sc_logged_in_fail($user, $ip = '')
    {
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'on';
               
        $ip = ($ip == '') ? $_SERVER['REMOTE_ADDR'] : $ip;
        $str_sql = "INSERT INTO SEC_LOGGED(LOGIN, DATE_LOGIN, SC_SESSION, IP) VALUES ('" . $user . "', '" . microtime(true) . "', '_SC_FAIL_SC_', '" . $ip . "')";
        
     $nm_select = $str_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             echo $this->Nm_lang['lang_errm_dber'] . ": " . $this->Db->ErrorMsg();
             echo "<br>APL: menuleft";
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
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'off';
}
function sc_logged_is_blocked($ip = '')
    {
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'on';
               
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
             echo "<br>APL: menuleft";
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
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'off';
}
function sc_logged_out($user, $date_login = '')
	{
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'on';
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
             echo "<br>APL: menuleft";
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
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'off';
}
function sc_looged_check_logout()
    {
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'on';
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
$_SESSION['scriptcase']['menuleft']['contr_erro'] = 'off';
}
   function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $alt_modal=0, $larg_modal=0)
   {
      global  $menuleft_menuData;
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
                  $tmp_parms .= $_SESSION['sc_session'][1]['menuleft'][substr($val, 1, -1)];
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
          $nm_apl_dest = $menuleft_menuData['url']['link'] . $this->tab_grupo[0] . $nm_apl_dest . "/" . $nm_apl_dest . ".php";
      }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">

      <HTML>
      <HEAD>
       <META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
       <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
       <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
       <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
       <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
       <META http-equiv="Pragma" content="no-cache"/>
       <?php
       if ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
       {
               ?>
               <meta name='viewport' content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' />
               <?php
       }
       ?>
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
$contr_menuleft = new menuleft_class;
$contr_menuleft->menuleft_menu();

?>
