<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715080910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_characteristic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE scalar_typed_attribute_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE media_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE feedback_dto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE groups_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE not_done_job_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64C19C1727ACA70 ON category (parent_id)');
        $this->addSql('CREATE TABLE product_characteristic (id INT NOT NULL, attribute_id INT DEFAULT NULL, product_id INT DEFAULT NULL, int_value INT DEFAULT NULL, varchar_value VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_146D77CB6E62EFA ON product_characteristic (attribute_id)');
        $this->addSql('CREATE INDEX IDX_146D77C4584665A ON product_characteristic (product_id)');
        $this->addSql('CREATE TABLE scalar_typed_attribute (id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE TABLE product_images (product_id INT NOT NULL, image_id INT NOT NULL, PRIMARY KEY(product_id, image_id))');
        $this->addSql('CREATE INDEX IDX_8263FFCE4584665A ON product_images (product_id)');
        $this->addSql('CREATE INDEX IDX_8263FFCE3DA5256D ON product_images (image_id)');
        $this->addSql('CREATE TABLE media (id INT NOT NULL, path VARCHAR(255) NOT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE feedback_dto (id INT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE groups (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE token (id INT NOT NULL, user_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F37A13BA76ED395 ON token (user_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_groups (user_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(user_id, group_id))');
        $this->addSql('CREATE INDEX IDX_953F224DA76ED395 ON user_groups (user_id)');
        $this->addSql('CREATE INDEX IDX_953F224DFE54D947 ON user_groups (group_id)');
        $this->addSql('CREATE TABLE not_done_job (id INT NOT NULL, payload VARCHAR(255) NOT NULL, event_date_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_characteristic ADD CONSTRAINT FK_146D77CB6E62EFA FOREIGN KEY (attribute_id) REFERENCES scalar_typed_attribute (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_characteristic ADD CONSTRAINT FK_146D77C4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_images ADD CONSTRAINT FK_8263FFCE4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_images ADD CONSTRAINT FK_8263FFCE3DA5256D FOREIGN KEY (image_id) REFERENCES media (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE token ADD CONSTRAINT FK_5F37A13BA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_groups ADD CONSTRAINT FK_953F224DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_groups ADD CONSTRAINT FK_953F224DFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product_characteristic DROP CONSTRAINT FK_146D77CB6E62EFA');
        $this->addSql('ALTER TABLE product_characteristic DROP CONSTRAINT FK_146D77C4584665A');
        $this->addSql('ALTER TABLE product_images DROP CONSTRAINT FK_8263FFCE4584665A');
        $this->addSql('ALTER TABLE product_images DROP CONSTRAINT FK_8263FFCE3DA5256D');
        $this->addSql('ALTER TABLE user_groups DROP CONSTRAINT FK_953F224DFE54D947');
        $this->addSql('ALTER TABLE token DROP CONSTRAINT FK_5F37A13BA76ED395');
        $this->addSql('ALTER TABLE user_groups DROP CONSTRAINT FK_953F224DA76ED395');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_characteristic_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE scalar_typed_attribute_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE media_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE feedback_dto_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE groups_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE token_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE not_done_job_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product_characteristic');
        $this->addSql('DROP TABLE scalar_typed_attribute');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_images');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE feedback_dto');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE token');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE user_groups');
        $this->addSql('DROP TABLE not_done_job');
    }
}
