<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503122923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE post ALTER user_name SET NOT NULL');
        $this->addSql('ALTER TABLE post ALTER title SET NOT NULL');
        $this->addSql('ALTER TABLE post ALTER body SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE post_id_seq');
        $this->addSql('SELECT setval(\'post_id_seq\', (SELECT MAX(id) FROM post))');
        $this->addSql('ALTER TABLE post ALTER id SET DEFAULT nextval(\'post_id_seq\')');
        $this->addSql('ALTER TABLE post ALTER user_name DROP NOT NULL');
        $this->addSql('ALTER TABLE post ALTER title DROP NOT NULL');
        $this->addSql('ALTER TABLE post ALTER body DROP NOT NULL');
    }
}
