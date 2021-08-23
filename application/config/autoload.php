<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('session','database','pagination','upload', 'themes', 'uuid', 'changer', 'generate', 'bcrypt', "cart");

$autoload['drivers'] = array();

$autoload['helper'] = array('url', 'form', 'html', 'cookie', 'string', 'file', 'download');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array("model_auth", "model_remun", "model_transaksi", "model_aktivitas", "model_pegawai", "model_referensi", "model_users", "model_barang", "model_simpanan");
