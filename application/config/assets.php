<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$root = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$config['assets_url'] = $root.'assets/';

/* End of file assets.php */
/* Location: ./application/config/assets.php */