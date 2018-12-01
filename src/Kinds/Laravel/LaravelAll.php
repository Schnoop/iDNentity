<?php namespace Idnentity\Kinds\Laravel;

use Idnentity\Kinds\Composer\AbstractComposerKind;

/**
 * Class LaravelAll
 *
 * @package Idnentity\Kinds\Laravel
 */
class LaravelAll extends AbstractComposerKind
{

    /**
     * @var string
     */
    protected $software = 'Laravel';

    /**
     *
     */
    const COMPOSER_PACKAGE = 'laravel/framework';

    /**
     * Returns true if current installation is kind of ComposerAboveEqual62
     *
     * @return bool
     */
    public function isKindOf()
    {
        return $this->isComposerPowered() === true && $this->composerRequires(self::COMPOSER_PACKAGE);
    }

    /**
     * Parse TYPO3 version.
     *
     * @return string|null
     */
    protected function parseVersion()
    {
        $composerPackages = $this->getComposerDetails();
        return $this->cleanVersionNumber($composerPackages[self::COMPOSER_PACKAGE]->version);
    }

}
