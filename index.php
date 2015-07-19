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
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>FruityWifi</title>
<script src="../js/jquery.js"></script>
<script src="../js/jquery-ui.js"></script>
<link rel="stylesheet" href="../css/jquery-ui.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../../../style.css" />

<script>
$(function() {
    $( "#action" ).tabs();
    $( "#result" ).tabs();
});

</script>

</head>
<body>

<? include "../menu.php"; ?>

<br>

<?

include "../../config/config.php";
include "_info_.php";
include "../../login_check.php";
include "../../functions.php";

// Checking POST & GET variables...
if ($regex == 1) {
    regex_standard($_POST["newdata"], "msg.php", $regex_extra);
    regex_standard($_GET["logfile"], "msg.php", $regex_extra);
    regex_standard($_GET["action"], "msg.php", $regex_extra);
    regex_standard($_POST["service"], "msg.php", $regex_extra);
}

$newdata = $_POST['newdata'];
$logfile = $_GET["logfile"];
$action = $_GET["action"];
$tempname = $_GET["tempname"];
$service = $_POST["service"];

include "includes/options_config.php";

?>

<div class="rounded-top" align="left"> &nbsp; <b><?=$mod_alias?></b> </div>
<div class="rounded-bottom" >

    &nbsp;&nbsp;version <?=$mod_version?><br>
    <? 
    if (file_exists( $bin_pand )) { 
        echo "&nbsp;$mod_alias <font style='color:lime'>installed</font><br>";
    } else {
        echo "&nbsp;$mod_alias <a href='includes/module_action.php?install=install_$mod_name' style='color:red'>install</a><br>";
    } 
    ?>
    
    <?
	
    $ismoduleup = exec($mod_isup);
    $isAgentUp = exec($mod_agentisup);
	$ss_mode = "run";
	
    if ($ismoduleup != "")
	{
        echo "&nbsp;$mod_alias  <font color=\"lime\"><b>enabled</b></font>.&nbsp; | <a href=\"includes/module_action.php?service=$ss_mode&action=stop&page=module\"><b>stop</b></a> | ";
        
		if($isAgentUp)
			echo "<a href=\"includes/module_action.php?service=$ss_mode&action=stop_pair&page=module\"><b>stop pairing</b></a>";
		else
			echo "<a href=\"includes/module_action.php?service=$ss_mode&action=pair&page=module\"><b>pair</b></a>";
		
		echo "<input type='hidden' name='action' value='stop'>";
        echo "<input type='hidden' name='page' value='module'>";
    }
	else
	{ 
        echo "&nbsp;$mod_alias  <font color=\"red\"><b>disabled</b></font>. | <a href=\"includes/module_action.php?service=$ss_mode&action=start&page=module\"><b>start</b></a> | "; 
        
		if($isAgentUp)
			echo "<a href=\"includes/module_action.php?service=$ss_mode&action=stop_pair&page=module\"><b>stop pairing</b></a>";
		else
			echo "<a href=\"includes/module_action.php?service=$ss_mode&action=pair&page=module\"><b>pair</b></a>";
		
		echo "<input type='hidden' name='action' value='start'>";
        echo "<input type='hidden' name='page' value='module'>";
    }
    ?>

</div>

<br>


<div id="msg" style="font-size:largest;">
Loading, please wait...
</div>

<div id="body" style="display:none;">


    <div id="result" class="module">
        <ul>
            <li><a href="#result-1">Setup</a></li>
            <li><a href="#result-2">About</a></li>
        </ul>
        
        <!-- SETUP -->
        
        <div id="result-1">
            <form method="POST" autocomplete="off" action="includes/save.php">
                <div class="module-options">
                    <table>
                        <tr>
                            <td>MAC: </td>
                            <td><input name="bluepand_mac" maxlength="23" style="width: 200px" value="<?=$bluepand_mac?>"></td>
                        </tr>
                        <tr>
                            <td>KeyPass: </td>
                            <td><input name="bluepand_keypass" maxlength="23" style="width: 200px" value="<?=$bluepand_keypass?>"></td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" value="save">
                                <input name="type" type="hidden" value="settings">
                            </td>
                        </tr>
                    </table>
                </div> 
            </form>
        </div>

        <!-- END SETUP -->

        <!-- ABOUT -->

        <div id="result-2" class="history">
            <? include "includes/about.php"; ?>
        </div>

        <!-- END ABOUT -->
        
    </div>

    <div id="loading" class="ui-widget" style="width:100%;background-color:#000; padding-top:4px; padding-bottom:4px;color:#FFF">
        Loading...
    </div>

    <script>
    $('#formLogs').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/ajax.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#output').html('');
                $.each(data, function (index, value) {
                    $("#output").append( value ).append("\n");
                });
                
                $('#loading').hide();
            }
        });
        
        $('#output').html('');
        $('#loading').show()

    });

    $('#loading').hide();

    </script>

    <script>
    $('#form1').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/ajax.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#output').html('');
                $.each(data, function (index, value) {
                    if (value != "") {
                        $("#output").append( value ).append("\n");
                    }
                });
                
                $('#loading').hide();

            }
        });
        
        $('#output').html('');
        $('#loading').show()

    });

    $('#loading').hide();

    </script>

    <?
    if ($_GET["tab"] == 1) {
        echo "<script>";
        echo "$( '#result' ).tabs({ active: 1 });";
        echo "</script>";
    } else if ($_GET["tab"] == 2) {
        echo "<script>";
        echo "$( '#result' ).tabs({ active: 2 });";
        echo "</script>";
    }
    ?>

</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#body').show();
    $('#msg').hide();
});
</script>

</body>
</html>
