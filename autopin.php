<?php

/**
 * Name: Autopin
 * Description: Auto-pin a selected set of apps for all users.
 *
 */

use App;
use Zotlabs\Lib\Apps;
use Zotlabs\Extend\Hook;
use Zotlabs\Extend\Route;

function autopin_load() {
	Hook::register('create_identity','addon/autopin/autopin.php','autopin_pin_apps');
	//Route::register('addon/autopin/Mod_Autopin.php','autopin');
}

function autopin_unload() {
	Hook::unregister('create_identity','addon/autopin/autopin.php','autopin_pin_apps');
	//Route::unregister('addon/autopin/Mod_Autopin.php','autopin');
}

function autopin_pin_apps($uid) {
	$app_id = Apps::app_install($uid, 'Channel Export');
	$app = q("select * from app where app_id = '%s' limit 1",
				dbesc($app_id));
	$app[0]['guid'] = $app_id;
	Apps::app_feature($uid, $app[0], 'nav_pinned_app');
}
