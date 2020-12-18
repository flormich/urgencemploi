<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190121093135 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE jobs (id INT AUTO_INCREMENT NOT NULL, contrast_id INT NOT NULL, category_id INT NOT NULL, title_job VARCHAR(255) NOT NULL, places_job VARCHAR(255) DEFAULT NULL, postal_code_job VARCHAR(5) DEFAULT NULL, name_comp_job VARCHAR(255) NOT NULL, salary_range_job INT DEFAULT NULL, description_job VARCHAR(255) DEFAULT NULL, phone_job VARCHAR(15) DEFAULT NULL, mail_job VARCHAR(190) NOT NULL, INDEX IDX_A8936DC54596777F (contrast_id), INDEX IDX_A8936DC512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name_roles VARCHAR(16) NOT NULL, value_roles VARCHAR(16) NOT NULL, UNIQUE INDEX name_id (name_roles), UNIQUE INDEX value_id (value_roles), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id_user INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, username VARCHAR(190) NOT NULL, firstname VARCHAR(190) DEFAULT NULL, lastname VARCHAR(190) DEFAULT NULL, password VARCHAR(64) NOT NULL, phone VARCHAR(15) DEFAULT NULL, mail VARCHAR(190) NOT NULL, INDEX IDX_1483A5E9D60322AC (role_id), UNIQUE INDEX username_id (username), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_job (id INT AUTO_INCREMENT NOT NULL, name_cat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrast (id INT AUTO_INCREMENT NOT NULL, type_contrast VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_jobs (id INT AUTO_INCREMENT NOT NULL, jobs_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_671A23CBAD650CA2 (jobs_id), INDEX IDX_671A23CB98333A1E (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jobs ADD CONSTRAINT FK_A8936DC54596777F FOREIGN KEY (contrast_id) REFERENCES contrast (id)');
        $this->addSql('ALTER TABLE jobs ADD CONSTRAINT FK_A8936DC512469DE2 FOREIGN KEY (category_id) REFERENCES category_job (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE users_jobs ADD CONSTRAINT FK_671A23CBAD650CA2 FOREIGN KEY (jobs_id) REFERENCES jobs (id)');
        $this->addSql('ALTER TABLE users_jobs ADD CONSTRAINT FK_671A23CB98333A1E FOREIGN KEY (users_id) REFERENCES users (id_user)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_jobs DROP FOREIGN KEY FK_671A23CBAD650CA2');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9D60322AC');
        $this->addSql('ALTER TABLE users_jobs DROP FOREIGN KEY FK_671A23CB98333A1E');
        $this->addSql('ALTER TABLE jobs DROP FOREIGN KEY FK_A8936DC512469DE2');
        $this->addSql('ALTER TABLE jobs DROP FOREIGN KEY FK_A8936DC54596777F');
        $this->addSql('DROP TABLE jobs');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE category_job');
        $this->addSql('DROP TABLE contrast');
        $this->addSql('DROP TABLE users_jobs');
    }
}
