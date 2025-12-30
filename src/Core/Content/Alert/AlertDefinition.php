<?php declare(strict_types=1);

namespace Rootrifs\CustomAlerts\Core\Content\Alert;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Rootrifs\CustomAlerts\Core\Content\Alert\Aggregate\AlertTranslation\AlertTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\System\SalesChannel\SalesChannelDefinition;
use Shopware\Core\Content\Rule\RuleDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;

class AlertDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'rootrifs_custom_alert';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return AlertCollection::class;
    }

    public function getEntityClass(): string
    {
        return AlertEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            new FkField('sales_channel_id', 'salesChannelId', SalesChannelDefinition::class),
            new FkField('rule_id', 'ruleId', RuleDefinition::class),
            new StringField('internal_title', 'internalTitle'),
            new BoolField('active', 'active'),
            (new StringField('style', 'style'))->addFlags(new Required()),
            (new StringField('position', 'position'))->addFlags(new Required()),
            new TranslatedField('heading'),
            new TranslatedField('message'),
            new TranslationsAssociationField(AlertTranslationDefinition::class, 'rootrifs_custom_alert_id'),
            new ManyToOneAssociationField('salesChannel', 'sales_channel_id', SalesChannelDefinition::class, 'id', false),
            new ManyToOneAssociationField('rule', 'rule_id', RuleDefinition::class, 'id', false),
            ]);
    }
}