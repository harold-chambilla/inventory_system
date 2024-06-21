<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621070020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorias (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(64) DEFAULT NULL, descripcion CLOB DEFAULT NULL)');
        $this->addSql('CREATE TABLE clientes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(64) DEFAULT NULL, contacto VARCHAR(64) DEFAULT NULL, direccion VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE detalles_venta (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, venta_id_id INTEGER DEFAULT NULL, producto_id_id INTEGER DEFAULT NULL, cantidad INTEGER DEFAULT NULL, precio_unitario NUMERIC(10, 2) DEFAULT NULL, subtotal NUMERIC(10, 2) DEFAULT NULL, CONSTRAINT FK_611AB2869F1AB70D FOREIGN KEY (venta_id_id) REFERENCES ventas (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_611AB2863F63963D FOREIGN KEY (producto_id_id) REFERENCES productos (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_611AB2869F1AB70D ON detalles_venta (venta_id_id)');
        $this->addSql('CREATE INDEX IDX_611AB2863F63963D ON detalles_venta (producto_id_id)');
        $this->addSql('CREATE TABLE producto_proveedores (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, producto_id_id INTEGER DEFAULT NULL, proveedor_id_id INTEGER DEFAULT NULL, precio_proveedor NUMERIC(10, 2) DEFAULT NULL, CONSTRAINT FK_522FD54B3F63963D FOREIGN KEY (producto_id_id) REFERENCES productos (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_522FD54B193A0047 FOREIGN KEY (proveedor_id_id) REFERENCES proveedores (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_522FD54B3F63963D ON producto_proveedores (producto_id_id)');
        $this->addSql('CREATE INDEX IDX_522FD54B193A0047 ON producto_proveedores (proveedor_id_id)');
        $this->addSql('CREATE TABLE productos (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categoria_id_id INTEGER DEFAULT NULL, nombre VARCHAR(64) DEFAULT NULL, descripcion CLOB DEFAULT NULL, precio NUMERIC(10, 2) DEFAULT NULL, stock INTEGER DEFAULT NULL, CONSTRAINT FK_767490E67E735794 FOREIGN KEY (categoria_id_id) REFERENCES categorias (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_767490E67E735794 ON productos (categoria_id_id)');
        $this->addSql('CREATE TABLE proveedores (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(64) DEFAULT NULL, contacto VARCHAR(64) DEFAULT NULL, direccion VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE transacciones (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, producto_id_id INTEGER DEFAULT NULL, proveedor_id_id INTEGER DEFAULT NULL, tipo VARCHAR(64) DEFAULT NULL, fecha DATETIME DEFAULT NULL, cantidad INTEGER DEFAULT NULL, CONSTRAINT FK_66C5ED5E3F63963D FOREIGN KEY (producto_id_id) REFERENCES productos (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_66C5ED5E193A0047 FOREIGN KEY (proveedor_id_id) REFERENCES proveedores (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_66C5ED5E3F63963D ON transacciones (producto_id_id)');
        $this->addSql('CREATE INDEX IDX_66C5ED5E193A0047 ON transacciones (proveedor_id_id)');
        $this->addSql('CREATE TABLE ventas (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cliente_id_id INTEGER DEFAULT NULL, fecha DATETIME DEFAULT NULL, total NUMERIC(10, 2) DEFAULT NULL, CONSTRAINT FK_808D9EACC9C364 FOREIGN KEY (cliente_id_id) REFERENCES clientes (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_808D9EACC9C364 ON ventas (cliente_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categorias');
        $this->addSql('DROP TABLE clientes');
        $this->addSql('DROP TABLE detalles_venta');
        $this->addSql('DROP TABLE producto_proveedores');
        $this->addSql('DROP TABLE productos');
        $this->addSql('DROP TABLE proveedores');
        $this->addSql('DROP TABLE transacciones');
        $this->addSql('DROP TABLE ventas');
    }
}
