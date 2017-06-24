<?php

namespace SimPow\Core\Maker;

use SimPow\Core\Exception\SimPowException;

class ConfigurationComparator
{
    public function check(array $config)
    {
        $reader = new JsonFileReader();
        $sample = $reader->getContents(__DIR__ . '/../../config/config.sample.json');

        $this->compare($sample, $config);
    }

    private function compare($sample, $config, $key = null)
    {
        if (is_array($sample)) {

            if (!is_array($config)) {
                throw new SimPowException(sprintf('"%s" must be an array', $key ? $key : 'config.json'));
            }

            foreach ($sample as $sampleKey => $sampleArray) {
                if (!array_key_exists($sampleKey, $config)) {
                    if (is_integer($sampleKey)) {
                        continue;
                    }

                    throw new SimPowException(sprintf('Key "%s" not found in "%s"', $sampleKey,
                        $key ? $key : 'config.json'));
                }

                $this->compare($sampleArray, $config[$sampleKey], sprintf('%s.%s', $key, $sampleKey));
            }
        } else {
            if (gettype($sample) !== gettype($config)) {
                throw new SimPowException(sprintf('Value for "%s" must be "%s"', $key ? $key : 'config.json',
                    gettype($sample)));
            }
        }
    }
}