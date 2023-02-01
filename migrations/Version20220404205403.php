<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404205403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create invoices table';
    }

    public function up(Schema $schema): void
    {
        $invoices = $schema->createTable('invoices');
        $invoices->addColumn('id', 'integer', ['autoincrement' => true]);
        $invoices->addColumn('invoice_number', 'string', ['length' => 255]);
        $invoices->addColumn('amount', 'float');
        $invoices->addColumn('status', 'string', ['length' => 255]);
        $invoices->addColumn('created_at', 'datetime');
        $invoices->addColumn('due_date', 'datetime');
        $invoices->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('invoices');
    }
}