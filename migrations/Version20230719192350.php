<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230719192350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meme (id INT AUTO_INCREMENT NOT NULL, template_id INT NOT NULL, title VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, INDEX IDX_4B9F79345DA0FB8 (template_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meme_template (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meme_template_representative (meme_template_id INT NOT NULL, representative_id INT NOT NULL, INDEX IDX_E745795A54092F5 (meme_template_id), INDEX IDX_E745795FC3FF006 (representative_id), PRIMARY KEY(meme_template_id, representative_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meme ADD CONSTRAINT FK_4B9F79345DA0FB8 FOREIGN KEY (template_id) REFERENCES meme_template (id)');
        $this->addSql('ALTER TABLE meme_template_representative ADD CONSTRAINT FK_E745795A54092F5 FOREIGN KEY (meme_template_id) REFERENCES meme_template (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meme_template_representative ADD CONSTRAINT FK_E745795FC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meme DROP FOREIGN KEY FK_4B9F79345DA0FB8');
        $this->addSql('ALTER TABLE meme_template_representative DROP FOREIGN KEY FK_E745795A54092F5');
        $this->addSql('ALTER TABLE meme_template_representative DROP FOREIGN KEY FK_E745795FC3FF006');
        $this->addSql('DROP TABLE meme');
        $this->addSql('DROP TABLE meme_template');
        $this->addSql('DROP TABLE meme_template_representative');
    }
}
