<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430204903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
{
    $this->addSql('CREATE TABLE post (
        id SERIAL PRIMARY KEY,
        user_id INT NOT NULL,
        user_name VARCHAR(255),
        title VARCHAR(255),
        body TEXT
    )');

    // Tu można dodać dodatkowe polecenia SQL, jeśli są potrzebne
}

public function down(Schema $schema): void
{
    $this->addSql('DROP TABLE post');
}

}
