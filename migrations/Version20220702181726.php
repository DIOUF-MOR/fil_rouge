<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702181726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27FCF26AD0');
        $this->addSql('DROP INDEX IDX_29A5EC27FCF26AD0 ON produit');
        $this->addSql('ALTER TABLE produit DROP produit_commande_id');
        $this->addSql('ALTER TABLE produit_commande ADD produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_47F5946EF347EFB ON produit_commande (produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD produit_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27FCF26AD0 FOREIGN KEY (produit_commande_id) REFERENCES produit_commande (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27FCF26AD0 ON produit (produit_commande_id)');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946EF347EFB');
        $this->addSql('DROP INDEX UNIQ_47F5946EF347EFB ON produit_commande');
        $this->addSql('ALTER TABLE produit_commande DROP produit_id');
    }
}
