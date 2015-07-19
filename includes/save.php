<? 
/*
	Copyright (C) 2013-2015 xtr4nge [_AT_] gmail.com
	Module BluePand created by @AnguisCaptor

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 
?>
<?

include "../../../config/config.php";
include "../_info_.php";
include "../../../login_check.php";
include "../../../functions.php";

include "options_config.php";

// Checking POST & GET variables...
if ($regex == 1) {
	regex_standard($_POST['type'], "../../../msg.php", $regex_extra);
	regex_standard($_POST['bluepand_mac'], "../../../msg.php", $regex_extra);
	regex_standard($_POST['bluepand_keypass'], "../../../msg.php", $regex_extra);
}

$type = $_POST['type'];
$bluepand_mac = $_POST["bluepand_mac"];
$bluepand_keypass = $_POST["bluepand_keypass"];

if ($type == "settings") {

    $exec = "/bin/sed -i 's/bluepand_mac.*/bluepand_mac = \\\"".$bluepand_mac."\\\";/g' options_config.php";
    $output = exec_fruitywifi($exec);

	$exec = "/bin/sed -i 's/bluepand_keypass.*/bluepand_keypass = \\\"".$bluepand_keypass."\\\";/g' options_config.php";
    $output = exec_fruitywifi($exec);
	
    header('Location: ../index.php?tab=0');
    exit;

}

header('Location: ../index.php');

?>
