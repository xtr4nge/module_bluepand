<?

//include "../login_check.php";
include "../../../config/config.php";
include "../_info_.php";
include "../../../functions.php";

include "options_config.php";

// Checking POST & GET variables...
if ($regex == 1) {
	regex_standard($_POST['type'], "../../../msg.php", $regex_extra);
	regex_standard($_POST['bluepand_mac'], "../../../msg.php", $regex_extra);
}

$type = $_POST['type'];
$bluepand_mac = $_POST["bluepand_mac"];

if ($type == "settings") {

    $exec = "/bin/sed -i 's/bluepand_mac.*/bluepand_mac = \\\"".$_POST["bluepand_mac"]."\\\";/g' options_config.php";
    //exec("$bin_danger \"" . $exec . "\"", $output); //DEPRECATED
    $output = exec_fruitywifi($exec);
	
    header('Location: ../index.php?tab=0');
    exit;

}

header('Location: ../index.php');

?>
