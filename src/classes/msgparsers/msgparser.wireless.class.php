<?php
/*
	*********************************************************************
	* -> www.phplogcon.org <-											*
	* -----------------------------------------------------------------	*
	* Apache Logfile Parser used to split WebLog fields if 
	* found in the msg. 
	*
	* This Parser is for custom wireless access point logformat 
	*																	*
	* All directives are explained within this file						*
	*
	* Copyright (C) 2008 Adiscon GmbH.
	*
	* This file is part of phpLogCon.
	*
	* PhpLogCon is free software: you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation, either version 3 of the License, or
	* (at your option) any later version.
	*
	* PhpLogCon is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	*
	* You should have received a copy of the GNU General Public License
	* along with phpLogCon. If not, see <http://www.gnu.org/licenses/>.
	*
	* A copy of the GPL can be found in the file "COPYING" in this
	* distribution.
	*********************************************************************
*/

/*
*	NEEDED FIELDS!
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_interface', 'SYSLOG_NET_INTERFACE', 'Interface', 0, 0, 100, 'center', 'net_interface', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_mac_address', 'SYSLOG_NET_MAC_ADDRESS', 'Mac Address', 0, 0, 125, 'left', 'net_mac_address', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_lastip', 'SYSLOG_NET_LASTIP', 'Last IP Address', 0, 0, 100, 'left', 'net_lastip', 1, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_rxrate', 'SYSLOG_NET_RXRATE', 'RX Rate', 0, 0, 65, 'center', 'net_rxrate', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_txrate', 'SYSLOG_NET_TXRATE', 'TX Rate', 0, 0, 65, 'center', 'net_txrate', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_uptime', 'SYSLOG_NET_UPTIME', 'System Uptime', 0, 0, 85, 'center', 'net_uptime', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_lastactivity', 'SYSLOG_NET_LASTACTIVITY', 'Last Activity', 0, 0, 80, 'center', 'net_lastactivity', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_signalstrength', 'SYSLOG_NET_SIGNALSTRENGTH', 'Signal strength', 0, 0, 100, 'center', 'net_signalstrength', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_signaltonoise', 'SYSLOG_NET_SIGNALTONOISE', 'Signal to noise', 1, 0, 50, 'center', 'net_signaltonoise', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_txccq', 'SYSLOG_NET_TXCCQ', 'TX CCQ', 1, 0, 50, 'center', 'net_txccq', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_bytesrecieved', 'SYSLOG_NET_BYTESRECIEVED', 'Bytes recieved', 1, 0, 50, 'left', 'net_bytesrecieved', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_bytessend', 'SYSLOG_NET_BYTESSEND', 'Bytes send', 1, 0, 50, 'left', 'net_bytessend', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_packetsrecieved', 'SYSLOG_NET_PACKETSRECIEVED', 'Packets recieved', 1, 0, 50, 'left', 'net_packetsrecieved', 0, 0);
INSERT INTO `logcon_fields` (`FieldID`, `FieldDefine`, `FieldCaption`, `FieldType`, `Sortable`, `DefaultWidth`, `FieldAlign`, `SearchField`, `SearchOnline`, `Trunscate`) VALUES ('net_packetssend', 'SYSLOG_NET_PACKETSSEND', 'Packets send', 1, 0, 50, 'left', 'net_packetssend', 0, 0);



*/

// --- Avoid directly accessing this file! 
if ( !defined('IN_PHPLOGCON') )
{
	die('Hacking attempt');
	exit;
}
// --- 

// --- Basic Includes
require_once($gl_root_path . 'classes/enums.class.php');
require_once($gl_root_path . 'classes/msgparser.class.php');
require_once($gl_root_path . 'include/constants_errors.php');
require_once($gl_root_path . 'include/constants_logstream.php');
// --- 

class MsgParser_wireless extends MsgParser {

