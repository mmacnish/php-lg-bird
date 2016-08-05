<?php
/*

    BIRD Looking Glass :: http://bird-lg.subnets.ru/
    =================================================
    Copyright (c) 2013 SUBNETS.RU project (Moscow, Russia)
    Authors: Nikolaev Dmitry <virus@subnets.ru>, Panfilov Alexey <lehis@subnets.ru>

    Configuration file

*/
$config=array();

//========================================================================================
//				   	GLOBAL CONFIG SECTION
//========================================================================================
/*
    Global
    ======
    timezone: http://php.net/manual/en/function.date-default-timezone-get.php , default Europe/Moscow
    php_path: full path to the PHP CLI version, details http://php.net/manual/en/features.commandline.introduction.php
*/
$config['timezone']="America/New_York";
$config['php_path']="/usr/bin/php";
$config['asn_url']="https://apps.db.ripe.net/search/lookup.html?source=ripe&key=AS%ASNUMBER%&type=aut-num";

/*
   BIRD sockets
    ==================================
    Full path to bird and bird6 sockets.
    ?ttention:
	* you must set write permissions on BIRD sockets so user/group who runs HTTP server can write to the BIRD socket
	    exmpl: chmod o=w /path/to/bird.ctl
	* if you set socket permissions they will be rewrited after BIRD daemon restarted - keep this in mind

    Default values:
	- for IPv4 BIRD daemon (birdc):  /var/run/bird.ctl
	- for IPv6 BIRD daemon (birdc6): /var/run/bird6.ctl
*/
$config['birdc']="/var/run/bird.ctl";
// $config['birdc6']="/var/run/bird6.ctl";


//========================================================================================
//				    BIRD CLIENT SCRIPT CONFIG SECTION
//========================================================================================

/*
    Bird client script
    ==================================
    bird_client_file: name of bird client script, default bird.client.php
    bird_client_dir: full path to directory where script bird.client.php is located
    bird_client_remote: if bird.client.php run on localhost set to false, if set to true bird.client.php will run as on remote host, default is false
    bird_client_remote_permited_ips: if bird_client_remote is set to true than need to specify permitted IP`s for connection
    suppress_welcome: don`t print BIRD welcome string, where BIRD version is present
    ping_util:
	* path - full path to ipv4 ping utility
	* flags - add flags when execute ping utility
    ping6_util:
	* path - full path to IPv6 ping utility
	* flags - add flags when execute ping utility
    trace_util:
	* path - full path to ipv4 traceroute utility
	* flags - add flags when execute traceroute utility
    trace6_util:
	* path - full path to IPv6 traceroute utility
	* flags - add flags when execute traceroute utility
*/
$config['bird_client_file']="bird.client.php";
$config['bird_client_dir']="/usr/sbin/";
$config['bird_client_remote']=true;					//boolean: False | True
$config['bird_client_remote_permited_ips']=array();
$config['bird_client_remote_permited_ips'][]="1.2.3.4";
//$config['bird_client_remote_permited_ips'][]="X.X.X.X";

$config['suppress_welcome']=true;					//boolean: False | True

$config['ping_util']['path']="/usr/bin/ping";
$config['ping_util']['flags']="-c 5";
$config['ping6_util']['path']="/usr/bin/ping6";
$config['ping6_util']['flags']="-c 5";
$config['trace_util']['path']="/usr/bin/traceroute";
$config['trace_util']['flags']="-m 20 -q 1 -w 1 -I";
$config['trace6_util']['path']="/usr/bin/traceroute6";
$config['trace6_util']['flags']="-m 20 -q 1 -I";


//========================================================================================
//				    WEB INTERFACE SECTION
//========================================================================================
define('REMOTE_ADDR',$_SERVER['REMOTE_ADDR']);			//Remote client IP-address, used for restricted commands
// comment out previous string and UNcomment this define if you use NGINX as proxy for APACHE
// don`t forget to add "proxy_set_header    X-Real-IP        $remote_addr;" to nginx.conf
//define('REMOTE_ADDR',$_SERVER['HTTP_X_REAL_IP']);

/*
    Main
    ====
    url: LG URL
    logo: path to logo image
    logo_url: href on logo image
    asn: Your Autonomous System Number (ASN)

    check_new_version: auto check if new version of LG is avail, default is true
    log_query: log LG requests to log file, default is false.
    log_query_result: log LG request result to log file, default is false
    log_query_file: full path to the log file, default is empty
    clear_additional: clear additional parameters value when click on query type, default is false
*/

