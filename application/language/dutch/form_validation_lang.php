<?php
/**
 * System messages translation for CodeIgniter(tm)
 *
 * @author	CodeIgniter community
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @copyright	Pieter Krul
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 */
defined('BASEPATH') OR exit('Directe toegang tot scripts is niet toegestaan');

$ci =& get_instance();
$ci->load->library('form_validation');
$ci->form_validation->set_message('is_unique', '{field} bestaat al.');
$ci->form_validation->set_message('required', 'Het {field} veld is verplicht.');
$ci->form_validation->set_message('isset','Het {field} veld mag niet leeg zijn.');
$ci->form_validation->set_message('valid_email', 'Het {field} veld moet een geldig e-mailadres zijn.');
$ci->form_validation->set_message('valid_emails', 'Het {field} veld moet geldige e-mailadressen bevatten.');
$ci->form_validation->set_message('valid_url', 'Het {field} veld moet een geldige URL zijn.');
$ci->form_validation->set_message('valid_ip', 'Het {field} veld moet een geldig IP-adres zijn.');
$ci->form_validation->set_message('min_length', 'Het {field} veld moet minimaal {param} karakters lang zijn.');
$ci->form_validation->set_message('max_length', 'Het {field} veld mag maximaal {param} karakters lang zijn.');
$ci->form_validation->set_message('exact_length', 'Het {field} veld moet precies {param} karakters lang zijn.');
$ci->form_validation->set_message('alpha', 'Het {field} veld mag alleen alfabetische karakters bevatten.');
$ci->form_validation->set_message('alpha_numeric', 'Het {field} veld mag alleen alfanumerieke karaktertekens bevatten.');
$ci->form_validation->set_message('alpha_numeric_spaces', 'Het {field} veld mag alleen alfanumerieke karakters en spaties bevatten.');
$ci->form_validation->set_message('alpha_dash', 'Het {field} veld mag alleen alfanumerieke karakters, underscores, en het minteken bevatten.');
$ci->form_validation->set_message('numeric', 'Het {field} veld mag alleen cijfers bevatten.');
$ci->form_validation->set_message('is_numeric', 'Het {field} veld mag alleen numerieke waarden bevatten.');
$ci->form_validation->set_message('integer', 'Het {field} veld mag alleen gehele getallen bevatten.');
$ci->form_validation->set_message('regex_match', 'Het {field} veld heeft niet het juiste formaat.');
$ci->form_validation->set_message('matches', 'Het {field} veld komt niet overeen met het {param} veld.');
$ci->form_validation->set_message('differs', 'Het {field} veld mag niet hetzelfde zijn als het {param} veld.');
$ci->form_validation->set_message('is_natural', 'Het {field} veld moet een natuurlijk getal zijn.');
$ci->form_validation->set_message('is_natural_no_zero', 'Het {field} veld moet een geheel getal groter dan nul zijn.');
$ci->form_validation->set_message('decimal', 'Het {field} veld moet een decimaal getal zijn.');
$ci->form_validation->set_message('less_than', 'Het {field} veld moet kleiner dan {param} zijn.');
$ci->form_validation->set_message('less_than_equal_to', 'Het {field} veld moet kleiner dan of gelijk aan {param} zijn.');
$ci->form_validation->set_message('greater_than', 'Het {field}-veld moet groter dan {param} zijn.');
$ci->form_validation->set_message('greater_than_equal_to', 'Het {field}-veld moet groter dan of gelijk aan {param} te zijn.');
$ci->form_validation->set_message('error_message_not_set', 'Tijdens de validatie van het {field}-veld is een ongedefiniëerde fout opgetreden.');
$ci->form_validation->set_message('in_list', 'Het {field}-veld moet één van de volgende waarden bevatten: {param}.');