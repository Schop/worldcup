<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');

        $site_lang = $ci->session->userdata('site_lang');
        if ($site_lang) {
            $ci->lang->load(array('auth','ion_auth'), $ci->session->userdata('site_lang'));
        } else {
            $ci->lang->load(array('auth','ion_auth'),'english');
        }

    }
}