<?php
/*
Plugin Name: StudioFACA Security
Plugin URI: http://www.wordpress.org/plugins/studiofaca-security/
Description: Powerful plugin to protect your WordPress against unauthorized users.
Version: 0.2
Author: StudioFACA
Author URI: http://www.studiofaca.com/
Licence: GPL2
*/
?><?php

// some definition we will use
define( 'STUDIOFACA_PUGIN_NAME', 'StudioFACA Security');
define( 'STUDIOFACA_PUGIN_DESCRIPTION', 'Powerful plugin to protect your WordPress against unauthorized users.');
define( 'STUDIOFACA_PLUGIN_DIRECTORY', 'studiofaca-security');
define( 'STUDIOFACA_CURRENT_VERSION', '0.2' );
define( 'STUDIOFACA_CURRENT_BUILD', '1' );

// studiofaca plugin domain for language files
define( 'STUDIOFACA', 'studiofaca_security' );

// create custom plugin settings menu
add_action( 'admin_menu', 'studiofaca_create_menu' );

//call register settings function
add_action( 'admin_init', 'studiofaca_register_settings' );


register_activation_hook(__FILE__, 'studiofaca_activate');
register_deactivation_hook(__FILE__, 'studiofaca_deactivate');
register_uninstall_hook(__FILE__, 'studiofaca_uninstall');

// activating the default values
function studiofaca_activate() {
	add_option('studiofaca_option_3', 'any_value');
}

// deactivating
function studiofaca_deactivate() {
	// needed for proper deletion of every option
	delete_option('studiofaca_option_3');
}

// uninstalling
function studiofaca_uninstall() {
	# delete all data stored
	delete_option('studiofaca_option_3');
}


function studiofaca_create_menu() {

	// create new top-level menu
	add_menu_page( 
	__('Security', STUDIOFACA),
	__('Security', STUDIOFACA),
	0,
	STUDIOFACA_PLUGIN_DIRECTORY.'/studiofaca_settings.php',
	'',
	plugins_url('/images/security.png', __FILE__));

}

function studiofaca_register_settings() {
	//register settings
	register_setting( STUDIOFACA, STUDIOFACA );
}
	
