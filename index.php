<?php
/**
 * WebEngine CMS
 * https://webenginecms.org/
 * 
 * @version 1.2.6
 * @author M4NU31 <http://lautaroangelico.com/>
 * @copyright (c) 2026 M4NU31, All Rights Reserved
 * 
 * Licensed under the MIT license
 * http://opensource.org/licenses/MIT
 */

if(!defined('access') or !access) die();
require_once __PATH_TEMPLATE_ROOT__ . 'inc/template.functions.php';

$serverInfoCache = LoadCacheData('server_info.cache');
if(is_array($serverInfoCache)) {
	$srvInfo = explode("|", $serverInfoCache[1][0]);
}

$maxOnline = config('maximum_online', true);
$onlinePlayers = isset($srvInfo[3]) ? $srvInfo[3] : 0;
$onlinePlayersPercent = check_value($maxOnline) ? $onlinePlayers*100/$maxOnline : 0;

if(!isset($_REQUEST['page'])) {
	$_REQUEST['page'] = '';
}

if(!isset($_REQUEST['subpage'])) {
	$_REQUEST['subpage'] = '';
}
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php config('website_meta_description'); ?>"/>
		<meta name="keywords" content="<?php config('website_meta_keywords'); ?>"/>
        <title><?php $handler->websiteTitle(); ?></title>
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
        <link href="<?php echo __PATH_TEMPLATE_CSS__; ?>main.css?v=<?php echo THEME_VER; ?>" rel="stylesheet">
        <script>
			var baseUrl = '<?php echo __BASE_URL__; ?>';
		</script>
    </head>
    <body>
        <div id="wrap_all">
            <header class="header">
                <?php require __PATH_TEMPLATE_ROOT__ . 'inc/modules/header.php'; ?>
            </header>
            <div id="main">
                <div class="main-inner">
                    <?php require __PATH_TEMPLATE_ROOT__ . 'inc/modules/body-menu.php'; ?>
                    <div class="sections-wrapper">
                        <?php if( $_REQUEST['page'] != '' || $_REQUEST['subpage'] != '') { ?>
                            <?php $handler->loadModule($_REQUEST['page'],$_REQUEST['subpage']); ?>
                        <?php }else{ ?>
                            <?php require __PATH_TEMPLATE_ROOT__ . 'inc/modules/home.php'; ?>
                        <?php } ?>
                    </div>
                    <?php require __PATH_TEMPLATE_ROOT__ . 'inc/modules/sidebar.php'; ?>
                    <footer id="main-section-footer" class="main-section section-footer">
                        <?php require __PATH_TEMPLATE_ROOT__ . 'inc/modules/footer.php'; ?>
                    </footer>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <script src="https://musephirot.com/templates/sephirot/js/events.js"></script>
        <script src="<?php echo __PATH_TEMPLATE_JS__; ?>main.js?v=<?php echo THEME_VER; ?>"></script>
    </body>
</html>