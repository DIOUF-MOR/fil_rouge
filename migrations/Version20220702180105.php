<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702180105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_commande_commande (produit_commande_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_5B5A2C8AFCF26AD0 (produit_commande_id), INDEX IDX_5B5A2C8A82EA2E54 (commande_id), PRIMARY KEY(produit_commande_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_commande_commande ADD CONSTRAINT FK_5B5A2C8AFCF26AD0 FOREIGN KEY (produit_commande_id) REFERENCES produit_commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_commande_commande ADD CONSTRAINT FK_5B5A2C8A82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE commande_produit');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFCF26AD0');
        $this->addSql('DROP INDEX IDX_6EEAA67DFCF26AD0 ON commande');
        $this->addSql('ALTER TABLE commande DROP produit_commande_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_produit (commande_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_DF1E9E87F347EFB (produit_id), INDEX IDX_DF1E9E8782EA2E54 (commande_id), PRIMARY KEY(commande_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E8782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE produit_commande_commande');
        $this->addSql('ALTER TABLE commande ADD produit_commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFCF26AD0 FOREIGN KEY (produit_commande_id) REFERENCES produit_commande (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DFCF26AD0 ON commande (produit_commande_id)');
    }
}
