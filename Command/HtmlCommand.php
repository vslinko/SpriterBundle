<?php
/**
 * @copyright 2012 Rithis Studio LLC
 * @author Vyacheslav Slinko <vyacheslav.slinko@rithis.com>
 */

namespace Rithis\SpriterBundle\Command;

use Rithis\Spriter\Command\HtmlCommand as Command;

class HtmlCommand extends Command
{
    protected function configure()
    {
        parent::configure();
        $this->setName('spriter:html');
    }
}
