<?

$mod_name="bluepand";
$mod_version="1.0";
$mod_path="/usr/share/fruitywifi/www/modules/$mod_name";
$mod_panel="show";
$bin_pand = "/usr/bin/pand";
$bin_pand_name = "pand";
$mod_alias="Blue Pand";
$mod_type="service";
# EXEC
$bin_danger = "/usr/share/fruitywifi/bin/danger";
$bin_sudo = "/usr/bin/sudo";
$bin_sh = "/bin/sh";
$bin_echo = "/bin_echo";
$bin_killall = "/usr/bin/killall";
$bin_cp = "/bin/cp";
$bin_chmod = "/bin/chmod";
$bin_sed = "/bin/sed";
$bin_rm = "/bin/rm";
$mod_isup="ps auxww | grep $bin_pand | grep -v -e 'grep $bin_pand'";
?>
