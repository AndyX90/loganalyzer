<?php

/*#### #### #### #### #### #### #### #### #### #### 
phpLogCon - A Web Interface to Log Data.
Copyright (C) 2003  Adiscon GmbH

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

If you have questions about phpLogCon in general, please email info@adiscon.com. To learn more about phpLogCon, please visit 
http://www.phplogcon.com.

This Project was intiated and is maintened by Rainer Gerhards <rgerhards@hq.adiscon.com>. See AUTHORS to learn who helped make 
it become a reality.

*/#### #### #### #### #### #### #### #### #### #### 


/*
SQL_CURSOR_TYPE (integer)
SQL_CURSOR_FORWARD_ONLY (integer)
SQL_CURSOR_KEYSET_DRIVEN (integer)
SQL_CURSOR_DYNAMIC (integer)
SQL_CURSOR_STATIC (integer)
*/

	/*
	 * This file contains the function for database connection
	 * via odbc
	 */
	 
	// Converter
	 
	function dbc_sql_timeformat($timestamp)
	{
		//use '#' for MS Access
		//return "#".date("Y-m-d H:i:s", $timestamp)."#";
		//return "#".date("m/d/Y H:i:s", $timestamp)."#";
		return "{ ts '".date("Y-m-d H:i:s", $timestamp)."' }";
	}

	// Driver
	 
	function db_connection()
	{
		return odbc_connect(_DBNAME, _DBUSERID, _DBPWD, SQL_CUR_USE_ODBC);
	}

	function db_exec($db, $cmdSQL)
	{
		//echo "<br><br><b>" . $cmdSQL . "</b><br><br>";
		return odbc_exec($db, $cmdSQL);
	}

	function db_num_rows($res)
	{
		return odbc_num_rows($res);
	}

	function db_fetch_row($res)
	{
		return odbc_fetch_row($res);
	}

	function db_fetch_singleresult($res)
	{
		return odbc_fetch_array($res);
	}

	function db_fetch_array($res)
	{
		//odbc_fetch_into replaced odbc_fetch_array, because
		//in various php version the fetch_array doesnt work

		odbc_fetch_into($res, $myarray);
		return $myarray;
	}

	function db_result($res, $res_name)
	{
		return odbc_result($res, $res_name);
	} 

	function db_close($db)
	{
		odbc_close($db);
	}

	function db_num_count($cmdSQLwhere_part)
	{
		return 'SELECT DISTINCT COUNT(*) AS num FROM ' . _DBTABLENAME . substr($cmdSQLwhere_part, 0, strpos($cmdSQLwhere_part, 'ORDER BY'));
	}

	/*
	* fetch a result row as an a numeric array, 
	* the array points to the first data record you want to display
	* at current page. You need it for paging.
	*/
	function db_exec_limit($db, $cmdSQLfirst_part, $cmdSQLmain_part, $cmdSQLwhere_part, $limitlower, $perpage)
	{
		//you must move through the recordset
		//until you reach the data record you want
		//***if you know a better and more efficent methode, please let us know, too!
		$cmdSQL = $cmdSQLfirst_part . $cmdSQLmain_part . $cmdSQLwhere_part . " limit ".($limitlower-1)."," . $perpage;
		
		$result = db_exec($db, $cmdSQL);
		for($i=1;$i<$limitlower;$i++)
			$row = odbc_fetch_row($result);

		return $result;
	}

	function db_free_result($result)
	{
		return odbc_free_result($result);
	}

	function db_errno()
	{
		return odbc_error();
	}

	function db_error()
	{
		return odbc_errormsg();
	}

	function db_die_with_error($MyErrorMsg)
	{
		$errdesc = odbc_errormsg();
		$errno = odbc_error();

		$errormsg="<br>Database error: $MyErrorMsg <br>";
		$errormsg.="mysql error: $errdesc <br>";
		$errormsg.="mysql error number: $errno<br>";
		$errormsg.="Date: ".date("d.m.Y @ H:i")."<br>";
		$errormsg.="Script: ".getenv("REQUEST_URI")."<br>";
		$errormsg.="Referer: ".getenv("HTTP_REFERER")."<br><br>";

		echo $errormsg;
		exit;
	}
  
  function db_get_wildcut()
  {
    return '*';
  }
?>