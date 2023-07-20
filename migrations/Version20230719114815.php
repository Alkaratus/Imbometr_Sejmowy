<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230719114815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nick (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nick_representative (nick_id INT NOT NULL, representative_id INT NOT NULL, INDEX IDX_577958AEC2ABD7E9 (nick_id), INDEX IDX_577958AEFC3FF006 (representative_id), PRIMARY KEY(nick_id, representative_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nick_representative ADD CONSTRAINT FK_577958AEC2ABD7E9 FOREIGN KEY (nick_id) REFERENCES nick (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nick_representative ADD CONSTRAINT FK_577958AEFC3FF006 FOREIGN KEY (representative_id) REFERENCES representative (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nick_representative DROP FOREIGN KEY FK_577958AEC2ABD7E9');
        $this->addSql('ALTER TABLE nick_representative DROP FOREIGN KEY FK_577958AEFC3FF006');
        $this->addSql('DROP TABLE nick');
        $this->addSql('DROP TABLE nick_representative');
    }
}
