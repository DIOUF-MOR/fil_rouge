<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702205523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lignecommande ADD produit_id INT DEFAULT NULL, ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lignecommande ADD CONSTRAINT FK_853B7939F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE lignecommande ADD CONSTRAINT FK_853B793982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_853B7939F347EFB ON lignecommande (produit_id)');
        $this->addSql('CREATE INDEX IDX_853B793982EA2E54 ON lignecommande (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lignecommande DROP FOREIGN KEY FK_853B7939F347EFB');
        $this->addSql('ALTER TABLE lignecommande DROP FOREIGN KEY FK_853B793982EA2E54');
        $this->addSql('DROP INDEX IDX_853B7939F347EFB ON lignecommande');
        $this->addSql('DROP INDEX IDX_853B793982EA2E54 ON lignecommande');
        $this->addSql('ALTER TABLE lignecommande DROP produit_id, DROP commande_id');
    }
}
