<!DOCTYPE html>
<?php
session_start();
require_once '../testAdminContentInterface/htmlbuildHelper.php';
$extrascipt=" \r\n function showImageBig(id){"
             ."\r\n window.location = document.getElementById(id).src;"
             ."\r\n }";
getHeaderExtraScript($extrascipt);
getNormalBodyTop();
$password = filter_input(INPUT_POST , "staffkey");
if($password == "unreal" || $_SESSION['screen_rights'] = "true" ) {
$_SESSION['screen_rights'] = "true";
// wo die screenshots sind
$dir_path = "."; 
// Welche Dateien angezeigt werden sollen
$extensions_array = array('jpg','png','jpeg','png','gif');
echo "
		<form action=\"logout.php\" method=\"post\">
			<input id=\"logout\" type=\"submit\" value=\"Logout\">
		</form>

		<div class=\"picture\"> 
                <table border='1'>
";
if(is_dir($dir_path))
{
    $files = scandir($dir_path);
    
    for($i = 0; $i < sizeof($files); $i++)
    {
        if($files[$i] !='.' && $files[$i] !='..')
        {
            // get file name
           // echo "File Name -> $files[$i]<br>";
            
            // get file extension
            $file = pathinfo($files[$i]);
            if(isset($file['extension'])){
            $extension = $file['extension'];
            }
          //  echo "File Extension-> $extension<br>";
            
           // check file extension
            if(isset($extension) && in_array($extension, $extensions_array) && $extension != "")
            {
            echo "
			<tr><td width='".  getimagesize($files[$i])[0] / 100 * 10."px'><img id='$i' src='$files[$i]' style='width:10%; height:10%;' onclick='showImageBig($i);'></button></td></tr>";
			
            }
        }
    }
}
echo " </table>
		</div> 
	</body>
</html>";
}
else {
	echo "
		<div id=\"error\">
			<h1>Du hast keinen Zugriff auf dieses Verzeichnis.</h1></br>
			<h2>Bitte gebe das Passwort ein.</h2>
			<form action='' method=\"post\">
				<input type=\"text\" name=\"staffkey\">
				<input type=\"submit\" value=\"Login\">
			</form>
		</div>
	</body>
</html>


";
}
 ?>