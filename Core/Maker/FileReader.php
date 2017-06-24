<?php

namespace SimPow\Core\Maker;

use SimPow\Core\Exception\SimPowException;

class FileReader
{
    /** @var  string */
    protected $content;

    /** @var  string */
    protected $file;

    public function getContents($file)
    {
        $this->file = $file;
        $this->perform();
        return $this->content;
    }

    protected function perform()
    {
        if (!file_exists($this->file)) {
            throw new SimPowException(sprintf('Unable to find file "%s"', $this->file));
        }

        if (!is_readable($this->file)) {
            throw new SimPowException(sprintf('Not enough right for file "%s"', $this->file));
        }

        $this->content = file_get_contents($this->file);
    }
}