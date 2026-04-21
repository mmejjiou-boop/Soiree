<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260421122034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soiree ADD theme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE soiree ADD CONSTRAINT FK_131F30D259027487 FOREIGN KEY (theme_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_131F30D259027487 ON soiree (theme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soiree DROP FOREIGN KEY FK_131F30D259027487');
        $this->addSql('DROP INDEX IDX_131F30D259027487 ON soiree');
        $this->addSql('ALTER TABLE soiree DROP theme_id');
    }
}
