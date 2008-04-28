<?php
/*
	*********************************************************************
	* -> www.phplogcon.org <-
	* -----------------------------------------------------------------
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
global $content;

// Global Stuff
$content['LN_MAINTITLE'] = "Main PhpLogCon";
$content['LN_MAIN_SELECTSTYLE'] = "Select a Style";
$content['LN_GEN_LANGUAGE'] = "Select Language";
$content['LN_GEN_SELECTSOURCE'] = "Select Source";
$content['LN_GEN_MOREPAGES'] = "More than one Page available";
$content['LN_GEN_FIRSTPAGE'] = "First Page";
$content['LN_GEN_LASTPAGE'] = "Last Page";
$content['LN_GEN_NEXTPAGE'] = "Next Page";
$content['LN_GEN_PREVIOUSPAGE'] = "Previous Page";
$content['LN_GEN_RECORDCOUNT'] = "Total records found";
$content['LN_GEN_PAGERSIZE'] = "Records per page";
$content['LN_GEN_PAGE'] = "Page";
$content['LN_GEN_PREDEFINEDSEARCHES'] = "Predefined Searches";
$content['LN_GEN_SOURCE_DISK'] = "Diskfile";
$content['LN_GEN_SOURCE_DB'] = "Database";
$content['LN_GEN_RECORDSPERPAGE'] = "records per page";
$content['LN_GEN_PRECONFIGURED'] = "Preconfigured";


// Main Index Site
$content['LN_ERROR_INSTALLFILEREMINDER'] = "Warning! You still have NOT removed the 'install.php' from your phpLogCon main directory!";
$content['LN_TOP_NUM'] = "No.";
$content['LN_TOP_UID'] = "uID";
$content['LN_GRID_POPUPDETAILS'] = "Details for Syslogmessage with ID '%1'";

$content['LN_SEARCH_USETHISBLA'] = "Use the form below and your advanced search will appear here";
$content['LN_SEARCH_FILTER'] = "Search (filter):";
$content['LN_SEARCH_ADVANCED'] = "Advanced Search";
$content['LN_SEARCH'] = "Search";
$content['LN_SEARCH_RESET'] = "Reset search";
$content['LN_SEARCH_PERFORMADVANCED'] = "Perform Advanced Search";
$content['LN_VIEW_MESSAGECENTERED'] = "View syslog message centered in logstream";
$content['LN_VIEW_RELATEDMSG'] = "View related syslog messages";
$content['LN_VIEW_FILTERFOR'] = "Filter message for ";


$content['LN_HIGHLIGHT'] = "Hightlight >>";
$content['LN_HIGHLIGHT_OFF'] = "Hightlight <<";
$content['LN_HIGHLIGHT_WORDS'] = "Hightlight words comma separated";

$content['LN_ERROR_NORECORDS'] = "No syslog records found.";

// Filter Options
$content['LN_FILTER_DATE'] = "Datetime Range";
$content['LN_FILTER_DATEMODE'] = "Select mode";
$content['LN_DATEMODE_ALL'] = "All time";
$content['LN_DATEMODE_RANGE'] = "Time range";
$content['LN_DATEMODE_LASTX'] = "Time x since today";
$content['LN_FILTER_DATEFROM'] = "Date range from";
$content['LN_FILTER_DATETO'] = "Date range to";
$content['LN_FILTER_DATELASTX'] = "Time since";
$content['LN_FILTER_ADD2SEARCH'] = "Add to search";
$content['LN_DATE_LASTX_HOUR'] = "Last hour";
$content['LN_DATE_LASTX_12HOURS'] = "Last 12 hours";
$content['LN_DATE_LASTX_24HOURS'] = "Last 24 hours";
$content['LN_DATE_LASTX_7DAYS'] = "Last 7 days";
$content['LN_DATE_LASTX_31DAYS'] = "Last 31 days";
$content['LN_FILTER_FACILITY'] = "Syslog Facility";
$content['LN_FILTER_SEVERITY'] = "Syslog Severity";
$content['LN_FILTER_OTHERS'] = "Other Filters";
$content['LN_FILTER_MESSAGE'] = "Syslog Message";
$content['LN_FILTER_SYSLOGTAG'] = "Syslogtag";
$content['LN_FILTER_SOURCE'] = "Source (Hostname)";

// Field Captions
$content['LN_FIELDS_DATE'] = "Date";
$content['LN_FIELDS_FACILITY'] = "Facility";
$content['LN_FIELDS_SEVERITY'] = "Severity";
$content['LN_FIELDS_HOST'] = "Host";
$content['LN_FIELDS_SYSLOGTAG'] = "Syslogtag";
$content['LN_FIELDS_PROCESSID'] = "ProcessID";
$content['LN_FIELDS_MESSAGETYPE'] = "Messagetype";
$content['LN_FIELDS_UID'] = "uID";
$content['LN_FIELDS_MESSAGE'] = "Message";

// Install Page
$content['LN_CFG_DBSERVER'] = "Database Host";
$content['LN_CFG_DBPORT'] = "Database Port";
$content['LN_CFG_DBNAME'] = "Database Name";
$content['LN_CFG_DBPREF'] = "Table prefix";
$content['LN_CFG_DBUSER'] = "Database User";
$content['LN_CFG_DBPASSWORD'] = "Database Password";
$content['LN_CFG_PARAMMISSING'] = "The following parameter were missing: ";
$content['LN_CFG_SOURCETYPE'] = "Source Type";
$content['LN_CFG_DISKTYPEOPTIONS'] = "Disk Type Options";
$content['LN_CFG_LOGLINETYPE'] = "Logline type";
$content['LN_CFG_SYSLOGFILE'] = "Syslog file";
$content['LN_CFG_DATABASETYPEOPTIONS'] = "Database Type Options";
$content['LN_CFG_DBTABLETYPE'] = "Table type";
$content['LN_CFG_DBSTORAGEENGINE'] = "Database Storage Engine";
$content['LN_CFG_DBTABLENAME'] = "Database Tablename";
$content['LN_CFG_NAMEOFTHESOURCE'] = "Name of the Source";
$content['LN_CFG_FIRSTSYSLOGSOURCE'] = "First Syslog Source";

// Details page
$content['LN_DETAILS_FORSYSLOGMSG'] = "Details for the syslog messages with id";
$content['LN_DETAILS_DETAILSFORMSG'] = "Details for message id";
$content['LN_DETAIL_BACKTOLIST'] = "Back to Listview";

?>