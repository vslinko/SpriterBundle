<?php
/**
 * @copyright 2012 Rithis Studio LLC
 * @author Vyacheslav Slinko <vyacheslav.slinko@rithis.com>
 */

namespace Rithis\SpriterBundle\Command;

use Rithis\Spriter\Command\CssCommand as Command;

class CssCommand extends Command
{
    protected function configure()
    {
        parent::configure();
        $this->setName('spriter:css');
    }
}