$config['logo']="img/logo.png";
$config['logo_url']="http://LG.PilotFiber.Com";
$config['company_name']="PilotFiber.com";
$config['asn']="46450";
$config['asn_link']="https://www.peeringdb.com/net/8406";
$config['contact_email']="Abuse@PilotFiber.Com";
$config['disclaimer']="All commands will be logged for possible later analysis and statistics. If you don't accept this policy, please close window now!";

$config['check_new_version']=true;				//boolean: False | True
$config['log_query']=true;
$config['log_query_result']=true;                               //boolean: False | True
$config['log_query_file']="/var/log/lg.log";
$config['clear_additional']=true;				//boolean: False | True

/*
    IPv6
    =====
    Enable IPv6 support or not, default is false.
*/
$config['ipv6_enabled']=false;					//boolean: False | True

/*
    Query types
    ============
    This query types is served by LG
    Format:
	$config['query']['QUERY_NAME'][PARAMS]
    PARAMS:
	* name - name of the query in web-interface
	* disabled - disable (remove from index page) or not this type of query, default is false
	* restricted - If "restricted" is set to "false", then anyone can see this query type in the web-iface. If "restricted" is set to "true", then only permitted IPs can see this query type in the web-iface.
	* additional_empty - permit empty additional parameters if they really don`t needed
	* addon - add this string to the end of the command before send it to bird.client
	* placeholder - HTML placeholder tag for "additional parameters" field
*/
$config['query']=array();

$config['query']['route']=array();
$config['query']['route']['name']="Show route";
$config['query']['route']['disabled']=false;			//boolean: False | True
$config['query']['route']['additional_empty']=false;		//boolean: False | True
$config['query']['route']['restricted']=false;			//boolean: False | True
$config['query']['route']['addon']="all";
$config['query']['route']['placeholder']="enter IP-address or subnet";

$config['query']['ping']=array();
$config['query']['ping']['name']="Ping IP";
$config['query']['ping']['disabled']=false;			//boolean: False | True
$config['query']['ping']['additional_empty']=false;		//boolean: False | True
$config['query']['ping']['restricted']=false;			//boolean: False | True
$config['query']['ping']['addon']="";
$config['query']['ping']['placeholder']="enter IP-address";

$config['query']['trace']=array();
$config['query']['trace']['name']="Trace IP";
$config['query']['trace']['disabled']=false;
$config['query']['trace']['additional_empty']=false;		//boolean: False | True
$config['query']['trace']['restricted']=false;			//boolean: False | True
$config['query']['trace']['addon']="";
$config['query']['trace']['placeholder']="enter IP-address";

$config['query']['protocols']=array();
$config['query']['protocols']['name']="Show protocols";
$config['query']['protocols']['disabled']=false;		//boolean: False | True
$config['query']['protocols']['additional_empty']=true;		//boolean: False | True
$config['query']['protocols']['restricted']=false;		//boolean: False | True
$config['query']['protocols']['addon']="";
$config['query']['protocols']['placeholder']="leave empty or all or protocol name";

$config['query']['bgp_summ']=array();
$config['query']['bgp_summ']['name']="BGP summary";
$config['query']['bgp_summ']['disabled']=false;			//boolean: False | True
$config['query']['bgp_summ']['additional_empty']=true;		//boolean: False | True
$config['query']['bgp_summ']['restricted']=false;		//boolean: False | True
$config['query']['bgp_summ']['addon']="";
$config['query']['bgp_summ']['placeholder']="leave this field empty";

$config['query']['export']=array();
$config['query']['export']['name']="Advertised routes";
$config['query']['export']['disabled']=false;			//boolean: False | True
$config['query']['export']['additional_empty']=false;		//boolean: False | True
$config['query']['export']['restricted']=false;			//boolean: False | True
$config['query']['export']['addon']="all";
$config['query']['export']['placeholder']="leave empty or protocol name";

$config['query']['bfd_sessions']=array();
$config['query']['bfd_sessions']['name']="BFD sessions";
$config['query']['bfd_sessions']['disabled']=false;		//boolean: False | True
$config['query']['bfd_sessions']['additional_empty']=true;	//boolean: False | True
$config['query']['bfd_sessions']['restricted']=true;		//boolean: False | True
$config['query']['bfd_sessions']['addon']="";
$config['query']['bfd_sessions']['placeholder']="leave empty or IP-address";

