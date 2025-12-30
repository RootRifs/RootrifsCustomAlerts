<?php declare(strict_types=1);

namespace Rootrifs\CustomAlerts\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1767051308Alert extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1703760000;
    }

    public function update(Connection $connection): void
    {
        $connection->executeStatement('
            CREATE TABLE IF NOT EXISTS `rootrifs_custom_alert` (
                `id` BINARY(16) NOT NULL,
                `sales_channel_id` BINARY(16) DEFAULT NULL,
                `rule_id` BINARY(16) DEFAULT NULL,
                `internal_title` VARCHAR(255) DEFAULT NULL,
                `active` TINYINT(1) DEFAULT 0,
                `style` VARCHAR(255) NOT NULL,
                `position` VARCHAR(255) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) DEFAULT NULL,
                PRIMARY KEY (`id`),
                CONSTRAINT `fk.rootrifs_alert.sales_channel_id` FOREIGN KEY (`sales_channel_id`)
                    REFERENCES `sales_channel` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                CONSTRAINT `fk.rootrifs_alert.rule_id` FOREIGN KEY (`rule_id`)
                    REFERENCES `rule` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        $connection->executeStatement('
            CREATE TABLE IF NOT EXISTS `rootrifs_custom_alert_translation` (
                `rootrifs_custom_alert_id` BINARY(16) NOT NULL,
                `language_id` BINARY(16) NOT NULL,
                `message` LONGTEXT NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) DEFAULT NULL,
                PRIMARY KEY (`rootrifs_custom_alert_id`, `language_id`),
                CONSTRAINT `fk.alert_translation.alert_id` FOREIGN KEY (`rootrifs_custom_alert_id`)
                    REFERENCES `rootrifs_custom_alert` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.alert_translation.language_id` FOREIGN KEY (`language_id`)
                    REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');

        if (!$this->columnExists($connection, 'rootrifs_custom_alert_translation', 'heading')) {
            $connection->executeStatement('
                ALTER TABLE `rootrifs_custom_alert_translation` 
                ADD COLUMN `heading` VARCHAR(255) NULL AFTER `language_id`
            ');
        }
    }

    public function updateDestructive(Connection $connection): void
    {
    }

    private function columnExists(Connection $connection, string $table, string $column): bool
    {
        $columns = $connection->fetchAllAssociative(sprintf('SHOW COLUMNS FROM `%s` LIKE :column', $table), [
            'column' => $column,
        ]);

        return \count($columns) > 0;
    }
}
