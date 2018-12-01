<?php namespace Idnentity\Kinds;

/**
 * Class AbstractKind
 *
 * @package Idnentity\Kinds
 */
abstract class AbstractKind
{

    /**
     * @var string
     */
    protected $regexp;

    /**
     * @var string
     */
    protected $configFile;

    /**
     * @var string
     */
    protected $realPath;

    /**
     * @var string
     */
    protected $software;

    /**
     * @var array
     */
    protected $composerPackages;

    /**
     * AbstractKind constructor.
     *
     * @param string $realPath
     */
    public function __construct($realPath)
    {
        $this->realPath = rtrim($realPath, '/') . '/';
    }

    /**
     * @param string $file
     *
     * @return \stdClass
     */
    protected function loadJsonFile($file)
    {
        return json_decode(file_get_contents($file));
    }

    /**
     * Clean version number
     *
     * @param string $versionNumber
     *
     * @return string
     */
    protected function cleanVersionNumber($versionNumber)
    {
        return str_replace('v', '', $versionNumber);
    }

    /**
     * Returns current server address
     *
     * @return string
     */
    protected function getServerAddress()
    {
        if (isset($_SERVER['SERVER_ADDR']) === true) {
            return $_SERVER['SERVER_ADDR'];
        }
        return gethostname();
    }

    /**
     * @return boolean
     */
    abstract public function isKindOf();

    /**
     * @return string
     */
    abstract protected function parseVersion();

    /**
     * @return array
     */
    abstract protected function parseExtensions();

    /**
     * Returns an array with detailed information about current installation.
     *
     * array
     */
    public function getDetails()
    {
        return [
            'ip_address' => $this->getServerAddress(),
            'php_version' => implode('.', [PHP_MAJOR_VERSION, PHP_MINOR_VERSION, PHP_RELEASE_VERSION]),
            'type' => $this->software,
            'version' => $this->parseVersion(),
            'extensions' => $this->parseExtensions()
        ];
    }

    /**
     * Parse something using $expression out of $content.
     *
     * @param string $expression
     * @param string $content
     *
     * @return string|null
     */
    protected function pregMatch($expression, $content)
    {
        $result = preg_match_all(
            $expression,
            $content,
            $matches,
            PREG_SET_ORDER,
            0
        );

        if ($result !== false) {
            return $matches[0][1];
        }

        return null;
    }
}
