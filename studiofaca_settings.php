<?php

$mod_geoip = 0;
if (!function_exists('geoip_country_code_by_name')) {

	$mod_geoip = 0;
	include_once('libs/geoip.php');
	
	$geo = new GeoIP();
	
	$codes = $geo->GEOIP_COUNTRY_CODE_TO_NUMBER;
	$names = $geo->GEOIP_COUNTRY_NAMES;

	$countries = array();
	foreach($codes as $key => $value) {
		$countries[$key] = $names[$value];
	}
	asort($countries);

} else {
	
	$mod_geoip = 1;

	$countries = array("" => "",
						"AD" => "ANDORRA",
						"AE" => "UNITED ARAB EMIRATES",
						"AF" => "AFGHANISTAN",
						"AG" => "ANTIGUA AND BARBUDA",
						"AI" => "ANGUILLA",
						"AL" => "ALBANIA",
						"AM" => "ARMENIA",
						"AN" => "NETHERLANDS ANTILLES",
						"AO" => "ANGOLA",
						"AP" => "ASIA PACIFIC",
						"AQ" => "ANTARCTICA",
						"AR" => "ARGENTINA",
						"AS" => "AMERICAN SAMOA",
						"AT" => "AUSTRIA",
						"AU" => "AUSTRALIA",
						"AW" => "ARUBA",
						"AX" => "ALAND ISLANDS",
						"AZ" => "AZERBAIJAN",
						"BA" => "BOSNIA AND HERZEGOVINA",
						"BB" => "BARBADOS",
						"BD" => "BANGLADESH",
						"BE" => "BELGIUM",
						"BF" => "BURKINA FASO",
						"BG" => "BULGARIA",
						"BH" => "BAHRAIN",
						"BI" => "BURUNDI",
						"BJ" => "BENIN",
						"BL" => "SAINT BARTHELEMY",
						"BM" => "BERMUDA",
						"BN" => "BRUNEI DARUSSALAM",
						"BO" => "BOLIVIA",
						"BQ" => "BONAIRE, SAINT EUSTATIUS AND SABA",
						"BR" => "BRAZIL",
						"BS" => "BAHAMAS",
						"BT" => "BHUTAN",
						"BV" => "BOUVET ISLAND",
						"BW" => "BOTSWANA",
						"BY" => "BELARUS",
						"BZ" => "BELIZE",
						"CA" => "CANADA",
						"CC" => "COCOS (KEELING) ISLANDS",
						"CD" => "CONGO, THE DEMOCRATIC REPUBLIC OF THE",
						"CF" => "CENTRAL AFRICAN REPUBLIC",
						"CG" => "CONGO - BRAZZAVILLE",
						"CH" => "SWITZERLAND",
						"CI" => "COTE D'IVOIRE",
						"CK" => "COOK ISLANDS",
						"CL" => "CHILE",
						"CM" => "CAMEROON",
						"CN" => "CHINA",
						"CO" => "COLOMBIA",
						"CR" => "COSTA RICA",
						"CS" => "KOSOVO",
						"CU" => "CUBA",
						"CV" => "CAPE VERDE",
						"CW" => "CURACAO",
						"CX" => "CHRISTMAS ISLAND",
						"CY" => "CYPRUS",
						"CZ" => "CZECH REPUBLIC",
						"DE" => "GERMANY",
						"DJ" => "DJIBOUTI",
						"DK" => "DENMARK",
						"DM" => "DOMINICA",
						"DO" => "DOMINICAN REPUBLIC",
						"DZ" => "ALGERIA",
						"EC" => "ECUADOR",
						"EE" => "ESTONIA",
						"EG" => "EGYPT",
						"EH" => "WESTERN SAHARA",
						"ER" => "ERITREA",
						"ES" => "SPAIN",
						"ET" => "ETHIOPIA",
						"EU" => "EUROPEAN UNION",
						"FI" => "FINLAND",
						"FJ" => "FIJI",
						"FK" => "FALKLAND ISLANDS (MALVINAS)",
						"FM" => "MICRONESIA, FEDERATED STATES OF",
						"FO" => "FAROE ISLANDS",
						"FR" => "FRANCE",
						"GA" => "GABON",
						"GB" => "UNITED KINGDOM",
						"GD" => "GRENADA",
						"GE" => "GEORGIA",
						"GF" => "FRENCH GUIANA",
						"GG" => "GUERNSEY",
						"GH" => "GHANA",
						"GI" => "GIBRALTAR",
						"GL" => "GREENLAND",
						"GM" => "GAMBIA",
						"GN" => "GUINEA",
						"GP" => "GUADELOUPE",
						"GQ" => "EQUATORIAL GUINEA",
						"GR" => "GREECE",
						"GS" => "SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS",
						"GT" => "GUATEMALA",
						"GU" => "GUAM",
						"GW" => "GUINEA-BISSAU",
						"GY" => "GUYANA",
						"HK" => "HONG KONG",
						"HM" => "HEARD AND MC DONALD ISLANDS",
						"HN" => "HONDURAS",
						"HR" => "CROATIA",
						"HT" => "HAITI",
						"HU" => "HUNGARY",
						"ID" => "INDONESIA",
						"IE" => "IRELAND",
						"IL" => "ISRAEL",
						"IM" => "ISLE OF MAN",
						"IN" => "INDIA",
						"IO" => "BRITISH INDIAN OCEAN TERRITORY",
						"IQ" => "IRAQ",
						"IR" => "IRAN, ISLAMIC REPUBLIC OF",
						"IS" => "ICELAND",
						"IT" => "ITALY",
						"JE" => "JERSEY",
						"JM" => "JAMAICA",
						"JO" => "JORDAN",
						"JP" => "JAPAN",
						"KE" => "KENYA",
						"KG" => "KYRGYZSTAN",
						"KH" => "CAMBODIA",
						"KI" => "KIRIBATI",
						"KM" => "COMOROS",
						"KN" => "SAINT KITTS AND NEVIS",
						"KP" => "KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF",
						"KR" => "KOREA, REPUBLIC OF",
						"KW" => "KUWAIT",
						"KY" => "CAYMAN ISLANDS",
						"KZ" => "KAZAKHSTAN",
						"LA" => "LAO PEOPLE'S DEMOCRATIC REPUBLIC",
						"LB" => "LEBANON",
						"LC" => "SAINT LUCIA",
						"LI" => "LIECHTENSTEIN",
						"LK" => "SRI LANKA",
						"LR" => "LIBERIA",
						"LS" => "LESOTHO",
						"LT" => "LITHUANIA",
						"LU" => "LUXEMBOURG",
						"LV" => "LATVIA",
						"LY" => "LIBYAN ARAB JAMAHIRIYA",
						"MA" => "MOROCCO",
						"MC" => "MONACO",
						"MD" => "MOLDOVA, REPUBLIC OF",
						"ME" => "MONTENEGRO",
						"MF" => "SAINT MARTIN",
						"MG" => "MADAGASCAR",
						"MH" => "MARSHALL ISLANDS",
						"MK" => "MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF",
						"ML" => "MALI",
						"MM" => "MYANMAR",
						"MN" => "MONGOLIA",
						"MO" => "MACAO",
						"MP" => "NORTHERN MARIANA ISLANDS",
						"MQ" => "MARTINIQUE",
						"MR" => "MAURITANIA",
						"MS" => "MONTSERRAT",
						"MT" => "MALTA",
						"MU" => "MAURITIUS",
						"MV" => "MALDIVES",
						"MW" => "MALAWI",
						"MX" => "MEXICO",
						"MY" => "MALAYSIA",
						"MZ" => "MOZAMBIQUE",
						"NA" => "NAMIBIA",
						"NC" => "NEW CALEDONIA",
						"NE" => "NIGER",
						"NF" => "NORFOLK ISLAND",
						"NG" => "NIGERIA",
						"NI" => "NICARAGUA",
						"NL" => "NETHERLANDS",
						"NO" => "NORWAY",
						"NP" => "NEPAL",
						"NR" => "NAURU",
						"NU" => "NIUE",
						"NZ" => "NEW ZEALAND",
						"OM" => "OMAN",
						"PA" => "PANAMA",
						"PE" => "PERU",
						"PF" => "FRENCH POLYNESIA",
						"PG" => "PAPUA NEW GUINEA",
						"PH" => "PHILIPPINES",
						"PK" => "PAKISTAN",
						"PL" => "POLAND",
						"PM" => "SAINT PIERRE AND MIQUELON",
						"PN" => "PITCAIRN",
						"PR" => "PUERTO RICO",
						"PS" => "PALESTINIAN TERRITORY",
						"PT" => "PORTUGAL",
						"PW" => "PALAU",
						"PY" => "PARAGUAY",
						"QA" => "QATAR",
						"RE" => "REUNION",
						"RO" => "ROMANIA",
						"RS" => "SERBIA",
						"RU" => "RUSSIAN FEDERATION",
						"RW" => "RWANDA",
						"SA" => "SAUDI ARABIA",
						"SB" => "SOLOMON ISLANDS",
						"SC" => "SEYCHELLES",
						"SD" => "SUDAN",
						"SE" => "SWEDEN",
						"SG" => "SINGAPORE",
						"SH" => "SAINT HELENA",
						"SI" => "SLOVENIA",
						"SJ" => "SVALBARD & JAN MAYEN ISLANDS",
						"SK" => "SLOVAKIA",
						"SL" => "SIERRA LEONE",
						"SM" => "SAN MARINO",
						"SN" => "SENEGAL",
						"SO" => "SOMALIA",
						"SR" => "SURINAME",
						"ST" => "SAO TOME AND PRINCIPE",
						"SV" => "EL SALVADOR",
						"SX" => "SINT MAARTEN",
						"SY" => "SYRIAN ARAB REPUBLIC",
						"SZ" => "SWAZILAND",
						"TC" => "TURKS AND CAICOS ISLANDS",
						"TD" => "CHAD",
						"TF" => "FRENCH SOUTHERN TERRITORIES",
						"TG" => "TOGO",
						"TH" => "THAILAND",
						"TJ" => "TAJIKISTAN",
						"TK" => "TOKELAU",
						"TL" => "TIMOR-LESTE",
						"TM" => "TURKMENISTAN",
						"TN" => "TUNISIA",
						"TO" => "TONGA",
						"TR" => "TURKEY",
						"TT" => "TRINIDAD AND TOBAGO",
						"TV" => "TUVALU",
						"TW" => "TAIWAN, PROVINCE OF CHINA",
						"TZ" => "TANZANIA, UNITED REPUBLIC OF",
						"UA" => "UKRAINE",
						"UG" => "UGANDA",
						"UM" => "UNITED STATES MINOR OUTLYING ISLANDS",
						"US" => "UNITED STATES", 
						"UY" => "URUGUAY",
						"UZ" => "UZBEKISTAN",
						"VA" => "HOLY SEE",
						"VC" => "SAINT VINCENT AND THE GRENADINES",
						"VE" => "VENEZUELA",
						"VG" => "VIRGIN ISLANDS, BRITISH",
						"VI" => "VIRGIN ISLANDS, U.S.",
						"VN" => "VIET NAM",
						"VU" => "VANUATU",
						"WF" => "WALLIS AND FUTUNA ISLANDS",
						"WS" => "SAMOA",
						"XA" => "BOGONS",
						"YE" => "YEMEN",
						"YT" => "MAYOTTE",
						"ZA" => "SOUTH AFRICA",
						"ZM" => "ZAMBIA",
						"ZW" => "ZIMBABWE",
					   );

}