if(isset($_GET['settings-updated'])) {

	$htaccess = ABSPATH.'/.htaccess';
	$content = '';

	$htaccess_org = WP_PLUGIN_DIR . "/".dirname(plugin_basename(__FILE__)).'/db/.htaccess.org';
	$htaccess_sec = WP_PLUGIN_DIR . "/".dirname(plugin_basename(__FILE__)).'/db/.htaccess.sec';

	if(!file_exists($htaccess_org)) {
		if(file_exists($htaccess)) {
			$content = file_get_contents($htaccess);

			$bom = pack("CCC", 0xef, 0xbb, 0xbf);
			if(0 == strncmp($content, $bom, 3)) {
				$content = substr($content, 3);	
			}

			$fh = fopen($htaccess_org, 'w') or die("can't open file");
			fwrite($fh, $content);
			fclose($fh);
		}
	
	}

	$settings = get_option(STUDIOFACA);
	$limit = '';
	$rewrite = '';
	$ip = 0;
	if($settings['status']) {

		$security = '';

		if($settings['rules_level'] != 'none') {
		
			$csv_file = WP_PLUGIN_DIR . "/".dirname(plugin_basename(__FILE__)).'/db/GeoIP.csv';
			include_once('libs/cidr.php');
			
			$cidr = new CIDR();
	
			if($settings['rule'] == 'deny') {
				$limit .= 'order allow,deny'.chr(13).chr(10);			
			} else {
				$limit .= 'order deny,allow'.chr(13).chr(10);			
			}
			
			if($settings['ip_addresses_allow']) {
				$ip_addresses_allow = explode(chr(13).chr(10), $settings['ip_addresses_allow']);
				foreach($ip_addresses_allow as $ip_address) {
					$limit .= 'allow from '.$ip_address.chr(13).chr(10);			
					$ip = 1;
				}
			}
			if($settings['ip_addresses_deny']) {
				$ip_addresses_deny = explode(chr(13).chr(10), $settings['ip_addresses_deny']);
				foreach($ip_addresses_deny as $ip_address) {
					$limit .= 'deny from '.$ip_address.chr(13).chr(10);			
					$ip = 1;
				}
			}
			
			if($settings['countries_allow']) {
				foreach($settings['countries_allow'] as $country) {
					$read_handle  = @fopen($csv_file, "r");
					while (($buffer = fgets($read_handle, 4096)) !== false) {
					  $csv_string_array = str_getcsv($buffer);
					  if($csv_string_array[4]==$country) {
						list($ip_start, $ip_end) = explode(',' ,str_replace('"', '', substr($buffer, 1, stripos($buffer, '"', 20))));
						$cidrl = $cidr->rangeToCIDRList($ip_start, $ip_end);
						$limit .= 'allow from '.$cidrl[0].chr(13).chr(10);			
					  }
					}
					$ip = 1;
				}
			}
			
			if($settings['countries_deny']) {
				foreach($settings['countries_deny'] as $country) {
					$read_handle  = @fopen($csv_file, "r");
					while (($buffer = fgets($read_handle, 4096)) !== false) {
					  $csv_string_array = str_getcsv($buffer);
					  if($csv_string_array[4]==$country) {
						list($ip_start, $ip_end) = explode(',' ,str_replace('"', '', substr($buffer, 1, stripos($buffer, '"', 20))));
						$cidrl = $cidr->rangeToCIDRList($ip_start, $ip_end);
						$limit .= 'deny from '.$cidrl[0].chr(13).chr(10);			
					  }
					}
					$ip = 1;
				}
			}
	
			if($settings['rule'] == 'deny') {
				$limit .= 'allow from all'.chr(13).chr(10);			
			} else {
				$limit .= 'deny from all'.chr(13).chr(10);			
			}
	
			if($limit && $ip) {
	
					if($settings['rules_level'] == 'site') {
						$files = ' index.php';
					} else if($settings['rules_level'] == 'admin') {
						$files = ' wp-login.php|wp-admin';
					} else if($settings['rules_level'] == 'all') {
						$files = ' /';
					} else {
						$files = '';	
					}

					if($files) {
						$security .= '<Files'.$files.'>'.chr(13).chr(10);			
					}
					$security .= $limit;
					if($files) {
						$security .= '</Files>'.chr(13).chr(10);			
					}
			}

		}


		if($settings['user_agent_deny']) {
			$rewrite .= 'RewriteCond %{HTTP:User-Agent} (?:'.str_replace(chr(13).chr(10), '|', $settings['user_agent_deny']).') [NC]'.chr(13).chr(10);
			$rewrite .= 'RewriteRule .? - [F]'.chr(13).chr(10);
		}
		
		if($settings['rule_proxy']) {
			$rewrite .= 'RewriteCond %{HTTP:VIA}                 !^$ [OR]'.chr(13).chr(10);
			$rewrite .= 'RewriteCond %{HTTP:FORWARDED}           !^$ [OR]'.chr(13).chr(10);
			$rewrite .= 'RewriteCond %{HTTP:USERAGENT_VIA}       !^$ [OR]'.chr(13).chr(10);
			$rewrite .= 'RewriteCond %{HTTP:X_FORWARDED_FOR}     !^$ [OR]'.chr(13).chr(10);
			$rewrite .= 'RewriteCond %{HTTP:PROXY_CONNECTION}    !^$ [OR]'.chr(13).chr(10);
			$rewrite .= 'RewriteCond %{HTTP:XPROXY_CONNECTION}   !^$ [OR]'.chr(13).chr(10);
			$rewrite .= 'RewriteCond %{HTTP:HTTP_PC_REMOTE_ADDR} !^$ [OR]'.chr(13).chr(10);
			$rewrite .= 'RewriteCond %{HTTP:HTTP_CLIENT_IP}      !^$'.chr(13).chr(10);
			$rewrite .= 'RewriteRule .? - [F]'.chr(13).chr(10);
		}

		if($settings['rule_sql_injection']) {
			$rewrite .= 'RewriteCond %{QUERY_STRING} [^a-z](declare¦char¦set¦cast¦convert¦delete¦drop¦exec¦insert¦meta¦script¦select¦truncate¦update)[^a-z] [NC]'.chr(13).chr(10);
			$rewrite .= 'RewriteRule .? - [F]'.chr(13).chr(10);
		}

		if($settings['rule_base64']) {
			$rewrite .= 'RewriteCond %{QUERY_STRING} base64_encode.*\(.*\) '.chr(13).chr(10);
			$rewrite .= 'RewriteRule .? - [F]'.chr(13).chr(10);
		}

		if($settings['rule_mosconfig']) {
			$rewrite .= 'RewriteCond %{QUERY_STRING} mosConfig_[a-zA-Z_]{1,21}(=|\%3D)'.chr(13).chr(10);
			$rewrite .= 'RewriteRule .? - [F]'.chr(13).chr(10);
		}

		if($settings['rule_php_global']) {
			$rewrite .= 'RewriteCond %{QUERY_STRING} GLOBALS(=|\[|\%[0-9A-Z]{0,2})'.chr(13).chr(10);
			$rewrite .= 'RewriteRule .? - [F]'.chr(13).chr(10);
		}

		if($settings['rule_request']) {
			$rewrite .= 'RewriteCond %{QUERY_STRING} _REQUEST(=|\[|\%[0-9A-Z]{0,2})'.chr(13).chr(10);
			$rewrite .= 'RewriteRule .? - [F]'.chr(13).chr(10);
		}
		
		if($rewrite) {
			$security .= '<IfModule mod_rewrite.c>'.chr(13).chr(10);			
			$security .= $rewrite;
			$security .= '</IfModule>'.chr(13).chr(10);
		}


		if($security) {
			$content = "# Start StudioFACA Security".chr(13).chr(10).$security."# End StudioFACA Security".chr(13).chr(10);	

			$fh = fopen($htaccess_sec, 'w') or die("can't open file");
			fwrite($fh, $content);
			fclose($fh);
		}

	}

	$fh = fopen($htaccess, 'w') or die("can't open file");
	fwrite($fh, file_get_contents($htaccess_sec).file_get_contents($htaccess_org));
	fclose($fh);

}

?>