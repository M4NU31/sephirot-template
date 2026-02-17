<?php
/**
 * WebEngine CMS
 * https://webenginecms.org/
 * 
 * @version 1.2.5
 * @author Lautaro Angelico <http://lautaroangelico.com/>
 * @author M4N3U1 <https://sephirot.games/>
 * @copyright (c) 2013-2023 Lautaro Angelico, All Rights Reserved
 * 
 * 
 * Licensed under the MIT license
 * 
 * http://opensource.org/licenses/MIT
 */
 
 define('THEME_VER', '1.0.67');
 define('__PATH_TEMPLATE_MODULES__', __PATH_TEMPLATE__ . 'inc/modules/');

function templateBuildNavbar() {
	$cfg = loadConfig('navbar');
	if(!is_array($cfg)) return;
	
	echo '<ul>';
	foreach($cfg as $element) {
		if(!is_array($element)) continue;
		
		# active
		if(!$element['active']) continue;
		
		# type
		$link = ($element['type'] == 'internal' ? __BASE_URL__ . $element['link'] : $element['link']);
		
		# title
		$title = (check_value(lang($element['phrase'], true)) ? lang($element['phrase'], true) : 'Unk_phrase');
		
		# visibility
		if($element['visibility'] == 'guest') if(isLoggedIn()) continue;
		if($element['visibility'] == 'user') if(!isLoggedIn()) continue;
		
		# print
		if($element['newtab']) {
			echo '<li><a href="'.$link.'" target="_blank">'.$title.'</a></li>';
		} else {
			echo '<li><a href="'.$link.'">'.$title.'</a></li>';
		}
	}
	echo '</ul>';
}

function templateBuildUsercp() {
	$cfg = loadConfig('usercp');
	if(!is_array($cfg)) return;
	
	echo '<ul>';
	foreach($cfg as $element) {
		if(!is_array($element)) continue;
		
		# active
		if(!$element['active']) continue;
		
		# type
		$link = ($element['type'] == 'internal' ? __BASE_URL__ . $element['link'] : $element['link']);
		
		# title
		$title = (check_value(lang($element['phrase'], true)) ? lang($element['phrase'], true) : 'Unk_phrase');
		
		# icon
		$icon = (check_value($element['icon']) ? __PATH_TEMPLATE_IMG__ . 'icons/' . $element['icon'] : __PATH_TEMPLATE_IMG__ . 'icons/usercp_default.png');
		
		# visibility
		if($element['visibility'] == 'guest') if(isLoggedIn()) continue;
		if($element['visibility'] == 'user') if(!isLoggedIn()) continue;
		
		# print
		if($element['newtab']) {
			echo '<li><img src="'.$icon.'"><a href="'.$link.'" target="_blank">'.$title.'</a></li>';
		} else {
			echo '<li><img src="'.$icon.'"><a href="'.$link.'">'.$title.'</a></li>';
		}
	}
	echo '</ul>';
}

function templateCastleSiegeWidget() {
	$castleSiege = new CastleSiege();
	if(!$castleSiege->showWidget()) return;
	$siegeData = $castleSiege->siegeData();
	if(!is_array($siegeData)) return;
	if(!is_array($siegeData['castle_data'])) return;
	
	if($siegeData['castle_data'][_CLMN_MCD_OCCUPY_] == 1) {
		$guildOwner = guildProfile($siegeData['castle_data'][_CLMN_MCD_GUILD_OWNER_]);
		$guildOwnerMark = $siegeData['castle_owner_alliance'][0][_CLMN_GUILD_LOGO_];
		$guildMaster = playerProfile($siegeData['castle_owner_alliance'][0][_CLMN_GUILD_MASTER_]);
	} else {
		$guildOwner = '-';
		$guildOwnerMark = '1111111111111111111111111114411111144111111111111111111111111111';
		$guildMaster = '-';
	}
	
	echo '<div class="panel castle-owner-widget">';
		echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">'.lang('castlesiege_widget_title').'</h3>';
		echo '</div>';
		echo '<div class="panel-body">';
			echo '<div class="row">';
				echo '<div class="col-sm-6 text-center">';
					echo returnGuildLogo($guildOwnerMark, 100);
				echo '</div>';
				echo '<div class="col-sm-6">';
					echo '<span class="alt">'.lang('castlesiege_txt_2').'</span><br />';
					echo $guildOwner . '<br /><br />';
					echo '<span class="alt">'.lang('castlesiege_txt_12').'</span><br />';
					echo $guildMaster;
				echo '</div>';
			echo '</div>';
			echo '<div class="row" style="margin-top: 20px;">';
				echo '<div class="col-sm-12 text-center">';
					echo '<span class="alt">'.lang('castlesiege_txt_21').'</span><br />';
					echo $siegeData['current_stage']['title'] . '<br /><br />';
					echo '<span class="alt">'.lang('castlesiege_txt_1').'</span><br />';
					echo $siegeData['warfare_stage_countdown'] . '<br /><br />';
					echo '<a href="'.__BASE_URL__.'castlesiege" class="btn btn-castlewidget btn-xs">'.lang('castlesiege_txt_7').'</a>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function templateLanguageSelector() {
	$langList = array(
		'en' => array('English', 'US'),
		'es' => array('Español', 'ES'),
		'ph' => array('Filipino', 'PH'),
		'br' => array('Português', 'BR'),
		'ro' => array('Romanian', 'RO'),
		'cn' => array('Simplified Chinese', 'CN'),
		'ru' => array('Russian', 'RU'),
		'lt' => array('Lithuanian', 'LT'),
	);
	
	if(isset($_SESSION['language_display'])) {
		$lang = $_SESSION['language_display'];
	} else {
		$lang = config('language_default', true);
	}
	
	echo '<ul class="webengine-language-switcher">';
		echo '<li><a href="'.__BASE_URL__.'language/switch/to/'.strtolower($lang).'" title="'.$langList[$lang][0].'"><img src="'.getCountryFlag($langList[$lang][1]).'" /> '.strtoupper($lang).'</a></li> ';
		foreach($langList as $language => $languageInfo) {
			if($language == $lang) continue;
			echo '<li><a href="'.__BASE_URL__.'language/switch/to/'.strtolower($language).'" title="'.$languageInfo[0].'"><img src="'.getCountryFlag($languageInfo[1]).'" /> '.strtoupper($language).'</a></li> ';
		}
	echo '</ul>';
}

