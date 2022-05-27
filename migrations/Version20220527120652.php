<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220527120652 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE url (id UUID NOT NULL, url TEXT NOT NULL, minimizing_url VARCHAR(255) NOT NULL, ttl TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX minimizing_url_unique_idx ON url (minimizing_url)');
        $this->addSql('COMMENT ON COLUMN url.id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE url');
    }
}