$levels = array('none' => 'None', 'site' => 'Site', 'admin' => 'Admin', 'all' => 'Site & Admin');
$rule = array('allow' => 'Allow all except list below', 'deny' => 'Deny all except list below');


$default_user_agent_allow = 'googlebot|yahoo|msnbot|studiofaca|facebook|ask|bing';
$default_user_agent_deny = "Alexibot|Art-Online|asterias|BackDoorbot|Black.Hole|BlackWidow|BlowFish|botALot|BuiltbotTough|Bullseye|BunnySlippers|Cegbfeieh|Cheesebot|CherryPicker|ChinaClaw|CopyRightCheck|cosmos|Crescent|Custo|DISCo|DittoSpyder|DownloadsDemon|eCatch|EirGrabber|EmailCollector|EmailSiphon|EmailWolf|EroCrawler|ExpresssWebPictures|ExtractorPro|EyeNetIE|FlashGet|Foobot|FrontPage|GetRight|GetWeb!|Go-Ahead-Got-It|Go!Zilla|GrabNet|Grafula|Harvest|hloader|HMView|httplib|HTTrack|humanlinks|ImagesStripper|ImagesSucker|IndysLibrary|InfonaviRobot|InterGET|Internet\sNinja|Jennybot|JetCar|JOC\sWeb\sSpider|Kenjin.Spider|Keyword.Density|larbin|LeechFTP|Lexibot|libWeb/clsHTTP|LinkextractorPro|LinkScan/8.1a.Unix|LinkWalker|lwp-trivial|Mass\sDownloader|Mata.Hari|Microsoft.URL|MIDown\stool|MIIxpc|Mister.PiX|Mister\sPiX|moget|Mozilla/3.Mozilla/2.01|Mozilla.*NEWT|Navroad|NearSite|NetAnts|NetMechanic|NetSpider|Net\sVampire|NetZIP|NICErsPRO|NPbot|Octopus|Offline.Explorer|Offline\sExplorer|Offline\sNavigator|Openfind|Pagerabber|Papa\sFoto|pavuk|pcBrowser|Program\sShareware\s1|ProPowerbot/2.14|ProWebWalker|ProWebWalker|psbot/0.1|QueryN.Metasearch|ReGet|RepoMonkey|RMA|SiteSnagger|SlySearch|SmartDownload|Spankbot|spanner|Superbot|SuperHTTP|Surfbot|suzuran|Szukacz/1.4|tAkeOut|Teleport|Teleport\sPro|Telesoft|The.Intraformant|TheNomad|TightTwatbot|Titan|toCrawl/UrlDispatcher|toCrawl/UrlDispatcher|True_Robot|turingos|Turnitinbot/1.5|URLy.Warning|VCI|VoidEYE|WebAuto|WebBandit|WebCopier|WebEMailExtrac.*|WebEnhancer|WebFetch|WebGo\sIS|Web.Image.Collector|Web\sImage\sCollector|WebLeacher|WebmasterWorldForumbot|WebReaper|WebSauger|Website\seXtractor|Website.Quester|Website\sQuester|Webster.Pro|WebStripper|Web\sSucker|WebWhacker|WebZip|Wget|Widow|[Ww]eb[Bb]andit|WWW-Collector-E|WWWOFFLE|Xaldon\sWebSpider|Xenu's|Zeus|Xombot|Baiduspider|dotbot|Exabot|Yeti|Trendscape|YandexBot|MJ12bot|Ezooms|magpie-crawler|Speedy+Spider|YandexImages|Baiduspider|YodaoBot|discobot|Sosospider|LYCOSA|Ezooms|Y!J-BRW/1.0+crawler|magpie-crawler|Speedy+Spider|Sosospider|SeznamBot|ShopWiki|ScoutJet|Gigabot|MJ12bot|checks.panopta.com|majestic12.co.uk";

