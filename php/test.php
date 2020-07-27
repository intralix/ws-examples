<?php
/*
* Author: 		Intralix - http://intralix.com/
* Description:	Example for Consume Las Positions Webservice
* Date: 		27/03/2019
* License:
############################################################################
#    Coded by: Intralix (https://github.com/intralix)
############################################################################
#
#    This program is free software: you can redistribute it and/or modify
#    it under the terms of the GNU Affero General Public License as
#    published by the Free Software Foundation, either version 3 of the
#    License, or (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
##############################################################################
*/

	error_reporting(E_ALL); ini_set("display_errors", 1);
	echo '<pre>';

	require 'vendor/autoload.php';
	require 'LgpsWsClient.php';

	$url = 'http://signals.intralix.com/api/v1/lgps/.....'; // Change URL as need
	// Process
	$config = [
		'endpoints' => [
			'last_positions' => $url,
		],

		'bearer_token' => 'API_TOKEN', // Token proporcionado en el documento
	];

	$params =  [
		/*
		'param 1' => 'value 1',
		'param 2' => 'value 2',
		*/
	];

	// Execute Ws Call
	$wsc = new LgpsWsClient( $config, $params );
	$response = $wsc->getLastPositions();

	// Has error ?
	if(!isset($response['error']))
	{
		// Has Data ?
		if(isset($response['data']))
		{
			// Print Results
			foreach ($response['data'] as $position) {
				var_dump($position);
			}
		}
	}
	else {

		var_dump($response);
	}

	echo '<hr>...Done';
	echo '</pre>';
?>
