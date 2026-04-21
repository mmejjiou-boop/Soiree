<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260421094526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dj (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, style VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE soiree_dj (soiree_id INT NOT NULL, dj_id INT NOT NULL, INDEX IDX_E8144C31BA021F7B (soiree_id), INDEX IDX_E8144C31670B2DD5 (dj_id), PRIMARY KEY (soiree_id, dj_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE soiree_dj ADD CONSTRAINT FK_E8144C31BA021F7B FOREIGN KEY (soiree_id) REFERENCES soiree (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE soiree_dj ADD CONSTRAINT FK_E8144C31670B2DD5 FOREIGN KEY (dj_id) REFERENCES dj (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soiree_dj DROP FOREIGN KEY FK_E8144C31BA021F7B');
        $this->addSql('ALTER TABLE soiree_dj DROP FOREIGN KEY FK_E8144C31670B2DD5');
        $this->addSql('DROP TABLE dj');
        $this->addSql('DROP TABLE soiree_dj');
    }
}