$config['query']['ospf_summ']=array();
$config['query']['ospf_summ']['name']="OSPF neighbors";
$config['query']['ospf_summ']['disabled']=false;		//boolean: False | True
$config['query']['ospf_summ']['additional_empty']=true;		//boolean: False | True
$config['query']['ospf_summ']['restricted']=true;		//boolean: False | True
$config['query']['ospf_summ']['addon']="";
$config['query']['ospf_summ']['placeholder']="leave empty or Router ID";

/*
    Permit restricted commands for IPs
    ===================================
    If "restricted" is set to "true" in any query type - here you can set list of permitted IPs for seeing this query type in the web-iface.
    If no IPs is specified then nobody can see "restricted" query types.
    You can set as many IPs as you want:
	$config['restricted'][]="1.1.1.1";
	$config['restricted'][]="2.2.2.2";
	$config['restricted'][]=...etc.....
*/
$config['restricted']=array();

$config['restricted'][]="1.2.3.4";
//$config['restricted'][]="2.2.2.2";

/*
    Nodes configuration
    ====================
    If "host" is set to "socket" then connect to BIRD socket on localhost (this server).
    If "host" is set to IP-address + set "port", then connections goes to bird.client.php on remote host.
    Example
    +++++++
    First node in the list:
	$hin++;
	$config['nodes'][$hin]['host'] = 'socket';
	$config['nodes'][$hin]['port'] = '55555';
	$config['nodes'][$hin]['name'] = 'JFK01';
	$config['nodes'][$hin]['description'] = 'NYC';

    Second node (remote node) in the list:
	$hin++;
	$config['nodes'][$hin]['host'] = '1.1.1.1';
	$config['nodes'][$hin]['port'] = '55555';
	$config['nodes'][$hin]['name'] = 'Remote';
	$config['nodes'][$hin]['description'] = 'remote host';

    Third node:
	$hin++;
	$config['nodes'][$hin]['host'] = .....etc....

*/
$hin=0;

//First node
$hin++;
$config['nodes'][$hin]['host'] = '1.2.3.4';
$config['nodes'][$hin]['port'] = '55555';
$config['nodes'][$hin]['name'] = 'JFK01';
$config['nodes'][$hin]['description'] = 'NYC';

/*
    Bird output
    ===================
    modify:
	* routes - modify bird`s standart route output to our custom format output, default is false
	* protocols  - modify bird`s standart protocols output our custom format output, default is false
	* own_community - if community is in the own communities list (difined below) than also print community meaning, default is false
    hide:
	* protocol - don`t display bird`s protocol names in route output, default is false
	* iface - don`t display interface names in route output, default is false
	* bgp_peer_det_link - don`t display bgp peer detail link (ex. in bgp summary output), default is false
	* bgp_accepted_routes_link - don`t display link for accepted routes in bgp summary output, default is false
	* bgp_best_routes_link - don`t display link for best routes in bgp summary output, default is false
	* bgp_export_routes_link - don`t display link for export routes in bgp summary output, default is false
	* bgp_filtered_routes_link - don`t display link for filtered routes in bgp summary output, default is false

	possible values: true, false, restricted:
	    * true: deny for all
	    * false: permit for all
	    * restricted: permit only for IP`s in restricted list
*/
$config['output']=array();

$config['output']['modify']=array();
$config['output']['modify']['routes']=false;				//boolean: False | True
$config['output']['modify']['protocols']=false;				//boolean: False | True
$config['output']['modify']['own_community']=false;			//boolean: False | True

$config['output']['hide']=array();
$config['output']['hide']['protocol']=false;				//boolean: False | True
$config['output']['hide']['iface']=false;				//boolean: False | True
$config['output']['hide']['bgp_peer_det_link']=false;			//boolean: False | True
$config['output']['hide']['bgp_accepted_routes_link']=false;		//boolean: False | True
$config['output']['hide']['bgp_best_routes_link']=false;		//boolean: False | True
$config['output']['hide']['bgp_export_routes_link']=false;		//boolean: False | True
$config['output']['hide']['bgp_filtered_routes_link']=false;		//boolean: False | True

/*
    BGP communities list
    =================
    List of communities for explanation. Used if "explain_own_community" is set to true.
    Format:
	$config['community'][COMMUNITY]="community meaning text";
    Examples:
	$config['own_community'][666]="blackhole";
	$config['own_community'][999]="internal route";
*/
$config['own_community']=array();
$config['own_community'][666]="blackhole";

/*
    End of configuration file
*/
?>
