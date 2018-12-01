<?php namespace Idnentity\Kinds\Composer;

use Idnentity\Kinds\AbstractKind;

/**
 * Class AbstractComposerKind
 *
 * @package Idnentity\Kinds\Composer
 */
abstract class AbstractComposerKind extends AbstractKind
{

    /**
     *
     */
    const COMPOSER_INSTALLED = '../vendor/composer/installed.json';

    /**
     * @var array
     */
    protected $composerPackages;

    /**
     * @return boolean
     */
    protected function isComposerPowered()
    {
        return file_exists($this->realPath . self::COMPOSER_INSTALLED);
    }

    /**
     * @return array
     */
    protected function getComposerDetails()
    {
        if ($this->composerPackages !== null) {
            return $this->composerPackages;
        }
        $composerJson = $this->loadJsonFile($this->realPath . self::COMPOSER_INSTALLED);
        $packages = [];
        foreach ($composerJson as $package) {
            $packages[$package->name] = $package;
        }
        $this->composerPackages = $packages;
        return $this->composerPackages;
    }

    /**
     * @param string $package
     *
     * @return boolean
     */
    protected function composerRequires($package)
    {
        $installedPackages = $this->getComposerDetails();
        return isset($installedPackages[$package]);
    }

    /**
     * Parse all used extensions out of composer file.
     *
     * @return array
     */
    protected function parseExtensions()
    {
        $composerPackages = $this->getComposerDetails();
        $extensions = [];
        foreach ($composerPackages as $identifier => $extensionConfig) {
            $extension = [
                'title' => $extensionConfig->name,
                'version' => $this->cleanVersionNumber($extensionConfig->version)
            ];
            if (isset($extensionConfig->authors[0]->name) === true) {
                $extension['author'] = $extensionConfig->authors[0]->name;
            }
            $extensions[] = $extension;
        }
        return $extensions;
    }
}