$profile_ip = $_SERVER['REMOTE_ADDR'];
$profile_hostname = gethostbyaddr($profile_ip);


if (!$mod_geoip) {
	$profile_code = strtolower(@geoip_country_code_by_addr($gi, $profile_ip));
	$profile_country = @geoip_country_name_by_addr($gi, $profile_ip);
} else {
	$profile_code = strtolower(@geoip_country_code_by_name($profile_ip));
	$profile_country = @geoip_country_name_by_name($profile_ip);
}





$profile_flag = 'http://'.$_SERVER['HTTP_HOST'].'/wp-content/plugins/studiofaca_security/images/country/'.$profile_code.'.png';

?>
<div class="wrap">
    <h2><?php echo STUDIOFACA_PUGIN_NAME; ?></h2>
	<?php
		if ( ! current_user_can( 'manage_options' ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			wp_die( __( '<h3>You are not allowed to access this part of the site</h3>' ) );
		}
	?>	
	<h3><?php echo STUDIOFACA_PUGIN_DESCRIPTION; ?> </h3>
    <div class="profile">
    <h3>Your profile</h3>
    <div class="donate">
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_donations">
        <input type="hidden" name="business" value="info@studiofaca.com">
        <input type="hidden" name="lc" value="US">
        <input type="hidden" name="item_name" value="StudioFACA Security">
        <input type="hidden" name="no_note" value="0">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
    </div>
    <p>IP address: <b><?php echo $profile_ip; ?></b><br />Hostname: <b><?php echo $profile_hostname; ?></b><br /><?php if($country) { ?>Country: <?php if(file_exists($profile_flag)) { echo '<img src="'.$profile_flag.'" />'; } ?><b><?php echo $profile_country; ?></b><? } ?></p>
    </div>
    <form method="post" action="options.php">
		<?php
            settings_fields( STUDIOFACA );
            $settings = get_option(STUDIOFACA);
        ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Status:</th>
                <td>
					<?php $name = 'status'; ?><label><input type="radio" name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]" value="1" <?php if($settings[$name] == 1) { echo 'checked="checked"'; } ?> /> Enable</label>
                    <label><input type="radio" name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]" value="0" <?php if($settings[$name] == 0) { echo 'checked="checked"'; } ?> /> Disable</label>
                </td>
            </tr>
            <th scope="row">Level of Rules:</th>
	            <td>
				<?php $name = 'rules_level'; ?><select name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]">
				<?php 
					foreach($levels as $key => $value) { 
						$selected = ''; 
						if($settings[$name] == $key || (!isset($settings[$name]) && $value == 'admin')) {
							$selected = ' selected="selected"';
						}
						echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
					}
				?>
                </select>
                </td></td>
            </tr>
            <th scope="row">Rule:</th>
	            <td>
				<?php $name = 'rule'; ?><select name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>][]">
				<?php 
					foreach($rule as $key => $value) { 
						$selected = ''; 
						if(@in_array($key, $settings[$name]) || (!isset($settings[$name]) || $value == 'deny')) {
							$selected = ' selected="selected"';
						}
						echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
					}
				?>
                </select>
                </td></td>
            </tr>            
            
            <tr valign="top">
            <th scope="row">IP addresses:</th>
                <td style="margin: 0; padding: 0;">
                	<table>
                    	<tr>
                        	<td>
                                Allow:<br />
                                <?php $name = 'ip_addresses_allow'; ?><textarea name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]"><?php echo $settings[$name]; ?><? if(!isset($settings[$name])) { echo $profile_ip; } ?></textarea>
                            </td>
                            <td>
                                Deny:<br />
                                <?php $name = 'ip_addresses_deny'; ?><textarea name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]"><?php echo $settings[$name]; ?></textarea>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <th scope="row">Countries:</th>
	            <td style="margin: 0; padding:0;">
                    <table>
                        <tr>
                            <td>
                                Allow:<br />
                                <?php $name = 'countries_allow'; ?><select name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>][]" multiple="multiple" size="10">
                                <?php 
                                    foreach($countries as $key => $value) { 
                                        $selected = ''; 
                                        if(@in_array($key, $settings[$name]) || (!isset($settings[$name]) && $key == $profil_code)) {
                                            $selected = ' selected="selected"';
                                        }
                                        echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
                                    }
                                ?>
                                </select>                        
                            </td>
                            <td>
                                Deny:<br />
                                <?php $name = 'countries_deny'; ?><select name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>][]" multiple="multiple" size="10">
                                <?php 
                                    foreach($countries as $key => $value) { 
                                        $selected = ''; 
                                        if(@in_array($key, $settings[$name])) {
                                            $selected = ' selected="selected"';
                                        }
                                        echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
                                    }
                                ?>
                                </select>                        
                            </td>
                        </tr>
                    </table>                
	            </td>
            </tr>
            <th scope="row">User-agent:</th>
                <td style="margin: 0; padding: 0;">
                	<table>
                    	<tr>
                        	<td>
                                Allow:<br />
                                <?php $name = 'user_agent_allow'; ?><textarea name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]" disabled="disabled"><?php echo $settings[$name]; ?><? if(!isset($settings[$name])) { echo str_replace('|', chr(13).chr(10), $default_user_agent_allow); } ?></textarea>
                            </td>
                            <td>
                                Deny:<br />
                                <?php $name = 'user_agent_deny'; ?><textarea name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]"><?php echo $settings[$name]; ?><? if(!isset($settings[$name])) { echo str_replace('|', chr(13).chr(10), $default_user_agent_deny); } ?></textarea>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <th scope="row">Advanced:</th>
                <td>
					<?php $name = 'rule_sql_injection'; ?><label><input type="checkbox" name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]" value="1" <?php if($settings[$name] == 1) { echo 'checked="checked"'; } ?> />
                    Block out any SQL injection</label><br />
					<?php $name = 'rule_mosconfig'; ?><label><input type="checkbox" name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]" value="1" <?php if($settings[$name] == 1) { echo 'checked="checked"'; } ?> />
                    Block out any script trying to set a mosConfig value throught the URL</label><br />
					<?php $name = 'rule_base64'; ?><label><input type="checkbox" name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]" value="1" <?php if($settings[$name] == 1) { echo 'checked="checked"'; } ?> />
                    Block out any script trying to base64_encode_crap to send via URL</label><br />
					<?php $name = 'rule_php_globals'; ?><label><input type="checkbox" name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]" value="1" <?php if($settings[$name] == 1) { echo 'checked="checked"'; } ?> />
                    Block out any script trying to set a PHP GLOBALS variable via URL</label><br />
					<?php $name = 'rule_request'; ?><label><input type="checkbox" name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]" value="1" <?php if($settings[$name] == 1) { echo 'checked="checked"'; } ?> />
                    Block out any script trying to modify a REQUEST variable via URL</label><br />
					<?php $name = 'rule_proxy'; ?><label><input type="checkbox" name="<?php echo STUDIOFACA; ?>[<?php echo $name; ?>]" value="1" <?php if($settings[$name] == 1) { echo 'checked="checked"'; } ?> />
                    Block Proxy</label><br />
                </td>
            </tr>
        </table>
        <p class="submit">
	        <input type="submit" class="button-primary" value="<?php _e('Save') ?>" />
        </p>
    </form>
</div>
<style>
.profile {
	margin-top: 10px;
	padding: 10px;
	border: 1px solid #999;	
}
.donate {
	float: right;	
}

select {
	width: 360px;
	height: 200px;	
}

.line {
	display: inline-table;
}
textarea {
	width: 360px;
	height: 200px;	
}
</style>
<a href="http://www.studiofaca.com/">StudioFACA</a> | This product includes GeoLite data created by MaxMind, available from <a rel="nofollow" href="http://www.maxmind.com/" target="_blank">http://www.maxmind.com</a>. 