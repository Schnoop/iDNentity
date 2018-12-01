<?php namespace Idnentity\Kinds\Symfony;

use Idnentity\Kinds\Composer\AbstractComposerKind;

/**
 * Class SymfonyAboveEqual2
 *
 * @package Idnentity\Kinds\Symfony
 */
class SymfonyAboveEqual2 extends AbstractComposerKind
{

    /**
     * @var string
     */
    protected $software = 'Symfony';

    /**
     *
     */
    const COMPOSER_PACKAGE = 'symfony/framework-bundle';

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
