<?php namespace Idnentity\Kinds\WordPress;

use Idnentity\Kinds\AbstractKind;

/**
 * Class LaravelAll
 *
 * @package Idnentity\Kinds\WordPress
 */
class WordPressAll extends AbstractKind
{

    const CONFIG_FILE = 'wp-includes/version.php';

    /**
     * @var string
     */
    protected $software = 'WordPress';

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
        return $this->pregMatch('/\$wp_version = \'(.*)\';/m', file_get_contents($this->realPath . self::CONFIG_FILE));
    }

    /**
     * @return array
     */
    protected function parseExtensions()
    {
        return [];
    }
}
