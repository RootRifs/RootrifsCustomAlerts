<?php declare(strict_types=1);

namespace Rootrifs\CustomAlerts\Core\Content\Alert;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void              add(AlertEntity $entity)
 * @method void              set(string $key, AlertEntity $entity)
 * @method AlertEntity[]    getIterator()
 * @method AlertEntity[]    getElements()
 * @method AlertEntity|null get(string $key)
 * @method AlertEntity|null first()
 * @method AlertEntity|null last()
 */
class AlertCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return AlertEntity::class;
    }
}