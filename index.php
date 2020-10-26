<?php
ob_start();
session_start();

require './_app/Config.inc.php';

//CHANCE THEME IN SESSION
$THEME = filter_input(INPUT_GET, "theme", FILTER_DEFAULT);
if ($THEME && $THEME != 'null'):
    $_SESSION['WC_THEME'] = $THEME;
    header("Location: " . BASE);
    exit;
elseif ($THEME && $THEME == 'null'):
    unset($_SESSION['THEME']);
    header("Location: " . BASE);
    exit;
endif;

//READ CLASS AUTO INSTANCE
if (empty($Read)):
    $Read = new Read;
endif;

//GET PARAMETER URL
$getURL = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$setURL = (empty($getURL) ? 'index' : $getURL);
$URL = explode('/', $setURL);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="mit" content="2018-01-03T21:07:08-02:00+19935">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=0">

    <title>Feegow Clinic - Software Para Clínicas Médicas</title>
    <meta name="description" content="Feegow Clinic - Software Para Clínicas Médicas"/>
    <meta name="robots" content="index, follow"/>

    <link rel="base" href="<?= BASE; ?>"/>
    <link rel="canonical" href="<?= BASE; ?>/<?= $getURL; ?>"/>

    <link href="<?= INCLUDE_PATH; ?>/images/favicon.png" rel="icon">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/style.css"/>

    <link rel="stylesheet" href="<?= BASE; ?>/_cdn/bootcss/reset.css"/>
    <link rel="stylesheet" href="<?= BASE; ?>/_cdn/bootcss/fonticon.css"/>

    <script src="<?= BASE; ?>/_cdn/jquery.js"></script>
    <script src="<?= BASE; ?>/_cdn/scripts.js"></script>
</head>
    <?php
        // HEADER
        if (file_exists(REQUIRE_PATH . "/inc/header.php")):
            require REQUIRE_PATH . "/inc/header.php";
        endif;

        // FOOTER
        if (file_exists(REQUIRE_PATH . "/index.php")):
            require REQUIRE_PATH . "/index.php";
        endif;

        // FOOTER
        if (file_exists(REQUIRE_PATH . "/inc/footer.php")):
            require REQUIRE_PATH . "/inc/footer.php";
        endif;
    ?>

    <script src="<?= INCLUDE_PATH; ?>/js/scripts.js"></script>
</body>

</html>
<?php
ob_end_flush();