//Ranking
function templateTopLevelWidget($limit = 10) {
	$levelRankingData = LoadCacheData('rankings_level.cache');
	if(!is_array($levelRankingData)) return;

	$top = array_slice($levelRankingData, 0, $limit+1);

	echo '<div class="panel panel-sidebar">';
		echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">'.lang('rankings_txt_1').'<a href="'.__BASE_URL__.'rankings/level" class="btn btn-primary btn-xs pull-right" style="text-align:center;width:22px;">+</a></h3>';
		echo '</div>';
		echo '<div class="panel-body">';
			echo '<table class="table table-condensed">';
				echo '<thead><tr>';
					echo '<th class="text-center"></th>'; // Empty
					echo '<th class="text-center">'.lang('rankings_txt_10').'</th>'; // Character
					echo '<th class="text-center">'.lang('rankings_txt_11').'</th>'; // Class
					echo '<th class="text-center">'.lang('rankings_txt_12').'</th>'; // Level
					echo '<th class="text-center">'.lang('rankings_txt_13').'</th>'; // Reset
				echo '</tr></thead>';
				echo '<tbody>';

				foreach($top as $k => $row) {
					if($k == 0) continue;
					echo '<tr>';
						echo '<td class="text-center">'.$k.'</td>';
						echo '<td class="text-center">'.playerProfile($row[0]).'</td>';
						echo '<td class="text-center">'.getPlayerClass($row[1]).'</td>';
						echo '<td class="text-center">'.number_format($row[3]).'</td>';
						echo '<td class="text-center">'.number_format($row[2]).'</td>';
					echo '</tr>';
				}

				echo '</tbody>';
			echo '</table>';
		echo '</div>';
	echo '</div>';
}
function templateTopGuildsWidget($limit = 10) {
	$guildRankingData = LoadCacheData('rankings_guilds.cache');
	if(!is_array($guildRankingData)) return;

	$rankingsConfig = loadConfigurations('rankings');
	$top = array_slice($guildRankingData, 0, $limit+1);

	echo '<div class="panel panel-sidebar">';
		echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">'.lang('rankings_txt_4').'<a href="'.__BASE_URL__.'rankings/guilds" class="btn btn-primary btn-xs pull-right" style="text-align:center;width:22px;">+</a></h3>';
		echo '</div>';
		echo '<div class="panel-body">';
			echo '<table class="table table-condensed">';
				echo '<thead><tr>';
					echo '<th class="text-center"></th>'; // Empty
					echo '<th class="text-center">'.lang('rankings_txt_17').'</th>'; // Guild Name
					echo '<th class="text-center">'.lang('rankings_txt_28').'</th>'; // Logo
					echo '<th class="text-center">'.lang('rankings_txt_19').'</th>'; // Score
				echo '</tr></thead>';
				echo '<tbody>';

				foreach($top as $k => $row) {
					if($k == 0) continue;
					$multiplier = ($rankingsConfig['guild_score_formula'] == 1 ? 1 : $rankingsConfig['guild_score_multiplier']);
					echo '<tr>';
						echo '<td class="text-center">'.$k.'</td>';
						echo '<td class="text-center">'.guildProfile($row[0]).'</td>';
						echo '<td class="text-center">'.returnGuildLogo($row[3], 20).'</td>';
						echo '<td class="text-center">'.number_format(floor($row[2]*$multiplier)).'</td>';
					echo '</tr>';
				}

				echo '</tbody>';
			echo '</table>';
		echo '</div>';
	echo '</div>';
}
function templateEventScheduleWidget() {
	echo '<div class="panel panel-sidebar panel-sidebar-events">';
		echo '<div class="panel-heading">';
			echo '<h3 class="panel-title">'.lang('event_schedule').'</h3>';
		echo '</div>';
		echo '<div class="panel-body" style="min-height:400px;">';
			echo '<table class="table table-condensed">';

			$events = array('bloodcastle','devilsquare','chaoscastle','dragoninvasion','goldeninvasion','castlesiege');
			foreach($events as $e) {
				echo '<tr>';
					echo '<td><span id="'.$e.'_name"></span><br /><span class="smalltext">'.lang('event_schedule_start').'</span></td>';
					echo '<td class="text-right"><span id="'.$e.'_next"></span><br /><span class="smalltext" id="'.$e.'"></span></td>';
				echo '</tr>';
			}

			echo '</table>';
		echo '</div>';
	echo '</div>';
}
function checkServerStatus(){
	$host = '51.79.44.162'; // Ej: 127.0.0.1 o midominio.com
	$port = 55901;         // Puerto del GameServer
	$timeout = 1;          // segundos
	$status = "";

	$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);

	if ($fp) {
		fclose($fp);
		$status = '<span style="color: var(--colorE6)" >Online</span>';
	} else {
		$status = '<span style="color: var(--colorE4)" >Offline</span>';
	}

	return $status;
}