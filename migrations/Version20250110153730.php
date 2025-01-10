<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250110153730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pizza_ingredients (pizza_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_AD0714F6D41D1D42 (pizza_id), INDEX IDX_AD0714F63EC4DCE (ingredients_id), PRIMARY KEY(pizza_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pizza_ingredients ADD CONSTRAINT FK_AD0714F6D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_ingredients ADD CONSTRAINT FK_AD0714F63EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_pizza DROP FOREIGN KEY FK_A182FD5A3EC4DCE');
        $this->addSql('ALTER TABLE ingredients_pizza DROP FOREIGN KEY FK_A182FD5AD41D1D42');
        $this->addSql('DROP TABLE ingredients_pizza');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredients_pizza (ingredients_id INT NOT NULL, pizza_id INT NOT NULL, INDEX IDX_A182FD5A3EC4DCE (ingredients_id), INDEX IDX_A182FD5AD41D1D42 (pizza_id), PRIMARY KEY(ingredients_id, pizza_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ingredients_pizza ADD CONSTRAINT FK_A182FD5A3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_pizza ADD CONSTRAINT FK_A182FD5AD41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_ingredients DROP FOREIGN KEY FK_AD0714F6D41D1D42');
        $this->addSql('ALTER TABLE pizza_ingredients DROP FOREIGN KEY FK_AD0714F63EC4DCE');
        $this->addSql('DROP TABLE pizza_ingredients');
    }
}
