<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230720052804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, representative_id INT NOT NULL, event_type_id INT NOT NULL, date DATETIME NOT NULL, description VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, INDEX IDX_3BAE0AA7FC3FF006 (representative_id), INDEX IDX_3BAE0AA7401B253C (event_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, representative_id INT NOT NULL, content VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_6B71CBF4FC3FF006 (representative_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7FC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7401B253C FOREIGN KEY (event_type_id) REFERENCES event_type (id)');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF4FC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7FC3FF006');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7401B253C');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF4FC3FF006');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE quote');
    }
}