	// Public Information properties 
	public $_ClassName = 'Custom Wireless Logfiles';
	public $_ClassDescription = 'Custom logfile parser for wireless access points.';
	public $_ClassHelpArticle = "";
	public $_ClassRequiredFields = array (
			"net_bytesrecieved" => array ( "FieldID" => "net_bytesrecieved", "FieldDefine" => "SYSLOG_NET_BYTESRECIEVED", "FieldCaption" => "Bytes recieved", "FieldType" => 1, "FieldAlign" => "left", "SearchField" => "net_bytesrecieved", "DefaultWidth" => 50, "SearchOnline" => false, "Trunscate" => false, "Sortable" => false), 
			"net_bytessend" => array (",  ", "FieldID" => "net_bytessend", "FieldDefine" => "SYSLOG_NET_BYTESSEND", "FieldCaption" => "Bytes send", "FieldType" => 1, "FieldAlign" => "left", "SearchField" => "net_bytessend", "DefaultWidth" => 50, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0 ), 
			"net_interface" => array (",  ", "FieldID" => "net_interface", "FieldDefine" => "SYSLOG_NET_INTERFACE", "FieldCaption" => "Interface", "FieldType" => 0, "FieldAlign" => "center", "SearchField" => "net_interface", "DefaultWidth" => 100, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0), 
			"net_lastactivity" => array (",  ", "FieldID" => "net_lastactivity", "FieldDefine" => "SYSLOG_NET_LASTACTIVITY", "FieldCaption" => "Last Activity", "FieldType" => 0, "FieldAlign" => "center", "SearchField" => "net_lastactivity", "DefaultWidth" => 80, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0), 
			"net_lastip" => array (",  ", "FieldID" => "net_lastip", "FieldDefine" => "SYSLOG_NET_LASTIP", "FieldCaption" => "Last IP Address", "FieldType" => 0, "FieldAlign" => "left", "SearchField" => "net_lastip", "DefaultWidth" => 100, "SearchOnline" => 1, "Trunscate" => 0, "Sortable" => 0), 
			"net_mac_address" => array (",  ", "FieldID" => "net_mac_address", "FieldDefine" => "SYSLOG_NET_MAC_ADDRESS", "FieldCaption" => "Mac Address", "FieldType" => 0, "FieldAlign" => "left", "SearchField" => "net_mac_address", "DefaultWidth" => 125, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0), 
			"net_packetsrecieved" => array (",  ", "FieldID" => "net_packetsrecieved", "FieldDefine" => "SYSLOG_NET_PACKETSRECIEVED", "FieldCaption" => "Packets recieved", "FieldType" => 1, "FieldAlign" => "left", "SearchField" => "net_packetsrecieved", "DefaultWidth" => 50, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0), 
			"net_packetssend" => array (",  ", "FieldID" => "net_packetssend", "FieldDefine" => "SYSLOG_NET_PACKETSSEND", "FieldCaption" => "Packets send", "FieldType" => 1, "FieldAlign" => "left", "SearchField" => "net_packetssend", "DefaultWidth" => 50, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0), 
			"net_rxrate" => array (",  ", "FieldID" => "net_rxrate", "FieldDefine" => "SYSLOG_NET_RXRATE", "FieldCaption" => "RX Rate", "FieldType" => 0, "FieldAlign" => "center", "SearchField" => "net_rxrate", "DefaultWidth" => 65, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0), 
			"net_signalstrength" => array (",  ", "FieldID" => "net_signalstrength", "FieldDefine" => "SYSLOG_NET_SIGNALSTRENGTH", "FieldCaption" => "Signal strength", "FieldType" => 0, "FieldAlign" => "center", "SearchField" => "net_signalstrength", "DefaultWidth" => 100, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0), 
			"net_signaltonoise" => array (",  ", "FieldID" => "net_signaltonoise", "FieldDefine" => "SYSLOG_NET_SIGNALTONOISE", "FieldCaption" => "Signal to noise", "FieldType" => 1, "FieldAlign" => "center", "SearchField" => "net_signaltonoise", "DefaultWidth" => 50, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0), 
			"net_uptime" => array (",  ", "FieldID" => "net_uptime", "FieldDefine" => "SYSLOG_NET_UPTIME", "FieldCaption" => "System Uptime", "FieldType" => 0, "FieldAlign" => "center", "SearchField" => "net_uptime", "DefaultWidth" => 85, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0), 
			"net_txccq" => array (",  ", "FieldID" => "net_txccq", "FieldDefine" => "SYSLOG_NET_TXCCQ", "FieldCaption" => "TX CCQ", "FieldType" => 1, "FieldAlign" => "center", "SearchField" => "net_txccq", "DefaultWidth" => 50, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0), 
			"net_txrate" => array (",  ", "FieldID" => "net_txrate", "FieldDefine" => "SYSLOG_NET_TXRATE", "FieldCaption" => "TX Rate", "FieldType" => 0, "FieldAlign" => "center", "SearchField" => "net_txrate", "DefaultWidth" => 65, "SearchOnline" => 0, "Trunscate" => 0, "Sortable" => 0)
		);

	// Constructor
	public function MsgParser_wireless() {

// TODO AUTOMATICALLY PERFORM FIELD INSERTS!

		return; // Nothing
	}

