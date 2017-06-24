<?php

namespace SimPow\Core\Maker;

use SimPow\Core\Exception\SimPowException;

class JsonFileReader extends FileReader
{
    protected function perform()
    {
        parent::perform();

        $this->content = json_decode($this->content, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new SimPowException(sprintf('Error in json file  "%s" : %s', $this->file, json_last_error_msg()));
        }
    }
}