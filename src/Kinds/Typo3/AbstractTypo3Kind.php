<?php namespace Idnentity\Kinds\Typo3;

use Idnentity\Kinds\AbstractKind;

/**
 * Class AbstractTypo3Kind
 *
 * @package Idnentity\Kinds\Typo3
 */
abstract class AbstractTypo3Kind extends AbstractKind
{

    /**
     * @var string
     */
    protected $software = 'TYPO3 CMS';

    /**
     * Parse TYPO3 version.
     *
     * @return string|null
     */
    protected function parseVersion()
    {
        return $this->pregMatch($this->regexp, file_get_contents($this->realPath . $this->configFile));
    }

    /**
     * Parse all extensions configuration and return array with detailed information.
     *
     * @return array
     */
    protected function parseExtensions()
    {
        $directories = glob($this->realPath . 'typo3conf/ext' . '/*', GLOB_ONLYDIR);
        $extensions = [];
        foreach ($directories as $directory) {
            $extensions[] = $this->parseExtensionConfig($directory);
        }
        return $extensions;
    }

    /**
     * Parse an ext_emconf.php and return values.
     *
     * @param string $directory
     *
     * @return array
     */
    protected function parseExtensionConfig($directory)
    {
        $content = file_get_contents($directory . '/ext_emconf.php');
        return [
            'title' => $this->pregMatch('/\'title\' => \'(.*)\'/m', $content),
            'version' => $this->pregMatch('/\'version\' => \'(.*)\'/m', $content),
            'author' => $this->pregMatch('/\'author\' => \'(.*)\'/m', $content),
        ];
    }

    /**
     * Returns true if current installation is kind of TYPO3
     *
     * @return bool
     */
    public function isKindOf()
    {
        return file_exists($this->realPath . $this->configFile);
    }

}
