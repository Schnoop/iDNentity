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
        $directories = glob($this->realPath . 'wp-content/plugins' . '/*', GLOB_ONLYDIR);
        $extensions = [];
        foreach ($directories as $directory) {
            $extensions[] = $this->parseExtensionConfig($directory);
        }
        return $extensions;
    }

    /**
     * Parse an WordPress plugin file and return values.
     *
     * @param string $directory
     *
     * @return array
     */
    protected function parseExtensionConfig($directory)
    {
        $explodedPath = explode('/', $directory);
        $filename = end($explodedPath) . '.php';

        $content = file_get_contents($directory . '/' . $filename);
        return [
            'title' => trim($this->pregMatch('/Plugin Name:(.*)/m', $content)),
            'version' => trim($this->pregMatch('/Version:(.*)/m', $content)),
            'author' => trim($this->pregMatch('/Author:(.*)/m', $content)),
        ];
    }
}
