<?php namespace Idnentity\Kinds\Typo3;

/**
 * Class Classic61
 *
 * @package Idnentity\Kinds\Typo3
 */
class Classic61 extends AbstractTypo3Kind
{

    /**
     * @var string
     */
    protected $regexp = '/define\(\'TYPO3_version\', \'(.*)\'\)/m';

    /**
     * @var string
     */
    protected $configFile = 'typo3/sysext/core/Classes/Core/SystemEnvironmentBuilder.php';

}
