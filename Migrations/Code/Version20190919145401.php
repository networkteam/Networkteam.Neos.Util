<?php
namespace Neos\Flow\Core\Migrations;

/**
 * Move class names in namespace String because string is a reserved keyword
 */
class Version20190919145401 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getIdentifier()
    {
        return 'Networkteam.Neos.Util-20190919145401';
    }

    public function up()
    {
        $this->searchAndReplace('Networkteam\Neos\Util\String\StringToIdSanitizer', 'Networkteam\Neos\Util\Sanitizer\StringToIdSanitizer', ['yaml', 'php']);
    }

    public function down()
    {
        $this->searchAndReplace('Networkteam\Neos\Util\Sanitizer\StringToIdSanitizer', 'Networkteam\Neos\Util\String\StringToIdSanitizer', ['yaml', 'php']);
    }
}