	/**
	* ParseLine
	*
	* @param arrArguments array in&out: properties of interest. There can be no guarantee the logstream can actually deliver them.
	* @return integer Error stat
	*/
	public function ParseMsg($szMsg, &$arrArguments)
	{
		global $content, $fields; 

		//trim the msg first to remove spaces from begin and end
		$szMsg = trim($szMsg);
//return ERROR_MSG_NOMATCH;

		// Sample:	script,info INICIO; Madrid-penalver ;wlan1 ;00:15:AF:9E:02:94 ;192.168.10.30 ;36Mbps ;24Mbps ;01:21:39 ;00:00:00.030 ;82dBm@1Mbps ;15 ;66 ;16852066,2147105 ;17288,12903
		if ( preg_match('/(.*?),(.*?) (.*?);(.*?);(.*?);(.*?);(.*?);(.*?);(.*?);(.*?);(.*?);(.*?);(.[0-9]{1,12}.);(.[0-9]{1,12}.);(.[0-9]{1,12}.),(.[0-9]{1,12}.);(.[0-9]{1,12}.),(.[0-9]{1,12}.)$/', $szMsg, $out ) )
		{

//print_r ( $out );
//exit;

			// Set generic properties
			$arrArguments[SYSLOG_HOST] = $out[4];
//			$arrArguments[SYSLOG_DATE] = GetEventTime($out[4]);

			// Set wlan log specific properties!
			$arrArguments[SYSLOG_NET_INTERFACE] = trim($out[5]);
			$arrArguments[SYSLOG_NET_MAC_ADDRESS] = trim($out[6]);
			$arrArguments[SYSLOG_NET_LASTIP] = trim($out[7]);
			$arrArguments[SYSLOG_NET_RXRATE] = trim($out[8]);
			$arrArguments[SYSLOG_NET_TXRATE] = trim($out[9]);
			$arrArguments[SYSLOG_NET_UPTIME] = trim($out[10]);
			$arrArguments[SYSLOG_NET_LASTACTIVITY] = trim($out[11]);
			$arrArguments[SYSLOG_NET_SIGNALSTRENGTH] = trim($out[12]);

			// Number based fields
			$arrArguments[SYSLOG_NET_SIGNALTONOISE] = $out[13];
			$arrArguments[SYSLOG_NET_TXCCQ] = $out[14];
			$arrArguments[SYSLOG_NET_BYTESRECIEVED] = $out[15];
			$arrArguments[SYSLOG_NET_BYTESSEND] = $out[16];
			$arrArguments[SYSLOG_NET_PACKETSRECIEVED] = $out[17];
			$arrArguments[SYSLOG_NET_PACKETSSEND] = $out[18];

			// Set msg to whole logline 
			$arrArguments[SYSLOG_MESSAGE] = $out[0];

			if ( $this->_MsgNormalize == 1 ) 
			{
				//Init tmp msg
				$szTmpMsg = "";

				// Create Field Array to prepend into msg! Reverse Order here
				$myFields = array( SYSLOG_NET_PACKETSSEND, SYSLOG_NET_PACKETSRECIEVED, SYSLOG_NET_BYTESSEND, SYSLOG_NET_BYTESRECIEVED, SYSLOG_NET_TXCCQ, SYSLOG_NET_SIGNALTONOISE, SYSLOG_NET_UPTIME, SYSLOG_NET_SIGNALSTRENGTH, SYSLOG_NET_LASTACTIVITY, SYSLOG_NET_TXRATE, SYSLOG_NET_RXRATE, SYSLOG_NET_LASTIP, SYSLOG_NET_MAC_ADDRESS, SYSLOG_NET_INTERFACE, SYSLOG_HOST );

				foreach ( $myFields as $myField )
				{
					// Set Field Caption
					if ( isset($fields[$myField]['FieldCaption']) )
						$szFieldName = $fields[$myField]['FieldCaption'];
					else
						$szFieldName = $myField;

					// Append Field into msg
					$szTmpMsg = $szFieldName . ": '" . $arrArguments[$myField] . "'\n" . $szTmpMsg;
				}

				// copy finished MSG back!
				$arrArguments[SYSLOG_MESSAGE] = $szTmpMsg;
			}
		}
		else
		{
			// return no match in this case!
			return ERROR_MSG_NOMATCH;
		}
		
		// Set IUT Property if success!
		$arrArguments[SYSLOG_MESSAGETYPE] = IUT_Syslog;

		// If we reached this position, return success!
		return SUCCESS;
	}
}

?>