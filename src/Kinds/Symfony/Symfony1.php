<?php namespace Idnentity\Kinds\Symfony;

use Idnentity\Kinds\AbstractKind;

/**
 * Class Symfony1
 *
 * @package Idnentity\Kinds\Symfony
 */
class Symfony1 extends AbstractKind
{

    const CONFIG_FILE = '../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';

    /**
     * @var string
     */
    protected $software = 'Symfony';

    /**
     * @return boolean
     */
    public function isKindOf()
    {
        return file_exists($this->realPath . self::CONFIG_FILE);
    }

    /**
     * @return string
     */
    protected function parseVersion()
    {
        return $this->pregMatch('/define\(\'SYMFONY_VERSION\', \'(.*)\'\);/m', file_get_contents($this->realPath . self::CONFIG_FILE));
    }

    /**
     * @return array
     */
    protected function parseExtensions()
    {
        return [];
    }
}
