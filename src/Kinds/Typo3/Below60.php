<?php namespace Idnentity\Kinds\Typo3;

/**
 * Class Below60
 *
 * @package Idnentity\Kinds\Typo3
 */
class Below60 extends AbstractTypo3Kind
{

    /**
     * @var string
     */
    protected $regexp = '/^\$TYPO_VERSION = \'(.*)\';/m';

    /**
     * @var string
     */
    protected $configFile = 't3lib/config_default.php';

}
