<?php

namespace SimPow\Core;

use SimPow\Core\Exception\SimPowException;
use SimPow\Core\Maker\ConfigurationComparator;
use SimPow\Core\Maker\JsonFileReader;

class SimPow
{
    /** @var array */
    private $config;

    /** @var string */
    private $output;

    public function run()
    {
        $this->load();
        $this->verify();
        $this->build();
        $this->display();
    }

    /**
     * @throws SimPowException
     */
    private function load()
    {
        $reader = new JsonFileReader();

        $this->config = $reader->getContents('config/config.json');
    }

    private function verify()
    {
        $comparator = new ConfigurationComparator();
        $comparator->check($this->config);
    }

    private function build()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../template');
        $twig = new \Twig_Environment($loader, array(
            'cache' => __DIR__ . '/../cache',
        ));

        $this->output = $twig->render('default.html.twig', $this->config);
    }

    private function display()
    {
        echo $this->output;
    }
}