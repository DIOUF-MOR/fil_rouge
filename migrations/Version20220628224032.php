<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628224032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tailleboisson (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tailleboisson_boisson (tailleboisson_id INT NOT NULL, boisson_id INT NOT NULL, INDEX IDX_797822A436F1CA00 (tailleboisson_id), INDEX IDX_797822A4734B8089 (boisson_id), PRIMARY KEY(tailleboisson_id, boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tailleboisson_boisson ADD CONSTRAINT FK_797822A436F1CA00 FOREIGN KEY (tailleboisson_id) REFERENCES tailleboisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tailleboisson_boisson ADD CONSTRAINT FK_797822A4734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tailleboisson_boisson DROP FOREIGN KEY FK_797822A436F1CA00');
        $this->addSql('DROP TABLE tailleboisson');
        $this->addSql('DROP TABLE tailleboisson_boisson');
    }
}
