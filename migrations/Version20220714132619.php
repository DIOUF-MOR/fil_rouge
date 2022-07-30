<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220714132619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boissontaille ADD boisson_id INT DEFAULT NULL, ADD taille_id INT DEFAULT NULL, ADD lignecommande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boissontaille ADD CONSTRAINT FK_D1041CEC734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('ALTER TABLE boissontaille ADD CONSTRAINT FK_D1041CECFF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE boissontaille ADD CONSTRAINT FK_D1041CEC20D3031 FOREIGN KEY (lignecommande_id) REFERENCES lignecommande (id)');
        $this->addSql('CREATE INDEX IDX_D1041CEC734B8089 ON boissontaille (boisson_id)');
        $this->addSql('CREATE INDEX IDX_D1041CECFF25611A ON boissontaille (taille_id)');
        $this->addSql('CREATE INDEX IDX_D1041CEC20D3031 ON boissontaille (lignecommande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boissontaille DROP FOREIGN KEY FK_D1041CEC734B8089');
        $this->addSql('ALTER TABLE boissontaille DROP FOREIGN KEY FK_D1041CECFF25611A');
        $this->addSql('ALTER TABLE boissontaille DROP FOREIGN KEY FK_D1041CEC20D3031');
        $this->addSql('DROP INDEX IDX_D1041CEC734B8089 ON boissontaille');
        $this->addSql('DROP INDEX IDX_D1041CECFF25611A ON boissontaille');
        $this->addSql('DROP INDEX IDX_D1041CEC20D3031 ON boissontaille');
        $this->addSql('ALTER TABLE boissontaille DROP boisson_id, DROP taille_id, DROP lignecommande_id');
    }
}
