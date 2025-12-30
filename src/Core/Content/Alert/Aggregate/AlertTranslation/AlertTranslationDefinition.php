<?php declare(strict_types=1);

namespace Rootrifs\CustomAlerts\Core\Content\Alert\Aggregate\AlertTranslation;

use Rootrifs\CustomAlerts\Core\Content\Alert\AlertDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\AllowHtml;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class AlertTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = 'rootrifs_custom_alert_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getParentDefinitionClass(): string
    {
        return AlertDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            new StringField('heading', 'heading'),
            (new LongTextField('message', 'message'))->addFlags(new Required(), new AllowHtml()),
        ]);
    }
}