<?php
/**
 * Plugin Name: Remove XML-RPC Pingback
 * Description: Disable Pingback method from XML-RPC by simply removing it. This plugins is working with WordPress 4.4
 * Author: Hybrid Webs
 * Version: 1.0.0
 * Author URI: http://www.hybridwebs.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package Remove XML-RPC Pingback
 
 Copyright 2014 - 2019  Web factory Ltd  (email: support@webfactoryltd.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

add_filter( 'xmlrpc_methods', 'block_xmlrpc_attacks' );

/**
 * Unset XML-RPC Methods.
 */
function block_xmlrpc_attacks( $methods ) {
	unset( $methods['pingback.ping'] );
	unset( $methods['pingback.extensions.getPingbacks'] );
	return $methods;
}
if ( version_compare( $wp_version, '4.4' ) >= 0 ) {
	add_action( 'wp', 'remove_xmlrpc_pingback_44', 9999 );
	function remove_xmlrpc_pingback_44() {
		header_remove( 'X-Pingback' );
	}
} else {
	add_filter( 'wp_headers', 'remove_xmlrpc_pingback_' );
	function remove_xmlrpc_pingback_( $headers ) {
		unset( $headers['X-Pingback'] );
		return $headers;
	}
}
