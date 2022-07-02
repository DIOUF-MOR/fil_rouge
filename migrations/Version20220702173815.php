<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702173815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_commande (client_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_400C96B819EB6921 (client_id), INDEX IDX_400C96B882EA2E54 (commande_id), PRIMARY KEY(client_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_commande ADD CONSTRAINT FK_400C96B819EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_commande ADD CONSTRAINT FK_400C96B882EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD gestionnaire_id INT DEFAULT NULL, ADD livraison_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D6885AC1B ON commande (gestionnaire_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D8E54FB25 ON commande (livraison_id)');
        $this->addSql('ALTER TABLE livraison ADD gestionnaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F6885AC1B ON livraison (gestionnaire_id)');
        $this->addSql('ALTER TABLE quartier ADD gestionnaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quartier ADD CONSTRAINT FK_FEE8962D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('CREATE INDEX IDX_FEE8962D6885AC1B ON quartier (gestionnaire_id)');
        $this->addSql('ALTER TABLE zone ADD gestionnaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE zone ADD CONSTRAINT FK_A0EBC0076885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('CREATE INDEX IDX_A0EBC0076885AC1B ON zone (gestionnaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE client_commande');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D6885AC1B');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('DROP INDEX IDX_6EEAA67D6885AC1B ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67D8E54FB25 ON commande');
        $this->addSql('ALTER TABLE commande DROP gestionnaire_id, DROP livraison_id');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F6885AC1B');
        $this->addSql('DROP INDEX IDX_A60C9F1F6885AC1B ON livraison');
        $this->addSql('ALTER TABLE livraison DROP gestionnaire_id');
        $this->addSql('ALTER TABLE quartier DROP FOREIGN KEY FK_FEE8962D6885AC1B');
        $this->addSql('DROP INDEX IDX_FEE8962D6885AC1B ON quartier');
        $this->addSql('ALTER TABLE quartier DROP gestionnaire_id');
        $this->addSql('ALTER TABLE zone DROP FOREIGN KEY FK_A0EBC0076885AC1B');
        $this->addSql('DROP INDEX IDX_A0EBC0076885AC1B ON zone');
        $this->addSql('ALTER TABLE zone DROP gestionnaire_id');
    }
}
