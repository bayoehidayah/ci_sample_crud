<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('session','database', 'themes', 'uuid');

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'form', 'html');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array("model_barang", "model_faktur");
