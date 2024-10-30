<?php

class Template
{

    protected $ci;
    var $template_data = [];

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function set($name, $value)
    {
        $this->template_data[$name] = $value;
    }

    function load($view = '', $view_data = [], $script = '', $return = FALSE)
    {
        $this->set('contents', $this->ci->load->view($view, $view_data, TRUE));
        $this->set('contents_script', $script !== '' ? $this->ci->load->view("_part/script/$script", ['view_data' => $view_data], TRUE) : '');
        return $this->ci->load->view('_part/template', $this->template_data, $return);
    }
}
