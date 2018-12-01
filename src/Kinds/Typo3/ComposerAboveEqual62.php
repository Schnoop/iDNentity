<?php namespace Idnentity\Kinds\Typo3;

use Idnentity\Kinds\Composer\AbstractComposerKind;

/**
 * Class Above60Composer
 *
 * @package Idnentity\Kinds\Typo3
 */
class ComposerAboveEqual62 extends AbstractComposerKind
{

    /**
     * @var string
     */
    protected $software = 'TYPO3 CMS';

    /**
     *
     */
    const COMPOSER_PACKAGE = 'typo3/cms';

    /**
     *
     */
    const TYPO3_COMPOSER_TER = 'typo3-ter';

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
            if (strpos($identifier, self::TYPO3_COMPOSER_TER) !== 0) {
                continue;
            }
            $extensions[] = [
                'title' => $extensionConfig->name,
                'version' => $this->cleanVersionNumber($extensionConfig->version),
                'author' => $extensionConfig->authors[0]->name,
            ];
        }
        return $extensions;
    }
}
