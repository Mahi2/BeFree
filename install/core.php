<?php
@session_start();

include_once "settings.inc.php";

// Returns language key
function lang_key($key)
{
    global $arrLang;
    $output = "";

    if (isset($arrLang[$key])) {
        $output = $arrLang[$key];
    } else {
        $output = str_replace("_", " ", $key);
    }
    return $output;
}

include_once "languages.inc.php";

if (file_exists(CONFIG_FILE_PATH)) {
    echo '<meta http-equiv="refresh" content="0; url=../" />';
    exit;
}

function head()
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BeFree - <?php
    echo lang_key("installation_wizard");
?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <meta charset="utf-8">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" media="screen">
    <link type="text/css" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <br /><center><h2><i class="fab fa-get-pocket"></i> BeFree - <?php
    echo lang_key("installation_wizard");
?></h2></center><br />
                        <div class="jumbotron">
<?php
}

function footer()
{
?>
                        </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
